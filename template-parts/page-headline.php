<?php
/**
 * Template part for displaying the page/post/archive headline.
 */

$tag = 'h1'; // Default tag
$page_type = '';
$page_slug = '';

if ( is_front_page() ) {
    $title = get_bloginfo( 'name' );
    $page_type = 'front-page';
    $page_slug = 'front-page'; // No inherent slug for the true front page
} elseif ( is_singular() ) {
    // Single Post or Page
    $title = get_the_title();
    $page_type = is_page() ? 'page' : 'single-post';
    $page_slug = get_post_field( 'post_name', get_the_ID() );
} elseif ( is_archive() ) {
    $page_type = 'archive';
    if ( is_category() ) {
        $title = single_cat_title( '', false );
        $page_slug = get_query_var('category_name');
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
        $page_slug = get_query_var('tag');
    } elseif ( is_author() ) {
        $title = sprintf( __( 'Author: %s', 'your-theme-slug' ), get_the_author() );
        $author_id = get_query_var('author');
        $author = get_userdata($author_id);
        $page_slug = $author ? $author->user_nicename : '';
    } elseif ( is_date() ) {
        if ( is_day() ) {
            $title = sprintf( __( 'Day: %s', 'your-theme-slug' ), get_the_date() );
            $page_slug = get_the_date('Y-m-d');
        } elseif ( is_month() ) {
            $title = sprintf( __( 'Month: %s', 'your-theme-slug' ), get_the_date( 'F Y' ) );
            $page_slug = get_the_date('Y-m');
        } elseif ( is_year() ) {
            $title = sprintf( __( 'Year: %s', 'your-theme-slug' ), get_the_date( 'Y' ) );
            $page_slug = get_the_date('Y');
        } else {
            $title = __( 'Archives', 'your-theme-slug' );
            $page_slug = 'archives';
        }
    } elseif ( is_tax() ) {
        $term = get_queried_object();
        $title = single_term_title( '', false );
        $page_slug = $term ? $term->slug : '';
    } else {
        $title = __( 'Archives', 'your-theme-slug' );
        $page_slug = 'archives';
    }
    $tag = 'h1'; // Archives often use h1
} elseif ( is_search() ) {
    $page_type = 'search';
    $title = sprintf( __( 'Search Results for: %s', 'your-theme-slug' ), get_search_query() );
    $page_slug = 'search-results';
} elseif ( is_404() ) {
    $page_type = 'error';
    $title = __( 'Page Not Found', 'your-theme-slug' );
    $page_slug = 'error-404';
} else {
    // Default for other pages (should catch static pages not caught by is_singular())
    $title = get_the_title();
    $page_type = 'page';
    $page_slug = get_post_field( 'post_name', get_the_ID() );
}
?>

<div class="page-title page-type--<?php echo esc_attr( $page_type ); ?> page-slug--<?php echo esc_attr( $page_slug ); ?>">
	<div class="content-width">
		<<?php echo esc_attr( $tag ); ?> class="custom-headline"><?php echo esc_html( $title ); ?></<?php echo esc_attr( $tag ); ?>>
	</div>
</div>


