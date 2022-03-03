<?php



// search varibales start

function cs_get_search_results($query) {

    if (!is_admin() and ( is_search())) {

        $query->set('post_type', array('post', 'events', 'cs_cause'));

        remove_action('pre_get_posts', 'cs_get_search_results');

    }

}



add_action('pre_get_posts', 'cs_get_search_results');



// Filter shortcode in text areas

if (!function_exists('cs_textarea_filter')) {



    function cs_textarea_filter($content = '') {

        return do_shortcode($content);

    }



}



//////////////// Header Cart ///////////////////

add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');



function woocommerce_header_add_to_cart_fragment($fragments) {

    if (class_exists('woocommerce')) {

        global $woocommerce;

        ob_start();

        ?>

        <div class="cart-sec">

            <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><span><i class="icon-shopping-cart"></i>(<?php echo $woocommerce->cart->cart_contents_count; ?>)</span><?php echo $woocommerce->cart->get_cart_total(); ?></a>

        </div>

        <?php

        $fragments['div.cart-sec'] = ob_get_clean();

        return $fragments;

    }

}



function cs_woocommerce_header_cart() {

    if (class_exists('woocommerce')) {

        global $woocommerce;

        ?>

        <div class="cart-sec">

            <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><span><i class="icon-shopping-cart"></i>(<?php echo $woocommerce->cart->cart_contents_count; ?>)</span><?php echo $woocommerce->cart->get_cart_total(); ?></a>

        </div>

        <?php

    }

}



//////////////// Header Cart Ends ///////////////////



/* Display navigation to next/previous for single.php */

if (!function_exists('cs_next_prev_post')) {



    function cs_next_prev_post($social_share_on = '') {

        global $post;

        posts_nav_link();

        // Don't print empty markup if there's nowhere to navigate.

        $previous = ( is_attachment() ) ? get_post($post->post_parent) : get_adjacent_post(false, '', true);

        $next = get_adjacent_post(false, '', false);

        echo '<div class="post-btn">';

        previous_post_link('%link', '<i class="icon-angle-left"></i>');

        next_post_link('%link', '<i class="icon-angle-right"></i>');

        echo '</div>';

    }



}



// next and prev post end

function posts_link_next_class($format) {

    $format = str_replace('href=', 'class="nexts colrhover" href=', $format);

    return $format;

}



add_filter('next_post_link', 'posts_link_next_class');



function posts_link_prev_class($format) {

    $format = str_replace('href=', 'class="prevs colrhover" href=', $format);

    return $format;

}



add_filter('previous_post_link', 'posts_link_prev_class');

//	Add Featured/sticky text/icon for sticky posts.

if (!function_exists('cs_featured()')) {



    function cs_featured() {

        global $cs_transwitch, $cs_theme_option;

        if (is_sticky()) {

            ?>

            <span class="featured"><span class="right-img"><?php

                    if ($cs_theme_option['trans_switcher'] == "on") {

                        _e('Featured', 'Mercycorp');

                    } else {

                        echo $cs_theme_option['trans_featured'];

                    }

                    ?></span><span class="left-img"></span></span>

                    <?php

                }

            }



        }



//Add classes according to diffrent view for blog post type

        function cs_blog_classes($blog_view = "") {

            if ($blog_view == 'blog-slider-view') {

                

            } elseif ($blog_view == 'blog-small') {

                echo 'blog-listing';

            } else {

                echo 'postlist blog';

            }

        }



// rating function

// custom function start



        /* 	return current post type and page type */



        function cs_post_type($current_id) {

            $post_type = get_post_type($current_id);

            if ($post_type == "events") {

                $post_type = "cs_event_meta";

            } elseif ($post_type == "page") {

                $post_type = "cs_page_builder";

            }

            return $post_type;

        }



// display post page title

        function cs_post_page_title() {

            if (is_author()) {

                global $author;

                $userdata = get_userdata($author);

                echo __('Author', 'Mercycorp') . " " . __('Archives', 'Mercycorp') . ": " . $userdata->display_name;

            } elseif (is_tag() || is_tax('event-tag') || is_tax('portfolio-tag') || is_tax('sermon-tag')) {

                echo __('Tags', 'Mercycorp') . " " . __('Archives', 'Mercycorp') . ": " . single_cat_title('', false);

            } elseif (is_category() || is_tax('event-category') || is_tax('portfolio-category') || is_tax('sermon-category') || is_tax('sermon-series') || is_tax('sermon-pastors')) {

                echo __('Categories', 'Mercycorp') . " " . __('Archives', 'Mercycorp') . ": " . single_cat_title('', false);

            } elseif (is_search()) {

                printf(__('Resultados de pesquisa %1$s %2$s', 'Mercycorp'), ': ', '<span>' . get_search_query() . '</span>');

            } elseif (is_day()) {

                printf(__('Daily Archives: %s', 'Mercycorp'), '<span>' . get_the_date() . '</span>');

            } elseif (is_month()) {

                printf(__('Monthly Archives: %s', 'Mercycorp'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'Mercycorp')) . '</span>');

            } elseif (is_year()) {

                printf(__('Yearly Archives: %s', 'Mercycorp'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'Mercycorp')) . '</span>');

            } elseif (is_404()) {

                _e('Error 404', 'Mercycorp');

            } elseif (!is_page()) {

                _e('Archives', 'Mercycorp');

            }

        }



// Dropcap shortchode with first letter in caps

        if (!function_exists('cs_dropcap_page')) {



            function cs_dropcap_page() {

                global $cs_node;

                $class = $cs_node->dropcap_class;

                $html = '<div class="element_size_' . $cs_node->dropcap_element_size . '">';

                $html .= '<div class="' . $class . '">';

                $html .= $cs_node->dropcap_content;

                $html .= '</div>';

                $html .= '</div>';

                return $html;

            }



        }



// block quote short code

        if (!function_exists('cs_quote_page')) {



            function cs_quote_page() {

                global $cs_node;

                $html = '<div class="element_size_' . $cs_node->quote_element_size . '">';

                $html .= '<blockquote style=" text-align:' . $cs_node->quote_align . '; color:' . $cs_node->quote_text_color . '"><span>' . $cs_node->quote_content . '</span></blockquote>';

                $html .= '</div>';

                return $html . '<div class="clear"></div>';

            }



        }



// video short code

        if (!function_exists('cs_video_page')) {



            function cs_video_page() {

                global $cs_node;

                $html = '<div class="element_size_' . $cs_node->video_element_size . '">';

                $html .= wp_oembed_get($cs_node->video_url, array('width' => $cs_node->video_width, 'height' => $cs_node->video_height));

                $html .= '</div>';

                return $html;

            }



        }

// map shortcode with various options

        if (!function_exists('cs_map_page')) {



            function cs_map_page() {

                global $cs_node, $cs_counter_node;

                if (!isset($cs_node->map_lat) or $cs_node->map_lat == "") {

                    $cs_node->map_lat = 0;

                }

                if (!isset($cs_node->map_lon) or $cs_node->map_lon == "") {

                    $cs_node->map_lon = 0;

                }

                if (!isset($cs_node->map_zoom) or $cs_node->map_zoom == "") {

                    $cs_node->map_zoom = 11;

                }

                if (!isset($cs_node->map_info_width) or $cs_node->map_info_width == "") {

                    $cs_node->map_info_width = 200;

                }

                if (!isset($cs_node->map_info_height) or $cs_node->map_info_height == "") {

                    $cs_node->map_info_height = 100;

                }

                if (!isset($cs_node->map_show_marker) or $cs_node->map_show_marker == "") {

                    $cs_node->map_show_marker = 'true';

                }

                if (!isset($cs_node->map_controls) or $cs_node->map_controls == "") {

                    $cs_node->map_controls = 'false';

                }

                if (!isset($cs_node->map_scrollwheel) or $cs_node->map_scrollwheel == "") {

                    $cs_node->map_scrollwheel = 'true';

                }

                if (!isset($cs_node->map_draggable) or $cs_node->map_draggable == "") {

                    $cs_node->map_draggable = 'true';

                }

                if (!isset($cs_node->map_type) or $cs_node->map_type == "") {

                    $cs_node->map_type = 'ROADMAP';

                }

                if (!isset($cs_node->map_info)) {

                    $cs_node->map_info = '';

                }

                if (!isset($cs_node->map_marker_icon)) {

                    $cs_node->map_marker_icon = '';

                }

                if (!isset($cs_node->map_title)) {

                    $cs_node->map_title = '';

                }

                if (!isset($cs_node->map_element_size)) {

                    $cs_node->map_element_size = 'default';

                }

                if (!isset($cs_node->map_height)) {

                    $cs_node->map_height = '180';

                }

                if (!isset($cs_node->map_view)) {

                    $cs_node->map_view = '';

                }

                if (!isset($cs_node->map_conactus_content)) {

                    $cs_node->map_conactus_content = '';

                }







                $map_show_marker = '';

                if ($cs_node->map_show_marker == "true") {

                    $map_show_marker = " var marker = new google.maps.Marker({

						position: myLatlng,

						map: map,

						title: '',

						icon: '" . $cs_node->map_marker_icon . "',

						shadow:''

					});

			";

                }



                //wp_enqueue_script('googleapis', 'https://maps.googleapis.com/maps/api/js?sensor=true', '', '', true);

                $html = '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-H7HcI6HJUpB8ozO2rG43NhmUiWzYfWg"></script>';

                $html .= '<div class="element_size_' . $cs_node->map_element_size . '">';

                $html .= '<div class="mapcode iframe mapsection gmapwrapp" id="map_canvas' . $cs_counter_node . '" style="height:' . $cs_node->map_height . 'px;"> </div>';

                $html .= '</div>';



                $html .= "<script type='text/javascript'>

					function initialize() {

						var myLatlng = new google.maps.LatLng(" . $cs_node->map_lat . ", " . $cs_node->map_lon . ");

						var mapOptions = {

							zoom: " . $cs_node->map_zoom . ",

							scrollwheel: " . $cs_node->map_scrollwheel . ",

							draggable: " . $cs_node->map_draggable . ",

							center: myLatlng,

							mapTypeId: google.maps.MapTypeId." . $cs_node->map_type . " ,

							disableDefaultUI: " . $cs_node->map_controls . ",

						}

						var map = new google.maps.Map(document.getElementById('map_canvas" . $cs_counter_node . "'), mapOptions);

						var infowindow = new google.maps.InfoWindow({

							content: '" . $cs_node->map_info . "',

							maxWidth: " . $cs_node->map_info_width . ",

							maxHeight:" . $cs_node->map_info_height . ",

						});

						" . $map_show_marker . "

						//google.maps.event.addListener(marker, 'click', function() {

	

							if (infowindow.content != ''){

							  infowindow.open(map, marker);

							   map.panBy(1,-60);

							   google.maps.event.addListener(marker, 'click', function(event) {

								infowindow.open(map, marker);

	

							   });

							}

						//});

					}

				

				google.maps.event.addDomListener(window, 'load', initialize);

				</script>";

                return $html;

            }



        }

// image short code

        if (!function_exists('cs_image_page')) {



            function cs_image_page() {

                global $cs_node;

                cs_enqueue_gallery_style_script();

                $href = '';

                $html = '';

                if ($cs_node->image_lightbox == "yes")

                    $href = $cs_node->image_source;

                if ($cs_node->image_lightbox == "yes")

                    $data_rel = 'data-rel="prettyPhoto"';

                else

                    $data_rel = 'target="_blank"';



                if ($cs_node->image_element_size <> "") {

                    $html .= '<div class="element_size_' . $cs_node->image_element_size . '">';

                }

                $html .= '<figure class="lightbox-single image-shortcode" style="float:left; width:' . $cs_node->image_width . 'px; height:' . $cs_node->image_height . 'px">';

                $html .= '<a class="' . $cs_node->image_style . '" href="' . $href . '" title="' . $cs_node->image_caption . '" ' . $data_rel . '>';

                $html .= '<img src="' . $cs_node->image_source . '" style="float:left; width:' . $cs_node->image_width . 'px; height:' . $cs_node->image_height . 'px" alt="" />';

                $html .= '</a>';

                $html .= '<figcaption class="webkit">';

                $html .= '<h6>' . $cs_node->image_caption . '</h6>';

                $html .= '</figcaption>';

                $html .= '</figure>';

                if ($cs_node->image_element_size <> "") {

                    $html .= '</div>';

                }

                return $html;

            }



        }

// Divider shortcode use for sepratiion of page elements

        if (!function_exists('cs_divider_page')) {



            function cs_divider_page() {

                global $cs_node;

                wp_enqueue_script('scrolltopcontrol_js', get_template_directory_uri() . '/scripts/frontend/scrolltopcontrol.js', '', '', true);

                $html = '<div class="devider element_size_' . $cs_node->divider_element_size . '>">';

                if ($cs_node->divider_style <> "divider2") {

                    $html .= '<div style="margin-top:' . $cs_node->divider_mrg_top . 'px;margin-bottom:' . $cs_node->divider_mrg_bottom . 'px; " class="' . $cs_node->divider_style . '">';

                    if (isset($cs_node->divider_backtotop) && strtolower($cs_node->divider_backtotop) == 'yes') {

                        $html .= '<a href="#" class="gotop" id="back-top">' . __('Top', 'Mercycorp') . '</a>';

                    }

                }

                if ($cs_node->divider_style == "divider2") {

                    $html .= '<div style="margin-top:' . $cs_node->divider_mrg_top . 'px;margin-bottom:' . $cs_node->divider_mrg_bottom . 'px; " class="heading-seprator"><span class="heading-pattren"></span>';

                    if (isset($cs_node->divider_backtotop) && strtolower($cs_node->divider_backtotop) == 'yes') {

                        $html .= '<a href="#" class="gotop" id="back-top">' . __('Top', 'Mercycorp') . '</a>';

                    }

                }



                $html .= '</div>';

                $html .= '</div>';

                return $html . '<div class="clear"></div>';

            }



        }



// Column shortcode with 2/3/4 column option even you can use shortcode in column shortcode

        if (!function_exists('cs_column_page')) {



            function cs_column_page() {

                global $cs_node;

                $html = '<div class="element_size_' . $cs_node->column_element_size . ' column">';

                $html .= do_shortcode($cs_node->column_text);

                $html .= '</div>';

                echo $html;

            }



        }



// tabs shortcode

        if (!function_exists('cs_tabs_page')) {



            function cs_tabs_page() {

                global $cs_node, $tab_counter;



                $html = "";

                if ($cs_node->tabs_element_size == "") {

                    $html .= '<ul class="nav nav-tabs" id="myTab">';

                    $cs_xmlObject = simplexml_load_string($cs_node->tabs_content);

                    $tabs_count = 0;

                    foreach ($cs_xmlObject as $val) {

                        if (!isset($val["icon"])) {

                            $val["icon"] = '';

                        }

                        if (!isset($val["title"])) {

                            $val["title"] = '';

                        }

                        $tabs_count++;

                        if ($val["active"] == "yes")

                            $tab_active = " active";

                        else

                            $tab_active = "";

                        $html .= '<li class="' . $tab_active . '"><a data-toggle="tab" href="#tab' . $tab_counter . $tabs_count . '"><i class="' . $val["icon"] . '"></i> ' . $val["title"] . '</a></li>';

                    }

                    $html .= '</ul>';

                    $html .= '<div class="tab-content">';

                    $tabs_count = 0;

                    foreach ($cs_xmlObject as $val) {

                        $tabs_count++;

                        if ($val["active"] == "yes")

                            $tab_active = " active";

                        else

                            $tab_active = "";

                        $html .= '<div class="tab-pane fade in ' . $tab_active . '" id="tab' . $tab_counter . $tabs_count . '">' . cs_decode_html_tags($val) . '</div>';

                    }

                    $html .= '</div>';

                    $html = '<div class="tabs ' . $cs_node->tabs_style . '">' . $html . '</div>';

                }

                return do_shortcode($html) . '<div class="clear"></div>';

            }



        }

// Accrodian shortcode

        if (!function_exists('cs_accordions_page')) {



            function cs_accordions_page() {

                global $cs_node, $acc_counter;

                $acc_counter = rand(5, 15);

                $acc_counter++;

                $accordion_count = 0;



                $html = "";

                if ($cs_node->accordion_element_size == "") {

                    $html .= '<div class="panel-group" id="accordion-' . $acc_counter . '">';

                    $cs_xmlObject = new SimpleXMLElement($cs_node->accordion_content);

                    foreach ($cs_xmlObject as $cs_node) {

                        if (!isset($cs_node["icon"])) {

                            $cs_node["icon"] = '';

                        }

                        if (!isset($cs_node["title"])) {

                            $cs_node["title"] = '';

                        }



                        $accordion_count++;

                        if ($accordion_count == 1 && $cs_node["active"] == "yes")

                            $class_active = " active";

                        else

                            $class_active = "";



                        if ($cs_node["active"] == "yes") {



                            $accordion_active = " in";

                        } else {

                            $accordion_active = "";

                        }

                        $html .= '<div class="panel panel-default"><div class="panel-heading">';

                       // $html .= '<i class="icon-question-sign icon-2"></i>';

                        $html .= '<h4 class="panel-title">';

                        $html .= '<a class="accordion-toggle backcolorhover collapsed ' . $class_active . '" data-toggle="collapse" data-parent="#accordion-' . $acc_counter . '" href="#accordion-' . str_replace(" ", "", $accordion_count . $acc_counter) . '"><i class="' . $cs_node["icon"] . '"></i> ' . $cs_node["title"] . '</a>';

                        $html .= '</h4>';

                        $html .= '</div>';

                        $html .= '<div id="accordion-' . str_replace(" ", "", $accordion_count . $acc_counter) . '" class="accordion-body collapse ' . $accordion_active . '">';

                        $html .= '<div class="panel-body"><p>' . cs_decode_html_tags($cs_node) . '</p></div>';

                        $html .= '</div>';

                        $html .= '</div>';

                    }

                    $html .= '</div>';

                }

                return do_shortcode($html) . '<div class="clear"></div>';

            }



        }



        if (!function_exists('cs_contact_submit')) {



            function cs_contact_submit() {

                foreach ($_REQUEST as $keys => $values) {

                    $$keys = $values;

                }

                $subject = "(" . $bloginfo . ") Contact Form Received";

                $message = '

			<table width="100%" border="1">

			  <tr><td width="100"><strong>' . __('Name', 'Mercycorp') . '</strong></td><td>' . $contact_name . '</td></tr>

			  <tr><td><strong>' . __('Email', 'Mercycorp') . '</strong></td><td>' . $contact_email . '</td></tr>

			  <tr><td><strong>' . __('Contact No', 'Mercycorp') . '</strong></td><td>' . $contact_no . '</td></tr>

			  <tr><td><strong>' . __('Message', 'Mercycorp') . '</strong></td><td>' . $contact_msg . '</td></tr>

			  <tr><td><strong>' . __('IP Address', 'Mercycorp') . '</strong></td><td>' . $_SERVER["REMOTE_ADDR"] . '</td></tr>

			</table>

			';

                $headers = "From: " . $contact_name . "\r\n";

                $headers .= "Reply-To: " . $contact_email . "\r\n";

                $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";

                $headers .= "MIME-Version: 1.0" . "\r\n";

                $attachments = '';

                wp_mail($cs_contact_email, $subject, $message, $headers, $attachments);

                //mail($cs_contact_email, $subject, $message, $headers);

                echo $cs_contact_succ_msg;

                die();

            }



        }

        add_action('wp_ajax_contact_submit', 'contact_submit');

        add_action('wp_ajax_contact_nopriv_submit', 'contact_submit');



// Corlor Switcher for front end

        function cs_color_switcher() {

            global $cs_theme_option;

            if ($cs_theme_option['color_switcher'] == "on") {



                if (empty($_POST['patter_or_bg'])) {

                    $_POST['patter_or_bg'] = '';

                }



                if (empty($_POST['reset_color_txt'])) {

                    $_POST['reset_color_txt'] = "";

                } else if ($_POST['reset_color_txt'] == "1") {

                    $_POST['layout_option'] = "wrapper";

                    $_POST['custome_pattern'] = "";

                    $_POST['bg_img'] = "";

                    $_POST['style_sheet'] = "";

                    $_POST['heading_color'] = "";

                }



                if ($_POST['patter_or_bg'] == 0) {

                    $_SESSION['sess_bg_img'] = '';

                } else if ($_POST['patter_or_bg'] == 1) {

                    $_SESSION['sess_custome_pattern'] = '';

                }



                if (isset($_POST['layout_option'])) {

                    $_SESSION['sess_layout_option'] = $_POST['layout_option'];

                }

                if (isset($_POST['style_sheet'])) {

                    $_SESSION['sess_style_sheet'] = $_POST['style_sheet'];

                }

                if (isset($_POST['heading_color'])) {

                    $_SESSION['sess_heading_color'] = $_POST['heading_color'];

                }

                if (isset($_POST['custome_pattern'])) {

                    $_SESSION['sess_custome_pattern'] = $_POST['custome_pattern'];

                }

                if (isset($_POST['bg_img'])) {

                    $_SESSION['sess_bg_img'] = $_POST['bg_img'];

                }



                if (empty($_SESSION['sess_layout_option']) or $_POST['reset_color_txt'] == "1") {

                    $_SESSION['sess_layout_option'] = "wrapper";

                }

                if (empty($_SESSION['sess_header_styles']) or $_POST['reset_color_txt'] == "1") {

                    $_SESSION['sess_header_styles'] = "";

                }

                if (empty($_SESSION['sess_style_sheet']) or $_POST['reset_color_txt'] == "1") {

                    $_SESSION['sess_style_sheet'] = "#0464b9";

                }

                if (empty($_SESSION['sess_custome_pattern']) or $_POST['reset_color_txt'] == "1") {

                    $_SESSION['sess_custome_pattern'] = "";

                }

                if (empty($_SESSION['sess_bg_img']) or $_POST['reset_color_txt'] == "1") {

                    $_SESSION['sess_bg_img'] = "";

                }



                $theme_path = get_template_directory_uri();

                wp_enqueue_style('wp-color-picker');



                wp_enqueue_script('iris', admin_url('js/iris.min.js'), array('jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch'), false, 1);

                wp_enqueue_script('wp-color-picker', admin_url('js/color-picker.min.js'), array('iris'), false, 1);

                $colorpicker_l10n = array(

                    'clear' => 'Clear',

                    'defaultString' => 'Default',

                    'pick' => 'Select Color'

                );

                wp_localize_script('wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n);

                ?>



        <script type="text/javascript">





            jQuery(document).ready(function ($) {

                jQuery("#togglebutton").click(function () {

                    jQuery("#sidebarmain").trigger('click')

                    jQuery(this).toggleClass('btnclose');

                    jQuery("#sidebarmain").toggleClass('sidebarmain');

                    return false;

                });

                $("#pattstyles li label").click(function () {

                    $("#backgroundimages li label").removeClass("active");

                    $("#patter_or_bg").attr("value", "0");

                    var ah = $(this).find('input[type="radio"]').val();

                    $('body').css({"background": "url(<?php echo $theme_path ?>/images/pattern/pattern" + ah + ".png)"});

                });

                $("#backgroundimages li label").click(function () {

                    $("#patter_or_bg").attr("value", "1");

                    $("#pattstyles li label").removeClass("active");

                    var ah = $(this).find('input[type="radio"]').val();

                    $('body').css({"background": "url(<?php echo $theme_path ?>/images/background/bg" + ah + ".png) no-repeat center center / cover fixed"});

                });

                $("#backgroundimages li label,#pattstyles li label").click(function () {

                    var classname = $(".layoutoption li:first-child label").hasClass("active");

                    if (classname) {

                        alert("Please select Boxed View")

                        return false;

                    }

                    else {

                        $(this).parents(".selectradio").find("label").removeClass("active");

                        $(this).addClass("active");

                    }

                });

                $(".layoutoption li label").click(function () {

                    jQuery(".header-section").scrollToFixed();

                    var th = $(this).find('input').val();

                    $("#wrappermain-pix").attr('class', '');

                    $('#wrappermain-pix').addClass(th);

                    $(this).parents(".selectradio").find("label").removeClass("active");

                    $(this).addClass("active");

                    jQuery(".top_strip").trigger('resize');

                    para();

                    parabg();

                });

                $(".accordion-sidepanel .innertext").hide();

                $(".accordion-sidepanel header").click(function () {

                    if ($(this).next().is(":visible")) {

                        $(".accordion-sidepanel .innertext").slideUp(300);

                        $(".accordion-sidepanel header").removeClass("active");

                        return false;

                    }

                    $(".accordion-sidepanel .innertext").slideUp(300);

                    $(".accordion-sidepanel header").removeClass("active");

                    $(this).addClass("active");

                    $(this).next().slideDown(300);

                });

            });

            jQuery(document).ready(function ($) {

                $(".colorpicker-main").click(function () {

                    $(this).find('.wp-color-result').trigger('click');

                    $('.iris-picker').toggle();

                });

                var cf = '.colr, .colrhover:hover, .services article:hover h3, .testimonial-author, .breadcrumbs ul li.active, .gallerysec figure figcaption .text h2,.post-options li a:hover, .blog_text p a:before, .comment-reply-title small a:hover, .widget-recent-blog article:hover .text h6 a,.event article .inn_text ul li a:hover, .open.active, .testimonial-author, .toggle-sectn a, .navigation ul > li:hover > a,.header-3 .navigation ul li:hover:before, .team-shortcode.team-slide .text .social-area .social-network > a:hover,.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price,.upsells.products h2,.related.products h2,.cart_totals h2,.shipping_calculator h2 a,.cross-sells h2,.col-1 h3, .col-2 h3,#order_review_heading,.price, .total, span.amount,.panel.entry-content h2';

                var bc = ".backcolr, .backcolrhover:hover, .filter-menu ul li:hover, .flex-direction-nav a:hover, .post-options:before,.widget_categories ul li:hover, .widget-latest-event article:hover .calendar-date, .pagination ul li a.active:before, .tab-content header h2,.blog-medium article figure figcaption .blogimg-hover a:hover, .quote:after, .tagcloud a:hover, .sortby ul li:hover, .social-network a:hover,#comments .thumblist:hover .comment-reply-link, #respond form p input[type='submit'], .calendar-link .sorted-link > a, .cs-map-location:before,.pagenone h4:after, .event article .inn_text h2:before, .wpcf7-submit, .ls-nav-prev, .ls-nav-next, .header_element .flex-direction-nav a,.sortby:hover .sorted-link a, .no-img figure a, .horizontal-tabs .nav-menu ul li:hover, .horizontal-tabs .nav-menu ul li.active, #wp-calendar caption,.flex-control-paging li a.flex-active, .flex-control-paging li a:hover, .filter-menu:hover .sort-menu a, .dropcap:first-letter, .dropcaptwo:first-letter,.header-5 .search-box input[type='submit'], .header-6 .nav-sec, .widget_archive ul li:hover, .widget_pages ul li a:hover, .widget_nav_menu ul li a:hover,.widget_recent_entries ul li:hover,.widget_recent_entries ul li:hover,.widget_recent_comments ul li:hover,.widget_links ul li:hover, .widget_meta ul li:hover,.post-media-attachments li a, .widget_ns_mailchimp input[type='submit'],.ls-nav-prev:focus, .ls-nav-next:focus, .services article:hover figure a,.caption a:hover, .share_post .social-network .icon-plus, .event article.featured figure span,.woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button, a.button, input.button,.woocommerce a.button.alt, .woocommerce-page a.button.alt, .woocommerce button.button.alt, .woocommerce-page button.button.alt, .woocommerce input.button.alt, .woocommerce-page input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce-page #respond input#submit.alt, .woocommerce #content input.button.alt, .woocommerce-page #content input.button.alt,.woocommerce-info:before,.woocommerce a.button,.woocommerce-page a.button,.woocommerce button.button,.woocommerce-page button.button,.woocommerce input.button,.woocommerce-page input.button,.woocommerce #respond input#submit,.woocommerce-page #respond input#submit,.woocommerce #content input.button,.woocommerce-page #content input.button,.woocommerce-page .add_to_cart_button,.post-btn a:hover, .woocommerce-message:before, .navigation select, .page-links span:hover, .woocommerce-error:before, .woocommerce-info:before,";

                var boc = ".bordercolr, .bordercolrhover:hover, .breadcrumbs ul li.active, .widget-recent-blog article .text time, .widget-latest-event .text time,.pagination ul li a.active, #respond form input[type='text']:focus, #respond form textarea:focus, .header-2 .search-box input,.header-3 .search-box input, .wpcf7-text:focus, .wpcf7-textarea:focus, .woocommerce-pagination ul li .current:before,.wpcf7-not-valid, .wpcf7-not-valid:focus, .woocommerce-pagination ul li .current, blockquote:before,#respond form input.frm_error, #respond form textarea.frm_error, #respond form input.frm_error:focus,#respond form textarea.frm_error:focus, .form-section p input.frm_error, .form-section p textarea.frm_error,.woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button, a.button, input.button,.woocommerce-info, .woocommerce-message, .woocommerce-message, .woocommerce-error, .woocommerce-info";

                var boc2 = ".coursesarticle:hover .rating:before, .blog_admin article:hover .cuting_border, .team-shortcode article:hover .cuting_border";

                $('#themecolor .bg_color').wpColorPicker({change: function (event, ui) {

                        var a = ui.color.toString();

                        $("#stylecss").remove();

                        $("<style type='text/css' id='stylecss'>" + cf + "{color:" + a + " !important}" + bc + "{background-color:" + a + " !important}" + boc + "{border-color:" + a + " !important}" + boc2 + "{border-color:transparent " + a + " !important}</style>").insertAfter("#wrappermain-pix");

                    }

                });

            });

            function reset_color() {

                jQuery("#reset_color_txt").attr('value', "1")

                jQuery("#bgcolor").attr('value', "#0464b9")

                jQuery("#color_switcher").submit();

            }



        //            jQuery(document).ready(function ($) {

        //                jQuery("#togglebutton").click(function () {

        //                    jQuery("#sidebarmain").trigger('click')

        //                    jQuery(this).toggleClass('btnclose');

        //                    jQuery("#sidebarmain").toggleClass('sidebarmain');

        //                    return false;

        //                });

        //                $("#pattstyles li label").click(function() {

        //                    $("#backgroundimages li label").removeClass("active");

        //                    $("#patter_or_bg").attr("value", "0");

        //                    var ah = $(this).find('input[type="radio"]').val();

        //                    $('body').css({"background": "url(<?php echo $theme_path ?>/images/pattern/pattern" + ah + ".png)"});

        //                });

        //                $("#backgroundimages li label").click(function () {

        //                    $("#patter_or_bg").attr("value", "1");

        //                    $("#pattstyles li label").removeClass("active");

        //                    var ah = $(this).find('input[type="radio"]').val();

        //                    $('body').css({"background": "url(<?php echo $theme_path ?>/images/background/bg" + ah + ".png) no-repeat center center / cover fixed"});

        //                });

        //                $("#backgroundimages li label,#pattstyles li label").click(function () {

        //                    var classname = $(".layoutoption li:first-child label").hasClass("active");

        //                    if (classname) {

        //                        alert("Please select BoxedView")

        //                        return false;

        //                    } else {

        //                        $(this).parents(".selectradio").find("label").removeClass("active");

        //                        $(this).addClass("active");

        //                    }

        //                });

        //                $(".layoutoption li label").click(function () {

        //                    $(".header-section").scrollToFixed();

        //                    var th = $(this).find('input').val();

        //                    $("#wrappermain-pix").attr('class ', '');

        //                    $('#wrappermain-pix').addClass(th);

        //                    $(this).parents(".selectradio").find("label").removeClass("active");

        //                    $(this).addClass("active");

        //                    $(".top_strip").trigger('resize');

        //                    para();

        //                    parabg();

        //                });

        //

        //                $(".accordion-sidepanel .innertext").hide();

        //                $(".accordion-sidepanel header").click(function () {

        //                    if ($(this).next().is(":visible")) {

        //                        $(".accordion-sidepanel .innertext").slideUp(300);

        //                        $(".accordion-sidepanel header").removeClass("active");

        //                        return false;

        //                    }

        //                    $(".accordion-sidepanel .innertext").slideUp(300);

        //                    $(".accordion-sidepanel header").removeClass("active");

        //                    $(this).addClass("active");

        //                    $(this).next().slideDown(300);

        //                });

        //

        //            });

        //

        //            jQuery(document).ready(function ($) {

        //                $(".colorpicker-main").click(function () {

        //                    $(this).find('.wp-color-result').trigger('click');

        //                    $('.iris-picker').toggle();

        //                });

        //                var cf = '.colr, .colrhover:hover, .services article:hover h3, .testimonial-author, .breadcrumbs ul li.active, .gallerysec figure figcaption .text h2,.post-options li a:hover, .blog_text p a:before, .comment-reply-title small a:hover, .widget-recent-blog article:hover .text h6 a,.event article .inn_text ul li a:hover, .open.active, .testimonial-author, .toggle-sectn a, .navigation ul > li:hover > a,.header-3 .navigation ul li:hover:before, .team-shortcode.team-slide .text .social-area .social-network > a:hover,.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price,.upsells.products h2,.related.products h2,.cart_totals h2,.shipping_calculator h2 a,.cross-sells h2,.col-1 h3, .col-2 h3,#order_review_heading,.price, .total, span.amount,.panel.entry-content h2';

        //

        //                var bc = ".backcolr, .backcolrhover:hover, .filter-menu ul li:hover, .flex-direction-nav a:hover, .post-options:before,.widget_categories ul li:hover, .widget-latest-event article:hover .calendar-date, .pagination ul li a.active:before, .tab-content header h2,.blog-medium article figure figcaption .blogimg-hover a:hover, .quote:after, .tagcloud a:hover, .sortby ul li:hover, .social-network a:hover,#comments .thumblist:hover .comment-reply-link, #respond form p input[type='submit'], .calendar-link .sorted-link > a, .cs-map-location:before,.pagenone h4:after, .event article .inn_text h2:before, .wpcf7-submit, .ls-nav-prev, .ls-nav-next, .header_element .flex-direction-nav a,.sortby:hover .sorted-link a, .no-img figure a, .horizontal-tabs .nav-menu ul li:hover, .horizontal-tabs .nav-menu ul li.active, #wp-calendar caption,.flex-control-paging li a.flex-active, .flex-control-paging li a:hover, .filter-menu:hover .sort-menu a, .dropcap:first-letter, .dropcaptwo:first-letter,.header-5 .search-box input[type='submit'], .header-6 .nav-sec, .widget_archive ul li:hover, .widget_pages ul li a:hover, .widget_nav_menu ul li a:hover,.widget_recent_entries ul li:hover,.widget_recent_entries ul li:hover,.widget_recent_comments ul li:hover,.widget_links ul li:hover, .widget_meta ul li:hover,.post-media-attachments li a, .widget_ns_mailchimp input[type='submit'],.ls-nav-prev:focus, .ls-nav-next:focus, .services article:hover figure a,.caption a:hover, .share_post .social-network .icon-plus, .event article.featured figure span,.woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button, a.button, input.button,.woocommerce a.button.alt, .woocommerce-page a.button.alt, .woocommerce button.button.alt, .woocommerce-page button.button.alt, .woocommerce input.button.alt, .woocommerce-page input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce-page #respond input#submit.alt, .woocommerce #content input.button.alt, .woocommerce-page #content input.button.alt,.woocommerce-info:before,.woocommerce a.button,.woocommerce-page a.button,.woocommerce button.button,.woocommerce-page button.button,.woocommerce input.button,.woocommerce-page input.button,.woocommerce #respond input#submit,.woocommerce-page #respond input#submit,.woocommerce #content input.button,.woocommerce-page #content input.button,.woocommerce-page .add_to_cart_button,.post-btn a:hover, .woocommerce-message:before, .navigation select, .page-links span:hover, .woocommerce-error:before, .woocommerce-info:before,";

        //                var boc = ".bordercolr, .bordercolrhover:hover, .breadcrumbs ul li.active, .widget-recent-blog article .text time, .widget-latest-event .text time,.pagination ul li a.active, #respond form input[type='text']:focus, #respond form textarea:focus, .header-2 .search-box input,.header-3 .search-box input, .wpcf7-text:focus, .wpcf7-textarea:focus, .woocommerce-pagination ul li .current:before,.wpcf7-not-valid, .wpcf7-not-valid:focus, .woocommerce-pagination ul li .current, blockquote:before,#respond form input.frm_error, #respond form textarea.frm_error, #respond form input.frm_error:focus,#respond form textarea.frm_error:focus, .form-section p input.frm_error, .form-section p textarea.frm_error,.woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button, a.button, input.button,.woocommerce-info, .woocommerce-message, .woocommerce-message, .woocommerce-error, .woocommerce-info";

        //                var boc2 = ".coursesarticle:hover .rating:before, .blog_admin article:hover .cuting_border, .team-shortcode article:hover .cuting_border";

        //

        //                $('#themecolor .bg_color').wpColorPicker({

        //                    change: function (event, ui) {

        //                        var a = ui.color.toString();

        //                        $("#stylecss").remove();

        //                        $("<style type='text/css' id='stylecss'>" + cf + "{color:" + a + " !important}" + bc + "{background-color:" + a + " !important}" + boc + "{border-color:" + a + " !important}" + boc2 + "{border-color:transparent " + a + " !important}</style>").insertAfter("#wrappermain-pix");

        //                    }

        //                });

        //            });

        //

        //            function reset_color() {

        //                jQuery("#reset_color_txt").attr('value', "1")

        //                jQuery("#bgcolor").attr('value', "#0464b9")

        //                jQuery("#color_switcher").submit();

        //            }



        </script>

        <div id="sidebarmain">

            <span id="togglebutton">&nbsp;</span>

            <div id="sidebar">

                <form method="post" id="color_switcher" action="">

                    <aside class="rowside">

                        <header><h4><?php _e('Layout options', 'Mercycorp'); ?></h4></header>

                        <h5><?php _e('Choose Your Layout Style', 'Mercycorp'); ?></h5>

                        <ul class="layoutoption selectradio">

                            <li><label class="label_radio <?php if ($_SESSION['sess_layout_option'] == "wrapper") echo "active"; ?> "><img src="<?php echo $theme_path ?>/images/admin/bg-btnwide.png" alt=""><input type="radio" name="layout_option" value="wrapper" ></label></li>

                            <li><label class="label_radio <?php if ($_SESSION['sess_layout_option'] == "wrapper_boxed") echo "active"; ?> "><img src="<?php echo $theme_path ?>/images/admin/bg-btnboxed.png" alt=""><input type="radio" name="layout_option" value="wrapper_boxed" ></label></li>

                        </ul>

                        <label for="bgcolor" id="themecolor" class="colorpicker-main">

                            <img src="<?php echo $theme_path ?>/images/admin/img-colorpan.png" alt="">

                            <h5><?php _e('Theme Color', 'Mercycorp'); ?></h5>

                            <input id="bgcolor" name="style_sheet" type="text" class="bg_color" value="<?php echo $_SESSION['sess_style_sheet']; ?>" /></label>



                    </aside>

                    <div class="accordion-sidepanel">

                        <aside class="rowside">

                            <header>  <h4><?php _e('Pattern Styles', 'Mercycorp'); ?></h4></header>

                            <div class="innertext">



                                <div id="pattstyles" class="itemstyles selectradio">

                                    <ul>

                                        <li><label <?php if ($_SESSION['sess_custome_pattern'] == "1") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/pattern/pattern1.png" alt=""><input type="radio" name="custome_pattern" value="1"></label></li>

                                        <li><label <?php if ($_SESSION['sess_custome_pattern'] == "2") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/pattern/pattern2.png" alt=""><input type="radio" name="custome_pattern" value="2"></label></li>

                                        <li><label <?php if ($_SESSION['sess_custome_pattern'] == "3") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/pattern/pattern3.png" alt=""><input type="radio" name="custome_pattern" value="3"></label></li>

                                        <li><label <?php if ($_SESSION['sess_custome_pattern'] == "4") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/pattern/pattern4.png" alt=""><input type="radio" name="custome_pattern" value="4"></label></li>

                                        <li><label <?php if ($_SESSION['sess_custome_pattern'] == "5") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/pattern/pattern5.png" alt=""><input type="radio" name="custome_pattern" value="5"></label></li>

                                        <li><label <?php if ($_SESSION['sess_custome_pattern'] == "6") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/pattern/pattern6.png" alt=""><input type="radio" name="custome_pattern" value="6"></label></li>

                                        <li><label <?php if ($_SESSION['sess_custome_pattern'] == "7") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/pattern/pattern7.png" alt=""><input type="radio" name="custome_pattern" value="7"></label></li>

                                        <li><label <?php if ($_SESSION['sess_custome_pattern'] == "8") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/pattern/pattern8.png" alt=""><input type="radio" name="custome_pattern" value="8"></label></li>

                                        <li><label <?php if ($_SESSION['sess_custome_pattern'] == "9") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/pattern/pattern9.png" alt=""><input type="radio" name="custome_pattern" value="9"></label></li>

                                        <li><label <?php if ($_SESSION['sess_custome_pattern'] == "10") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/pattern/pattern10.png" alt=""><input type="radio" name="custome_pattern" value="10"></label></li>

                                        <li><label <?php if ($_SESSION['sess_custome_pattern'] == "11") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/pattern/pattern11.png" alt=""><input type="radio" name="custome_pattern" value="11"></label></li>



                                    </ul>

                                </div>

                            </div>

                        </aside>

                        <aside class="rowside">

                            <header><h4><?php _e('Background Images', 'Mercycorp'); ?></h4></header>

                            <div class="innertext">



                                <div id="backgroundimages" class="selectradio">

                                    <ul>

                                        <li><label <?php if ($_SESSION['sess_bg_img'] == "1") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/background/background1.png" alt=""><input type="radio" name="bg_img" value="1"></label></li>

                                        <li><label <?php if ($_SESSION['sess_bg_img'] == "2") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/background/background2.png" alt=""><input type="radio" name="bg_img" value="2"></label></li>

                                        <li><label <?php if ($_SESSION['sess_bg_img'] == "3") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/background/background3.png" alt=""><input type="radio" name="bg_img" value="3"></label></li>

                                        <li><label <?php if ($_SESSION['sess_bg_img'] == "4") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/background/background4.png" alt=""><input type="radio" name="bg_img" value="4"></label></li>

                                        <li><label <?php if ($_SESSION['sess_bg_img'] == "5") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/background/background5.png" alt=""><input type="radio" name="bg_img" value="5"></label></li>

                                        <li><label <?php if ($_SESSION['sess_bg_img'] == "6") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/background/background6.png" alt=""><input type="radio" name="bg_img" value="6"></label></li>

                                        <li><label <?php if ($_SESSION['sess_bg_img'] == "7") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/background/background7.png" alt=""><input type="radio" name="bg_img" value="7"></label></li>

                                        <li><label <?php if ($_SESSION['sess_bg_img'] == "8") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/background/background8.png" alt=""><input type="radio" name="bg_img" value="8"></label></li>

                                        <li><label <?php if ($_SESSION['sess_bg_img'] == "9") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/background/background9.png" alt=""><input type="radio" name="bg_img" value="9"></label></li>

                                        <li><label <?php if ($_SESSION['sess_bg_img'] == "10") echo "class='active'"; ?> ><img src="<?php echo $theme_path ?>/images/background/background10.png" alt=""><input type="radio" name="bg_img" value="10"></label></li>



                                    </ul>

                                </div>

                            </div>

                        </aside>

                    </div>

                    <div class="buttonarea">

                        <input type="submit" value="<?php _e('Apply', 'Mercycorp'); ?>" class="btn" />

                        <input type="hidden" name="patter_or_bg" id="patter_or_bg" value="1" />

                        <input type="hidden" name="reset_color_txt" id="reset_color_txt" value="" />

                        <input type="reset" value="<?php _e('Reset', 'Mercycorp'); ?>" class="btn" onclick="javascript:reset_color()" />

                    </div>

                </form>

            </div>

        </div>

        <?php

    }

}



function cs_custom_styles() {

    global $cs_theme_option;

    if (isset($_POST['style_sheet'])) {

        $_SESSION['sess_style_sheet'] = $_POST['style_sheet'];

        $cs_color_scheme = $_SESSION['sess_style_sheet'];

    } elseif (isset($_SESSION['sess_style_sheet']) and $_SESSION['sess_style_sheet'] <> '') {

        $cs_color_scheme = $_SESSION['sess_style_sheet'];

    } else {

        $cs_color_scheme = $cs_theme_option['custom_color_scheme'];

    }

    ?>

    <style type="text/css" >

        /* -- Theme Color -- */

        .colr, .colrhover:hover, .services article:hover h3, .testimonial-author, .breadcrumbs ul li.active, .gallerysec figure figcaption .text h2,.post-options li a:hover, .blog_text p a:before, .comment-reply-title small a:hover, .widget-recent-blog article:hover .text h6 a,.event article .inn_text ul li a:hover, .open.active, .testimonial-author, .toggle-sectn a, .navigation ul > li:hover > a,.header-3 .navigation ul li:hover:before, .team-shortcode.team-slide .text .social-area .social-network > a:hover,.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price,.upsells.products h2,.related.products h2,.cart_totals h2,.shipping_calculator h2 a,.cross-sells h2,.col-1 h3, .col-2 h3,#order_review_heading,.price, .total, span.amount,.panel.entry-content h2, .panel-heading h4 a.accordion-toggle,

        .panel-heading h4 a.accordion-toggle i,

        .panel-heading a.accordion-toggle:after{

            color:<?php echo $cs_color_scheme; ?> !important;

        }



        /* -- Theme Background Color -- */

        .backcolr, .backcolrhover:hover, .filter-menu ul li:hover, .flex-direction-nav a:hover, .post-options:before,.widget_categories ul li:hover, .widget-latest-event article:hover .calendar-date, .pagination ul li a.active:before, .tab-content header h2,.blog-medium article figure figcaption .blogimg-hover a:hover, .quote:after, .tagcloud a:hover, .sortby ul li:hover, .social-network a:hover,#comments .thumblist:hover .comment-reply-link, #respond form p input[type="submit"], .calendar-link .sorted-link > a, .cs-map-location:before,.pagenone h4:after, .event article .inn_text h2:before, .wpcf7-submit, .ls-nav-prev, .ls-nav-next, .header_element .flex-direction-nav a,.sortby:hover .sorted-link a, .no-img figure a, .horizontal-tabs .nav-menu ul li:hover, .horizontal-tabs .nav-menu ul li.active, #wp-calendar caption,.flex-control-paging li a.flex-active, .flex-control-paging li a:hover, .filter-menu:hover .sort-menu a, .dropcap:first-letter, .dropcaptwo:first-letter,.header-5 .search-box input[type="submit"], .header-6 .nav-sec, .widget_archive ul li:hover, .widget_pages ul li a:hover, .widget_nav_menu ul li a:hover,.widget_recent_entries ul li:hover,.widget_recent_entries ul li:hover,.widget_recent_comments ul li:hover,.widget_links ul li:hover, .widget_meta ul li:hover,.post-media-attachments li a, .widget_ns_mailchimp input[type="submit"],.ls-nav-prev:focus, .ls-nav-next:focus, .services article:hover figure a,.caption a:hover, .share_post .social-network .icon-plus, .event article.featured figure span,.woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button, a.button, input.button,.woocommerce a.button.alt, .woocommerce-page a.button.alt, .woocommerce button.button.alt, .woocommerce-page button.button.alt, .woocommerce input.button.alt, .woocommerce-page input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce-page #respond input#submit.alt, .woocommerce #content input.button.alt, .woocommerce-page #content input.button.alt,.woocommerce-info:before,.woocommerce a.button,.woocommerce-page a.button,.woocommerce button.button,.woocommerce-page button.button,.woocommerce input.button,.woocommerce-page input.button,.woocommerce #respond input#submit,.woocommerce-page #respond input#submit,.woocommerce #content input.button,.woocommerce-page #content input.button,.woocommerce-page .add_to_cart_button,.widget_product_search input[type='submit'],.widget_product_categories li:hover, #undercontruction .countdownit span.countdown_section, .post-btn a:hover, .woocommerce-message:before, .navigation select, .page-links span:hover,.woocommerce-error:before, .woocommerce-info:before,.woocommerce span.onsale, .woocommerce-page span.onsale{

            background-color:<?php echo $cs_color_scheme; ?> !important;

        }



        #wp-calendar tfoot a:hover{

            background:<?php echo $cs_color_scheme; ?> !important;

        }



        /* -- Theme Border Color -- */

        .bordercolr, .bordercolrhover:hover, .breadcrumbs ul li.active, .widget-recent-blog article .text time, .widget-latest-event .text time,.pagination ul li a.active, #respond form input[type="text"]:focus, #respond form textarea:focus, .header-2 .search-box input,.header-3 .search-box input, .wpcf7-text:focus, .wpcf7-textarea:focus, .woocommerce-pagination ul li .current:before,.wpcf7-not-valid, .wpcf7-not-valid:focus, .woocommerce-pagination ul li .current, blockquote:before,#respond form input.frm_error, #respond form textarea.frm_error, #respond form input.frm_error:focus,#respond form textarea.frm_error:focus, .form-section p input.frm_error, .form-section p textarea.frm_error,.woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button, a.button, input.button,.woocommerce-info, .woocommerce-message,.woocommerce-message, .woocommerce-error, .woocommerce-info{

            border-color:<?php echo $cs_color_scheme; ?> !important;

        }

        /* -- Theme transparent Border Color -- */

        .heart-active:before{

            border-color: transparent <?php echo $cs_color_scheme; ?> transparent transparent;

        }

        .services article:hover figure a:before{

            border-color: transparent  <?php echo $cs_color_scheme ?>;

        }

     

    </style>

    <?php

}



/*

 * Ccustom Header Styles 

 */



function cs_custom_header_styles($header_styles = 'header1') {

    global $cs_theme_option;

    $header_styles = 'header1';

    ?>



    <header class="header-1">

        <!-- Top Strip Start -->

        <div class="top-strip">

            <!-- // Container Start // -->

            <div class="container">

                <!-- // Logo Start // -->

                <div class="logo">

                    <?php

                    if ($cs_theme_option['header_logo'] == 'on') { ?> 



<a href="<? echo site_url(); ?>"><img src="<? echo site_url(); ?>/wp-content/uploads/2018/09/logo.png" style="width:; height:" alt="Freguesia Almagreira"></a>

                        

                      <div class="logo_descricao">  

                    <h1><? echo bloginfo('title'); ?> </h1>

                        <?

                         //cs_logo($cs_theme_option['logo'],

                         //$cs_theme_option['logo_width'], 

                         //$cs_theme_option['logo_height']);

                    }



                    if ($cs_theme_option['header_slogan'] == 'on') {

                        echo '<p>';

                        bloginfo('description');

                        echo '</p>';

                    }

                    ?>

                    </div>

                    <div class="morestuff">

                        <?php echo do_shortcode('[wpdreams_ajaxsearchpro id=1]'); ?> 

                    </div>

                </div>

                <!-- // Logo End // -->

                <!-- Top Icos Start -->

               

                <!-- Top Icos End -->

            </div>

            <!-- // Container End // -->

        </div>

        <!-- Top Strip End -->

        <!-- Header Section Start -->

        <div class="header-section">

            <!-- // Container Start // -->

            <div class="container">

                <!-- Navigation Start -->

                <nav class="navigation">

                    <?php cs_navigation('main-menu'); ?>

                </nav>

                <!-- Navigation End -->

                <!-- Social Network Start -->

                <?php

                if ($cs_theme_option['header_social_icons'] == 'on') {

                    cs_social_network();

                }

                ?>

                <!-- Social Network End -->

            </div>

            <!-- // Container End // -->

        </div>

        <!-- Header Section End -->

    </header>



    <?php

}



// Custom excerpt function 

function cs_get_the_excerpt($limit, $readmore = '') {

    global $cs_theme_option;

    $get_the_excerpt = trim(preg_replace('/<a[^>]*>(.*)<\/a>/iU', '', get_the_excerpt()));

    echo substr($get_the_excerpt, 0, "$limit");

    if (strlen($get_the_excerpt) > "$limit") {

        if ($readmore == "true") {

            echo '... <a href="' . get_permalink() . '" class="colr">' . $cs_theme_option['trans_read_more'] . '</a>';

        }

    }

}



// Flexslider function





if (!function_exists('cs_flex_slider')) {



    function cs_flex_slider($width, $height, $slider_id) {

        global $cs_node, $cs_theme_option, $cs_counter_node;

        $cs_counter_node++;

        if ($slider_id == '') {

            $slider_id = $cs_node->slider;

        }

        if ($cs_theme_option['flex_auto_play'] == 'on') {

            $auto_play = 'true';

        } else if ($cs_theme_option['flex_auto_play'] == '') {

            $auto_play = 'false';

        }

        $cs_meta_slider_options = get_post_meta("$slider_id", "cs_meta_slider_options", true);

        ?>

        <!-- Flex Slider -->

        <div id="flexslider<?php echo $cs_counter_node; ?>">

            <div class="flexslider">

                <ul class="slides">

                    <?php

                    $cs_counter = 1;

                    $cs_xmlObject_flex = new SimpleXMLElement($cs_meta_slider_options);

                    foreach ($cs_xmlObject_flex->children() as $as_node) {



                        $image_url = cs_attachment_image_src($as_node->path, $width, $height);

                        ?>

                        <li>

                            <img src="<?php echo $image_url ?>" alt="" />

                            <!-- Caption Start -->

                            <?php

                            if ($as_node->title != '' && $as_node->description != '' || $as_node->title != '' || $as_node->description != '') {

                                $as_node->cs_slider_link = "";

                                $title_1 = explode(" ", $as_node->title);

                                $get_title = '<h3><span>' . $title_1['0'] . ' </span>' . substr(strstr("$as_node->title", " "), 1) . '</h3>';

                                ?>

                                <div class="caption">

                                    <?php echo $get_title; ?>

                                    <p>

                                        <?php

                                        echo substr($as_node->description, 0, 220);

                                        if (strlen($as_node->description) > 220)

                                            echo "...";

                                        ?>

                                    </p>

                                    <?php

                                    if ($as_node->link <> '') {

                                        echo '<a href="' . $as_node->link . '" target="' . $as_node->link_target . '">' . $cs_theme_option['trans_read_more'] . '</a>';

                                    }

                                    ?>

                                </div>

                                <!-- Caption End -->

                            <?php } ?>

                            <div class="bannershadow"></div>

                        </li>

                        <?php

                        $cs_counter++;

                    }

                    ?>

                </ul>

            </div>

        </div>

        <?php cs_enqueue_flexslider_script(); ?>

        <!-- Slider height and width -->

        <!-- Flex Slider Javascript Files -->

        <script type="text/javascript">

            jQuery(window).load(function () {

                var speed = <?php echo $cs_theme_option['flex_animation_speed']; ?>;

                var slidespeed = <?php echo $cs_theme_option['flex_pause_time']; ?>;

                jQuery('#flexslider<?php echo $cs_counter_node; ?> .flexslider').flexslider({

                    animation: "<?php echo $cs_theme_option['flex_effect']; ?>", // fade

                    slideshow: <?php echo $auto_play; ?>,

                    slideshowSpeed: speed,

                    animationSpeed: slidespeed



                });

            });</script>

        <?php

    }



}

// Portfolio Gallery 

if (!function_exists('cs_portfolio_gallery')) {



    function cs_portfolio_gallery($width, $height, $gallery_id, $gallery_type) {

        $cs_meta_gallery_options = get_post_meta($gallery_id, "cs_meta_gallery_options", true);

        if ($cs_meta_gallery_options <> "") {

            $cs_xmlObject = new SimpleXMLElement($cs_meta_gallery_options);

            if ($gallery_type == "Simple Gallery") {

                ?>

                <div class="staticmg">

                    <?php

                    for ($i = 0; $i < count($cs_xmlObject); $i++) {

                        $path = $cs_xmlObject->gallery[$i]->path;

                        $image_url = cs_attachment_image_src($path, $width, $height);

                        $image_url_full = cs_attachment_image_src($path, 0, 0);

                        ?>

                        <img src="<?php echo $image_url; ?>" alt="">

                    <?php } ?>

                </div>

                <?php

            } else {

                cs_enqueue_sly_style_script();

                ?>

                <!-- Scroll Page Start -->

                <div id="scroller">

                    <div id="basic" class="frame">

                        <ul>

                            <?php

                            for ($i = 0; $i < count($cs_xmlObject); $i++) {

                                $path = $cs_xmlObject->gallery[$i]->path;

                                $image_url = cs_attachment_image_src($path, $width, $height);

                                $image_url_full = cs_attachment_image_src($path, 0, 0);

                                ?>



                                <li>

                                    <figure><img src="<?php echo $image_url_full; ?>" alt=""></figure>

                                </li>

                            <?php } ?>

                        </ul>

                    </div>

                    <div class="scrollbar">

                        <div class="handle">

                            <div class="mousearea"></div>

                        </div>

                    </div>

                </div>

                <!-- Scroll Page End -->

                <script type="text/javascript">

                    jQuery(function ($) {

                        'use strict';

                        // -------------------------------------------------------------

                        //   Basic Navigation

                        // -------------------------------------------------------------

                        (function () {

                            var $frame = $('#basic');

                            var $slidee = $frame.children('ul').eq(0);

                            var $wrap = $frame.parent();

                            // Call Sly on frame

                            $frame.sly({

                                horizontal: 1,

                                itemNav: 'basic',

                                smart: 1,

                                activateOn: 'click',

                                mouseDragging: 1,

                                touchDragging: 1,

                                releaseSwing: 1,

                                startAt: 3,

                                scrollBar: $wrap.find('.scrollbar'),

                                scrollBy: 1,

                                activatePageOn: 'click',

                                speed: 300,

                                elasticBounds: 1,

                                easing: 'easeOutCubic',

                                dragHandle: 1,

                                dynamicHandle: 1,

                                clickBar: 1,

                                // Buttons

                                prev: $wrap.find('.prev'),

                                next: $wrap.find('.next'),

                            });

                        }());

                        jQuery(window).resize(function (event) {

                            var $frame = $('#basic');

                            $frame.stop();

                            $frame.sly('reload');

                        });

                    });</script>

                <?php

            }

        } else {

            

        }

    }



}



// Get post meta in xml form

function cs_meta_page($meta) {

    global $cs_meta_page;

    $meta = get_post_meta(get_the_ID(), $meta, true);

    if ($meta <> '') {

        $cs_meta_page = new SimpleXMLElement($meta);

        return $cs_meta_page;

    }

}



function cs_meta_shop_page($meta, $id) {

    global $cs_meta_page;

    $meta = get_post_meta($id, $meta, true);

    if ($meta <> '') {

        $cs_meta_page = new SimpleXMLElement($meta);

        return $cs_meta_page;

    }

}



// pages sidebar

if (!function_exists('cs_meta_sidebar')) {



    function cs_meta_sidebar() {

        global $cs_meta_page;

        if ($cs_meta_page->sidebar_layout->cs_layout <> '' and $cs_meta_page->sidebar_layout->cs_layout == 'right') {

            echo "<aside class='sidebar-right span3'><div class='column'>";

            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_meta_page->sidebar_layout->cs_sidebar_right)) : endif;

            echo "</div></aside>";

        }

        else if ($cs_meta_page->sidebar_layout->cs_layout <> '' and $cs_meta_page->sidebar_layout->cs_layout == 'left') {

            echo "<aside class='sidebar-left span3'><div class='column'>";

            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_meta_page->sidebar_layout->cs_sidebar_left)) : endif;

            echo "</div></aside>";

        }

    }



}

// content class

if (!function_exists('cs_meta_content_class')) {



    function cs_meta_content_class() {

        global $cs_meta_page, $cs_video_width;

        if ($cs_meta_page->sidebar_layout->cs_layout == '' or $cs_meta_page->sidebar_layout->cs_layout == 'none') {

            $content_class = "col-md-12";

            $cs_video_width = 1170;

        } else if ($cs_meta_page->sidebar_layout->cs_layout <> '' and $cs_meta_page->sidebar_layout->cs_layout == 'right') {

            $content_class = "col-md-9";

            $cs_video_width = 870;

        } else if ($cs_meta_page->sidebar_layout->cs_layout <> '' and $cs_meta_page->sidebar_layout->cs_layout == 'left') {

            $content_class = "col-md-9";

            $cs_video_width = 870;

        } else if ($cs_meta_page->sidebar_layout->cs_layout <> '' and ( $cs_meta_page->sidebar_layout->cs_layout == 'both' or $cs_meta_page->sidebar_layout->cs_layout == 'both_left' or $cs_meta_page->sidebar_layout->cs_layout == 'both_right')) {

            $content_class = "col-md-6";

            $cs_video_width = 570;

        } else {

            $content_class = "col-md-12";

        }

        return $content_class;

    }



}

// sidebar class

if (!function_exists('cs_meta_sidebar_class')) {



    function cs_meta_sidebar_class() {

        global $cs_meta_page;

        if ($cs_meta_page->sidebar_layout->cs_layout <> '' and $cs_meta_page->sidebar_layout->cs_layout == 'right') {

            echo "sidebar-right col-md-3";

        } else if ($cs_meta_page->sidebar_layout->cs_layout <> '' and $cs_meta_page->sidebar_layout->cs_layout == 'left') {

            echo "sidebar-left col-md-3";

        }

    }



}

// Content pages Meta Class

if (!function_exists('cs_default_pages_meta_content_class')) {



    function cs_default_pages_meta_content_class($layout) {

        if ($layout == '' or $layout == 'none') {

            echo "span12";

        } else if ($layout <> '' and $layout == 'right') {

            echo "content-left col-md-9";

        } else if ($layout <> '' and $layout == 'left') {

            echo "content-right col-md-9";

        } else if ($layout <> '' and $layout == 'both') {

            echo "content-right col-md-6";

        }

    }



}

// Default pages sidebar class

if (!function_exists('cs_default_pages_sidebar_class')) {



    function cs_default_pages_sidebar_class($layout) {

        if ($layout <> '' and $layout == 'right') {

            echo "sidebar-right col-md-3";

        } else if ($layout <> '' and $layout == 'left') {

            echo "sidebar-left col-md-3";

        }

    }



}



// Default page sidebar

function cs_default_pages_sidebar() {

    global $cs_theme_option;

    if ($cs_theme_option['cs_layout'] <> '' and $cs_theme_option['cs_layout'] == 'right') {

        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_theme_option['cs_sidebar_right'])) : endif;

    }

    else if ($cs_theme_option['cs_layout'] <> '' and $cs_theme_option['cs_layout'] == 'left') {

        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_theme_option['cs_sidebar_left'])) : endif;

    }

}



// change the default query variable start

function cs_change_query_vars($query) {

    if (is_search()) {

        if (empty($_GET['page_id_all']))

            $_GET['page_id_all'] = 1;

        $query->query_vars['paged'] = $_GET['page_id_all'];

        return $query;

    }

    // Return modified query variables

}



add_filter('pre_get_posts', 'cs_change_query_vars'); // Hook our custom function onto the request filter

// change the default query variable end

// custom pagination start

if (!function_exists('cs_pagination')) {



    function cs_pagination($total_records, $per_page, $qrystr = '') {

        $html = '';

        $dot_pre = '';

        $dot_more = '';

        $total_page = ceil($total_records / $per_page);

        $loop_start = $_GET['page_id_all'] - 2;

        $loop_end = $_GET['page_id_all'] + 2;

        if ($_GET['page_id_all'] < 3) {

            $loop_start = 1;

            if ($total_page < 5)

                $loop_end = $total_page;

            else

                $loop_end = 5;

        }

        else if ($_GET['page_id_all'] >= $total_page - 1) {

            if ($total_page < 5)

                $loop_start = 1;

            else

                $loop_start = $total_page - 4;

            $loop_end = $total_page;

        }

        if ($_GET['page_id_all'] > 1)

            $html .= "<li class='prev'><a class='icon-angle-left icon-2' href='?page_id_all=" . ($_GET['page_id_all'] - 1) . "$qrystr' ></a></li>";

        if ($_GET['page_id_all'] > 3 and $total_page > 5)

            $html .= "<li><a href='?page_id_all=1$qrystr'>1</a></li>";

        if ($_GET['page_id_all'] > 4 and $total_page > 6)

            $html .= "<li> <a>. . .</a> </li>";

        if ($total_page > 1) {

            for ($i = $loop_start; $i <= $loop_end; $i++) {

                if ($i <> $_GET['page_id_all'])

                    $html .= "<li><a href='?page_id_all=$i$qrystr'>" . $i . "</a></li>";

                else

                    $html .= "<li><a class='active'>" . $i . "</a></li>";

            }

        }

        if ($loop_end <> $total_page and $loop_end <> $total_page - 1)

            $html .= "<li> <a>. . .</a> </li>";

        if ($loop_end <> $total_page)

            $html .= "<li><a href='?page_id_all=$total_page$qrystr'>$total_page</a></li>";

        if ($_GET['page_id_all'] < $total_records / $per_page)

            $html .= "<li class='next'><a class='icon-angle-right icon' href='?page_id_all=" . ($_GET['page_id_all'] + 1) . "$qrystr' ></a></li>";

        return $html;

    }



}

// Services shortcode with multiple layout

if (!function_exists('cs_services_page')) {



    function cs_services_page() {

        global $cs_node, $post, $cs_element_size_class, $cs_theme_option;

        ?>

        <div class="element_size_<?php echo $cs_node->services_element_size; ?>">

            <!-- Prayer Submit Start -->

            <div class="services">

                <?php

                foreach ($cs_node->service as $service_info) {

                    ?>

                    <article class="service-v1 viewme">

                        <figure>

                            <a <?php

                            if ($service_info->service_bg_image == '') {

                                echo 'class=""';

                            }

                            ?> href="<?php echo $service_info->service_link_url; ?>">

                                <img alt="" src="<?php echo $service_info->service_bg_image; ?>" width="170" height="170"></a>

                            <span></span><figcaption></figcaption>



                            <?php if ($service_info->service_icon <> '') { ?><a class="service-tick" href="<?php echo $service_info->service_link_url; ?>">

                                    <i class="<?php echo $service_info->service_icon; ?>"></i></a><?php } ?>

                        </figure>



                        <a href="<?php echo $service_info->service_link_url; ?>"><h5 class="uppercase"><?php echo $service_info->service_title; ?></h5></a>

                        <p><?php echo do_shortcode($service_info->service_text); ?></p>

                    </article>

                <?php } ?>

            </div>

            <!-- Prayer Submit End -->

            <div class="clearfix"></div> 

        </div>

        <?php

    }



}

// pagination end

// Social Share Function

/*if (!function_exists('cs_social_share')) {



    function cs_social_share($icon_type = '', $title = 'true') {

        global $cs_theme_option;

        cs_addthis_script_init_method();

        if ($icon_type == 'small') {

            $icon = 'icon';

        } else {

            $icon = 'icon';

        }

        $html = '';

        $pageurl = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

        $path = get_template_directory_uri() . "/images/admin/";



        $html = '<div class="social-network">';

        if (isset($title) && $title == true) {

            $html .= '<h6>';

            if ($cs_theme_option["trans_switcher"] == "on") {

                $html .= __("Share this post", 'Mercycorp');

            } else {

                $html .= $cs_theme_option["trans_share_this_post"];

            }

            $html .= '</h6>';

        }



        if (isset($cs_theme_option['facebook_share']) && $cs_theme_option['facebook_share'] == 'on') {

            $html .='<a class="addthis_button_facebook  icon-facebook"></a>';

        }

        if (isset($cs_theme_option['twitter_share']) && $cs_theme_option['twitter_share'] == 'on') {

            $html .='<a class="addthis_button_twitter icon-twitter"></a>';

        }

        if (isset($cs_theme_option['google_plus_share']) && $cs_theme_option['google_plus_share'] == 'on') {

            $html .='<a class="addthis_button_google icon-google-plus"></a>';

        }

        if (isset($cs_theme_option['pinterest_share']) && $cs_theme_option['pinterest_share'] == 'on') {

            $html .='<a class="addthis_button_pinterest icon-pinterest"></a>';

        }

        if (isset($cs_theme_option['tumblr_share']) && $cs_theme_option['tumblr_share'] == 'on') {

            $html .='<a class="addthis_button_tumblr icon-tumblr"></a>';

        }

        if (isset($cs_theme_option['linkedin_share']) && $cs_theme_option['linkedin_share'] == 'on') {

            $html .='<a class="addthis_button_linkedin icon-linkedin"></a>';

        }

        if (isset($cs_theme_option['cs_other_share']) && $cs_theme_option['cs_other_share'] == 'on') {

            $html .='<a class="addthis_button_compact icon-plus"></a>';

        }

        $html .='</div>';

        echo $html;

    }



}*/

// Social network

if (!function_exists('cs_social_network')) {



    function cs_social_network($icon_type = '', $tooltip = '') {

        global $cs_theme_option;

        global $cs_theme_option;

        $tooltip_data = '';

        if ($icon_type == 'large') {

            $icon = 'icon-2x';

        } else {

            $icon = 'icon';

        }

        echo '<div class="social-network">';

        if (isset($tooltip) && $tooltip <> '') {

            $tooltip_data = 'data-placement-tooltip="tooltip"';

        }

        if (isset($cs_theme_option['social_net_url']) and count($cs_theme_option['social_net_url']) > 0) {

            $i = 0;

            foreach ($cs_theme_option['social_net_url'] as $val) {

                ?>

                <?php if ($val != '') { ?><a title="" href="<?php echo $val; ?>" data-original-title="<?php echo $cs_theme_option['social_net_tooltip'][$i]; ?>" data-placement="top" <?php echo $tooltip_data; ?> class="colrhover"  target="_blank"><?php if ($cs_theme_option['social_net_awesome'][$i] <> '' && isset($cs_theme_option['social_net_awesome'][$i])) { ?> <i class="<?php echo $cs_theme_option['social_net_awesome'][$i]; ?> <?php echo $icon; ?>"></i><?php } else { ?><img src="<?php echo $cs_theme_option['social_net_icon_path'][$i]; ?>" alt="<?php echo $cs_theme_option['social_net_tooltip'][$i]; ?>" /><?php } ?></a><?php

                }



                $i++;

            }

        }

        echo '</div>';

    }



}



// Post image attachment function

function cs_attachment_image_src($attachment_id, $width, $height) {

    $image_url = wp_get_attachment_image_src((int) $attachment_id, array($width, $height), true);

    if ($image_url[1] == $width and $image_url[2] == $height)

        ;

    else

        $image_url = wp_get_attachment_image_src((int) $attachment_id, "full", true);

    $parts = explode('/uploads/', $image_url[0]);

    if (count($parts) > 1)

        return $image_url[0];

}



// Post image attachment source function

function cs_get_post_img_src($post_id, $width, $height) {

    if (has_post_thumbnail()) {

        $image_id = get_post_thumbnail_id($post_id);

        $image_url = wp_get_attachment_image_src((int) $image_id, array($width, $height), true);

        if ($image_url[1] == $width and $image_url[2] == $height) {

            return $image_url[0];

        } else {

            $image_url = wp_get_attachment_image_src((int) $image_id, "full", true);

            return $image_url[0];

        }

    }

}



// Get Post image attachment

function cs_get_post_img($post_id, $width, $height) {

    $image_id = get_post_thumbnail_id($post_id);

    $image_url = wp_get_attachment_image_src((int) $image_id, array($width, $height), true);

    if ($image_url[1] == $width and $image_url[2] == $height) {

        return get_the_post_thumbnail($post_id, array($width, $height));

    } else {

        return get_the_post_thumbnail($post_id, "full");

    }

}



// Get Main background

function cs_bg_image() {

    global $cs_theme_option;

    $bg_img = '';

    if (isset($_POST['bg_img'])) {

        $_SESSION['sess_bg_img'] = $_POST['bg_img'];

        $bg_img = get_template_directory_uri() . "/images/background/bg" . $_SESSION['sess_bg_img'] . ".png";

    } else if (isset($_SESSION['sess_bg_img']) and ! empty($_SESSION['sess_bg_img'])) {

        $bg_img = get_template_directory_uri() . "/images/background/bg" . $_SESSION['sess_bg_img'] . ".png";

    } else {

        if ($cs_theme_option['bg_img_custom'] == "") {

            if ($cs_theme_option['bg_img'] <> 0) {

                $bg_img = get_template_directory_uri() . "/images/background/bg" . $cs_theme_option['bg_img'] . ".png";

            }

        } else {

            $bg_img = $cs_theme_option['bg_img_custom'];

        }

    }

    if ($bg_img <> "") {

        echo ' style="background: url(' . $bg_img . ') ' . $cs_theme_option['bg_repeat'] . ' top ' . $cs_theme_option['bg_position'] . ' ' . $cs_theme_option['bg_attach'] . '"';

    }

}



// Main wrapper class function

function cs_wrapper_class() {

    global $cs_theme_option;

    if (isset($_POST['layout_option'])) {

        echo $_SESSION['sess_layout_option'] = $_POST['layout_option'];

    } elseif (isset($_SESSION['sess_layout_option']) and ! empty($_SESSION['sess_layout_option'])) {

        echo $_SESSION['sess_layout_option'];

    } else {

        echo $cs_theme_option['layout_option'];

    }

}



// Get Background color Pattren

function cs_bgcolor_pattern() {

    global $cs_theme_option;

    // pattern start

    $pattern = '';

    $bg_color = '';

    if (isset($_POST['custome_pattern'])) {

        $_SESSION['sess_custome_pattern'] = $_POST['custome_pattern'];

        $pattern = get_template_directory_uri() . "/images/pattern/pattern" . $_SESSION['sess_custome_pattern'] . ".png";

    } else if (isset($_SESSION['sess_custome_pattern']) and ! empty($_SESSION['sess_custome_pattern'])) {

        $pattern = get_template_directory_uri() . "/images/pattern/pattern" . $_SESSION['sess_custome_pattern'] . ".png";

    } else {

        if ($cs_theme_option['custome_pattern'] == "") {

            if ($cs_theme_option['pattern_img'] <> 0) {

                $pattern = get_template_directory_uri() . "/images/pattern/pattern" . $cs_theme_option['pattern_img'] . ".png";

            }

        } else {

            $pattern = $cs_theme_option['custome_pattern'];

        }

    }

    // pattern end

    // bg color start

    if (isset($_POST['bg_color'])) {

        $_SESSION['sess_bg_color'] = $_POST['bg_color'];

        $bg_color = $_SESSION['sess_bg_color'];

    } else if (isset($_SESSION['sess_bg_color'])) {

        $bg_color = $_SESSION['sess_bg_color'];

    } else {

        $bg_color = $cs_theme_option['bg_color'];

    }

    // bg color end

    echo ' style="background:' . $bg_color . ' url(' . $pattern . ')" ';

}



// custom sidebar start

global $cs_theme_option;

//$cs_theme_option = get_option('cs_theme_option');

if (isset($cs_theme_option['sidebar']) and ! empty($cs_theme_option['sidebar'])) {

    foreach ($cs_theme_option['sidebar'] as $sidebar) {

        //foreach ( $parts as $val ) {

        register_sidebar(array(

            'name' => $sidebar,

            'id' => $sidebar,

            'description' => 'This widget will be displayed on right side of the page.',

            'before_widget' => '<div class="widget %2$s">',

            'after_widget' => '</div>',

            'before_title' => '<header class="heading"><h2 class="section-title heading-color">',

            'after_title' => '</h2></header>'

        ));

    }

}

// custom sidebar end

//footer widget

register_sidebar(array(

    'name' => 'Footer Widget',

    'id' => 'footer-widget',

    'description' => 'This Widget Show the Content in Footer Area.',

    'before_widget' => '<div class="widget %2$s">',

    'after_widget' => '</div>',

    'before_title' => '<header class="heading"><h2 class="section-title">',

    'after_title' => '</h2></header>'

));



function cs_add_menuid($ulid) {

    return preg_replace('/<ul>/', '<ul id="menus">', $ulid, 1);

}



add_filter('wp_page_menu', 'cs_add_menuid');



function cs_remove_div($menu) {

    return preg_replace(array('#^<div[^>]*>#', '#</div>$#'), '', $menu);

}



add_filter('wp_page_menu', 'cs_remove_div');



function cs_register_my_menus() {

    register_nav_menus(

            array(

                'main-menu' => __('Main Menu', 'Mercycorp'),

                'top-menu' => __('Top Menu', 'Mercycorp')

            )

    );

}



add_action('init', 'cs_register_my_menus');



add_filter('nav_menu_css_class', 'cs_add_parent_css', 10, 2);



function cs_add_parent_css($classes, $item) {

    global $cs_menu_children;

    if ($cs_menu_children)

        $classes[] = 'parent';

    return $classes;

}



// adding custom images while uploading media start

add_image_size('cs_media_1', 1280, 574, true);

add_image_size('cs_media_2', 984, 470, true);

add_image_size('cs_media_3', 640, 360, true);

add_image_size('cs_media_4', 585, 440, true);

add_image_size('cs_media_5', 230, 230, true);

add_image_size('cs_media_6', 229, 133, true);





// event listing 140*140

// adding custom images while uploading media end



If (!function_exists('PixFill_comment')) :



    /**

     * Template for comments and pingbacks.

     *

     * To override this walker in a child theme without modifying the comments template

     * simply create your own PixFill_comment(), and that function will be used instead.

     *

     * Used as a callback by wp_list_comments() for displaying the comments.

     *

     */

    function PixFill_comment($comment, $args, $depth) {

        $GLOBALS['comment'] = $comment;

        $args['reply_text'] = '<i class="icon-mail-reply"></i>';

        switch ($comment->comment_type) :

            case '' :

                ?>

                <li  <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

                    <div class="thumblist" id="comment-<?php comment_ID(); ?>">

                        <ul>

                            <li>

                                <figure>

                                    <a href="#"><?php echo get_avatar($comment, 50); ?></a>

                                </figure>

                                <div class="text">

                                    <header>

                                        <?php printf(__('%s', 'Mercycorp'), sprintf('<h6><a class="colrhover">%s</a></h6>', get_comment_author_link())); ?>

                                        <?php

                                        /* translators: 1: date, 2: time */

                                        printf(__('<time>%1$s</time>', 'Mercycorp'), get_comment_date());

                                        ?>

                                        <?php edit_comment_link(__('(Edit)', 'Mercycorp'), ' '); ?>

                                        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>

                                        <?php if ($comment->comment_approved == '0') : ?>

                                            <div class="comment-awaiting-moderation colr"><?php _e('Your comment is awaiting moderation.', 'Mercycorp'); ?></div>

                                        <?php endif; ?>

                                    </header>

                                    <?php comment_text(); ?>

                                </div>

                            </li>

                        </ul>

                    </div>

                </li>

                <?php

                break;

            case 'pingback' :

            case 'trackback' :

                ?>

                <li class="post pingback">

                    <p><?php comment_author_link(); ?><?php edit_comment_link(__('(Edit)', 'Mercycorp'), ' '); ?></p>

                    <?php

                    break;

            endswitch;

        }



    endif;

// password protect post/page

    if (!function_exists('cs_password_form')) {



        function cs_password_form() {

            global $post, $cs_theme_option;

            $label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );

            $o = '<div class="password_protected">

				<div class="protected-icon"><a href="#"><i class="icon-unlock-alt icon-4"></i></a></div>

				<h3>' . __("This post is password protected. To view it please enter your password below:", 'Mercycorp') . '</h3>';

            $o .= '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post">

					<label><input name="post_password" id="' . $label . '" type="password" size="20" /></label>

					<input class="backcolr" type="submit" name="Submit" value="' . __("Submit", "Mercycorp") . '" />

				</form>

			</div>';

            return $o;

        }



    }

    add_filter('the_password_form', 'cs_password_form');



// breadcrumb function

    if (!function_exists('cs_breadcrumbs')) {



        function cs_breadcrumbs() {

            global $wp_query;

            /* === OPTIONS === */

            $text['home'] = 'Início'; // text for the 'Home' link

            $text['category'] = '%s'; // text for a category page

            $text['search'] = '%s'; // text for a search results page

            $text['tag'] = '%s'; // text for a tag page

            $text['author'] = '%s'; // text for an author page

            $text['404'] = 'Error 404'; // text for the 404 page



            $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show

            $showOnHome = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show

            $delimiter = ''; // delimiter between crumbs

            $before = '<li class="cs-active">'; // tag before the current crumb

            $after = '</li>'; // tag after the current crumb

            /* === END OF OPTIONS === */



            global $post;

            $homeLink = home_url() . '/';
            $linkBefore = '<li>';
            $linkAfter = '</li>';
            $linkAttr = '';
            if ( is_singular( 'infraestruturas' ) ) {
                $link = $linkBefore . '<a href="'.get_home_url().'/infraestreturas">%2$s</a>' . $linkAfter;
            } 
            elseif ( is_singular( 'pratrimonionatural' ) ) {
                $link = $linkBefore . '<a href="'.get_home_url().'/patrimonio-natural">%2$s</a>' . $linkAfter;
            }  
            elseif ( is_singular( 'pratrimoniorelegioso' ) ) {
                $link = $linkBefore . '<a href="'.get_home_url().'/patrimonio-religioso">%2$s</a>' . $linkAfter;
            } 
            elseif ( is_singular( 'pratrimoniocultural' ) ) {
                $link = $linkBefore . '<a href="'.get_home_url().'/patrimonio-cultural">%2$s</a>' . $linkAfter;
            }                                
            else {
                $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
            }
            $linkhome = $linkBefore . '<a' . $linkAttr . ' href="%1$s"><i class="icon-home"></i>%2$s</a>' . $linkAfter;



            if (is_home() || is_front_page()) {



                if ($showOnHome == "1")

                    echo '<div class="breadcrumbs"><ul>' . $before . '<a href="' . $homeLink . '"><i class="icon-home"></i>' . $text['home'] . '</a>' . $after . '</ul></div>';

            } else {

                echo '<div class="breadcrumbs"><ul>' . sprintf($linkhome, $homeLink, $text['home']) . $delimiter;

                if (is_category()) {

                    $thisCat = get_category(get_query_var('cat'), false);

                    if ($thisCat->parent != 0) {

                        $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);

                        $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);

                        $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);

                        echo $cats;

                    }

                    echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

                } elseif (is_search()) {

                    echo $before . sprintf($text['search'], get_search_query()) . $after;

                } elseif (is_day()) {

                    echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;

                    echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F')) . $delimiter;

                    echo $before . get_the_time('d') . $after;

                } elseif (is_month()) {

                    echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;

                    echo $before . get_the_time('F') . $after;

                } elseif (is_year()) {

                    echo $before . get_the_time('Y') . $after;

                } elseif (is_single() && !is_attachment()) {

                    if (get_post_type() != 'post') {

                        $post_type = get_post_type_object(get_post_type());

                        $slug = $post_type->rewrite;

                        printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);

                        if ($showCurrent == 1)

                            echo $delimiter . $before . 'Página Atual' . $after;

                    } else {

                        $cat = get_the_category();

                        $cat = $cat[0];

                        $cats = get_category_parents($cat, TRUE, $delimiter);

                        if ($showCurrent == 0)

                            $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);

                        $linkAttr =" class='forcenot'";

                        $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);

                        $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);

                        echo $cats;

                        if ($showCurrent == 1)

                            echo $before . 'Página Actual' . $after;

                    }

                } elseif (!is_single() && !is_page() && get_post_type() <> '' && get_post_type() != 'post' && get_post_type() <> 'events' && get_post_type() <> 'cs_menu' && !is_404()) {

                    $post_type = get_post_type_object(get_post_type());

                    echo $before . $post_type->labels->singular_name . $after;

                } elseif (isset($wp_query->query_vars['taxonomy']) && !empty($wp_query->query_vars['taxonomy'])) {

                    $taxonomy = $taxonomy_category = '';

                    $taxonomy = $wp_query->query_vars['taxonomy'];

                    echo $before . $wp_query->query_vars[$taxonomy] . $after;

                } elseif (is_page() && !$post->post_parent) {

                    if ($showCurrent == 1)

                        echo $before . get_the_title() . $after;

                } elseif (is_page() && $post->post_parent) {

                    $parent_id = $post->post_parent;

                    $breadcrumbs = array();

                    while ($parent_id) {

                        $page = get_page($parent_id);

                        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));

                        $parent_id = $page->post_parent;

                    }

                    $breadcrumbs = array_reverse($breadcrumbs);

                    for ($i = 0; $i < count($breadcrumbs); $i++) {

                        echo $breadcrumbs[$i];

                        if ($i != count($breadcrumbs) - 1)

                            echo $delimiter;

                    }

                    if ($showCurrent == 1)

                        echo $delimiter . $before . get_the_title() . $after;

                } elseif (is_tag()) {

                    echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

                } elseif (is_author()) {

                    global $author;

                    $userdata = get_userdata($author);

                    echo $before . sprintf($text['author'], $userdata->display_name) . $after;

                } elseif (is_404()) {

                    echo $before . $text['404'] . $after;

                }



                //echo "<pre>"; print_r($wp_query->query_vars); echo "</pre>";

                if (get_query_var('paged')) {

                    // if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';

                    // echo __('Page') . ' ' . get_query_var('paged');

                    // if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';

                }

                echo '</ul></div>';

            }

        }



    }

    if (!function_exists('cs_logo')) {



        function cs_logo($logo_url, $log_width, $logo_height) {

            ?>

            <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo_url; ?>"  style="width:<?php echo $log_width; ?>px; height:<?php echo $logo_height; ?>px" alt="<?php echo bloginfo('name'); ?>" /></a>

            <?php

        }



    }



    /*

      Under Construction logo Function

     */



    function cs_uc_logo() {

        global $cs_theme_option;

        ?>

        <a href="<?php echo home_url(); ?>"><img src="<?php echo $cs_theme_option['logo']; ?>"  style="width:<?php echo $cs_theme_option['logo_width']; ?>px; height:<?php echo $cs_theme_option['logo_height']; ?>px" alt="<?php echo bloginfo('name'); ?>" /></a>

        <?php

    }



    /*

      Top and Main Navigation

     */

    if (!function_exists('cs_navigation')) {



        function cs_navigation($nav = '', $menus = 'menus') {

            global $cs_theme_option;

            // Menu parameters	

            $defaults = array(

                'theme_location' => "$nav",

                'menu' => '',

                'container' => '',

                'container_class' => '',

                'container_id' => '',

                'menu_class' => '',

                'menu_id' => "$menus",

                'echo' => false,

                'fallback_cb' => 'wp_page_menu',

                'before' => '',

                'after' => '',

                'link_before' => '',

                'link_after' => '',

                'items_wrap' => '<ul id="%1$s">%3$s</ul>',

                'depth' => 0,

                'walker' => '',);

            echo do_shortcode(wp_nav_menu($defaults));

        }



    }



// Header simple, toggle and custom Search at front end//

    function cs_header_search($type = 'simple') {

        ?>



        <!-- Search Start -->

        <div class="search-sec">

            <button class="searchbtn"></button>

            <form action="<?php echo home_url() ?>" id="searchform" method="get" role="search">

                <?php if ($type = 'toggle' && $type <> '') { ?>



                    <div class="search">



                        <div class="search-box" style="display: block;">

                            <input type="text" value="<?php _e('Pesquisar por:', "Mercycorp"); ?>" class="search-input" name="s">

                            <label><input type="submit" value="" name=""></label>

                        </div>

                    </div>

                <?php } else { ?>

                    <div class="search">

                        <div class="search-box">

                            <input type="text" name="s" class="search-input" value="<?php _e('Pesquisar por:', "Mercycorp"); ?>">

                            <label><input type="submit" name="" value=""></label>

                        </div>

                    </div>

                <?php } ?>



            </form>  

        </div>

        <!-- Search End -->

        <?php

    }



    function cs_header_search_box($type = 'simple') {

        ?>



        <!-- Search Start -->

        <div class="search-sec">

            <!-- Search Form Start -->

            <div class="search_form" id="search_form">

                <!-- Container Start -->

                <div class="relative"> 

                    <form action="<?php echo home_url() ?>" id="searchform" method="get" role="search">

                        <input type="text" name="s" value="<?php _e('Pesquisar por:', "Mercycorp"); ?>"

                               onFocus="if (this.value == '<?php _e('Pesquisar por:', "Mercycorp"); ?>') {

                                               this.value = '';

                                           }"

                               onblur="if (this.value == '') {

                                               this.value = '<?php _e('Pesquisar por:', "Mercycorp"); ?>';

                                           }">

                        <label>

                            <i class="icon-search icon-2"></i>

                            <input type="submit" value="<?php //_e('Search', "Mercycorp")            ?>" id="searchsubmit" class="backcolr">

                        </label>

                    </form>

                </div>

                <!-- Container End -->

            </div>

            <!-- Search Form End -->

        </div>

        <!-- Search End -->

        <?php

    }



    /*

     * Login function

     */

    if (!function_exists('cs_login')) {



        function cs_login($login = '', $logout = '', $header_style = '') {

            ?>

            <nav class="topnav">

                <ul>

                    <?php if (is_user_logged_in()) { ?>

                        <li><a class="logout" href="<?php echo wp_logout_url("https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>">

                                <?php

                                if ($logout == true && $header_style == 'header6') {

                                    echo '<span>';

                                    _e('Log out', 'Mercycorp');

                                    echo '</span>';

                                } else if ($logout == true && $header_style == '') {

                                    _e('Log out', 'Mercycorp');

                                }

                                ?>

                                <i class="icon-signout"></i></a></li>

                    <?php } else { ?>

                        <li><a href="#loginbox" class="login" role="button" data-toggle="modal">

                                <?php

                                if ($login == true && $header_style == 'header6') {

                                    echo '<span>';

                                    _e('Log In', 'Mercycorp');

                                    echo '</span>';

                                } else if ($login == true && $header_style == '') {

                                    _e('Log In', 'Mercycorp');

                                }

                                ?>

                                <i class="icon-user"></i></a>

                        </li>

                    <?php } ?>

                </ul>

            </nav>



            <?php

        }



    }

    /*

     * Under Construction Page

     */

    if (!function_exists('cs_under_construction')) {



        function cs_under_construction() {

            global $cs_theme_option, $post;

            if (isset($post)) {

                $post_name = $post->post_name;

            } else {

                $post_name = '';

            }

            if ($cs_theme_option['under-construction'] == "on" or $post_name == "pf-under-construction") {

                ?>

                <div id="wrappermain-pix" class="wrapper wrapper_boxed undercunst-box">		

                    <div class="bottom_strip">

                        <div class="container">

                            <div class="logo">

                                <?php

                                if ($cs_theme_option['showlogo'] == "on") {

                                    cs_uc_logo();

                                }

                                ?>

                            </div>

                        </div>

                    </div>

                    <div id="undercontruction">



                        <div id="midarea">

                            <?php echo '<p>' . htmlspecialchars_decode($cs_theme_option['under_construction_text']) . '</p>'; ?>      

                            <?php

                            $launch_date = $cs_theme_option['launch_date'];

                            $year = date("Y", strtotime($launch_date));

                            $month = date("m", strtotime($launch_date));

                            $month_event_c = date("M", strtotime($launch_date));

                            $day = date("d", strtotime($launch_date));

                            $time_left = date("H,i,s", strtotime($launch_date));

                            ?>

                            <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/frontend/jquery.countdown.js"></script>

                            <script type="text/javascript">

                                   //Countdown callback function

                                   jQuery(function () {

                                       var austDay = new Date();

                                       austDay = new Date(<?php echo $year; ?>,<?php echo $month; ?> - 1,<?php echo $day; ?>);

                                       jQuery('#defaultCountdown').countdown({until: austDay});

                                       jQuery('#year').text(austDay.getFullYear());

                                   });</script>

                            <div class="countdown styled"></div>

                            <div class="countdownit">

                                <div id="defaultCountdown"></div>

                            </div>



                        </div>

                    </div>



                    <!-- Footer Widgets Start -->

                    <footer>

                        <!-- Container Start -->

                        <!-- Social Network Start -->

                        <?php

                        if ($cs_theme_option['socialnetwork'] == "on") {

                            cs_social_network();

                        }

                        ?> 

                        <!-- Social Network End -->

                        <!-- Container End -->

                    </footer>

                    <!-- Footer Start -->

                    <div class="clear"></div>

                </div>

                <?php

                die();

            }

        }



    }



// widget start

    if (!class_exists('facebook_module')) {



        class facebook_module extends WP_Widget {

            /**

             * Outputs the content of the widget

             *

             * @param array $args

             * @param array $instance

             */



            /**

             * @Facebook Module

             *

             *

             */

            public function __construct() {



                parent::__construct(

                        'facebook_module', // Base ID

                        __('CS : Facebook', 'logistic'), // Name

                        array('classname' => 'facebok_widget', 'description' => esc_html__('Facebook widget like box total customized with theme.', 'logistic'),) // Args

                );

            }



            /**

             * @Facebook html Form

             *

             *

             */

            function form($instance) {

                $instance = wp_parse_args((array) $instance, array('title' => ''));

                $title = $instance['title'];

                $pageurl = isset($instance['pageurl']) ? esc_attr($instance['pageurl']) : '';

                $showfaces = isset($instance['showfaces']) ? esc_attr($instance['showfaces']) : '';

                $showstream = isset($instance['showstream']) ? esc_attr($instance['showstream']) : '';

                $showheader = isset($instance['showheader']) ? esc_attr($instance['showheader']) : '';

                $fb_bg_color = isset($instance['fb_bg_color']) ? esc_attr($instance['fb_bg_color']) : '';

                $likebox_height = isset($instance['likebox_height']) ? esc_attr($instance['likebox_height']) : '';





                $width = isset($instance['width']) ? esc_attr($instance['width']) : '';

                $hide_cover = isset($instance['hide_cover']) ? esc_attr($instance['hide_cover']) : '';

                $show_posts = isset($instance['show_posts']) ? esc_attr($instance['show_posts']) : '';

                $hide_cta = isset($instance['hide_cta']) ? esc_attr($instance['hide_cta']) : '';

                $small_header = isset($instance['small_header']) ? esc_attr($instance['small_header']) : '';

                $adapt_container_width = isset($instance['adapt_container_width']) ? esc_attr($instance['adapt_container_width']) : '';

                ?>

                <p>

                    <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'logistic'); ?>

                        <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('title')); ?>" size='40' name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />

                    </label>

                </p>

                <p>

                    <label for="<?php echo esc_attr($this->get_field_id('pageurl')); ?>"><?php esc_html_e('Page Url', 'logistic'); ?> 

                        <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('pageurl')); ?>" size='40' name="<?php echo esc_attr($this->get_field_name('pageurl')); ?>" type="text" value="<?php echo esc_attr($pageurl); ?>" />

                        <br />

                        <small><?php esc_html_e('Please enter your page or User profile url example:L', 'logistic'); ?> https://www.facebook.com/profilename OR <br />

                            https://www.facebook.com/pages/wxyz/123456789101112 </small><br />

                    </label>

                </p>





                <p>

                    <label for="<?php echo cs_allow_special_char($this->get_field_id('fb_bg_color')); ?>"><?php esc_html_e('Background Color', 'logistic'); ?> 

                        <input type="text" name="<?php echo cs_allow_special_char($this->get_field_name('fb_bg_color')); ?>" size='4' id="<?php echo cs_allow_special_char($this->get_field_id('fb_bg_color')); ?>"  value="<?php

                        if (!empty($fb_bg_color)) {

                            echo cs_allow_special_char($fb_bg_color);

                        }

                        ?>" class="fb_bg_color upcoming"  />

                    </label>

                </p>   



                <p>

                    <label for="<?php echo cs_allow_special_char($this->get_field_id('width')); ?>"><?php esc_html_e('width', 'logistic'); ?> 

                        <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('width')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('width')); ?>" type="text" value="<?php echo esc_attr($width); ?>" />

                    </label>

                </p>



                <p>

                    <label for="<?php echo cs_allow_special_char($this->get_field_id('likebox_height')); ?>"><?php esc_html_e('Like Box Height', 'logistic'); ?> 

                        <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('likebox_height')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('likebox_height')); ?>" type="text" value="<?php echo esc_attr($likebox_height); ?>" />

                    </label>

                </p>



                <p>

                    <label for="<?php echo esc_attr($this->get_field_id('hide_cover')); ?>"><?php esc_html_e('Hide Cover', 'logistic'); ?> 

                        <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('hide_cover')); ?>" name="<?php echo esc_attr($this->get_field_name('hide_cover')); ?>" type="checkbox" <?php

                               if (esc_attr($hide_cover) != '') {

                                   echo 'checked';

                               }

                               ?> />

                    </label>

                </p>





                <p>

                    <label for="<?php echo esc_attr($this->get_field_id('showfaces')); ?>"><?php esc_html_e('Show Faces', 'logistic'); ?> 

                        <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('showfaces')); ?>" name="<?php echo esc_attr($this->get_field_name('showfaces')); ?>" type="checkbox" <?php

                   if (esc_attr($showfaces) != '') {

                       echo 'checked';

                   }

                   ?> />

                    </label>

                </p>





                <p>

                    <label for="<?php echo esc_attr($this->get_field_id('show_posts')); ?>"><?php esc_html_e('Show Posts', 'logistic'); ?> 

                        <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('show_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('show_posts')); ?>" type="checkbox" <?php

                   if (esc_attr($show_posts) != '') {

                       echo 'checked';

                   }

                   ?> />

                    </label>

                </p>





                <p>

                    <label for="<?php echo esc_attr($this->get_field_id('hide_cta')); ?>"><?php esc_html_e('Hide Cta', 'logistic'); ?> 

                        <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('hide_cta')); ?>" name="<?php echo esc_attr($this->get_field_name('hide_cta')); ?>" type="checkbox" <?php

                   if (esc_attr($hide_cta) != '') {

                       echo 'checked';

                   }

                               ?> />

                    </label>

                </p>



                <p>

                    <label for="<?php echo esc_attr($this->get_field_id('small_header')); ?>"><?php esc_html_e('Small Header', 'logistic'); ?> 

                        <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('small_header')); ?>" name="<?php echo esc_attr($this->get_field_name('small_header')); ?>" type="checkbox" <?php

                               if (esc_attr($small_header) != '') {

                                   echo 'checked';

                               }

                               ?> />

                    </label>

                </p>



                <p>

                    <label for="<?php echo esc_attr($this->get_field_id('adapt_container_width')); ?>"><?php esc_html_e('Adapt width', 'logistic'); ?> 

                        <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('adapt_container_width')); ?>" name="<?php echo esc_attr($this->get_field_name('adapt_container_width')); ?>" type="checkbox" <?php

                if (esc_attr($adapt_container_width) != '') {

                    echo 'checked';

                }

                ?> />

                    </label>

                </p>



                <?php

            }



            /**

             * @Facebook Update Form Data

             *

             *

             */

            function update($new_instance, $old_instance) {

                $instance = $old_instance;

                $instance['title'] = $new_instance['title'];

                $instance['pageurl'] = $new_instance['pageurl'];

                $instance['showfaces'] = $new_instance['showfaces'];

                $instance['showstream'] = $new_instance['showstream'];

                $instance['showheader'] = $new_instance['showheader'];

                $instance['fb_bg_color'] = $new_instance['fb_bg_color'];

                $instance['likebox_height'] = $new_instance['likebox_height'];



                $instance['width'] = $new_instance['width'];

                $instance['hide_cover'] = $new_instance['hide_cover'];

                $instance['show_posts'] = $new_instance['show_posts'];

                $instance['hide_cta'] = $new_instance['hide_cta'];

                $instance['small_header'] = $new_instance['small_header'];

                $instance['adapt_container_width'] = $new_instance['adapt_container_width'];





                return $instance;

            }



            /**

             * @Facebook Widget Display

             *

             *

             */

            function widget($args, $instance) {

                extract($args, EXTR_SKIP);

                $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

                $title = htmlspecialchars_decode(stripslashes($title));

                $pageurl = empty($instance['pageurl']) ? ' ' : apply_filters('widget_title', $instance['pageurl']);

                $showfaces = empty($instance['showfaces']) ? ' ' : apply_filters('widget_title', $instance['showfaces']);

                $showstream = empty($instance['showstream']) ? ' ' : apply_filters('widget_title', $instance['showstream']);

                $showheader = empty($instance['showheader']) ? ' ' : apply_filters('widget_title', $instance['showheader']);

                $fb_bg_color = empty($instance['fb_bg_color']) ? ' ' : apply_filters('widget_title', $instance['fb_bg_color']);

                $likebox_height = empty($instance['likebox_height']) ? ' ' : apply_filters('widget_title', $instance['likebox_height']);



                $width = empty($instance['width']) ? ' ' : apply_filters('widget_title', $instance['width']);

                $hide_cover = empty($instance['hide_cover']) ? ' ' : apply_filters('widget_title', $instance['hide_cover']);

                $show_posts = empty($instance['show_posts']) ? ' ' : apply_filters('widget_title', $instance['show_posts']);

                $hide_cta = empty($instance['hide_cta']) ? ' ' : apply_filters('widget_title', $instance['hide_cta']);

                $small_header = empty($instance['small_header']) ? ' ' : apply_filters('widget_title', $instance['small_header']);

                $adapt_container_width = empty($instance['adapt_container_width']) ? ' ' : apply_filters('widget_title', $instance['adapt_container_width']);





                if (isset($showfaces) AND $showfaces == 'on') {

                    $showfaces = 'true';

                } else {

                    $showfaces = 'false';

                }

                if (isset($showstream) AND $showstream == 'on') {

                    $showstream = 'true';

                } else {

                    $showstream = 'false';

                }



                if (isset($hide_cover) AND $hide_cover == 'on') {

                    $hide_cover = 'true';

                } else {

                    $hide_cover = 'false';

                }

                if (isset($show_posts) AND $show_posts == 'on') {

                    $show_posts = 'true';

                } else {

                    $show_posts = 'false';

                }

                if (isset($hide_cta) AND $hide_cta == 'on') {

                    $hide_cta = 'true';

                } else {

                    $hide_cta = 'false';

                }

                if (isset($small_header) AND $small_header == 'on') {

                    $small_header = 'true';

                } else {

                    $small_header = 'false';

                }

                if (isset($adapt_container_width) AND $adapt_container_width == 'on') {

                    $adapt_container_width = 'true';

                } else {

                    $adapt_container_width = 'false';

                }





                echo cs_allow_special_char($before_widget);

                ?>

                <style scoped>

                    .facebookOuter {background-color:<?php echo cs_allow_special_char($fb_bg_color); ?>; width:100%;padding:0;float:left;}

                    .facebookInner {float: left; width: 100%;}

                    .facebook_module, .fb_iframe_widget > span, .fb_iframe_widget > span > iframe { width: 100% !important;}

                    .fb_iframe_widget, .fb-like-box div span iframe { width: 100% !important; float: left;}

                </style>

            <?php

            if (!empty($title) && $title <> ' ') {

                echo cs_allow_special_char($before_title);

                echo cs_allow_special_char($title);

                echo cs_allow_special_char($after_title);

            }

            global $wpdb, $post;

            ?>		



                <div id="fb-root"></div>

                <script>(function (d, s, id) {

                        var js, fjs = d.getElementsByTagName(s)[0];

                        if (d.getElementById(id))

                            return;

                        js = d.createElement(s);

                        js.id = id;

                        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";

                        fjs.parentNode.insertBefore(js, fjs);

                    }(document, 'script', 'facebook-jssdk'));</script>



                <?php

                $output = '';

                $output .= '<div style="background:' . esc_attr($instance['fb_bg_color']) . ';" class="fb-like-box" ';

                $output .= ' data-href="' . esc_url($pageurl) . '"';

                $output .= ' data-width="' . $width . '" ';

                $output .= ' data-height="' . $likebox_height . '" ';

                $output .= ' data-hide-cover="' . $hide_cover . '" ';

                $output .= ' data-show-facepile="' . $showfaces . '" ';

                $output .= ' data-show-posts="' . $show_posts . '">';

                $output .= ' </div>';

                echo cs_allow_special_char($output);



                echo cs_allow_special_char($after_widget);

            }



        }



    }

    add_action('widgets_init', create_function('', 'return register_widget("facebook_module");'));



// widget_gallery start

    class albums extends WP_Widget {



        public function __construct() {



            parent::__construct(

                    'albums', // Base ID

                    __('CS : Gallery Widget', 'Mercycorp'), // Name

                    array('classname' => 'widget_gallery', 'description' => 'Select any gallery to show in widget.',) // Args

            );

        }



        function form($instance) {

            $instance = wp_parse_args((array) $instance, array('title' => '', 'get_names_gallery' => 'new'));

            $title = $instance['title'];

            $get_names_gallery = isset($instance['get_names_gallery']) ? esc_attr($instance['get_names_gallery']) : '';

            $showcount = isset($instance['showcount']) ? esc_attr($instance['showcount']) : '';

            ?>

            <p>

                <label for="<?php echo $this->get_field_id('title'); ?>">

                        <?php _e('Title', 'Mercycorp'); ?> 

                    <input class="upcoming" id="<?php echo $this->get_field_id('title'); ?>" size="40" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />

                </label>

            </p>

            <p>

                <label for="<?php echo $this->get_field_id('get_names_gallery'); ?>">

                                <?php _e('Select Gallery', 'Mercycorp'); ?>

                    <select id="<?php echo $this->get_field_id('get_names_gallery'); ?>" name="<?php echo $this->get_field_name('get_names_gallery'); ?>" style="width:225px;">

                                <?php

                                global $wpdb, $post;

                                $newpost = 'posts_per_page=-1&post_type=albums&order=ASC&post_status=publish';

                                $newquery = new WP_Query($newpost);

                                while ($newquery->have_posts()): $newquery->the_post();

                                    ?>

                            <option <?php

                                    if (esc_attr($get_names_gallery) == $post->post_name) {

                                        echo 'selected';

                                    }

                                    ?> value="<?php echo $post->post_name; ?>" >

                        <?php

                        echo substr(get_the_title($post->ID), 0, 20);

                        if (strlen(get_the_title($post->ID)) > 20)

                            echo "...";

                        ?>

                            </option>						

            <?php endwhile; ?>

                    </select>

                </label>

            </p>  



            <p>

                <label for="<?php echo $this->get_field_id('showcount'); ?>">

            <?php _e('Number of Images', 'Mercycorp'); ?>

                    <input class="upcoming" id="<?php echo $this->get_field_id('showcount'); ?>" size="2" name="<?php echo $this->get_field_name('showcount'); ?>" type="text" value="<?php echo esc_attr($showcount); ?>" />

                </label>

            </p>  

            <?php

        }



        function update($new_instance, $old_instance) {



            $instance = $old_instance;

            $instance['title'] = $new_instance['title'];

            $instance['get_names_gallery'] = $new_instance['get_names_gallery'];

            $instance['showcount'] = $new_instance['showcount'];

            return $instance;

        }



        function widget($args, $instance) {

            extract($args, EXTR_SKIP);

            global $wpdb, $post;

            $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

            $get_names_gallery = isset($instance['get_names_gallery']) ? esc_attr($instance['get_names_gallery']) : '';

            $showcount = isset($instance['showcount']) ? esc_attr($instance['showcount']) : '';

            if (empty($showcount)) {

                $showcount = '12';

            }



            // WIDGET display CODE Start

            echo $before_widget;

            if (strlen($get_names_gallery) <> 1 || strlen($get_names_gallery) <> 0) {

                echo $before_title . $title . $after_title;

            }

            if ($get_names_gallery <> '') {

                // galery slug to id start

                $get_gallery_id = '';

                $args = array(

                    'name' => $get_names_gallery,

                    'post_type' => 'albums',

                    'post_status' => 'publish',

                    'showposts' => 1,

                );

                $get_posts = get_posts($args);

                if ($get_posts) {

                    $get_gallery_id = $get_posts[0]->ID;

                }

                // galery slug to id end

                if ($get_gallery_id <> '') {

                    $cs_meta_gallery_options = get_post_meta($get_gallery_id, "cs_meta_gallery_options", true);

                    if ($cs_meta_gallery_options <> "") {

                        $cs_xmlObject = new SimpleXMLElement($cs_meta_gallery_options);

                        if ($showcount > count($cs_xmlObject)) {

                            $showcount = count($cs_xmlObject);

                        }

                        ?>



                        <ul class="gallery-list lightbox gallery">

                    <?php

                    cs_enqueue_gallery_style_script();

                    for ($i = 0; $i < $showcount; $i++) {

                        $path = $cs_xmlObject->gallery[$i]->path;

                        $title = $cs_xmlObject->gallery[$i]->title;

                        $description = $cs_xmlObject->gallery[$i]->description;

                        $social_network = $cs_xmlObject->gallery[$i]->social_network;

                        $use_image_as = $cs_xmlObject->gallery[$i]->use_image_as;

                        $video_code = $cs_xmlObject->gallery[$i]->video_code;

                        $link_url = $cs_xmlObject->gallery[$i]->link_url;

                        $image_url = cs_attachment_image_src($path, 60, 60);

                        $image_url_full = cs_attachment_image_src($path, 0, 0);

                        ?>

                                <li>

                                    <figure>

                                        <figcaption>

                                            <a <?php

                        

                            echo 'data-title="' . $title . '"';

                            echo 'data-description="' . $description . '"';

                      

                        ?> href="<?php

                            if ($use_image_as == 1)

                                echo $video_code;

                            elseif ($use_image_as == 2)

                                echo $link_url;

                            else

                                echo $image_url_full;

                            ?>" target="<?php

                            if ($use_image_as == 2) {

                                echo '_blank';

                            } else {

                                echo '_self';

                            };

                            ?>" rel="prettyPhoto[gallery2]"><?php echo "<img width='60' height='60' src='" . $image_url . "' data-alt='" . $title . "' alt='' />" ?></a>



                                        </figcaption></figure></li>





                        <?php } ?>

                        </ul>

                        <?php

                    }

                } else {

                    echo '<h4>' . __('No results found.', 'Mercycorp') . '</h4>';

                }

            }     // endif of Category Selection

            ?>



            <?php

            echo $after_widget; // WIDGET display CODE End

        }



    }



    add_action('widgets_init', create_function('', 'return register_widget("albums");'));



    // widget_gallery end

    // widget_recent_post start

    class recentposts extends WP_Widget {



        public function __construct() {



            parent::__construct(

                    'recentposts', // Base ID

                    __('CS : Recent Posts', 'Mercycorp'), // Name

                    array('classname' => 'widget-recent-blog', 'description' => 'Recent Posts from category.',) // Args

            );

        }



        function form($instance) {

            $instance = wp_parse_args((array) $instance, array('title' => ''));

            $title = $instance['title'];

            $select_category = isset($instance['select_category']) ? esc_attr($instance['select_category']) : '';

            $showcount = isset($instance['showcount']) ? esc_attr($instance['showcount']) : '';

            $thumb = isset($instance['thumb']) ? esc_attr($instance['thumb']) : '';

            ?>

            <p>

                <label for="<?php echo $this->get_field_id('title'); ?>">

        <?php _e('Title', 'Mercycorp'); ?> 

                    <input class="upcoming" id="<?php echo $this->get_field_id('title'); ?>" size="40" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />

                </label>

            </p> 

            <p>

                <label for="<?php echo $this->get_field_id('select_category'); ?>">

        <?php _e('Select Category', 'Mercycorp'); ?>            

                    <select id="<?php echo $this->get_field_id('select_category'); ?>" name="<?php echo $this->get_field_name('select_category'); ?>" style="width:225px">

                    <?php

                    $categories = get_categories();

                    if ($categories <> "") {

                        foreach ($categories as $category) {

                            ?>

                                <option <?php

                    if ($select_category == $category->slug) {

                        echo 'selected';

                    }

                    ?> value="<?php echo $category->slug; ?>" ><?php echo $category->name; ?></option>						

                <?php } ?>

            <?php } ?>            

                    </select>

                </label>

            </p>  

            <p>

                <label for="<?php echo $this->get_field_id('showcount'); ?>">

            <?php _e('Number of Posts To Display', 'Mercycorp'); ?>

                    <input class="upcoming" id="<?php echo $this->get_field_id('showcount'); ?>" size='2' name="<?php echo $this->get_field_name('showcount'); ?>" type="text" value="<?php echo esc_attr($showcount); ?>" />

                </label>

            </p>

            <p>

                <label for="<?php echo $this->get_field_id('thumb'); ?>">

            <?php _e('Display Thumbnails', 'Mercycorp'); ?>	

                    <input class="upcoming" id="<?php echo $this->get_field_id('thumb'); ?>" size='2' name="<?php echo $this->get_field_name('thumb'); ?>" value="true" type="checkbox"  <?php if (isset($instance['thumb']) && $instance['thumb'] == 'true') echo 'checked="checked"'; ?> />

                </label>

            </p>

            <?php

        }



        function update($new_instance, $old_instance) {

            $instance = $old_instance;

            $instance['title'] = $new_instance['title'];

            $instance['select_category'] = $new_instance['select_category'];

            $instance['showcount'] = $new_instance['showcount'];

            $instance['thumb'] = $new_instance['thumb'];

            return $instance;

        }



        function widget($args, $instance) {

            global $cs_node;

            extract($args, EXTR_SKIP);

            $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

            $select_category = empty($instance['select_category']) ? ' ' : apply_filters('widget_title', $instance['select_category']);

            $showcount = empty($instance['showcount']) ? ' ' : apply_filters('widget_title', $instance['showcount']);

            $thumb = isset($instance['thumb']) ? esc_attr($instance['thumb']) : '';



            if ($instance['showcount'] == "") {

                $instance['showcount'] = '-1';

            }

            echo $before_widget;

            // WIDGET display CODE Start

            if (!empty($title) && $title <> ' ') {

                echo $before_title;

                echo $title;

                echo $after_title;

            }

            global $wpdb, $post;

            ?>

            <!-- Recent Posts Start -->

            <?php

            wp_reset_query();

            $args = array('posts_per_page' => "$showcount", 'post_type' => 'post', 'category_name' => "$select_category");

            $custom_query = new WP_Query($args);

            if ($custom_query->have_posts() <> "") {

                while ($custom_query->have_posts()) : $custom_query->the_post();

                    $post_xml = get_post_meta($post->ID, "post", true);

                    $cs_xmlObject = new stdClass();

                    if ($post_xml <> "") {

                        $cs_xmlObject = new SimpleXMLElement($post_xml);

                        $post_view = '';

                        $post_view = $cs_xmlObject->post_thumb_view;

                        $post_image = $cs_xmlObject->post_thumb_image;

                        $post_video = $cs_xmlObject->post_thumb_video;

                        $post_audio = $cs_xmlObject->post_thumb_audio;

                        $post_slider = $cs_xmlObject->post_thumb_slider;

                        $post_slider_type = $cs_xmlObject->post_thumb_slider_type;

                        $post_date = date("d F Y", strtotime(get_the_date()));

                        $datetime = date("Y-d-m", strtotime(get_the_date()));

                        $width = 230;

                        $height = 230;

                        $image_url = cs_get_post_img_src($post->ID, $width, $height);

                    }

                    ?>

                    <!-- Upcoming Widget Start -->

                    <article>



                  

                                    <?php if ($thumb == "true") { ?>

                            <figure>

                                        <?php

                                        if ($post_view <> '') {

                                            //cs_enqueue_gallery_style_script();

                                            echo "<a class='icon-hover' href='" . get_permalink() . "' ><img src='" . $image_url . "' alt='' width='60'></a>";

                                        }

                                        ?>

                            </figure>

                            <div class="text">

                                <h6><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h6>	

                                <time datetime="<?php echo date('Y-m-d', strtotime(get_the_date())); ?>"><?php echo date('Y-m-d', strtotime(get_the_date())); ?></time>

                            </div>



                    <?php }else { ?>

                            <div class="text">

                                <h6><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h6>	

                                <time datetime="<?php echo date('Y-m-d', strtotime(get_the_date())); ?>"><?php echo date('Y-m-d', strtotime(get_the_date())); ?></time>

                            </div>

                    <?php } ?>

                    </article>                 

                <?php endwhile; ?>

                <?php

            }

            else {

                echo '<h4>' . __('No results found.', 'Mercycorp') . '</h4>';

            }

            ?>

            <!-- Recent Posts End -->     

            <?php

            echo $after_widget;

        }



    }



    add_action('widgets_init', create_function('', 'return register_widget("recentposts");'));



    // widget_recent_post end

    // widget_twitter start

    class cs_twitter_widget extends WP_Widget {



        public function __construct() {



            parent::__construct(

                    'cs_twitter_widget', // Base ID

                    __('CS : Twitter Widget', 'Mercycorp'), // Name

                    array('classname' => 'widget widget-latestnews widget-twitter', 'description' => 'Twitter Widget.',) // Args

            );

        }



        function form($instance) {

            $instance = wp_parse_args((array) $instance, array('title' => ''));

            $title = $instance['title'];

            $username = isset($instance['username']) ? esc_attr($instance['username']) : '';

            $numoftweets = isset($instance['numoftweets']) ? esc_attr($instance['numoftweets']) : '';

            ?>

            <label for="<?php echo $this->get_field_id('title'); ?>">

                <span><?php _e('Title', 'Mercycorp'); ?> </span>

                <input class="upcoming" id="<?php echo $this->get_field_id('title'); ?>" size="40" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />

            </label>

            <label for="screen_name"><?php _e('User Name', 'Mercycorp'); ?><span class="required">(*)</span>: </label>

            <input class="upcoming" id="<?php echo $this->get_field_id('username'); ?>" size="40" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo esc_attr($username); ?>" />

            <label for="tweet_count">

                <span><?php _e('Num of Tweets', 'Mercycorp'); ?> </span>

                <input class="upcoming" id="<?php echo $this->get_field_id('numoftweets'); ?>" size="2" name="<?php echo $this->get_field_name('numoftweets'); ?>" type="text" value="<?php echo esc_attr($numoftweets); ?>" />

                <div class="clear"></div>

            </label>

            <?php

        }



        function update($new_instance, $old_instance) {

            $instance = $old_instance;

            $instance['title'] = $new_instance['title'];

            $instance['username'] = $new_instance['username'];

            $instance['numoftweets'] = $new_instance['numoftweets'];



            return $instance;

        }



        //Updated Widget

        function widget($args, $instance) {

            global $cs_theme_option, $cs_twitter_arg;





            $cs_twitter_arg['consumerkey'] = isset($cs_theme_option['consumer_key']) ? $cs_theme_option['consumer_key'] : '';

            $cs_twitter_arg['consumersecret'] = isset($cs_theme_option['consumer_secret']) ? $cs_theme_option['consumer_secret'] : '';

            $cs_twitter_arg['accesstoken'] = isset($cs_theme_option['access_token']) ? $cs_theme_option['access_token'] : '';

            $cs_twitter_arg['accesstokensecret'] = isset($cs_theme_option['access_token_secret']) ? $cs_theme_option['access_token_secret'] : '';

            $cs_cache_limit_time = isset($cs_theme_option['cache_limit_time']) ? $cs_theme_option['cache_limit_time'] : '';

            $cs_tweet_num_from_twitter = isset($cs_theme_option['tweet_num_post']) ? $cs_theme_option['tweet_num_post'] : '';

            $cs_twitter_datetime_formate = isset($cs_theme_option['twitter_datetime_formate']) ? $cs_theme_option['twitter_datetime_formate'] : 'fggghgh';





            if ($cs_cache_limit_time == '') {

                $cs_cache_limit_time = 60;

            }

            if ($cs_twitter_datetime_formate == '') {

                $cs_twitter_datetime_formate = 'time_since';

            }

            if ($cs_tweet_num_from_twitter == '') {

                $cs_tweet_num_from_twitter = 5;

            }



            extract($args, EXTR_SKIP);

            $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

            $title = htmlspecialchars_decode(stripslashes($title));

            $username = $instance['username'];

            $numoftweets = $instance['numoftweets'];

            if ($numoftweets == '') {

                $numoftweets = 2;

            }

            echo cs_allow_special_char($before_widget);

            // WIDGET display CODE Start

            if (!empty($title) && $title <> ' ') {

                echo cs_allow_special_char($before_title . $title . $after_title);

            }

            if (strlen($username) > 1) {

                if ($cs_twitter_arg['consumerkey'] <> '' && $cs_twitter_arg['consumersecret'] <> '' && $cs_twitter_arg['accesstoken'] <> '' && $cs_twitter_arg['accesstokensecret'] <> '') {

                    require_once get_template_directory() . '/include/twitteroauth/display-tweets.php';

                    display_tweets($username, $cs_twitter_datetime_formate, $cs_tweet_num_from_twitter, $numoftweets, $cs_cache_limit_time);

                    echo '</div>';

                } else {

                    echo '<p>' . __('Please Set Twitter API', 'forkbite') . '</p>';

                }

            }

            echo cs_allow_special_char($after_widget);

        }



    }



    add_action('widgets_init', create_function('', 'return register_widget("cs_twitter_widget");'));



    // widget_twitter end

// widget end

    /**

     * Archives widget class

     */

    class chimp_Widget_Archives extends WP_Widget {



        public function __construct() {



            parent::__construct(

                    'chimp_archives', // Base ID

                    __('CS: Archives', 'Mercycorp'), // Name

                    array('classname' => 'widget_archive', 'description' => 'A monthly archive Widget',) // Args

            );

        }



        function widget($args, $instance) {

            global $wpdb, $wp_locale;

            $output = $selectbox = '';



            extract($args);

            $title = apply_filters('widget_title', empty($instance['title']) ? 'Archives' : $instance['title']);

            $count = $instance['count'];

            $dropdown = $instance['dropdown'];



            echo $before_widget;

            if ($title)

                echo $before_title . $title . $after_title;

            $post_types = array('post', 'cs_cause', 'events');



            // 

            $where = apply_filters('getarchives_where', "WHERE (post_type='post'|| post_type='cs_cause' || post_type='events') AND post_status = 'publish'", '');

            $join = apply_filters('getarchives_join', "", '');

            $query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC";

            $key = md5($query);

            $cache = wp_cache_get('wp_get_archives', 'general');

            if (!isset($cache[$key])) {

                $arcresults = $wpdb->get_results($query);

                $cache[$key] = $arcresults;

                wp_cache_add('wp_get_archives', $cache, 'general');

            } else {

                $arcresults = $cache[$key];

            }

            if ($arcresults) {

                //$afterafter = $after;

                foreach ((array) $arcresults as $arcresult) {

                    $url = get_month_link($arcresult->year, $arcresult->month);

                    $text = sprintf(__('%1$s %2$d', 'Mercycorp'), $wp_locale->get_month($arcresult->month), $arcresult->year);



                    if (isset($count) && $count <> '')

                        $text .= '&nbsp;(' . $arcresult->posts . ')';





                    $output .= get_archives_link($url, $text, '', '<li>', '</li>');

                    if (isset($dropdown) && $dropdown <> '') {

                        $selectbox.='<option value="' . $url . '">' . $text . '</option>';

                    }

                }

            }



            if (isset($dropdown) && $dropdown <> '') {

                ?>

                <ul>

                    <li>

                        <select name="archive-dropdown" onchange='document.location.href = this.options[this.selectedIndex].value;'>

                            <option value=""><?php echo _e('Select Month', 'Mercycorp'); ?></option>

                <?php echo $selectbox; ?>

                        </select>

                    </li>

                </ul>

                <?php

            } else {

                echo '<ul>' . $output . '</ul>';

            }

            echo $after_widget;

        }



        function update($new_instance, $old_instance) {

            $instance = $old_instance;

            $new_instance = wp_parse_args((array) $new_instance, array('title' => '', 'count' => 0, 'dropdown' => ''));

            $instance['title'] = strip_tags($new_instance['title']);

            $instance['count'] = $new_instance['count'] ? 1 : 0;

            $instance['dropdown'] = $new_instance['dropdown'] ? 1 : 0;



            return $instance;

        }



        function form($instance) {

            $instance = wp_parse_args((array) $instance, array('title' => '', 'count' => 0, 'dropdown' => ''));

            $title = strip_tags($instance['title']);

            $count = $instance['count'] ? 'checked="checked"' : '';

            $dropdown = $instance['dropdown'] ? 'checked="checked"' : '';

            ?>

            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'Mercycorp'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

            <p>

                <input class="checkbox" type="checkbox" <?php echo $count; ?> id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" /> <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Show post counts', 'Mercycorp'); ?></label>

                <br />

                <input class="checkbox" type="checkbox" <?php echo $dropdown; ?> id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>" /> <label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e('Display as a drop down', 'Mercycorp'); ?></label>

            </p>

            <?php

        }



    }



    function chimp_widget_init() {

        // unregister some default widgets

        unregister_widget('WP_Widget_Archives');

        // register my own widgets

        register_widget('chimp_Widget_Archives');

    }



    add_action('widgets_init', 'chimp_widget_init');



// Event Widget



    class upcoming_events extends WP_Widget {



        public function __construct() {



            parent::__construct(

                    'upcoming_events', // Base ID

                    __('CS : Upcoming Events', 'Mercycorp'), // Name

                    array('classname' => 'widget-latest-event', 'description' => 'Select Event to show its countdown',) // Args

            );

        }



        function form($instance) {

            $instance = wp_parse_args((array) $instance, array('title' => '', 'widget_names_events' => 'new'));

            $title = $instance['title'];

            $get_post_slug = isset($instance['get_post_slug']) ? esc_attr($instance['get_post_slug']) : '';

            $showcount = isset($instance['showcount']) ? esc_attr($instance['showcount']) : '';

            ?>

            <p>

                <label for="<?php echo $this->get_field_id('title'); ?>">

                                <?php _e('Title', 'Mercycorp'); ?> 

                    <input class="upcoming" id="<?php echo $this->get_field_id('title'); ?>" size="40" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />

                </label>

            </p>

            <p>

                <label for="<?php echo $this->get_field_id('get_post_slug'); ?>">

                        <?php _e('Select Event', 'Mercycorp'); ?> 

                    <select id="<?php echo $this->get_field_id('get_post_slug'); ?>" name="<?php echo $this->get_field_name('get_post_slug'); ?>" style="width:225px">

                        <option value=""> Select Category</option>

        <?php

        global $wpdb, $post;

        $categories = get_categories('taxonomy=event-category&child_of=0&hide_empty=0');

        if ($categories != '') {

            

        }

        foreach ($categories as $category) {

            ?>

                            <option <?php

                if (esc_attr($get_post_slug) == $category->slug) {

                    echo 'selected';

                }

                ?> value="<?php echo $category->slug; ?>" >

                <?php

                echo substr($category->name, 0, 20);

                if (strlen($category->name) > 20)

                    echo "...";

                ?>

                            </option>						

            <?php } ?>

                    </select>

                </label>

            </p>  

            <p>

                <label for="<?php echo $this->get_field_id('showcount'); ?>">

            <?php _e('Number of Events', 'Mercycorp'); ?>

                    <input class="upcoming" id="<?php echo $this->get_field_id('showcount'); ?>" size="2" name="<?php echo $this->get_field_name('showcount'); ?>" type="text" value="<?php echo esc_attr($showcount); ?>" />

                </label>

            </p>  

            <?php

        }



        function update($new_instance, $old_instance) {

            $instance = $old_instance;

            $instance['title'] = $new_instance['title'];

            $instance['get_post_slug'] = $new_instance['get_post_slug'];

            $instance['showcount'] = $new_instance['showcount'];





            return $instance;

        }



        function widget($args, $instance) {

            extract($args, EXTR_SKIP);

            $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

            $get_post_slug = isset($instance['get_post_slug']) ? esc_attr($instance['get_post_slug']) : '';

            $showcount = isset($instance['showcount']) ? esc_attr($instance['showcount']) : '';

            if (empty($showcount)) {

                $showcount = '4';

            }

            // WIDGET display CODE Start

            echo $before_widget;

            wp_reset_query();

            if (!empty($title) && $title <> ' ') {

                echo $before_title . $title . $after_title;

            }

            global $wpdb, $post;

            //$term = get_term( $get_names_events, 'event-category' );

            if ($get_post_slug <> '') {

                date_default_timezone_set('UTC');

                $current_time = current_time('Y-m-d H:i', $gmt = 0);

                $newterm = get_term_by('slug', $get_post_slug, 'event-category');

                $args = array(

                    'posts_per_page' => $showcount,

                    'post_type' => 'events',

                    'event-category' => "$get_post_slug",

                    'post_status' => 'publish',

                    'meta_key' => 'cs_event_from_date_time',

                    'meta_value' => $current_time,

                    'meta_compare' => ">",

                    'orderby' => 'meta_value',

                    'order' => 'ASC'

                );

                $custom_query = new WP_Query($args);

                if ($custom_query->have_posts() <> "") {



                    $cs_counter_events = 0;

                    while ($custom_query->have_posts()): $custom_query->the_post();

                        $cs_counter_events++;

                        $cs_event_from_date = get_post_meta($post->ID, "cs_event_from_date", true);

                        $year_event = date("Y", strtotime($cs_event_from_date));

                        $month_event = date("M", strtotime($cs_event_from_date));

                        $day_event = date("d", strtotime($cs_event_from_date));

                        $cs_event_meta = get_post_meta($post->ID, "cs_event_meta", true);

                        if ($cs_event_meta <> "") {

                            $cs_event_meta = new SimpleXMLElement($cs_event_meta);

                            $event_start_time = $cs_event_meta->event_start_time;

                        }

                        $cs_event_loc = get_post_meta($cs_event_meta->event_address, "cs_event_loc_meta", true);

                        if ($cs_event_loc <> "") {

                            $cs_xmlObject = new SimpleXMLElement($cs_event_loc);

                            $loc_address = $cs_xmlObject->loc_address;

                        } else {

                            $loc_address = '';

                        }

                        ?>

                        <!-- Events Widget Start -->

                        <article>

                            <div class="calendar-date">

                                <p class="dotted-style"></p>

                                <span><?php echo date_i18n("M", strtotime($cs_event_from_date)); ?></span>

                                <time datetime="<?php echo $cs_event_from_date; ?>"><?php echo $day_event; ?></time>

                            </div>

                            <div class="text">

                                <h6><a class="colrhover" href="<?php echo get_permalink(); ?>">

                        <?php

                        echo substr(get_the_title(), 0, 30);

                        if (strlen(get_the_title()) > 30)

                            echo "...";

                        ?>

                                    </a>

                                </h6>

                                <time datetime="<?php echo $month_event; ?>"><?php echo date_i18n("l", strtotime($cs_event_from_date)); ?>, <?php echo $event_start_time; ?></time>

                                <p><i class="icon-map-marker"></i><?php echo $loc_address; ?></p>

                            </div>

                        </article>



                        <!-- Events Widget End -->		

                    <?php endwhile; ?>



                    <?php

                }else {

                    echo '<h3 class="heading-color">';

                    _e('No results found.', 'Mercycorp');

                    echo '</h3>';

                }

            } // endif of Category Selection

            echo $after_widget; // WIDGET display CODE End

        }



    }



    add_action('widgets_init', create_function('', 'return register_widget("upcoming_events");'));



// MailChimp Widget

    if (!class_exists('chimp_MailChimp_Widget')) {



        class chimp_MailChimp_Widget extends WP_Widget {



            private $default_failure_message;

            public $default_loader_graphic;

            private $default_signup_text;

            private $default_success_message;

            private $default_title;

            private $successful_signup = false;

            private $subscribe_errors;

            private $ns_mc_plugin;



            /**



             * @author James Lafferty



             * @since 0.1



             */

            public function __construct() {



                $this->default_failure_message = __('There was a problem processing your submission.', 'Mercycorp');



                $this->default_signup_text = __('Join now!', 'Mercycorp');



                $this->default_success_message = __('Thank you for joining our mailing list. Please check your email for a confirmation link.', 'Mercycorp');



                $this->default_title = __('Sign up for our mailing list.', 'Mercycorp');

                $this->ns_mc_plugin = CHIMP_MC_Plugin::get_instance();



                $default_loader_graphic = get_template_directory_uri() . "/images/ajax-loader.gif";



                $this->default_loader_graphic = get_template_directory_uri() . "/images/ajax-loader.gif";



                add_action('parse_request', array(&$this, 'process_submission'));

                parent::__construct(

                        'chimp_MailChimp_Widget', // Base ID

                        __('Chimp: MailChimp List Signup'), // Name

                        array('classname' => 'widget_ns_mailchimp', 'description' => 'Displays a sign-up form for a MailChimp mailing list',) // Args

                );

            }



            /* private $default_failure_message;

              public $default_loader_graphic;

              private $default_signup_text;

              private $default_success_message;

              private $default_title;

              private $successful_signup = false;

              private $subscribe_errors;

              private $ns_mc_plugin;



              /**

             * @author James Lafferty

             * @since 0.1

             */

            /*  public function __construct() {



              parent::__construct(

              'chimp_MailChimp_Widget', // Base ID

              __('Chimp: MailChimp List Signup', 'Mercycorp'), // Name

              array('classname' => 'widget_ns_mailchimp', 'description' => 'Displays a sign-up form for a MailChimp mailing list',) // Args

              );

              }



              public function chimp_MailChimp_Widget() {

              $this->default_failure_message = __('There was a problem processing your submission.', 'Mercycorp');

              $this->default_signup_text = __('Join now!', 'Mercycorp');

              $this->default_success_message = __('Thank you for joining our mailing list. Please check your email for a confirmation link.', 'Mercycorp');

              $this->default_title = __('Sign up for our mailing list.', 'Mercycorp');

              $this->ns_mc_plugin = CHIMP_MC_Plugin::get_instance();

              $default_loader_graphic = get_template_directory_uri() . "/images/ajax-loader.gif";

              $this->default_loader_graphic = get_template_directory_uri() . "/images/ajax-loader.gif";

              add_action('parse_request', array(&$this, 'process_submission'));

              } */



            /**

             * @author James Lafferty

             * @since 0.1

             */

            public function form($instance) {

                $mcapi = $this->ns_mc_plugin->get_mcapi();

                if (false == $mcapi) {

                    echo $this->ns_mc_plugin->get_admin_notices();

                } else {

                    $this->lists = $mcapi->lists();

                    $defaults = array(

                        'failure_message' => $this->default_failure_message,

                        'title' => $this->default_title,

                        'signup_text' => $this->default_signup_text,

                        'success_message' => $this->default_success_message,

                        'collect_first' => false,

                        'collect_last' => false,

                        'old_markup' => false

                    );

                    $vars = wp_parse_args($instance, $defaults);

                    extract($vars);

                    ?>

                    <h3><?php echo __('General Settings', 'Mercycorp'); ?></h3>

                    <p>

                        <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title :', 'Mercycorp'); ?></label>

                        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />

                    </p>

                    <p>

                        <label for="<?php echo $this->get_field_id('current_mailing_list'); ?>"><?php echo __('Select a Mailing List :', 'Mercycorp'); ?></label>

                        <select class="widefat" id="<?php echo $this->get_field_id('current_mailing_list'); ?>" name="<?php echo $this->get_field_name('current_mailing_list'); ?>">

                <?php

                foreach ($this->lists['data'] as $key => $value) {

                    $selected = (isset($current_mailing_list) && $current_mailing_list == $value['id']) ? ' selected="selected" ' : '';

                    ?>	

                                <option <?php echo $selected; ?>value="<?php echo $value['id']; ?>"><?php echo __($value['name'], 'Mercycorp'); ?></option>

                    <?php

                }

                ?>

                        </select>

                    </p>

                    <p>

                        <label for="<?php echo $this->get_field_id('description'); ?>"><?php echo __('Description :', 'Mercycorp'); ?></label>

                        <textarea  class="widefat" name="<?php echo $this->get_field_name('description'); ?>" id="<?php echo $this->get_field_id('description'); ?>"  rows="4" cols="8"><?php echo $description; ?></textarea>

                    </p>



                    <p>

                        <label for="<?php echo $this->get_field_id('signup_text'); ?>"><?php echo __('Sign Up Button Text :', 'Mercycorp'); ?></label>

                        <input class="widefat" id="<?php echo $this->get_field_id('signup_text'); ?>" name="<?php echo $this->get_field_name('signup_text'); ?>" value="<?php echo $signup_text; ?>" />

                    </p>

                    <p>

                        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('collect_first'); ?>" name="<?php echo $this->get_field_name('collect_first'); ?>" <?php echo checked($collect_first, true, false); ?> />

                        <label for="<?php echo $this->get_field_id('collect_first'); ?>"><?php echo __('Collect first name.', 'Mercycorp'); ?></label>

                        <br />

                        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('collect_last'); ?>" name="<?php echo $this->get_field_name('collect_last'); ?>" <?php echo checked($collect_last, true, false); ?> />

                        <label><?php echo __('Collect last name.', 'Mercycorp'); ?></label>

                    </p>

                    <h3><?php echo __('Notifications', 'Mercycorp'); ?></h3>

                    <p><?php echo __('Use these fields to customize what your visitors see after they submit the form', 'Mercycorp'); ?></p>

                    <p>

                        <label for="<?php echo $this->get_field_id('success_message'); ?>"><?php echo __('Success :', 'Mercycorp'); ?></label>

                        <textarea class="widefat" id="<?php echo $this->get_field_id('success_message'); ?>" name="<?php echo $this->get_field_name('success_message'); ?>"><?php echo $success_message; ?></textarea>

                    </p>

                    <p>

                        <label for="<?php echo $this->get_field_id('failure_message'); ?>"><?php echo __('Failure :', 'Mercycorp'); ?></label>

                        <textarea class="widefat" id="<?php echo $this->get_field_id('failure_message'); ?>" name="<?php echo $this->get_field_name('failure_message'); ?>"><?php echo $failure_message; ?></textarea>

                    </p>

                    <?php

                }

            }



            /**

             * @author James Lafferty

             * @since 0.1

             */

            public function process_submission() {



                if (isset($_GET[$this->id_base . '_email'])) {



                    header("Content-Type: application/json");



                    //Assume the worst.

                    $response = '';

                    $result = array('success' => false, 'error' => $this->get_failure_message($_GET['ns_mc_number']));



                    $merge_vars = array();



                    if (!is_email($_GET[$this->id_base . '_email'])) { //Use WordPress's built-in is_email function to validate input.

                        $response = json_encode($result); //If it's not a valid email address, just encode the defaults.

                    } else {



                        $mcapi = $this->ns_mc_plugin->get_mcapi();



                        if (false == $this->ns_mc_plugin) {



                            $response = json_encode($result);

                        } else {



                            if (isset($_GET[$this->id_base . '_first_name']) && is_string($_GET[$this->id_base . '_first_name'])) {



                                $merge_vars['FNAME'] = $_GET[$this->id_base . '_first_name'];

                            }



                            if (isset($_GET[$this->id_base . '_last_name']) && is_string($_GET[$this->id_base . '_last_name'])) {



                                $merge_vars['LNAME'] = $_GET[$this->id_base . '_last_name'];

                            }



                            $subscribed = $mcapi->listSubscribe($this->get_current_mailing_list_id($_GET['ns_mc_number']), $_GET[$this->id_base . '_email'], $merge_vars);



                            if (false == $subscribed) {



                                $response = json_encode($result);

                            } else {



                                $result['success'] = true;

                                $result['error'] = '';

                                $result['success_message'] = $this->get_success_message($_GET['ns_mc_number']);

                                $response = json_encode($result);

                            }

                        }

                    }



                    exit($response);

                } elseif (isset($_POST[$this->id_base . '_email'])) {



                    $this->subscribe_errors = '<div class="error">' . $this->get_failure_message($_POST['ns_mc_number']) . '</div>';



                    if (!is_email($_POST[$this->id_base . '_email'])) {



                        return false;

                    }



                    $mcapi = $this->ns_mc_plugin->get_mcapi();



                    if (false == $mcapi) {



                        return false;

                    }



                    if (is_string($_POST[$this->id_base . '_first_name']) && '' != $_POST[$this->id_base . '_first_name']) {



                        $merge_vars['FNAME'] = strip_tags($_POST[$this->id_base . '_first_name']);

                    }



                    if (is_string($_POST[$this->id_base . '_last_name']) && '' != $_POST[$this->id_base . '_last_name']) {



                        $merge_vars['LNAME'] = strip_tags($_POST[$this->id_base . '_last_name']);

                    }



                    $subscribed = $mcapi->listSubscribe($this->get_current_mailing_list_id($_POST['ns_mc_number']), $_POST[$this->id_base . '_email'], $merge_vars);



                    if (false == $subscribed) {



                        return false;

                    } else {



                        $this->subscribe_errors = '';



                        setcookie($this->id_base . '-' . $this->number, $this->hash_mailing_list_id(), time() + 31556926);



                        $this->successful_signup = true;



                        $this->signup_success_message = '<p>' . $this->get_success_message($_POST['ns_mc_number']) . '</p>';



                        return true;

                    }

                }

            }



            /**

             * @author James Lafferty

             * @since 0.1

             */

            public function update($new_instance, $old_instance) {



                $instance = $old_instance;



                $instance['collect_first'] = !empty($new_instance['collect_first']);



                $instance['collect_last'] = !empty($new_instance['collect_last']);



                $instance['current_mailing_list'] = esc_attr($new_instance['current_mailing_list']);



                $instance['failure_message'] = esc_attr($new_instance['failure_message']);



                $instance['signup_text'] = esc_attr($new_instance['signup_text']);



                $instance['success_message'] = esc_attr($new_instance['success_message']);



                $instance['title'] = esc_attr($new_instance['title']);

                $instance['description'] = esc_attr($new_instance['description']);



                return $instance;

            }



            /**

             * @author James Lafferty

             * @since 0.1

             */

            public function widget($args, $instance) {



                extract($args);



                if ((isset($_COOKIE[$this->id_base . '-' . $this->number]) && $this->hash_mailing_list_id($this->number) == $_COOKIE[$this->id_base . '-' . $this->number]) || false == $this->ns_mc_plugin->get_mcapi()) {



                    return 0;

                } else {



                    echo $before_widget . $before_title . $instance['title'] . $after_title;



                    if ($this->successful_signup) {

                        echo $this->signup_success_message;

                    } else {

                        //cs_mailchimp_add_scripts ();

                        global $cs_theme_option;

                        ?>	

                        <p><?php echo $instance['description']; ?></p>

                        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="<?php echo $this->id_base . '_form-' . $this->number; ?>" method="post">

                                <?php echo $this->subscribe_errors; ?>

                            <?php

                            if ($instance['collect_first']) {

                                ?>	

                                <label><?php

                        if ($cs_theme_option['trans_switcher'] == "on") {

                            _e('First Name', 'Mercycorp');

                        } else {

                            echo $cs_theme_option['res_first_name'];

                        }

                        ?><input type="text" name="<?php echo $this->id_base . '_first_name'; ?>" /></label>

                                <br />

                        <?php

                    }

                    if ($instance['collect_last']) {

                        ?>	

                                <label><?php

                            if ($cs_theme_option['trans_switcher'] == "on") {

                                _e('Last Name', 'Mercycorp');

                            } else {

                                echo $cs_theme_option['res_last_name'];

                            }

                            ?><input type="text" name="<?php echo $this->id_base . '_last_name'; ?>" /></label>

                                <br />

                            <?php

                        }

                        ?>

                            <input type="hidden" name="ns_mc_number" value="<?php echo $this->number; ?>" />

                            <label for="<?php echo $this->id_base; ?>-email-<?php echo $this->number; ?>"><?php _e('Email', 'Mercycorp'); ?></label>

                            <input id="<?php echo $this->id_base; ?>-email-<?php echo $this->number; ?>" type="text" name="<?php echo $this->id_base; ?>_email" />

                            <input class="button" type="submit" name="<?php echo __($instance['signup_text'], 'Mercycorp'); ?>" value="<?php echo __($instance['signup_text'], 'Mercycorp'); ?>" />

                        </form>

                        <script type="text/javascript">

                            jQuery(document).ready(function () {

                                cs_mailchimp_add_scripts();

                                jQuery('#<?php echo $this->id_base; ?>_form-<?php echo $this->number; ?>').ns_mc_widget({"url": "<?php echo $_SERVER['PHP_SELF']; ?>", "cookie_id": "<?php echo $this->id_base; ?>-<?php echo $this->number; ?>", "cookie_value": "<?php echo $this->hash_mailing_list_id(); ?>", "loader_graphic": "<?php echo $this->default_loader_graphic; ?>"});

                                    });

                        </script>

                        <?php

                    }

                    echo $after_widget;

                }

            }



            /**

             * @author James Lafferty

             * @since 0.1

             */

            private function hash_mailing_list_id() {



                $options = get_option($this->option_name);



                $hash = md5($options[$this->number]['current_mailing_list']);



                return $hash;

            }



            /**

             * @author James Lafferty

             * @since 0.1

             */

            private function get_current_mailing_list_id($number = null) {



                $options = get_option($this->option_name);



                return $options[$number]['current_mailing_list'];

            }



            /**

             * @author James Lafferty

             * @since 0.5

             */

            private function get_failure_message($number = null) {



                $options = get_option($this->option_name);



                return $options[$number]['failure_message'];

            }



            /**

             * @author James Lafferty

             * @since 0.5

             */

            private function get_success_message($number = null) {



                $options = get_option($this->option_name);



                return $options[$number]['success_message'];

            }



        }



    }

    add_action('widgets_init', create_function('', 'return register_widget("chimp_MailChimp_Widget");'));



    $args = array(

        'default-color' => '',

        'default-image' => '',

    );

    add_theme_support('custom-background', $args);

    add_theme_support('custom-header', $args);



// This theme styles the visual editor with editor-style.css to match the theme style.

    add_editor_style();



// This theme uses post thumbnails

    add_theme_support('post-thumbnails');



// Add default posts and comments RSS feed links to head

    add_theme_support('automatic-feed-links');



// Make theme available for translation

// Translations can be filed in the /languages/ directory

    load_theme_textdomain('Mercycorp', get_template_directory() . '/languages');



//	$locale = get_locale();

//	$locale_file = get_template_directory() . "/languages/$locale.php";

//	if ( is_readable( $locale_file ) )

//		require_once( $locale_file );





    if (!isset($content_width))

        $content_width = 1170;



    function calender_time($event_time) {

        //$event_time = str_replace(':', '', $event_time).'00';

        $event_time = str_replace('am', '', $event_time);

        $event_time = str_replace('pm', '', $event_time);

        if (strlen($event_time) < 6) {

            $event_time = '0' . $event_time;

        }

        return $event_time; // Removes special chars.

    }



    function get_formated_date($date) {

        return mysql2date(get_option('date_format'), $date);

    }



    function get_formated_time($time) {

        return mysql2date(get_option('time_format'), $time, $translate = true);

        ;

    }



    function add_to_calender($post_id = '') {

        global $post, $cs_theme_option;

        // $cs_theme_option = get_option('cs_theme_option');

        $calendar_args = array('outlook' => 1, 'google_calender' => 1, 'yahoo_calender' => 1, 'ical_cal' => 1);

        if ($calendar_args) {

            $calendar_url = cs_event_calendar($post->ID);

            ?>

            <div class="sortby">

                <div class="sorted-link"> <a><i class="icon-calendar"></i><?php

                    if ($cs_theme_option['trans_switcher'] == "on") {

                        _e('Add to Calendar', 'Mercycorp');

                    } else {

                        echo $cs_theme_option['trans_add_to_calendar'];

                    }

                    ?> </a> </div>

                <ul>

                            <?php if ($calendar_args['outlook']) { ?><li class="i_calendar"><a href="<?php echo $calendar_url['ical']; ?>"> <?php

                                if ($cs_theme_option['trans_switcher'] == "on") {

                                    _e('Outlook Calendar', 'Mercycorp');

                                } else {

                                    echo $cs_theme_option['trans_outlook_calendar'];

                                }

                                ?></a> </li><?php } ?>

        <?php if ($calendar_args['google_calender']) { ?><li class="i_google"><a href="<?php echo $calendar_url['google']; ?>" target="_blank"> <?php

            if ($cs_theme_option['trans_switcher'] == "on") {

                _e('Google Calendar', 'Mercycorp');

            } else {

                echo $cs_theme_option['trans_google_calendar'];

            }

            ?> </a> </li><?php } ?>

            <?php if ($calendar_args['yahoo_calender']) { ?><li class="i_yahoo"><a href="<?php echo $calendar_url['yahoo']; ?>" target="_blank"><?php

                if ($cs_theme_option['trans_switcher'] == "on") {

                    _e('Yahoo Calendar', 'Mercycorp');

                } else {

                    echo $cs_theme_option['trans_yahoo_calendar'];

                }

                ?></a> </li><?php } ?>

            <?php if ($calendar_args['ical_cal']) { ?><li class="i_calendar"><a href="<?php echo $calendar_url['ical']; ?>"> <?php

                if ($cs_theme_option['trans_switcher'] == "on") {

                    _e('iCal Calendar', 'Mercycorp');

                } else {

                    echo $cs_theme_option['trans_ical_calendar'];

                }

                ?> </a> </li><?php } ?>

                </ul>

            </div>



            <?php

        }

    }



    /* 	Function to get the events info on calander -- START	 */



    function cs_event_calendar($post_id = '') {



        if (!isset($post_id) && $post_id == '') {

            global $post;

            $post_id = $post->ID;

        }

        $cal_post = get_post($post_id);

        if ($cal_post) {

            $event_from_date = get_post_meta($post_id, "cs_event_from_date", true);

            $cs_event_to_date = get_post_meta($post_id, "cs_event_to_date", true);

            $cs_event_meta = get_post_meta($post_id, "cs_event_meta", true);

            if ($cs_event_meta <> "") {

                $cs_event_meta = new SimpleXMLElement($cs_event_meta);

                if ($cs_event_meta->event_address <> '') {

                    $address_map = get_the_title("$cs_event_meta->event_address");

                } else {

                    $address_map = '';

                }

            }

            $cs_event_loc = get_post_meta($cs_event_meta->event_address, "cs_event_loc_meta", true);

            if ($cs_event_loc <> "") {

                $cs_xmlObject = new SimpleXMLElement($cs_event_loc);

                $loc_address = $cs_xmlObject->loc_address;

                $event_loc_lat = $cs_xmlObject->event_loc_lat;

                $event_loc_long = $cs_xmlObject->event_loc_long;

                $event_loc_zoom = $cs_xmlObject->event_loc_zoom;

                $loc_city = $cs_xmlObject->loc_city;

                $loc_postcode = $cs_xmlObject->loc_postcode;

                $loc_country = $cs_xmlObject->loc_country;

                $location = $loc_address . ', ' . $loc_city . ', ' . $loc_postcode . ', ' . $loc_country;

            } else {

                $loc_address = '';

                $event_loc_lat = '';

                $event_loc_long = '';

                $event_loc_zoom = '';

                $loc_city = '';

                $loc_postcode = '';

                $loc_country = '';

                $location = '';

            }





            $start_year = date('Y', strtotime($event_from_date));

            $start_month = date('m', strtotime($event_from_date));

            $start_day = date('d', strtotime($event_from_date));



            $end_year = date('Y', strtotime($cs_event_to_date));

            $end_month = date('m', strtotime($cs_event_to_date));

            $end_day = date('d', strtotime($cs_event_to_date));

            if ($cs_event_meta->event_all_day != "on") {

                $start_time = calender_time($cs_event_meta->event_start_time);

                $end_time = calender_time($cs_event_meta->event_end_time);

            } else {

                $start_time = $end_time = '';

            }

            if (($start_time != '') && ($start_time != ':')) {

                $event_start_time = explode(":", $start_time);

            }

            if (($end_time != '') && ($end_time != ':')) {

                $event_end_time = explode(":", $end_time);

            }



            $post_title = get_the_title($post_id);

            $cs_vcalendar = new vcalendar();

            $cs_vevent = new vevent();

            $site_info = get_bloginfo('name') . 'Events';

            $cs_vevent->setProperty('categories', $site_info);



            if (isset($event_start_time)) {

                @$cs_vevent->setProperty('dtstart', @$start_year, @$start_month, @$start_day, @$event_start_time[0], @$event_start_time[1], 00);

            } else {

                $cs_vevent->setProperty('dtstart', $start_year, $start_month, $start_day);

            } // YY MM dd hh mm ss

            if (isset($event_end_time)) {

                @$cs_vevent->setProperty('dtend', $end_year, $end_month, $end_day, $event_end_time[0], $event_end_time[1], 00);

            } else {

                $cs_vevent->setProperty('dtend', $end_year, $end_month, $end_day);

            } // YY MM dd hh mm ss

            $cs_vevent->setProperty('description', strip_tags($cal_post->post_excerpt));

            if (isset($location)) {

                $cs_vevent->setProperty('location', $location);

            }

            $cs_vevent->setProperty('summary', $post_title);

            $cs_vcalendar->addComponent($cs_vevent);

            $templateurl = get_template_directory_uri() . '/cache/';

            //makeDir(get_bloginfo('template_directory').'/cache/');

            $home = home_url();

            $dir = str_replace($home, '', $templateurl);

            $dir = str_replace('/wp-content/', 'wp-content/', $dir);

            $cs_vcalendar->setConfig('directory', $dir);

            //$cs_vcalendar->setConfig( 'directory', ABSPATH .'wp-content/themes/mercycorp/cache' ); 

            $cs_vcalendar->setConfig('filename', 'event-' . $post_id . '.ics');

            $cs_vcalendar->saveCalendar();

            ////OUT LOOK & iCAL URL//

            $output_calendar_url['ical'] = $templateurl . 'event-' . $post_id . '.ics';

            ////GOOGLE URL//

            $google_url = "https://www.google.com/calendar/event?action=TEMPLATE";

            $google_url .= "&text=" . urlencode($post_title);

            if (isset($event_start_time) && isset($event_end_time)) {

                $google_url .= "&dates=" . @$start_year . @$start_month . @$start_day . "T" . str_replace('.', '', @$event_start_time[0]) . str_replace('.', '', @$event_start_time[1]) . "00/" . @$end_year . @$end_month . @$end_day . "T" . str_replace('.', '', @$event_end_time[0]) . str_replace('.', '', @$event_end_time[1]) . "00";

            } else {

                $google_url .= "&dates=" . $start_year . $start_month . $start_day . "/" . $end_year . $end_month . $end_day;

            }

            $google_url .= "&sprop=website:" . get_permalink($post_id);

            $google_url .= "&details=" . strip_tags($cal_post->post_excerpt);

            if (isset($location)) {

                $google_url .= "&location=" . $location;

            } else {

                $google_url .= "&location=Unknown";

            }

            $google_url .= "&trp=true";

            $output_calendar_url['google'] = $google_url;

            ////YAHOO CALENDAR URL///

            $yahoo_url = "https://calendar.yahoo.com/?v=60&view=d&type=20";

            $yahoo_url .= "&title=" . str_replace(' ', '+', $post_title);

            if (isset($event_start_time)) {

                $yahoo_url .= "&st=" . @$start_year . @$start_month . @$start_day . "T" . @$event_start_time[0] . @$event_start_time[1] . "00";

            } else {

                $yahoo_url .= "&st=" . $start_year . $start_month . $start_day;

            }

            if (isset($event_end_time)) {

                //$yahoo_url .= "&dur=".$event_start_time[0].$event_start_time[1];

            }

            $yahoo_url .= "&desc=" . str_replace(' ', '+', strip_tags($cal_post->post_excerpt)) . ' -- ' . get_permalink($post_id);

            $yahoo_url .= "&in_loc=" . str_replace(' ', '+', $location);

            $output_calendar_url['yahoo'] = $yahoo_url;

        }

        return $output_calendar_url;

    }



    /* 	Function to get the events info on calander -- END	 */

    ?>