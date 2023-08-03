<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= bloginfo('name') ?></title>

    <?php wp_head(); ?>

    <link rel="stylesheet" href="<?= get_template_directory_uri() ?>/style.css?v=1.0.0">

    <script>
      const siteUrl = '<?= get_site_url() ?>';
    </script>
    <script src="<?= get_template_directory_uri() ?>/main.min.js?v=1.0.0" charset="utf-8" defer></script>
  </head>
  <body style="background-image: url(<?= get_template_directory_uri() ?>/assets/img/wall_4.jpeg);">
