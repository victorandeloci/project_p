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
                                get_template_part('elements/post_item_simple');
                            endwhile;
                        endif;
                ?>
            </ul>                
            <?php endif; ?>
        </div>
    </div>
</div>