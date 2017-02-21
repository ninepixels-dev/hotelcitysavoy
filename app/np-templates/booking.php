<div class="modal-dialog modal-lg">
    <form name="booking-form" class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Request a Booking</h4>
        </div>
        <div class="modal-dialog form-horizontal">
            <div class="form-group-heading">Room details</div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="check-in">Check in Date:*</label>
                <div class="col-sm-9"><input type="text" name="check_in" class="form-control datepicker" required/></div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="check-out">Check out Date:*</label>
                <div class="col-sm-9"><input type="text" name="check_out" class="form-control datepicker" required/></div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="mobile">Number of Persons:*</label>
                <div class="col-sm-9">
                    <select name="persons" class="form-control" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="mobile">Room:*</label>
                <div class="col-sm-9">
                    <select name="room" class="form-control" required>
                        <option value="Classic Single">Classic Single</option>
                        <option value="Classic Double">Classic Double</option>
                        <option value="Deluxe Double">Deluxe Double</option>
                        <option value="Deluxe Twin">Deluxe Twin</option>
                        <option value="Suite">Suite</option>
                    </select>
                </div>
            </div>
            <div class="form-group-heading">Personal informations</div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="first_name">First name:*</label>
                <div class="col-sm-9"><input type="text" name="first_name" class="form-control" required/></div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="last_name">Last name:*</label>
                <div class="col-sm-9"><input type="text" name="last_name" class="form-control" required/></div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="mobile">Mobile phone:</label>
                <div class="col-sm-9"><input type="text" name="mobile" class="form-control" /></div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="email">Email address:*</label>
                <div class="col-sm-9"><input type="email" name="email" class="form-control" required/></div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="country">Country:*</label>
                <div class="col-sm-9"><input type="text" name="country" class="form-control" required/></div>
            </div>
            <div class="form-group-heading">Payment information</div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="name_on_card">Name on Card:</label>
                <div class="col-sm-9"><input type="text" name="name_on_card" class="form-control"/></div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="credit_card_number">Credit Card Number:</label>
                <div class="col-sm-9"><input type="text" name="credit_card_number" class="form-control"/></div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="credit_card_date">Credit Card Ex. Date:</label>
                <div class="col-sm-9"><input type="text" name="credit_card_date" class="form-control"/></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-default btn-book send-request">Send request</button>
        </div>
    </form>
</div>