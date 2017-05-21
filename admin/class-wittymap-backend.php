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
			100
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

		foreach (self::_opt_list() as $opt_key => $opt_arry):
			register_setting( 'witty-map-settings-group', $opt_key );
		endforeach;
	}

	/**
	 * Option Page Form
	 */
	public function settings(){
		$support = $this->support;

		do_settings_sections( 'witty-map-settings-group' );

		$key_value = self::_opt_list();
		foreach ($key_value as $opt_key => $opt_arry):
			$key_value[ $opt_key ]['value'] = esc_attr( get_option( $opt_key ) );
		endforeach;
		$support->witty_template( 'admin', 'witty-map-option-page', [ 'opt_arr' => $key_value ] );
	}

	/**
	 * Option page field declaration
	 */
	private function _opt_list(){		

		return [
			'googlemapapi_key'			=> [
				'template_name' =>	"witty-field-common",
				'type'			=>	"text",
				'label'			=>	"Google map api key",
				'desc'			=>	"Witty map plugin required <a href='https://developers.google.com/maps/documentation/javascript/get-api-key' target='_blank'>google map api key</a>.",
				'attrb'			=>	[
					'id'    =>  'googlemapapi-key',
					'class' =>  'regular-text'
				],
			],
			'wittymap_loc'				=> [
				'template_name' =>	"witty-field-common",
				'type'			=>	"text",
                'label'			=>	"Map Center",
                'desc'			=>	"Set Center of the map.",
                'attrb' =>  [
                    'id'    =>  'wittymap-center',
                    'class' =>  'regular-text'
                ],                
			],
			'wittymap_def_zoom'			=> [
				'template_name' =>	"witty-field-common",
				'type'			=>	"number",
                'label'			=>	"Default Map Zoom",
                'desc'			=>	"Zoom level of the map (the bigger the number the zoom it be). <b>default value : 5, max value : 18</b>",
                'attrb' =>  [
                    'id'    =>  'wittymap-center',
                    'class' =>  'regular-text'
                ],                		
			],
			'wittymap_marker'			=> [
				'template_name' =>	"witty-field-imgbox",
				'type'			=>	"",
				'label'			=>	"Map Pointer",
				'desc'			=>	"Use image as marker of the map.",
			],
			'wittymap_draggable'		=> [
				'template_name'	=>	"witty-field-checkbox",
				'type'			=>	"",		
				'label'			=>	"Draggable",
				'desc'			=>	"Map can be drag to check other parts of the map.",	
			],
			'wittymap_doubleClickZoom'	=> [
				'template_name'	=>	"witty-field-checkbox",
				'type'			=>	"",
				'label'			=>	"Double click will zoom",
				'desc'			=>	"Enables/disables zoom and center on double click.",
			],
			'wittymap_zoomControl'		=> [
				'template_name'	=>	"witty-field-checkbox",
				'type'			=>	"",
				'label'			=>	"Zoom Control",
				'desc'			=>	"Located at right bottom of the map.",
			],
			'wittymap_scrollWheel'		=> [
				'template_name'	=>	"witty-field-checkbox",
				'type'			=>	"",
				'label'			=>	"Scroll Wheel",
				'desc'			=>	"If checked, disables scrollwheel zooming on the map.",
			],
			'wittymap_streetView'		=> [
				'template_name'	=>	"witty-field-checkbox",
				'type'			=>	"",
				'label'			=>	"Street View Control",
				'desc'			=>	"Located at right bottom of the map",
			],
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