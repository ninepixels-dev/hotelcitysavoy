<div class="container-fluid footer">
    <div class="container">
        <div class="row">
            <?php include 'np-templates/element_navigation.php'; ?>
        </div>
    </div>
</div>

<div class="container-fluid copyright">
    <div class="container">
        <div class="row">
            <?php
            $filteredContent = array_filter(getContent('pages/0/items'), function($obj) {
                return $obj->identifier === 'copyright' ? true : false;
            });

            foreach ($filteredContent as $item) {
                echo npEditor('div', 'col-md-6', $item);
            }
            ?>
            <div class="col-md-6 social-icons">
                Cetinjska 3, 11000 Belgrade
                <a href="https://www.facebook.com/hotelcitysavoy/?fref=ts" class="facebook"></a>
                <a href="https://twitter.com/hotelcitysavoy" class="twitter"></a>
                <a href="https://www.instagram.com/hotelcitysavoy/" class="instagram"></a>
            </div>
        </div>
    </div>
</div>

<div id="booking-modal" class="modal fade"></div>
