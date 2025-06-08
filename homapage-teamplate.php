<?php /* Template Name: Home Template */ ?>

<?php get_header(); ?>

<main class="site-page modern_page">

    <section class="main_banner modern_banner">
        <div class="hex"></div>
        <div class="container">
            <div class="mb_wrap">
                <div class="sub_logo">
                    <span>Smart<span>er</span> manufacturing</span>
                </div>
                <?php
                $main_banner_image = get_field( 'main_banner_image' );

                ?>
                <div class="mb_inner_wrap" >
                    <div class="left_banner_wrap">
                        <div class="banner_title"><?php the_field( 'banner_title_text' ); ?></div>
                        <div class="btn_row">
                            <?php $banner_button = get_field( 'banner_button' ); ?>
                            <?php if ( $banner_button ) : ?>
                                <a class="btn btn_green" href="<?php echo esc_url( $banner_button['url'] ); ?>" target="<?php echo esc_attr( $banner_button['target'] ); ?>"><?php echo esc_html( $banner_button['title'] ); ?></a>
                            <?php endif; ?>
                            <?php $banner_demo_button = get_field( 'banner_demo_button' ); ?>
                            <?php if ( $banner_demo_button ) : ?>
                                <a class="btn btn_bordered" href="<?php echo esc_url( $banner_demo_button['url'] ); ?>" target="<?php echo esc_attr( $banner_demo_button['target'] ); ?>"><?php echo esc_html( $banner_demo_button['title'] ); ?></a>
                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="right_banner_wrap">
                        <?php $main_banner_image = get_field( 'main_banner_image' ); ?>
                        <?php if ( $main_banner_image ) : ?>
                            <img src="<?php echo esc_url( $main_banner_image['url'] ); ?>" alt="<?php echo esc_attr( $main_banner_image['alt'] ); ?>" />
                        <?php endif; ?>
                    </div>
                </div>
                <div class="trusted_banner_block">
                    <div class="trusted_wrap">
                        <div class="block_title">
                            <span><?php the_field( 'trusted_title' ); ?></span>
                        </div>
                        <div class="trusted_inner_wrap">
                            <?php $trusted_items_images = get_field( 'trusted_items' ); ?>
                            <?php if ( $trusted_items_images ) : ?>
                                <?php foreach ( $trusted_items_images as $trusted_items_image ): ?>
                                    <div class="trusted_item">
                                        <img src="<?php echo esc_url( $trusted_items_image['sizes']['large'] ); ?>" alt="<?php echo esc_attr( $trusted_items_image['alt'] ); ?>" />
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="solutions">
        <?php if ( get_field( 'onof_adexa_banner' ) == 1 ) : ?>
            <div class="adexa_banner">
                <div class="container">
                    <div class="adexa_banner_wrap <?php the_field( 'background_color' ); ?>">
                        <div class="banner_bg_inner">
                            <div class="banner_left_side">
                                <?php $adexa_banner_logo = get_field( 'adexa_banner_logo' ); ?>
                                <?php if ( $adexa_banner_logo ) : ?>
                                    <div class="banner_logo">
                                        <img src="<?php echo esc_url( $adexa_banner_logo['url'] ); ?>" alt="<?php echo esc_attr( $adexa_banner_logo['alt'] ); ?>" />
                                    </div>

                                <?php endif; ?>

                                <div class="banner_title">
                                    <?php the_field( 'adexa_banner_text' ); ?>
                                </div>
                            </div>
                            <?php $adexa_banner_link = get_field( 'adexa_banner_link' ); ?>
                            <?php if ( $adexa_banner_link ) : ?>
                                <div class="banner_btn">
                                    <a class="btn btn_white" href="<?php echo esc_url( $adexa_banner_link['url'] ); ?>" target="<?php echo esc_attr( $adexa_banner_link['target'] ); ?>"><?php echo esc_html( $adexa_banner_link['title'] ); ?></a>
                                </div>

                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <?php // echo 'false'; ?>
        <?php endif; ?>
        <div class="container">
            <div class="block_title">
                <h2><?php the_field( 'solutins_title' ); ?></h2>
            </div>
            <div class="solutions_wrap">
                <?php if ( have_rows( 'solutions_items' ) ) : ?>
                    <?php while ( have_rows( 'solutions_items' ) ) : the_row(); ?>
                        <div class="solution_item">
                            <div class="si_top">

                                <div class="item_title">
                                    <span><?php the_sub_field( 'solutions_item_title' ); ?></span>
                                </div>
                                <div class="item_description">
                                    <span><?php the_sub_field( 'solutions_button' ); ?></span>
                                </div>
                                <div class="item_btn">
                                    <?php $solutions_button_copy = get_sub_field( 'solutions_button_copy' ); ?>
                                    <?php if ( $solutions_button_copy ) : ?>
                                        <a class="btn btn_white_bordered" href="<?php echo esc_url( $solutions_button_copy['url'] ); ?>" target="<?php echo esc_attr( $solutions_button_copy['target'] ); ?>"><?php echo esc_html( $solutions_button_copy['title'] ); ?></a>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="item_ico">
                                <?php $solutions_icon = get_sub_field( 'solutions_icon' ); ?>
                                <?php if ( $solutions_icon ) : ?>
                                    <img src="<?php echo esc_url( $solutions_icon['url'] ); ?>" alt="<?php echo esc_attr( $solutions_icon['alt'] ); ?>" />
                                <?php endif; ?>
                            </div>

                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <?php // No rows found ?>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <?php if ( get_field( 'show_infographics_portion' ) == 1 ) : ?>
        <section class="result">
            <div class="hex"></div>
            <div class="container">
                <div class="title_of_block">
                    <?php the_field( 'infographics_title' ); ?>
                </div>
                <div class="result_wrap">
                    <?php if ( have_rows( 'infographics_items' ) ) : ?>
                        <?php while ( have_rows( 'infographics_items' ) ) : the_row(); ?>
                            <div class="result_item">
                                <div class="res_cout">
                                    <span><?php the_sub_field( 'amount_of_percent' ); ?></span>
                                </div>
                                <div class="res_text">
                                    <?php the_sub_field( 'item_text' ); ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <?php // No rows found ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php else : ?>
        <?php // echo 'false'; ?>
    <?php endif; ?>



    <section class="services">
        <div class="container">
            <div class="services_inner_wrap">
                <div class="services_left_side">
                    <?php the_field( 'title' ); ?>
                </div>
                <div class="services_block_bottom_wrap">
                    <div class="side_image">
                        <?php $services_section_image = get_field( 'services_section_image' ); ?>
                        <?php if ( $services_section_image ) : ?>
                            <img src="<?php echo esc_url( $services_section_image['url'] ); ?>" alt="<?php echo esc_attr( $services_section_image['alt'] ); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="services_right_side">
                        <p class="subtitle">
                            <?php the_field( 'subtitle' ); ?></p>
                        <?php if ( have_rows( 'services' ) ) : ?>
                            <?php while ( have_rows( 'services' ) ) : the_row(); ?>
                                <div class="services_item">
                                    <div class="si_ico">
                                        <?php $sevrices_icon = get_sub_field( 'sevrices_icon' ); ?>
                                        <?php if ( $sevrices_icon ) : ?>
                                            <img src="<?php echo esc_url( $sevrices_icon['url'] ); ?>" alt="<?php echo esc_attr( $sevrices_icon['alt'] ); ?>" />
                                        <?php endif; ?>
                                    </div>
                                    <div class="si_content">
                                        <div class="si_title">
                                            <span><?php the_sub_field( 'services_title' ); ?></span>
                                        </div>
                                        <div class="si_text">
                                            <p><?php the_sub_field( 'services_text' ); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <?php // No rows found ?>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="case_home_block">
        <div class="container">
            <div class="block_title">
                <?php the_field( 'case_study_block_title' ); ?>
            </div>
            <div class="case_home_block_wrap">
                <?php if ( have_rows( 'case_studys' ) ) : ?>
                    <?php while ( have_rows( 'case_studys' ) ) : the_row(); ?>
                        <div class="case_home_block_item">
                            <div class="ri_top">
                                <div class="laib">
                                    <span>Case study</span>
                                </div>
                                <div class="item_title">
                                    <h3>
                                        <?php the_sub_field( 'case_title' ); ?>
                                    </h3>
                                </div>
                                <div class="item_content">
                                    <?php the_sub_field( 'case_content' ); ?>

                                </div>
                            </div>
                            <div class="ri_bottom">
                                <?php $case_link = get_sub_field( 'case_link' ); ?>
                                <?php if ( $case_link ) : ?>
                                    <a class="btn btn_grey" href="<?php echo esc_url( $case_link['url'] ); ?>" target="<?php echo esc_attr( $case_link['target'] ); ?>"><?php echo esc_html( $case_link['title'] ); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>



                    <?php endwhile; ?>
                <?php else : ?>
                    <?php // No rows found ?>
                <?php endif; ?>


            </div>
            <?php $case_study_block_link = get_field( 'case_study_block_link' ); ?>
            <?php if ( $case_study_block_link ) : ?>
                <div class="case_home_block_btn">
                    <a class="btn_green btn" href="<?php echo esc_url( $case_study_block_link['url'] ); ?>" target="<?php echo esc_attr( $case_study_block_link['target'] ); ?>"><?php echo esc_html( $case_study_block_link['title'] ); ?></a>
                </div>
            <?php endif; ?>

        </div>
    </section>

    <section class="industry">
        <div class="hex"></div>
        <div class="container">
            <div class="block_animation">
                <div class="anim_item">
                    <?php $industry_image_animate = get_field( 'industry_image_animate' ); ?>
                    <?php if ( $industry_image_animate ) : ?>
                        <img class="anim_img" src="<?php echo esc_url( $industry_image_animate['url'] ); ?>" alt="<?php echo esc_attr( $industry_image_animate['alt'] ); ?>" />
                    <?php endif; ?>
                    <div class="animdots">
                        <span class="dot aeroplace" data-trigger="aeroplace"><span class="midle_c"><span class="small_c"></span></span></span>
                        <span class="dot medical" data-trigger="medical"><span class="midle_c"><span class="small_c"></span></span></span>
                        <span class="dot semiconductor" data-trigger="semiconductor"><span class="midle_c"><span class="small_c"></span></span></span>
                        <span class="dot battery" data-trigger="battery"><span class="midle_c"><span class="small_c"></span></span></span>
                        <span class="dot food" data-trigger="food"><span class="midle_c"><span class="small_c"></span></span></span>
                        <span class="dot automative" data-trigger="automative"><span class="midle_c"><span class="small_c"></span></span></span>
                    </div>
                    <div class="animdescript">
                        <div class="descrip aeroplace">
                            <div class="head">
                                <span class="ico">
                                    <svg width="24" height="18" viewBox="0 0 24 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.7459 0.835354C18.9615 1.1647 17.9973 1.5865 16.9227 2.09003C14.2462 0.978184 9.35633 -0.517411 5.80352 1.4803C5.49997 1.65098 5.32545 1.93085 5.32744 2.249C5.32939 2.64577 5.33388 3.4488 9.77565 5.96875C8.7587 6.60566 7.73299 7.2831 6.70624 7.99919L6.14633 7.73318C4.9858 7.18355 3.63879 7.14032 2.448 7.61587L0.33898 8.45669C0.166608 8.52536 0.0426805 8.67364 0.0090893 8.85093C-0.0245019 9.02823 0.0362002 9.21145 0.171531 9.33552L5.96672 14.6617C6.11974 14.8029 6.34246 14.8446 6.53851 14.7712C6.57055 14.7594 9.55157 13.6284 13.2161 11.7766C13.2387 16.779 13.9754 17.1985 14.2994 17.3835C14.5813 17.5443 14.917 17.5385 15.2215 17.3672C18.7573 15.3791 19.8806 10.5613 20.2374 7.69846C21.2181 7.05367 22.0729 6.46007 22.759 5.97115C24.0124 5.076 24.3685 3.40715 23.5872 2.08923C22.8114 0.78051 21.1603 0.241443 19.7459 0.835354ZM6.47541 2.33293C9.31429 0.832445 13.2976 1.87504 15.608 2.72242C14.5891 3.22413 13.5069 3.78719 12.409 4.40452C11.8833 4.70017 11.3539 5.00888 10.8213 5.32922C7.47203 3.46961 6.6674 2.61425 6.4769 2.33332L6.47541 2.33293ZM22.1122 5.11418C21.3892 5.63004 20.4734 6.26532 19.42 6.95343C19.2874 7.04027 19.2001 7.18021 19.1828 7.33607C18.944 9.42163 18.0422 14.4366 14.7998 16.3751C14.6413 16.0652 14.2671 14.9064 14.3108 10.9007C14.3129 10.7129 14.2126 10.5372 14.0481 10.4406C13.8831 10.3431 13.6768 10.3375 13.5071 10.4255C10.2494 12.1235 7.39327 13.2886 6.46244 13.656L1.53691 9.12897L2.86195 8.60126C3.76585 8.24159 4.78885 8.27422 5.67017 8.69105L6.52286 9.09574C6.7027 9.18004 6.91161 9.16449 7.08106 9.04834C9.05931 7.65724 11.0353 6.40492 12.955 5.32551C15.7333 3.76329 18.4174 2.55248 20.1804 1.81288C21.0845 1.43223 22.1431 1.7801 22.6415 2.62095C23.1438 3.46826 22.9154 4.53981 22.1122 5.11418Z" fill="#0E3983"/>
                                    </svg>
                                </span>
                                <span class="title">Aerospace & Defense</span>
                            </div>
                            <span class="text">Precision, traceability, and security ensured</span>
                        </div>
                        <div class="descrip medical">
                            <div class="head">
                                <span class="ico">
                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.5 4H16V2.5C16 1.122 14.879 0 13.5 0H10.5C9.121 0 8 1.122 8 2.5V4H4.5C2.019 4 0 6.019 0 8.5V17.5C0 19.981 2.019 22 4.5 22H19.5C21.981 22 24 19.981 24 17.5V8.5C24 6.019 21.981 4 19.5 4ZM9 2.5C9 1.673 9.673 1 10.5 1H13.5C14.327 1 15 1.673 15 2.5V4H9V2.5ZM23 17.5C23 19.43 21.43 21 19.5 21H4.5C2.57 21 1 19.43 1 17.5V8.5C1 6.57 2.57 5 4.5 5H19.5C21.43 5 23 6.57 23 8.5V17.5ZM16 13C16 13.276 15.776 13.5 15.5 13.5H12.5V16.5C12.5 16.776 12.276 17 12 17C11.724 17 11.5 16.776 11.5 16.5V13.5H8.5C8.224 13.5 8 13.276 8 13C8 12.724 8.224 12.5 8.5 12.5H11.5V9.5C11.5 9.224 11.724 9 12 9C12.276 9 12.5 9.224 12.5 9.5V12.5H15.5C15.776 12.5 16 12.724 16 13Z" fill="#0E3983"/>
                                    </svg>
                                </span>
                                <span class="title">Medical Device</span>
                            </div>
                            <span class="text">Compliant, efficient, high-quality manufacturing</span>
                        </div>
                        <div class="descrip semiconductor">
                            <div class="head">
                                <span class="ico">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.5 7H7.5C7.22 7 7 7.22 7 7.5V16.5C7 16.78 7.22 17 7.5 17H16.5C16.78 17 17 16.78 17 16.5V7.5C17 7.22 16.78 7 16.5 7ZM16 16H8V8H16V16ZM23.5 11C23.78 11 24 10.78 24 10.5C24 10.22 23.78 10 23.5 10H22V8H23.5C23.78 8 24 7.78 24 7.5C24 7.22 23.78 7 23.5 7H22V6.5C22 4.02 19.98 2 17.5 2H17V0.5C17 0.22 16.78 0 16.5 0C16.22 0 16 0.22 16 0.5V2H14V0.5C14 0.22 13.78 0 13.5 0C13.22 0 13 0.22 13 0.5V2H11V0.5C11 0.22 10.78 0 10.5 0C10.22 0 10 0.22 10 0.5V2H8V0.5C8 0.22 7.78 0 7.5 0C7.22 0 7 0.22 7 0.5V2H6.5C4.02 2 2 4.02 2 6.5V7H0.5C0.22 7 0 7.22 0 7.5C0 7.78 0.22 8 0.5 8H2V10H0.5C0.22 10 0 10.22 0 10.5C0 10.78 0.22 11 0.5 11H2V13H0.5C0.22 13 0 13.22 0 13.5C0 13.78 0.22 14 0.5 14H2V16H0.5C0.22 16 0 16.22 0 16.5C0 16.78 0.22 17 0.5 17H2V17.5C2 19.98 4.02 22 6.5 22H7V23.5C7 23.78 7.22 24 7.5 24C7.78 24 8 23.78 8 23.5V22H10V23.5C10 23.78 10.22 24 10.5 24C10.78 24 11 23.78 11 23.5V22H13V23.5C13 23.78 13.22 24 13.5 24C13.78 24 14 23.78 14 23.5V22H16V23.5C16 23.78 16.22 24 16.5 24C16.78 24 17 23.78 17 23.5V22H17.5C19.98 22 22 19.98 22 17.5V17H23.5C23.78 17 24 16.78 24 16.5C24 16.22 23.78 16 23.5 16H22V14H23.5C23.78 14 24 13.78 24 13.5C24 13.22 23.78 13 23.5 13H22V11H23.5ZM21 17.5C21 19.43 19.43 21 17.5 21H6.5C4.57 21 3 19.43 3 17.5V6.5C3 4.57 4.57 3 6.5 3H17.5C19.43 3 21 4.57 21 6.5V17.5Z" fill="#0E3983"/>
                                    </svg>
                                </span>
                                <span class="title">Semiconductor</span>
                            </div>
                            <span class="text">Complete solutions for semiconductor production</span>
                        </div>
                        <div class="descrip battery">
                            <div class="head">
                                <span class="ico">
                                    <svg width="25" height="16" viewBox="0 0 25 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.7588 16.0005H4.75879C2.27779 16.0005 0.258789 13.9815 0.258789 11.5005V4.50049C0.258789 2.01949 2.27779 0.000488281 4.75879 0.000488281H17.7588C20.0708 0.000488281 21.9818 1.75349 22.2308 4.00049H22.7588C23.5858 4.00049 24.2588 4.67349 24.2588 5.50049V10.5005C24.2588 11.3275 23.5858 12.0005 22.7588 12.0005H22.2308C21.9808 14.2475 20.0708 16.0005 17.7588 16.0005ZM4.75879 1.00049C2.82879 1.00049 1.25879 2.57049 1.25879 4.50049V11.5005C1.25879 13.4305 2.82879 15.0005 4.75879 15.0005H17.7588C19.6888 15.0005 21.2588 13.4305 21.2588 11.5005C21.2588 11.2245 21.4828 11.0005 21.7588 11.0005H22.7588C23.0348 11.0005 23.2588 10.7765 23.2588 10.5005V5.50049C23.2588 5.22449 23.0348 5.00049 22.7588 5.00049H21.7588C21.4828 5.00049 21.2588 4.77649 21.2588 4.50049C21.2588 2.57049 19.6888 1.00049 17.7588 1.00049H4.75879ZM10.7588 13.0005H4.75879C3.93179 13.0005 3.25879 12.3275 3.25879 11.5005V4.50049C3.25879 3.67349 3.93179 3.00049 4.75879 3.00049H10.7588C11.5858 3.00049 12.2588 3.67349 12.2588 4.50049V11.5005C12.2588 12.3275 11.5858 13.0005 10.7588 13.0005ZM4.75879 4.00049C4.48279 4.00049 4.25879 4.22449 4.25879 4.50049V11.5005C4.25879 11.7765 4.48279 12.0005 4.75879 12.0005H10.7588C11.0348 12.0005 11.2588 11.7765 11.2588 11.5005V4.50049C11.2588 4.22449 11.0348 4.00049 10.7588 4.00049H4.75879Z" fill="#0E3983"/>
                                    </svg>
                                </span>
                                <span class="title">Battery & Solar</span>
                            </div>
                            <span class="text">Cost-effective, traceable quality manufacturing</span>
                        </div>
                        <div class="descrip food">
                            <div class="head">
                                <span class="ico">
                                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2780_108713)">
                                    <path d="M19.9208 13H16.5958L17.3598 7.058C17.5268 6.313 17.3478 5.545 16.8708 4.95C16.3938 4.355 15.6828 4.013 14.9198 4.013H11.9858L12.1978 2.314C12.2918 1.565 12.9308 1 13.6858 1H16.9198C17.1958 1 17.4198 0.776 17.4198 0.5C17.4198 0.224 17.1958 0 16.9198 0H13.6858C12.4278 0 11.3608 0.941 11.2058 2.19L10.9778 4.013H2.92181C2.15981 4.013 1.44981 4.354 0.972812 4.948C0.495812 5.542 0.315812 6.309 0.471812 7.003L2.00781 20.026C2.27581 22.291 4.19681 23.999 6.47681 23.999H19.9208C22.4018 23.999 24.4208 21.98 24.4208 19.499V17.499C24.4208 15.018 22.4018 12.999 19.9208 12.999V13ZM23.4208 17.5V18H20.9298C20.9248 18 20.9198 18 20.9148 18H14.9268C14.9218 18 14.9168 18 14.9108 18H10.4208V17.5C10.4208 15.57 11.9908 14 13.9208 14H19.9208C21.8508 14 23.4208 15.57 23.4208 17.5ZM19.2698 19L17.9208 19.899L16.5718 19H19.2688H19.2698ZM14.9198 5.013C15.3778 5.013 15.8038 5.218 16.0898 5.575C16.3768 5.932 16.4838 6.393 16.3758 6.885L16.2318 8H11.4868L11.8608 5.013H14.9198ZM1.75281 5.573C2.03881 5.217 2.46481 5.012 2.92181 5.012H10.8528L10.4788 7.999H1.59481L1.45781 6.836C1.35881 6.39 1.46681 5.93 1.75281 5.573ZM6.47681 23C4.70281 23 3.20881 21.671 3.00081 19.91L1.71281 9H16.1028L15.5868 13H13.9198C11.4388 13 9.41981 15.019 9.41981 17.5V19.5C9.41981 20.912 10.0738 22.174 11.0948 23H6.47681ZM19.9208 23H13.9208C11.9908 23 10.4208 21.43 10.4208 19.5V19H14.7698L17.6438 20.916C17.7278 20.972 17.8248 21 17.9208 21C18.0168 21 18.1138 20.972 18.1978 20.916L21.0718 19H23.4208V19.5C23.4208 21.43 21.8508 23 19.9208 23Z" fill="#0E3983"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_2780_108713">
                                    <rect width="24" height="24" fill="white" transform="translate(0.420898)"/>
                                    </clipPath>
                                    </defs>
                                    </svg>

                                </span>
                                <span class="title">Food & Beverage</span>
                            </div>
                            <span class="text">Traceability, quality, and efficiency improvements</span>
                        </div>
                        <div class="descrip automative">
                            <div class="head">
                                <span class="ico">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M23.669 12.001L20.789 4.082C20.118 2.239 18.35 1 16.389 1H7.611C5.65 1 3.882 2.239 3.211 4.082L0.331 12.001C0.111 12.604 0 13.236 0 13.88V15.499C0 16.89 0.822 18.084 2 18.648V20.499C2 21.877 3.121 22.999 4.5 22.999C5.879 22.999 7 21.877 7 20.499V18.999H17V20.499C17 21.877 18.121 22.999 19.5 22.999C20.879 22.999 22 21.877 22 20.499V18.648C23.178 18.084 24 16.89 24 15.499V13.88C24 13.236 23.889 12.604 23.669 12.001ZM4.15 4.424C4.677 2.974 6.069 2 7.611 2H16.388C17.93 2 19.322 2.974 19.849 4.424L21.513 9H2.486L4.15 4.424ZM6 20.5C6 21.327 5.327 22 4.5 22C3.673 22 3 21.327 3 20.5V18.949C3.165 18.973 3.329 19 3.5 19H6V20.5ZM15 18H9V17C9 16.449 9.448 16 10 16H14C14.552 16 15 16.449 15 17V18ZM21 20.5C21 21.327 20.327 22 19.5 22C18.673 22 18 21.327 18 20.5V19H20.5C20.671 19 20.835 18.973 21 18.949V20.5ZM23 15.5C23 16.878 21.879 18 20.5 18H16V17C16 15.897 15.103 15 14 15H10C8.897 15 8 15.897 8 17V18H3.5C2.121 18 1 16.878 1 15.5V13.881C1 13.583 1.037 13.29 1.095 13H3.5C3.776 13 4 12.776 4 12.5C4 12.224 3.776 12 3.5 12H1.395L2.122 10H21.877L22.604 12H20.499C20.223 12 19.999 12.224 19.999 12.5C19.999 12.776 20.223 13 20.499 13H22.904C22.962 13.289 22.999 13.583 22.999 13.881L23 15.5Z" fill="#0E3983"/>
                                    </svg>
                                </span>
                                <span class="title">Automotive & Industrial</span>
                            </div>
                            <span class="text">Efficient, compliant, high-throughput manufacturing</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block_title">
                <?php the_field( 'industry_title' ); ?>
            </div>
            <div class="industry_wrap">
                <?php if ( have_rows( 'industry_items' ) ) : ?>
                    <?php while ( have_rows( 'industry_items' ) ) : the_row(); ?>
                        <div class="industry_item">
                            <div class="item_ico">
                                <?php $icon_link = get_sub_field( 'icon_link' ); ?>
                                <?php $industry_item_icon = get_sub_field( 'industry_item_icon' ); ?>
                                <?php if ( $industry_item_icon ) : ?>
                                    <a href="<?php echo esc_url( $icon_link); ?>">
                                        <img src="<?php echo esc_url( $industry_item_icon['url'] ); ?>" alt="<?php echo esc_attr( $industry_item_icon['alt'] ); ?>" />
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="item_title">
                                <span><?php the_sub_field( 'industry_item_title' ); ?></span>
                            </div>
                            <div class="item_text">
                                <p><?php the_sub_field( 'industry_item_text' ); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <?php // No rows found ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="manufacturing">
        <div class="hex"></div>
        <div class="large-container">
            <div class="manufacturing_wrap">
                <div class="block_title">
                    <?php the_field( 'manufacturing_title' ); ?>
                </div>
                <div class="manufacturing_bottom">

                    <div class="mb_left">

                        <div class="items_wrap">
                            <?php if ( have_rows( 'manufacturing_list' ) ) : ?>
                                <?php while ( have_rows( 'manufacturing_list' ) ) : the_row(); ?>
                                    <div class="mb_list_item">

                                        <div class="side_ico">
                                            <?php $manufacturing_item_icon = get_sub_field( 'manufacturing_item_icon' ); ?>
                                            <?php if ( $manufacturing_item_icon ) : ?>
                                                <img src="<?php echo esc_url( $manufacturing_item_icon['url'] ); ?>" alt="<?php echo esc_attr( $manufacturing_item_icon['alt'] ); ?>" />
                                            <?php endif; ?>
                                        </div>
                                        <div class="side_content">
                                            <span class="title"><?php the_sub_field( 'manufacturing_item_title' ); ?></span>
                                            <p class="text"><?php the_sub_field( 'manufacturing_item_text' ); ?></p>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <?php // No rows found ?>
                            <?php endif; ?>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <?php if ( get_field( 'show_reviews' ) == 1 ) : ?>
        <section class="reviews">
            <div class="hex"></div>
            <div class="container">
                <div class="title_block">

                   <?php the_field( 'reviews_block_title' ); ?>

                </div>
            </div>
            <div class="review_slider">

                <div class="reviewSwiper">
                    <div class="swiper-wrapper">
                        <?php if ( have_rows( 'reviews' ) ) : ?>
                            <?php while ( have_rows( 'reviews' ) ) : the_row(); ?>
                                <div class="swiper-slide">
                                    <div class="review_item">
                                        <div class="review_content">
                                            <?php the_sub_field( 'reviews_text' ); ?>
                                        </div>
                                        <div class="review_author">

                                            <div class="position"><?php the_sub_field( 'reviewer_name' ); ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <?php // No rows found ?>
                        <?php endif; ?>
                    </div>
                    <div class="slider_nav">
                        <div class="slider_dots_wrap">
                            <div class="slider_arrows"></div>
                        </div>
                    </div>


                </div>

            </div>
        </section>
    <?php else : ?>
        <?php // echo 'false'; ?>
    <?php endif; ?>

    <?php if ( get_field( 'show_latest_news_block' ) == 1 ) : ?>
        <section class="latest_news">
            <div class="container">
                <div class="block_title">
                    <?php the_field( 'latest_news_block_title' ); ?>
                </div>
                <div class="news_wrap">
                    <?php if ( have_rows( 'latest_news_items' ) ) : ?>
                        <?php while ( have_rows( 'latest_news_items' ) ) : the_row(); ?>
                            <div class="news_item">
                                <div class="ni_top">
                                    <div class="news_title">
                                        <?php the_sub_field( 'news_item_title' ); ?>
                                    </div>
                                    <div class="item_text">
                                        <?php the_sub_field( 'news_item_text' ); ?>
                                    </div>
                                </div>
                                <div class="ni_bottom">
                                    <div class="item_link">
                                        <?php $news_item_link = get_sub_field( 'news_item_link' ); ?>
                                        <?php if ( $news_item_link ) : ?>
                                            <a class="btn btn_bordered" href="<?php echo esc_url( $news_item_link['url'] ); ?>" target="<?php echo esc_attr( $news_item_link['target'] ); ?>"><?php echo esc_html( $news_item_link['title'] ); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <?php // No rows found ?>
                    <?php endif; ?>



                </div>
            </div>
        </section>
    <?php else : ?>
        <?php // echo 'false'; ?>
    <?php endif; ?>



    <?php if ( get_field( 'show_latest_resources_block' ) == 1 ) : ?>
        <section class="latest_resources">
            <div class="container">
                <div class="block_title">
                    <?php the_field( 'latest_resources_block_title' ); ?>
                </div>
                <div class="resources_wrap">
                    <?php if ( have_rows( 'latest_resources_items' ) ) : ?>
                        <?php while ( have_rows( 'latest_resources_items' ) ) : the_row(); ?>
                            <div class="resources_item">
                                <div class="ni_top">
                                    <div class="resources_image">
                                        <?php $resources_image = get_sub_field( 'resources_image' ); ?>
                                        <?php if ( $resources_image ) : ?>
                                            <img src="<?php echo esc_url( $resources_image['url'] ); ?>" alt="<?php echo esc_attr( $resources_image['alt'] ); ?>" />
                                        <?php endif; ?>
                                    </div>
                                    <div class="resources_title">
                                        <?php the_sub_field( 'resources_item_title' ); ?>
                                    </div>
                                    <div class="item_text">
                                        <?php the_sub_field( 'resources_item_text' ); ?>
                                    </div>
                                </div>
                                <div class="ni_bottom">
                                    <div class="item_link">
                                        <?php $resources_item_link = get_sub_field( 'resources_item_link' ); ?>
                                        <?php if ( $resources_item_link ) : ?>
                                            <a class="btn btn_bordered" href="<?php echo esc_url( $news_item_link['url'] ); ?>" target="<?php echo esc_attr( $news_item_link['target'] ); ?>"><?php echo esc_html( $news_item_link['title'] ); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <?php // No rows found ?>
                    <?php endif; ?>



                </div>
            </div>
        </section>
    <?php else : ?>
        <?php // echo 'false'; ?>
    <?php endif; ?>






    <section class="ready_banner">
        <div class="bg">
        <div class="container">
            <div class="ready_banner_wrap">

                    <div class="block_title">
                        <?php the_field( 'redy_to_start_title' ); ?>
                    </div>
                    <div class="block_content">
                        <?php the_field( 'redy_to_start_text' ); ?>
                    </div>

                        <div class="block_link">
                            <?php $redy_to_start_button = get_field( 'redy_to_start_button' ); ?>
                            <?php if ( $redy_to_start_button ) : ?>
                                <a class="btn btn_green" href="<?php echo esc_url( $redy_to_start_button['url'] ); ?>" target="<?php echo esc_attr( $redy_to_start_button['target'] ); ?>"><?php echo esc_html( $redy_to_start_button['title'] ); ?></a>
                            <?php endif; ?>

                            <?php $request_demo_button_rs = get_field( 'request_demo_button_rs' ); ?>
                            <?php if ( $request_demo_button_rs ) : ?>
                                <a class="btn btn_bordered" href="<?php echo esc_url( $request_demo_button_rs['url'] ); ?>" target="<?php echo esc_attr( $request_demo_button_rs['target'] ); ?>"><?php echo esc_html( $request_demo_button_rs['title'] ); ?></a>
                            <?php endif; ?>
                        </div>



            </div>
        </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>

