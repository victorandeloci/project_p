<?php 
    get_header();
    $search = filter_var($_GET['s'], FILTER_UNSAFE_RAW) ?? '';
?>

<main id="search">
    <div class="overlay"></div>
    <div class="container">
        <?php get_template_part('parts/header_info'); ?>
        <?php get_template_part('parts/banner_min', null, [
            'search' => $search
        ]); ?>
        <?php get_template_part('elements/nav'); ?>
        <?php get_template_part('elements/category_selector'); ?>
        <?php get_template_part('parts/last_posts', null, [
            'search' => $search
        ]); ?>
    </div>    
</main>

<?php get_footer(); ?>
