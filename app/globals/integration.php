<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="assets/scripts/vendor.min.js"></script>
<script type="text/javascript" src="assets/scripts/app.min.js"></script>

<?php
if (isset($_COOKIE['user'], $_COOKIE['sec_session_id'])) {
    echo '<script type="text/javascript" src="angular/ninepixels-core.min.js"></script>';
}

if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
    echo '<script type="text/javascript" src="http://localhost:35729/livereload.js?snipver=1"></script>';
}