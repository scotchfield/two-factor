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

	protected function __construct() {
		add_action( 'admin_init', array( $this, 'maybe_register_settings' ) );
		return $this;
	}

	function maybe_register_settings() {
		$provider = Two_Factor_Core::get_instance()->get_provider_for_user();
		if ( is_a( $provider, __CLASS__ ) ) {
			register_setting(
				'two-factor',
				'two_factor_totp_setting_one',
				'sanitize_text_field'
			);

			add_settings_field(
				'two_factor_totp_setting_one',
				__( 'TOTP Setting One', 'two-factor' ),
				array( $this, 'render_setting_one' ),
				'two-factor',
				'two-factor-auth-settings'
			);
		}
	}

	function render_setting_one() {
		?>
		<input type="text" name="two_factor_totp_setting_one" value="<?php echo esc_attr( get_option( 'two_factor_totp_setting_one' ) ); ?>" />
		<?php
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
