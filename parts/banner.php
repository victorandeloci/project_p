<?php 
  $banner = get_page_by_path('banner', OBJECT, 'home');
  if ($banner) :
?>

    <section class="banner-container">
      <img src="<?= get_the_post_thumbnail_url($banner->ID) ?>" alt="Podcast cover" class="cover">
      <?php get_template_part('elements/links'); ?>
      <?= $banner->post_content ?>
    </section>

<?php endif; ?>