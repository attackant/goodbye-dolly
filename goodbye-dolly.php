<?php
/**
 * Plugin Name:       Goodbye Dolly
 * Description:       This is not just a plugin, it symbolizes the hopelessness and nihilism of an entire generation summed up in two words: Goodbye, Dolly. When activated you will randomly see an end of world scenario in the upper right of your admin screen on every page, also available as a dynamic Gutenberg block.
 * Requires at least: 6.1
 * Requires PHP:      8.0
 * Version:           0.1.0
 * Author:            Damian Taggart
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       goodbye-dolly
 *
 * @package           create-block
 */


const GOODBYE_DOLLY = "An uncontained biotech disaster floods the earth with toxic waste, rendering the planet uninhabitable.
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


/**
 * Setup defaults and check for newer PHP
 *
 * @return void
 */
function goodbye_dolly_options(): void {
	$version = 8.2;
	if ( version_compare( PHP_VERSION, $version, '<' ) ) {
		deactivate_plugins( basename( __FILE__ ) );
		wp_die( '<p>The <strong>Goodbye Dolly</strong> plugin requires PHP version ' . $version . ' or greater.</p>', 'Plugin Activation Error', array(
			'response'  => 200,
			'back_link' => true
		) );
	} else {
		$options = get_option( 'goodbye_dolly_options' );

		if ( ! $options ) {
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

register_activation_hook( __FILE__, 'goodbye_dolly_options' );

/**
 * Add settings link to plugin actions
 *
 * @param array $plugin_actions
 * @param string $plugin_file
 *
 * @return array
 * @since  1.0
 */
function goodbye_dolly_add_plugin_link( $plugin_actions, $plugin_file ): array {
	$new_actions                = array();
	$new_actions['cl_settings'] = sprintf( __( '<a href="%s">Settings</a>', 'goodbye-dolly' ),
		esc_url( admin_url( 'options-general.php?page=goodbye_dolly_options' ) ) );
	return array_merge( $new_actions, $plugin_actions );
}
add_filter( 'plugin_action_links', 'goodbye_dolly_add_plugin_link', 10, 2 );

/**
 * Registers Holly Dolly block using the metadata loaded from the `block.json` file.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_goodbye_dolly_block_init(): void {
	register_block_type( __DIR__ . '/build' );
}

add_action( 'init', 'create_block_goodbye_dolly_block_init' );

/**
 * @return string
 */
function goodbye_dolly_get_lyric(): string {
	$lyrics = get_option( 'goodbye_dolly_options' );
	$lyrics = is_array( $lyrics ) ? $lyrics['goodbye_dolly_text'] : GOODBYE_DOLLY;

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] . ' Goodbye, dolly!' );
}

/**
 * @return void
 */
function goodbye_dolly(): void {
	$chosen = goodbye_dolly_get_lyric();
	$lang   = '';
	if ( ! str_starts_with( get_user_locale(), 'en_' ) ) {
		$lang = ' lang="en"';
	}

	if ( is_admin() ) {
		printf(
			'<p id="goodbye-dolly"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
			__( 'Ways the world could end' ),
			$lang,
			$chosen
		);
	} else {
		printf(
			'<span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span>',
			__( 'Ways the world could end' ),
			$lang,
			$chosen
		);
	}
}

// Check fm option to display on admin
if ( is_admin() && get_option( 'goodbye_dolly_options' )['goodbye_dolly_display'] ) {
	add_action( 'admin_notices', 'goodbye_dolly' );
}


/**
 * Inline CSS (just like Mullenweg) !
 *
 * @return void
 */
function goodbye_dolly_css(): void {
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

add_action( 'admin_head', 'goodbye_dolly_css' );

/**
 * Setup FieldManager
 * @return void
 */
function goodbye_dolly_fm(): void {
	if ( defined( 'FM_VERSION' ) ) {
		$dir = dirname( __FILE__ ) . '/lib/';

		require_once( $dir . 'class-fm-setup.php' );
	} else {
		// Add an error message saying, "hey, WTF dude, install FM"
	}
}

// Only call the FM if we're not on the site editor
// There must be a better way to do this... Avoiding a timing
// issue with WP the after_setup_theme hook by using some functions
// I'd already written for another project

/**
 * Gets the current URL.
 *
 * @return string
 */
function goodbye_dolly_get_url() {
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
function goodbye_dolly_in_url( $text ) {
	if ( stristr( goodbye_dolly_get_url(), $text ) ) {
		return true;
	} else {
		return false;
	}
}

if ( ! function_exists( 'is_site_editor' ) ) {
	/**
	 * @param string $text
	 *
	 * @return bool
	 */
	function is_site_editor( string $text = 'site-editor.php' ): bool {
		return goodbye_dolly_in_url( $text );
	}
}

if ( ! is_site_editor() ) {
	add_action( 'after_setup_theme', 'goodbye_dolly_fm' );
}
