<?php
/**
 * Template part for displaying the page/post/archive headline.
 */

$tag = 'h1'; // Default tag

if ( is_front_page() ) {
	$title = get_bloginfo( 'name' );
	$tag   = 'h1';
} elseif ( is_singular() ) {
	// Single Post or Page
	$title = get_the_title();
	$tag   = is_front_page() ? 'h1' : 'h2'; // Adjust tag for pages if needed
} elseif ( is_archive() ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'your-theme-slug' ), get_the_author() );
	} elseif ( is_date() ) {
		if ( is_day() ) {
			$title = sprintf( __( 'Day: %s', 'your-theme-slug' ), get_the_date() );
		} elseif ( is_month() ) {
			$title = sprintf( __( 'Month: %s', 'your-theme-slug' ), get_the_date( 'F Y' ) );
		} elseif ( is_year() ) {
			$title = sprintf( __( 'Year: %s', 'your-theme-slug' ), get_the_date( 'Y' ) );
		} else {
			$title = __( 'Archives', 'your-theme-slug' );
		}
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} else {
		$title = __( 'Archives', 'your-theme-slug' );
	}
	$tag = 'h1'; // Archives often use h1
} elseif ( is_search() ) {
	$title = sprintf( __( 'Search Results for: %s', 'your-theme-slug' ), get_search_query() );
	$tag   = 'h1';
} elseif ( is_404() ) {
	$title = __( 'Page Not Found', 'your-theme-slug' );
	$tag   = 'h1';
} else {
	// Default for other pages
	$title = get_the_title();
	$tag   = 'h2';
}
?>

<<?php echo esc_attr( $tag ); ?> class="page-title custom-headline">
    <?php echo 'Page Headline: '; ?>
	<?php echo esc_html( $title ); ?>
</<?php echo esc_attr( $tag ); ?>>