jQuery(document).ready(function($) {
	
	Fancybox.bind('[data-fancybox]', {
		// Your custom options
	}); 
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('.upgrade-store-woocommerce-embedded-root').find('.woocommerce-layout__header').addClass('is-scrolled');
		} else {
			$('.upgrade-store-woocommerce-embedded-root').find('.woocommerce-layout__header').removeClass('is-scrolled');
		}
	});
	$('.upgrade-store-tab-content-toggle').on('click', function(){
		$(this).closest('.tab-container').find('.group-content').slideToggle();
		// if ($(this).is(":checked")) {
		// 	$(this).closest('.tab-container').find('.content')
		// } else {
		// 	console.log('Close');
		// }
	});
	attachment_categories_row_visibility();
	quickview_categories_row_visibility();
	attachment_meta_file_con_visibility();
	function attachment_meta_file_con_visibility() {
		var result = $('#_upgrade_store_product_attachment_type').val();
		if (result == 'external') {
			$('._upgrade_store_product_attachment_internal_file_con').hide();
			$('._upgrade_store_product_attachment_external_file_con').show();
		} else {	
			$('._upgrade_store_product_attachment_internal_file_con').show();
			$('._upgrade_store_product_attachment_external_file_con').hide();		
		}
	}
	function attachment_categories_row_visibility(){
		var result = $('input.attachment_category_for:checked').val();
		if (result == 'specific') {
			$('.attachment_categories_row').show();
		} else {			
			$('.attachment_categories_row').hide();
		}
	}
	$('.attachment_category_for').on('click', function(){
		attachment_categories_row_visibility();
	});
	// $('.datetime-picker').datetimepicker({
	// 	allowTimes: ['10:00', '10:30'],
	// });
	function quickview_categories_row_visibility(){
		var result = $('input.quickview_category_for:checked').val();
		if (result == 'specific') {
			$('.quickview_categories_row').show();
		} else {			
			$('.quickview_categories_row').hide();
		}
	}
	$('.quickview_category_for').on('click', function(){
		quickview_categories_row_visibility();
	});

	$('#_upgrade_store_product_attachment_type').on('change', function(){
		attachment_meta_file_con_visibility();
	});
	$('.select2 > select').select2();

	$('.select2-icon > select').select2({
		templateSelection: formatText,
    	templateResult: formatText,
		minimumResultsForSearch: -1
	});
	function formatText (icon) {
		// return $('<span><i class="dashicons-before ' + $(icon.element).data('icon') + '"></i> ' + icon.text + '</span>');
		return $('<span class="select-wrap"><span class="icon-wrap"><i class="dashicons dashicons-before dashicons-' + $(icon.element).attr('value') + '"></i></span><span class="text-wrap">' + icon.text + '</span></span>');
	};
	$("button.single-file-uploader-button").on("click", function(add){
        add.preventDefault();
        var button = $(this);
        var fileUploader = wp.media({
            // 'title'     : 'Upload Image',
            // 'button'    : {
            //     'text'  : 'Set the file'
            // },
            'multiple'  : false
        });
		fileUploader.on("open", function() {
			let selection = fileUploader.state().get('selection');
			let attachment = wp.media.attachment(button.closest('.file-uploader').find('input.fileId').val());
			selection.add(attachment ? [attachment] : []);
			/*
			let ids = []; // array of IDs of previously selected files. You're gonna build it dynamically
			ids.forEach(function(id) {
			  let attachment = wp.media.attachment(id);
			  selection.add(attachment ? [attachment] : []);
			}); // would be probably a good idea to check if it is indeed a non-empty array
			*/
		});
        fileUploader.on("select", function(){
            var file = fileUploader.state().get("selection").first().toJSON();
			button.closest('.file-uploader').find('input.fileId').val(file.id);
			button.closest('.file-uploader').find('input.fileUrl').val(file.url);
			button.closest('.file-uploader').find('input.fileName').val(file.filename);

			button.closest('.file-uploader').find('.file-name').html('<a href="'+file.url+'" target="_blank">'+file.filename+'</a>');
			// console.log(file);
        });
        fileUploader.open();
    });
	
	$('.upgrade-store-settings-wrapper').find('p.submit').hide();
	$('.post-type-product-tab').find(".wp-heading-inline, .page-title-action").wrapAll('<div class="upgrade-store-title-wrap"></div>');
	var sale_price = $("#post").find('#_sale_price').val();
	if (sale_price) {
		var regular_price = $("#post").find('#_regular_price').val();
		var discount = (regular_price - sale_price) * 100 / regular_price;
		discount = discount.toFixed(2);
		var content = $("#post").find('#show-discount').data('content');
		$('#show-discount').html(content + ': ' +discount + '%');
		// console.log(discount);
	}
	$("#post").find('#_sale_price, #_regular_price').on('change', function(){
		var sale_price = $("#post").find('#_sale_price').val();
		var regular_price = $("#post").find('#_regular_price').val();
		var discount = (regular_price - sale_price) * 100 / regular_price;
		discount = discount.toFixed(2);
		var content = $("#post").find('#show-discount').data('content');
		$('#show-discount').html(content + ': ' +discount + '%');
	});
	//post
	$("#post").validate({
        submitHandler: function(form) {
            $(form).ajaxSubmit();
        },
        rules: {},
        messages: {}, 
		errorElement: "p",
		errorPlacement: function(error, element) {
			error.addClass( "text-danger" );
			element.parent( "div" ).addClass( "has-error" );
			error.insertAfter( element.parent( "div" ) );
		},
		
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( "div" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( "div" ).addClass( "has-success" ).removeClass( "has-error" );
		}       
    });

    $(".upgrade-store-meta-unit").find("button.single-image-uploader-button").on("click", function(add){
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
        });		
        imageUploader.open();
    });
    $(".upgrade-store-meta-unit").find('.remove-image').on('click', function(e){
        e.preventDefault();
        var base = $(this).data('default');
        $(this).closest('.file-name').removeClass('with-close-button');
        $(this).closest('.image-uploader').find('input.imageId').val('');
        $(this).closest('.image-uploader').find('input.imageUrl').val('');
        $(this).closest('.image-uploader').find('input.imageName').val('');
        $(this).closest('.image-uploader').find('.option-image').attr({'src':base, 'srcset': '', 'data-src':''});
		$(this).closest('.image-uploader').find('.gallery').removeAttr('data-fancybox');
    });

	// $.validator.addMethod(
	// 	"regex",
	// 	function(value, element, regexp) {
	// 	  var re = new RegExp(regexp);
	// 	  return this.optional(element) || re.test(value);
	// 	},
	// 	"Please check your input."
	// );	
	// $.validator.methods.checkEmail = function( value, element ) {
    //     return this.optional( element ) || /[a-z]+@[a-z]+\.[a-z]+/.test( value );
    // }
	if ($('#banner_enable_shop_page').is(":checked")) {		
		$('.sub-element-banner_enable_shop_page').removeClass('hidden');
	}
	else {
		$('.sub-element-banner_enable_shop_page').addClass('hidden');
	}
	if ($('#banner_enable_all_product_page').is(":checked")) {		
		$('.sub-element-banner_enable_all_product_page').removeClass('hidden');
	}
	else {
		$('.sub-element-banner_enable_all_product_page').addClass('hidden');
	}

	$('#banner_enable_shop_page').on('change', function(){
		if ($(this).is(":checked")) {
			$('.sub-element-banner_enable_shop_page').removeClass('hidden');
		} else {
			$('.sub-element-banner_enable_shop_page').addClass('hidden');
		}
	});
	$('#banner_enable_all_product_page').on('change', function(){
		if ($(this).is(":checked")) {
			$('.sub-element-banner_enable_all_product_page').removeClass('hidden');
		} else {
			$('.sub-element-banner_enable_all_product_page').addClass('hidden');
		}
	});
	$('.wc_input_stock').on('change', function(){
		var content = $('#show-stock').data('content');
		if ($('.wc_input_stock').val()) {
			$('#show-stock').html($('.wc_input_stock').val());
		} else {			
			$('#show-stock').html(content);
		}
	});
	$('#show-part-2').on('click', function(e){
		e.preventDefault();
		$('.part-1').addClass('hidden');
		$('.part-2').removeClass('hidden');
	});
	$('.back-link').on('click', function(e){
		e.preventDefault();
		$('.part-1').removeClass('hidden');
		$('.part-2').addClass('hidden');
	});	
	
	// $('#woocommerce-product-images').find('.add_product_images').append("<b>Appended text</b>");
	// $('#woocommerce-product-images').find('.add_product_images').after("<p>Appended text</p>");
});


