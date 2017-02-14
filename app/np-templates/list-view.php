<?php include 'np-templates/element_page_header.php' ?>

<div class="container page-content list-view">
    <h2><?php echo $GLOBALS['page']->navigation ?></h2>
    <div class="row">
        <?php
        foreach (getChild($GLOBALS['page']) as $s_page) {
            echo '<div class="col-md-4 list-view-item"><a href="/' . $s_page->name . '">';
            echo npImage($s_page, '', 'gallery');
            echo '<div class="list-view-item__description">' . $s_page->navigation . '</div>';
            echo '</a></div>';
        }
        ?>
    </div>
</div>
