<?php
get_header();
global $cs_theme_option;
isset($cs_theme_option['cs_layout']);
$cs_layout = $cs_theme_option['cs_layout'];
?>
<div role="main" id="main">
    <div class="container"> 
        <div class="row">

            <div class="col-md-9">
                <div class="postlist blog">
                    <!-- Blog Post Start -->
                    <?php
                    if (is_author()) {
                        global $author;
                        $userdata = get_userdata($author);
                    }
                    if (category_description() || is_tag() || (is_author() && isset($userdata->description) && !empty($userdata->description))) {
                        echo '<div class="rich_editor_text">';
                        if (is_author()) {
                            echo $userdata->description;
                        } elseif (is_category()) {
                            echo category_description();
                        } elseif (is_tag()) {
                            $tag_description = tag_description();
                            if (!empty($tag_description))
                                echo apply_filters('tag_archive_meta', $tag_description);
                        }
                        echo '</div>';
                    }
                    ?>
                    <?php
                    if (empty($_GET['page_id_all']))
                        $_GET['page_id_all'] = 1;
                    if (!isset($_GET["s"])) {
                        $_GET["s"] = '';
                    }
                    rewind_posts();
                    $taxonomy = 'category';
                    $taxonomy_tag = 'post_tag';
                    $args_cat = array();
                    if (is_author()) {
                        $args_cat = array('author' => $wp_query->query_vars['author']);
                        $post_type = array('post', 'events', 'cs_cause');
                    } elseif (is_date()) {
                        if (is_month() || is_year() || is_day() || is_time()) {
                            $args_cat = array('m' => $wp_query->query_vars['m'], 'year' => $wp_query->query_vars['year'], 'day' => $wp_query->query_vars['day'], 'hour' => $wp_query->query_vars['hour'], 'minute' => $wp_query->query_vars['minute'], 'second' => $wp_query->query_vars['second']);
                        }
                        $post_type = array('post');
                    } elseif (isset($wp_query->query_vars['taxonomy']) && !empty($wp_query->query_vars['taxonomy'])) {
                        $taxonomy = $wp_query->query_vars['taxonomy'];
                        $taxonomy_category = '';
                        $taxonomy_category = $wp_query->query_vars[$taxonomy];
                        if ($wp_query->query_vars['taxonomy'] == 'cs_cause-category' || $wp_query->query_vars['taxonomy'] == 'cs_cause-tag') {
                            $args_cat = array($taxonomy => "$taxonomy_category");
                            $post_type = 'cs_cause';
                        } else if ($wp_query->query_vars['taxonomy'] == 'event-category' || $wp_query->query_vars['taxonomy'] == 'event-tag') {
                            $args_cat = array($taxonomy => "$taxonomy_category");
                            $post_type = 'events';
                        } else {
                            $taxonomy = 'category';
                            $args_cat = array();
                            $post_type = 'post';
                        }
                    } elseif (is_category()) {
                        $taxonomy = 'category';
                        $args_cat = array();
                        $category_blog = $wp_query->query_vars['cat'];
                        $post_type = 'post';
                        $args_cat = array('cat' => "$category_blog");
                    } elseif (is_tag()) {
                        $taxonomy = 'category';
                        $args_cat = array();
                        $tag_blog = $wp_query->query_vars['tag'];
                        $post_type = 'post';
                        $args_cat = array('tag' => "$tag_blog");
                    } else {
                        $taxonomy = 'category';
                        $args_cat = array();
                        $post_type = 'post';
                    }
                    $args = array(
                        'post_type' => $post_type,
                        'paged' => $_GET['page_id_all'],
                        'post_status' => 'publish',
                        'order' => 'ASC',
                    );
                    $args = array_merge($args_cat, $args);
                    $custom_query = new WP_Query($args);
                    ?>
                    <?php if ($custom_query->have_posts()): ?>
                        <?php
                        while ($custom_query->have_posts()) : $custom_query->the_post();
                            $event_from_date = get_post_meta($post->ID, "cs_event_from_date", true);
                            ?> 

                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                                <!-- Text Start -->
                                <div class="blog_text webkit">
                                    <div class="text">
                                        <?php cs_featured(); ?>
                                        <h2 class="heading-color post-title"><a href="<?php the_permalink(); ?>" class="colrhover"><?php the_title(); ?></a></h2>
                                    </div>
                                    <ul class="post-options">
                                        <li><i class="icon icon-user">&nbsp;</i><?php printf(__('%s', 'Mercycorp'), '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '" >' . get_the_author() . '</a>'); ?></li>
                                        <li>
                                            <i class="icon icon-calendar">&nbsp;</i>
                                            <time datetime="<?php echo date('Y-m-d', strtotime(get_the_date())); ?>"><?php echo get_the_date(); ?></time>
                                        </li>

                                        <li><?php
                                            if (comments_open()) {
                                                echo '<i class="icon-comment"></i>';
                                                comments_popup_link(__('0', 'Mercycorp'), __('1', 'Mercycorp'), __('%', 'Mercycorp'));
                                            }
                                            ?></li>

                                        <?php edit_post_link(__('Edit', 'Mercycorp'), '<li><span class="edit-link">', '</span></li>'); ?>
                                    </ul> 
                                    <?php
                                    the_content();
                                    ?> 
                                </div>
                                <!-- Text End -->

                            </article>

                            <?php
                        endwhile;
                    endif;
                    ?>

                </div>
                <?php
                $qrystr = '';
                // pagination start
                if ($custom_query->found_posts > get_option('posts_per_page')) {
                    echo "<nav class='pagination'><ul>";
                    if (isset($_GET['page_id']))
                        $qrystr .= "&page_id=" . $_GET['page_id'];
                    if (isset($_GET['author']))
                        $qrystr .= "&author=" . $_GET['author'];
                    if (isset($_GET['tag']))
                        $qrystr .= "&tag=" . $_GET['tag'];
                    if (isset($_GET['cat']))
                        $qrystr .= "&cat=" . $_GET['cat'];
                    if (isset($_GET['event-category']))
                        $qrystr .= "&event-category=" . $_GET['event-category'];
                    if (isset($_GET['cs_cause-category']))
                        $qrystr .= "&cs_cause-category=" . $_GET['cs_cause-category'];
                    if (isset($_GET['event-tag']))
                        $qrystr .= "&event-tag=" . $_GET['event-tag'];
                    if (isset($_GET['cs_cause-tag']))
                        $qrystr .= "&cs_cause-tag=" . $_GET['cs_cause-tag'];
                    if (isset($_GET['m']))
                        $qrystr .= "&m=" . $_GET['m'];
                    echo cs_pagination($custom_query->found_posts, get_option('posts_per_page'), $qrystr);
                    echo "</ul></nav>";
                }
                // pagination end
                ?>
            </div>  
             <div class="col-md-3">
                 <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Event Detail')) : ?><?php endif; ?>
            </div>
            <?php get_footer(); ?>