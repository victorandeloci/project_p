<?php

define('PP_VERSION', '1.4.1');

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

  register_post_type( 'playlist',
    [
      'labels' => [
        'name' => __( 'Playlists' ),
        'singular_name' => __( 'Playlists' )
      ],
      'public' => true,
      'has_archive' => true,
      'rewrite' => ['slug' => 'playlist'],
      'show_in_rest' => true,
			'supports' => ['title', 'excerpt', 'thumbnail', 'custom-fields']
    ]
  );
}
add_action( 'init', 'create_custom_posttypes' );

// ========== CONTACT ==========

function pp_contact() {
  $to = 'contato@podcastporao.com.br';

  $name   = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
  $email  = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
  $msg  = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

  $headers = ['Content-Type: text/html; charset=ISO-8859-1'];

  $message .= 'Nome: ' . $name . '<br/>' .
              'E-mail: ' . $email . '<br/>' .
              'Mensagem: ' . $msg . '<br/>';

              $sentMail = wp_mail( $to, 'Formul&aacute;rio de Contato', $message, $headers);

              if ($sentMail)
                echo 'Obrigado pelo contato!';
              else
                echo 'Ocorreu um erro ao entregar sua mensagem!';

	die();
}
add_action('wp_ajax_pp_contact', 'pp_contact');
add_action('wp_ajax_nopriv_pp_contact', 'pp_contact');