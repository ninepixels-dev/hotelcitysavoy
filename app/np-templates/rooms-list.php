<?php include 'np-templates/element_page_header.php' ?>

<div class="container page-content room-list-view">
    <div class="row">
        <div class="col-md-3 col-sm-12 filter-panel">
            <div class="panel">
                <div class="panel-header">Book a Room</div>
                <form class="panel-content fast-booking-form">
                    <div class="room-type">
                        <label class="group-heading">Room type</label>
                        <input type="radio" name="room" id="classic_single" value="Classic Single"/><label for="classic_single">Classic Single</label>
                        <input type="radio" name="room" id="classic_double" value="Classic Double"/><label for="classic_double">Classic Double</label>
                        <input type="radio" name="room" id="deluxe_double" value="Deluxe Double"/><label for="deluxe_double">Deluxe Double</label>
                        <input type="radio" name="room" id="deluxe_twin" value="Classic Twin"/><label for="deluxe_twin">Deluxe Twin</label>
                        <input type="radio" name="room" id="suite" value="Suite"/><label for="suite">Suite</label>
                    </div>
                    <div class="separator">
                        <label class="group-heading">Date</label>
                        <input type="text" name="check_in" placeholder="Check In" class="datepicker check-in"/>
                        <input type="text" name="check_out" placeholder="Check Out" class="datepicker check-out"/>
                    </div>
                    <div class="separator">
                        <label class="group-heading">People</label>
                        <input type="text" name="persons" placeholder="Adults"/>
                        <input type="text" name="children" placeholder="Children" />
                    </div>
                    <button type="submit" class="btn btn-default btn-book">Make a request!</button>
                </form>
            </div>
        </div>
        <div class="col-md-9 col-sm-12 rooms-list">
            <?php
            $toolbar = $GLOBALS['WITHOUT_TOOLBAR'] ? '?toolbar=false' : '';
            foreach (getChild($GLOBALS['page']) as $s_page) {
                echo '<div class="col-md-6 col-sm-12 room-list-item"><a href="/' . $s_page->name . $toolbar . '">';
                echo '<div class="list-image">';
                echo npImage($s_page, '', 'gallery');
                echo '</div>';
                echo '<div class="list-description">';
                echo '<h3>' . $s_page->navigation . '</h3><p>';
                echo isset($s_page->description) ? $s_page->description : '';
                echo '</p><span class="title-symbol"></span>';
                echo '</div>';
                echo '</a></div>';
            }
            ?>
        </div>
    </div>
</div>