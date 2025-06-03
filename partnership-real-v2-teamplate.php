<?php /* Template Name: Partnership Template V2 */ ?>

<?php get_header(); ?>

<main class="site-page">

    <section class="page_hero_block mes_hero contact_hero partnership_page">
        <div class="angle_bg"></div>
        <div class="container">
            <div class="hero_wrap">
                <div class="hero_left_side">
                    <h1><?php the_field( 'side_title' ); ?></h1>
                    <div class="content">
                        <?php the_field( 'side_text' ); ?>
                    </div>
                    <div class="hs-cta-embed hs-cta-simple-placeholder hs-cta-embed-189289884498"
                         style="max-width:100%; max-height:100%; width:182px;height:50.3984375px" data-hubspot-wrapper-cta-id="189289884498">
                        <a href="https://cta-service-cms2.hubspot.com/web-interactives/public/v1/track/redirect?encryptedPayload=AVxigLJRHcu3SeXa5ZMa%2BFiUwPY1f9Mv8nNHTbpN%2FiapYV1Wdo3W1swP0VNvCiTUayXlYiS5uSnxYMy8p61FpUJhyZrv6cG5LXWm3dZdYnudjNkJ3aKnKqrwC4oiETLDLgBOW5ImlZj1LIX25M1%2Bv%2FK6vGFoTRl35hFXlc8m1iZ4NHzv0hMpqJGPTw%3D%3D&webInteractiveContentId=189289884498&portalId=48720229" target="_blank" rel="noopener" crossorigin="anonymous">
                            <img alt="View jobs" loading="lazy" src="https://no-cache.hubspot.com/cta/default/48720229/interactive-189289884498.png" style="height: 100%; width: 100%; object-fit: fill"
                                 onerror="this.style.display='none'" />
                        </a>
                    </div>


                </div>
                <div class="hero_right_side">

<!--                    <div class="form_block">-->
<!--                        --><?php //echo do_shortcode('[hubspot type="form" portal="48720229" id="de4262d6-fda8-4f51-b65c-7f8ecadbe3a6"]');  ?>
<!--                    </div>-->
                    <?php $side_image = get_field( 'side_image' ); ?>
                    <?php if ( $side_image ) : ?>
                        <div class="side_image">
                            <img src="<?php echo esc_url( $side_image['url'] ); ?>" alt="<?php echo esc_attr( $side_image['alt'] ); ?>" />
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php if ( get_field( 'onoff_block' ) == 1 ) : ?>
        <section class="additional_resources_section">
            <div class="container">
                <div class="section_title">
                    <h2><?php the_field( 'additional_resources_title' ); ?></h2>
                </div>
                <div class="additional_wrap">
                    <?php if ( have_rows( 'resurcse' ) ) : ?>
                        <?php while ( have_rows( 'resurcse' ) ) : the_row(); ?>
                            <div class="add_item">
                                <?php $resources_image = get_sub_field( 'resources_image' ); ?>
                                <?php if ( $resources_image ) : ?>
                                    <div class="add_image">
                                        <img src="<?php echo esc_url( $resources_image['url'] ); ?>" alt="<?php echo esc_attr( $resources_image['alt'] ); ?>" />
                                    </div>
                                <?php endif; ?>
                                <?php $addlink =  get_sub_field( 'resources_link' ); ?>
                                <?php if ( $addlink ) { ?>
                                    <div class="title">
                                        <a href="<?php the_sub_field( 'resources_link' ); ?>"><?php the_sub_field( 'resources_title' ); ?></a>
                                    </div>
                                <?php } else { ?>
                                    <div class="title">
                                        <span><?php the_sub_field( 'resources_title' ); ?></span>
                                    </div>
                                <?php } ?>

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




</main>
<?php get_footer(); ?>

