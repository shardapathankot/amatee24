<?php
require_once plugin_dir_path(__FILE__) . '../vendor'.DIRECTORY_SEPARATOR.'autoload.php';
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
global $plugin_dir;
$plugin_dir     = plugin_dir_path(dirname(__FILE__)).'templates'; 
$success_message = '';
$error_message = '';

// Hook for adding admin menus
add_action('admin_menu', 'event_management_menu');
// Action function for the above hook
function event_management_menu() {
    // Add a new top-level menu (ill-advised):
    add_menu_page('Event Management', 'Event Management', 'manage_options', 'event-management', 'event_management_main_page', 'dashicons-tickets-alt', 6);

    // Add a submenu to the custom top-level menu:
    add_submenu_page('event-management', 'Add Event', 'Add Event', 'manage_options', 'add-event', 'event_management_add_event');
    add_submenu_page('event-management', 'List Guests', 'List Guests', 'manage_options', 'list-guests', 'event_management_list_guests');
    add_submenu_page('event-management', 'Add a Guest', 'Add a Guest', 'manage_options', 'add-guest', 'event_management_add_guest');
    add_submenu_page('event-management', 'Import Guests', 'Import Guests', 'manage_options', 'import-guests', 'event_management_import_guests');
    add_submenu_page('event-management', 'Event Gallery', 'Event Gallery', 'manage_options', 'event-mngt-gallery', 'event_management_gallery');
    add_submenu_page('event-management', 'Settings', 'Settings', 'manage_options', 'event-mngt-settings', 'event_management_settings');
}

/* Add an event */
function event_management_add_event() {
    global $plugin_dir;
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'edit':
                $post_id = $_GET['event_id'];
                if (isset($_POST['submit_event'])) {                        
                    $post_data  = array(
                                        'ID'         => $post_id,
                                        'post_title' => wp_strip_all_tags($_POST['event_name']),
                                    );
                    wp_update_post($post_data);
                    if (!is_wp_error($post_id) && $post_id != 0) {
                        update_post_meta($post_id, 'organiser_name', $_POST['organiser_name']);
                        update_post_meta($post_id, 'organiser_email', $_POST['organiser_email']);
                        update_post_meta($post_id, 'contact_number', $_POST['contact_number']);
                        update_post_meta($post_id, 'venue_details', $_POST['venue_details']);
                        update_post_meta($post_id, 'start_datetime', $_POST['start_datetime']);
                        update_post_meta($post_id, 'end_datetime', $_POST['end_datetime']); 
                        update_post_meta($post_id, 'status', $_POST['status']);
                        update_post_meta($post_id, 'available_seats', $_POST['available_seats']);
            
                        $success_message = 'Event successfully updated.';
                    } else {
                        $error_message = 'There was an error updating the event.';
                    }
                }
                    
                $custom_fields = get_post_custom($post_id);
                $single_value = get_the_title($post_id);
                include_once($plugin_dir . '/events/edit-event.php');
                break;
            default:
                if (isset($_POST['submit_event'])) {
                    $new_event = array(
                            'post_title'    => wp_strip_all_tags($_POST['event_name']),
                            'post_content'  => '', // You can include a description or content here if you want
                            'post_status'   => 'publish',
                            'post_type'     => 'event'
                        );
                
                    // Insert the post into the database
                    $post_id = wp_insert_post($new_event);
                    if (!is_wp_error($post_id) && $post_id != 0) {
                        update_post_meta($post_id, 'organiser_name', $_POST['organiser_name']);
                        update_post_meta($post_id, 'organiser_email', $_POST['organiser_email']);
                        update_post_meta($post_id, 'contact_number', $_POST['contact_number']);
                        update_post_meta($post_id, 'venue_details', $_POST['venue_details']);
                        update_post_meta($post_id, 'start_datetime', $_POST['start_datetime']);
                        update_post_meta($post_id, 'end_datetime', $_POST['end_datetime']);
                        update_post_meta($post_id, 'status', $_POST['status']);
                        update_post_meta($post_id, 'available_seats', $_POST['available_seats']);
                        $success_message = 'Event successfully added.';
                    } else {
                        $error_message = 'There was an error adding the event.';
                    }
                }

                include_once($plugin_dir . '/events/add-event.php');
                break;
        }
    } else {
        if (isset($_POST['submit_event'])) {
            $new_event = array(
                    'post_title'    => wp_strip_all_tags($_POST['event_name']),
                    'post_content'  => '', // You can include a description or content here if you want
                    'post_status'   => 'publish',
                    'post_type'     => 'event'
                );        
            // Insert the post into the database
            $post_id = wp_insert_post($new_event);        
            // Check if the post was successfully created
            if (!is_wp_error($post_id) && $post_id != 0) {
                update_post_meta($post_id, 'organiser_name', $_POST['organiser_name']);
                update_post_meta($post_id, 'organiser_email', $_POST['organiser_email']);
                update_post_meta($post_id, 'contact_number', $_POST['contact_number']);
                update_post_meta($post_id, 'venue_details', $_POST['venue_details']);
                update_post_meta($post_id, 'start_datetime', $_POST['start_datetime']);
                update_post_meta($post_id, 'end_datetime', $_POST['end_datetime']);
                update_post_meta($post_id, 'status', $_POST['status']);
                update_post_meta($post_id, 'available_seats', $_POST['available_seats']);
                $success_message = 'Event successfully added.';
            } else {
                $error_message = 'There was an error adding the event.';
            }
        }

        include_once($plugin_dir . '/events/add-event.php');
    }
}


// Function to display the main page of the Event Management menu
function event_management_main_page() {
    global $plugin_dir;
    echo '<div class="wrap"><h1>Event Management</h1></div>';
    include_once($plugin_dir . '/events/list-events.php');
}

// Functions for submenus
function event_management_list_guests() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    
    global $plugin_dir;
    echo '<div class="wrap"><h1>List Guests</h1></div>';
    include_once($plugin_dir . '/guests/list-guests.php');
}

function event_management_add_guest() {
    global $plugin_dir;
    $QrDataSTr = '';
    $token = wp_generate_uuid4();
    $accept_url = add_query_arg([
        'response' => 'accept',
        'token' => $token,
    ], site_url('/response-handler'));
    $decline_url = add_query_arg([
        'response' => 'decline',
        'token' => $token,
    ], site_url('/response-handler'));
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        $action = $_GET['action'];
       


        switch ($action) {
            case 'edit':
                $guest_id = $_GET['guest_id'];
                if (isset($_POST['submit_guest'])) {                        
                    $post_data  = array(
                                        'ID'         => $guest_id,
                                        'post_title' => wp_strip_all_tags($_POST['guest_name']),
                                    );
                    wp_update_post($post_data);
                    if (!is_wp_error($guest_id) && $guest_id != 0) {
                        update_post_meta($guest_id, 'guest_name', $_POST['guest_name']);
                        update_post_meta($guest_id, 'guest_contact', $_POST['guest_contact']);
                        // update_post_meta($guest_id, 'contact_number', $_POST['contact_number']);
                        update_post_meta($guest_id, 'guest_email', $_POST['guest_email']);
                        update_post_meta($guest_id, 'table_number', $_POST['table_number']);
                        update_post_meta($guest_id, 'associate_guests', $_POST['associate_guests']);
                        update_post_meta($guest_id, 'rsvp_status', $_POST['rsvp_status']);
                        update_post_meta($guest_id, 'attendance_status', $_POST['attendance_status']);
                        update_post_meta($guest_id, 'associated_event', $_POST['event_id']);
                        update_post_meta($guest_id, 'user_action', '');
                        update_post_meta($guest_id, 'user_token', $token);
                        $success_message = 'Guest successfully updated.';
                    } else {
                        $error_message = 'There was an error updating the event.';
                    }

                    $eventName = get_the_title($_POST['event_id']);   
                    
                    $QrDataSTr .= 'event_name:'.$eventName ?? '';
                    $QrDataSTr .= '&guestname:'.$_POST['guest_name'] ?? '';
                    $QrDataSTr .= '&guest_contact:'.$_POST['guest_contact'] ?? '';
                    $QrDataSTr .= '&guest_email:'.$_POST['guest_email'] ?? '';
                    $QrDataSTr .= '&table_number:'.$_POST['table_number'] ?? '';
                    $QrDataSTr .= '&associated_guests:'.$_POST['associate_guests'] ?? 0;
                    $QrDataSTr .= '&attendance:'.$_POST['attendance_status'] ?? '';
                    generate_and_save_qr_code($QrDataSTr,$guest_id);
                }
                    
                $custom_fields = get_post_custom($guest_id);
                $single_value = get_the_title($guest_id);
                include_once($plugin_dir . '/guests/edit-guest.php');
                break;
            case 'delete':
                    $guest_id = intval($_REQUEST['guest_id'] ?? 0);
                    wp_delete_post($guest_id, true); 
                    // unlink QR code    
                    $upload_dir = wp_upload_dir();
                    unlink($upload_dir['basedir'] . '/qr_codes/' . $_REQUEST['guest_id'] . '.png');
                    $success_message = 'Guest deleted successfully.';
                    include_once($plugin_dir . '/guests/edit-guest.php');
                    break;
            default:
                if (isset($_POST['submit_guest'])) {
                    $new_guest = array(
                            'post_title'    => wp_strip_all_tags($_POST['guest_name']),
                            'post_content'  => '', // You can include a description or content here if you want
                            'post_status'   => 'publish',
                            'post_type'     => 'event_guests'
                        );        
                    // Insert the post into the database
                    $guest_id = wp_insert_post($new_guest);        
                    // Check if the post was successfully created
                    if (!is_wp_error($guest_id) && $guest_id != 0) {
                        update_post_meta($guest_id, 'guest_name', $_POST['guest_name']);
                        update_post_meta($guest_id, 'guest_contact', $_POST['guest_contact']);
                        // update_post_meta($guest_id, 'contact_number', $_POST['contact_number']);
                        update_post_meta($guest_id, 'guest_email', $_POST['guest_email']);
                        update_post_meta($guest_id, 'table_number', $_POST['table_number']);
                        update_post_meta($guest_id, 'associate_guests', $_POST['associate_guests']);
                        update_post_meta($guest_id, 'rsvp_status', $_POST['rsvp_status']);
                        update_post_meta($guest_id, 'attendance_status', $_POST['attendance_status']);
                        update_post_meta($guest_id, 'associated_event', $_POST['event_id']);
                        update_post_meta($guest_id, 'user_action', '');
                        update_post_meta($guest_id, 'user_token', $token);

                        $eventName = get_the_title($_POST['event_id']); 
                        $retData = get_guest_data($guest_id);
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
                        sendEmail( $email_to, 'Invitation Email', $invitation_template , '');                        
                        $success_message = 'Guest successfully added.';
                    } else {
                        $error_message = 'There was an error adding the event.';
                    }

                    $eventName = get_the_title($_POST['event_id']);    
                    $QrDataSTr .= 'event_name:'.$eventName ?? '';
                    $QrDataSTr .= '&guestname:'.$_POST['guest_name'] ?? '';
                    $QrDataSTr .= '&guest_contact:'.$_POST['guest_contact'] ?? '';
                    $QrDataSTr .= '&guest_email:'.$_POST['guest_email'] ?? '';
                    $QrDataSTr .= '&table_number:'.$_POST['table_number'] ?? '';
                    $QrDataSTr .= '&associated_guests:'.$_POST['associate_guests'] ?? 0;
                    $QrDataSTr .= '&attendance:'.$_POST['attendance_status'] ?? '';
                    generate_and_save_qr_code($QrDataSTr,$guest_id);
                }

                include_once($plugin_dir . '/guests/add-guest.php');
                break;
        }
    } else {
        if (isset($_POST['submit_guest'])) {
            $new_guest = array(
                    'post_title'    => wp_strip_all_tags($_POST['guest_name']),
                    'post_content'  => '', // You can include a description or content here if you want
                    'post_status'   => 'publish',
                    'post_type'     => 'event_guests'
                );        
            // Insert the post into the database
            $guest_id = wp_insert_post($new_guest);        
            // Check if the post was successfully created
            if (!is_wp_error($guest_id) && $guest_id != 0) {
                update_post_meta($guest_id, 'guest_name', $_POST['guest_name']);
                update_post_meta($guest_id, 'guest_contact', $_POST['guest_contact']);
                // update_post_meta($guest_id, 'contact_number', $_POST['contact_number']);
                update_post_meta($guest_id, 'guest_email', $_POST['guest_email']);
                update_post_meta($guest_id, 'table_number', $_POST['table_number']);
                update_post_meta($guest_id, 'associate_guests', $_POST['associate_guests']);
                update_post_meta($guest_id, 'rsvp_status', $_POST['rsvp_status']);
                update_post_meta($guest_id, 'attendance_status', $_POST['attendance_status']);
                update_post_meta($guest_id, 'associated_event', $_POST['event_id']);
                update_post_meta($guest_id, 'user_action', '');
                update_post_meta($guest_id, 'user_token', $token);
                $eventName = get_the_title($_POST['event_id']);      

                
                $retData = get_guest_data($guest_id);
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
                sendEmail( $email_to, 'Invitation Email', $invitation_template , '');
                $success_message = 'Guest successfully added.';
            } else {
                $error_message = 'There was an error adding the event.';
            }

            $eventName = get_the_title($_POST['event_id']);                    
            $QrDataSTr .= 'event_name:'.$eventName ?? '';
            $QrDataSTr .= '&guestname:'.$_POST['guest_name'] ?? '';
            $QrDataSTr .= '&guest_contact:'.$_POST['guest_contact'] ?? '';
            $QrDataSTr .= '&guest_email:'.$_POST['guest_email'] ?? '';
            $QrDataSTr .= '&table_number:'.$_POST['table_number'] ?? '';
            $QrDataSTr .= '&associated_guests:'.$_POST['associate_guests'] ?? 0;
            $QrDataSTr .= '&attendance:'.$_POST['attendance_status'] ?? '';
            generate_and_save_qr_code($QrDataSTr,$guest_id);
        }

        include_once($plugin_dir . '/guests/add-guest.php');
    }    
}


function event_management_import_guests() {
    global $plugin_dir;
    echo '<div class="wrap"><h1>Import Guests</h1></div>';
    include_once($plugin_dir . '/guests/import-guests.php');
}

function event_handle_file_import() {
    // Verify nonce for security
    check_ajax_referer('event_secure_nonce', 'security');
    // Handle file upload and import

    if (!empty($_FILES['file']['tmp_name'])) {
        // Assuming you have the file in $_FILES['excel_file']
        $file = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if ($fileExtension === 'xls' || $fileExtension === 'xlsx') {
            // The file is an Excel file
            $target_dir = WP_CONTENT_DIR . '/uploads/guests_excel_directory/';
            if (!file_exists($target_dir)) {
                wp_mkdir_p($target_dir); // Create the directory if it doesn't exist
            }
            $target_file = $target_dir . basename(sanitize_text_field($_FILES['file']['name']));
                if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                    processExcelFileInChunks($target_file,500);
                } else {
                    wp_send_json_error('Failed to move the file.');
                }

            wp_send_json_success(['message' => 'File imported successfully']);
        } else {
            // The file is not in the expected Excel formats
            wp_send_json_success(['message' => 'The file is not an Excel file. Please upload an .xls or .xlsx file.']);
        }

        
    } else {
        wp_send_json_error(['message' => 'No file uploaded or an error occurred']);
    }

    wp_die(); // Terminate to avoid trailing 0 in the response
}


function setupReader($filePath) {
    $reader = new Xlsx();
    $reader->setReadDataOnly(true);
    $spreadsheet = $reader->load($filePath);
    $worksheet = $spreadsheet->getActiveSheet();
    return $worksheet;
}


function processExcelFileInChunks($filePath, $chunkSize = 500) {
    $startTime = microtime(true);
    sleep(1);
    $worksheet  = setupReader($filePath);    
    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();
    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
    $postData = [];
    $data = [];
    try {
        // Get organizer data from the second row
        $columnName = ["eventname","organisername","organiseremail","organisercontact","venuedetails","startdate","starttime","enddate","endtime"];
        $organizerData = [];
        foreach ($worksheet->getRowIterator(1, 1) as $row) { // Start and end with the second row for the organizer
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
            foreach ($cellIterator as $cell) {
                $organizerTitles = strtolower($cell->getValue());
                if(in_array($organizerTitles,$columnName)){
                    continue;
                }else{
                    unlink($filePath);
                    wp_send_json_error(['message' => 'Error reading file: Please check sample file essential organizer information.', 'data' => 'Success']); die;
                }
            }
        }
        $organizerData = [];
        foreach ($worksheet->getRowIterator(2, 2) as $row) { // Start and end with the second row for the organizer
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
            foreach ($cellIterator as $cell) {
                $organizerData[] = $cell->getValue();
            }
        }    

        // Extract organizer details
        $eventName = $organizerData[0] ?? '';
        $organiserName = $organizerData[1] ?? '';
        $organiserEmail = $organizerData[2] ?? '';
        $organiserContact = $organizerData[3] ?? '';
        $venueDetails = $organizerData[4] ?? '';
        $startDate = $organizerData[5] ?? '';
        $startTime = $organizerData[6] ?? ''; 
        
        $endDate = $organizerData[7] ?? '';
        $endTime = $organizerData[8] ?? '';
        $importedRecords = 0;

        if ($eventName && $organiserName && $organiserEmail && $organiserContact && $venueDetails && $startDate && $startTime && $endDate && $endTime) {
            $new_event =    array(
                                'post_title'    => wp_strip_all_tags($eventName),
                                'post_content'  => '', // You can include a description or content here if you want
                                'post_status'   => 'publish',
                                'post_type'     => 'event'
                            );
        
            // Insert the post into the database
            $event_id = wp_insert_post($new_event);
            if (!is_wp_error($event_id) && $event_id != 0) {
                update_post_meta($event_id, 'organiser_name', $organiserName);
                update_post_meta($event_id, 'organiser_email', $organiserEmail);
                update_post_meta($event_id, 'contact_number', $organiserContact);
                update_post_meta($event_id, 'venue_details', $venueDetails);
                $startSeconds = $startTime * 24 * 60 * 60;
                $formattedStartTime = gmdate("H:i:s", $startSeconds);
                $inputString = $startDate.' '.$formattedStartTime;
                $dateStartTime = date('Y-m-d\TH:i', strtotime($inputString));
                update_post_meta($event_id, 'start_datetime', $dateStartTime);
                
                $EndSeconds = $endTime * 24 * 60 * 60;
                $formattedendTime = gmdate("H:i:s", $EndSeconds);
                $inputEndString = $endDate.' '.$formattedendTime;
                $dateEndTime = date('Y-m-d\TH:i', strtotime($inputEndString));
                update_post_meta($event_id, 'end_datetime', $dateEndTime);
                update_post_meta($event_id, 'status', 'pending');
                
                foreach ($worksheet->getRowIterator(4) as $row) {
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false);
                    
                    $guestData = [];
                    foreach ($cellIterator as $cell) {
                        $guestData[] = $cell->getValue();
                    }
                    
                    $guestName = $guestData[0] ?? '';
                    $guestContact = $guestData[1] ?? '';
                    $guestEmail = $guestData[2] ?? '';
                    $tableNumber = $guestData[3] ?? '';
                    $status = $guestData[4] ?? '';
                    if (!empty($guestName) && !empty($guestContact) && !empty($guestEmail) && !empty($tableNumber) && !empty($status)) {
                        $new_guest = array(
                                        'post_title'    => wp_strip_all_tags($guestName),
                                        'post_content'  => '', // You can include a description or content here if you want
                                        'post_status'   => 'publish',
                                        'post_type'     => 'event_guests'
                                    );        
                        $guest_id = wp_insert_post($new_guest);        
                        if (!is_wp_error($guest_id) && $guest_id != 0) {
                            update_post_meta($guest_id, 'guest_name', $guestName);
                            update_post_meta($guest_id, 'guest_contact', $guestContact);
                            update_post_meta($guest_id, 'contact_number', $guestContact);
                            update_post_meta($guest_id, 'guest_email', $guestEmail);
                            update_post_meta($guest_id, 'table_number', $tableNumber);
                            update_post_meta($guest_id, 'rsvp_status', 'pending');
                            update_post_meta($guest_id, 'attendance_status', 'not_attended');
                            update_post_meta($guest_id, 'associated_event', $event_id);
                            $importedRecords++;
                            update_option('event_plugin_import_progress', array('total' => $highestColumnIndex - 3, 'imported' => $importedRecords));
                        } else {
                            wp_send_json_error('Error reading file: There was an error adding the event.');
                        }
                    }else{
                        wp_send_json_error('Error reading file: Please check sample file essential guest information.');
                    }
                }
            } else {
                wp_send_json_error('Error reading file: Please check sample file essential organizer information.');
            }
        }else{
            wp_send_json_success(['message' => 'Error reading file: Please check sample file essential organizer information.', 'data' => 'Success']); die;
        }

        wp_send_json_success(['message' => 'File imported successfully', 'data' => 'Success']);
    } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
        wp_send_json_error('Error reading file: ' . $e->getMessage());
    }
    
    die;
}

function event_plugin_check_import_progress() {
    // Assume progress is stored in an option or transient
    $progress = get_option('event_plugin_import_progress', array('total' => 0, 'imported' => 0));
    
    wp_send_json($progress);
}

add_action('wp_ajax_check_import_progress', 'event_plugin_check_import_progress');

function event_management_settings() {
    global $plugin_dir;
    echo '<div class="wrap"><h1>Event Management Settings</h1></div>';
    include_once($plugin_dir . '/settings/settings.php');

}


add_action('admin_init', 'handle_event_actions');

function handle_event_actions() {
    $page = $_REQUEST['page'] ?? '';
    
    if($page){
        switch($page){
            case 'event-management' : 
                    $action = $_REQUEST['action'] ?? '';
                    $event_id = intval($_REQUEST['event'] ?? 0);
                    if ('edit' === $action) {
                        wp_redirect(admin_url('admin.php?page=add-event&action='.$action.'&event_id=' . $event_id));
                        exit;
                    } elseif ('delete' === $action && $event_id > 0) {
                        wp_delete_post($event_id, true);
                        wp_redirect(admin_url('admin.php?page=event-management'));
                        exit;
                    }
                    break;
            case 'list-guests' : 
                    $action = $_REQUEST['action'] ?? '';
                    $guest_id = intval($_REQUEST['guest_id'] ?? 0);
                    if ('delete' === $action && $guest_id > 0) {
                        wp_delete_post($guest_id, true);
                        wp_redirect(admin_url('admin.php?page=list-guests'));
                        exit;
                    }
        }
    }else{
        return ;
    }
}

function generate_and_save_qr_code($data, $post_id) {
    ob_start();
    $upload_dir = wp_upload_dir();
    if(isset($data) && $post_id > 0){
        $qr_image_path = $upload_dir['basedir'] . '/qr_codes/' . $post_id . '.png';
        if (!file_exists($upload_dir['basedir'] . '/qr_codes/')) {
            wp_mkdir_p($upload_dir['basedir'] . '/qr_codes/');
        }
        $options    =   new QROptions([
                                'version'    => QRCode::VERSION_AUTO,
                                'outputType' => QRCode::OUTPUT_IMAGE_PNG,
                                'eccLevel'   => QRCode::ECC_L
                            ]);
        $qrcode = new QRCode($options);              
        $base64_string = str_replace('data:image/png;base64,','',$qrcode->render(urlencode($data)));
        $decoded_data = base64_decode($base64_string);
        file_put_contents($qr_image_path, '');
        file_put_contents($qr_image_path, $decoded_data);
        update_post_meta($post_id, 'qr_code_url', 'qr_codes/' . $post_id . '.png');        
    }else{
        return '';
    }
    ob_end_flush();  
}

function generate_url_qr_code() {
    ob_start();
    $upload_dir = wp_upload_dir();
        $qr_image_path = $upload_dir['basedir'] . '/qr_codes/upload-link.png';
        if (!file_exists($upload_dir['basedir'] . '/qr_codes/')) {
            wp_mkdir_p($upload_dir['basedir'] . '/qr_codes/');
        }
        $options    =   new QROptions([
                                'version'    => QRCode::VERSION_AUTO,
                                'outputType' => QRCode::OUTPUT_IMAGE_PNG,
                                'eccLevel'   => QRCode::ECC_L
                            ]);
        $qrcode = new QRCode($options);       
        $data = site_url("event-photo-video-upload");       
        $base64_string = str_replace('data:image/png;base64,','',$qrcode->render($data));
        $decoded_data = base64_decode($base64_string);
        file_put_contents($qr_image_path, $decoded_data);
    
    ob_end_flush();  
}

function event_management_gallery(){
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    
    global $plugin_dir;
    echo '<div class="wrap"><h1>Event Gallery List</h1></div>';
    include_once($plugin_dir . '/list-gallery.php');
}