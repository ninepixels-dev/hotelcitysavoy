<?php include 'np-templates/element_page_header.php' ?>

<div class="container page-content blog-content">
    <div class="row">
        <?php
        $toolbar = $GLOBALS['WITHOUT_TOOLBAR'] ? '?toolbar=false' : '';
        $blogPage = getContent('blogs');
        foreach ($blogPage as $item) {
            echo '<div class="col-md-6 blog-item"><a href="' . $item->name . $toolbar . '">';
            echo '<div class="image_holder">';
            echo npImage($item, '', 'gallery');
            echo '</div>';
            echo '<div class="content">';
            echo '<h3>' . $item->title . '</h3>';
            echo '<p>' . substr(strip_tags($item->content), 0, 240) . '...</p>';
            echo '<button class="btn btn-default btn-book">Make a request</button>';
            echo '</div>';
            echo '</a></div>';
        }

        if (empty($blogPage)) {
            echo '<p class="no-content">Great news are coming!</p>';
        }
        ?>
    </div>
</div>