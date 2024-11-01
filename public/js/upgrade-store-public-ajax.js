jQuery(document).ready(function($) {
    
	$( ".quickview-opener" ).on( "click", function() {
        var _this =  $(this);
        var content = $(this).html();
        var dataJSON = {
            'action': 'prefix_upgrade_store_get_product_details',
            'product_id': $(this).data('product_id'),
            'security': ajax_obj.security,
        };
    
        $.ajax({
            cache: false,
            type: "POST",
            url: ajax_obj.ajax_url,
            data: dataJSON,
            beforeSend: function() {
                _this.html('Loading...');
            },
            success: function( response ){
                data = $.parseJSON(response);
                if(data.success){
                    $( ".quickview-dialog" ).html(data.html);
                    $( ".quickview-dialog" ).modal({
                        // fadeDuration: 1000,
                        // fadeDelay: 0.50
                    });
                    $('.zoom-image').zoom();
                }
            },
            error: function( xhr, status, error ) {
                console.log( 'Status: ' + xhr.status );
                console.log( 'Error: ' + xhr.responseText );
            },
            complete: function() {
                _this.html(content);
            }
        });
		
	});
    
});