<?php
/**
 * Block template file:
 *
 * Acfgbcblockgenericsection Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'acfgbcblockgenericsection-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-acfgbcblockgenericsection';
if( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<style type="text/css">
    <?php echo '#' . $id; ?> {
    /* Add styles that use ACF values here */
    }
   
</style>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <?php if ( have_rows( 'content' ) ) : ?>
        <?php while ( have_rows( 'content' ) ) : the_row(); ?>
            <?php the_sub_field( 'id' ); ?>
            <?php the_sub_field( 'classes' ); ?>
            <pre><code><?php echo esc_html( get_sub_field( 'html' ) ); ?></code></pre>
            <pre><code><?php echo esc_html( get_sub_field( 'cssscss' ) ); ?></code></pre>
            <pre><code><?php echo esc_html( get_sub_field( 'jquery' ) ); ?></code></pre>
            <?php if ( have_rows( 'data' ) ) : ?>
                <?php while ( have_rows( 'data' ) ) : the_row(); ?>
                    <?php the_sub_field( 'name' ); ?>
                    <?php the_sub_field( 'value' ); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
            <?php if ( have_rows( 'text_tokens' ) ) : ?>
                <?php while ( have_rows( 'text_tokens' ) ) : the_row(); ?>
                    <?php the_sub_field( 'name' ); ?>
                    <?php the_sub_field( 'content' ); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
            <?php if ( have_rows( 'wysiwyg_tokens' ) ) : ?>
                <?php while ( have_rows( 'wysiwyg_tokens' ) ) : the_row(); ?>
                    <?php the_sub_field( 'name' ); ?>
                    <?php the_sub_field( 'content' ); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
            <?php if ( have_rows( 'image_tokens' ) ) : ?>
                <?php while ( have_rows( 'image_tokens' ) ) : the_row(); ?>
                    <?php the_sub_field( 'name' ); ?>
                    <?php $content = get_sub_field( 'content' ); ?>
                    <?php if ( $content ) { ?>
                        <img src="<?php echo $content['url']; ?>" alt="<?php echo $content['alt']; ?>" />
                    <?php } ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
            <?php if ( have_rows( 'link_tokens' ) ) : ?>
                <?php while ( have_rows( 'link_tokens' ) ) : the_row(); ?>
                    <?php the_sub_field( 'name' ); ?>
                    <?php the_sub_field( 'link_description' ); ?>
                    <?php the_sub_field( 'link_type' ); ?>
                    <?php the_sub_field( 'url' ); ?>
                    <?php the_sub_field( 'text' ); ?>
                    <?php the_sub_field( 'page' ); ?>
                    <?php if ( get_sub_field( 'file' ) ) { ?>
                        <a href="<?php the_sub_field( 'file' ); ?>">Download File</a>
                    <?php } ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php else : ?>
        <?php // no rows found ?>
    <?php endif; ?>
</div>