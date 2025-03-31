<?php /* Template Name: MES+APS Template */ ?>

<?php get_header(); ?>

    <main class="site-page">
        <?php if ( have_rows( 'page_layout' ) ): ?>
                <?php while ( have_rows( 'page_layout' ) ) : the_row(); ?>
                    <?php $rowcontent = get_row_layout(); if ( get_row_layout() == $rowcontent ) : ?>
                        <?php get_template_part('template-parts/'.$rowcontent); ?>
                    <?php endif; ?>
                <?php endwhile; ?>
        <?php else: ?>
            <?php // No layouts found ?>
        <?php endif; ?>

    </main>
 <?php get_footer(); ?>

