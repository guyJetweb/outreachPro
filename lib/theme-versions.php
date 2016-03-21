<?php

add_theme_support( /*exterminatro-version-selctor */'ver_style_selctor', array(
        '' 	=>	__( 'Defult', 'outreach' ),
	'ver-one' 	=>	__( 'version one', 'outreach' ),
	'ver-two' 	=> 	__( 'version two', 'outreach' ),
	'ver-three' 	=> 	__( 'version three', 'outreach' ),
) );

add_theme_support("exterminator_theme_colors");


$current_style=genesis_get_option('ver-style');

 if ($current_style == 'ver-two') {
        add_theme_support('genesis-structural-wraps', array(
            'header',
            'nav',
            'subnav',
            'footer-widgets',
            'footer',
        ));

     add_action('template_redirect','outreach_ver_two_actions');
}

function outreach_ver_two_actions() {
    if (is_front_page()) {
        remove_action( 'genesis_before_footer', 'outreach_sub_footer', 5 );
        add_action('genesis_after_loop', 'outreach_sub_footer');

        add_action('genesis_before_footer','outreach_ver_two_open_middle_wrapper',1);
        add_action('genesis_before_footer','outreach_ver_two_close_middle_wrapper',3);
    }
}

function outreach_ver_two_open_middle_wrapper() {
    echo '<div id="after-slider-container"><div class="wrap">';
}

function outreach_ver_two_close_middle_wrapper() {
    echo '</div></div>';
}

add_action('wp_head','outreach_color_styles',100);

function outreach_color_styles() {
    
    $color1 = '#' . genesis_get_option('ep-color1');
    $color2 = '#' . genesis_get_option('ep-color2');

    ?>
<style>
    .content .entry-title a:hover,
.content #genesis-responsive-slider a,
.content #genesis-responsive-slider h2 a:hover,
.nav-secondary .genesis-nav-menu .current-menu-item > a,
.nav-secondary .genesis-nav-menu .sub-menu a:hover,
.nav-secondary .genesis-nav-menu a:hover,
.nav-secondary .genesis-nav-menu li:hover > a,
.widget-title,
 a {
    color: <?php echo $color1 ?>;
}

.archive-pagination .active a,
.archive-pagination li a:hover,
.button,
.nav-primary,
button,
input[type="button"],
input[type="reset"],
input[type="submit"] {
    background-color: <?php echo $color1 ?>;
    color: #fff;
}

.button:hover,
.site-header,
button:hover,
input:hover[type="button"],
input:hover[type="reset"],
input:hover[type="submit"] {
    background-color: <?php echo $color2 ?>;
    color: #fff;
}

a:hover {
  color:   <?php echo $color2 ?>
}
body,
.footer-widgets,
.site-footer {
    background-color: <?php echo $color1 ?>;
}

.ver-one .site-header .widget-area a {
    color: <?php echo $color1 ?>;
}

.ver-three .genesis-nav-menu .current-menu-item > a,
.ver-three .genesis-nav-menu .sub-menu .current-menu-item > a:hover,
.ver-three .genesis-nav-menu a:hover,
.ver-three .genesis-nav-menu li:hover > a ,
.ver-three .site-header .header-widget-area a:hover,
.ver-two .site-header .header-widget-area a:hover,
.home .ver-three .title-area a,
.home .ver-three .entry-title a{
    color: <?php echo $color1 ?> !important;
}

    .sidebar .widget a:hover {
        color: <?php echo $color1 ?>;
    }
</style>
    <?php
}




