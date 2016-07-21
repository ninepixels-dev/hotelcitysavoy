<?php include 'templates/page-header.php' ?>

<div class="container page-content">
    <div class="row">
        <div class="col-md-3 filter-panel">
            <div class="panel">
                <div class="panel-header">Filter By</div>
                <div class="panel-content">
                    <div class="room-type">
                        <label class="group-heading">Room type</label>
                        <input type="checkbox" name="All" id="all"/><label for="all">All</label>
                        <?php
                        $args = array('table' => 'pages', 'ident' => 'page_parent', 'identValue' => $GLOBALS['page']['page_id']);
                        $result = get_content($args);
                        while ($row = $result->fetch_assoc()) {
                            echo '<input type="checkbox" name="' . $row['page_navName'] . '" id="' . $row['page_name'] . '" /><label for="' . $row['page_name'] . '">' . $row['page_navName'] . '</label>';
                        }
                        ?>
                    </div>
                    <div class="price">
                        <label class="group-heading">Price</label>
                        <input type="text" name="price_from" placeholder="From" />
                        <input type="text" name="price_to" placeholder="To" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <?php
            $args = array('table' => 'pages', 'ident' => 'page_parent', 'identValue' => $GLOBALS['page']['page_id']);
            $result = get_content($args);

            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 list-item">';
                echo '<div class="list-image" style="background-image:url(' . str_replace('\\', '/', $row['page_teaser']) . ')"></div>';
                echo '<div class="list-description">';
                echo '<h3>' . $row['page_navName'] . '</h3>';
                echo '<p>' . $row['page_description'] . '</p>';
                echo '<br>';
                echo '<span class="title-symbol"></span>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>