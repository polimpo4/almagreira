<?php
global $cs_node, $post, $cs_theme_option, $cs_counter_node, $wpdb;
date_default_timezone_set('UTC');
$current_time = current_time('Y-m-d H:i', $gmt = 0);
if (!isset($cs_node->cs_event_per_page) || empty($cs_node->cs_event_per_page)) {
    $cs_node->cs_event_per_page = -1;
}
$meta_compare = '';
$filter_category = '';
if ($cs_node->cs_event_type == "Upcoming Events")
    $meta_compare = ">";
else if ($cs_node->cs_event_type == "Past Events")
    $meta_compare = "<";
$row_cat = $wpdb->get_row("SELECT * from " . $wpdb->prefix . "terms WHERE slug = '" . $cs_node->cs_event_category . "'");
if (isset($_GET['filter_category'])) {
    $filter_category = $_GET['filter_category'];
} else {
    if (isset($row_cat->slug)) {
        $filter_category = $row_cat->slug;
    }
}
$cs_counter_events = 0;
if (empty($_GET['page_id_all'])) {
    $_GET['page_id_all'] = 1;
}
if ($cs_node->cs_event_type == "All Events") {
    $args = array(
        'posts_per_page' => "-1",
        'paged' => $_GET['page_id_all'],
        'post_type' => 'events',
        'post_status' => 'publish',
        'orderby' => 'meta_value',
        'order' => 'ASC',
    );
} else {
    $args = array(
        'posts_per_page' => "-1",
        'paged' => $_GET['page_id_all'],
        'post_type' => 'events',
        'post_status' => 'publish',
        'meta_key' => 'cs_event_from_date_time',
        'meta_value' => $current_time,
        'meta_compare' => $meta_compare,
        'orderby' => 'meta_value',
        'order' => 'ASC',
    );
}
if (isset($filter_category) && $filter_category <> '' && $filter_category <> '0') {
    $event_category_array = array('event-category' => "$filter_category");
    $args = array_merge($args, $event_category_array);
}
$custom_query = new WP_Query($args);
$count_post = 0;
$count_post = $custom_query->post_count;
?>
<div class="element_size_<?php echo $cs_node->event_element_size; ?>">
    <?php
    if ($cs_node->cs_event_view == 'Calendar View') {
        if ($cs_node->cs_event_type == "All Events") {
            $args = array(
                'posts_per_page' => "-1",
                'post_type' => 'events',
                'event-category' => "$filter_category",
                'post_status' => 'publish',
                'orderby' => 'meta_value',
                'order' => 'ASC',
            );
        } else {
            $args = array(
                'posts_per_page' => "-1",
                'post_type' => 'events',
                'event-category' => "$filter_category",
                'post_status' => 'publish',
                'meta_key' => 'cs_event_from_date_time',
                'meta_value' => $current_time,
                'meta_compare' => $meta_compare,
                'orderby' => 'meta_value',
                'order' => 'ASC',
            );
        }
        $custom_query = new WP_Query($args);
        if ($custom_query->have_posts() <> "") {
            while ($custom_query->have_posts()): $custom_query->the_post();
                $cs_event_meta = get_post_meta($post->ID, "cs_event_meta", true);
                $event_from_date = get_post_meta($post->ID, "cs_event_from_date", true);
                $cs_event_to_date = get_post_meta($post->ID, "cs_event_to_date", true);
                if ($cs_event_meta <> "") {
                    $cs_event_meta = new SimpleXMLElement($cs_event_meta);
                }
                if ($cs_event_meta->event_all_day != "on") {
                    $allday = false;
                } else {
                    $allday = true;
                }
                $aaa[] = array(
                    'title' => substr(get_the_title(), 0, 35) . '....',
                    'start' => date("Y-m-d", strtotime($event_from_date)),
                    'end' => date("Y-m-d", strtotime($cs_event_to_date)),
                    //'allDay' => $allday,
                    'url' => get_permalink()
                );
                $counter_events++;
            endwhile;
            cs_calender_enqueue_scripts();
            ?>		
            <script type='text/javascript'>
                jQuery(document).ready(function ($) {
                    var date = new Date();
                    var d = date.getDate();
                    var m = date.getMonth();
                    var y = date.getFullYear();

                    jQuery('#calendar').fullCalendar({
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        },
                        editable: true,
                        eventMouseover: function (calEvent, domEvent) {
                            var thistxt = $(this).html();
                            jQuery('body').append("<div class='wrappertooltip'><span class='innertooltip'>" + thistxt + "</span></div>");
                            var x = jQuery(this).offset().left;
                            var y = jQuery(this).offset().top;
                            var xw = jQuery(".wrappertooltip").outerWidth();
                            var xh = jQuery(".wrappertooltip").outerHeight();
                            jQuery(".wrappertooltip").css({"top": y, "left": x, "margin-left": -xw / 2, "margin-top": -(xh)});
                        },
                        eventMouseout: function (calEvent, domEvent) {
                            jQuery(".wrappertooltip").remove();
                        },
                        disableResizing: true,
                        disableDragging: true,
                        events: <?php echo json_encode($aaa); ?>
                    });
                });
            </script>
            <!-- Calender Protected Start -->
            <div class="calendar">
                <div id='calendar'></div>
            </div>
            <!-- Calender Protected End -->
            <?php } else { ?>
            <h2><?php _e('No results found.', "Mercycorp") ?></h2>
                <?php
            }
        } else {
            if ($cs_node->cs_featured_post <> '') {
                ?>
            <div class="event featured-event">
                <?php
                $cs_featured_post_args = array('post_type' => "events", 'p' => $cs_node->cs_featured_post);
                $cs_featured_post_custom_query = new WP_Query($cs_featured_post_args);
                while ($cs_featured_post_custom_query->have_posts()) : $cs_featured_post_custom_query->the_post();
                    $image_url = cs_get_post_img_src($post->ID, 550, 550);
                    $event_from_date = get_post_meta($post->ID, "cs_event_from_date", true);
                    $cs_event_to_date = get_post_meta($post->ID, "cs_event_to_date", true);
                    $cs_event_meta = get_post_meta($post->ID, "cs_event_meta", true);
                    $cs_event_from_date_time = get_post_meta($post->ID, "cs_event_from_date_time", true);
                    $year_event = date("Y", strtotime($event_from_date));
                    $month_event = date("m", strtotime($event_from_date));
                    $month_event_c = date("M", strtotime($event_from_date));
                    $date_event = date("d", strtotime($event_from_date));
                    $cs_hours = date("H", strtotime($cs_event_from_date_time));
                    $cs_minutes = date("i", strtotime($cs_event_from_date_time));
                    if ($cs_event_meta <> "") {
                        $cs_event_meta = new SimpleXMLElement($cs_event_meta);
                    }
                    ?>
                    <article class="featured">
            <?php
            if ($cs_theme_option['trans_switcher'] == "on") {
                $trans_featured = __('Featured', 'Mercycorp');
            } else {
                $trans_featured = $cs_theme_option['trans_featured'];
            }
            if ($image_url <> "") {
                echo '<figure><a href="' . get_permalink() . '"><img src="' . $image_url . '" /></a>
                                        <span><i class="icon icon-star"></i>' . $trans_featured . '</span></figure>';
            }
            ?>
                        <div class="text">
                            <div class="text-row">
                                <div class="inn_text">
                                    <h2 class="post-title"><a href="<?php the_permalink(); ?>" class="colrhover"><?php the_title(); ?></a></h2>
                                    <ul>
            <?php
            /* translators: used between list items, there is a space after the comma */
            $listed_in_text = "";
            $before_cat = '<li><i class="icon icon-reorder">&nbsp;</i>';
            $categories_list = get_the_term_list(get_the_id(), 'event-category', $before_cat, ', ', '</li>');
            if ($categories_list): printf(__('%1$s', 'Mercycorp'), $categories_list);
            endif;
            ?>
                                        <li><i class="icon icon-calendar">&nbsp;</i>

                                            <!--< ?php echo date_i18n(get_option('date_format'),strtotime($event_from_date));?>,-->

                                            <?php echo date_i18n(get_option('date_format'), strtotime($event_from_date)); ?>,


                                            <?php
                                            if ($cs_event_meta->event_all_day != "on") {
                                                // echo $cs_event_meta->event_start_time; 
                                                /* <!-- Miltry Time--> */
                                                echo date_i18n(get_option('time_format'), strtotime($cs_event_meta->event_start_time));
                                                /* miltry time */
                                                if ($cs_event_meta->event_end_time <> '') {
                                                    echo "- "; // echo $cs_event_meta->event_end_time; 
                                                    echo date_i18n(get_option('time_format'), strtotime($cs_event_meta->event_end_time));
                                                }
                                            } else {
                                                _e("All", 'Mercycorp') . printf(__("%s day", 'Mercycorp'), ' ');
                                            }
                                            ?>
                                        </li>
                                    </ul>
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
                                </div>
                            </div>
                        </div>       
                    </article>        
                        <?php
                    endwhile;
                    wp_reset_query();
                    ?>
            </div>
                    <?php } ?>
        <div class="event"> 

    <?php if ($cs_node->cs_event_title <> '' || $cs_node->cs_event_filterables == "Yes") { ?>
                <!-- Event Heading Area Start -->
                <header>
                                    <?php if ($cs_node->cs_event_title <> '') { ?>
                        <h2 class="section-title"><?php echo $cs_node->cs_event_title; ?></h2>
                                <?php } ?>
                    <!-- Sortby Start -->
                                <?php if ($cs_node->cs_event_filterables == "Yes" && !empty($filter_category)) { ?>

                        <div class="sortby">
                                        <?php
                                        $qrystr = "";
                                        if (isset($_GET['page_id']))
                                            $qrystr = "&page_id=" . $_GET['page_id'];
                                        ?>
                            <form action="" method="get">
                                <input type="hidden" name="page_id" value="<?php if (isset($_GET['page_id'])) echo $_GET['page_id'] ?>" />
                                <select name="filter_category" onchange="this.form.submit()">
                                    <option>
            <?php _e("All", 'Mercycorp'); ?>
                                    </option>
                    <?php
                    $categories = get_categories(array('child_of' => "$row_cat->term_id", 'taxonomy' => 'event-category', 'hide_empty' => 0));
                    foreach ($categories as $category) {
                        ?>
                                        <option class="filter <?php if ($filter_category == $category->slug) echo "active"; ?>" >
                        <?php echo $category->slug ?>
                                        </option>
                    <?php } ?>
                                </select>
                            </form>
                        </div>
                        <!-- Sortby End --> 
                <?php } ?>
                </header>

                <!-- Event Heading Area End -->
                <?php
            }

            if ($cs_node->cs_event_pagination == "Single Page") {
                $cs_node->cs_event_per_page = $cs_node->cs_event_per_page;
            }
            if ($count_post) {

                if ($cs_node->cs_event_type == "Upcoming Events") {
                    $args = array(
                        'posts_per_page' => "$cs_node->cs_event_per_page",
                        'paged' => $_GET['page_id_all'],
                        'post_type' => 'events',
                        'post_status' => 'publish',
                        'meta_key' => 'cs_event_from_date_time',
                        'meta_value' => $current_time,
                        'meta_compare' => $meta_compare,
                        'orderby' => 'meta_value',
                        'order' => 'ASC',
                    );
                } else if ($cs_node->cs_event_type == "All Events") {
                    $args = array(
                        'posts_per_page' => "$cs_node->cs_event_per_page",
                        'paged' => $_GET['page_id_all'],
                        'post_type' => 'events',
                        'meta_key' => 'cs_event_from_date_time',
                        'meta_value' => '',
                        'post_status' => 'publish',
                        'orderby' => 'meta_value',
                        'order' => 'DESC',
                    );
                } else {
                    $args = array(
                        'posts_per_page' => "$cs_node->cs_event_per_page",
                        'paged' => $_GET['page_id_all'],
                        'post_type' => 'events',
                        'post_status' => 'publish',
                        'meta_key' => 'cs_event_from_date_time',
                        'meta_value' => $current_time,
                        'meta_compare' => $meta_compare,
                        'orderby' => 'meta_value',
                        'order' => 'DESC',
                    );
                }
                if (isset($filter_category) && $filter_category <> '' && $filter_category <> '0') {
                    $event_category_array = array('event-category' => "$filter_category");
                    $args = array_merge($args, $event_category_array);
                }
                $custom_query = new WP_Query($args);
                $width = 150;
                $height = 150;
                if ($custom_query->have_posts() <> "") {
                    ?>
                    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script> 
                    <?php
                    $cs_counter_year = $cs_counter_month = $previous_counter_year = $previous_counter_month = 0;
                    $count_event = 1;
                    while ($custom_query->have_posts()): $custom_query->the_post();
                        $event_from_date = get_post_meta($post->ID, "cs_event_from_date", true);
                        $cs_event_to_date = get_post_meta($post->ID, "cs_event_to_date", true);
                        $cs_counter_month = date('m', strtotime($event_from_date));
                        $cs_counter_year = date('Y', strtotime($event_from_date));
                        if (($cs_counter_year <> $previous_counter_year) || ($cs_counter_month <> $previous_counter_month) || ($count_event == 1)) {
                            $previous_counter_year = $cs_counter_year;
                            $previous_counter_month = $cs_counter_month;
                            ?>
                            <h1 class="event-heading"><span class="backcolr uppercase"><?php echo date_i18n('F', strtotime($event_from_date)); ?></span><?php echo date_i18n('Y', strtotime($event_from_date)); ?></h1>
                            <?php
                        }
                        $count_event++;
                        $cs_event_meta = get_post_meta($post->ID, "cs_event_meta", true);
                        if ($cs_event_meta <> "") {
                            $cs_event_meta = new SimpleXMLElement($cs_event_meta);
                            if ($cs_event_meta->event_address <> '') {
                                $address_map = get_the_title("$cs_event_meta->event_address");
                            } else {
                                $address_map = '';
                            }
                        }

                        $cs_event_loc = get_post_meta("$cs_event_meta->event_address", "cs_event_loc_meta", true);
                        if ($cs_event_loc <> "") {
                            $cs_xmlObject = new SimpleXMLElement($cs_event_loc);
                            $loc_address = $cs_xmlObject->loc_address;
                            $event_loc_lat = $cs_xmlObject->event_loc_lat;
                            $event_loc_long = $cs_xmlObject->event_loc_long;
                            $event_loc_zoom = $cs_xmlObject->event_loc_zoom;
                            $loc_city = $cs_xmlObject->loc_city;
                            $loc_postcode = $cs_xmlObject->loc_postcode;
                            $loc_country = $cs_xmlObject->loc_country;
                        } else {
                            $loc_address = '';
                            $event_loc_lat = '';
                            $event_loc_long = '';
                            $event_loc_zoom = '';
                        }

                        $image_id = cs_get_post_img($post->ID, $width, $height);
                        if ($image_id == '') {
                            $noimg = 'no-img';
                        } else {
                            $noimg = '';
                        }
                        ?>
                        <!-- Article Start -->
                        <article <?php post_class($noimg); ?>> 
                            <!-- Text Start -->
                            <div class="text">
                                        <?php
                                        if ($image_id <> "") {
                                            echo '<figure><a href="' . get_permalink() . '">' . $image_id . '</a><figcaption><a href="' . get_permalink() . '"><i class="icon-plus icon-2x"></i></a></figcaption></figure>';
                                        } else {
                                            echo '<figure><a href="#"></a></figure>';
                                        }
                                        ?>
                                <div class="inn_text">
                                    <h2 class="post-title"><a href="<?php the_permalink(); ?>" class="colrhover"><?php echo substr(get_the_title(), 0, 40);
                            if (strlen(get_the_title()) > 40) echo '...'; ?></a></h2>
                                    <ul>
                                            <?php
                                            /* translators: used between list items, there is a space after the comma */
                                            $listed_in_text = "";
                                            if ($cs_theme_option['trans_switcher'] == "on") {
                                                $listed_in_text = _e('Listed in', 'Mercycorp');
                                            } else {
                                                $listed_in_text = $cs_theme_option['trans_listed_in'];
                                            }
                                            $before_cat = '<li>' . $listed_in_text . ': ';
                                            $categories_list = get_the_term_list(get_the_id(), 'event-category', $before_cat, ', ', '</li>');
                                            if ($categories_list): printf(__('%1$s', 'Mercycorp'), $categories_list);
                                            endif;
                                            ?>
                                        <li><i class="icon-time icon-2"></i><?php echo date_i18n(get_option('date_format'), strtotime($event_from_date)); ?>,
                                    <?php
                                    if ($cs_event_meta->event_all_day != "on") {
                                        // echo $cs_event_meta->event_start_time;
                                        echo date_i18n(get_option('time_format'), strtotime($cs_event_meta->event_start_time));


                                        if ($cs_event_meta->event_end_time <> '') {
                                            echo "- ";

                                            //echo $cs_event_meta->event_end_time;

                                            echo date_i18n(get_option('time_format'), strtotime($cs_event_meta->event_end_time));
                                        }
                                    } else {
                                        _e("All", 'Mercycorp') . printf(__("%s day", 'Mercycorp'), ' ');
                                    }
                                    ?>




                                        </li>
                                    </ul>
                                                <?php if ($address_map <> "" && $event_loc_lat <> "" && $event_loc_long <> '' && $event_loc_zoom <> '') { ?>
                                        <a class="open webkit" onclick="show_mapp('<?php echo $post->ID; ?>', '<?php echo $address_map; ?>', '<?php echo $event_loc_lat; ?>', '<?php echo $event_loc_long; ?>', '<?php echo $event_loc_zoom; ?>', '<?php echo home_url() ?>', '<?php echo get_template_directory_uri() ?>')"><i class="icon-map-marker icon-2x"></i></a>
                                                <?php } ?>
                                </div>
                                <!-- Open Map Start -->
                                                    <?php if ($address_map <> "" && $event_loc_lat <> "" && $event_loc_long <> '' && $event_loc_zoom <> '') { ?>
                                    <div class="open_map post-<?php echo $post->ID; ?>">
                                        <div  id="map_canvas<?php echo $post->ID; ?>" style="height:300px; width:100%; float:left;"></div>
                                        <!-- Map Caption Start -->
                                        <div class="map-caption">
                                            <ul>
                                                <li><i class="icon-map-marker"></i><?php echo $loc_address . ', ' . $loc_city . ', ' . $loc_postcode . ', ' . $loc_country ?></li>
                                                <li>
                    <?php if ($cs_event_meta->event_phone_no <> "") { ?>
                                                        <i class="icon-phone"></i><?php echo $cs_event_meta->event_phone_no; ?>
                    <?php } ?>
                                                </li>
                                                <li>
                            <?php
                            if ($cs_event_meta->event_buy_now <> "") {

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
                                                        <a href="<?php echo $cs_event_meta->event_buy_now; ?>" class="small-btn square" target="_blank"><i class="icon-ticket"></i><?php echo $trans_buynow; ?></a>
                    <?php } ?>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- Map Caption End --> 
                                    </div>
                <?php } ?>
                                <!-- Open Map End --> 
                            </div>
                            <!-- Text End --> 
                        </article>
                        <!-- Article End --> 
            <?php
            endwhile;
        }
    }
    $qrystr = '';
    if ($cs_node->cs_event_pagination == "Show Pagination" and $count_post > $cs_node->cs_event_per_page and $cs_node->cs_event_per_page > 0 and $cs_node->cs_event_filterables != "On") {
        echo "<nav class='pagination'><ul>";
        if (isset($_GET['page_id']))
            $qrystr = "&page_id=" . $_GET['page_id'];
        echo cs_pagination($count_post, $cs_node->cs_event_per_page, $qrystr);
        echo "</ul></nav>";
    }
    ?>
        </div>
<?php } ?>
</div>
