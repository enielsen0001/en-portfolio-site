<?php
/**
 * en-portfolio-site functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package en-portfolio-site
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function en_portfolio_site_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on en-portfolio-site, use a find and replace
		* to change 'en-portfolio-site' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'en-portfolio-site', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'en-portfolio-site' ),
			'footer-navigation' => esc_html__( 'Footer Navigation', 'en-portfolio-site' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'en_portfolio_site_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'en_portfolio_site_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function en_portfolio_site_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'en_portfolio_site_content_width', 640 );
}
add_action( 'after_setup_theme', 'en_portfolio_site_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function en_portfolio_site_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'en-portfolio-site' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'en-portfolio-site' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar( array(
        'name'          => esc_html__( 'Projects Archive Sidebar', 'en-portfolio-site' ),
        'id'            => 'sidebar-projects-archive',
        'description'   => esc_html__( 'Widgets displayed on the projects archive page.', 'en-portfolio-site' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'en_portfolio_site_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function en_portfolio_site_scripts() {
	wp_enqueue_script('masonry-js', 'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', array(), null, true);
	wp_enqueue_style( 'en-portfolio-site-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'en-portfolio-site-style', 'rtl', 'replace' );

	wp_enqueue_script( 'en-portfolio-site-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'en-portfolio-site-main-scripts', get_template_directory_uri() . '/js/main-scripts.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'en_portfolio_site_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

	global $wp_version;
	if ( $wp_version !== '4.7.1' ) {
	   return $data;
	}

	$filetype = wp_check_filetype( $filename, $mimes );

	return [
		'ext'             => $filetype['ext'],
		'type'            => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];

  }, 10, 4 );

  function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
  }
  add_filter( 'upload_mimes', 'cc_mime_types' );

  function fix_svg() {
	echo '<style type="text/css">
		  .attachment-266x266, .thumbnail img {
			   width: 100% !important;
			   height: auto !important;
		  }
		  </style>';
  }
  add_action( 'admin_head', 'fix_svg' );


/**
 * Function to display the three most recent posts of a specific custom post type.
 *
 * @param string $custom_post_type The slug of the custom post type to query.
 */
function display_recent_custom_posts( $custom_post_type ) {
	if ( post_type_exists( $custom_post_type ) ) {
		$args = array(
			'post_type'      => $custom_post_type,
			'posts_per_page' => 3,
			'orderby'        => 'date',
			'order'          => 'DESC',
		);

		$recent_posts = new WP_Query( $args );

		if ( $recent_posts->have_posts() ) {
			echo '<div class="rcps recent-' . esc_attr( $custom_post_type ) . '-posts">';
			while ( $recent_posts->have_posts() ) {
				$recent_posts->the_post();
				?>
				<article class="rcp">
					<?php
					// Display thumbnail
					if ( has_post_thumbnail() ) {
						echo '<div class="rcp-thumbnail">';
						the_post_thumbnail( 'thumbnail' ); // You can change 'thumbnail' to other image sizes
						echo '</div>';
					} else {
						echo '<div class="rcp-no-thumbnail rcp-no-thumbnail-bg-' . rand(1, 4) . '"></div>';
					}
					?>

					<h3 class="rcp-title"><?php the_title(); ?></h3>

					<?php
					// Display categories
					$categories = get_the_category();
					if ( $categories && ! is_wp_error( $categories ) ) {
						echo '<div class="proj-categories">';
						echo '<span class="sr-only">Categories:</span>';
						$category_links = array();
						foreach ( $categories as $category ) {
							$category_links[] = '<a class="proj-category" href="' . esc_url( get_category_link( $category->term_id ) ) . '" rel="category tag">' . esc_html( $category->name ) . '</a>';
						}
						echo implode( '', $category_links );
						echo '</div>';
					}

					// Display excerpt
					if ( has_excerpt() ) {
						echo '<div class="rcp-excerpt">';
						the_excerpt();
						echo '</div>';
					}

					// Display tags
					$tags = get_the_tags();
					if ( $tags && ! is_wp_error( $tags ) ) {
						echo '<div class="proj-tags">';
						echo '<span class="sr-only">Tags:</span>';
						$tag_links = array();
						foreach ( $tags as $tag ) {
							$tag_links[] = '<a class="proj-tag" href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" rel="tag">' . esc_html( $tag->name ) . '</a>';
						}
						echo implode( '', $tag_links );
						echo '</div>';
					}

					echo '<div class="rcp-read-more-link-wrap"><a href="' . esc_url( get_the_permalink() ) . '" class="rcp-read-more-link accent-link" aria-label="Read more about ' . esc_attr( get_the_title() ) . '"><span>Read More</span></a></div>';

					echo '</article>';
				}
				echo '</div>';
				wp_reset_postdata(); // IMPORTANT: Restore original post data

				echo '<p class="rcp-view-all"><a class="btn btn-filled" href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '">View All Projects</a></p>';


			} else {
				echo '<p>No posts found for the custom post type: ' . esc_html( $custom_post_type ) . '</p>';
			}
		} else {
			echo '<p>Custom post type "' . esc_html( $custom_post_type ) . '" does not exist.</p>';
		}
}

/**
 * Function to display the four most recent blog posts with title, excerpt, and a "View All Posts" link.
 */
function display_recent_blog_posts() {
	$args = array(
		'post_type'      => 'post', // Specify that we want blog posts
		'posts_per_page' => 4,     // Get the four most recent posts
		'orderby'        => 'date',
		'order'          => 'DESC',
	);

	$recent_posts = new WP_Query( $args );

	if ( $recent_posts->have_posts() ) :
		echo '<div class="rbps">';
		while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
		$post_date = get_the_date( 'F j, Y' );
		$date_parts = explode( ' ', $post_date );
			?>
			<article class="rbp">
				<div class="post-date-square">
				<?php
				if ( count( $date_parts ) >= 3 ) {
					$month = $date_parts[0];
					$day = rtrim( $date_parts[1], ',' ); // Remove the trailing comma from the day
					$year = $date_parts[2];

					echo '<span class="post-month">' . esc_html( $month ) . '</span> ';
					echo '<span class="post-day">' . esc_html( $day ) . '</span> ';
					echo '<span class="post-year">' . esc_html( $year ) . '</span>';
				} else {
					// Handle cases where the date format might be unexpected
					echo esc_html( $post_date );
				}
				?>
				</div>
				<div class="rbp-content">
					<h3 class="rbp-title"><?php the_title(); ?></h3>
					<?php
					if ( has_excerpt() ) {
						echo '<div class="rbp-excerpt">';
						the_excerpt();
						echo '</div>';
					}
					?>
					<div class="rbp-read-more-link-wrap">
						<a class="rbp-read-more-link accent-link">
							<span>Read More</span>
						</a>
					</div>
				</div>
			</article>
			<?php
		endwhile;
		echo '</div>';


		// Link to view all posts
		echo '<p class="rbp-view-all"><a class="btn btn-filled" href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '">View All Posts</a></p>';

		wp_reset_postdata(); // Restore original post data
	else :
		echo '<p>No blog posts found.</p>';
	endif;
}

/* begin theme color */
function my_theme_customize_register( $wp_customize ) {
    // Add a new section for theme colors if it doesn't exist
    if ( ! $wp_customize->get_section( 'colors' ) ) {
        $wp_customize->add_section( 'colors', array(
            'title'    => __( 'Colors', 'your-theme-slug' ),
            'priority' => 30,
        ) );
    }

    // Background Color
    $wp_customize->add_setting( 'background_color', array(
        'default'           => '#f9f9f9',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
        'label'    => __( 'Background Color', 'your-theme-slug' ),
        'section'  => 'colors',
        'settings' => 'background_color',
    ) ) );

    // Text Color
    $wp_customize->add_setting( 'text_color', array(
        'default'           => '#222222',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_color', array(
        'label'    => __( 'Text Color', 'your-theme-slug' ),
        'section'  => 'colors',
        'settings' => 'text_color',
    ) ) );

    // Additional Color 1
    $wp_customize->add_setting( 'accent_color_1', array(
        'default'           => '#f8b705',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color_1', array(
        'label'    => __( 'Accent Color 1', 'your-theme-slug' ),
        'section'  => 'colors',
        'settings' => 'accent_color_1',
    ) ) );

    // Additional Color 2
    $wp_customize->add_setting( 'accent_color_2', array(
        'default'           => '#131a48',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color_2', array(
        'label'    => __( 'Accent Color 2', 'your-theme-slug' ),
        'section'  => 'colors',
        'settings' => 'accent_color_2',
    ) ) );

    // Additional Color 3
    $wp_customize->add_setting( 'accent_color_3', array(
        'default'           => '#FF6120',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color_3', array(
        'label'    => __( 'Accent Color 3', 'your-theme-slug' ),
        'section'  => 'colors',
        'settings' => 'accent_color_3',
    ) ) );

    // Additional Color 4
    $wp_customize->add_setting( 'accent_color_4', array(
        'default'           => '#00a6a6',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color_4', array(
        'label'    => __( 'Accent Color 4', 'your-theme-slug' ),
        'section'  => 'colors',
        'settings' => 'accent_color_4',
    ) ) );
}
add_action( 'customize_register', 'my_theme_customize_register' );

// Output CSS in the <head> for live preview
function my_theme_customize_preview_js() {
    wp_enqueue_script( 'my-theme-customize-preview', get_stylesheet_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'my_theme_customize_preview_js' );

// Output CSS in the <head> for front-end styling
function my_theme_customize_css() {
    $background_color = get_theme_mod( 'background_color', '#f9f9f9' );
    $text_color       = get_theme_mod( 'text_color', '#222222' );
    $accent_color_1   = get_theme_mod( 'accent_color_1', '#f8b705' );
    $accent_color_2   = get_theme_mod( 'accent_color_2', '#131a48' );
    $accent_color_3   = get_theme_mod( 'accent_color_3', '#FF6120' );
    $accent_color_4   = get_theme_mod( 'accent_color_4', '#00a6a6' );
    ?>
    <style type="text/css">
        body {
            background-color: <?php echo esc_attr( $background_color ); ?>;
            color: <?php echo esc_attr( $text_color ); ?>;
        }
        a {
            color: <?php echo esc_attr( $accent_color_1 ); ?>;
        }
        /* Add more CSS rules to use your additional colors */
        .accent-1 {
            color: <?php echo esc_attr( $accent_color_1 ); ?>;
        }
        .bg-accent-2 {
            background-color: <?php echo esc_attr( $accent_color_2 ); ?>;
            color: white; /* Example text color on this background */
        }
        .border-accent-3 {
            border-color: <?php echo esc_attr( $accent_color_3 ); ?>;
        }
        .highlight-4 {
            background-color: <?php echo esc_attr( $accent_color_4 ); ?>;
        }
        /* You'll need to define specific CSS rules to apply these colors to your theme's elements */
    </style>
    <?php
}
add_action( 'wp_head', 'my_theme_customize_css' );
/* end theme color */