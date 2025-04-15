<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package en-portfolio-site
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- <header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
			en_portfolio_site_posted_on();
			en_portfolio_site_posted_by();
			?>
		</div>
		<?php endif; ?>
	</header> -->

	<!-- <?php en_portfolio_site_post_thumbnail(); ?> -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<?php
	$post_type = get_post_type();
	if ( $post_type === 'projects' ) {
		echo '<span class="post-type-label">Type: Project</span>';

		// Get categories for the 'projects' custom post type
		$categories = get_the_terms( get_the_ID(), 'project_category' ); // Assuming 'project_category' is your taxonomy

		if ( $categories && ! is_wp_error( $categories ) ) {
			echo '<div class="project-categories-list">';
			echo '<span>Categories:</span>';
			echo '<ul>';
			foreach ( $categories as $category ) {
				echo '<li><a href="' . esc_url( get_term_link( $category ) ) . '">' . esc_html( $category->name ) . '</a></li>';
			}
			echo '</ul>';
			echo '</div>';
		}
	} elseif ( $post_type === 'post' ) {
		echo '<span class="post-type-label">Type: Blog</span>';

		// Get categories for standard blog posts
		$categories = get_the_category();

		if ( $categories && ! is_wp_error( $categories ) ) {
			echo '<div class="blog-categories-list">';
			echo '<span>Categories:</span>';
			echo '<ul>';
			foreach ( $categories as $category ) {
				echo '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></li>';
			}
			echo '</ul>';
			echo '</div>';
		}
	}
	?>

	<footer class="entry-footer">
		<?php en_portfolio_site_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
