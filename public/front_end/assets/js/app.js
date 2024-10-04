(function (_0xb928x1) {
    ("use strict");
    var _0xb928x2 = _0xb928x1("body");
    var _0xb928x3 = _0xb928x1(window);
    function _0xb928x4(_0xb928x5) {
      _0xb928x5.slick({arrows: _0xb928x5.data("nav") ? true : false, dots: _0xb928x5.data("dots") ? true : false, draggable: _0xb928x5.data("draggable") ? false : true, infinite: _0xb928x5.data("infinite") ? false : true, autoplay: _0xb928x5.data("autoplay") ? true : false, prevArrow: '<i class="slick-arrow fa fa-angle-left"></i>', slidesToScroll: _0xb928x5.data("slidestoscroll") ? _0xb928x5.data("columns") : 1, nextArrow: '<i class="slick-arrow fa fa-angle-right"></i>', slidesToShow: _0xb928x5.data("columns"), asNavFor: _0xb928x5.data("asnavfor") ? _0xb928x5.data("asnavfor") : false, vertical: _0xb928x5.data("vertical") ? true : false, verticalSwiping: _0xb928x5.data("verticalswiping") ? _0xb928x5.data("verticalswiping") : false, rtl: _0xb928x2.hasClass("rtl") && !_0xb928x5.data("vertical") ? true : false, centerMode: _0xb928x5.data("centermode") ? _0xb928x5.data("centermode") : false, centerPadding: _0xb928x5.data("centerpadding") ? _0xb928x5.data("centerpadding") : false, focusOnSelect: _0xb928x5.data("focusonselect") ? _0xb928x5.data("focusonselect") : false, fade: _0xb928x5.data("fade") && !_0xb928x2.hasClass("rtl") ? true : false, cssEase: "linear", autoplaySpeed: 5e3, pauseOnHover: false, pauseOnFocus: false, responsive: [{breakpoint: 1441, settings: {slidesToShow: _0xb928x5.data("columns1440") ? _0xb928x5.data("columns1440") : _0xb928x5.data("columns"), slidesToScroll: _0xb928x5.data("columns1440") ? _0xb928x5.data("columns1440") : _0xb928x5.data("columns")}}, {breakpoint: 1200, settings: {slidesToShow: _0xb928x5.data("columns1"), slidesToScroll: _0xb928x5.data("columns1")}}, {breakpoint: 1024, settings: {slidesToShow: _0xb928x5.data("columns2"), slidesToScroll: _0xb928x5.data("columns2")}}, {breakpoint: 768, settings: {slidesToShow: _0xb928x5.data("columns3"), slidesToScroll: _0xb928x5.data("columns3"), vertical: false, verticalSwiping: false}}, {breakpoint: 480, settings: {slidesToShow: _0xb928x5.data("columns4"), slidesToScroll: _0xb928x5.data("columns4"), vertical: false, verticalSwiping: false}}]});
      _0xb928xd(_0xb928x5);
      var _0xb928x6 = _0xb928x1(".shop-details");
      if (_0xb928x6.length > 0 && _0xb928x6.hasClass("zoom")) {
        var _0xb928x7 = _0xb928x6.data();
        var _0xb928x8 = _0xb928x1(".img-item.slick-current", ".shop-details .image-additional");
        if (_0xb928x1(window).width() >= 768) {
          _0xb928x1a(_0xb928x1("img", _0xb928x8), _0xb928x7);
        }
      }
      ;
      _0xb928x5.on("afterChange", function (_0xb928x9, _0xb928xa, _0xb928xb, _0xb928xc) {
        if (_0xb928x6.length > 0 && _0xb928x6.hasClass("zoom")) {
          _0xb928x1(".zoomContainer").remove();
          var _0xb928x7 = _0xb928x6.data();
          var _0xb928x8 = _0xb928x1(".img-item.slick-current", ".shop-details .image-additional");
          if (_0xb928x1(window).width() >= 768) {
            _0xb928x1a(_0xb928x1("img", _0xb928x8), _0xb928x7);
          }
        }
      });
    }
    function _0xb928xd(_0xb928x5) {
      if (_0xb928x1(".slick-arrow", _0xb928x5).length > 0) {
        if (_0xb928x1(".fa-angle-left", _0xb928x5).length > 0) {
          var _0xb928xe = _0xb928x1(".fa-angle-left", _0xb928x5).clone();
          _0xb928x1(".fa-angle-left", _0xb928x5).remove();
          if (_0xb928x5.parent().find(".fa-angle-left").length == 0) {
            _0xb928xe.prependTo(_0xb928x5.parent());
          }
          ;
          _0xb928xe.click(function () {
            _0xb928x5.slick("slickPrev");
          });
        }
        ;
        if (_0xb928x1(".fa-angle-right", _0xb928x5).length > 0) {
          var _0xb928xf = _0xb928x1(".fa-angle-right", _0xb928x5).clone();
          _0xb928x1(".fa-angle-right", _0xb928x5).remove();
          if (_0xb928x5.parent().find(".fa-angle-right").length == 0) {
            _0xb928xf.appendTo(_0xb928x5.parent());
          }
          ;
          _0xb928xf.click(function () {
            _0xb928x5.slick("slickNext");
          });
        }
      } else {
        _0xb928x1(".fa-angle-left", _0xb928x5.parent()).remove();
        _0xb928x1(".fa-angle-right", _0xb928x5.parent()).remove();
      }
    }
    function _0xb928x10() {
      _0xb928x1("#show-megamenu").on("click", function () {
        if (_0xb928x1(".site-mobile-navigation").hasClass("active")) {
          _0xb928x1(".site-mobile-navigation").removeClass("active");
        } else {
          _0xb928x1(".site-mobile-navigation").addClass("active");
        }
        ;
        return false;
      });
      _0xb928x1("#show-verticalmenu").on("click", function () {
        if (_0xb928x1(".site-mobile-vertical").hasClass("active")) {
          _0xb928x1(".site-mobile-vertical").removeClass("active");
        } else {
          _0xb928x1(".site-mobile-vertical").addClass("active");
        }
        ;
        return false;
      });
    }
    _0xb928x10();
    function _0xb928x11() {
      var _0xb928x12 = _0xb928x3.width();
      var _0xb928x13 = _0xb928x1(".menu", "#main-navigation");
      if (_0xb928x12 <= 991) {
        if (_0xb928x1("#mobile-main-menu").length < 1 && _0xb928x13.length > 0) {
          var _0xb928x14 = _0xb928x13.parent().clone();
          _0xb928x14.attr("id", "mobile-main-menu");
          _0xb928x1(_0xb928x14).find(".menu").removeAttr("id");
          _0xb928x1("#page").append('<div class="site-mobile-navigation"><span id="remove-megamenu" class="remove-megamenu icon-remove">Close</span></div>');
          _0xb928x1(".site-mobile-navigation").append(_0xb928x14);
          _0xb928x14.mmenu({offCanvas: false, navbar: {title: false}});
          _0xb928x16();
        }
        ;
        if (_0xb928x1("#mobile-vertical-menu").length < 1) {
          var _0xb928x15 = _0xb928x1(".bwp-vertical-navigation > div").clone();
          _0xb928x15.attr("id", "mobile-vertical-menu");
          _0xb928x1(_0xb928x15).find(".menu").removeAttr("id");
          _0xb928x1("#page").append('<div  class="site-mobile-vertical"><span id="remove-verticalmenu" class="remove-verticalmenu icon-remove">' + _0xb928x1(".bwp-navigation").data("text_close") + "</span></div>");
          _0xb928x1(".site-mobile-vertical").append(_0xb928x15);
          _0xb928x15.mmenu({offCanvas: false, navbar: {title: false}});
          _0xb928x16();
        }
      } else {
        _0xb928x1(".site-mobile-navigation").remove();
        _0xb928x1(".site-mobile-vertical").remove();
      }
    }
    _0xb928x11();
    function _0xb928x16() {
      _0xb928x1("#remove-megamenu").on("click", function () {
        _0xb928x1(".site-mobile-navigation").removeClass("active");
        return false;
      });
      _0xb928x1("#remove-verticalmenu").on("click", function () {
        _0xb928x1(".site-mobile-vertical").removeClass("active");
        return false;
      });
    }
    function _0xb928x17() {
      if (_0xb928x1(".shop-details").length) {
        var _0xb928x5 = _0xb928x1(".shop-details");
        var _0xb928x7 = _0xb928x5.data();
        if (_0xb928x5.hasClass("zoom")) {
          if (_0xb928x7.product_layout_thumb == "one_column" || _0xb928x7.product_layout_thumb == "grid") {
            _0xb928x18(_0xb928x7);
          }
        }
      }
    }
    function _0xb928x18(_0xb928x7) {
      var _0xb928x5 = _0xb928x1(".image-additional");
      if (_0xb928x1(window).width() >= 768) {
        _0xb928x1(".img-item", _0xb928x5).each(function () {
          var _0xb928x19 = _0xb928x1("a", _0xb928x1(this));
          _0xb928x1a(_0xb928x1("img", _0xb928x19), _0xb928x7);
        });
      }
    }
    function _0xb928x1a(_0xb928x5, _0xb928x7) {
      if (_0xb928x1(".image-thumbnail").length > 0) {
        var _0xb928x1b = "image-thumbnail";
      } else {
        var _0xb928x1b = false;
      }
      ;
      _0xb928x5.elevateZoom({zoomType: _0xb928x7.zoomtype, scrollZoom: _0xb928x7.zoom_scroll, lensSize: _0xb928x7.lenssize, lensShape: _0xb928x7.lensshape, containLensZoom: _0xb928x7.zoom_contain_lens, gallery: _0xb928x1b, cursor: "crosshair", galleryActiveClass: "active", lensBorder: _0xb928x7.lensborder, borderSize: _0xb928x7.bordersize, borderColour: _0xb928x7.bordercolour});
    }
    _0xb928x1(document).ready(function () {
      setTimeout(function () {
        _0xb928x1(".page-preloader").fadeOut();
      }, 1500);
      _0xb928x1(".slick-sliders").each(function () {
        _0xb928x4(_0xb928x1(this));
      });
      _0xb928x1('a[data-toggle="tab"]').on("shown.bs.tab", function (_0xb928x1c) {
        _0xb928x1(this).closest(".block").find(".slick-sliders").slick("refresh");
      });
      _0xb928x1(".shop-details .slick-carousel").each(function () {
        _0xb928x4(_0xb928x1(this));
      });
      _0xb928x17();
      _0xb928x3.scroll(function () {
        if (_0xb928x1(this).scrollTop() > 100) {
          _0xb928x1(".back-top").addClass("button-show");
        } else {
          _0xb928x1(".back-top").removeClass("button-show");
        }
      });
      _0xb928x1(".back-top").on("click", function () {
        _0xb928x1("html, body").animate({scrollTop: 0}, 800);
        return false;
      });
      _0xb928x1(".scroll-button").click(function (_0xb928x1c) {
        _0xb928x1c.preventDefault();
        var _0xb928x1d = _0xb928x1(this).attr("href");
        _0xb928x1("html,body").animate({scrollTop: _0xb928x1(_0xb928x1d).offset().top}, 800);
        return false;
      });
      _0xb928x1(".active-login").on("click", function (_0xb928x1c) {
        _0xb928x1c.preventDefault();
        if (_0xb928x1(".form-login-register").hasClass("active")) {
          _0xb928x1(".form-login-register").removeClass("active");
        } else {
          _0xb928x1(".form-login-register").addClass("active");
        }
      });
      _0xb928x1(".remove-form-login-register").on("click", function () {
        if (_0xb928x1(".form-login-register").hasClass("active")) {
          _0xb928x1(".form-login-register").removeClass("active");
        }
      });
      _0xb928x1(".button-next-reregister").on("click", function () {
        if (_0xb928x1(".form-login").hasClass("active")) {
          _0xb928x1(".form-login").removeClass("active");
          _0xb928x1(".form-register").addClass("active");
        }
      });
      _0xb928x1(".button-next-login").on("click", function () {
        if (_0xb928x1(".form-register").hasClass("active")) {
          _0xb928x1(".form-register").removeClass("active");
          _0xb928x1(".form-login").addClass("active");
        }
      });
      _0xb928x1(".search-toggle").on("click.break", function (_0xb928x9) {
        _0xb928x1(".page-wrapper").toggleClass("opacity-style");
        var _0xb928x1e = _0xb928x1(".search-overlay");
        _0xb928x1e.toggleClass("search-visible");
      });
      _0xb928x1(".close-search", ".search-overlay").on("click.break", function (_0xb928x9) {
        _0xb928x1(".page-wrapper").toggleClass("opacity-style");
        var _0xb928x1e = _0xb928x1(".search-overlay");
        _0xb928x1e.toggleClass("search-visible");
      });
      _0xb928x1(".search-close").on("click.break", function (_0xb928x9) {
        _0xb928x1(".page-wrapper").toggleClass("opacity-style");
        var _0xb928x1e = _0xb928x1(".search-overlay");
        _0xb928x1e.toggleClass("search-visible");
      });
      _0xb928x1(".ajax-search .input-search").on("keydown", function () {
        setTimeout(function (_0xb928x1f) {
          var _0xb928x20 = _0xb928x1f.val();
          if (_0xb928x20.length >= 2) {
            _0xb928x1(".ajax-search .result-search-products-content").show();
            _0xb928x1(".ajax-search .result-search-products .items-search").hide();
            _0xb928x1(".ajax-search .result-search-products").addClass("loading");
            _0xb928x1(".ajax-search .result-search-products").show();
            setTimeout(function () {
              _0xb928x1(".ajax-search .result-search-products").removeClass("loading");
              _0xb928x1(".ajax-search .result-search-products .items-search").show();
            }, 1e3);
          } else {
            _0xb928x1(".ajax-search .result-search-products-content").hide();
          }
        }, 200, _0xb928x1(this));
      });
      _0xb928x1(".cart-empty-wrap").hide();
      _0xb928x1(".cart-list-wrap").show();
      _0xb928x1(".cart-remove").on("click", function () {
        if (_0xb928x1(".mojuri-topcart.popup").hasClass("active")) {
          _0xb928x1(".mojuri-topcart.popup").removeClass("active");
        }
        ;
        if (_0xb928x2.hasClass("not-scroll")) {
          _0xb928x2.removeClass("not-scroll");
        }
      });
      _0xb928x1(".cart-icon").on("click", function () {
        if (!_0xb928x2.hasClass("not-scroll") && _0xb928x1(".mojuri-topcart").hasClass("popup")) {
          _0xb928x2.addClass("not-scroll");
        }
      });
      _0xb928x1(".remove-cart-shadow").on("click", function () {
        if (_0xb928x1(".mojuri-topcart.popup").hasClass("active")) {
          _0xb928x1(".mojuri-topcart.popup").removeClass("active");
        }
        ;
        if (_0xb928x2.hasClass("not-scroll")) {
          _0xb928x2.removeClass("not-scroll");
        }
      });
      _0xb928x1(".mini-cart-item a.remove").on("click", function (_0xb928x1c) {
        _0xb928x1c.preventDefault();
        var _0xb928x21 = _0xb928x1(this).closest(".mini-cart");
        _0xb928x1(this).closest("li").remove();
        _0xb928x21.find(".cart-count").text(_0xb928x21.find(".cart-list-wrap .cart-list li").length);
        if (!_0xb928x21.find(".cart-list-wrap .cart-list li").length) {
          _0xb928x21.find(".cart-empty-wrap").show();
          _0xb928x21.find(".cart-list-wrap").hide();
        }
      });
      _0xb928x1(".dropdown-menu.cart-popup").on("click.bs.dropdown", function (_0xb928x1c) {
        _0xb928x1c.stopPropagation();
      });
      _0xb928x1(".btn-add-to-cart a").on("click", function (_0xb928x1c) {
        _0xb928x1c.preventDefault();
        var _0xb928x22 = _0xb928x1(this);
        _0xb928x22.addClass("loading");
        setTimeout(function () {
          _0xb928x22.removeClass("loading");
          _0xb928x22.addClass("added");
          _0xb928x22.closest("div").append('<a href="shop-cart.html" class="added-to-cart product-btn" title="View cart" tabindex="0">View cart</a>');
          _0xb928x1("body").append('<div class="cart-product-added"><div class="added-message">Product was added to cart successfully!</div>');
          setTimeout(function () {
            _0xb928x1(".cart-product-added").remove();
          }, 2e3);
        }, 1e3);
      });
      _0xb928x1(".btn-wishlist .product-btn").on("click", function (_0xb928x1c) {
        _0xb928x1c.preventDefault();
        var _0xb928x23 = _0xb928x1(this);
        if (_0xb928x23.hasClass("added")) {
          _0xb928x1(".wishlist-popup").addClass("show");
        } else {
          _0xb928x23.addClass("adding");
          _0xb928x23.html("Add to wishlist...");
          setTimeout(function () {
            _0xb928x23.removeClass("adding");
            _0xb928x23.addClass("added");
            _0xb928x23.html("Browse wishlist");
            _0xb928x1(".wishlist-popup").addClass("show");
            setTimeout(function () {
              _0xb928x1(".wishlist-notice").removeClass("wishlist-notice-show");
            }, 1e3);
          }, 1e3);
        }
      });
      _0xb928x1(".wishlist-popup .wishlist-popup-close").on("click", function (_0xb928x1c) {
        _0xb928x1c.preventDefault();
        _0xb928x1(".wishlist-popup").removeClass("show");
      });
      _0xb928x1(document).on("click touch", ".wishlist-popup", function (_0xb928x1c) {
        var _0xb928x24 = _0xb928x1(".wishlist-popup-content");
        if (_0xb928x1(_0xb928x1c.target).closest(_0xb928x24).length == 0) {
          _0xb928x1(".wishlist-popup").removeClass("show");
        }
      });
      _0xb928x1(".wishlist-popup .wishlist-continue").on("click", function (_0xb928x1c) {
        _0xb928x1(".wishlist-popup").removeClass("show");
      });
      _0xb928x1(".wishlist-item-remove span").on("click", function (_0xb928x1c) {
        _0xb928x1(this).addClass("removing");
        _0xb928x1(".wishlist-notice").text("Removed from wishlist!");
        _0xb928x1(".wishlist-notice").addClass("wishlist-notice-show");
        var _0xb928x25 = _0xb928x1(this).closest(".wishlist-items");
        var _0xb928x26 = _0xb928x1(this).closest(".wishlist-item");
        setTimeout(function () {
          _0xb928x1(".wishlist-notice").removeClass("wishlist-notice-show");
          _0xb928x26.remove();
          _0xb928x1(".wishlist-count").text(_0xb928x25.find("tbody tr").length);
          if (!_0xb928x25.find("tbody tr").length) {
            _0xb928x25.before('<div class="wishlist-empty">There are no products on the wishlist!</div>');
          }
        }, 1e3);
      });
      _0xb928x1(".btn-compare .product-btn").on("click", function (_0xb928x1c) {
        var _0xb928x27 = _0xb928x1(this);
        _0xb928x27.addClass("adding");
        setTimeout(function () {
          _0xb928x27.removeClass("adding");
          _0xb928x1(".compare-popup").addClass("active");
        }, 1e3);
      });
      _0xb928x1(".compare-popup .compare-table-close").on("click", function (_0xb928x1c) {
        _0xb928x1c.preventDefault();
        _0xb928x1(".compare-popup").removeClass("active");
      });
      _0xb928x1(".product-quickview .quickview-button").on("click", function (_0xb928x1c) {
        _0xb928x1c.preventDefault();
        var _0xb928x28 = _0xb928x1(this);
        _0xb928x28.addClass("loading");
        setTimeout(function () {
          _0xb928x28.removeClass("loading");
          _0xb928x1(".quickview-popup").addClass("active");
        }, 1e3);
      });
      _0xb928x1(".quickview-popup .quickview-close").on("click", function (_0xb928x1c) {
        _0xb928x1c.preventDefault();
        _0xb928x1(".quickview-popup").removeClass("active");
      });
      _0xb928x1(document).on("click touch", ".quickview-popup", function (_0xb928x1c) {
        var _0xb928x29 = _0xb928x1(".quickview-container");
        if (_0xb928x1(_0xb928x1c.target).closest(_0xb928x29).length == 0) {
          _0xb928x1(".quickview-popup").removeClass("active");
        }
      });
      _0xb928x1(".quantity .plus").on("click", function (_0xb928x1c) {
        var _0xb928x2a = parseInt(_0xb928x1(this).closest(".quantity").find(".qty").val());
        _0xb928x1(this).closest(".quantity").find(".qty").val(_0xb928x2a + 1);
      });
      _0xb928x1(".quantity .minus").on("click", function (_0xb928x1c) {
        var _0xb928x2a = parseInt(_0xb928x1(this).closest(".quantity").find(".qty").val());
        if (_0xb928x2a > 1) {
          _0xb928x1(this).closest(".quantity").find(".qty").val(_0xb928x2a - 1);
        }
      });
      _0xb928x1(".newsletter-popup").addClass("active");
      _0xb928x1(".popup-shadow").show();
      _0xb928x1(".newsletter-popup .newsletter-close").on("click", function (_0xb928x1c) {
        _0xb928x1c.preventDefault();
        _0xb928x1(".newsletter-popup").removeClass("active");
        _0xb928x1(".popup-shadow").hide();
      });
      _0xb928x1(".newsletter-popup .newsletter-no").on("click", function (_0xb928x1c) {
        _0xb928x1c.preventDefault();
        _0xb928x1(".newsletter-popup").removeClass("active");
        _0xb928x1(".popup-shadow").hide();
      });
      _0xb928x1(".popup-shadow").on("click", function (_0xb928x1c) {
        var _0xb928x2b = _0xb928x1(".newsletter-container");
        if (_0xb928x1(_0xb928x1c.target).closest(_0xb928x2b).length == 0) {
          _0xb928x1(".newsletter-popup").removeClass("active");
          _0xb928x1(".popup-shadow").hide();
        }
      });
      var _0xb928x2c;
      _0xb928x1(".video-wrap .video").click(function () {
        _0xb928x2c = _0xb928x1(this).data("src");
      });
      _0xb928x1("#video-popup").on("shown.bs.modal", function (_0xb928x1c) {
        _0xb928x1("#video").attr("src", _0xb928x2c);
      });
      _0xb928x1("#video-popup").on("hide.bs.modal", function (_0xb928x1c) {
        _0xb928x1("#video").attr("src", _0xb928x2c);
      });
      _0xb928x1(".btn.loadmore").on("click", function (_0xb928x1c) {
        _0xb928x1c.preventDefault();
        var _0xb928x2d = _0xb928x1(this);
        _0xb928x2d.addClass("loading");
        setTimeout(function () {
          _0xb928x2d.closest(".block-products").find(".products-list .row > div.hide").show();
          _0xb928x2d.remove();
        }, 1e3);
      });
      if (screen.width <= 480) {
        _0xb928x1(".item-lookbook").each(function () {
          var _0xb928x2e = _0xb928x1(this).offset();
          var _0xb928x2f = parseInt(_0xb928x2e.left);
          _0xb928x1(this).find(".content-lookbook").css("left", "-" + (_0xb928x2f - 14) + "px");
          _0xb928x1(this).find(".content-lookbook").css("top", "auto");
          _0xb928x1(this).find(".content-lookbook").css("bottom", "36px");
          _0xb928x1(this).find(".content-lookbook").css("width", parseInt(screen.width) - 30 + "px");
        });
      }
      ;
      _0xb928x1(".menu-full .menu-toggle").on("click", function (_0xb928x1c) {
        _0xb928x1(this).closest(".menu-full").find(".site-navigation").addClass("active");
      });
      _0xb928x1(".menu-full .close-menu-full").on("click", function (_0xb928x1c) {
        _0xb928x1(this).closest(".menu-full").find(".site-navigation").removeClass("active");
      });
      if (_0xb928x1("#price-filter").length) {
        var max = $('#max-price').val();
        _0xb928x1("#price-filter").slider({from: 0, to: max, step: 1, smooth: true, round: 0, dimension: "&nbsp;₹", skin: "plastic"});
      }
      ;
      _0xb928x1(".shop-cart-empty").hide();
      _0xb928x1(".shop-cart .product-remove a").on("click", function (_0xb928x1c) {
        _0xb928x1c.preventDefault();
        _0xb928x1(this).closest("tr").remove();
        _0xb928x1(".shop-cart .cart-subtotal .price").text(_0xb928x1(".shop-cart .product-subtotal .price").text());
        _0xb928x1(".shop-cart .order-total .price").text(_0xb928x1(".shop-cart .product-subtotal .price").text());
        if (_0xb928x1(".shop-cart .cart-items tr").length == 2) {
          _0xb928x1(".shop-cart").hide();
          _0xb928x1(".shop-cart-empty").show();
        }
      });
      _0xb928x1(".custom-radio li .payment-box").hide();
      _0xb928x1(".custom-radio li .input-radio:checked").closest("li").find(".payment-box").show();
      _0xb928x1(".custom-radio li").on("click", function (_0xb928x1c) {
        _0xb928x1(this).closest(".custom-radio").find("li input").prop("checked", false);
        _0xb928x1(this).find("input").prop("checked", true);
        _0xb928x1(this).closest(".custom-radio").find("li .payment-box").hide();
        _0xb928x1(this).find(".payment-box").show();
      });
      if (_0xb928x1(".custom-select").length) {
        _0xb928x1(".custom-select").select2();
      }
      ;
      _0xb928x1(".shop-checkout .create-account").hide();
      _0xb928x1(".shop-checkout .account-fields .input-checkbox").change(function () {
        _0xb928x1(".shop-checkout .create-account").toggle();
      });
      _0xb928x1(".shop-checkout .shipping-address").hide();
      _0xb928x1(".shop-checkout .shipping-fields .input-checkbox").change(function () {
        _0xb928x1(".shop-checkout .shipping-address").toggle();
      });
    });
  }(jQuery));
