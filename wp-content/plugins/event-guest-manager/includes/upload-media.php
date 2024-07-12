<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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

$query = new WP_Query($args);

$args1 = array(
    'post_type'      => 'event', // Assuming your CPT is 'event'
    'posts_per_page' => 1, // Get only the latest single upcoming event
    'meta_key'       => 'start_datetime', // Use the key for the start date
    'orderby'        => 'meta_value', // Order by the start date
    'order'          => 'ASC', // Ascending order to get the next event
    'meta_query'     => array(
        array(
            'key'     => 'start_datetime',
            'value'   => current_time('Y-m-d H:i'), // Use the current time to compare
            'compare' => '>', // Only show events that are after the current time
            'type'    => 'DATETIME', // Type of the custom field
        ),
    ),
);

$query1 = new WP_Query($args1);
$eventdate = '';
$eventname = '';
$start = '';
$end = '';
$address = '';
$eventId = '';
if ($query1->have_posts()) {
    while ($query1->have_posts()) {
        $query1->the_post();
        $eventId = get_the_ID() ?? '';
        $start_datetime = get_post_meta(get_the_ID(), 'start_datetime', true);
        $date_format = 'F j, Y'; // Example: March 10, 2021
        $time_format = 'g:i a'; // Example: 3:30 pm
        
        $start_datetime = strtotime($start_datetime);
        $formatted_date = date_i18n($date_format, $start_datetime);
        $formatted_time = date_i18n($time_format, $start_datetime);

        $end_datetime = get_post_meta(get_the_ID(), 'end_datetime', true);
        $date_format = 'F j, Y'; // Example: March 10, 2021
        $time_format = 'g:i a'; // Example: 3:30 pm
        
        $end_datetime = strtotime($end_datetime);
        $formatted_end_date = date_i18n($date_format, $end_datetime);
        $formatted_end_time = date_i18n($time_format, $end_datetime);
        $eventdate = esc_html($formatted_date) ?? '';
        $eventname = get_the_title() ?? '';
        $start = $formatted_time ?? '';
        $end = $formatted_end_date . ' '.$formatted_end_time ?? '';
        $address = str_replace(',','<br />',get_post_meta(get_the_ID(), 'venue_details', true));
    }

    $formDisplay = do_shortcode('[custom_email_upload_form]');
    wp_reset_postdata();
} else {
    $formDisplay = '<p>No upcoming events found.</p>';
}
?>
<style>
    a.btn.btn-default {
    background: #000;
    color: #FFF;
    font-weight: bold;
    padding: 10px 30px 10px 30px;
    font-size: 25px;
    text-decoration: none;
    }
    a.btn.btn-default:hover{
        background: #CCC;
        color: #000;
    }
    #link-message {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: <?php echo isset($_SESSION['link_message']['decline']) && !empty($_SESSION['link_message']['decline']) ? '#ee0404' : 'green'; ?>;
        padding: 20px 15px;
        border-radius: 5px;
        border-collapse: collapse;
        border-spacing: 0;
        width: inherit;
        max-width: 762px;
        color: #FFF;
        font-size: 20px;
    }
    p#successmsg .success {
        padding: 10px;
        background: #287229;
        width: 93%;
        margin: 10px 15px auto;
        color: #FFF;
    }
    p#successmsg .error{
        padding: 10px;
        background: red;
        width: 93%;
        margin: 10px 15px auto;
        color: #FFF;
    }
    p#successmsg .success p, p#successmsg .error p {
        color: #FFF;
        font-size: 18px;
    }
</style>
<div topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0" marginwidth="0" marginheight="0" width="100%" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;
    background-color: #F0F0F0;
    color: #000000; padding-top: 5rem;" bgcolor="#F0F0F0" text="#000000">
    <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0"
        style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%;" class="background">
        <tr>
            <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;"
                bgcolor="#F0F0F0">

                <table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF" width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
                max-width: 760px;" class="container">
<tr>
                        <td><?php if(isset($_SESSION['link_message'])): ?>
                            <div id="link-message">
                                <?php echo $_SESSION['link_message']['decline'] ?? ''; ?>
                                <?php echo $_SESSION['link_message']['accept'] ?? ''; ?>
                            </div>
                            <script>
                                setTimeout(function() {
                                    document.getElementById('link-message').style.display = 'none';
                                    <?php unset($_SESSION['link_message']); ?> 
                                }, 5000); 
                            </script>
                            <?php endif; ?> 
                        </td>
                    </tr>
                                        
                    <tr>
                        <td style="    border-collapse: collapse;
                        border-spacing: 0;
                        margin: 0;
                        padding: 0;
                        padding-top: 20px;">
                            <table style="    width: 95%;
                            margin: 1rem auto 0px;
                            border: 1px solid #939393;
                            padding: 25px 0px;    background-color: #FFFF;">
                                <tr>
                                    <td align="center" valign="top" style="border-collapse: collapse;
                                    border-spacing: 0;
                                    margin: 0;
                                    padding: 0;
                                    padding-bottom: 0px;
                                    width: 100%;
                                    display: block;
                                    font-size: 16px;
                                    font-weight: 500;
                                    text-align: left;
                                    letter-spacing: 2px;
                                    padding-top: 0px;
                                    color: #000000;
                                    font-family: sans-serif;" class="subheader">
                                        <p style="    margin: 0 0 0 0;
                                        padding-left: 6.25%;
                                        font-size: 18px;">
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height: 10px;"></tr>
                                <tr style="height: 40px;"></tr>
                                <tr>
                                    <td align="center" valign="top" style="border-collapse: collapse;
                                    border-spacing: 0;
                                    margin: 0;
                                    padding: 0;
                                    padding-bottom: 0px;
                                    width: 100%;
                                    display: block;
                                    font-size: 16px;
                                    font-weight: 500;
                                    text-align: left;
                                    letter-spacing: 2px;
                                    padding-top: 0px;
                                    color: #000000;
                                    font-family: sans-serif;" class="subheader">
                                        
                                    </td>
                                </tr>
                                <tr style="height: 20px;"></tr>
                                <tr>
                                    <td style="    text-align: center;">
                                        
                                    </td>
                                </tr>
                                <tr style="height: 10px;"></tr>
                                
                                <tr style="height: 10px;"></tr>
                                <tr>
                                    <td style="color: #000000;
                                    text-align: center;
                                    margin: 0 0 0 0;
                                    padding-left: 20.25%;
                                    padding-right: 20.25%;
                                    font-size: 18px;
                                    font-weight: normal;
                                    line-height: 25px;">
                                       We are so excited to celebrate this day with our nearest and dearest, and are hoping to keep the guest memories. So, a guest images and videos would be displayed at: amatee24.com.
                                       Please input email and upload event video or image.
                                    </td>
                                </tr>
                                <tr style="height: 20px;"></tr>
                                <tr>
                                    <td style="    text-align: center;">
                                    <div class="form_rsvp">                        
                                            
                                            <div class="row">
                                            <form id="event-upload-form" action="" method="post" class="form-container event-upload-form" enctype="multipart/form-data">
                                                <h1>Upload Image OR Video</h1>
                                                <p id="successmsg"></p>
                                                
                                                <div class="hideform">
                                                    <p>Please fill out the form below to upload image or video</p>        
                                                    <input type="hidden" name="event_id" value="<?php echo $eventId ??''; ?>">                        
                                                    <input type="email" name="guest_email" placeholder="Guest Email" class="widefat" required>
                                                    <input type="file" name="guest_media" class="widefat" required />
                                                    <br /> 
                                                    <br />
                                                    <input type="submit" class="btn" name="submit_media" value="upload" />
                                                </div>                                         
                                                </form>

                                        </div>                        
                                        </div>
                                    </td>
                                </tr>
                                <tr style="height: 10px;"></tr>
                                <tr>
                                    <td style="    color: #000000;
                                    text-align: center;
                                    margin: 0 0 0 0;
                                    padding-left: 15.25%;
                                    padding-right: 15.25%;
                                    font-size: 20px;">
                                        
                                    </td>
                                </tr>                                
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
            padding-top: 25px;
            padding-bottom: 5px;" class="button">
                            <a href="#!" target="_blank" style="text-decoration: none;">
                                <table border="0" cellpadding="0" cellspacing="0" align="center"
                                    style="max-width: 340px; min-width: 120px; border-collapse: collapse; border-spacing: 0; padding: 0;">
                                    <tr>
                                        <td align="center">
                                        </td>
                                    </tr>
                                </table>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
            padding-top: 25px;" class="line">
                            <hr color="#E0E0E0" align="center" width="100%" size="1" noshade
                                style="margin: 0; padding: 0;" />
                        </td>
                    </tr>
                </table>
                <table border="0" cellpadding="0" cellspacing="0" align="center" width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
    max-width: 560px;" class="wrapper">

                    <tr>
                        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
            padding-top: 25px;" class="social-icons">
                            <table width="256" border="0" cellpadding="0" cellspacing="0" align="center"
                                style="border-collapse: collapse; border-spacing: 0; padding: 0;">
                                <tr>

                                <tr>
                                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 13px; font-weight: 400; line-height: 150%;
            padding-top: 20px;
            padding-bottom: 20px;
            color: #999999;
            font-family: sans-serif;" class="footer">
                                        <img width="1" height="1" border="0" vspace="0" hspace="0"
                                            style="margin: 0; padding: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: block;"
                                            src="" />

                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <style>
                    .form_rsvp {
                        height: 100%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }

                    .form-container {
                        max-width: 500px;
                        padding: 10px;
                        background-color: white;
                    }
                    
                    .form-container input[type=text],
                    .form-container input[type=email],
                    .form-container input[type=file] {
                        width: 93%;
                        padding: 15px;
                        margin: 5px 0 22px 0;
                        border: none;
                        background: #f1f1f1;
                    }

                    /* When the inputs get focus, do something */
                    .form-container input[type=text]:focus,
                    .form-container input[type=password]:focus {
                        background-color: #ddd;
                        outline: none;
                    }

                    /* Set a style for the submit/login button */
                    .form-container .btn {
                        background-color: #04AA6D;
                        color: white;
                        padding: 16px 20px;
                        border: none;
                        cursor: pointer;
                        width: 100%;
                        margin-bottom: 10px;
                        opacity: 0.8;
                    }

                    .form-container .cancel {
                        background-color: red;
                    }
					#loader-overlay {
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background-color: rgba(255, 255, 255, 0.7); 
                        z-index: 9999; 
                        display: none; 
                    }

                    .loader {
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        border: 4px solid #f3f3f3; 
                        border-top: 4px solid #3498db; 
                        border-radius: 50%;
                        width: 30px; 
                        height: 30px; 
                        animation: spin 2s linear infinite; 
                    }


                    @keyframes spin {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                </style>
</div>  
<div id="loader-overlay">
    <div class="loader"></div>
</div>