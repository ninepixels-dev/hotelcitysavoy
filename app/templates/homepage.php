<div class="container-fluid home-slider">
    <?php
    $args = array('table' => 'items', 'identify' => 'home-slider', 'create' => true);
    $result = get_content($args);

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
    <div class="sub-heading">A few words</div>
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

<div class="container-fluid room-teaser">
    <?php
    $args = array('table' => 'items', 'identify' => 'room-teaser', 'create' => true);
    $result = get_content($args);

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
<div class="container-fluid pattern">
    <div class="container split-view page-content">
        <div class="owl-carousel">
            <?php
            $args = array('table' => 'items', 'identify' => 'our-facilities', 'create' => true);
            $result = get_content($args);

            while ($row = $result->fetch_assoc()) {
                echo '<div class="row ' . $row['item_class'] . '" np-editor data-item="' . $row['item_id'] . '" data-identifier="' . $args['identify'] . '">';
                echo '<div class="col-md-6">' . $row['item_structure'] . '</div>';
                echo '<div class="col-md-6"><div class="image_holder"><img src="' . str_replace('\\', '/', $row['item_image']) . '" /></div></div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>

<div class="container-fluid dark-background">
    <div class="container distances">
        <div class="row">
            <?php
            $args = array('table' => 'items', 'identify' => 'distances', 'create' => true);
            $result = get_content($args);

            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-3 ' . $row['item_class'] . '" np-editor data-item="' . $row['item_id'] . '" data-identifier="' . $args['identify'] . '">';
                echo $row['item_class'];
                echo '<span class="heading">' . $row['item_structure'] . '</span>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div id="map"></div>
</div>