<?php
    // playlist items
    if (!empty(get_post_meta(get_the_ID(), 'tag', true))) {
        $tag = get_post_meta(get_the_ID(), 'tag', true);
        $order = get_post_meta(get_the_ID(), 'order', true);

        $queryArgs = [
            'post_type' => 'post',
            'posts_per_page' => -1,
            'tag' => $tag,
            'order' => (!empty($order) ? $order : 'ASC')
        ];

        $query = new WP_Query( $queryArgs );
    }

    $viewMode = $_GET['mode'];
    if (empty($viewMode) || $viewMode != 'player') :
        $banner = get_page_by_path('banner', OBJECT, 'home');
        get_header();
?>

    <main id="single">
        <div class="container">
            <?php get_template_part('parts/header_info'); ?>
            <div class="row post-title">
                <div class="column">
                    <section class="banner-container">
                        <div class="cover" style="background-image: url(<?= (empty(get_next_post())) ? (get_template_directory_uri() . '/assets/img/capybara/capy_' . rand(1, 18) . '-min.gif') : get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>);"></div>
                    </section>
                </div>
                <div class="column">
                    <?php get_template_part('elements/links'); ?>
                    <h1><?= get_the_title() ?></h1>
                    <?php get_template_part('elements/post_details', null, [
                        'show_author' => true
                    ]); ?>
                    <p><?= get_the_excerpt() ?></p>
                </div>
            </div>
            <?php get_template_part('elements/nav'); ?>
            <div class="content post-content last-posts">
                <?php 
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            get_template_part('elements/post_item', null, [
                                'is_first' => false,
                                'show_player' => true,
                                'show_rating' => true
                            ]);
                        }
                    }
                ?>
            </div>
        </div>    
    </main>

<?php 
    get_footer();
    elseif ($viewMode == 'player') :
?>
    <link rel="stylesheet" href="<?= get_template_directory_uri() ?>/style.css?v=<?= PP_VERSION ?>">
    <script src="<?= get_template_directory_uri() ?>/main.min.js?v=<?= PP_VERSION ?>" charset="utf-8" defer></script>
    <div id="playlistPlayerModal" class="aesthetic-windows-95-modal">
        <!-- Title Bar -->
        <div class="aesthetic-windows-95-modal-title-bar">
            <div class="aesthetic-windows-95-modal-title-bar-text">Playlist: <?= get_the_title() ?></div>

            <div class="aesthetic-windows-95-modal-title-bar-controls">
                <div class="aesthetic-windows-95-button-title-bar">
                <button onclick="window.close();">X</button>
                </div>
            </div>
        </div>

        <div class="aesthetic-windows-95-tabbed-container">
            <div class="aesthetic-windows-95-tabbed-container-tabs">
                <div class="aesthetic-windows-95-tabbed-container-tabs-button is-active">
                    <button>
                        About
                    </button>
                </div>
                <div class="aesthetic-windows-95-tabbed-container-tabs-button">
                    <button>
                        Disc
                    </button>
                </div>
                <div class="aesthetic-windows-95-tabbed-container-tabs-button">
                    <button>
                        View
                    </button>
                </div>
                <div class="aesthetic-windows-95-tabbed-container-tabs-button">
                    <button>
                        Options
                    </button>
                </div>
                <div class="aesthetic-windows-95-tabbed-container-tabs-button">
                    <button>
                        Help
                    </button>
                </div>                
            </div>

            <div class="aesthetic-windows-95-container excerpt-container">
                <?= get_the_excerpt() ?>
            </div>
        </div>

        <div id="playlistPlayer">
            <div class="row">
                <div class="column" id="playlistPlayerPosition">0:00</div>
                <div class="column controls">
                    <div class="aesthetic-windows-95-button large">
                        <button id="ppPlay" title="Play" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80L0 432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"/></svg>
                        </button>
                    </div>
                    <div class="aesthetic-windows-95-button">
                        <button id="ppPause" title="Pause" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M48 64C21.5 64 0 85.5 0 112L0 400c0 26.5 21.5 48 48 48l32 0c26.5 0 48-21.5 48-48l0-288c0-26.5-21.5-48-48-48L48 64zm192 0c-26.5 0-48 21.5-48 48l0 288c0 26.5 21.5 48 48 48l32 0c26.5 0 48-21.5 48-48l0-288c0-26.5-21.5-48-48-48l-32 0z"/></svg>
                        </button>
                    </div>
                    <div class="aesthetic-windows-95-button">
                        <button id="ppStop" title="Parar" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 128C0 92.7 28.7 64 64 64H320c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z"/></svg>
                        </button>
                    </div>
                    <div class="aesthetic-windows-95-button">
                        <button id="ppPrevious" title="Anterior" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M459.5 440.6c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29l0-320c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4L288 214.3l0 41.7 0 41.7L459.5 440.6zM256 352l0-96 0-128 0-32c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4l-192 160C4.2 237.5 0 246.5 0 256s4.2 18.5 11.5 24.6l192 160c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29l0-64z"/></svg>
                        </button>
                    </div>
                    <div class="aesthetic-windows-95-button">
                        <button id="ppBackward" title="-15s" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M267.5 440.6c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29l0-320c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4l-192 160L64 241 64 96c0-17.7-14.3-32-32-32S0 78.3 0 96L0 416c0 17.7 14.3 32 32 32s32-14.3 32-32l0-145 11.5 9.6 192 160z"/></svg>
                        </button>
                    </div>
                    <div class="aesthetic-windows-95-button">
                        <button id="ppForward" title="+15s" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M52.5 440.6c-9.5 7.9-22.8 9.7-34.1 4.4S0 428.4 0 416L0 96C0 83.6 7.2 72.3 18.4 67s24.5-3.6 34.1 4.4l192 160L256 241l0-145c0-17.7 14.3-32 32-32s32 14.3 32 32l0 320c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-145-11.5 9.6-192 160z"/></svg>
                        </button>
                    </div>
                    <div class="aesthetic-windows-95-button">
                        <button id="ppNext" title="Próximo" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M52.5 440.6c-9.5 7.9-22.8 9.7-34.1 4.4S0 428.4 0 416L0 96C0 83.6 7.2 72.3 18.4 67s24.5-3.6 34.1 4.4L224 214.3l0 41.7 0 41.7L52.5 440.6zM256 352l0-96 0-128 0-32c0-12.4 7.2-23.7 18.4-29s24.5-3.6 34.1 4.4l192 160c7.3 6.1 11.5 15.1 11.5 24.6s-4.2 18.5-11.5 24.6l-192 160c-9.5 7.9-22.8 9.7-34.1 4.4s-18.4-16.6-18.4-29l0-64z"/></svg>
                        </button>
                    </div>
                    <div class="aesthetic-windows-95-button">
                        <button title="Ejetar" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M224 32c13.5 0 26.3 5.6 35.4 15.6l176 192c12.9 14 16.2 34.3 8.6 51.8S419 320 400 320L48 320c-19 0-36.3-11.2-43.9-28.7s-4.3-37.7 8.6-51.8l176-192C197.7 37.6 210.5 32 224 32zM0 432c0-26.5 21.5-48 48-48l352 0c26.5 0 48 21.5 48 48s-21.5 48-48 48L48 480c-26.5 0-48-21.5-48-48z"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            <audio src="" class="playlist-audio" id="playlistAudio"></audio>
        </div>

        <div class="playlist-player-details">
            <div id="ppTrackSelector" class="aesthetic-windows-95-select">
                <select>
                    <option value="">Por favor, selecione uma faixa ou insira o disco</option>
                    <?php 
                        if ($query->have_posts()) :
                            foreach ($query->posts as $i => $post) :
                                $mp3Url = trim(get_post_meta($post->ID, 'episode_mp3_url', true));
                                if (!empty($mp3Url)) :
                                    ?>
                                        <option value="<?= $mp3Url ?>"><?= $post->post_title ?></option>
                                    <?php
                                endif;
                            endforeach;
                        endif;
                    ?>
                </select>
                <label class="aesthetic-windows-95-select-checkmark"></label>
            </div>
        </div>

    </div>
<?php endif; ?>
