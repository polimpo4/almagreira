<?php
get_header();
global $cs_theme_option;
$cs_layout = $cs_theme_option['cs_layout'];
       $custom_width = 263;

            $custom_height = 195;

            $width = 263;

            $height = 197;
            $post_xmls = "";
            $image_url = "";
            $flag = "";
?>
<div role="main" id="main">
    <div class="container columns"> 
        <div class="row">
        <div class="col-md-9 ">
            <?php if ($cs_layout <> '' and $cs_layout <> "none" and $cs_layout == 'left' or $cs_layout == 'both') : ?>
                <aside class="left-content col-md-3">
                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_theme_option['cs_sidebar_left'])) : endif; ?>
                </aside>
            <?php endif; ?>	
            <div class="<?php cs_default_pages_meta_content_class($cs_layout); ?>">
                <div class="postlist blog blog-medium">
                    <!-- Blog Post Start -->
                    <?php
                    if (have_posts()) :
                        while (have_posts()) : the_post();

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
                            <article id="post-<?php the_ID(); ?>" <?php post_class($no_image); ?> >
                                
                        <?php //if (cs_hide_figure($image_url) != 'image_url') { ?>
                        <?php if (cs_hide_figure($post_xmls, $image_url) != 'false') {  ?>
                    
                        <!-- Blog Post Thumbnail Start -->

                        <?php
                        if ($post_view == "Slider" and $post_slider <> '') {

                            echo '<figure>';

                            cs_flex_slider($width, $height, $post_slider);

                            echo '</figure>';
                        } elseif ($post_view == "Single Image") {

                            if ($image_url <> '') {
                                echo '<figure><a href="' . get_permalink() . '" ><img src="' . $image_url . '" alt="" ></a></figure>';
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

                                        <li><?php if (comments_open()) {
                                    echo '<i class="icon-comment"></i>';
                                    comments_popup_link(__('0', 'Mercycorp'), __('1', 'Mercycorp'), __('%', 'Mercycorp'));
                                } ?></li>

        <?php edit_post_link(__('Edit', 'Mercycorp'), '<li><span class="edit-link">', '</span></li>'); ?>
                                    </ul> 
                                    <p><?php // echo cs_get_the_excerpt(255, true); ?>
                                        
<a class="cs-readmore colr" href="<?php the_permalink(); ?>">

                            <i class="fa icon-arrow-right"></i>Ler mais...</a>

                                    </p>
                                </div>
                                <!-- Text End -->

                            </article>
                            <?php
                        endwhile;
                    else:
                        ?>
                        <aside class="col-md-6">
                            <div class="widget widget_search">

                                <header class="heading">
                                    <h2 class="section_title heading-color"><?php _e('Lamento, mas não encontra-mos resultados', 'Mercycorp'); ?></h2>
                                </header>

    <?php get_search_form(); ?>

                            </div>
                        </aside>
                    <?php
                    endif;
                    ?>
               	</div>
                <?php
                $qrystr = '';
                // pagination start
                if ($wp_query->found_posts > get_option('posts_per_page')) {

                    echo "<nav class='pagination'><ul>";
                    if (isset($_GET['s']))
                        $qrystr = "&s=" . $_GET['s'];
                    if (isset($_GET['page_id']))
                        $qrystr .= "&page_id=" . $_GET['page_id'];
                    echo cs_pagination($wp_query->found_posts, get_option('posts_per_page'), $qrystr);
                    echo "</ul></nav>";
                }
                // pagination end
                ?>                    
            </div>
            
            </div>
            <div class="col-md-3">
                 
                 <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Event Detail')) : ?><?php endif; ?>
            </div>
<?php get_footer(); ?>
            <!-- Columns End -->