<div class="container-fluid home-slider">
    <?php
    $args = array('table' => 'items', 'identify' => 'home-slider', 'create' => true);
    $result = get_content($args);
    if ($result->num_rows === 0) {
        echo '<div class="ninepixels_item_holder" np-editor data-identifier="' . $args['identify'] . '"></div>';
    }
    while ($row = $result->fetch_assoc()) {
        echo '<div class="row ' . $row['item_class'] . '" np-editor data-item="' . $row['item_id'] . '" data-identifier="' . $args['identify'] . '">';
        echo '<img src="' . str_replace('\\', '/', $row['item_image']) . '" />';
        echo '<span class="teaser">' . $row['item_structure'] . '</span>';
        echo '</div>';
    }
    ?>
</div>

<div class="container-fluid reservation-bar"></div>

<div class="container few-words">
    <div class="sub-heading">
        A few words
        <br>
        <span class="title-symbol"></span>
    </div>
    <div class="row">
        <?php
        $args = array('table' => 'items', 'identify' => 'few-words', 'create' => true);
        $result = get_content($args);

        if ($result->num_rows === 0) {
            echo '<div class="ninepixels_item_holder" np-editor data-identifier="' . $args['identify'] . '"></div>';
        }

        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-4 ' . $row['item_class'] . '" np-editor data-item="' . $row['item_id'] . '" data-identifier="' . $args['identify'] . '">';
            echo '<img src="' . str_replace('\\', '/', $row['item_image']) . '" />';
            echo '<span class="teaser">' . $row['item_structure'] . '</span>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<div class="container-fluid room-teaser">
    <?php
    $args = array('table' => 'items', 'identify' => 'room-teaser', 'create' => true);
    $result = get_content($args);

    if ($result->num_rows === 0) {
        echo '<div class="ninepixels_item_holder" np-editor data-identifier="' . $args['identify'] . '"></div>';
    }

    while ($row = $result->fetch_assoc()) {
        echo '<div class="row ' . $row['item_class'] . '" np-editor data-item="' . $row['item_id'] . '" data-identifier="' . $args['identify'] . '">';
        echo '<div class="col-md-6">';
        echo '<img src="' . str_replace('\\', '/', $row['item_image']) . '" />';
        echo '</div>';
        echo '<div class="col-md-6 room-description">';
        echo $row['item_structure'];
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>