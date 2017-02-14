<?php include 'np-templates/element_page_header.php' ?>

<div class="container page-content gallery-header">
    <h2><?php echo $GLOBALS['page']->navigation ?></h2>
</div>

<div class="container content-gallery">
    <div class="row">
        <?php
        $gallery = filterBy(getContent('galleries'), 'name', $GLOBALS['page']->navigation === 'Conference Room' ? 'Restaurant' : $GLOBALS['page']->navigation);
        $singleGallery = getContent('galleries/' . array_values($gallery)[0]->id . '/images');

        foreach ($singleGallery as $item) {
            echo '<div class="col-md-4"><a class="fancybox" rel="item-gallery" href="' . $GLOBALS['SERVER_URL'] . 'uploads/gallery/' . $item->url . '">';
            echo '<img src="' . $GLOBALS['SERVER_URL'] . 'uploads/thumbs/' . $item->url . '" alt="' . $item->alt . '">';
            echo '</a></div>';
        }
        ?>
    </div>
</div>
