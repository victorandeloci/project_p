<div class="post-item">
    <div class="row">
        <div class="column">
            <a href="<?= get_permalink() ?>">
                <?php if (!empty($args['is_first']) && $args['is_first'] == true) : ?>
                    <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" class="thumb" alt="<?= get_the_title() ?>">
                <?php else : ?>
                    <img 
                        class="thumb"
                        alt="<?= get_the_title() ?>"
                        src="<?= get_template_directory_uri() . '/assets/img/default-image.png' ?>"
                        lazy-load-img="<?= get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>"
                    >
                <?php endif; ?>  
            </a>
        </div>
        <div class="column">
            <a href="<?= get_permalink() ?>"><h3><?= get_the_title() ?></h3></a>
            <?php get_template_part('elements/post_details'); ?>
            <div class="post-content">
                <?php if (!empty($args['is_first']) && $args['is_first'] == true) : ?>
                    <?php get_template_part('elements/podcast_player'); ?>
                    <?=  get_the_content() ?>
                <?php else : ?>
                    <?= get_the_excerpt() ?>
                <?php endif; ?>                
            </div>
            <?php get_template_part('elements/tags_container'); ?>
        </div>
    </div>
</div>