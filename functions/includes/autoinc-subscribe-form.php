<?php

add_shortcode( 'newsform', 'newsletter_form' );
function newsletter_form( $params = array() ) {
// default parameters
	extract( shortcode_atts( array(
		'buttontext' => 'SIGN UP',
	), $params ) );

	/**
	 *
	 * Need to tell IDE that these variables do exist
	 *
	 * @var string $buttontext
	 */

	$res = '<div class="newsletter-form">
				<div class="grid-x">
					<div class="cell auto"><input type="email" class="address"/> </div>
					<div class="cell shrink">
					<button class="newsletter-submit g-recapture" data-callback="onSubmit" data-sitekey="'.get_field('google_recapture_site_key','option').'" data-post_id="' . get_the_ID() . '">' . $buttontext . '</button>
					</div>
				</div>
			</div><div id="emplacementRecaptcha"></div>';

	return $res;
}

wp_enqueue_script( 'newsform-script', get_template_directory_uri() . '/assets/scripts/newsform.js', array( 'jquery' ), null, true );
wp_enqueue_script( 'google-recapture-api','https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit', array('newsform-script'), null, true );

// set variables for script
wp_localize_script( 'newsform-script', 'newsform_settings', array(
	'ajaxurl'    => admin_url( 'admin-ajax.php' ),
	'security'  => wp_create_nonce( 'newsform-security-nonce' )
) );

add_action( 'wp_ajax_nopriv_newsform_address_submit', 'newsform_address_submit' );
add_action( 'wp_ajax_newsform_address_submit', 'newsform_address_submit' );

function newsform_address_submit() {
	checkNewsSecure();
	$return = array('message' => 'Thank you for subscribing!','ID' => 1);
	$email = $_POST['address'];
	$nPostID = $_POST['post_id'];
	$nDate = date("d/m/Y H:i:s");
	$nLink = get_permalink($nPostID);

	$nMailTo = get_field('send_submissions_to','option');
	$subject = get_field('newsletter_subject_line','option');
	$from = get_field('newsletter_from_address','option');

	if($email) {
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$row = array(
				'email_address' => $email,
				'date_added' => $nDate,
				'page_used_for_submission' => $nLink
			);
			add_row('news_submissions',$row,'option');
			if(($nMailTo!='')&&(filter_var($nMailTo, FILTER_VALIDATE_EMAIL))) {
				if($subject == '') $subject = 'Newsletter Subscription form submission from your website';
				//error_log($subject);
				if($from == '') $from = 'edward@technicks.com';
				$headers = array('Content-Type: text/html; charset=UTF-8','From: '.$from);
				$body = 'Email Address: '.$email.' submitted at: '.$nDate.' from page: '.$nLink;
				wp_mail($nMailTo,$subject,$body,$headers);
			}
			wp_send_json_success($return);
		} else {
			wp_send_json_error( 'Invalid email address.' );
		}
	} else {
		wp_send_json_error( 'No email address submitted.' );
	}


	wp_die();
	/*echo 'Thank you for subscribing!';
	exit;*/
}

function checkNewsSecure() {
	if ( ! check_ajax_referer( 'newsform-security-nonce', 'security' ) ) {
		wp_send_json_error( 'Invalid security token sent.' );
		wp_die();
	}
}

// add async and defer attributes to enqueued scripts
function shapeSpace_script_loader_tag($tag, $handle) {

	if ($handle === 'google-recapture-api') {
		if (false === stripos($tag, 'async')) {
			$tag = str_replace(' src', ' async="async" src', $tag);
		}
		if (false === stripos($tag, 'defer')) {
			$tag = str_replace('<script ', '<script defer ', $tag);
		}
	}
	return $tag;

}
add_filter('script_loader_tag', 'shapeSpace_script_loader_tag', 10, 2);
