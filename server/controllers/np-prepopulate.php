<?php

require_once 'np-connect.php';
require_once 'np-database.php';

function usersCreateTable($mysqli) {
    $sql = "CREATE TABLE IF NOT EXISTS users (
            user_id                 int(11) NOT NULL AUTO_INCREMENT,
            user_name               varchar(64) CHARACTER SET utf8 NOT NULL,
            user_address            varchar(64) CHARACTER SET utf8,
            user_email              varchar(64) CHARACTER SET utf8 NOT NULL,
            user_username           varchar(64) CHARACTER SET utf8 NOT NULL,
            user_password           char(128) CHARACTER SET utf8 NOT NULL,
            user_picture            varchar(128) CHARACTER SET utf8,
            user_timestamp          timestamp NOT NULL,
            user_type               varchar(32) CHARACTER SET utf8,
            user_status             int(11),
            user_delete             int(11) DEFAULT 0,
            PRIMARY KEY (user_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

    exSQL($sql, $mysqli);
}

function loginAttemptsCreateTable($mysqli) {
    $sql = "CREATE TABLE IF NOT EXISTS login_attempts (
            user_id     int(11) NOT NULL,
            time        varchar(30) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

    exSQL($sql, $mysqli);
}

function pagesCreateTable($mysqli) {
    $sql = "CREATE TABLE `pages` (
            `page_id` int(11) NOT NULL AUTO_INCREMENT,
            `user_id` int(11) NOT NULL,
            `page_parent` int(11) DEFAULT NULL,
            `page_name` varchar(64) NOT NULL,
            `page_template` varchar(64) NOT NULL,
            `page_navName` varchar(128) DEFAULT NULL,
            `page_title` varchar(60) DEFAULT NULL,
            `page_description` varchar(512) DEFAULT NULL,
            `page_teaser` varchar(128) DEFAULT NULL,
            `page_header` tinyint(1) NOT NULL DEFAULT '1',
            `page_navigation` tinyint(1) NOT NULL DEFAULT '1',
            `page_footer` tinyint(1) NOT NULL DEFAULT '1',
            `page_inNavigation` tinyint(1) NOT NULL DEFAULT '1',
            `page_active` tinyint(1) NOT NULL DEFAULT '1',
            `page_order` int(11) NOT NULL DEFAULT '0',
            `page_delete` int(11) DEFAULT '0',
            `page_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

    exSQL($sql, $mysqli);
}

/* ======================================================
  FUNCTIONS FOR DATABASE PREPOPULATION
  ======================================================= */

function userPrepopulate($mysqli) {
    $sql = "INSERT INTO `users` (`user_id`, `user_name`, `user_address`, `user_email`, `user_username`, `user_password`, `user_picture`, `user_type`, `user_status`, `user_delete`) VALUES
            (1, 'Nemanja Pavlović', 'Beograd', 'me@pavlovicnemanja.com', 'npavlovic', '736ad674977166d1937fca599352ac655f4d7b028fcf38451087a37a685faf10acdcab2edf6aefa219072142be409c2464474b945c4f4f1e593e34125c0f58f5', NULL, 'suadmin', 1, 0)";

    exSQL($sql, $mysqli);
}

function homePagePrepopulate($mysqli) {
    $sql = "INSERT INTO `pages` (`page_id`, `user_id`, `page_parent`, `page_name`, `page_template`, `page_navName`, `page_title`, `page_description`, `page_teaser`, `page_header`, `page_navigation`, `page_footer`, `page_inNavigation`, `page_active`, `page_order`, `page_delete`) VALUES
            (1, 1, 0, 'home', 'homepage.php', 'Homepage', 'Welcome', 'There should be some good description', 'null', 1, 1, 1, 0, 1, 0, 0)";

    exSQL($sql, $mysqli);
}

function createBase($mysqli) {
    usersCreateTable($mysqli);
    loginAttemptsCreateTable($mysqli);
    pagesCreateTable($mysqli);

    userPrepopulate($mysqli);
    homePagePrepopulate($mysqli);
}

createBase($mysqli);
