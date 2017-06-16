<?php
/*
Plugin Name: WP-ScrollUp
Plugin URI: http://dedushka.org/uroki/5503.html
Description: Add a "Scroll to the top button" to a defined corner of blog
Version: 1.0
Author: Nazar Tokar
Author URI: nazartokar.com
*/

function checkScrollUpOpt ($name, $default) { // check if option exists
	$s = get_option($name);
	if (strlen($s) == 0) {
		update_option ( $name, $default );
	}
}

function addScrollUpFiles() {
	$scrollup_folder = WP_PLUGIN_URL.'/'.plugin_basename(dirname(__FILE__)).'';

// check if vars exist

	checkScrollUpOpt ( 'scrollup_position', 'left_bottom' );
	checkScrollUpOpt ( 'scrollup_style', 'light' );
	checkScrollUpOpt ( 'scrollup_size', 'normal' );
	checkScrollUpOpt ( 'scrollup_folder', $scrollup_folder );

	if (!$scrollup_position = get_option('scrollup_position')) { 
		$scrollup_position = "leftbottom"; 
	}

	if (!$scrollup_style = get_option('scrollup_style')) { 
		$scrollup_style = "light"; 
	}

	if (!$scrollup_size = get_option('scrollup_size')) { 
		$scrollup_size = "normal"; 
	}

// echoing the vars

	echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$scrollup_folder.'/css/style.css" />
	<script type="text/javascript" src="'.$scrollup_folder.'/js/wp-scrollup.js" /></script>'."\n";

	if ( ($scrollup_style == 'light') && ($scrollup_size == 'normal') ) { 
		$scr_bg = 'background: #333 url("'.$scrollup_folder.'/img/up-light.png") center center no-repeat;';
	} 

	if ( ($scrollup_style == 'light') && ($scrollup_size == 'small') ) { 
		$scr_bg = 'background: #333 url("'.$scrollup_folder.'/img/up-light-s.png") center center no-repeat;';
	}

	if ( ($scrollup_style == 'dark') && ($scrollup_size == 'normal') ) { 
		$scr_bg = 'background: #fff url("'.$scrollup_folder.'/img/up.png") center center no-repeat;';
	} 

	if ( ($scrollup_style == 'dark') && ($scrollup_size == 'small') ) { 
		$scr_bg = 'background: #fff url("'.$scrollup_folder.'/img/up-s.png") center center no-repeat;';
	}

	if ( $scrollup_size == 'normal' ) { 
		$scr_sizes = 'width: 66px; height: 60px;'; 
	} else { 
		$scr_sizes = 'width: 33px; height: 30px;'; 
	}

	switch ($scrollup_position) {
		case 'left_top':
			$scr_position = 'top: 10px; left: 10px; ';
			break;
		case 'left_bottom':
			$scr_position = 'bottom: 10px; left: 10px; ';
			break;
		case 'right_top':
			$scr_position = 'top: 10px; right: 10px; ';
			break;
		case 'right_bottom':
			$scr_position = 'bottom: 10px; right: 10px; ';
			break;
	}

	echo '<style type="text/css"> #scrollup { '.$scr_bg.$scr_sizes.$scr_position.' } </style><!-- wp-scrollup plugin -->';
}

add_action('wp_head', 'addScrollUpFiles');
add_action('admin_menu', 'add_scrollup_options');

function add_scrollup_options() {
	add_options_page('WP-ScrollUp', 'WP-ScrollUp', 'manage_options', 'wp-scrollup', 'wp_scrollup_options');
}

function wp_scrollup_options() { ?>

<div class="wrap">

<div class="postbox-container side" style="width:65%; margin-right: 5%">

	<h2>Scrollup button Options</h2>
	<form method="post" action="options.php">
		<?php wp_nonce_field('update-options') ?>

<table class="form-table">
	<tr valign="top">
		<th scope="row">Button position:</th>
		<td>
			<select name="scrollup_position">
				<?php 
					$scrollup_position = get_option('scrollup_position');
					$scrollup_position_list = array('Left Bottom', 'Left Top', 'Right Bottom', 'Right Top'); 
					$scrollup_position_ids = array('left_bottom', 'left_top', 'right_bottom', 'right_top'); 
					for ($i = 0; $i < count($scrollup_position_list); $i++) {
						echo '<option';
						if ($scrollup_position == $scrollup_position_ids[$i]) {
							echo " selected ";
						}
						echo' value="'.$scrollup_position_ids[$i].'">'.$scrollup_position_list[$i].'</option>';
					}
				?>
				</select>
				<p>Choose the position of a button.</p>
		</td>
	</tr>

	<tr valign="top">
		<th scope="row">Button style:</th>
		<td>
			<select name="scrollup_style">
				<?php 
					$scrollup_style = get_option('scrollup_style');
					$scrollup_style_list = array('Light', 'Dark'); 
					$scrollup_style_ids = array('light', 'dark'); 
					for ($i = 0; $i < count($scrollup_style_list); $i++) {
						echo '<option';
						if ($scrollup_style == $scrollup_style_ids[$i]) {
							echo " selected ";
						}
						echo' value="'.$scrollup_style_ids[$i].'">'.$scrollup_style_list[$i].'</option>';
					}
				?>
				</select>
				<p>Choose the style of a button: dark or light one.</p>
		</td>
	</tr>

	<tr valign="top">
		<th scope="row">Button size:</th>
		<td>
			<select name="scrollup_size">
				<?php 
					$scrollup_size = get_option('scrollup_size');
					$scrollup_size_list = array('Normal', 'Small'); 
					$scrollup_size_ids = array('normal', 'small'); 
					for ($i = 0; $i < count($scrollup_size_list); $i++) {
						echo '<option';
						if ($scrollup_size == $scrollup_size_ids[$i]) {
							echo " selected ";
						}
						echo' value="'.$scrollup_size_ids[$i].'">'.$scrollup_size_list[$i].'</option>';
					}
				?>
				</select>
				<p>Normal size is 50 px width, small one is 25 px.</p>
		</td>
	</tr>
</table>

	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="scrollup_position, scrollup_style, scrollup_size" />

	<p><input type="submit" class="button-primary" name="Submit" value="Save Options" /></p>
	</form>
</div>
<div class="postbox-container side" style="width:25%">
	<div class="metabox-holder">
		<div class="meta-box-sortables">
			<div class="postbox">
				<h3 class="hndle"><span>Donate now</span></h3>
				<div class="inside">
					<p>This plugin is free to use. Your donates are highly appreciated. Thanks!</p>
					<script src="<?php echo get_option('scrollup_folder'); ?>/js/paypal.js?merchant=aprilis2003@mail.ru" 
					    data-button="donate" 
					    data-name="WP-ScrollUp" 
					    data-quantity="1" 
					    data-amount="9.90" 
					    data-currency="USD" 
					    data-shipping="0" 
					    data-tax="0" 
					    data-callback="http://dedushka.org/pay"
					></script>
				</div>
			</div>
			
			<div class="postbox">
				<h3 class="hndle"><span>Community</span></h3>
				<div class="inside">
					<ul>
						<li><a href="http://qbx.me" target="_blank">Support Forums</a> (English + Russian)</li>
						<li>See the <a href="http://dedushka.org/uroki/5503.html">template examples</a></li>
						<li><a href="http://dedushka.org" target="_blank">My blog in Russian</a></li>
					</ul>
				</div>
			</div>
			<div class="postbox">
				<h3 class="hndle"><span>Contact me</span></h3>
				<div class="inside">
					<ul>
						<li>Feel free to <a href="mailto:a@dedushka.org">mail me</a> on propositions.</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?}?>