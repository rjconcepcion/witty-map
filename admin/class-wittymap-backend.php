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
		add_action( 'init',					[ $this, 'image_size' ] );		
		add_action( 'admin_menu', 			[ $this, 'wittymap_func' ] );
		add_action( 'witty_map_after_form',	[ $this, 'option_page_before_form' ] );
		add_action( 'admin_enqueue_scripts',[ $this, 'enqueue' ] );
		$this->load_supports();
	}

	/**
	 * Enqueue admin css and js
	 * @return void
	 */
	public function enqueue(){

		wp_enqueue_style(	'witty-map-admin', WITTY_DIR_URL . '/admin/css/witty-map-admin.css' );
		wp_enqueue_script(	'witty-map-admin', WITTY_DIR_URL . '/admin/js/witty-map-settings.js', [], '', true );
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
			[ $this, 'settings' ],
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

		foreach (self::_opt_list() as $opt_key):
			register_setting( 'witty-map-settings-group', $opt_key );
		endforeach;
	}

	/**
	 * Option Page Form
	 */
	public function settings(){
		$support = $this->support;

		do_settings_sections( 'witty-map-settings-group' );

		$key_value = [];
		foreach (self::_opt_list() as $opt_key):
			$key_value[ $opt_key ] = esc_attr( get_option( $opt_key ) );
		endforeach;
		$support->witty_template( 'admin', 'witty-map-option-page', $key_value );
	}

	/**
	 * option keys
	 */
	private function _opt_list(){

		return [
			'googlemapapi_key',
			'wittymap_loc',
			'wittymap_def_zoom',
			'wittymap_marker',
			'wittymap_draggable',
			'wittymap_doubleClickZoom',
			'wittymap_zoomControl',
			'wittymap_scrollWheel',
			'wittymap_streetView',
		];
	}

	/**
	 * Setting field
	 */
	public function option_page_before_form(){

		settings_fields( 'witty-map-settings-group' );
	}

	/**
	 * Witty Map Marker Default Size
	 */
	public function image_size(){

		add_image_size( 'witty-map-thumb', 100, 100, false );
	}

}
new witty_map_backend();