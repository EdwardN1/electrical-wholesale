<?php
/**
 * The template for displaying search form
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
    <div class="grid-x">
        <div class="cell auto">
            <label>
                <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search for items', 'jointswp') ?>" value="<?php echo get_search_query() ?>" name="s"
                       title="<?php echo esc_attr_x('Search for:', 'jointswp') ?>"/>
            </label>
        </div>
        <div class="cell shrink">
            <?php
            $submitbtn = '<input type="submit" class="search-submit button" value="Search" />';;
            if (have_rows('icons', 'option')) :
                while (have_rows('icons', 'option')) : the_row();
                    $iname = get_sub_field('name');
                    $icon = get_sub_field('icon');
                    if ($iname == 'search') {
                        $submitbtn = '<input type=image src="' . $icon['url'] . '" alt="Search">';
                    }
                endwhile;
            endif;
            echo $submitbtn;
            ?>
        </div>
    </div>
</form>