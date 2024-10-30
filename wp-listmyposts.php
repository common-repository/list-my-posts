<?php
	/*
	Plugin Name: ListMyPosts
	Plugin URI: http://silvercover.ir/list-my-posts
	Description: Plugin for displaying latest posts in a box at top of your pages to gain more attraction.
	Author: Hamed Takmil
	Version: 1.0
	Author URI: http://silvercover.ir
	*/
	
	/*
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
	*/


//We call this for localization.   
load_plugin_textdomain('ListMyPosts', PLUGINDIR.'/'.dirname(plugin_basename(__FILE__)), dirname(plugin_basename(__FILE__)).'/languages/');

//Define plugin base name and folder as a constant.
$mldp = plugin_basename(__FILE__);  
$plugin_full_url_path = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
$tipStyle = 'font-size:8pt;color:#808080';

define('tipStyle', $tipStyle);
define('ListMyPostsPath', $mldp);
define('WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
define('SITE_URL', get_option('siteurl'));
define('PLUGIN_FULL_URL', $plugin_full_url_path);


//Plugin installation function which will be called on activation.
add_action('activate_ListMyPosts/ListMyPosts.php', 'ListMyPostsInstall');
function ListMyPostsInstall(){
/* 	update_option('lmp_box_title', '');		
	update_option('lmp_title_alignment', 'c');
	update_option('lmp_title_font_size', '16px');
	update_option('lmp_number_of_links', '10');
	update_option('lmp_bg_color', '');
	update_option('lmp_border_color', '');
	update_option('lmp_link_color', $lmp_link_color);	
	update_option('lmp_hover_link_color', $lmp_hover_link_color);
	update_option('lmp_link_icon', $lmp_link_icon);
	update_option('lmp_border_thickness', $lmp_border_thickness);
	update_option('lmp_tl_corner_radius', $lmp_tl_corner_radius);
	update_option('lmp_tr_corner_radius', $lmp_tr_corner_radius);
	update_option('lmp_bl_corner_radius', $lmp_bl_corner_radius);
	update_option('lmp_br_corner_radius', $lmp_br_corner_radius);
	update_option('lmp_padding', $lmp_padding); */
}

register_activation_hook(__FILE__, 'ListMyPostsInstall');

// Hook for adding admin menus
add_action('admin_menu', 'ListMyPostsAdminActions');

add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );
function mw_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', plugins_url('my-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}

// action function for above hook
function ListMyPostsAdminActions() {
     $icon_url = '';
     $position = '';
    // Add a new top-level menu (ill-advised):
    add_menu_page(__('ListMyPosts', 'ListMyPosts'), __('ListMyPosts', 'ListMyPosts'), 'administrator', 'ListMyPosts', 'ListMyPostsAdminPage');
}

function ListMyPostsAdminPage() {

 if($_POST['posted_option_hidden'] == 'Y' && check_admin_referer('ListMyPosts_admin_option-update')) {
  
    $lmp_box_title  = $_POST['lmp_box_title'];
	update_option('lmp_box_title', $lmp_box_title);
		
	$lmp_title_alignment = $_POST['lmp_title_alignment'];
	update_option('lmp_title_alignment', $lmp_title_alignment);
	
	$lmp_title_font_size  = $_POST['lmp_title_font_size'];
	update_option('lmp_title_font_size', $lmp_title_font_size);
	
	$lmp_number_of_links = $_POST['lmp_number_of_links'];
	update_option('lmp_number_of_links', $lmp_number_of_links);
	
	$lmp_bg_color  = $_POST['lmp_bg_color'];
	update_option('lmp_bg_color', $lmp_bg_color);
	
	$lmp_border_color = $_POST['lmp_border_color'];
	update_option('lmp_border_color', $lmp_border_color);

	$lmp_link_color = $_POST['lmp_link_color'];
	update_option('lmp_link_color', $lmp_link_color);	
	
	$lmp_hover_link_color = $_POST['lmp_hover_link_color'];
	update_option('lmp_hover_link_color', $lmp_hover_link_color);

	$lmp_link_icon = $_POST['lmp_link_icon'];
	update_option('lmp_link_icon', $lmp_link_icon);

	$lmp_border_thickness = $_POST['lmp_border_thickness'];
	update_option('lmp_border_thickness', $lmp_border_thickness);

	$lmp_link_right_padding = $_POST['lmp_link_right_padding'];
	update_option('lmp_link_right_padding', $lmp_link_right_padding);
	
	$lmp_link_left_padding = $_POST['lmp_link_left_padding'];
	update_option('lmp_link_left_padding', $lmp_link_left_padding);
	
	$lmp_tl_corner_radius = $_POST['lmp_tl_corner_radius'];
	update_option('lmp_tl_corner_radius', $lmp_tl_corner_radius);

	$lmp_tr_corner_radius = $_POST['lmp_tr_corner_radius'];
	update_option('lmp_tr_corner_radius', $lmp_tr_corner_radius);

	$lmp_bl_corner_radius = $_POST['lmp_bl_corner_radius'];
	update_option('lmp_bl_corner_radius', $lmp_bl_corner_radius);

	$lmp_br_corner_radius = $_POST['lmp_br_corner_radius'];
	update_option('lmp_br_corner_radius', $lmp_br_corner_radius);

	$lmp_padding = $_POST['lmp_padding'];
	update_option('lmp_padding', $lmp_padding);	
	
	$lmp_horizontal_shadow = $_POST['lmp_horizontal_shadow'];	
	update_option('lmp_horizontal_shadow', $lmp_horizontal_shadow);
	
	$lmp_shadow_size = $_POST['lmp_shadow_size'];	
	update_option('lmp_shadow_size', $lmp_shadow_size);	
	
	$lmp_vertical_shadow = $_POST['lmp_vertical_shadow'];	       
	update_option('lmp_vertical_shadow', $lmp_vertical_shadow);
	
	$lmp_shadow_color = $_POST['lmp_shadow_color'];		
	update_option('lmp_shadow_color', $lmp_shadow_color);
	
	$lmp_icon_top_position	= $_POST['lmp_icon_top_position'];
	update_option('lmp_icon_top_position', $lmp_icon_top_position);

	$lmp_icon_left_position	= $_POST['lmp_icon_left_position'];
	update_option('lmp_icon_left_position', $lmp_icon_left_position);
	
	$lmp_post_cat = $_POST['lmp_post_cat'];
	update_option('lmp_post_cat', $lmp_post_cat);
	
	$lmp_random_post = $_POST['lmp_random_post'];
	update_option('lmp_random_post', $lmp_random_post);
	
	$lmp_title_bottom_margin = $_POST['lmp_title_bottom_margin'];
	update_option('lmp_title_bottom_margin', $lmp_title_bottom_margin);
	
	$lmp_title_color =  $_POST['lmp_title_color'];
	update_option('lmp_title_color', $lmp_title_color);
	
	$lmp_link_alignment = $_POST['lmp_link_alignment'];
	update_option('lmp_link_alignment', $lmp_link_alignment);
	
	$lmp_link_right_margin = $_POST['lmp_link_right_margin'];
	update_option('lmp_link_right_margin', $lmp_link_right_margin);
	
	$lmp_link_left_margin = $_POST['lmp_link_left_margin'];
	update_option('lmp_link_left_margin', $lmp_link_left_margin);
	
	?>
	<div class="updated fade"><p><strong><?php _e('Options saved.'); ?></strong></p></div>
	<?php
} else {
    $lmp_box_title  = get_option('lmp_box_title');	
	$lmp_title_alignment = get_option('lmp_title_alignment');
	$lmp_title_font_size  = get_option('lmp_title_font_size');
	$lmp_number_of_links = get_option('lmp_number_of_links');
	$lmp_bg_color  = get_option('lmp_bg_color');
	$lmp_border_color = get_option('lmp_border_color');
	$lmp_link_color = get_option('lmp_link_color');	
	$lmp_hover_link_color = get_option('lmp_hover_link_color');
	$lmp_link_icon = get_option('lmp_link_icon');
	$lmp_link_right_padding = get_option('lmp_link_right_padding');
	$lmp_link_left_padding = get_option('lmp_link_left_padding'); 
	$lmp_border_thickness = get_option('lmp_border_thickness');
	$lmp_tl_corner_radius = get_option('lmp_tl_corner_radius');
	$lmp_tr_corner_radius = get_option('lmp_tr_corner_radius');
	$lmp_bl_corner_radius = get_option('lmp_bl_corner_radius');
	$lmp_br_corner_radius = get_option('lmp_br_corner_radius');
	$lmp_padding = get_option('lmp_padding');	       
	$lmp_horizontal_shadow = get_option('lmp_horizontal_shadow');	       
	$lmp_shadow_size = get_option('lmp_shadow_size');	       
	$lmp_vertical_shadow = get_option('lmp_vertical_shadow');	       
	$lmp_shadow_color = get_option('lmp_shadow_color');	
	$lmp_icon_top_position	= get_option('lmp_icon_top_position');
	$lmp_post_cat	= get_option('lmp_post_cat');
	$lmp_random_post = get_option('lmp_random_post');
	$lmp_title_bottom_margin = get_option('lmp_title_bottom_margin');
	$lmp_title_color = get_option('lmp_title_color');
	$lmp_link_alignment = get_option('lmp_link_alignment');
	$lmp_icon_left_position = get_option('lmp_icon_left_position');
}
?>
 <div class="wrap">
   <div>
   <a style="display: block;margin: 5px auto;width: 460px;" target="_blank" href="http://silvercover.ir/contact">
	<img style="border:1px solid gray" src="<?php echo PLUGIN_FULL_URL.'images/wp-localize-banner-ad.png' ?>" />
   </a>
   </div>
   <?php echo '<h2 style="display:block">' . __('ListMyPosts Settings', 'ListMyPosts') . '</h2>'; ?>
   <form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
   <?php wp_nonce_field('update-options'); ?>
   <input type="hidden" name="posted_option_hidden" value="Y">
   <table class="form-table">
	 <tr colspan="2">
		<td colspan="2" style="background-color:#E6F0F4;height:15px;line-height: 0; border-radius: 5px 5px 5px 5px;"><h3>
			<?php echo __('Header Area', 'ListMyPosts')?></h3>
		</td>
		<td style="background-color:#F7DE88;height:15px;line-height: 0; border-radius: 5px 5px 5px 5px;text-align:center;width: 100px;">
			<a target="_blank" href="<?php echo PLUGIN_FULL_URL.'images/option-guide-ss.jpg' ?>"
			style="text-decoration:none;padding-bottom3px;border-bottom:1px dotted gray">
				<?php echo __('Quick Help', 'ListMyPosts')?>
			</a>
		</td>
	 </tr>
     <tr valign="top">
     <th scope="row"><?php echo __('Box Title', 'ListMyPosts')?>:</th>
      <td>
		<input type="text" name="lmp_box_title" value="<?php echo $lmp_box_title?>" size="40"/><br/>
		<span style="<?php echo tipStyle; ?>"><?php echo _e('Leave blank to hide title.', 'ListMyPosts')?></span>
	  </td>
     </tr>
     <tr valign="top">
     <th scope="row"><?php echo __('Title Alignment', 'ListMyPosts')?>:</th>
      <td>
      <select name="lmp_title_alignment">
    <?php
        if ($lmp_title_alignment == 'right'){?>
        <option value="right" selected="selected"><?php echo __(' Right ', 'ListMyPosts')?></option>
        <option value="center" ><?php echo __(' Center ', 'ListMyPosts')?></option>
        <option value="left" ><?php echo __(' Left ', 'ListMyPosts')?></option>
    <?php }
		else if ($lmp_title_alignment == 'center'){?>
        <option value="center" selected="selected"><?php echo __(' Center ', 'ListMyPosts')?></option>
		<option value="right" ><?php echo __(' Right ', 'ListMyPosts')?></option>
		<option value="left" ><?php echo __(' Left ', 'ListMyPosts')?></option>
    <?php } 
		else if ($lmp_title_alignment == 'left'){?>
		<option value="left" selected="selected"><?php echo __(' Left ', 'ListMyPosts')?></option>
		<option value="right" ><?php echo __(' Right ', 'ListMyPosts')?></option>
        <option value="center" ><?php echo __(' Center ', 'ListMyPosts')?></option>
	<?php } else { ?>
		<option value="left" ><?php echo __(' Left ', 'ListMyPosts')?></option>
        <option value="center" ><?php echo __(' Center ', 'ListMyPosts')?></option>		
		<option value="right" ><?php echo __(' Right ', 'ListMyPosts')?></option>
	<?php }	?>
      </select>
      </td>
     </tr>
     <tr valign="top">
     <th scope="row"><?php echo __('Title Bottom Margin', 'ListMyPosts')?>:</th>
      <td><input type="text" name="lmp_title_bottom_margin" value="<?php echo $lmp_title_bottom_margin?>" size="2"/>
	      <span style="<?php echo tipStyle; ?>"><?php echo __('In pixel.', 'ListMyPosts')?></span>
	  </td>
     </tr>		 
     <tr valign="top">
     <th scope="row"><?php echo __('Title Font Size', 'ListMyPosts')?>:</th>
      <td><input type="text" name="lmp_title_font_size" value="<?php echo $lmp_title_font_size?>" size="2"/>
	      <span style="<?php echo tipStyle; ?>"><?php echo __('In pixel.', 'ListMyPosts')?></span>
	  </td>
     </tr>	
     <tr valign="top">
     <th scope="row"><?php echo __('Title Color', 'ListMyPosts')?>:</th>
      <td>
       <input type="text" name="lmp_title_color" id="lmp_title_color" value="<?php echo $lmp_title_color?>" size="8"/>
	   <script> 
		jQuery(document).ready(function($){
			$('#lmp_title_color').wpColorPicker();
		});
	  </script>
       <br/>
       <span style="<?php echo tipStyle; ?>"><?php echo __('It must be in HEX format.', 'ListMyPosts')?></span>
     </td>
     </tr>	 
	 <tr colspan="2">
		<td colspan="2" style="background-color:#E6F0F4;height:15px;line-height: 0; border-radius: 5px 5px 5px 5px;"><h3>
			<?php echo __('Box Area', 'ListMyPosts')?></h3>
		</td>
		<td style="background-color:#F7DE88;height:15px;line-height: 0; border-radius: 5px 5px 5px 5px;text-align:center;width: 100px;">
			<a target="_blank" href="<?php echo PLUGIN_FULL_URL.'images/option-guide-ss.jpg' ?>"
			style="text-decoration:none;padding-bottom3px;border-bottom:1px dotted gray">
				<?php echo __('Quick Help', 'ListMyPosts')?>
			</a>
		</td>	
	 </tr>	 
     <tr valign="top">
     <th scope="row"><?php echo __('Background Color', 'ListMyPosts')?>:</th>
      <td>
       <input type="text" name="lmp_bg_color" id="lmp_bg_color" value="<?php echo $lmp_bg_color?>" size="8"/>
	   <script> 
		jQuery(document).ready(function($){
			$('#lmp_bg_color').wpColorPicker();
		});
	  </script>
       <br/>
       <span style="<?php echo tipStyle; ?>"><?php echo __('It must be in HEX format.', 'ListMyPosts')?></span>
     </td>
     </tr>
     <tr valign="top">
     <th scope="row"><?php echo __('Border Color', 'ListMyPosts')?>:</th>
      <td>
       <input type="text" name="lmp_border_color" id="lmp_border_color" value="<?php echo $lmp_border_color?>" size="8"/>
	   <script> 
		jQuery(document).ready(function($){
			$('#lmp_border_color').wpColorPicker();
		});
	  </script>
       <br/>
       <span style="<?php echo tipStyle; ?>"><?php echo __('It must be in HEX format.', 'ListMyPosts')?></span>
     </td>
     </tr>   	 
     <tr valign="top">
     <th scope="row"><?php echo __('Border Thickness', 'ListMyPosts')?>:</th>
      <td>
          <input type="text" name="lmp_border_thickness" value="<?php echo $lmp_border_thickness?>" size="2"/>
          <span style="<?php echo tipStyle; ?>"><?php echo __('In pixel.', 'ListMyPosts')?></span>
      </td>
     </tr>	 	 
	 <tr valign="top">
     <th scope="row"><?php echo __('Top Left Corner Radius', 'ListMyPosts')?>:</th>
      <td>
          <input type="text" name="lmp_tl_corner_radius" value="<?php echo $lmp_tl_corner_radius?>" size="2"/>
          <span style="<?php echo tipStyle; ?>"><?php echo __('In pixel.', 'ListMyPosts')?></span>
      </td>
     </tr>	
     <tr valign="top">
     <th scope="row"><?php echo __('Top Right Corner Radius', 'ListMyPosts')?>:</th>
      <td>
          <input type="text" name="lmp_tr_corner_radius" value="<?php echo $lmp_tr_corner_radius?>" size="2"/>
          <span style="<?php echo tipStyle; ?>"><?php echo __('In pixel.', 'ListMyPosts')?></span>
      </td>
     </tr>	
     <tr valign="top">
     <th scope="row"><?php echo __('Bottom Left Corner Radius', 'ListMyPosts')?>:</th>
      <td>
          <input type="text" name="lmp_bl_corner_radius" value="<?php echo $lmp_bl_corner_radius?>" size="2"/>
          <span style="<?php echo tipStyle; ?>"><?php echo __('In pixel.', 'ListMyPosts')?></span>
      </td>
     </tr>	
     <tr valign="top">
     <th scope="row"><?php echo __('Bottem Right Corner Radius', 'ListMyPosts')?>:</th>
      <td>
          <input type="text" name="lmp_br_corner_radius" value="<?php echo $lmp_br_corner_radius?>" size="2"/>
          <span style="<?php echo tipStyle; ?>"><?php echo __('In pixel.', 'ListMyPosts')?></span>
      </td>
     </tr>
     <tr valign="top">
     <th scope="row"><?php echo __('Padding', 'ListMyPosts')?>:</th>
      <td>
          <input type="text" name="lmp_padding" value="<?php echo $lmp_padding?>" size="2"/>
          <span style="<?php echo tipStyle; ?>"><?php echo __('In pixel.', 'ListMyPosts')?></span>
      </td>
     </tr>	
     <tr valign="top">
     <th scope="row"><?php echo __('Horizontal Shadow', 'ListMyPosts')?>:</th>
      <td>
          <input type="text" name="lmp_horizontal_shadow" value="<?php echo $lmp_horizontal_shadow?>" size="2"/>
          <span style="<?php echo tipStyle; ?>"><?php echo __('In pixel.', 'ListMyPosts')?></span>
      </td>
     </tr>
     <tr valign="top">
     <th scope="row"><?php echo __('Vertical Shadow', 'ListMyPosts')?>:</th>
      <td>
          <input type="text" name="lmp_vertical_shadow" value="<?php echo $lmp_vertical_shadow?>" size="2"/>
          <span style="<?php echo tipStyle; ?>"><?php echo __('In pixel.', 'ListMyPosts')?></span>
      </td>
     </tr>
     <tr valign="top">
     <th scope="row"><?php echo __('Size of Shadow', 'ListMyPosts')?>:</th>
      <td>
          <input type="text" name="lmp_shadow_size" value="<?php echo $lmp_shadow_size?>" size="2"/>
          <span style="<?php echo tipStyle; ?>"><?php echo __('In pixel.', 'ListMyPosts')?></span>
      </td>
     </tr>		 
     <tr valign="top">
     <th scope="row"><?php echo __('Shadow Color', 'ListMyPosts')?>:</th>
      <td>
          <input type="text" name="lmp_shadow_color" id="lmp_shadow_color" value="<?php echo $lmp_shadow_color?>" size="2"/>
			<script> 
			jQuery(document).ready(function($){
				$('#lmp_shadow_color').wpColorPicker();
			});
			</script>
			<br/>		  
          <span style="<?php echo tipStyle; ?>"><?php echo __('It must be in HEX format.', 'ListMyPosts')?></span>
      </td>
     </tr>	
	 <tr colspan="2">
		<td colspan="2" style="background-color:#E6F0F4;height:15px;line-height: 0; border-radius: 5px 5px 5px 5px;"><h3>
			<?php echo __('Links & Posts Style', 'ListMyPosts')?></h3>
		</td>
		<td style="background-color:#F7DE88;height:15px;line-height: 0; border-radius: 5px 5px 5px 5px;text-align:center;width: 100px;">
			<a target="_blank" href="<?php echo PLUGIN_FULL_URL.'images/option-guide-ss.jpg' ?>"
			style="text-decoration:none;padding-bottom3px;border-bottom:1px dotted gray">
				<?php echo __('Quick Help', 'ListMyPosts')?>
			</a>
		</td>		
	 </tr>	
     <tr valign="top">
     <th scope="row"><?php echo __('Link Align', 'ListMyPosts')?>:</th>
      <td>
      <select name="lmp_link_alignment">
    <?php
        if ($lmp_link_alignment == 'rtl'){?>
        <option value="rtl" selected="selected"><?php echo __(' Right ', 'ListMyPosts')?></option>
        <option value="ltr" ><?php echo __(' Left ', 'ListMyPosts')?></option>
    <?php } else { ?>
		<option value="ltr" selected="selected"><?php echo __(' Left ', 'ListMyPosts')?></option>
		<option value="rtl" ><?php echo __(' Right ', 'ListMyPosts')?></option>
	<?php } ?>
      </select>
      </td>
     </tr>		 
     <tr valign="top">
     <th scope="row"><?php echo __('Posts Category', 'ListMyPosts')?>:</th>
      <td>
		<?php 
			$args = array(
				'show_option_all'    => '--------- '.__('Show from all', 'ListMyPosts').' ---------',
				'show_option_none'   => '',
				'orderby'            => 'ID', 
				'order'              => 'ASC',
				'show_count'         => 1,
				'hide_empty'         => 0, 
				'child_of'           => 0,
				'exclude'            => '',
				'echo'               => 1,
				'selected'           => $lmp_post_cat,
				'hierarchical'       => true, 
				'name'               => 'lmp_post_cat',
				'id'                 => '',
				'class'              => 'postform',
				'depth'              => 0,
				'tab_index'          => 0,
				'taxonomy'           => 'category',
				'hide_if_empty'      => false,
				'walker'             => '');   		
				wp_dropdown_categories( $args ); 
		?>
      </td>
     </tr> 	 
     <tr valign="top">
     <th scope="row"><?php echo __('Random Posts', 'ListMyPosts')?>:</th>
      <td>
      <select name="lmp_random_post">
		<?php
			if ($lmp_random_post){?>
			<option value="1" selected="selected"><?php echo __(' Yes ', 'ListMyPosts')?></option>
			<option value="0" ><?php echo __(' No ', 'ListMyPosts')?></option>
		<?php }else{?>
			<option value="0" selected="selected"><?php echo __(' No ', 'ListMyPosts')?></option>
			<option value="1" ><?php echo __(' Yes ', 'ListMyPosts')?></option>
		<?php } ?>
      </select>
      </td>
     </tr>	 
     <tr valign="top">	 
     <th scope="row"><?php echo __('Number of Links', 'ListMyPosts')?>:</th>
      <td>
          <input type="text" name="lmp_number_of_links" value="<?php echo $lmp_number_of_links?>" size="2"/>
      </td>
     </tr>
     <tr valign="top">
     <th scope="row"><?php echo __('Link Right Padding', 'ListMyPosts')?>:</th>
      <td>
          <input type="text" name="lmp_link_right_padding" value="<?php echo $lmp_link_right_padding?>" size="2"/>
          <span style="<?php echo tipStyle; ?>"><?php echo __('In pixel.', 'ListMyPosts')?></span>
      </td>
     </tr>	
     <tr valign="top">
     <th scope="row"><?php echo __('Link Left Padding', 'ListMyPosts')?>:</th>
      <td>
          <input type="text" name="lmp_link_left_padding" value="<?php echo $lmp_link_left_padding?>" size="2"/>
          <span style="<?php echo tipStyle; ?>"><?php echo __('In pixel.', 'ListMyPosts')?></span>
      </td>
     </tr>	
     <tr valign="top">
     <th scope="row"><?php echo __('Link Right Margin', 'ListMyPosts')?>:</th>
      <td>
          <input type="text" name="lmp_link_right_margin" value="<?php echo $lmp_link_right_margin?>" size="2"/>
          <span style="<?php echo tipStyle; ?>"><?php echo __('In pixel.', 'ListMyPosts')?></span>
      </td>
     </tr>	
     <tr valign="top">
     <th scope="row"><?php echo __('Link Left Margin', 'ListMyPosts')?>:</th>
      <td>
          <input type="text" name="lmp_link_left_margin" value="<?php echo $lmp_link_left_margin?>" size="2"/>
          <span style="<?php echo tipStyle; ?>"><?php echo __('In pixel.', 'ListMyPosts')?></span>
      </td>
     </tr>		  
     <tr valign="top">	 
     <th scope="row"><?php echo __('Icon Top Position', 'ListMyPosts')?>:</th>
      <td>
          <input type="text" name="lmp_icon_top_position" value="<?php echo $lmp_icon_top_position?>" size="2"/>
          <span style="<?php echo tipStyle; ?>"><?php echo __('In pixel.', 'ListMyPosts')?></span>
      </td>
     </tr>	
     <tr valign="top">	 
     <th scope="row"><?php echo __('Icon Left Position', 'ListMyPosts')?>:</th>
      <td>
          <input type="text" name="lmp_icon_left_position" value="<?php echo $lmp_icon_left_position?>" size="2"/>
          <span style="<?php echo tipStyle; ?>"><?php echo __('In pixel.', 'ListMyPosts')?></span>
      </td>
     </tr>		 
     <tr valign="top">
     <th scope="row"><?php echo __('Link Icon', 'ListMyPosts')?>:</th>
      <td>
	<?php
      $dir_path = str_replace( $_SERVER['SCRIPT_FILENAME'], "", dirname(realpath(__FILE__)) ) . DIRECTORY_SEPARATOR;
      $handle=opendir($dir_path.'/styles/icons/');
	  $lmp_link_icon = get_option('lmp_link_icon');
       while (false!==($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
         if ($lmp_link_icon == $file) {
          echo '<input type="radio" name="lmp_link_icon" value="'.$file.'" checked="checked" /> 
				<img src="'.PLUGIN_FULL_URL.'styles/icons/'.$file.'"/> ';
         }else {
          echo '<input type="radio" name="lmp_link_icon" value="'.$file.'" /> 
				<img src="'.PLUGIN_FULL_URL.'styles/icons/'.$file.'"/> ';
         }
		 }
        }
        closedir($handle); 
	?>
     </td>
     </tr> 		 
     <tr valign="top">
     <th scope="row"><?php echo __('Link Color', 'ListMyPosts')?>:</th>
      <td>
       <input type="text" name="lmp_link_color" id="lmp_link_color" value="<?php echo $lmp_link_color?>" size="8"/>
	   <script> 
		jQuery(document).ready(function($){
			$('#lmp_link_color').wpColorPicker();
		});
	  </script>
       <br/>
       <span style="<?php echo tipStyle; ?>"><?php echo __('It must be in HEX format.', 'ListMyPosts')?></span>
     </td>
     </tr>  	
     <tr valign="top">
     <th scope="row"><?php echo __('Hover Link Color', 'ListMyPosts')?>:</th>
      <td>
       <input type="text" name="lmp_hover_link_color" id="lmp_hover_link_color" value="<?php echo $lmp_hover_link_color?>" size="8"/>
	   <script> 
		jQuery(document).ready(function($){
			$('#lmp_hover_link_color').wpColorPicker();
		});
	  </script>
       <br/>
       <span style="<?php echo tipStyle; ?>"><?php echo __('It must be in HEX format.', 'ListMyPosts')?></span>
     </td>
     </tr> 	  
   </table>
   <input type="hidden" name="action" value="update" />
   <input type="hidden" name="page_options" value="link_title,link" />
   <p class="submit">
    <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
   </p>
   <?php wp_nonce_field('ListMyPosts_admin_option-update');?>
   </form>
   <br/>
   </div>

<?php
}

//Display links at Front-end.
function ListMyPostsShow($type="standard", $args = '') {
	global $wpdb;
	$wpdb->hide_errors();
	$random = get_option('lmp_random_post');
	if ($random){
		$random = 'rand';
	}else{
		$random = 'post_date';
	}
	$args = array(
		'posts_per_page'   => get_option('lmp_number_of_links'),
		'offset'           => 0,
		'category'         => get_option('lmp_post_cat'),
		'orderby'          => $random,
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'post',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'post_status'      => 'publish',
		'suppress_filters' => true );
	$myposts = get_posts( $args );
	$lmpBlock = '<div id="lmpBox">';
	$title = get_option('lmp_box_title');
	if (!empty($title)){
				$lmpBlock .= '<h2>'.get_option('lmp_box_title').'</h2>';
	}
	$lmpBlock .= '<div class="lmp_box_wrapper">
					<ul>';
	foreach ( $myposts as $post ) : 
		setup_postdata( $post );
		$lmpBlock .= '<li><a href="'. get_permalink($post->ID).'">'. get_the_title($post->ID).'</a></li>';
	endforeach;	
	$lmpBlock .= '  </ul>
				</div>
				</div>';
	
	echo $lmpBlock;

}

//Shortcode
add_shortcode("ListMyPosts", "ListMyPostsShow");

// Write box style in header
function ListMyPostsWriteCSS() {
 echo '<style>
		.entry ul li:before {  content: "" !important; }
		.entry ul li:after {  content: "" !important; }
		#lmpBox h2{
			font-size:'.get_option('lmp_title_font_size').'px !important;
			text-align:'.get_option('lmp_title_alignment').' !important;
			color:'.get_option('lmp_title_color').'!important;
			margin-bottom: '.get_option('lmp_title_bottom_margin').'px !important;
		}
		.lmp_box_wrapper {
			background-color:'.get_option('lmp_bg_color').' !important; 
			border:'.get_option('lmp_border_thickness').'px solid '.get_option('lmp_border_color').'!important;
			border-radius:'.get_option('lmp_tl_corner_radius').'px '.get_option('lmp_tr_corner_radius').'px '
						   .get_option('lmp_br_corner_radius').'px '.get_option('lmp_bl_corner_radius').'px !important;
			padding:'.get_option('lmp_padding').'px !important; 
			box-shadow:'.get_option('lmp_horizontal_shadow').'px '.get_option('lmp_vertical_shadow').'px '
			            .get_option('lmp_shadow_size').'px '.get_option('lmp_shadow_color').' !important;
			margin: 15px auto !important;
		}
		.lmp_box_wrapper ul li{			
			list-style-type: none !important;
			background: url('.get_option('siteurl').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__)).'/styles/icons/'
				                   .get_option('lmp_link_icon').') no-repeat '.get_option('lmp_icon_left_position').
								   'px '.get_option('lmp_icon_top_position').'px !important;
			padding-right:'.get_option('lmp_link_right_padding').'px !important;
			padding-left:'.get_option('lmp_link_left_padding').'px !important;
			margin: 0 '.get_option('lmp_link_right_margin').'px 0 '.get_option('lmp_link_left_margin').'px; 
			direction:'.get_option('lmp_link_alignment').';
		}
		.lmp_box_wrapper a {
			text-decoration: none !important;
			color:'.get_option('lmp_link_color').' !important;
		}
		.lmp_box_wrapper a:hover {
			color:'.get_option('lmp_hover_link_color').' !important;
		}		
	   </style>'; 
}
add_action('wp_head', 'ListMyPostsWriteCSS');

?>