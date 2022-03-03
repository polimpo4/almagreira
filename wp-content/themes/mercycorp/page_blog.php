<?php
global $cs_node, $post, $cs_theme_option, $cs_counter_node, $cs_meta_page, $cs_video_width;


if (!isset($cs_node->cs_blog_num_post) || empty($cs_node->cs_blog_num_post)) {
    $cs_node->cs_blog_num_post = -1;
}
if (!isset($cs_node->cs_blog_orderby) || empty($cs_node->cs_blog_orderby)) {
    $cs_node->cs_blog_orderby = 'DESC';
}

cs_enqueue_gallery_style_script();
cs_enqueue_video_style_script();
$image_url = '';
?>

<div class="element_size_<?php echo $cs_node->blog_element_size; ?>">

    <div class="<?php cs_blog_classes($cs_node->cs_blog_view); ?>  <?php echo $cs_node->cs_blog_view; ?> <?php
    if ($cs_node->cs_blog_title == '') {
        echo 'no-heading';
    }
    ?> lightbox">

        <?php if ($cs_node->cs_blog_title <> '' || $cs_node->cs_blog_subtitle <> '') { ?>

            <header class="heading">

                <?php if ($cs_node->cs_blog_title <> '') { ?>

                    <h2 class="cs-section-title float-left section-title"><?php echo $cs_node->cs_blog_title; ?></h2>

                <?php } ?>

                <?php if ($cs_node->cs_blog_link_title <> '' && $cs_node->cs_blog_link_url <> '') { ?>

                    <a href="<?php echo $cs_node->cs_blog_link_url; ?>" class="btnshowmore float-right"> <em class="fa fa-th-large"></em>

                        <?php echo $cs_node->cs_blog_link_title; ?>

                    </a>

                <?php } ?>

            </header>

        <?php } ?>

        <!-- Blog Start -->

        <?php
        if (empty($_GET['page_id_all']))
            $_GET['page_id_all'] = 1;

        $args = array('posts_per_page' => "-1", 'paged' => $_GET['page_id_all'], 'post_type' => 'post', 'category_name' => "$cs_node->cs_blog_cat", 'order' => "DESC");

        $custom_query = new WP_Query($args);

        $post_count = $custom_query->post_count;

        $count_post = 0;

        // if ($cs_node->cs_blog_pagination == "Single Page") $cs_node->cs_blog_num_post = $cs_node->cs_blog_num_post;

        $args = array('posts_per_page' => "$cs_node->cs_blog_num_post", 'post_type' => 'post', 'paged' => $_GET['page_id_all'], 'category_name' => "$cs_node->cs_blog_cat", 'order' => "DESC");

        $custom_query = new WP_Query($args);


        $cs_counter = 0;

        $custom_width = 984;

        $custom_height = 470;

        cs_meta_content_class();

        if (cs_meta_content_class() == "col-md-12") {

            if ($cs_node->cs_blog_view == "blog-large") {
                $custom_width = 984;
                $custom_height = 470;
            } elseif ($cs_node->cs_blog_view == "blog-medium") {
                $custom_width = 230;
                $custom_height = 230;
            }
        } elseif (cs_meta_content_class() == "col-md-9") {

            if ($cs_node->cs_blog_view == "blog-large") {
                $custom_width = 730;
                $custom_height = 346;
            } elseif ($cs_node->cs_blog_view == "blog-medium") {
                $custom_width = 370;
                $custom_height = 208;
            }
        } elseif (cs_meta_content_class() == "col-md-6") {

            if ($cs_node->cs_blog_view == "blog-large") {
                $custom_width = 870;
                $custom_height = 300;
            } elseif ($cs_node->cs_blog_view == "blog-medium") {
                $custom_width = 570;
                $custom_height = 321;
            }
        }



        if ($cs_node->cs_blog_view == "blog-grid") {

            $custom_width = 263;

            $custom_height = 195;

            $width = 263;

            $height = 197;
            ?>

            <script>

                jQuery(document).ready(function () {

                    cs_flex_slider_article_function();

                });

            </script>

            <?php
            echo '<div class="latest-news fullwidth">';

            while ($custom_query->have_posts()) : $custom_query->the_post();

                $post_xml = get_post_meta("$post->ID", "post", true);

                if ($post_xml <> "") {
                    $post_xmls = $post_xml;

                    $cs_xmlObject = new SimpleXMLElement("$post_xmls");

                    $post_view = $cs_xmlObject->post_thumb_view;

                    $post_image = $cs_xmlObject->post_thumb_image;

                    $post_featured_image = $cs_xmlObject->post_featured_image_as_thumbnail;

                    $post_video = $cs_xmlObject->post_thumb_video;

                    $post_audio = $cs_xmlObject->post_thumb_audio;

                    $post_slider = $cs_xmlObject->post_thumb_slider;

                    $no_image = '';

                    $image_url = cs_get_post_img_src($post->ID, $width, $height);

                    $image_url_full = cs_get_post_img_src($post->ID, '', '');

                    if ($image_url == "" and $post_view == "Single Image") {

                        $no_image = 'no-image';
                    }
                } else {

                    $post_view = '';

                    $no_image = '';

                    $image_url_full = '';
                }
                ?>

                <article>

                    <?php
                    if (cs_hide_figure($post_xml, $image_url) == 'true') {
                        if ($post_view == "Slider" and $post_slider <> '') {

                            echo '<figure>';

                            cs_flex_slider($width, $height, $post_slider);

                            echo '</figure>';
                        } elseif ($post_view == "Single Image") {

                            if ($image_url <> '') {
                                echo '<figure><a href="' . get_permalink() . '" ><img src="' . $image_url . '" alt="" ></a>

                                    <figcaption><a href="' . get_permalink() . '"><span class="fa-stack fa-lg"> <em class="fa fa-circle fa-stack-2x"></em> <em class="fa fa-chain fa-stack-1x fa-inverse"></em>

                                    </span></a></figcaption>

                                    </figure>';
                            }
                        } elseif ($post_view == "Video") {
                            echo '<figure class="videoWrapper">';

                            $url = parse_url($post_video);

                            if ($url['host'] == $_SERVER["SERVER_NAME"]) {
                                ?>

                                <video class="mejs-wmp"  src="<?php echo $post_video ?>" poster="<?php
                                if ($post_featured_image == "on") {
                                    echo $image_url;
                                }
                                ?>" controls="controls" preload="none"></video>

                                <?php
                            } else {
                                ?>
                                <script type="text/javascript">
                                    jQuery(document).ready(function ($) {
                                        if(typeof cs_iframe_videos =='function'){
                                        cs_iframe_videos();
                                        }
                                    });
                                </script>
                                <?php
                                echo wp_oembed_get($post_video, array());
                            }

                            echo '</figure>';
                        } elseif ($post_view == "Audio" and $post_audio <> '') {

                            echo '<figure>';
                            ?>

                            <audio  style="width:100%; height:30px;" src="<?php echo $post_audio; ?>" type="audio/mp3" controls="controls"></audio>

                            <?php
                            echo '</figure>';
                        }
                    }
                    ?>

                    <div class="text fullwidth">

                        <?php
                        if (cs_hide_figure($post_xml, $image_url) == 'false') {
                            edit_post_link('', '<span class="post-icon"><em class="fa fa-edit"></em>', '</span>');
                        }
                        ?>

                        <time><?php echo date('F d, Y', strtotime(get_the_date())); ?></time>

                        <h2 class="cs-post-title"><a href="<?php the_permalink(); ?>" class="colrhvr"><?php
                                echo substr(get_the_title(), 0, 35);
                                if (strlen(get_the_title()) > 35)
                                    echo '...';
                                ?></a></h2>

                        <?php
                        $cs_datil = $cs_node->cs_blog_description;
                        if ($cs_datil == "yes") {
                            ?>

                            <p><?php cs_get_the_excerpt($cs_node->cs_blog_excerpt, false); ?></p>

                            <?php } ?>

                        <a href="<?php the_permalink(); ?>" class="btnreadmore float-right"><?php
                            if ($cs_theme_option['trans_switcher'] == "on") {
                                _e('Ler mais', 'Mercycorp');
                            } else {
                                echo $cs_theme_option['trans_read_more'];
                            }
                            ?> &gt;&gt;</a>

                    </div>

                </article>

                <?php
            endwhile;

            echo '</div><div class="clear"></div>';
        } else {



            while ($custom_query->have_posts()) : $custom_query->the_post();

                $post_xml = get_post_meta("$post->ID", "post", true);

                if ($post_xml <> "") {

                    $post_xmls = $post_xml;
                    $cs_xmlObject = new SimpleXMLElement("$post_xmls");

                    $post_view = $cs_xmlObject->post_thumb_view;

                    $post_image = $cs_xmlObject->post_thumb_image;

                    $post_featured_image = $cs_xmlObject->post_featured_image_as_thumbnail;

                    $post_video = $cs_xmlObject->post_thumb_video;

                    $post_audio = $cs_xmlObject->post_thumb_audio;

                    $post_slider = $cs_xmlObject->post_thumb_slider;

                    $no_image = '';
                    if ($cs_node->cs_blog_view = 'blog-medium') {
                        $width = 348;
                        $height = 192;
                    } else {
                        $width = 984;
                        $height = 470;
                    }
                    $image_url = cs_get_post_img_src($post->ID, $width, $height);

                    $image_url_full = cs_get_post_img_src($post->ID, '', '');

                    if ($image_url == "" and $post_view == "Single Image") {

                        $no_image = 'no-image';
                    }
                } else {

                    $post_view = '';

                    $no_image = '';

                    $image_url_full = '';
                }
                ?>

                <!-- Blog Post Start -->

                <article <?php post_class($no_image); ?>>

        <?php if (cs_hide_figure($post_xmls, $image_url) == 'true') { ?>

                        <!-- Blog Post Thumbnail Start -->

                        <?php
                        if ($post_view == "Slider" and $post_slider <> '') {

                            echo '<figure>';

                            cs_flex_slider($width, $height, $post_slider);

                            echo '</figure>';
                        } elseif ($post_view == "Single Image") {

                            if ($image_url <> '') {
                                echo '<figure class="singleHover"><a href="' . get_permalink() . '" ><img src="' . $image_url . '" alt="" ><figcaption>
                                        <span class="bghover"></span>
                                        <div class="text">
                                                <i class="icon-eye-open icon-2x"></i>                                            <div class="gal-txt-sec">
                                                        </div>
                                        </div>
                                    </figcaption></a></figure>';
                            }
                        } elseif ($post_view == "Video") {


                            echo '<figure class="videoWrapper">';

                            $url = parse_url($post_video);

                            if ($url['host'] == $_SERVER["SERVER_NAME"]) {
                                ?>

                                <video class="mejs-wmp" src="<?php echo $post_video ?>" poster="<?php
                                if ($post_featured_image == "on") {
                                    echo $image_url;
                                }
                                ?>" controls="controls" preload="none"></video>

                                <?php
                            } else {
                                ?>
                                <script type="text/javascript">
                                    jQuery(document).ready(function ($) {
                                        if(typeof cs_iframe_videos =='function'){
                                        cs_iframe_videos();
                                        }
                                    });
                                </script>
                                <?php
                                echo wp_oembed_get($post_video, array('height' => $custom_height));
                            }

                            echo '</figure>';
                        } elseif ($post_view == "Audio" and $post_audio <> '') {

                            echo '<figure>';
                            ?>

                            <audio  style="width:100%; height:30px;" src="<?php echo $post_audio; ?>" type="audio/mp3" controls="controls"></audio>

                            <?php
                            echo '</figure>';
                        }
                        ?>  

        <?php }
        ?>

                    <!-- Blog Post Thumbnail End -->

                    <div class="blog_text webkit">

                        <div class="text">



                            <h2 class="heading-color post-title"> <a href="<?php the_permalink(); ?>" class="colrhover"><?php
                                    echo get_the_title();
        
                                    ?></a></h2>

                        </div>

        <?php if ($cs_node->cs_blog_view == "blog-large") { ?>

                            <ul class="post-options">



                                <li><?php
                                    if (comments_open()) {
                                        echo '<i class="fa fa-comment"></i>';
                                        comments_popup_link(__('0', 'Mercycorp'), __('1', 'Mercycorp'), __('%', 'Mercycorp'));
                                    }
                                    ?></li>

                                <li><?php cs_like_counter($post->ID); ?></li>



                            </ul>

        <?php } ?>

                        <ul class="post-categories">

        <?php cs_featured(); ?>

                            <li><span><?php echo date('d M, Y', strtotime(get_the_date())); ?></span></li>

                            <li>&nbsp;|&nbsp;</li>

                            <li>

                                <?php
                                /* translators: used between list items, there is a space after the comma */

                                $before_cat = " " . __('', 'Mercycorp') . "";

                                $categories_list = get_the_term_list(get_the_id(), 'category', $before_cat, ', ', '');

                                if ($categories_list) {

                                    printf(__('%1$s', 'Mercycorp'), $categories_list);
                                }
                                ?>

                            </li>

                            <li>&nbsp;|&nbsp;</li>

                            <li><?php printf(__('%s', 'Mercycorp'), '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '" >' . get_the_author() . '</a>'); ?></li>

                        </ul>

                        <?php
                        $cs_datil = $cs_node->cs_blog_description;
                        if ($cs_datil == "yes") {
                            ?>

                            <p><?php cs_get_the_excerpt($cs_node->cs_blog_excerpt, false); ?></p>

            <?php if ($cs_node->cs_blog_view == "blog-medium") { ?>

                                <ul class="post-options">



                                    <li><?php
                                        if (comments_open()) {
                                            echo '<i class="fa fa-comment"></i>';
                                            comments_popup_link(__('0', 'Mercycorp'), __('1', 'Mercycorp'), __('%', 'Mercycorp'));
                                        }
                                        ?></li>

                                    <li><?php cs_like_counter($post->ID); ?></li>
                                </ul>

                                <?php } ?>
                   
                            <a class="cs-readmore colr" href="<?php the_permalink(); ?>">
                       
                            <i class="fa icon-arrow-right"></i><?php
                                if ($cs_theme_option['trans_switcher'] == "on") {
                                    _e('Ler mais', 'Mercycorp');
                                } else {
                                    echo "Ler mais...";
                                }
                                ?></a>

        <?php } ?>

                    </div>

                </article>

                <?php wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'Mercycorp') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>

                <!-- Blog Post End -->

    <?php endwhile; ?>

            <!-- Blog End -->



            <?php
        }

        echo '</div>';

        $qrystr = '';

        if ($cs_node->cs_blog_pagination == "Show Pagination" and $post_count > $cs_node->cs_blog_num_post and $cs_node->cs_blog_num_post > 0) {

            echo "<nav class='pagination'><ul>";

            if (isset($_GET['page_id']))
                $qrystr = "&page_id=" . $_GET['page_id'];

            echo cs_pagination($post_count, $cs_node->cs_blog_num_post, $qrystr);

            echo "</ul></nav>";
        }

        // pagination end
        ?>

    </div>


