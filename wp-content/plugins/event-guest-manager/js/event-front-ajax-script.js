jQuery(document).ready(function($) {
    $("#successmsg").html('');
    $('.add-guest').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting via the browser.
        jQuery("#successmsg").html('Processing ...');
        var formData = {
            'action': 'add_guest_ajax', // This is required so WordPress knows which action to trigger.
            'nonce': event_plugin_ajax_object.nonce, // Passed from wp_localize_script
            'data': $(this).serialize() // Serialize the form data
        };

        $.ajax({
            type: 'POST',
            url: event_plugin_ajax_object.ajax_url,
            data: formData,
            success: function(response) {
    if(response.success){
		const parsedUrl = new URL(response.data.qr_url);
        const pathname = parsedUrl.pathname;
        const filename = pathname.split('/').pop();
        const eventQr='';
        if (filename.endsWith('.jpg')) {
            eventQr = filename;
        }
		//var qrHtml = '<p>Thank you for registering for our wedding!</p><img src="'+response.data.qr_url+'" /> <br /> <a href="'+response.data.qr_url+'" download="'+eventQr+'"><button type="button">Download QR</button></a> <button id="copyQRButton" type="button">Copy QR</button>';
        var qrHtml = '<p>Thank you for registering for our wedding!</p><img src="'+response.data.qr_url+'" /> <br /> <a href="'+response.data.qr_url+'" download="'+eventQr+'"><button type="button">Download QR</button></a> <button id="copyQRButton" type="button">Copy QR</button> <p class="qr-big-text">As we embark on this exciting journey, Your presence is what we value the most. If you are considering a gift, a monetary contribution would be a lovely gesture. Visit our wedding registry by clicking the “Registry” button below.</p>';
        
                
                // Assuming `response` is the JSON response you've received

                var content = response.data.event_paypal_button;

                // Create a temporary container for the content
                var tempDiv = document.createElement('div');
                tempDiv.innerHTML = content;

                // Extract script tags
                var scripts = tempDiv.querySelectorAll('script');

                // Remove script tags from the temporary div
                scripts.forEach(function(script) {
                    script.parentNode.removeChild(script);
                });

                // Now, tempDiv.innerHTML contains only the non-script HTML
                // Insert this HTML into the DOM
                qrHtml +='<p id="event_paypal_button">'+tempDiv.innerHTML+'</p>';
                jQuery('#qrCodeImage').html(qrHtml);
                // Iterate over the extracted scripts and dynamically create script elements
                scripts.forEach(function(oldScript) {
                    var newScript = document.createElement('script');

                    // Copy script attributes (src, type) if necessary
                    Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));

                    // If the script has inline content, copy it
                    if (oldScript.innerHTML) {
                        newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                    }

                    // Append the new script to the document
                    document.body.appendChild(newScript);
                });

        jQuery("#successmsg").html(response.data.message);
        jQuery(".add-guest").get(0).reset();
        jQuery('.hideform').hide();     

        // Copy QR code to clipboard
        $('#copyQRButton').click(function() {
            var qrUrl = response.data.qr_url;
            var tempInput = document.createElement('input');
            tempInput.value = qrUrl;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            alert('QR code copied to clipboard!');
        });
    }
},

            error: function(error) {
                jQuery("#successmsg").html('Failed to add as RSVP.');
            }
        });
        // jQuery("#successmsg").html('');
    });

    $('input[name="submit_guest"]').click(function() {
        
        $("#successmsg").html('Processing ...');
        // Your code here
    });


});