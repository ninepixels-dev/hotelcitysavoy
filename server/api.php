<?php

require_once 'controllers/np-connect.php';
require_once 'controllers/np-login.php';
require_once 'controllers/np-sanitize.php';
require_once 'controllers/np-database.php';
require_once 'controllers/php-logger.php';

secure_session_start();

if (login_check($mysqli) == true) {

    function set($table, $getters, $mysqli) {
        $params = array();

        if (!empty($getters)) {
            $params = $getters;

            $params['user_id'] = $_SESSION['user_id'];

            setDatabase($table, $params, $mysqli);
        }
    }

    function get($table, $getters, $mysqli) {
        $params = array();

        $sql = "SELECT * FROM " . $table;

        if (!empty($getters)) {
            $params = $getters;
        }

        getDatabase($sql, $params, $mysqli);
    }

    function update($table, $getters, $mysqli) {
        $params = array();

        if (!empty($getters)) {
            $params = $getters;

            $identifier = substr($table, 0, -1) . '_id';

            updateDatabase($table, $identifier, $params, $mysqli);
        }
    }

    function delete($table, $getters, $mysqli) {
        if (!empty($getters)) {

            $identifier = substr($table, 0, -1) . '_id';
            $identifier .= " = " . $getters[$identifier];

            markForDelete($table, $identifier, $mysqli);
        }
    }

    function removeKey($value, $array) {
        unset($array[$value]);
        return $array;
    }

    $table = sanitize($_GET['table'], $mysqli);
    $getters = sanitize($_POST, $mysqli);
    $method = sanitize($_GET['method'], $mysqli);

    switch ($method) {
        case 'POST' : set($table, $getters, $mysqli);
            break;
        case 'GET' : get($table, $getters, $mysqli);
            break;
        case 'PUT' : update($table, $getters, $mysqli);
            break;
        case 'DELETE' : delete($table, $getters, $mysqli);
            break;
    }
} else {
    echo json_encode('You are not authorized to access this page, please login.');
}