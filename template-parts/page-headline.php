<?php
/**
 * Template part for displaying the page/post/archive headline.
 */

$tag = 'h1'; // Default tag
$page_type = '';
$page_slug = '';

$tag = 'h1'; // Default tag
$title = ''; // Initialize title
$page_type = '';
$page_slug = '';

if ( is_front_page() ) {
    // Site's static front page
    $title = get_bloginfo( 'name' );
    $page_type = 'front-page';
    $page_slug = 'front-page'; // No inherent slug for the true front page
} elseif ( is_home() && ! is_front_page() ) {
    // This is the static page designated as the "Posts page" in Settings > Reading
    $posts_page_id = get_option( 'page_for_posts' );
    if ( $posts_page_id ) {
        $title = get_the_title( $posts_page_id ); // Get the title of the assigned Posts page (e.g., "Blog")
        $page_slug = get_post_field( 'post_name', $posts_page_id );
    } else {
        // Fallback for if is_home() is true but no static posts page is explicitly set
        // (e.g., if the site's front page IS the blog posts index, but handled by is_front_page above)
        $title = __( 'Blog', 'en-portfolio-site' ); // Default title for generic blog listing
        $page_slug = 'blog';
    }
    $page_type = 'blog';
    $tag = 'h1'; // Main blog page often uses h1
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
        $title = sprintf( __( 'Author: %s', 'en-portfolio-site' ), get_the_author() );
        $author_id = get_query_var('author');
        $author = get_userdata($author_id);
        $page_slug = $author ? $author->user_nicename : '';
    } elseif ( is_date() ) {
        if ( is_day() ) {
            $title = sprintf( __( 'Day: %s', 'en-portfolio-site' ), get_the_date() );
            $page_slug = get_the_date('Y-m-d');
        } elseif ( is_month() ) {
            $title = sprintf( __( 'Month: %s', 'en-portfolio-site' ), get_the_date( 'F Y' ) );
            $page_slug = get_the_date('Y-m');
        } elseif ( is_year() ) {
            $title = sprintf( __( 'Year: %s', 'en-portfolio-site' ), get_the_date( 'Y' ) );
            $page_slug = get_the_date('Y');
        } else {
            $title = __( 'Archives', 'en-portfolio-site' );
            $page_slug = 'archives';
        }
    } elseif ( is_tax() ) {
        $term = get_queried_object();
        $title = single_term_title( '', false );
        $page_slug = $term ? $term->slug : '';
    } elseif ( is_post_type_archive() ) {
        $post_type_obj = get_queried_object();
        if ( $post_type_obj && isset( $post_type_obj->labels->name ) ) {
            $title = $post_type_obj->labels->name;
            $page_slug = $post_type_obj->name;
        } else {
            $title = __( 'Post Type Archives', 'en-portfolio-site' );
            $page_slug = 'post-type-archives';
        }
    } else {
        // Generic archive fallback if none of the above specific archive types are matched
        $title = __( 'Archives', 'en-portfolio-site' );
        $page_slug = 'archives';
    }
    $tag = 'h1'; // Archives often use h1
} elseif ( is_search() ) {
    $page_type = 'search';
    $title = sprintf( __( 'Search Results for: %s', 'en-portfolio-site' ), get_search_query() );
    $page_slug = 'search-results';
} elseif ( is_404() ) {
    $page_type = 'error';
    $title = __( 'Page Not Found', 'en-portfolio-site' );
    $page_slug = 'error-404';
} else {
    // Default for any other page not caught by above (e.g., a static page not set as front/posts page)
    $title = get_the_title();
    $page_type = 'page';
    $page_slug = get_post_field( 'post_name', get_the_ID() );
}
?>

<div class="page-title page-type--<?php echo esc_attr( $page_type ); ?> page-slug--<?php echo esc_attr( $page_slug ); ?>">
	<div class="content-width">
		<<?php echo esc_attr( $tag ); ?> class="page-title__hl">
        <span class="page-title__hl-txt"><?php echo esc_html( $title ); ?></span></<?php echo esc_attr( $tag ); ?>>
	</div>
</div>


