<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package eyelittechnologies
 */

get_header();
?>
    <main class="site-page">
        <section  class="site-main search_result page_hero_block mes_hero " >
            <div class="angle_bg hero"></div>
            <div class="container">

                <div class="page_header">
                    <h1>Search results</h1>
                </div>

               <?php

               $search_query = get_search_query();
               $post_array = [];
               $case_arr = [];
               $white_arr = [];
               $case_id = 821;
               $white_id = 2137;

               function search_results_hightlight($text)
               {
                   // цвета
                   $styles = 'color: rgba(104, 186, 157, 1);';

                   // только для страницы поиска
                   if (!is_search())
                       return $text;

                   $query_terms = $search_query;

                   if (empty($query_terms))
                       $query_terms = array_filter([get_query_var("s")]);

                   if (empty($query_terms))
                       return $text;

                   $n = 0;
                   foreach ($query_terms as $term) {
                       $n++;

                       $term = preg_quote($term, "/");
                       $text = preg_replace_callback("/$term/iu", function ($match) use ($styles, $n) {
                           return '<span style="' . $styles . '">' . $match[0] . '</span>';
                       }, $text);
                   }

                   return $text;
               }

               if ($search_query !== ''){



               // post search request
               $args = array(
                  's' => $search_query,
                );



                $query = new WP_Query( $args );

                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                    $query->the_post();
                        array_push($post_array, array(get_the_ID(), get_the_title(), get_the_permalink(), get_the_excerpt()));
                     }
                }

                wp_reset_postdata();


               // case search request
                if (have_rows('cases', $case_id)) {
                    $total = count(get_field('cases', $case_id));
                    $count = 0;
                    while (have_rows('cases', $case_id)) {
                         the_row();
                         $case_link = get_sub_field( 'case_link' );
                         array_push($case_arr, array($case_id, get_sub_field( 'case_title' ), esc_url( $case_link['url'] ), get_sub_field( 'case_text' )));

                    }
                }
                $testReplaceString = $search_query;
                function finderInCase($array, $needle){
                    return array_filter($array, function($v) use($needle){
                        return strpos($v, $needle) !== FALSE;

                    });
                }
                foreach ($case_arr as $value) {
                    if(finderInCase($value, $testReplaceString )){
                        array_push($post_array, $value);
                    }

                }

               // whites search request
               if (have_rows('cases', $white_id)) {
                   $total = count(get_field('cases', $white_id));
                   $count = 0;
                   while (have_rows('cases', $white_id)) {
                       the_row();

                       array_push($white_arr, array($white_id, get_sub_field( 'case_title' ), get_the_permalink($case_id), get_sub_field( 'case_text' )));

                   }
               }
               function finderInWhite($array, $needle){
                   return array_filter($array, function($v) use($needle){
                       return strpos($v, $needle) !== FALSE;

                   });
               }
               foreach ($white_arr as $value) {
                   if(finderInWhite($value, $testReplaceString )){
                       array_push($post_array, $value);
                   }

               }

                    $chuk = array_chunk($post_array, 6);

               }


               if($post_array){ ?>

            </div>
        </section><!-- #main -->
        <section class="result_section">
            <div class="container">
                <div class="search_result_wrap_header">
                    <div class="result_title">
                        <span><b><?php echo count($post_array) ?> results</b> for “<?php echo get_search_query(); ?>” request</span>
                    </div>
                </div>


                       <div class="search_result_wrap">



                   <?php
                        if(count($chuk) > 1){
                            foreach ($chuk as $key=>$ch) { ?>
                                <div class="single_wrap <?php if($key >= 1){ echo 'hide'; } ?>" data-count="<?php echo $key+1;?>" >
                                <?php foreach ($ch as $single) { ?>

                                    <div class="single_search_result">
                                        <div class="result_header">
                                            <h2><?php echo search_results_hightlight($single[1]); ?></h2>
                                        </div>
                                        <div class="result_content">
                                            <?php echo search_results_hightlight($single[3]); ?>
                                        </div>
                                        <div class="result_link">
                                            <a target="_blank" href="<?php echo $single[2] ?>">Go to page</a>
                                        </div>
                                    </div>

                                <?php } ?>
                                </div>
                           <?php }

                        } else {
                            foreach ($chuk as $key=>$ch) { ?>
                           <div class="single_wrap " data-count="<?php echo $key+1;?>" >
                               <?php foreach ($ch as $single) { ?>

                                    <div class="single_search_result">
                                        <div class="result_header">
                                            <h2><?php echo search_results_hightlight($single[1]); ?></h2>
                                        </div>
                                        <div class="result_content">
                                            <?php echo search_results_hightlight($single[3]); ?>
                                        </div>
                                        <div class="result_link">
                                            <a target="_blank" href="<?php echo $single[2] ?>">Go to page</a>
                                        </div>
                                    </div>

                           <?php } ?>
                           </div>
                         <?php }
                        }
                       if(count($chuk) > 1){ ?>

                           <div class="load_more_array">
                               <a href="#" class="btn btn_blue" data-max-pages="<?php echo count($chuk); ?>" data-page="1">Load more results</a>
                           </div>

                       <?php  }

                   ?>
                   </div>
            </div>
            <div class="angle_bg bg_right"></div>
        </section>
               <?php } else {
                   get_template_part( 'template-parts/content', 'none' );
               }


               ?>
            </div>


    </main>

<?php

get_footer();
