<?php 

/**
 * Witty map admin control / backend
 *
 * @class       witty_map_backend
 * @version     1
 * @package     wittyMap/admin
 * @author      Robert John Concepcion
 */
class witty_map_backend
{
	/**
	 * Store witty plugin obj support
	 * @var Object
	 */
	public $support;

	function __construct(){

		add_action( 'init', 				'wp_enqueue_media' );
		add_action( 'admin_menu', 			[ $this, 'wittymap_func' ] );
		add_action( 'witty_map_after_form', [ $this, 'option_page_before_form' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue' ]);
		$this->load_supports();
	}

	/**
	 * Helper 
	 */
	public function load_supports()
	{
		
		require_once WITTY_DIR_INC . '/class-witty-support.php';
		$this->support = new witty_support();
	}

	public function enqueue()
	{

		wp_enqueue_style( 'witty-map-admin', WITTY_DIR_URL . 'admin/css/witty-map-admin.css' );

	}

	/**
	 * Add menu in admin menu
	 * @return void
	 */
	public function wittymap_func(){

		add_menu_page( 
			'Map Settings',
			'Witty Map',
			'manage_options',
			'witty-map-settings',
			[ $this, 'test1' ],
			'dashicons-flag',
			8
		);

		/**
		 * Will not continue if admin menu was not successfully create
		 */
		add_action( 'admin_init', [ $this, 'register_options'] );
	}

	/**
	 * Registering Option.
	 */
	public function register_options() {

		register_setting( 'witty-map-settings-group', 'googlemapapi_key' );
		register_setting( 'witty-map-settings-group', 'wittymap_loc' );
		register_setting( 'witty-map-settings-group', 'wittymap_def_zoom' );

		register_setting( 'witty-map-settings-group', 'img-pointers' );
		
	}

	/**
	 * Option Page Form
	 */
	public function test1(){

		do_settings_sections( 'witty-map-settings-group' );

		$support = $this->support;

		$support->witty_template( 'admin', 'witty-map-option-page', [
			"googlemap_api"			=>	esc_attr( get_option('googlemapapi_key') ),
			"wittymap_loc"			=>	get_option( 'wittymap_loc' ),
			"wittymap_def_zoom"		=>	get_option( 'wittymap_def_zoom' ),
		] );

	}

	/**
	 * Setting field
	 */
	public function option_page_before_form(){

		settings_fields( 'witty-map-settings-group' );
	}

}
new witty_map_backend();