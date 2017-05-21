<?php 

/**
 * Witty map front end
 *
 * @class       witty_map_public
 * @version     1
 * @package     wittyMap/Public
 * @author      Robert John Concepcion
 */
class witty_map_public
{
	/**
	 * Store witty plugin obj support
	 * @var Object
	 */
	public $support;

	public $gmap_api;

	public function __construct(){

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue' ] );
		$this->shortcodes();
		$this->load_supports();
		$this->gmap_api = esc_attr( get_option('googlemapapi_key') );
	}

	/**
	 * Enqueue files
	 */
	public function enqueue(){

		wp_enqueue_style(	'witty-map', WITTY_DIR_URL . '/public/css/witty-map-base.css' );
		wp_enqueue_script(	'googlemap-api', 'https://maps.googleapis.com/maps/api/js?key=' . $this->gmap_api, [], '', true );
		wp_enqueue_script(	'witty-map', WITTY_DIR_URL . '/public/js/googlemap.js', [], '', true );
		wp_localize_script( 'witty-map', 'wm', [ 
			'wittyMapLocation' => get_option('wittymap_loc'),
			'wittyDefaultZoom' => get_option('wittymap_def_zoom') ? get_option('wittymap_def_zoom') : 5,
			'wittyMapMarker'   => get_option( 'wittymap_marker' ), 
			'wittyMapDraggable'=> get_option( 'wittymap_draggable' ),
			'wittyDoubleClickZoom'=> get_option( 'wittymap_doubleClickZoom' ),
			'wittyMapZoomCtrl'=> get_option( 'wittymap_zoomControl' ),
			'wittyMapScrollWheel'=> get_option( 'wittymap_scrollWheel' ),
		] );
		
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
	 * Witty Shortcodes
	 * @return void
	 */
	public function shortcodes(){

		$shortcodes = [
			'witty-map' => [ $this, 'witty_map_render' ]
		];

		foreach ($shortcodes as $shortcode => $func):

			add_shortcode( $shortcode, $func );

		endforeach;
		
	}

	/**
	 * Show div#witty-map-wrap to append googlemap
	 * @return void
	 */
	public function witty_map_render(){

		$support = $this->support;

		return $this->support->witty_template( 'public', 'witty-map-wrap', [], false );

	}



}
new witty_map_public();