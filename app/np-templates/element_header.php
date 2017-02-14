<div class="container header">
    <div class="row">
        <?php
        if (isset($GLOBALS['page']->show_navigation) || strrpos($GLOBALS['page']->name, 'news/') !== false) {
            include_once 'np-templates/element_navigation.php';
        }
        ?>
    </div>
</div>
