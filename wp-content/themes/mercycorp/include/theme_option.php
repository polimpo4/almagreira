<?php

function theme_option() {
    global $post, $cs_theme_option;
    $g_fonts = cs_get_google_fonts();
    

    ?>
    <link href="<?php echo get_template_directory_uri() ?>/css/admin/datePicker.css" rel="stylesheet" type="text/css" />
    <form id="frm" method="post" action="javascript:theme_option_save('<?php echo admin_url('admin-ajax.php') ?>', '<?php echo get_template_directory_uri() ?>');">
        <div class="theme-wrap fullwidth">
            <div class="loading_div"></div>
            <div class="form-msg"></div>
            <div class="inner">
                <div class="row"> 
                    <!-- Left Column Start -->
                    <div class="col1">
                        <div class="logo"><a href="#"><img src="<?php echo get_template_directory_uri() ?>/images/admin/logo.png" /></a></div>
                        <div class="arrowlistmenu" id="paginate-slider2">
                            <h3 class="menuheader expandable"><a href="#"><span class="nav-icon g-setting">&nbsp;</span><?php _e('General Settings', 'Mercycorp'); ?></a></h3>
                            <ul class="categoryitems">
                                <li class="tab-color active"><a href="#tab-color" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('Color and Style', 'Mercycorp'); ?></a></li>
                                <li class="tab-logo"><a href="#tab-logo" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('Logo / Fav Icon', 'Mercycorp'); ?></a></li>
                                <li class="tab-head-scripts"><a href="#tab-head-scripts" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('Header Settings', 'Mercycorp'); ?></a></li>
                                <li class="tab-foot-setting"><a href="#tab-foot-setting" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('Footer Settings', 'Mercycorp'); ?></a></li>
                                <li class="tab-under-consturction"><a href="#tab-under-consturction" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('Under Construction', 'Mercycorp'); ?></a></li>
                                <li class="tab-other"><a href="#tab-other" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('Other Settings', 'Mercycorp'); ?></a></li>
                                <li class="tab-api-key"><a href="#tab-paypalapi-key" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('Paypal API Settings', 'Mercycorp'); ?></a></li>
                                <li class="tab-mailchimp-key"><a href="#tab-mailchimp-key" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('MailChimp Settings', 'Mercycorp'); ?></a></li>
                                <li class="tab-api-key"><a href="#tab-api-key" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('API Settings', 'Mercycorp'); ?></a></li>

                            </ul>
                            <h3 class="menuheader expandable"><a href="#"><span class="nav-icon h-setting">&nbsp;</span><?php _e('Home Page Settings', 'Mercycorp'); ?></a></h3>
                            <ul class="categoryitems">
                                <li class="tab-slider"><a href="#tab-slider" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('Home Page Slider', 'Mercycorp'); ?></a></li>
                            </ul>
                            <h3 class="menuheader expandable"><a href="#"><span class="nav-icon fonts">&nbsp;</span><?php _e('Fonts', 'Mercycorp'); ?></a></h3>
                            <ul class="categoryitems">
                                <li class="tab-font-settings"><a href="#tab-font-settings" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('Fonts Settings', 'Mercycorp'); ?></a></li>
                            </ul>

                            <h3 class="menuheader expandable"><a href="#"><span class="nav-icon side-bar">&nbsp;</span><?php _e('Side Bars', 'Mercycorp'); ?></a></h3>
                            <ul class="categoryitems">
                                <li class="tab-manage-sidebars"><a href="#tab-manage-sidebars" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('Manage Sidebars', 'Mercycorp'); ?></a></li>
                            </ul>
                            <h3 class="menuheader expandable"><a href="#"><span class="nav-icon slider-setting">&nbsp;</span><?php _e('Slider Setting', 'Mercycorp'); ?></a></h3>
                            <ul class="categoryitems">
                                <li class="tab-flex-slider"><a href="#tab-flex-slider" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('Flex Slider', 'Mercycorp'); ?></a></li>
                            </ul>
                            <h3 class="menuheader expandable"><a href="#"><span class="nav-icon s-network">&nbsp;</span><?php _e('Social Settings', 'Mercycorp'); ?></a></h3>
                            <ul class="categoryitems">
                                <li class="tab-social-network"><a href="#tab-social-network" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('Social Network', 'Mercycorp'); ?></a></li>
                                <li class="tab-social-sharing"><a href="#tab-social-sharing" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('Social Sharing', 'Mercycorp'); ?></a></li>
                            </ul>
                            <h3 class="menuheader expandable"><a href="#"><span class="nav-icon languages">&nbsp;</span><?php _e('Language', 'Mercycorp'); ?></a></h3>
                            <ul class="categoryitems">
                                <li class="tab-upload-languages"><a href="#tab-upload-languages" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('Upload New Languages', 'Mercycorp'); ?></a></li>
                            </ul>
                            <h3 class="menuheader expandable"><a href="#"><span class="nav-icon translation">&nbsp;</span><?php _e('Translation', 'Mercycorp'); ?></a></h3>
                            <ul class="categoryitems">
                                <li class="tab-event-translation"><a href="#tab-event-translation" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('Events', 'Mercycorp'); ?></a></li>
                                <li class="tab-cause-translation"><a href="#tab-cause-translation" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('Cause', 'Mercycorp'); ?></a></li>
                                <li class="tab-contact-translation"><a href="#tab-contact-translation" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('Contact', 'Mercycorp'); ?></a></li>
                                <li class="tab-other-translation"><a href="#tab-other-translation" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('Others', 'Mercycorp'); ?></a></li>
                            </ul>
                            <h3 class="menuheader expandable"><a href="#"><span class="nav-icon default-pages">&nbsp;</span><?php _e('Default Pages', 'Mercycorp'); ?></a></h3>
                            <ul class="categoryitems">
                                <li class="tab-default-pages"><a href="#tab-default-pages" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('Default Pages', 'Mercycorp'); ?></a></li>
                            </ul>
                            <h3 class="menuheader expandable"><a href="#"><span class="nav-icon default-pages">&nbsp;</span><?php _e('Backup Options', 'Mercycorp'); ?></a></h3>
                            <ul class="categoryitems">
                                <li class="tab-import-export"><a href="#tab-import-export" onClick="toggleDiv(this.hash);
                                            return false;"><?php _e('Theme Options Backup and restore settings', 'Mercycorp'); ?></a></li>
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php
                    
                    $cs_theme_option['banner_color'] = isset( $cs_theme_option['banner_color']) ?  $cs_theme_option['banner_color'] : '';
                    $cs_theme_option['layout_option'] = isset( $cs_theme_option['layout_option']) ?  $cs_theme_option['layout_option'] : '';
                    $cs_theme_option['bg_img'] = isset( $cs_theme_option['bg_img']) ?  $cs_theme_option['bg_img'] : '';
                    $cs_theme_option['bg_img_custom'] = isset( $cs_theme_option['bg_img_custom']) ?  $cs_theme_option['bg_img_custom'] : '';
                    $cs_theme_option['bg_position'] = isset($cs_theme_option['bg_position']) ? $cs_theme_option['bg_position'] : '';
                    $cs_theme_option['bg_repeat'] = isset($cs_theme_option['bg_repeat']) ? $cs_theme_option['bg_repeat'] : '';
                    $cs_theme_option['bg_attach'] = isset($cs_theme_option['bg_attach']) ? $cs_theme_option['bg_attach'] : '';
                    $cs_theme_option['pattern_img'] = isset($cs_theme_option['pattern_img']) ? $cs_theme_option['pattern_img'] : '';
                    $cs_theme_option['custome_pattern'] = isset($cs_theme_option['custome_pattern']) ? $cs_theme_option['custome_pattern'] : '';
                    $cs_theme_option['logo'] = isset($cs_theme_option['logo']) ? $cs_theme_option['logo'] : '';
                    $cs_theme_option['logo_width'] = isset($cs_theme_option['logo_width']) ? $cs_theme_option['logo_width'] : '';
                    $cs_theme_option['logo_height'] = isset($cs_theme_option['logo_height']) ? $cs_theme_option['logo_height'] : '';
                    $cs_theme_option['header_sticky_menu'] = isset($cs_theme_option['header_sticky_menu']) ? $cs_theme_option['header_sticky_menu'] : '';
                    $cs_theme_option['fav_icon'] = isset($cs_theme_option['fav_icon']) ? $cs_theme_option['fav_icon'] : '';
                    $cs_theme_option['header_logo'] = isset($cs_theme_option['header_logo']) ? $cs_theme_option['header_logo'] : '';
                    $cs_theme_option['header_slogan'] = isset($cs_theme_option['header_slogan']) ? $cs_theme_option['header_slogan'] : '';
                    $cs_theme_option['header_top_menu'] = isset($cs_theme_option['header_top_menu']) ? $cs_theme_option['header_top_menu'] : '';
                    $cs_theme_option['header_social_icons'] = isset($cs_theme_option['header_social_icons']) ? $cs_theme_option['header_social_icons'] : '';
                    $cs_theme_option['header_code'] = isset($cs_theme_option['header_code']) ? $cs_theme_option['header_code'] : '';
                    $cs_theme_option['partners_title'] = isset($cs_theme_option['partners_title']) ? $cs_theme_option['partners_title'] : '';
                    $cs_theme_option['show_partners'] = isset($cs_theme_option['show_partners']) ? $cs_theme_option['show_partners'] : '';
                    $cs_theme_option['copyright'] = isset($cs_theme_option['copyright']) ? $cs_theme_option['copyright'] : '';
                    $cs_theme_option['powered_by'] = isset($cs_theme_option['powered_by']) ? $cs_theme_option['powered_by'] : '';
                    $cs_theme_option['analytics'] = isset($cs_theme_option['analytics']) ? $cs_theme_option['analytics'] : '';
                    $cs_theme_option['under-construction'] = isset($cs_theme_option['under-construction']) ? $cs_theme_option['under-construction'] : '';
                    $cs_theme_option['showlogo'] = isset($cs_theme_option['showlogo']) ? $cs_theme_option['showlogo'] : '';
                    $cs_theme_option['under_construction_text'] = isset($cs_theme_option['under_construction_text']) ? $cs_theme_option['under_construction_text'] : '';
                    $cs_theme_option['launch_date'] = isset($cs_theme_option['launch_date']) ? $cs_theme_option['launch_date'] : '';
                    $cs_theme_option['socialnetwork'] = isset($cs_theme_option['socialnetwork']) ? $cs_theme_option['socialnetwork'] : '';
                    $cs_theme_option['responsive'] = isset($cs_theme_option['responsive']) ? $cs_theme_option['responsive'] : '';
                    $cs_theme_option['style_rtl'] = isset($cs_theme_option['style_rtl']) ? $cs_theme_option['style_rtl'] : '';
                    $cs_theme_option['color_switcher'] = isset($cs_theme_option['color_switcher']) ? $cs_theme_option['color_switcher'] : '';
                    $cs_theme_option['trans_switcher'] = isset($cs_theme_option['trans_switcher']) ? $cs_theme_option['trans_switcher'] : '';
                    $cs_theme_option['paypal_email'] = isset($cs_theme_option['paypal_email']) ? $cs_theme_option['paypal_email'] : '';
                    $cs_theme_option['paypal_currency'] = isset($cs_theme_option['paypal_currency']) ? $cs_theme_option['paypal_currency'] : '';
                    $cs_theme_option['paypal_currency_sign'] = isset($cs_theme_option['paypal_currency_sign']) ? $cs_theme_option['paypal_currency_sign'] : '';
                    $cs_theme_option['mailchimp_key'] = isset($cs_theme_option['mailchimp_key']) ? $cs_theme_option['mailchimp_key'] : '';
                    $cs_theme_option['cache_limit_time'] = isset($cs_theme_option['cache_limit_time']) ? $cs_theme_option['cache_limit_time'] : '';
                    $cs_theme_option['tweet_num_post'] = isset($cs_theme_option['tweet_num_post']) ? $cs_theme_option['tweet_num_post'] : '';
                    $cs_theme_option['consumer_key'] = isset( $cs_theme_option['consumer_key']) ?  $cs_theme_option['consumer_key'] : '';
                    $cs_theme_option['consumer_secret'] = isset( $cs_theme_option['consumer_secret']) ?  $cs_theme_option['consumer_secret'] : '';
                    $cs_theme_option['access_token'] = isset( $cs_theme_option['access_token']) ?  $cs_theme_option['access_token'] : '';
                    $cs_theme_option['access_token_secret'] = isset( $cs_theme_option['access_token_secret']) ?  $cs_theme_option['access_token_secret'] : '';
                    $cs_theme_option['show_slider'] = isset($cs_theme_option['show_slider']) ? $cs_theme_option['show_slider'] : '';
                    $cs_theme_option['slider_type'] = isset($cs_theme_option['slider_type']) ? $cs_theme_option['slider_type'] : '';
                    $cs_theme_option['content_size'] = isset($cs_theme_option['content_size']) ? $cs_theme_option['content_size'] : '';
                    $cs_theme_option['facebook_share'] = isset($cs_theme_option['facebook_share']) ? $cs_theme_option['facebook_share'] : '';
                    $cs_theme_option['twitter_share'] = isset($cs_theme_option['twitter_share']) ? $cs_theme_option['twitter_share'] : '';
                    $cs_theme_option['linkedin_share'] = isset($cs_theme_option['linkedin_share']) ? $cs_theme_option['linkedin_share'] : '';
                    $cs_theme_option['pinterest_share'] = isset($cs_theme_option['pinterest_share']) ? $cs_theme_option['pinterest_share'] : '';
                    $cs_theme_option['tumblr_share'] = isset($cs_theme_option['tumblr_share']) ? $cs_theme_option['tumblr_share'] : '';
                    $cs_theme_option['google_plus_share'] = isset($cs_theme_option['google_plus_share']) ? $cs_theme_option['google_plus_share'] : '';
                    $cs_theme_option['cs_other_share'] = isset($cs_theme_option['cs_other_share']) ? $cs_theme_option['cs_other_share'] : '';
                    $cs_theme_option['trans_timeleft'] = isset($cs_theme_option['trans_timeleft']) ? $cs_theme_option['trans_timeleft'] : '';
                    $cs_theme_option['trans_buynow'] = isset($cs_theme_option['trans_buynow']) ? $cs_theme_option['trans_buynow'] : '';
                    $cs_theme_option['trans_add_to_calendar'] = isset($cs_theme_option['trans_add_to_calendar']) ? $cs_theme_option['trans_add_to_calendar'] : '';
                    $cs_theme_option['trans_outlook_calendar'] = isset($cs_theme_option['trans_outlook_calendar']) ? $cs_theme_option['trans_outlook_calendar'] : '';
                    $cs_theme_option['trans_google_calendar'] = isset($cs_theme_option['trans_google_calendar']) ? $cs_theme_option['trans_google_calendar'] : '';
                    $cs_theme_option['trans_yahoo_calendar'] = isset($cs_theme_option['trans_yahoo_calendar']) ? $cs_theme_option['trans_yahoo_calendar'] : '';
                    $cs_theme_option['trans_ical_calendar'] = isset($cs_theme_option['trans_ical_calendar']) ? $cs_theme_option['trans_ical_calendar'] : '';
                    $cs_theme_option['trans_read_more'] = isset($cs_theme_option['trans_read_more']) ? $cs_theme_option['trans_read_more'] : '';
                    $cs_theme_option['cause_raised'] = isset($cs_theme_option['cause_raised']) ? $cs_theme_option['cause_raised'] : '';
                    $cs_theme_option['cause_goal'] = isset($cs_theme_option['cause_goal']) ? $cs_theme_option['cause_goal'] : '';
                    $cs_theme_option['cause_status'] = isset($cs_theme_option['cause_status']) ? $cs_theme_option['cause_status'] : '';
                    $cs_theme_option['pagination'] = isset($cs_theme_option['pagination']) ? $cs_theme_option['pagination'] : '';
                    $cs_theme_option['twitter_datetime_formate'] = isset($cs_theme_option['twitter_datetime_formate']) ? $cs_theme_option['twitter_datetime_formate'] : '';
                    $cs_theme_option['cause_donors '] = isset($cs_theme_option['cause_donors ']) ? $cs_theme_option['cause_donors '] : '';
                    $cs_theme_option['cause_donation'] = isset($cs_theme_option['cause_donation']) ? $cs_theme_option['cause_donation'] : '';
                    $cs_theme_option['slider_name'] = isset($cs_theme_option['slider_name']) ? $cs_theme_option['slider_name'] : '';
                    $cs_theme_option['cause_donate'] = isset($cs_theme_option['cause_donate']) ? $cs_theme_option['cause_donate'] : '';
                    $cs_theme_option['res_first_name'] = isset($cs_theme_option['res_first_name']) ? $cs_theme_option['res_first_name'] : '';
                    $cs_theme_option['res_last_name'] = isset($cs_theme_option['res_last_name']) ? $cs_theme_option['res_last_name'] : '';
                    $cs_theme_option['trans_special_request'] = isset($cs_theme_option['trans_special_request']) ? $cs_theme_option['trans_special_request'] : '';
                    $cs_theme_option['trans_email_published'] = isset($cs_theme_option['trans_email_published']) ? $cs_theme_option['trans_email_published'] : '';
                    $cs_theme_option['trans_opening_hours_monday'] = isset($cs_theme_option['trans_opening_hours_monday']) ? $cs_theme_option['trans_opening_hours_monday'] : '';
                    $cs_theme_option['trans_opening_hours_tuesday'] = isset($cs_theme_option['trans_opening_hours_tuesday']) ? $cs_theme_option['trans_opening_hours_tuesday'] : '';
                    $cs_theme_option['trans_opening_hours_wednesday'] = isset($cs_theme_option['trans_opening_hours_wednesday']) ? $cs_theme_option['trans_opening_hours_wednesday'] : '';
                    $cs_theme_option['trans_opening_hours_thursday'] = isset($cs_theme_option['trans_opening_hours_thursday']) ? $cs_theme_option['trans_opening_hours_thursday'] : '';
                    $cs_theme_option['trans_opening_hours_friday'] = isset($cs_theme_option['trans_opening_hours_friday']) ? $cs_theme_option['trans_opening_hours_friday'] : '';
                    $cs_theme_option['trans_opening_hours_saturday'] = isset($cs_theme_option['trans_opening_hours_saturday']) ? $cs_theme_option['trans_opening_hours_saturday'] : '';
                    $cs_theme_option['trans_opening_hours_sunday'] = isset($cs_theme_option['trans_opening_hours_sunday']) ? $cs_theme_option['trans_opening_hours_sunday'] : '';
                    $cs_theme_option['trans_opening_hours_wednesday'] = isset($cs_theme_option['trans_opening_hours_wednesday']) ? $cs_theme_option['trans_opening_hours_wednesday'] : '';
                            
 
 ?>
                    <!-- Left Column End -->
                    <div class="col2">
                        <input type="submit" id="submit_btn" name="submit_btn" class="topbtn" value="<?php _e('Save All Settings', 'Mercycorp'); ?>" />
                        <!-- Color And Style Start -->
                        <div id="tab-color">
                            <div class="theme-header">
                                <h1><?php _e('General Settings', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Color And Styles', 'Mercycorp'); ?></h4>
                                <p><?php _e('Theme color scheme and styling setting', 'Mercycorp'); ?></p>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Custom Color Scheme', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="custom_color_scheme" value="<?php echo $cs_theme_option['custom_color_scheme'] ?>" class="bg_color" />
                                    <p><?php _e('Pick a custom color for Scheme of the theme', 'Mercycorp'); ?> e.g. #697e09</p>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Banner Color Scheme', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="hidden" name="banner_color" value="" />
                                    <input type="checkbox" class="myClass" name="banner_color" <?php if ($cs_theme_option['banner_color'] == "on") echo "checked" ?> />
                                    <p><?php _e('Switch it on if you want to show custom color', 'Mercycorp'); ?></p>
                                </li>
                                <li class="to-label"><label><?php _e('Select Banner Color', 'Mercycorp'); ?></label></li>
                                <li>
                                    <input type="text" name="banner_bg_color" value="<?php echo $cs_theme_option['banner_bg_color'] ?>" class="bg_color" />
                                    <p><?php _e('Pick a custom color for banner', 'Mercycorp'); ?> e.g. #333</p>
                                </li>
                            </ul> 
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Layout Option', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="radio" name="layout_option" value="wrapper_boxed" <?php if ($cs_theme_option['layout_option'] == "wrapper_boxed") echo "checked" ?> class="styled" />
                                    <label><?php _e('Boxed', 'Mercycorp'); ?></label>
                                    <input type="radio" name="layout_option" value="wrapper" <?php if ($cs_theme_option['layout_option'] == "wrapper") echo "checked" ?> class="styled" />
                                    <label><?php _e('Wide', 'Mercycorp'); ?></label>
                                </li>
                            </ul>
                            <div class="opt-head">
                                <h4><?php _e('Layout Options', 'Mercycorp'); ?></h4>
                                <div class="clear"></div>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Background Image', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <div class="meta-input pattern">
                                        <?php
                                        for ($i = 0; $i < 11; $i++) {
                                            ?>
                                            <div class='radio-image-wrapper'>
                                                <input <?php if ($cs_theme_option['bg_img'] == $i) echo "checked" ?> onclick="select_bg()" type="radio" name="bg_img" class="radio" value="<?php echo $i ?>" />
                                                <label for="radio_<?php echo $i ?>"> <span class="ss"><img src="<?php echo get_template_directory_uri() ?>/images/background/background<?php echo $i ?>.png" /></span> <span <?php if ($cs_theme_option['bg_img'] == $i) echo "class='check-list'" ?> id="check-list">&nbsp;</span> </label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </li>
                                <li class="full">&nbsp;</li>
                                <li class="to-label">
                                    <label><?php _e('Background Image', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input id="bg_img_custom" name="bg_img_custom" value="<?php echo $cs_theme_option['bg_img_custom'] ?>" type="text" class="small" />
                                    <input id="bg_img_custom" name="bg_img_custom" type="button" class="uploadfile left" value="<?php _e('Browse', 'Mercycorp'); ?>"/>
                                    <?php if ($cs_theme_option['bg_img_custom'] <> "") { ?>
                                        <div class="thumb-preview" id="bg_img_custom_img_div"> <img src="<?php echo $cs_theme_option['bg_img_custom'] ?>" /> <a href="javascript:remove_image('bg_img_custom')" class="del">&nbsp;</a> </div>
                                    <?php } ?>
                                </li>
                                <li class="full">&nbsp;</li>
                                <li class="to-label">
                                    <label><?php _e('Position', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="radio" name="bg_position" value="left" <?php if ($cs_theme_option['bg_position'] == "left") echo "checked" ?> class="styled" />
                                    <label><?php _e('Left', 'Mercycorp'); ?></label>
                                    <input type="radio" name="bg_position" value="center" <?php if ($cs_theme_option['bg_position'] == "center") echo "checked" ?> class="styled" />
                                    <label><?php _e('Center', 'Mercycorp'); ?></label>
                                    <input type="radio" name="bg_position" value="right" <?php if ($cs_theme_option['bg_position'] == "right") echo "checked" ?> class="styled" />
                                    <label><?php _e('Right', 'Mercycorp'); ?></label>
                                </li>
                                <li class="full">&nbsp;</li>
                                <li class="to-label">
                                    <label><?php _e('Repeat', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="radio" name="bg_repeat" value="no-repeat" <?php if ($cs_theme_option['bg_repeat'] == "no-repeat") echo "checked" ?> class="styled" />
                                    <label><?php _e('No Repeat', 'Mercycorp'); ?></label>
                                    <input type="radio" name="bg_repeat" value="repeat" <?php if ($cs_theme_option['bg_repeat'] == "repeat") echo "checked" ?> class="styled" />
                                    <label><?php _e('Tile', 'Mercycorp'); ?></label>
                                    <input type="radio" name="bg_repeat" value="repeat-x" <?php if ($cs_theme_option['bg_repeat'] == "repeat-x") echo "checked" ?> class="styled" />
                                    <label><?php _e('Tile Horizontally', 'Mercycorp'); ?></label>
                                    <input type="radio" name="bg_repeat" value="repeat-y" <?php if ($cs_theme_option['bg_repeat'] == "repeat-y") echo "checked" ?> class="styled" />
                                    <label><?php _e('Tile Vertically', 'Mercycorp'); ?></label>
                                </li>
                                <li class="full">&nbsp;</li>
                                <li class="to-label">
                                    <label><?php _e('Attachment', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="radio" name="bg_attach" value="scroll" <?php if ($cs_theme_option['bg_attach'] == "scroll") echo "checked" ?> class="styled" />
                                    <label><?php _e('Scroll', 'Mercycorp'); ?></label>
                                    <input type="radio" name="bg_attach" value="fixed" <?php if ($cs_theme_option['bg_attach'] == "fixed") echo "checked" ?> class="styled" />
                                    <label><?php _e('Fixed', 'Mercycorp'); ?></label>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Background Pattern', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <div class="meta-input pattern">
                                        <?php
                                        for ($i = 0; $i < 12; $i++) {
                                            ?>
                                            <div class='radio-image-wrapper'>
                                                <input <?php if ($cs_theme_option['pattern_img'] == $i) echo "checked" ?> onclick="select_pattern()" type="radio" name="pattern_img" class="radio" value="<?php echo $i ?>" />
                                                <label for="radio_<?php echo $i ?>"> <span class="ss"><img src="<?php echo get_template_directory_uri() ?>/images/pattern/pattern<?php echo $i ?>.png" /></span> <span <?php if ($cs_theme_option['pattern_img'] == $i) echo "class='check-list'" ?> id="check-list">&nbsp;</span> </label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </li>
                                <li class="full">&nbsp;</li>
                                <li class="to-label">
                                    <label><?php _e('Background Pattern', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input id="custome_pattern" name="custome_pattern" value="<?php echo $cs_theme_option['custome_pattern']; ?>" type="text" class="small" />
                                    <input id="custome_pattern" name="custome_pattern" type="button" class="uploadfile left" value="<?php _e('Browse', 'Mercycorp'); ?>"/>
                                    <?php if ($cs_theme_option['custome_pattern'] <> "") { ?>
                                        <div class="thumb-preview" id="custome_pattern_img_div"> <img src="<?php echo $cs_theme_option['custome_pattern']; ?>" /> <a href="javascript:remove_image('custome_pattern')" class="del">&nbsp;</a> </div>
                                    <?php } ?>
                                </li>
                                <li class="full">&nbsp;</li>
                                <li class="to-label">
                                    <label><?php _e('Background Color', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="bg_color" value="<?php echo $cs_theme_option['bg_color'] ?>" class="bg_color" data-default-color="" />
                                </li>
                            </ul>
                        </div>
                        <!-- Color And Style End --> 
                        <!-- Logo Tabs -->
                        <div id="tab-logo" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('Logo / Fav Icon Settings', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Logo / Fav Icon Settings', 'Mercycorp'); ?></h4>
                                <p><?php _e('Add your logo and fav icon.', 'Mercycorp'); ?></p>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Upload Logo', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input id="logo" name="logo" value="<?php echo $cs_theme_option['logo'] ?>" type="text" class="small {validate:{accept:'jpg|jpeg|gif|png|bmp'}}" />
                                    <input id="log" name="logo" type="button" class="uploadfile left" value="<?php _e('Browse', 'Mercycorp'); ?>"/>
                                    <?php if ($cs_theme_option['logo'] <> "") { ?>
                                        <div class="thumb-preview" id="logo_img_div"> <img width="<?php echo $cs_theme_option['logo_width'] ?>" height="<?php echo $cs_theme_option['logo_height'] ?>" src="<?php echo $cs_theme_option['logo'] ?>" /> <a href="javascript:remove_image('logo')" class="del">&nbsp;</a> </div>
                                    <?php } ?>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Width', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="logo_width" id="width-value" value="<?php echo $cs_theme_option['logo_width'] ?>" class="vsmall" />
                                    <span class="short">px</span>
                                    <p><?php _e('Please enter the required size', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Height', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="logo_height" id="height-value" value="<?php echo $cs_theme_option['logo_height'] ?>" class="vsmall" />
                                    <span class="short">px</span>
                                    <p><?php _e('Please enter the required size', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Sticky Menu', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="hidden" name="header_sticky_menu" value="" />
                                    <input type="checkbox" class="myClass" name="header_sticky_menu" <?php if ($cs_theme_option['header_sticky_menu'] == "on") echo "checked" ?> />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('FAV Icon', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input id="fav_icon" name="fav_icon" value="<?php echo $cs_theme_option['fav_icon'] ?>" type="text" class="small {validate:{accept:'ico|png'}}" />
                                    <input id="fav_icon" name="fav_icon" type="button" class="uploadfile left" value="<?php _e('Browse', 'Mercycorp'); ?>" />
                                    <p><?php _e('Browse a small fav icon, only .ICO or .PNG format allowed', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                        </div>

                        <!-- Logo Tabs End --> 

                        <!-- Header Styles --> 

                        <!-- Header Script -->
                        <div id="tab-head-scripts" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('Header Settings', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Header Settings', 'Mercycorp'); ?></h4>
                                <p><?php _e('Modify your header settings', 'Mercycorp'); ?></p>
                            </div>
                            <div class="header-section" id="header_banner1">
                                <ul class="form-elements">
                                    <li class="full">&nbsp;</li>
                                    <li class="to-label">
                                        <label><?php _e('Logo', 'Mercycorp'); ?></label>
                                    </li>
                                    <li class="to-field">
                                        <input type="hidden" name="header_logo" value=""  />
                                        <input type="checkbox" class="myClass" name="header_logo" <?php if ($cs_theme_option['header_logo'] == "on") echo "checked" ?> />
                                    </li>
                                </ul>
                                <ul class="form-elements">
                                    <li class="full">&nbsp;</li>
                                    <li class="to-label">
                                        <label><?php _e('Slogan', 'Mercycorp'); ?></label>
                                    </li>
                                    <li class="to-field">
                                        <input type="hidden" name="header_slogan" value="" >
                                        <input type="checkbox" class="myClass" name="header_slogan" <?php if ($cs_theme_option['header_slogan'] == "on") echo "checked" ?> />
                                    </li>
                                </ul>
                                <?php
                                $wpmlsettings = get_option('icl_sitepress_settings');

                                if (function_exists('icl_object_id')) {
                                    ?>
                                    <ul class="form-elements">
                                        <li class="full">&nbsp;</li>
                                        <li class="to-label">
                                            <label><?php _e('Header Languages', 'Mercycorp'); ?></label>
                                        </li>
                                        <li class="to-field">
                                            <input type="hidden" name="header_languages" value="" />
                                            <input type="checkbox" class="myClass" name="header_languages" <?php if ($cs_theme_option['header_languages'] == "on") echo "checked" ?> />
                                        </li>
                                    </ul>
                                <?php } ?>
                                <ul class="form-elements">
                                    <li class="full">&nbsp;</li>
                                    <li class="to-label">
                                        <label><?php _e('Header Top Menu', 'Mercycorp'); ?></label>
                                    </li>
                                    <li class="to-field">
                                        <input type="hidden" name="header_top_menu" value="" />
                                        <input type="checkbox" class="myClass" name="header_top_menu" <?php if ($cs_theme_option['header_top_menu'] == "on") echo "checked" ?> />
                                    </li>
                                </ul>
                                <ul class="form-elements">
                                    <li class="full">&nbsp;</li>
                                    <li class="to-label">
                                        <label><?php _e('Social Icons', 'Mercycorp'); ?></label>
                                    </li>
                                    <li class="to-field">
                                        <input type="hidden" name="header_social_icons" value=""/>
                                        <input type="checkbox" class="myClass" name="header_social_icons" <?php if ($cs_theme_option['header_social_icons'] == "on") echo "checked" ?>/>
                                    </li>
                                </ul>
                                <ul class="form-elements" id="cs_breadcrumbs">
                                    <li class="to-label">
                                        <label><?php _e('Show BreadCrumbs', 'Mercycorp'); ?></label>
                                    </li>
                                    <li class="to-field">
                                        <input type="hidden" name="show_beadcrumbs" value="" />
                                        <input type="checkbox" class="myClass" name="show_beadcrumbs" <?php if (isset($cs_theme_option['show_beadcrumbs']) and $cs_theme_option['show_beadcrumbs'] == "on") echo "checked" ?> />
                                        <p><?php _e('Switch it on if you want to show BreadCrumbs. If you switch it off it will not show breadcrumbs', 'Mercycorp'); ?></p>
                                    </li>
                                </ul>
                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Header Next Event', 'Mercycorp'); ?></label>
                                    </li>
                                    <li class="to-field">
                                        <select name="header_next_event">
                                            <option value="0"><?php _e('-- Select Next Event --', 'Mercycorp'); ?></option>
                                            <?php
                                            $args = array(
                                                'posts_per_page' => "-1",
                                                'post_type' => 'events',
                                                'post_status' => 'publish',
                                                'meta_key' => 'cs_event_to_date',
                                                'meta_value' => date('Y-m-d'),
                                                'meta_compare' => ">=",
                                                'orderby' => 'meta_value',
                                                'order' => 'ASC',
                                            );
                                            query_posts($args);
                                            while (have_posts()) : the_post();
                                                ?>
                                                <option <?php if ($cs_theme_option['header_next_event'] == $post->post_name) echo "selected" ?> value="<?php echo $post->post_name; ?>">
                                                    <?php the_title() ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                        <p><?php _e('You have to create Event from Events post type', 'Mercycorp'); ?></p>
                                    </li>
                                </ul>
                                <?php if (function_exists('is_woocommerce')) { ?> 
                                    <ul class="form-elements">
                                        <li class="full">&nbsp;</li>
                                        <li class="to-label">
                                            <label><?php _e('Social Cart Count', 'Mercycorp'); ?></label>
                                        </li>
                                        <li class="to-field">
                                            <input type="hidden" name="header_cart" value=""/>
                                            <input type="checkbox" class="myClass" name="header_cart" <?php if ($cs_theme_option['header_cart'] == "on") echo "checked" ?>/>
                                        </li>
                                    </ul>
                                <?php } ?>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Header Code', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <textarea rows="" cols="" name="header_code"><?php echo $cs_theme_option['header_code'] ?></textarea>
                                    <p><?php _e('Paste your Html or Css Code here', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                        </div>
                        <!-- Header Script End --> 
                        <!-- Footer Settings -->
                        <div id="tab-foot-setting" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('Footer Settings', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Footer Settings', 'Mercycorp'); ?></h4>
                                <p><?php _e('Add footer setting detail', 'Mercycorp'); ?></p>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Partners Title', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="partners_title" value="<?php echo $cs_theme_option['partners_title'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Select Partner', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <select name="partners_gallery">
                                        <option value="0"><?php _e('-- Select Partner --', 'Mercycorp'); ?></option>
                                        <?php
                                        query_posts(array('posts_per_page' => "-1", 'post_status' => 'publish', 'post_type' => 'albums'));
                                        while (have_posts()) : the_post();
                                            ?>
                                            <option <?php if ($cs_theme_option['partners_gallery'] == $post->post_name) echo "selected" ?> value="<?php echo $post->post_name; ?>">
                                                <?php the_title() ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                    <p><?php _e('You have to create partner gallery from gallery post type', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Show Partners', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <select name="show_partners">
                                        <option value="none"><?php _e('None', 'Mercycorp'); ?></option>
                                        <option <?php if ($cs_theme_option['show_partners'] == "home") echo "selected" ?> value="home"><?php _e('Home Page', 'Mercycorp'); ?> </option>
                                        <option <?php if ($cs_theme_option['show_partners'] == "all") echo "selected" ?> value="all"> <?php _e('All Pages', 'Mercycorp'); ?></option>
                                    </select>
                                    <p><?php _e('Select option to show partner on home page / all pages', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Custom Copyright', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <textarea rows="2" cols="4" name="copyright"><?php echo $cs_theme_option['copyright'] ?></textarea>
                                    <p><?php _e('Write Custom Copyright text', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Powered By Text', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <textarea rows="2" cols="4" name="powered_by"><?php echo $cs_theme_option['powered_by'] ?></textarea>
                                    <p><?php _e('Please enter powered by text', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Analytics Code', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <textarea rows="" cols="" name="analytics"><?php echo $cs_theme_option['analytics'] ?></textarea>
                                    <p><?php _e('Paste your Google Analytics (or other) tracking code here.<br />This will be added into the footer template of your theme.', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                        </div>
                        <!-- Footer Settings End --> 
                        <!-- Maintenance Page Settings start -->
                        <div id="tab-under-consturction" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('Maintenance Page Settings', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Maintenance Page Settings', 'Mercycorp'); ?></h4>
                                <p><?php _e('Add maintenance page setting detail', 'Mercycorp'); ?></p>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Maintenance Page', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="hidden" name="under-construction" value="" />
                                    <input type="checkbox" class="myClass" name="under-construction" <?php if ($cs_theme_option['under-construction'] == "on") echo "checked" ?> />
                                    <p><?php _e('Set the maintenance page On/Off', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Show Logo', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="hidden" name="showlogo" value="" />
                                    <input type="checkbox" class="myClass" name="showlogo" <?php if ($cs_theme_option['showlogo'] == "on") echo "checked" ?> />
                                    <p><?php _e('Set show logo On/Off', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Maintenance Text', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <textarea rows="2" cols="4" name="under_construction_text"><?php echo $cs_theme_option['under_construction_text'] ?></textarea>
                                    <p><?php _e('Write Maintenance', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Launch Date', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" id="launch_date" name="launch_date" value="<?php
                                    if ($cs_theme_option['launch_date'] == '') {
                                        echo gmdate("Y-m-d");
                                    } else {
                                        echo $cs_theme_option['launch_date'];
                                    }
                                    ?>" />
                                    <p> <?php _e('Put event start date', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Social Network', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="hidden" name="socialnetwork" value="" />
                                    <input type="checkbox" class="myClass" name="socialnetwork" <?php if ($cs_theme_option['socialnetwork'] == "on") echo "checked" ?> />
                                    <p><?php _e('Set social network On/Of', 'Mercycorp'); ?>f</p>
                                </li>
                            </ul>
                        </div>
                        <!-- Maintenance Page Settings end --> 
                        <!-- Other Settings Start -->
                        <div id="tab-other" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('Other Setting', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Other Setting', 'Mercycorp'); ?></h4>
                                <p><?php _e('Other Setting', 'Mercycorp'); ?></p>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Responsive', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="hidden" name="responsive" value="" />
                                    <input type="checkbox" class="myClass" name="responsive" <?php if ($cs_theme_option['responsive'] == "on") echo "checked" ?> />
                                    <p><?php _e('Set the responsive On/Off', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Right to Left (RTL)', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="hidden" name="style_rtl" value="" />
                                    <input type="checkbox" class="myClass" name="style_rtl" <?php if ($cs_theme_option['style_rtl'] == "on") echo "checked" ?> />
                                    <p><?php _e('Set the theme style "Right to Left (RTL)"', 'Mercycorp'); ?> </p>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Color Switcher', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="hidden" name="color_switcher" value="" />
                                    <input type="checkbox" class="myClass" name="color_switcher" <?php if ($cs_theme_option['color_switcher'] == "on") echo "checked" ?> />
                                    <p><?php _e('Set the color switcher for user demo', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Translation Switcher', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="hidden" name="trans_switcher" value="" />
                                    <input type="checkbox" class="myClass" name="trans_switcher" <?php if ($cs_theme_option['trans_switcher'] == "on") echo "checked" ?> />
                                    <p><?php _e('Set the translation switcher for user demo', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                        </div>
                        <!-- Other Settings End --> 
                        <!-- API Settings Start -->
                        <div id="tab-api-key" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('API Setting', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Twitter API Setting', 'Mercycorp'); ?></h4>
                                <p><?php _e('Twitter API Setting', 'Mercycorp'); ?></p>
                            </div>
                            <div class="opt-head">
                                <h4><?php _e('Twitter API Setting', 'Mercycorp'); ?></h4>
                                <div class="clear"></div>
                            </div>
                            <ul class="form-elements">
                            <li class="to-label">
                              <label><?php _e('Cache Time Limit','Mercycorp');?></label>
                            </li>
                            <li class="to-field">
                              <input type="hidden" name="cache_limit_time" value="" />
                              <input type="text" id="cache_limit_time" name="cache_limit_time" value="<?php  echo $cs_theme_option['cache_limit_time'];  ?>"  class="{validate:{required:true}}"/>
                            </li>
                          </ul>
                          <ul class="form-elements">
                            <li class="to-label">
                              <label><?php _e('Number of tweet','Mercycorp');?></label>
                            </li>
                            <li class="to-field">
                              <input type="hidden" name="tweet_num_post" value="" />
                              <input type="text" id="tweet_num_post" name="tweet_num_post" value="<?php  echo $cs_theme_option['tweet_num_post'];  ?>"  class="{validate:{required:true}}"/>
                            </li>
                          </ul>
                          <ul class="form-elements">
                              <li class="to-label">
                                <label><?php _e('Date Time Formate','Mercycorp')?></label>
                              </li>
                              <li class="to-field">
                                <select name="twitter_datetime_formate" class="dropdown" id="cs_twitter_datetime_formate" onchange="javascript:home_breadcrumb_toggle(this.value)">
                                  <option <?php if($cs_theme_option['twitter_datetime_formate']=="default"){echo "selected";}?> value="default" ><?php _e('Displays November 06 2012','Mercycorp')?></option>
                                  <option <?php if($cs_theme_option['twitter_datetime_formate']=="eng_suff"){echo "selected";}?> value="eng_suff" ><?php _e('Displays 6th November','Mercycorp')?></option>
                                  <option <?php if($cs_theme_option['twitter_datetime_formate']=="ddmm"){echo "selected";}?> value="ddmm" ><?php _e('Displays 06 Nov','Mercycorp')?></option>
                                  <option <?php if($cs_theme_option['twitter_datetime_formate']=="ddmmyy"){echo "selected";}?> value="ddmmyy" ><?php _e('Displays 06 Nov 2012','Mercycorp')?></option>
                                  <option <?php if($cs_theme_option['twitter_datetime_formate']=="full_date"){echo "selected";}?> value="full_date" ><?php _e('Displays Tues 06 Nov 2012','Mercycorp')?></option>
                                  <option <?php if($cs_theme_option['twitter_datetime_formate']=="time_since"){echo "selected";}?> value="time_since" ><?php _e('Displays in hours, minutes etc','Mercycorp')?></option>
                                </select>
                              </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Consumer Key', 'Mercycorp'); 
                                    
                                    $cs_theme_option['consumer_key'] = isset($cs_theme_option['consumer_key']) ? $cs_theme_option['consumer_key'] : '';
                                    ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="hidden" name="consumer_key" value="" />
                                    <input type="text" id="consumer_key" name="consumer_key" value="<?php echo $cs_theme_option['consumer_key']; ?>"  class="{validate:{required:true}}"/>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Consumer Secret', 'Mercycorp'); 
                                    $cs_theme_option['consumer_secret'] = isset($cs_theme_option['consumer_secret']) ?  $cs_theme_option['consumer_secret'] : '';
                                    
                                    ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="hidden" name="consumer_secret" value="" />
                                    <input type="text" id="consumer_secret" name="consumer_secret" value="<?php echo $cs_theme_option['consumer_secret']; ?>" class="{validate:{required:true}}"/>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Access Token', 'Mercycorp'); 
                                    $cs_theme_option['access_token']  = isset($cs_theme_option['access_token']) ? $cs_theme_option['access_token'] : '';
                                    $cs_theme_option['access_token_secret'] = isset($cs_theme_option['access_token_secret']) ? $cs_theme_option['access_token_secret'] : '';
                                    ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="hidden" name="access_token" value="" />
                                    <input type="text" id="access_token" name="access_token" value="<?php echo $cs_theme_option['access_token']; ?>" class="{validate:{required:true}}"/>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Access Token Secret', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="hidden" name="access_token_secret" value="" />
                                    <input type="text" id="access_token_secret" name="access_token_secret" value="<?php echo $cs_theme_option['access_token_secret']; ?>" class="{validate:{required:true}}"/>
                                </li>
                            </ul>
                            <input type="hidden" id="submit_btn" name="twitter_setting" class="botbtn" value="Generate Bearer Token"  />
                        </div>
                        <div id="tab-paypalapi-key" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('Paypal API Setting', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Paypal API Setting', 'Mercycorp'); ?></h4>
                                <p><?php _e('Paypal API Setting', 'Mercycorp'); ?></p>
                            </div>
                            <div class="opt-head">
                                <h4><?php _e('Paypal API Setting', 'Mercycorp'); ?></h4>
                                <div class="clear"></div>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Paypal Email', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" id="paypal_email" name="paypal_email" value="<?php echo $cs_theme_option['paypal_email']; ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Paypal Ipn Url', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <?php $ipn_url = get_template_directory_uri() . '/include/ipn.php' ?>
                                    <input type="text" id="paypal_ipn_url" name="paypal_ipn_url" value="<?php
                                    if (isset($cs_theme_option['paypal_ipn_url']) and $cs_theme_option['paypal_ipn_url'] != '') {
                                        echo $cs_theme_option['paypal_ipn_url'];
                                    } else {
                                        echo $ipn_url;
                                    }
                                    ?>"/>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Currency', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <?php $currency_array = array('U.S. Dollar' => 'USD', 'Australian Dollar' => 'AUD', 'Brazilian Real' => 'BRL', 'Canadian Dollar' => 'CAD', 'Czech Koruna' => 'CZK', 'Danish Krone' => 'DKK', 'Euro' => 'EUR', 'Hong Kong Dollar' => 'HKD', 'Hungarian Forint' => 'HUF', 'Israeli New Sheqel' => 'ILS', 'Japanese Yen' => 'JPY', 'Malaysian Ringgit' => 'MYR', 'Mexican Peso' => 'MXN', 'Norwegian Krone' => 'NOK', 'New Zealand Dollar' => 'NZD', 'Philippine Peso' => 'PHP', 'Polish Zloty' => 'PLN', 'Pound Sterling' => 'GBP', 'Singapore Dollar' => 'SGD', 'Swedish Krona' => 'SEK', 'Swiss Franc' => 'CHF', 'Taiwan New Dollar' => 'TWD', 'Thai Baht' => 'THB', 'Turkish Lira' => 'TRY'); ?>
                                    <select name="paypal_currency">
                                        <?php foreach ($currency_array as $key => $val) { ?>
                                            <option value="<?php echo $val; ?>" <?php
                                            if ($cs_theme_option['paypal_currency'] == $val) {
                                                echo ' selected="selected"';
                                            }
                                            ?>><?php echo $key; ?></option>
                                                <?php } ?>
                                    </select>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Currency Sign', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" id="paypal_currency_sign" name="paypal_currency_sign" value="<?php
                                    if ($cs_theme_option['paypal_currency_sign'] == '') {
                                        echo '$';
                                    } else {
                                        echo $cs_theme_option['paypal_currency_sign'];
                                    }
                                    ?>"/>
                                    <p><?php _e('Use Currency Sign', 'Mercycorp'); ?> eg: $, £</p>
                                </li>
                            </ul>
                        </div>
                        <div id="tab-mailchimp-key" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('MailChimp Setting', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('MailChimp Setting', 'Mercycorp'); ?></h4>
                                <p><?php _e('MailChimp Setting', 'Mercycorp'); ?></p>
                            </div>
                            <div class="opt-head">
                                <h4><?php _e('MailChimp Setting', 'Mercycorp'); ?></h4>
                                <div class="clear"></div>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('MailChimp Key', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" id="mailchimp_key" name="mailchimp_key" value="<?php echo $cs_theme_option['mailchimp_key']; ?>" />
                                    <p><?php echo __('Enter a valid MailChimp API key here to get started. Once you\'ve done that, you can use the MailChimp Widget from the Widgets menu. You will need to have at least MailChimp list set up before the using the widget.', 'Mercycorp') . __(' You can get your mailchimp activation key', 'Mercycorp') . ' <u><a href="' . get_admin_url() . 'https://login.mailchimp.com/">' . __('here', 'Mercycorp') . '</a></u>' ?>                
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <!-- API Settings end -->
                        <div id="tab-slider" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('Home Page Slider', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Home Page Slider', 'Mercycorp'); ?></h4>
                                <p><?php _e('Edit home page slider settings', 'Mercycorp'); ?></p>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Show Slider', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="hidden" name="show_slider" value="" />
                                    <input type="checkbox" class="myClass" name="show_slider" <?php if ($cs_theme_option['show_slider'] == "on") echo "checked" ?> />
                                    <p><?php _e('Switch it on if you want to show slider at home page. If you switch it off it will not show slider at home page', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Choose Slider Type', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <select name="slider_type" class="dropdown" onchange="javascript:home_slider_toggle(this.value)">
                                        <option <?php
                                        if ($cs_theme_option['slider_type'] == "Flex Slider") {
                                            echo "selected";
                                        }
                                        ?> ><?php _e('Flex Slider', 'Mercycorp'); ?></option>
                                        <option <?php
                                        if ($cs_theme_option['slider_type'] == "Revolution Slider") {
                                            echo "selected";
                                        }
                                        ?> ><?php _e('Revolution Slider', 'Mercycorp'); ?></option>
                                    </select>
                                </li>
                            </ul>
                            <ul class="form-elements" id="other_sliders" style=" <?php
                            if ($cs_theme_option['slider_type'] == "" or $cs_theme_option['slider_type'] == "Revolution Slider")
                                echo "display:none";
                            else
                                "display:inline";
                            ?>">
                                <li class="to-label">
                                    <label><?php _e('Select Slider', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <select name="slider_name" class="dropdown">
                                        <option value=""><?php _e('-- Select Slider --', 'Mercycorp'); ?></option>
                                        <?php
                                        query_posts("posts_per_page=-1&post_type=cs_slider");
                                        while (have_posts()) : the_post();
                                            ?>
                                            <option <?php if ($post->post_name == $cs_theme_option['slider_name']) echo "selected"; ?> value="<?php echo $post->post_name; ?>">
                                                <?php the_title() ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        ?>
                                    </select>
                                    <p><?php _e('Slider images resolution should be (1280 x 574). Create new Slider from', 'Mercycorp'); ?> <a style="color:#06F; text-decoration:underline;" href="<?php echo get_site_url(); ?>/wp-admin/post-new.php?post_type=cs_slider"><?php _e('here', 'Mercycorp'); ?></a></p>
                                </li>
                            </ul>
                            <ul class="form-elements" id="layer_slider" style=" <?php
                            if ($cs_theme_option['slider_type'] == "" or $cs_theme_option['slider_type'] <> "Revolution Slider")
                                echo "display:none";
                            else
                                "display:inline";
                            ?>" >
                                <li class="to-label">
                                    <label><?php _e('Revolution Slider Short Code', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                <?php 
                                $slider_id=isset($cs_theme_option['slider_id']) ? $cs_theme_option['slider_id']: '';?>
                                    <input type="text" name="slider_id" class="txtfield" value="<?php  echo $slider_id; ?>" />
                                    <p><?php _e('Please enter the Revolution Slider Short Code like [rev_slider rocky]', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                        </div>

                        <div id="tab-font-settings" style="display:none;">
                            <div class="theme-header"><h1><?php _e('Fonts Settings', 'Mercycorp'); ?></h1></div>
                            <div class="theme-help">
                                <h4><?php _e('Fonts Settings', 'Mercycorp'); ?></h4>
                                <p><?php _e('Edit Fonts Settings', 'Mercycorp'); ?></p>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label"><label><?php _e('Content Text Size', 'Mercycorp'); ?></label></li>
                                <li class="to-field">
                                    <input type="text" name="content_size" value="<?php echo $cs_theme_option['content_size'] ?>" class="vsmall" />
                                    <span class="short">px</span>
                                    <p><?php _e('Please enter the required size', 'Mercycorp'); ?></p>
                                </li>
                                <li class="full">&nbsp;</li>
                                <li class="to-label">&nbsp;</li>
                                <li class="to-field">
                                    <select name="content_size_g_font">  
                                        <option value=""><?php _e('-- Default Font --', 'Mercycorp'); ?></option>
                                        <?php foreach ($g_fonts as $key => $font): ?>
                                            <option <?php
                                            if ($cs_theme_option['content_size_g_font'] == $font) {
                                                echo "selected";
                                            }
                                            ?>><?php echo $font; ?></option>
                                            <?php endforeach; ?>  
                                    </select>
                                </li>
                            </ul>                        
                        </div>

                        <div id="tab-manage-sidebars" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('Manage Sidebars', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Manage Sidebars', 'Mercycorp'); ?></h4>
                                <p><?php _e('Manage Sidebars', 'Mercycorp'); ?></p>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Sidebar Name', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input class="small" type="text" name="sidebar_input" id="sidebar_input" style="width:420px;" />
                                    <input type="button" value="<?php _e('Add Sidebar', 'Mercycorp'); ?>" onclick="javascript:add_sidebar()" />
                                    <p><?php _e('Please enter the desired title of sidebar', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                            <div class="opt-head">
                                <h4><?php _e('Already Added Sidebars', 'Mercycorp'); ?></h4>
                                <div class="clear"></div>
                            </div>
                            <div class="boxes">
                                <table class="to-table" border="0" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th><?php _e('Sider Bar Name', 'Mercycorp'); ?></th>
                                            <th class="centr"><?php _e('Actions', 'Mercycorp'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="sidebar_area">
                                        <?php
                                        if (isset($cs_theme_option['sidebar']) and count($cs_theme_option['sidebar']) > 0) {
                                            $cs_counter_sidebar = rand(10000, 20000);
                                            foreach ($cs_theme_option['sidebar'] as $sidebar) {
                                                $cs_counter_sidebar++;
                                                echo '<tr id="' . $cs_counter_sidebar . '">';
                                                echo '<td><input type="hidden" name="sidebar[]" value="' . $sidebar . '" />' . $sidebar . '</td>';
                                                echo '<td class="centr"> <a onclick="javascript:return confirm(\'Are you sure! You want to delete this\')" href="javascript:cs_div_remove(' . $cs_counter_sidebar . ')">Del</a> </td>';
                                                echo '</tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="tab-flex-slider" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('Flex Slider', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Flex Slider Options', 'Mercycorp'); ?></h4>
                                <p><?php _e('Configure Flex Slider setting', 'Mercycorp'); ?></p>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Effects', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <select class="dropdown" name="flex_effect">
                                        <option <?php
                                        if ($cs_theme_option['flex_effect'] == "fade") {
                                            echo "selected";
                                        }
                                        ?> value="fade" ><?php _e('Fade', 'Mercycorp'); ?></option>
                                        <option <?php
                                        if ($cs_theme_option['flex_effect'] == "slide") {
                                            echo "selected";
                                        }
                                        ?> value="slide" ><?php _e('Slide', 'Mercycorp'); ?></option>
                                    </select>
                                    <p><?php _e('Please select Effect for flex Slider', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Auto Play', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="hidden" name="flex_auto_play" value="" />
                                    <input type="checkbox" name="flex_auto_play" <?php
                                    if ($cs_theme_option['flex_auto_play'] == "on") {
                                        echo "checked";
                                    }
                                    ?> class="myClass" />
                                    <p><?php _e('If true, the slideshow will start running on page load', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Animation Speed', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="flex_animation_speed" size="5" class="{validate:{required:true}} bar" value="<?php echo $cs_theme_option['flex_animation_speed'] ?>" />
                                    <p><?php _e('How long the slideshow transition takes (in milliseconds)', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Pause Time', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="flex_pause_time" size="5" class="{validate:{required:true}} bar" value="<?php echo $cs_theme_option['flex_pause_time'] ?>" />
                                    <p><?php _e('Resume slideshow after user interaction (in milliseconds)', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                        </div>
                        <div id="tab-social-network" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('Social Settings', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Social Network', 'Mercycorp'); ?></h4>
                                <p><?php _e('Edit Social Network', 'Mercycorp'); ?></p>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Section Title', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="social_net_title" value="<?php echo $cs_theme_option['social_net_title'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Icon Path', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input id="social_net_icon_path_input" type="text" class="small" onblur="javascript:update_image('social_net_icon_path_input_img_div')" />
                                    <input id="social_net_icon_path_input" name="social_net_icon_path_input" type="button" class="uploadfile left" value="<?php _e('Browse', 'Mercycorp'); ?>"/>
                                </li>
                                <li class="full">&nbsp;</li>
                                <li class="to-label">
                                    <label><?php _e('Awesome Font', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input class="small" type="text" id="social_net_awesome_input" style="width:420px;" />
                                    <p><?php _e('Put Awesome Font Code like "icon-flag"', 'Mercycorp'); ?></p>
                                </li>
                                <li class="full">&nbsp;</li>
                                <li class="to-label">
                                    <label><?php _e('Url', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input class="small" type="text" id="social_net_url_input" style="width:420px;" />
                                    <p><?php _e('Please enter Full Url', 'Mercycorp'); ?></p>
                                </li>
                                <li class="full">&nbsp;</li>
                                <li class="to-label">
                                    <label><?php _e('Title', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input class="small" type="text" id="social_net_tooltip_input" style="width:420px;" />
                                    <p><?php _e('Please enter text for icon tooltip', 'Mercycorp'); ?></p>
                                </li>
                                <li class="full">&nbsp;</li>
                                <li class="to-label"></li>
                                <li class="to-field">
                                    <input type="button" value="<?php _e('Add', 'Mercycorp'); ?>" onclick="javascript:cs_add_social_icon('<?php echo admin_url('admin-ajax.php') ?>')" />
                                </li>
                            </ul>
                            <div class="opt-head">
                                <h4><?php _e('Already Added Items', 'Mercycorp'); ?></h4>
                                <div class="clear"></div>
                            </div>
                            <div class="boxes">
                                <table class="to-table" border="0" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th><?php _e('Icon Path', 'Mercycorp'); ?></th>
                                            <th><?php _e('Url', 'Mercycorp'); ?></th>
                                            <th class="centr"><?php _e('Actions', 'Mercycorp'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="social_network_area">
                                        <?php
                                        if (isset($cs_theme_option['social_net_url']) and count($cs_theme_option['social_net_url']) > 0) {
                                            wp_enqueue_style('font-awesome_css', get_template_directory_uri() . '/css/font-awesome.css');
                                            // Register stylesheet
                                            wp_register_style('font-awesome-ie7_css', get_template_directory_uri() . '/css/font-awesome-ie7.css');
                                            // Apply IE conditionals
                                            $GLOBALS['wp_styles']->add_data('font-awesome-ie7_css', 'conditional', 'lte IE 9');
                                            // Enqueue stylesheet
                                            wp_enqueue_style('font-awesome-ie7_css');
                                            $cs_counter_social_network = rand(10000, 20000);
                                            $i = 0;
                                            foreach ($cs_theme_option['social_net_url'] as $val) {
                                                $cs_counter_social_network++;
                                                echo '<tr id="del_' . $cs_counter_social_network . '">';
                                                if (isset($cs_theme_option['social_net_awesome'][$i]) && $cs_theme_option['social_net_awesome'][$i] <> '') {
                                                    echo '<td><i style="color: green;" class="' . $cs_theme_option['social_net_awesome'][$i] . ' icon-2x"></td>';
                                                } else {
                                                    echo '<td><img width="50" src="' . $cs_theme_option['social_net_icon_path'][$i] . '"></td>';
                                                }
                                                echo '<td>' . $val . '</td>';
                                                echo '<td class="centr"> 
                                            <a onclick="javascript:return confirm(\'Are you sure! You want to delete this\')" href="javascript:social_icon_del(' . $cs_counter_social_network . ')">Del</a>
                                            | <a href="javascript:cs_toggle(' . $cs_counter_social_network . ')">Edit</a>
                                        </td>';
                                                echo '</tr>';
                                                ?>
                                                <tr id="<?php echo $cs_counter_social_network; ?>" style="display:none">
                                                    <td colspan="3"><ul class="form-elements">
                                                            <li class="to-label">
                                                                <label><?php _e('Icon Path', 'Mercycorp'); ?></label>
                                                            </li>
                                                            <li class="to-field">
                                                                <input id="social_net_icon_path<?php echo $cs_counter_social_network ?>" name="social_net_icon_path[]" value="<?php echo $cs_theme_option['social_net_icon_path'][$i] ?>" type="text" class="small" />
                                                            </li>
                                                            <li><a onclick="cs_toggle('<?php echo $cs_counter_social_network ?>')"><img src="<?php echo get_template_directory_uri() ?>/images/admin/close-red.png" /></a></li>
                                                            <li class="full">&nbsp;</li>
                                                            <li class="to-label">
                                                                <label><?php _e('Awesome Font', 'Mercycorp'); ?></label>
                                                            </li>
                                                            <li class="to-field">
                                                                <input class="small" type="text" id="social_net_awesome" name="social_net_awesome[]" value="<?php echo $cs_theme_option['social_net_awesome'][$i] ?>" style="width:420px;" />
                                                                <p><?php _e('Put Awesome Font Code like "icon-flag"', 'Mercycorp'); ?></p>
                                                            </li>
                                                            <li class="full">&nbsp;</li>
                                                            <li class="to-label">
                                                                <label><?php _e('Url', 'Mercycorp'); ?></label>
                                                            </li>
                                                            <li class="to-field">
                                                                <input class="small" type="text" id="social_net_url" name="social_net_url[]" value="<?php echo $val ?>" style="width:420px;" />
                                                                <p><?php _e('Please enter Full Url', 'Mercycorp'); ?></p>
                                                            </li>
                                                            <li class="full">&nbsp;</li>
                                                            <li class="to-label">
                                                                <label><?php _e('Title', 'Mercycorp'); ?></label>
                                                            </li>
                                                            <li class="to-field">
                                                                <input class="small" type="text" id="social_net_tooltip" name="social_net_tooltip[]" value="<?php echo $cs_theme_option['social_net_tooltip'][$i] ?>" style="width:420px;" />
                                                                <p><?php _e('Please enter text for icon tooltip.', 'Mercycorp'); ?></p>
                                                            </li>
                                                        </ul></td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="tab-social-sharing" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('Social Settings', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Social Network / Sharing', 'Mercycorp'); ?></h4>
                                <p><?php _e('Edit Social Network / Sharing', 'Mercycorp'); ?></p>
                            </div>
                            <div class="social-head">
                                <ul>
                                    <li><?php _e('Social Sharing', 'Mercycorp'); ?></li>
                                </ul>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Facebook', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field social-share">
                                    <input type="hidden" name="facebook_share" value="" />
                                    <input type="checkbox" class="myClass" name="facebook_share" <?php if ($cs_theme_option['facebook_share'] == "on") echo "checked" ?> />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Twitter', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field social-share">
                                    <input type="hidden" name="twitter_share" value="" />
                                    <input type="checkbox" class="myClass" name="twitter_share" <?php if ($cs_theme_option['twitter_share'] == "on") echo "checked" ?> />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Linkedin', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field social-share">
                                    <input type="hidden" name="linkedin_share" value="" />
                                    <input type="checkbox" class="myClass" name="linkedin_share" <?php if ($cs_theme_option['linkedin_share'] == "on") echo "checked" ?> />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Pinterest', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field social-share">
                                    <input type="hidden" name="pinterest_share" value="" />
                                    <input type="checkbox" class="myClass" name="pinterest_share" <?php if ($cs_theme_option['pinterest_share'] == "on") echo "checked" ?> />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Tumblr', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field social-share">
                                    <input type="hidden" name="tumblr_share" value="" />
                                    <input type="checkbox" class="myClass" name="tumblr_share" <?php if ($cs_theme_option['tumblr_share'] == "on") echo "checked" ?> />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Google+', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field social-share">
                                    <input type="hidden" name="google_plus_share" value="" />
                                    <input type="checkbox" class="myClass" name="google_plus_share" <?php if ($cs_theme_option['google_plus_share'] == "on") echo "checked" ?> />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Others', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field social-share">
                                    <input type="hidden" name="cs_other_share" value="" />
                                    <input type="checkbox" class="myClass" name="cs_other_share" <?php if ($cs_theme_option['cs_other_share'] == "on") echo "checked" ?> />
                                </li>
                            </ul>
                        </div>
                        <div id="tab-default-pages" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('Default Pages', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Default Pages Settings', 'Mercycorp'); ?></h4>
                                <p><?php _e('Manage Default Pages (Archive, Search, Categories, Tags and Author Pages)', 'Mercycorp'); ?></p>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Pagination', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <select name="pagination" class="dropdown" onchange="cs_toggle('record_per_page')">
                                        <option <?php if ($cs_theme_option['pagination'] == "Show Pagination") echo "selected"; ?> ><?php _e('Show Pagination', 'Mercycorp'); ?></option>
                                        <option <?php if ($cs_theme_option['pagination'] == "Single Page") echo "selected"; ?> ><?php _e('Single Page', 'Mercycorp'); ?></option>
                                    </select>
                                </li>
                            </ul>
                            <?php
                            global $cs_xmlObject;
                            $cs_xmlObject = new stdClass();
                            $cs_xmlObject->sidebar_layout = new stdClass();
                            $cs_xmlObject->sidebar_layout->cs_layout = $cs_theme_option['cs_layout'];
                            $cs_xmlObject->sidebar_layout->cs_sidebar_left = $cs_theme_option['cs_sidebar_left'];
                            $cs_xmlObject->sidebar_layout->cs_sidebar_right = $cs_theme_option['cs_sidebar_right'];
                            if ($cs_theme_option['cs_layout'] == "none") {
                                $cs_xmlObject->sidebar_layout->cs_sidebar_left = '';
                                $cs_xmlObject->sidebar_layout->cs_sidebar_right = '';
                            } else if ($cs_theme_option['cs_layout'] == "left") {
                                $cs_xmlObject->sidebar_layout->cs_sidebar_right = '';
                            } else if ($cs_theme_option['cs_layout'] == "right") {
                                $cs_xmlObject->sidebar_layout->cs_sidebar_left = '';
                            }
                            meta_layout();
                            ?>
                        </div>
                        <div id="tab-upload-languages" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('Upload New Language', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Upload New Language', 'Mercycorp'); ?></h4>
                                <p><?php _e('Upload New Language', 'Mercycorp'); ?></p>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Upload Language (MO File)', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <div class="fileinputs">
                                        <input type="file" class="file" size="78" name="mofile" id="mofile" />
                                        <div class="fakefile">
                                            <input type="text" />
                                            <button><?php _e('Browse', 'Mercycorp'); ?></button>
                                        </div>
                                    </div>
                                    <p><?php _e('Please upload new language file (MO format only). It will be uploaded in your themes languages folder', 'Mercycorp'); ?> </p>
                                    <p><?php _e('Download MO files from', 'Mercycorp'); ?> <a target="_blank" href="http://translate.wordpress.org/projects/wp/">http://translate.wordpress.org/projects/wp/</a> </p>
                                    <p>
                                        <button type="button" id="upload_btn"><?php _e('Upload Files!', 'Mercycorp'); ?></button>
                                    </p>
                                </li>
                            </ul>
                            <ul id="image-list">
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Already Uploaded Languages', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field"> <strong>
                                        <?php
                                        $cs_counter = 0;
                                        foreach (glob(get_template_directory() . "/languages/*.mo") as $filename) {
                                            $cs_counter++;
                                            $val = str_replace(get_template_directory() . "/languages/", "", $filename);
                                            echo "<p>" . $cs_counter . ". " . str_replace(".mo", "", $val) . "</p>";
                                        }
                                        ?>
                                    </strong>
                                    <p><?php _e('Please copy the language name, open config.php file, find WPLANG constant and set its value by replacing the language name', 'Mercycorp'); ?> </p>
                                </li>
                            </ul>
                        </div>
                        <div id="tab-upload-languages" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('Manage Languages', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Upload Languages', 'Mercycorp'); ?></h4>
                                <p><?php _e('Upload new language', 'Mercycorp'); ?></p>
                            </div>
                        </div>
                        <div id="tab-event-translation" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('Events Translation', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Events Translation', 'Mercycorp'); ?></h4>
                                <p><?php _e('Events Translation', 'Mercycorp'); ?></p>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Time Left', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_timeleft" value="<?php echo $cs_theme_option['trans_timeleft'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Buy Now', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_buynow" value="<?php
                                    if (isset($cs_theme_option['trans_buynow'])) {
                                        echo $cs_theme_option['trans_buynow'];
                                    } else {
                                        echo 'Buy Now';
                                    }
                                    ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Add to Calendar', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_add_to_calendar" value="<?php echo $cs_theme_option['trans_add_to_calendar'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Outlook Calendar', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_outlook_calendar" value="<?php echo $cs_theme_option['trans_outlook_calendar'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Google Calendar', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_google_calendar" value="<?php echo $cs_theme_option['trans_google_calendar'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Yahoo Calendar', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_yahoo_calendar" value="<?php echo $cs_theme_option['trans_yahoo_calendar'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('iCal Calendar', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_ical_calendar" value="<?php echo $cs_theme_option['trans_ical_calendar'] ?>" />
                                </li>
                            </ul>
                        </div>
                        <div id="tab-contact-translation" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('Contact Translation', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Contact Translation', 'Mercycorp'); ?></h4>
                                <p><?php _e('Contact Translation', 'Mercycorp'); ?></p>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('First Name', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="res_first_name" value="<?php echo $cs_theme_option['res_first_name'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Last Name', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="res_last_name" value="<?php echo $cs_theme_option['res_last_name'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Subject', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_subject" value="<?php echo $cs_theme_option['trans_subject'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Message', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_message" value="<?php echo $cs_theme_option['trans_message'] ?>" />
                                </li>
                            </ul>
                        </div>
                        <div id="tab-cause-translation" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('Cause Translation', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Cause Translation', 'Mercycorp'); ?></h4>
                                <p><?php _e('Cause Translation', 'Mercycorp'); ?></p>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Raised', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="cause_raised" value="<?php echo $cs_theme_option['cause_raised'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Goal', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="cause_goal" value="<?php echo $cs_theme_option['cause_goal'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Goal Complete Status', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="cause_status" value="<?php echo $cs_theme_option['cause_status'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Donors', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="cause_donors" value="<?php echo $cs_theme_option['cause_donors'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Donation', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="cause_donation" value="<?php echo $cs_theme_option['cause_donation'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Donate', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="cause_donate" value="<?php echo $cs_theme_option['cause_donate'] ?>" />
                                </li>
                            </ul>
                        </div>
                        <div id="tab-other-translation" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('Other Translation', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Other Translation', 'Mercycorp'); ?></h4>
                                <p><?php _e('Other Translation', 'Mercycorp'); ?></p>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('404 Content', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <textarea name="trans_content_404"><?php echo $cs_theme_option['trans_content_404'] ?></textarea>
                                </li>
                            </ul>  
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Share Now', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_share_this_post" value="<?php echo $cs_theme_option['trans_share_this_post'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Listed in', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_listed_in" value="<?php echo $cs_theme_option['trans_listed_in'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Featured', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_featured" value="<?php echo $cs_theme_option['trans_featured'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Ler mais', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_read_more" value="<?php echo $cs_theme_option['trans_read_more'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Current Page', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_current_page" value="<?php echo $cs_theme_option['trans_current_page'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Special Request', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_special_request" value="<?php echo $cs_theme_option['trans_special_request'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Email Spam', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_email_published" value="<?php echo $cs_theme_option['trans_email_published'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Monday', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_opening_hours_monday" value="<?php echo $cs_theme_option['trans_opening_hours_monday'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Tuesday', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_opening_hours_tuesday" value="<?php echo $cs_theme_option['trans_opening_hours_tuesday'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Wednesday', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_opening_hours_wednesday" value="<?php echo $cs_theme_option['trans_opening_hours_wednesday'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Thursday', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_opening_hours_thursday" value="<?php echo $cs_theme_option['trans_opening_hours_thursday'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Friday', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_opening_hours_friday" value="<?php echo $cs_theme_option['trans_opening_hours_friday'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Saturday', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_opening_hours_saturday" value="<?php echo $cs_theme_option['trans_opening_hours_saturday'] ?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Sunday', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="text" name="trans_opening_hours_sunday" value="<?php echo $cs_theme_option['trans_opening_hours_sunday'] ?>" />
                                </li>
                            </ul>
                        </div>

                        <!-- import export Start -->
                        <div id="tab-import-export" style="display:none;">
                            <div class="theme-header">
                                <h1><?php _e('Theme Options Backup and restore settings', 'Mercycorp'); ?></h1>
                            </div>
                            <div class="theme-help">
                                <h4><?php _e('Theme Options Backup and restore settings', 'Mercycorp'); ?></h4>
                                <p><?php _e('Theme Options backup, restore backup, restore default and import / export current settings', 'Mercycorp'); ?></p>
                            </div>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Restore Default Options', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="button" value="<?php _e('Restore Default', 'Mercycorp'); ?>" onclick="cs_to_restore_default('<?php echo admin_url('admin-ajax.php') ?>', '<?php echo get_template_directory_uri() ?>')" />
                                    <p><?php _e('You current theme options will be replaced with the default theme activation options', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Last Backup Taken on', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field"> <strong><span id="last_backup_taken">
                                            <?php
                                            if (get_option('cs_theme_option_backup_time')) {
                                                echo get_option('cs_theme_option_backup_time');
                                            } else {
                                                echo __("Not Taken Yet", 'Mercycorp');
                                            }
                                            ?>
                                        </span></strong> </li>
                                <li class="full">&nbsp;</li>
                                <li class="to-label">
                                    <label><?php _e('Take Backup', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="button" value="<?php _e('Take Backup', 'Mercycorp'); ?>" onclick="cs_to_backup('<?php echo admin_url('admin-ajax.php') ?>', '<?php echo get_template_directory_uri() ?>')" />
                                    <p><?php _e('Take the Backup of your current theme options, it will replace the old backup if you have already taken', 'Mercycorp'); ?></p>
                                </li>
                                <li class="full">&nbsp;</li>
                                <li class="to-label">
                                    <label><?php _e('Restore Backup', 'Mercycorp'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input type="button" value="<?php _e('Restore Backup', 'Mercycorp'); ?>" onclick="cs_to_backup_restore('<?php echo admin_url('admin-ajax.php') ?>', '<?php echo get_template_directory_uri() ?>')" />
                                    <p><?php _e('Restore your last backup taken (It will be replaced on your current theme options)', 'Mercycorp'); ?></p>
                                </li>
                            </ul>
                        </div>
                        <!-- import / export end --> 

                    </div>
                    <div class="clear"></div>
                    <!-- Right Column End --> 
                </div>
                <div class="footer">
                    <input type="submit" id="submit_btn" name="submit_btn" class="botbtn" value="<?php _e('Save All Settings', 'Mercycorp'); ?>" />
                    <input type="hidden" name="action" value="theme_option_save" />
                </div>
            </div>
        </div>
    </form>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/scripts/admin/select.js"></script> 
    <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/scripts/admin/functions.js"></script> 
    <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/scripts/admin/jquery.validate.metadata.js"></script> 
    <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/scripts/admin/jquery.validate.js"></script> 
    <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/scripts/admin/ddaccordion.js"></script> 
    <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/scripts/admin/prettyCheckable.js"></script> 
    <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/scripts/admin/jquery.timepicker.js"></script>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/admin/jquery.ui.datepicker.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/admin/jquery.ui.datepicker.theme.css">
    <script type="text/javascript">
                                        jQuery(document).ready(function ($) {
                                            $('.bg_color').wpColorPicker();
                                        });
                                        function load_default_settings(id) {
                                            jQuery("#" + id + " input.button.wp-picker-default").trigger('click');
                                            jQuery("#" + id + " input[type='checkbox'].myClass").each(function (index) {
                                                var da = jQuery(this).data('default-header');
                                                var ch = jQuery(this).next().hasClass("checked")
                                                if ((da == 'on') && (!ch)) {
                                                    jQuery(this).next().trigger('click');
                                                }
                                                if ((da == 'off') && (ch)) {
                                                    jQuery(this).next().trigger('click');
                                                }
                                            });
                                            jQuery("#" + id + " input[type='text'].vsmall").each(function (index) {
                                                var da = jQuery(this).data('default-header');
                                                jQuery(this).val(da);

                                            });
                                            jQuery("#" + id + " .to-field input.small").each(function (index) {
                                                var da = jQuery(this).data('default-header');
                                                jQuery(this).val(da);
                                                jQuery(this).parent().find(".thumb-preview").find('img').attr("src", da)
                                            });
                                            jQuery("#" + id + " textarea").each(function (index) {
                                                var da = jQuery(this).data('default-header');
                                                jQuery(this).val(da);

                                            });
                                            jQuery("#" + id + " select").each(function (index) {

                                                var da = jQuery(this).data('default-header');
                                                jQuery(this).find("option[value='" + da + "']").attr("selected", "selected");

                                            });

                                        }
    </script> 
    <script type="text/javascript">
        jQuery(function ($) {
            $("#launch_date").datepicker({
                defaultDate: "+1w",
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                numberOfMonths: 1,
                onSelect: function (selectedDate) {
                    $("#launch_date").datepicker("option", "minDate", selectedDate);
                }
            });
        });
        function toggleDiv(id)
        {
            jQuery('.col2').children().hide();
            jQuery(id).show();
            location.hash = id + "-show";
            var link = id.replace('#', '');
            jQuery('.categoryitems li').removeClass('active');
            jQuery(".menuheader.expandable").removeClass('openheader');
            jQuery(".categoryitems").hide();
            jQuery("." + link).addClass('active');
            jQuery("." + link).parent("ul").show().prev().addClass("openheader");

        }
        jQuery(document).ready(function () {
            jQuery(".categoryitems").hide();
            jQuery(".categoryitems:first").show();
            jQuery(".menuheader:first").addClass("openheader");
            jQuery(".menuheader").live('click', function (event) {
                if (jQuery(this).hasClass('openheader')) {
                    jQuery(".menuheader").removeClass("openheader");
                    jQuery(this).next().slideUp(200);
                    return false;
                }
                jQuery(".menuheader").removeClass("openheader");
                jQuery(this).addClass("openheader");
                jQuery(".categoryitems").slideUp(200);
                jQuery(this).next().slideDown(200);
                return false;
            });
            var hash = window.location.hash.substring(1);
            var id = hash.split("-show")[0];
            if (id) {
                jQuery('.col2').children().hide();
                jQuery("#" + id).show();
                jQuery('.categoryitems li').removeClass('active');
                jQuery(".menuheader.expandable").removeClass('openheader');
                jQuery(".categoryitems").hide();
                jQuery("." + id).addClass('active');
                jQuery("." + id).parent("ul").slideDown(300).prev().addClass("openheader");

            }
        });

        var counter_sidebar = 0;
        function add_sidebar() {
            counter_sidebar++;
            var sidebar_input = jQuery("#sidebar_input").val();
            if (sidebar_input != "") {
                jQuery("#sidebar_area").append('<tr id="' + counter_sidebar + '"> \
                                <td><input type="hidden" name="sidebar[]" value="' + sidebar_input + '" />' + sidebar_input + '</td> \
                                <td class="centr"> <a onclick="javascript:return confirm(\'Are you sure! You want to delete this\')" href="javascript:cs_div_remove(' + counter_sidebar + ')">Del</a> </td> \
                            </tr>');
                jQuery("#sidebar_input").val("");
            }
        }
        jQuery().ready(function ($) {
            var container = $('div.container');
            // validate the form when it is submitted
            var validator = $("#frm").validate({
                errorContainer: container,
                errorLabelContainer: $(container),
                errorElement: 'span',
                errorClass: 'ele-error',
                meta: "validate"
            });
        });
        jQuery(document).ready(function ($) {
            var consoleTimeout;
            $('.minicolors').each(function () {
                $(this).minicolors({
                    change: function (hex, opacity) {
                        // Generate text to show in console
                        text = hex ? hex : 'transparent';
                        if (opacity)
                            text += ', ' + opacity;
                        text += ' / ' + $(this).minicolors('rgbaString');
                    }
                });
            });
        });
        (function () {
            var input = document.getElementById("mofile")
            var upload_btn = document.getElementById("upload_btn"),
                    formdata = false;
            if (window.FormData) {
                formdata = new FormData();
            }
            upload_btn.addEventListener("click", function (evt) {
                var i = 0, len = input.files.length, txt, reader, file;

                for (; i < len; i++) {
                    file = input.files[i];
                    if (formdata) {
                        formdata.append("mofile[]", file);
                    }
                }
                if (formdata) {
                    jQuery.ajax({
                        url: '<?php echo get_template_directory_uri() ?>/include/lang_upload.php',
                        type: "POST",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                            jQuery("#mofile").val("");
                            jQuery(".form-msg").show();
                            jQuery(".form-msg").html(res);
                        }
                    });
                }
            }, false);
        }());
    </script>
<?php } ?>
