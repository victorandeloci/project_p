<div class="playlist-item">
    <div class="row">
        <div class="column glitch">
            <div class="thumb" style="background-image: url(<?= get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>);"></div>
            <div class="glitch__layers">
                <div class="glitch__layer" style="background-image: url(<?= get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>);"></div>
                <div class="glitch__layer" style="background-image: url(<?= get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>);"></div>
                <div class="glitch__layer" style="background-image: url(<?= get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>);"></div>
            </div>
        </div>
        <div class="column">
            <div class="info">
                <h2><?= get_the_title() ?></h2>
                <p><?= get_the_excerpt() ?></p>
            </div>
            <ul>
                <?php 
                    if (!empty(get_post_meta(get_the_ID(), 'tag', true))) :
                        $tag = get_post_meta(get_the_ID(), 'tag', true);

                        $queryArgs = [
                            'post_type' => 'post',
                            'posts_per_page' => -1,
                            'tag' => $tag,
                            'order' => 'ASC'
                        ];
                
                        $query = new WP_Query( $queryArgs );
                
                        if ($query->have_posts()) :
                            while ($query->have_posts()) :
                                $query->the_post();
                        ?>
                                <li class="post-item simple">
                                    <a href="<?= get_permalink() ?>"><h3><?= get_the_title() ?></h3></a>
                                    <div class="details">
                                        <?php if (!empty(trim(get_post_meta(get_the_ID(), 'episode_duration', true)))) : ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>
                                            <span><?= trim(get_post_meta(get_the_ID(), 'episode_duration', true)) ?></span>
                                        <?php endif; ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M128 0c13.3 0 24 10.7 24 24V64H296V24c0-13.3 10.7-24 24-24s24 10.7 24 24V64h40c35.3 0 64 28.7 64 64v16 48V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V192 144 128C0 92.7 28.7 64 64 64h40V24c0-13.3 10.7-24 24-24zM400 192H48V448c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V192zM329 297L217 409c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47 95-95c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
                                        <span><?= get_the_date('d/m/Y', get_the_ID()) ?></span>
                                    </div>
                                </li>
                        <?php
                            endwhile;
                        endif;
                ?>
            </ul>                
            <?php endif; ?>
        </div>
    </div>
</div>