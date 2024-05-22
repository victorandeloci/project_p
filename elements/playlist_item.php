<div class="playlist-item">
    <div class="row">
        <div class="column glitch">
            <div class="thumb" style="background-image: url(<?= get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>);"></div>
        </div>
        <div class="column">
            <div class="info">
                <a href="<?= get_permalink() ?>"><h2><?= get_the_title() ?></h2></a>
                <p><?= get_the_excerpt() ?></p>
            </div>
            <?php if (!empty(get_post_meta(get_the_ID(), 'tag', true))) : ?>
                <ul>
                    <?php                         
                        $tag = get_post_meta(get_the_ID(), 'tag', true);
                        $order = get_post_meta(get_the_ID(), 'order', true);

                        $queryArgs = [
                            'post_type' => 'post',
                            'posts_per_page' => -1,
                            'tag' => $tag,
                            'order' => (!empty($order) ? $order : 'ASC')
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