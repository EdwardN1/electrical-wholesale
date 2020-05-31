<?php
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
?>
    </div>
<div class="grid-container <?php echo esc_attr( $classes ); ?>">
<?php