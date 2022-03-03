<?php
get_header();
global $cs_node, $cs_theme_option;
$cs_layout = '';
$cs_counter_events = 1;
$post_xml = get_post_meta($post->ID, "cs_event_meta", true);
if ($post_xml <> "") {
    $cs_xmlObject = new SimpleXMLElement($post_xml);
    $cs_layout = $cs_xmlObject->sidebar_layout->cs_layout;
    $cs_sidebar_left = $cs_xmlObject->sidebar_layout->cs_sidebar_left;
    $cs_sidebar_right = $cs_xmlObject->sidebar_layout->cs_sidebar_right;
    $event_social_sharing = $cs_xmlObject->event_social_sharing;
    $event_start_time = $cs_xmlObject->event_start_time;
    $event_end_time = $cs_xmlObject->event_end_time;
    $event_all_day = $cs_xmlObject->event_all_day;
    $event_booking_url = $cs_xmlObject->event_booking_url;
    $event_phone_no = $cs_xmlObject->event_phone_no;
    $event_address = $cs_xmlObject->event_address;
    $cs_sidebar_left = $cs_xmlObject->sidebar_layout->cs_sidebar_left;
    $cs_sidebar_right = $cs_xmlObject->sidebar_layout->cs_sidebar_right;
    $inside_event_map = $cs_xmlObject->event_map;
    $event_buy_now = $cs_xmlObject->event_buy_now;
    //print_r($cs_xmlObject);
    $width = 984;
    $height = 470;
    $image_id = cs_get_post_img($post->ID, $width, $height);

    if ($cs_layout == "left") {
        $cs_layout = "content-right col-md-9";
        $custom_height = 300;
    } else if ($cs_layout == "right") {
        $cs_layout = "content-left col-md-9";
        $custom_height = 300;
    } else {
        $cs_layout = "col-md-12";
        $custom_height = 403;
    }
} else {
    $event_social_sharing = '';
    $inside_event_thumb_view = '';
    $inside_event_thumb_map_lat = '';
    $inside_event_thumb_map_lon = '';
    $inside_event_thumb_map_zoom = '';
    $inside_event_thumb_map_address = '';
    $inside_event_thumb_map_controls = '';
}
$cs_event_loc = get_post_meta("$cs_xmlObject->event_address", "cs_event_loc_meta", true);
if ($cs_event_loc <> "") {
    $cs_event_loc = new SimpleXMLElement($cs_event_loc);
    $event_loc_lat = $cs_event_loc->event_loc_lat;
    $event_loc_long = $cs_event_loc->event_loc_long;
    $event_loc_zoom = $cs_event_loc->event_loc_zoom;
    $loc_address = $cs_event_loc->loc_address;
    $loc_city = $cs_event_loc->loc_city;
    $loc_postcode = $cs_event_loc->loc_postcode;
    $loc_region = $cs_event_loc->loc_region;
    $loc_country = $cs_event_loc->loc_country;
} else {
    $event_loc_lat = '';
    $event_loc_long = '';
    $event_loc_zoom = '';
    $loc_address = '';
    $loc_city = '';
    $loc_postcode = '';
    $loc_region = '';
    $loc_country = '';
}
$cs_event_to_date = get_post_meta($post->ID, "cs_event_to_date", true);
$cs_event_from_date = get_post_meta($post->ID, "cs_event_from_date", true);
$cs_event_from_date_time = get_post_meta($post->ID, "cs_event_from_date_time", true);
$year_event = date("Y", strtotime($cs_event_from_date));
$month_event = date("m", strtotime($cs_event_from_date));
$month_event_c = date("M", strtotime($cs_event_from_date));
$date_event = date("d", strtotime($cs_event_from_date));
$cs_hours = date("H", strtotime($cs_event_from_date_time));
$cs_minutes = date("i", strtotime($cs_event_from_date_time));
$cs_event_meta = get_post_meta($post->ID, "cs_event_meta", true);
$date_format = get_option('date_format');
$time_format = get_option('time_format');
if ($cs_event_meta <> "") {
    $cs_event_meta = new SimpleXMLElement($cs_event_meta);
}
$address_map = '';
$address_map = get_the_title("$cs_xmlObject->event_address");
$time_left = date("H,i,s", strtotime("$cs_event_meta->event_start_time"));
$current_date = date('Y-m-d');
if (have_posts())
    while (have_posts()) : the_post();
        $cs_event_meta = get_post_meta($post->ID, "cs_event_meta", true);
        if ($cs_event_meta <> "")
            $cs_event_meta = new SimpleXMLElement($cs_event_meta);

        if ($inside_event_map != "on") {
            $class = 'eventdetail-parallax-full';
        } else {
            $class = '';
        }
        ?>

        <!-- Event Outer Image Strat -->
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
                    <div class="<?php echo $cs_layout; ?>">
                        <div class="event featured-event eventdetail">
                            <article class="featured">
        <?php if ($image_id <> '') { ?>
                                    <figure><?php echo '<a>' . $image_id . '</a>'; ?></figure>
                                    <?php }
                                ?>
                                <!-- Post Options Start -->
                                <div class="text">
                                    <div class="text-row">
                                        <div class="inn_text">
                                            <ul class="post-options">
                                                <li><i class="icon icon-calendar">&nbsp;</i><?php echo date_i18n(get_option('date_format'), strtotime($cs_event_from_date)); ?>,
        <?php
        if ($cs_event_meta->event_all_day != "on") {
            echo $cs_event_meta->event_start_time;
            if ($cs_event_meta->event_end_time <> '') {
                echo "- ";
                echo $cs_event_meta->event_end_time;
            }
        } else {
            _e("All", 'Mercycorp') . printf(__("%s day", 'Mercycorp'), ' ');
        }
        ?>
                                                </li>

                                                <li>
                                                    <i class="icon icon-reorder">&nbsp;</i>
                                                    <?php
                                                    /* translators: used between list items, there is a space after the comma */
                                                    $before_cat = " " . __('', 'Mercycorp') . "";
                                                    $categories_list = get_the_term_list(get_the_id(), 'event-category', $before_cat, ', ', '');
                                                    if ($categories_list) {
                                                        printf(__('%1$s', 'Mercycorp'), $categories_list);
                                                    } // End if categories 
                                                    ?>
                                                </li>
                                                <li>
                                                    <?php if ($event_phone_no <> "") { ?>
                                                        <i class="icon-phone"></i><?php echo $event_phone_no; ?>
                                                    <?php } ?>
                                                </li>
                                                <li>
                                                    <?php
                                                    if ($event_buy_now <> "") {
                                                        if ($cs_theme_option['trans_switcher'] == "on") {
                                                            $trans_buynow = __('Buy Now', 'Mercycorp');
                                                        } else {
                                                            if (isset($cs_theme_option['trans_buynow'])) {
                                                                $trans_buynow = $cs_theme_option['trans_buynow'];
                                                            } else {
                                                                $trans_buynow = 'Buy Now';
                                                            }
                                                        }
                                                        ?>
                                                        <a href="<?php echo $event_buy_now; ?>" class="small-btn square" target="_blank"><i class="icon-ticket"></i><?php echo $trans_buynow; ?></a>
        <?php } ?>
                                                </li>
                                            </ul>
                                            <div class="cs-map-location">
                                                <p><?php if (isset($loc_address) and $loc_address <> "") { ?><i class="icon-map-marker"></i><?php echo $loc_address;
        } ?></p>
                                                <a href="#event-map" class="cs-map-link"><i class="icon-map-marker"></i></a>
                                            </div>
                                        </div>
                                        <div class="event-countdown">
                                            <h4><?php if ($cs_theme_option['trans_switcher'] == "on") {
            $trans_featured = _e('Time Left', 'Mercycorp');
        } else {
            echo $cs_theme_option['trans_timeleft'];
        } ?></h4>
                                            <div class="ev-contdown">
        <?php cs_enqueue_countdown_script(); ?>
                                                <script>
                                                    //Countdown callback function
                                                    jQuery(function () {
                                                        var austDay = new Date();
                                                        austDay = new Date(<?php echo $year_event; ?>,<?php echo $month_event; ?> - 1,<?php echo $date_event; ?>,<?php echo $cs_hours; ?>,<?php echo $cs_minutes; ?>);
                                                        jQuery('#countdown').countdown({until: austDay});
                                                        jQuery('#year').text(austDay.getFullYear());
                                                    });
                                                </script>
                                                <div class="countdownit"><div id="countdown"></div></div>
                                            </div>
                                            <!--<a href="#" class="cs-addcalender"><i class="icon-calendar"></i></a>-->
        <?php add_to_calender($post->ID); ?>
                                                                    <!--<a href="#"><i class="icon-calendar"></i><?php if ($cs_theme_option['trans_switcher'] == "on") {
            _e('Add to Calendar', 'Mercycorp');
        } else {
            echo $cs_theme_option['trans_add_to_calendar'];
        } ?></a>-->
                                        </div>
                                    </div>
                                </div>
                                <!-- Post Options End -->
                            </article>
                        </div>
                        <!-- Detail Text Start -->
                        <div class="detail_text rich_editor_text">
        <?php
        the_content();
        wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'Mercycorp') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>'));
        ?>
                        </div>
                        <!-- Map Section Start -->
                        <div class="map-sec eventdetail-parallax" id="event-map">
                            <?php
                            if ($inside_event_map == "on") {
                                if ($address_map <> "" && $event_loc_lat <> "" && $event_loc_long <> "" && $event_loc_zoom <> '') {
                                    ?>
                                    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script> 
                                    <script type="text/javascript">
                jQuery(document).ready(function () {
                event_map("<?php echo $loc_address . '<br>' . $loc_city . '<br>' . $loc_postcode . '<br>' . $loc_country ?>",<?php echo $event_loc_lat ?>, <?php echo $event_loc_long ?>,<?php echo $event_loc_zoom ?>,<?php echo $cs_counter_events; ?>);
                });
                                    </script>
                                    <article>
                                        <div id="map_canvas<?php echo $cs_counter_events; ?>" class="event-map" style="height:300px; width:100%;"></div>
                                    </article>
                            <?php
                            }
                        }
                        ?>
                        </div>
                        <!-- Detail Text End -->

                        <!-- TagCloud Start -->
                        <?php
                        /* translators: used between list items, there is a space after the comma */
                        $before_tag = " <div class='tagcloud'><h5>" . __('Tags', 'Mercycorp') . ":</h5>";
                        $tags_list = get_the_term_list(get_the_id(), 'event-tag', $before_tag, ' ', '</div>');
                        if ($tags_list) {
                            printf(__('%1$s', 'Mercycorp'), $tags_list);
                        } // End if categories 
                        ?> 
                        <!-- TagCloud End -->
                        <!-- Post Media attachment-->
                        <?php
                        $args = array(
                            'post_type' => 'attachment',
                            'numberposts' => -1,
                            'post_status' => null,
                            'post_parent' => $post->ID
                        );
                        $attachments = get_posts($args);
                        if ($attachments) {
                            echo '<ul class="post-media-attachments gallery-list lightbox">';
                            cs_enqueue_gallery_style_script();
                            foreach ($attachments as $attachment) {
                                $attachment_title = apply_filters('the_title', $attachment->post_title);
                                $type = get_post_mime_type($attachment->ID);
                                if ($type == 'image/jpeg') {
                                    $image_attributes = wp_get_attachment_image_src((int) $attachment->ID, '230', '222');
                                    echo '<li>';
                                    ?>
                                    <a <?php if ($attachment_title <> '') {
                                        echo 'data-title="' . $attachment_title . '"';
                                    } ?> href="<?php echo $attachment->guid; ?>" data-rel="<?php echo "prettyPhoto[gallery1]" ?>"><img src="<?php echo $image_attributes[0]; ?>" width="150" height="150"></a>
                                    <?php
                                    echo '</li>';
                                } elseif ($type == 'audio/mpeg') {
                                    echo '<li>';
                                    ?>
                                    <!-- Button to trigger modal -->
                                    <a href="#audioattachment<?php echo $attachment->ID; ?>" role="button" data-toggle="modal"><i class="icon-play-sign icon-5x"></i></a>
                                    <!-- Modal -->
                                    <div id="audioattachment<?php echo $attachment->ID; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-body">
                                            <audio style="width:100%;" src="<?php echo $attachment->guid; ?>" type="audio/mp3" controls="controls"></audio>
                                        </div>
                                    </div>
                                    <?php
                                    echo '</li>';
                                } elseif ($type == 'video/mp4') {
                                    echo '<li>';
                                    ?>
                                    <a href="#videoattachment<?php echo $attachment->ID; ?>" role="button" data-toggle="modal"><i class="icon-play-sign icon-5x"></i></a>
                                    <div id="videoattachment<?php echo $attachment->ID; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-body">
                                            <video width="100%" class="mejs-wmp" height="380" src="<?php echo $attachment->guid; ?>"  id="player1" poster="" controls="controls" preload="none"></video>
                                        </div>
                                    </div>
                                        <?php
                                        echo '</li>';
                                    }
                                }
                                echo '</ul>';
                                //<!-- Post Media attachment end--> 
                            }
                            ?>
                        <!-- Share Post Start -->
                        <div class="share_post">

        <?php
        if ($event_social_sharing == "on") {
            cs_social_share();
        }
        cs_next_prev_post();
        ?>
                        </div>
                        <!-- Share Post End -->
        <?php
        if (get_the_author_meta('description')) {
            //<!-- About Author Start -->
            ?>
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
                    </div>
        <?php if ($cs_layout == 'content-left col-md-9') { ?>
                        <!--Right Sidebar Starts-->
                        <aside class="sidebar-right col-md-3"><?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_right)) : ?><?php endif; ?></aside>
        <?php } ?>
                </div>
                <!-- Row End --> 
            </div>
            <!-- Container End --> 
        </div>
        <!-- main End -->
        <?php
    endwhile;
$cs_counter_events++;
get_footer();
?>