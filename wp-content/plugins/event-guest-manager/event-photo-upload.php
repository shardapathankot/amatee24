<?php
/*
 * Template Name: Event Management Custom Front Page
 */
get_header();
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
    p#successmsg .success p {
        color: #FFF;
        font-size: 14px;
        margin-bottom: 0px;
    }
    p#successmsg .error{
        padding: 10px;
        background: red;
        width: 93%;
        margin: 10px 15px auto;
        color: #FFF;
    }
    p#successmsg .error p {
        color: #FFF;
        font-size: 14px;
        margin-bottom: 0px;
    }
    }
    p#successmsg .success p, p#successmsg .error p {
        color: #FFF;
        font-size: 14px;
    }
    .upload_lbl {
    border: 3px dashed #dedede;
    padding: 20px 20px;
    width: 100%;
    border-radius: 5px;
    cursor:pointer;
}


.upload_lbl img {
    height: 70px;
}
.upload_lbl span {
    display: flex;
    background-color: black;
    color: #fff;
    width: 156px;
    margin: 20px auto 0px;
    justify-content: center;
    padding: 15px 0;
    border-radius: 5px;
}
.upload_lbl #file-name {
    color: green;
    font-size: 15px;
    margin: 15px 0 0;
    display: block;
}

@media screen and (max-width:580px) {
    .amaka {
    display: block;
    line-height: 135%;
}
.tita {
    display: block;
    line-height: 135%;
}
}
    
</style>
<div topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0" marginwidth="0" marginheight="0" width="100%" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;
    background-color: #000000;
    color: #000000; padding-top: 0rem;" bgcolor="#000000" text="#000000">
    <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0"
        style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%;" class="background">
        <tr>
            <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;    border: none;"
                bgcolor="#000000">

                <table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF" width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
                max-width: 630px;" class="container">
                    <tr style="display:none;">
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
                        <td style="border-spacing: 0;
    max-width: 100%;
    margin: 0px auto 0px;
    width: 50%;
    background-color: #000;
    padding: 30px;
    border: none;
    caption-side: unset;
    border-collapse: unset;">
                            <table style="    width: 95%;
                            margin: 1rem auto 1rem;
                            border: 0px solid #939393;
                            padding: 25px 0px;    background-color: #FFFF;">
                                <tr>
                                    <td style="    text-align: center;    border: 0px solid #ebebf1;    padding: 30px;">
                                    <div class="form_rsvp">                        
                                            
                                            <div class="row">
                                            <form id="event-upload-form" action="" method="post" class="form-container event-upload-form" enctype="multipart/form-data">
                                                <h1 style="margin-top:0px;">Upload Image OR Video</h1>
                                                <p id="successmsg"></p>
                                                
                                                <div class="hideform">
                                                    <p>Please fill out the form below to upload image or video</p>        
                                                    <input type="hidden" name="event_id" value="<?php echo $eventId ??''; ?>">                        
                                                    <input type="email" name="guest_email" placeholder="Guest Email" class="widefat" required>
                                                    <input style="display:none;" id="upload" type="file" name="guest_media" class="widefat" required onchange="updateFileName(this)" />
                                                    <label for="upload" class="upload_lbl">
                                                        <img src="https://amatee24.com/wp-content/uploads/2024/04/cloud-computing.png">
                                                        <span>UPLOAD FILES</span>
                                                        <small id="file-name"></small>
                                                    </label>
                                                    <br /> 
                                                    <br />
                                                    <input style="" type="submit" class="btn" name="submit_media" value="SUBMIT" />
                                                </div>                                         
                                                </form>

                                        </div>                        
                                        </div>
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
                        width: 100%;
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
                        text-decoration: none;
                        color: #002642;
                        background-color: #cde0ef;
                        padding: 10px 50px;
                        display: inline-block;
                        border-radius: 0px;
                        font-size: 22px;
                        border: none;
                        cursor: pointer;
                        width: 100%;
                        margin-bottom: 10px;
                        opacity: 0.8;
                    }
                    .form-container .btn:hover {
                        background-color: #000000;
                        color: #fff;
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
<script>
function updateFileName(input) {
    var fileName = input.files[0].name;
    document.getElementById("file-name").innerText = fileName;
}
</script>
<?php
get_footer();