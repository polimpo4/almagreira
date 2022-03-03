<?php
cs_slider_gallery_template_redirect();
global $cs_node, $cs_theme_option, $cs_counter_node, $cs_video_width;
$cs_node = new stdClass();
get_header();
$cs_layout = '';
$post_xml = get_post_meta($post->ID, "post", true);
if ($post_xml <> "") {
    $cs_xmlObject = new SimpleXMLElement($post_xml);
    $cs_layout = $cs_xmlObject->sidebar_layout->cs_layout;
    $cs_sidebar_left = $cs_xmlObject->sidebar_layout->cs_sidebar_left;
    $cs_sidebar_right = $cs_xmlObject->sidebar_layout->cs_sidebar_right;
    if ($cs_layout == "left") {
        $cs_layout = "content-right col-md-9";
        $custom_height = 348;
    } else if ($cs_layout == "right") {
        $cs_layout = "content-left col-md-9";
        $custom_height = 348;
    } else {
        $cs_layout = "col-md-12";
        $custom_height = 470;
    }
} else {
    $cs_layout = "col-md-12";
}
if (have_posts()):
    while (have_posts()) : the_post();
        $image_id = get_post_thumbnail_id($post->ID);
        $post_xml = get_post_meta($post->ID, "post", true);
        if ($post_xml <> "") {
            $cs_xmlObject = new SimpleXMLElement($post_xml);
            $post_view = $cs_xmlObject->inside_post_thumb_view;
            $post_video = $cs_xmlObject->inside_post_thumb_video;
            $post_audio = $cs_xmlObject->inside_post_thumb_audio;
            $post_slider = $cs_xmlObject->inside_post_thumb_slider;
            $post_featured_image = $cs_xmlObject->inside_post_featured_image_as_thumbnail;
            $width = 984;
            $height = 470;
            $image_url = cs_get_post_img_src($post->ID, $width, $height);
        } else {
            $cs_xmlObject = new stdClass();
            $post_view = '';
            $post_video = '';
            $post_audio = '';
            $post_slider = '';
            $post_slider_type = '';
            $width = 0;
            $height = 0;
            $image_id = 0;
            $cs_xmlObject->post_social_sharing = '';
        }
        ?>
        <!-- Columns Start -->
        <div class="clear"></div>
        <!-- Content Section Start -->
        <div id="main" role="main">
            <!-- Container Start -->
            <div class="container">
                <!-- Row Start -->
                <div class="row">
                    <!-- Need to add code below in function file to call it on all pages -->
                    <!--Left Sidebar Starts-->
        <?php if ($cs_layout == 'content-right col-md-9') { ?>
                        <aside class="sidebar-left col-md-3"><?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_left)) : ?><?php endif; ?></aside>
                    <?php } ?>
                    <!--Left Sidebar End-->
                    <!-- Blog Detail Start -->
                    <div class="<?php echo $cs_layout; ?>">
                        <!-- Blog Start -->
                        <!-- Blog Post Start -->
                        <article>
        <?php if (isset($post_view) and $post_view <> '') {
; ?>
                                <!-- Blog Post Thumbnail Start -->
                                <?php
                                if ($post_view == "Slider" and $post_slider <> '') {
                                    echo '<figure class="detail_figure">';
                                    cs_flex_slider($width, $height, $post_slider);
                                    echo '</figure>';
                                } elseif ($post_view == "Single Image" && $image_url <> '') {
                                    echo '<figure class="detail_figure">';
                                    echo '<a><img src="' . $image_url . '" ></a>
												<span class="cuting_border"></span>';
                                    echo '</figure>';
                                } elseif ($post_view == "Video" and $post_video <> '' and $post_view <> '') {
                                    echo '<figure class="detail_figure">';
                                    $url = parse_url($post_video);
                                    if ($url['host'] == $_SERVER["SERVER_NAME"]) {
                                        ?>
                                        <video width="<?php echo $width; ?>" class="mejs-wmp" height="100%"  style="width: 100%; height: 100%;" src="<?php echo $post_video ?>"  id="player1" poster="<?php if ($post_featured_image == "on") {
                        echo $image_url;
                    } ?>" controls="controls" preload="none"></video>
                                        <?php
                                    } else {
                                        echo wp_oembed_get($post_video, array('height' => $custom_height));
                                    }
                                    echo '</figure>';
                                } elseif ($post_view == "Audio" and $post_view <> '') {
                                    echo '<figure class="detail_figure">';
                                    ?>
                                    <audio style="width:100%;" src="<?php echo $post_audio; ?>" type="audio/mp3" controls="controls"></audio>
                                    <?php
                                    echo '</figure>';
                                }
                                ?>
        <?php } ?>
                            <!-- Blog Post Thumbnail End -->
                            <!-- Post Options Start -->
                            <ul class="post-options">
        <?php cs_featured(); ?>
                                <li>
                                    <i class="icon icon-calendar">&nbsp;</i>
                                    <time datetime="<?php echo date('Y-m-d', strtotime(get_the_date())); ?>"><?php echo get_the_date(); ?></time>
                                </li>
                                <li>
                                    <i class="icon icon-user">&nbsp;</i>
        <?php printf(__('By: %s', 'Mercycorp'), '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author() . '</a>'); ?>
                                </li>
                                <li>
                                    <i class="icon icon-reorder">&nbsp;</i>
                                    <?php
                                    /* translators: used between list items, there is a space after the comma */
                                    $before_cat = " " . __('', 'Mercycorp') . "";
                                    $categories_list = get_the_term_list(get_the_id(), 'category', $before_cat, ', ', '');
                                    if ($categories_list) {
                                        printf(__('%1$s', 'Mercycorp'), $categories_list);
                                    } // End if categories 
                                    ?>
                                </li>
                            </ul>
                            <!-- Post Options End -->
                        </article>
                        <!-- Blog Post End -->
                        <!-- Detail Text Start -->
                        <div class="detail_text rich_editor_text">
                            <?php
                            the_content();
                            wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'Mercycorp') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>'));
                            ?>
                        </div>
                        <!-- Post Text End -->
                        <?php
                        /* translators: used between list items, there is a space after the comma */
                        /*$before_tag = " <div class='tagcloud'>" . __('<h5>Tags:</h5>', 'Mercycorp') . "";
                        $tags_list = get_the_term_list(get_the_id(), 'post_tag', $before_tag, ' ', '</div>');
                        if ($tags_list) {
                            printf(__('%1$s', 'Mercycorp'), $tags_list);
                        }*/ // End if categories 
                        ?> 
                        
                        <!-- Share Post Start -->
                        <div class="share_post">
         
                                <h6>Partilha</h6>
                                <div class="addthis_inline_share_toolbox" style="float: left;"></div>
                                <? cs_next_prev_post($cs_xmlObject->post_social_sharing); ?>
                           
                        </div>        
                        <!-- Post Sharing Section End -->
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
                   
                <?php endwhile;
				 ?></div> <?php
            endif; ?>

            <!--Content Area End-->
            <!--Right Sidebar Starts-->
            <?php if ($cs_layout == 'content-left col-md-9') { ?>
                <aside class="sidebar-right col-md-3"><?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_right)) : ?><?php endif; ?></aside>
            <?php } ?>
            <!-- Columns End -->
            </div>
            </div>
            </div>
            <!--Footer-->
<?php get_footer(); ?>
