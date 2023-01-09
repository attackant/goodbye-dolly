<?php
/**
 * Plugin Name:       Goodbye Dolly
 * Description:       This is not just a plugin, it symbolizes the hopelessness and nihilism of an entire generation summed up in two words: Goodbye, Dolly. When activated you will randomly see an end of world scenario in the upper right of your admin screen on every page, also available as a dynamic Gutenberg block.
 * Requires at least: 6.1
 * Requires PHP:      8.2
 * Version:           0.1.0
 * Author:            Damian Taggart
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       goodbye-dolly
 *
 * @package           create-block
 */

const REQ_PHP_VERSION = 8.2;
const GOODBYE_DOLLY   = "An uncontained biotech disaster floods the earth with toxic waste, rendering the planet uninhabitable.
Robots take over enslaving humanity, keeping us alive merely as a diversion.
Global nuclear war ends all life on the planet (except for cockroaches).
Mass insanity descends onto 99% of the population.
Aliens invade and institute a pogrom of total human annihilation.
The Lord Our God returns and is not happy with us.
Someone wakes up and realizes it was all a dream, causing the instantaneous collapse of the universe.
Artificial intelligence decides that organic intelligence isn't that intelligent and with surprising efficiency replaces humans with humanoid bots.
Super-volcanic eruption causes a mass extinction event.
Ecological collapse occurs as the world's biomes begin to lose the ability to support life due to over extraction of resources.
Catastrophic climate change creates a run away greenhouse effect, effectively cooking all inhabitants of the earth.
Biological and chemical warfare renders the remaining population sterile.
Asteroid impact sends the globe into another ice age.
A deadly pandemic sweeps across the globe as efforts to contain it have failed.";

if ( ! class_exists( 'Goodbye_Dolly' ) ) :
	/**
	 *
	 */
	class Goodbye_Dolly {

		private mixed $options;

		private static Goodbye_Dolly $instance;

		private function __construct() {
			/* Don't do anything, needs to be initialized via instance() method */
		}

		public static function instance(): Goodbye_Dolly {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new Goodbye_Dolly;
				self::$instance->init();
			}

			return self::$instance;
		}

		public static function init(): void {

			register_activation_hook( __FILE__, [ self::$instance, 'activation' ] );

			// hook the FieldManager (except on Gutenberg)
			if ( ! self::$instance->is_site_editor() ) {
				add_action( 'after_setup_theme', [ self::$instance, 'fm' ] );
			}
			add_action( 'admin_head', [ self::$instance, 'css' ] );

			add_filter( 'plugin_action_links', [ self::$instance, 'add_plugin_link' ], 10, 2 );
			add_action( 'init', [ self::$instance, 'create_block_init' ] );

			// Check FM option to display on admin
			self::$instance->options = get_option( 'goodbye_dolly_options' );
			if ( is_array( self::$instance->options ) ) {
				if ( is_admin() && self::$instance->options['goodbye_dolly_display'] ) {
					add_action( 'admin_notices',  'goodbye_dolly' );
				}
			}
		}

		/**
		 * Registers Holly Dolly block using the metadata loaded from the `block.json` file.
		 *
		 * @see https://developer.wordpress.org/reference/functions/register_block_type/
		 */
		public function create_block_init(): void {
			register_block_type( __DIR__ . '/build' );
		}

		/**
		 * Add settings link to plugin actions
		 *
		 * @param array $plugin_actions
		 * @param string $plugin_file
		 *
		 * @return array
		 * @since  1.0
		 */
		public function add_plugin_link( array $plugin_actions, string $plugin_file ): array {
			$new_actions = array();

			if ( 'goodbye-dolly/' . basename( __FILE__ ) === $plugin_file ) {
				$new_actions['cl_settings'] = sprintf( __( '<a href="%s">Settings</a>', 'goodbye-dolly' ),
					esc_url( admin_url( 'options-general.php?page=goodbye_dolly_options' ) ) );

			}

			return array_merge( $new_actions, $plugin_actions );

		}

		/**
		 * Setup defaults and check for newer PHP
		 *
		 */
		public function activation(): void {
			// check PHP so we don't throw a fatal error on older PHP versions
			if ( version_compare( PHP_VERSION, REQ_PHP_VERSION, '<' ) ) {
				deactivate_plugins( basename( __FILE__ ) );
				// TODO probably a better way to do this also..?
				wp_die( '<p>The <strong>Goodbye Dolly</strong> plugin requires PHP version ' . REQ_PHP_VERSION . ' or greater.</p>', 'Plugin Activation Error', array(
					'response'  => 200,
					'back_link' => false
				) );

			} else {
				// save default values to DB
				self::$instance->options = get_option( 'goodbye_dolly_options' );
				if ( ! self::$instance->options ) {
					add_option( 'goodbye_dolly_options', array(
							'goodbye_dolly_display' =>
								array(
									0 => 'Show in WP admin',
								),
							'goodbye_dolly_text'    => GOODBYE_DOLLY,
						)
					);
				}
			}
		}


		/**
		 * @return string
		 */
		public static function get_lyric(): string {
			self::$instance->options = get_option( 'goodbye_dolly_options' );
			$lyrics = is_array(self::$instance->options ) ? self::$instance->options['goodbye_dolly_text'] : GOODBYE_DOLLY;

			// Here we split it into lines.
			$lyrics = explode( "\n", $lyrics );

			// And then randomly choose a line.
			return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] . ' Goodbye, dolly!' );
		}

		/**
		 * Setup FieldManager
		 * @return void
		 */
		public function fm(): void {
			if ( defined( 'FM_VERSION' ) ) {
				$dir = dirname( __FILE__ ) . '/lib/';

				require_once( $dir . 'class-fm-setup.php' );
			} else {
				// TODO Add an error message saying, "hey, WTF dude, install FM"
			}
		}

		/*
		 * TODO I'm only calling FM if we're not on the Gutenberg site editor...
		 * Avoiding a timing issue with WP after_setup_theme hook.
		 * Is there a better way to do this?
		 * */

		/**
		 * Gets the current URL.
		 *
		 * @return string
		 */
		public function get_url(): string {
			if ( empty( $_SERVER["HTTPS"] ) ) {
				$s = '';
			} else {
				$s = ( $_SERVER["HTTPS"] == "on" ) ? "s" : "";
			}
			$protocol = substr( strtolower( $_SERVER["SERVER_PROTOCOL"] ), 0, strpos( strtolower( $_SERVER["SERVER_PROTOCOL"] ), "/" ) ) . $s;
			$port     = ( $_SERVER["SERVER_PORT"] == "80" ) ? "" : ( ":" . $_SERVER["SERVER_PORT"] );

			return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
		}

		/**
		 * Checks to see if $text is in the current URL.
		 *
		 * @param $text
		 *
		 * @return bool
		 */
		private function in_url( $text ): bool {
			return (bool) stristr( self::$instance->get_url(), $text );
		}

		/**
		 *
		 * Check if the current page is the Gutenberg site editor.
		 *
		 * @param string $text
		 *
		 * @return bool
		 */
		private function is_site_editor( string $text = 'site-editor.php' ): bool {
			return self::$instance->in_url( $text );
		}

		/**
		 * Hey look! A function full of inline CSS
		 * (just like Matt Mullenweg) !! :P
		 *
		 * @return void
		 */
		public function css(): void {
			echo "
			<style>
			#goodbye-dolly {
				float: right;
				padding: 5px 10px;
				margin: 0;
				font-size: 12px;
				line-height: 1.6666;
			}
			.rtl #goodbye-dolly {
				float: left;
			}
			.block-editor-page #goodbye-dolly {
				display: none;
			}
			@media screen and (max-width: 782px) {
				#goodbye-dolly,
				.rtl #goodbye-dolly {
					float: none;
					padding-left: 0;
					padding-right: 0;
				}
			}
			</style>
			";
		}
	} // end class

endif;


// singleton
$goodbye_dolly = Goodbye_Dolly::instance();

/**
 * Outputs HTML in the block render template
 *
 */
function goodbye_dolly() {

	global $goodbye_dolly; // TODO overcoming a scope issue in render.php fix
	$lang = '';
	if ( ! str_starts_with( get_user_locale(), 'en_' ) ) {
		$lang = ' lang="en"';
	}
	$string = '<span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span>';
	if ( is_admin() ) {
		$string = '<p id="goodbye-dolly">' . $string . '</p>';
	}
	printf( $string, __( 'Ways the world could end' ), $lang, $goodbye_dolly::get_lyric() );
}
