<?php

$ram108_fancybox = new ram108_fancybox;

class ram108_fancybox{

	private $options;

	function __construct(){
		$this->options = &$GLOBALS['ram108_fbalbum_settings']; 

		add_action('wp_enqueue_scripts', array( $this, '_register_scripts') );
		add_action('wp_head', array( $this, '_add_script') );
	}

	function _register_scripts(){

		// MAIN
		wp_enqueue_style( 'fancybox', plugins_url('fancybox/jquery.fancybox-1.3.6.css', __FILE__) ); 
		wp_enqueue_script( 'fancybox', plugins_url('fancybox/jquery.fancybox-1.3.6.min.js', __FILE__), array('jquery') ); 

		// PLUGINS
		wp_enqueue_script( 'jquery-mousewheel', plugins_url('jquery.mousewheel.js', __FILE__), array('jquery') ); 
		wp_enqueue_script( 'jquery-easing', plugins_url('jquery.easing.js', __FILE__), array('jquery') ); 
	}

	function _add_script(){ ?>
		<!-- [ram108] activate fancybox -->
		<script type="text/javascript">jQuery(document).ready(function($){
			$('.ram108_fbimage > a, .fancybox').fancybox({
				'transitionIn':'elastic','easingIn':'easeOutBack','transitionOut':'elastic','easingOut':'easeInBack','opacity':false,'hideOnContentClick':false,'titleShow':true,'titleFromAlt':true,'showNavArrows':true,'enableKeyboardNav':true,
				'titlePosition':'over','centerOnScroll':true,'cyclic':true
			});
		});</script>
	<?php }
}
