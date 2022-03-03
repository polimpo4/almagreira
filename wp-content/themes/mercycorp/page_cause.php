<?php
global $cs_node, $post, $cs_theme_option, $cs_counter_node, $wpdb;
$cs_xmlObject_transaction = new stdclass();
$cause_status = '';
if (!isset($cs_node->cause_per_page) || empty($cs_node->cause_per_page)) {
    $cs_node->cause_per_page = -1;
}
$filter_category = '';
$row_cat = $wpdb->get_row("SELECT * from " . $wpdb->prefix . "terms WHERE slug = '" . $cs_node->cause_cat . "'");
if (isset($_GET['filter_category'])) {
    $filter_category = $_GET['filter_category'];
} else {
    if (isset($row_cat->slug)) {
        $filter_category = $row_cat->slug;
    }
}
if (empty($_GET['page_id_all']))
    $_GET['page_id_all'] = 1;

$args = array(
    'posts_per_page' => "-1",
    'post_type' => 'cs_cause',
    'post_status' => 'publish',
    'order' => 'ASC',
);
if (isset($cs_node->menu_cat) && $cs_node->menu_cat <> '' && $cs_node->menu_cat <> '0') {
    $menu_category_array = array('cs_cause-category' => "$filter_category");
    $args = array_merge($args, $menu_category_array);
}
$custom_query = new WP_Query($args);
$post_count = 0;
$post_count = $custom_query->post_count;
?>
<div class="element_size_<?php echo $cs_node->cause_element_size; ?>">
    <div class="our-cuases">
        <?php
        $percentage_amount = $payment_gross = '0';
        $cs_xmlObject_transaction->transaction = '';
        if (isset($cs_node->cause_featured_article) && $cs_node->cause_featured_article <> '0') {
            query_posts(array('p' => $cs_node->cause_featured_article, 'post_type' => 'cs_cause'));
            if (have_posts()) : while (have_posts()) : the_post();
                    $post_xml = get_post_meta($post->ID, "cs_cause_meta", true);
                    if ($post_xml <> '') {
                        $cs_xmlObject = new SimpleXMLElement($post_xml);
                    }
                    $cs_tr = get_post_meta($post->ID, "cs_cause_transaction_meta", true);
                    $payment_gross = 0;
                    $percentage_amount = 0;
                    if ($cs_tr <> '') {
                        $cs_xmlObject_transaction = new SimpleXMLElement($cs_tr);
                        if (count($cs_xmlObject_transaction->transaction) > 0) {
                            foreach ($cs_xmlObject_transaction->transaction as $transct) {
                                $payment_gross = $payment_gross + $transct->payment_gross;
                            }
                            if ($payment_gross <> '0' && $cs_xmlObject->cause_goal_amount <> '0') {
                                $percentage_amount = (($payment_gross / $cs_xmlObject->cause_goal_amount) * 100);
                            }
                            if ($percentage_amount > 0 || $percentage_amount == '100') {
                                $percentage_amount = 100;
                                if ($cs_theme_option['trans_switcher'] == "on") {
                                    $cause_status = __('Closed', 'Mercycorp');
                                } else {
                                    $cause_status = $cs_theme_option['cause_status'];
                                }
                            }
                        }
                    }
                    $image_url = cs_attachment_image_src(get_post_thumbnail_id($post->ID), '230', '230');
                    ?>
                    <article class="featureds">
            <?php if ($image_url <> "") { ?><figure><a href="<?php the_permalink(); ?>"><img src="<?php echo $image_url; ?>" alt=""></a></figure><?php } ?>
                        <!-- Text Section -->
                        <div class="text-sec">
                            <div class="dis-table">
                                <div class="dis-tow">
                                    <div class="inntext">
                                        <h2 class="post-title heading-color"><a class="colrhover" href="<?php the_permalink(); ?>"><?php echo substr(get_the_title(), 0, 24);
            if (strlen(get_the_title()) > 24) echo '...'; ?></a></h2>
                                        <time><?php echo date('F d, Y', strtotime(get_the_date())); ?></time>
                                        <p><?php cs_get_the_excerpt($cs_node->cs_cause_excerpt, true); ?></p>
                                    </div>
                                    <div class="donation-sec">
                                        <div class="progress_bar">
                                            <div data-loadbar-text="<?php echo round($percentage_amount); ?>%" data-loadbar="<?php echo round($percentage_amount); ?>" class="tiny-green">
                                                <div style="background-color: #8bba4e;"></div>
                                            </div>
                                            <div class="glob-info">
                                                <p><?php if ($cs_theme_option['trans_switcher'] == "on") {
                $trans_featured = _e('Goal', 'Mercycorp');
            } else {
                echo $cs_theme_option['cause_goal'];
            } ?> <span><?php echo $cs_theme_option['paypal_currency_sign']; ?><?php echo number_format((float) $cs_xmlObject->cause_goal_amount); ?></span></p>
                                                <p class="rised"><?php if ($cs_theme_option['trans_switcher'] == "on") {
                                _e('Raised', 'Mercycorp');
                            } else {
                                echo $cs_theme_option['cause_raised'];
                            } ?> <span><?php echo $cs_theme_option['paypal_currency_sign']; ?><?php echo number_format($payment_gross); ?></span></p>
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
                                <a href="<?php the_permalink(); ?>" class="donar-info"><i class="icon-user"></i><?php echo count($cs_xmlObject_transaction->transaction); ?> <?php if ($cs_theme_option['trans_switcher'] == "on") {
                _e('Donors', 'Mercycorp');
            } else {
                echo $cs_theme_option['cause_donors'];
            } ?></a>
                            </div>
                        </div>
                        <!-- Text Section -->
                    </article>
                            <?php endwhile;
                        endif;
                        wp_reset_query();
                    } ?>
        <header>
                    <?php if ($cs_node->cause_title <> '') { ?>
                <h2 class="section-title"><?php echo $cs_node->cause_title; ?></h2>
<?php } ?>
            <?php
            if ($cs_node->cause_filterable == "On") {
                $qrystr = "";
                if (isset($_GET['page_id']))
                    $qrystr = "&page_id=" . $_GET['page_id'];
                ?>  
                <!-- Sortby Start -->
                <div class="sortby-sec">

                    <ul>
                        <li class="<?php if (($cs_node->cause_cat == $filter_category) || empty($cs_node->cause_cat)) {
                echo 'active';
            } ?>"><a href="?<?php echo $qrystr . "&filter_category=" . $row_cat->slug ?>"><?php _e("All", 'Mercycorp'); ?></a></li>
                <?php
                if ($cs_node->cause_cat <> "") {
                    $categories = get_categories(array('child_of' => "$row_cat->term_id", 'taxonomy' => 'cs_cause-category', 'hide_empty' => 0));
                } else {
                    $categories = get_categories(array('taxonomy' => 'cs_cause-category', 'hide_empty' => 0));
                }
                foreach ($categories as $category) {
                    ?>
                            <li class="<?php if ($category->slug == $filter_category) {
                echo 'active';
            } ?>"><a href="?<?php echo $qrystr . "&filter_category=" . $category->slug ?>"><?php echo $category->cat_name ?></a></li>
                <?php } ?>
                    </ul>
                </div>
                <!-- Sortby End -->
            <?php } ?>
        </header>
        <div class="marign-minus">
            <?php
            $args = array(
                'posts_per_page' => "$cs_node->cause_per_page",
                'paged' => $_GET['page_id_all'],
                'post_type' => 'cs_cause',
                'post_status' => 'publish',
                'order' => 'ASC',
            );
            if (isset($filter_category) && $filter_category <> '' && $filter_category <> '0') {
                $menu_category_array = array('cs_cause-category' => "$filter_category");
                $args = array_merge($args, $menu_category_array);
            }
            $custom_query = new WP_Query($args);
            while ($custom_query->have_posts()): $custom_query->the_post();
                $post_xml = get_post_meta($post->ID, "cs_cause_meta", true);
                if ($post_xml <> '') {
                    $cs_xmlObject = new SimpleXMLElement($post_xml);
                }
                $payment_gross = 0;
                $percentage_amount = 0;
                $cs_tr = get_post_meta($post->ID, "cs_cause_transaction_meta", true);
                if ($cs_tr <> '') {
                    $cs_xmlObject_transaction = new SimpleXMLElement($cs_tr);
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
                }
                $image_url = cs_attachment_image_src(get_post_thumbnail_id($post->ID), '230', '230');
                $no_image = '';
                if ($image_url == "") {
                    $no_image = 'no-img';
                }
                ?>
                <article <?php post_class($no_image); ?>>
    <?php if ($image_url <> "") { ?><figure><a href="<?php the_permalink(); ?>"><img src="<?php echo $image_url; ?>" alt=""></a></figure><?php } ?>
                    <!-- Text Section -->
                    <div class="text-sec">
                        <div class="dis-table">
                            <div class="dis-tow">
                                <div class="inntext">
                                    <h2 class="post-title heading-color"><a  class="colrhover"  href="<?php the_permalink(); ?>"><?php echo substr(get_the_title(), 0, 24);
                            if (strlen(get_the_title()) > 24) echo '...'; ?></a></h2>
                                <?php if ($image_url == "") { ?>
                                        <time><?php echo date('F d, Y', strtotime(get_the_date())); ?></time>
                                        <p><?php cs_get_the_excerpt($cs_node->cs_cause_excerpt, true); ?></p>
    <?php } ?>
                                </div>
                                <div class="donation-sec">
                                    <div class="progress_bar">
                                        <div data-loadbar-text="<?php echo round($percentage_amount); ?>%" data-loadbar="<?php echo round($percentage_amount); ?>" class="tiny-green">
                                            <div style="background-color: #8bba4e;"></div>
                                        </div>
                                        <div class="glob-info">
                                            <p><?php if ($cs_theme_option['trans_switcher'] == "on") {
                $trans_featured = _e('Goal', 'Mercycorp');
            } else {
                echo $cs_theme_option['cause_goal'];
            } ?> <span><?php echo $cs_theme_option['paypal_currency_sign']; ?><?php echo number_format((float) $cs_xmlObject->cause_goal_amount); ?></span></p>
                                            <p class="rised"><?php if ($cs_theme_option['trans_switcher'] == "on") {
            _e('Raised', 'Mercycorp');
        } else {
            echo $cs_theme_option['cause_raised'];
        } ?> <span><?php echo $cs_theme_option['paypal_currency_sign']; ?><?php echo number_format($payment_gross); ?></span></p>
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
                            <a href="<?php the_permalink(); ?>" class="donar-info"><i class="icon-user"></i><?php echo count($cs_xmlObject_transaction->transaction); ?> <?php if ($cs_theme_option['trans_switcher'] == "on") {
        _e('Donors', 'Mercycorp');
    } else {
        echo $cs_theme_option['cause_donors'];
    } ?></a>
                        </div>
                    </div>
                    <!-- Text Section -->
                </article>
<?php endwhile; ?>
        </div>
<?php
$qrystr = '';
if ($cs_node->cause_pagination == "Show Pagination" and $post_count > $cs_node->cause_per_page and $cs_node->cause_per_page > 0 and $cs_node->cause_filterable != "On") {
    echo "<nav class='pagination'><ul>";
    if (isset($_GET['page_id']))
        $qrystr = "&page_id=" . $_GET['page_id'];
    echo cs_pagination($post_count, $cs_node->cause_per_page, $qrystr);
    echo "</ul></nav>";
}
?>
    </div>
</div>