jQuery(document).ready(function($) {
    $('.upgrade-store-notice-dismiss').on('click', function(){
        var dataJSON = {
            'action': 'prefix_upgrade_store_hide_admin_notice_ajax',
            'security': ajax_obj.security,
        };
    
        $.ajax({
            cache: false,
            type: "POST",
            url: ajax_obj.ajax_url,
            data: dataJSON,
            // beforeSend: function() {
            //     $('.some-class').addClass('loading');
            // },
            success: function( response ){
                console.log(response);
                // on success
                // code...
            },
            error: function( xhr, status, error ) {
                console.log( 'Status: ' + xhr.status );
                console.log( 'Error: ' + xhr.responseText );
            },
            complete: function() {
                $('.upgrade-store-notice').hide();
            }
        });
    });
    // change keyup keydown
    $('.upgrade-store-settings-wrapper').find('.tab-options').on('change', 'input, textarea, select', function (e) {
        ajax_settings_update($(this));
	});    
    $('.upgrade-store-settings-wrapper').find('.welcome-form').on('change', 'input, textarea, select', function (e) {
        welcome_settings_update($(this));
	});
    $(".upgrade-store-setting-unit").find("button.single-image-uploader-button").on("click", function(add){
        add.preventDefault();        
        var button = $(this);
        var imageUploader = wp.media({
            // 'title'     : 'Upload Image',
            // 'button'    : {
            //     'text'  : 'Set the image'
            // },
            library: {type: 'image'},
            'multiple'  : false
        });        
		imageUploader.on("open", function() {
			let selection = imageUploader.state().get('selection');
			let attachment = wp.media.attachment(button.closest('.image-uploader').find('input.imageId').val());
			selection.add(attachment ? [attachment] : []);
			/*
			let ids = []; // array of IDs of previously selected files. You're gonna build it dynamically
			ids.forEach(function(id) {
			  let attachment = wp.media.attachment(id);
			  selection.add(attachment ? [attachment] : []);
			}); // would be probably a good idea to check if it is indeed a non-empty array
			*/
		});
        imageUploader.on("select", function(){
            var image = imageUploader.state().get("selection").first().toJSON();
            var thumbnail = (image.sizes.thumbnail.url)?image.sizes.thumbnail.url:image.url;
            console.log(image);
			button.closest('.image-uploader').find('input.imageId').val(image.id);
			button.closest('.image-uploader').find('input.imageUrl').val(image.url);
			button.closest('.image-uploader').find('input.imageName').val(image.filename);
			button.closest('.image-uploader').find('.option-image').attr({'src':thumbnail, 'srcset': ''});
			button.closest('.image-uploader').find('.gallery').attr({'data-fancybox': 'gallery-' + (Math.floor(Math.random() * 1000) + 1), 'data-src':image.url});
            button.closest('.image-uploader').find('.file-name').addClass('with-close-button');
			ajax_settings_update(button);
        });        
        imageUploader.open();
    });
    $(".upgrade-store-setting-unit").find('.remove-image').on('click', function(e){
        e.preventDefault();
        var base = $(this).data('default');
        $(this).closest('.file-name').removeClass('with-close-button');
        $(this).closest('.image-uploader').find('input.imageId').val('');
        $(this).closest('.image-uploader').find('input.imageUrl').val('');
        $(this).closest('.image-uploader').find('input.imageName').val('');
        $(this).closest('.image-uploader').find('.option-image').attr({'src':base, 'srcset': '', 'data-src':''});
		$(this).closest('.image-uploader').find('.gallery').removeAttr('data-fancybox');
        ajax_settings_update($(this));
    });
    function ajax_settings_update(elem){
        // console.log(elem);
        var formData = new FormData(document.querySelector('form'));
        data = Object.fromEntries(formData); 
        var form_data = elem.closest('form').serialize();
        var option_name = elem.closest('form').find('.upgrade-store-option-name').val();        
        var dataJSON = {
            'action': 'prefix_upgrade_store_save_setting_data',
            'form': data,
            'option_name': option_name,
            'form_data': form_data,
            'security': ajax_obj.security,
        };
        $.ajax({
            cache: false,
            type: "POST",
            url: ajax_obj.ajax_url,
            data: dataJSON,
            // beforeSend: function() {
            //     $('.some-class').addClass('loading');
            // },
            success: function( response ){
                console.log(response);
                // on success
                // code...
            },
            error: function( xhr, status, error ) {
                console.log( 'Status: ' + xhr.status );
                console.log( 'Error: ' + xhr.responseText );
            },
            complete: function() {
                toastr.success("Settings Saved", "Successfully!", {
                    "closeButton": true,
                    "closeDuration": 1,
                    // "preventDuplicates": true,
                });
            }
        });
    }
    function welcome_settings_update(elem){
        // console.log(elem);
        var formData = new FormData(document.querySelector('form'));
        data = Object.fromEntries(formData); 
        var form_data = elem.closest('form').serialize();
        var option_name = elem.closest('form').find('.upgrade-store-option-name').val();        
        var dataJSON = {
            'action': 'prefix_upgrade_store_save_setting_data',
            'form': data,
            'option_name': option_name,
            'form_data': form_data,
            'security': ajax_obj.security,
        };
        $.ajax({
            cache: false,
            type: "POST",
            url: ajax_obj.ajax_url,
            data: dataJSON,
            // beforeSend: function() {
            //     $('.some-class').addClass('loading');
            // },
            success: function( response ){
                console.log(response);
                // on success
                // code...
            },
            error: function( xhr, status, error ) {
                console.log( 'Status: ' + xhr.status );
                console.log( 'Error: ' + xhr.responseText );
            },
            complete: function() {}
        });
    }
});