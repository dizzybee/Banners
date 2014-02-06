<?php 

$ram108_fbalbum_functions = new ram108_fbalbum_functions;

class ram108_fbalbum_functions {

	protected $options;

	public function __construct(){

		$this->options = &$GLOBALS['ram108_fbalbum_settings']; 

		if ( !$this->options->fancybox ) add_action('wp_head', array( $this, '_activate_lightbox') );
		add_action('wp_footer', array( $this, '_activate_ram108_fblink') );
	}

	public function _activate_lightbox(){ ?>
		<!-- [ram108] makeup for lightbox -->
		<script type="text/javascript">jQuery(document).ready(function($){
			$('.ram108_fbimage > a').each(function(){
				var e = $(this);
				e.attr('rel', e.attr('rel').replace(/(gallery-(\d+).*)/i, '$1 lightbox[$2] prettyPhoto') );
				e.attr('class', 'lightbox colorbox cboxElement thickbox fancybox');
			});
		});</script>
	<?php }

	public function _activate_ram108_fblink(){ ?>
		<script type="text/javascript">jQuery(document).ready(function($){ 
			$('.ram108_fblink').attr('style', 'display: block !important;'); 
			<?php if ( !$this->options->nofblink ): ?>
				$('.ram108_fblink span:nth-child(1)').attr('style', 'display: inline !important;'); 
				$('.ram108_fbwidget .ram108_fblink span:nth-child(1)').attr('style', 'display: none;');
			<? endif; ?> 
			<?php if ( !$this->options->nocredits ): ?>
				$('.ram108_fblink span:nth-child(2)').attr('style', 'display: inline; opacity: 0.5;');
			<?php endif; ?> 
		});</script>
	<?php }
}

function ram108_fbalbum_stats(){ 
	$options = &$GLOBALS['ram108_fbalbum_settings']; 
	preg_match('|(?:\d+\.?)+|', PHP_VERSION, $php ); $php = @$php[0];
	echo '<img src="http://www.ram108.ru/plugin.gif?plugin=ram108-fbalbum&ver='._RAM108_FBALBUM_VER.'&php='.$php.'&reg='.$options->nocredits.'&url='.get_home_url().'" width=1 height=1 border=0 alt />';
}

function ram108_fbalbum_registration_notice(){ 
	$options = &$GLOBALS['ram108_fbalbum_settings']; 
	?>
	<?php if ( !$options->nocredits && !$options->nofblink ): ?>
		<h3><?php _e('Register your copy of plugin', $options->id );?></h3>
		<p>
			<a href="http://www.ram108.ru/donate" target="_blank"><?php _e('Support the developer with donation', $options->id );?></a>. 
			<?php _e('This will allow you to use registered version of plugin and to hide plugin credits', $options->id );?> "by [ram108] Facebook Photo Album".
		</p>
	<?php endif; ?>
<?php }