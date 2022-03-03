
<?php $loop = new WP_Query( array( 'post_type' => 'albums', 'posts_per_page' => -1 ) ); ?>
<div class="gallerysec">
   <ul class="gallery-four-col gallery light-box clearfix">

<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

  <li>
     <a href="">
        <figure>
           <img src="<? the_post_thumbnail_url('medium');  ?>" alt="">                                    
           <figcaption>
              <span class="bghover"></span>
              <div class="text">
                 <i class="icon-folder-open icon-2x"></i>                                            
                 <div class="gal-txt-sec">
                    <p></p>
                 </div>
              </div>
           </figcaption>
        </figure> 
      <span class="GTittle"><?php the_title(); ?></span>
     </a>
     
  </li>






<?php endwhile; wp_reset_query(); ?>

   </ul>
</div>






<?


die ();
global $cs_node, $cs_counter_node;
$count_post = 0;
cs_enqueue_gallery_style_script();
$gal_album_db = $cs_node->album;
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
$cs_meta_gallery_options = get_post_meta("$gal_album_db", "cs_meta_gallery_options", true);
if (empty($_GET['page_id_all']))
    $_GET['page_id_all'] = 1;
// pagination start
if ($cs_meta_gallery_options <> "") {
    $cs_xmlObject = new SimpleXMLElement($cs_meta_gallery_options);
    if ($cs_node->media_per_page > 0) {
        $limit_start = $cs_node->media_per_page * ($_GET['page_id_all'] - 1);
        $limit_end = $limit_start + $cs_node->media_per_page;
        $count_post = count($cs_xmlObject);
        if ($limit_end > count($cs_xmlObject))
            $limit_end = count($cs_xmlObject);
    }
    else {
        $limit_start = 0;
        $limit_end = count($cs_xmlObject);
        $count_post = count($cs_xmlObject);
    }
}
?>
AaaaaaaaaaaaaaAaaaaaaaaaaaaaAaaaaaaaaaaaaaAaaaaaaaaaaaaaAaaaaaaaaaaaaaAaaaaaaaaaaaaaAaaaaaaaaaaaaa
<div class="element_size_<?php echo $cs_node->gallery_element_size; ?>">
<?php if ($cs_node->header_title <> '') { ?>
        <header class="heading">
            <h2 class="section-title heading-color"><?php echo $cs_node->header_title; ?></h2>
        </header>
    <?php } ?>
    <?php
    if ($cs_node->layout == 'gallery-masonry') {
        cs_enqueue_masonry_style_script();
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                var container = jQuery('#container<?php echo $cs_counter_node; ?>, .blog #container<?php echo $cs_counter_node; ?>');
                jQuery(container).imagesLoaded(function () {
                    jQuery(container).isotope({
                        columnWidth: 10,
                        itemSelector: '.box'
                    });
                });
                if (jQuery.browser.msie && navigator.userAgent.indexOf('Trident') !== -1) {
                    jQuery(container).isotope({
                        columnWidth: 10,
                        itemSelector: '.box'
                    });
                }
            });
            
/*jQuery(document).ready(function(){
                jQuery("area[rel^='prettyPhoto']").prettyPhoto();
                
                jQuery(".galleryies:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal', hook: 'rel', theme:'pp_default',slideshow:3000,social_tools:'',autoplay_slideshow: false});
                jQuery(".galleryies:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
        
                jQuery("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
                    custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
                    changepicturecallback: function(){ initialize(); }
                });

                jQuery("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
                    custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
                    changepicturecallback: function(){ _bsap.exec(); }
                });
            }); */
            
            
        </script>

        <div class="gallerysec gallery" id="container<?php echo $cs_counter_node; ?>">
            <ul class="<?php echo $cs_node->layout; ?> light-box galleryies clearfix">
                <?php
                if ($cs_meta_gallery_options <> "") {
                    for ($i = $limit_start; $i < $limit_end; $i++) {
                        $path = $cs_xmlObject->gallery[$i]->path;
                        $title = $cs_xmlObject->gallery[$i]->title;
                        $description = $cs_xmlObject->gallery[$i]->description;
                        $social_network = $cs_xmlObject->gallery[$i]->social_network;
                        $use_image_as = $cs_xmlObject->gallery[$i]->use_image_as;
                        $video_code = $cs_xmlObject->gallery[$i]->video_code;
                        $link_url = $cs_xmlObject->gallery[$i]->link_url;
                        $image_url_full = cs_attachment_image_src($path, 0, 0);
                        ?>
                        <li class="box photo">
                            <!-- Gallery Listing Item Start -->
                            <div class="ms-box">
                                <a data-description="<? echo $description ?>" data-title="<?php   echo $title; 
             ?>"  href="<?php if ($use_image_as == 1) echo $video_code;
                            elseif ($use_image_as == 2) echo $link_url;
                            else echo $image_url_full; ?>" target="<?php if ($use_image_as == 2) echo '_blank'; ?>">
                                    <figure>
                                                <?php echo "<img src='" . $image_url_full . "' data-alt='" . $title . "' alt='' />"; ?>
                                        <figcaption>
                                            <span class="bghover"></span>
                                            <div class="text">
                                                <?php
                                                if ($use_image_as == 1) {
                                                    echo '<i class="icon-play-sign icon-2x"></i>';
                                                } elseif ($use_image_as == 2) {
                                                    echo '<i class="icon-link icon-2x"></i>';
                                                } else {
                                                    echo '<i class="icon-picture icon-2x"></i>';
                                                }
                                                ?>
                                                <div class="gal-txt-sec">
                                                    <?php
                                                    if ($title <> '') {
                                                        ?>
                                                        <h2 class="post-title"><?php echo $title; ?></h2>
                                                        <?php
                                                    }
                                                    if ($cs_node->desc == "On") {
                                                        ?>
                                                        <p><?php echo substr($description, 0, 75);
                                                        if (strlen($description) > 75) echo " ..."; ?></p>
                <?php
            }
            ?>
                                                </div>
                                            </div>
                                        </figcaption>

                                    </figure>
                                </a>

                            </div>
                        </li>
                <?php
            }
        }
        ?>
            </ul>
        </div>
                <?php
            }else {
                ?>
        <div class="gallerysec">
            <ul class="<?php echo $cs_node->layout; ?> gallery light-box clearfix">
                <?php
                if ($cs_meta_gallery_options <> "") {
                    for ($i = $limit_start; $i < $limit_end; $i++) {
                        $path = $cs_xmlObject->gallery[$i]->path;
                        $title = $cs_xmlObject->gallery[$i]->title;
                        $description = $cs_xmlObject->gallery[$i]->description;
                        $social_network = $cs_xmlObject->gallery[$i]->social_network;
                        $use_image_as = $cs_xmlObject->gallery[$i]->use_image_as;
                        $video_code = $cs_xmlObject->gallery[$i]->video_code;
                        $link_url = $cs_xmlObject->gallery[$i]->link_url;
                        $image_url = cs_attachment_image_src($path, 585, 440);
                        $image_url_full = cs_attachment_image_src($path, 0, 0);
                        ?>
                        <li>
                            <a data-description="<? echo $description ?>" data-title="<?php   echo $title;                   
                            ?>"  href="<?php if ($use_image_as == 1) echo $video_code;
                                elseif ($use_image_as == 2) echo $link_url;
                                else echo $image_url_full; ?>" target="<?php if ($use_image_as == 2) echo '_blank'; ?>">                            
                                <figure>
                                            <?php echo "<img src='" . $image_url . "' alt='$title' />"; ?>
                                    <figcaption>
                                        <span class="bghover"></span>
                                        <div class="text">
                                                <?php
                                                if ($use_image_as == 1) {
                                                    echo '<i class="icon-play-sign icon-2x"></i>';
                                                } elseif ($use_image_as == 2) {
                                                    echo '<i class="icon-link icon-2x"></i>';
                                                } else {
                                                    echo '<i class="icon-picture icon-2x"></i>';
                                                }
                                                ?>
                                            <div class="gal-txt-sec">
            <?php
            if ($title <> '') {
                ?>
                                                    <h2 class="post-title"><?php echo $title; ?></h2>
                <?php
            }
            if ($cs_node->desc == "On") {
                ?>
                                                    <p><?php echo substr($description, 0, 75);
                if (strlen($description) > 75) echo " ..."; ?></p>
                            <?php
                        }
                        ?>
                                            </div>
                                        </div>
                                    </figcaption>

                                </figure>
                            </a>
                        </li>
                <?php
            }
        }
        ?>
            </ul>
        </div>
    <?php } ?>

<?php
// pagination start
$qrystr = '';
if ($cs_node->pagination == "Show Pagination" and $count_post > $cs_node->media_per_page and $cs_node->media_per_page > 0) {
    echo "<nav class='pagination'><ul>";
    $qrystr = '';
    if (isset($_GET['page_id']))
        $qrystr = "&page_id=" . $_GET['page_id'];
    echo cs_pagination($count_post, $cs_node->media_per_page, $qrystr);
    echo "</ul></nav>";
}
// pagination end
?>
</div>
<div class="clear"></div>