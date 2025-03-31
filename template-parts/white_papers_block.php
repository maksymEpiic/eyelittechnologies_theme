<section class="white_paper_block">
    <div class="container">
        <div class="white_paper_inner_wrap">
            <div class="image_side">
                <?php $white_paper_inner_block_image = get_sub_field( 'white_paper_inner_block_image' ); ?>
                <?php if ( $white_paper_inner_block_image ) : ?>
                    <img src="<?php echo esc_url( $white_paper_inner_block_image['url'] ); ?>" alt="<?php echo esc_attr( $white_paper_inner_block_image['alt'] ); ?>" />
                <?php endif; ?>
            </div>
            <div class="content_side">
                <span class="pre_title">White paper</span>
                <div class="block_cs_title">
                    <h2><?php the_sub_field( 'white_paper_inner_block_title' ); ?></h2>
                </div>
                <div class="block_cs_content">
                    <?php the_sub_field( 'white_paper_inner_block_content' ); ?>
                </div>
                <?php $white_paper_inner_button = get_sub_field( 'white_paper_inner_button' ); ?>
                <?php if ( $white_paper_inner_button ) : ?>
                    <div class="block_cs_link">
                        <a class="btn btn_green" href="<?php echo esc_url( $white_paper_inner_button['url'] ); ?>" target="<?php echo esc_attr( $white_paper_inner_button['target'] ); ?>"><?php echo esc_html( $white_paper_inner_button['title'] ); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
