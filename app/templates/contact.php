<?php include 'templates/page-header.php' ?>

<div class="container page-content">
    <div class="row">
        <div class="col-md-12">
            <div class="sub-heading">
                Let's drink a Coffee
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php
            $args = array('table' => 'items', 'identify' => 'contact', 'create' => true);
            $result = get_content($args);

            while ($row = $result->fetch_assoc()) {
                echo '<div class="' . $row['item_class'] . '" np-editor data-item="' . $row['item_id'] . '" data-identifier="' . $args['identify'] . '">';
                echo $row['item_structure'];
                echo '</div>';
            }
            ?>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" class="form-control" id="name">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="website">Website:</label>
                <input type="text" class="form-control" id="website">
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" id="message"></textarea>
            </div>
            <div class="form-group">
                <button class="btn">Send message</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div id="map"></div>
</div>
