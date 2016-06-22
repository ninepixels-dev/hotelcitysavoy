<div class="container-fluid footer">
    <div class="container">
        <div class="row">
            <?php include 'templates/navigation.php' ?>
        </div>
    </div>
</div>

<div class="container-fluid copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php
                $args = array('table' => 'items', 'identify' => 'copyright', 'create' => true);
                $result = get_content($args);

                while ($row = $result->fetch_assoc()) {
                    echo $row['item_structure'];
                }
                ?>
            </div>
            <div class="col-md-6 social-icons">
                <a href="https://www.facebook.com/hotelcitysavoy/?fref=ts" class="facebook"></a>
                <a href="https://twitter.com/hotelcitysavoy" class="twitter"></a>
                <a href="https://www.instagram.com/hotelcitysavoy/" class="instagram"></a>
            </div>
        </div>
    </div>
</div>