<style>
    form.add-event {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f4f4f4;
        border-radius: 8px;
    }

    form.add-event input[type="text"],
    form.add-event input[type="email"],
    form.add-event input[type="number"],
    form.add-event input[type="datetime-local"],
    form.add-event textarea,
    form.add-event select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }

    form.add-event textarea {
        height: 100px;
        resize: vertical;
    }

    form.add-event input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 15px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    form.add-event input[type="submit"]:hover {
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
    <h1>Edit Event</h1>
    <?php 
        if (!empty($success_message)) {
            echo '<div class="notice notice-success is-dismissible"><p>' . $success_message . '</p></div>';
        }
        
        if (!empty($error_message)) {
            echo '<div class="notice notice-error is-dismissible"><p>' . $error_message . '</p></div>';
        }
        $url = admin_url('admin.php?page=event-management');
    ?>
    <form class="add-event" method="post" action="">
        <input type="hidden" name="event_action" value="edit_event"/>
        <input type="text" name="event_name" placeholder="Event Name" value="<?php echo $single_value ?? ''; ?>"  required/><br/>
        <input type="text" name="organiser_name" value="<?php echo $custom_fields['organiser_name'][0] ?? ''; ?>" placeholder="Organiser Full Name" required/><br/>
        <input type="email" name="organiser_email" value="<?php echo $custom_fields['organiser_email'][0] ?? ''; ?>" placeholder="Organiser Email" required/><br/>
        <input type="text" name="contact_number" value="<?php echo $custom_fields['contact_number'][0] ?? ''; ?>" placeholder="Contact Number" required/><br/>
        <textarea name="venue_details" placeholder="Venue Details" required><?php echo $custom_fields['venue_details'][0] ?? ''; ?></textarea><br/>
        <input type="datetime-local" value="<?php echo $custom_fields['start_datetime'][0] ?? ''; ?>" name="start_datetime" placeholder="Start Date Time" required/><br/>
        <input type="datetime-local" name="end_datetime" value="<?php echo $custom_fields['end_datetime'][0] ?? ''; ?>" placeholder="End Date Time" required/><br/>
        <select name="status">
            <option value="pending" <?php if(isset($custom_fields['status'][0]) && $custom_fields['status'][0] == 'pending'){ echo 'selected="selected"';} echo $custom_fields['end_datetime'][0] ?? ''; ?>>Pending</option>
            <option value="started" <?php if(isset($custom_fields['status'][0]) && $custom_fields['status'][0] == 'started'){ echo 'selected="selected"';} echo $custom_fields['end_datetime'][0] ?? ''; ?>>Started</option>
            <option value="ended" <?php if(isset($custom_fields['status'][0]) && $custom_fields['status'][0] == 'ended'){ echo 'selected="selected"';} echo $custom_fields['end_datetime'][0] ?? ''; ?>>Ended</option>
        </select><br/>
        <input type="submit" name="submit_event" value="Submit"/>
        <a href="<?php echo esc_url($url); ?>" class="button-link">Go to Event Management</a>
    </form>
</div>