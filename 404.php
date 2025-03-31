<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package eyelittechnologies
 */

get_header();
?>

    <section class="contact-us eroore_page">
        <div class="container">
            <div class="content_wrap">
                <div class="image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/dist/images/firefly_404.png" alt="">
                </div>
                <div class="content">
                    <h1 class="contact-us__title">Page not found</h1>

                </div>

                <div class="errore_btn_wrap">
                    <a href="/" class="btn btn_green">Return to homepage</a>
                </div>
            </div>


        </div>
    </section>

<?php
get_footer();
