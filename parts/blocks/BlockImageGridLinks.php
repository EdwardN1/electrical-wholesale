<?php $column_count = get_field( 'column_count' ); ?>
<?php $id = cssName( get_field( 'id' ) ); ?>
<?php $title = get_field( 'title' ); ?>
<?php $type = get_field( 'type' ); ?>
<?php if ( $type == 'Carousel' ): ?>
	<?php if ( have_rows( 'responsive' ) ) : ?>
		<?php $breakpointData = array(); ?>
		<?php $breakpoints = array(); ?>
		<?php $columns = array(); ?>
		<?php while ( have_rows( 'responsive' ) ) : the_row(); ?>
			<?php $breakpointData[] = array( 'breakpoint' => get_sub_field( 'breakpoint' ),  'columns' => get_sub_field( 'number_of_columns' ) ) ; ?>
		<?php endwhile;
		foreach ( $breakpointData as $key => $row ) {
			$breakpoints[ $key ] = $row['breakpoint'];
			$columns[ $key ]     = $row['columns'];
		}
		array_multisort( $breakpoints, SORT_DESC, $columns, SORT_DESC, $breakpointData );
		?>
        <div id="<?php echo $id; ?>" class="grid-container">
			<?php if ( $title != '' ): ?>
                <h2><span><?php echo $title; ?></span></h2>
			<?php endif; ?>
            <?php //print_r($breakpointData); ?>
			<?php if ( have_rows( 'columns' ) ) : ?>
				<?php
				$dataBP = '';
				$sep ='';
				foreach ($breakpointData as $row) {
				    //print_r($row);
				    $dataBP .= $sep.$row['breakpoint'].':'.$row['columns'];
				    $sep = ',';
                }
				?>
                <div class="image-link-carousel" data-slick-carousel data-breakpoints="<?php echo $dataBP; ?>">
					<?php while ( have_rows( 'columns' ) ) : the_row(); ?>
						<?php $image = get_sub_field( 'image' ); ?>
						<?php $imageURL = $image['url']; ?>
						<?php $link_text = get_sub_field( 'link_text' ); ?>
						<?php $link_type = get_sub_field( 'link_type' ); ?>
						<?php $blank = ''; ?>
						<?php $href = ''; ?>

						<?php $external_url = get_sub_field( 'external_url' ); ?>
						<?php echo $external_url; ?>
						<?php $text_link = get_sub_field( 'text_link' ); ?>

						<?php $internal_page = get_sub_field( 'internal_page' ); ?>

						<?php if ( $link_type == 'External URL' ): ?>
							<?php $blank = 'target="_blank"'; ?>
							<?php $href = $external_url; ?>
						<?php endif; ?>
						<?php if ( $link_type == 'Text' ): ?>
							<?php $href = $text_link; ?>
						<?php endif; ?>
						<?php if ( $link_type == 'Internal Page' ): ?>
							<?php $href = $internal_page; ?>
						<?php endif; ?>

                        <div class="image-link-carousel-cell">
                            <div class="image-link-carousel-cell-contents">
								<?php if ( $href != '' ): ?>
                                    <a class="image-carousel-link-anchor" href="<?php echo $href; ?>"<?php echo $blank ?>>
                                        <div class="image"
                                             style="background-image:url(<?php echo $imageURL; ?>);">
                                        </div>
                                        <div class="description">
											<?php echo $link_text; ?>
                                        </div>
                                    </a>
								<?php else: ?>
                                    <div class="image"
                                         style="background-image:url(<?php echo $imageURL; ?>);">
                                    </div>
									<?php if ( $link_text != '' ): ?>
                                        <div class="description">
											<?php echo $link_text; ?>
                                        </div>
									<?php endif; ?>
								<?php endif; ?>
                            </div>
                        </div>

					<?php endwhile; ?>
                </div>
			<?php else : ?>
				<?php // no rows found ?>
			<?php endif; ?>
        </div>
	<?php else : ?>
		<?php $type = 'Grid' ?>
	<?php endif; ?>
<?php endif;; ?>
<?php if ( $type == 'Grid' ): ?>
	<?php $cellClass = ""; ?>
	<?php $gridClass = ""; ?>
	<?php if ( $column_count == 2 ): ?>
		<?php $cellClass = " cell large-6 medium-6 small-12"; ?>
	<?php endif; ?>
	<?php if ( $column_count == 3 ): ?>
		<?php $cellClass = " cell large-4 medium-4 small-12"; ?>
	<?php endif; ?>
	<?php if ( $column_count == 4 ): ?>
		<?php $cellClass = " cell large-3 medium-3 small-12"; ?>
	<?php endif; ?>
	<?php if ( $column_count == 5 ): ?>
		<?php $gridClass = " large-up-5 medium-up-3 small-up-1"; ?>
		<?php $cellClass = " cell"; ?>
	<?php endif; ?>
	<?php if ( $column_count == 6 ): ?>
		<?php $cellClass = " cell large-2 medium-4 small-12"; ?>
	<?php endif; ?>
	<?php $cellPadClass = ' right-cell-pad'; ?>
    <div id="<?php echo $id; ?>">
		<?php if ( $title != '' ): ?>
            <h2><span><?php echo $title; ?></span></h2>
		<?php endif; ?>
		<?php if ( have_rows( 'columns' ) ) : ?>
            <div class="grid-container image-link-grid">
                <div class="grid-x<?php echo $gridClass; ?>">
					<?php $currentCol = 1; ?>
					<?php while ( have_rows( 'columns' ) ) : the_row(); ?>
						<?php $image = get_sub_field( 'image' ); ?>
						<?php $imageURL = $image['url']; ?>
						<?php $link_text = get_sub_field( 'link_text' ); ?>
						<?php $link_type = get_sub_field( 'link_type' ); ?>
						<?php $blank = ''; ?>
						<?php $href = ''; ?>

						<?php $external_url = get_sub_field( 'external_url' ); ?>
						<?php echo $external_url; ?>
						<?php $text_link = get_sub_field( 'text_link' ); ?>

						<?php $internal_page = get_sub_field( 'internal_page' ); ?>

						<?php if ( $link_type == 'External URL' ): ?>
							<?php $blank = 'target="_blank"'; ?>
							<?php $href = $external_url; ?>
						<?php endif; ?>
						<?php if ( $link_type == 'Text' ): ?>
							<?php $href = $text_link; ?>
						<?php endif; ?>
						<?php if ( $link_type == 'Internal Page' ): ?>
							<?php $href = $internal_page; ?>
						<?php endif; ?>

                        <div class="image-link-grid-cell<?php echo $cellClass; ?>">
                            <div class="image-link-grid-cell-contents<?php echo $cellPadClass; ?>" data-col="<?php echo $currentCol;?>">
								<?php if ( $href != '' ): ?>
                                    <a class="image-grid-link-anchor" href="<?php echo $href; ?>"<?php echo $blank ?>>
                                        <div class="image"
                                             style="background-image:url(<?php echo $imageURL; ?>);">
                                        </div>
                                        <div class="description">
											<?php echo $link_text; ?>
                                        </div>
                                    </a>
								<?php else: ?>
                                    <div class="image"
                                         style="background-image:url(<?php echo $imageURL; ?>);">
                                    </div>
									<?php if ( $link_text != '' ): ?>
                                        <div class="description">
											<?php echo $link_text; ?>
                                        </div>
									<?php endif; ?>
								<?php endif; ?>
                            </div>
                        </div>
						<?php $currentCol ++; ?>
						<?php
						if ( $currentCol == $column_count ) {
							$cellPadClass = ' left-cell-pad';
						} else {
							if ( $currentCol == ( $column_count + 1 ) ) {
								$cellPadClass = ' right-cell-pad';
								$currentCol = 1;
							} else {
								$cellPadClass = ' cell-pad';
							}
						}
						?>
					<?php endwhile; ?>
                </div>
            </div>
		<?php else : ?>
			<?php // no rows found ?>
		<?php endif; ?>
    </div>
<?php endif; ?>

