<?php

/**
 *  Settings page
 */
if ( ! class_exists( 'Goodbye_Dolly_Settings' ) ) :

	class Goodbye_Dolly_Settings {

		private static $instance;

		private function __construct() {
			/* Don't do anything, needs to be initialized via instance() method */
		}

		public static function instance(): Goodbye_Dolly_Settings {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new Goodbye_Dolly_Settings;
				self::$instance->init();
			}

			return self::$instance;
		}

		/**
		 * @throws FM_Developer_Exception
		 */
		public function init(): void {

			$fm = new Fieldmanager_Group( false, array(
				'name'     => 'goodbye_dolly_options',
				'children' => array(
					'goodbye_dolly_display' => new Fieldmanager_Checkboxes( 'Goodbye Dolly Display', array(
						'options'       => array( 'Show in WP admin' ),
						'default_value' => 'checked'
					) ),
					'goodbye_dolly_text'    => new Fieldmanager_TextArea( 'Doomsday Scenarios (one per line)', array(
						'default_value' => GOODBYE_DOLLY,
						'attributes'    => array( 'style' => 'min-width:50%;min-height:400px' )
					) ),
				)
			) );

			$fm->add_submenu_page( 'options-general.php', 'Goodbye Dolly' );
		}
	}

	Goodbye_Dolly_Settings::instance();

endif;
