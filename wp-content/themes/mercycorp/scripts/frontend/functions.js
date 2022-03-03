

// JavaScript Input Placeholder

        jQuery(document).ready(function($) {



            



// scroll animation

jQuery('.topHome').click(function () {

    jQuery('body,html').animate({

    scrollTop: 0

    }, 800);

});



jQuery("a[href^=#]").click(function(event){      

    event.preventDefault();

    jQuery('html,body').animate({scrollTop:(jQuery(this.hash).offset().top)-10}, 500);

});    

    



// Woocomerce Title

jQuery(".cs_shop_wrap h1.page-title").remove();

        jQuery(".cart-sec a span.amount").addClass("cart-bg");

// NiceScroll Javascript

        var seq = 0;

        $(document).ready(function() {



$("#mainlogo img").eq(1).hide();

        function goSeq() {

        var nxt = (seq + 1) % 2;

                $("#mainlogo img").eq(seq).fadeIn(2000);

                $("#mainlogo img").eq(nxt).fadeOut(2000);

                seq = nxt;

                setTimeout(goSeq, 2500);

        };

        goSeq();

        $(window).load(function(){

setTimeout(function(){

$("#gmbox div").animate({'top':60}, 1500, "easeOutElastic");

        }, 1500);

        });

        function trackLink(link, category, action) {

        try {

        _gaq.push(['_trackEvent', 'tracklink', 'click', link.href ]);

                setTimeout('document.location = "' + link.href + '"', 100)

        } catch (err){}

        }



$('[rel="outbound"]').click(function(e){

try {

_gaq.push(['_trackEvent', 'outbound', 'click', this.href]);

        } catch (err){}

});

        });

// NiceScroll Javascript



        jQuery('.share-section').hide();

        jQuery(".share_post .icon-share").click(function(){

jQuery(".share-section").fadeToggle();

        });

        jQuery('html').click(function() {

jQuery(".share-section").fadeOut();

        });

        jQuery('.share_post').click(function(event){

event.stopPropagation();

        });

        jQuery(' textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"]').focus(function() {

if (!jQuery(this).data("DefaultText")) jQuery(this).data("DefaultText", jQuery(this).val());

        if (jQuery(this).val() != "" && jQuery(this).val() == jQuery(this).data("DefaultText")) jQuery(this).val("");

        }).blur(function() {

if (jQuery(this).val() == "") jQuery(this).val(jQuery(this).data("DefaultText"));

        });

});

        function show_map(id) {

        jQuery("div.post-" + id).toggleClass("show-map");

        }

// plus minus Close event script end



jQuery(document).ready(function($) {

jQuery(".search-box").hide();

        jQuery(".search-sec button").click(function(){

jQuery(".search-box").toggle();

        return false

        });

        jQuery("html").click(function(){

jQuery(".search-box").hide();

        jQuery(".search-box").click(function(event){

event.stopPropagation();

        });

        });

        cs_skills_shortcode_script();

// skill short code 



// Tabs script start

        jQuery('#myTab a').click(function (e) {

e.preventDefault()

        jQuery(this).tab('show')

})

// Tabs script End



// plus minus Close event script start

        jQuery("a.open").click(function(){

jQuery(this).toggleClass("active");

});

// plus minus Close script start

        jQuery(".ourteam-carousel article").click(function(event) {

/* Act on the event */

var a = jQuery(this).find("a").attr("href");

        jQuery(a).fadeIn(300);

        return false;

});

        jQuery(".carouselclose").click(function(event) {

/* Act on the event */

jQuery(this).parents(".carousel-active").fadeOut(300);

});

        // plus minus Close script end



        // fade in #back-top

        jQuery(function () {

        // scroll body to 0px on click

        jQuery('#back-top').click(function () {

        jQuery('body,html').animate({

        scrollTop: 0

        }, 800);

                return false;

        });

        });

// fade in #back-top



// fade in #back-top

        jQuery(function () {

        // scroll body to 0px on click

        jQuery('#back-to-top').click(function () {

        jQuery('body,html').animate({

        scrollTop: 0

        }, 800);

                return false;

        });

        });

// fade in #back-top

});

        jQuery(function(){

        //jQuery('#Grid').mixitup();

        jQuery(window).resize(function(event) {

        /* Act on the event */

        });

        });

        /*jQuery(window).load(function(){

         jQuery('.flexslider').flexslider({

         animation: "fade",

         start: function(slider){

         jQuery('body').removeClass('loading');

         }

         });

         });*/



                function cs_masonary_isotope(){

                jQuery(function(){

                var $container = $('#container');

                        $container.isotope({

                        itemSelector : '.box',

                                isFitWidth:true,

                                masonry: { columnWidth: $container.width() / 300 }

                        });

                        jQuery(window).resize(function(){

                $container.isotope({

                // update columnWidth to a percentage of container width

                masonry: { columnWidth: $container.width() / 300 }

                });

                });

                });

                }

        function cs_skills_shortcode_script(){

        jQuery("[data-loadbar]").each(function(index){

        var d = jQuery(this).attr('data-loadbar');

                var e = jQuery(this).attr('data-loadbar-text');

                var ani = jQuery(this).find('div');

                jQuery(ani).animate({width:d + "%"}, 2000).next().html(e);

        });

        }

        function event_map(add, lat, long, zoom, counter){

        var map;

                var myLatLng = new google.maps.LatLng(lat, long)

                //Initialize MAP

                var myOptions = {

                zoom:zoom,

                        center: myLatLng,

                        disableDefaultUI: true,

                        zoomControl: true,

                        mapTypeId: google.maps.MapTypeId.ROADMAP

                };

                map = new google.maps.Map(document.getElementById('map_canvas' + counter), myOptions);

                //End Initialize MAP



                //Set Marker

                var marker = new google.maps.Marker({

                position: map.getCenter(),

                        map: map

                });

                marker.getPosition();

                //End marker



                //Set info window

                var infowindow = new google.maps.InfoWindow({

                content: "" + add,

                        position: myLatLng

                });

                google.maps.event.addListener(marker, 'click', function() {

                infowindow.open(map, marker);

                });

        }

        function sticky_menu(){

        // js

        jQuery("#stickyarea").appendTo("header[class^='header-']");

                var bgc = jQuery(".main-menu").css('backgroundColor');

                jQuery("#stickyarea").css({"background":bgc});

                //jQuery(".logo a") .clone() .appendTo('#logobox-stick');

                jQuery("header[class^='header-'] .navigation").clone().appendTo('#menubox-stick');

                jQuery(window).scroll(function() {

        // Act on the event 

        var h = jQuery("header[class^='header-']").height();

                var ws = jQuery(window).scrollTop();

                if (ws > h){

        jQuery("#stickyarea").slideDown(200);

        } else {

        jQuery("#stickyarea").slideUp(200);

        }

        });

                // js close	

        }





        function show_map(id) {

        jQuery("div.post-" + id).toggleClass("show-map");

        }

// like counter function

        function cs_like_counter(theme_url, post_id){

        jQuery("#like_this" + post_id).hide();

                jQuery("#loading_div" + post_id).show();

                var dataString = 'post_id=' + post_id;

                jQuery.ajax({

                type:"POST",

                        url: theme_url + "/include/like_counter.php",

                        data:dataString,

                        success:function(response){

                        jQuery("#loading_div" + post_id).hide();

                                jQuery("#like_counter" + post_id).show();

                                jQuery("#like_counter" + post_id).html(response);

                                jQuery("#like_counter").html(response);

                        }

                });

                //return false;

        }



// Load  Event map js

        function show_mapp(id, add, lat, long, zoom, home_url, get_template_directory_uri) {



        var a = jQuery("div.post-" + id).find("[id^=map]").length;

                if (a > 1) {

        jQuery("div.post-" + id).toggleClass("open_map");

        } else {

        jQuery("article.post-" + id).find("a.open i").hide();

                jQuery("article.post-" + id).find("a.open").append('<img src="' + get_template_directory_uri + '/images/ajax-loader.gif" />');

                var dataString = 'post_id=' + id + '&add=' + add + '&lat=' + lat + '&long=' + long + '&zoom=' + zoom;

                jQuery.ajax({

                type:"POST",

                        url: get_template_directory_uri + "/include/map_load.php",

                        data:dataString,

                        success:function(response){

                        jQuery("article.post-" + id).find("a.open img").hide();

                                jQuery("article.post-" + id).find("a.open i").show();

                                jQuery("div.post-" + id).toggleClass("open_map");

                                jQuery("div.post-" + id).show();

                                jQuery("#map_canvas" + id).html(response);

                                jQuery(".open" + id).hide();

                        }

                });

        }

        }



// Mailchimp widget 

        function cs_mailchimp_add_scripts () {

        //'use strict';

        (function(a){a.fn.ns_mc_widget = function(b){var e, c, d; e = {url:"/", cookie_id:false, cookie_value:""}; d = jQuery.extend(e, b); c = a(this); c.submit(function(){var f; f = jQuery("<div></div>"); f.css({"background-image":"url(" + d.loader_graphic + ")", "background-position":"center center", "background-repeat":"no-repeat", height:"16px", left:"48%", position:"absolute", top:"40px", width:"16px", "z-index":"100"}); c.css({height:"100%", position:"relative", width:"100%"}); c.children().hide(); c.append(f); a.getJSON(d.url, c.serialize(), function(h, k){var j, g, i; if ("success" === k){if (true === h.success){i = jQuery("<p>" + h.success_message + "</p>"); i.hide(); c.fadeTo(400, 0, function(){c.html(i); i.show(); c.fadeTo(400, 1)}); if (false !== d.cookie_id){j = new Date(); j.setTime(j.getTime() + "3153600000"); document.cookie = d.cookie_id + "=" + d.cookie_value + "; expires=" + j.toGMTString() + ";"}} else{g = jQuery(".error", c); if (0 === g.length){f.remove(); c.children().show(); g = jQuery('<div class="error"></div>'); g.prependTo(c)} else{f.remove(); c.children().show()}g.html(h.error)}}return false}); return false})}}(jQuery));

        }

// end mailchimp widget







        jQuery(document).ready(function(){

			if(typeof prettyPhoto== 'function'){

        jQuery("area[rel^='prettyPhoto']").prettyPhoto();

                jQuery(".lightbox:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal', hook: 'rel', theme:'pp_default', slideshow:3000, social_tools:'', autoplay_slideshow: false});

                jQuery(".lightbox:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast', slideshow:10000, hideflash: true});

                jQuery("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({

        custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',

                changepicturecallback: function(){ initialize(); }

        });

                jQuery("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({

        custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',

                changepicturecallback: function(){ _bsap.exec(); }

        });

			}

        });



jQuery(document).ready(function() {

            //albums

            jQuery('.gallery').each(function() { // the containers for all your Galeria

                jQuery(this).magnificPopup({

                    delegate: 'a', // the selector for gallery item

                    type: 'image',

                    gallery: {

                      enabled:true

                    },

                    image: {

                      tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',

                      titleSrc: function(item) {
                       if (item.el.attr('data-title')){                    
                        return item.el.attr('data-title') + 'aaa<small>'+item.el.attr('data-description')+'</small>';
                       }
                      //return item.el.parents('article').find('h2').html() +   item.el.parents('article').find('figcaption').html();

                    }}





                });

            });





              // magnificPopup

  jQuery('.image-link').magnificPopup({

      type:'image',

  });

                // magnificPopup

  jQuery('.image-visual a').magnificPopup({

      type:'image',

  });





            (function() {

  /* Define a variável que dá swipe no lightbox */

  var magnificPopup = jQuery.magnificPopup.instance;



  /* Carrega a função quando clica no lightbox (senão não pega a classe utilizada) */

  jQuery(".gallery a").click(function(e) {



    /* Espera carregar o lightbox */

    setTimeout(function() {

        /* Swipe para a esquerda - Próximo */

       jQuery(".mfp-container").swipe( {

          swipeLeft:function(event, direction, distance, duration, fingerCount) {

            console.log("swipe right");

            magnificPopup.next();

          },



        /* Swipe para a direita - Anterior */

        swipeRight:function(event, direction, distance, duration, fingerCount) {

          console.log("swipe left");

          magnificPopup.prev();

        },

        });

    }, 500);

  });



}).call(this);



        // Scroll To Fixed



        function cs_menu_sticky(){

        jQuery(".header-section").scrollToFixed();

        }





  });

//Fit Video Fram Funtion



                jQuery(function () {

                if (jQuery("body").length != ''){

                jQuery(document).ready(function($) {

				if(typeof fitVids =='function'){

                jQuery("body").fitVids();

				}

                });

				

                }

                });



                jQuery(".forcenot").attr("href", "http://freguesiaalmagreira.com/noticias");





