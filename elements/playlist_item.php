<?php $playlistLink = get_permalink(); ?>

<div class="playlist-item">
    <div class="row">
        <div class="column glitch">
            <a 
                href="<?= $playlistLink ?>" 
                class="thumb" 
                style="background-image: url(<?= get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>);"
                title="<?= get_the_title() ?>"
            >
            </a>
        </div>
        <div class="column">
            <div class="info">
                <a href="<?= $playlistLink ?>"><h2><?= get_the_title() ?></h2></a>
                <p><?= get_the_excerpt() ?></p>
            </div>
            <?php 
                if (!empty(get_post_meta(get_the_ID(), 'tag', true))) :
                    $tag = get_post_meta(get_the_ID(), 'tag', true);

                    if ($args['first']) :
            ?>
                        <ul>
                            <?php
                                $order = get_post_meta(get_the_ID(), 'order', true);

                                $queryArgs = [
                                    'post_type' => 'post',
                                    'posts_per_page' => -1,
                                    'tag' => $tag,
                                    'order' => (!empty($order) ? $order : 'ASC')
                                ];
                        
                                $query = new WP_Query( $queryArgs );
                        
                                if ($query->have_posts()) {
                                    while ($query->have_posts()) {
                                        $query->the_post();
                                        get_template_part('elements/post_item_simple');
                                    }
                                }
                            ?>
                        </ul>
            <?php   
                    else :
                        $queryArgs = [
                            'post_type' => 'post',
                            'posts_per_page' => -1,
                            'tag' => $tag,
                            'order' => (!empty($order) ? $order : 'ASC')
                        ];
                
                        $query = new WP_Query( $queryArgs );
                
                        if ($query->have_posts()) :
                            $totalPosts = count($query->posts);

                            $totalDuration = 0;
                            foreach ($query->posts as $post) {
                                $duration = trim(get_post_meta($post->ID, 'episode_duration', true));
                                sscanf($duration, "%d:%d:%d", $hours, $minutes, $seconds);
                                $totalDuration += isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
                            }
                            $totalDuration = sprintf('%02dh %02dmin', ($totalDuration / 3600), (intval($totalDuration / 60) % 60));

                            ?>
                                <div class="details playlist-items-details">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 80C149.9 80 62.4 159.4 49.6 262c9.4-3.8 19.6-6 30.4-6c26.5 0 48 21.5 48 48V432c0 26.5-21.5 48-48 48c-44.2 0-80-35.8-80-80V384 336 288C0 146.6 114.6 32 256 32s256 114.6 256 256v48 48 16c0 44.2-35.8 80-80 80c-26.5 0-48-21.5-48-48V304c0-26.5 21.5-48 48-48c10.8 0 21 2.1 30.4 6C449.6 159.4 362.1 80 256 80z"/></svg>
                                    <span><?= $totalPosts . (($totalPosts > 1) ? ' episódios' : ' episódio') ?></span>
                                    
                                    <?php if (!empty($totalDuration)) : ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>
                                        <span><?= $totalDuration ?></span>
                                    <?php endif; ?>                                    
                                </div>
                                <a href="<?= $playlistLink ?>" class="btn blue">Ouvir playlist</a>
                            <?php
                        endif;
                    endif;
                endif;
            ?>
        </div>
    </div>
</div>