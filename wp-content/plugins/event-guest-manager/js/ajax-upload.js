jQuery(document).ready(function($) {
    $('#event-upload-form').submit(function(e) {
        e.preventDefault();
		$('#loader-overlay').show();
        $('#successmsg').html('');
        var formData = new FormData(this);
        formData.append('action', 'event_handle_upload');
        formData.append('nonce', event_ajax_obj.nonce);

        $.ajax({
            url: event_ajax_obj.ajaxurl,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
				$('#loader-overlay').hide();
                jQuery("#event-upload-form").get(0).reset();
                if(response.success){
                    $('#successmsg').html('<div class="success"><p>'+response.data+'</p></div>');
                    setTimeout(function(){
                        $('#successmsg').html('');
                    },5000);
                }else{
                    $('#successmsg').html('<div class="error"><p>'+response.data+'</p></div>');
                    setTimeout(function(){
                        $('#successmsg').html('');
                    },5000);
                }                
            },
            error: function(response) {
				$('#loader-overlay').hide();
                $('#successmsg').html('<div class="error"><p>'+response.data+'</p></div>');
                setTimeout(function(){
                    $('#successmsg').html('');
                },5000);
            }
        });
    });
});
