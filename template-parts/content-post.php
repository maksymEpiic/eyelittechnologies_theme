<section class="breadcrumbs">
    <ul>
        <li><a href="/">Home</a> / </li>
        <li><a href="/blog/">Blog</a> / </li>
        <li><span><?php echo get_the_title(); ?></span></li>

    </ul>
</section>
<section class="post">
<!--    --><?php //eyelittechnologies_theme_post_thumbnail(); ?>
    <div class="post_header">
        <div class="title">
<!--            --><?php //the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            <div class="date">
                <?php the_date("m.d.Y"); ?>
            </div>
        </div>



    </div>
    <div class="content">
        <?php
            $top_text = get_field('top_text');
            $top_image = get_field('top_image'); // массив
        ?>
            <?php if ( $top_text && $top_image ) : ?>
                <h1 class="page-title"><?php the_title(); ?></h1>

                <div class="blog_top_content">
                    <div class="blog_top_left">
                        <?php echo wp_kses_post( $top_text ); ?>
                    </div>
                    <div class="blog_top_right" style="background-image: url('<?php echo esc_url( $top_image['url'] ); ?>');"></div>
                </div>
            <?php endif; ?>
        <?php
		the_content(); ?>
    </div>
</section>