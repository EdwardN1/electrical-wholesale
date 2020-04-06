<?php
/**
 * Template part for displaying page content in page.php
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">

    <!--<header class="article-header">
		<h1 class="page-title"><?php /*the_title(); */ ?></h1>
	</header>--> <!-- end article header -->

    <section class="entry-content" itemprop="text">
        <div class="grid-container">
            <?php the_content(); ?>
        </div>
    </section> <!-- end article section -->

    <section class="acf-content-loop">

        <?php
        //include_once get_template_directory().'/functions/includes/inc-acf-content-loop.php';
        echo get_page_content_ex();
        ?>

    </section>

    <footer class="article-footer">
        <?php wp_link_pages(); ?>
    </footer> <!-- end article footer -->

    <?php comments_template(); ?>

</article> <!-- end article -->