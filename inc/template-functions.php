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

            if ( !empty($links_array) ) {
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
            }


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


function ajax_get_category_counts() {
    // Получаем выбранные значения таксономий из POST
    $selected_content_types = ! empty($_POST['content_type']) && is_array($_POST['content_type'])
        ? array_map('sanitize_text_field', $_POST['content_type'])
        : array();
    $selected_industries = ! empty($_POST['industry']) && is_array($_POST['industry'])
        ? array_map('sanitize_text_field', $_POST['industry'])
        : array();

    $results = array(
        'industry'     => array(), // для таксономии industry – подсчет на основе выбранных content-type
        'content_type' => array(), // для таксономии content-type – подсчет на основе выбранных industry
    );

    // 1. Подсчет для таксономии industry:
    // Если выбраны content-type, фильтруем посты по ним, иначе выбираем все посты
    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    );
    if ( ! empty( $selected_content_types ) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'content-type',
                'field'    => 'slug',
                'terms'    => $selected_content_types,
            ),
        );
    }
    $query = new WP_Query( $args );
    $post_ids = wp_list_pluck( $query->posts, 'ID' );

    // Получаем все термины таксономии industry
    $industry_terms = get_terms( array(
        'taxonomy'   => 'industry',
        'hide_empty' => false,
    ) );
    if ( ! is_wp_error( $industry_terms ) && ! empty( $industry_terms ) ) {
        foreach ( $industry_terms as $term ) {
            // Получаем ID постов, привязанных к этому термину
            $term_post_ids = get_objects_in_term( $term->term_id, 'industry' );
            // Считаем пересечение с выборкой постов (с выбранными content-type)
            $intersection = array_intersect( $post_ids, $term_post_ids );
            $results['industry'][ $term->slug ] = count( $intersection );
        }
    }

    // 2. Подсчет для таксономии content-type:
    $args2 = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    );
    if ( ! empty( $selected_industries ) ) {
        $args2['tax_query'] = array(
            array(
                'taxonomy' => 'industry',
                'field'    => 'slug',
                'terms'    => $selected_industries,
            ),
        );
    }
    $query2 = new WP_Query( $args2 );
    $post_ids2 = wp_list_pluck( $query2->posts, 'ID' );

    $content_terms = get_terms( array(
        'taxonomy'   => 'content-type',
        'hide_empty' => false,
    ) );
    if ( ! is_wp_error( $content_terms ) && ! empty( $content_terms ) ) {
        foreach ( $content_terms as $term ) {
            $term_post_ids = get_objects_in_term( $term->term_id, 'content-type' );
            $intersection = array_intersect( $post_ids2, $term_post_ids );
            $results['content_type'][ $term->slug ] = count( $intersection );
        }
    }

    wp_send_json_success( $results );
}
add_action( 'wp_ajax_get_category_counts', 'ajax_get_category_counts' );
add_action( 'wp_ajax_nopriv_get_category_counts', 'ajax_get_category_counts' );


function cta_shortcode_function($atts, $content = null) {
    return '<div class="cta_blog_block">' . do_shortcode($content) . '</div>';
}
add_shortcode('cta', 'cta_shortcode_function');

function cta_button_shortcode_function($atts) {
    $atts = shortcode_atts(array(
        'href' => '#',
        'text' => 'Click here'
    ), $atts);
    return '<a target="_blank" class="btn_green btn" href="' . esc_url($atts['href']) . '">' . esc_html($atts['text']) . '</a>';
}
add_shortcode('cta_button', 'cta_button_shortcode_function');

function cta_title_shortcode_function($atts, $content = null) {
    return '<span class="cta_title">' . do_shortcode($content) . '</span>';
}
add_shortcode('cta_title', 'cta_title_shortcode_function');

function cta_subtitle_shortcode_function($atts, $content = null) {
    return '<span class="cta_subtitle">' . do_shortcode($content) . '</span>';
}
add_shortcode('cta_subtitle', 'cta_subtitle_shortcode_function');

function add_mce_buttons($buttons) {
    array_push($buttons, "cta_shortcode_button", "cta_btn_shortcode_button", "cta_title_shortcode_button", "cta_subtitle_shortcode_button");
    return $buttons;
}
add_filter("mce_buttons", "add_mce_buttons");

function add_mce_plugins($plugin_array) {
    $plugin_array['cta_shortcode_button'] = get_template_directory_uri() . '/assets/dist/js/script.js';
    $plugin_array['cta_btn_shortcode_button'] = get_template_directory_uri() . '/assets/dist/js/script.js';
    $plugin_array['cta_title_shortcode_button'] = get_template_directory_uri() . '/assets/dist/js/script.js';
    $plugin_array['cta_subtitle_shortcode_button'] = get_template_directory_uri() . '/assets/dist/js/script.js';
    return $plugin_array;
}
add_filter("mce_external_plugins", "add_mce_plugins");

// Отключить поддержку комментариев
function disable_comments_support() {
    // Посты
    remove_post_type_support('post', 'comments');
    // Страницы
    remove_post_type_support('page', 'comments');
}
add_action('init', 'disable_comments_support');

// Удалить комментарии из админки
function disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'disable_comments_admin_menu');

// Отключить комментарии на фронтенде
function disable_comments_template() {
    return false;
}
add_filter('comments_open', 'disable_comments_template', 20, 2);
add_filter('pings_open', 'disable_comments_template', 20, 2);


add_action('wpcf7_before_send_mail', 'cf7_multi_form_hubspot_log');

function cf7_multi_form_hubspot_log($contact_form) {
    $form_id = $contact_form->id();

    // Конфигурация форм
    $forms = [
        3934 => [
            'name'     => 'Contact Us',
            'portalId' => '48720229',
            'formId'   => '96352238-965e-44f6-9dac-eeb5867f0ab4',
            'fields'   => [
                'email'     => 'email',
                'firstname' => 'first_name',
                'lastname'  => 'last_name',
                'message'   => 'message',
            ]
        ],
        // можно добавить другие формы по аналогии
    ];

    if (!isset($forms[$form_id])) return;

    $submission = WPCF7_Submission::get_instance();
    if (!$submission) return;

    $data = $submission->get_posted_data();
    $form_config = $forms[$form_id];

    // Подготовка полей для HubSpot
    $fields = [];
    foreach ($form_config['fields'] as $hs_name => $cf7_name) {
        $fields[] = [
            'name'  => $hs_name,
            'value' => sanitize_text_field($data[$cf7_name] ?? '')
        ];
    }

    // Получение context из скрытого поля (если есть)
    $context = [
        'pageUri'  => $_SERVER['HTTP_REFERER'] ?? '',
        'pageName' => get_the_title(),
    ];

    if (!empty($data['hubspot_context'])) {
        $decoded = json_decode(stripslashes($data['hubspot_context']), true);
        if (is_array($decoded)) {
            // Только разрешённые поля
            $allowed = ['hutk', 'pageUri', 'pageName', 'referrer'];
            $context = array_intersect_key($decoded, array_flip($allowed));
        }
    }

    $payload = [
        'fields'  => $fields,
        'context' => $context,
    ];

    $endpoint = "https://api.hsforms.com/submissions/v3/integration/submit/{$form_config['portalId']}/{$form_config['formId']}";

    $response = wp_remote_post($endpoint, [
        'headers' => ['Content-Type' => 'application/json'],
        'body'    => json_encode($payload),
    ]);

    $response_code = wp_remote_retrieve_response_code($response);
    $response_body = wp_remote_retrieve_body($response);
    $response_json = json_decode($response_body, true);

    if (is_wp_error($response)) {
        $status = 'WP_ERROR';
        $hubspot_message = $response->get_error_message();
    } elseif ($response_code !== 200) {
        $status = $response_json['errorType'] ?? 'UNKNOWN_ERROR';
        $hubspot_message = $response_json['message'] ?? 'No message from HubSpot';
    } else {
        $status = 'SUCCESS';
        $hubspot_message = $response_json['inlineMessage'] ?? 'Form submitted successfully.';
    }

    // Логирование в CSV
    $upload_dir = wp_upload_dir();
    $log_dir = $upload_dir['basedir'] . '/hubspot-logs/';
    wp_mkdir_p($log_dir);

    $log_file = $log_dir . "form-{$form_id}.csv";
    $log_row = [
        date('Y-m-d H:i:s'),
        $status,
        json_encode($data, JSON_UNESCAPED_UNICODE),
        json_encode($payload, JSON_UNESCAPED_UNICODE),
        $response_body
    ];

    $handle = fopen($log_file, 'a');
    fputcsv($handle, $log_row);
    fclose($handle);
}


add_action('admin_menu', 'cf7_hubspot_logs_admin_page');
function cf7_hubspot_logs_admin_page() {
    add_menu_page(
        'HubSpot Logs',
        'HubSpot Forms',
        'manage_options',
        'hubspot-forms-log',
        'cf7_hubspot_render_admin_tabs',
        'dashicons-feedback',
        25
    );
}

function cf7_hubspot_render_admin_tabs() {
    $forms = [
        3934 => 'Contact Us',
        //456 => 'Обратная связь',
    ];

    $active_tab = $_GET['tab'] ?? array_key_first($forms);

    echo '<div class="wrap"><h1>HubSpot Form Submission Logs</h1>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach ($forms as $id => $label) {
        $active = ($active_tab == $id) ? ' nav-tab-active' : '';
        echo '<a href="?page=hubspot-forms-log&tab=' . $id . '" class="nav-tab' . $active . '">' . esc_html($label) . '</a>';
    }
    echo '</h2>';

    $upload_dir = wp_upload_dir();
    $log_file = $upload_dir['basedir'] . "/hubspot-logs/form-{$active_tab}.csv";

    if (!file_exists($log_file)) {
        echo '<p>There is no data for the selected form.</p></div>';
        return;
    }

    $rows = array_map('str_getcsv', file($log_file));
    $clear_url = wp_nonce_url(admin_url("admin.php?page=hubspot-forms-log&tab={$active_tab}&action=clear"), 'cf7hubspot_clear');
    $download_url = wp_nonce_url(admin_url("admin.php?page=hubspot-forms-log&tab={$active_tab}&action=download"), 'cf7hubspot_download');

    echo '<p style="margin-bottom: 15px;">';
    echo '<a href="' . esc_url($download_url) . '" class="button button-primary">Download CSV</a> ';
    echo '<a href="' . esc_url($clear_url) . '" class="button button-danger" onclick="return confirm(\'Вы точно хотите очистить лог?\')">Clear log</a>';
    echo '</p>';

    echo '<table class="widefat"><thead>
        <tr>
            <th>Date</th>
            <th>Status</th>
            <th>Message</th>
            <th>HubSpot Response</th>
        </tr>
      </thead><tbody>';

    foreach ($rows as $row) {
        $date     = $row[0] ?? '';
        $status   = $row[1] ?? '';
        $message  = $row[2] ?? '';
        $rawResp  = $row[4] ?? '{}';

        $hubspot_response = json_decode($rawResp, true);

        // Если есть errorType — используем его как статус
        if (is_array($hubspot_response['errors'][0] ?? null)) {
            $status = $hubspot_response['errors'][0]['errorType'] ?? $status;
        }

        // Если message в CSV не сохранён — попробуем достать из ответа
        if (!$message && is_array($hubspot_response) && !empty($hubspot_response['message'])) {
            $message = $hubspot_response['message'];
        }

        $row_class = $status !== 'SUCCESS' ? 'error' : '';

        echo '<tr class="' . esc_attr($row_class) . '">';
        echo '<td><strong>' . esc_html($date) . '</strong></td>';
        echo '<td><span class="cf7-status cf7-' . strtolower($status) . '">' . esc_html($status) . '</span></td>';
        echo '<td>';
        $form_data = json_decode($message, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($form_data)) {
            echo '<table class="cf7-subtable">';
            foreach ($form_data as $key => $value) {
                if (is_array($value)) {
                    echo '<tr><td>' . esc_html($key) . '</td><td><pre>' . esc_html(json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) . '</pre></td></tr>';
                } else {
                    echo '<tr><td>' . esc_html($key) . '</td><td>' . esc_html($value) . '</td></tr>';
                }
            }
            echo '</table>';
        } else {
            echo esc_html($message ?: '-');
        }

        echo '</td>';

        echo '<td><table class="cf7-subtable">';
        foreach ($hubspot_response as $key => $value) {
            if (is_array($value)) {
                echo '<tr><td><strong>' . esc_html($key) . '</strong></td><td><pre>' . esc_html(json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)) . '</pre></td></tr>';
            } else {
                echo '<tr><td><strong>' . esc_html($key) . '</strong></td><td>' . esc_html($value) . '</td></tr>';
            }
        }
        echo '</table></td>';
        echo '</tr>';
    }

    echo '</tbody></table></div>';
}

add_action('admin_head', 'cf7_hubspot_logs_styles');
function cf7_hubspot_logs_styles() {
    if (!isset($_GET['page']) || $_GET['page'] !== 'hubspot-forms-log') return;
    ?>
    <style>
        .cf7-status {
            padding: 3px 6px;
            border-radius: 4px;
            color: #fff;
            font-weight: bold;
        }
        .cf7-success { background-color: #46b450; }
        .cf7-blocked_email,
        .cf7-error,
        .cf7-unknown_error { background-color: #dc3232; }
        .cf7-subtable td {
            padding: 2px 6px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }
        .cf7-subtable {
            width: 100%;
            font-size: 13px;
            margin: 0;
            border-collapse: collapse;
        }
        details summary {
            cursor: pointer;
            font-weight: bold;
            color: #0073aa;
            margin-bottom: 5px;
        }
        details pre {
            background: #f6f7f7;
            padding: 10px;
            margin: 0;
            font-size: 12px;
            line-height: 1.4;
            overflow-x: auto;
            border: 1px solid #ccd0d4;
        }
        .widefat{
            border-collapse: collapse;
        }
        .widefat th:nth-child(1){
            width: 150px;
        }
        .widefat th:nth-child(2){
            width: 150px;
        }
        .widefat th:nth-child(3){
            width: 390px;
        }

        .widefat td {
            vertical-align: middle;
            border: 1px solid lightgray;
        }
        .widefat td:first-child {
            white-space: nowrap;
        }
        .error {
            background: #fff0f0;
        }
    </style>
    <?php
}

add_action('admin_init', 'cf7_hubspot_logs_handle_actions');

function cf7_hubspot_logs_handle_actions() {
    if (!is_admin() || !current_user_can('manage_options')) return;
    if (!isset($_GET['page']) || $_GET['page'] !== 'hubspot-forms-log') return;

    // Очистка
    if (isset($_GET['action'], $_GET['tab']) && $_GET['action'] === 'clear' && check_admin_referer('cf7hubspot_clear')) {
        $form_id = intval($_GET['tab']);
        $upload_dir = wp_upload_dir();
        $log_file = $upload_dir['basedir'] . "/hubspot-logs/form-{$form_id}.csv";
        if (file_exists($log_file)) {
            unlink($log_file);
            add_action('admin_notices', function() {
                echo '<div class="notice notice-success is-dismissible"><p>The log has been cleared successfully.</p></div>';
            });
        }
    }

    // Скачать CSV
    if (isset($_GET['action'], $_GET['tab']) && $_GET['action'] === 'download' && check_admin_referer('cf7hubspot_download')) {
        $form_id = intval($_GET['tab']);
        $upload_dir = wp_upload_dir();
        $log_file = $upload_dir['basedir'] . "/hubspot-logs/form-{$form_id}.csv";
        if (file_exists($log_file)) {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="hubspot-form-' . $form_id . '.csv"');
            readfile($log_file);
            exit;
        }
    }
}

add_action('admin_menu', function () {
    add_submenu_page(
        'hubspot-forms-log', // slug родительской страницы
        'Domains blocked',
        'Domains blocked',
        'manage_options',
        'cf7-blocked-domains',
        'cf7_blocked_domains_page'
    );
});


function cf7_blocked_domains_page() {
    if (isset($_POST['cf7_blocked_domains'])) {
        check_admin_referer('cf7_blocked_domains_save');
        update_option('cf7_blocked_domains_list', sanitize_textarea_field($_POST['cf7_blocked_domains']));
        echo '<div class="updated"><p>The list has been updated.</p></div>';
    }

    $list = get_option('cf7_blocked_domains_list', '');

    echo '<div class="wrap">';
    echo '<h1>Domain Blocking for CF7</h1>';
    echo '<form method="post">';
    wp_nonce_field('cf7_blocked_domains_save');
    echo '<textarea name="cf7_blocked_domains" rows="10" cols="50" class="large-text code" placeholder="One domain per line...">' . esc_textarea($list) . '</textarea>';
    echo '<p><input type="submit" class="button button-primary" value="Сохранить"></p>';
    echo '</form>';
    echo '</div>';
}

add_filter('wpcf7_validate_email*', 'cf7_check_blacklisted_domains', 20, 2);
add_filter('wpcf7_validate_email', 'cf7_check_blacklisted_domains', 20, 2);

function cf7_check_blacklisted_domains($result, $tag) {
    $tag_name = $tag->name;
    $submission = WPCF7_Submission::get_instance();
    if (!$submission) return $result;

    $data = $submission->get_posted_data();
    $email = $data[$tag_name] ?? '';

    $blocked_raw = get_option('cf7_blocked_domains_list', '');
    $blocked = array_map('trim', explode("\n", strtolower($blocked_raw)));

    if (!empty($email)) {
        $email_domain = strtolower(substr(strrchr($email, "@"), 1));
        if (in_array($email_domain, $blocked)) {
            $result->invalidate($tag, "Email domains like @$email_domain are not allowed.");
        }
    }

    return $result;
}