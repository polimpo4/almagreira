<?php /* Template Name: Atividades */ ?>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

get_header();
?>

<div id="main" role="main">
  <!-- Container Start -->
  <div class="container">
    <!-- Row Start -->
    <div class="row"> 
      <?
        $args = array( 'category' => 32, 'post_type' =>  'post' ); 
        $postslist = get_posts( $args );    
        foreach ($postslist as $post) :  setup_postdata($post); 
      ?> 
      <div class="acti"> 
        <time class="article-date"><?php echo get_the_date(); ?></time>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2> 
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?
get_footer(); 

?> 

