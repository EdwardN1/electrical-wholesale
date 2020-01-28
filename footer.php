<?php
/**
 * The template for displaying the footer.
 *
 * Comtains closing divs for header.php.
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
?>


<footer class="footer" role="contentinfo">

    <?php get_template_part( 'parts/footer', 'content' ); ?>

</footer> <!-- end .footer -->

</div>  <!-- end .off-canvas-content -->

</div> <!-- end .off-canvas-wrapper -->

<?php wp_footer(); ?>

<?php
$google_analytics = get_field( 'google_analytics', 'option' );
if ( $google_analytics ) {
	echo $google_analytics;
}
?>

</body>

</html> <!-- end page -->