<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package en-portfolio-site
 */

?>

<footer class="site-footer">
    <div class="content-width">
		<div class="footer-top">
			<div class="footer-logo">
				<?php
				if ( has_custom_logo() ) {
					the_custom_logo();
				}
				?>
			</div>
			<nav aria-label="Footer Navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-navigation',
						'menu_class'     => 'footer-menu',
						'fallback_cb'    => false,
						'depth'          => 1,
					)
				);
				?>
			</nav>
			<div class="footer-social">
				<a class="footer-social-link" href="https://www.linkedin.com/in/enielsen0001/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>

				<a class="footer-social-link" href="https://github.com/enielsen0001" target="_blank" rel="noopener noreferrer" aria-label="GitHub"><i class="fab fa-github"></i></a>
			</div>
		</div>
        <div class="footer-bottom">
            <p class="footer-copy">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved.</p>
            <a class="footer-privacy" href="/privacy-policy" target="_blank" rel="noopener noreferrer">Privacy Policy</a>
        </div>
		<p class="footer-to-top"><a  class="footer-to-top-link" href="#top">Back to Top</a></p>
    </div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
