<?php 
/*
Plugin Name: Witty Map
*/


class witty_map {

	static function install() {

	
	}

}

register_activation_hook( __FILE__, array( 'witty_map', 'install' ) );