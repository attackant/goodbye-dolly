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

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
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
	/** These are the lyrics to Hello Dolly */
	$lyrics = "An uncontained biotech disaster floods the earth with toxic waste, rendering the planet uninhabitable.
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

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] . ' Goodbye, dolly!' );
}

/**
 * This just echoes the chosen line, we'll position it later.
 * @return void
 */
function goodbye_dolly(): void {
	$chosen = goodbye_dolly_get_lyric();
	$lang   = '';
	if ( ! str_starts_with( get_user_locale(), 'en_' ) ) {
		$lang = ' lang="en"';
	}

	if(is_admin()) {
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

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'goodbye_dolly' );

//
/**
 * We need some CSS to position the paragraph.
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
