<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package eyelittechnologies
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function eyelittechnologies_theme_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'eyelittechnologies_theme_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function eyelittechnologies_theme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'eyelittechnologies_theme_pingback_header' );


/**
 * Enqueue scripts and styles.
 */

function enqueue_versioned_style( $handle, $src, $deps = array(), $media = 'all' )
{
    wp_enqueue_style( $handle, get_stylesheet_directory_uri() . $src, $deps, filemtime( get_stylesheet_directory() . $src ), $media );
}

function theme_register_style() {
    wp_enqueue_style( 'terem-style', get_stylesheet_uri() );
    enqueue_versioned_style( 'custom', '/assets/dist/css/main.css', null, 'all' );

}
add_action( 'wp_enqueue_scripts', 'theme_register_style' );



function terem_scripts() {
   //wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array('jquery'), '1.0.0', true );
   wp_enqueue_script( 'slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '1.0.0', true );

   wp_enqueue_script( 'custom', get_stylesheet_directory_uri() . '/assets/dist/js/script.js', array( 'jquery'), _S_VERSION, true );
    wp_localize_script( 'custom', 'ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'terem_scripts' );

add_action( 'admin_print_footer_scripts', 'add_sheensay_quicktags' );
function add_sheensay_quicktags() {
    add_action( 'admin_print_footer_scripts', 'appthemes_add_quicktags', 99 );
    function appthemes_add_quicktags() {
        if ( ! wp_script_is('quicktags') )
            return;

        ?>
        <script>
            document.addEventListener( 'DOMContentLoaded', function(){

                QTags.addButton( 'br', 'line break', '<br>', '', 'br', 'line break', 1 );
            } );
        </script>
        <?php
    }


}


function ajax_filter_posts() {
    // Получаем номер страницы (если не передан, устанавливаем 1)
    $paged = isset($_POST['paged']) ? intval( $_POST['paged'] ) : 1;
    $posts_per_page = 12;

    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged'          => $paged,
    );

    // Формируем tax_query, если заданы значения для таксономий
    $tax_query = array();
    if ( ! empty( $_POST['content_type'] ) && is_array( $_POST['content_type'] ) ) {
        $tax_query[] = array(
            'taxonomy' => 'content-type',
            'field'    => 'slug',
            'terms'    => array_map( 'sanitize_text_field', $_POST['content_type'] ),
        );
    }
    if ( ! empty( $_POST['industry'] ) && is_array( $_POST['industry'] ) ) {
        $tax_query[] = array(
            'taxonomy' => 'industry',
            'field'    => 'slug',
            'terms'    => array_map( 'sanitize_text_field', $_POST['industry'] ),
        );
    }
    if ( ! empty( $tax_query ) ) {
        // Если заданы оба фильтра – условие AND
        $args['tax_query'] = array_merge( array( 'relation' => 'AND' ), $tax_query );
    }
    $blog_page_id  = get_option('page_for_posts');
    $blog_page_url = get_permalink( $blog_page_id );

    $query = new WP_Query( $args );
    ob_start();

    if ( $query->have_posts() ) : ?>
        <div class="posts-list">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="blog_post_item">
                    <div class="own_wrap">
                        <div class="loop_post_image">
                            <?php echo get_the_post_thumbnail( get_the_ID(), 'medium', [
                                'class' => 'blog-thumbnail',
                                'sizes' => '(max-width: 768px) 100vw, 768px'
                            ] ); ?>
                        </div>
                        <div class="loop_post_title">
                            <?php the_title('<h2>', '</h2>'); ?>
                        </div>
                        <div class="loop_post_content">
                            <?php
                            echo '<p>';
                            do_excerpt(get_the_excerpt(), 20);
                            echo '</p>';
                            ?>

                        </div>
                    </div>
                    <div class="bottom_btn">
                        <a href="<?php the_permalink(); ?>" class="btn btn_lightblue">Continue Reading</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="pagination">
            <?php
            $links_array = paginate_links( array(
                'total'      => $query->max_num_pages,
                'current'    => $paged,
                'base'       => trailingslashit( $blog_page_url ) . 'page/%#%/',
                'format'     => '',
                'prev_text'  => '<span aria-hidden="true">&lt;</span>',
                'next_text'  => '<span aria-hidden="true">&gt;</span>',
                'type'       => 'array',
            ) );

            // if ( empty($links_array) ) {
            //     return;
            // }

            $custom_links = array();
            foreach ( $links_array as $link_html ) {

                // Если элемент содержит "prev page-numbers", принудительно генерируем стрелку "Предыдущая" как ссылку
                if ( strpos( $link_html, 'prev page-numbers' ) !== false || strpos( $link_html, '&lt;' ) !== false ) {
                    $prev_page = ($paged > 1) ? $paged - 1 : 1;
                    $href = ($prev_page == 1)
                        ? trailingslashit( $blog_page_url )
                        : trailingslashit( $blog_page_url ) . 'page/' . $prev_page . '/';
                    $generated = '<li class="prev"><a href="' . esc_url( $href ) . '" tabindex="0" role="button" aria-disabled="false" aria-label="Previous page" rel="prev">&lt;</a></li>';
                    $custom_links[] = $generated;
                    continue;
                }
                // Если элемент содержит "next page-numbers", генерируем стрелку "Следующая"
                if ( strpos( $link_html, 'next page-numbers' ) !== false || strpos( $link_html, '&gt;' ) !== false ) {
                    $next_page = ($paged < $query->max_num_pages) ? $paged + 1 : $query->max_num_pages;
                    $href = trailingslashit( $blog_page_url ) . 'page/' . $next_page . '/';
                    $generated = '<li class="next"><a href="' . esc_url( $href ) . '" tabindex="0" role="button" aria-disabled="false" aria-label="Next page" rel="next">&gt;</a></li>';
                    $custom_links[] = $generated;
                    continue;
                }

                // Если элемент содержит <span>, это либо текущая страница, либо многоточие
                if ( strpos( $link_html, '<span' ) !== false ) {
                    // Если это текущая страница
                    if ( strpos( $link_html, 'current' ) !== false ) {
                        $class        = 'class="selected"';
                        $aria_current = 'aria-current="page"';
                        $rel          = 'rel="canonical"';
                        // Здесь делаем текущую страницу кликабельной, поэтому tabindex="0"
                        $tabindex     = '0';
                        if ( preg_match( '/<span[^>]*>([^<]+)<\/span>/', $link_html, $m ) ) {
                            $text = $m[1];
                        } else {
                            $text = '?';
                        }
                        $aria_label = 'aria-label="Page ' . $text . ' is your current page"';
                        // Формируем URL для текущей страницы: для 1-й страницы используем базовый URL
                        $page_num = intval( $text );
                        if ( $page_num === 1 ) {
                            $current_href = trailingslashit( $blog_page_url );
                        } else {
                            $current_href = trailingslashit( $blog_page_url ) . 'page/' . $page_num . '/';
                        }
                        $generated = '<li ' . $class . '><a href="' . esc_url( $current_href ) . '" ' . $aria_current . ' ' . $aria_label . ' ' . $rel . ' tabindex="' . $tabindex . '">' . $text . '</a></li>';
                    } else {
                        // Если это многоточие (например, "…")
                        $dots_text = strip_tags($link_html);
                        $generated = '<li><span>' . $dots_text . '</span></li>';
                    }
                } else {
                    // Элемент – это ссылка <a> (обычная числовая страница)
                    $href = '#';
                    $text = '';
                    if ( preg_match( '/href="([^"]+)"/', $link_html, $href_m ) ) {
                        $href = $href_m[1];
                    }
                    if ( preg_match( '/>([^<]+)<\/a>/', $link_html, $text_m ) ) {
                        $text = $text_m[1];
                    }
                    $aria_label = 'aria-label="Page ' . $text . '"';
                    $generated = '<li><a href="' . esc_url( $href ) . '" tabindex="0" aria-disabled="false" ' . $aria_label . '>' . $text . '</a></li>';
                }

                $custom_links[] = $generated;
            }

            // Опционально: Если необходимо добавить rel="prev" и rel="next" для соседних ссылок числовой пагинации,
            // можно найти индекс текущей страницы (по наличию aria-current) и добавить атрибуты к соседним элементам.
            $current_index = null;
            for ( $i = 0; $i < count($custom_links); $i++ ) {
                if ( strpos( $custom_links[$i], 'aria-current="page"' ) !== false ) {
                    $current_index = $i;
                    break;
                }
            }
            if ( $current_index !== null ) {
                if ( $current_index > 0 ) {
                    if ( strpos( $custom_links[$current_index - 1], '<a' ) !== false && strpos( $custom_links[$current_index - 1], 'rel="prev"' ) === false ) {
                        $custom_links[$current_index - 1] = preg_replace('/<a /', '<a rel="prev" ', $custom_links[$current_index - 1]);
                    }
                }
                if ( $current_index < count($custom_links) - 1 ) {
                    if ( strpos( $custom_links[$current_index + 1], '<a' ) !== false && strpos( $custom_links[$current_index + 1], 'rel="next"' ) === false ) {
                        $custom_links[$current_index + 1] = preg_replace('/<a /', '<a rel="next" ', $custom_links[$current_index + 1]);
                    }
                }
            }

            echo '<nav><ul role="navigation" aria-label="Pagination">';
            foreach ( $custom_links as $link ) {
                echo $link;
            }
            echo '</ul></nav>';
            ?>
        </div>
    <?php else: ?>
        <p><?php esc_html_e( 'No posts found', 'your-textdomain' ); ?></p>
    <?php
    endif;

    wp_reset_postdata();
    $content = ob_get_clean();
    echo $content;
    wp_die();
}
add_action( 'wp_ajax_filter_posts', 'ajax_filter_posts' );
add_action( 'wp_ajax_nopriv_filter_posts', 'ajax_filter_posts' );






add_action('wp_ajax_my_repeater_show_more', 'my_repeater_show_more');
add_action('wp_ajax_nopriv_my_repeater_show_more', 'my_repeater_show_more');

function my_repeater_show_more() {
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'my_repeater_field_nonce')) {
        exit;
    }
    if (!isset($_POST['post_id']) || !isset($_POST['offset'])) {
        return;
    }
    $show = 6;
    $start = $_POST['offset'];
    $end = $start+$show;
    $post_id = $_POST['post_id'];
    ob_start();
    if (have_rows('cases', $post_id)) {
        $total = count(get_field('cases', $post_id));
        $count = 0;
        while (have_rows('cases', $post_id)) {
            the_row();
            if ($count < $start) {
                $count++;
                continue;
            }
            ?>
            <div class="blog_post_item">
                <div class="case_card_top">
                    <div class="loop_post_image">
                        <?php $case_image = get_sub_field( 'case_image' ); ?>
                        <?php if ( $case_image ) : ?>
                            <img src="<?php echo esc_url( $case_image['url'] ); ?>" alt="<?php echo esc_attr( $case_image['alt'] ); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="loop_post_title">
                        <h2><?php the_sub_field( 'case_title' ); ?></h2>
                    </div>
                    <div class="loop_post_content">
                        <?php the_sub_field( 'case_text' ); ?>
                    </div>
                </div>
                <div class="lopp_post_link">
                    <?php $case_link = get_sub_field( 'case_link' ); ?>
                    <?php if ( $case_link ) : ?>
                        <a class="btn btn_lightblue" href="<?php echo esc_url( $case_link['url'] ); ?>" target="<?php echo esc_attr( $case_link['target'] ); ?>"><?php echo esc_html( $case_link['title'] ); ?></a>
                    <?php endif; ?>
                </div>

                

            </div>
            <?php
            $count++;
            if ($count == $end) {
                break;
            }
        }
    }
    $content = ob_get_clean();
    $more = false;
    if ($total > $count) {
        $more = true;
    }
    echo json_encode(array('content' => $content, 'more' => $more, 'offset' => $end));
    exit;
}

add_filter( 'the_content', 'filter_ptags_on_images' );
function filter_ptags_on_images( $content ){
    return preg_replace('~<p>(<img.*/>)</p>~', '\1', $content );
}




function do_excerpt($string, $word_limit) {
    $words = explode(' ', $string, ($word_limit + 1));
    if (count($words) > $word_limit)
        array_pop($words);
    echo implode(' ', $words).'...';
}

function ultra_navigation_markup_filter( $template, $class ) {
    return str_replace( 'h2', 'span', $template );
}
add_filter( 'navigation_markup_template', 'ultra_navigation_markup_filter', 10, 2 );





