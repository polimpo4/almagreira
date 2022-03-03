<?php

get_header();
$globalID = get_the_ID();
if (have_posts()):
    while (have_posts()) : the_post();
  

        ?>
        <!-- Columns Start -->
        <div class="clear"></div>
        <!-- Content Section Start -->
        <div id="main" role="main">
            <!-- Container Start -->
            <div class="container">
                <!-- Row Start -->
                <div class="row">
            
        
                    <!--Left Sidebar End-->
                    <!-- Blog Detail Start -->
                    <div class="content-left col-md-9">
            
     
                        <article>
                            <figure class="detail_figure">
                                <a><img src="<?php the_post_thumbnail_url('full'); ?>"></a>
                                <span class="cuting_border"></span>
                            </figure>
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
         
                                <!-- <h6>Partilha</h6> -->
                                <div class="addthis_inline_share_toolbox" style="float: left;"></div>
                                <? //cs_next_prev_post($cs_xmlObject->post_social_sharing); ?>
                           
                        </div>        
                        <!-- Post Sharing Section End -->

            
                        <!-- Blog Post End -->
                   
                <?php endwhile;
				 ?></div> <?php
            endif; ?>
              <aside class="sidebar-right col-md-3 turismoBlock">
                <h3>Património Relegioso</h3>
                <ul>
                  <? 
                    $args = array( 'post_type' => 'pratrimoniorelegioso', 'posts_per_page' => -1 );
                    $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : $loop->the_post();
                      ?>
                      <li <? if ($globalID==get_the_ID()) echo "class='active'" ?>>
                        <div class="inner">
                          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        </div>
                      </li>
                      <?
                    endwhile;
                  ?>
                </ul>           
              </aside>

            <!--Content Area End-->
            <!--Right Sidebar Starts-->
         
                         
            <!-- Columns End -->
            </div>
            </div>
            </div>
            <!--Footer-->
<?php get_footer(); ?>
