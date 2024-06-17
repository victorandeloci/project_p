<?php 
    if (!empty($args['post_id'])) :
        $rating = trim(get_post_meta($args['post_id'], 'rating', true));
        if (!empty($rating)) :
            ?>
                <div class="rating-container <?= (is_numeric($rating) ? 'numeric-rating' : '') ?>">
                    <span><?= pp_getRatingLabel($rating) ?></span>
                </div>
            <?php
        endif;
    endif;
?>
