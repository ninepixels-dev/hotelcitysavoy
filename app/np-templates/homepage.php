<div class="alert alert-success alert-success-booking">
    <strong>Success!</strong> Request successfully sent.
</div>

<div class="container-fluid home-slider owl-carousel">
    <?php
    $homepage_items = getContent('pages/' . $GLOBALS['page']->id . '/items');
    foreach (filterBy($homepage_items, 'identifier', 'home-slider') as $item) {
        echo npEditor('div', 'slider-item', $item, true);
        echo npImage($item, '', false);
        echo '<span class="teaser">' . $item->structure . '</span>';
        echo '</div>';
    }
    ?>
</div>

<div class="container-fluid fast-booking">
    <div class="container">
        <form class="row fast-booking-form">
            <div class="col-md-6 col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" name="check_in" class="form-control datepicker check-in" placeholder="Check In" required/>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" name="check_out" class="form-control datepicker check-out" placeholder="Check Out" required/>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="row">
                    <div class="col-sm-4">
                        <select name="persons" required>
                            <option disabled selected>Persons</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select name="room" required>
                            <option disabled selected>Room</option>
                            <option value="Classic Single">Classic Single</option>
                            <option value="Classic Double">Classic Double</option>
                            <option value="Delux Double">Deluxe Double</option>
                            <option value="Deluxe Twin">Deluxe Twin</option>
                            <option value="Suite">Suite</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-book btn-default" type="submit">Make a request</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container few-words">
    <div class="sub-heading">A few words</div>
    <div class="row">
        <?php
        foreach (filterBy($homepage_items, 'identifier', 'few-words') as $item) {
            echo npEditor('div', 'col-md-4', $item, true);
            echo npImage($item, '', 'thumbs');
            echo '<span class="teaser">' . $item->structure . '</span>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<div class="container-fluid room-teaser">
    <?php
    foreach (filterBy($homepage_items, 'identifier', 'room-teaser') as $item) {
        echo npEditor('div', 'row', $item, true);
        echo '<div class="col-md-6">';
        echo npImage($item, '', 'gallery');
        echo '</div>';
        echo '<div class="col-md-6 room-description">';
        echo $item->structure;
        echo '<button class="btn btn-book btn-default make-request">Make a request</button>';
        echo'</div>';
        echo '</div>';
    }
    ?>
</div>

<div class="container-fluid pattern">
    <div class="container split-view page-content">
        <div class="owl-carousel">
            <?php
            foreach (filterBy($homepage_items, 'identifier', 'our-facilities') as $item) {
                echo npEditor('div', 'row', $item, true);
                echo '<div class="col-md-6">' . $item->structure . '</div>';
                echo '<div class="col-md-6"><div class="image_holder">';
                echo npImage($item, '', 'gallery');
                echo '</div></div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>

<div class="container-fluid dark-background walking-distances">
    <span class="walking-bg">Walking</span>
    <span class="distances-bg">distances</span>
    <div class="container distances">
        <div class="row">
            <?php
            foreach (filterBy($homepage_items, 'identifier', 'distances') as $item) {
                echo npEditor('div', 'col-md-3', $item, true);
                echo $item->classes;
                echo '<span class="heading">' . $item->structure . '</span>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div id="map"></div>
</div>