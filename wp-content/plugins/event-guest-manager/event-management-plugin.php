<?php
/*
Plugin Name: Event Management Plugin
Description: A plugin to manage event invitations, RSVPs, table assignments, and more.
Version: 1.0
Author: Your Name
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
ini_set('memory_limit', '768M'); // Adjust as necessary.
add_filter('http_request_args', function($request) {
    $request['timeout'] = 3600; // Increase timeout to 15 seconds
    return $request;
}, 100);



// Define plugin paths and URLs.
define( 'EMP_PATH', plugin_dir_path( __FILE__ ) );
define( 'EMP_URL', plugin_dir_url( __FILE__ ) );
define( 'EMP_BASE_DIR', plugin_dir_path(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'event-management-plugin.php'));
define( 'EMP_DS', DIRECTORY_SEPARATOR );
// Mail credentials 
$smtp_host = get_option('smtp_host') ? get_option('smtp_host') : 'smtpout.secureserver.net';
$smtp_port = get_option('smtp_port') ? get_option('smtp_port') : 465;
$smtp_username = get_option('smtp_username') ? get_option('smtp_username') : 'info@amatee24.com';
$smtp_password = get_option('smtp_password') ? get_option('smtp_password') : "ourwedding24";
define( 'MAIL_MAILER', 'smtp');
define( 'MAIL_HOST', "$smtp_host");
define( 'MAIL_PORT', $smtp_port);
define( 'MAIL_USERNAME', "$smtp_username");
define( 'MAIL_PASSWORD', "$smtp_password");
define( 'MAIL_ENCRYPTION', "ssl");
define( 'MAIL_FROM_ADDRESS', "$smtp_username"); // "toolsque@gmail.com"
define( 'MAIL_FROM_NAME', "Event Management");
$paypal_key = get_option('paypal_key') ? get_option('paypal_key') : 'AVNJ2xHbto7ureFMkQg5uhKEY9lf177UDv2bqxU_7EyK03IKw4_IzTF5-2o-umpULFc0eKxYSQ76sT-m';
$paypal_secret = get_option('paypal_secret') ? get_option('paypal_secret') : "";
define( 'paypal_key', "$paypal_key");
define( 'paypal_secret', "$paypal_secret");

define( 'invitation_template', file_get_contents(plugin_dir_path( __FILE__ ) . DIRECTORY_SEPARATOR .'templates'. DIRECTORY_SEPARATOR .'email'. DIRECTORY_SEPARATOR . 'invitation-email.php'));
define( 'qr_template', file_get_contents(plugin_dir_path( __FILE__ ) . DIRECTORY_SEPARATOR .'templates'. DIRECTORY_SEPARATOR .'email'. DIRECTORY_SEPARATOR . 'invitation-qr.php'));

require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;



require_once EMP_PATH . 'includes/admin-pages.php';
// Include other necessary files.
require_once EMP_PATH . 'includes/custom-post-types.php';
require_once EMP_PATH . 'includes/admin-pages.php';
// ... Include other necessary files here ...

function event_plugin_admin_scripts() {
    wp_enqueue_script('jquery');
}

add_action('admin_enqueue_scripts', 'event_plugin_admin_scripts');
add_action('wp_ajax_event_import_action', 'event_handle_file_import');

add_action( 'wp_ajax_resend_email', 'event_ajax_resend_email' );
add_action( 'wp_ajax_nopriv_resend_email', 'event_ajax_resend_email' ); // For non-logged in users
function event_ajax_resend_email() {
    
    // Check for nonce for security
    check_ajax_referer( 'email_send_nonce', 'security' );    
    $guest_id =  $_POST['guest_id'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = '';
    
    if ( empty( $guest_id ) || empty($subject) ) {
        wp_send_json_error( 'Invalid guest or subject' );
    }
    $retData = get_guest_data($guest_id);
    $accept_url = add_query_arg([
                        'response' => 'accept',
                        'token' =>  $retData['guest_meta']['user_token'] ?? '',
                    ], site_url('/response-handler'));
    $decline_url = add_query_arg([
                    'response' => 'decline',
                    'token' => $retData['guest_meta']['user_token'] ?? '',
                ], site_url('/response-handler'));
    $invitation_template = invitation_template;
    $date_format = 'F j, Y'; // Example: March 10, 2021
    $time_format = 'g:i a'; // Example: 3:30 pm
    $start_datetime = strtotime($retData['event_meta']['start_datetime']);
    $formatted_date = date_i18n($date_format, $start_datetime);
    $formatted_time = date_i18n($time_format, $start_datetime);
    $end_datetime = strtotime($retData['event_meta']['end_datetime']);
    $formatted_end_date = date_i18n($date_format, $end_datetime);
    $formatted_end_time = date_i18n($time_format, $end_datetime);
    $address = str_replace(',','<br />',$retData['event_meta']['venue_details']);            

    $userData = [
                    'name' => $retData['guest_meta']['guest_name'] ?? '',
                    'eventname'=> $retData['event_name'] ?? '',
                    'eventdate' => $formatted_date,
                    'start' => $formatted_time,
                    'end' => $formatted_end_date. ' '. $formatted_end_time,
                    'accept_url'=>$accept_url,
                    'decline_url'=>$decline_url,
                    'address'=>$address
                ];
    // Replace placeholders with actual data
    foreach ($userData as $key => $value) {
        $invitation_template = str_replace("{{{$key}}}", $value, $invitation_template);
    }        
   
    $email_to = $retData['guest_meta']['guest_email'] ?? '';
    if ( $email_to  && sendEmail( $email_to, strtoupper(str_replace('_',' ',$subject)), $invitation_template , '') ) {
        wp_send_json_success( 'Email sent successfully.' );
    } else {
        wp_send_json_error( 'Failed to send email.' );
    }

    wp_die(); // this is required to terminate immediately and return a proper response
} 


add_action( 'wp_ajax_resend_qr_email', 'event_ajax_resend_qr_email' );
add_action( 'wp_ajax_nopriv_resend_qr_email', 'event_ajax_resend_qr_email' ); // For non-logged in users
function event_ajax_resend_qr_email() {    
    check_ajax_referer( 'email_send_nonce', 'security' );    
    $guest_id =  $_POST['guest_id'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = '';
    
    if ( empty( $guest_id ) || empty($subject) ) {
        wp_send_json_error( 'Invalid guest or subject' );
    }
    $retData = get_guest_data($guest_id);
    $qr_template = qr_template;
    $userData = [
                    'name' => $retData['guest_meta']['guest_name'] ?? '',
                    'eventname'=> $retData['event_name'] ?? '',
                    'eventdate' => date('Y-m-d',strtotime($retData['guest_meta']['start_datetime']??'')),
                    'start' => date('H:i A',strtotime($retData['guest_meta']['start_datetime']??'')),
                    'end' => date('H:i A',strtotime($retData['guest_meta']['end_datetime']??'')),
                    'qr_image' => esc_url(site_url('wp-content/uploads/') . $retData['guest_meta']['qr_code_url']),
                    'qr_url' => esc_url(site_url('wp-content/uploads/') . $retData['guest_meta']['qr_code_url']),
                    
                ];
    foreach ($userData as $key => $value) {
        $qr_template = str_replace("{{{$key}}}", $value, $qr_template);
    }        
   
    $email_to = $retData['guest_meta']['guest_email'] ?? '';
    if ( $email_to  && sendEmail( $email_to, strtoupper(str_replace('_',' ',$subject)), $qr_template , '') ) {
        wp_send_json_success( 'Email sent successfully.' );
    } else {
        wp_send_json_error( 'Failed to send email.' );
    }

    wp_die(); 
} 

add_action('wp_ajax_save_smtp_settings', 'event_save_smtp_settings');
function event_save_smtp_settings() {
    // Check nonce for security
    check_ajax_referer('save-smtp-settings-nonce', 'security');
    // Sanitize and update options
    update_option('smtp_host', sanitize_text_field($_POST['smtp_host']));
    update_option('smtp_port', intval($_POST['smtp_port']));
    update_option('smtp_username', sanitize_text_field($_POST['smtp_username']));
    update_option('smtp_password', sanitize_text_field($_POST['smtp_password']));

    wp_send_json_success('SMTP settings saved successfully');
    wp_die();
}


/*Get Guest detailed data */
function get_guest_data($guestID){
    $data = [];
    $data = [];
    $all_meta_for_guest = get_post_meta($guestID);
    $guestMeta = []; 
    $eventId   =  get_post_meta($guestID, 'associated_event', true); //
    foreach ($all_meta_for_guest as $key => $value) {
        $guestMeta[$key] = esc_html(implode(", ", $value));
    }
   
    wp_reset_postdata();
    $data['guest_meta'] = $guestMeta;    
    $eventName = get_the_title($eventId);
    $data['event_name'] = $eventName;
    
    $all_meta_for_event = get_post_meta($eventId);
    $eventMeta = []; 
    foreach ($all_meta_for_event as $key => $value) {
        $eventMeta[$key] = esc_html(implode(", ", $value));
    }
    $data['event_meta'] = $eventMeta;
    return $data;
}


$to = '';
$from = '';
$messageBody = '';
$attachment = '';
function emp_activate() {
    // Trigger our function that registers the custom post type.
    event_management_create_post_type();
    event_management_register_guests_cpt();
    sendEmail($to='',$fro='',$messageBody='',$attachment='');
    generate_and_save_qr_code('','');
    generate_url_qr_code();
    // Clear the permalinks after the post type has been registered.
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'emp_activate' );

// Deactivation hook.
function emp_deactivate() {
    // Clear the permalinks to remove our post type's rules.
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'emp_deactivate' );

function event_plugin_template_include($template) {
    if (is_page('invitation')) {
        $custom_template = plugin_dir_path(__FILE__) . 'event-custom-front-page.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }elseif(is_page('event-photo-video-upload')){
        $custom_template = plugin_dir_path(__FILE__) . 'event-photo-upload.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }
    /*elseif (is_page('scan-qr-code')) {
        // Check if the current user has the 'manage_options' capability (Admin)
        if (current_user_can('manage_options')) {
            $custom_template = plugin_dir_path(__FILE__) . 'scan-qr-code.php';
            if (file_exists($custom_template)) {
                return $custom_template;
            }
        } else {
            // Optional: Redirect to home or another page if the user does not have admin permissions
            wp_redirect(home_url());
            exit;
        }
    }*/
    
    return $template;
}
add_filter('template_include', 'event_plugin_template_include', 99);

function event_plugin_activate() {
    $page_slug = 'invitation';
    $page = get_page_by_path($page_slug);

    if (!$page) {
        wp_insert_post([
            'post_title'     => 'Event Wedding Page',
            'post_name'      => $page_slug,
            'post_status'    => 'publish',
            'post_type'      => 'page',
        ]);
    }

    $page_slug1 = 'event-photo-video-upload';
    $page1 = get_page_by_path($page_slug1);

    if (!$page1) {
        wp_insert_post([
            'post_title'     => 'Event Photo/Video Upload Page',
            'post_name'      => $page_slug1,
            'post_status'    => 'publish',
            'post_type'      => 'page',
        ]);
    }

    // $page_slug2 = 'scan-qr-code';
    // $page2 = get_page_by_path($page_slug2);

    // if (!$page2) {
    //     wp_insert_post([
    //         'post_title'     => 'Event QR Scan Page',
    //         'post_name'      => $page_slug2,
    //         'post_status'    => 'publish',
    //         'post_type'      => 'page',
    //     ]);
    // }

    wp_reset_postdata(); // Reset the global $post object
}
register_activation_hook(__FILE__, 'event_plugin_activate');

function event_plugin_deactivate() {
    $page_slug = 'invitation';
    $page = get_page_by_path($page_slug);

    if ($page) {
        // Page exists, delete it
        wp_delete_post($page->ID, true); // Set to true to bypass trash and permanently delete
    }

    $page_slug1 = 'scan-qr-code';
    $page1 = get_page_by_path($page_slug1);

    if ($page1) {
        // Page exists, delete it
        wp_delete_post($page1->ID, true); // Set to true to bypass trash and permanently delete
    }

    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'event_plugin_deactivate');



// add_filter('all_plugins', 'hide_event_plugin');
// function hide_event_plugin($plugins) { 
//     if(is_plugin_active('event-guest-manager/event-management-plugin.php')) {
//         unset($plugins['event-guest-manager/event-management-plugin.php']);
//     }
//     return $plugins;
// }


/**
 * Sends email with attachment
 * @param $to
 * @param $subject
 * @param $message
 * @param $emailAttachment
 */
function sendEmail($to, $subject, $message, $emailAttachment) {
    // return true;
    
    try {  
		$headers = array(
						'Content-Type: text/html; charset=UTF-8',
						'From: '.MAIL_FROM_NAME.' <'.MAIL_FROM_ADDRESS.'>' // Replace with your email and name
					);
		
		if($emailAttachment){
			if (wp_mail($to, $subject, $message, $headers, $emailAttachment)) {
				$_SESSION['success_message'] = "Email Message has been sent successfully";
				return true;
				
			} else {
				$_SESSION['error_message'] =  "Message could not be sent.";
				return false;
			}
        }else{
			if (wp_mail($to, $subject, $message, $headers)) {
				$_SESSION['success_message'] = "Email Message has been sent successfully";
				return true;
			} else {
				$_SESSION['error_message'] =  "Message could not be sent.";
				return false;
			}
		}
		
		/* SMTP CODE PHP Mailer
        $mail = new PHPMailer(true);
        // $mail->SMTPDebug = SMTP::DEBUG_CONNECTION;
        // $mail->isSMTP();
        // $mail->Host = MAIL_HOST; //'smtp.gmail.com';
        // $mail->SMTPAuth = true;
        // $mail->Username = MAIL_USERNAME; //'yourEmail@gmail.com';
        // $mail->Password = MAIL_PASSWORD; //'xxxxxxxxxxxYourPassword'; // <-- which we generated from step2
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        // $mail->Port = MAIL_PORT; //465;
		//         $mail->isSMTP();
		//        $mail->Host = 'smtp.gmail.com';
		//        $mail->SMTPAuth = true;
		//        $mail->Username = 'toolsque@gmail.com';
		//        $mail->Password = 'yrxt oaqo oehu vstb';
		//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		//         $mail->SMTPSecure = 'tls';
		//        $mail->Port = 587;
       
       $mail->isSMTP();
       $mail->Host = MAIL_HOST;
       $mail->SMTPAuth = true;
        $mail->Username = MAIL_USERNAME; 
       $mail->Password = MAIL_PASSWORD;
       $mail->SMTPSecure = 'SSL'; // tls
       $mail->Port = MAIL_PORT;	

        $mail->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME); // 'yourEmail@gmail.com' 'Coding Birds' <-- 2nd param is optional
        $mail->addAddress($to); //<-- 2nd param is optional
       
    
    
        $mail->isHTML(true); //<-- make it true if sending HTML content as message
        $mail->Subject = $subject;
        if($emailAttachment){
            $mail->addAttachment($emailAttachment); // Add attachment
        }

        $mail->Body = $message;
        if($mail->send()){
            $_SESSION['success_message'] = "Email Message has been sent successfully";
            return true;
        } */        
        
    }catch (Exception $e){
        $_SESSION['error_message'] =  "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}


function handle_decision_response() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_GET['response']) && isset($_GET['token'])) {
        global $wpdb;
        // $table_name = $wpdb->prefix . 'response_records';
        $_SESSION['link_message'] = '';
        $token = sanitize_text_field($_GET['token']);
        $response = sanitize_text_field($_GET['response']);

        if (in_array($response, ['accept', 'decline'])) {
            $args = array(
                'post_type'  => 'event_guests', // Set to your specific post type, e.g., 'post', 'page', or any custom post type.
                'posts_per_page' => -1, // Get all posts that match the criteria. Consider limiting this for performance.
                'meta_query' => array(
                    array(
                        'key'   => 'user_token',
                        'value' => $token,
                        'compare' => '='
                    )
                )
            );
            
            $posts = get_posts($args);
            
            if (!empty($posts)) {
                foreach ($posts as $post) {
                    // Access the post ID like this
                    $guest_id = $post->ID;           
                    $meta_rsvp_status = get_post_meta($guest_id, 'rsvp_status', true);
                    if(in_array($meta_rsvp_status, ['confirmed', 'declined'])){
                        $_SESSION['link_message'] = ['decline'=>'This link is expired!'];
                        wp_redirect(site_url('invitation'));
                        exit;
                    }else{
                        update_post_meta($guest_id, 'user_action', $response);      
                        if($response=='accept'){
                            update_post_meta($guest_id, 'rsvp_status', 'confirmed');
                            $meta_qr_code_url = get_post_meta($guest_id, 'qr_code_url', true);
                            $meta_guest_email = get_post_meta($guest_id, 'guest_email', true);
                            $meta_associated_event = get_post_meta($guest_id, 'associated_event', true);
                            $eventName = get_the_title($meta_associated_event);     

                            $retData = get_guest_data($guest_id);
                            $qr_template = qr_template;
                            $userData = [
                                            'name' => $retData['guest_meta']['guest_name'] ?? '',
                                            'eventname'=> $retData['event_name'] ?? '',
                                            'eventdate' => date('Y-m-d',strtotime($retData['guest_meta']['start_datetime']??'')),
                                            'start' => date('H:i A',strtotime($retData['guest_meta']['start_datetime']??'')),
                                            'end' => date('H:i A',strtotime($retData['guest_meta']['end_datetime']??'')),
                                            'qr_image' => esc_url(site_url('wp-content/uploads/') . $retData['guest_meta']['qr_code_url']),
                                            'qr_url' => esc_url(site_url('wp-content/uploads/') . $retData['guest_meta']['qr_code_url']),
                                            
                                        ];
                            foreach ($userData as $key => $value) {
                                $qr_template = str_replace("{{{$key}}}", $value, $qr_template);
                            }        
                        
                            $email_to = $retData['guest_meta']['guest_email'] ?? '';
                            $upload_dir = wp_upload_dir(); // Get upload directory
                            $attachment = $upload_dir['basedir'] . '/'.$meta_qr_code_url; 

                            sendEmail( $meta_guest_email, 'Accepted Invitation Email', $qr_template , $attachment);
                        }
                        if($response=='decline'){
                            $_SESSION['link_message'] = ['decline'=>'The event invitation is declined!'];
                            wp_redirect(site_url('invitation'));
                            update_post_meta($guest_id, 'rsvp_status', 'declined');
                        }

                        $_SESSION['link_message'] = ['accept'=>'Thank you for accepting the event invitation! <br /> A QR email is sent to attend the event.'];
                        wp_redirect(site_url('invitation'));
                        exit;
                    }
                }
            } else {
                echo 'No posts found for given meta value.';
                wp_redirect(home_url());
                exit;
            }
        }
    }
}
add_action('template_redirect', 'handle_decision_response');

function event_plugin_enqueue_scripts() {
    wp_enqueue_script('event-plugin-ajax-script', plugin_dir_url(__FILE__) . 'js/event-front-ajax-script.js', array('jquery'), null, true);
    wp_localize_script('event-plugin-ajax-script', 'event_plugin_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('event_plugin_ajax_nonce'),
    ));

    wp_enqueue_script('event-ajax-upload', plugin_dir_url(__FILE__) . 'js/ajax-upload.js', array('jquery'), null, true);
    wp_localize_script('event-ajax-upload', 'event_ajax_obj', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('event-upload-nonce')
    ));
    

    wp_enqueue_script('event-ajax-update-guest', plugin_dir_url(__FILE__) . 'js/ajax-update-guest.js', array('jquery'), null, true);
    wp_localize_script('event-ajax-update-guest', 'event_guest_update_obj', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('event-guest-update-nonce')
    ));
	wp_enqueue_script('paypal_sdk', "https://www.paypal.com/sdk/js?client-id=" . paypal_key, array(), null, true); 
	add_thickbox();
}
add_action('wp_enqueue_scripts', 'event_plugin_enqueue_scripts');

add_action('wp_ajax_add_guest_ajax', 'eventplugin_handle_add_guest_ajax');
add_action('wp_ajax_nopriv_add_guest_ajax', 'eventplugin_handle_add_guest_ajax'); // Uncomment if needed

function eventplugin_handle_add_guest_ajax() {
    check_ajax_referer('event_plugin_ajax_nonce', 'nonce');
    if (isset($_POST['data'])) {
        parse_str($_POST['data'], $formData);        
        $event_id = sanitize_text_field($formData['event_id']);
        $guest_name = sanitize_text_field($formData['guest_name']);
        $guest_contact = sanitize_text_field($formData['guest_contact']);
        $guest_email = sanitize_email($formData['guest_email']);
        $rsvp_status = 'confirmed';
        $attendance_status = 'not_attended';
        $QrDataSTr = '';
        $new_guest = array(
                        'post_title'    => wp_strip_all_tags($guest_name),
                        'post_content'  => '', // You can include a description or content here if you want
                        'post_status'   => 'publish',
                        'post_type'     => 'event_guests'
                    );
        $guest_id = wp_insert_post($new_guest);        
        if (!is_wp_error($guest_id) && $guest_id != 0) {
            update_post_meta($guest_id, 'guest_name', $guest_name);
            update_post_meta($guest_id, 'guest_contact', $guest_contact);
            update_post_meta($guest_id, 'guest_email', $guest_email);
            update_post_meta($guest_id, 'rsvp_status', $rsvp_status);
            update_post_meta($guest_id, 'attendance_status', $attendance_status);
            update_post_meta($guest_id, 'associated_event', $event_id);
            update_post_meta($guest_id, 'user_action', 'accept');
            update_post_meta($guest_id, 'user_token', wp_generate_uuid4());

            $eventName = get_the_title($event_id);      
			//             $QrDataSTr .= 'Event Name : '.$eventName ?? ''.'\n';
			//             $QrDataSTr .= 'Guest Name : '.$guest_name ?? ''.'\n';
			//             $QrDataSTr .= 'Guest Contact : '.$guest_contact ?? ''.'\n';
			//             $QrDataSTr .= 'Guest Email : '.$guest_email ?? ''.'\n';
			//             $QrDataSTr .= 'Attendance : '.$attendance_status ?? ''.'\n';
			//             $eventName = get_the_title($event_id);      
            $QrDataSTr .= 'event_name:'.$eventName ?? '';
            $QrDataSTr .= '&guestname:'.$guest_name ?? '';
            $QrDataSTr .= '&guest_contact:'.$guest_contact ?? '';
            $QrDataSTr .= '&guest_email:'.$guest_email ?? '';
            $QrDataSTr .= '&table_number:0';
            $QrDataSTr .= '&associated_guests:0';
            $QrDataSTr .= '&attendance:not_attended';
            generate_and_save_qr_code($QrDataSTr,$guest_id);
            generate_and_save_qr_code($QrDataSTr,$guest_id);
            $retData = get_guest_data($guest_id);
            $qr_template = qr_template;
            $userData = [
                            'name' => $retData['guest_meta']['guest_name'] ?? '',
                            'eventname'=> $retData['event_name'] ?? '',
                            'eventdate' => date('Y-m-d',strtotime($retData['guest_meta']['start_datetime']??'')),
                            'start' => date('H:i A',strtotime($retData['guest_meta']['start_datetime']??'')),
                            'end' => date('H:i A',strtotime($retData['guest_meta']['end_datetime']??'')),
                            'qr_image' => esc_url(site_url('wp-content/uploads/') . $retData['guest_meta']['qr_code_url']),
                            'qr_url' => esc_url(site_url('wp-content/uploads/') . $retData['guest_meta']['qr_code_url']),
                            
                        ];
            foreach ($userData as $key => $value) {
                $qr_template = str_replace("{{{$key}}}", $value, $qr_template);
            }        
            $qr_url = $userData['qr_url']??'';

            $response_data = array(
                                'message' => 'RSVP QR email sent successfully.',
                                'qr_url'  => $qr_url,
								'event_paypal_button' => '<a href="https://amatee24.com/registry/" class="register-button">Registry Here</a>'
                            );

            $upload_dir = wp_upload_dir(); // Get upload directory
            $attachment = $upload_dir['basedir'] . '/'.$retData['guest_meta']['qr_code_url'];
            if ( $guest_email  && sendEmail( $guest_email, "Event RSVP QR", $qr_template , $attachment) ) {
                wp_send_json_success( $response_data );
                wp_die();
            } else {
                wp_send_json_error( 'RSVP QR email failed to sent.' );
                wp_die();
            }
        } else {
            wp_send_json_error( 'There was an error adding the guest as RSVP.' );
            wp_die();
        }
    }

    wp_die(); // This is required to terminate immediately and return a proper response
}


function event_handle_upload() {
    check_ajax_referer('event-upload-nonce', 'nonce');
    
    if (!function_exists('wp_handle_upload')) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
    }

    $user_email = isset($_POST['guest_email']) ? sanitize_email($_POST['guest_email']) : '';
    
    if (empty($user_email) || empty($_FILES['guest_media']['tmp_name'])) {
        wp_send_json_error('Missing data of email or file.');
    }

    $email_folder = sanitize_title($user_email);
    
    $event_id = $_POST['event_id'] ?? ''; // Replace 123 with your actual post ID
    if($event_id){
        
        $associated_event = get_meta_values_for_posts($event_id, $user_email,'confirmed');
        if (isset($associated_event) && !empty($associated_event)) {
            $uploadedfile = $_FILES['guest_media'];
   
            $file_type = $uploadedfile['type'];
            $file_size = $uploadedfile['size'];
            $max_size = 30000000; // 30 MB in bytes
            $allowed_types = array('image/jpeg','image/jpg', 'image/png', 'video/mp4');

            if (!in_array($file_type, $allowed_types) || $file_size > $max_size) {
                wp_send_json_error('Failed to upload file. Please choose only jpg, jpeg, png, mp4 with max size 5MB file');
                wp_die();
            }else{
                
                $upload_dir = wp_upload_dir();
                $user_dirname = $upload_dir['basedir'] . '/event_uploads/'; 

                if (!file_exists($user_dirname)) {
                    wp_mkdir_p($user_dirname);
                }
                $filename = wp_unique_filename($user_dirname, $uploadedfile['name']);
                $filepath = $user_dirname . '/' . $filename;
                $uploads_base_url = site_url('/wp-content/uploads/event_uploads/'. $filename);

                if (move_uploaded_file($uploadedfile['tmp_name'], $filepath)) {
                        $args = [
                                'post_title' => $user_email,
                                'post_content' => basename($uploadedfile['name']),
                                'post_status' => 'pending', 
                                'post_type' => 'event_media_gallery', 
                            ];
                        $post_id = wp_insert_post($args);
                        add_post_meta($post_id, 'event_media_gallery_url', $uploads_base_url);
                    wp_send_json_success('File uploaded successfully.');
                    wp_die();
                } else {            
                    wp_send_json_error('Failed to move uploaded file.');
                    wp_die();
                }
            }
        } else {
            wp_send_json_error('Guest email or event is not confirmed, please try again later!');
            wp_die();
        }
    }else{
        wp_send_json_error('Invalid event. Please try again later!');
        wp_die();
    }
    wp_die();
}
add_action('wp_ajax_event_handle_upload', 'event_handle_upload');
add_action('wp_ajax_nopriv_event_handle_upload', 'event_handle_upload');

function get_posts_by_meta_value($associated_event, $guest_email_value,$rsvp_status_value) {
    $args = array(
        'post_type' => 'event_guests',
        'post_status' => 'publish',
        'posts_per_page' => -1, // Retrieve all posts
        'meta_query' => array(
            'relation' => 'AND', // Use AND relation to make sure all conditions must be met
            array(
                'key' => 'associated_event',
                'value' => $associated_event, // Assuming $meta_value holds the value for 'associated_event'
                'compare' => '='
            ),
            array(
                'key' => 'guest_email',
                'value' => $guest_email_value,
                'compare' => '='
            ),
            array(
                'key' => 'rsvp_status',
                'value' => $rsvp_status_value,
                'compare' => '='
            )
        )
    );

    $query = new WP_Query($args);
    $posts = $query->posts;

    $post_ids = wp_list_pluck($posts, 'ID');

    return $post_ids;
}

function get_meta_values_for_posts($associated_event, $guest_email_value,$rsvp_status_value) {
    $post_ids = get_posts_by_meta_value($associated_event, $guest_email_value,$rsvp_status_value);
    $meta_values = array();

    foreach ($post_ids as $post_id) {
        $post_meta = get_post_meta($post_id);
        array_push($meta_values, $post_meta);
    }

    return $meta_values;
}

add_action('wp_ajax_handle_qr_update', 'your_function_to_handle_request');
add_action('wp_ajax_nopriv_handle_qr_update', 'your_function_to_handle_request');

function your_function_to_handle_request() {
    check_ajax_referer('event-guest-update-nonce', 'nonce');
    $event_name = isset($_POST['event_name']) && !empty($_POST['event_name']) ? urldecode($_POST['event_name']) : '';
    if($event_name){
        $slug = str_replace(' ','-',strtolower($event_name)); // The slug of the post
        $event = get_page_by_path($slug, OBJECT, 'event'); // Change 'post' to your custom post type if necessary
        if ($event) {
            $event_id = $event->ID;
            $guest_email = $_POST['guest_email'] ?? '';
            if($guest_email){                
                    $associated_event = get_meta_values_for_posts($event_id, $guest_email,'confirmed');
                    if (isset($associated_event) && !empty($associated_event)) {
                        $post_ids = get_posts_by_meta_value($event_id, $guest_email,'confirmed');
                        foreach ($post_ids as $guest_id) {
                            update_post_meta($guest_id, 'attendance_status', 'attended');   
                        }

                        wp_send_json_success('Guest record updated successfully.');
                    }else{
                        wp_send_json_error('Guest have not confirmed the event, please try again later!');
                    }          
            }else{
                wp_send_json_error('Guest email not found, please try again later!');
            }
        } else {
            wp_send_json_error('Event is not found, please try again later!');
        }
    }
    wp_die();
}

function event_scan_qr_shortcode() {
    ob_start();
    include_event_scan_qr_template();
    return ob_get_clean();
}
add_shortcode('event_scan_qr', 'event_scan_qr_shortcode');

// function include_event_scan_qr_template() {
// //     if (current_user_can('manage_options')) {

//         include(plugin_dir_path(__FILE__) . 'includes/event-scan-qr-template.php');

//         include(plugin_dir_path(__FILE__) . 'includes/event-list-guests-template.php');
// //     }else{
// //         echo '<div class="event-template-part"><p> Unauthorize Access </p></div>';
// //     }    
// }

function include_event_scan_qr_template() {
    // Check if the current user can manage options or has the 'Gateway' role
    if (current_user_can('manage_options') || current_user_can('gateman')) {

        include(plugin_dir_path(__FILE__) . 'includes/event-scan-qr-template.php');

        include(plugin_dir_path(__FILE__) . 'includes/event-list-guests-template.php');
    } else {
        echo '<div class="event-template-part"><p> Unauthorized Access </p></div>';
    }
}


// Shortcode to render PayPal button
function event_paypal_button_shortcode() {
// 	<script src="https://www.paypal.com/sdk/js?client-id='.paypal_key.'"></script>
        $html = '<form id="paymentForm">
                    <label for="amount">Amount:</label>
                    <input type="text" id="amount" name="amount" required>
                    <div id="paypal-button-container"></div> <!-- Added a container for PayPal buttons -->
                </form>
            
            <script>
                jQuery(function($){
                    paypal.Buttons({
                        createOrder: function(data, actions) {
                            var amountInput = document.getElementById("amount");
                            var amount = parseFloat(amountInput.value);
                            if (isNaN(amount) || amount <= 0) {
                                console.error("Invalid amount entered.");
                                alert("Please enter a valid amount.");
                                // throw new Error("Invalid amount entered.");
                            }else{
                                 return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        value: amount.toString() // Ensure the amount is in a proper format
                                    },
                                    application_context: {
                                        shipping_preference: "NO_SHIPPING" // Indicate that shipping is not required
                                    }
                                }]
                            });
                            }
                        },
                        onApprove: function(data, actions) {
                            return actions.order.capture().then(function(details) {
                                alert("Transaction completed by " + details.payer.name.given_name);
                            });
                        },
                        onError: function(err) {
                            console.log(err);
                            alert("Payment could not be processed.");
                        },
                        onInit(data, actions)  {
                            actions.disable();
                            document.querySelector("#amount")
                              .addEventListener("keyup", function(event) {                      
                                if (event.target.value > 0)  {
                                  actions.enable();
                                } else  {
                                  actions.disable();
                                }
                            });
                            var amountInput = document.getElementById("amount");
                            var amount = parseFloat(amountInput.value);
                            if (isNaN(amount) || amount <= 0) {
                                actions.disable();
                            }else{
                                actions.enable();
                            }                            
                          },
                          onClick()  {
                            var amountInput = document.getElementById("amount");
                            var amount = parseFloat(amountInput.value);
                            if (isNaN(amount) || amount <= 0) {
                                alert("Please enter a valid amount.");
                                amountInput.value = 0;
                            }else{
                                amountInput.value = parseFloat(document.getElementById("amount").value);
                            }
                          }
                      
                    }).render("#paypal-button-container");
                })            
            </script>';
    return $html;
}
add_shortcode('event_paypal_button', 'event_paypal_button_shortcode');
// Handle the redirect to PayPal

add_action('wp_ajax_save_paypal_settings', 'event_save_paypal_settings');
function event_save_paypal_settings() {
    // Check nonce for security
    check_ajax_referer('save-paypal-settings-nonce', 'security');
    // Sanitize and update options
    update_option('paypal_key', sanitize_text_field($_POST['paypal_key']));
    update_option('paypal_secret', sanitize_text_field($_POST['paypal_secret']));
    wp_send_json_success('Paypal settings saved successfully');
    wp_die();
}


add_action('wp_ajax_nopriv_event_attended_users_list', 'event_users_ajax_handler');
add_action('wp_ajax_event_attended_users_list', 'event_users_ajax_handler');
function event_users_ajax_handler() {    
    $event_id = isset($_POST['event_id']) ? intval($_POST['event_id']) : 0;
    $search_query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';
    $paged = isset($_POST['page']) ? max(1, intval($_POST['page'])) : 1;
    require_once EMP_PATH . 'includes/guest-lists-class.php';
     if (!empty($search_query)) {
        $search_term = esc_attr($search_query) ;
        $_REQUEST['s'] = $search_term;
     }else{
        $search_term = '';
        $_REQUEST['s'] = $search_term;
     }
    $guestListTable = new Guest_List_Table(); 
    $guestListTable->prepare_items(10,$paged,$search_term);
    $guestListTable->display();
    wp_die(); // This is required to terminate immediately and return a proper response
}

function event_upload_shortcode() {
    ob_start();
    include_event_upload_media_template();
    return ob_get_clean();
}
function include_event_upload_media_template() {
    include(plugin_dir_path(__FILE__) . 'includes/upload-media.php');
}

add_shortcode('event_upload_media', 'event_upload_shortcode');
function handle_media_approval() {
    check_ajax_referer('media_approval_nonce', 'security');

    if (!current_user_can('edit_posts')) { // Adjust capability as needed
        wp_send_json_error('Unauthorized action.');
    }

    $media_id = isset($_POST['media_id']) ? intval($_POST['media_id']) : 0;
    $action = isset($_POST['media_action']) ? $_POST['media_action'] : '';

    if ('approve' === $action) {
        $update_args = array(
                            'ID'           => $media_id,
                            'post_status'  => 'publish'
                        );
        $updated_post_id = wp_update_post($update_args, true);  
        if (is_wp_error($updated_post_id)) {
            $error_message = $updated_post_id->get_error_message();
            wp_send_json_error("Something went wrong: $error_message");
            
        } else {
            wp_send_json_success("Media updated successfully!");
        }

    } elseif ('disapprove' === $action) {
        $update_args    =   array(
                                'ID'           => $media_id,
                                'post_status'  => 'pending'
                            );
        $updated_post_id = wp_update_post($update_args, true);  
        if (is_wp_error($updated_post_id)) {
            $error_message = $updated_post_id->get_error_message();
            wp_send_json_error("Something went wrong: $error_message");
        } else {
            wp_send_json_success("Media updated successfully!");
        }
    } else {
        wp_send_json_error('Invalid action. Please try again later!');
    }

    // Assuming the action was successful
    // wp_send_json_success('Action successful.');
    wp_die();
}
add_action('wp_ajax_handle_media_approval', 'handle_media_approval');

// Define the function to handle post deletion
function event_post_deletion_handler() {    
    if ( isset( $_GET['action'] ) && $_GET['action'] === 'delete' && isset( $_GET['media_id'] ) ) {
        $media_id = intval( $_GET['media_id'] );
        wp_delete_post( $media_id, true );
        $media_file = get_attached_file( $media_id );
        if ( !empty( $media_file ) && file_exists( $media_file ) ) {
            unlink( $media_file );
        }
    }
}
add_action( 'init', 'event_post_deletion_handler' );


function event_modal_markup() {
    echo '<div id="event-modal-content" style="display:none;">
                <div class="post-modal-content"></div>
            </div>
            <div id="loader-overlay">
                <div class="loader"></div>
            </div>';
}
add_action('admin_footer', 'event_modal_markup');
add_action('wp_footer', 'event_modal_markup');
function event_modal_script() {
    ?>
    <script>
    jQuery(document).ready(function($) {        
        function openMediaModal(media_id) {
            $('#loader-overlay').show();
            var post_content = $('#event-modal-content .post-modal-content');
                post_content.html('Loading...');                
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'load_media',
                    media_id: media_id
                },
                success: function(response) {
                    $('#loader-overlay').hide();
                    post_content.html(response);      
                    var contentWidth = $('#event-modal-content').outerWidth() + 200;
                    var contentHeight = $('#event-modal-content').outerHeight()  + 200;
                    tb_show('Media File', '#TB_inline?width=600&height=400&inlineId=event-modal-content');
                }
            });
        }

        $(document).on('click','.open-media', function(e) {
            e.preventDefault();            
            var media_id = $(this).data('media-id');
            openMediaModal(media_id);
        });
    });

    </script>
    <style>
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


        .post-modal-content {
            position: relative;
            width: 100%;
            height: 0;
            padding-top: 56.25%;
        }
        .post-modal-content video,.post-modal-content img {
            padding-top: 30px;
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            top: 0;
            left: 0;
        }
    </style>
    <?php
}
add_action('admin_footer', 'event_modal_script');
add_action('wp_footer', 'event_modal_script');

add_action('wp_ajax_load_media', 'event_load_media_callback');
add_action('wp_ajax_nopriv_load_media', 'event_load_media_callback');
function event_load_media_callback() {
    $media_id = intval($_POST['media_id']);
    $media_url = get_post_meta($media_id, 'event_media_gallery_url', true);
    $file_extension = pathinfo($media_url, PATHINFO_EXTENSION);
    if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
        $mediaFIle = '<div class=""><img src="' . $media_url . '" alt="Uploaded Image"></div>';
    } elseif (in_array($file_extension, ['mp4', 'mov', 'avi', 'wmv', 'mkv'])) {
        $mediaFIle = '<div class=""><video controls><source src="' . $media_url . '" type="video/mp4">Your browser does not support the video tag.</video></div>';
    } else {
        $mediaFIle = '<div class=""><p>Unsupported file type.</p></div>';
    }
    echo $mediaFIle;
    exit;
}

function event_gallery_shortcode($atts) {
    $atts = shortcode_atts(array(
        'per_page' => 12, 
    ), $atts, 'gallery');
    $per_page = intval($atts['per_page']);
    ob_start(); // Start output buffering
    ?>
    <div id="gallery-container"></div>
    <div id="pagination-container"></div>
    <script>
        var perPage = <?php echo $per_page; ?>;
    </script>
    <?php

    return ob_get_clean(); // Return the buffered content
}
add_shortcode('event_gallery', 'event_gallery_shortcode');

function load_gallery_content() {
    $page_number = isset($_POST['page_number']) ? intval($_POST['page_number']) : 1;
    $per_page = isset($_POST['per_page']) ? intval($_POST['per_page']) : 10;

    $args = array(
        'posts_per_page' => $per_page,
        'offset' => ($page_number - 1) * $per_page,
        'post_type' => 'event_media_gallery',
        'post_status' => array('publish'),
    );

    $query = new WP_Query($args);

    $gallery_items = array();
    $counter = 0; // Initialize counter
    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        $event_media_gallery_url = get_post_meta($post_id, 'event_media_gallery_url', true);
    
        $file_extension = pathinfo($event_media_gallery_url, PATHINFO_EXTENSION);
        if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
            $mediaFile = '<div class="media-item open-media" data-media-id="'.$post_id.'"><img src="' . esc_url($event_media_gallery_url) . '" alt="Image"></div>';
        } elseif (in_array($file_extension, ['mp4', 'mov', 'avi', 'wmv', 'mkv'])) {
            $mediaFile = '<div class="media-item open-media" data-media-id="'.$post_id.'"><video controls><source src="' . esc_url($event_media_gallery_url) . '" type="video/mp4">Your browser does not support the video tag.</video></div>';
        } else {
            continue;
        }
    
        echo $mediaFile;
    
        $counter++; 
    
        if ($counter % 3 == 0) {
            echo '<div class="clearfix"></div>'; // Add clearfix to clear floats
        }
    }

    wp_reset_postdata();

    die(); 
}
add_action('wp_ajax_load_gallery_content', 'load_gallery_content');
add_action('wp_ajax_nopriv_load_gallery_content', 'load_gallery_content');

function add_gallery_script_after_footer() {
    ?>
    <style>
        .media-item {
            float: left;
            width: calc(33.333% - 20px); 
            margin-right: 20px; 
            margin-bottom: 20px; 
            box-sizing: border-box; 
            cursor: pointer; 
            height: 250px; 
            overflow: hidden; 
        }

        .media-item:hover {
            cursor: pointer; 
        }

        .media-item img,
        .media-item video {
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
        }

        .clearfix {
            clear: both;
        }
    </style>
    <script>
    jQuery(document).ready(function($) {
		let perPage = 10;
        loadGalleryContent(1);
        function loadGalleryContent(pageNumber) {
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'load_gallery_content',
                    page_number: pageNumber,
                    per_page: perPage
                },
                success: function(response) {
                    $('#gallery-container').html(response);
                }
            });
        }

    });
    </script>
    <?php
}
add_action('wp_footer', 'add_gallery_script_after_footer');
