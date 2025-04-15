<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package en-portfolio-site
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php include( get_template_directory() . '/template-parts/page-headline.php' ); ?>

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>


		<?php if ( ! is_page( 'contact' ) && ! is_page( 'privacy-policy' ) ) {
			include( get_template_directory() . '/template-parts/contact-cta.php' );
		} else {
			echo '<span class="footer-divider"></span>';
		}
		?>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
