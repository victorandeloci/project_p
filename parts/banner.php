<?php 
  $banner = get_page_by_path('banner', OBJECT, 'home');
  if ($banner) :
?>

    <section id="banner">
        <div class="container">
            <div class="cover" style="background-image: url(<?= get_the_post_thumbnail_url($banner->ID) ?>);">
                <h1><?= $banner->post_title ?></h1>
                <p><?= get_post_meta($banner->ID, 'label', true) ?></p>
            </div>
        </div>
    </section>

<?php endif; ?>