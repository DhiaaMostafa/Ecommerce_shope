"use strict";

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

;

(function ($) {
  "use strict"; // in home page animateion image header 

  var _owl$owlCarousel;

  var owl_image = $('.slider ');
  owl_image.owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
    autoplay: true,
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    autoplayTimeout: 6000,
    smartSpeed: 1500,
    nav_offset_top: true,
    autoplayHoverPause: true,
    dots: false,
    responsive: {
      100: {
        items: 1
      }
    }
  }); // in home  animation  image section

  var owl = $('.image_anim_home_Clothes');
  owl.owlCarousel((_owl$owlCarousel = {
    loop: true,
    margin: 10,
    autoplay: true,
    autoplayTimeout: 2000,
    autoplayHoverPause: true,
    nav: true,
    navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"]
  }, _defineProperty(_owl$owlCarousel, "autoplay", true), _defineProperty(_owl$owlCarousel, "dots", false), _defineProperty(_owl$owlCarousel, "smartSpeed", 1500), _defineProperty(_owl$owlCarousel, "nav_offset_top", true), _defineProperty(_owl$owlCarousel, "responsive", {
    0: {
      items: 1
    },
    576: {
      items: 2
    },
    768: {
      items: 3
    },
    992: {
      items: 4
    }
  }), _owl$owlCarousel)); // in prodect pag cheese image without menu

  $(window).on('load', function () {
    $(".loader").fadeOut();
    $("#preloder").delay(200).fadeOut("slow");
    $('.featured__controls li').on('click', function () {
      $('.featured__controls li').removeClass('active');
      $(this).addClass('active');
    });

    if ($('.featured__filter').length > 0) {
      var containerEl = document.querySelector('.featured__filter');
      var mixer = mixitup(containerEl);
    }
  }); //all page the function do display or hide small page card

  $('.icon-card').on('click', function () {
    $('.popup_small_card').fadeIn();
  });
  $('.popup-close').on('click', function (e) {
    e.preventDefault();
    $('.popup_small_card').fadeOut();
  }); // nav active

  $('.nav-sec ul li').on('click', function () {
    $('.nav-sec li').removeClass('active');
    $(this).addClass('active');
  }); //-----------------------------------------------------------
  //--------------------------------------------------------------
  // filter

  $(function ($) {
    $("#slider-range").slider({
      range: true,
      min: 30,
      max: 300,
      values: [75, 300],
      slide: function slide(event, ui) {
        $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
      }
    });
    $("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));
  }); // filter 2

  $(document).ready(function () {
    $("span.fa").click(function () {
      $(this).toggleClass("ss");
    });
    $("#colors").click(function () {
      $(".allcolor").fadeToggle(500);
      $(".allcolor").css("z-index", 1);

      if ($(this).find("span").hasClass("fa-angle-down")) {
        $(this).find("span").removeClass("fa-angle-down");
        $(this).find("span").addClass("fa-angle-up");
      } else {
        $(this).find("span").removeClass("fa-angle-up");
        $(this).find("span").addClass("fa-angle-down");
      }
    });
    $("#typs").click(function () {
      $("#alltypes").fadeToggle(500);

      if ($(this).find("span").hasClass("fa-angle-down")) {
        $(this).find("span").removeClass("fa-angle-down");
        $(this).find("span").addClass("fa-angle-up");
      } else {
        $(this).find("span").removeClass("fa-angle-up");
        $(this).find("span").addClass("fa-angle-down");
      }
    });
    $("#sorts").click(function () {
      $("#allsorts").fadeToggle(500);

      if ($(this).find("span").hasClass("fa-angle-down")) {
        $(this).find("span").removeClass("fa-angle-down");
        $(this).find("span").addClass("fa-angle-up");
      } else {
        $(this).find("span").removeClass("fa-angle-up");
        $(this).find("span").addClass("fa-angle-down");
      }
    });
    $("#sizes").click(function () {
      $("#allsizes").fadeToggle(500);

      if ($(this).find("span").hasClass("fa-angle-down")) {
        $(this).find("span").removeClass("fa-angle-down");
        $(this).find("span").addClass("fa-angle-up");
      } else {
        $(this).find("span").removeClass("fa-angle-up");
        $(this).find("span").addClass("fa-angle-down");
      }
    });
    $("#prices").click(function () {
      $("#allprices").fadeToggle(500);

      if ($(this).find("span").hasClass("fa-angle-down")) {
        $(this).find("span").removeClass("fa-angle-down");
        $(this).find("span").addClass("fa-angle-up");
      } else {
        $(this).find("span").removeClass("fa-angle-up");
        $(this).find("span").addClass("fa-angle-down");
      }
    });
  });
})(jQuery);