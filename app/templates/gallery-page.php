<?php include 'templates/page-header.php' ?>

<div class="container content-gallery">
    <div class="row">
        <?php
        $galleryArgs = array('table' => 'gallery', 'ident' => 'page_id', 'identValue' => $GLOBALS['page']['page_id'], 'gallery-identify' => 'content-gallery', 'create' => true);
        $galleryItems = get_content($galleryArgs);
        while ($gallery = $galleryItems->fetch_assoc()) {
            echo '<div class="col-md-4">';
            echo '<a class="fancybox" rel="item-gallery" href="' . str_replace('\\', '/', $gallery['gallery_image']) . '">';
            echo '<img src="' . str_replace('\\', '/', $gallery['gallery_image']) . '" />';
            echo '</a>';
            echo '</div>';
        }
        ?>
    </div>
</div>