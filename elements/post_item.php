<? $post = $args['post']; ?>

<div class="post-item">
    <div class="row">
        <div class="column">
            <a href="<?= get_permalink($post->ID) ?>">
                <?php if (!empty($args['is_first']) && $args['is_first'] == true) : ?>
                    <img src="<?= get_the_post_thumbnail_url($post->ID, 'medium'); ?>" class="thumb" alt="<?= get_the_title($post->ID) ?>">
                <?php else : ?>
                    <img 
                        class="thumb"
                        alt="<?= $post->post_title ?>"
                        src="<?= get_template_directory_uri($post->ID) . '/assets/img/default-image.jpg' ?>"
                        lazy-load-img="<?= get_the_post_thumbnail_url($post->ID, 'medium'); ?>"
                    >
                <?php endif; ?>  
            </a>
        </div>
        <div class="column">
            <a href="<?= get_permalink($post->ID) ?>"><h3><?= $post->post_title ?></h3></a>
            <?php get_template_part('elements/post_details'); ?>
            <div class="post-content">
                <?php if (!empty($args['is_first']) && $args['is_first'] == true) : ?>
                    <?php get_template_part('elements/podcast_player'); ?>
                    <?php 
                        if (!empty($args['show_rating']) && $args['show_rating'] == true) {
                            get_template_part('elements/podcast_rating', null, [
                                'post_id' => $post->ID
                            ]);
                        }
                    ?>
                    <?=  $post->post_content ?>
                <?php elseif (!empty($args['show_player']) && $args['show_player'] == true) : ?>
                    <?php get_template_part('elements/podcast_player'); ?>
                    <?= get_the_excerpt($post->ID) ?>
                    <?php 
                        if (!empty($args['show_rating']) && $args['show_rating'] == true) {
                            get_template_part('elements/podcast_rating', null, [
                                'post_id' => $post->ID
                            ]);
                        }
                    ?>
                <?php else : ?>
                    <?= get_the_excerpt($post->ID) ?>
                    <?php 
                        if (!empty($args['show_rating']) && $args['show_rating'] == true) {
                            get_template_part('elements/podcast_rating', null, [
                                'post_id' => $post->ID
                            ]);
                        }
                    ?>
                <?php endif; ?>                
            </div>            
            <?php get_template_part('elements/tags_container', null, [
                'show_least' => true
            ]); ?>
        </div>
    </div>
</div>