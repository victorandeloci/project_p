<?php

add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-logo' );

function add_nav_menus() {
	register_nav_menu('header-menu',__('Header Menu'));
	register_nav_menu('footer-menu',__('Footer Menu'));
}
add_action('init','add_nav_menus');

function excerpt($limit, $postId = null) {
  if ($postId)
    $excerpt = explode(' ', get_the_excerpt($postId), $limit);
  else
    $excerpt = explode(' ', get_the_excerpt(), $limit);

  if (count($excerpt) >= $limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).' [...]';
  } else {
    $excerpt = implode(" ",$excerpt);
  }

  $excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
  return $excerpt;
}

function create_custom_posttypes() {
  register_post_type( 'home',
    array(
      'labels' => array(
        'name' => __( 'Home Content' ),
        'singular_name' => __( 'Home Content' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'home'),
      'show_in_rest' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields')
    )
  );
}
add_action( 'init', 'create_custom_posttypes' );