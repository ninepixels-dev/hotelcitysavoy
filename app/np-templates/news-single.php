<?php include 'np-templates/element_page_header.php' ?>

<div class="container page-content news-single-view">
    <div class="row">
        <div class="col-md-4 col-sm-12 filter-panel">
            <div class="panel">
                <div class="panel-header">Related posts</div>
                <div class="panel-content">
                    <?php
                    $toolbar = $GLOBALS['WITHOUT_TOOLBAR'] ? '?toolbar=false' : '';
                    $blogPage = getContent('blogs');
                    foreach ($blogPage as $item) {
                        echo '<a href="' . $item->name . $toolbar . '">';
                        echo $item->title;
                        echo '</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <?php
            $blogSingle = getContent('blogs/' . $GLOBALS['page']->id);
            echo '<h2>' . $blogSingle->title . '</h2>';
            echo npImage($blogSingle, '');
            echo $blogSingle->content;
            ?>
        </div>
    </div>
</div>