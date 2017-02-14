<div class="container-fluid page-slider">
    <?php
    foreach (filterBy(getContent('pages/' . $GLOBALS['page']->id . '/items'), 'identifier', 'page-slide') as $item) {
        $url = isset($item->image) ? $item->image->url : '';
        echo npEditor('div style="background-image: url(' . $GLOBALS['SERVER_URL'] . 'uploads/' . $url . ')"', 'row', $item, true);
        echo '</div>';
    }
    ?>
</div>

<div class="container-fluid dark-background">
    <div class="container breadcrumps">
        <span>Home</span>
        <span><?php echo isset($GLOBALS['page']->navigation) ? $GLOBALS['page']->navigation : $GLOBALS['page']->title ?></span>
    </div>
</div>