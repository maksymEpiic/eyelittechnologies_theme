<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eyelittechnologies
 */

?>

<footer class="site-footer">
    <div class="container">
        <div class="footer_top_wrap">
            <div class="left_footer_side">
                <div class="logo_block">
                    <?php $footer_logo = get_field( 'footer_logo', 'option' ); ?>
                    <?php if ( $footer_logo ) : ?>
                        <img src="<?php echo esc_url( $footer_logo['url'] ); ?>" alt="<?php echo esc_attr( $footer_logo['alt'] ); ?>" />
                    <?php endif; ?>
                </div>
                <div class="menu_block">

                    <nav id="footer_menu" class="footer_menu">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'menu-1',
                                'menu_id'        => 'footer-menu',
                                'container' => false,
                            )
                        );
                        ?>
                    </nav><!-- #site-navigation -->
                </div>
            </div>
            <div class="phone_block">
                <?php $phone = get_field('phone', 'option'); ?>
                <?php if ($phone) : ?>
                    <a class="btn btn_green" href="<?php echo esc_url($phone['url']); ?>" target="<?php echo esc_attr($phone['target']); ?>"><?php echo esc_html($phone['title']); ?></a>
                <?php endif; ?>

            </div>
        </div>
        <div class="footer_bottom_wrap">
            <div class="copyr">
                <span>Eyelit 2024 | <a href="/privacy-policy">Privacy Policy</a></span>
            </div>
            <div class="social">
                <?php
                $linkedin_link = get_field('linkedin_link', 'option');

                if ($linkedin_link) { ?>
                    <a href="<?= esc_url($linkedin_link); ?>">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.1429 0H2.85714C1.28 0 0 1.28 0 2.85714V21.1429C0 22.72 1.28 24 2.85714 24H21.1429C22.72 24 24 22.72 24 21.1429V2.85714C24 1.28 22.72 0 21.1429 0ZM7.42857 9.14286V20H4V9.14286H7.42857ZM4 5.98286C4 5.18286 4.68571 4.57143 5.71429 4.57143C6.74286 4.57143 7.38857 5.18286 7.42857 5.98286C7.42857 6.78286 6.78857 7.42857 5.71429 7.42857C4.68571 7.42857 4 6.78286 4 5.98286ZM20 20H16.5714C16.5714 20 16.5714 14.7086 16.5714 14.2857C16.5714 13.1429 16 12 14.5714 11.9771H14.5257C13.1429 11.9771 12.5714 13.1543 12.5714 14.2857C12.5714 14.8057 12.5714 20 12.5714 20H9.14286V9.14286H12.5714V10.6057C12.5714 10.6057 13.6743 9.14286 15.8914 9.14286C18.16 9.14286 20 10.7029 20 13.8629V20Z" fill="white" />
                        </svg>
                    </a>
                <?php } ?>
                <?php $instagram_link = get_field('instagram_link', 'option'); ?>
                <?php if ($instagram_link) : ?>
                    <a href="<?php echo esc_url($instagram_link); ?>">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.4844 0H3.51562C1.57727 0 0 1.57727 0 3.51562V20.4844C0 22.4227 1.57727 24 3.51562 24H20.4844C22.4227 24 24 22.4227 24 20.4844V3.51562C24 1.57727 22.4227 0 20.4844 0ZM12.0469 18.2812C8.55743 18.2812 5.71875 15.4426 5.71875 11.9531C5.71875 8.46368 8.55743 5.625 12.0469 5.625C15.5363 5.625 18.375 8.46368 18.375 11.9531C18.375 15.4426 15.5363 18.2812 12.0469 18.2812ZM19.0781 7.03125C17.915 7.03125 16.9688 6.08496 16.9688 4.92188C16.9688 3.75879 17.915 2.8125 19.0781 2.8125C20.2412 2.8125 21.1875 3.75879 21.1875 4.92188C21.1875 6.08496 20.2412 7.03125 19.0781 7.03125Z" fill="white" />
                            <path d="M19.0781 4.21875C18.6901 4.21875 18.375 4.53387 18.375 4.92188C18.375 5.30988 18.6901 5.625 19.0781 5.625C19.4661 5.625 19.7812 5.30988 19.7812 4.92188C19.7812 4.53387 19.4661 4.21875 19.0781 4.21875Z" fill="white" />
                            <path d="M12.0468 7.86475C9.79278 7.86475 7.9585 9.69903 7.9585 11.9531C7.9585 14.2072 9.79278 16.0414 12.0468 16.0414C14.3009 16.0414 16.1352 14.2072 16.1352 11.9531C16.1352 9.69903 14.3009 7.86475 12.0468 7.86475Z" fill="white" />
                        </svg>
                    </a>

                <?php endif; ?>

                <?php $_twitter = get_field('_twitter', 'option'); ?>
                <?php if ($_twitter) : ?>

                    <a href="<?php echo esc_url($_twitter); ?>">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.51562 0H20.4844C22.4227 0 24 1.57727 24 3.51562V20.4844C24 22.4227 22.4227 24 20.4844 24H3.51562C1.57727 24 0 22.4227 0 20.4844V3.51562C0 1.57727 1.57727 0 3.51562 0ZM8.35131 17.6168C8.98098 17.7161 9.6069 17.7656 10.215 17.7656C10.9188 17.7656 11.5988 17.6991 12.232 17.5666C13.5229 17.2963 14.6094 16.7678 15.4615 15.9959C16.15 15.372 16.6691 14.5985 17.0041 13.6971C17.3582 12.7443 17.5064 11.6452 17.4447 10.4303C17.4285 10.1106 17.5155 9.80571 17.6897 9.57161C18.3857 8.63673 18.4366 8.55967 18.4774 8.49772L18.478 8.49681C18.488 8.48162 18.4957 8.46996 18.5242 8.4308L19.0312 7.73368L18.1734 7.77275C18.1362 7.77437 18.1005 7.77685 18.066 7.77977L18.5899 6.27458L17.7865 6.55304C17.5709 6.62777 17.3981 6.6932 17.2457 6.75092L17.2406 6.75282L17.2405 6.75285C16.9852 6.84954 16.7963 6.92109 16.5399 6.98811C16.0149 6.51332 15.3538 6.23886 14.6256 6.19385C13.9393 6.15144 13.2468 6.3225 12.6759 6.67554C12.1617 6.9935 11.7749 7.43957 11.5574 7.96562C11.3706 8.41742 11.3142 8.92145 11.3895 9.44372C9.54553 9.18631 7.9919 8.307 6.76528 6.8247L6.37744 6.35607L6.08744 6.89162C5.72105 7.56823 5.59939 8.34197 5.74476 9.07028C5.80441 9.36892 5.90591 9.65386 6.04635 9.92066L5.71343 9.79093L5.67395 10.3503C5.63393 10.9187 5.82201 11.5819 6.17724 12.1247C6.27712 12.2774 6.40597 12.4453 6.56916 12.6108L6.39707 12.5844L6.60692 13.2252C6.88276 14.0675 7.45578 14.7191 8.19929 15.0813C7.45675 15.3982 6.8569 15.6006 5.87082 15.9267L4.96875 16.2251L5.80195 16.6834C6.11962 16.8582 7.24228 17.4417 8.35131 17.6168Z" fill="white" />
                        </svg>
                    </a>
                <?php endif; ?>

                <?php $youtube_link = get_field('youtube_link', 'option'); ?>
                <?php if ($youtube_link) : ?>
                    <a href="<?php echo esc_url($youtube_link['url']); ?>">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.51562 0H20.4844C22.4227 0 24 1.57727 24 3.51562V20.4844C24 22.4227 22.4227 24 20.4844 24H3.51562C1.57727 24 0 22.4227 0 20.4844V3.51562C0 1.57727 1.57727 0 3.51562 0ZM20 13.7684V10.2316C19.9764 10.0742 19.9533 9.91678 19.9302 9.75936C19.8815 9.42694 19.8327 9.09458 19.7792 8.76282C19.6456 7.93087 19.1022 7.43507 18.1595 7.33297C14.0491 6.88865 9.93722 6.88865 5.82733 7.33513C4.89139 7.4368 4.33972 7.93692 4.22321 8.7771C3.9256 10.9247 3.9256 13.0753 4.22321 15.2229C4.33923 16.0626 4.89139 16.5632 5.82733 16.6649C9.93722 17.1113 14.0496 17.1113 18.1595 16.667C19.1018 16.5649 19.6456 16.0691 19.7792 15.2372C19.8327 14.9054 19.8815 14.5731 19.9302 14.2406C19.9533 14.0832 19.9764 13.9258 20 13.7684ZM14.6683 11.9972L10.6842 14.3498V9.65707C12.0274 10.4458 13.2957 11.1908 14.6683 11.9972Z" fill="white" />
                        </svg>
                    </a>

                <?php endif; ?>
                <?php $facebook_link = get_field('facebook_link', 'option'); ?>
                <?php if ($facebook_link) : ?>
                    <a href="<?php echo esc_url($facebook_link['url']); ?>">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.4844 0H3.51562C1.57727 0 0 1.57727 0 3.51562V20.4844C0 22.4227 1.57727 24 3.51562 24H10.5938V15.5156H7.78125V11.2969H10.5938V8.4375C10.5938 6.11115 12.4861 4.21875 14.8125 4.21875H19.0781V8.4375H14.8125V11.2969H19.0781L18.375 15.5156H14.8125V24H20.4844C22.4227 24 24 22.4227 24 20.4844V3.51562C24 1.57727 22.4227 0 20.4844 0Z" fill="white" />
                        </svg>
                    </a>

                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>
</div>



<?php wp_footer(); ?>
<!--<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>-->
<!--<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>-->
<!--<script defer src="--><?php //bloginfo('template_url'); 
                            ?><!--/assets/dist/js/script.js"></script>-->
</body>

</html>