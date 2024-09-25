<?php 
    /* Template Name: Playlists */
    get_header();
?>

<main id="page" class="playlists">
    <div class="container">
        <?php get_template_part('parts/header_info'); ?>
        <?php get_template_part('parts/banner_min', null, [
            'page_title' => get_the_title()
        ]); ?>
        <?php get_template_part('elements/nav'); ?>
        <div class="content post-content">
            <?=  get_the_content() ?>
        </div>
        <div class="lists">
            <?php
                $args = [
                    'post_type' => 'playlist',
                    'order' => 'DESC',
                    'posts_per_page' => -1
                ];
            
                $query = new WP_Query($args);
            
                if ($query->have_posts()) {
                    $i = 0;
                    while ($query->have_posts()) {                        
                        $query->the_post();

                        get_template_part('elements/playlist_item', null, [
                            'first' => ($i == 0)
                        ]);

                        $i++;
                    }
                }
            ?>
        </div>
    </div>    
</main>

<div id="playlistBox">
    <div id="playlistBoxHeader"></div>
    <iframe id="playlistBoxIframe" src="" frameborder="0"></iframe>
</div>

<?php get_footer(); ?>
