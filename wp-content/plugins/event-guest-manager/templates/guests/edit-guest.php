<?php 
// Set up the arguments for the WP_Query
$args = array(
    'post_type'      => 'event', // Assuming your CPT is 'event'
    'posts_per_page' => -1, // Get all matching posts
    'meta_key'       => 'start_datetime', // Use the key for the start date
    'orderby'        => 'meta_value', // Order by the start date
    'order'          => 'ASC', // Ascending order
    'meta_query'     => array(
        array(
            'key'     => 'start_datetime',
            'value'   => current_time('Y-m-d H:i'), // Use the current time to compare
            'compare' => '>', // Only show events that are after the current time
            'type'    => 'DATETIME', // Type of the custom field
        ),
    ),
);
// Create a new WP_Query
$query = new WP_Query($args);
?>
<style>
    form.add-guest {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f4f4f4;
        border-radius: 8px;
    }

    form.add-guest input[type="text"],
    form.add-guest input[type="email"],
    form.add-guest input[type="number"],
    form.add-guest input[type="datetime-local"],
    form.add-guest textarea,
    form.add-guest select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }

    form.add-guest textarea {
        height: 100px;
        resize: vertical;
    }

    form.add-guest input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 15px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    form.add-guest input[type="submit"]:hover {
        background-color: #45a049;
    }

    .button-link {
        background-color: #4CAF50; /* Green */
        color: white;
        padding: 15px 20px;
        text-decoration: none;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        display: inline-block; /* To allow padding and dimensions */
    }

    .button-link:hover {
        background-color: #45a049; /* Darker green on hover */
    }
</style>
<div class="wrap">
    <h1>Edit Event Guest</h1>
    <?php 
        
        if (!empty($success_message)) {
            echo '<div class="notice notice-success is-dismissible"><p>' . $success_message . '</p></div>';
        }
        
        if (!empty($error_message)) {
            echo '<div class="notice notice-error is-dismissible"><p>' . $error_message . '</p></div>';
        }
        $url = admin_url('admin.php?page=list-guests');
    ?>
    <form class="add-guest" method="post" action="">
        <select name="event_id" required>
            <option value="">Select an Event</option>
            <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <option value="<?php the_ID(); ?>" <?php echo isset($custom_fields['associated_event'][0]) && $custom_fields['associated_event'][0] == get_the_ID() ? 'selected="selected"' : ''; ?>><?php the_title(); ?> - <?php echo get_post_meta(get_the_ID(), 'start_datetime', true); ?></option>
                <?php endwhile; ?>
            <?php endif; ?>
        </select>
        
        <input type="hidden" name="event_action" value="add_guest"/>
        <input type="text" name="guest_name" placeholder="Guest Name" value="<?php echo $single_value ?? ''; ?>" required/><br/>
        <input type="number" name="guest_contact" min="0" value="<?php echo $custom_fields['guest_contact'][0] ?? ''; ?>" placeholder="Guest contact" class="widefat" pattern="(\+\d{1,3})?[\s-]?(\(\d{1,3}\)|\d{1,3})[\s-]?(\d{1,4}[\s-]?){1,3}" title="Please enter a valid contact number" required>
        <!-- <input type="text" name="guest_contact" placeholder="Guest Contact" class="widefat" value="<?php //echo $custom_fields['guest_contact'][0] ?? ''; ?>" required> -->
        <input type="text" name="guest_email" placeholder="Guest Email" class="widefat" value="<?php echo $custom_fields['guest_email'][0] ?? ''; ?>" required>
        <input type="text" name="table_number" placeholder="Table Number" class="widefat" value="<?php echo $custom_fields['table_number'][0] ?? ''; ?>" required>
        <input type="number" name="associate_guests" min="0" placeholder="Number of additional guests" class="widefat" value="<?php echo $custom_fields['associate_guests'][0] ?? ''; ?>" required>
        <select name="rsvp_status" class="widefat" required>
            <option value="pending" <?php echo isset($custom_fields['rsvp_status'][0]) && $custom_fields['rsvp_status'][0] == 'pending' ? 'selected="selected"' : ''; ?>>Pending</option>
            <option value="confirmed" <?php echo isset($custom_fields['rsvp_status'][0]) && $custom_fields['rsvp_status'][0] == 'confirmed' ? 'selected="selected"' : ''; ?>>Confirmed</option>
            <option value="declined" <?php echo isset($custom_fields['rsvp_status'][0]) && $custom_fields['rsvp_status'][0] == 'declined' ? 'selected="selected"' : ''; ?>>Declined</option>
        </select>
        <select name="attendance_status" class="widefat" required>
            <option value="not_attended" <?php echo isset($custom_fields['attendance_status'][0]) && $custom_fields['attendance_status'][0] == 'not_attended' ? 'selected="selected"' : ''; ?>>Not Attended</option>
            <option value="attended" <?php echo isset($custom_fields['attendance_status'][0]) && $custom_fields['attendance_status'][0] == 'attended' ? 'selected="selected"' : ''; ?>>Attended</option>
        </select>
        <br/>
        <input type="submit" name="submit_guest" value="Submit"/>
        <a href="<?php echo esc_url($url); ?>" class="button-link">Go to Guest List</a>
    </form>
</div>