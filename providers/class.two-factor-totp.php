<?php

class Two_Factor_Totp extends Two_Factor_Provider {

	static function get_instance() {
		static $instance;
		$class = __CLASS__;
		if ( ! is_a( $instance, $class ) ) {
			$instance = new $class;
		}
		return $instance;
	}


	function get_label() {
		return _x( 'Time Based One-Time Password (Google Authenticator)', 'Provider Label', 'two-factor' );
	}

	function authentication_page( $user ) {
		require_once( ABSPATH .  '/wp-admin/includes/template.php' );
		submit_button( __( 'Go away.', 'two-factor' ) );
	}

	function validate_authentication( $user ) {
		return true;
	}

}
