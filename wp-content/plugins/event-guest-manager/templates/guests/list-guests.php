<style>
    /* admin-style.css */
    .row-actions {
        visibility: visible !important;
    }
</style>
<?php
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class Guest_List_Table extends WP_List_Table
{

    public function __construct()
    {
        parent::__construct([
            'singular' => 'Guest',
            'plural' => 'Guests',
            'ajax' => false
        ]);
    }

    public function get_columns()
    {
        $columns = [
            'cb' => '<input type="checkbox" />',
            'event_name' => 'Event Name',
            'guest_name' => 'Guest Name',
            'guest_contact' => 'Guest Contact',
            'guest_email' => 'Guest Email',
            'table_number' => 'Table Number',
            'associate_guests' => 'Associate Guests',
            'rsvp_status' => 'RSVP Status',
            'attendance_status' => 'Attendance Status',
            'qr_code_url' => 'QR Url',
            'actions' => __('Actions', 'your-text-domain'),
            // Add other columns as needed
        ];

        return $columns;
    }


    protected function column_actions($item)
    {
        $actions = array(
            'send_email' => sprintf('<a href="javascript:;" id="resend_invitation" data-id="%s">Resend Invitation</a>', absint($item['ID'])),
            'edit' => sprintf('<a href="?page=%s&action=%s&guest_id=%s">Edit</a>', esc_attr('add-guest'), 'edit', absint($item['ID'])),
            'delete' => sprintf('<a href="?page=%s&action=%s&guest_id=%s">Delete</a>', esc_attr($_REQUEST['page']), 'delete', absint($item['ID'])),
        );
        return str_replace('row-actions', '', $this->row_actions($actions));
    }

    protected function column_default($item, $column_name)
    {

        switch ($column_name) {

            default:
                return $item[$column_name];
        }
    }

    protected function get_sortable_columns()
    {
        $sortable_columns = [
            'guest_name' => ['guest_name', true],
            'attendance_status' => ['attendance_status', true]
        ];

        return $sortable_columns;
    }

    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = []; // Add any hidden columns
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = [$columns, $hidden, $sortable];

        $per_page = 10;
        $current_page = $this->get_pagenum();
        $total_items = wp_count_posts('event_guests')->publish;
        $search_term = (isset($_REQUEST['s'])) ? wp_unslash(trim($_REQUEST['s'])) : '';

        $orderby = (!empty($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'date';

        $order = (!empty($_REQUEST['order']) && in_array(strtolower($_REQUEST['order']), ['asc', 'desc'])) ? strtolower($_REQUEST['order']) : 'desc';

        $this->items = $this->fetch_table_data($per_page, $current_page, $search_term, $orderby, $order);

        $total_items = $this->get_total_items($search_term);
    
        $this->set_pagination_args([
            'total_items' => $total_items,
            'per_page' => $per_page
        ]);

    }

    private function get_total_items($search_term = '') {
        $args = [
            'post_type' => 'event_guests',
            'post_status' => 'publish',
            's' => $search_term,
            'posts_per_page' => -1 // Retrieve all posts matching the criteria
        ];
    
        $query = new WP_Query($args);
        $total_items = $query->found_posts;
    
        wp_reset_postdata();
        return $total_items;
    }
    

    private function fetch_table_data($per_page = 5, $page_number = 1, $search_term = '', $orderby = 'default_column_name', $order = 'desc')
    {
        $args = [
            'posts_per_page' => $per_page,
            'offset' => ($page_number - 1) * $per_page,
            'post_type' => 'event_guests',
            'post_status' => 'publish',
            's' => $search_term, // Search parameter
            'orderby' => $orderby,
            'order' => $order,
        ];

        $query = new WP_Query($args);
        $data = [];
        $upload_dir = wp_upload_dir();
        $qr_image_path = $upload_dir['basedir'] . '/';
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $custom_fields = get_post_custom($post_id);
            $data[] = [
                'ID' => $post_id,
                'event_name' => get_the_title($custom_fields['associated_event'][0] ?? ''),
                'guest_name' => get_the_title(),
                'guest_contact' => $custom_fields['guest_contact'][0] ?? '',
                'guest_email' => $custom_fields['guest_email'][0] ?? '',
                'table_number' => $custom_fields['table_number'][0] ?? '',
                'associate_guests' => $custom_fields['associate_guests'][0] ?? 0,
                'rsvp_status' => $custom_fields['rsvp_status'][0] ?? '',
                'attendance_status' => $custom_fields['attendance_status'][0] ?? '',
                'qr_code_url' => isset($custom_fields['qr_code_url'][0]) ? '<a style="cursor:pointer;" data-id="' . $post_id . '" id="email-send-qr" class="btn btn-success btn-lg">Resend QR Email</a> | <a href="' . esc_url(site_url('wp-content/uploads/') . $custom_fields['qr_code_url'][0]) . '" target="_blank">' . esc_html(get_the_title()) . ' QR</a>' : ''
            ];
        }

        wp_reset_postdata();
        return $data;
    }
}
$guestListTable = new Guest_List_Table();
$guestListTable->prepare_items();
?>
<div class="notice notice-success is-dismissible" style="display:none"></div>
<div class="notice notice-error notice-errors is-dismissible" style="display:none"></div>
<div class="wrap">    
    <form method="get">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
        <?php
            $guestListTable->search_box('search', 'search_id');
            $guestListTable->display();
        ?>
    </form>
    <script>
        jQuery(document).ready(function ($) {
            $('.notice-success').hide();
            $('.notice-errors').hide();
            $('.delete-action').on('click', function (e) {
                var confirmation = confirm("Are you sure you want to delete this?");
                if (!confirmation) {
                    e.preventDefault();
                }
            });

            $(document).on('click','#resend_invitation',function (event) {
                event.preventDefault();
                $('.notice-errors').hide();
                $('.notice-success').hide();
                var dataId = $(this).data('id');
                var data = {
                    'action': 'resend_email',
                    'security': "<?php echo wp_create_nonce('email_send_nonce'); ?>",
                    'subject': 'event_re-invitation',
                    'guest_id': dataId
                };

                $.post("<?php echo admin_url('admin-ajax.php'); ?>", data, function (response) {
                    if (response.success) {
                        $('.notice-success').show();
                        $('.notice-errors').hide();
                        $('.notice-success').html('<p>Resend invitation email sent successfully.</p>');
                        setTimeout(function () {
                            $('.notice-success').html('');
                            window.location.reload();
                        }, 5000);
                    } else {
                        $('.notice-errors').show();
                        $('.notice-success').hide();
                        $('.notice-errors').html('<p>'+response.data+'</p>');
                        setTimeout(function () {
                            $('.notice-error').html('');
                            window.location.reload();
                        }, 5000);
                    }
                });
            });

            $(document).on('click','#email-send-qr',function (event) {
                event.preventDefault();
                $('.notice-success').hide();
                $('.notice-errors').hide();
                var dataId = $(this).data('id');
                var data = {
                    'action': 'resend_qr_email',
                    'security': "<?php echo wp_create_nonce('email_send_nonce'); ?>",
                    'subject': 'event_qr_resent',
                    'guest_id': dataId
                };

                $.post("<?php echo admin_url('admin-ajax.php'); ?>", data, function (response) {
                    if (response.success) {
                        $('.notice-success').show();
                        $('.notice-errors').hide();
                        $('.notice-success').html('<p>Resend QR sent successfully.</p>');
                        setTimeout(function () {
                            $('.notice-success').html('');
                            window.location.reload();
                        }, 5000);
                    } else {
                        $('.notice-success').hide();
                        $('.notice-errors').show();
                        $('.notice-errors').html('<p>'+response.data+'</p>');
                        // setTimeout(function () {
                        //     $('.notice-error').html('');
                        //     window.location.reload();
                        // }, 5000);
                    }
                });
            });
        });
    </script>
</div>