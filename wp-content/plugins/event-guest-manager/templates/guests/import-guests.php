<style>
    form#import-form input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 15px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

</style>
<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <p class="error"></p>
    <p class="success"></p>

    <form id="import-form" method="post" enctype="multipart/form-data">
        <input type="file" name="excel_file" id="excel_file" accept=".xls,.xlsx" />
        <p class="progress"></p>
        <input type="submit" value="Import Excel File" />
    </form>
    <br>
    <a href="<?php echo site_url('wp-content/uploads/guests_excel_directory/Vineet-Guests-Lists.xlsx')?>" target="__blank">Guests Sample File</a>
    <!-- <div id="import-progress">
        <p>Total Records: <span id="total-records">0</span></p>
        <p>Imported Records: <span id="imported-records">0</span></p>
    </div> -->
</div>

<script type="text/javascript">
    document.getElementById('import-form').onsubmit = function(e) {
        
        jQuery('.progress').html('Processing ...');
        jQuery('.error').html('');
        jQuery('.success').html('');
        var fileInput = document.getElementById('excel_file');
        if (!fileInput.files.length) {
            e.preventDefault();
            jQuery('.error').html('Please select a file to import.');
            setTimeout(function(){ jQuery('.error').html(''); }, 2000);
            jQuery('.progress').html('');
            return false;
        }
        e.preventDefault();
        var formData = new FormData();
        formData.append('action', 'event_import_action');
        formData.append('security', '<?php echo wp_create_nonce("event_secure_nonce"); ?>');
        var fileInput = document.getElementById('excel_file');
        if (fileInput && fileInput.files.length > 0) {
            formData.append('file', fileInput.files[0]);
        }

        var ajaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
        jQuery.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: formData,
            contentType: false, // Don't set any content type header
            processData: false, // Don't process the files
            success: function(response) {
                jQuery('.progress').html('');
                jQuery('#import-form')[0].reset();
                if(response.success){
                    
                    jQuery('.success').html(response.data.message);
                }else{
                    jQuery('.error').html(response.data.message);
                }
            },
            error: function(response) {
                jQuery('.progress').html('');
                jQuery('#import-form')[0].reset();
                jQuery('.error').html(response.data.message);
            }
        });
        // updateProgress(); // Initial call to start the progress update
        // // Function to update progress, if necessary
        // function updateProgress() {
        //     jQuery.get(ajaxUrl, { action: 'check_import_progress' }, function(response) {
        //         var data = JSON.parse(response);
        //         jQuery('#total-records').text(data.total);
        //         jQuery('#imported-records').text(data.imported);
        //         alert(data.total);
        //         alert(data.imported);
        //         if(data.imported < data.total) {
        //             setTimeout(updateProgress, 1000); // Update every second
        //         }
        //     });
        // }
        
    };
</script>

