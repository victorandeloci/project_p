<?php get_header(); ?>

<main id="page">
    <div class="overlay"></div>
    <div class="container">
        <?php get_template_part('parts/header_info'); ?>
        <?php get_template_part('parts/banner_min', null, [
            'page_title' => get_the_title()
        ]); ?>
        <?php get_template_part('elements/nav'); ?>
        <div class="content post-content">
            <?=  get_the_content() ?>
        </div>
    </div>    
</main>

<?php get_footer(); ?>
