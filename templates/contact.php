<?php 
    /* Template Name: Contato */
    get_header();
?>

<main id="page" class="contact">
    <div class="container">
        <?php get_template_part('parts/header_info'); ?>
        <?php get_template_part('parts/banner_min', null, [
            'page_title' => get_the_title()
        ]); ?>
        <?php get_template_part('elements/nav'); ?>
        <div class="content post-content">
            <?=  get_the_content() ?>
            <?php get_template_part('elements/social_links'); ?>
        </div>
        <form id="contactForm">
            <input placeholder="Nome" type="text" name="name" id="name" required>
            <input placeholder="E-mail" type="email" name="email" id="email" required>
            <textarea placeholder="Mensagem" name="message" id="message"></textarea>
            <button type="submit">Enviar</button>
        </form>
    </div>    
</main>

<?php get_footer(); ?>
