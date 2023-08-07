<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= bloginfo('name') ?></title>

    <?php wp_head(); ?>

    <link rel="stylesheet" href="<?= get_template_directory_uri() ?>/style.css?v=<?= PP_VERSION ?>">

    <script>
      const siteUrl = '<?= get_site_url() ?>';
      const apiUrl = '<?= get_site_url() ?>/wp-admin/admin-ajax.php';
    </script>
    <script src="<?= get_template_directory_uri() ?>/main.min.js?v=<?= PP_VERSION ?>" charset="utf-8" defer></script>
  </head>
  <body style="background-image: url(<?= get_template_directory_uri() ?>/assets/img/wall_7.jpeg);">
    <div class="overlay"></div>
