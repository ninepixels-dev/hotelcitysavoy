<?php include 'np-templates/element_page_header.php' ?>

<div class="container page-content">
    <?php
    $contentPage = getContent('pages/' . $GLOBALS['page']->id . '/items');
    foreach (filterBy($contentPage, 'identifier', 'page-content') as $item) {
        echo npEditor('div', 'row', $item, true);
        echo '<div class="col-md-5">' . $item->structure . '</div>';
        echo '<div class="col-md-7"><div class="image_holder">';
        echo npImage($item, '', 'gallery');
        echo '</div></div>';
        echo '</div>';
    }
    ?>
</div>

<div class="container few-words">
    <div class="row">
        <?php
        $homePage = getContent('pages/1/items');
        foreach (filterBy($homePage, 'identifier', 'few-words') as $item) {
            echo npEditor('div', 'col-md-4', $item, true);
            echo npImage($item, '', 'thumbs');
            echo '<span class="teaser">' . $item->structure . '</span>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<div class="container-fluid hotel-facts dark-background">
    <div class="row">
        <div class="col-md-6">
            <?php
            foreach (filterBy($contentPage, 'identifier', 'hotel-facts-image') as $item) {
                echo npEditor('div', 'image-holder', $item, true);
                echo npImage($item, '', 'gallery');
                echo '</div>';
            }
            ?>
        </div>
        <div class="col-md-6">
            <?php
            foreach (filterBy($contentPage, 'identifier', 'hotel-facts') as $item) {
                echo npEditor('div', 'col-md-6', $item, true);
                echo npImage($item, 'facts-icon', 'thumbs');
                echo '<span class="teaser">' . $item->structure . '</span>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>

<br><br>