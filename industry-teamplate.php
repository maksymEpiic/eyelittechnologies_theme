<?php /* Template Name: Industry Template */ ?>

<?php get_header(); ?>

    <main class="site-page modern_page">
        <?php $hero_image = get_field( 'hero_image' ); ?>

        <section class="page_hero_block industry_hero mes_hero" style="background-image: url(<?php echo esc_url( $hero_image['url'] ); ?>)">
            <div class="container">
                <div class="hero_wrap">
                        <div class="banner_content">
                            <h1><?php the_field( 'hero_title' ); ?></h1>

                            <?php $hero_subtitle = get_field( 'hero_subtitle' ); ?>
                            <?php if ( $hero_subtitle ) : ?>
                                <?php the_field( 'hero_subtitle' ); ?>
                            <?php endif; ?>
                        </div>
                        <div class="banner_link_block">

                                <?php $hero_link = get_field( 'hero_link' ); ?>
                                <?php if ( $hero_link ) : ?>
                                    <a class="btn btn_green" href="<?php echo esc_url( $hero_link['url'] ); ?>" target="<?php echo esc_attr( $hero_link['target'] ); ?>"><?php echo esc_html( $hero_link['title'] ); ?></a>
                                <?php endif; ?>
                                <?php $banner_demo_button = get_field( 'hero_request_demo' ); ?>
                                <?php if ( $banner_demo_button ) : ?>
                                    <a class="btn btn_white_bordered" href="<?php echo esc_url( $banner_demo_button['url'] ); ?>" target="<?php echo esc_attr( $banner_demo_button['target'] ); ?>"><?php echo esc_html( $banner_demo_button['title'] ); ?></a>
                                <?php endif; ?>

                        </div>
                </div>
                <div class="hero_bottom_text">
                    <div class="hbt_wrap">
                        <?php the_field( 'hero_text' ); ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="industry_result">

                <div class="container">
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


        <section class="capabilities">
            <div class="hex"></div>
            <div class="container">
                <div class="capabilities_title">
                    <?php the_field( 'capabilities_title' ); ?>
                </div>
                <div class="capabilities_wrap">
                    <?php if ( have_rows( 'capabilities_items' ) ) : ?>
                        <?php while ( have_rows( 'capabilities_items' ) ) : the_row(); ?>
                            <div class="capabilities_item">
                                <div class="capabilities_item_ico">
                                    <?php $capabilities_item_icon = get_sub_field( 'capabilities_item_icon' ); ?>
                                    <?php if ( $capabilities_item_icon ) : ?>
                                        <img src="<?php echo esc_url( $capabilities_item_icon['url'] ); ?>" alt="<?php echo esc_attr( $capabilities_item_icon['alt'] ); ?>" />
                                    <?php endif; ?>
                                </div>
                                <div class="capabilities_item_title">
                            <span><?php the_sub_field( 'capabilities_item_title' ); ?></span>
                                </div>
                                <div class="capabilities_item_text">
                                    <p><?php the_sub_field( 'capabilities_item_text' ); ?></p>
                                </div>
                            </div>

                        <?php endwhile; ?>
                    <?php else : ?>
                        <?php // No rows found ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>


        <section class="key_capabilities">
            <div class="key_cap_wrap">
                <div class="key_cap_content">
                    <div class="block_title">
                        <?php the_field( 'key_capabilities_title' ); ?>
                    </div>
                    <div class="block_content">
                        <?php the_field( 'key_capabilities_content' ); ?>
                    </div>
                    <div class="btn_block">
                        <?php $key_capabilities_started_btn = get_field( 'key_capabilities_started_btn' ); ?>
                        <?php if ( $key_capabilities_started_btn ) : ?>
                            <a class="btn btn_green" href="<?php echo esc_url( $key_capabilities_started_btn['url'] ); ?>" target="<?php echo esc_attr( $key_capabilities_started_btn['target'] ); ?>"><?php echo esc_html( $key_capabilities_started_btn['title'] ); ?></a>
                        <?php endif; ?>
                        <?php $key_capabilities_demo_btn = get_field( 'key_capabilities_demo_btn' ); ?>
                        <?php if ( $key_capabilities_demo_btn ) : ?>
                            <a class="btn btn_bordered_white" href="<?php echo esc_url( $key_capabilities_demo_btn['url'] ); ?>" target="<?php echo esc_attr( $key_capabilities_demo_btn['target'] ); ?>"><?php echo esc_html( $key_capabilities_demo_btn['title'] ); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="key_cap_imag">
                    <?php $key_capabilities_image = get_field( 'key_capabilities_image' ); ?>
                    <?php if ( $key_capabilities_image ) : ?>
                        <img src="<?php echo esc_url( $key_capabilities_image['url'] ); ?>" alt="<?php echo esc_attr( $key_capabilities_image['alt'] ); ?>" />
                    <?php endif; ?>
                </div>
            </div>
        </section>


        <?php if ( get_field( 'show_white_paper_block' ) == 1 ) : ?>
            <section class="white_paper_block">
                <div class="hex"></div>
                <div class="container">
                    <div class="white_paper_block_top_title">
                        <?php the_field( 'white_paper_title' ); ?>
                        <div class="subtitle_block">
                            <?php the_field( 'white_paper_subtitle' ); ?>
                        </div>
                    </div>
                    <div class="white_paper_inner_wrap">
                        <div class="image_side">
                            <?php $white_paper_inner_block_image = get_field( 'white_paper_inner_block_image' ); ?>
                            <?php if ( $white_paper_inner_block_image ) : ?>
                                <img src="<?php echo esc_url( $white_paper_inner_block_image['url'] ); ?>" alt="<?php echo esc_attr( $white_paper_inner_block_image['alt'] ); ?>" />
                            <?php endif; ?>
                        </div>
                        <div class="content_side">
                            <span class="pre_title">White paper</span>
                            <div class="block_cs_title">
                                <?php the_field( 'white_paper_inner_block_title' ); ?>
                            </div>
                            <div class="block_cs_content">
                                <?php the_field( 'white_paper_inner_block_content' ); ?>
                            </div>
                            <?php $white_paper_inner_button = get_field( 'white_paper_inner_button' ); ?>
                            <?php if ( $white_paper_inner_button ) : ?>
                                <div class="block_cs_link">
                                    <a class="btn btn_green" href="<?php echo esc_url( $white_paper_inner_button['url'] ); ?>" target="<?php echo esc_attr( $white_paper_inner_button['target'] ); ?>"><?php echo esc_html( $white_paper_inner_button['title'] ); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="hex"></div>
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


        <?php if ( get_field( 'show_ready_to_start' ) == 1 ) : ?>
            <section class="ready_banner">
                <div class="bg">
                    <div class="container">
                        <div class="ready_banner_wrap">

                            <div class="block_title">
                                <?php the_field( 'ready_to_start_title' ); ?>
                            </div>
                            <div class="block_content">
                                <?php the_field( 'ready_to_start_content' ); ?>
                            </div>

                            <div class="block_link">
                                <?php $redy_to_start_button = get_field( 'ready_to_start_button' ); ?>
                                <?php if ( $redy_to_start_button ) : ?>
                                    <a class="btn btn_green" href="<?php echo esc_url( $redy_to_start_button['url'] ); ?>" target="<?php echo esc_attr( $redy_to_start_button['target'] ); ?>"><?php echo esc_html( $redy_to_start_button['title'] ); ?></a>
                                <?php endif; ?>

                                <?php $request_demo_button_rs = get_field( 'ready_request_demo_button' ); ?>
                                <?php if ( $request_demo_button_rs ) : ?>
                                    <a class="btn btn_bordered" href="<?php echo esc_url( $request_demo_button_rs['url'] ); ?>" target="<?php echo esc_attr( $request_demo_button_rs['target'] ); ?>"><?php echo esc_html( $request_demo_button_rs['title'] ); ?></a>
                                <?php endif; ?>
                            </div>



                        </div>
                    </div>
                </div>
            </section>
        <?php else : ?>
            <?php // echo 'false'; ?>
        <?php endif; ?>


    </main>
 <?php get_footer(); ?>

