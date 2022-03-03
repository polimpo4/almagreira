<?php
get_header();
global $cs_theme_option;
?>
<!-- Columns Start - fullwidth -->
<!-- Page Contents Start -->
<div class="col-md-12">
    <div class="pagenone">
        <i class="icon-warning-sign icon-4 colr"></i>
        <h1 class="colr"><?php _e('Página não encontrada', 'Mercycorp') ?></h1>
        <h4><?php
            if ($cs_theme_option['trans_switcher'] == "on") {
                echo _e('It seems we can not find what you are looking for.', 'Mercycorp');
            } else {
                echo $cs_theme_option['trans_content_404'];
            }
            ?></h4>
        <!-- Password Protected Strat -->
        <div class="password_protected">   
            <form id="searchform" method="get" action="<?php echo home_url() ?>"  role="search">
                <input name="s" id="searchinput" value="<?php _e('Pesquisar por:', 'Mercycorp'); ?>"
                       onFocus="if (this.value == '<?php _e('Pesquisar por:', 'Mercycorp'); ?>') {
                                   this.value = '';
                               }"
                       onblur="if (this.value == '') {
                                   this.value = '<?php _e('Pesquisar por:', 'Mercycorp'); ?>';
                               }" type="text" />
                <input type="submit" id="searchsubmit" class="backcolr" value="<?php _e('Pesquisar', 'Mercycorp'); ?>" />
            </form>            

        </div>
        <!-- Password Protected End -->
    </div>
</div>
<!-- Page Contents End -->
<?php get_footer(); ?>