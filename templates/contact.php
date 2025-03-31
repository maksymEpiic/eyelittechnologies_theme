<?php

/* Template Name: Contact us */

get_header();

?>


<section class="contact-us">
    <div class="container">
        <h1 class="contact-us__title"><?= the_field('contact_us_title'); ?></h1>
        <?php
        $contact_us_text = get_field('contact_us_text');

        if ($contact_us_text) { ?>
            <p class="contact-us__text">
                <?= $contact_us_text; ?>
            </p>
        <?php } ?>
        <div class="contact-us__form">
            <?= do_shortcode("[ninja_form id='1']") ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>