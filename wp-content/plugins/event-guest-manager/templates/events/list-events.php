<?php 
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class Event_List_Table extends WP_List_Table {

    public function __construct() {
        parent::__construct([
            'singular' => 'event',
            'plural'   => 'events',
            'ajax'     => false
        ]);
    }

    public function get_columns() {
        $columns = [
            'cb'      => '<input type="checkbox" />',
            'event_name'   => 'Event Name',
            'organiser_name'   => 'Organiser Full Name',
            'organiser_email'    => 'Organiser Email',
            'contact_number'=>'Contact Number',
            'venue_details'=>'Venue Details',
            'start_datetime'=>'Start Date Time',
            'end_datetime'=>'End Date Time',
            'status'=>'status',
            'actions' => __('Actions', 'your-text-domain'),
            // Add other columns as needed
        ];

        return $columns;
    }

    protected function column_actions($item) {
        $actions = array(
            'edit'   => sprintf('<a href="?page=%s&action=%s&event=%s">Edit</a>', esc_attr($_REQUEST['page']), 'edit', absint($item['ID'])),
            'delete' => sprintf('<a href="?page=%s&action=%s&event=%s">Delete</a>', esc_attr($_REQUEST['page']), 'delete', absint($item['ID'])),
        );
        return str_replace('row-actions','',$this->row_actions($actions));
    }

    protected function column_default($item, $column_name) {
        switch ($column_name) {
            // ... handle other columns ...

            default:
                return $item[$column_name];
        }
    }

    protected function get_sortable_columns() {
        $sortable_columns = [
            'event_name' => ['event_name', true],
            'start_datetime'  => ['start_datetime', true]
            // Add other sortable columns as needed
        ];

        return $sortable_columns;
    }

    public function prepare_items() {
        $columns  = $this->get_columns();
        $hidden   = []; // Add any hidden columns
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = [$columns, $hidden, $sortable];

        // Retrieve data for table
        $per_page     = 10;
        $current_page = $this->get_pagenum();
        $total_items  = wp_count_posts('event')->publish;
        // Capture the search term if any
        $search_term = (isset($_REQUEST['s'])) ? wp_unslash(trim($_REQUEST['s'])) : '';

        // Set default orderby to 'date' if not provided
        $orderby = (!empty($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'date';

        // Set default order to 'desc' if not provided
        $order = (!empty($_REQUEST['order']) && in_array(strtolower($_REQUEST['order']), ['asc', 'desc'])) ? strtolower($_REQUEST['order']) : 'desc';

        $this->items = $this->fetch_table_data($per_page, $current_page, $search_term, $orderby, $order);

        // Adjust the total items based on the search or the total number of items
        $total_items = $this->get_total_items($search_term);
    
        $this->set_pagination_args([
            'total_items' => $total_items,
            'per_page' => $per_page
        ]);
    }

    private function get_total_items($search_term = '') {
        $args = [
            'post_type' => 'event',
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
            'offset'         => ($page_number - 1) * $per_page,
            'post_type'      => 'event',
            'post_status'    => 'publish',
            's' => $search_term, // Search parameter
            'orderby' => $orderby,
            'order' => $order,
        ];

        $query = new WP_Query($args);
        $data = [];

        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $custom_fields = get_post_custom($post_id);
            $data[] = [
                'ID' => $post_id,
                'event_name' => get_the_title(),
                'organiser_name' => $custom_fields['organiser_name'][0] ?? '',
                'organiser_email' => $custom_fields['organiser_email'][0] ?? '',
                'contact_number' => $custom_fields['contact_number'][0] ?? '',
                'venue_details' => $custom_fields['venue_details'][0] ?? '',
                'start_datetime' => $custom_fields['start_datetime'][0] ?? '',
                'end_datetime' => $custom_fields['end_datetime'][0] ?? '',
                'status' => $custom_fields['status'][0] ?? '',
            ];
        }

        wp_reset_postdata();
        return $data;
    }
}
$eventListTable = new Event_List_Table();
$eventListTable->prepare_items();
?>
<div class="wrap">
    <h1 class="wp-heading-inline">Events</h1>
    <form method="get">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
        <?php
        $eventListTable->search_box('search', 'search_id');
        $eventListTable->display();
        ?>
    </form>
</div>