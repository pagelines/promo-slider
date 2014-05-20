<<<<<<< HEAD
<?php

/*



Plugin Name: Promo Slider

Description: Promo Slider adds a button on right or left of the page that slides out to reveal a promo when you click on it! It is a vertical element that shows on the left or right hand side of your site!

Version: 1.1

Author: Catapult Impact

Pagelines: true



*/



class PageLinesPromoSlider{

	function __construct() {

		$this->base_url = sprintf( '%s/%s', WP_PLUGIN_URL,  basename(dirname( __FILE__ )));

		$this->icon = $this->base_url . '/icon.png';

		$this->base_dir = sprintf( '%s/%s', WP_PLUGIN_DIR,  basename(dirname( __FILE__ )));

		$this->base_file = sprintf( '%s/%s/%s', WP_PLUGIN_DIR,  basename(dirname( __FILE__ )), basename( __FILE__ ));

		// register plugin hooks...		

		$this->plugin_hooks();

	}		

	

	function plugin_hooks(){

		// Always run		

		add_action( 'after_setup_theme', array( &$this, 'options' ));		

		add_action( 'wp_enqueue_scripts', array( &$this, 'promo_css' ) );	

		add_action( 'pagelines_page', array( &$this, 'promo_slider' ));

	}

	

	function promo_css() {

		wp_register_style( 'promo-style', plugins_url( 'maincss.css', __FILE__ ) );

		wp_enqueue_style( 'promo-style' );

	}

	

	function promo_slider(){

		$show_promo_slider = pl_setting('show_promoslider');

		if( $show_promo_slider ){

			$slider_buttontitle = pl_setting('promoslider_title');

			$slider_buttonorentation = strtolower(pl_setting('promoslider_orientation'));

			$slider_buttonposition = pl_setting('promoslider_top_position');

			$slider_contentbox = stripslashes(pl_setting('promoslider_content'));

			

			if($slider_buttonorentation == "left"){

				$sliderdivname = "QuickContentSlider-left";

				$buttondivname = "QuickContentSlider-button-left";

				$contentdivname = "QuickContentSlider-content-left";

				$button_position = $slider_buttonposition;

				$sliderbuttonbutton ='

					<script>

						var $j = jQuery.noConflict();

						$j(window).load(function(){

							if($j.browser.msie && $j.browser.version <= 8.0){

								$j(".'.$buttondivname.'").addClass("QuickContentSlider-button-left-ie");

								var content_width = $j(".'.$contentdivname.'").outerWidth(); 

								var button_height = $j(".'.$buttondivname.'").outerHeight();

								var button_inner_height = $j(".'.$buttondivname.'").height();

								var content_height = $j(".'.$contentdivname.'").outerHeight(); 

								var content_inner_height = $j(".'.$contentdivname.'").height(); 

								$j("#'.$sliderdivname.'").css({"left":"-"+content_width+"px","top":"'.$button_position.'"});

								$j("#'.$sliderdivname.'").css("z-index", "1035");

								if(button_height > content_height){

									var button_left = $j(".'.$buttondivname.'").outerHeight();

									$j(".'.$buttondivname.'").css("right","-"+button_left+"px");			

									var paddint_top = parseInt($j(".'.$contentdivname.'").css("padding-top"), 10);

									var paddint_bottom = parseInt($j(".'.$contentdivname.'").css("padding-bottom"), 10);

									var new_content_height = button_height - (paddint_top + paddint_bottom);

									$j(".'.$contentdivname.'").css("height",new_content_height+"px");

								}else{

									var paddint_top = parseInt($j(".'.$buttondivname.'").css("padding-top"), 10);

									var paddint_bottom = parseInt($j(".'.$buttondivname.'").css("padding-bottom"), 10);

									var button_update_height = content_height - (paddint_top + paddint_bottom);

									$j(".'.$buttondivname.'").css("width",button_update_height+"px");

									var button_left = $j(".'.$buttondivname.'").outerHeight();

									$j(".'.$buttondivname.'").css("right","-"+button_left+"px");

								}

							}else{

								var content_width = $j(".'.$contentdivname.'").outerWidth(); 

								var button_height = $j(".'.$buttondivname.'").outerWidth();

								var button_inner_height = $j(".'.$buttondivname.'").width();

								var content_height = $j(".'.$contentdivname.'").outerHeight(); 

								var content_inner_height = $j(".'.$contentdivname.'").height();

								$j("#'.$sliderdivname.'").css({"left":"-"+content_width+"px","top":"'.$button_position.'"});

								$j("#'.$sliderdivname.'").css("z-index", "1035");

								if(button_height > content_height){

									var new_but_top = button_inner_height - 21;

									$j(".'.$buttondivname.'").css("right","0px");

									var paddint_top = parseInt($j(".'.$contentdivname.'").css("padding-top"), 10);

									var paddint_bottom = parseInt($j(".'.$contentdivname.'").css("padding-bottom"), 10);

									var new_content_height = button_height - (paddint_top + paddint_bottom);

									$j(".'.$contentdivname.'").css("height",new_content_height+"px");

									$j(".'.$buttondivname.'").css("top",new_but_top+"px");

								}else{

									var paddint_top = parseInt($j(".'.$buttondivname.'").css("padding-top"), 10);

									var paddint_bottom = parseInt($j(".'.$buttondivname.'").css("padding-bottom"), 10);

									var button_update_height = content_height - (paddint_top + paddint_bottom);

									$j(".'.$buttondivname.'").css("width",button_update_height+"px");

									$j(".'.$buttondivname.'").css("right","0px");

									var new_cont_top = button_update_height - 21;

									$j(".'.$buttondivname.'").css("top",new_cont_top+"px");

								}

							}

							$j(".'.$buttondivname.'").click(function(){

								$j("#'.$sliderdivname.'").animate({"left":"0px"},1000);

							});

							

							$j(".'.$contentdivname.'").hover("",function(){	

								$j("#'.$sliderdivname.'").stop().delay(500).animate({"left":"-"+content_width+"px"},1000);

							});

							$j(".'.$contentdivname.'").css("visibility","visible");

							$j(".'.$buttondivname.'").css("visibility","visible");

						});

					</script>

				';

			}elseif($slider_buttonorentation == "right"){

				$sliderdivname = "QuickContentSlider-right";

				$buttondivname = "QuickContentSlider-button-right";

				$contentdivname = "QuickContentSlider-content-right";

				$button_position = $slider_buttonposition;

				$sliderbuttonbutton ='

					<script>

						var $j = jQuery.noConflict();

						$j(window).load(function(){

							if($j.browser.msie && $j.browser.version <= 8.0){

								$j(".'.$buttondivname.'").addClass("QuickContentSlider-button-right-ie");

								var content_width = $j(".'.$contentdivname.'").outerWidth(); 

								var button_height = $j(".'.$buttondivname.'").outerHeight();

								var button_inner_height = $j(".'.$buttondivname.'").height();

								var content_height = $j(".'.$contentdivname.'").outerHeight(); 

								var content_inner_height = $j(".'.$contentdivname.'").height(); 

								$j("#'.$sliderdivname.'").css({"right":"-"+content_width+"px","top":"'.$button_position.'"});

								$j("#'.$sliderdivname.'").css("z-index", "1035");

								if(button_height > content_height){

									var button_left = $j(".'.$buttondivname.'").outerWidth();

									$j(".'.$buttondivname.'").css("left","-"+button_left+"px");			

									var paddint_top = parseInt($j(".'.$contentdivname.'").css("padding-top"), 10);

									var paddint_bottom = parseInt($j(".'.$contentdivname.'").css("padding-bottom"), 10);

									var new_content_height = button_height - (paddint_top + paddint_bottom);

									$j(".'.$contentdivname.'").css("height",new_content_height+"px");

								}else{

									var button_update_height = content_height - 24;

									$j(".'.$buttondivname.'").css("width",button_update_height+"px");

									var button_left = $j(".'.$buttondivname.'").outerWidth();

									$j(".'.$buttondivname.'").css("left","-"+button_left+"px");

								}

							}else{

								var content_width = $j(".'.$contentdivname.'").outerWidth(); 

								var button_height = $j(".'.$buttondivname.'").outerWidth();

								var button_inner_height = $j(".'.$buttondivname.'").width();

								var content_height = $j(".'.$contentdivname.'").outerHeight(); 

								var content_inner_height = $j(".'.$contentdivname.'").height(); 

								$j("#'.$sliderdivname.'").css({"right":"-"+content_width+"px","top":"'.$button_position.'"});

								$j("#'.$sliderdivname.'").css("z-index", "1035");

								if(button_height > content_height){

									$j(".'.$buttondivname.'").css("left","-"+button_height+"px");			

									var paddint_top = parseInt($j(".'.$contentdivname.'").css("padding-top"), 10);

									var paddint_bottom = parseInt($j(".'.$contentdivname.'").css("padding-bottom"), 10);

									var new_content_height = button_height - (paddint_top + paddint_bottom);

									$j(".'.$contentdivname.'").css("height",new_content_height+"px");

								}else{

									var button_update_height = content_height - 24;

									$j(".'.$buttondivname.'").css("width",button_update_height+"px");

									$j(".'.$buttondivname.'").css("left","-"+content_height+"px");

								}

							}

							

							$j(".'.$buttondivname.'").click(function(){

								$j("#'.$sliderdivname.'").animate({right:0},1000);

							});

							

							$j(".'.$contentdivname.'").hover("",function(){	

								$j("#'.$sliderdivname.'").stop().animate({right:-content_width},1000);

							});

							$j(".'.$contentdivname.'").css("visibility","visible");

							$j(".'.$buttondivname.'").css("visibility","visible");

						});

					</script>

				';

			}

			$sliderbuttonbutton .= '<div id="'.$sliderdivname.'">

										<div class="'.$buttondivname.'">'.$slider_buttontitle.'</div>

										<div class="'.$contentdivname.'">'.wpautop(do_shortcode("$slider_contentbox")).'</div>

									</div>';

			echo $sliderbuttonbutton;

		}

	}

	

	function options(){

		

		if( !function_exists('pl_setting') )			

			return;		

			

		$options = array();

		$options[] = array(

			'key'		=> 'promoslider_show_settings',

			'type'		=> 'multi',			

			'title'		=> __('PromoSlider Main Options', 'pagelines'),			

			'col'		=> 1,			

			'opts'	=> array(

				array(

					'key'	=> 'show_promoslider',					

					'type' 	=> 'check',					

					'label' => 'Activate the PromoSlider globally?',					

					'help'	=> 'This option will activate the PromoSlider globally.'

				),

				array(

					'key'	=> 'promoslider_orientation',

					'type' 	=> 'select',

					'label' => 'Select Slider Orientation',

					'opts'	=> array(

						'right'	=> array('name'	=>'Right (Default)'),

						'left'			=> array('name'	=>'Left'),

					),

				),

				array(

					'key'	  => 'promoslider_top_position',

					'type'    => 'text',

					'label'	  => 'PromoSlider top position.'

				),

			),

		);

		

		$options[] = array(

			'key'		=> 'promoslider_setup',

			'type'		=> 'multi',

			'col'		=> 2,

			'title'		=> 'PromoSlider Title',

			'opts'	=> array(



				 array(

					'key'			=> 'promoslider_title',

					'type' 			=> 'text',

					'label'	=> 'PromoSlider Title'

				),

				array(

					'key'			=> 'promoslider_content',

					'type' 			=> 'textarea',

					'label' 	=> 'PromoSlider Content'

				),

			),

		);

		

		$option_args = array(

			'name'		=> 'PromoSlider',			

			'opts'		=> $options,			

			'icon'		=> 'icon-tag',			

			'pos'		=> 12		

		);

		

		pl_add_options_page( $option_args );

	}

	

}



new PageLinesPromoSlider;

?>
=======
<?php
/*
Plugin Name: Promo Slider
Description: Promo Slider adds a button on right or left of the page that slides out to reveal a promo when you click on it! It is a vertical element that shows on the left or right hand side of your site!
Version: 1.1
Author: Catapult Impact
Pagelines: true
*/

class PLPromoSlider{

	function __construct() {
		$this->icon = plugins_url( 'icon.png', __FILE__ );
		register_activation_hook(__FILE__,array(&$this,'PromoSlider_install'));
		register_deactivation_hook(__FILE__ , array(&$this,'PromoSlider_uninstall'));
		add_action('admin_menu', array(&$this,'PromoSlider_plugin_admin_menu'));
		add_action( 'wp_enqueue_scripts', array( &$this, 'promo_css' ) );
		add_action( 'pagelines_page', array( &$this, 'promo_slider' ));	
	}
	
	function PromoSlider_install() {
		$boj = new PLPromoSlider;
		$boj->PromoSlider_create();
		$content_box = 'Go to settings in Promo Slider plugin to add your own text.';
		global $wpdb;
		$table_name = $wpdb->prefix . "PromoSlider"; 
		$sql = "INSERT IGNORE INTO " . $table_name . " values ('','Promo Slider','right','".$content_box."','200px','1')";
		$wpdb->query( $sql );
	}
	
	function PromoSlider_create(){
		global $wpdb;
		$table_name = $wpdb->prefix . "PromoSlider"; 
		$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
				  id mediumint(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				  promo_slider_button_title VARCHAR(255) NOT NULL,
				  promo_slider_orentation VARCHAR(255) NOT NULL,
				  promo_slider_desc TEXT,
				  promo_slider_top VARCHAR(100) NOT NULL,
				  promo_slider_enable tinyint(1) NOT NULL DEFAULT  '1'
				)";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
	
	function PromoSlider_uninstall(){
		global $wpdb;
		$table = $wpdb->prefix . "PromoSlider";
		$structure = "drop table if exists $table";
		$wpdb->query($structure);  
	}
	
	function PromoSlider_plugin_admin_menu() {
		add_menu_page('Promo Slider', 'Promo Slider', 'publish_posts', 'promoslider', array('PLPromoSlider','PromoSlider_main'), $this->icon);
	}
	
	function promo_css() {
		wp_register_style( 'promo-style', plugins_url( 'maincss.css', __FILE__ ) );
		wp_enqueue_style( 'promo-style' );
	}

	function PromoSlider_main() {
	
		if(isset($_REQUEST['id'])){
			$option = $_REQUEST['id'];
			$promo_slider_button_title = $_REQUEST['promo_slider_button_title'];
			$promo_slider_orentation = $_REQUEST['promo_slider_orentation'];
			$promo_slider_desc = $_REQUEST['promo_slider_desc'];
			$promo_slider_top = $_REQUEST['promo_slider_top'];
			$promo_slider_enable = (isset($_REQUEST['promo_slider_enable']))?$_REQUEST['promo_slider_enable']:0;
			global $wpdb;
			$table_name = $wpdb->prefix . "PromoSlider";
			$query = "UPDATE $table_name SET promo_slider_button_title='$promo_slider_button_title', promo_slider_orentation='$promo_slider_orentation', promo_slider_desc='$promo_slider_desc', promo_slider_top='$promo_slider_top', promo_slider_enable=$promo_slider_enable where id=$option";
			$wpdb->query("UPDATE $table_name SET promo_slider_button_title='$promo_slider_button_title', promo_slider_orentation='$promo_slider_orentation', promo_slider_desc='$promo_slider_desc', promo_slider_top='$promo_slider_top', promo_slider_enable=$promo_slider_enable where id=$option " );
		}
		
		global $wpdb;
		$table = $wpdb->prefix . "PromoSlider";
		$data = $wpdb->get_row("select * from $table");
		$rselected = "";
		$lselected = "";
		if(isset($data) && $data->promo_slider_orentation == "right"){
			$orentation = "Right";
			$rselected = 'selected="selected"';
		}else{
			$orentation = "Left";
			$lselected = 'selected="selected"';
		}
		
		$checked_value = '';
		if(isset($data) && $data->promo_slider_enable == 1){
		$checked_value = 'checked="checked"';
		}
		
	?>	

	<div class="wrap" style="width:820px;"><div id="icon-options-general" class="icon32"><br /></div>
		<h2>Promo Slider 1.1 Settings</h2>
		<div class="metabox-holder" style="width: 820px; float:left;">
		<small>Welcome to Promo Slider 1.1</small>
		<div class="inside">
			<br />
		</div>
	</div>

	<div id="general" class="inside" style="padding: 10px;">
		<form method="post" action="?page=promoslider&id=<?php echo $data->id; ?>">
			<div id="post-body-content">
				<div class="postbox" id="content_box" style="margin-top: 20px;">
					<h3 style="padding: 7px 10px;" class="hndle"><span>Activate The Slider</span></h3>
					<div class="inside">
						<div id="titlediv">
							<div id="titlewrap">
								<input id="promo_slider_enable" type="checkbox" name="promo_slider_enable" value="1" <?php echo $checked_value; ?> >
								<label style="cursor: pointer;" for="promo_slider_enable">Show The Promo Slider?</label>
							</div>
						</div>
					</div>
				</div>
				<div class="postbox" id="button_title">
					<h3 style="padding: 7px 10px;" class="hndle"><span>Slider Title</span></h3>
					<div class="inside">
						<div id="titlediv">
							<div id="titlewrap">
								<input type="text" autocomplete="off" id="title" value="<?php echo $data->promo_slider_button_title; ?>" tabindex="1" size="30" name="promo_slider_button_title">
							</div>
						</div>
					</div>
				</div>
				<div class="postbox" id="content_box" style="margin-top: 20px;">
					<h3 style="padding: 7px 10px;" class="hndle"><span>Slider Content</span></h3>
					<div class="inside">
						<div>
							<?php wp_editor($data->promo_slider_desc,$id = 'promo_slider_desc' ); ?>
						</div>
					</div>
				</div>
				<div class="postbox" id="promo_slider_orentation">
					<h3 style="padding: 7px 10px;" class="hndle"><span>Slider orientation</span></h3>
					<div class="inside">
						<div id="titlediv">
							<div id="titlewrap">
								<select name="promo_slider_orentation">
									<option>Select Slider orientation</option>
									<option value="right" <?php echo $rselected; ?> >Right</option>
									<option value="left" <?php echo $lselected; ?> >Left</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="postbox" id="page-links-to" style="margin-top: 20px;">
					<h3 style="padding: 7px 10px;" class="hndle"><span>Slider Top Position</span></h3>
					<div class="inside">
						<p>Current Slider Top Position</p>
						<div>
							<div style="display: inline;"><input type="radio" checked="checked" value="wp" name="promo_slider_top" id="txfx-links-to-choose-wp"></div>
							<div style="display: inline; padding-left: 10px;"> 
								<?php echo $data->promo_slider_top; ?> <font style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;* Default 200px.</font>
							</div>
						</div>
						<p style="margin-top: 32px;">
							<div style="display: inline;"><input type="radio" value="new_img" name="promo_slider_top" id="txfx-links-to-choose-alternate"></div>
							<div style="display: inline; padding-left: 10px;"><label for="txfx-links-to-choose-alternate"> Click to set top position : </label></div>
						</p>
						<div class="hide-if-js" id="txfx-links-to-alternate-section" style="margin-left: 30px; display: none;">
							<p>
								<input type="text" id="promo_slider_top" name="promo_slider_top" size="20" value="<?php echo $data->promo_slider_top; ?>" />
								<font style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;* Example: 20% or 200px - default is 200px.</font>
							</p>
						</div>
						<script>
							(function($){
								$('input[type=radio]', '#page-links-to').change(function(){
									if ( 'wp' == $(this).val() ) {
										$('#txfx-links-to-alternate-section').fadeOut();
									} else {
										$('#txfx-links-to-alternate-section').fadeIn(function(){
											i = $('#txfx-links-to');
											i.focus().val(i.val());
										});
									}
								});
							})(jQuery);
						</script>
					</div>
				</div>
				<div id="publishing-action" style="float: left; margin-top: 10px;">
					<img alt="" id="ajax-loading" class="ajax-loading" src="images/wpspin_light.gif" style="visibility: hidden;">
					<input type="hidden" value="Update" id="original_publish" name="original_publish">
					<input type="submit" value="Update" accesskey="p" tabindex="5" id="publish" class="button-primary" name="save">
				</div>
			</div>
		</form>
	</div>
	<?php 

	}
		
	function promo_slider(){
	
		global $wpdb;
		$table = $wpdb->prefix . "PromoSlider";
		$data = $wpdb->get_row("select * from $table where promo_slider_enable=1");
		
		$slider_status = (isset($data) && $data->promo_slider_enable == 1)?'on':'off';
		if($slider_status == 'on'){
			$slider_buttontitle = (isset($data))?$data->promo_slider_button_title:'';
			$slider_buttonorentation = (isset($data))?strtolower($data->promo_slider_orentation):'';
			$slider_buttonposition = (isset($data))?$data->promo_slider_top:'';
			$slider_contentbox = (isset($data))?stripslashes($data->promo_slider_desc):'';
			
			if($slider_buttonorentation == "left"){
				$sliderdivname = "QuickContentSlider-left";
				$buttondivname = "QuickContentSlider-button-left";
				$contentdivname = "QuickContentSlider-content-left";
				$button_position = $slider_buttonposition;
				$sliderbuttonbutton ='
					<script>
						var $j = jQuery.noConflict();
						$j(window).load(function(){
							if($j.browser.msie && $j.browser.version <= 8.0){
								$j(".'.$buttondivname.'").addClass("QuickContentSlider-button-left-ie");
								var content_width = $j(".'.$contentdivname.'").outerWidth(); 
								var button_height = $j(".'.$buttondivname.'").outerHeight();
								var button_inner_height = $j(".'.$buttondivname.'").height();
								var content_height = $j(".'.$contentdivname.'").outerHeight(); 
								var content_inner_height = $j(".'.$contentdivname.'").height(); 
								$j("#'.$sliderdivname.'").css({"left":"-"+content_width+"px","top":"'.$button_position.'"});
								$j("#'.$sliderdivname.'").css("z-index", "1035");
								if(button_height > content_height){
									var button_left = $j(".'.$buttondivname.'").outerHeight();
									$j(".'.$buttondivname.'").css("right","-"+button_left+"px");			
									var paddint_top = parseInt($j(".'.$contentdivname.'").css("padding-top"), 10);
									var paddint_bottom = parseInt($j(".'.$contentdivname.'").css("padding-bottom"), 10);
									var new_content_height = button_height - (paddint_top + paddint_bottom);
									$j(".'.$contentdivname.'").css("height",new_content_height+"px");
								}else{
									var paddint_top = parseInt($j(".'.$buttondivname.'").css("padding-top"), 10);
									var paddint_bottom = parseInt($j(".'.$buttondivname.'").css("padding-bottom"), 10);
									var button_update_height = content_height - (paddint_top + paddint_bottom);
									$j(".'.$buttondivname.'").css("width",button_update_height+"px");
									var button_left = $j(".'.$buttondivname.'").outerHeight();
									$j(".'.$buttondivname.'").css("right","-"+button_left+"px");
								}
							}else{
								var content_width = $j(".'.$contentdivname.'").outerWidth(); 
								var button_height = $j(".'.$buttondivname.'").outerWidth();
								var button_inner_height = $j(".'.$buttondivname.'").width();
								var content_height = $j(".'.$contentdivname.'").outerHeight(); 
								var content_inner_height = $j(".'.$contentdivname.'").height();
								$j("#'.$sliderdivname.'").css({"left":"-"+content_width+"px","top":"'.$button_position.'"});
								$j("#'.$sliderdivname.'").css("z-index", "1035");
								if(button_height > content_height){
									var new_but_top = button_inner_height - 21;
									$j(".'.$buttondivname.'").css("right","0px");
									var paddint_top = parseInt($j(".'.$contentdivname.'").css("padding-top"), 10);
									var paddint_bottom = parseInt($j(".'.$contentdivname.'").css("padding-bottom"), 10);
									var new_content_height = button_height - (paddint_top + paddint_bottom);
									$j(".'.$contentdivname.'").css("height",new_content_height+"px");
									$j(".'.$buttondivname.'").css("top",new_but_top+"px");
								}else{
									var paddint_top = parseInt($j(".'.$buttondivname.'").css("padding-top"), 10);
									var paddint_bottom = parseInt($j(".'.$buttondivname.'").css("padding-bottom"), 10);
									var button_update_height = content_height - (paddint_top + paddint_bottom);
									$j(".'.$buttondivname.'").css("width",button_update_height+"px");
									$j(".'.$buttondivname.'").css("right","0px");
									var new_cont_top = button_update_height - 21;
									$j(".'.$buttondivname.'").css("top",new_cont_top+"px");
								}
							}
							$j(".'.$buttondivname.'").click(function(){
								$j("#'.$sliderdivname.'").animate({"left":"0px"},1000);
							});
							
							$j(".'.$contentdivname.'").hover("",function(){	
								$j("#'.$sliderdivname.'").stop().delay(500).animate({"left":"-"+content_width+"px"},1000);
							});
							$j(".'.$contentdivname.'").css("visibility","visible");
							$j(".'.$buttondivname.'").css("visibility","visible");
						});
					</script>
				';
			}elseif($slider_buttonorentation == "right"){
				$sliderdivname = "QuickContentSlider-right";
				$buttondivname = "QuickContentSlider-button-right";
				$contentdivname = "QuickContentSlider-content-right";
				$button_position = $slider_buttonposition;
				$sliderbuttonbutton ='
					<script>
						var $j = jQuery.noConflict();
						$j(window).load(function(){
							if($j.browser.msie && $j.browser.version <= 8.0){
								$j(".'.$buttondivname.'").addClass("QuickContentSlider-button-right-ie");
								var content_width = $j(".'.$contentdivname.'").outerWidth(); 
								var button_height = $j(".'.$buttondivname.'").outerHeight();
								var button_inner_height = $j(".'.$buttondivname.'").height();
								var content_height = $j(".'.$contentdivname.'").outerHeight(); 
								var content_inner_height = $j(".'.$contentdivname.'").height(); 
								$j("#'.$sliderdivname.'").css({"right":"-"+content_width+"px","top":"'.$button_position.'"});
								$j("#'.$sliderdivname.'").css("z-index", "1035");
								if(button_height > content_height){
									var button_left = $j(".'.$buttondivname.'").outerWidth();
									$j(".'.$buttondivname.'").css("left","-"+button_left+"px");			
									var paddint_top = parseInt($j(".'.$contentdivname.'").css("padding-top"), 10);
									var paddint_bottom = parseInt($j(".'.$contentdivname.'").css("padding-bottom"), 10);
									var new_content_height = button_height - (paddint_top + paddint_bottom);
									$j(".'.$contentdivname.'").css("height",new_content_height+"px");
								}else{
									var button_update_height = content_height - 24;
									$j(".'.$buttondivname.'").css("width",button_update_height+"px");
									var button_left = $j(".'.$buttondivname.'").outerWidth();
									$j(".'.$buttondivname.'").css("left","-"+button_left+"px");
								}
							}else{
								var content_width = $j(".'.$contentdivname.'").outerWidth(); 
								var button_height = $j(".'.$buttondivname.'").outerWidth();
								var button_inner_height = $j(".'.$buttondivname.'").width();
								var content_height = $j(".'.$contentdivname.'").outerHeight(); 
								var content_inner_height = $j(".'.$contentdivname.'").height(); 
								$j("#'.$sliderdivname.'").css({"right":"-"+content_width+"px","top":"'.$button_position.'"});
								$j("#'.$sliderdivname.'").css("z-index", "1035");
								if(button_height > content_height){
									$j(".'.$buttondivname.'").css("left","-"+button_height+"px");			
									var paddint_top = parseInt($j(".'.$contentdivname.'").css("padding-top"), 10);
									var paddint_bottom = parseInt($j(".'.$contentdivname.'").css("padding-bottom"), 10);
									var new_content_height = button_height - (paddint_top + paddint_bottom);
									$j(".'.$contentdivname.'").css("height",new_content_height+"px");
								}else{
									var button_update_height = content_height - 24;
									$j(".'.$buttondivname.'").css("width",button_update_height+"px");
									$j(".'.$buttondivname.'").css("left","-"+content_height+"px");
								}
							}
							
							$j(".'.$buttondivname.'").click(function(){
								$j("#'.$sliderdivname.'").animate({right:0},1000);
							});
							
							$j(".'.$contentdivname.'").hover("",function(){	
								$j("#'.$sliderdivname.'").stop().animate({right:-content_width},1000);
							});
							$j(".'.$contentdivname.'").css("visibility","visible");
							$j(".'.$buttondivname.'").css("visibility","visible");
						});
					</script>
				';
			}
			$sliderbuttonbutton .= '<div id="'.$sliderdivname.'">
										<div class="'.$buttondivname.'">'.$slider_buttontitle.'</div>
										<div class="'.$contentdivname.'">'.wpautop(do_shortcode("$slider_contentbox")).'</div>
									</div>';
			echo $sliderbuttonbutton;
			
		}
	}
}
 
new PLPromoSlider;
?>
>>>>>>> a6006e77d6e939fcbcbfe5ce37fb7f6af8c48b2d
