<?php 
global $cs_theme_option;

if(!isset($global_var_set)){
	$cs_theme_option = get_option('cs_theme_option');
}
$cs_theme_option['custom_color_scheme']=isset($cs_theme_option['custom_color_scheme']) ? $cs_theme_option['custom_color_scheme']:'';
$cs_theme_option['banner_color']=isset($cs_theme_option['banner_color']) ? $cs_theme_option['banner_color']:'';
$cs_theme_option['banner_bg_color']=isset($cs_theme_option['banner_bg_color']) ? $cs_theme_option['banner_bg_color']:'';
$cs_theme_option['layout_option']=isset($cs_theme_option['layout_option']) ? $cs_theme_option['layout_option']:'';
$cs_theme_option['bg_img']=isset($cs_theme_option['bg_img']) ? $cs_theme_option['bg_img']:'';
$cs_theme_option['bg_img_custom']=isset($cs_theme_option['bg_img_custom']) ? $cs_theme_option['bg_img_custom']:'';
$cs_theme_option['bg_position']=isset($cs_theme_option['bg_position']) ? $cs_theme_option['bg_position']:'';
$cs_theme_option['bg_repeat']=isset($cs_theme_option['bg_repeat']) ? $cs_theme_option['bg_repeat']:'';
$cs_theme_option['bg_attach']=isset($cs_theme_option['bg_attach']) ? $cs_theme_option['bg_attach']:'';
$cs_theme_option['pattern_img']=isset($cs_theme_option['pattern_img']) ? $cs_theme_option['pattern_img']:'';
$cs_theme_option['custome_pattern']=isset($cs_theme_option['custome_pattern']) ? $cs_theme_option['custome_pattern']:'';
$cs_theme_option['bg_color']=isset($cs_theme_option['bg_color']) ? $cs_theme_option['bg_color']:'';
$cs_theme_option['logo']=isset($cs_theme_option['logo']) ? $cs_theme_option['logo']:'';
$cs_theme_option['logo_width']=isset($cs_theme_option['logo_width']) ? $cs_theme_option['logo_width']:'';
$cs_theme_option['logo_height']=isset($cs_theme_option['logo_height']) ? $cs_theme_option['logo_height']:'';
$cs_theme_option['header_sticky_menu']=isset($cs_theme_option['header_sticky_menu']) ? $cs_theme_option['header_sticky_menu']:'';
$cs_theme_option['fav_icon']=isset($cs_theme_option['fav_icon']) ? $cs_theme_option['fav_icon']:'';
$cs_theme_option['header_logo']=isset($cs_theme_option['header_logo']) ? $cs_theme_option['header_logo']:'';
$cs_theme_option['header_slogan']=isset($cs_theme_option['header_slogan']) ? $cs_theme_option['header_slogan']:'';
$cs_theme_option['header_top_menu']=isset($cs_theme_option['header_top_menu']) ? $cs_theme_option['header_top_menu']:'';
$cs_theme_option['header_social_icons']=isset($cs_theme_option['header_social_icons']) ? $cs_theme_option['header_social_icons']:'';
$cs_theme_option['show_beadcrumbs']=isset($cs_theme_option['show_beadcrumbs']) ? $cs_theme_option['show_beadcrumbs']:'';
$cs_theme_option['header_next_event']=isset($cs_theme_option['header_next_event']) ? $cs_theme_option['header_next_event']:'';
$cs_theme_option['header_cart']=isset($cs_theme_option['header_cart']) ? $cs_theme_option['header_cart']:'';
$cs_theme_option['header_code']=isset($cs_theme_option['header_code']) ? $cs_theme_option['header_code']:'';
$cs_theme_option['partners_title']=isset($cs_theme_option['partners_title']) ? $cs_theme_option['partners_title']:'';
$cs_theme_option['partners_gallery']=isset($cs_theme_option['partners_gallery']) ? $cs_theme_option['partners_gallery']:'';
$cs_theme_option['show_partners']=isset($cs_theme_option['show_partners']) ? $cs_theme_option['show_partners']:'';
$cs_theme_option['copyright']=isset($cs_theme_option['copyright']) ? $cs_theme_option['copyright']:'';
$cs_theme_option['powered_by']=isset($cs_theme_option['powered_by']) ? $cs_theme_option['powered_by']:'';
$cs_theme_option['analytics']=isset($cs_theme_option['analytics']) ? $cs_theme_option['analytics']:'';
$cs_theme_option['under-construction']=isset($cs_theme_option['under-construction']) ? $cs_theme_option['under-construction']:'';
$cs_theme_option['showlogo']=isset($cs_theme_option['showlogo']) ? $cs_theme_option['showlogo']:'';
$cs_theme_option['under_construction_text']=isset($cs_theme_option['under_construction_text']) ? $cs_theme_option['under_construction_text']:'';
$cs_theme_option['launch_date']=isset($cs_theme_option['launch_date']) ? $cs_theme_option['launch_date']:'';
$cs_theme_option['socialnetwork']=isset($cs_theme_option['socialnetwork']) ? $cs_theme_option['socialnetwork']:'';
$cs_theme_option['responsive']=isset($cs_theme_option['responsive']) ? $cs_theme_option['responsive']:'';
$cs_theme_option['style_rtl']=isset($cs_theme_option['style_rtl']) ? $cs_theme_option['style_rtl']:'';
$cs_theme_option['color_switcher']=isset($cs_theme_option['color_switcher']) ? $cs_theme_option['color_switcher']:'';
$cs_theme_option['trans_switcher']=isset($cs_theme_option['trans_switcher']) ? $cs_theme_option['trans_switcher']:'';
$cs_theme_option['cache_limit_time']=isset($cs_theme_option['cache_limit_time']) ? $cs_theme_option['cache_limit_time']:'';
$cs_theme_option['tweet_num_post']=isset($cs_theme_option['tweet_num_post']) ? $cs_theme_option['tweet_num_post']:'';
$cs_theme_option['twitter_datetime_formate']=isset($cs_theme_option['twitter_datetime_formate']) ? $cs_theme_option['twitter_datetime_formate']:'';
$cs_theme_option['consumer_key']=isset($cs_theme_option['consumer_key']) ? $cs_theme_option['consumer_key']:'';
$cs_theme_option['consumer_secret']=isset($cs_theme_option['consumer_secret']) ? $cs_theme_option['consumer_secret']:'';
$cs_theme_option['access_token']=isset($cs_theme_option['access_token']) ? $cs_theme_option['access_token']:'';
$cs_theme_option['access_token_secret']=isset($cs_theme_option['access_token_secret']) ? $cs_theme_option['access_token_secret']:'';
$cs_theme_option['twitter_setting']=isset($cs_theme_option['twitter_setting']) ? $cs_theme_option['twitter_setting']:'';
$cs_theme_option['paypal_email']=isset($cs_theme_option['paypal_email']) ? $cs_theme_option['paypal_email']:'';
$cs_theme_option['paypal_ipn_url']=isset($cs_theme_option['paypal_ipn_url']) ? $cs_theme_option['paypal_ipn_url']:'';
$cs_theme_option['paypal_currency']=isset($cs_theme_option['paypal_currency']) ? $cs_theme_option['paypal_currency']:'';
$cs_theme_option['paypal_currency_sign']=isset($cs_theme_option['paypal_currency_sign']) ? $cs_theme_option['paypal_currency_sign']:'';
$cs_theme_option['mailchimp_key']=isset($cs_theme_option['mailchimp_key']) ? $cs_theme_option['mailchimp_key']:'';
$cs_theme_option['show_slider']=isset($cs_theme_option['show_slider']) ? $cs_theme_option['show_slider']:'';
$cs_theme_option['slider_type']=isset($cs_theme_option['slider_type']) ? $cs_theme_option['slider_type']:'';
$cs_theme_option['slider_name']=isset($cs_theme_option['slider_name']) ? $cs_theme_option['slider_name']:'';
$cs_theme_option['slider_id']=isset($cs_theme_option['slider_id']) ? $cs_theme_option['slider_id']:'';
$cs_theme_option['content_size']=isset($cs_theme_option['content_size']) ? $cs_theme_option['content_size']:'';
$cs_theme_option['content_size_g_font']=isset($cs_theme_option['content_size_g_font']) ? $cs_theme_option['content_size_g_font']:'';
$cs_theme_option['sidebar_input']=isset($cs_theme_option['sidebar_input']) ? $cs_theme_option['sidebar_input']:'';
$cs_theme_option['sidebar']=isset($cs_theme_option['sidebar']) ? $cs_theme_option['sidebar']:'';
$cs_theme_option['flex_effect']=isset($cs_theme_option['flex_effect']) ? $cs_theme_option['flex_effect']:'';
$cs_theme_option['flex_auto_play']=isset($cs_theme_option['flex_auto_play']) ? $cs_theme_option['flex_auto_play']:'';
$cs_theme_option['flex_animation_speed']=isset($cs_theme_option['flex_animation_speed']) ? $cs_theme_option['flex_animation_speed']:'';
$cs_theme_option['flex_pause_time']=isset($cs_theme_option['flex_pause_time']) ? $cs_theme_option['flex_pause_time']:'';
$cs_theme_option['social_net_title']=isset($cs_theme_option['social_net_title']) ? $cs_theme_option['social_net_title']:'';
$cs_theme_option['social_net_icon_path']=isset($cs_theme_option['social_net_icon_path']) ? $cs_theme_option['social_net_icon_path']:'';
$cs_theme_option['social_net_awesome']=isset($cs_theme_option['social_net_awesome']) ? $cs_theme_option['social_net_awesome']:'';
$cs_theme_option['social_net_url']=isset($cs_theme_option['social_net_url']) ? $cs_theme_option['social_net_url']:'';
$cs_theme_option['social_net_tooltip']=isset($cs_theme_option['social_net_tooltip']) ? $cs_theme_option['social_net_tooltip']:'';
$cs_theme_option['facebook_share']=isset($cs_theme_option['facebook_share']) ? $cs_theme_option['facebook_share']:'';
$cs_theme_option['twitter_share']=isset($cs_theme_option['twitter_share']) ? $cs_theme_option['twitter_share']:'';
$cs_theme_option['linkedin_share']=isset($cs_theme_option['linkedin_share']) ? $cs_theme_option['linkedin_share']:'';
$cs_theme_option['pinterest_share']=isset($cs_theme_option['pinterest_share']) ? $cs_theme_option['pinterest_share']:'';
$cs_theme_option['tumblr_share']=isset($cs_theme_option['tumblr_share']) ? $cs_theme_option['tumblr_share']:'';
$cs_theme_option['google_plus_share']=isset($cs_theme_option['google_plus_share']) ? $cs_theme_option['google_plus_share']:'';
$cs_theme_option['cs_other_share']=isset($cs_theme_option['cs_other_share']) ? $cs_theme_option['cs_other_share']:'';
$cs_theme_option['pagination']=isset($cs_theme_option['pagination']) ? $cs_theme_option['pagination']:'';
$cs_theme_option['cs_layout']=isset($cs_theme_option['cs_layout']) ? $cs_theme_option['cs_layout']:'';
$cs_theme_option['cs_sidebar_left']=isset($cs_theme_option['cs_sidebar_left']) ? $cs_theme_option['cs_sidebar_left']:'';
$cs_theme_option['cs_sidebar_right']=isset($cs_theme_option['cs_sidebar_right']) ? $cs_theme_option['cs_sidebar_right']:'';
$cs_theme_option['cs_orderby']=isset($cs_theme_option['cs_orderby']) ? $cs_theme_option['cs_orderby']:'';
$cs_theme_option['trans_timeleft']=isset($cs_theme_option['trans_timeleft']) ? $cs_theme_option['trans_timeleft']:'';
$cs_theme_option['trans_buynow']=isset($cs_theme_option['trans_buynow']) ? $cs_theme_option['trans_buynow']:'';
$cs_theme_option['trans_add_to_calendar']=isset($cs_theme_option['trans_add_to_calendar']) ? $cs_theme_option['trans_add_to_calendar']:'';
$cs_theme_option['trans_outlook_calendar']=isset($cs_theme_option['trans_outlook_calendar']) ? $cs_theme_option['trans_outlook_calendar']:'';
$cs_theme_option['trans_google_calendar']=isset($cs_theme_option['trans_google_calendar']) ? $cs_theme_option['trans_google_calendar']:'';
$cs_theme_option['trans_yahoo_calendar']=isset($cs_theme_option['trans_yahoo_calendar']) ? $cs_theme_option['trans_yahoo_calendar']:'';
$cs_theme_option['trans_ical_calendar']=isset($cs_theme_option['trans_ical_calendar']) ? $cs_theme_option['trans_ical_calendar']:'';
$cs_theme_option['res_first_name']=isset($cs_theme_option['res_first_name']) ? $cs_theme_option['res_first_name']:'';
$cs_theme_option['res_last_name']=isset($cs_theme_option['res_last_name']) ? $cs_theme_option['res_last_name']:'';
$cs_theme_option['trans_subject']=isset($cs_theme_option['trans_subject']) ? $cs_theme_option['trans_subject']:'';
$cs_theme_option['trans_message']=isset($cs_theme_option['trans_message']) ? $cs_theme_option['trans_message']:'';
$cs_theme_option['cause_raised']=isset($cs_theme_option['cause_raised']) ? $cs_theme_option['cause_raised']:'';
$cs_theme_option['cause_goal']=isset($cs_theme_option['cause_goal']) ? $cs_theme_option['cause_goal']:'';
$cs_theme_option['cause_status']=isset($cs_theme_option['cause_status']) ? $cs_theme_option['cause_status']:'';
$cs_theme_option['cause_donors']=isset($cs_theme_option['cause_donors']) ? $cs_theme_option['cause_donors']:'';
$cs_theme_option['cause_donation']=isset($cs_theme_option['cause_donation']) ? $cs_theme_option['cause_donation']:'';
$cs_theme_option['cause_donate']=isset($cs_theme_option['cause_donate']) ? $cs_theme_option['cause_donate']:'';
$cs_theme_option['trans_content_404']=isset($cs_theme_option['trans_content_404']) ? $cs_theme_option['trans_content_404']:'';
$cs_theme_option['trans_share_this_post']=isset($cs_theme_option['trans_share_this_post']) ? $cs_theme_option['trans_share_this_post']:'';
$cs_theme_option['trans_listed_in']=isset($cs_theme_option['trans_listed_in']) ? $cs_theme_option['trans_listed_in']:'';
$cs_theme_option['trans_featured']=isset($cs_theme_option['trans_featured']) ? $cs_theme_option['trans_featured']:'';
$cs_theme_option['trans_read_more']=isset($cs_theme_option['trans_read_more']) ? $cs_theme_option['trans_read_more']:'';
$cs_theme_option['trans_current_page']=isset($cs_theme_option['trans_current_page']) ? $cs_theme_option['trans_current_page']:'';
$cs_theme_option['trans_special_request']=isset($cs_theme_option['trans_special_request']) ? $cs_theme_option['trans_special_request']:'';
$cs_theme_option['trans_email_published']=isset($cs_theme_option['trans_email_published']) ? $cs_theme_option['trans_email_published']:'';
$cs_theme_option['trans_opening_hours_monday']=isset($cs_theme_option['trans_opening_hours_monday']) ? $cs_theme_option['trans_opening_hours_monday']:'';
$cs_theme_option['trans_opening_hours_tuesday']=isset($cs_theme_option['trans_opening_hours_tuesday']) ? $cs_theme_option['trans_opening_hours_tuesday']:'';
$cs_theme_option['trans_opening_hours_wednesday']=isset($cs_theme_option['trans_opening_hours_wednesday']) ? $cs_theme_option['trans_opening_hours_wednesday']:'';
$cs_theme_option['trans_opening_hours_thursday']=isset($cs_theme_option['trans_opening_hours_thursday']) ? $cs_theme_option['trans_opening_hours_thursday']:'';
$cs_theme_option['trans_opening_hours_friday']=isset($cs_theme_option['trans_opening_hours_friday']) ? $cs_theme_option['trans_opening_hours_friday']:'';
$cs_theme_option['trans_opening_hours_saturday']=isset($cs_theme_option['trans_opening_hours_saturday']) ? $cs_theme_option['trans_opening_hours_saturday']:'';
$cs_theme_option['trans_opening_hours_sunday']=isset($cs_theme_option['trans_opening_hours_sunday']) ? $cs_theme_option['trans_opening_hours_sunday']:'';
$cs_theme_option['action']=isset($cs_theme_option['action']) ? $cs_theme_option['action']:'';
?>