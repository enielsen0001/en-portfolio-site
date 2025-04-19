<?php
get_header();

// hero links
// Assuming your custom post type for projects has the slug 'project'
$project_archive_url = esc_url( get_post_type_archive_link( 'projects' ) );

// Assuming your contact page has the slug 'contact'
$contact_page = get_page_by_path( 'contact' );
$contact_url = '';
if ( $contact_page ) {
    $contact_url = esc_url( get_permalink( $contact_page->ID ) );
} else {
    $contact_url = '#contact'; // Fallback if contact page isn't found
    error_log( 'Warning: Contact page with slug "contact" not found.' );
}

?>

	<main id="primary" class="site-main">

        <div class="home-hero">

            <div class="home-hero-content">
                <div class="content-width">
                    <h1 class="home-hero-content__title">Erika Nielsen</h1>
                    <p class="home-hero-content__tagline home-hero-content__tagline--1">Web Developer &amp; Designer</p>
                    <p class="home-hero-content__tagline home-hero-content__tagline--1">Transforming ideas into engaging online experiences</p>

                    <div class="home-hero-content__cta-group">
                        <a href="<?php echo $project_archive_url; ?>">View my portfolio</a>
                        <a href="<?php echo $contact_url; ?>">Contact Me</a>
                    </div>

                </div>
            </div>

            <picture>
                <?php
                $upload_dir = wp_get_upload_dir();
                $mobile_url = trailingslashit( $upload_dir['baseurl'] ) . '2025/04/hero-graphic-sm.svg';
                $desktop_url = trailingslashit( $upload_dir['baseurl'] ) . '2025/04/hero-graphic-lg.svg';
                $fallback_url = trailingslashit( $upload_dir['baseurl'] ) . '2025/04/hero-graphic-lg.svg';
                ?>
                <source media="(max-width: 767px)" srcset="<?php echo esc_url( $mobile_url ); ?>">
                <source srcset="<?php echo esc_url( $desktop_url ); ?>">
                <img src="<?php echo esc_url( $fallback_url ); ?>" alt="abstract geometric shapes">
            </picture>

        </div>

        <section class="content-width">

            <h2>Recent Projects</h2>

            <div class="featured-proj">
                <?php display_recent_custom_posts( 'projects' ); ?>
            </div>

        </section>

        <section class="content-width">

            <h2>My Key Skills</h2>
            <?php include( get_template_directory() . '/template-parts/skills-partial.php' ); ?>

            <p>Being a curious person, I genuinely enjoy learning new things and am driven to create quality experiences on the web.</p>

            <h3>Currently Developing Skills</h3>

            <ul class="developing-skills-list list-reset">
                <li>WordPress Theme Development</li>
                <li>PHP</li>
                <li>Node.js</li>
            </ul>

        </section>

        <section class="fp-about">
            <div class="content-width">
                <h2>Hello, World!</h2>

                <p>I truly enjoy crafting intuitive and visually appealing digital experiences, and I'm eager to contribute my skills in web development and design, whether collaborating within a team or working independently on freelance projects. My goal is to build impactful and user-centric solutions that not only meet requirements but also delight and engage.</p>

                <a href="<?php esc_url( home_url( '/' . 'about' . '/' ) ); ?>">More About My Journey</a>
            <div>
        </section>

        <section class="content-width">
            <h2>Latest Insights</h2>
            <?php display_recent_blog_posts( 'projects' ); ?>
        </section>

        <?php include( get_template_directory() . '/template-parts/contact-cta.php' ); ?>

	</main><!-- #main -->

<?php
get_footer();
?>