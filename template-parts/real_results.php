<section class="scheduling mesaps">
    <div class="container">
        <div class="title_block">
            <h2><?php the_sub_field( 'scheduling_title' ); ?></h2>
        </div>
        <div class="content_wrap">
            <div class="image">
                <?php $scheduling_image = get_sub_field( 'scheduling_image' ); ?>
                <?php if ( $scheduling_image ) : ?>
                    <img src="<?php echo esc_url( $scheduling_image['url'] ); ?>" alt="<?php echo esc_attr( $scheduling_image['alt'] ); ?>" />
                <?php endif; ?>
            </div>
            <div class="content">
                <?php the_sub_field( 'scheduling_text' ); ?>
            </div>

        </div>
    </div>
</section>
