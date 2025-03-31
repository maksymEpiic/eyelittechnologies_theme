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
		the_content(); ?>
    </div>
</section>