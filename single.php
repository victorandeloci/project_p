<?php get_header(); ?>

<main id="single">
    <div class="container">
        <?php get_template_part('parts/header_info'); ?>
        <div class="row post-title">
            <div class="column">
                <section class="banner-container">
                    <div class="cover" style="background-image: url(<?= get_the_post_thumbnail_url() ?>);"></div>                    
                </section>
            </div>
            <div class="column">
                <?php get_template_part('elements/links'); ?>
                <h1><?= get_the_title() ?></h1>
                <?php get_template_part('elements/post_details', null, [
                    'show_author' => true
                ]); ?>
                <?php
                    get_template_part('elements/podcast_rating', null, [
                        'post_id' => get_the_ID()
                    ]);
                ?>
            </div>
        </div>
        <?php get_template_part('elements/nav'); ?>
        <div class="content post-content">
            <?php get_template_part('elements/podcast_player'); ?>
            <?=  get_the_content() ?>
        </div>
        <?php get_template_part('elements/tags_container'); ?>
    </div>    
</main>

<?php get_footer(); ?>
