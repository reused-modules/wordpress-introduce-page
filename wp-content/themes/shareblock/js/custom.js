jQuery(document).ready(function ($) {
"use strict";
$('.menu_mobile_icons, .mobile_menu_overlay').on("click", function() {
    $('#content_nav').toggleClass('jl_mobile_nav_open');
    $('.mobile_menu_overlay').toggleClass('mobile_menu_active');
    $('.mobile_nav_class').toggleClass('active_mobile_nav_class');
});

$('.widget_nav_menu ul > li.menu-item-has-children').on( 'click', function(){
        var parentMenu = jQuery(this);        
        parentMenu.toggleClass('active');        
        return false;
    });

$("#mobile_menu_slide .menu-item-has-children > a").append($("<span/>", {
    class: 'arrow_down'
}).html('<i class="jli-down-chevron-1" aria-hidden="true"></i>'));
$('#mobile_menu_slide .arrow_down i').on("click", function() {
    var $submenu = $(this).closest('.menu-item-has-children').find(' > .sub-menu');
    $(this).toggleClass("jli-down-chevron-1").toggleClass("jli-up-chevron-1");
    if ($submenu.hasClass('menu-active-class')) {
        $submenu.removeClass('menu-active-class');
    } else {
        $submenu.addClass('menu-active-class');
    }
    return false;
});
$('.search_form_menu_personal_click').on("click", function() {
    $('.search_form_menu_personal').toggleClass('search_form_menu_personal_active');
    $('.mobile_nav_class').toggleClass('active_mobile_nav_class');
    setTimeout(function() {
        $('.search_form_menu_personal').find('.search_btn').focus()
    }, 100)

});

$(document).keyup(function(e) {
    if (e.keyCode == 27) {
        $('.search_form_menu_personal.search_form_menu_personal_active').toggleClass('search_form_menu_personal_active');    
        $('.mobile_nav_class.active_mobile_nav_class').toggleClass('active_mobile_nav_class');
    }
});

$('.search_form_menu_click').on('click', function(e) {
    e.preventDefault();
    $('.search_form_menu').toggle();
    $(this).toggleClass('active');
});
if ($('.sb-toggle-left').length) {
    $('.sb-toggle-left').on("click", function() {
        $('#nav-wrapper').toggle(100);
    });
    $("#menu-main-menu .menu-item-has-children > a").append($("<span/>", {
        class: 'arrow_down'
    }).html('<i class="jli-down-chevron-1"></i>'));
}

$('#nav-wrapper .menu .arrow_down').on("click", function() {
    var $submenu = $(this).closest('.menu-item-has-children').find(' > .sub-menu');

    if ($submenu.hasClass('menu-active-class')) {
        $submenu.removeClass('menu-active-class');
    } else {
        $submenu.addClass('menu-active-class');
    }

    return false;
});

$('.jl_pop_vid').magnificPopup({
          disableOn: 700,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,
          fixedContentPos: true
});
var tagrtl = $("html").attr("dir");
if(tagrtl){var rtl_options = true;}else{var rtl_options = false;}
$('.jl_single_gallery').slick({
    rtl: rtl_options,
    dots: true,
    speed: 600,
    arrows: false,
    autoplaySpeed: 6000,
    autoplay: false,
    pauseOnHover: true,
    adaptiveHeight: true,
    prevArrow: '<div class="jl-slider-prev jl_es_pre"><i class="jli-left-chevron-1"></i></div>',
    nextArrow: '<div class="jl-slider-next jl_es_next"><i class="jli-right-chevron-1"></i></div>',
    dotsClass: 'jl_s_pagination',
    slidesToShow: 1,
    slidesToScroll: 1
});

if ($('body').hasClass('jl_nav_stick')) {
    var theElement = $('body').hasClass('jl_nav_active') ? $('.jl_cus_sihead') : $('.tp_head_on');
    var jl_navbase, $orgElement, $jl_r_menudElement, orgElementTop, currentScroll, previousScroll = 0, scrollDifference, detachPoint = 320, hideShowOffset = 2,
    $html = $('body');    
    $orgElement = $('.jl_base_menu');
    if ($orgElement.length) {
    $jl_r_menudElement = $('.jl_r_menu');
    jl_navbase = $('body').hasClass('jl_nav_slide');
    $jl_r_menudElement.width($orgElement.width());
    $(window).on("resize", function() {
        $jl_r_menudElement.width($orgElement.width());
    });
    $(window).on("scroll", function() {
        if (jQuery(this).scrollTop() > 500) {
            jQuery("#go-top").fadeIn();
        } else {
            jQuery("#go-top").fadeOut();
        }
        currentScroll = $(this).scrollTop(),
        scrollDifference = Math.abs(currentScroll - previousScroll);
        $jl_r_menudElement.width($orgElement.width());
            orgElementTop = $orgElement.offset().top;
            if (currentScroll >= (orgElementTop) && currentScroll != 0) {
                if (jl_navbase) {
                    if (currentScroll > detachPoint) {
                        if (!$html.hasClass('menu-detached')) {
                            $html.addClass('menu-detached');
                        }
                    }
                    if (scrollDifference >= hideShowOffset) {
                        if (currentScroll > previousScroll) {
                            if (!$html.hasClass('menu-invisible')) {
                                $html.addClass('menu-invisible');
                            }
                        } else {
                            if ($html.hasClass('menu-invisible')) {
                                $html.removeClass('menu-invisible');
                            }
                        }
                    }
                } else {
                    $jl_r_menudElement.addClass('m-visible');
                    $orgElement.addClass('m-hidden');
                }
            } else {
                $jl_r_menudElement.removeClass('m-visible');
                $orgElement.removeClass('m-hidden');

                if (jl_navbase) {
                    $html.removeClass('menu-detached').removeClass('menu-invisible');
                }
            }
            previousScroll = currentScroll;        
    });
}
}

$('.shareblock_day_night .jl_moon').on("click", function() {
    $('.shareblock_day_night').addClass('jl_night_en');
    $('.shareblock_day_night').removeClass('jl_day_en');
    $('.jl_en_day_night').addClass('options_dark_skin');
    $('.mobile_nav_class').addClass('wp-night-mode-on');
    $.cookie('jlendnight', 'no', {
        expires: 7,
        path: '/'
    });
    $.cookie('jlenday', 'no', {
        expires: 7,
        path: '/'
    });
});

$('.shareblock_day_night .jl_moon').on("click", function() {
    $('.shareblock_day_night').addClass('jl_night_en');
    $('.shareblock_day_night').removeClass('jl_day_en');
    $('.jl_en_day_night').addClass('options_dark_skin');
    $('.mobile_nav_class').addClass('wp-night-mode-on');
    $.cookie('jlendnight', 'no', {
        expires: 7,
        path: '/'
    });
    $.cookie('jlenday', 'no', {
        expires: 7,
        path: '/'
    });
});

$('.shareblock_day_night .jl_sun').on("click", function() {
    $('.shareblock_day_night').addClass('jl_day_en');
    $('.shareblock_day_night').removeClass('jl_night_en');
    $('.jl_en_day_night').removeClass('options_dark_skin');
    $('.mobile_nav_class').removeClass('wp-night-mode-on');

    $.cookie('jlenday', 'no', {
        expires: 7,
        path: '/'
    });
    $.cookie('jlendnight', 'no', {
        expires: 7,
        path: '/'
    });

});

window.lazySizesConfig = window.lazySizesConfig || {};
window.lazySizesConfig.expand = 1000;
window.lazySizesConfig.loadMode = 1;
window.lazySizesConfig.loadHidden = false;

if ($('#jl-gdpr').length > 0) {
            if ($.cookie('jl_cookie_accept') !== '1') {
                $('#jl-gdpr').css('display', 'block');
                setTimeout(function () {
                    $('#jl-gdpr').addClass('jl-display');
                }, 10)
            }
            $('#jl-gdpr-accept').off('click').on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $.cookie('jl_cookie_accept', '1', {expires: 30, path: '/'});
                $('#jl-gdpr').removeClass('jl-display');
                setTimeout(function () {
                    $('#jl-gdpr').css('display', 'none');
                }, 500)
            })
}

if ($('#jl_tp_info').length > 0) {
            if ($.cookie('jl_topclose') !== '1') {
                $('#jl_tp_info').css('display', 'block');                
            }
            $('#tp_link').off('click').on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $.cookie('jl_topclose', '1', {expires: 30, path: '/'});
                $('#jl_tp_info').slideUp(280, function () {
                $('#jl_tp_info').remove();
                });                
            })
}

$("#go-top").on("click", function() {
    jQuery("body,html").animate({
        scrollTop: 0
    }, 800);
    return false;
});

$('.quantity .jlb-btn').on("click", function(e) {
    e.preventDefault();
    var button = $(this);
    var step = 1;
    var input = button.parent().find('input');
    var min = 1;
    var max = 1000;
    var value_old = parseInt(input.val());
    var value_new = parseInt(input.val());
    if (input.attr('step')) {
        step = parseInt(input.attr('step'));
    }
    if (input.attr('min')) {
        min = parseInt(input.attr('min'));
    }
    if (input.attr('max')) {
        max = parseInt(input.attr('max'));
    }
    if (button.hasClass('up')) {
        if (value_old < max) {
            value_new = value_old + step;
        } else {
            value_new = max;
        }
    } else if (button.hasClass('down')) {
        if (value_old > min) {
            value_new = value_old - step;
        } else {
            value_new = min;
        }
    }
    if (!input.attr('disabled')) {
        input.val(value_new).change();
    }
});

cusMainScript.init();
});
(function ($) {
    'use strict';
    var jlCookies = {
        setCookie: function setCookie(key, value, time, path) {
            var expires = new Date();
            expires.setTime(expires.getTime() + time);
            var pathValue = '';
            if (typeof path !== 'undefined') {
                pathValue = 'path=' + path + ';';
            }
            document.cookie = key + '=' + value + ';' + pathValue + 'expires=' + expires.toUTCString();
        },
        getCookie: function getCookie(key) {
            var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
            return keyValue ? keyValue[2] : null;
        }
    };
    document.addEventListener("DOMContentLoaded", function(event) {
        jl_night_mode_button_click();
        jl_night_mode_load_cookie();
    });

    function jl_night_mode_turn_on_time() {
        var server_time = wpnmObject.server_time;
        var turn_on_time = wpnmObject.turn_on_time;
        var turn_off_time = wpnmObject.turn_off_time;        
        if ( server_time >= turn_on_time && server_time <= turn_off_time ) {
            jlCookies.setCookie('jlmode_dn', 'true', 2628000000, '/');
        }
    }
    function jl_night_mode_button_click() {
        var nightModeButton = document.querySelectorAll('.jl-night-toggle-icon');

        for (var i = 0; i < nightModeButton.length; i++) {
            nightModeButton.item(i).onclick = function (event) {
                event.preventDefault();
                
                for (var i = 0; i < nightModeButton.length; i++) {
                    nightModeButton[i].classList.toggle('active');
                }

                if (this.classList.contains('active')) {
                    jlCookies.setCookie('jlmode_dn', 'true', 2628000000, '/');
                } else {
                    jlCookies.setCookie('jlmode_dn', 'false', 2628000000, '/');
                }
            };
        }
    }

    function jl_night_mode_load_cookie() {
        var nightModeButton = document.querySelectorAll('.jl-night-toggle-icon');

        if ('true' === jlCookies.getCookie('jlmode_dn')) {
            document.body.classList.add('wp-night-mode-on');
            $('.jl_en_day_night').addClass('options_dark_skin');
            $('.shareblock_day_night').addClass('jl_night_en');
            $('.shareblock_day_night').removeClass('jl_day_en');
            for (var i = 0; i < nightModeButton.length; i++) {
                nightModeButton[i].classList.add('active');
            }
        } else {
            document.body.classList.remove('wp-night-mode-on');
            $('.jl_en_day_night').removeClass('options_dark_skin');
            $('.shareblock_day_night').removeClass('jl_night_en');
            for (var i = 0; i < nightModeButton.length; i++) {
                nightModeButton[i].classList.remove('active');
            }
        }
    }   
    var jl_ma_effect_load = {
        init: function (jl_post_effect) {
            var $commonElements = $('.jl_ma_grid_col');

            if ($commonElements.length) {
                $commonElements.each(function () {
                    var $thisItem = $(this);
                    if (jl_post_effect) {
                        $thisItem.addClass('jl_ma_nitem');
                        setTimeout(function () {
                            $thisItem.addClass('jl_ma_appear');
                        }, 1100);
                    } else {
                        $thisItem.appear(function () {
                            $thisItem.addClass('jl_ma_appear');
                        }, { accX: 0, accY: 0 });
                    }
                });
            }
        }
    }
    $(window).on( 'load', function () {
        jl_ma_effect_load.init();        
    });

})(jQuery);

var cusMainScript = (function (OptScript, $) { OptScript.$body = $('body'); OptScript.$document = $(document); OptScript.$html = $('html, body'); OptScript.$window = $(window); OptScript.$ajax = {}; OptScript.sjload = {};
OptScript.init = function () { this.queryList(); this.cusLoadScript();};
OptScript.cusLoadScript = function () { this.jl_menu_cat(); this.navNextPre(); this.navloadMore(); this.navautoload(); this.blocknest();};
OptScript.loadpFunctions = function () {this.$html.off();this.$document.off();this.$window.trigger('load');this.cusLoadScript();};
OptScript.$blocksave = {data: {},get: function (id) {return this.data[id];},set: function (id, data) {this.remove(id);this.data[id] = data;},remove: function (id) {delete this.data[id];},exist: function (id) {return this.data.hasOwnProperty(id) && this.data[id] !== null;}};

    OptScript.blocknest = function () {
        var wrapper = $('.jl_ma_grid.jl_load_magrid');
        if (wrapper.length > 0) {
            wrapper.each(function () {
                var jcontain = $(this).find('.jl_contain').eq(0);
                $(jcontain).isotope({itemSelector: '.jl_ma_grid_col', percentPosition: true,masonry: {columnWidth: '.jl_ma_grid_w', gutter: '.jl_ma_grid_gutter'}});
                jcontain.imagesLoaded().progress(function () {$(jcontain).isotope('layout');});                               
            });
        }
    };
    OptScript.blockDatalist = function (block) {
        return {blockid: block.data('blockid'), section_style: block.data('section_style'), posts_per_page: block.data('posts_per_page'), page_max: block.data('page_max'), page_current: block.data('page_current'), category: block.data('category'), categories: block.data('categories'), orderby: block.data('orderby'), author: block.data('author'), tags: block.data('tags'), tabs_link: block.data('tabs_link'), post_not_in: block.data('post_not_in'), format: block.data('format'), offset: block.data('offset')};
    };
    OptScript.trackPagenav = function (block) {
        var settings = this.blockDatalist(block);
        var max_offsets = settings.page_max+settings.offset;
        if (settings.page_current >= max_offsets || settings.page_current >= settings.page_max || settings.page_max <= 1) {
            block.find('.jl-load-link').hide();
            block.find('.jl-load-animation').hide();
            block.find('.jl_lmore_c').addClass('jl_hide_pagination');
            block.find('.jl_autoload').addClass('disable-pagination');
        } else {
            block.find('.jl-load-link').show();
            block.find('.jl-load-link').css('opacity', 1);
            block.find('.jl-load-animation').hide();
            block.find('.jl_lmore_c').removeClass('jl_hide_pagination');
            block.find('.jl_autoload').removeClass('disable-pagination');
        }
        if (settings.page_max < 2) {
            block.find('.jl-foot-nav').addClass('jl_disable');
        }
        if (settings.page_current >= settings.page_max) {
            block.find('.jl-next-nav').addClass('jl_disable');
        }
        if (settings.page_current <= 1) {
            block.find('.jl-prev-nav').addClass('jl_disable');
        }
    };
    OptScript.queryList = function () {
        var self = this;
        $('.jl-tab-link').off('click').on('click', function (e) {

            e.preventDefault();
            e.stopPropagation();

            var link = $(this);
            var block = link.parents('.block-section');
            var blockid = block.attr('id');

            if (true == self.$ajax[blockid + '_loading']) {
                return;
            }
            self.$ajax[blockid + '_loading'] = true;
            var filterVal = link.data('ajax_filter_val');

            block.find('.jl-tab-link').removeClass('is-active');
            block.find('.jl-tab-link').not(this).addClass('is-deactivate');
            link.addClass('is-active');

            self.startEffect(block, 'replace');
            var settings = self.blockDatalist(block);

            self.resetQuickFilter(block, settings, filterVal);

            setTimeout(function () {
                self.blockLink(block, settings);
            }, 400);

        });

        OptScript.navNextPre = function () {
            var self = this;
            $('.jl-foot-nav').off('click').on('click', function (e) {

                e.preventDefault();
                e.stopPropagation();

                var link = $(this);
                var block = link.parents('.block-section');
                var blockid = block.attr('id');

                if (true == self.$ajax[blockid + '_loading']) {
                    return;
                }
                self.$ajax[blockid + '_loading'] = true;
                var type = link.data('type');
                var settings = self.blockDatalist(block);
                self.startEffect(block, 'replace');
                self.navNextPreProcess(block, settings, type);
            });
        };
        
    OptScript.navNextPreProcess = function (block, settings, type) {

            if ('prev' == type) {
                settings.page_next = parseInt(settings.page_current) - 1;
            } else {
                settings.page_next = parseInt(settings.page_current) + 1;
            }
            var cacheSettings = settings;
            delete cacheSettings.page_max;
            cacheSettings.page_current = settings.page_next;
            var cacheID = JSON.stringify(cacheSettings);

            if (self.$blocksave.exist(cacheID)) {
                var data = self.$blocksave.get(cacheID);
                if ('undefined' != typeof data.page_current) {
                    block.data('page_current', data.page_current);
                }
                self.endEffect(block, data.content, 'replace');
                return false;
            } else {
                $.ajax({
                    type: 'POST',
                    url: jlParamsOpt.ajaxurl,
                    data: {
                        action: 'shareblock_loadnavs',
                        data: settings
                    },
                    success: function (data) {
                        data = $.parseJSON(JSON.stringify(data));
                        if ('undefined' != typeof data.page_current) {
                            block.data('page_current', data.page_current);
                        }
                        self.$blocksave.set(cacheID, data);
                        self.endEffect(block, data.content, 'replace');
                    },
                    complete: function(){
                    block.find('.load-animation').css({'display': 'none'});
                }
                });
            }
        };
        

        OptScript.resetQuickFilter = function (block, settings, filterVal) {

            var self = this;
            var blockid = block.attr('id');

            settings.page_current = 1;
            block.data('page_current', 1);

            if ('category' == settings.tabs_link) {
                if ('undefined' == typeof (self.$ajax[blockid + '_category'])) {
                    self.$ajax[blockid + '_category'] = 0;
                }

                if (0 == filterVal) {
                    settings.category = self.$ajax[blockid + '_category'];
                    settings.categories = self.$ajax[blockid + '_categories'];

                    block.data('category', self.$ajax[blockid + '_category']);
                    block.data('categories', self.$ajax[blockid + '_categories']);

                } else {
                    settings.category = filterVal;
                    settings.categories = 0;

                    block.data('category', filterVal);
                    block.data('categories', 0);
                }
            }

            if ('tag' == settings.tabs_link) {
                settings.tags = filterVal;
                block.data('tags', filterVal);
            }
        };

        OptScript.blockLink = function (block, settings) {

            var self = this;
            var cacheSettings = settings;
            delete cacheSettings.page_max;
            var cacheID = JSON.stringify(cacheSettings);

            if (self.$blocksave.exist(cacheID)) {
                var data = self.$blocksave.get(cacheID);

                if ('undefined' != typeof data.page_max) {
                    block.data('page_max', data.page_max);
                }
                self.endEffect(block, data.content, 'replace');
                return false;
            } else {
                $.ajax({
                    type: 'POST',
                    url: jlParamsOpt.ajaxurl,
                    data: {
                        action: 'shareblock_block_link',
                        data: settings
                    },
                    success: function (data) {
                        data = $.parseJSON(JSON.stringify(data));
                        if ('undefined' != typeof data.page_max) {
                            block.data('page_max', data.page_max);
                        }
                        self.$blocksave.set(cacheID, data);
                        self.endEffect(block, data.content, 'replace');
                    }
                });
            }
        };       
        OptScript.startEffect = function (block, action) {
            var wrapper = block.find('.jl_wrap_eb');
            var jcontain = wrapper.find('.jl_contain');
            block.find('.jl-block-link').addClass('jl_disable');
            jcontain.stop();
            if (action =='replace') {
                wrapper.css('height', wrapper.outerHeight());
                wrapper.prepend('<div class="jl-load-animation"></div>');
                jcontain.addClass('jl_overflow');
                jcontain.fadeTo('100', .3);
            } else {
                block.find('.jl-load-link').addClass('loading').animate({opacity: 0}, 100);
                block.find('.jl-load-animation').css({'display': 'block'}).delay(100).animate({opacity: 1}, 100);
            }
        };
        OptScript.navloadMore = function () {
            var self = this;
            $('.jl-load-link').off('click').on('click', function (e) {

                e.preventDefault();
                e.stopPropagation();

                var link = $(this);
                var block = link.parents('.block-section');
                var blockid = block.attr('id');
                if (true == self.$ajax[blockid + '_loading']) {
                    return;
                }
                self.$ajax[blockid + '_loading'] = true;
                var settings = self.blockDatalist(block);
                if (settings.page_current >= settings.page_max) {
                    return;
                }
                self.startEffect(block, 'append');
                self.navloadAction(block, settings);

            })
        };   
        OptScript.navautoload = function () {
            var self = this;
            var infiniteElements = $('.jl_autoload');
            if (infiniteElements.length > 0) {
                infiniteElements.each(function () {
                    var link = $(this);
                    if (!link.hasClass('disable-pagination')) {
                        var animation = link.find('.jl-load-animation');
                        var block = link.parents('.block-section');
                        var blockid = block.attr('id');
                        var sjloadID = 'infinite' + blockid;
                        var settings = self.blockDatalist(block);

                        self.sjload[sjloadID] = new Waypoint({
                            element: link,
                            handler: function (direction) {
                                if ('down' == direction) {
                                    if (true == self.$ajax[blockid + '_loading']) {
                                        return;
                                    }
                                    self.$ajax[blockid + '_loading'] = true;
                                    self.startEffect(block, 'append');
                                    OptScript.navloadAction(block, settings);
                                    setTimeout(function () {
                                        self.sjload[sjloadID].destroy();
                                    }, 10);
                                }
                            },
                            offset: '99%'
                        })
                    }
                });
            }
        };
        OptScript.navloadAction = function (block, settings) {
            settings.page_next = parseInt(settings.page_current) + 1;
            if (settings.page_next <= settings.page_max) {
                $.ajax({
                    type: 'POST',
                    url: jlParamsOpt.ajaxurl,
                    data: {
                        action: 'shareblock_loadnavs',
                        data: settings
                    },
                    success: function (data) {
                        data = $.parseJSON(JSON.stringify(data));
                        if ('undefined' != data.page_current) {
                            block.data('page_current', data.page_current);
                        }
                        if ('undefined' != data.notice) {
                            data.content = data.content + data.notice;
                        }
                        self.endEffect(block, data.content, 'append');
                    }
                });
            }
        };
        OptScript.jl_menu_cat = function() {
            var cat_haction;
            var cat_sub = $('.mega-category-menu .menu-item');
            cat_sub.hover(function(event) {
                event.stopPropagation();
                cat_sub = $(this);
                cat_sub.addClass('is-current-sub').siblings().removeClass('is-current-sub current-menu-item');
                var wrapper = cat_sub.parents('.mega-category-menu');
                var block = wrapper.find('.block-section');
                cat_haction = setTimeout(function() {
                    self.jl_menu_cat_load(cat_sub, block);
                }, 200);
            }, function() {
                clearTimeout(cat_haction);
            });
        },
        OptScript.jl_menu_cat_load = function(cat_sub, block) {
            var blockid = block.attr('id');
            if (true == self.$ajax[blockid + '_loading']) {
                return;
            }
            self.$ajax[blockid + '_loading'] = true;
            var settings = self.blockDatalist(block);
            settings.category = cat_sub.data('mega_sub_filter');
            settings.page_current = 1;
            settings.section_style = 'jl_menu_g';
            settings.posts_per_page = 4;
            block.data('category', settings.category);
            block.data('page_current', settings.page_current);
            self.startEffect(block, 'replace');
            setTimeout(function() {
                self.jl_menu_cat_fil(block, settings);
            }, 200);
        },
        OptScript.jl_menu_cat_fil = function(block, settings) {
            var jl_mcache = settings;
            delete jl_mcache.page_max;
            var cache_id = JSON.stringify(jl_mcache);

            if (self.$blocksave.exist(cache_id)) {
                var data = self.$blocksave.get(cache_id);
                if ('undefined' != data.page_max) {
                    block.data('page_max', data.page_max);
                }
                self.endEffect(block, data.content, 'replace');
                return false;
            }
            $.ajax({
                type: 'POST',
                url: jlParamsOpt.ajaxurl,
                data: {
                    action: 'shareblock_menu_cat_opt',
                    data: settings
                },
                success: function(data) {
                    data = $.parseJSON(data);
                    if ('undefined' != data.page_max) {
                        block.data('page_max', data.page_max);
                    }
                    self.$blocksave.set(cache_id, data);
                    self.endEffect(block, data.content, 'replace');
                }
            });
        },
        OptScript.endEffect = function (block, content, action) {
            var self = this;
            block.delay(100).queue(function () {
                var blockid = block.attr('id');
                var wrapper = block.find('.jl_wrap_eb');
                var jcontain = block.find('.jl_contain');

                block.find('.filter-link').removeClass('jl_removes');
                block.find('.jl-block-link').removeClass('jl_disable');
                jcontain.stop();

                if ('replace' == action) {
                    wrapper.find('.jl-load-animation').remove();
                    jcontain.html(content);

                    if (jcontain.hasClass('large-jcontain')) {
                        jcontain.imagesLoaded(function () {
                            setTimeout(function () {
                                jcontain.removeClass('jl_overflow');
                                wrapper.css('height', 'auto');
                                setTimeout(function () {
                                    jcontain.fadeTo(200, 1);
                                }, 200);
                            }, 100)
                        });
                    } else {
                        jcontain.removeClass('jl_overflow');
                        wrapper.css('height', 'auto');
                        setTimeout(function () {
                            jcontain.fadeTo(200, 1);
                        }, 200);
                    }
                } else {
                    content = $(content);
                    content.addClass('jl_hide');
                    content.addClass('show_block');
                    jcontain.append(content);
                    block.find('.jl-load-animation').animate({opacity: 0}, 200, function () {
                        $(this).css({'display': 'none'});
                    });                    
                    setTimeout(function () {
                        content.removeClass('jl_hide');
                    }, 200);
                    block.find('.jl-load-link').removeClass('loading').delay(200).animate({opacity: 1}, 200);
                }
                    if (jcontain.hasClass('jl_ma_layout')) {
                        $(jcontain).isotope('reloadItems').isotope({ sortBy: 'original-order', transitionDuration: 0 });
                    }
                    
                    $('.jl_pop_vid').magnificPopup({
                              disableOn: 700,
                              type: 'iframe',
                              mainClass: 'mfp-fade',
                              removalDelay: 160,
                              preloader: false,
                              fixedContentPos: true
                    });
              
                self.trackPagenav(block);
                block.dequeue();

                setTimeout(function () {
                    self.$ajax[blockid + '_loading'] = false;
                    self.loadpFunctions();
                }, 50);
            });
        }
    };
    return OptScript;
}(cusMainScript || {}, jQuery));
( function( $ ) {
     var eSlidertabOpt = function ($scope, $) {        
        var jl_sl_t = $scope.find('.jl_sl_t').eq(0);
        var jl_load_c = $scope.find('.jl_load_c').eq(0);        
        var tagrtl = $("html").attr("dir");
        if(tagrtl){var rtl_options = true;}else{var rtl_options = false;}
if ( jl_sl_t.length > 0) {            
 jl_sl_t.slick({
                rtl: rtl_options,
                arrows: jl_sl_t.attr("data-arrows") == "true",
                prevArrow:'<div class="jl-slider-prev jl_es_pre"><i class="jli-left-chevron-1"></i></div>',
                nextArrow:'<div class="jl-slider-next jl_es_next"><i class="jli-right-chevron-1"></i></div>',
                dotsClass:'jl_s_pagination',
                speed: parseInt(jl_sl_t.attr('data-speed')) || 500,
                fade: jl_sl_t.attr("data-effect") == "true",
                dots: jl_sl_t.attr("data-dots") == "true",
                infinite: jl_sl_t.attr("data-loop") == "true",
                autoplay: jl_sl_t.attr("data-play") == "true",
                autoplaySpeed: parseInt(jl_sl_t.attr('data-autospeed')) || 7000,
                swipe: jl_sl_t.attr("data-swipe") == "true",
                pauseOnHover: false,
                slidesToShow: parseInt(jl_sl_t.attr('data-xl-items')) || 1,
                adaptiveHeight: true,
                centerMode: jl_sl_t.attr("data-center") == "true",
                swipeToSlide:true,
                centerPadding: jl_sl_t.attr('data-center-p') || '50px',                
                asNavFor: jl_load_c
            });

            jl_load_c.slick({
              slidesToShow: 4,
              slidesToScroll: 4,
              asNavFor: jl_sl_t,
              focusOnSelect: true,
            });
};
    };

     var eSliderOpt = function ($scope, $) {
        var slider_element = $scope.find('.jl-eb-slider').eq(0);
        var tagrtl = $("html").attr("dir");
        if(tagrtl){var rtl_options = true;}else{var rtl_options = false;}
        if ( slider_element.length > 0) {            
            slider_element.slick({
                rtl: rtl_options,
                arrows: slider_element.attr("data-arrows") == "true",
                prevArrow:'<div class="jl-slider-prev jl_es_pre"><i class="jli-left-chevron-1"></i></div>',
                nextArrow:'<div class="jl-slider-next jl_es_next"><i class="jli-right-chevron-1"></i></div>',
                dotsClass:'jl_s_pagination',
                speed: parseInt(slider_element.attr('data-speed')) || 500,
                fade: slider_element.attr("data-effect") == "true",
                dots: slider_element.attr("data-dots") == "true",
                infinite: slider_element.attr("data-loop") == "true",
                autoplay: slider_element.attr("data-play") == "true",
                autoplaySpeed: parseInt(slider_element.attr('data-autospeed')) || 7000,
                swipe: slider_element.attr("data-swipe") == "true",
                pauseOnHover: true,
                slidesToShow: parseInt(slider_element.attr('data-xl-items')) || 1,
                adaptiveHeight: true,
                centerMode: slider_element.attr("data-center") == "true",
                swipeToSlide:true,
                centerPadding: slider_element.attr('data-center-p') || '50px',
                responsive: [
                      {
                        breakpoint: 0,
                        settings: {
                          slidesToShow: parseInt(slider_element.attr('data-items')) || 1,
                          centerMode: false
                        }
                      },
                      {
                        breakpoint: 479,
                        settings: {
                          slidesToShow: parseInt(slider_element.attr('data-xs-items')) || 1,
                          centerMode: false
                        }
                      },
                      {
                        breakpoint: 767,
                        settings: {
                          slidesToShow: parseInt(slider_element.attr('data-sm-items')) || 1,
                          centerMode: false
                        }
                      },
                      {
                        breakpoint: 850,
                        settings: {
                          slidesToShow: parseInt(slider_element.attr('data-smd-items')) || 1,
                          centerMode: false
                        }
                      },
                      {
                        breakpoint: 991,
                        settings: {
                          slidesToShow: parseInt(slider_element.attr('data-md-items')) || 1,
                          centerMode: false
                        }
                      },
                      {
                        breakpoint: 1199,
                        settings: {
                          slidesToShow: parseInt(slider_element.attr('data-lg-items')) || 1,
                          centerMode: false
                        }
                      },
                      {
                        breakpoint: 1799,
                        settings: {
                          slidesToShow: parseInt(slider_element.attr('data-xl-items')) || 1,
                        }
                      },
                ]
            });
  };
    };

    var ecarOpt = function ($scope, $) {
        var slider_element = $scope.find('.jl-eb-slider').eq(0);
        var tagrtl = $("html").attr("dir");
        if(tagrtl){var rtl_options = true;}else{var rtl_options = false;}
        if ( slider_element.length > 0) {            
            slider_element.slick({
                rtl: rtl_options,
                arrows: slider_element.attr("data-arrows") == "true",
                prevArrow:'<div class="jl-slider-prev jl_es_pre"><i class="jli-left-chevron-1"></i></div>',
                nextArrow:'<div class="jl-slider-next jl_es_next"><i class="jli-right-chevron-1"></i></div>',
                dotsClass:'jl_s_pagination',
                speed: parseInt(slider_element.attr('data-speed')) || 500,
                fade: slider_element.attr("data-effect") == "true",
                dots: slider_element.attr("data-dots") == "true",
                infinite: slider_element.attr("data-loop") == "true",
                autoplay: slider_element.attr("data-play") == "true",
                autoplaySpeed: parseInt(slider_element.attr('data-autospeed')) || 7000,
                swipe: slider_element.attr("data-swipe") == "true",
                pauseOnHover: true,
                slidesToShow: parseInt(slider_element.attr('data-xl-items')) || 1,
                adaptiveHeight: true,
                centerMode: slider_element.attr("data-center") == "true",
                swipeToSlide:true,
                centerPadding: slider_element.attr('data-center-p') || '50px',
                responsive: [
                      {
                        breakpoint: 0,
                        settings: {
                          slidesToShow: parseInt(slider_element.attr('data-items')) || 1,
                          centerMode: false
                        }
                      },
                      {
                        breakpoint: 479,
                        settings: {
                          slidesToShow: parseInt(slider_element.attr('data-xs-items')) || 1,
                          centerMode: false
                        }
                      },
                      {
                        breakpoint: 767,
                        settings: {
                          slidesToShow: parseInt(slider_element.attr('data-sm-items')) || 1,
                          centerMode: false
                        }
                      },
                      {
                        breakpoint: 850,
                        settings: {
                          slidesToShow: parseInt(slider_element.attr('data-smd-items')) || 1,
                          centerMode: false
                        }
                      },
                      {
                        breakpoint: 991,
                        settings: {
                          slidesToShow: parseInt(slider_element.attr('data-md-items')) || 1,
                          centerMode: false
                        }
                      },
                      {
                        breakpoint: 1199,
                        settings: {
                          slidesToShow: parseInt(slider_element.attr('data-lg-items')) || 1,
                          centerMode: false
                        }
                      },
                      {
                        breakpoint: 1799,
                        settings: {
                          slidesToShow: parseInt(slider_element.attr('data-xl-items')) || 1,
                        }
                      },
                ]
            });
  };
    };

  $( window ).on( 'elementor/frontend/init', function() {
    elementorFrontend.hooks.addAction( 'frontend/element_ready/shareblock-feature-slider.default', eSlidertabOpt );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/shareblock-feature-slider.default', eSliderOpt );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/shareblock-feature-carousel.default', ecarOpt );    
  });
})( jQuery );