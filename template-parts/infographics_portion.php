<section class="result">
    <div class="container">
        <div class="title_of_block">
            <h2><?php the_sub_field( 'infographics_title' ); ?></h2>
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