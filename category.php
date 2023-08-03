<?php 
    get_header();
    $term = get_queried_object();
?>

<main id="category">
    <div class="overlay"></div>
    <div class="container">
        <?php get_template_part('parts/banner'); ?>
        <?php get_template_part('elements/nav'); ?>
        <?php get_template_part('elements/category_selector'); ?>
        <?php get_template_part('parts/last_posts', null, [
            'category_slug' => $term->slug
        ]); ?>
    </div>    
</main>

<?php get_footer(); ?>
