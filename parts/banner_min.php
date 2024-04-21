<?php 
  $banner = get_page_by_path('banner', OBJECT, 'home');
  if ($banner) :
?>

    <section class="banner-container min">
        <div class="row">
            <div class="column">
                <div class="cover" style="background-image: url(<?= get_post_meta($banner->ID, 'cover_small', true) ?>);"></div>
            </div>
            <div class="column">
                <?php get_template_part('elements/links'); ?>
                <?php if (!empty($args['term_name']) || !empty($args['search']) || !empty($args['tag']) || !empty($args['page_title'])) : ?>
                    <h1><?= !empty($args['term_name']) 
                                ? $args['term_name'] 
                                : (!empty($args['search']) 
                                        ? ('<span>Busca por</span> ' . $args['search']) 
                                        : (!empty($args['tag']) 
                                                ? ('<span>Marcados em</span> #' . $args['tag']) 
                                                : $args['page_title'])) ?></h1>
                <?php endif; ?>
                <?php if (!empty($args['term_description'])) : ?>
                    <p><?= $args['term_description'] ?></p>
                <?php endif; ?>                
            </div>
        </div>
    </section>

<?php endif; ?>