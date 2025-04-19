<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package en-portfolio-site
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Outfit:wght@100..900&family=Poppins:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'en-portfolio-site' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="content-width d-flex site-header-inner">
			<div class="site-branding">
				<?php
				the_custom_logo();
				?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle button-reset" aria-controls="primary-menu" aria-expanded="false">
					<span class="sr-only">Open Menu</span>
					<span class="hamburger-icon">
						<span class="hamburger-icon-bar hamburger-icon-bar-1"></span>
						<span class="hamburger-icon-bar hamburger-icon-bar-2"></span>
						<span class="hamburger-icon-bar hamburger-icon-bar-3"></span>
					</span>
				</button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->
