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
				<?php $dataFields = ''; ?>
				<?php if ( have_rows( 'data' ) ) : ?>
					<?php while ( have_rows( 'data' ) ) : the_row(); ?>
						<?php
						$dataFields .= ' data-' . get_sub_field( 'name' );
						$dataValue  = get_sub_field( 'value' );
						if ( $dataValue != '' ) {
							$dataFields .= '="' . $dataValue . '"';
						}
						?>
					<?php endwhile; ?>
				<?php else : ?>
					<?php // no rows found ?>
				<?php endif;
				$classNames = get_sub_field( 'classes' );
				if ( $classNames != '' ) {
					$classNames = ' class="' . $classNames . '"';
				}
				$html   = get_sub_field( 'html' );
				$tokens = array();
				preg_match_all( '/<token\s*([^>]*)\s*\/?>/', $html, $tokens, PREG_SET_ORDER );
				foreach ( $tokens as $customTag ) {
					$originalTag   = $customTag[0];
					$rawAttributes = $customTag[1];

					preg_match_all( '/([^=\s]+)="([^"]+)"/', $rawAttributes, $attributes, PREG_SET_ORDER );

					$formatedAttributes = array();

					foreach ( $attributes as $attribute ) {
						$name  = $attribute[1];
						$value = $attribute[2];

						$formatedAttributes[ $name ] = $value;
					}

					$replaceWith = '';

					if ( $formatedAttributes['type'] == 'link' ) {
						$tokenName = $formatedAttributes['name'];
						if ( have_rows( 'link_tokens' ) ) :
							while ( have_rows( 'link_tokens' ) ) : the_row();
								if ( get_sub_field( 'name' ) == $tokenName ) {
								    if($replaceWith=='') {
									    $replaceWith = '<a href="';
									    if ( get_sub_field( 'link_type' ) == 'Internal Page' ) {
										    $replaceWith .= get_sub_field( 'page' ) . '" >' . get_sub_field( 'link_description' ) . '</a>';
									    }
									    if ( get_sub_field( 'link_type' ) == 'External Page' ) {
										    $replaceWith .= get_sub_field( 'url' ) . '" target="_blank">' . get_sub_field( 'link_description' ) . '</a>';
									    }
									    if ( get_sub_field( 'link_type' ) == 'Text' ) {
										    $replaceWith .= get_sub_field( 'text' ) . '" >' . get_sub_field( 'link_description' ) . '</a>';
									    }
									    if ( get_sub_field( 'link_type' ) == 'File' ) {
										    $replaceWith .= get_sub_field( 'file' ) . '" target="_blank">' . get_sub_field( 'link_description' ) . '</a>';
									    }
								    }
									//break;
								}
							endwhile;
						endif;
					}

					if ( $formatedAttributes['type'] == 'image' ) {
						$tokenName = $formatedAttributes['name'];
						if ( have_rows( 'image_tokens' ) ) :
							while ( have_rows( 'image_tokens' ) ) : the_row();
								if ( get_sub_field( 'name' ) == $tokenName ) {
									if($replaceWith=='') {
										$image = get_sub_field('content');
										$replaceWith = $image['url'];
									}
								}
							endwhile;
						endif;
					}

					$html = str_replace( $originalTag, $replaceWith, $html );
				}
				?>
                <div id="<?php echo cssName( get_sub_field( 'id' ) ); ?>"<?php echo $dataFields; ?><?php echo $classNames; ?>><?php echo $html; ?></div>
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