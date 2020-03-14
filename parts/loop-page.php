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

        <?php if (have_rows('content')) : ?>
            <?php while (have_rows('content')) : the_row(); ?>
                <?php $dataFields = ''; ?>
                <?php if (have_rows('data')) : ?>
                    <?php while (have_rows('data')) : the_row(); ?>
                        <?php
                        $dataFields .= ' data-' . get_sub_field('name');
                        $dataValue = get_sub_field('value');
                        if ($dataValue != '') {
                            $dataFields .= '="' . $dataValue . '"';
                        }
                        ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <?php // no rows found ?>
                <?php endif;
                $classNames = get_sub_field('classes');
                if ($classNames != '') {
                    $classNames = ' class="' . $classNames . '"';
                }
                $html = get_sub_field('html');

                $html = tokens($html);
                ?>
                <div id="<?php echo cssName(get_sub_field('id')); ?>"<?php echo $dataFields; ?><?php echo $classNames; ?>><?php echo $html; ?></div>
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