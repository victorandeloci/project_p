<?php
    $banner = get_page_by_path('banner', OBJECT, 'home');
    get_header();
?>

<main id="single">
    <div class="container">
        <?php get_template_part('parts/header_info'); ?>
        <div class="row post-title">
            <div class="column">
                <section class="banner-container">
                    <div class="cover" style="background-image: url(<?= get_post_meta($banner->ID, 'cover_small', true) ?>);"></div>
                </section>
            </div>
            <div class="column">
                <?php get_template_part('elements/links'); ?>
                <h1><?= get_the_title() ?></h1>
                <?php get_template_part('elements/post_details', null, [
                    'show_author' => true
                ]); ?>
                <p><?= get_the_excerpt() ?></p>
            </div>
        </div>
        <?php get_template_part('elements/nav'); ?>
        <div class="content post-content last-posts">
            <?php 
                if (!empty(get_post_meta(get_the_ID(), 'tag', true))) {
                    $tag = get_post_meta(get_the_ID(), 'tag', true);

                    $queryArgs = [
                        'post_type' => 'post',
                        'posts_per_page' => -1,
                        'tag' => $tag,
                        'order' => 'ASC'
                    ];
            
                    $query = new WP_Query( $queryArgs );
            
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            get_template_part('elements/post_item', null, [
                                'is_first' => false,
                                'show_player' => true
                            ]);
                        }
                    }
                }
            ?>
        </div>
    </div>    
</main>

<?php get_footer(); ?>
