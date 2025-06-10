<?php /* Template Name: APS Template */ ?>

<?php get_header(); ?>

<main class="site-page modern_page ">
    <?php $hero_image = get_field( 'hero_image' ); ?>

    <section class="page_hero_block industry_hero mes_hero aps-hero" style="background-image: url(<?php echo esc_url( $hero_image['url'] ); ?>)">
        <div class="container">
            <div class="hero_wrap">
                <div class="banner_content">
                    <?php the_field( 'hero_title' ); ?>

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
                        <a class="btn btn_bordered" href="<?php echo esc_url( $banner_demo_button['url'] ); ?>" target="<?php echo esc_attr( $banner_demo_button['target'] ); ?>"><?php echo esc_html( $banner_demo_button['title'] ); ?></a>
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

    <?php if ( get_field( 'show_infographics_portion' ) == 1 ) : ?>
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
    <?php else : ?>
        <?php // echo 'false'; ?>
    <?php endif; ?>

    <section class="capabilities aps_capabilities">
        <div class="hex top"></div>
        <div class="container">
            <div class="capabilities_title">
                <?php the_field( 'key_features_title' ); ?>
            </div>
            <div class="capabilities_wrap">
                <?php if ( have_rows( 'key_features_items' ) ) : ?>
                    <?php while ( have_rows( 'key_features_items' ) ) : the_row(); ?>
                        <div class="capabilities_item">
                            <div class="capabilities_item_ico">
                                <?php $capabilities_item_icon = get_sub_field( 'capabilities_item_icon' ); ?>
                                <?php if ( $capabilities_item_icon ) : ?>
                                    <img src="<?php echo esc_url( $capabilities_item_icon['url'] ); ?>" alt="<?php echo esc_attr( $capabilities_item_icon['alt'] ); ?>" />
                                <?php endif; ?>
                            </div>
                            <div class="capabilities_item_title">
                                <span><?php the_sub_field( 'item_title' ); ?></span>
                            </div>
                            <div class="capabilities_item_text">
                                <p><?php the_sub_field( 'item_text' ); ?></p>
                            </div>
                        </div>

                    <?php endwhile; ?>
                <?php else : ?>
                    <?php // No rows found ?>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <section class="real_result">
        <div class="container">
            <div class="block_title">
                <?php the_field( 'result_title' ); ?>
                <span class="subtitle"><?php the_field( 'result_block_image_copy' ); ?></span>
            </div>
            <div class="result_wrap <?php if ( get_field( 'result_items_witout_text' ) == 1 ) { echo 'without_text';} ?>">

                    <?php if ( have_rows( 'result_items' ) ) : ?>
                        <?php while ( have_rows( 'result_items' ) ) : the_row(); ?>
                            <div class="result_inner_item">
                                <div class="item_ico">
                                    <?php $industry_item_icon = get_sub_field( 'item_ico' ); ?>
                                    <?php if ( $industry_item_icon ) : ?>
                                        <img src="<?php echo esc_url( $industry_item_icon['url'] ); ?>" alt="<?php echo esc_attr( $industry_item_icon['alt'] ); ?>" />
                                    <?php endif; ?>
                                </div>
                                <div class="item_content">
                                    <div class="item_title">
                                        <span><?php the_sub_field( 'item_title' ); ?></span>
                                    </div>
                                    <div class="item_text">
                                        <p><?php the_sub_field( 'item_text' ); ?></p>
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

    <?php if ( get_field( 'trusted_by_show_block' ) == 1 ) : ?>

        <?php $trusted_by_leads_background_image = get_field( 'trusted_by_leads_background_image' ); ?>

        <section class="trusted_by_leads" style="background-image: url(<?php echo esc_url( $trusted_by_leads_background_image['url'] ); ?>)">
            <div class="container">
                <div class="block_title">
                    <?php the_field( 'trusted_by_leads_title' ); ?>
                </div>
                <div class="content_block">
                    <div class="quote_block">
                        <?php the_field( 'trusted_by_leads_quotes_block' ); ?>
                    </div>
                    <div class="leaders_logos">
                        <?php $trusted_by_leads_logos_urls = get_field( 'trusted_by_leads_logos' ); ?>
                        <?php if ( $trusted_by_leads_logos_urls ) : ?>
                            <?php foreach ( $trusted_by_leads_logos_urls as $trusted_by_leads_logos_url ): ?>
                                <div class="leaders_logos_item">
                                    <img src="<?php echo esc_url( $trusted_by_leads_logos_url ); ?>" />
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php else : ?>
        <?php // echo 'false'; ?>
    <?php endif; ?>




<!--    --><?php //if ( get_field( '_show_case_study_block' ) == 1 ) : ?>
        <section class="case_study_block">
            <div class="container">
                <div class="case_study_block_wrap">
                    <div class="image_side">
                        <?php $case_study_image = get_field( '_case_study_image' ); ?>
                        <?php if ( $case_study_image ) : ?>
                            <img src="<?php echo esc_url( $case_study_image['url'] ); ?>" alt="<?php echo esc_attr( $case_study_image['alt'] ); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="content_side">
                        <span class="pre_title">Case study</span>
                        <div class="block_cs_title">
                            <?php the_field( '_case_study_title' ); ?>
                        </div>
                        <div class="block_cs_content">
                            <?php the_field( '_case_study_content' ); ?>
                        </div>

                        <?php $case_study_button = get_field( '_case_study_button' ); ?>
                        <?php if ( $case_study_button ) : ?>
                            <div class="block_cs_link">
                                <a class="btn btn_green" href="<?php echo esc_url( $case_study_button['url'] ); ?>" target="<?php echo esc_attr( $case_study_button['target'] ); ?>"><?php echo esc_html( $case_study_button['title'] ); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </section>
<!--    --><?php //else : ?>
<!--        --><?php //// echo 'false'; ?>
<!--    --><?php //endif; ?>


    <section class="key_compilation">
        <div class="container">
            <?php $key_compliance_title = get_field( 'key_compliance_title' ); ?>
            <?php if ( $key_compliance_title ) : ?>
            <div class="block_title">
                <h2><?php the_field( 'key_compliance_title' ); ?></h2>
            </div>
            <?php endif; ?>
            <div class="logos_wrap">
                <?php $key_compliance_logos_images = get_field( 'key_compliance_logos' ); ?>
                <?php if ( $key_compliance_logos_images ) : ?>
                    <?php foreach ( $key_compliance_logos_images as $key_compliance_logos_image ): ?>
                        <div class="logo_item">
                            <img src="<?php echo esc_url( $key_compliance_logos_image['sizes']['thumbnail'] ); ?>" alt="<?php echo esc_attr( $key_compliance_logos_image['alt'] ); ?>" />
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
            <?php $key_compliance_under_text = get_field( 'key_compliance_under_text' ); ?>
            <?php if ( $key_compliance_under_text ) : ?>
                <div class="under_text">
                    <?php the_field( 'key_compliance_under_text' ); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php if ( get_field( 'show_scheduling_block' ) == 1 ) : ?>
        <section class="scheduling">


                <div class="content_wrap">
                    <div class="content_side">
                        <?php $scheduling_title = get_field( 'scheduling_title' ); ?>
                        <?php if ( $scheduling_title ) : ?>
                        <div class="title_block">

                            <?php the_field( 'scheduling_title' ); ?>
                        </div>
                        <?php endif; ?>

                        <div class="content">
                            <?php the_field( 'scheduling_text' ); ?>
                        </div>
                    </div>
                    <div class="image">
                        <?php $scheduling_image = get_field( 'scheduling_image' ); ?>
                        <?php if ( $scheduling_image ) : ?>
                            <img src="<?php echo esc_url( $scheduling_image['url'] ); ?>" alt="<?php echo esc_attr( $scheduling_image['alt'] ); ?>" />
                        <?php endif; ?>
                    </div>

                </div>

        </section>
    <?php else : ?>
        <?php // echo 'false'; ?>
    <?php endif; ?>



    <section class="industry aps_industry">

        <div class="container">
            <div class="block_title">
                <h2><?php the_field( 'industry_title' ); ?></h2>
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

    <?php if ( get_field( 'show_white_paper_block' ) == 1 ) : ?>
        <section class="white_paper_block">
            <div class="container">

                <div class="white_paper_inner_wrap">

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
                    <div class="image_side">
                        <?php $white_paper_inner_block_image = get_field( 'white_paper_inner_block_image' ); ?>
                        <?php if ( $white_paper_inner_block_image ) : ?>
                            <img src="<?php echo esc_url( $white_paper_inner_block_image['url'] ); ?>" alt="<?php echo esc_attr( $white_paper_inner_block_image['alt'] ); ?>" />
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
        <section class="ready_banner ">
            <div class="container">
                <div class="ready_banner_wrap">
                    <div class="content_side">
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

                            <?php $request_demo_button_rs = get_field( 'request_demo_button_rs' ); ?>
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

