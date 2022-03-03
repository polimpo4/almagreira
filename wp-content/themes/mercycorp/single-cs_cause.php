<?php
cs_slider_gallery_template_redirect();
global $cs_node, $cs_theme_option, $cs_counter_node, $cs_video_width;
$cs_node = new stdClass();
get_header();
$cs_layout = '';
$cause_status = '';
if (have_posts()):
    while (have_posts()) : the_post();
        $cs_xmlObject_transaction = new stdclass();
        $cs_menu = get_post_meta($post->ID, "cs_cause_meta", true);
        $percentage_amount = 0;
        $payment_gross = 0;
        if ($cs_menu <> "") {
            $cs_xmlObject = new SimpleXMLElement($cs_menu);
            $cs_layout = $cs_xmlObject->sidebar_layout->cs_layout;
            $cs_sidebar_left = $cs_xmlObject->sidebar_layout->cs_sidebar_left;
            $cs_sidebar_right = $cs_xmlObject->sidebar_layout->cs_sidebar_right;
            if ($cs_layout == "left") {
                $cs_layout = "content-right col-md-9";
            } else if ($cs_layout == "right") {
                $cs_layout = "content-left col-md-9";
            } else {
                $cs_layout = "col-md-12";
            }
            $sub_title = $cs_xmlObject->sub_title;
            $cause_social_share = $cs_xmlObject->cause_social_share;
            $cause_goal_amount = $cs_xmlObject->cause_goal_amount;
            $payment_gross_total = 0;
            $cause_related = $cs_xmlObject->cause_related;
            $cause_related_post_title = $cs_xmlObject->cause_related_post_title;

            $cause_raised_amount = $payment_gross_total;
        } else {
            $sub_title = '';
            $cause_social_share = '';
            $cause_related = '';
            $cause_related_post_title = '';
            $cause_goal_amount = '0';
            $cause_raised_amount = '0';
            $cs_layout = "col-md-12";
        }
        $cs_cause = get_post_meta($post->ID, "cs_cause_transaction_meta", true);
        if ($cs_cause <> "") {
            $cs_xmlObject_transaction = new SimpleXMLElement($cs_cause);
            $payment_gross = get_post_meta($post->ID, 'cs_cause_raised_amount', true);
            $payment_gross = 0;
            $percentage_amount = 0;
            if (count($cs_xmlObject_transaction->transaction) > 0) {
                foreach ($cs_xmlObject_transaction->transaction as $transct) {
                    $payment_gross = $payment_gross + $transct->payment_gross;
                }
            }
            if ($payment_gross <> '0' && $cs_xmlObject->cause_goal_amount <> '0') {
                $percentage_amount = (($payment_gross / $cs_xmlObject->cause_goal_amount) * 100);
                if ($percentage_amount > 100 || $percentage_amount == '100') {
                    $percentage_amount = 100;
                    if ($cs_theme_option['trans_switcher'] == "on") {
                        $cause_status = __('Closed', 'Mercycorp');
                    } else {
                        $cause_status = $cs_theme_option['cause_status'];
                    }
                }
            }
        } else {
            $percentage_amount = 0;
            $payment_gross = 0;
        }

        $image_url = cs_attachment_image_src(get_post_thumbnail_id($post->ID), '1280', '574');
        ?>
        <!-- Columns Start -->
        <div class="clear"></div>
        <!-- Content Section Start -->
        <div id="main" role="main">
            <!-- Container Start -->
            <div class="container">
                <!-- Row Start -->
                <div class="row">
                    <!--Left Sidebar Starts-->
                    <?php if ($cs_layout == 'content-right col-md-9') { ?>
                        <aside class="sidebar-left col-md-3"><?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_left)) : ?><?php endif; ?></aside>
                    <?php } ?>
                    <!--Left Sidebar End-->
                    <!-- Blog Detail Start -->
                    <div class="<?php echo $cs_layout; ?>">
                        <div class="couses-detail<?php
                        if ($image_url == '') {
                            echo ' no-image';
                        }
                        ?>">
                            <?php if ($image_url <> '') { ?>
                                <figure class="detail_figure <?php
                    if ($image_url <> '') {
                        $no_image = 'no-image';
                    }
                                ?>">
                                    <a><img src="<?php echo $image_url; ?>"></a>
                                </figure>
                            <?php } ?>
                            <?php
                            $cs_cause_gallery = get_post_meta("$cs_xmlObject->cause_gallery", "cs_meta_gallery_options", true);
                            if ($cs_cause_gallery <> "") {
                                $cs_image_per_gallery = '';
                                $cs_xmlObject_gallery = new SimpleXMLElement($cs_cause_gallery);
                                $limit_start = 0;
                                $limit_end = $limit_start + $cs_image_per_gallery;
                                if ($limit_end < 1) {
                                    $limit_end = count($cs_xmlObject_gallery);
                                }
                                $count_post = count($cs_xmlObject_gallery);
                                ?>
                                <!-- Element Size Start -->
            <?php cs_enqueue_tinycarousel_script(); ?>
                                <script type="text/javascript">
                                    jQuery(document).ready(function ($) {
                                        $('#slider1').tinycarousel();
                                    });
                                </script>
                                <div class="element-section-left">
                                    <div id="slider1" class="tinycarousal_cause">
                                        <a class="buttons prev" href="#">left</a>
                                        <div class="viewport">
                                            <ul class="overview lightbox">
                                                <?php
                                                cs_enqueue_gallery_style_script();
                                                for ($i = 0; $i < $limit_end; $i++) {
                                                    $path = $cs_xmlObject_gallery->gallery[$i]->path;
                                                    $title = $cs_xmlObject_gallery->gallery[$i]->title;
                                                    $description = $cs_xmlObject_gallery->gallery[$i]->description;
                                                    $social_network = $cs_xmlObject_gallery->gallery[$i]->social_network;
                                                    $use_image_as = $cs_xmlObject_gallery->gallery[$i]->use_image_as;
                                                    $video_code = $cs_xmlObject_gallery->gallery[$i]->video_code;
                                                    $link_url = $cs_xmlObject_gallery->gallery[$i]->link_url;
                                                    $gallery_image_url = cs_attachment_image_src($path, 150, 150);
                                                    if ($gallery_image_url <> '') {
                                                        $image_url_full = cs_attachment_image_src($path, 0, 0);
                                                        ?>
                                                        <li>
                                                            <img src="<?php echo $gallery_image_url; ?>" alt="" />
                                                            <div class="car-caption">
                                                                <a data-title="<?php
                                                                   if ($description <> "") {
                                                                       echo $description;
                                                                   }
                                                                   ?>"  href="<?php
                                                                       if ($use_image_as == 1)
                                                                           echo $video_code;
                                                                       elseif ($use_image_as == 2)
                                                                           echo $link_url;
                                                                       else
                                                                           echo $image_url_full;
                                                                       ?>" target="<?php if ($use_image_as == 2) echo '_blank'; ?>" data-rel="<?php
                                                if ($use_image_as == 1)
                                                    echo "prettyPhoto";
                                                elseif ($use_image_as == 2)
                                                    echo "";
                                                else
                                                    echo "prettyPhoto[gallery1]"
                                                    ?>"><?php
                                                if ($use_image_as == 1) {
                                                    echo '<i class="icon-play-sign"></i>';
                                                } elseif ($use_image_as == 2) {
                                                    echo '<i class="icon-link"></i>';
                                                } else {
                                                    echo '<i class="icon-plus"></i>';
                                                }
                                                ?></a>
                                                            </div>
                                                        </li>
                <?php }
            }
            ?>
                                            </ul>
                                        </div>
                                        <a class="buttons next" href="#"><?php _e('right', 'Mercycorp'); ?></a>
                                    </div>
                                </div>
                                <!-- Element Size End -->
        <?php } ?>
                            <!-- Element Size Start -->
                            <div class="element-section">
                                <div class="our-cuases">
                                    <article>
                                        <!-- Text Section -->
                                        <div class="text-sec">
                                            <div class="dis-table">
                                                <div class="dis-tow">
                                                    <div class="inntext">
                                                        <span>$<?php echo $payment_gross; ?></span>
                                                        <p><?php
                                                                    if ($cs_theme_option['trans_switcher'] == "on") {
                                                                        _e('Raised', 'Mercycorp');
                                                                    } else {
                                                                        echo $cs_theme_option['cause_raised'];
                                                                    }
                                                                    ?></p>
                                                    </div>
                                                    <div class="donation-sec">
                                                        <div class="progress_bar">
                                                            <div data-loadbar-text="<?php echo round($percentage_amount); ?>%" data-loadbar="<?php echo round($percentage_amount); ?>" class="tiny-green">
                                                                <div style="background-color: #8bba4e;"></div>
                                                            </div>
                                                            <div class="glob-info">
                                                                <p><?php
                                                        if ($cs_theme_option['trans_switcher'] == "on") {
                                                            $trans_featured = _e('Goal', 'Mercycorp');
                                                        } else {
                                                            echo $cs_theme_option['cause_goal'];
                                                        }
                                                        ?> <span><?php echo $cs_theme_option['paypal_currency_sign']; ?><?php echo number_format((int) $cs_xmlObject->cause_goal_amount); ?></span></p>
                                                                <p class="rised"><?php
                                                        if ($cs_theme_option['trans_switcher'] == "on") {
                                                            _e('Raised', 'Mercycorp');
                                                        } else {
                                                            echo $cs_theme_option['cause_raised'];
                                                        }
                                                        ?> <span><?php echo $cs_theme_option['paypal_currency_sign']; ?><?php echo number_format($payment_gross); ?></span></p>
                                                            </div>
                                                        </div>
        <?php
        if (isset($cause_status) && $cause_status <> '') {
            echo '<span class="donate-btn backcolr"><i class="icon-credit-card"></i>' . $cause_status . ' </span>';
        } else {
            if (isset($cs_xmlObject->cause_paypal_email) && $cs_xmlObject->cause_paypal_email <> '') {
                cs_donate_button($cs_xmlObject->cause_paypal_email);
            } else {
                cs_donate_button();
            }
        }
        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="category-sec">
                                                <ul class="post-option">
                            <?php
                            $before_cat = '<li><i class="icon-align-justify"></i>';
                            $categories_list = get_the_term_list(get_the_id(), 'cs_cause-category', $before_cat, ', ', '</li>');
                            if ($categories_list) {
                                printf(__('%1$s', 'Mercycorp'), $categories_list);
                            }
                            ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- Text Section -->
                                    </article>
                                </div>
                            </div>
                            <!-- Element Size End -->
                            <div class="detail_text rich_editor_text">
                                                <?php
                                                the_content();
                                                wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'Mercycorp') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>'));
                                                ?>
                            </div>
                            <?php
                            if ($cs_cause <> "") {
                                if (isset($cs_xmlObject->cs_donations_show) && $cs_xmlObject->cs_donations_show == 'on') {
                                    if (count($cs_xmlObject_transaction->transaction) > 0) {
                                        ?>
                                        <div class="donar-table">
                                            <h2 class="heading-sec"><?php
                    if ($cs_theme_option['trans_switcher'] == "on") {
                        $trans_featured = _e('Donors', 'Mercycorp');
                    } else {
                        echo $cs_theme_option['cause_donors'];
                    }
                                        ?></h2>
                                            <ul>
                                        <?php foreach ($cs_xmlObject_transaction->transaction as $transct) { ?>
                                                    <li>
                                                        <a><?php echo $transct->address_name; ?></a>
                                                        <p><span><?php echo $transct->payment_gross; ?> <?php echo $cs_theme_option['paypal_currency']; ?></span> <a><?php
                                        if ($cs_theme_option['trans_switcher'] == "on") {
                                            _e('Donation', 'Mercycorp');
                                        } else {
                                            echo $cs_theme_option['cause_donation'];
                                        }
                                        ?></a></p>
                                                    </li>
                                        <?php } ?>
                                            </ul>
                                        </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                        </div>
                        <!-- Share Post Start -->
                        <div class="share_post">
                                <?php
                                if ($cause_social_share == "on") {
                                    cs_social_share();
                                }
                                cs_next_prev_post();
                                ?>
                        </div>
                        <!-- Post Sharing Section End -->
                                <?php
                                if ($cs_xmlObject->cause_related == 'on' && !empty($categories_list)) {
                                    wp_reset_query();
                                    ?>
                            <div class="our-cuases">

                                    <?php if ($cs_xmlObject->cause_related_post_title <> '') { ?>
                                    <header class="heading"><h2 class="section-title"><?php echo $cs_xmlObject->cause_related_post_title; ?> </h2></header>
                                    <?php } ?>
                                <div class="marign-minus">
                                    <?php
                                    $custom_taxterms = '';
                                    $custom_taxterms = wp_get_object_terms($post->ID, array('cs_cause-category', 'cs_cause-tag'), array('fields' => 'ids'));
                                    // arguments
                                    $args = array(
                                        'post_type' => 'cs_cause',
                                        'post_status' => 'publish',
                                        'posts_per_page' => 8, // you may edit this number
                                        'orderby' => 'DESC',
                                        'tax_query' => array(
                                            'relation' => 'OR',
                                            array(
                                                'taxonomy' => 'cs_cause-tag',
                                                'field' => 'id',
                                                'terms' => $custom_taxterms
                                            ),
                                            array(
                                                'taxonomy' => 'cs_cause-category',
                                                'field' => 'id',
                                                'terms' => $custom_taxterms
                                            )
                                        ),
                                        'post__not_in' => array($post->ID),
                                    );
                                    $custom_query = new WP_Query($args);
                                    if ($custom_query->have_posts()):
                                        while ($custom_query->have_posts()): $custom_query->the_post();
                                            $post_xml = get_post_meta($post->ID, "cs_cause_meta", true);
                                            if ($post_xml <> '') {
                                                $cs_xmlObject = new SimpleXMLElement($post_xml);
                                            }
                                            $cs_tr = get_post_meta($post->ID, "cs_cause_transaction_meta", true);
                                            if ($cs_tr <> '') {
                                                $cs_xmlObject_transaction = new SimpleXMLElement($cs_tr);
                                            }
                                            $image_url = cs_attachment_image_src(get_post_thumbnail_id($post->ID), '230', '230');
                                            $no_image = '';
                                            if ($image_url == "") {
                                                $no_image = 'no-img';
                                            }
                                            $payment_gross = 0;
                                            $percentage_amount = 0;
                                            if (count($cs_xmlObject_transaction->transaction) > 0) {
                                                foreach ($cs_xmlObject_transaction->transaction as $transct) {
                                                    $payment_gross = $payment_gross + $transct->payment_gross;
                                                }
                                                if ($payment_gross <> '0' && $cs_xmlObject->cause_goal_amount <> '0') {
                                                    $percentage_amount = (($payment_gross / $cs_xmlObject->cause_goal_amount) * 100);
                                                    if ($percentage_amount > 100) {
                                                        $percentage_amount = 100;
                                                    }
                                                }
                                            }
                                            ?>
                                            <!-- Element Size Start -->
                                            <article <?php post_class($no_image); ?>>
                                                                            <?php if ($image_url <> "") { ?><figure><a href="<?php the_permalink(); ?>"><img src="<?php echo $image_url; ?>" alt=""></a></figure><?php } ?>
                                                <!-- Text Section -->
                                                <div class="text-sec">
                                                    <div class="dis-table">
                                                        <div class="dis-tow">
                                                            <div class="inntext">
                                                                <h2 class="post-title heading-color"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                                            <?php if ($image_url == "") { ?>
                                                                    <time><?php echo date('F d, Y', strtotime(get_the_date())); ?></time>
                                                                    <p><?php cs_get_the_excerpt('255', false); ?></p>
                                                            <?php } ?>
                                                            </div>
                                                            <div class="donation-sec">
                                                                <div class="progress_bar">
                                                                    <div data-loadbar-text="<?php echo round($percentage_amount); ?>%" data-loadbar="<?php echo round($percentage_amount); ?>" class="tiny-green">
                                                                        <div style="background-color: #8bba4e;"></div>
                                                                    </div>
                                                                    <div class="glob-info">
                                                                        <p><?php
                                                            if ($cs_theme_option['trans_switcher'] == "on") {
                                                                $trans_featured = _e('Goal', 'Mercycorp');
                                                            } else {
                                                                echo $cs_theme_option['cause_goal'];
                                                            }
                                                            ?> <span><?php echo $cs_theme_option['paypal_currency_sign']; ?><?php echo $cs_xmlObject->cause_goal_amount; ?></span></p>
                                                                        <p class="rised"><?php
                                                            if ($cs_theme_option['trans_switcher'] == "on") {
                                                                _e('Raised', 'Mercycorp');
                                                            } else {
                                                                echo $cs_theme_option['cause_raised'];
                                                            }
                                                            ?> <span><?php echo $cs_theme_option['paypal_currency_sign']; ?><?php echo $payment_gross; ?></span></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="category-sec">
                                                        <ul class="post-option">
                    <?php
                    $before_cat = '<li><i class="icon-align-justify"></i>';
                    $categories_list = get_the_term_list(get_the_id(), 'cs_cause-category', $before_cat, ', ', '</li>');
                    if ($categories_list) {
                        printf(__('%1$s', 'Mercycorp'), $categories_list);
                    }
                    ?>
                                                        </ul>
                                                        <a href="<?php the_permalink(); ?>" class="donar-info"><i class="icon-user"></i><?php echo count($cs_xmlObject_transaction->transaction); ?> <?php
                                    if ($cs_theme_option['trans_switcher'] == "on") {
                                        _e('Donors', 'Mercycorp');
                                    } else {
                                        echo $cs_theme_option['cause_donors'];
                                    }
                                    ?></a>
                                                    </div>
                                                </div>
                                                <!-- Text Section -->
                                            </article>

                                            <!-- Element Size End -->
                <?php
                endwhile;
            endif;
            wp_reset_query();
            ?>
                                </div></div>
        <?php } ?>
                        <!-- About Author Start -->
        <?php if (get_the_author_meta('description')) { ?>
                            <div class="about-author">
                                <figure>
                                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('PixFill_author_bio_avatar_size', 63)); ?></a>
                                </figure>
                                <div class="text">
                                    <h6><a class="colrhover" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"> <?php echo get_the_author_meta('nickname'); ?></a></h6>
                                    <span><?php echo get_the_author(); ?></span>
                                    <p class="line"><?php the_author_meta('description'); ?></p>
            <?php if (get_the_author_meta('twitter')) { ?>
                                        <a class="follow-tweet" href="http://twitter.com/<?php the_author_meta('twitter'); ?>" target="_blank"><i class="icon-twitter icon-2x"></i>@<?php the_author_meta('twitter'); ?></a>
            <?php } ?>
                                </div>
                            </div>
                            <!-- About Author End -->
        <?php } ?>
        <?php comments_template('', true); ?>
                        <!-- Blog Post End -->
                    </div>
                    <!--Right Sidebar Starts-->
        <?php if ($cs_layout == 'content-left col-md-9') { ?>
                        <aside class="sidebar-right col-md-3"><?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_right)) : ?><?php endif; ?></aside>
        <?php } ?>

    <?php endwhile;
endif;
?>
            <!--Content Area End-->
            <!-- Columns End -->
            <!--Footer-->
<?php get_footer(); ?>
