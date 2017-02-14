<?php include 'np-templates/element_page_header.php' ?>

<div class="container page-content list-view">
    <h2><?php echo $GLOBALS['page']->navigation ?></h2>
    <div class="row">
        <?php
        $toolbar = $GLOBALS['WITHOUT_TOOLBAR'] ? '?toolbar=false' : '';
        foreach (getChild($GLOBALS['page'], 0) as $s_page) {
            echo '<div class="col-md-4 list-view-item"><a href="/' . $s_page->name . $toolbar .'">';
            echo npImage($s_page, '');
            echo '<div class="gallery_label"><span class="title-symbol">' . $s_page->navigation . '</span></div>';
            echo '</a></div>';
        }
        ?>
    </div>
</div>
