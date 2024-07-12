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
// Create a new WP_Query
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

// Create a new WP_Query
$query1 = new WP_Query($args1);
$eventdate = '';
$eventname = '';
$start = '';
$end = '';
$address = '';
$event_id = '';
if ($query1->have_posts()) {
    while ($query1->have_posts()) {
        $query1->the_post();
        $event_id = get_the_ID();
        // Assuming 'start_datetime' is stored in the format 'Y-m-d H:i'
        $start_datetime = get_post_meta(get_the_ID(), 'start_datetime', true);
        $date_format = 'm/d/Y'; // Example: March 10, 2021
        $time_format = 'g:i a'; // Example: 3:30 pm
        
        // Optionally, convert datetime based on WordPress timezone settings
        $start_datetime = strtotime($start_datetime);
        $formatted_date = date_i18n($date_format, $start_datetime);
        $formatted_time = date_i18n($time_format, $start_datetime);

        $end_datetime = get_post_meta(get_the_ID(), 'end_datetime', true);
        $date_format = 'm/d/Y'; // Example: March 10, 2021
        $time_format = 'g:i a'; // Example: 3:30 pm
        
        // Optionally, convert datetime based on WordPress timezone settings
        $end_datetime = strtotime($end_datetime);
        $formatted_end_date = date_i18n($date_format, $end_datetime);
        $formatted_end_time = date_i18n($time_format, $end_datetime);
        $eventdate = esc_html($formatted_date) ?? '';
        $eventname = get_the_title() ?? '';
        $start = $formatted_time ?? '';
        $end = $formatted_end_date . ' '.$formatted_end_time ?? '';
        $address = str_replace(',','<br />',get_post_meta(get_the_ID(), 'venue_details', true));
    }
    /* Restore original Post Data */
    wp_reset_postdata();
} else {
    echo '<p>No upcoming events found.</p>';
}
?>

  <title>WEDDING INVITATION</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Edu+NSW+ACT+Foundation:wght@400..700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Edu+NSW+ACT+Foundation:wght@400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Courgette&display=swap');

    body {
      font-family: "Poppins", sans-serif;
    }

    .Courgette {
      font-family: "Courgette", cursive;
    }

    .our {
      font-family: "Edu NSW ACT Foundation", cursive;
    }

    .font_brush {
      font-family: "Caveat Brush", cursive;
      font-weight: 400;
    }
    p {
    font-size: unset;
    color: unset;
}
.page-wrapper p {
    line-height: unset;
    margin: 0 0 0em;
}
table {
    caption-side: unset;
    border-collapse: unset;
}
td, th {
    border: 1px solid #ebebf1;
    padding: 0px;
    font-size: unset;
    color: unset;
}

@media screen and (max-width:576px) {
    .crmny_section td {
    font-size: 22px !important;
}
.crmny_section td {
    font-size: 18px !important;
}
.Courgette {
    font-size: 40px ! IMPORTANT;
}

.image_time p span:first-child {
    font-size: 13px !important;
}
.crmny_section {
    display: contents;
}
.table_main {
    width: 90% !important;
    padding: 10px !important;
}

}
    /* Old css */
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
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        background-color: <?php echo isset($_SESSION['link_message']['decline']) && !empty($_SESSION['link_message']['decline']) ? '#ee0404' : 'green'; ?>;
        padding: 20px 15px;
        border-radius: 5px;
        border-collapse: collapse;
        border-spacing: 0;
        max-width: 500px;
        color: #FFF;
        width: 100%;
        margin: auto;
        z-index: 9;
        height: fit-content;
        font-size: 17px;
        text-align: center;
    }
    td {
        border: none;
    }
    
    /* form new design */
    .form-container h1 {
    font-size: 40px;
    line-height: 55px;
    margin: 0;
    margin: 15px 0;
    position: relative;
    text-transform: uppercase;
    font-family: "Futura PT";
    font-weight: 700;
    text-align: center;
    color: #fff;
}
.hideform p {
    line-height: 55px;
    position: relative;
    text-transform: uppercase;
    font-family: "Futura PT";
    font-weight: 500;
    text-align: center;
    color: #fff;
}
.hideform input[type="text"] {
    height: 50px;
    margin-bottom: 20px;
    border: 0;
    border-bottom: 1px solid #CDE0EF;
    background: transparent;
    border-radius: 0;
     color: #fff;
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    -moz-appearance: none;
    appearance: none;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}
.hideform input[type="text"]::placeholder {
    color: #fff;
}
.hideform input[type="text"]:focus {
    background-color: transparent;
    outline: none;
}
.form-container .btn {
    background-color: #CDE0EF;
    color: #002642;
    padding: 16px 20px;
        border: 1px solid;
    cursor: pointer;
    width: 100%;
    margin-bottom: 10px;
    font-weight: 600;
    outline: none;
    box-shadow: none;
    
}
.form-container .btn:hover {
    background-color: #000;
    color: #fff;
    border-color: #fff;
}
.form-container .cancel {
    background-color: transparent;
    border: 2px solid #CDE0EF;
        color: #fff;
}
#qrCodeImage img {
    margin: 10px 0;
    height: 150px;
}
#qrCodeImage p {
    color: #fff;
    font-size: 13px;
}
#event_paypal_button .register-button {
    text-decoration: none;
    background-color: #cde0ef;
    padding: 10px 30px;
    display: inline-block;
    border-radius: 0px;
    font-size: 14px;
    margin: 5px 0;
    color: #111111;
}
#qrCodeImage button {
    text-decoration: none;
    background-color: #cde0ef;
    padding: 5px 10px;
    display: inline-block;
    border-radius: 0px;
    font-size: 12px;
    margin: auto;
    width: 105px;
    border: none;
}

 /* Button used to open the contact form - fixed at the bottom of the page */
 .open-button {
                        background-color: #555;
                        color: white;
                        padding: 16px 20px;
                        border: none;
                        cursor: pointer;
                        opacity: 0.8;
                        bottom: 23px;
                        right: 28px;
                        width: 280px;
                    }

                    /* The popup form - hidden by default */
                    .form-popup {
                        display: none;
                        position: fixed;
                        bottom: 0;
                        right: 15px;
                        z-index: 999999;
                        left: 0;
                        top: 0;
                        background-color: #00000085;
                    }

                    .form_rsvp {
                        height: 100%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }

                    /* Add styles to the form container */
                    .form-container {
                        max-width: 500px;
                        padding: 10px;
                        background-color: black;
                        text-align: center;
                        border: 5px solid #fff;
                    }

                    /* Full-width input fields */
                    .form-container input[type=text],
                    .form-container input[type=password] {
                        width: 93%;
                    }
                    

                    /* Add some hover effects to buttons */
                   

                    select.widefat {
                        width: 94%;
                        padding: 15px;
                        margin: 5px 0 22px 0;
                        border: none;
                        background: #f1f1f1;
                    }
  </style>


<div style="background-color: #000000;    padding-bottom: 100px;">
  <table style="padding: 100px auto 0px;">
    <tbody>

      <tr>
          <?php if(isset($_SESSION['link_message'])): ?>
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
        <td style="  text-align: center;  margin: 1rem auto 0px;
        padding: 30px;
        /* background-image: linear-gradient(180deg, #00000094, #0000001f); */
        background-color: #000000;">
          <table style="width: 100%;">
            <tbody>
              <tr>
                <td>
                  <img src="https://amatee24.com/wp-content/plugins/event-guest-manager/images/section-title2.png" alt="">
                </td>
              </tr>
              <tr>
                <td style="font-size: 40px;
                color: #ffffff;">WEDDING INVITATION</td>
              </tr>
              <tr>
                <td>
                  <img style="height: 12px;
                  width: auto;" src="https://amatee24.com/wp-content/plugins/event-guest-manager/images/heading-border.png" alt="">
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      <tr class="height: 30px;"></tr>
    </tbody>
  </table>
  <table class="table_main" style="max-width: 100%;
  margin: 0px auto 0px;
  width: 50%;
  background-color: #000;
  padding: 30px;
  border: 10px solid #fff;    caption-side: unset;
    border-collapse: unset;">
    <tbody>
      <tr>
        <td style="    margin: 1rem auto 0px;
        border: 1px solid #939393;
        padding: 30px;
        /* background-image: linear-gradient(180deg, #00000094, #0000001f); */
        background-color: #fff;">
          <table style="width: 100%;">
            <tbody>
              <tr>
                <td class="Courgette" style="text-align: center;
                font-size: 60px;font-weight: 500; line-height: 100%; color: #000000;">
                  <p style="letter-spacing: 20px;display: inline;">S</p>
                  <p style="letter-spacing: 20px;display: inline;">A</p>
                  <p style="letter-spacing: 20px;display: inline;">V</p>
                  <p style="display: inline;">E</p>
                </td>
              </tr>
              <tr>
                <td class="our" style="
                    text-align: center;
    font-weight: 600;
    font-size: 50px;line-height: 100%; color: #000000;">our</td>
              </tr>
              <tr>
                <td class="Courgette" style=" font-weight: 500;   text-align: center;
                font-size: 60px; color: #000000;">
                  <p style="letter-spacing: 20px;display: inline;">D</p>
                  <p style="letter-spacing: 20px;display: inline;">A</p>
                  <p style="letter-spacing: 20px;display: inline;">T</p>
                  <p style="display: inline;">E</p>
                </td>
              </tr>
              <tr>
                <td style="    text-align: center;
                font-size: 25px;
                padding: 15px 0;
                font-weight: 500;color: #000000;">08 . 17 . 2024</td>
              </tr>
              <tr>
                <td style="    text-align: center;">
                  <img style="        height: 260px;
                  box-shadow: inset 0px 0px 220px #ffffffe0;
                  /* background-color: #ffffff9e; */
                  padding: 10px;
                  border-radius: 5px;" src="https://amatee24.com/wp-content/plugins/event-guest-manager/images/name-logo.png" alt="">
                </td>
              </tr>
              <tr>
                <td style="text-align: center;
                font-weight: 400;
                font-size: 18px; color: #000000;">Request Your Presence At Their Wedding</td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      <tr style="height: 30px;"></tr>
      <tr>
        <td style="">
          <table style="width: 100%;">
            <tbody>
              <tr>
                <td>
                  <img style="    width: 100%;" src="https://amatee24.com/wp-content/plugins/event-guest-manager/images/couple-image.jpg" alt="">
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      <tr style="height: 30px;"></tr>
      <tr>
        <td style="margin: 1rem auto 0px;
                  border: 1px solid #939393;
                  background-image: url(https://amatee24.com/wp-content/plugins/event-guest-manager/images/background-image.jpg);background-color: black;
                  background-repeat: no-repeat;
                  background-size: 100%;    filter: grayscale(100%);">
          <table class="table_image" style="width: 100%;
                        padding: 30px;
                        background-image: linear-gradient(180deg, #00000042, #000000);">
            <tbody>
              <tr>
                <td class="crmny_section" style="text-align: center; width: 30%;    border-right: 3px solid #fff;">
                  <table style="width: 100%;">
                    <tbody>
                      <tr>
                        <td class="image_time" style="text-align: center;
                                  font-weight: 500;
                                  font-size: 32px;
                                  color: #ffffff;
                                  text-shadow: 1px 2px 0px #000000;font-style: italic;">
                          <p style="margin: 0px 0px;">
                            <span style="font-size: 20px;">11:00 am</span>
                            <br>
                            <span class="font_brush">Ceremony</span>
                          </p>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
                <td class="crmny_section" style="text-align: center; width: 65%;">
                  <table style="width: 100%;">
                    <tr>
                      <td class="image_time" style="text-align: center;
                            font-weight: 500;
                            font-size: 32px;
                            color: #ffffff;
                            text-shadow: 1px 2px 0px #000000;font-style: italic;">
                        <p style="margin: 0px 0px;">
                          <span style="font-size: 20px;">5:00 pm</span>
                          <br>
                          <span class="font_brush">Reception/Traditional marriage</span>
                        </p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <!-- <tr>
                <td class="font_brush" style="    text-align: center;
                font-weight: 500;
                font-size: 32px;
                color: #ffffff;
                text-shadow: 1px 2px 0px #000000;font-style: italic;">
                  <p style="margin: 0px 0px;">
                    <span>Ceremony</span>
                    <span>Reception/Traditional marriage</span>
                  </p>
                </td>
              </tr> -->
              <tr>
                <td colspan="2" style="text-align: center;
                color: #fff;">
                  <p style="font-size: 22px; color: #fff; font-weight: 500; margin-top:1rem; margin-bottom:1rem;    text-align: center;">
                    <img style="    display: inline;
                    height: 104px;" src="https://amatee24.com/wp-content/plugins/event-guest-manager/images/location.png" alt="">
                    <br>
                    <span>ICCH Hall 8250 Creekbend Dr
                      <br>
                      Houston
                      <br>
                      TX 77071</span>
                  </p>
                </td>
              </tr>
              <tr>
                <td colspan="2" style="    text-align: center;">
                  <img style="    width: auto;
                  height: 36px;" src="https://amatee24.com/wp-content/plugins/event-guest-manager/images/border-b-removebg-preview.png" alt="">
                </td>
              </tr>
              <tr>
                <td colspan="2" style="    text-align: center;
                color: #fff;
                font-size: 32px;
                font-weight: 500;">RSVP</td>
              </tr>
              <tr>
                <td colspan="2" style="text-align: center;
                color: #ffffff;
                font-size: 15px;
                width: 80%;
                max-width: 100%;
                margin: auto;">
                  We are so excited to celebrate this day with our nearest and dearest, and are hoping to keep the guest
                  list limited. So, a guest-specific access QR code will be assigned following your RSVP below. Security will scan QR codes to direct guests to their assigned tables upon arrival. Only QR codes assigned to guests on the guest list will be valid for entry.
                  Thank you for respecting our wishes.
                </td>
              </tr>
              <tr>
                <td colspan="2" style="    text-align: center;">
                  <img style="    width: auto;
                  height: 36px;" src="https://amatee24.com/wp-content/plugins/event-guest-manager/images/border-b-removebg-preview.png" alt="">
                </td>
              </tr>
              <tr>
                <td colspan="2" style="    text-align: center;
                color: #fff;
                font-size: 32px;
                font-weight: 500;">Adults-Only</td>
              </tr>
              <tr>
                <td colspan="2" style="text-align: center;
                color: #ffffff;
                font-size: 15px;
                width: 80%;
                max-width: 100%;
                margin: auto;    padding-bottom: 50px;">
                  While we adore your little ones, we have opted for an adults-only event to allow everyone enjoy the
                  festivities without any restrictions.
                  We appreciate your understanding.
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      <tr style="height: 30px;"></tr>
      <tr>
        <td>
          <table style="width: 100%;">
            <tbody>
              <tr>
                <td style="text-align: center;">
                  <a style="    text-decoration: none;
                  color: #002642;
                  background-color: #cde0ef;
                  padding: 10px 50px;
                  display: inline-block;
                  border-radius: 0px;
                  font-size: 24px;" href="#!"
                  onclick="openForm(event); return false;"
                  >RSVP</a>
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>


                <div class="form-popup" id="rsvpForm">
                    <div class="form_rsvp">                        
                        <?php
                        if (!empty($success_message)) {
                            echo '<div class="notice notice-success is-dismissible"><p>' . $success_message . '</p></div>';
                        }

                        if (!empty($error_message)) {
                            echo '<div class="notice notice-error is-dismissible"><p>' . $error_message . '</p></div>';
                        }
                        $url = admin_url('admin.php?page=list-guests');
                        ?>
                        <div class="row">                      
                        
                        <form action="" method="post" class="add-guest form-container">
                            <h1>RSVP</h1>
                            <p id="qrCodeImage"></p>
                            <p id="successmsg" style="color:green"></p>
                            <div class="hideform">
                                <p>Please fill out the form below</p>
                                <input type="hidden" name="event_id" value="<?php echo $event_id; ?>" />
                                <input type="hidden" name="event_action" value="add_guest" />
                                <input type="text" name="guest_name" placeholder="Guest Name *" required /><br />
                                <input type="text" name="guest_contact" placeholder="Guest Phone Number *" required class="widefat">
                                <input type="text" name="guest_email" placeholder="Guest Email *" required class="widefat">
<p>Number of accompanying guests is assigned by hosts.</p>
                                <input type="submit" class="btn" name="submit_guest" value="Submit" />
                            </div>                            
                            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                        </form>

                        </div>                        
                    </div>
                </div>

                <script>
                    function openForm(event) {
                        // Prevent the default anchor action
                        if (event) event.preventDefault();
                        document.getElementById("rsvpForm").style.display = "block";

                        jQuery('#qrCodeImage').html('');
                        jQuery('#successmsg').html('');
                        jQuery('.hideform').show();       
                    }

                    function closeForm() {
                        document.getElementById("rsvpForm").style.display = "none";
                    }
                </script>



</div>
<?php
get_footer();