<section class="case_study_block">
    <div class="container">
        <div class="case_study_block_wrap">
            <div class="content_side">
                <span class="pre_title">Case study</span>
                <div class="block_cs_title">
                    <h2><?php the_sub_field( 'case_study_title' ); ?></h2>
                </div>
                <div class="block_cs_content">
                    <?php the_sub_field( 'case_study_content' ); ?>
                </div>

                <?php $case_study_button = get_sub_field( 'case_study_button' ); ?>
                <?php if ( $case_study_button ) : ?>
                    <div class="block_cs_link">
                        <a class="btn btn_blue" href="<?php echo esc_url( $case_study_button['url'] ); ?>" target="<?php echo esc_attr( $case_study_button['target'] ); ?>"><?php echo esc_html( $case_study_button['title'] ); ?></a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="image_side">
                <?php $case_study_image = get_sub_field( 'case_study_image' ); ?>
                <?php if ( $case_study_image ) : ?>
                    <img src="<?php echo esc_url( $case_study_image['url'] ); ?>" alt="<?php echo esc_attr( $case_study_image['alt'] ); ?>" />
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
