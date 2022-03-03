<?php

//include(get_template_directory_uri().'/include/global_variables.php');

include (get_template_directory() . '/include/global_variables.php');

if(! function_exists('cs_comment_tut_fields')){

function cs_comment_tut_fields() {



    $you_may_use = __('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'Mercycorp');

    $cs_comment_opt_array = array(

        'std' => '',

        'id' => '',

        'classes' => 'commenttextarea',

        'extra_atr' => ' rows="55" cols="15"',

        'cust_id' => 'comment_mes',

        'cust_name' => 'comment',

        'return' => true,

        'required' => false

    );

    $html = '<p class="comment-form-comment fullwidth">' .

            '<label for="comment">' . __('Comment:', 'Mercycorp') . '<span>' . __('(required)', 'Mercycorp') . '</span></label>' .

            '<textarea id="comment" name="comment"  class="commenttextarea" rows="4" cols="39"></textarea>' .

            '</p>';

    echo force_balance_tags($html);

}

}

if(! function_exists('cs_filter_comment_form_field_comment')){

function cs_filter_comment_form_field_comment($field) {



    return '';

}

}

add_filter( 'wp_mail_from', function() {

    return 'geral@freguesiaalmagreira.com';

} );

// add the filter

add_filter('comment_form_field_comment', 'cs_filter_comment_form_field_comment', 10, 1);



add_action('comment_form_logged_in_after', 'cs_comment_tut_fields');

add_action('comment_form_after_fields', 'cs_comment_tut_fields');

// tgm class for (internal and WordPress repository) plugin activation start

require_once dirname(__FILE__) . '/include/tgm_plugin_activation.php';

add_action('tgmpa_register', 'cs_register_required_plugins');







add_theme_support("title-tag");

if(! function_exists('cs_register_required_plugins')){

function cs_register_required_plugins() {

    /**

     * Array of plugin arrays. Required keys are name and slug.

     * If the source is NOT from the .org repo, then source is also required.

     */

    $plugins = array(

        // This is an example of how to include a plugin pre-packaged with a theme

        array(

            'name' => 'Revolution Slider',

            'slug' => 'revslider',

            'source' => 'https://chimpgroup.com/wp-demo/download-plugin/revslider.zip',

            'required' => false,

            'version' => '',

            'force_activation' => false,

            'force_deactivation' => false,

            'external_url' => '',

        ),

            // This is an example of how to include a plugin from the WordPress Plugin Repository

    );

    // Change this to your theme text domain, used for internationalising strings

    $theme_text_domain = 'Mercycorp';

    /**

     * Array of configuration settings. Amend each line as needed.

     * If you want the default strings to be available under your own theme domain,

     * leave the strings uncommented.

     * Some of the strings are added into a sprintf, so see the comments at the

     * end of each line for what each argument will be.

     */

    $config = array(

        'domain' => $theme_text_domain, // Text domain - likely want to be the same as your theme.

        'default_path' => '', // Default absolute path to pre-packaged plugins

        'parent_menu_slug' => 'themes.php', // Default parent menu slug

        'parent_url_slug' => 'themes.php', // Default parent URL slug

        'menu' => 'install-required-plugins', // Menu slug

        'has_notices' => true, // Show admin notices or not

        'is_automatic' => true, // Automatically activate plugins after installation or not

        'message' => '', // Message to output right before the plugins table

        'strings' => array(

            'page_title' => __('Install Required Plugins', $theme_text_domain),

            'menu_title' => __('Install Plugins', $theme_text_domain),

            'installing' => __('Installing Plugin: %s', $theme_text_domain), // %1$s = plugin name

            'oops' => __('Something went wrong with the plugin API.', $theme_text_domain),

            'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.'), // %1$s = plugin name(s)

            'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.'), // %1$s = plugin name(s)

            'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.'), // %1$s = plugin name(s)

            'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)

            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)

            'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.'), // %1$s = plugin name(s)

            'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.'), // %1$s = plugin name(s)

            'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.'), // %1$s = plugin name(s)

            'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins'),

            'activate_link' => _n_noop('Activate installed plugin', 'Activate installed plugins'),

            'return' => __('Return to Required Plugins Installer', $theme_text_domain),

            'plugin_activated' => __('Plugin activated successfully.', $theme_text_domain),

            'complete' => __('All plugins installed and activated successfully. %s', $theme_text_domain), // %1$s = dashboard link

            'nag_type' => 'updated' // Determines admin notice type - can only be 'updated' or 'error'

        )

    );

    tgmpa($plugins, $config);

}

}

// tgm class for (internal and WordPress repository) plugin activation end

// Paypal Button

if(! function_exists('cs_donate_button')){

function cs_donate_button($cause_paypal_email = '') {

    global $post, $cs_theme_option;

    if (isset($cause_paypal_email) && $cause_paypal_email <> '') {

        $cs_cause_paypal_email = $cause_paypal_email;

    } else {

        $cs_cause_paypal_email = $cs_theme_option['paypal_email'];

    }

    if ($cs_theme_option['trans_switcher'] == "on") {

        $cause_donate = __('Donate', 'Mercycorp');

    } else {

        $cause_donate = $cs_theme_option['cause_donate'];

    }

    $paypal_content_button = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">  

		<input type="hidden" name="cmd" value="_xclick">  

		<input type="hidden" name="business" value="' . $cs_cause_paypal_email . '">

		<input type="hidden" type="text" name="amount">  

		<input type="hidden" name="item_name" value="' . get_the_title() . '"> 

		<input type="hidden" name="no_shipping" value="2">

		<input type="hidden" name="item_number" value="' . $post->ID . '">  

		<input name = "cancel_return" value = "' . get_permalink($post->ID) . '" type = "hidden">  

		<input type="hidden" name="no_note" value="1">  

		<input type="hidden" name="currency_code" value="' . $cs_theme_option['paypal_currency'] . '">  

		<input type="hidden" name="notify_url" value="' . $cs_theme_option['paypal_ipn_url'] . '">

		<input type="hidden" name="lc" value="AU">  

		<input type="hidden" name="return" value="' . get_permalink($post->ID) . '">  

		<span class="donate-btn backcolr"><i class="icon-credit-card"></i><input type="submit" value="' . $cause_donate . '"> </span>

	</form> ';

    echo $paypal_content_button;

}

}

if(! function_exists('cs_add_transaction_detail')){

function cs_add_transaction_detail() {

    if (isset($_POST['item_number']) && isset($_POST['txn_id'])) {

        $trnx_exit = 0;

        $item_number = $_POST['item_number'];

        $cs_cause = get_post_meta($item_number, "cs_cause_transaction", true);

        //global $cs_xmlObject;

        $sxe = new SimpleXMLElement("<cause></cause>");

        $cs_counter = 0;

        if (isset($_POST['txn_id'])) {

            if ($cs_cause <> "") {

                $cs_xmlObject = new SimpleXMLElement($cs_cause);

            }

            if (isset($cs_xmlObject->transaction) && count($cs_xmlObject->transaction) > 0) {

                foreach ($cs_xmlObject->transaction as $trans) {

                    $track = $sxe->addChild('transaction');

                    if ($trans->txn_id == $_POST['txn_id']) {

                        $trnx_exit = 1;

                    }

                    $track->addChild('txn_id', $trans->txn_id);

                    $track->addChild('item_number', $trans->item_number);

                    $track->addChild('payer_id', $trans->payer_id);

                    $track->addChild('payment_date', $trans->payment_date);

                    $track->addChild('payer_email', $trans->payer_email);

                    $track->addChild('payment_gross', $trans->payment_gross);

                    $track->addChild('address_name', $trans->address_name);

                }

            }

            if ($trnx_exit <> '1') {

                $track = $sxe->addChild('transaction');

                $track->addChild('txn_id', htmlspecialchars($_POST['txn_id']));

                $track->addChild('item_number', htmlspecialchars($_POST['item_number']));

                $track->addChild('payer_id', htmlspecialchars($_POST['payer_id']));

                $track->addChild('item_number', htmlspecialchars($_POST['item_number']));

                $track->addChild('payment_date', htmlspecialchars($_POST['payment_date']));

                $track->addChild('payer_email', htmlspecialchars($_POST['payer_email']));

                $track->addChild('payment_gross', htmlspecialchars($_POST['payment_gross']));

                $track->addChild('address_name', htmlspecialchars($_POST['address_name']));

            }

        }

        update_post_meta($item_number, 'cs_cause_transaction', $sxe->asXML());

    }

}

}

if(! function_exists('cs_paypal_ipn')){

function cs_paypal_ipn() {



    if ($_REQUEST['ipn_request'] == 'true') {

        // PHP 4.1

        // read the post from PayPal system and add 'cmd'

        $req = 'cmd=_notify-validate';



        foreach ($_POST as $key => $value) {

            $value = urlencode(stripslashes($value));

            $req .= "&$key=$value";

        }

        update_post_meta($_POST['item_number'], 'cs_cause_transaction_txn', $_POST['txn_id']);

        // post back to PayPal system to validate

        $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";

        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";

        $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

        $fp = fsockopen('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);



        // assign posted variables to local variables

        $item_name = $_POST['item_name'];

        $item_number = $_POST['item_number'];

        $payment_status = $_POST['payment_status'];

        $payment_amount = $_POST['mc_gross'];

        $payment_currency = $_POST['mc_currency'];

        $txn_id = $_POST['txn_id'];

        $receiver_email = $_POST['receiver_email'];

        $payer_email = $_POST['payer_email'];



        if (!$fp) {

            // HTTP ERROR

        } else {

            fputs($fp, $header . $req);

            while (!feof($fp)) {

                $res = fgets($fp, 1024);

                if (strcmp($res, "VERIFIED") == 0) {

                    $trnx_exit = 0;

                    $item_number = $_POST['item_number'];

                    $cs_cause = get_post_meta($item_number, "cs_cause_transaction_ipn", true);

                    //global $cs_xmlObject;

                    $sxe = new SimpleXMLElement("<cause></cause>");

                    $cs_counter = 0;

                    if (isset($_POST['txn_id'])) {

                        if ($cs_cause <> "") {

                            $cs_xmlObject = new SimpleXMLElement($cs_cause);

                        }

                        if (isset($cs_xmlObject->transaction) && count($cs_xmlObject->transaction) > 0) {

                            foreach ($cs_xmlObject->transaction as $trans) {

                                $track = $sxe->addChild('transaction');

                                if ($trans->txn_id == $_POST['txn_id']) {

                                    $trnx_exit = 1;

                                }

                                $track->addChild('txn_id', $trans->txn_id);

                                $track->addChild('item_number', $trans->item_number);

                                $track->addChild('payer_id', $trans->payer_id);

                                $track->addChild('payment_date', $trans->payment_date);

                                $track->addChild('payer_email', $trans->payer_email);

                                $track->addChild('payment_gross', $trans->payment_gross);

                                $track->addChild('address_name', $trans->address_name);

                            }

                        }

                        if ($trnx_exit <> '1') {

                            $track = $sxe->addChild('transaction');

                            $track->addChild('txn_id', htmlspecialchars($_POST['txn_id']));

                            $track->addChild('item_number', htmlspecialchars($_POST['item_number']));

                            $track->addChild('payer_id', htmlspecialchars($_POST['payer_id']));

                            $track->addChild('item_number', htmlspecialchars($_POST['item_number']));

                            $track->addChild('payment_date', htmlspecialchars($_POST['payment_date']));

                            $track->addChild('payer_email', htmlspecialchars($_POST['payer_email']));

                            $track->addChild('payment_gross', htmlspecialchars($_POST['payment_gross']));

                            $track->addChild('address_name', htmlspecialchars($_POST['address_name']));

                        }

                    }

                    update_post_meta($_POST['item_number'], 'cs_cause_transaction_ipn', $sxe->asXML());





                    // check the payment_status is Completed

                    // check that txn_id has not been previously processed

                    // check that receiver_email is your Primary PayPal email

                    // check that payment_amount/payment_currency are correct

                    // process payment

                } else if (strcmp($res, "INVALID") == 0) {

                    // log for manual investigation

                }

            }

            fclose($fp);

        }

    }

}

}

if(! function_exists('add_social_icon')){



function add_social_icon() {

    $template_path = get_template_directory_uri() . '/scripts/admin/media_upload.js';

    wp_enqueue_script('my-upload2', $template_path, array('jquery', 'media-upload', 'thickbox', 'jquery-ui-droppable', 'jquery-ui-datepicker', 'jquery-ui-slider', 'wp-color-picker'));



    echo '<tr id="del_' . $_POST['counter_social_network'] . '"> 

		<td><img width="50" src="' . $_POST['social_net_icon_path'] . '"></td> 

		<td>' . $_POST['social_net_url'] . '</td> 

		<td class="centr"> 

			<a onclick="javascript:return confirm(\'Are you sure! You want to delete this\')" href="javascript:social_icon_del(' . $_POST['counter_social_network'] . ')">Del</a> 

			| <a href="javascript:cs_toggle(' . $_POST['counter_social_network'] . ')">Edit</a>

		</td> 

	</tr> 

	<tr id="' . $_POST['counter_social_network'] . '" style="display:none"> 

		<td colspan="3"> 

			<ul class="form-elements">

				<li class="to-label"><label>' . __('Icon Path', 'Mercycorp') . '</label></li>

				<li class="to-field">

				  <input id="social_net_icon_path' . $_POST['counter_social_network'] . '" name="social_net_icon_path[]" value="' . $_POST['social_net_icon_path'] . '" type="text" class="small" /> 

				</li>

				<li><a onclick="cs_toggle(' . $_POST['counter_social_network'] . ')"><img src="' . get_template_directory_uri() . '/images/admin/close-red.png"></a></li>

				<li class="full">&nbsp;</li>

				<li class="to-label"><label>' . __('Awesome Font', 'Mercycorp') . '</label></li>

				<li class="to-field">

				  <input class="small" type="text" id="social_net_awesome" name="social_net_awesome[]" value="' . $_POST['social_net_awesome'] . '" style="width:420px;" />

				  <p>' . __('Put Awesome Font Code like "icon-flag"', 'Mercycorp') . '</p>

				</li>

				<li class="full">&nbsp;</li>

				<li class="to-label"><label>' . __('Url', 'Mercycorp') . '</label></li>

				<li class="to-field">

				  <input class="small" type="text" id="social_net_url" name="social_net_url[]" value="' . $_POST['social_net_url'] . '" style="width:420px;" />

				  <p>' . __('Please enter Full Url', 'Mercycorp') . '</p>

				</li>

				<li class="full">&nbsp;</li>

				<li class="to-label"><label>' . __('Title', 'Mercycorp') . '</label></li>

				<li class="to-field">

				  <input class="small" type="text" id="social_net_tooltip" name="social_net_tooltip[]" value="' . $_POST['social_net_tooltip'] . '" style="width:420px;" />

				  <p>' . __('Please enter text for icon tooltip', 'Mercycorp') . '</p>

				</li>

			</ul>

		</td> 

	</tr>';

    die;

}

}

add_action('wp_ajax_add_social_icon', 'add_social_icon');



// media pagination for slider/gallery in admin side start

if(! function_exists('media_pagination')){

function media_pagination() {

    foreach ($_REQUEST as $keys => $values) {

        $$keys = $values;

    }

    $records_per_page = 10;

    if (empty($page_id))

        $page_id = 1;

    $offset = $records_per_page * ($page_id - 1);

    ?>

    <ul class="gal-list">

        <?php

        $query_images_args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_status' => 'inherit', 'posts_per_page' => -1,);

        $query_images = new WP_Query($query_images_args);

        if (empty($total_pages))

            $total_pages = count($query_images->posts);

        $query_images_args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_status' => 'inherit', 'posts_per_page' => $records_per_page, 'offset' => $offset,);

        $query_images = new WP_Query($query_images_args);

        $images = array();

        foreach ($query_images->posts as $image) {

            $image_path = wp_get_attachment_image_src((int) $image->ID, array(get_option("thumbnail_size_w"), get_option("thumbnail_size_h")));

            ?>

            <li style="cursor:pointer"><img src="<?php echo $image_path[0] ?>" onclick="javascript:clone('<?php echo $image->ID ?>')" alt="" /></li>

            <?php

        }

        ?>

    </ul>

    <br />

    <div class="pagination-cus">

        <ul>

            <?php

            if ($page_id > 1)

                echo "<li><a href='javascript:show_next(" . ($page_id - 1) . ",$total_pages)'>Prev</a></li>";

            for ($i = 1; $i <= ceil($total_pages / $records_per_page); $i++) {

                if ($i <> $page_id)

                    echo "<li><a href='javascript:show_next($i,$total_pages)'>" . $i . "</a></li> ";

                else

                    echo "<li class='active'><a>" . $i . "</a></li>";

            }

            if ($page_id < $total_pages / $records_per_page)

                echo "<li><a href='javascript:show_next(" . ($page_id + 1) . ",$total_pages)'>Next</a></li>";

            ?>

        </ul>

    </div>

    <?php

    if (isset($_POST['action']))

        die();

}

}

add_action('wp_ajax_media_pagination', 'media_pagination');



// media pagination for slider/gallery in admin side end

// to make a copy of media image for slider start

if(! function_exists('cs_slider_clone')){

function cs_slider_clone() {

    global $cs_node, $cs_counter;

    if (isset($_POST['action'])) {

        $cs_node = new stdClass();

        $cs_node->title = '';

        $cs_node->description = '';

        $cs_node->link = '';

        $cs_node->link_target = '';

        $cs_node->use_image_as = '';

        $cs_node->video_code = '';

    }

    if (isset($_POST['counter']))

        $cs_counter = $_POST['counter'];

    if (isset($_POST['path']))

        $cs_node->path = $_POST['path'];

    ?>

    <li class="ui-state-default" id="<?php echo $cs_counter ?>">

        <div class="thumb-secs">

            <?php $image_path = wp_get_attachment_image_src((int) $cs_node->path, array(get_option("thumbnail_size_w"), get_option("thumbnail_size_h"))); ?>

            <img src="<?php echo $image_path[0] ?>" alt="">

            <div class="gal-edit-opts">

                <!--<a href="#" class="resize"></a>-->

                <a href="javascript:slidedit(<?php echo $cs_counter ?>)" class="edit"></a>

                <a href="javascript:del_this(<?php echo $cs_counter ?>)" class="delete"></a>

            </div>

        </div>

        <div class="poped-up" id="edit_<?php echo $cs_counter ?>">

            <div class="opt-head">

                <h5><?php _e('Edit Options', 'Mercycorp'); ?></h5>

                <a href="javascript:slideclose(<?php echo $cs_counter ?>)" class="closeit">&nbsp;</a>

                <div class="clear"></div>

            </div>

            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Image Title', 'Mercycorp'); ?></label></li>

                    <li class="to-field"><input type="text" name="cs_slider_title[]" value="<?php echo htmlspecialchars($cs_node->title) ?>" class="txtfield" /></li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Image Description', 'Mercycorp'); ?></label></li>

                    <li class="to-field"><textarea class="txtarea" name="cs_slider_description[]"><?php echo htmlspecialchars($cs_node->description) ?></textarea></li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Link', 'Mercycorp'); ?></label></li>

                    <li class="to-field"><input type="text" name="cs_slider_link[]" value="<?php echo htmlspecialchars($cs_node->link) ?>" class="txtfield" /></li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Link Target', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cs_slider_link_target[]" class="select_dropdown">

                            <option <?php if ($cs_node->link_target == "_self") echo "selected"; ?> >_self</option>

                            <option <?php if ($cs_node->link_target == "_blank") echo "selected"; ?> >_blank</option>

                        </select>

                        <p><?php _e('Please select image target', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"></li>

                    <li class="to-field">

                        <input type="hidden" name="path[]" value="<?php echo $cs_node->path ?>" />

                        <input type="button" value="<?php _e('Submit', 'Mercycorp'); ?>" onclick="javascript:slideclose(<?php echo $cs_counter ?>)" class="close-submit" />

                    </li>

                </ul>

                <div class="clear"></div>

            </div>

        </div>

    </li>

    <?php

    if (isset($_POST['action']))

        die();

}

}

add_action('wp_ajax_slider_clone', 'cs_slider_clone');



// to make a copy of media image for slider end

// to make a copy of media image for gallery start

if(! function_exists('albums_clone')){

function albums_clone() {

    global $cs_node, $cs_counter;

    if (isset($_POST['action'])) {

        $cs_node = new stdClass();

        $cs_node->title = "";

        $cs_node->description = "";

        $cs_node->use_image_as = "";

        $cs_node->video_code = "";

        $cs_node->link_url = "";

        $cs_node->use_image_as_db = "";

        $cs_node->link_url_db = '';

    }

    if (isset($_POST['counter']))

        $cs_counter = $_POST['counter'];

    if (isset($_POST['path']))

        $cs_node->path = $_POST['path'];

    ?>

    <li class="ui-state-default" id="<?php echo $cs_counter ?>">

        <div class="thumb-secs">

            <?php $image_path = wp_get_attachment_image_src((int) $cs_node->path, array(get_option("thumbnail_size_w"), get_option("thumbnail_size_h"))); ?>

            <img src="<?php echo $image_path[0] ?>" alt="">

            <div class="gal-edit-opts">

                <!--<a href="#" class="resize"></a>-->

                <a href="javascript:galedit(<?php echo $cs_counter ?>)" class="edit"></a>

                <a href="javascript:del_this(<?php echo $cs_counter ?>)" class="delete"></a>

            </div>

        </div>

        <div class="poped-up" id="edit_<?php echo $cs_counter ?>">

            <div class="opt-head">

                <h5><?php _e('Edit Options', 'Mercycorp'); ?></h5>

                <a href="javascript:galclose(<?php echo $cs_counter ?>)" class="closeit">&nbsp;</a>

            </div>

            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Image Title', 'Mercycorp'); ?></label></li>

                    <li class="to-field"><input type="text" name="title[]" value="<?php echo htmlspecialchars($cs_node->title) ?>" class="txtfield" /></li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Image Description', 'Mercycorp'); ?></label></li>

                    <li class="to-field"><textarea class="txtarea" name="description[]"><?php echo htmlspecialchars($cs_node->description) ?></textarea></li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Use Image As', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="use_image_as[]" class="select_dropdown" onchange="cs_toggle_gal(this.value, <?php echo $cs_counter ?>)">

                            <option <?php if ($cs_node->use_image_as == "0") echo "selected"; ?> value="0"><?php _e('LightBox to current thumbnail', 'Mercycorp'); ?></option>

                            <option <?php if ($cs_node->use_image_as == "1") echo "selected"; ?> value="1"><?php _e('LightBox to Video', 'Mercycorp'); ?></option>

                            <option <?php if ($cs_node->use_image_as == "2") echo "selected"; ?> value="2"><?php _e('Url', 'Mercycorp'); ?></option>

                        </select>

                        <p><?php _e('Please select Image link where it will go', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements" id="video_code<?php echo $cs_counter ?>" <?php if ($cs_node->use_image_as == "0" or $cs_node->use_image_as == "" or $cs_node->use_image_as == "2") echo 'style="display:none"'; ?> >

                    <li class="to-label"><label><?php _e('Video Url', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="video_code[]" value="<?php echo htmlspecialchars($cs_node->video_code) ?>" class="txtfield" />

                        <p><?php _e('(Enter Specific Video Url Youtube or Vimeo)', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements" id="link_url<?php echo $cs_counter ?>" <?php if ($cs_node->use_image_as == "0" or $cs_node->use_image_as == "" or $cs_node->use_image_as == "1") echo 'style="display:none"'; ?> >

                    <li class="to-label"><label><?php _e('Link', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="link_url[]" value="<?php echo htmlspecialchars($cs_node->link_url) ?>" class="txtfield" />

                        <p><?php _e('(Enter Specific Link)', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"></li>

                    <li class="to-field">

                        <input type="hidden" name="path[]" value="<?php echo $cs_node->path ?>" />

                        <input type="button" onclick="javascript:galclose(<?php echo $cs_counter ?>)" value="<?php _e('Submit', 'Mercycorp'); ?>" class="close-submit" />

                    </li>

                </ul>

                <div class="clear"></div>

            </div>

        </div>

    </li>

    <?php

    if (isset($_POST['action']))

        die();

}

}

add_action('wp_ajax_gallery_clone', 'albums_clone');



// to make a copy of media image for gallery end

// stripslashes / htmlspecialchars for theme option save start

if(! function_exists('stripslashes_htmlspecialchars')){

function stripslashes_htmlspecialchars($value) {

    $value = is_array($value) ? array_map('stripslashes_htmlspecialchars', $value) : stripslashes(htmlspecialchars($value));

    return $value;

}

}

// stripslashes / htmlspecialchars for theme option save end

// saving all the theme options start

if(! function_exists('theme_option_save')){

function theme_option_save() {

    if (isset($_POST['logo'])) {

        $_POST = stripslashes_htmlspecialchars($_POST);

        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['twitter_setting'])) {

            update_option("cs_theme_option", $_POST);

            echo __("All Settings Saved", 'Mercycorp');

        } else {

            update_option("cs_theme_option", $_POST);

            echo __("All Settings Saved", 'Mercycorp');

        }

        //$_POST = array_map( 'htmlspecialchars' ,$_POST);

        //$a = array_map( 'stripslashes' ,$a);

        //$cs_theme_option = get_option('cs_theme_option');

        // upating config file start

        /*

          $fname = ABSPATH."wp-config.php";

          $fhandle = fopen($fname,"r");

          $content = fread($fhandle,filesize($fname));

          $content = str_replace("define('WPLANG', '".$cs_theme_option['lang_theme']."')", "define('WPLANG', '".$_POST['lang_theme']."')", $content);

          $fhandle = fopen($fname,"w");

          fwrite($fhandle,$content);

          fclose($fhandle);

         */

        // upating config file end

    } else {

        //echo $_FILES["mofile"]["tmp_name"][0];

        //echo $_FILES["mofile"]["name"][0];

        $target_path_mo = get_template_directory() . "/languages/" . $_FILES["mofile"]["name"][0];

        if (move_uploaded_file($_FILES["mofile"]["tmp_name"][0], $target_path_mo)) {

            chmod($target_path_mo, 0777);

        }

        echo __("New Language Uploaded Successfully", 'Mercycorp');

    }

    die();

}

}

add_action('wp_ajax_theme_option_save', 'theme_option_save');



// saving all the theme options end

// saving theme options import export start

if(! function_exists('theme_option_import_export')){

function theme_option_import_export() {

    $a = unserialize(base64_decode($_POST['theme_option_data']));

    update_option("cs_theme_option", $a);

    echo __("Options Imported", 'Mercycorp');

    die();

}

}

add_action('wp_ajax_theme_option_import_export', 'theme_option_import_export');



// saving theme options import export end

// restoring default theme options start

if(! function_exists('theme_option_restore_default')){

function theme_option_restore_default() {

    update_option("cs_theme_option", get_option('cs_theme_option_restore'));

    echo __("Default Theme Options Restored", 'Mercycorp');

    die();

}

}

add_action('wp_ajax_theme_option_restore_default', 'theme_option_restore_default');



// restoring default theme options end

// saving theme options backup start

if(! function_exists('theme_option_backup')){

function theme_option_backup() {

    update_option("cs_theme_option_backup", get_option('cs_theme_option'));

    update_option("cs_theme_option_backup_time", gmdate("Y-m-d H:i:s"));

    echo "Current Backup Taken @ " . gmdate("Y-m-d H:i:s");

    die();

}

}



add_action('wp_ajax_theme_option_backup', 'theme_option_backup');



// saving theme options backup end

// restore backup start

if(! function_exists('theme_option_backup_restore')){

function theme_option_backup_restore() {

    update_option("cs_theme_option", get_option('cs_theme_option_backup'));

    echo __("Backup Restored", 'Mercycorp');

    die();

}

}



add_action('wp_ajax_theme_option_backup_restore', 'theme_option_backup_restore');



// restore backup end

// page bulider items start

// gallery html form for page builder start

if(! function_exists('cs_pb_gallery')){

function cs_pb_gallery($die = 0) {

    global $cs_node, $cs_count_node, $post;

    if (isset($_POST['action'])) {

        $name = $_POST['action'];

        $cs_counter = $_POST['counter'];

        $gallery_element_size = '50';

        $cs_gal_header_title_db = '';

        $cs_gal_layout_db = '';

        $cs_gal_album_db = '';

        $cs_gal_desc_db = '';

        $cs_gal_pagination_db = '';

        $cs_gal_media_per_page_db = get_option("posts_per_page");

    } else {

        $name = $cs_node->getName();

        $cs_count_node++;

        $gallery_element_size = $cs_node->gallery_element_size;

        $cs_gal_header_title_db = $cs_node->header_title;

        $cs_gal_layout_db = $cs_node->layout;

        $cs_gal_album_db = $cs_node->album;

        $cs_gal_desc_db = $cs_node->desc;

        $cs_gal_pagination_db = $cs_node->pagination;

        $cs_gal_media_per_page_db = $cs_node->media_per_page;

        $cs_counter = $post->ID . $cs_count_node;

    }

    ?> 

    <div id="<?php echo $name . $cs_counter ?>_del" class="column  parentdelete column_<?php echo $gallery_element_size ?>" item="gallery" data="<?php echo element_size_data_array_index($gallery_element_size) ?>" >

        <div class="column-in">

            <h5><?php echo ucfirst(str_replace("cs_pb_", "", $name)) ?></h5>

            <input type="hidden" name="gallery_element_size[]" class="item" value="<?php echo $gallery_element_size ?>" >

            <a href="javascript:hide_all('<?php echo $name . $cs_counter ?>')" class="options"><?php _e('Options', 'Mercycorp'); ?></a> &nbsp; 

            <a href="#" class="delete-it btndeleteit"><?php _e('Del', 'Mercycorp'); ?></a> &nbsp;  

            <a class="decrement" onclick="javascript:decrement(this)"><?php _e('Dec', 'Mercycorp'); ?></a> &nbsp; 

            <a class="increment" onclick="javascript:increment(this)"><?php _e('Inc', 'Mercycorp'); ?></a>

        </div>

        <div class="poped-up" id="<?php echo $name . $cs_counter ?>" style="border:none; background:#f8f8f8;" >

            <div class="opt-head">

                <h5><?php _e('Edit Gallery Options', 'Mercycorp'); ?></h5>

                <a href="javascript:show_all('<?php echo $name . $cs_counter ?>')" class="closeit">&nbsp;</a>

            </div>

            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Gallery Header Title', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_gal_header_title[]" class="txtfield" value="<?php echo htmlspecialchars($cs_gal_header_title_db) ?>" />

                        <p><?php _e('Please enter gallery header title.', 'Mercycorp'); ?></p>

                    </li>                    

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Choose Gallery Layout', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cs_gal_layout[]" class="dropdown">

                            <option value="gallery-four-col" <?php if ($cs_gal_layout_db == "gallery-four-col") echo "selected"; ?> ><?php _e('4 Column', 'Mercycorp'); ?></option>

                            <option value="gallery-three-col" <?php if ($cs_gal_layout_db == "gallery-three-col") echo "selected"; ?> ><?php _e('3 Column', 'Mercycorp'); ?></option>

                            <option value="gallery-two-col" <?php if ($cs_gal_layout_db == "gallery-two-col") echo "selected"; ?> ><?php _e('2 Column', 'Mercycorp'); ?></option>

                            <option value="gallery-masonry" <?php if ($cs_gal_layout_db == "gallery-masonry") echo "selected"; ?> ><?php _e('Masonry', 'Mercycorp'); ?></option>

                        </select>



                        <p><?php _e('Select gallery layout, single column, double column, triple column or four column.', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Choose Gallery/Album', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cs_gal_album[]" class="dropdown">

                            <option value="0"><?php _e('-- Select Gallery --', 'Mercycorp'); ?></option>

                            <?php

                            $query = array('posts_per_page' => '-1', 'post_type' => 'albums', 'orderby' => 'ID', 'post_status' => 'publish');

                            $wp_query = new WP_Query($query);

                            while ($wp_query->have_posts()) : $wp_query->the_post();

                                ?>

                                <option <?php if ($post->post_name == $cs_gal_album_db) echo "selected"; ?> value="<?php echo $post->post_name; ?>"><?php echo get_the_title() ?></option>

                                <?php

                            endwhile;

                            ?>

                        </select>

                        <p><?php _e('Select gallery album to show images', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Show Description', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cs_gal_desc[]" class="dropdown">

                            <option <?php if ($cs_gal_desc_db == "On") echo "selected"; ?> ><?php _e('On', 'Mercycorp'); ?></option>

                            <option <?php if ($cs_gal_desc_db == "Off") echo "selected"; ?> ><?php _e('Off', 'Mercycorp'); ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Pagination', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cs_gal_pagination[]" class="dropdown" >

                            <option <?php if ($cs_gal_pagination_db == "Show Pagination") echo "selected"; ?> ><?php _e('Show Pagination', 'Mercycorp'); ?></option>

                            <option <?php if ($cs_gal_pagination_db == "Single Page") echo "selected"; ?> ><?php _e('Single Page', 'Mercycorp'); ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements" >

                    <li class="to-label"><label><?php _e('No. of Media Per Page', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_gal_media_per_page[]" class="txtfield" value="<?php echo $cs_gal_media_per_page_db; ?>" />

                        <p><?php _e('To display all the records, leave this field blank.', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements noborder">

                    <li class="to-label"></li>

                    <li class="to-field">

                        <input type="hidden" name="cs_orderby[]" value="gallery" />

                        <input type="button" value="<?php _e('Save', 'Mercycorp'); ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $cs_counter ?>')" />

                    </li>

                </ul>

            </div>

        </div>

    </div>

    <?php

    if ($die <> 1)

        die();

}

}

add_action('wp_ajax_cs_pb_gallery', 'cs_pb_gallery');



// gallery html form for page builder end

// services html form for page builder start

if(! function_exists('cs_pb_services')){

function cs_pb_services($die = 0) {

    global $cs_node, $cs_count_node, $post;

    if (isset($_POST['action'])) {

        $name = $_POST['action'];

        $cs_counter = $_POST['counter'];

        $services_element_size = '50';

        $service_title = '';

        $service_text = '';

        $service_link_url = '';

        $service_bg_image = '';

    } else {

        $name = $cs_node->getName();

        $cs_count_node++;

        $services_element_size = $cs_node->services_element_size;

        $service_title = $cs_node->service_title;

        $service_text = $cs_node->service_text;

        $service_link_url = $cs_node->service_link_url;

        $service_text = $cs_node->service_bg_image;

        $cs_counter = $post->ID . $cs_count_node;

    }

    ?> 

    <div id="<?php echo $name . $cs_counter ?>_del" class="column parentdelete column_<?php echo $services_element_size ?>" item="services" data="<?php echo element_size_data_array_index($services_element_size) ?>" >

        <div class="column-in">

            <h5><?php echo ucfirst(str_replace("cs_pb_", "", $name)) ?></h5>

            <input type="hidden" name="services_element_size[]" class="item" value="<?php echo $services_element_size ?>" >

            <a href="javascript:hide_all('<?php echo $name . $cs_counter ?>')" class="options"><?php _e('Options', 'Mercycorp'); ?></a> &nbsp; 

            <a href="#" class="delete-it btndeleteit"><?php _e('Del', 'Mercycorp'); ?></a> &nbsp;  

            <a class="decrement" onclick="javascript:decrement(this)"><?php _e('Dec', 'Mercycorp'); ?></a> &nbsp; 

            <a class="increment" onclick="javascript:increment(this)"><?php _e('Inc', 'Mercycorp'); ?></a>

        </div>

        <div class="poped-up" id="<?php echo $name . $cs_counter ?>" style="border:none; background:#f8f8f8;" >

            <div class="opt-head">

                <h5><?php _e('Edit Services Options', 'Mercycorp'); ?></h5>

                <a href="javascript:show_all('<?php echo $name . $cs_counter ?>')" class="closeit">&nbsp;</a>

            </div>

            <div class="wrapptabbox">

                <div class="clone_append">

                    <?php

                    $services_num = 0;

                    if (isset($cs_node)) {

                        $services_num = count($cs_node->service);

                        foreach ($cs_node->service as $service) {

                            ?>

                            <div class='clone_form'>

                                <a href='#' class='deleteit_node'><?php _e('Delete', 'Mercycorp'); ?> it</a>

                                <label><?php _e('Service Title', 'Mercycorp'); ?></label> <input class="txtfield" type="text" name="service_title[]" value="<?php echo $service->service_title ?>" />

                                <label><?php _e('Service Icon', 'Mercycorp'); ?></label> <input class="txtfield" type="text" name="service_icon[]" value="<?php echo $service->service_icon ?>" />

                                <label><?php _e('Service Background Image:', 'Mercycorp'); ?></label> <input class="txtfield" type="text" name="service_bg_image[]" value="<?php echo $service->service_bg_image ?>" />

                                <label><?php _e('Service Link', 'Mercycorp'); ?></label> <input class="txtfield" type="text" name="service_link_url[]" value="<?php echo $service->service_link_url ?>" />

                                <label><?php _e('Service Text', 'Mercycorp'); ?></label> <textarea class="txtfield" name="service_text[]"><?php echo $service->service_text ?></textarea>



                            </div>



                            <?php

                        }

                    }

                    ?>

                </div>

                <div class="opt-conts">

                    <ul class="form-elements">

                        <li class="to-label"><label></label></li>

                        <li class="to-field"><a href="#" class="add_services"><?php _e('Add service', 'Mercycorp'); ?></a></li>

                    </ul>

                    <ul class="form-elements noborder">

                        <li class="to-label"></li>

                        <li class="to-field">

                            <input type="hidden" name="services_num[]" value="<?php echo $services_num ?>" class="fieldCounter"  />

                            <input type="hidden" name="cs_orderby[]" value="services" />

                            <input type="button" value="<?php _e('Save', 'Mercycorp'); ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $cs_counter ?>')" />

                        </li>

                    </ul>

                </div>

            </div>



        </div>

    </div>

    <?php

    if ($die <> 1)

        die();

}

}



add_action('wp_ajax_cs_pb_services', 'cs_pb_services');



// services html form for page builder end

// slider html form for page builder start

if(! function_exists('cs_pb_slider')){

function cs_pb_slider($die = 0) {

    global $cs_node, $cs_count_node, $post;

    if (isset($_POST['action'])) {

        $name = $_POST['action'];

        $cs_counter = $_POST['counter'];

        $slider_element_size = '50';

        $cs_slider_header_title_db = '';

        $cs_slider_type_db = '';

        $cs_slider_db = '';

        $cs_slider_width_db = '';

        $cs_slider_height_db = '';

        $slider_view = '';

        $slider_id = '';

    } else {

        $name = $cs_node->getName();

        $cs_count_node++;

        $slider_element_size = $cs_node->slider_element_size;

        $cs_slider_header_title_db = $cs_node->slider_header_title;

        $cs_slider_type_db = $cs_node->slider_type;

        $cs_slider_db = $cs_node->slider;

        $slider_view = $cs_node->slider_view;

        $slider_id = $cs_node->slider_id;

        $cs_slider_width_db = $cs_node->width;

        $cs_slider_height_db = $cs_node->height;

        $cs_counter = $post->ID . $cs_count_node;

    }

    ?>

    <div id="<?php echo $name . $cs_counter ?>_del" class="column  parentdelete column_<?php echo $slider_element_size ?>" item="slider" data="<?php echo element_size_data_array_index($slider_element_size) ?>" >

        <div class="column-in">

            <h5><?php echo ucfirst(str_replace("cs_pb_", "", $name)) ?></h5>

            <input type="hidden" name="slider_element_size[]" class="item" value="<?php echo $slider_element_size ?>" >

            <a href="javascript:hide_all('<?php echo $name . $cs_counter ?>')" class="options"><?php _e('Options', 'Mercycorp'); ?></a>

            <a href="#" class="delete-it btndeleteit"><?php _e('Del', 'Mercycorp'); ?></a> &nbsp;

            <a class="decrement" onclick="javascript:decrement(this)"><?php _e('Dec', 'Mercycorp'); ?></a> &nbsp; 

            <a class="increment" onclick="javascript:increment(this)"><?php _e('Inc', 'Mercycorp'); ?></a>

        </div>

        <div class="poped-up" id="<?php echo $name . $cs_counter ?>" style="border:none; background:#f8f8f8;" >

            <div class="opt-head">

                <h5><?php _e('Edit Slider Options', 'Mercycorp'); ?></h5>

                <a href="javascript:show_all('<?php echo $name . $cs_counter ?>')" class="closeit">&nbsp;</a>

            </div>

            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Slider Header Title', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_slider_header_title[]" class="txtfield" value="<?php echo htmlspecialchars($cs_slider_header_title_db) ?>" />

                        <p><?php _e('Please enter slider header title', 'Mercycorp'); ?></p>

                    </li>                    

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Choose Slider Type', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cs_slider_type[]" class="dropdown" onchange="cs_toggle_height(this.value, 'cs_slider_height<?php echo $name . $cs_counter ?>')">

                            <option <?php

                            if ($cs_slider_type_db == "Flex Slider") {

                                echo "selected";

                            }

                            ?> ><?php _e('Flex Slider', 'Mercycorp'); ?></option>

                            <option <?php

                            if ($cs_slider_type_db == "Custom Slider") {

                                echo "selected";

                            }

                            ?> ><?php _e('Custom Slider', 'Mercycorp'); ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements" id="choose_slider" style="display:<?php

                if ($cs_slider_type_db == "Custom Slider")

                    echo "none";

                else

                    echo "inline";

                ?>">

                    <li class="to-label"><label><?php _e('Choose Slider', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cs_slider[]" class="dropdown">

                            <?php

                            $query = array('posts_per_page' => '-1', 'post_type' => 'cs_slider', 'orderby' => 'ID', 'post_status' => 'publish');

                            $wp_query = new WP_Query($query);

                            while ($wp_query->have_posts()) : $wp_query->the_post();

                                ?>

                                <option <?php if ($post->post_name == $cs_slider_db) echo "selected"; ?> value="<?php echo $post->post_name; ?>"><?php the_title() ?></option>

                                <?php

                            endwhile;

                            ?>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements" >

                    <li class="to-label"><label><?php _e('Slider View', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="slider_view[]" class="dropdown" >

                            <option <?php if ($slider_view == "content") echo "selected"; ?> ><?php _e('content', 'Mercycorp'); ?></option>

                            <option <?php if ($slider_view == "header") echo "selected"; ?> ><?php _e('header', 'Mercycorp'); ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements" id="layer_slider" style="display:<?php

                if ($cs_slider_type_db == "Custom Slider")

                    echo "inline";

                else

                    echo "none";

                ?>" >

                    <li class="to-label">

                        <label><?php _e('Use Short Code', 'Mercycorp'); ?></label>

                    </li>

                    <li class="to-field">

                        <input type="text" name="cs_slider_id[]" class="txtfield" value="<?php echo htmlspecialchars($slider_id); ?>" />

                    </li>

                    <li class="to-label"></li>

                    <li class="to-field">

                        <p><?php _e('Please enter the Revolution/Other Slider Short Code like [rev_slider mercycorp]', 'Mercycorp'); ?></p>

                    </li>                                            

                </ul>

                <ul class="form-elements noborder">

                    <li class="to-label"></li>

                    <li class="to-field">

                        <input type="hidden" name="cs_orderby[]" value="slider" />

                        <input type="button" value="<?php _e('Save', 'Mercycorp'); ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $cs_counter ?>')" />

                    </li>

                </ul>

            </div>

        </div>

    </div>

    <?php

    if ($die <> 1)

        die();

}

}

add_action('wp_ajax_cs_pb_slider', 'cs_pb_slider');

// slider html form for page builder end

add_action('wp_ajax_add_gradiants_to_list', 'add_gradiants_to_list');

if(! function_exists('add_gradiants_to_list')){

function add_gradiants_to_list() {

    global $counter_track, $address_name, $payer_email, $payment_gross, $txn_id, $payment_date;

    foreach ($_POST as $keys => $values) {

        $$keys = $values;

    }

    ?>

    <tr id="edit_track<?php echo $counter_track ?>">

        <td id="address_name<?php echo $counter_track ?>" style="width:20%;"><?php echo $address_name ?></td>

        <td id="payer_email<?php echo $counter_track ?>" style="width:20%;"><?php echo $payer_email ?></td>

        <td id="payment_gross<?php echo $counter_track ?>" style="width:20%;"><?php echo $payment_gross ?></td>

        <td id="txn_id<?php echo $counter_track ?>" style="width:20%;"><?php echo $txn_id ?></td>

        <td id="payment_date<?php echo $counter_track ?>" style="width:20%;"><?php echo $payment_date ?></td>

        <td class="centr" style="width:20%;">

            <a href="javascript:openpopedup('edit_track_form<?php echo $counter_track ?>')" class="actions edit">&nbsp;</a>

            <a onclick="javascript:return confirm('Are you sure! You want to delete this Transaction')" href="javascript:cs_div_remove('edit_track<?php echo $counter_track ?>')" class="actions delete">&nbsp;</a>

            <div class="poped-up" id="edit_track_form<?php echo $counter_track ?>" style="position:absolute;">

                <div class="opt-head">

                    <h5><?php _e('Edit Donation', 'Mercycorp'); ?></h5>

                    <a href="javascript:closepopedup('edit_track_form<?php echo $counter_track ?>')" class="closeit">&nbsp;</a>

                    <div class="clear"></div>

                </div>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Donar Name', 'Mercycorp'); ?></label></li>

                    <li class="to-field"><input type="text" name="address_name[]" value="<?php echo htmlspecialchars($address_name) ?>" id="address_name<?php echo $counter_track ?>" /><p><?php _e('Put Donar Name', 'Mercycorp'); ?></p></li>



                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Email', 'Mercycorp'); ?></label></li>

                    <li class="to-field"><input type="text" name="payer_email[]" value="<?php echo htmlspecialchars($payer_email) ?>" id="payer_email<?php echo $counter_track ?>" /><p><?php _e('Put Donor Email', 'Mercycorp'); ?></p></li>



                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Amount', 'Mercycorp'); ?></label></li>

                    <li class="to-field"><input type="text" name="payment_gross[]" value="<?php echo htmlspecialchars($payment_gross) ?>" id="payment_gross<?php echo $counter_track ?>" /><p><?php _e('Put Donor Raised Amount', 'Mercycorp'); ?></p></li>



                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Transaction Id', 'Mercycorp'); ?></label></li>

                    <li class="to-field"><input type="text" name="txn_id[]" value="<?php echo htmlspecialchars($txn_id) ?>" id="txn_id<?php echo $counter_track ?>" /><p><?php _e('Put Donor Transaction id', 'Mercycorp'); ?></p></li>



                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Donation Date', 'Mercycorp'); ?></label></li>

                    <li class="to-field"><input type="text" name="payment_date[]" value="<?php echo htmlspecialchars($payment_date) ?>" id="payment_date<?php echo $counter_track ?>" /><p><?php _e('Put Donation Date', 'Mercycorp'); ?></p></li>



                </ul>

                <ul class="form-elements noborder">

                    <li class="to-label"><label></label></li>

                    <li class="to-field"><input type="button" value="<?php _e('Update Donation', 'Mercycorp'); ?>" onclick="update_title(<?php echo $counter_track ?>);

                                closepopedup('edit_track_form<?php echo $counter_track ?>')" /></li>

                </ul>

            </div>

        </td>

    </tr>

    <?php

}

}

// Menu html form for page builder start

if(! function_exists('cs_pb_cause')){

function cs_pb_cause($die = 0) {

    global $cs_node, $cs_count_node, $post;

    if (isset($_POST['action'])) {

        $name = $_POST['action'];

        $cs_counter = $_POST['counter'];

        $cause_element_size = '50';

        $cause_cat = '';

        $cause_title = '';

        $cause_filterable = '';

        $cause_featured_article = '';

        $cause_pagination = '';

        $cause_per_page = get_option("posts_per_page");

        $cause_view = '';

        $cs_cause_excerpt = '255';

    } else {

        $name = $cs_node->getName();

        $cs_count_node++;

        $cause_element_size = $cs_node->cause_element_size;

        $cause_title = $cs_node->cause_title;

        $cause_cat = $cs_node->cause_cat;

        $cause_filterable = $cs_node->cause_filterable;

        //$cause_post_title = $cs_node->cause_post_title;

        $cause_pagination = $cs_node->cause_pagination;

        $cause_per_page = $cs_node->cause_per_page;

        $cause_featured_article = $cs_node->cause_featured_article;

        $cs_counter = $post->ID . $cs_count_node;

        $cs_cause_excerpt = $cs_node->cs_cause_excerpt;

    }

    ?> 

    <div id="<?php echo $name . $cs_counter ?>_del" class="column  parentdelete column_<?php echo $cause_element_size ?>" item="blog" data="<?php echo element_size_data_array_index($cause_element_size) ?>" >

        <div class="column-in">

            <h5><?php echo ucfirst(str_replace("cs_pb_", "", $name)) ?></h5>

            <input type="hidden" name="cause_element_size[]" class="item" value="<?php echo $cause_element_size ?>" >

            <a href="javascript:hide_all('<?php echo $name . $cs_counter ?>')" class="options"><?php _e('Options', 'Mercycorp'); ?></a>

            <a href="#" class="delete-it btndeleteit"><?php _e('Del', 'Mercycorp'); ?></a> &nbsp;

            <a class="decrement" onclick="javascript:decrement(this)"><?php _e('Dec', 'Mercycorp'); ?></a> &nbsp; 

            <a class="increment" onclick="javascript:increment(this)"><?php _e('Inc', 'Mercycorp'); ?></a>

        </div>

        <div class="poped-up" id="<?php echo $name . $cs_counter ?>" style="border:none; background:#f8f8f8;" >

            <div class="opt-head">

                <h5><?php _e('Edit Menu Options', 'Mercycorp'); ?></h5>

                <a href="javascript:show_all('<?php echo $name . $cs_counter ?>')" class="closeit">&nbsp;</a>

            </div>

            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Cause Title', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cause_title[]" class="txtfield" value="<?php echo htmlspecialchars($cause_title) ?>" />

                        <p><?php _e('Menu Page Title', 'Mercycorp'); ?></p>

                    </li>                                            

                </ul>



                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Choose Category', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cause_cat[]" class="dropdown">

                            <option value=""><?php _e('-- Select Category --', 'Mercycorp'); ?></option>

                            <?php show_all_cats('', '', $cause_cat, "cs_cause-category"); ?>

                        </select>

                        <p><?php _e('Choose category to show Cause list', 'Mercycorp'); ?></p>

                    </li>

                </ul>



                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Select Featured Cause', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cause_featured_article[]" class="dropdown" >

                            <option value="0"><?php _e('--Select Featured Cause --', 'Mercycorp'); ?></option>

                            <?php

                            query_posts(array('posts_per_page' => "-1", 'post_status' => 'publish', 'post_type' => 'cs_cause'));

                            while (have_posts()) : the_post();

                                ?>

                                <option <?php if ($cause_featured_article == get_the_ID()) echo "selected" ?> value="<?php the_ID() ?>"><?php the_title() ?></option>

                                <?php

                            endwhile;

                            ?>

                        </select>

                        <p><?php _e('Please select Featured Cause', 'Mercycorp'); ?></p>

                    </li>                                        

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('No. of record Per Page', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cause_per_page[]" class="txtfield" value="<?php echo $cause_per_page; ?>" />

                        <p><?php _e('To display all the records, leave this field blank', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Length of Excerpt', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_cause_excerpt[]" class="txtfield" value="<?php echo $cs_cause_excerpt; ?>" />

                        <p><?php _e('Enter number of character for short description text', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Filterable', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cause_filterable[]" class="dropdown" onchange="cs_toggle_tog('port_pagination<?php echo $name . $cs_counter ?>')">

                            <option <?php if ($cause_filterable == "Off") echo "selected"; ?> ><?php _e('Off', 'Mercycorp'); ?></option>

                            <option <?php if ($cause_filterable == "On") echo "selected"; ?> ><?php _e('On', 'Mercycorp'); ?></option>

                        </select>

                    </li>

                </ul>

                <div id="port_pagination<?php echo $name . $cs_counter ?>" <?php if ($cause_filterable == "On") echo 'style=" display:none"' ?> >

                    <ul class="form-elements">

                        <li class="to-label"><label><?php _e('Pagination', 'Mercycorp'); ?></label></li>

                        <li class="to-field">

                            <select name="cause_pagination[]" class="dropdown">

                                <option <?php if ($cause_pagination == "Show Pagination") echo "selected"; ?> ><?php _e('Show Pagination', 'Mercycorp'); ?></option>

                                <option <?php if ($cause_pagination == "Single Page") echo "selected"; ?> ><?php _e('Single Page', 'Mercycorp'); ?></option>

                            </select>

                        </li>

                    </ul>



                </div>

                <ul class="form-elements noborder">

                    <li class="to-label"><label></label></li>

                    <li class="to-field">

                        <input type="hidden" name="cs_orderby[]" value="cause" />

                        <input type="button" value="<?php _e('Save', 'Mercycorp'); ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $cs_counter ?>')" />

                    </li>

                </ul>

            </div>

        </div>

    </div>

    <?php

    if ($die <> 1)

        die();

}

}

add_action('wp_ajax_cs_pb_cause', 'cs_pb_cause');

// Menu html form for page builder end

if (isset($action))

    die();



// blog html form for page builder start

if(! function_exists('cs_pb_blog')){

function cs_pb_blog($die = 0) {

    global $cs_node, $cs_count_node, $post;

    if (isset($_POST['action'])) {

        $name = $_POST['action'];

        $cs_counter = $_POST['counter'];

        $blog_element_size = '50';

        $cs_blog_title_db = '';

        $cs_blog_description_db = '';

        $cs_blog_view_db = '';

        $cs_blog_cat_db = '';

        $cs_blog_excerpt_db = '255';

        $cs_blog_num_post_db = get_option("posts_per_page");

        $cs_blog_pagination_db = '';

        $cs_post_description_db = '';

        $cs_blog_orderby_db = 'DESC';

    } else {

        $name = $cs_node->getName();

        $cs_count_node++;

        $blog_element_size = $cs_node->blog_element_size;

        $cs_blog_title_db = $cs_node->cs_blog_title;

        $cs_blog_description_db = $cs_node->cs_blog_description;

        $cs_blog_view_db = $cs_node->cs_blog_view;

        $cs_blog_cat_db = $cs_node->cs_blog_cat;

        $cs_blog_excerpt_db = $cs_node->cs_blog_excerpt;

        $cs_blog_num_post_db = $cs_node->cs_blog_num_post;

        $cs_blog_pagination_db = $cs_node->cs_blog_pagination;

        $cs_blog_description_db = $cs_node->cs_blog_description;

        $cs_blog_orderby_db = $cs_node->cs_blog_orderby;

        $cs_counter = $post->ID . $cs_count_node;

    }

    ?> 

    <div id="<?php echo $name . $cs_counter ?>_del" class="column  parentdelete column_<?php echo $blog_element_size ?>" item="blog" data="<?php echo element_size_data_array_index($blog_element_size) ?>" >

        <div class="column-in">

            <h5><?php echo ucfirst(str_replace("cs_pb_", "", $name)) ?></h5>

            <input type="hidden" name="blog_element_size[]" class="item" value="<?php echo $blog_element_size ?>" >

            <a href="javascript:hide_all('<?php echo $name . $cs_counter ?>')" class="options"><?php _e('Options', 'Mercycorp'); ?></a>

            <a href="#" class="delete-it btndeleteit"><?php _e('Del', 'Mercycorp'); ?></a> &nbsp;

            <a class="decrement" onclick="javascript:decrement(this)"><?php _e('Dec', 'Mercycorp'); ?></a> &nbsp; 

            <a class="increment" onclick="javascript:increment(this)"><?php _e('Inc', 'Mercycorp'); ?></a>

        </div>

        <div class="poped-up" id="<?php echo $name . $cs_counter ?>" style="border:none; background:#f8f8f8;" >

            <div class="opt-head">

                <h5><?php _e('Edit Blog Options', 'Mercycorp'); ?></h5>

                <a href="javascript:show_all('<?php echo $name . $cs_counter ?>')" class="closeit">&nbsp;</a>

            </div>

            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Blog Header Title', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_blog_title[]" class="txtfield" value="<?php echo htmlspecialchars($cs_blog_title_db) ?>" />

                        <p><?php _e('Please enter Blog header title', 'Mercycorp'); ?></p>

                    </li>                    

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Select View', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cs_blog_view[]" class="dropdown">

                            <option <?php if ($cs_blog_view_db == "blog-large") echo "selected"; ?> value="blog-large"><?php _e('Blog Large Image', 'Mercycorp'); ?></option>

                            <option <?php if ($cs_blog_view_db == "blog-medium") echo "selected"; ?> value="blog-medium"><?php _e('Blog Medium Image', 'Mercycorp'); ?></option>



                        </select>



                    </li>                                        

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Choose Category', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cs_blog_cat[]" class="dropdown">

                            <option value="0"><?php _e('All', 'Mercycorp'); ?></option>

                            <?php show_all_cats('', '', $cs_blog_cat_db, "category"); ?>

                        </select>

                        <p><?php _e('Please select category to show posts', 'Mercycorp'); ?></p>

                    </li>                                        

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Post Order', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cs_blog_orderby[]" class="dropdown" >

                            <option <?php if ($cs_blog_orderby_db == "ASC") echo "selected"; ?> value="ASC"><?php _e('Asc', 'Mercycorp'); ?></option>

                            <option <?php if ($cs_blog_orderby_db == "DESC") echo "selected"; ?> value="DESC"><?php _e('DESCENDING', 'Mercycorp'); ?></option>

                        </select>

                    </li>

                </ul>



                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Post Description', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cs_blog_description[]" class="dropdown" >

                            <option <?php if ($cs_blog_description_db == "yes") echo "selected"; ?> value="yes"><?php _e('Yes', 'Mercycorp'); ?></option>

                            <option <?php if ($cs_blog_description_db == "no") echo "selected"; ?> value="no"><?php _e('No', 'Mercycorp'); ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Length of Excerpt', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_blog_excerpt[]" class="txtfield" value="<?php echo $cs_blog_excerpt_db; ?>" />

                        <p><?php _e('Enter number of character for short description text', 'Mercycorp'); ?></p>

                    </li>                         

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Pagination', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cs_blog_pagination[]" class="dropdown" >

                            <option <?php if ($cs_blog_pagination_db == "Show Pagination") echo "selected"; ?> ><?php _e('Show Pagination', 'Mercycorp'); ?></option>

                            <option <?php if ($cs_blog_pagination_db == "Single Page") echo "selected"; ?> ><?php _e('Single Page', 'Mercycorp'); ?></option>

                            <!--<option <?php //if($cs_blog_pagination_db=="Load More")echo "selected";      ?> >Load More</option>-->

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('No. of Post Per Page', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_blog_num_post[]" class="txtfield" value="<?php echo $cs_blog_num_post_db; ?>" />

                        <p><?php _e('To display all the records, leave this field blank.', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements noborder">

                    <li class="to-label"></li>

                    <li class="to-field">

                        <input type="hidden" name="cs_orderby[]" value="blog" />

                        <input type="button" value="<?php _e('Save', 'Mercycorp'); ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $cs_counter ?>')" />

                    </li>

                </ul>

            </div>

        </div>

    </div>

    <?php

    if ($die <> 1)

        die();

}

}

add_action('wp_ajax_cs_pb_blog', 'cs_pb_blog');



// blog html form for page builder end

// event html form for page builder start

if(! function_exists('cs_pb_event')){

function cs_pb_event($die = 0) {

    global $cs_node, $cs_count_node, $post;

    if (isset($_POST['action'])) {

        $name = $_POST['action'];

        $cs_counter = $_POST['counter'];

        $event_element_size = '50';

        $cs_event_title_db = '';

        $cs_event_view_db = '';

        $cs_event_type_db = '';

        $cs_event_category_db = '';

        $cs_event_time_db = '';

        $cs_event_organizer_db = '';

        $cs_event_filterables_db = '';

        $cs_event_pagination_db = '';

        $cs_event_per_page_db = get_option("posts_per_page");

        $cs_featured_post = '';

    } else {

        $name = $cs_node->getName();

        $cs_count_node++;

        $event_element_size = $cs_node->event_element_size;

        $cs_event_title_db = $cs_node->cs_event_title;

        $cs_event_view_db = $cs_node->cs_event_view;

        $cs_event_type_db = $cs_node->cs_event_type;

        $cs_event_category_db = $cs_node->cs_event_category;

        $cs_event_time_db = $cs_node->cs_event_time;

        $cs_event_organizer_db = $cs_node->cs_event_organizer;

        $cs_event_filterables_db = $cs_node->cs_event_filterables;

        $cs_event_pagination_db = $cs_node->cs_event_pagination;

        $cs_event_per_page_db = $cs_node->cs_event_per_page;

        $cs_counter = $post->ID . $cs_count_node;

        $cs_featured_post = $cs_node->cs_featured_post;

    }

    ?> 

    <div id="<?php echo $name . $cs_counter ?>_del" class="column  parentdelete column_<?php echo $event_element_size ?>" item="event" data="<?php echo element_size_data_array_index($event_element_size) ?>" >

        <div class="column-in">

            <h5><?php echo ucfirst(str_replace("cs_pb_", "", $name)) ?></h5>

            <input type="hidden" name="event_element_size[]" class="item" value="<?php echo $event_element_size ?>" >

            <a href="javascript:hide_all('<?php echo $name . $cs_counter ?>')" class="options"><?php _e('Options', 'Mercycorp'); ?></a>

            <a href="#" class="delete-it btndeleteit"><?php _e('Del', 'Mercycorp'); ?></a> &nbsp;

            <a class="decrement" onclick="javascript:decrement(this)"><?php _e('Dec', 'Mercycorp'); ?></a> &nbsp; 

            <a class="increment" onclick="javascript:increment(this)"><?php _e('Inc', 'Mercycorp'); ?></a>

        </div>

        <div class="poped-up" id="<?php echo $name . $cs_counter ?>" style="border:none; background:#f8f8f8;" >

            <div class="opt-head">

                <h5><?php _e('Edit Event Options', 'Mercycorp'); ?></h5>

                <a href="javascript:show_all('<?php echo $name . $cs_counter ?>')" class="closeit">&nbsp;</a>

            </div>

            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Event Title', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_event_title[]" class="txtfield" value="<?php echo htmlspecialchars($cs_event_title_db) ?>" />

                        <p><?php _e('Event Page Title', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('View', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cs_event_view[]" class="dropdown">

                            <option value="List View" <?php if ($cs_event_view_db == "List View") echo "selected"; ?> ><?php _e('List View', 'Mercycorp'); ?></option>

                            <option value="Calendar View" <?php if ($cs_event_view_db == "Calendar View") echo "selected"; ?> ><?php _e('Calendar View', 'Mercycorp'); ?></option>

                        </select>

                        <p><?php _e('Select layout for Listing page, calendar view contain all the dates of events in calender format. List view contain all the events with title and description in list', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements" id="cs_featured_post">

                    <li class="to-label"><label><?php _e('Choose Featured Event', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cs_featured_post[]" class="dropdown">

                            <option value=""><?php _e('-- Select Featured Event --', 'Mercycorp'); ?></option>

                            <?php

                            $args = array('posts_per_page' => "-1", 'post_type' => 'events');

                            $custom_query = new WP_Query($args);

                            while ($custom_query->have_posts()) : $custom_query->the_post();

                                ?>

                                <option value="<?php echo $post->ID ?>" <?php

                                if ($cs_featured_post == $post->ID) {

                                    echo 'selected';

                                }

                                ?>> <?php the_title(); ?></option><?php endwhile; ?>                 </select>

                        <p><?php _e('Please select featured event', 'Mercycorp'); ?></p>

                    </li>                                        

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Event Types', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cs_event_type[]" class="dropdown">

                            <option <?php if ($cs_event_type_db == "All Events") echo "selected"; ?> ><?php _e('All Events', 'Mercycorp'); ?></option>

                            <option <?php if ($cs_event_type_db == "Upcoming Events") echo "selected"; ?> ><?php _e('Upcoming Events', 'Mercycorp'); ?></option>

                            <option <?php if ($cs_event_type_db == "Past Events") echo "selected"; ?> ><?php _e('Past Events', 'Mercycorp'); ?></option>

                        </select>

                        <p><?php _e('Select event type', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Select Category', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cs_event_category[]" class="dropdown">

                            <option value="0"><?php _e('-- Select Category --', 'Mercycorp'); ?></option>

                            <?php show_all_cats('', '', $cs_event_category_db, "event-category"); ?>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Show Time', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cs_event_time[]" class="dropdown">

                            <option value="Yes" <?php if ($cs_event_time_db == "Yes") echo "selected"; ?> ><?php _e('Yes', 'Mercycorp'); ?></option>

                            <option value="No" <?php if ($cs_event_time_db == "No") echo "selected"; ?> ><?php _e('No', 'Mercycorp'); ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements" style="display:none;">

                    <li class="to-label"><label><?php _e('Show Organizer', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cs_event_organizer[]" class="dropdown">

                            <option value="Yes" <?php if ($cs_event_organizer_db == "Yes") echo "selected"; ?> ><?php _e('Yes', 'Mercycorp'); ?></option>

                            <option value="No" <?php if ($cs_event_organizer_db == "No") echo "selected"; ?> ><?php _e('No', 'Mercycorp'); ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Filterable', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cs_event_filterables[]" class="dropdown" >

                            <option value="No" <?php if ($cs_event_filterables_db == "No") echo "selected"; ?> ><?php _e('No', 'Mercycorp'); ?></option>

                            <option value="Yes" <?php if ($cs_event_filterables_db == "Yes") echo "selected"; ?> ><?php _e('Yes', 'Mercycorp'); ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Pagination', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="cs_event_pagination[]" class="dropdown" >

                            <option <?php if ($cs_event_pagination_db == "Show Pagination") echo "selected"; ?> ><?php _e('Show Pagination', 'Mercycorp'); ?></option>

                            <!--<option <?php //if($cs_event_pagination_db=="Load More")echo "selected";      ?> >Load More</option>-->

                            <option <?php if ($cs_event_pagination_db == "Single Page") echo "selected"; ?> ><?php _e('Single Page', 'Mercycorp'); ?></option>

                        </select>

                        <p><?php _e('Show navigation only at List View', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('No. of Events Per Page', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_event_per_page[]" class="txtfield" value="<?php echo $cs_event_per_page_db; ?>" />

                        <p><?php _e('To display all the records, leave this field blank', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements noborder">

                    <li class="to-label"></li>

                    <li class="to-field">

                        <input type="hidden" name="cs_orderby[]" value="event" />

                        <input type="button" value="<?php _e('Save', 'Mercycorp'); ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $cs_counter ?>')" />

                    </li>

                </ul>

            </div>

        </div>

    </div>

    <?php

    if ($die <> 1)

        die();

}

}



add_action('wp_ajax_cs_pb_event', 'cs_pb_event');



// event html form for page builder end

// contact us html form for page builder start

if(! function_exists('cs_pb_contact')){

function cs_pb_contact($die = 0) {

    global $cs_node, $cs_count_node, $post;

    if (isset($_POST['action'])) {

        $name = $_POST['action'];

        $cs_counter = $_POST['counter'];

        $contact_element_size = '50';

        $cs_contact_email_db = '';

        $cs_contact_succ_msg_db = '';

    } else {

        $name = $cs_node->getName();

        $cs_count_node++;

        $contact_element_size = $cs_node->contact_element_size;

        $cs_contact_email_db = $cs_node->cs_contact_email;

        $cs_contact_succ_msg_db = $cs_node->cs_contact_succ_msg;

        $cs_counter = $post->ID . $cs_count_node;

    }

    ?> 

    <div id="<?php echo $name . $cs_counter ?>_del" class="column  parentdelete column_<?php echo $contact_element_size ?>" item="contact" data="<?php echo element_size_data_array_index($contact_element_size) ?>" >

        <div class="column-in">

            <h5><?php echo ucfirst(str_replace("cs_pb_", "", $name)) ?></h5>

            <input type="hidden" name="contact_element_size[]" class="item" value="<?php echo $contact_element_size ?>" >

            <a href="javascript:hide_all('<?php echo $name . $cs_counter ?>')" class="options"><?php _e('Options', 'Mercycorp'); ?></a>

            <a href="#" class="delete-it btndeleteit"><?php _e('Del', 'Mercycorp'); ?></a> &nbsp;

            <a class="decrement" onclick="javascript:decrement(this)"><?php _e('Dec', 'Mercycorp'); ?></a> &nbsp; 

            <a class="increment" onclick="javascript:increment(this)"><?php _e('Inc', 'Mercycorp'); ?></a>

        </div>

        <div class="poped-up" id="<?php echo $name . $cs_counter ?>" style="border:none; background:#f8f8f8;" >

            <div class="opt-head">

                <h5><?php _e('Edit Contact Form', 'Mercycorp'); ?></h5>

                <a href="javascript:show_all('<?php echo $name . $cs_counter ?>')" class="closeit">&nbsp;</a>

            </div>

            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Contact Email', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_contact_email[]" class="txtfield" value="<?php

                        if ($cs_contact_email_db == "")

                            echo get_option("admin_email");

                        else

                            echo $cs_contact_email_db;

                        ?>" />

                        <p><?php _e('Please enter Contact email Address', 'Mercycorp'); ?></p>

                    </li>                    

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Successful Message', 'Mercycorp'); ?></label></li>

                    <li class="to-field"><textarea name="cs_contact_succ_msg[]"><?php

                            if ($cs_contact_succ_msg_db == "")

                                echo "Email Sent Successfully.\nThank you, your message has been submitted to us.";

                            else

                                echo $cs_contact_succ_msg_db;

                            ?></textarea></li>

                </ul>

                <ul class="form-elements noborder">

                    <li class="to-label"></li>

                    <li class="to-field">

                        <input type="hidden" name="cs_orderby[]" value="contact" />

                        <input type="button" value="<?php _e('Save', 'Mercycorp'); ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $cs_counter ?>')" />

                    </li>

                </ul>

            </div>

        </div>

    </div>

    <?php

    if ($die <> 1)

        die();

}

}

add_action('wp_ajax_cs_pb_contact', 'cs_pb_contact');



// contact us html form for page builder end

// column html form for page builder start

if(! function_exists('cs_pb_column')){

function cs_pb_column($die = 0) {

    global $cs_node, $cs_count_node, $post;

    if (isset($_POST['action'])) {

        $name = $_POST['action'];

        $cs_counter = $_POST['counter'];

        $column_element_size = '25';

        $column_text = '';

    } else {

        $name = $cs_node->getName();

        $cs_count_node++;

        $column_element_size = $cs_node->column_element_size;

        $column_text = $cs_node->column_text;

        $cs_counter = $post->ID . $cs_count_node;

    }

    ?> 

    <div id="<?php echo $name . $cs_counter ?>_del" class="column  parentdelete column_<?php echo $column_element_size ?>" item="column" data="<?php echo element_size_data_array_index($column_element_size) ?>" >

        <div class="column-in">

            <h5><?php echo ucfirst(str_replace("cs_pb_", "", $name)) ?></h5>

            <input type="hidden" name="column_element_size[]" class="item" value="<?php echo $column_element_size ?>" >

            <a href="javascript:hide_all('<?php echo $name . $cs_counter ?>')" class="options"><?php _e('Options', 'Mercycorp'); ?></a> &nbsp; 

            <a href="#" class="delete-it btndeleteit"><?php _e('Del', 'Mercycorp'); ?></a> &nbsp;  

            <a class="decrement" onclick="javascript:decrement(this)"><?php _e('Dec', 'Mercycorp'); ?></a> &nbsp; 

            <a class="increment" onclick="javascript:increment(this)"><?php _e('Inc', 'Mercycorp'); ?></a>

        </div>

        <div class="poped-up" id="<?php echo $name . $cs_counter ?>" style="border:none; background:#f8f8f8;" >

            <div class="opt-head">

                <h5><?php _e('Edit Column Options', 'Mercycorp'); ?></h5>

                <a href="javascript:show_all('<?php echo $name . $cs_counter ?>')" class="closeit">&nbsp;</a>

            </div>

            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Column Text', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <textarea name="column_text[]"><?php echo htmlspecialchars_decode($column_text) ?></textarea>

                        <p><?php _e('Shortcodes and HTML tags allowed', 'Mercycorp'); ?></p>

                    </li>                  

                </ul>

                <ul class="form-elements noborder">

                    <li class="to-label"></li>

                    <li class="to-field">

                        <input type="hidden" name="cs_orderby[]" value="column" />

                        <input type="button" value="<?php _e('Save', 'Mercycorp'); ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $cs_counter ?>')" />

                    </li>

                </ul>

            </div>

        </div>

    </div>

    <?php

    if ($die <> 1)

        die();

}

}

add_action('wp_ajax_cs_pb_column', 'cs_pb_column');



// column html form for page builder end 

// google map html form for page builder start

if(! function_exists('cs_pb_map')){

function cs_pb_map($die = 0) {

    global $cs_node, $cs_count_node, $post;

    if (isset($_POST['action'])) {

        $name = $_POST['action'];

        $cs_counter = $_POST['counter'];

        $map_element_size = '25';

        $map_title = '';

        $map_height = '';

        $map_lat = '';

        $map_lon = '';

        $map_zoom = '';

        $map_type = '';

        $map_info = '';

        $map_info_width = '';

        $map_info_height = '';

        $map_marker_icon = '';

        $map_show_marker = '';

        $map_controls = '';

        $map_draggable = '';

        $map_scrollwheel = '';

        $map_view = '';

        $map_conactus_content = '<a href="' . home_url() . '" class="logo"><img src="' . get_template_directory_uri() . '/images/logo.png" alt=""></a>

                            <p>25 Infinite Square,</br> Red StreetCA 123456,</br> City name Canada,</p>

                            <ul>

                                <li><span>Phonee</span>123.456.78910</li>

                                <li><span>Mobile</span>(800) 123 4567 89</li>

                                <li><span>Emailx</span><a class="colrhover" href="#">resturant@resturant.com</a></li>

                                <li><span>Timing</span>Mon-Thu (09:00 to 17:30)</li>

                            </ul>';

    } else {

        $name = $cs_node->getName();

        $cs_count_node++;

        $map_element_size = $cs_node->map_element_size;

        $map_title = $cs_node->map_title;

        $map_height = $cs_node->map_height;

        $map_lat = $cs_node->map_lat;

        $map_lon = $cs_node->map_lon;

        $map_zoom = $cs_node->map_zoom;

        $map_type = $cs_node->map_type;

        $map_info = $cs_node->map_info;

        $map_info_width = $cs_node->map_info_width;

        $map_info_height = $cs_node->map_info_height;

        $map_marker_icon = $cs_node->map_marker_icon;

        $map_show_marker = $cs_node->map_show_marker;

        $map_controls = $cs_node->map_controls;

        $map_draggable = $cs_node->map_draggable;

        $map_scrollwheel = $cs_node->map_scrollwheel;

        $map_view = $cs_node->map_view;

        $map_conactus_content = $cs_node->map_conactus_content;

        $cs_counter = $post->ID . $cs_count_node;

    }

    ?> 

    <div id="<?php echo $name . $cs_counter ?>_del" class="column  parentdelete column_<?php echo $map_element_size ?>" item="map" data="<?php echo element_size_data_array_index($map_element_size) ?>" >

        <div class="column-in">

            <h5><?php echo ucfirst(str_replace("cs_pb_", "", $name)) ?></h5>

            <input type="hidden" name="map_element_size[]" class="item" value="<?php echo $map_element_size ?>" >

            <a href="javascript:hide_all('<?php echo $name . $cs_counter ?>')" class="options"><?php _e('Options', 'Mercycorp'); ?></a> &nbsp; 

            <a href="#" class="delete-it btndeleteit"><?php _e('Del', 'Mercycorp'); ?></a> &nbsp;  

            <a class="decrement" onclick="javascript:decrement(this)"><?php _e('Dec', 'Mercycorp'); ?></a> &nbsp; 

            <a class="increment" onclick="javascript:increment(this)"><?php _e('Inc', 'Mercycorp'); ?></a>

        </div>

        <div class="poped-up" id="<?php echo $name . $cs_counter ?>" style="border:none; background:#f8f8f8;" >

            <div class="opt-head">

                <h5><?php _e('Edit Map Options', 'Mercycorp'); ?></h5>

                <a href="javascript:show_all('<?php echo $name . $cs_counter ?>')" class="closeit">&nbsp;</a>

            </div>

            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Title', 'Mercycorp'); ?></label></li>

                    <li class="to-field"><input type="text" name="map_title[]" class="txtfield" value="<?php echo $map_title ?>" /></li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Map Height', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="map_height[]" class="txtfield" value="<?php echo $map_height ?>" />

                        <p><?php _e('Info Max Height in PX (Default is 200)', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Latitude', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="map_lat[]" class="txtfield" value="<?php echo $map_lat ?>" />

                        <p><?php _e('Put Latitude (Default is 0)', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Longitude', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="map_lon[]" class="txtfield" value="<?php echo $map_lon ?>" />

                        <p><?php _e('Put Longitude (Default is 0)', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Zoom', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="map_zoom[]" class="txtfield" value="<?php echo $map_zoom ?>" />

                        <p><?php _e('Put Zoom Level (Default is 11)', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Map Types', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="map_type[]" class="dropdown" >

                            <option <?php if ($map_type == "ROADMAP") echo "selected"; ?> ><?php _e('ROADMAP', 'Mercycorp'); ?></option>

                            <option <?php if ($map_type == "HYBRID") echo "selected"; ?> ><?php _e('Hybrid', 'Mercycorp'); ?></option>

                            <option <?php if ($map_type == "SATELLITE") echo "selected"; ?> ><?php _e('SATELLITE', 'Mercycorp'); ?></option>

                            <option <?php if ($map_type == "TERRAIN") echo "selected"; ?> ><?php _e('Terrain', 'Mercycorp'); ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Info Text', 'Mercycorp'); ?></label></li>

                    <li class="to-field"><input type="text" name="map_info[]" class="txtfield" value="<?php echo $map_info ?>" /></li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Info Max Width', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="map_info_width[]" class="txtfield" value="<?php echo $map_info_width ?>" />

                        <p><?php _e('Info Max Width in PX (Default is 200)', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Info Max Height', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="map_info_height[]" class="txtfield" value="<?php echo $map_info_height ?>" />

                        <p><?php _e('Info Max Height in PX (Default is 100)', 'Mercycorp'); ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Marker Icon Path', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <input type="text" name="map_marker_icon[]" class="txtfield" value="<?php echo $map_marker_icon ?>" />

                        <p>e.g. http://yourdomain.com/logo.png</p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Show Marker', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="map_show_marker[]" class="dropdown" >

                            <option value="true" <?php if ($map_show_marker == "true") echo "selected"; ?> ><?php _e('On', 'Mercycorp'); ?></option>

                            <option value="false" <?php if ($map_show_marker == "false") echo "selected"; ?> ><?php _e('Off', 'Mercycorp'); ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Disable Map Controls', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="map_controls[]" class="dropdown" >

                            <option value="false" <?php if ($map_controls == "false") echo "selected"; ?> ><?php _e('Off', 'Mercycorp'); ?></option>

                            <option value="true" <?php if ($map_controls == "true") echo "selected"; ?> ><?php _e('On', 'Mercycorp'); ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Draggable', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="map_draggable[]" class="dropdown" >

                            <option value="true" <?php if ($map_draggable == "true") echo "selected"; ?> ><?php _e('On', 'Mercycorp'); ?></option>

                            <option value="false" <?php if ($map_draggable == "false") echo "selected"; ?> ><?php _e('Off', 'Mercycorp'); ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Scroll Wheel', 'Mercycorp'); ?></label></li>

                    <li class="to-field">



                        <select name="map_scrollwheel[]" class="dropdown" >

                            <option value="true" <?php if ($map_scrollwheel == "true") echo "selected"; ?> ><?php _e('On', 'Mercycorp'); ?></option>

                            <option value="false" <?php if ($map_scrollwheel == "false") echo "selected"; ?> ><?php _e('Off', 'Mercycorp'); ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Map View', 'Mercycorp'); ?></label></li>

                    <li class="to-field">

                        <select name="map_view[]" class="dropdown"  onchange="map_contactus_element(this.value,<?php echo $cs_counter; ?>)">

                            <option <?php if ($map_view == "content") echo "selected"; ?> ><?php _e('content', 'Mercycorp'); ?></option>

                            <option <?php if ($map_view == "header") echo "selected"; ?> ><?php _e('header', 'Mercycorp'); ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements noborder">

                    <li class="to-label"></li>

                    <li class="to-field">

                        <input type="hidden" name="cs_orderby[]" value="map" />

                        <input type="button" value="<?php _e('Save', 'Mercycorp'); ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $cs_counter ?>')" />

                    </li>

                </ul>

            </div>



        </div>

    </div>

    <?php

    if ($die <> 1)

        die();

}

}

add_action('wp_ajax_cs_pb_map', 'cs_pb_map');



// google map html form for page builder end

// page bulider items end

// side bar layout in pages, post and default page(theme options) start

if(! function_exists('meta_layout')){

function meta_layout() {

    global $cs_xmlObject;

    if (empty($cs_xmlObject->sidebar_layout->cs_layout))

        $cs_layout = "";

    else

        $cs_layout = $cs_xmlObject->sidebar_layout->cs_layout;

    if (empty($cs_xmlObject->sidebar_layout->cs_sidebar_left))

        $cs_sidebar_left = "";

    else

        $cs_sidebar_left = $cs_xmlObject->sidebar_layout->cs_sidebar_left;

    if (empty($cs_xmlObject->sidebar_layout->cs_sidebar_right))

        $cs_sidebar_right = "";

    else

        $cs_sidebar_right = $cs_xmlObject->sidebar_layout->cs_sidebar_right;

    ?>

    <div class="elementhidden">

        <div class="clear"></div>

        <div class="opt-head">

            <h4><?php _e('Layout Options', 'Mercycorp'); ?></h4>

            <div class="clear"></div>

        </div>

        <ul class="form-elements">

            <li class="to-label">

                <label><?php _e('Select Layout', 'Mercycorp'); ?></label>

            </li>

            <li class="to-field">

                <div class="meta-input">
                    <?php 
                        if ($cs_layout == ''){
                            $cs_layout='right';
                        }

                     ?>
                    <div class='radio-image-wrapper'>
        
                        <input <?php if ($cs_layout == "none") echo "checked" ?> onclick="show_sidebar('none')" type="radio" name="cs_layout" class="radio" value="none" id="radio_1" />

                        <label for="radio_1">

                            <span class="ss"><img src="<?php echo get_template_directory_uri() ?>/images/admin/1.gif"  alt="" /></span>

                            <span <?php if ($cs_layout == "none") echo "class='check-list'" ?> id="check-list"><img src="<?php echo get_template_directory_uri() ?>/images/admin/1-hover.gif" alt="" /></span>

                        </label>

                    </div>

                    <div class='radio-image-wrapper'>
                        <input <?php if ($cs_layout == "right") ?> <? if ($cs_layout == "") echo "checked" ?>  onclick="show_sidebar('right')" type="radio" name="cs_layout" class="radio" value="right" id="radio_2"  />
                        <label for="radio_2">
                            <span class="ss"><img src="<?php echo get_template_directory_uri() ?>/images/admin/2.gif" alt="" /></span>
                            <span <?php if ($cs_layout == "right") echo "class='check-list'" ?> id="check-list"><img src="<?php echo get_template_directory_uri() ?>/images/admin/2-hover.gif" alt="" /></span>
                        </label>
                    </div>

                    <div class='radio-image-wrapper'>

                        <input <?php if ($cs_layout == "left") echo "checked"?> onclick="show_sidebar('left')" type="radio" name="cs_layout" class="radio" value="left" id="radio_3" />

                        <label for="radio_3">

                            <span class="ss"><img src="<?php echo get_template_directory_uri() ?>/images/admin/3.gif" alt="" /></span>

                            <span <?php if ($cs_layout == "left") echo "class='check-list'" ?> id="check-list"><img src="<?php echo get_template_directory_uri() ?>/images/admin/3-hover.gif" alt="" /></span>

                        </label>

                    </div>

                </div>

            </li>

        </ul>

        <ul class="form-elements meta-body" style=" <?php

        if ($cs_sidebar_left == "") {

            echo "display:none";

        } else

            echo "display:block";

        ?>" id="sidebar_left" >

            <li class="to-label">

                <label><?php _e('Select Left Sidebar', 'Mercycorp'); ?></label>

            </li>

            <li class="to-field">

                <select name="cs_sidebar_left" class="select_dropdown" id="page-option-choose-left-sidebar">

                    <?php

                    global $cs_theme_option;

                   // $cs_theme_option = get_option('cs_theme_option');

                    if (isset($cs_theme_option['sidebar']) and count($cs_theme_option['sidebar']) > 0) {

                        foreach ($cs_theme_option['sidebar'] as $sidebar) {

                            ?>

                            <option <?php if ($cs_sidebar_left == $sidebar) echo "selected"; ?> ><?php echo $sidebar; ?></option>

                            <?php

                        }

                    }

                    ?>

                </select>

            </li>

        </ul>

        <ul class="form-elements meta-body" style=" <?php

        if ($cs_sidebar_right == "") {

            echo "display:none";

        } else

            echo "display:block";

        ?>" id="sidebar_right" >

            <li class="to-label">

                <label><?php _e('Select Right Sidebar', 'Mercycorp'); ?></label>

            </li>

            <li class="to-field">

                <select name="cs_sidebar_right" class="select_dropdown" id="page-option-choose-right-sidebar">

                    <?php

                    if (isset($cs_theme_option['sidebar']) and count($cs_theme_option['sidebar']) > 0) {

                        foreach ($cs_theme_option['sidebar'] as $sidebar) {

                            ?>

                            <option <?php if ($cs_sidebar_right == $sidebar) echo "selected"; ?> ><?php echo $sidebar; ?></option>

                            <?php

                        }

                    }

                    ?>

                </select>

                <input type="hidden" name="cs_orderby[]" value="meta_layout" />

            </li>

        </ul>

    </div>

    <div class="clear"></div>

    <?php

}

}

// side bar layout in pages, post and default page(theme options) end

if(! function_exists('element_size_data_array_index')){

function element_size_data_array_index($size) {

    if ($size == "" or $size == 100)

        return 0;

    else if ($size == 75)

        return 1;

    else if ($size == 50)

        return 2;

    else if ($size == 25)

        return 3;

}

}

// Show all Categories

if(! function_exists('show_all_cats')){

function show_all_cats($parent, $separator, $selected = "", $taxonomy) {

    if ($parent == "") {

        global $wpdb;

        $parent = 0;

    } else

        $separator .= " &ndash; ";

    $args = array(

        'parent' => $parent,

        'hide_empty' => 0,

        'taxonomy' => $taxonomy

    );

    $categories = get_categories($args);

    foreach ($categories as $category) {

        ?>

        <option <?php if ($selected == $category->slug) echo "selected"; ?> value="<?php echo $category->slug ?>"><?php echo $separator . $category->cat_name ?></option>

        <?php

        show_all_cats($category->term_id, $separator, $selected, $taxonomy);

    }

}

}

// Events Meta data save

if(! function_exists('events_meta_save')){

function events_meta_save($post_id) {

    global $wpdb;

    if (empty($_POST["sub_title"])) {

        $_POST["sub_title"] = "";

    }

    if (empty($_POST["inside_event_thumb_view"])) {

        $_POST["inside_event_thumb_view"] = "";

    }

    if (empty($_POST["inside_event_featured_image_as_thumbnail"])) {

        $_POST["inside_event_featured_image_as_thumbnail"] = "";

    }

    if (empty($_POST["inside_event_thumb_audio"])) {

        $_POST["inside_event_thumb_audio"] = "";

    }

    if (empty($_POST["inside_event_thumb_video"])) {

        $_POST["inside_event_thumb_video"] = "";

    }

    if (empty($_POST["inside_event_thumb_slider"])) {

        $_POST["inside_event_thumb_slider"] = "";

    }

    if (empty($_POST["inside_event_thumb_slider_type"])) {

        $_POST["inside_event_thumb_slider_type"] = "";

    }

    if (empty($_POST["inside_event_thumb_map_lat"])) {

        $_POST["inside_event_thumb_map_lat"] = "";

    }

    if (empty($_POST["inside_event_thumb_map_lon"])) {

        $_POST["inside_event_thumb_map_lon"] = "";

    }

    if (empty($_POST["inside_event_thumb_map_zoom"])) {

        $_POST["inside_event_thumb_map_zoom"] = "";

    }

    if (empty($_POST["inside_event_thumb_map_address"])) {

        $_POST["inside_event_thumb_map_address"] = "";

    }

    if (empty($_POST["inside_event_thumb_map_controls"])) {

        $_POST["inside_event_thumb_map_controls"] = "";

    }

    if (empty($_POST["event_social_sharing"])) {

        $_POST["event_social_sharing"] = "";

    }

    if (empty($_POST["event_buy_now"])) {

        $_POST["event_buy_now"] = "";

    }

    if (empty($_POST["event_phone_no"])) {

        $_POST["event_phone_no"] = "";

    }

    if (empty($_POST["switch_footer_widgets"])) {

        $_POST["switch_footer_widgets"] = "";

    }

    if (empty($_POST["event_start_time"])) {

        $_POST["event_start_time"] = "";

    }

    if (empty($_POST["event_end_time"])) {

        $_POST["event_end_time"] = "";

    }

    if (empty($_POST["event_all_day"])) {

        $_POST["event_all_day"] = "";

    }

    if (empty($_POST["event_address"])) {

        $_POST["event_address"] = "";

    }

    if (empty($_POST["event_map"])) {

        $_POST["event_map"] = "";

    }



    $sxe = new SimpleXMLElement("<event></event>");

    $sxe->addChild('sub_title', $_POST['sub_title']);

    $sxe->addChild('inside_event_thumb_view', $_POST['inside_event_thumb_view']);

    $sxe->addChild('inside_event_featured_image_as_thumbnail', $_POST['inside_event_featured_image_as_thumbnail']);

    $sxe->addChild('inside_event_thumb_audio', $_POST['inside_event_thumb_audio']);

    $sxe->addChild('inside_event_thumb_video', $_POST['inside_event_thumb_video']);

    $sxe->addChild('inside_event_thumb_slider', $_POST['inside_event_thumb_slider']);

    $sxe->addChild('inside_event_thumb_slider_type', $_POST['inside_event_thumb_slider_type']);

    $sxe->addChild('inside_event_thumb_map_lat', $_POST['inside_event_thumb_map_lat']);

    $sxe->addChild('inside_event_thumb_map_lon', $_POST['inside_event_thumb_map_lon']);

    $sxe->addChild('inside_event_thumb_map_zoom', $_POST['inside_event_thumb_map_zoom']);

    $sxe->addChild('inside_event_thumb_map_address', $_POST['inside_event_thumb_map_address']);

    $sxe->addChild('inside_event_thumb_map_controls', $_POST['inside_event_thumb_map_controls']);

    $sxe->addChild('event_social_sharing', $_POST["event_social_sharing"]);

    $sxe->addChild('event_buy_now', htmlspecialchars($_POST["event_buy_now"]));

    $sxe->addChild('event_phone_no', $_POST["event_phone_no"]);

    $sxe->addChild('switch_footer_widgets', $_POST["switch_footer_widgets"]);

    $sxe->addChild('event_start_time', $_POST["event_start_time"]);

    $sxe->addChild('event_end_time', $_POST["event_end_time"]);

    $sxe->addChild('event_all_day', $_POST["event_all_day"]);

    $sxe->addChild('event_address', $_POST["event_address"]);

    $sxe->addChild('event_map', $_POST["event_map"]);

    $sxe = save_layout_xml($sxe);

    update_post_meta($post_id, 'cs_event_meta', $sxe->asXML());

}

}



// Get Google Fonts

if(! function_exists('get_google_fonts')){

function get_google_fonts() {

    $fonts = array("Abel", "Aclonica", "Acme", "Actor", "Advent Pro", "Aldrich", "Allerta", "Allerta Stencil", "Amaranth", "Andika", "Anonymous Pro", "Antic", "Anton", "Arimo", "Armata", "Asap", "Asul",

        "Basic", "Belleza", "Cabin", "Cabin Condensed", "Cagliostro", "Candal", "Cantarell", "Carme", "Chau Philomene One", "Chivo", "Coda Caption", "Comfortaa", "Convergence", "Cousine", "Cuprum", "Days One",

        "Didact Gothic", "Doppio One", "Dorsa", "Dosis", "Droid Sans", "Droid Sans Mono", "Duru Sans", "Economica", "Electrolize", "Exo", "Federo", "Francois One", "Fresca", "Galdeano", "Geo", "Gudea",

        "Hammersmith One", "Homenaje", "Imprima", "Inconsolata", "Inder", "Istok Web", "Jockey One", "Josefin Sans", "Jura", "Karla", "Krona One", "Lato", "Lekton", "Magra", "Mako", "Marmelad", "Marvel",

        "Maven Pro", "Metrophobic", "Michroma", "Molengo", "Montserrat", "Muli", "News Cycle", "Nobile", "Numans", "Nunito", "Open Sans", "Open Sans Condensed", "Orbitron", "Oswald", "Oxygen", "PT Mono",

        "PT Sans", "PT Sans Caption", "PT Sans Narrow", "Paytone One", "Philosopher", "Play", "Pontano Sans", "Port Lligat Sans", "Puritan", "Quantico", "Quattrocento Sans", "Questrial", "Quicksand", "Rationale",

        "Ropa Sans", "Rosario", "Ruda", "Ruluko", "Russo One", "Shanti", "Sigmar One", "Signika", "Signika Negative", "Six Caps", "Snippet", "Spinnaker", "Syncopate", "Telex", "Tenor Sans", "Ubuntu",

        "Ubuntu Condensed", "Ubuntu Mono", "Varela", "Varela Round", "Viga", "Voltaire", "Wire One", "Yanone Kaffeesatz", "Adamina", "Alegreya", "Alegreya SC", "Alice", "Alike", "Alike Angular", "Almendra",

        "Almendra SC", "Amethysta", "Andada", "Antic Didone", "Antic Slab", "Arapey", "Artifika", "Arvo", "Average", "Balthazar", "Belgrano", "Bentham", "Bevan", "Bitter", "Brawler", "Bree Serif", "Buenard",

        "Cambo", "Cantata One", "Cardo", "Caudex", "Copse", "Coustard", "Crete Round", "Crimson Text", "Cutive", "Della Respira", "Droid Serif", "EB Garamond", "Enriqueta", "Esteban", "Fanwood Text", "Fjord One",

        "Gentium Basic", "Gentium Book Basic", "Glegoo", "Goudy Bookletter 1911", "Habibi", "Holtwood One SC", "IM Fell DW Pica", "IM Fell DW Pica SC", "IM Fell Double Pica", "IM Fell Double Pica SC",

        "IM Fell English", "IM Fell English SC", "IM Fell French Canon", "IM Fell French Canon SC", "IM Fell Great Primer", "IM Fell Great Primer SC", "Inika", "Italiana", "Josefin Slab", "Judson", "Junge",

        "Kameron", "Kotta One", "Kreon", "Ledger", "Linden Hill", "Lora", "Lusitana", "Lustria", "Marko One", "Mate", "Mate SC", "Merriweather", "Montaga", "Neuton", "Noticia Text", "Old Standard TT", "Ovo",

        "PT Serif", "PT Serif Caption", "Petrona", "Playfair Display", "Podkova", "Poly", "Port Lligat Slab", "Prata", "Prociono", "Quattrocento", "Radley", "Rokkitt", "Rosarivo", "Simonetta", "Sorts Mill Goudy",

        "Stoke", "Tienne", "Tinos", "Trocchi", "Trykker", "Ultra", "Unna", "Vidaloka", "Volkhov", "Vollkorn", "Abril Fatface", "Aguafina Script", "Aladin", "Alex Brush", "Alfa Slab One", "Allan", "Allura",

        "Amatic SC", "Annie Use Your Telescope", "Arbutus", "Architects Daughter", "Arizonia", "Asset", "Astloch", "Atomic Age", "Aubrey", "Audiowide", "Averia Gruesa Libre", "Averia Libre", "Averia Sans Libre",

        "Averia Serif Libre", "Bad Script", "Bangers", "Baumans", "Berkshire Swash", "Bigshot One", "Bilbo", "Bilbo Swash Caps", "Black Ops One", "Bonbon", "Boogaloo", "Bowlby One", "Bowlby One SC",

        "Bubblegum Sans", "Buda", "Butcherman", "Butterfly Kids", "Cabin Sketch", "Caesar Dressing", "Calligraffitti", "Carter One", "Cedarville Cursive", "Ceviche One", "Changa One", "Chango", "Chelsea Market",

        "Cherry Cream Soda", "Chewy", "Chicle", "Coda", "Codystar", "Coming Soon", "Concert One", "Condiment", "Contrail One", "Cookie", "Corben", "Covered By Your Grace", "Crafty Girls", "Creepster", "Crushed",

        "Damion", "Dancing Script", "Dawning of a New Day", "Delius", "Delius Swash Caps", "Delius Unicase", "Devonshire", "Diplomata", "Diplomata SC", "Dr Sugiyama", "Dynalight", "Eater", "Emblema One",

        "Emilys Candy", "Engagement", "Erica One", "Euphoria Script", "Ewert", "Expletus Sans", "Fascinate", "Fascinate Inline", "Federant", "Felipa", "Flamenco", "Flavors", "Fondamento", "Fontdiner Swanky",

        "Forum", "Fredericka the Great", "Fredoka One", "Frijole", "Fugaz One", "Geostar", "Geostar Fill", "Germania One", "Give You Glory", "Glass Antiqua", "Gloria Hallelujah", "Goblin One", "Gochi Hand",

        "Gorditas", "Graduate", "Gravitas One", "Great Vibes", "Gruppo", "Handlee", "Happy Monkey", "Henny Penny", "Herr Von Muellerhoff", "Homemade Apple", "Iceberg", "Iceland", "Indie Flower", "Irish Grover",

        "Italianno", "Jim Nightshade", "Jolly Lodger", "Julee", "Just Another Hand", "Just Me Again Down Here", "Kaushan Script", "Kelly Slab", "Kenia", "Knewave", "Kranky", "Kristi", "La Belle Aurore",

        "Lancelot", "League Script", "Leckerli One", "Lemon", "Lilita One", "Limelight", "Lobster", "Lobster Two", "Londrina Outline", "Londrina Shadow", "Londrina Sketch", "Londrina Solid",

        "Love Ya Like A Sister", "Loved by the King", "Lovers Quarrel", "Luckiest Guy", "Macondo", "Macondo Swash Caps", "Maiden Orange", "Marck Script", "Meddon", "MedievalSharp", "Medula One", "Megrim",

        "Merienda One", "Metamorphous", "Miltonian", "Miltonian Tattoo", "Miniver", "Miss Fajardose", "Modern Antiqua", "Monofett", "Monoton", "Monsieur La Doulaise", "Montez", "Mountains of Christmas",

        "Mr Bedfort", "Mr Dafoe", "Mr De Haviland", "Mrs Saint Delafield", "Mrs Sheppards", "Mystery Quest", "Neucha", "Niconne", "Nixie One", "Norican", "Nosifer", "Nothing You Could Do", "Nova Cut",

        "Nova Flat", "Nova Mono", "Nova Oval", "Nova Round", "Nova Script", "Nova Slim", "Nova Square", "Oldenburg", "Oleo Script", "Original Surfer", "Over the Rainbow", "Overlock", "Overlock SC", "Pacifico",

        "Parisienne", "Passero One", "Passion One", "Patrick Hand", "Patua One", "Permanent Marker", "Piedra", "Pinyon Script", "Plaster", "Playball", "Poiret One", "Poller One", "Pompiere", "Press Start 2P",

        "Princess Sofia", "Prosto One", "Qwigley", "Raleway", "Rammetto One", "Rancho", "Redressed", "Reenie Beanie", "Revalia", "Ribeye", "Ribeye Marrow", "Righteous", "Rochester", "Rock Salt", "Rouge Script",

        "Ruge Boogie", "Ruslan Display", "Ruthie", "Sail", "Salsa", "Sancreek", "Sansita One", "Sarina", "Satisfy", "Schoolbell", "Seaweed Script", "Sevillana", "Shadows Into Light", "Shadows Into Light Two",

        "Share", "Shojumaru", "Short Stack", "Sirin Stencil", "Slackey", "Smokum", "Smythe", "Sniglet", "Sofia", "Sonsie One", "Special Elite", "Spicy Rice", "Spirax", "Squada One", "Stardos Stencil",

        "Stint Ultra Condensed", "Stint Ultra Expanded", "Sue Ellen Francisco", "Sunshiney", "Supermercado One", "Swanky and Moo Moo", "Tangerine", "The Girl Next Door", "Titan One", "Trade Winds", "Trochut",

        "Tulpen One", "Uncial Antiqua", "UnifrakturCook", "UnifrakturMaguntia", "Unkempt", "Unlock", "VT323", "Vast Shadow", "Vibur", "Voces", "Waiting for the Sunrise", "Wallpoet", "Walter Turncoat",

        "Wellfleet", "Yellowtail", "Yeseva One", "Yesteryear", "Zeyada");

    return $fonts;

}

}

//Countries Array

if(! function_exists('cs_get_countries')){

function cs_get_countries() {

    $get_countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan",

        "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "British Virgin Islands",

        "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China",

        "Colombia", "Comoros", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Democratic People's Republic of Korea", "Democratic Republic of the Congo", "Denmark", "Djibouti",

        "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "England", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Fiji", "Finland", "France", "French Polynesia",

        "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong",

        "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kosovo", "Kuwait", "Kyrgyzstan",

        "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Macedonia", "Madagascar", "Malawi", "Malaysia",

        "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique",

        "Myanmar(Burma)", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Northern Ireland",

        "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Puerto Rico",

        "Qatar", "Republic of the Congo", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa",

        "San Marino", "Saudi Arabia", "Scotland", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa",

        "South Korea", "Spain", "Sri Lanka", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga",

        "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "US Virgin Islands", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay",

        "Uzbekistan", "Vanuatu", "Vatican", "Venezuela", "Vietnam", "Wales", "Yemen", "Zambia", "Zimbabwe");

    return $get_countries;

}

}

// Default xml data save

if(! function_exists('save_layout_xml')){

function save_layout_xml($sxe) {



    if (empty($_POST['page_title']))

        $_POST['page_title'] = "";

    if (empty($_POST['cs_layout']))

        $_POST['cs_layout'] = "";

    if (empty($_POST['cs_sidebar_left']))

        $_POST['cs_sidebar_left'] = "";

    if (empty($_POST['cs_sidebar_right']))

        $_POST['cs_sidebar_right'] = "";

    $sxe->addChild('page_title', $_POST['page_title']);

    $sidebar_layout = $sxe->addChild('sidebar_layout');

    $sidebar_layout->addChild('cs_layout', $_POST["cs_layout"]);

    if ($_POST["cs_layout"] == "left") {

        $sidebar_layout->addChild('cs_sidebar_left', $_POST['cs_sidebar_left']);

    } else if ($_POST["cs_layout"] == "right") {

        $sidebar_layout->addChild('cs_sidebar_right', $_POST['cs_sidebar_right']);

    } else if ($_POST["cs_layout"] == "both_right" or $_POST["cs_layout"] == "both_left" or $_POST["cs_layout"] == "both") {

        $sidebar_layout->addChild('cs_sidebar_left', $_POST['cs_sidebar_left']);

        $sidebar_layout->addChild('cs_sidebar_right', $_POST['cs_sidebar_right']);

    }

    return $sxe;

}

}

// installing tables on theme activating start

global $pagenow;



if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php') {

    // Theme default widgets activation

    add_action('admin_head', 'cs_activate_widget');

    if (!get_option('cs_theme_option')) {

        wp_redirect(admin_url('admin.php?page=cs_demo_importer'));

    }

if(! function_exists('cs_activate_widget')){

    function cs_activate_widget() {

        $sidebars_widgets = get_option('sidebars_widgets');  //collect widget informations

        // ---- calendar widget setting---

        $calendar = array();

        $calendar[1] = array(

            "title" => 'Calendar'

        );



        $calendar['_multiwidget'] = '1';

        update_option('widget_calendar', $calendar);

        $calendar = get_option('widget_calendar');

        krsort($calendar);

        foreach ($calendar as $key1 => $val1) {

            $calendar_key = $key1;

            if (is_int($calendar_key)) {

                break;

            }

        }

        //---Blog Categories

        $categories = array();

        $categories[1] = array(

            "title" => 'Categories',

            "count" => 'checked'

        );



        $calendar['_multiwidget'] = '1';

        update_option('widget_categories', $categories);

        $categories = get_option('widget_categories');

        krsort($categories);

        foreach ($categories as $key1 => $val1) {

            $categories_key = $key1;

            if (is_int($categories_key)) {

                break;

            }

        }



        // ----   recent post with thumbnail widget setting---

        $recent_post_widget = array();

        $recent_post_widget[1] = array(

            "title" => 'Latest Posts',

            "select_category" => 'mercy',

            "showcount" => '4',

            "thumb" => 'true'

        );

        $recent_post_widget['_multiwidget'] = '1';

        update_option('widget_recentposts', $recent_post_widget);

        $recent_post_widget = get_option('widget_recentposts');

        krsort($recent_post_widget);

        foreach ($recent_post_widget as $key1 => $val1) {

            $recent_post_widget_key = $key1;

            if (is_int($recent_post_widget_key)) {

                break;

            }

        }

        // ----   recent post without thumbnail widget setting---

        $recent_post_widget2 = array();

        $recent_post_widget2 = get_option('widget_recentposts');

        $recent_post_widget2[2] = array(

            "title" => 'Latest Posts',

            "select_category" => 'mercy',

            "showcount" => '2',

            "thumb" => 'false'

        );

        $recent_post_widget2['_multiwidget'] = '1';

        update_option('widget_recentposts', $recent_post_widget2);

        $recent_post_widget2 = get_option('widget_recentposts');

        krsort($recent_post_widget2);

        foreach ($recent_post_widget2 as $key1 => $val1) {

            $recent_post_widget_key2 = $key1;

            if (is_int($recent_post_widget_key2)) {

                break;

            }

        }

        // ----   recent event widget setting---

        $upcoming_events_widget = array();

        $upcoming_events_widget[1] = array(

            "title" => 'Upcoming Events',

            "get_post_slug" => 'our-events',

            "showcount" => '4',

        );

        $upcoming_events_widget['_multiwidget'] = '1';

        update_option('widget_upcoming_events', $upcoming_events_widget);

        $upcoming_events_widget = get_option('widget_upcoming_events');

        krsort($upcoming_events_widget);

        foreach ($upcoming_events_widget as $key1 => $val1) {

            $upcoming_events_widget_key = $key1;

            if (is_int($upcoming_events_widget_key)) {

                break;

            }

        }

        // ---- tags widget setting---

        $tag_cloud = array();

        $tag_cloud[1] = array(

            "title" => 'Tags',

            "taxonomy" => 'category',

        );

        $tag_cloud['_multiwidget'] = '1';

        update_option('widget_tag_cloud', $tag_cloud);

        $tag_cloud = get_option('widget_tag_cloud');

        krsort($tag_cloud);

        foreach ($tag_cloud as $key1 => $val1) {

            $tag_cloud_key = $key1;

            if (is_int($tag_cloud_key)) {

                break;

            }

        }

        // --- text widget setting ---

        $text = array();

        $text[1] = array(

            'title' => '',

            'text' => '<a href="' . site_url() . '/?events=lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit-1"><img src="' . get_template_directory_uri() . '/images/add.jpg" alt="" /></a>',

        );

        $text['_multiwidget'] = '1';

        update_option('widget_text', $text);

        $text = get_option('widget_text');

        krsort($text);

        foreach ($text as $key1 => $val1) {

            $text_key = $key1;

            if (is_int($text_key)) {

                break;

            }

        }

        // --- text widget About Our Team setting ---

        $text2 = array();

        $text2 = get_option('widget_text');

        $text2[2] = array(

            'title' => 'deans message',

            'text' => '[tab style="horizontal"]

						[tab_item active="yes" icon="" title="Donec" tabs="tabs"]<strong>Donec rutrum lor em at justo luctus Nulla facilisi Class aptent taciti...</strong>any good people who know and believe good theology find themselves in tall weeds because of physical, emotional, and spiritual exhausted. Deep fatigue has left them vulnerable so that their souls are at risk.In part the answer lies with our compulsions to do more than we are...[/tab_item]

						[tab_item icon="" title="Justo" tabs="tabs"]<strong>Donec rutrum lor em at justo luctus Nulla facilisi Class aptent taciti...</strong>any good people who know and believe good theology find themselves in tall weeds because of physical, emotional, and spiritual exhausted. Deep fatigue has left them vulnerable so that their souls are at risk.In part the answer lies with our compulsions to do more than we are...[/tab_item]

						[tab_item icon="" title="Nulla" tabs="tabs"]<strong>Donec rutrum lor em at justo luctus Nulla facilisi Class aptent taciti...</strong>any good people who know and believe good theology find themselves in tall weeds because of physical, emotional, and spiritual exhausted. Deep fatigue has left them vulnerable so that their souls are at risk.In part the answer lies with our compulsions to do more than we are...[/tab_item]

						[/tab]',

        );

        $text2['_multiwidget'] = '1';

        update_option('widget_text', $text2);

        $text2 = get_option('widget_text');

        krsort($text2);

        foreach ($text2 as $key1 => $val1) {

            $text_key2 = $key1;

            if (is_int($text_key2)) {

                break;

            }

        }

        // --- text widget About Our Team setting ---

        $text3 = array();

        $text3 = get_option('widget_text');

        $text3[3] = array(

            'title' => 'About Resturant',

            'text' => ' <p>Donecccumsan et eleifend  massa orci, accumsan et eleifend ut, ultrices sit amet lacus. Vestibulum ante ipsum primis in faucibus orci luc+tus et ultrices youtube. Donecccumsan et eleifend  massa orci, accumsan et eleifend ut, ultrices sit amet lacus.</p>

                <a class="backcolr uppercase" href="#">Buy Theme</a>',

        );

        $text3['_multiwidget'] = '1';

        update_option('widget_text', $text3);

        $text3 = get_option('widget_text');

        krsort($text3);

        foreach ($text3 as $key1 => $val1) {

            $text_key3 = $key1;

            if (is_int($text_key3)) {

                break;

            }

        }



        // --- gallery widget setting ---

        $albums = array();

        $albums[1] = array(

            'title' => 'Our Photos',

            'get_names_gallery' => 'gallery',

            'showcount' => '12'

        );

        $albums['_multiwidget'] = '1';

        update_option('widget_albums', $albums);

        $albums = get_option('widget_albums');

        krsort($albums);

        foreach ($albums as $key1 => $val1) {

            $albums_key = $key1;

            if (is_int($albums_key)) {

                break;

            }

        }

        // ---- archive widget setting---

        $archives = array();

        $archives[1] = array(

            "title" => 'Archives',

            "count" => 'checked',

            "dropdown" => ''

        );

        $archives['_multiwidget'] = '1';

        update_option('widget_chimp_archives', $archives);

        $archives = get_option('widget_chimp_archives');

        krsort($archives);

        foreach ($archives as $key1 => $val1) {

            $archives_key = $key1;

            if (is_int($archives_key)) {

                break;

            }

        }



        // ---- search widget setting---		

        $search = array();

        $search[1] = array(

            "title" => '',

        );

        $search['_multiwidget'] = '1';

        update_option('widget_search', $search);

        $search = get_option('widget_search');

        krsort($search);

        foreach ($search as $key1 => $val1) {

            $search_key = $key1;

            if (is_int($search_key)) {

                break;

            }

        }

        // ---- twitter widget setting---

        $cs_twitter_widget = array();

        $cs_twitter_widget[1] = array(

            "title" => 'Twitter',

            "username" => "envato",

            "numoftweets" => "2",

        );

        $cs_twitter_widget['_multiwidget'] = '1';

        update_option('widget_twitter_widget', $cs_twitter_widget);

        $cs_twitter_widget = get_option('widget_twitter_widget');

        krsort($cs_twitter_widget);

        foreach ($cs_twitter_widget as $key1 => $val1) {

            $cs_twitter_widget_key = $key1;

            if (is_int($cs_twitter_widget_key)) {

                break;

            }

        }

        // --- facebook widget setting-----

        $facebook_module = array();

        $facebook_module[1] = array(

            "title" => 'facebook',

            "pageurl" => "https://www.facebook.com/envato",

            "showfaces" => "on",

            "likebox_height" => "265",

            "fb_bg_color" => "#F5F2F2",

        );

        $facebook_module['_multiwidget'] = '1';

        update_option('widget_facebook_module', $facebook_module);

        $facebook_module = get_option('widget_facebook_module');

        krsort($facebook_module);

        foreach ($facebook_module as $key1 => $val1) {

            $facebook_module_key = $key1;

            if (is_int($facebook_module_key)) {

                break;

            }

        }

        //----text widget for contact info----------

        $text5 = array();

        $text5 = get_option('widget_text');

        $text5[5] = array(

            'title' => 'Accordion',

            'text' => '[accordion]

			[accordion_item active="yes" icon="" title="Qualified Full-time Professional" accordion="accordion"]Qualified Full-time Professional Master Photographer Andrew Gransden photographs weddings, portraits, wildlife and nature, commercial and businesses across Scotland from Aberdeen to Inverness..[/accordion_item]

			[accordion_item title="Commercial and businesses across" accordion="accordion"]Qualified Full-time Professional Master Photographer Andrew Gransden photographs weddings, portraits, wildlife and nature, commercial and businesses across Scotland from Aberdeen to Inverness..[/accordion_item]

			[accordion_item title="Businesses across Scotland from" accordion="accordion"]Qualified Full-time Professional Master Photographer Andrew Gransden photographs weddings, portraits, wildlife and nature, commercial and businesses across Scotland from Aberdeen to Inverness..[/accordion_item]

			[/accordion]',

        );



        $text5['_multiwidget'] = '1';

        update_option('widget_text', $text5);

        $text5 = get_option('widget_text');

        krsort($text5);

        foreach ($text5 as $key1 => $val1) {

            $text_key5 = $key1;

            if (is_int($text_key5)) {

                break;

            }

        }

        //----text widget for contact info----------

        $text6 = array();

        $text6 = get_option('widget_text');

        $text6[6] = array(

            'title' => 'Toggle',

            'text' => '[toggle active="yes" title="Toggle Title 1"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ac arcu aliquet sem varius interdum vel quis odio. Nulla adipiscing ipsum sit amet neque egestas sagittis.[/toggle]',

        );

        $text6['_multiwidget'] = '1';

        update_option('widget_text', $text6);

        $text6 = get_option('widget_text');

        krsort($text6);

        foreach ($text6 as $key1 => $val1) {

            $text_key6 = $key1;

            if (is_int($text_key6)) {

                break;

            }

        }

        //----text widget for footer----------

        $text7 = array();

        $text7 = get_option('widget_text');

        $text7[7] = array(

            'title' => '',

            'text' => '<a href="#"><img alt="" src="https://chimpgroup.com/wp-demo/mercycorp/wp-content/themes/mercycorp/images/footer-logo.png"></a>

				<p>The Statfort University<br>

				1234 South Lipsum Avenue, NewYork<br>

				United States , 123456</p>

				<ul>

					<li>

						<i class="icon-phone"></i>

						<span>Phone : 12345678</span>

					</li>

					<li>

						<i class="icon-print"></i>

						<span>Fax: 123456789</span>

					</li>

				<li>

						<i class="icon-envelope-alt"></i>

						<a href="#">Email: info@mercywordpress.com</a>

					</li>

				<li>

						<i class="icon-skype"></i>

						<span>mercywordpress</span>

					</li>

				</ul>',

        );

        $text7['_multiwidget'] = '1';

        update_option('widget_text', $text7);

        $text7 = get_option('widget_text');

        krsort($text7);

        foreach ($text7 as $key1 => $val1) {

            $text_key7 = $key1;

            if (is_int($text_key7)) {

                break;

            }

        }

        // Add widgets in sidebars

        $sidebars_widgets['Sidebar'] = array("search-$search_key", "categories-$categories_key", "recentposts-$recent_post_widget_key", "upcoming_events-$upcoming_events_widget_key", "albums-$albums_key", "chimp_archives-$archives_key");

        $sidebars_widgets['Event Detail'] = array("search-$search_key", "categories-$categories_key", "recentposts-$recent_post_widget_key", "upcoming_events-$upcoming_events_widget_key", "albums-$albums_key", "chimp_archives-$archives_key");

        $sidebars_widgets['footer-widget'] = array("text-$text_key7", "twitter_widget-$cs_twitter_widget_key", "albums-$albums_key", "categories-$categories_key");

        update_option('sidebars_widgets', $sidebars_widgets);  //save widget iformations

    }

}

    // Install data on theme activation

    



}



add_action('init', 'install_tables');

if(! function_exists('install_tables')){

function install_tables() {

        global $wpdb;

        $args = array(

            'style_sheet' => 'custom',

            'custom_color_scheme' => '#0464b9',

            'banner_color_scheme' => '#0464b9',

            'banner_color' => 'on',

            'layout_option' => 'wrapper',

            // Banner Backgorung Color

            'banner_bg_color' => '#0464b9',

            // footer Color Settigs

            'header_styles' => 'header1',

            'default_header' => 'header1',

            // HEADER SETTINGS

            'header_logo' => 'on',

            'header_slogan' => 'on',

            'header_top_menu' => 'on',

            'header_languages' => '',

            'header_cart' => '',

            'header_social_icons' => 'on',

            'header_next_event' => 'our-event',

            'show_beadcrumbs' => 'on',

            'bg_img' => '0',

            'bg_img_custom' => '',

            'bg_position' => 'center',

            'bg_repeat' => 'no-repeat',

            'bg_attach' => 'fixed',

            'pattern_img' => '0',

            'custome_pattern' => '',

            'bg_color' => '',

            'logo' => get_template_directory_uri() . '/images/logo.png',

            'logo_width' => '146',

            'logo_height' => '41',

            'header_sticky_menu' => 'on',

            'fav_icon' => get_template_directory_uri() . '/images/favicon.ico',

            'header_code' => '',

            'header_link_title' => '',

            'header_link_url' => '',

            'footer_bg_img' => get_template_directory_uri() . '/images/footer_bg.jpg',

            'footer_logo' => get_template_directory_uri() . '/images/footer-logo.png',

            'copyright' => '&copy;' . gmdate("Y") . " " . get_option("blogname") . " Wordpress All rights reserved.",

            'powered_by' => '<a href="#">Design by ChimpStudio</a>',

            'powered_icon' => '',

            'analytics' => '',

            'responsive' => 'on',

            'style_rtl' => '',

            'paypal_email' => 'paypal@chimp.com',

            'paypal_ipn_url' => get_template_directory_uri() . '/include/ipn.php',

            'paypal_currency' => 'USD',

            'paypal_currency_sign' => '$',

            // switchers

            'color_switcher' => '',

            'trans_switcher' => '',

            'show_slider' => '',

            'slider_name' => '',

            'slider_type' => '',

            'show_partners' => 'none',

            'partners_title' => 'Our Partners',

            'partners_gallery' => '',

            'show_posts' => '',

            'post_title' => '',

            'post_cat' => '',

            'all_cat' => array(),

            'sidebar' => array('Sidebar', 'Contact us', 'Event Detail', 'Shop'),

            //Fonts

            'content_size' => '12',

            'content_size_g_font' => '',

            // slider setting

            'flex_effect' => 'fade',

            'flex_auto_play' => 'on',

            'flex_animation_speed' => '7000',

            'flex_pause_time' => '600',

            'slider_id' => '',

            'slider_view' => '',

            'social_net_title' => '',

            'social_net_icon_path' => array('', '', '', '', '', '', '', '', ''),

            'social_net_awesome' => array('icon-facebook', 'icon-google-plus', 'icon-linkedin', 'icon-pinterest', 'icon-twitter', 'icon-youtube', 'icon-tumblr', 'icon-instagram', ' icon-flickr'),

            'social_net_url' => array('Facebook URL', 'Google-plus URL', 'Linked-in URL', 'Pinterest URL', 'Twitter URL', 'Youtube URL', 'Tumblr URL', 'Instagram URL', 'Flickr URL'),

            'social_net_tooltip' => array('Facebook', 'Google-plus', 'Linked-in', 'Pinterest', 'Twitter', 'Youtube', 'Tumblr', 'Instagram', 'Flickr'),

            'facebook_share' => 'on',

            'twitter_share' => 'on',

            'linkedin_share' => 'on',

            'pinterest_share' => 'on',

            'tumblr_share' => 'on',

            'google_plus_share' => 'on',

            'cs_other_share' => 'on',

            'mailchimp_key' => '',

            // tranlations

            'trans_timeleft' => 'Time Left',

            'trans_add_to_calendar' => 'Add',

            'trans_outlook_calendar' => 'Outlook Calendar',

            'trans_google_calendar' => 'Google Calendar',

            'trans_yahoo_calendar' => 'Yahoo Calendar',

            'trans_ical_calendar' => 'iCal Calendar',

            'trans_buynow' => 'Buy Now',

            'res_first_name' => 'First Name',

            'res_last_name' => 'Last Name',

            'trans_subject' => 'Subject',

            'trans_message' => 'Message',

            'cause_raised' => 'Raised',

            'cause_goal' => 'Goal',

            'cause_donors' => 'Donors',

            'cause_donate' => 'Donate',

            'cause_donation' => 'Donation',

            'cause_status' => 'Closed',

            'trans_share_this_post' => 'Share Now',

            'trans_content_404' => "It seems we can not find what you are looking for.",

            'trans_featured' => 'Featured',

            'trans_listed_in' => 'Listed in',

            'trans_read_more' => 'Ler mais',

            'trans_current_page' => 'Página Actual',

            'trans_load_more' => 'Load More',

            'trans_special_request' => 'Special Request',

            'trans_email_published' => '*Your Email will never published.',

            // Daily Opening Hours for: 

            'trans_opening_hours_monday' => 'Monday',

            'trans_opening_hours_tuesday' => 'Tuesday',

            'trans_opening_hours_wednesday' => 'Wednesday',

            'trans_opening_hours_thursday' => 'Thursday',

            'trans_opening_hours_friday' => 'Friday',

            'trans_opening_hours_saturday' => 'Saturday',

            'trans_opening_hours_sunday' => 'Sunday',

            // translation end

            'pagination' => 'Show Pagination',

            'record_per_page' => '5',

            'cs_layout' => 'none',

            'cs_sidebar_left' => '',

            'cs_sidebar_right' => '',

            'under-construction' => '',

            'showlogo' => 'on',

            'socialnetwork' => 'on',

            'under_construction_text' => '<h1 class="colr">OUR WEBSITE IS UNDERCONSTRUCTION</h1><p>We shall be here soon with a new website, Estimated Time Remaining</p>',

            'launch_date' => '2014-10-24',

            'consumer_key' => '',

            'consumer_secret' => '',

            'access_token' => '',

            'access_token_secret' => '',

        );

        /* Merge Heaser styles

         */

		

		if( ! get_option("cs_theme_option") ) {

        	update_option("cs_theme_option", $args);

		}

        update_option("cs_theme_option_restore", $args);

    }

}

// Admin scripts enqueue

if(! function_exists('cs_admin_scripts_enqueue')){

function cs_admin_scripts_enqueue() {

    $template_path = get_template_directory_uri() . '/scripts/admin/media_upload.js';

    wp_enqueue_script('my-upload', $template_path, array('jquery', 'media-upload', 'thickbox', 'jquery-ui-droppable', 'jquery-ui-datepicker', 'jquery-ui-slider', 'wp-color-picker'));

    wp_enqueue_script('custom_wp_admin_script', get_template_directory_uri() . '/scripts/admin/cs_functions.js');

    wp_enqueue_style('custom_wp_admin_style', get_template_directory_uri() . '/css/admin/admin-style.css', array('thickbox'), time() ); 

    wp_enqueue_style('wp-color-picker');

}

}

add_action('admin_enqueue_scripts', 'cs_admin_scripts_enqueue');

// Backend functionality files



require_once (TEMPLATEPATH . '/include/event.php');

require_once (TEMPLATEPATH . '/include/slider.php');

require_once (TEMPLATEPATH . '/include/gallery.php');

require_once (TEMPLATEPATH . '/include/page_builder.php');

require_once (TEMPLATEPATH . '/include/post_meta.php');

require_once (TEMPLATEPATH . '/include/short_code.php');

require_once (TEMPLATEPATH . '/include/cs_cause.php');

require_once (TEMPLATEPATH . '/functions-theme.php');

require_once (TEMPLATEPATH . '/include/ical/iCalcreator.class.php');

require_once (TEMPLATEPATH . '/include/mailchimpapi/mailchimpapi.class.php');

require_once (TEMPLATEPATH . '/include/mailchimpapi/chimp_mc_plugin.class.php');

require_once (TEMPLATEPATH . '/include/widgets/cs_widget_book_appointment.php');

require_once (TEMPLATEPATH . '/include/widgets/cs_widget_opening_hours.php');



/////// Require Woocommerce///////



require_once (TEMPLATEPATH . '/include/config_woocommerce/config.php');

require_once (TEMPLATEPATH . '/include/config_woocommerce/product_meta.php');



/////////////////////////////////



if (current_user_can('administrator')) {

    // Addmin Menu CS Theme Option

    require_once (TEMPLATEPATH . '/include/theme_option.php');

    add_action('admin_menu', 'cs_theme');

if(! function_exists('cs_theme')){

    function cs_theme() {

        add_theme_page('CS Theme Option', __('CS Theme Option', 'Mercycorp'), 'read', 'cs_theme_options', 'theme_option');

        add_theme_page("Import Demo Data", __("Import Demo Data", 'Mercycorp'), 'read', 'cs_demo_importer', 'cs_demo_importer');

    }

}



}



// add short code in widget area

add_filter('widget_text', 'do_shortcode');





if (!session_id())

//	session_start();

    //add_action('init', 'session_start');



// add twitter option in user profile\

if(! function_exists('cs_contact_options')){

function cs_contact_options($contactoptions) {

    $contactoptions['twitter'] = 'Twitter';

    return $contactoptions;

}

}

add_filter('user_contactmethods', 'cs_contact_options', 10, 1);



// Template redirect in single Gallery and Slider page

if(! function_exists('cs_slider_gallery_template_redirect')){

function cs_slider_gallery_template_redirect() {

    if (get_post_type() == "albums" or get_post_type() == "cs_slider") {

        global $wp_query;

        $wp_query->set_404();

        status_header(404);

        get_template_part(404);

        exit();

    }

}

}

// enque style and scripts

if(! function_exists('cs_front_scripts_enqueue')){

function cs_front_scripts_enqueue() {

    global $cs_theme_option;

    if (!is_admin()) {

        wp_enqueue_style('style_css', get_stylesheet_uri());

        if ($cs_theme_option['color_switcher'] == "on") {

            wp_enqueue_style('color-switcher_css', get_template_directory_uri() . '/css/color-switcher.css');

        }

        wp_enqueue_style('bootstrap_css', get_template_directory_uri() . '/css/bootstrap.css');

        wp_enqueue_style('font-awesome_css', get_template_directory_uri() . '/css/font-awesome.css');

        wp_enqueue_style('font-awesome-ie7_css', get_template_directory_uri() . '/css/font-awesome-ie7.css');

        wp_enqueue_style('widget_css', get_template_directory_uri() . '/css/widget.css');

        wp_enqueue_style('shortcode_css', get_template_directory_uri() . '/css/shortcode.css');

        // Register stylesheet

        // Apply IE conditionals  

        $GLOBALS['wp_styles']->add_data('font-awesome-ie7_css', 'conditional', 'lte IE 9');

        // Enqueue stylesheet

        wp_enqueue_style('font-awesome-ie7_css');

        wp_enqueue_style('wp-mediaelement');

        wp_enqueue_script('jquery');

        wp_enqueue_script('wp-mediaelement');

        wp_enqueue_script('bootstrap_js', get_template_directory_uri() . '/scripts/frontend/bootstrap.min.js', '', '', true);

        wp_enqueue_script('bootstrap_js', get_template_directory_uri() . '/scripts/frontend/bootstrap.min.js', '', '', true);



        wp_enqueue_script('slick_js', get_template_directory_uri() . '/scripts/frontend/slick.min.js', '', '', true);





        if ($cs_theme_option['style_rtl'] == "on") {

            wp_enqueue_style('rtl_css', get_template_directory_uri() . '/css/rtl.css');

        }

        if ($cs_theme_option['responsive'] == "on") {

            echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">';

            wp_enqueue_style('responsive_css', get_template_directory_uri() . '/css/responsive.css');

        }

        if (class_exists('Woocommerce')) {

            wp_enqueue_style('cs_woocommerce_css', get_template_directory_uri() . '/css/cs_woocommerce.css');

        }



        function cs_enqueue_video_style_script() {

            wp_enqueue_script('cs_video_script', get_template_directory_uri() . '/scripts/frontend/jquery.fitvids.js', '', '', true);

        }



        wp_enqueue_script('functions_js', get_template_directory_uri() . '/scripts/frontend/functions.js', '0', '', true);

    }

}

}

add_action('wp_enqueue_scripts', 'cs_front_scripts_enqueue');



// Gallery Script Enqueue

if(! function_exists('cs_enqueue_gallery_style_script')){

function cs_enqueue_gallery_style_script() {

    wp_enqueue_style('prettyPhoto_css', get_template_directory_uri() . '/css/magnific-popup.css');

    wp_enqueue_script('prettyPhoto_js', get_template_directory_uri() . '/scripts/frontend/jquery.magnific-popup.min.js', '', '', true);

    wp_enqueue_script('touch_swipe', get_template_directory_uri() . '/scripts/frontend/touchSwipe.js', '', '', true);

}

}

// Masonry Style and Script enqueue

if(! function_exists('cs_enqueue_masonry_style_script')){

function cs_enqueue_masonry_style_script() {

    wp_enqueue_style('masonry_css', get_template_directory_uri() . '/css/masonry.css');

    wp_enqueue_script('jquery.masonry_js', get_template_directory_uri() . '/scripts/frontend/jquery.masonry.min.js', '', '', true);

}

}

// Validation Script Enqueue

if(! function_exists('cs_enqueue_validation_script')){

function cs_enqueue_validation_script() {

    wp_enqueue_script('jquery.validate.metadata_js', get_template_directory_uri() . '/scripts/admin/jquery.validate.metadata.js', '', '', true);

    wp_enqueue_script('jquery.validate_js', get_template_directory_uri() . '/scripts/admin/jquery.validate.js', '', '', true);

}

}

// Filterable Style enqueue

if(! function_exists('cs_enqueue_filterable_style_script')){

function cs_enqueue_filterable_style_script() {

    wp_enqueue_script('filterable_js', get_template_directory_uri() . '/scripts/frontend/filterable.js', '', '', true);

}

}



// Flexslider Script and style enqueue

if(! function_exists('cs_enqueue_flexslider_script')){

function cs_enqueue_flexslider_script() {

    wp_enqueue_script('jquery.flexslider-min_js', get_template_directory_uri() . '/scripts/frontend/jquery.flexslider-min.js', '', '', true);

    wp_enqueue_style('flexslider_css', get_template_directory_uri() . '/css/flexslider.css');

}

}



// Skills Circle Porgress bar script enqueue

if(! function_exists('cs_circular_progress_script')){

function cs_circular_progress_script() {

    wp_enqueue_script('circular_progress_js', get_template_directory_uri() . '/scripts/frontend/circular-progress.js', '', '', true);

}

}

// Skills Circle Porgress bar script enqueue

if(! function_exists('cs_scrolltofixed_script')){

function cs_scrolltofixed_script() {

    wp_enqueue_script('sticky_scrolltofixed_js', get_template_directory_uri() . '/scripts/frontend/jquery-scrolltofixed.js', '', '', true);

}

}

if(! function_exists('cs_enqueue_jcycle_script')){



function cs_enqueue_jcycle_script() {

    wp_enqueue_script('jquerycycle2_js', get_template_directory_uri() . '/scripts/frontend/jquerycycle2.js', '', '', false);

    wp_enqueue_script('cycle2carousel_js', get_template_directory_uri() . '/scripts/frontend/cycle2carousel.js', '', '', false);

}

}

if(! function_exists('cs_enqueue_tinycarousel_script')){



function cs_enqueue_tinycarousel_script() {

    wp_enqueue_script('tinycarousel_js', get_template_directory_uri() . '/scripts/frontend/jquery.tinycarousel.min.js', '', '', false);

    //wp_enqueue_style('tiny-carousel_css', get_template_directory_uri() . '/css/tiny-carousel.css');

}

}

// Flexslider Script and style enqueue

if(! function_exists('cs_enqueue_countdown_script')){

function cs_enqueue_countdown_script() {

    wp_enqueue_script('jquery.countdown_js', get_template_directory_uri() . '/scripts/frontend/jquery.countdown.js', '', '', true);

}

}

/*if(! function_exists('cs_addthis_script_init_method')){

function cs_addthis_script_init_method() {

    if (is_single()) {

        wp_enqueue_script('cs_addthis', 'http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e4412d954dccc64', ",", 'true');

    }

}

}*/

// Event Calendar enqueue Script

if(! function_exists('cs_calender_enqueue_scripts')){

function cs_calender_enqueue_scripts() {

    wp_enqueue_script('calender_js', get_template_directory_uri() . '/scripts/frontend/fullcalendar.min.js', '', '', TRUE);

    wp_enqueue_style('fullcalendar_css', get_template_directory_uri() . '/css/fullcalendar.css');

}

}



// Favicon and header code in head tag//

if(! function_exists('cs_header_settings')){

function cs_header_settings() {

    global $cs_theme_option;

    ?>

    <link rel="shortcut icon" href="<?php echo $cs_theme_option['fav_icon'] ?>" />

    <!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->



    <?php

    echo htmlspecialchars_decode($cs_theme_option['header_code']);

}

}



// Favicon and header code in head tag//

if(! function_exists('cs_footer_settings')){

function cs_footer_settings() {

    global $cs_theme_option;

    ?>



                             <!--[if lt IE 9]><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" /><![endif]-->



    <?php

    echo htmlspecialchars_decode($cs_theme_option['analytics']);

}

}

// Get Header Name

if(! function_exists('cs_get_header_name')){

function cs_get_header_name() {

    global $post, $cs_theme_option;

    if (isset($_POST['header_styles'])) {

        $_SESSION['sess_header_styles'] = $_POST['header_styles'];

        $header_styles = $_SESSION['sess_header_styles'];

    } else if (!empty($_SESSION['sess_header_styles'])) {

        $header_styles = $_SESSION['sess_header_styles'];

    } else if (is_page()) {

        $cs_page_builder = get_post_meta($post->ID, "cs_page_builder", true);

        if ($cs_page_builder <> '') {

            $cs_xmlObject = new SimpleXMLElement($cs_page_builder);

            $header_styles = $cs_xmlObject->header_styles;

            if ($header_styles == '' or $header_styles == 'default-header') {

                $header_styles = $cs_theme_option['default_header'];

            }

        } else {

            $header_styles = $cs_theme_option['default_header'];

        }

    } else {

        $header_styles = $cs_theme_option['default_header'];

    }

    return $header_styles;

}

}

// Home page Slider //

if(! function_exists('cs_get_home_slider')){

function cs_get_home_slider() {

    global $cs_theme_option;

    if ($cs_theme_option['show_slider'] == "on" and $cs_theme_option['slider_type'] <> "Revolution Slider") {

        ?>

        <div id="banner">

            <?php

            if ($cs_theme_option['layout_option'] == "wrapper") {

                $width = 1900;

                $height = 529;

            } else {

                $width = 1170;

                $height = 490;

            }

            $slider_slug = $cs_theme_option['slider_name'];

            if ($slider_slug <> '') {

                $args = array(

                    'name' => $slider_slug,

                    'post_type' => 'cs_slider',

                    'post_status' => 'publish',

                    'showposts' => 1,

                );

                $get_posts = get_posts($args);

                if ($get_posts) {

                    $slider_id = $get_posts[0]->ID;

                    if ($cs_theme_option['slider_type'] == 'Flex Slider') {

                        cs_flex_slider($width, $height, $slider_id);

                    }

                } else {

                    $slider_id = '';

                    echo '<div class="box-small no-results-found heading-color"> <h5>';

                    _e("No results found.", 'Mercycorp');

                    echo ' </h5></div>';

                }

            }

            ?>

        </div>

        <?php

    } else {

        echo do_shortcode(htmlspecialchars_decode($cs_theme_option['slider_id']));

    }

}

}

// Page Sub header title and subtitle //

if(! function_exists('get_subheader_title')){

function get_subheader_title() {

    global $post, $wp_query;

    ;

    $show_title = true;

    $show_subtitle = true;

    $subtitle = '';

    $get_title = '';

    if (is_page() || is_single()) {

        if (is_page()) {

            $cs_xmlObject = cs_meta_page('cs_page_builder');

            if (isset($cs_xmlObject)) {

                if ($cs_xmlObject->page_title == "No") {

                    $show_title = false;

                }

                $subtitle = $cs_xmlObject->page_sub_title;

            }

            if (isset($show_title) && $show_title == true) {

                $get_title = '<div class="subtitle"><h2 class="page-title">' . substr(get_the_title(), 0, 80) . '</h2></div>';

            }

        } elseif (is_single()) {

            $post_type = get_post_type($post->ID);

            if ($post_type == "events") {

                $post_type = "cs_event_meta";

            } else {

                $post_type = "post";

            }

            $post_xml = get_post_meta($post->ID, $post_type, true);

            if ($post_xml <> "") {

                $cs_xmlObject = new SimpleXMLElement($post_xml);

            }

            if (isset($cs_xmlObject) && $cs_xmlObject->sub_title <> "") {

                $subtitle = $cs_xmlObject->sub_title;

            }

            $show_title = true;

            $show_subtitle = true;

            if (isset($show_title) && $show_title == true) {

                $get_title = '<h2 class="page-title">' . get_the_title() . '</h2>';

            }

        }

        if (isset($show_title) && $show_title == true) {

            echo $get_title;

        }

        if (isset($subtitle) && $subtitle <> '') {

            echo '<p>' . $subtitle . '</p>';

        }

    } else {

        ?>

        <h2 class="page-title"><?php cs_post_page_title(); ?></h2>



        <?php

    }

}



}

// character limit 

if(! function_exists('cs_character_limit')){

function cs_character_limit($string = '', $start_limit = '', $end_limit = '') {

    return substr($string, $start_limit, $end_limit) . "...";

}

}

// like counter funtion

if(! function_exists('cs_like_counter')){

function cs_like_counter($post_id = '') {

    global $cs_theme_option, $post;

    $cs_like_counter = '';

    $cs_like_counter = get_post_meta(get_the_id(), "cs_like_counter", true);

    if (!isset($cs_like_counter) or empty($cs_like_counter))

        $cs_like_counter = 0;

    if (isset($_COOKIE["cs_like_counter" . get_the_id()]) and $cs_like_counter > 0) {

        echo '<a>' . $cs_like_counter . '</a>';

    } else {

        ?>

        <a href="javascript:cs_like_counter('<?php echo get_template_directory_uri() ?>',<?php echo get_the_id() ?>)" class="btnlike" id="like_this<?php echo get_the_id() ?>"><?php echo $cs_like_counter; ?></a>

        <a class="btnlike" id="like_counter<?php echo get_the_id() ?>" style="display:none;"><?php echo $cs_like_counter; ?></a>

        <div id="loading_div<?php echo get_the_id() ?>" style="display:none;"><img src="<?php echo get_template_directory_uri() ?>/images/ajax-loader.gif" /></div>

        <?php

    }

}

}

// hide figure tag on post list page

if(! function_exists('cs_hide_figure')){

function cs_hide_figure($post_xml, $image_url = '') {

    if ($post_xml <> "") {

        $cs_xmlObject = new SimpleXMLElement($post_xml);

        $flag = 'true';

        if ($cs_xmlObject->post_thumb_audio == '' and $cs_xmlObject->post_thumb_view == "Audio") {

            $flag = 'false';

        } elseif ($cs_xmlObject->post_thumb_video == '' and $cs_xmlObject->post_thumb_view == "Video") {

            $flag = 'false';

        } elseif ($cs_xmlObject->post_thumb_slider == '' and $cs_xmlObject->post_thumb_view == "Slider") {

            $flag = 'false';

        } elseif ($image_url == '' and $cs_xmlObject->post_thumb_view == "Single Image") {

            $flag = 'false';

        } else {

            $flag = 'true';

        }

    }

    return $flag;

}

}

// Get post meta in xml format at front end //

if(! function_exists('cs_get_post_data')){

function cs_get_post_data() {

    global $post;

    $cs_xmlObject = '';

    $post_type = get_post_type($post->ID);

    if ($post_type == "events") {

        $post_type = "cs_event_meta";

    } else {

        $post_type = "post";

    }

    $post_xml = get_post_meta($post->ID, $post_type, true);

    if ($post_xml <> "") {

        $cs_xmlObject = new SimpleXMLElement($post_xml);

    }

    return $cs_xmlObject;

}

}

if(! function_exists('cs_show_partner')){

function cs_show_partner() {

    global $cs_theme_option;

    ?>

    <div class="span12 lightbox">

        <!-- Logo Slide Start -->

        <div class="logo_slide">

            <?php if ($cs_theme_option['partners_title'] <> '') { ?>

                <header class="heading">

                    <h2 class="heading-color section-title cs-heading-color"><?php echo $cs_theme_option['partners_title']; ?></h2>

                </header>

            <?php } ?>



            <div id="flexslider-partners">

                <div class="flexslider">



                    <ul class="slides">

                        <?php

                        $gal_album_db = $cs_theme_option['partners_gallery'];

                        if ($gal_album_db <> "0") {

                            // galery slug to id start

                            $args = array(

                                'name' => $gal_album_db,

                                'post_type' => 'albums',

                                'post_status' => 'publish',

                                'showposts' => 1,

                            );

                            $get_posts = get_posts($args);

                            if ($get_posts) {

                                $gal_album_db = $get_posts[0]->ID;

                            }

                            // galery slug to id end	

                            $cs_meta_gallery_options = get_post_meta($gal_album_db, "cs_meta_gallery_options", true);

                            // pagination start

                            if ($cs_meta_gallery_options <> "") {

                                $xmlObject = new SimpleXMLElement($cs_meta_gallery_options);

                                $limit_start = 0;

                                $limit_end = count($xmlObject);

                                //foreach ( $xmlObject->children() as $node ) {

                                for ($i = $limit_start; $i < $limit_end; $i++) {

                                    $path = $xmlObject->gallery[$i]->path;

                                    $title = $xmlObject->gallery[$i]->title;

                                    $description = $xmlObject->gallery[$i]->description;

                                    $use_image_as = $xmlObject->gallery[$i]->use_image_as;

                                    $video_code = $xmlObject->gallery[$i]->video_code;

                                    $link_url = $xmlObject->gallery[$i]->link_url;

                                    //$image_url = wp_get_attachment_image_src($path, array(438,288),false);

                                    $image_url = cs_attachment_image_src($path, 150, 150);

                                    //$image_url_full = wp_get_attachment_image_src($path, 'full',false);

                                    $image_url_full = cs_attachment_image_src($path, 0, 0);

                                    ?>



                                    <li>

                                        <figure>

                                            <a href="<?php

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

                                               }

                                               ?>" data-rel="<?php

                                               if ($use_image_as == 1)

                                                   echo "prettyPhoto1";

                                               elseif ($use_image_as == 2)

                                                   echo "";

                                               else

                                                   echo "prettyPhoto[gallery2]"

                                                   ?>"><?php echo "<img src='" . $image_url . "' alt='" . $title . "' />"; ?></a>

                                        </figure>

                                    </li>

                                    <?php

                                }

                            }

                        }else {

                            echo '<h4 class="heading-color">' . __('No results found.', 'Mercycorp') . '</h4></li>';

                        }

                        ?>



                    </ul>

                </div>

            </div>

            <?php

            cs_enqueue_flexslider_script();

            ?>

            <script type="text/javascript">

                jQuery(window).load(function () {

                    var speed = <?php echo $cs_theme_option['flex_animation_speed']; ?>;

                    var slidespeed = <?php echo $cs_theme_option['flex_pause_time']; ?>;

                    jQuery('#flexslider-partners .flexslider').flexslider({

                        animation: "slide",

                        slideshow: false,

                        animationLoop: true,

                        itemWidth: 160,

                        itemMargin: 18,

                    });

                });

            </script>

            <!-- Logo Slide End -->

        </div>

    </div>

    <?php

}

}

// Front End Functions END

// Shortcode Dropdown

add_action('media_buttons', 'cs_shortcode_dropdown', 11);

if(! function_exists('cs_shortcode_dropdown')){

function cs_shortcode_dropdown() {

    $cs_shortcode_tags = array('accordion', 'button', 'column', 'code', 'dropcap', 'divider', 'heading', 'highlight', 'image-frame', 'icon', 'list', 'message_box', 'map', 'quote', 'testimonials', 'team', 'toogle', 'tabs', 'table', 'video');

    $cs_shortcodes_list = '';

    echo '&nbsp;<select id="sc_select"><option>' . __('Shortcode', 'Mercycorp') . '</option>';

    foreach ($cs_shortcode_tags as $val) {



        $cs_shortcodes_list .= "<option value='" . $val . "'>" . $val . "</option>";

    }

    echo $cs_shortcodes_list;

    echo '</select>';

}

}

add_action('admin_head', 'cs_button_js');

if(! function_exists('cs_button_js')){

function cs_button_js() {

    ?>

    <script type="text/javascript">

        jQuery(document).ready(function () {

            cs_shortocde_selection();

        });

    </script>

    <?php

}

}



// Google Fonts array

if(! function_exists('cs_get_google_fonts')){

function cs_get_google_fonts() {

    $fonts = array("Abel", "Aclonica", "Acme", "Actor", "Advent Pro", "Aldrich", "Allerta", "Allerta Stencil", "Amaranth", "Andika", "Anonymous Pro", "Antic", "Anton", "Arimo", "Armata", "Asap", "Asul",

        "Basic", "Belleza", "Cabin", "Cabin Condensed", "Cagliostro", "Candal", "Cantarell", "Carme", "Chau Philomene One", "Chivo", "Coda Caption", "Comfortaa", "Convergence", "Cousine", "Cuprum", "Days One",

        "Didact Gothic", "Doppio One", "Dorsa", "Dosis", "Droid Sans", "Droid Sans Mono", "Duru Sans", "Economica", "Electrolize", "Exo", "Federo", "Francois One", "Fresca", "Galdeano", "Geo", "Gudea",

        "Hammersmith One", "Homenaje", "Imprima", "Inconsolata", "Inder", "Istok Web", "Jockey One", "Josefin Sans", "Jura", "Karla", "Krona One", "Lato", "Lekton", "Magra", "Mako", "Marmelad", "Marvel",

        "Maven Pro", "Metrophobic", "Michroma", "Molengo", "Montserrat", "Muli", "News Cycle", "Nobile", "Numans", "Nunito", "Open Sans", "Open Sans Condensed", "Orbitron", "Oswald", "Oxygen", "PT Mono",

        "PT Sans", "PT Sans Caption", "PT Sans Narrow", "Paytone One", "Philosopher", "Play", "Pontano Sans", "Port Lligat Sans", "Puritan", "Quantico", "Quattrocento Sans", "Questrial", "Quicksand", "Rationale",

        "Ropa Sans", "Rosario", "Ruda", "Ruluko", "Russo One", "Shanti", "Sigmar One", "Signika", "Signika Negative", "Six Caps", "Snippet", "Spinnaker", "Syncopate", "Telex", "Tenor Sans", "Ubuntu",

        "Ubuntu Condensed", "Ubuntu Mono", "Varela", "Varela Round", "Viga", "Voltaire", "Wire One", "Yanone Kaffeesatz", "Adamina", "Alegreya", "Alegreya SC", "Alice", "Alike", "Alike Angular", "Almendra",

        "Almendra SC", "Amethysta", "Andada", "Antic Didone", "Antic Slab", "Arapey", "Artifika", "Arvo", "Average", "Balthazar", "Belgrano", "Bentham", "Bevan", "Bitter", "Brawler", "Bree Serif", "Buenard",

        "Cambo", "Cantata One", "Cardo", "Caudex", "Copse", "Coustard", "Crete Round", "Crimson Text", "Cutive", "Della Respira", "Droid Serif", "EB Garamond", "Enriqueta", "Esteban", "Fanwood Text", "Fjord One",

        "Gentium Basic", "Gentium Book Basic", "Glegoo", "Goudy Bookletter 1911", "Habibi", "Holtwood One SC", "IM Fell DW Pica", "IM Fell DW Pica SC", "IM Fell Double Pica", "IM Fell Double Pica SC",

        "IM Fell English", "IM Fell English SC", "IM Fell French Canon", "IM Fell French Canon SC", "IM Fell Great Primer", "IM Fell Great Primer SC", "Inika", "Italiana", "Josefin Slab", "Judson", "Junge",

        "Kameron", "Kotta One", "Kreon", "Ledger", "Linden Hill", "Lora", "Lusitana", "Lustria", "Marko One", "Mate", "Mate SC", "Merriweather", "Montaga", "Neuton", "Noticia Text", "Old Standard TT", "Ovo",

        "PT Serif", "PT Serif Caption", "Petrona", "Playfair Display", "Podkova", "Poly", "Port Lligat Slab", "Prata", "Prociono", "Quattrocento", "Radley", "Rokkitt", "Rosarivo", "Simonetta", "Sorts Mill Goudy",

        "Stoke", "Tienne", "Tinos", "Trocchi", "Trykker", "Ultra", "Unna", "Vidaloka", "Volkhov", "Vollkorn", "Abril Fatface", "Aguafina Script", "Aladin", "Alex Brush", "Alfa Slab One", "Allan", "Allura",

        "Amatic SC", "Annie Use Your Telescope", "Arbutus", "Architects Daughter", "Arizonia", "Asset", "Astloch", "Atomic Age", "Aubrey", "Audiowide", "Averia Gruesa Libre", "Averia Libre", "Averia Sans Libre",

        "Averia Serif Libre", "Bad Script", "Bangers", "Baumans", "Berkshire Swash", "Bigshot One", "Bilbo", "Bilbo Swash Caps", "Black Ops One", "Bonbon", "Boogaloo", "Bowlby One", "Bowlby One SC",

        "Bubblegum Sans", "Buda", "Butcherman", "Butterfly Kids", "Cabin Sketch", "Caesar Dressing", "Calligraffitti", "Carter One", "Cedarville Cursive", "Ceviche One", "Changa One", "Chango", "Chelsea Market",

        "Cherry Cream Soda", "Chewy", "Chicle", "Coda", "Codystar", "Coming Soon", "Concert One", "Condiment", "Contrail One", "Cookie", "Corben", "Covered By Your Grace", "Crafty Girls", "Creepster", "Crushed",

        "Damion", "Dancing Script", "Dawning of a New Day", "Delius", "Delius Swash Caps", "Delius Unicase", "Devonshire", "Diplomata", "Diplomata SC", "Dr Sugiyama", "Dynalight", "Eater", "Emblema One",

        "Emilys Candy", "Engagement", "Erica One", "Euphoria Script", "Ewert", "Expletus Sans", "Fascinate", "Fascinate Inline", "Federant", "Felipa", "Flamenco", "Flavors", "Fondamento", "Fontdiner Swanky",

        "Forum", "Fredericka the Great", "Fredoka One", "Frijole", "Fugaz One", "Geostar", "Geostar Fill", "Germania One", "Give You Glory", "Glass Antiqua", "Gloria Hallelujah", "Goblin One", "Gochi Hand",

        "Gorditas", "Graduate", "Gravitas One", "Great Vibes", "Gruppo", "Handlee", "Happy Monkey", "Henny Penny", "Herr Von Muellerhoff", "Homemade Apple", "Iceberg", "Iceland", "Indie Flower", "Irish Grover",

        "Italianno", "Jim Nightshade", "Jolly Lodger", "Julee", "Just Another Hand", "Just Me Again Down Here", "Kaushan Script", "Kelly Slab", "Kenia", "Knewave", "Kranky", "Kristi", "La Belle Aurore",

        "Lancelot", "League Script", "Leckerli One", "Lemon", "Lilita One", "Limelight", "Lobster", "Lobster Two", "Londrina Outline", "Londrina Shadow", "Londrina Sketch", "Londrina Solid",

        "Love Ya Like A Sister", "Loved by the King", "Lovers Quarrel", "Luckiest Guy", "Macondo", "Macondo Swash Caps", "Maiden Orange", "Marck Script", "Meddon", "MedievalSharp", "Medula One", "Megrim",

        "Merienda One", "Metamorphous", "Miltonian", "Miltonian Tattoo", "Miniver", "Miss Fajardose", "Modern Antiqua", "Monofett", "Monoton", "Monsieur La Doulaise", "Montez", "Mountains of Christmas",

        "Mr Bedfort", "Mr Dafoe", "Mr De Haviland", "Mrs Saint Delafield", "Mrs Sheppards", "Mystery Quest", "Neucha", "Niconne", "Nixie One", "Norican", "Nosifer", "Nothing You Could Do", "Nova Cut",

        "Nova Flat", "Nova Mono", "Nova Oval", "Nova Round", "Nova Script", "Nova Slim", "Nova Square", "Oldenburg", "Oleo Script", "Original Surfer", "Over the Rainbow", "Overlock", "Overlock SC", "Pacifico",

        "Parisienne", "Passero One", "Passion One", "Patrick Hand", "Patua One", "Permanent Marker", "Piedra", "Pinyon Script", "Plaster", "Playball", "Poiret One", "Poller One", "Pompiere", "Press Start 2P",

        "Princess Sofia", "Prosto One", "Qwigley", "Raleway", "Rammetto One", "Rancho", "Redressed", "Reenie Beanie", "Revalia", "Ribeye", "Ribeye Marrow", "Righteous", "Rochester", "Rock Salt", "Rouge Script",

        "Ruge Boogie", "Ruslan Display", "Ruthie", "Sail", "Salsa", "Sancreek", "Sansita One", "Sarina", "Satisfy", "Schoolbell", "Seaweed Script", "Sevillana", "Shadows Into Light", "Shadows Into Light Two",

        "Share", "Shojumaru", "Short Stack", "Sirin Stencil", "Slackey", "Smokum", "Smythe", "Sniglet", "Sofia", "Sonsie One", "Special Elite", "Spicy Rice", "Spirax", "Squada One", "Stardos Stencil",

        "Stint Ultra Condensed", "Stint Ultra Expanded", "Sue Ellen Francisco", "Sunshiney", "Supermercado One", "Swanky and Moo Moo", "Tangerine", "The Girl Next Door", "Titan One", "Trade Winds", "Trochut",

        "Tulpen One", "Uncial Antiqua", "UnifrakturCook", "UnifrakturMaguntia", "Unkempt", "Unlock", "VT323", "Vast Shadow", "Vibur", "Voces", "Waiting for the Sunrise", "Wallpoet", "Walter Turncoat",

        "Wellfleet", "Yellowtail", "Yeseva One", "Yesteryear", "Zeyada");

    return $fonts;

}

}

// adding font start

if(! function_exists('cs_font_head')){

function cs_font_head() {

    $cs_fonts = get_option('cs_theme_option');



    if (isset($cs_fonts['content_size']))

        echo '<style> body{ font-size:' . $cs_fonts['content_size'] . 'px !important; } </style>';

    if (isset($cs_fonts['content_size_g_font']) and $cs_fonts['content_size_g_font'] <> "") {

        echo '<style>';

        echo "@import url(https://fonts.googleapis.com/css?family=" . $cs_fonts['content_size_g_font'] . ");";

        echo "body { font-family: '" . $cs_fonts['content_size_g_font'] . "', sans-serif !important; }";

        echo '</style>';

    }

}

}

add_action('wp_head', 'cs_font_head');



// import demo xml file

if(! function_exists('cs_demo_importer')){

function cs_demo_importer() {

    ?>

    <div class="cs-demo-data">

        <h2><?php _e('Import Demo Data', 'Mercycorp'); ?></h2>

        <div class="inn-text">

            <p><?php _e('Importing demo data helps to build site like the demo site by all means. It is the quickest way to setup theme. Following things happen when dummy data is imported', 'Mercycorp'); ?></p>

            <ul class="import-data">

                <li>&#8226; <?php _e('All wordpress settings will remain same and intact', 'Mercycorp'); ?></li>

                <li>&#8226; <?php _e('Posts, pages and dummy images shown in demo will be imported', 'Mercycorp'); ?></li>

                <li>&#8226; <?php _e('Only dummy images will be imported as all demo images have copy right restriction', 'Mercycorp'); ?></li>

                <li>&#8226; <?php _e('No existing posts, pages, categories, custom post types or any other data will be deleted or modified', 'Mercycorp'); ?></li>

                <li>&#8226; <?php _e('To proceed, please click "Import Demo Data" and wait for a while', 'Mercycorp'); ?></li>

            </ul>

        </div>

        <form method="post">

            <input name="reset"  type="submit" value="<?php _e('Import Demo Data', 'Mercycorp'); ?>" id="submit_btn"/>

            <input type="hidden" name="demo" value="demo-data" />

        </form>

    </div>

    <?php

    if (isset($_REQUEST['demo']) && $_REQUEST['demo'] == 'demo-data') {



        require_once ABSPATH . 'wp-admin/includes/import.php';

        if (!defined('WP_LOAD_IMPORTERS'))

            define('WP_LOAD_IMPORTERS', true);

        $cs_demoimport_error = false;



        if (!class_exists('WP_Importer')) {

            $cs_import_class = ABSPATH . 'wp-admin/includes/class-wp-importer.php';

            if (file_exists($cs_import_class)) {

                require_once($cs_import_class);

            } else {

                $cs_demoimport_error = true;

            }

        }

        if (!class_exists('WP_Import')) {

            $cs_import_class = get_template_directory() . '/include/importer/wordpress-importer.php';

            if (file_exists($cs_import_class))

                require_once($cs_import_class);

            else

                $cs_demoimport_error = true;

        }



        if ($cs_demoimport_error) {

            echo __('Error.', 'Mercycorp') . '</p>';

            die();

        } else {

            if (!is_file(get_template_directory() . '/include/importer/demo.xml')) {

                echo '<p><strong>' . __('Sorry, there has been an error.', 'Mercycorp') . '</strong><br />';

                echo __('The file does not exist, please try again.', 'Mercycorp') . '</p>';

            } else {



                global $wpdb;

                $theme_mod_val = array();

                $term_exists = term_exists('top-menu', 'nav_menu');

                if (!$term_exists) {

                    $wpdb->query(" INSERT INTO `" . $wpdb->prefix . "terms` VALUES ('', 'Top Menu' , 'top-menu', '0'); ");

                    $insert_id = $wpdb->insert_id;

                    $theme_mod_val['top-menu'] = $insert_id;

                    $wpdb->query(" INSERT INTO `" . $wpdb->prefix . "term_taxonomy` VALUES ('', '" . $insert_id . "' , 'nav_menu', '', '0', '0'); ");

                } else

                    $theme_mod_val['top-menu'] = $term_exists['term_id'];

                $term_exists = term_exists('main-menu', 'nav_menu');

                if (!$term_exists) {

                    $wpdb->query(" INSERT INTO `" . $wpdb->prefix . "terms` VALUES ('', 'Main Menu' , 'main-menu', '0'); ");

                    $insert_id = $wpdb->insert_id;

                    $theme_mod_val['main-menu'] = $insert_id;

                    $wpdb->query(" INSERT INTO `" . $wpdb->prefix . "term_taxonomy` VALUES ('', '" . $insert_id . "' , 'nav_menu', '', '0', '0'); ");

                } else

                    $theme_mod_val['main-menu'] = $term_exists['term_id'];

                $term_exists = term_exists('footer-menu', 'nav_menu');

                if (!$term_exists) {

                    $wpdb->query(" INSERT INTO `" . $wpdb->prefix . "terms` VALUES ('', 'Footer Menu' , 'footer-menu', '0'); ");

                    $insert_id = $wpdb->insert_id;

                    $theme_mod_val['footer-menu'] = $insert_id;

                    $wpdb->query(" INSERT INTO `" . $wpdb->prefix . "term_taxonomy` VALUES ('', '" . $insert_id . "' , 'nav_menu', '', '0', '0'); ");

                } else

                    $theme_mod_val['footer-menu'] = $term_exists['term_id'];

                set_theme_mod('nav_menu_locations', $theme_mod_val);

                $cs_demo_import = new WP_Import();

                $cs_demo_import->fetch_attachments = true;

                $cs_demo_import->import(get_template_directory() . '/include/importer/demo.xml');



                // Menu Location

                /*

                  $cs_theme_option = get_option('cs_theme_option');

                  $cs_theme_option['show_slider']='on';

                  $cs_theme_option['slider_type']='Flex Slider';

                  $cs_theme_option['slider_name']='6352';

                  $cs_theme_option['announcement_title']='Announcement';

                  $cs_theme_option['announcement_blog_category']='aidreform';

                  $cs_theme_option['announcement_no_posts']='5';

                  $cs_theme_option['partners_title']='Our Partners';

                  $cs_theme_option['partners_gallery']='our-clients';

                  $cs_theme_option['show_partners']='home';

                  $cs_theme_option['layout_option']='wrapper_boxed';

                  update_option("cs_theme_option", $cs_theme_option );

                 */

                update_option('cs_import_data', 'success');



                $home = get_page_by_title('Home');

                if ($home <> '' && get_option('page_on_front') == "0") {

                    update_option('page_on_front', $home->ID);

                    update_option('show_on_front', 'page');

                    update_option('front_page_settings', '1');

                }

            }

        }

    }

}

}

if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php') {

    

}

if(! function_exists('cs_clean_shortcode_data')){

// Shortcode content

function cs_clean_shortcode_data($content = '') {



    $content = htmlspecialchars(stripslashes($content));

    $content = str_replace('&', '', $content);

    $content = str_replace(array('quot;', 'amp;#8221;', 'amp;#8243;', 'amp;', 'lt;', 'gt;'), array('"', '"', '"', '', '<', '>'), $content);



    return $content;

}

}

if(! function_exists('cs_encode_html_tags')){

function cs_encode_html_tags($content = '') {



    $content = str_replace(array('<', '>', '/>', '</'), array('ls_then', 'gr_then', 'cls_then', 'cgr_then'), $content);



    return $content;

}

}

if(! function_exists('cs_decode_html_tags')){

function cs_decode_html_tags($content = '') {



    $content = str_replace(array('ls_then', 'gr_then', 'cls_then', 'cgr_then', '<br>', '<br />'), array('<', '>', '/>', '</', '', ''), $content);



    return $content;

}

}

if(! function_exists('cs_content_decode')){



function cs_content_decode($content = '') {



    $content = htmlspecialchars(stripslashes($content));

    $content = str_replace('&', '', $content);

    $content = str_replace(array('quot;', 'amp;#8221;', 'amp;#8243;', '#8211;', 'amp;', 'lt;', 'gt;'), array('"', '"', '"', '-', '', '<', '>'), $content);



    return $content;

}

}

if(! function_exists('cs_allow_special_char')){

function cs_allow_special_char($input = '') {

    $output = $input;

    return $output;

}

}



add_action( 'init', 'patrimonio_cultural' );



function patrimonio_cultural() {

    $labels = array(

        'name'               => _x( 'Património Cultural', 'post type general name', 'your-plugin-textdomain' ),

        'singular_name'      => _x( 'Património Cultural', 'post type singular name', 'your-plugin-textdomain' ),

        'menu_name'          => _x( 'Património Cultural', 'admin menu', 'your-plugin-textdomain' ),

        'name_admin_bar'     => _x( 'Património Cultural', 'add new on admin bar', 'your-plugin-textdomain' ),

        'add_new'            => _x( 'Adicionar Património Cultural', 'book', 'your-plugin-textdomain' ),

        'add_new_item'       => __( 'Adicionar Património Cultural', 'your-plugin-textdomain' ),

        'new_item'           => __( 'Novo Património Cultural', 'your-plugin-textdomain' ),

        'edit_item'          => __( 'Editar Património Cultural', 'your-plugin-textdomain' ),

        'view_item'          => __( 'Ver Património Cultura', 'your-plugin-textdomain' ),

        'all_items'          => __( 'Ver Todos', 'your-plugin-textdomain' ),

        'search_items'       => __( 'Search Books', 'your-plugin-textdomain' ),

        'parent_item_colon'  => __( 'Parent Books:', 'your-plugin-textdomain' ),

        'not_found'          => __( 'No books found.', 'your-plugin-textdomain' ),

        'not_found_in_trash' => __( 'No books found in Trash.', 'your-plugin-textdomain' )

    );



    $args = array(

        'labels'             => $labels,

        'description'        => __( 'Description.', 'your-plugin-textdomain' ),

        'public'             => true,

        'publicly_queryable' => true,

        'show_ui'            => true,

        'show_in_menu'       => true,

        'query_var'          => true,

        'rewrite'            => array( 'slug' => 'pratrimoniocultural' ),

        'capability_type'    => 'post',

        'has_archive'        => true,

        'hierarchical'       => false,

        'menu_position'      => null,

        'supports'           => array( 'title', 'editor', 'author', 'thumbnail')

    );



    register_post_type( 'pratrimoniocultural', $args );

}









add_action( 'init', 'patrimonio_relegioso' );



function patrimonio_relegioso() {

    $labels = array(

        'name'               => _x( 'Património Relegioso', 'post type general name', 'your-plugin-textdomain' ),

        'singular_name'      => _x( 'Património Relegioso', 'post type singular name', 'your-plugin-textdomain' ),

        'menu_name'          => _x( 'Património Relegioso', 'admin menu', 'your-plugin-textdomain' ),

        'name_admin_bar'     => _x( 'Património Relegioso', 'add new on admin bar', 'your-plugin-textdomain' ),

        'add_new'            => _x( 'Adicionar Património Relegioso', 'book', 'your-plugin-textdomain' ),

        'add_new_item'       => __( 'Adicionar Património Relegioso', 'your-plugin-textdomain' ),

        'new_item'           => __( 'Novo Património Relegioso', 'your-plugin-textdomain' ),

        'edit_item'          => __( 'Editar Património Relegioso', 'your-plugin-textdomain' ),

        'view_item'          => __( 'Ver Património Relegioso', 'your-plugin-textdomain' ),

        'all_items'          => __( 'Ver Todos', 'your-plugin-textdomain' ),

        'search_items'       => __( 'Search Books', 'your-plugin-textdomain' ),

        'parent_item_colon'  => __( 'Parent Books:', 'your-plugin-textdomain' ),

        'not_found'          => __( 'No books found.', 'your-plugin-textdomain' ),

        'not_found_in_trash' => __( 'No books found in Trash.', 'your-plugin-textdomain' )

    );



    $args = array(

        'labels'             => $labels,

        'description'        => __( 'Description.', 'your-plugin-textdomain' ),

        'public'             => true,

        'publicly_queryable' => true,

        'show_ui'            => true,

        'show_in_menu'       => true,

        'query_var'          => true,

        'rewrite'            => array( 'slug' => 'pratrimoniorelegioso' ),

        'capability_type'    => 'post',

        'has_archive'        => true,

        'hierarchical'       => true,

        'menu_position'      => null,

        'supports'           => array( 'title', 'editor', 'author', 'thumbnail')

    );



    register_post_type( 'pratrimoniorelegioso', $args );

}







add_action( 'init', 'patrimonio_natural' );



function patrimonio_natural() {

    $labels = array(

        'name'               => _x( 'Património Natural', 'post type general name', 'your-plugin-textdomain' ),

        'singular_name'      => _x( 'Património Natural', 'post type singular name', 'your-plugin-textdomain' ),

        'menu_name'          => _x( 'Património Natural', 'admin menu', 'your-plugin-textdomain' ),

        'name_admin_bar'     => _x( 'Património Natural', 'add new on admin bar', 'your-plugin-textdomain' ),

        'add_new'            => _x( 'Adicionar Património Natural', 'book', 'your-plugin-textdomain' ),

        'add_new_item'       => __( 'Adicionar Património Natural', 'your-plugin-textdomain' ),

        'new_item'           => __( 'Novo Património Natural', 'your-plugin-textdomain' ),

        'edit_item'          => __( 'Editar Património Natural', 'your-plugin-textdomain' ),

        'view_item'          => __( 'Ver Património Natural', 'your-plugin-textdomain' ),

        'all_items'          => __( 'Ver todos', 'your-plugin-textdomain' ),

        'search_items'       => __( 'Search Books', 'your-plugin-textdomain' ),

        'parent_item_colon'  => __( 'Parent Books:', 'your-plugin-textdomain' ),

        'not_found'          => __( 'No books found.', 'your-plugin-textdomain' ),

        'not_found_in_trash' => __( 'No books found in Trash.', 'your-plugin-textdomain' )

    );



    $args = array(

        'labels'             => $labels,

        'description'        => __( 'Description.', 'your-plugin-textdomain' ),

        'public'             => true,

        'publicly_queryable' => true,

        'show_ui'            => true,

        'show_in_menu'       => true,

        'query_var'          => true,

        'rewrite'            => array( 'slug' => 'pratrimonionatural' ),

        'capability_type'    => 'post',

        'has_archive'        => true,

        'hierarchical'       => false,

        'menu_position'      => null,

        'supports'           => array( 'title', 'editor', 'author', 'thumbnail')

    );



    register_post_type( 'pratrimonionatural', $args );

}





add_action( 'init', 'infraestruturas' );



function infraestruturas() {

    $labels = array(

        'name'               => _x( 'Infraestreturas', 'post type general name', 'your-plugin-textdomain' ),

        'singular_name'      => _x( 'Infraestreturas', 'post type singular name', 'your-plugin-textdomain' ),

        'menu_name'          => _x( 'Infraestreturas', 'admin menu', 'your-plugin-textdomain' ),

        'name_admin_bar'     => _x( 'Infraestreturas', 'add new on admin bar', 'your-plugin-textdomain' ),

        'add_new'            => _x( 'Adicionar Infraestretura', 'book', 'your-plugin-textdomain' ),

        'add_new_item'       => __( 'Adicionar nova Infraestretura', 'your-plugin-textdomain' ),

        'new_item'           => __( 'Nova Infraestretura', 'your-plugin-textdomain' ),

        'edit_item'          => __( 'Editar Infraestretura', 'your-plugin-textdomain' ),

        'view_item'          => __( 'Ver Infraestretura', 'your-plugin-textdomain' ),

        'all_items'          => __( 'Ver Todos', 'your-plugin-textdomain' ),

        'search_items'       => __( 'Search Books', 'your-plugin-textdomain' ),

        'parent_item_colon'  => __( 'Parent Books:', 'your-plugin-textdomain' ),

        'not_found'          => __( 'No books found.', 'your-plugin-textdomain' ),

        'not_found_in_trash' => __( 'No books found in Trash.', 'your-plugin-textdomain' )

    );



    $args = array(

        'labels'             => $labels,

        'description'        => __( 'Description.', 'your-plugin-textdomain' ),

        'public'             => true,

        'publicly_queryable' => true,

        'show_ui'            => true,

        'show_in_menu'       => true,

        'query_var'          => true,

        'rewrite'            => array( 'slug' => 'infraestruturas' ),

        'capability_type'    => 'post',

        'has_archive'        => true,

        'hierarchical'       => false,

        'menu_position'      => null,

        'supports'           => array( 'title', 'editor', 'author', 'thumbnail')

    );



    register_post_type( 'infraestruturas', $args );

}





