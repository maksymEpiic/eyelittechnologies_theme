<?php /* Template Name: Partnership Template */ ?>

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
                    <?php $side_image = get_field( 'side_image' ); ?>
                    <?php if ( $side_image ) : ?>
                        <div class="side_image">
                            <img src="<?php echo esc_url( $side_image['url'] ); ?>" alt="<?php echo esc_attr( $side_image['alt'] ); ?>" />
                        </div>
                    <?php endif; ?>

                </div>
                <div class="hero_right_side">

                    <div class="form_block">
                        <?php echo do_shortcode('[hubspot type="form" portal="48720229" id="de4262d6-fda8-4f51-b65c-7f8ecadbe3a6"]');  ?>
                    </div>
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

