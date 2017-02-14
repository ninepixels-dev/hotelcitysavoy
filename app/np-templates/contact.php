<?php include 'np-templates/element_page_header.php' ?>

<div class="container page-content contact-page">
    <div class="row">
        <div class="col-md-12">
            <div class="sub-heading">
                Make a request!
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php
            $contactPage = getContent('pages/' . $GLOBALS['page']->id . '/items');
            foreach (filterBy($contactPage, 'identifier', 'contact') as $item) {
                echo npEditor('div', '', $item);
            }
            ?>
        </div>
        <form class="col-md-6 contact-form">
            <div class="alert alert-success">
                <strong>Success!</strong> Message successfully sent.
            </div>
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" name="full_name" class="form-control" id="name">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" name="message" id="message"></textarea>
            </div>
            <div class="form-group">
                <button class="btn">Send message</button>
            </div>

        </form>
    </div>
</div>

<div class="container-fluid">
    <div id="map"></div>
</div>
