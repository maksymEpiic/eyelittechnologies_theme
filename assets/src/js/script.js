"use strict";

//import jQuery from "browser-sync/dist/lodash.custom.js";

jQuery(document).ready(function () {
    jQuery('a[href="#"]').on('click', function (e) {
        e.preventDefault();
    });

    // Конфигурация для интерактивной карты
    const mapConfig = {
        triggers: {
            india: { show: '.india', hide: '.usa, .uk, .canada, .canada_n, .japan, .taiwan' },
            uk: { show: '.uk', hide: '.usa, .india, .canada, .canada_n, .japan, .taiwan' },
            usa: { show: '.usa', hide: '.uk, .india, .canada, .canada_n, .japan, .taiwan' },
            canada: { show: '.canada', hide: '.uk, .india, .usa, .canada_n, .japan, .taiwan' },
            canada_n: { show: '.canada_n', hide: '.uk, .india, .usa, .canada, .japan, .taiwan' },
            japan: { show: '.japan', hide: '.uk, .india, .usa, .canada, .canada_n, .taiwan' },
            taiwan: { show: '.taiwan', hide: '.uk, .india, .usa, .canada, .japan, .canada_n' }
        }
    };

    // Обработчики для интерактивной карты
    Object.entries(mapConfig.triggers).forEach(([key, config]) => {
        // Обработчик наведения
        jQuery(`.${key}_triger`).on('mouseover', () => {
            jQuery(config.hide).hide();
            jQuery(config.show).show();
        });

        // Обработчик клика
        jQuery(config.show).on('click', () => {
            const data = jQuery(`path.${key}`).data('adress');
            navigator.clipboard.writeText(String(data));

            // Показываем уведомление
            jQuery('.adress_copied').addClass('show');
            setTimeout(() => jQuery('.adress_copied').removeClass('show'), 1000);
        });
    });

    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('content_type')) {
        var types = urlParams.get('content_type').split(',');
        types.forEach(function (val) {
            jQuery('.content-type_filter input#' + val).prop('checked', true);
        });
    }
    if (urlParams.has('industry')) {
        var inds = urlParams.get('industry').split(',');
        inds.forEach(function (val) {
            jQuery('.industry_filter input#' + val).prop('checked', true);
        });
    }

    function ajaxGetCategoryCounts() {
        var content_types = [];
        var industries = [];
        jQuery('.content-type_filter input:checked').each(function () {
            content_types.push(jQuery(this).attr('id'));
        });
        jQuery('.industry_filter input:checked').each(function () {
            industries.push(jQuery(this).attr('id'));
        });

        jQuery.ajax({
            url: ajax.ajaxurl, // ajax.ajaxurl должен быть локализован через wp_localize_script()
            type: 'POST',
            data: {
                action: 'get_category_counts',
                content_type: content_types,
                industry: industries
            },
            success: function (response) {
                if (response.success) {
                    // Обновляем счетчики для таксономии industry
                    jQuery('.industry_filter li').each(function () {
                        var slug = jQuery(this).find('input').attr('id');
                        var count = response.data.industry[slug] || 0;
                        jQuery(this).find('.posts_count').text(count);
                    });
                    // Обновляем счетчики для таксономии content-type
                    jQuery('.content-type_filter li').each(function () {
                        var slug = jQuery(this).find('input').attr('id');
                        var count = response.data.content_type[slug] || 0;
                        jQuery(this).find('.posts_count').text(count);
                    });
                }
            }
        });
    }

    // Вызываем обновление счетчиков при изменении любого из фильтров
    jQuery('.filter_list input').on('change', function () {
        ajaxGetCategoryCounts();
        ajaxFilterPosts(1);
    });

    // Также можно вызывать эту функцию при первичной загрузке, если нужно обновить счетчики
    ajaxGetCategoryCounts();

    function ajaxFilterPosts(paged) {
        var content_type = [];
        jQuery('.content-type_filter input:checked').each(function() {
            content_type.push(jQuery(this).attr('id'));
        });
        var industry = [];
        jQuery('.industry_filter input:checked').each(function() {
            industry.push(jQuery(this).attr('id'));
        });

        if (!paged) {
            paged = 1;
        }
        jQuery.ajax({
            url: ajax.ajaxurl,
            type: 'POST',
            data: {
                action: 'filter_posts',
                paged: paged,
                content_type: content_type,
                industry: industry
            },
            success: function(response) {

                jQuery('.post_loop_wrap').html(response);


                var baseUrl = window.location.href.split('?')[0];
                baseUrl = baseUrl.replace(/\/page\/\d+\/?$/, '');

                if (paged > 1) {
                    baseUrl = baseUrl + '/page/' + paged + '/';
                }

                var params = [];
                if (content_type.length > 0) {
                    params.push('content_type=' + content_type.join(','));
                }
                if (industry.length > 0) {
                    params.push('industry=' + industry.join(','));
                }

                if (params.length > 0) {
                    baseUrl += '?' + params.join('&');
                }

                var newUrl = baseUrl.replace(/%2C/g, ',');


                history.pushState(null, '', newUrl);
            }
        });
    }


    // jQuery('.mobile_filter_btn a, .filter_on').on('click', function(e) {
    //     e.preventDefault();
    //     ajaxFilterPosts(1);
    // });

    // jQuery('.filter_list input').on('change', function() {
    //     ajaxFilterPosts(1);
    // });

    jQuery('.filter_on').on('click', function (e) {
        e.preventDefault();
        jQuery('.filters_overlay, .filter_aside').toggleClass('active');
    });

    jQuery('.filter_mobile_close, .mobile_filter_btn a').on('click', function (e) {
        e.preventDefault();
        jQuery('.filters_overlay, .filter_aside').toggleClass('active');
    });


    jQuery(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var href = jQuery(this).attr('href');
        var paged = 1;

        var match = href.match(/\/page\/(\d+)\//);
        if(match) {
            paged = match[1];
        } else {
            // Альтернативно, если используется GET-параметр
            var matchQuery = href.match(/[?&]paged=(\d+)/);
            if(matchQuery) {
                paged = matchQuery[1];
            }
        }
        ajaxFilterPosts(paged);
    });


    jQuery(document).on('click', '.load_more_array a', function(event) {
        event.preventDefault();
        let button = jQuery(this);
        let paged = button.attr("data-page");
        let maxPages = button.attr("data-max-pages");
        let pageUpdate =  ++paged;
        let serchres = '[data-count="' + pageUpdate + '"]';
        button.attr("data-page", pageUpdate)

        if(pageUpdate == maxPages){
            button.css("display", "none");
        }
        jQuery(serchres).removeClass('hide');
    });

    jQuery(document).on('click', '.search_triger a', function(event) {
        event.preventDefault();
        jQuery('.site-header').addClass('open_form');
    });


    jQuery(document).on('click', function(e) {
        let form = jQuery( ".search_form" );
        if ( !form.is(e.target) && form.has(e.target).length === 0 ) {
            jQuery('.site-header').removeClass('open_form');
        }


    });



});



window.addEventListener('DOMContentLoaded', () => {

    let openMenuBtn = document.querySelector('.openMenuBtn');
    let closeMenuBtn = document.querySelector('.closeMobileMenu');
    let mobileMenuBtn = document.querySelector('.main_menu');
    openMenuBtn.addEventListener('click', function (event) {
        event.preventDefault();
        mobileMenuBtn.classList.add("opened");
    });
    closeMenuBtn.addEventListener('click', function (event) {
        event.preventDefault();
        mobileMenuBtn.classList.remove("opened");
    });

    // jQuery('.trustedSwiper .swiper-wrapper').slick({
    //     pauseOnHover:false,
    //     cssEase:'linear',
    //     arrows: false,
    //     infinite: true,     //Бесонечная прокрутка
    //     autoplay: true,     //Автопроигрывание
    //     autoplaySpeed: 0,    //Через какое время слайды будут сменяться
    //     speed: 6000,         // Скорость
    //     slidesToShow: 6,    //Количество карточек
    //
    //     responsive: [
    //         {
    //             breakpoint: 1024, //Планшет горизонтальный
    //             settings: {
    //                 slidesToShow: 4,    //Количество карточек
    //                 infinite: true,
    //                 autoplay: true,     //Автопроигрывание
    //                 autoplaySpeed: 0,    //Через какое время слайды будут сменяться
    //                 speed: 4000,
    //             }
    //         }
    //     ]
    // });

    let reviewSlider = jQuery('.review_slider .swiper-wrapper');

    if(reviewSlider){
        jQuery('.review_slider .swiper-wrapper').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            variableWidth: true,
            appendDots: jQuery('.slider_dots_wrap'),
            appendArrows: jQuery('.slider_arrows'),
            prevArrow : '<div class="swiper-button-prev">\n' +
                '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
                '<path d="M14.7665 4.99691L13.9696 4.19995L6 12.1694L13.9696 20.139L14.7665 19.342L7.59397 12.1695L14.7665 4.99691Z" fill="#231F20" stroke="#231F20" stroke-linejoin="round"/>\n' +
                '</svg>\n' +
                '</div>',
            nextArrow: '<div class="swiper-button-next">\n' +
                '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
                '<path d="M9.23346 4.99691L10.0304 4.19995L18 12.1694L10.0304 20.139L9.23346 19.342L16.406 12.1695L9.23346 4.99691Z" fill="#231F20" stroke="#231F20" stroke-linejoin="round"/>\n' +
                '</svg>\n' +
                '</div>',
            arrows: true,
            dots: true,
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        arrows: true,
                        slidesToShow: 2,
                    }
                }
            ]
        });
    }



    // const mobileWidthMediaQuery = window.matchMedia('(max-width: 768px)');
    // window.addEventListener('resize', function (event) {
    //     if (window.matchMedia('(max-width: 768px)').matches) {
    //         jQuery('.trustedSwiper .swiper-wrapper').slick('unslick');
    //     }
    // })
    //
    // if (window.matchMedia('(max-width: 768px)').matches) {
    //     jQuery('.trustedSwiper .swiper-wrapper').slick('unslick');
    // }
    //
    // var swiperReview = new Swiper(".reviewSwiper", {
    //     slidesPerView: "auto",
    //     centeredSlides: true,
    //     spaceBetween: 24,
    //     loop: true,
    //     pagination: {
    //         el: ".swiper-pagination",
    //         clickable: true,
    //     },
    //     navigation: {
    //         nextEl: ".swiper-button-next",
    //         prevEl: ".swiper-button-prev",
    //     },
    // });

});

// document.addEventListener('wpcf7mailsent', function(event) {
//     const formId = event.detail.contactFormId;
//
//     if (formId !== 3934) return;
//
//     const form = event.target;
//     const formData = new FormData(form);
//
//
//     const email = formData.get('email');
//     const first_name = formData.get('first_name');
//     const last_name = formData.get('last_name');
//     const message = formData.get('message');
//
//
//     const payload = {
//         fields: [
//             { name: 'email', value: email },
//             { name: 'firstname', value: first_name },
//             { name: 'lastname', value: last_name },
//             { name: 'message', value: message }
//         ],
//         context: {
//             pageUri: window.location.href,
//             pageName: document.title
//         }
//     };
//
//
//     const portalId = '48720229';
//     const hubFormId = '96352238-965e-44f6-9dac-eeb5867f0ab4';
//
//     const endpoint = `https://api.hsforms.com/submissions/v3/integration/submit/${portalId}/${hubFormId}`;
//
//     fetch(endpoint, {
//         method: 'POST',
//         headers: { 'Content-Type': 'application/json' },
//         body: JSON.stringify(payload)
//     })
//         .then(res => res.json().then(json => {
//             if (!res.ok) {
//                 console.error('❌ Ошибка HubSpot:', json);
//             } else {
//                 console.log('✅ Успешно отправлено в HubSpot');
//             }
//         }))
//         .catch(error => {
//             console.error('❌ Сетевая ошибка при отправке в HubSpot:', error);
//         });
// }, false);

document.addEventListener('DOMContentLoaded', function() {
    let siteHeader = document.querySelector('.site-header');

    let menuItemsWithChildren = siteHeader.querySelectorAll('.menu-item-has-children');

    menuItemsWithChildren.forEach(function(menuItem) {

        menuItem.addEventListener('mouseenter', function() {
            let subMenu = menuItem.querySelector('.sub-menu');
            if (subMenu) {
                subMenu.classList.add("showen");
                menuItem.classList.add("in_show");
                siteHeader.classList.add("open_menu");
            }
        });


        menuItem.addEventListener('mouseleave', function() {
            let subMenu = menuItem.querySelector('.sub-menu');
            if (subMenu) {
                subMenu.classList.remove("showen");
                menuItem.classList.remove("in_show");
                siteHeader.classList.remove("open_menu");
            }
        });
    });

    let siteFooter = document.querySelector('#footer-menu');

    let menuFooterItemsWithChildren = siteFooter.querySelectorAll('.menu-item-has-children');

    menuFooterItemsWithChildren.forEach(function(menuItem) {



        menuItem.addEventListener('click', function() {
            let allSubMenus = siteFooter.querySelectorAll('.sub-menu');
            allSubMenus.forEach(function(subItem) {
                subItem.classList.remove("showen")
            });
            let subMenu = menuItem.querySelector('.sub-menu');
            if (subMenu) {

                subMenu.classList.toggle("showen");
                menuItem.classList.toggle("in_show");

            }
        });


    });
});
if (window.location.href.includes('/wp-admin/')) {
    (function () {
        tinymce.create('tinymce.plugins.cta_shortcode_button', {
            init: function (editor, url) {
                editor.addButton('cta_shortcode_button', {
                    title: 'Insert CTA',
                    text: 'CTA',
                    onclick: function () {
                        editor.insertContent('[cta] CTA inner here [/cta]');
                    }
                });
            },
            createControl: function (n, cm) {
                return null;
            },
            getInfo: function () {
                return {
                    longname: "CTA Block Shortcode Button",
                    author: "Onfim",
                    version: "1.0"
                };
            }
        });
        tinymce.PluginManager.add('cta_shortcode_button', tinymce.plugins.cta_shortcode_button);

        tinymce.create('tinymce.plugins.cta_btn_shortcode_button', {
            init: function (editor, url) {
                editor.addButton('cta_btn_shortcode_button', {
                    title: 'CTA button',
                    text: 'CTA button',
                    onclick: function () {
                        editor.windowManager.open({
                            title: 'Insert CTA button',
                            body: [
                                {type: 'textbox', name: 'href', label: 'URL', value: '#'},
                                {type: 'textbox', name: 'text', label: 'Link Text', value: 'Click here'}
                            ],
                            onsubmit: function (e) {
                                editor.insertContent('[cta_button href="' + e.data.href + '" text="' + e.data.text + '"]');
                            }
                        });
                    }
                });
            },
            createControl: function (n, cm) {
                return null;
            },
            getInfo: function () {
                return {
                    longname: "CTA Link Shortcode Button",
                    author: "Onfim",
                    version: "1.0"
                };
            }
        });
        tinymce.PluginManager.add('cta_btn_shortcode_button', tinymce.plugins.cta_btn_shortcode_button);
    })();

    (function () {
        tinymce.create('tinymce.plugins.cta_title_shortcode_button', {
            init: function (editor, url) {
                editor.addButton('cta_title_shortcode_button', {
                    title: 'Insert CTA Title',
                    text: 'CTA Title',
                    onclick: function () {
                        editor.windowManager.open({
                            title: 'Insert CTA Title',
                            body: [
                                {type: 'textbox', name: 'content', label: 'Text', value: 'Your title here'}
                            ],
                            onsubmit: function (e) {
                                editor.insertContent('[cta_title]' + e.data.content + '[/cta_title]');
                            }
                        });
                    }
                });
            },
            createControl: function (n, cm) {
                return null;
            },
            getInfo: function () {
                return {
                    longname: "CTA Title Shortcode Button",
                    author: "Onfim",
                    version: "1.0"
                };
            }
        });
        tinymce.PluginManager.add('cta_title_shortcode_button', tinymce.plugins.cta_title_shortcode_button);
    })();

    (function () {
        tinymce.create('tinymce.plugins.cta_subtitle_shortcode_button', {
            init: function (editor, url) {
                editor.addButton('cta_subtitle_shortcode_button', {
                    title: 'Insert CTA Subtitle',
                    text: 'CTA Subtitle',
                    onclick: function () {
                        editor.windowManager.open({
                            title: 'Insert CTA Subtitle',
                            body: [
                                {type: 'textbox', name: 'content', label: 'Text', value: 'Your subtitle here'}
                            ],
                            onsubmit: function (e) {
                                editor.insertContent('[cta_subtitle]' + e.data.content + '[/cta_subtitle]');
                            }
                        });
                    }
                });
            },
            createControl: function (n, cm) {
                return null;
            },
            getInfo: function () {
                return {
                    longname: "CTA Subtitle Shortcode Button",
                    author: "Onfim",
                    version: "1.0"
                };
            }
        });
        tinymce.PluginManager.add('cta_subtitle_shortcode_button', tinymce.plugins.cta_subtitle_shortcode_button);
    })();

}

function getHubspotContext() {
    const cookie = document.cookie.split('; ').find(row => row.startsWith('hubspotutk='));
    const hutk = cookie ? cookie.split('=')[1] : '';

    return {
        hutk: hutk,
        pageUri: window.location.href,
        pageName: document.title,
        referrer: document.referrer || ''
    };
}

document.addEventListener('DOMContentLoaded', function () {
    const hiddenInput = document.getElementById('hubspot_context');
    if (hiddenInput) {
        const context = getHubspotContext();
        hiddenInput.value = JSON.stringify(context);
    }
});