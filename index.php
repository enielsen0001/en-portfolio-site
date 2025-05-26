<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package en-portfolio-site
 */

get_header();
?>
<?php include( get_template_directory() . '/template-parts/page-headline.php' ); ?>

<div class="d-flex-md">
	<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
            ?>
            <div class="blog-posts-list content-width"> <?php // Wrapper for your posts ?>
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post-item' ); ?>>
                    <header class="entry-header">
                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    </header><div class="entry-meta">
                        <span class="posted-on">
                            <?php
                            printf(
                                /* translators: %s: post date. */
                                esc_html__( 'Posted on %s', 'en-portfolio-site' ),
                                '<time datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time>'
                            );
                            ?>
                        </span>
                        <?php if ( has_category() ) : ?>
                            <span class="cat-links">
                                <?php
                                printf(
                                    /* translators: %s: list of categories. */
                                    esc_html__( ' in %s', 'en-portfolio-site' ),
                                    get_the_category_list( ', ' )
                                );
                                ?>
                            </span>
                        <?php endif; ?>
                    </div><div class="entry-content">
                        <?php the_excerpt(); ?>
                        <p class="read-more-link"><a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'en-portfolio-site' ); ?></a></p>
                    </div><?php if ( has_tag() ) : ?>
                        <footer class="entry-footer">
                            <span class="tags-links">
                                <?php
                                printf(
                                    /* translators: %s: list of tags. */
                                    esc_html__( 'Tagged: %s', 'en-portfolio-site' ),
                                    get_the_tag_list( '', ', ', '' )
                                );
                                ?>
                            </span>
                        </footer><?php endif; ?>
                </article><?php
            endwhile;
            ?>
            </div> <?php // End .blog-posts-list ?>
            <?php

            the_posts_navigation();

        else :

            get_template_part( 'template-parts/content', 'none' );

        endif;
        ?>

	</main><!-- #main -->

<?php
get_sidebar();
?>
</div>
<?php include( get_template_directory() . '/template-parts/contact-cta.php' ); ?>
<?php
get_footer();
?>