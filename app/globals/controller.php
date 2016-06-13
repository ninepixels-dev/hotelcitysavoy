<?php

$requestURI = filter_input(INPUT_SERVER, 'REQUEST_URI');
$cleanURL = explode('?', $requestURI, 2);
$parseURL = explode("/", $cleanURL[0]);
$page = strtolower(end($parseURL));

$root = 'templates/';

if ($page === '') {
    $page = "home";
} else if ($page === 'np-admin') {
    $GLOBALS['content'] = "login/login.php";
    $GLOBALS['page'] = array(
        'page_id' => '0',
        'page_name' => 'login',
        'page_title' => 'Nine Pixels Admin Panel',
        'page_description' => 'Nine Pixels Admin Panel'
    );
    return;
}

$args = array('table' => 'pages', 'ident' => 'page_name', 'identValue' => $page);
$result = get_content($args);

if ($result->num_rows === 0) {
    $GLOBALS['content'] = $root . "404.php";
    $GLOBALS['page'] = array(
        'page_id' => '0',
        'page_name' => '404',
        'page_title' => 'Upps! Page not found!',
        'page_description' => 'Upps! Page not found!'
    );
    return;
}

while ($row = $result->fetch_assoc()) {
    $GLOBALS['page'] = $row;
    $GLOBALS['content'] = $root . $row['page_template'];
}

setcookie("page", json_encode($GLOBALS['page']));
