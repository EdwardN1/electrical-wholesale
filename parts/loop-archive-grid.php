<?php
/**
 * The template part for displaying a grid of posts
 *
 * For more info: http://jointswp.com/docs/grid-archive/
 */

// Adjust the amount of rows in the grid
$grid_columns = 4; ?>

<?php if( 0 === ( $wp_query->current_post  )  % $grid_columns ): ?>

    <div class="grid-x grid-margin-x grid-padding-x archive-grid" data-equalizer> <!--Begin Grid--> 

<?php endif; ?> 

		<!--Item: -->
		<div class="small-6 medium-3 large-3 cell panel" data-equalizer-watch>
		
			<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">

                <style>
                    .featured-image img {
                        max-height: 300px;
                        height: auto;
                        width: auto;
                    }
                    .featured-image {
                        min-height: 300px;
                    }
                </style>
				<section class="featured-image" itemprop="text">
					<?php the_post_thumbnail('full'); ?>
				</section> <!-- end article section -->
			
				<header class="article-header">
					<h3 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                            <?php
                            $title= get_the_title();
                            if (str_word_count($title, 0) > 5) {
                                $words = str_word_count($title, 2);
                                $pos = array_keys($words);
                                $title = substr($title, 0, $pos[5]) . '...';
                            }
                            echo $title; ?>
                        </a></h3>
					<?php //get_template_part( 'parts/content', 'byline' ); ?>
				</header> <!-- end article header -->	
								
				<section class="entry-content" itemprop="text">
					<?php
                    ob_start();
                    the_content();
                    $content = ob_get_contents();
                    ob_end_clean();
                    if (str_word_count($content, 0) > 50) {
                        $words = str_word_count($content, 2);
                        $pos = array_keys($words);
                        $content = substr($content, 0, $pos[50]) . '...';
                    }
                    echo $content; ?>
				</section> <!-- end article section -->
								    							
			</article> <!-- end article -->
			
		</div>

<?php if( 0 === ( $wp_query->current_post + 1 )  % $grid_columns ||  ( $wp_query->current_post + 1 ) ===  $wp_query->post_count ): ?>

   </div>  <!--End Grid --> 

<?php endif; ?>

