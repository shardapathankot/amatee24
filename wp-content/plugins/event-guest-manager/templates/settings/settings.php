<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f5f5f5; /* Light gray background */
    }

    h2 {
        color: #333; /* Dark gray color for the text */
        margin-bottom: 20px; /* Space below the heading */
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin: -10px;
    }

    .column {
        flex: 1;
        padding: 10px;
        min-width: 200px;
    }
    #settingForm input {
        width: 100%;
    }
    form, textarea, input {
        width: 100%;
        height: 100px; /* Adjust based on your need */
    }

    textarea {
        padding: 10px;
        margin-top: 10px; /* Spacing between the form and the button if in the same column */
        resize: vertical; /* Allows the user to vertically resize the textarea */
        border: 1px solid #ccc; /* Style the border as needed */
        border-radius: 4px; /* Optional: rounds the corners of the textarea */
    }

    button {
        cursor: pointer;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        transition: background-color 0.3s ease;

        /* Align button to the right of the column */
        display: block;
        width: fit-content;
        margin-left: auto;
    }

    button:hover {
        background-color: #0056b3;
    }

    .link-column {
        background-color: #e9ecef; /* Light gray background color */
        /* Additional styling specific to this column can go here */
    }

    /* Ensure the link within the column is styled appropriately */
    .link-column a {
        display: inline-block; /* Makes the link fill the column for better clickability */
        padding: 10px; /* Adds some padding around the text for aesthetics */
        color: #007bff; /* Bootstrap primary link color for consistency */
        text-decoration: none; /* Removes underline from links */
    }

    .link-column a:hover {
        color: #0056b3; /* Darker blue on hover for visual feedback */
        text-decoration: underline; /* Adds underline on hover for clarity */
    }

    /* Add some basic styling */
    /* Add some basic styling */
    table {
        width: 100%;
        border-collapse: collapse;
    }
    td, th {
        border: 1px solid #ddd;
        padding: 8px;
    }
    /* Style for the first cell with increased font size */
    .dark-blue-bg {
        background-color: #00008B; /* Dark blue background */
        color: white; /* White text color */
        font-size: 20px; /* Larger font size */
        font-weight: bold; /* Make the font bold */
    }
    /* Center align the input in the second cell */
    .input-center {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: white;
    }
    /* Styling for the input field for better visibility */
    input[type="text"] {
        padding: 5px;
        margin: 0;
    }
    /* Style for the action button with centered alignment and larger font */
    .button-center {
        text-align: center; /* Center-align the button wrapper */
        vertical-align: middle;
    }
    .action-button {
        background-color: #4CAF50; /* Green background */
        color: white;
        padding: 10px 24px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px; /* Larger font size for the button */
        text-align: center;
    }
</style>
<div class="container">
    <h2>Settings</h2>
    <hr/>
    <p id="successmsg" style="color:green;text-align:center;"></p>
    <p id="errormsg" style="color:red;text-align:center;"></p>
    <table>
        <tr>
            <td class="dark-blue-bg">Photo/Video Upload QR</td>
            <td class="input-center">
                <img id="qr-upload" src="<?php echo esc_url(site_url('wp-content/uploads/qr_codes/upload-link.png'));?>" width="250" height="250" />    
            </td>
            <td class="button-center">
                <button type="button" id="qr-action-button" class="qr-action-button action-button" onclick="printImage()">Print</button>
            </td>
        </tr>
        <tr>
        <form id="smtp-settings-form">
            <td class="dark-blue-bg">SMTP Credentials</td>
            <td class="input-center">
                
                <input type="hidden" name="smtp_settings_nonce" id="smtp_settings_nonce" value="<?php echo wp_create_nonce('save-smtp-settings-nonce'); ?>" />
    
                <input type="text" id="smtp_host" name="smtp_host" placeholder="SMTP Host" value="<?php echo esc_attr(get_option('smtp_host')); ?>" required /> <br/>
                <input type="text" id="smtp_username" name="smtp_username" placeholder="SMTP Username" value="<?php echo esc_attr(get_option('smtp_username')); ?>" required /> <br/>
                <input type="password" id="smtp_password" name="smtp_password" placeholder="SMTP Password" value="<?php echo esc_attr(get_option('smtp_password')); ?>" required /> <br/>
                <input type="number" id="smtp_port" name="smtp_port" placeholder="SMTP Port" min="0" value="<?php echo esc_attr(get_option('smtp_port')); ?>" required /> <br/>
            </td>
            <td class="button-center">
                <?php //submit_button('Save Settings'); ?>
                <button type="submit" id="smtp-action-button" class="action-button">Save</button>
            </td>
        </form>
        </tr>
        <tr>
            <td class="dark-blue-bg">QR Scan Code Snippet</td>
            <td colspan="3" class="input-center">
                <table border="0">
                    <tr>
                        <td class="input-center">Include Below shortcode in Page or Post</td>
                    </tr>
                    <tr>
                        <td class="input-center"><pre><code>[event_scan_qr]</code></pre></td>
                    </tr>
                    <tr>
                        <td class="input-center">OR</td>
                    </tr>
                    <tr>
                        <td class="input-center">Include the shortcode in a WordPress template</td>
                    </tr>
                    <tr>
                        <td class="input-center">
                            <pre><code>&lt;?php if (shortcode_exists('event_scan_qr')) { echo do_shortcode('[event_scan_qr]'); } ?&gt;</code></pre>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <form id="paypal-settings-form">
            <tr>
                <td class="dark-blue-bg">Paypal Credentials</td>
                <td class="input-center">
                    <input type="hidden" name="paypal_settings_nonce" id="paypal_settings_nonce" value="<?php echo wp_create_nonce('save-paypal-settings-nonce'); ?>" />
                    <input type="text" id="paypal_key" name="paypal_key" placeholder="Paypal Key" value="<?php echo esc_attr(get_option('paypal_key')); ?>" required> <br/>
                    <input type="text" id="paypal_secret" name="paypal_secret" placeholder="Paypal Secret" value="<?php echo esc_attr(get_option('paypal_secret')); ?>" required> <br/>
                </td>
                <td class="button-center">
                    <button class="action-button" id="paypal_credential_save">Save</button>
                </td>
            </tr>
		</form>	
            <tr>
                <td class="dark-blue-bg">Paypal Shortcode </td>
                <td colspan="3" class="input-center">
                    <table border="0">
                        <tr>
                            <td class="input-center">Include Below shortcode in Page or Post</td>
                        </tr>
                        <tr>
                            <td class="input-center"><pre><code>[event_paypal_button]</code></pre></td>
                        </tr>
                        <tr>
                            <td class="input-center">OR</td>
                        </tr>
                        <tr>
                            <td class="input-center">Include the shortcode in a WordPress template</td>
                        </tr>
                        <tr>
                            <td class="input-center">
                                <pre><code>&lt;?php if (shortcode_exists('event_paypal_button')) { echo do_shortcode('[event_paypal_button]'); } ?&gt;</code></pre>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="dark-blue-bg">Upload Image/video Shortcode </td>
                <td colspan="3" class="input-center">
                    <table border="0">
                        <tr>
                            <td class="input-center">Include Below shortcode in Page or Post</td>
                        </tr>
                        <tr>
                            <td class="input-center"><pre><code>[event_upload_media]</code></pre></td>
                        </tr>
                        <tr>
                            <td class="input-center">OR</td>
                        </tr>
                        <tr>
                            <td class="input-center">Include the shortcode in a WordPress template</td>
                        </tr>
                        <tr>
                            <td class="input-center">
                                <pre><code>&lt;?php if (shortcode_exists('event_upload_media')) { echo do_shortcode('[event_upload_media]'); } ?&gt;</code></pre>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
			<tr>
							<td class="dark-blue-bg">Frontend Gallery Shortcode </td>
							<td colspan="3" class="input-center">
								<table border="0">
									<tr>
										<td class="input-center">Include Below shortcode in Page or Post</td>
									</tr>
									<tr>
										<td class="input-center"><pre><code>[event_gallery]</code></pre></td>
									</tr>
									<tr>
										<td class="input-center">OR</td>
									</tr>
									<tr>
										<td class="input-center">Include the shortcode in a WordPress template</td>
									</tr>
									<tr>
										<td class="input-center">
											<pre><code>&lt;?php if (shortcode_exists('event_gallery')) { echo do_shortcode('[event_gallery]'); } ?&gt;</code></pre>
										</td>
									</tr>
								</table>
							</td>
						</tr>
        
    </table>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#smtp-settings-form').submit(function(e) {
            e.preventDefault();
            $('#successmsg').html('');
            var data = {
                'action': 'save_smtp_settings',
                'smtp_host': $('#smtp_host').val(), 
                'smtp_username': $('#smtp_username').val(), 
                'smtp_password': $('#smtp_password').val(),
                'smtp_port': $('#smtp_port').val(),
                'security': '<?php echo wp_create_nonce("save-smtp-settings-nonce"); ?>'
            };

            $.post(ajaxurl, data, function(response) {
                if(response.success){
                    $('#successmsg').html(response.data);
                    setTimeout(function(){
                        $('#successmsg').html('');
                    },5000);
                }else{
                    $('#errormsg').html(response.data);
                    setTimeout(function(){
                        $('#errormsg').html('');
                    },5000);
                }
            });
        });

        $('#paypal-settings-form').submit(function(e) {
            e.preventDefault();
            $('#successmsg').html('');
            var data = {
                'action': 'save_paypal_settings',
                'paypal_key': $('#paypal_key').val(),
                'paypal_secret': $('#paypal_secret').val(),
                'security': '<?php echo wp_create_nonce("save-paypal-settings-nonce"); ?>'
            };

            $.post(ajaxurl, data, function(response) {
                $('#container').animate({
                                    scrollTop: 0
                                }, 'slow');

                if(response.success){
                    $('#successmsg').html(response.data);
                    setTimeout(function(){
                        $('#successmsg').html('');
                    },5000);
                }else{
                    $('#errormsg').html(response.data);
                    setTimeout(function(){
                        $('#errormsg').html('');
                    },5000);
                }
            });
        });


    });
    function printImage() {
        var imageURL = document.getElementById('qr-upload').src;
        var iframe = document.createElement('iframe');
        iframe.style.display = 'none'; // Hide the iframe
        iframe.src = imageURL;
        document.body.appendChild(iframe);
        
        iframe.onload = function() {
            setTimeout(function() {
                iframe.focus();
                iframe.contentWindow.print();
                document.body.removeChild(iframe); // Remove the iframe after printing
            }, 1);
        };
    }
    

</script>