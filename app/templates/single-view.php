<?php include 'templates/page-header.php' ?>

<div class="container few-words">
    <div class="row">
        <?php
        $args = array('table' => 'items', 'identify' => 'few-words', 'create' => true, 'ident' => 'page_id', 'identValue' => $GLOBALS['page']['page_id']);
        $result = get_content($args);

        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-4 ' . $row['item_class'] . '" np-editor data-item="' . $row['item_id'] . '" data-identifier="' . $args['identify'] . '">';
            echo '<img src="' . str_replace('\\', '/', $row['item_image']) . '" />';
            echo '<span class="teaser">' . $row['item_structure'] . '</span>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<div class="container-fluid hotel-facts dark-background">
    <div class="row">
        <div class="col-md-6">
            <?php
            $args = array('table' => 'items', 'identify' => 'hotel-facts-image', 'create' => true, 'ident' => 'page_id', 'identValue' => $GLOBALS['page']['page_id']);
            $result = get_content($args);

            while ($row = $result->fetch_assoc()) {
                echo '<div class="image_holder" np-editor data-item="' . $row['item_id'] . '" data-identifier="' . $args['identify'] . '">';
                echo '<img src="' . str_replace('\\', '/', $row['item_image']) . '" />';
                echo '</div>';
            }
            ?>
        </div>
        <div class="col-md-6">
            <?php
            $args = array('table' => 'items', 'identify' => 'hotel-facts', 'create' => true, 'ident' => 'page_id', 'identValue' => $GLOBALS['page']['page_id']);
            $result = get_content($args);

            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-6 ' . $row['item_class'] . '" np-editor data-item="' . $row['item_id'] . '" data-identifier="' . $args['identify'] . '">';
                echo '<img class="facts-icon" src="' . str_replace('\\', '/', $row['item_image']) . '" />';
                echo '<span class="teaser">' . $row['item_structure'] . '</span>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>

<br><br>