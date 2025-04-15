<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package en-portfolio-site
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found content-width">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'en-portfolio-site' ); ?></h1>
			</header><div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'en-portfolio-site' ); ?></p>

				<?php
				get_search_form();
				?>

				<div class="flex-row">
					<div class="flex-col-50">
						<div class="widget widget_recent_projects">
							<h2 class="widget-title"><?php esc_html_e( 'Recent Projects', 'en-portfolio-site' ); ?></h2>
							<ul>
								<?php
								$recent_projects = wp_get_recent_posts( array(
									'post_type'      => 'projects',
									'numberposts'    => 5, // Adjust the number of recent projects to display
									'post_status'    => 'publish',
									'orderby'        => 'date',
									'order'          => 'DESC',
								) );
								if ( $recent_projects ) :
									foreach ( $recent_projects as $project ) :
										?>
										<li>
											<a href="<?php echo esc_url( get_permalink( $project['ID'] ) ); ?>"><?php echo esc_html( $project['post_title'] ); ?></a>
										</li>
										<?php
									endforeach;
								else :
									?>
									<li><?php esc_html_e( 'No recent projects found.', 'en-portfolio-site' ); ?></li>
									<?php
								endif;
								?>
							</ul>
						</div><div class="widget widget_project_types">
							<h2 class="widget-title"><?php esc_html_e( 'Project Types', 'en-portfolio-site' ); ?></h2>
							<ul>
								<?php
								$project_types = get_terms( array(
									'taxonomy'   => 'project-type', // Replace 'project-type' with your actual taxonomy slug
									'hide_empty' => true,
								) );
								if ( $project_types && ! is_wp_error( $project_types ) ) :
									foreach ( $project_types as $project_type ) :
										?>
										<li>
											<a href="<?php echo esc_url( get_term_link( $project_type ) ); ?>"><?php echo esc_html( $project_type->name ); ?></a>
										</li>
										<?php
									endforeach;
								else :
									?>
									<li><?php esc_html_e( 'No project types found.', 'en-portfolio-site' ); ?></li>
									<?php
								endif;
								?>
							</ul>
						</div>
					</div>

					<div class="flex-col-50">
						<?php
						the_widget( 'WP_Widget_Recent_Posts' );
						?>
						<div class="widget widget_categories">
							<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'en-portfolio-site' ); ?></h2>
							<ul>
								<?php
								wp_list_categories(
									array(
										'orderby'    => 'count',
										'order'      => 'DESC',
										'show_count' => 1,
										'title_li'   => '',
										'number'     => 10,
									)
								);
								?>
							</ul>
						</div><?php
						/* translators: %1$s: smiley */
						$en_portfolio_site_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'en-portfolio-site' ), convert_smilies( ':)' ) ) . '</p>';
						// Remove the archives dropdown widget
						// the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$en_portfolio_site_archive_content" );

						the_widget( 'WP_Widget_Tag_Cloud' );
						?>

					</div>

				</div>

			</div></section></main><?php
get_footer();