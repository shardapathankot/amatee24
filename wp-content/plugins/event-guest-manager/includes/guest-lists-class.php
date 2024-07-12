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
            'ajax' => true
        ]);
    }

    public function get_columns()
    {
        $columns = [
            // 'event_name' => 'Event Name',
            'guest_name' => 'Guest Name',
            'guest_contact' => 'Contact',
            'guest_email' => 'Email',
            'table_number' => 'Table Number',
            'associate_guests' => 'Associates',
            'rsvp_status' => 'RSVP',
            'attendance_status' => 'Attendance'
        ];

        return $columns;
    }


    protected function column_actions($item)
    {
        return ;
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
        $sortable_columns = [];    
        return $sortable_columns;
    }

    public function prepare_items($per_page = 10,$current_page=1,$search_term='')
    {
        $columns = $this->get_columns();
        $hidden = []; 
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = [$columns, $hidden, $sortable];

        $per_page = 10;
        $current_page = $current_page ? $current_page : $this->get_pagenum();
        $total_items = wp_count_posts('event_guests')->publish;
        $search_term = (isset($_REQUEST['s'])) ? wp_unslash(trim($_REQUEST['s'])) : '';

        $orderby = (!empty($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'date';

        $order = (!empty($_REQUEST['order']) && in_array(strtolower($_REQUEST['order']), ['asc', 'desc'])) ? strtolower($_REQUEST['order']) : 'desc';

        $this->items = $this->fetch_table_data($per_page, $current_page, $search_term, $orderby, $order);

        $total_items = $this->get_total_items($search_term);
    
        $total_pages = ceil($total_items / $per_page);

        $this->custom_pagination($current_page, $total_pages);

    }

    private function get_total_items($search_term = '') {
        $args = [
            'post_type' => 'event_guests',
            'post_status' => 'publish',
            's' => $search_term,
            'posts_per_page' => -1, // Retrieve all posts matching the criteria
            'meta_query' => [
                [
                    'key' => 'attendance_status',
                    'value' => 'attended',
                    'compare' => '=',
                ],
            ]
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
            'meta_query' => [
                [
                    'key' => 'attendance_status',
                    'value' => 'attended',
                    'compare' => '=',
                ],
            ]
        ];

        $query = new WP_Query($args);
        $data = [];
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $custom_fields = get_post_custom($post_id);
            $data[] = [
                // 'ID' => $post_id,
                // 'event_name' => get_the_title($custom_fields['associated_event'][0] ?? ''),
                'guest_name' => get_the_title(),
                'guest_contact' => $custom_fields['guest_contact'][0] ?? '',
                'guest_email' => $custom_fields['guest_email'][0] ?? '',
                'table_number' => $custom_fields['table_number'][0] ?? '',
                'associate_guests' => $custom_fields['associate_guests'][0] ?? 0,
                'rsvp_status' => $custom_fields['rsvp_status'][0] ?? '',
                'attendance_status' => $custom_fields['attendance_status'][0] ?? ''
            ];
        }

        wp_reset_postdata();
        return $data;
    }

    public function custom_pagination($current_page, $total_pages) {
        $pagination_args = array(
            'base'      => add_query_arg('paged', '%#%'),
            'format'    => '',
            'current'   => max(1, $current_page),
            'total'     => $total_pages,
            'mid_size'  => 1,
            'end_size'  => 2,
            'prev_text' => __('« Prev'),
            'next_text' => __('Next »'),
        );
    
        echo paginate_links($pagination_args);
    }
}

?>