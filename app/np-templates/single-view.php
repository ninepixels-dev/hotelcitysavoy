<?php include 'np-templates/element_page_header.php' ?>

<div class="container few-words">
    <div class="row">
        <?php
        $singleViewPage = getContent('pages/' . $GLOBALS['page']->id . '/items');
        foreach (filterBy($singleViewPage, 'identifier', 'few-words') as $item) {
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
            foreach (filterBy($singleViewPage, 'identifier', 'hotel-facts-image') as $item) {
                echo npEditor('div', 'image-holder', $item, true);
                echo npImage($item, '', 'gallery');
                echo '</div>';
            }
            ?>
        </div>
        <div class="col-md-6">
            <?php
            foreach (filterBy($singleViewPage, 'identifier', 'hotel-facts') as $item) {
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