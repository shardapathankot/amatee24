<?php 
    $args = [
        'posts_per_page' => 1, // Only fetch the latest event
        'post_type'      => 'event',
        'post_status'    => 'publish',
        'orderby'        => 'date', // Order by the date the post was published
        'order'          => 'DESC', // Start with the most recent
    ];
    
    $query = new WP_Query($args);
    
    // Check if there's at least one published event
    if ( $query->have_posts() ) {
        $query->the_post(); // Set up the post data        
        $latest_event_id = get_the_ID(); 
        wp_reset_postdata(); // Reset the global post object so that the rest of the page works correctly
    } else {
        // Handle cases where there are no published events
        $latest_event_id = 1433; 
    }
    
    // Sanitize attributes.
    $event_id = intval($latest_event_id);

    ob_start(); // Start output buffering to capture the HTML.
?>
<style>
    .row-actions {
        visibility: visible !important;
    }
</style>
<div class="wrap">    
    <form id="user-search-form" action="" method="post">
        <input type="hidden" id="event-id" value="<?php echo esc_attr($event_id); ?>">
        <input type="text" id="user-search-query" placeholder="Search users...">
        <button type="submit">Search</button>
    </form>    
    <div id="event-users-list">
        <p>Loading...</p> 
    </div>
    <script>
        jQuery(document).ready(function ($) {
            function loadEventUsers(eventId, searchQuery = '', page = 1) {
                $('#event-users-list').html('Loading ...');
                $.ajax({
                    url: event_guest_update_obj.ajaxurl,
                    type: 'POST',
                    data: {
                        'action': 'event_attended_users_list',
                        'event_id': eventId,
                        'query': searchQuery,
                        'page': page
                    },
                    success: function(response) {
                        
                        $('#event-users-list').html(response);
						$('.toggle-row').remove();
                    }
                });
            }
            loadEventUsers($('#event-id').val());
            $('#user-search-form').on('submit', function(e) {
                e.preventDefault();
                loadEventUsers($('#event-id').val(), $('#user-search-query').val());
            });

            $(document).on('click','a.page-numbers',function(e) {
                e.preventDefault();                
                var href = $(this).attr('href');                
                var urlParams = new URLSearchParams(href.split('?')[1]);                
                var pageNumber = urlParams.get('paged');
                loadEventUsers($('#event-id').val(), $('#user-search-query').val(),pageNumber);
            });

            
        });
    </script>
</div>





    
    