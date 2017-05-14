<?php 

class witty_support
{

	public $prop1 = "asda";

	public function __construct(){



	}

	public function get_template(){


		//return plugin_dir_url();
		//
		echo DIR;

	}

	public function witty_template( $type='root' ,$template, $vars = array(), $echo = true ) {
		
		$allowed_type = [ 'root', 'admin', 'public' ];

		if( !in_array( $type, $allowed_type) ):
			echo 'Invalid Type :-('; return false;
		endif;

		$path = DIR ."/$type/partials/$template.php";

		if ( file_exists( $path ) ):
	            
			extract( $vars );

			if( !$echo ):

				ob_start();

					include $path;

				return ob_get_clean();

			endif;

			include $path;
			
		endif;
	}


}