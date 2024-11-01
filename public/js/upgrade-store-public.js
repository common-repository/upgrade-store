jQuery(document).ready(function($) {   
	Fancybox.bind('[data-fancybox]', {
		// Your custom options
	}); 
	$('body').on('click', '.quickview-gallery-image', function(){
		var src = $(this).data('src');
		var srcset =$(this).attr('srcset');
		// console.log(src);
		// console.log(srcset);
		// console.log('clicked');
		$(this).closest('.woocommerce-product-gallery').find('.quickview-feature-image').attr({'src':src, 'srcset':srcset});//{attribute:value, attribute:value,...}
		$(this).closest('.woocommerce-product-gallery').find('.zoomImg').attr('src',src);
		$(this).closest('li').addClass('active').siblings('li').removeClass('active');
	}); 

	// countDown
	$('time').countDown({
		with_separators: true,	
	});
	$('.count-down').countDown({
		css_class: 'countdown-alt-1',	
        label_dd: 'days',
        label_hh: 'hours',
        label_mm: 'min',
        label_ss: 'secs',
	});
	$('.alt-2').countDown({
		css_class: 'countdown-alt-2'
	});
	
});

