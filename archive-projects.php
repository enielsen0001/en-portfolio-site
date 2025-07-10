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
        <?php include(get_template_directory() . '/template-parts/page-headline.php'); ?>
        <div class="content-width">
            <?php
            the_archive_description('<div class="archive-description">', '</div>'); // Outputs the archive description (if set)
            ?>
        </div>
    </header>


    <div class="content-width">
        <div class="project-filter">
            <h2 class="filters-hl">Filter by:</h2>
            <?php
            $terms = get_terms(array(
                'taxonomy' => 'project-type',
                'hide_empty' => true, // Only show categories with posts
            ));

            if (!empty($terms) && !is_wp_error($terms)) {
                echo '<ul class="filters-list">';
                echo '<li><a href="' . esc_url(get_post_type_archive_link('projects')) . '">All Categories</a></li>';
                foreach ($terms as $term) {
                    $projects_archive_base_url = get_post_type_archive_link('projects'); //

                    if ($projects_archive_base_url) {
                        $link_url = add_query_arg('project-type', $term->slug, $projects_archive_base_url);

                        echo '<li>';
                        echo '<a href="' . esc_url($link_url) . '">';
                        echo esc_html($term->name);
                        echo '</a>';
                        echo '</li>';
                    } else {

                        echo '<li><a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . ' (Fallback - general category archive)</a></li>';
                    }
                }
            }
            ?>
        </div><?php if (have_posts()): ?>

            <div class="projects-archive-list">
                <?php
                /* Start the Loop */
                while (have_posts()):
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php if (has_post_thumbnail()): ?>
                            <div class="entry-featured-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); // You can adjust the image size here ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="header-text-cta-wrap">
                            <div class="header-text-wrap">
                                <header class="entry-header">
                                    <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>

                                    <div class="entry-meta">
                                        <span class="posted-on">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                <time class="entry-date published updated"
                                                    datetime="<?php the_time('c'); ?>"><?php the_date(); ?></time>
                                            </a>
                                        </span>


                                    </div>
                                </header>
                                <div class="entry-summary">
                                    <?php the_excerpt(); ?>
                                </div>

                                <div class="proj-archive-cat-tags-wrap">
                                <?php
                                    $categories = get_the_terms(get_the_ID(), 'project-type');
                                    if ($categories && !is_wp_error($categories)) {
                                        echo '<div class="proj-categories">';
                                        echo '<span class="sr-only">Categories:</span> ';
                                        $category_links = array();
                                        foreach ($categories as $category) {
                                            $category_links[] = '<a class="proj-category" href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a>';
                                        }
                                        echo implode(' ', $category_links);
                                        echo '</div>';
                                    }

                                    $tags = get_the_tags();
                                    if ( $tags && ! is_wp_error( $tags ) ) {
                                        echo '<div class="proj-archive-tags">';
                                        echo '<span class="sr-only">Tags:</span>';
                                        $tag_links = array();
                                        foreach ( $tags as $tag ) {
                                            $tag_links[] = '<a class="proj-archive-tag" href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" rel="tag"><span aria-hidden="true">#</span>' . esc_html( $tag->name ) . '</a>';
                                        }
                                        echo implode( '', $tag_links );
                                        echo '</div>';
                                    }
                                ?>
                                </div>

                            </div>
                            <footer class="entry-footer">
                                <a href="<?php the_permalink(); ?>"
                                    class="read-more accent-link"><span><?php esc_html_e('Read More', 'en-portfolio-site'); ?></span></a>
                            </footer>
                        </div>
                    </article><?php
                endwhile;

                the_posts_navigation(); // For pagination if there are many posts

        else:

            get_template_part('template-parts/content', 'none'); // If no posts are found

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
<?php include(get_template_directory() . '/template-parts/contact-cta.php'); ?>
<?php
get_footer();
?>