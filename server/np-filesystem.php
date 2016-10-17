<?php

require_once 'controllers/np-connect.php';
require_once 'controllers/np-login.php';
require_once 'controllers/np-sanitize.php';

secure_session_start();

if (login_check($mysqli) == true) {

    function listFiles() {
        $dir = "../assets/files";
        $return_array = array();
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) != false) {
                    if ($file == "." or $file == "..") {

                    } else {
                        $return_array[] = $file;
                    }
                }
            }
            echo json_encode($return_array);
        }
    }

    function deleteItem($file) {
        $dir = "../assets/files";
        unlink($dir . '/' . $file);

        listFiles();
    }

    $method = isset($_GET['method']) ? sanitize($_GET['method'], $mysqli) : 'GET';

    switch ($method) {
        case 'GET' : listFiles();
            break;
        case 'DELETE' : deleteItem($file);
            break;
    }
} else {
    echo json_encode('You are not authorized to access this page, please login.');
}