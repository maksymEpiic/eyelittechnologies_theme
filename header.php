<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eyelittechnologies
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    if(is_page(2137)){
        echo '<meta name="robots" content="noindex, nofollow">';
    }

    ?>
    <link rel="profile" href="https://gmpg.org/xfn/11">
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>



    <?php wp_head(); ?>
    <?php
    if(is_page(2137)){
        echo '<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="e7fba820-a717-4356-a239-83998964889b";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>';
    }

    ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-22CR0KNT8M"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-22CR0KNT8M');
    </script>
</head>


<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'eyelittechnologies_theme' ); ?></a>

<div class="site-wrapper">
    <header class="site-header">
        <div class="container">
            <div class="menu-wrapper">
                <div class="header_logo">
                    <?php $logo = get_field( 'logo', 'option' ); ?>
                    <?php if ( $logo ) : ?>
                        <a href="/">
                            <img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo esc_attr( $logo['alt'] ); ?>" />
                        </a>

                    <?php endif; ?>
                </div>
                <div class="main_menu">
                    <div class="close_mobile_menu">
                        <a class="closeMobileMenu" href="#"><svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.89388 31.1061C-0.29796 29.9143 -0.29796 27.9819 0.89388 26.7901L11.684 16L0.893883 5.20992C-0.297957 4.01808 -0.29796 2.08572 0.89388 0.89388C2.08572 -0.29796 4.01807 -0.29796 5.20991 0.89388L16 11.684L26.7901 0.893883C27.9819 -0.297957 29.9143 -0.29796 31.1061 0.89388C32.298 2.08572 32.298 4.01807 31.1061 5.20991L20.316 16L31.1061 26.7901C32.298 27.9819 32.298 29.9143 31.1061 31.1061C29.9143 32.298 27.9819 32.298 26.7901 31.1061L16 20.316L5.20992 31.1061C4.01808 32.298 2.08572 32.298 0.89388 31.1061Z" fill="#68BA9D"/>
                            </svg>
                        </a>
                        <div class="menu_logo">
                            <img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo esc_attr( $logo['alt'] ); ?>" />
                        </div>
                    </div>

                    <nav id="site-navigation" class="main-navigation">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'menu-1',
                                'menu_id'        => 'primary-menu',
                                'container' => false,
                            )
                        );
                        ?>
                    </nav><!-- #site-navigation -->
                    <?php $phone = get_field( 'phone', 'option' ); ?>
                    <?php if ( $phone ) : ?>
                        <div class="mobile_menu_phone">
                            <a class="btn btn_green" href="<?php echo esc_url( $phone['url'] ); ?>" target="<?php echo esc_attr( $phone['target'] ); ?>"><?php echo esc_html( $phone['title'] ); ?></a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="side_phone">
                    <?php $phone = get_field( 'phone', 'option' ); ?>
                    <?php if ( $phone ) : ?>
                        <a class="btn btn_blue" href="<?php echo esc_url( $phone['url'] ); ?>" target="<?php echo esc_attr( $phone['target'] ); ?>"><?php echo esc_html( $phone['title'] ); ?></a>
                    <?php endif; ?>

                </div>
                <div class="search_form">
                    <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
                        <label class="screen-reader-text" for="s">Search: </label>
                        <input type="text" value="<?php echo get_search_query() ?>" name="s" id="s" />
                        <input type="submit" id="searchsubmit" value="find" />
                    </form>

                    <div class="search_triger">
                        <a href="#">
                            <svg width="26" height="27" viewBox="0 0 26 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17 17.5L25 25.5M10.3333 20.1667C5.17868 20.1667 1 15.988 1 10.8333C1 5.67868 5.17868 1.5 10.3333 1.5C15.488 1.5 19.6667 5.67868 19.6667 10.8333C19.6667 15.988 15.488 20.1667 10.3333 20.1667Z" stroke="#37A480" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="mobile_btn">
                    <a href="#" class="openMenuBtn">
                        <svg width="32" height="25" viewBox="0 0 32 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="32" height="3" rx="1.5" fill="#68BA9D"/>
                            <rect y="11" width="32" height="3" rx="1.5" fill="#68BA9D"/>
                            <rect x="11" y="22" width="21" height="3" rx="1.5" fill="#68BA9D"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </header>
