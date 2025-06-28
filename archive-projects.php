<?php
/**
 * The template for displaying the archive page for the 'projects' custom post type.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package en-portfolio-site
 */

get_header();
?>

<main id="primary" class="site-main">

    <header class="page-header">
        <?php include( get_template_directory() . '/template-parts/page-headline.php' ); ?>
        <div class="content-width">
            <?php
        the_archive_description( '<div class="archive-description">', '</div>' ); // Outputs the archive description (if set)
        ?>
        </div>
    </header>


    <div class="content-width">
    <div class="project-filter">
        <h2>Filter</h2>
        <?php
        $terms = get_terms( array(
            'taxonomy' => 'project-type',
            'hide_empty' => true, // Only show categories with posts
        ) );

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            echo '<ul class="filters-list">';
            echo '<li><a href="' . esc_url( get_post_type_archive_link( 'projects' ) ) . '">All Categories</a></li>'; // Link to show all projects
            foreach ( $terms as $term ) {
                echo '<li><a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a></li>';
            }
            echo '</ul>';
        }
        ?>
    </div><?php if ( have_posts() ) : ?>

        <div class="projects-archive-list">
            <?php
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="entry-featured-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'medium' ); // You can adjust the image size here ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <header class="entry-header">
                        <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

                        <div class="entry-meta">
                            <span class="posted-on">
                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                    <time class="entry-date published updated" datetime="<?php the_time( 'c' ); ?>"><?php the_date(); ?></time>
                                </a>
                            </span>

                            <span class="cat-links">
                                <?php
                                $categories = get_the_terms( get_the_ID(), 'project_category' );
                                if ( $categories && ! is_wp_error( $categories ) ) {
                                    echo '<span>Categories:</span> ';
                                    $category_links = array();
                                    foreach ( $categories as $category ) {
                                        $category_links[] = '<a href="' . esc_url( get_term_link( $category ) ) . '">' . esc_html( $category->name ) . '</a>';
                                    }
                                    echo implode( ', ', $category_links );
                                }
                                ?>
                            </span>
                        </div></header><div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div><footer class="entry-footer">
                        <a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e( 'Read More', 'en-portfolio-site' ); ?></a>
                    </footer></article><?php
            endwhile;

            the_posts_navigation(); // For pagination if there are many posts

        else :

            get_template_part( 'template-parts/content', 'none' ); // If no posts are found

        endif;
        ?>
        </div>

        </main>

		<?php
		// Check if the projects archive sidebar is active before displaying it
		// if ( is_active_sidebar( 'sidebar-projects-archive' ) ) {
		// 	get_sidebar( 'projects-archive' ); // Use the 'projects-archive' slug
		// }
        ?>
        </div>
        <?php include( get_template_directory() . '/template-parts/contact-cta.php' ); ?>
        <?php
get_footer();
?>