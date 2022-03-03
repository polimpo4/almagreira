<?php

global $cs_theme_option;

if ($cs_theme_option['show_partners'] == "all") {

    echo cs_show_partner();

} elseif ($cs_theme_option['show_partners'] == "home") {

    if (is_home() || is_front_page()) {

        echo cs_show_partner();

    }

}

?>      

</div>

<!-- Row End -->

</div>

<div class="clear"></div>

<!-- Container End -->

</div>

<!-- Content Section End -->

<div class="clear"></div>

<!-- Footer Widgets Start -->

<?php if( is_active_sidebar('footer-widget') ) { ?>

<div id="footer-widgets">

    <!-- Container Start -->

    <div class="container">

        <!-- Footer Widgets Start -->

        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget')) : ?><?php endif; ?>

        <!-- Footer Widgets End -->

    </div>

    <!-- Container End -->

</div>

<?php } ?>

<!-- Footer Start -->

<!-- CopyRight Start -->

<div class="copyright">

    <!-- Container Start -->

    <div class="container">

        <p>© <?php echo date("Y"); ?> Freguesia de Almagreira. Todos os direitos reservados. Desenvolvido por <a href="https://www.sisdias.com" target="_blank">SISDIAS</a>
    </p>

        <a class="topHome"><i class="icon-chevron-up icon-2x"></i></a>

    </div>

    <!-- Container End -->

</div>

<!-- CopyRight End --> 

<div class="clear"></div>

</div>

<!-- Go to www.addthis.com/dashboard to customize your tools --> 

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-586a795bfe432110"></script> 

<div id="fb-root"></div>

<script>(function(d, s, id) {

  var js, fjs = d.getElementsByTagName(s)[0];

  if (d.getElementById(id)) return;

  js = d.createElement(s); js.id = id;

  js.src = "//connect.facebook.net/pt_PT/sdk.js#xfbml=1&version=v2.8";

  fjs.parentNode.insertBefore(js, fjs);

}(document, 'script', 'facebook-jssdk'));</script>



<!-- Google Analytics -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-90409293-10"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-90409293-10');
</script>



 

<!-- Wrapper End -->

<?php

cs_footer_settings();

wp_footer();

?>

</body>

</html>