<?php

$nggNivoSliderAdmin = new NGG_NivoSlider_Admin();

class NGG_NivoSlider_Admin {

	public function __construct() {
		add_option( 'ngg_nivoslider_theme', 'default' );
		add_action( 'admin_menu', array( $this, 'options_menu' ) );
		add_action( 'admin_init', array( $this, 'options_init' ) );
	}

	function options_menu() {
		add_submenu_page(
				'nextgen-gallery',
				'Nivo Slider Settings',
				'Nivo Slider',
				'manage_options',
				__FILE__,
				array( $this, 'display_page' ) );
	}

	function display_page() {
		?>

		<div class="wrap">

			<?php screen_icon(); ?>

			<h2>NextGen NivoSlider</h2>
			<p>Customize your nivo slider.</p>

			<form method="post" action="options.php">
				<?php

		do_settings_sections( 'ngg_nivoslider_settings' );
		settings_fields( 'ngg_nivoslider_settings_group' );
		submit_button();

				?>
			</form>
		</div>
		<?php
	}

	function options_init() {
		add_settings_section(
				'ngg_nivoslider_theme_settings',
				'NivoSlider Theme',
				array( $this, 'section_callback' ),
				'ngg_nivoslider_settings' );

		add_settings_field(
				'ngg_nivoslider_theme',
				'Current theme',
				array( $this, 'get_nivo_themes' ),
				'ngg_nivoslider_settings',
				'ngg_nivoslider_theme_settings' );

		register_setting(
				'ngg_nivoslider_settings_group',
				'ngg_nivoslider_theme' );
	}

	function section_callback() {
		echo ( 'Pick the theme to be used for your Nivo Slider.' );
	}

	public function get_nivo_themes() {
		$return = "\n<select id=\"ngg_nivoslider_theme\" name=\"ngg_nivoslider_theme\">\n";
		$selected = get_option( 'ngg_nivoslider_theme' );
		//$path = dirname( plugin_dir_path( __FILE__ ) ) . '/themes';
		$path = WPNGG_NIVOSLIDER_PLUGIN_DIR . '/themes';
		foreach ( new DirectoryIterator( $path ) as $folder ) {
			if ( !$folder->isDot() && $folder->getFilename() ) {
				$return .= '<option ';
				if ( $folder->getFilename() == $selected ) {
					$return .= 'selected';
				}
				$return .= " value=\"" . $folder->getFilename() . "\">"
						. ucfirst( $folder->getFilename() ) . "</option>\n";
			}
		}

		$return .= '</select>';

		echo $return;
	}
}
