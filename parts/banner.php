<?php 
  $banner = get_page_by_path('banner', OBJECT, 'home');
  if ($banner) :
?>

    <div class="cover" style="background-image: url(<?= get_the_post_thumbnail_url($banner->ID) ?>);">
        <h1 class="flick"><?= $banner->post_title ?></h1>
        <p class="flick"><?= get_post_meta($banner->ID, 'label', true) ?></p>
    </div>

<?php endif; ?>