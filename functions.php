<?php
/**
 * Plugins
 */

if ( ! defined( 'RP_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'RP_VERSION', '1.0.0' );
}

/**
 * theme setup
 */
function rapidpress_setup() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
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

  // register menus
  register_nav_menus(
    array(
      'main' => esc_html__('Primary', 'rapidpress')
    )
  );

  // core custom logo
  add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

  // disable admin bar for everyone
  add_filter('show_admin_bar', '__return_false');

  // disallow wpadmin file edit
  define('DISALLOW_FILE_EDIT', true);

  // disable gravatar
  update_option( 'show_avatars', 0 );

  // enable acf options page
  if(function_exists('acf_add_options_page')) {
    acf_add_options_page();
  }
}
add_action('after_setup_theme', 'rapidpress_setup');

/**
 * enqueue scripts and styles.
 */
function rapidpress_scripts() {
	// css
	wp_enqueue_style(
    'rapidpress-style',
    get_stylesheet_directory_uri() . '/style.css',
    array(),
    '1.0.0'
  );

	// scripts
	wp_enqueue_script( 
		'rapidpress-scripts',
		get_template_directory_uri() . '/.interpress/build/script.js',
		array(),
		'1.0.0',
		true
	);

  // gulp livereload
  if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
    wp_register_script(
      'livereload', 
      'http://localhost:35729/livereload.js?snipver=1', 
      null, 
      false, 
      true
    );
    wp_enqueue_script('livereload');
  }

	// remove block editor css libraries
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_dequeue_style('wc-blocks-style'); // woocommerce block css
}
add_action( 'wp_enqueue_scripts', 'rapidpress_scripts' );

/**
 * modify user fields in admin
 */
function modify_user_fields($profile_fields) {
  // add fields
  $profile_fields['example'] = 'Custom Field Example';

  // remove fields
  unset($profile_fields['twitter']);
  unset($profile_fields['facebook']);
  unset($profile_fields['linkedin']);
  unset($profile_fields['instagram']);

  // legacy
  unset($profile_fields['aim']);
  unset($profile_fields['url']);
  unset($profile_fields['yim']);
  unset($profile_fields['jabber']);

  return $profile_fields;
}
add_filter('user_contactmethods', 'modify_user_fields');

/**
 * remove admin color options
 */
function admin_color_scheme() {
  global $_wp_admin_css_colors;
  $_wp_admin_css_colors = array(0);
 }
add_action('admin_head', 'admin_color_scheme');

/**
 * custom post excerpt
 */
function custom_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

function new_excerpt_more($more) {
	global $post;
	return '<a class="etag" href="'. get_permalink($post->ID) . '">...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * update 'author' permalink to 'user'
 */
function change_author_permalinks() {
	global $wp_rewrite;
	$wp_rewrite->author_base = 'user';
}
add_action('init','change_author_permalinks');

/**
 * wpadmin footer credentials
 */
function remove_footer_admin() {
  echo 'update me in functions.php';
}
add_filter('admin_footer_text', 'remove_footer_admin');

/**
 * update email content type to support html
 */
function email_set_content_type(){
  return "text/html";
}
add_filter( 'wp_mail_content_type','email_set_content_type' );

/**
 * acf local json
 */
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point($path) {
	$path = get_stylesheet_directory() . '/acf-json';
	return $path;
}

/**
 * disable wp emoji
 */
function disable_emojis() {
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles'); 
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji'); 
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

	add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
	add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}
add_action('init', 'disable_emojis');

function disable_emojis_tinymce($plugins) {
	if(is_array($plugins)) {
		return array_diff($plugins, array('wpemoji'));
	} else {
		return array();
	}
}

function disable_emojis_remove_dns_prefetch($urls, $relation_type) {
	if ('dns-prefetch' == $relation_type) {
		$emoji_svg_url = apply_filters(
      'emoji_svg_url', 
      'https://s.w.org/images/core/emoji/2/svg/'
    );
 		$urls = array_diff($urls, array($emoji_svg_url));
	}
	return $urls;
}
