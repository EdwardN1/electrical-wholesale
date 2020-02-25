<?php
/**
 * Template part for displaying page content in page.php
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( '' ); ?> role="article" itemscope itemtype="http://schema.org/WebPage">

    <!--<header class="article-header">
		<h1 class="page-title"><?php /*the_title(); */ ?></h1>
	</header>--> <!-- end article header -->

    <section class="entry-content" itemprop="text">
		<?php the_content(); ?>
    </section> <!-- end article section -->

    <section class="acf-content-loop">
		<?php if ( have_rows( 'content' ) ) : ?>
			<?php while ( have_rows( 'content' ) ) : the_row(); ?>
                <div id="<?php echo cssName( get_sub_field( 'id' ) ); ?>"><?php the_sub_field( 'html' ); ?></div>
			<?php endwhile; ?>
		<?php else : ?>
			<?php // no rows found ?>
		<?php endif; ?>

    </section>

    <footer class="article-footer">
		<?php wp_link_pages(); ?>
    </footer> <!-- end article footer -->

	<?php comments_template(); ?>

</article> <!-- end article -->