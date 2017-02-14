<?php include 'np-templates/element_page_header.php' ?>

<div class="container page-content room-single-content">
    <div class="row">
        <div class="col-md-6">
            <?php
            $gallery = filterBy(getContent('galleries'), 'name', $GLOBALS['page']->navigation);
            $singleGallery = getContent('galleries/' . array_values($gallery)[0]->id . '/images');

            echo '<div class="room-single-teaser">';
            echo '<a class="fancybox" rel="item-gallery" href="' . $GLOBALS['SERVER_URL'] . 'uploads/gallery/' . array_values($singleGallery)[0]->url . '">';
            echo '<img src="' . $GLOBALS['SERVER_URL'] . 'uploads/gallery/' . array_values($singleGallery)[0]->url . '" alt="' . array_values($singleGallery)[0]->alt . '">';
            echo '</a>';
            echo '</div>';

            echo '<div class="room-single-gallery">';
            foreach ($singleGallery as $item) {
                echo '<a class="fancybox" rel="item-gallery" href="' . $GLOBALS['SERVER_URL'] . 'uploads/gallery/' . $item->url . '">';
                echo '<img src="' . $GLOBALS['SERVER_URL'] . 'uploads/thumbs/' . $item->url . '" alt="' . $item->alt . '">';
                echo '</a>';
            }
            echo '</div>';
            ?>
        </div>
        <div class="col-md-6 room-description">
            <?php
            echo '<h2>' . $GLOBALS['page']->navigation . '</h2>';

            $roomsSingleItems = getContent('pages/' . $GLOBALS['page']->id . '/items');
            foreach (filterBy($roomsSingleItems, 'identifier', 'room-single-item') as $item) {
                echo npEditor('div', '', $item, true);
                echo '<span>' . $item->structure . '</span>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>