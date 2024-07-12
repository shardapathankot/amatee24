jQuery(document).ready(function($) {
    if (document.getElementById("button-container")) {
        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", 
            { fps: 10, qrbox: 250 }, false);
            const onScanSuccess = (decodedText, decodedResult) => {
                const encodedString = decodedText;
                const decodedString = decodeURIComponent(encodedString);
                const pairs = decodedString.split('&');
                const parsedData = {};
                pairs.forEach(pair => {
                const [key, value] = pair.split(':');
                    parsedData[key] = value;
                });
                updatePageWithParsedData(parsedData);
                html5QrcodeScanner.clear().then(() => { 
                    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                }).catch((err) => {
                    //alert('Failed to clear the QR Code scanner.'+ err);
                    //html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                });
            };
    
            const onScanFailure = (error) => {
                //alert(`QR Code scan failed. Error: ${error}`);
                //html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            };
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    }

    // function onScanSuccess(decodedText, decodedResult) {
    //     const encodedString = decodedText;
    //     const decodedString = decodeURIComponent(encodedString);
    //     const pairs = decodedString.split('&');
    //     const parsedData = {};
    //     pairs.forEach(pair => {
    //     const [key, value] = pair.split(':');
    //         parsedData[key] = value;
    //     });
    //     updatePageWithParsedData(parsedData);
    // }

    function updatePageWithParsedData(data) {
        const keyToLabelMapping = {
                                    event_name: 'Event Name',
                                    guestname: 'Guest Name',
                                    guest_contact: 'Guest Contact',
                                    guest_email: 'Guest Email',
                                    table_number: 'Table Number',
                                    associated_guests: 'Associated Guests',
                                    attendance: 'Attendance'
                                };
        document.getElementById("button-container").textContent = ''; 
        for (const key in keyToLabelMapping) {
            element = document.getElementById(key); 
            if(element){   
                element.textContent = ``;      
            }
        }

        let shouldAddSaveButton = false;                                          
        for (const key in data) {
            const element = document.getElementById(key);
            if (element && data[key].toString().trim() !== '') {
                const label = keyToLabelMapping[key];
                element.textContent = `${label}: ${data[key].toString().replace(/_/g, ' ').toLowerCase()}`;
                shouldAddSaveButton = true; 
            }
        }

        if (shouldAddSaveButton) {
            addSaveButton(data);
        }
    }

    function addSaveButton(parsedData) {
        const container = document.querySelector('#button-container'); // Change '#your-container-id' to the ID of your container
        if (!document.querySelector('#saveButton')) { // Check if the button does not already exist
            const saveButton = document.createElement('button');
            saveButton.id = 'saveButton';
            saveButton.textContent = 'Update Attendance';
            saveButton.onclick = function() {
            var qrdata = {
                        action: 'handle_qr_update', // The WP AJAX action hook name
                        nonce: event_guest_update_obj.nonce
                    };

                for (const key in parsedData) {
                    qrdata[key] = parsedData[key];
                }        
                $('#successmsg').html('');   
                $('#errormsg').html('');     
                $.ajax({
                    url: event_guest_update_obj.ajaxurl,
                    type: 'POST',
                    data: qrdata, // Assuming qrdata is an object with your AJAX call parameters
                    success: function(response) {
                        if(response.success){
                            $("#user-search-form").trigger('submit');
                            $('#successmsg').html('<div class="success"><p>'+response.data+'</p></div>');
                            setTimeout(function(){
                                $('#successmsg').html('');
                                $('#event_name').html('');
                                $('#guestname').html('');
                                $('#guest_contact').html('');
                                $('#guest_email').html('');
                                $('#table_number').html('');
                                $('#associated_guests').html('');
                                $('#attendance').html('');
                                
                                
                            },5000);
                        }else{
                            $('#errormsg').html('<div class="error"><p>'+response.data+'</p></div>');
                            setTimeout(function(){
                                $('#errormsg').html('');
                                $('#event_name').html('');
                                $('#guestname').html('');
                                $('#guest_contact').html('');
                                $('#guest_email').html('');
                                $('#table_number').html('');
                                $('#associated_guests').html('');
                                $('#attendance').html('');
                            },5000);
                        }
                        document.getElementById("button-container").textContent = ''; 
                    },
                    error: function(response) {
                        $('#errormsg').html('');
                        $('#event_name').html('');
                        $('#guestname').html('');
                        $('#guest_contact').html('');
                        $('#guest_email').html('');
                        $('#table_number').html('');
                        $('#associated_guests').html('');
                        $('#attendance').html('');
                        document.getElementById("button-container").textContent = ''; 
                    }
                });
            };
            container.appendChild(saveButton); // Append the button to the container
        }
    }

    // function onScanFailure(error) {
    //     console.error(`Code scan error = ${error}`);
    // }

    

});
