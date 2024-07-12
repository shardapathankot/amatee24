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

class Media_List_Table extends WP_List_Table
{

    public function __construct()
    {
        parent::__construct([
            'singular' => 'event_media_gallery',
            'plural' => 'event_media_galleries',
            'ajax' => false
        ]);
    }

    public function get_columns()
    {
        $columns = [
            'cb' => '<input type="checkbox" />',
            'event_media_gallery_url' => 'Image OR video',
            'guest_email' => 'Guest Email',
            'actions' => __('Actions', 'your-text-domain'),
        ];

        return $columns;
    }


    protected function column_actions($item)
    {
        if($item['post_status'] && $item['post_status']=='publish'){
            $approve = sprintf('<a href="#" data-media-id="%s" class="disapproves">Disapprove</a>', absint($item['ID']));
        }else{
            $approve = sprintf('<a href="#" data-media-id="%s" class="approves">Approve</a>', absint($item['ID']), esc_attr('approve-media'), 'Approve');
        }
         
        $actions = array(   
            'edit' => $approve,         
            'view' => sprintf('<a class="open-media" data-media-id="%s" href="#">%s</a>',absint($item['ID']), 'view'),        
            'delete' => sprintf('<a href="?page=%s&action=%s&media_id=%s" class="delete-action">Delete</a>', esc_attr($_REQUEST['page']), 'delete', absint($item['ID'])),
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
            // 'guest_name' => ['guest_name', true],
            // 'event_media_gallery' => ['event_media_gallery', true]
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
        // $total_items = wp_count_posts('event_media_gallery')->publish + wp_count_posts('event_media_gallery')->pending;
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
            'post_type' => 'event_media_gallery',
            'post_status'    => array('publish', 'pending'),
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
            'post_type' => 'event_media_gallery',
            'post_status'    => array('publish', 'pending'),
            's' => $search_term, 
            'orderby' => $orderby,
            'order' => $order,
        ];

        $query = new WP_Query($args);
        $data = [];
        $upload_dir = wp_upload_dir();
        $uploads_base_url = $upload_dir['baseurl'] . '/event_uploads/';
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $event_media_gallery_url = get_post_meta($post_id, 'event_media_gallery_url', true);
            $media_tag = $this->display_media($event_media_gallery_url);
            $custom_fields = get_post_custom($post_id);
            $data[] = [
                'ID' => $post_id,
                'event_media_gallery_url' => isset($media_tag) ? $media_tag: '',
                'guest_email' => get_the_title(),
                'post_status' => get_post_status($post_id) 
            ];
        }

        wp_reset_postdata();
        return $data;
    }


    /**
     * Check if a media file is either an image or a video.
     * If it's an image, return the HTML <img> tag.
     * If it's a video, return the HTML <video> tag.
     * If it's neither, return an empty string.
     *
     * @param string $file_url The URL of the media file.
     * @return string The HTML tag for displaying the media file.
     */
    function display_media($file_url) {
        $file_extension = pathinfo($file_url, PATHINFO_EXTENSION);
        $image_extensions = array('jpg', 'jpeg', 'png', 'gif');
        $video_extensions = array('mp4', 'mov', 'avi', 'wmv');
        if (in_array(strtolower($file_extension), $image_extensions)) {
            return '<img src="' . esc_url($file_url) . '" alt="Image" height="150" width="250">';
        }
        elseif (in_array(strtolower($file_extension), $video_extensions)) {
            return '<video controls height="150" width="250"><source src="' . esc_url($file_url) . '" type="video/' . esc_attr($file_extension) . '">Your browser does not support the video tag.</video>';
        } else {
            return '';
        }
    }


}
$mediaListTable = new Media_List_Table();
$mediaListTable->prepare_items();
?>
<div class="notice notice-success is-dismissible" style="display:none"></div>
<div class="notice notice-error notice-errors is-dismissible" style="display:none"></div>
<div class="wrap">    
    <form method="get">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
        <?php
            $mediaListTable->search_box('search', 'search_id');
            $mediaListTable->display();
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
            
            $('.approves, .disapproves').click(function(e) {
                e.preventDefault(); // Prevent default anchor action

                var link = $(this); // The clicked link
                var action = link.hasClass('approves') ? 'approve' : 'disapprove';  
                var mediaId = link.data('media-id');
                $('.notice-errors').hide();
                $('.notice-success').hide();
                $.ajax({
                    url: "<?php echo admin_url('admin-ajax.php'); ?>",
                    type: 'POST',
                    data: {
                        action: 'handle_media_approval',
                        media_action: action,
                        media_id: mediaId,
                        security: "<?php echo wp_create_nonce('media_approval_nonce'); ?>" // nonce for security
                    },
                    success: function(response) {
                        if (response.success) {
                            $('.notice-success').show();
                            $('.notice-errors').hide();
                            $('.notice-success').html('<p>'+response.data+'</p>');
                            setTimeout(function () {
                                $('.notice-success').html('');
                                window.location.reload();
                            }, 1000);
                        } else {
                            $('.notice-errors').show();
                            $('.notice-success').hide();
                            $('.notice-errors').html('<p>'+response.data+'</p>');
                            setTimeout(function () {
                                $('.notice-error').html('');
                                window.location.reload();
                            }, 1000);
                        }
                    }
                });
            });
            // $(document).on('click','#resend_invitation',function (event) {
            //     event.preventDefault();
            //     $('.notice-errors').hide();
            //     $('.notice-success').hide();
            //     var dataId = $(this).data('id');
            //     var data = {
            //         'action': 'resend_email',
            //         'security': "<?php echo wp_create_nonce('email_send_nonce'); ?>",
            //         'subject': 'event_re-invitation',
            //         'guest_id': dataId
            //     };

            //     $.post("<?php echo admin_url('admin-ajax.php'); ?>", data, function (response) {
            //         if (response.success) {
            //             $('.notice-success').show();
            //             $('.notice-errors').hide();
            //             $('.notice-success').html('<p>Resend invitation email sent successfully.</p>');
            //             setTimeout(function () {
            //                 $('.notice-success').html('');
            //                 window.location.reload();
            //             }, 5000);
            //         } else {
            //             $('.notice-errors').show();
            //             $('.notice-success').hide();
            //             $('.notice-errors').html('<p>'+response.data+'</p>');
            //             setTimeout(function () {
            //                 $('.notice-error').html('');
            //                 window.location.reload();
            //             }, 5000);
            //         }
            //     });
            // });
        });
    </script>
</div>