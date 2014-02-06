<?php

$ram108_fbalbum_admin = new ram108_fbalbum_admin;

class ram108_fbalbum_admin{

	protected $options;

	public function __construct(){

		$this->options = &$GLOBALS['ram108_fbalbum_settings']; 

		add_action('admin_init', array( $this, '_admin_init' ) );
		add_action('admin_menu', array( $this, '_admin_menu' ) );
		add_filter('plugin_action_links_'.plugin_basename( _RAM108_FBALBUM ), array( $this, '_admin_link' ) );
	}

	public function admin_page(){ ?>

		<div class="wrap">

			<?php screen_icon(); ?>
			
			<h2>[ram108] Facebook Photo Album</h2>

			<div style="width: 68%; float: left; margin-right: 20px;">

				<form method="post" action="options.php">

					<?php settings_fields( $this->options->id ); ?><?php do_settings_sections( $this->options->id ); ?>
					
					<input type="hidden" name="<?php echo $this->options->id?>[ver]" value="<?php echo $this->options->ver?>" />

					<h3><?php _e('Default album settings', $this->options->id );?></h3>

					<table class="form-table">
						<tr valign="top"><th scope="row"><?php _e('Thumbnail size', $this->options->id );?></th><td>
							<input type="number" step="5" min="5" class="small-text" name="<?php echo $this->options->id?>[thumb_size]" value="<?php echo $this->options->thumb_size?>" />
						</td></tr>
						<tr valign="top"><th scope="row"><?php _e('Thumbnail shape', $this->options->id );?></th><td>
							<fieldset>
							<label><input name="<?php echo $this->options->id?>[thumb_shape]" type="radio" value="0" <?php checked( 0, $this->options->thumb_shape );?>> <?php _e('Rectangular', $this->options->id );?></label><br/>
							<label><input name="<?php echo $this->options->id?>[thumb_shape]" type="radio" value="1" <?php checked( 1, $this->options->thumb_shape );?>> <?php _e('Square', $this->options->id );?></label><br/>
							<label><input name="<?php echo $this->options->id?>[thumb_shape]" type="radio" value="2" <?php checked( 2, $this->options->thumb_shape );?>> <?php _e('Circle', $this->options->id );?></label>
							</fieldset>
						</td></tr>
					</table>

					<h3><?php _e('Other', $this->options->id );?></h3>

					<table class="form-table fancybox_settings">
						<tr valign="top"><th scope="row"><?php _e('Builtin Fancybox', $this->options->id );?></th><td>
							<label><input name="<?php echo $this->options->id?>[fancybox]" type="checkbox" value="1" <?php checked( 1, @$this->options->fancybox );?>> <?php _e('Popup image appearing and gallery navigation', $this->options->id );?></label>
						</td></tr>
						<tr valign="top"><th scope="row"><?php _e('Facebook Like button', $this->options->id );?></th><td>
							<label><input name="<?php echo $this->options->id?>[fblike]" type="checkbox" value="1" <?php checked( 1, @$this->options->fblike );?>> <?php _e('Show Facebook Like button under each album', $this->options->id );?></label>
						</td></tr>
					</table>

					<div id="credits" style="display:<?php echo @$this->options->nocredits || @$this->options->nofblink ? 'block' : 'none';?>">

					<h3>Credits removal</h3>

					<table class="form-table fancybox_settings">
						<tr valign="top"><th scope="row">Hide plugin credits</th><td>
							<input name="<?php echo $this->options->id?>[nocredits]" type="checkbox" value="1" <?php checked( 1, @$this->options->nocredits );?>> Available on <a href="http://www.ram108.ru/donate">donations only</a>. Thank you!
						</td></tr>
						<tr valign="top"><th scope="row">Hide Facebook link</th><td>
							<input name="<?php echo $this->options->id?>[nofblink]" type="checkbox" value="1" <?php checked( 1, @$this->options->nofblink );?>> Available on <a href="http://www.ram108.ru/donate">donations only</a>. Thank you!
						</td></tr>
					</table>

					</div>

					<?php submit_button(); ?>
					
				</form>

				<?php ram108_fbalbum_registration_notice(); ?>

			</div>

			<div style="width: 28%; float: right">

				<h3><?php _e('Requirements check', $this->options->id );?></h3>
				<p><?php _e('The following extensions should be installed for proper work of plugin', $this->options->id );?>.</p>

				<p>
				<?php $this->_yes_no( APC_AVAILABLE, '<a href="https://www.google.com/search?q=install+php+apc+cache">APC cache</a>' ); ?><br/>
				<?php $this->_yes_no( CURL_AVAILABLE, '<a href="https://www.google.com/search?q=how+to+enable+curl+extension">cURL extension</a>' ); ?>
				</p>

				<h3><?php _e('Plugin usage', $this->options->id );?></h3>
				<p><?php printf( __('Visit plugin %1$shome page%2$s for examples on plugin usage', $this->options->id ), '<a href="http://www.ram108.ru/plugins/ram108-fbalbum">', '</a>');?>.</p>

				<h3><?php _e('Thanks', $this->options->id );?></h3>
				<p><?php printf( __('Do you like the plugin? %1$sRate it%2$s in Wordpress Plugin Directory or write a review on your blog', $this->options->id ), '<a href="http://wordpress.org/support/view/plugin-reviews/ram108-fbalbum">', '</a>' );?>.</p>

			</div>

		</div>

		<script type="text/javascript">jQuery(document).ready(function($){
			$(document).keydown(function(e) {
				if ( e.which == 75 && e.ctrlKey && e.shiftKey ) $('#credits').css('display','block');
			});
		});</script>
		<?php
	}

	public function _yes_no( $value, $title ) {

		$yes = '<img src="'.plugins_url('yes.png', __FILE__ ).'" style="vertical-align: middle;" alt />&nbsp;&nbsp;';
		$no = '<img src="'.plugins_url('no.png', __FILE__ ).'" style="vertical-align: middle;" alt />&nbsp;&nbsp;';

		echo ( $value ? $yes : $no ) . $title . ' '. ( $value ? __('available', $this->options->id ) : __('should be installed', $this->options->id ) );
	}

	public function _admin_onsubmit( $input ) {

		// drop APC cache on size change
		if ( APC_AVAILABLE && $this->options->thumb_size != $input['thumb_size'] ) apc_delete_reqex( '|^ram108_fbalbum_.+$|');
		return $input;
	}

	// OTHER

	public function _admin_init(){

		register_setting('ram108-fbalbum', 'ram108-fbalbum', array( $this, '_admin_onsubmit' ) );
	}

	public function _admin_menu(){

		add_options_page('Facebook Photo Album Settings', 'Facebook Photo Album', 'manage_options', $this->options->id, array( $this, 'admin_page' ) );
	}

	public function _admin_link( $text ){

		return array_merge( array(
			'<a href="'.admin_url( 'options-general.php?page='.$this->options->id ).'">'.__( 'Settings', $this->options->id ).'</a>'), 
		$text );
	}
}