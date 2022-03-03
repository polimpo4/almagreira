<? if ( is_front_page() ) { 
    $limit=4;
 } else {
    $limit=-1;
 }

$loop = new WP_Query( array( 'post_type' => 'albums', 'posts_per_page' => $limit ) );

if ( is_front_page() ) { ?>
  <header class="heading">
    <h2 class="section-title heading-color">Galeria Fotográfica</h2>
  </header>
<? } ?>

<div class="gallerysec">
   <ul class="gallery-four-col light-box clearfix">

<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

  <li>
   <a href="<? echo get_permalink(); ?>">
      <figure>
         <img src="<? the_post_thumbnail_url( array(220, 220) );  ?>" alt="">                                    
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


