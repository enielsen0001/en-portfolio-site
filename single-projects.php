<?php
/**
 * The template for displaying project post type single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package en-portfolio-site
 */

get_header();
?>


<main id="primary" class="site-main ">

	<?php
	while (have_posts()):
		echo '<div class="content-width row single-proj-post">';
		the_post();

		get_template_part('template-parts/content', get_post_type());

		echo '</div>';

		echo '<div class="content-width row  single-proj-nav">';
		the_post_navigation(
			array(
				'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'en-portfolio-site') . '</span> <span class="nav-title">&nbsp;%title</span>',
				'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'en-portfolio-site') . '</span> <span class="nav-title">&nbsp;%title</span>',
			)
		);
		echo '</div>';

		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()):
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>
	</div>
</main><!-- #main -->

<?php
// get_sidebar();
include(get_template_directory() . '/template-parts/contact-cta.php');
get_footer();
