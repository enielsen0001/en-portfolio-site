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
            <div class="content-width">
                <div class="home-hero-content">
                    <div class="home-hero-content-inner">
                        <h1 class="home-hero-content-title">Erika <br>Nielsen</h1>
                        <p class="home-hero-content-tagline home-hero-content-tagline-1">Web Developer &amp; Designer</p>


                        <p class="home-hero-content-tagline home-hero-content-tagline-2">Transforming ideas into engaging <br>online experiences</p>

                        <div class="home-hero-content-cta-group">
                            <a class="btn btn-filled" href="<?php echo $project_archive_url; ?>">View my portfolio</a>
                            <a class="btn btn-outline" href="<?php echo $contact_url; ?>">Contact Me</a>
                        </div>
                    </div>

                </div>

                <div  class="home-hero-img-frame">

                    <?php
                    $upload_dir = wp_get_upload_dir();
                    $hero_url = trailingslashit( $upload_dir['baseurl'] ) . '2025/04/hero-graphic-sm.svg';
                    ?>

                    <img class="home-hero-img" src="<?php echo esc_url( $hero_url ); ?>" alt="abstract geometric shapes">

                </div>

            </div>

        </div>

        <section class="content-width row">

            <h2>Recent Projects</h2>

            <div class="featured-proj">
                <?php display_recent_custom_posts( 'projects' ); ?>
            </div>

        </section>

        <section class="content-width row">

            <h2>My Key Skills</h2>
            <?php include( get_template_directory() . '/template-parts/skills-partial.php' ); ?>

        </section>

        <section class="fp-about row">
            <div class="content-width">
                <h2>Hello, World!</h2>

                <p>I truly enjoy crafting intuitive and visually appealing digital experiences, and I'm eager to contribute my skills in web development and design, whether collaborating within a team or working independently on freelance projects. My goal is to build impactful and user-centric solutions that not only meet requirements but also delight and engage.</p>

                <div class="fp-about-link-wrap">
                    <a  class="fp-about-link accent-link" href="<?php esc_url( home_url( '/' . 'about' . '/' ) ); ?>"><span>More About My Journey</span></a>
                </div>
            <div>
        </section>

        <section class="content-width row">
            <h2>Latest Insights</h2>
            <?php display_recent_blog_posts( 'projects' ); ?>
        </section>

        <?php include( get_template_directory() . '/template-parts/contact-cta.php' ); ?>

	</main><!- #main ->

<?php
get_footer();
?>