<?php
/**
 * SoSimple admin functions
 *
 * @package SoSimple
 */

class SoSimple {
	private $sosimple_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'sosimple_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'sosimple_page_init' ) );
	}

	public function sosimple_add_plugin_page() {
		add_theme_page(
			'SoSimple', // page_title
			'SoSimple', // menu_title
			'manage_options', // capability
			'sosimple', // menu_slug
			array( $this, 'sosimple_create_admin_page' ), // function
			'dashicons-admin-generic' // icon_url
		);
	}

	public function sosimple_create_admin_page() {
		$this->sosimple_options = get_option( 'sosimple_option_name' ); ?>

		<div class="wrap ss_options">
			<div class="ss_header">
				<div class="ss_header_left">
					<img src="<?php echo get_template_directory_uri(); ?>/lib/img/logo-white.png" alt="">

					<h1>SoSimple Theme Options</h1>
					<span>Basic Theme Options</span>
				</div>
				<div class="ss_header_right">
				<?php $sosimple_theme = wp_get_theme(); ?>
					<div class="version">
						<?php echo $sosimple_theme->get( 'Name' ) . " is version " . $sosimple_theme->get( 'Version' ); ?>
					</div>
					<div class="author">
						Author: <a href="<?php echo $sosimple_theme->get( 'AuthorURI' ); ?>">Fernando Villamor Jr</a>
					</div>
					<div class="theme_url">
						Web link: <a href="<?php echo $sosimple_theme->get( 'ThemeURI' ); ?>">SoSimple on wordpress.org</a>
					</div>
				</div>
				
			</div>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'sosimple_option_group' );
					do_settings_sections( 'sosimple-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function sosimple_page_init() {
		register_setting(
			'sosimple_option_group', // option_group
			'sosimple_option_name', // option_name
			array( $this, 'sosimple_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'sosimple_setting_section', // id
			'Settings', // title
			array( $this, 'sosimple_section_info' ), // callback
			'sosimple-admin' // page
		);

		add_settings_field(
			'excerpt_type_0', // id
			'Excerpt Type', // title
			array( $this, 'excerpt_type_0_callback' ), // callback
			'sosimple-admin', // page
			'sosimple_setting_section' // section
		);

		add_settings_field(
			'read_more_type_1', // id
			'Read More Type', // title
			array( $this, 'read_more_type_1_callback' ), // callback
			'sosimple-admin', // page
			'sosimple_setting_section' // section
		);

		add_settings_field(
			'read_more_button_style_2', // id
			'Read More Button Style', // title
			array( $this, 'read_more_button_style_2_callback' ), // callback
			'sosimple-admin', // page
			'sosimple_setting_section' // section
		);

		add_settings_field(
			'read_more_button_icon_3', // id
			'Read More Button Icon', // title
			array( $this, 'read_more_button_icon_3_callback' ), // callback
			'sosimple-admin', // page
			'sosimple_setting_section' // section
		);

		add_settings_field(
			'read_more_text_4', // id
			'Read More Text', // title
			array( $this, 'read_more_text_4_callback' ), // callback
			'sosimple-admin', // page
			'sosimple_setting_section' // section
		);

		add_settings_field(
			'button_background_color_5', // id
			'Button Background Color', // title
			array( $this, 'button_background_color_5_callback' ), // callback
			'sosimple-admin', // page
			'sosimple_setting_section' // section
		);

		add_settings_field(
			'button_text_color_6', // id
			'Button Text Color', // title
			array( $this, 'button_text_color_6_callback' ), // callback
			'sosimple-admin', // page
			'sosimple_setting_section' // section
		);
	}

	public function sosimple_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['excerpt_type_0'] ) ) {
			$sanitary_values['excerpt_type_0'] = $input['excerpt_type_0'];
		}

		if ( isset( $input['read_more_type_1'] ) ) {
			$sanitary_values['read_more_type_1'] = $input['read_more_type_1'];
		}

		if ( isset( $input['read_more_button_style_2'] ) ) {
			$sanitary_values['read_more_button_style_2'] = $input['read_more_button_style_2'];
		}

		if ( isset( $input['read_more_button_icon_3'] ) ) {
			$sanitary_values['read_more_button_icon_3'] = $input['read_more_button_icon_3'];
		}

		if ( isset( $input['read_more_text_4'] ) ) {
			$sanitary_values['read_more_text_4'] = sanitize_text_field( $input['read_more_text_4'] );
		}

		if ( isset( $input['button_background_color_5'] ) ) {
			$sanitary_values['button_background_color_5'] = sanitize_text_field( $input['button_background_color_5'] );
		}

		if ( isset( $input['button_text_color_6'] ) ) {
			$sanitary_values['button_text_color_6'] = sanitize_text_field( $input['button_text_color_6'] );
		}

		return $sanitary_values;
	}

	public function sosimple_section_info() {
		echo "<div class='ss_info'>";
		echo "Note: Additional options below 'Excerpt Type' does not work if you select 'Excerpt' in option 'Excerpt Type'";
		echo "<hr>";
		/*
		echo "Note 2a: Options in 'Read More Button Style','Read More Button Icon' will work if you do not select option ' Text + Button' or 'Text + Button + Icon' in 'Read More Type'";
		echo "<hr>";
		echo "Note 2b: Options in 'Read More Button Icon' will work if you do not select option 'Text + Button + Icon' in 'Read More Type'";
		echo "<hr>";
		echo "Note 2c: Options in 'Read More Text' will work if you do select option 'None' in 'Read More Type'";
		*/
		echo "</div>";
		
	}

	public function excerpt_type_0_callback() {
		?> <fieldset><?php $checked = ( isset( $this->sosimple_options['excerpt_type_0'] ) && $this->sosimple_options['excerpt_type_0'] === 'Option-one' ) ? 'checked' : '' ; ?>
		<label for="excerpt_type_0-0"><input type="radio" name="sosimple_option_name[excerpt_type_0]" id="excerpt_type_0-0" value="Option-one" <?php echo $checked; ?>> More tag</label><br>
		<?php $checked = ( isset( $this->sosimple_options['excerpt_type_0'] ) && $this->sosimple_options['excerpt_type_0'] === 'Option-second' ) ? 'checked' : '' ; ?>
		<label for="excerpt_type_0-1"><input type="radio" name="sosimple_option_name[excerpt_type_0]" id="excerpt_type_0-1" value="Option-second" <?php echo $checked; ?>> Excerpt</label></fieldset> <?php
	}

	public function read_more_type_1_callback() {
		?> <fieldset><?php $checked = ( isset( $this->sosimple_options['read_more_type_1'] ) && $this->sosimple_options['read_more_type_1'] === 'Option-one' ) ? 'checked' : '' ; ?>
		<label for="read_more_type_1-0"><input type="radio" name="sosimple_option_name[read_more_type_1]" id="read_more_type_1-0" value="Option-one" <?php echo $checked; ?>> None</label><br>
		<?php $checked = ( isset( $this->sosimple_options['read_more_type_1'] ) && $this->sosimple_options['read_more_type_1'] === 'Option-second' ) ? 'checked' : '' ; ?>
		<label for="read_more_type_1-1"><input type="radio" name="sosimple_option_name[read_more_type_1]" id="read_more_type_1-1" value="Option-second" <?php echo $checked; ?>> Text</label><br>
		<?php $checked = ( isset( $this->sosimple_options['read_more_type_1'] ) && $this->sosimple_options['read_more_type_1'] === 'Option-third' ) ? 'checked' : '' ; ?>
		<label for="read_more_type_1-2"><input type="radio" name="sosimple_option_name[read_more_type_1]" id="read_more_type_1-2" value="Option-third" <?php echo $checked; ?>> Text + Button</label><br>
		<?php $checked = ( isset( $this->sosimple_options['read_more_type_1'] ) && $this->sosimple_options['read_more_type_1'] === 'Option-fourth' ) ? 'checked' : '' ; ?>
		<label for="read_more_type_1-3"><input type="radio" name="sosimple_option_name[read_more_type_1]" id="read_more_type_1-3" value="Option-fourth" <?php echo $checked; ?>> Text + Button + Icon </label></fieldset> <?php
	}

	public function read_more_button_style_2_callback() {
		?> <fieldset><?php $checked = ( isset( $this->sosimple_options['read_more_button_style_2'] ) && $this->sosimple_options['read_more_button_style_2'] === 'Option-one' ) ? 'checked' : '' ; ?>
		<label for="read_more_button_style_2-0"><input type="radio" name="sosimple_option_name[read_more_button_style_2]" id="read_more_button_style_2-0" value="Option-one" <?php echo $checked; ?>> Sharp Edges</label><br>
		<?php $checked = ( isset( $this->sosimple_options['read_more_button_style_2'] ) && $this->sosimple_options['read_more_button_style_2'] === 'Option-second' ) ? 'checked' : '' ; ?>
		<label for="read_more_button_style_2-1"><input type="radio" name="sosimple_option_name[read_more_button_style_2]" id="read_more_button_style_2-1" value="Option-second" <?php echo $checked; ?>> Rounded Edges</label></fieldset> <?php
	}

	public function read_more_button_icon_3_callback() {
		?> <fieldset><?php $checked = ( isset( $this->sosimple_options['read_more_button_icon_3'] ) && $this->sosimple_options['read_more_button_icon_3'] === 'Option-one' ) ? 'checked' : '' ; ?>
		<label for="read_more_button_icon_3-0"><input type="radio" name="sosimple_option_name[read_more_button_icon_3]" id="read_more_button_icon_3-0" value="Option-one" <?php echo $checked; ?>> SoSimple (built-in)</label><br>
		<?php $checked = ( isset( $this->sosimple_options['read_more_button_icon_3'] ) && $this->sosimple_options['read_more_button_icon_3'] === 'Option-second' ) ? 'checked' : '' ; ?>
		<label for="read_more_button_icon_3-1"><input type="radio" name="sosimple_option_name[read_more_button_icon_3]" id="read_more_button_icon_3-1" value="Option-second" <?php echo $checked; ?>> Triangle Icon</label><br>
		<?php $checked = ( isset( $this->sosimple_options['read_more_button_icon_3'] ) && $this->sosimple_options['read_more_button_icon_3'] === 'Option-third' ) ? 'checked' : '' ; ?>
		<label for="read_more_button_icon_3-2"><input type="radio" name="sosimple_option_name[read_more_button_icon_3]" id="read_more_button_icon_3-2" value="Option-third" <?php echo $checked; ?>> Check Icon</label></fieldset> <?php
	}

	public function read_more_text_4_callback() {
		printf(
			'<input class="regular-text" type="text" name="sosimple_option_name[read_more_text_4]" id="read_more_text_4" value="%s">',
			isset( $this->sosimple_options['read_more_text_4'] ) ? esc_attr( $this->sosimple_options['read_more_text_4']) : ''
		);
	}

	public function button_background_color_5_callback() {
		printf(
			'<input class="color-picker" type="text" name="sosimple_option_name[button_background_color_5]" id="button_background_color_5" value="%s">',
			isset( $this->sosimple_options['button_background_color_5'] ) ? esc_attr( $this->sosimple_options['button_background_color_5']) : ''
		);
	}

	public function button_text_color_6_callback() {
		printf(
			'<input class="color-picker" type="text" name="sosimple_option_name[button_text_color_6]" id="button_text_color_6" value="%s">',
			isset( $this->sosimple_options['button_text_color_6'] ) ? esc_attr( $this->sosimple_options['button_text_color_6']) : ''
		);
	}

}
if ( is_admin() )
	$sosimple = new SoSimple();

/* 
 * Retrieve this value with:
 * $sosimple_options = get_option( 'sosimple_option_name' ); // Array of All Options
 * $excerpt_type_0 = $sosimple_options['excerpt_type_0']; // Excerpt Type
 * $read_more_type_1 = $sosimple_options['read_more_type_1']; // Read More Type
 * $read_more_button_style_2 = $sosimple_options['read_more_button_style_2']; // Read More Button Style
 * $read_more_button_icon_3 = $sosimple_options['read_more_button_icon_3']; // Read More Button Icon
 * $read_more_text_4 = $sosimple_options['read_more_text_4']; // Read More Text
 * $button_background_color_5 = $sosimple_options['button_background_color_5']; // Button Background Color
 * $button_text_color_6 = $sosimple_options['button_text_color_6']; // Button Text Color
 */
 ?>