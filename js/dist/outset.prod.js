"use strict";function _defineProperty(e,a,t){return a in e?Object.defineProperty(e,a,{value:t,enumerable:!0,configurable:!0,writable:!0}):e[a]=t,e}!function(a){var e;a(".slider ").owlCarousel({items:1,loop:!0,margin:10,nav:!0,navText:["<span class='fa fa-angle-left'><span/>","<span class='fa fa-angle-right'><span/>"],autoplay:!0,animateOut:"fadeOut",animateIn:"fadeIn",autoplayTimeout:6e3,smartSpeed:1500,nav_offset_top:!0,autoplayHoverPause:!0,dots:!1}),a(".image_anim_home_Clothes").owlCarousel((_defineProperty(e={loop:!0,margin:10,autoplay:!0,autoplayTimeout:2e3,autoplayHoverPause:!0,nav:!0,navText:["<span class='fa fa-angle-left'><span/>","<span class='fa fa-angle-right'><span/>"]},"autoplay",!0),_defineProperty(e,"dots",!1),_defineProperty(e,"smartSpeed",1500),_defineProperty(e,"nav_offset_top",!0),_defineProperty(e,"responsive",{0:{items:1},576:{items:2},768:{items:3},992:{items:4}}),e)),a(window).on("load",function(){if(a(".loader").fadeOut(),a("#preloder").delay(200).fadeOut("slow"),a(".featured__controls li").on("click",function(){a(".featured__controls li").removeClass("active"),a(this).addClass("active")}),0<a(".featured__filter").length){var e=document.querySelector(".featured__filter");mixitup(e)}}),a(".icon-card").on("click",function(){a(".popup_small_card").fadeIn()}),a(".popup-close").on("click",function(e){e.preventDefault(),a(".popup_small_card").fadeOut()}),a(".nav-sec ul li").on("click",function(){a(".nav-sec li").removeClass("active"),a(this).addClass("active")}),a(".slick-dot-image  img").on("click",function(){a(".slick-dot-image img").removeClass("selected"),a(this).addClass("selected"),a(".image-detail img").attr("src",a(this).attr("src"))}),a(".image-detail .fa-chevron-left").on("click",function(){a(".slick-dot-image .selected").is(":last-child")?a(".slick-dot-image  img").eq(0).click():a(".slick-dot-image  .selected").next().click()}),a(".image-detail .fa-chevron-right").on("click",function(){a(".slick-dot-image .selected").is(":first-child")?a(".slick-dot-image  img:last").click():a(".slick-dot-image  .selected").prev().click()});var t=0;a(".sml-title_card span").each(function(){t+=parseInt(a(this).text())}),a(".small-total span").text(t)}(jQuery);