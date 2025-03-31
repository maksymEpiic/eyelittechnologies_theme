<section class="ready_banner ">
    <div class="container">
        <div class="ready_banner_wrap">
            <div class="content_side">
                <div class="block_title">
                    <h2><?php the_sub_field( 'ready_to_start_title' ); ?></h2>
                </div>
                <div class="block_content">
                    <?php the_sub_field( 'ready_to_start_content' ); ?>
                </div>
                <?php $ready_to_start_button = get_sub_field( 'ready_to_start_button' ); ?>
                <?php if ( $ready_to_start_button ) : ?>
                    <div class="block_link">
                        <a class="btn btn_white" href="<?php echo esc_url( $ready_to_start_button['url'] ); ?>" target="<?php echo esc_attr( $ready_to_start_button['target'] ); ?>"><?php echo esc_html( $ready_to_start_button['title'] ); ?></a>
                    </div>
                <?php endif; ?>

            </div>
            <div class="image_side">
                <?php $ready_to_start_image = get_sub_field( 'ready_to_start_image' ); ?>
                <?php if ( $ready_to_start_image ) : ?>
                    <img src="<?php echo esc_url( $ready_to_start_image['url'] ); ?>" alt="<?php echo esc_attr( $ready_to_start_image['alt'] ); ?>" />
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
