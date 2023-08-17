<?php
    $podcastCategory = get_category_by_slug('podcast');
    $categories = get_categories([
        'child_of' => $podcastCategory->term_id
    ]);
    if (!empty($categories)) :
?>
    <div class="category-selector">
        <select name="category_selector" id="category_selector">
            <option value="">Filtrar por quadro</option>
            <?php foreach ($categories as $cat) : ?>
                <option value="<?= $cat->slug ?>"><?= $cat->name ?></option>
            <?php endforeach; ?>
        </select>
    </div>
<?php endif; ?>