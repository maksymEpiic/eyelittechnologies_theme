<section class="key_compilation">
    <div class="container">
        <div class="block_title">
            <h2><?php the_sub_field( 'key_compliance_title' ); ?></h2>
        </div>
        <div class="logos_wrap">
            <?php $key_compliance_logos_images = get_sub_field( 'key_compliance_logos' ); ?>
            <?php if ( $key_compliance_logos_images ) : ?>
                <?php foreach ( $key_compliance_logos_images as $key_compliance_logos_image ): ?>
                    <div class="logo_item">
                        <img src="<?php echo esc_url( $key_compliance_logos_image['sizes']['thumbnail'] ); ?>" alt="<?php echo esc_attr( $key_compliance_logos_image['alt'] ); ?>" />
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
        <?php $key_compliance_under_text = get_sub_field( 'key_compliance_under_text' ); ?>
        <?php if ( $key_compliance_under_text ) : ?>
            <div class="under_text">
                <?php the_sub_field( 'key_compliance_under_text' ); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
