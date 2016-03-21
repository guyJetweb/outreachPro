<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );
include_once( get_stylesheet_directory() . '/lib/theme-versions.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'outreach', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'outreach' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Outreach Pro Theme', 'outreach' ) );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/outreach/' );
define( 'CHILD_THEME_VERSION', '3.1' );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Enqueue Scripts
add_action( 'wp_enqueue_scripts', 'outreach_load_scripts' );
function outreach_load_scripts() {

	wp_enqueue_script( 'outreach-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
	
	wp_enqueue_style( 'dashicons' );
	
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:400,700', array(), CHILD_THEME_VERSION );

}

//* Add new image sizes
add_image_size( 'home-top', 1140, 460, TRUE );
add_image_size( 'home-bottom', 285, 160, TRUE );
add_image_size( 'sidebar', 300, 150, TRUE );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'height'          => 100,
	'width'           => 340,
) );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for additional color style options
add_theme_support( 'genesis-style-selector', array(
	'outreach-color-one' 	=>	__( 'Outreach Color One', 'outreach' ),
	'outreach-color-two' 	=>	__( 'Outreach Color Two', 'outreach' ),
) );

//* Add shortcode support for widgets
add_filter('widget_text', 'do_shortcode');


//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'site-inner',
	'footer-widgets',
	'footer',
) );

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'outreach_author_box_gravatar_size' );
function outreach_author_box_gravatar_size( $size ) {

    return '80';
    
}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'outreach_remove_comment_form_allowed_tags' );
function outreach_remove_comment_form_allowed_tags( $defaults ) {
	
	$defaults['comment_notes_after'] = '';
	return $defaults;

}

//* Add the sub footer section
add_action( 'genesis_before_footer', 'outreach_sub_footer', 5 );
function outreach_sub_footer() {

	if ( is_active_sidebar( 'sub-footer-left' ) || is_active_sidebar( 'sub-footer-right' ) ) {
		echo '<div class="sub-footer"><div class="wrap">';
		
		   genesis_widget_area( 'sub-footer-left', array(
		       'before' => '<div class="sub-footer-left">',
		       'after'  => '</div>',
		   ) );
	
		   genesis_widget_area( 'sub-footer-right', array(
		       'before' => '<div class="sub-footer-right">',
		       'after'  => '</div>',
		   ) );
	
		echo '</div><!-- end .wrap --></div><!-- end .sub-footer -->';	
	}
	
}

//* Add support for 4-column footer widgets
add_theme_support( 'genesis-footer-widgets', 4 );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Relocate after entry widget
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-top',
	'name'        => __( 'Home - Top', 'outreach' ),
	'description' => __( 'This is the top section of the Home page.', 'outreach' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-middle',
	'name'        => __( 'Home - Middle', 'outreach' ),
	'description' => __( 'This is the middle section of the Home page.', 'outreach' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-bottom',
	'name'        => __( 'Home - Bottom', 'outreach' ),
	'description' => __( 'This is the bottom section of the Home page.', 'outreach' ),
) );
genesis_register_sidebar( array(
	'id'          => 'sub-footer-left',
	'name'        => __( 'Sub Footer - Left', 'outreach' ),
	'description' => __( 'This is the left section of the sub footer.', 'outreach' ),
) );
genesis_register_sidebar( array(
	'id'          => 'sub-footer-right',
	'name'        => __( 'Sub Footer - Right', 'outreach' ),
	'description' => __( 'This is the right section of the sub footer.', 'outreach' ),
) );

//* site footer 
add_filter('genesis_footer_creds_text', 'jetweb_site_footer_creds');
function jetweb_site_footer_creds( $creds ) {
	$creds = '&middot; [footer_copyright] &middot;';
	return $creds;
}

function ep_service_shchema_meta() {
    $areaServed = get_field("area_served");
    $availableChannel = get_field("available_channel");
    $Category = get_field("category");
    $serviceType = get_field("service_type");
    $additionalType = get_field("additional_type");
    $description = get_the_excerpt();
    $url = get_the_permalink();
    
    ?>
<meta itemprop="areaServed" content="<?php echo $areaServed ?>">
<meta itemprop="availableChannel" content="<?php echo $availableChannel ?>">
<meta itemprop="Category" content="<?php echo $Category ?>">
<meta itemprop="serviceType" content="<?php echo $serviceType ?>">
<meta itemprop="additionalType" content="<?php echo $additionalType ?>">

<?php if (is_archive()): ?>
<meta itemprop="description" content="<?php echo $description ?>">
<?php endif; ?>
<meta itemprop="url" content="<?php echo $url ?>">
<?php
}

function ep_service_genesis_attributes_entry_title($attributes) {
     $attributes['itemprop']  = 'name';
		return $attributes;
}

function ep_service_genesis_attributes_entry( $attributes ) {
    $attributes['itemtype']  = 'http://schema.org/Service';
		return $attributes;
}