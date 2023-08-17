<?php 
    get_header();
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $tag = explode('/', substr($url, strpos($url, 'tag/') + 4))[0];
?>

<main id="tag">
    <div class="container">
        <?php get_template_part('parts/header_info'); ?>
        <?php get_template_part('parts/banner_min', null, [
            'tag' => $tag
        ]); ?>
        <?php get_template_part('elements/nav'); ?>
        <?php get_template_part('elements/category_selector'); ?>
        <?php get_template_part('parts/last_posts', null, [
            'tag' => $tag
        ]); ?>
    </div>    
</main>

<?php get_footer(); ?>
