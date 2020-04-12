var onloadCallback = function(){
    grecaptcha.render("emplacementRecaptcha",{
        "sitekey": jQuery('.newsletter-form .newsletter-submit').data('sitekey'),
        //"sitekey": '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI',
        "badge": "inline",
        "type": "image",
        "size": "invisible",
        "callback": onSubmit
    });
};

var onSubmit = function(token) {

    //window.console.log('Ok - onSubmit');
    let $button = jQuery( '.newsletter-form .newsletter-submit' );
    let $address = jQuery('.newsletter-form .address')

    let buttonText = $button.text();
    $button.text('...');

    // set ajax data
    let data = {
        'action' : 'newsform_address_submit',
        'post_id': $button.data( 'post_id' ),
        'address' : $address.val(),
        'security' : newsform_settings.security
    };

    jQuery.post( newsform_settings.ajaxurl, data, function( response ) {

        //window.console.log(response);
        if(response.success) {
            $button.width( $button.width() ).text('SUBSCRIBED');
            $button.prop('disabled',true);
            $address.prop('disabled',true);
        } else {
            $button.text(buttonText);
            $button.disabled = false;
            $button.prop('disabled',false);
            $button.removeAttr('disabled');
            grecaptcha.reset();
            alert(response.data);
        }
    } );
};

jQuery(document).ready(function ($) {

    $( '.newsletter-form' ).on( 'click', '.newsletter-submit', function( event ) {
        grecaptcha.execute();
    });

    /*$( '.newsletter-form' ).on( 'click', '.newsletter-submit', function( event ) {

        var $button = $( this );

        $button.width( $button.width() ).text('...');
        $button.prop('disabled',true);

        // set ajax data
        var data = {
            'action' : 'newsform_address_submit',
            'post_id': $button.data( 'post_id' ),
            'address' : $( '.address' ).val(),
            'security' : newsform_settings.security
        };

        $.post( newsform_settings.ajaxurl, data, function( response ) {

            window.console.log(response);
            //let resO = JSON.parse(response);
            if(response.success) {
                $button.width( $button.width() ).text('SUBSCRIBED');
                $button.resize();
            }
        } );

    } );*/

});