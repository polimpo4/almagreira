<?php

/*
  Template Name: Paypal Notification Template
 */
wp_head();
    while (have_posts()) : the_post();
                            the_content();

                        endwhile;

wp_footer();
?>