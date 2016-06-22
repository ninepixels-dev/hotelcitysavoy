<div class="container-fluid page-slider">
    <?php
    $args = array('table' => 'items', 'identify' => 'page-slider', 'create' => true, 'ident' => 'page_id', 'identValue' => $GLOBALS['page']['page_id']);
    $result = get_content($args);

    while ($row = $result->fetch_assoc()) {
        echo '<div class="row ' . $row['item_class'] . '" np-editor data-item="' . $row['item_id'] . '" data-identifier="' . $args['identify'] . '" style="background-image:url(' . str_replace('\\', '/', $row['item_image']) . ')">';
        echo '<span class="teaser">' . $row['item_structure'] . '</span>';
        echo '</div>';
    }
    ?>
</div>

<div class="container-fluid dark-background">
    <div class="container breadcrumps">
        <span>Home</span>
        <span><?php echo $GLOBALS['page']['page_navName'] ?></span>
    </div>
</div>