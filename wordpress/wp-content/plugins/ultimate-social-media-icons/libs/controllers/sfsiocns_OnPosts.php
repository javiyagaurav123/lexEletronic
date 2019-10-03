<?php
/* add fb like add this end of every post */

function sfsi_social_buttons_below($content)
{
	global $post;
	$sfsi_section6 =  unserialize(get_option('sfsi_section6_options', false));
	$sfsi_section9   = unserialize(get_option('sfsi_section9_options', false));
	// if($sfsi_section9["sfsi_show_via_afterposts"]!=="yes"){
	// 	return $content;
	// }
	if($sfsi_section6["sfsi_display_button_type"]=="responsive_button"){
		if($sfsi_section6["sfsi_responsive_icons_end_post"]=="yes"){
			$content =   $content . sfsi_social_responsive_buttons(null, $sfsi_section6);
		}
	}else{
		//checking for standard icons
		if (!isset($sfsi_section6['sfsi_rectsub'])) {
			$sfsi_section6['sfsi_rectsub'] = 'no';
		}
		if (!isset($sfsi_section6['sfsi_rectfb'])) {
			$sfsi_section6['sfsi_rectfb'] = 'yes';
		}
		if (!isset($sfsi_section6['sfsi_rectshr'])) {
			$sfsi_section6['sfsi_rectshr'] = 'yes';
		}
		if (!isset($sfsi_section6['sfsi_recttwtr'])) {
			$sfsi_section6['sfsi_recttwtr'] = 'no';
		}
		if (!isset($sfsi_section6['sfsi_rectpinit'])) {
			$sfsi_section6['sfsi_rectpinit'] = 'no';
		}
		if (!isset($sfsi_section6['sfsi_rectfbshare'])) {
			$sfsi_section6['sfsi_rectfbshare'] = 'no';
		}
		//checking for standard icons

		/* check if option activated in admin or not */
		if ($sfsi_section6['sfsi_show_Onposts'] == "yes") {
			$permalink = get_permalink($post->ID);
			$title = get_the_title();
			$sfsiLikeWith = "45px;";
			/* check for counter display */
			if ($sfsi_section6['sfsi_icons_DisplayCounts'] == "yes") {
				$show_count = 1;
				$sfsiLikeWith = "125px;";
			} else {
				$show_count = 0;
			}
			$txt	= (isset($sfsi_section6['sfsi_textBefor_icons'])) ? $sfsi_section6['sfsi_textBefor_icons'] : "Please follow and like us:";
			$float	= $sfsi_section6['sfsi_icons_alignment'];
			if (($sfsi_section6['sfsi_show_Onposts'] == "yes") && ($sfsi_section6['sfsi_rectsub'] == 'yes' || $sfsi_section6['sfsi_rectfb'] == 'yes' || $sfsi_section6['sfsi_rectshr'] == 'yes' || $sfsi_section6['sfsi_recttwtr'] == 'yes' || $sfsi_section6['sfsi_rectpinit'] == 'yes' || $sfsi_section6['sfsi_rectfbshare'] == 'yes')) {
				$icons = "<div class='sfsi_Sicons' style='width: 100%; display: inline-block; vertical-align: middle; text-align:" . $float . "'><div style='margin:0px 8px 0px 0px; line-height: 24px'><span>" . $txt . "</span></div>";
			} else {
				$icons = "<div  style='margin:0'>";
			}
			//adding wrapper div
			$icons .= "<div class='sfsi_socialwpr'>";
			if ( $sfsi_section6['sfsi_rectsub'] == 'yes' && $sfsi_section6['sfsi_show_Onposts'] == "yes") {
				if ($show_count) {
					$sfsiLikeWithsub = "93px";
				} else {
					$sfsiLikeWithsub = "64px";
				}
				if (!isset($sfsiLikeWithsub)) {
					$sfsiLikeWithsub = $sfsiLikeWith;
				}
				$icons .= "<div class='sf_subscrbe' style='text-align:left;vertical-align: middle;float:left;width:" . $sfsiLikeWithsub . "'>" . sfsi_Subscribelike($permalink, $show_count) . "</div>";
			}
			if (($sfsi_section6['sfsi_show_Onposts'] == "yes") && ($sfsi_section6['sfsi_rectfb'] == 'yes' || $sfsi_section6['sfsi_rectfbshare'] == 'yes')) {
				if ($sfsi_section6['sfsi_rectfb'] == 'yes') {
					if ($show_count) {
						$sfsiLikeWithfb = "80px";
					} else {
						$sfsiLikeWithfb = "52px";
					}
				}
				if ($sfsi_section6['sfsi_rectfbshare'] == 'yes') {
					if ($show_count) {
						$sfsiLikeWithfb = "88px";
					} else {
						$sfsiLikeWithfb = "60px";
					}
				}
				if ($sfsi_section6['sfsi_rectfb'] == 'yes' && $sfsi_section6['sfsi_rectfbshare'] == 'yes') {
					if ($show_count) {
						$sfsiLikeWithfb = "125px";
					} else {
						$sfsiLikeWithfb = "98px";
					}
				}

				$icons .= "<div class='sf_fb' style='text-align:left;vertical-align: middle;width:" . $sfsiLikeWithfb . "'>" . sfsi_FBlike($permalink, $show_count) . "</div>";
			}
			if (( $sfsi_section6['sfsi_recttwtr'] == "yes" && $sfsi_section6['sfsi_show_Onposts'] == "yes")) {
				if ($show_count) {
					$sfsiLikeWithtwtr = "62px";
				} else {
					$sfsiLikeWithtwtr = "62px";
				}
				if (!isset($sfsiLikeWithtwtr)) {
					$sfsiLikeWithtwtr = $sfsiLikeWith;
				}
				$icons .= "<div class='sf_twiter' style='text-align:left;float:left;vertical-align: middle;width:auto'>" . sfsi_twitterlike($permalink, $show_count) . "</div>";
			}

			if (($sfsi_section6['sfsi_show_Onposts'] == "yes") && $sfsi_section6['sfsi_rectpinit'] == 'yes') {
				$sfsi_pinwidth = "47px";
				if ($show_count) {
					$sfsi_pinwidth = "100px";
				} else {
					$sfsi_pinwidth = "47px";
				}
				$icons .= "<div class='sf_pinit' style='text-align:left;vertical-align: middle;float:left;line-height: 20px;width:" . $sfsi_pinwidth . "'>" . sfsi_pinterest($permalink, $show_count) . "</div>";
			}
			$icons .= "</div>";
			//closing wrapper div
			$icons .= "</div>";
			if (!is_feed() && !is_home() && !is_page()) {
				$content =   $content . $icons;
			}
		}
	}
	return $content;
}

/*subscribe like*/
function sfsi_Subscribelike($permalink, $show_count)
{
	global $socialObj;
	$socialObj = new sfsi_SocialHelper();

	$sfsi_section2_options =  unserialize(get_option('sfsi_section2_options', false));
	$sfsi_section4_options = unserialize(get_option('sfsi_section4_options', false));
	$sfsi_section6_options =  unserialize(get_option('sfsi_section6_options', false));
	$url = (isset($sfsi_section2_options['sfsi_email_url'])) ? $sfsi_section2_options['sfsi_email_url'] : '';

	if ($sfsi_section4_options['sfsi_email_countsFrom'] == "source") {
		$feed_id = sanitize_text_field(get_option('sfsi_feed_id', false));
		$feed_data = $socialObj->SFSI_getFeedSubscriber($feed_id);
		$counts = $socialObj->format_num($feed_data);
		if (empty($scounts['email_count'])) {
			$counts = (string) "0";
		}
	} else {
		$counts = $sfsi_section4_options['sfsi_email_manualCounts'];
	}

	if ($sfsi_section6_options['sfsi_icons_DisplayCounts'] == "yes") {
		$icon = '<a href="' . $url . '" target="_blank"><img src="' . SFSI_PLUGURL . 'images/follow_subscribe.png" alt="error" /></a><span class="bot_no">' . $counts . '</span>';
	} else {
		$icon = '<a href="' . $url . '" target="_blank"><img src="' . SFSI_PLUGURL . 'images/follow_subscribe.png" alt="error" /></a>';
	}
	return $icon;
}
/*subscribe like*/
/*twitter like*/
function sfsi_twitterlike($permalink, $show_count)
{
	global $socialObj;
	$socialObj = new sfsi_SocialHelper();
	$twitter_text = '';
	if (!empty($permalink)) {
		$postid = url_to_postid($permalink);
	}
	if (!empty($postid)) {
		$twitter_text = get_the_title($postid);
	}
	return $socialObj->sfsi_twitterSharewithcount($permalink, $twitter_text, $show_count);
}
/*twitter like*/
/* create pinit button */
function sfsi_pinterest($permalink, $show_count)
{
	$pinit_html = '<a href="https://www.pinterest.com/pin/create/button/?url=&media=&description=" data-pin-do="buttonPin" data-pin-save="true"';
	if ($show_count) {
		$pinit_html .= 'data-pin-count="beside"';
	} else {
		$pinit_html .= 'data-pin-count="none"';
	}
	$pinit_html .= '></a>';

	return $pinit_html;
}

/* create fb like button */
function sfsi_FBlike($permalink, $show_count)
{
	$send = 'false';
	$width = 180;
	$fb_like_html = '';

	$option6 =  unserialize(get_option('sfsi_section6_options', false));
	if ($option6['sfsi_rectfbshare'] == 'yes' && $option6['sfsi_rectfb'] == 'yes') {
		$fb_like_html .= '<div class="fb-like" data-href="' . $permalink . '" data-width="' . $width . '" data-send="' . $send . '" data-show-faces="false"  data-action="like" data-share="true"';
	} else if ($option6['sfsi_rectfb'] == 'no' && $option6['sfsi_rectfbshare'] == 'yes') {
		$fb_like_html .= '<div class="fb-share-button" href="' . $permalink . '" data-width="' . $width . '" data-send="' . $send . '" ';
	} else {
		$fb_like_html .= '<div class="fb-like" data-href="' . $permalink . '" data-width="' . $width . '" data-send="' . $send . '" data-show-faces="false"  data-action="like" data-share="false" ';
	}
	if ($show_count == 1) {
		$fb_like_html .= 'data-layout="button_count"';
	} else {
		$fb_like_html .= 'data-layout="button"';
	}
	$fb_like_html .= ' ></div>';
	return $fb_like_html;
}

/* add all external javascript to wp_footer */
function sfsi_footer_script()
{
	$sfsi_section1 =  unserialize(get_option('sfsi_section1_options', false));
	$sfsi_section6 =  unserialize(get_option('sfsi_section6_options', false));
	$sfsi_section9   = unserialize(get_option('sfsi_section9_options', false));
	$sfsi_section2 =  unserialize(get_option('sfsi_section2_options', false));

	if (!isset($sfsi_section6['sfsi_rectsub'])) {
		$sfsi_section6['sfsi_rectsub'] = 'no';
	}
	if (!isset($sfsi_section6['sfsi_rectfb'])) {
		$sfsi_section6['sfsi_rectfb'] = 'yes';
	}
	if (!isset($sfsi_section6['sfsi_rectshr'])) {
		$sfsi_section6['sfsi_rectshr'] = 'yes';
	}
	if (!isset($sfsi_section6['sfsi_recttwtr'])) {
		$sfsi_section6['sfsi_recttwtr'] = 'no';
	}
	if (!isset($sfsi_section6['sfsi_rectpinit'])) {
		$sfsi_section6['sfsi_rectpinit'] = 'no';
	}
	if (!isset($sfsi_section6['sfsi_rectfbshare'])) {
		$sfsi_section6['sfsi_rectfbshare'] = 'no';
	}
	$sisi_common_options_check = (($sfsi_section9['sfsi_show_via_widget'] == "yes") || ($sfsi_section9['sfsi_icons_float'] == "yes") && (isset($sfsi_section9['sfsi_icons_floatPosition'])) || ($sfsi_section9['sfsi_show_via_shortcode'] == "yes"));
	$sfsi_section6['sfsi_show_Onposts'] = isset($sfsi_section6['sfsi_show_Onposts']) && !empty($sfsi_section6['sfsi_show_Onposts']) ? $sfsi_section6['sfsi_show_Onposts'] : "no";
	if ($sfsi_section1['sfsi_facebook_display'] == "yes") {
		// var_dump($sfsi_section6['sfsi_rectfb'],$sfsi_section6['sfsi_show_Onposts']);
		if ((($sfsi_section6['sfsi_rectfb'] == "yes" || $sfsi_section6['sfsi_rectfbshare'] == "yes") && $sfsi_section6['sfsi_show_Onposts'] == "yes") || $sisi_common_options_check && ($sfsi_section2['sfsi_facebookPage_option'] == "yes" || $sfsi_section2['sfsi_facebookLike_option'] == "yes" || $sfsi_section2['sfsi_facebookShare_option'] == "yes")) {
			?>
			<!--facebook like and share js -->
			<div id="fb-root"></div>
			<script>
				(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s);
					js.id = id;
					js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script>
		<?php
		}
	}
	if ($sfsi_section1['sfsi_youtube_display'] == "yes") {
		if ($sisi_common_options_check && ($sfsi_section2['sfsi_youtube_page'] == 'yes' || ($sfsi_section2['sfsi_youtube_follow'] == 'yes'))) {
			?>
			<script type="text/javascript">
				window.___gcfg = {
					lang: 'en-US'
				};
				(function() {
					var po = document.createElement('script');
					po.type = 'text/javascript';
					po.async = true;
					po.src = 'https://apis.google.com/js/plusone.js';
					var s = document.getElementsByTagName('script')[0];
					s.parentNode.insertBefore(po, s);
				})();
			</script>

			<script type="text/javascript">
				(function() {
					var po = document.createElement('script');
					po.type = 'text/javascript';
					po.async = true;
					po.src = 'https://apis.google.com/js/platform.js';
					var s = document.getElementsByTagName('script')[0];
					s.parentNode.insertBefore(po, s);
				})();
			</script>
		<?php
		}
	}

	if ($sfsi_section1['sfsi_linkedin_display'] == "yes") {
		if ($sisi_common_options_check && ($sfsi_section2['sfsi_linkedin_page'] == 'yes' || $sfsi_section2['sfsi_linkedin_follow'] == 'yes' || $sfsi_section2['sfsi_linkedin_SharePage'] == 'yes' || $sfsi_section2['sfsi_linkedin_recommendBusines'] == 'yes')) {

			?>
			<script src="//platform.linkedin.com/in.js" type="text/javascript">
				lang: en_US
			</script>
		<?php
		}
	}
	if ($sfsi_section1['sfsi_pinterest_display'] == "yes") {
		if (( $sfsi_section6['sfsi_rectpinit'] == "yes" && $sfsi_section6['sfsi_show_Onposts'] == "yes") || $sisi_common_options_check && ($sfsi_section2['sfsi_pinterest_page'] == 'yes' || $sfsi_section2['sfsi_pinterest_pingBlog'] == 'yes')) { ?>
			<!--pinit js -->
			<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
		<?php
		}
	}

	if ($sfsi_section1['sfsi_twitter_display'] == "yes") {
		if (( $sfsi_section6['sfsi_recttwtr'] == "yes" && $sfsi_section6['sfsi_show_Onposts'] == "yes") || ($sisi_common_options_check && ($sfsi_section2['sfsi_twitter_page'] == 'yes' || $sfsi_section2['sfsi_twitter_followme'] == 'yes' || $sfsi_section2['sfsi_twitter_aboutPage'] == 'yes'))) { ?>
			<!-- twitter JS End -->
			<script>
				! function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (!d.getElementById(id)) {
						js = d.createElement(s);
						js.id = id;
						js.src = "https://platform.twitter.com/widgets.js";
						fjs.parentNode.insertBefore(js, fjs);
					}
				}(document, "script", "twitter-wjs");
			</script>
		<?php
		}
	}
	/* activate footer credit link */
	if (get_option('sfsi_footer_sec') == "yes") {
		if (!is_admin()) {
			//$footer_link='<div class="sfsiplus_footerLnk" style="margin: 0 auto;z-index:1000; absolute; text-align: center;">Social media & sharing icons powered by  <a href="https://wordpress.org/plugins/ultimate-social-media-icons/" target="new">UltimatelySocial</a> ';

			$sfsi_themecheck = new sfsi_ThemeCheck();
			$domain 	= $sfsi_themecheck->sfsi_plus_getdomain(get_site_url());
			$firstCharacter = substr($domain, 0, 1);
			if (in_array($firstCharacter, array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm'))) {
				$footer_link = '<div class="sfsiplus_footerLnk" style="margin: 0 auto;z-index:1000; text-align: center;">Social media & sharing icons  powered by <a href="https://www.ultimatelysocial.com/?utm_source=usmplus_settings_page&utm_campaign=credit_link_to_homepage&utm_medium=banner" target="new">UltimatelySocial </a>';
				$footer_link .= "</div>";
				echo $footer_link;
			} else if (in_array($firstCharacter, array('n', 'o', 'p', 'q', 'r', 's'))) {
				$footer_link = '<div class="sfsiplus_footerLnk" style="margin: 0 auto;z-index:1000; text-align: center;"><a href="https://www.ultimatelysocial.com/usm-premium/" target="new">Wordpress Social Share Plugin </a> powered by Ultimatelysocial';
				$footer_link .= "</div>";
				echo $footer_link;
			} else {
				$footer_link = '<div class="sfsiplus_footerLnk" style="margin: 0 auto;z-index:1000;text-align: center;"><a href="https://www.ultimatelysocial.com/?utm_source=usmplus_settings_page&utm_campaign=credit_link_to_homepage&utm_medium=banner" target="new">Social Share Buttons and Icons</a> powered by Ultimatelysocial';
				$footer_link .= "</div>";
				echo $footer_link;
			}
		}
	}
}
/* filter the content of post */
add_filter('the_content', 'sfsi_social_buttons_below');

/* update footer for frontend and admin both */
if (!is_admin()) {
	global $post;
	add_action('wp_footer', 'sfsi_footer_script');
	add_action('wp_footer', 'sfsi_check_PopUp');
	add_action('wp_footer', 'sfsi_frontFloter');
}

if (is_admin()) {
	add_action('in_admin_footer', 'sfsi_footer_script');
}
/* ping to vendor site on updation of new post */

//<---------------------* Responsive icons *----------------->
function sfsi_social_responsive_buttons($content,$option6,$server_side=false)
{
	global $wp;
	$count =60 ;
	if( ((isset($option6["sfsi_display_button_type"]) && $option6["sfsi_display_button_type"]=="responsive_button")) || $server_side ):
	    $option2 = unserialize(get_option('sfsi_section2_options',false));
	    $option4 = unserialize(get_option('sfsi_section4_options',false));
		$icons= "";
		$sfsi_responsive_icons = (isset($option6["sfsi_responsive_icons"])?$option6["sfsi_responsive_icons"]:null);
		$current_url = in_the_loop()?get_permalink():add_query_arg( $wp->query_vars, home_url( $wp->request ) );
		if(is_null($sfsi_responsive_icons) ){
			if($server_side){
				$sfsi_responsive_icons = array(
			        "default_icons" => array(
			            "facebook" => array("active" => "yes", "text" => "Share on Facebook", "url" => ""),
			            "Twitter" => array("active" => "yes", "text" => "Tweet", "url" => ""),
			            "Follow" => array("active" => "yes", "text" => "Follow us", "url" => "")
			        ),
			        "custom_icons" => array(),
			        "settings" => array(
			            "icon_size" => "Medium",
			            "icon_width_type" => "Fully responsive",
			            "icon_width_size" => 240,
			            "edge_type" => "Round",
			            "edge_radius" => 5,
			            "style" => "Gradient",
			            "margin" => 10,
			            "text_align" => "Centered",
			            "show_count" => "no",
			            "counter_color" => "#aaaaaa",
			            "counter_bg_color" => "#fff",
			            "share_count_text" => "SHARES"
			        )
			    );
			}else{
				return ""; // dont return anything if options not set;
			}
		}
		$twitter_text = isset($option2['sfsi_twitter_aboutPageText']) && !empty($option2['sfsi_twitter_aboutPageText']) ? $option2['sfsi_twitter_aboutPageText'] : false;

		$icon_width_type = $sfsi_responsive_icons["settings"]["icon_width_type"];
		if($option4['sfsi_display_counts']=='yes' &&isset($sfsi_responsive_icons["settings"]['show_count'])&&$sfsi_responsive_icons["settings"]['show_count']=="yes"):
	       $counter_class="sfsi_responsive_with_counter_icons";
	       $couter_display="inline-block";
	       $counts = sfsi_getCounts(true);
	       $count = 0;
	       if(isset($counts['email_count'])){
	       		$count = (int)($counts['email_count'])+$count;
	       }
	       if(isset($counts['fb_count'])){
	       		$count = (int)($counts['fb_count'])+$count;
	       }
	       if(isset($counts['twitter_count'])){
	       		$count = (int)($counts['twitter_count'])+$count;
	       }else{}

	   	else:
	       $counter_class="sfsi_responsive_without_counter_icons";
	       $couter_display="none";
	    endif;
		$icons .= "<div class='sfsi_responsive_icons' style='display:inline-block; ".($icon_width_type=="Fully Responsive"?"width:100%;display:flex; ":'width:100%')."' data-icon-width-type='".$icon_width_type."' data-icon-width-size='".$sfsi_responsive_icons["settings"]['icon_width_size']."' data-edge-type='".$sfsi_responsive_icons["settings"]['edge_type']."' data-edge-radius='".$sfsi_responsive_icons["settings"]['edge_radius']."'  >";
		$sfsi_anchor_div_style="";
		if($sfsi_responsive_icons["settings"]["edge_type"]==="Round"){
			$sfsi_anchor_div_style.=" border-radius:";
			if($sfsi_responsive_icons["settings"]["edge_radius"]!==""){
				$sfsi_anchor_div_style.=$sfsi_responsive_icons["settings"]["edge_radius"].'px; ';
			}else{
				$sfsi_anchor_div_style.='0px; ';
			}
		}
		
		ob_start();?>
				<div class="sfsi_responsive_icons_count sfsi_<?php echo ($icon_width_type=="Fully responsive"?'responsive':'fixed'); ?>_count_container sfsi_<?php echo strtolower($sfsi_responsive_icons['settings']['icon_size']); ?>_button"  style='display:<?php echo $couter_display; ?>;text-align:center; background-color:<?php echo $sfsi_responsive_icons['settings']['counter_bg_color'] ;?>;color:<?php echo $sfsi_responsive_icons['settings']['counter_color'] ;?>; <?php echo $sfsi_anchor_div_style; ?>;' >
					<h3 style="color:<?php echo $sfsi_responsive_icons['settings']['counter_color'] ;?>; " ><?php echo $count; ?></h3>
					<h6 style="color:<?php echo $sfsi_responsive_icons['settings']['counter_color'] ;?>;" ><?php echo $sfsi_responsive_icons['settings']["share_count_text"]; ?></h6>
				</div>
		<?php
			$icons.= ob_get_contents();
			ob_end_clean();
		$icons .= "\t<div class='sfsi_icons_container ".$counter_class." sfsi_".strtolower($sfsi_responsive_icons['settings']['icon_size'])."_button_container sfsi_icons_container_box_".($icon_width_type!=="Fixed icon width"?"fully":'fixed')."_container ' style='".($icon_width_type!=="Fixed icon width"?"width:100%;display:flex; ":'width:auto')."; text-align:center;' >";
		$socialObj = new sfsi_SocialHelper();
		//styles
		$sfsi_anchor_style="";
		if($sfsi_responsive_icons["settings"]["text_align"]=="Centered"){
			$sfsi_anchor_style.='text-align:center;';
		}
		if($sfsi_responsive_icons["settings"]["margin"]!==""){
			$sfsi_anchor_style.='margin-left:'.$sfsi_responsive_icons["settings"]["margin"]."px; ";
			// $sfsi_anchor_style.='margin-bottom:'.$sfsi_responsive_icons["settings"]["margin"]."px; ";
		}
		//styles
		 
		if($sfsi_responsive_icons['settings']['icon_width_type']==="Fixed icon width") 
		{
			$sfsi_anchor_div_style.='width:'.$sfsi_responsive_icons['settings']['icon_width_size'].'px;';
		}
		else{
			$sfsi_anchor_style.=" flex-basis:100%;";
			$sfsi_anchor_div_style.=" width:100%;";
		}
		// var_dump($sfsi_anchor_style,$sfsi_anchor_div_style);
		foreach($sfsi_responsive_icons['default_icons'] as $icon=>$icon_config){
			// var_dump($icon_config);
			// $current_url =  $socialObj->sfsi_get_custom_share_link(strtolower($icon));
			switch($icon){
				case "facebook":$share_url="https://www.facebook.com/sharer/sharer.php?u=".urlencode($current_url); break;
	           	case "Twitter":$twitter_text = $share_url = "https://twitter.com/intent/tweet?text=".urlencode($twitter_text)."&url=".urlencode($current_url);break;
				case "Follow":
					if(isset($option2['sfsi_email_icons_functions']) && $option2['sfsi_email_icons_functions'] == 'sf')
					{
						$share_url = (isset($option2['sfsi_email_url']))
							? $option2['sfsi_email_url']
							: 'javascript:';	
					}
					elseif(isset($option2['sfsi_email_icons_functions']) && $option2['sfsi_email_icons_functions'] == 'contact')
					{
						$share_url = (isset($option2['sfsi_email_icons_contact']) && !empty($option2['sfsi_email_icons_contact']))
							? "mailto:".$option2['sfsi_email_icons_contact']
							: 'javascript:';	
					}
					elseif(isset($option2['sfsi_email_icons_functions']) && $option2['sfsi_email_icons_functions'] == 'page')
					{
						$share_url = (isset($option2['sfsi_email_icons_pageurl']) && !empty($option2['sfsi_email_icons_pageurl']))
							? $option2['sfsi_email_icons_pageurl']
							: 'javascript:';	
					}
					elseif(isset($option2['sfsi_email_icons_functions']) && $option2['sfsi_email_icons_functions'] == 'share_email')
					{
						$subject = stripslashes($option2['sfsi_email_icons_subject_line']);
						$subject = str_replace('${title}', $socialObj->sfsi_get_the_title(), $subject);
						$subject = str_replace('"', '', str_replace("'", '', $subject));
						$subject = html_entity_decode(strip_tags($subject), ENT_QUOTES,'UTF-8');
						$subject = str_replace("%26%238230%3B", "...", $subject);				
						$subject = rawurlencode($subject);

						$body = stripslashes($option2['sfsi_email_icons_email_content']);
						$body = str_replace('${title}', $socialObj->sfsi_get_the_title(), $body);	
						$body = str_replace('${link}',  trailingslashit($socialObj->sfsi_get_custom_share_link('email')), $body);
						$body = str_replace('"', '', str_replace("'", '', $body));
						$body = html_entity_decode(strip_tags($body), ENT_QUOTES,'UTF-8');
						$body = str_replace("%26%238230%3B", "...", $body);
						$body = rawurlencode($body);				
						$share_url = "mailto:?subject=$subject&body=$body";
					}
					else
					{
						$share_url = (isset($option2['sfsi_email_url']))
							? $option2['sfsi_email_url']
							: 'javascript:';	
					}
					break;
	           
			}
			$icons.="\t\t"."<a ".sfsi_checkNewWindow()." href='".($icon_config['url']==""?$share_url:$icon_config['url'])."' style='".($icon_config['active']=='yes'?($sfsi_responsive_icons['settings']['icon_width_type']==="Fixed icon width"?'display:inline-flex':'display:block'):'display:none').";".$sfsi_anchor_style."' class=".($sfsi_responsive_icons['settings']['icon_width_type']==="Fixed icon width"?'sfsi_responsive_fixed_width':'sfsi_responsive_fluid')." >"."\n";
			$icons.="\t\t\t<div class='sfsi_responsive_icon_item_container sfsi_responsive_icon_".strtolower($icon)."_container sfsi_".strtolower($sfsi_responsive_icons['settings']['icon_size'])."_button ".($sfsi_responsive_icons['settings']['style']=="Gradient"?'sfsi_responsive_icon_gradient':'').( " sfsi_".(strtolower($sfsi_responsive_icons['settings']['text_align'])=="centered"?'centered':'left-align')."_icon")."' style='".$sfsi_anchor_div_style." ' >"."\n";
			$icons.="\t\t\t\t<img style='max-height: 25px;display:unset;margin:0' src='".SFSI_PLUGURL."images/responsive-icon/".$icon.('Follow'===$icon?'.png':'.svg')."'>"."\n";
			$icons.="\t\t\t\t<span style='color:#fff' >".($icon_config["text"])."</span>"."\n";
			$icons.="\t\t\t</div>"."\n";
			$icons.="\t\t</a>"."\n\n";
		}
		$sfsi_responsive_icons_custom_icons=array();
		if(!isset($sfsi_responsive_icons['custom_icons']) || !empty($sfsi_responsive_icons['custom_icons'])){
			$sfsi_responsive_icons_custom_icons=$sfsi_responsive_icons['custom_icons'];
		}else{
			$count=5;
			for($i=0;$i<$count;$i++){
				array_push($sfsi_responsive_icons_custom_icons,array(
					"added"=>"no",
					"active"=>"no",
					"text"=>"Share",
					"bg-color"=>"#729fcf",
					"url"=>"",
					"icon"=>''
				));
			}
		}
		foreach($sfsi_responsive_icons_custom_icons as $icon=>$icon_config){
			// $current_url =  $socialObj->sfsi_get_custom_share_link(strtolower($icon));
			$icons.="\t\t"."<a ".sfsi_checkNewWindow()." href='".($icon_config['url']==""?"":$icon_config['url'])."' style='".($icon_config['active']=='yes'?'display:inline-flex':'display:none').";".$sfsi_anchor_style."' class=".($sfsi_responsive_icons['settings']['icon_width_type']==="Fixed icon width"?'sfsi_responsive_fixed_width':'sfsi_responsive_fluid')."  >"."\n";
			$icons.="\t\t\t<div class='sfsi_responsive_icon_item_container sfsi_responsive_custom_icon sfsi_responsive_icon_".strtolower($icon)."_container sfsi_".strtolower($sfsi_responsive_icons['settings']['icon_size'])."_button ".( "sfsi_".(strtolower($sfsi_responsive_icons['settings']['text_align'])=="centered"?'centered':'left-align')."_icon")." ".($sfsi_responsive_icons['settings']['style']=="Gradient"?'sfsi_responsive_icon_gradient':'')."' style='".$sfsi_anchor_div_style." background-color:".(isset($icon_config['bg-color'])?$icon_config['bg-color']:'#73d17c')."' >"."\n";
			$icons.="\t\t\t\t<img style='max-height: 25px' src='".(isset($icon_config['icon'])?$icon_config['icon']:'#')."'>"."\n";
			$icons.="\t\t\t\t<span style='color:#fff' >".($icon_config["text"])."</span>"."\n";
			$icons.="\t\t\t</div>"."\n";
			$icons.="\t\t</a>"."\n\n";
		}
		$icons.="</div></div><!--end responsive_icons-->";
		return $icons;
	endif;
}
?>