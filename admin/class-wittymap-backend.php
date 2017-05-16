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

		add_action( 'admin_menu', [ $this, 'wittymap_func' ] );
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
		add_action( 'admin_init', [ $this, 'register_my_cool_plugin_settings'] );
	}

	/**
	 * Registering Option.
	 */
	public function register_my_cool_plugin_settings() {

		register_setting( 'witty-map-settings-group', 'googlemapapi_key' );
		register_setting( 'witty-map-settings-group', 'map_location' );
		register_setting( 'witty-map-settings-group', 'zoom_level' );
	}

	/**
	 * Option Page Form
	 */
	public function test1(){

		$support = $this->support;

		echo $support->witty_template( 'admin', 'test');
	}

}
new witty_map_backend();