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

/* ======================================================
  FUNCTIONS FOR DATABASE PREPOPULATION
  ======================================================= */

function userPrepopulate($mysqli) {
    $sql = "INSERT INTO `users` (`user_id`, `user_name`, `user_address`, `user_email`, `user_username`, `user_password`, `user_picture`, `user_timestamp`, `user_type`, `user_status`, `user_delete`) VALUES
            (1, 'Nemanja Pavlović', 'Beograd', 'me@pavlovicnemanja.com', 'npavlovic', '$2y$10$B50DQ1SnQsiM6bhw9EefueNkwM4vuo.E8Fvdtw4S.Z12mzJY5EZmS', NULL, '2016-03-16 19:09:39', 'suadmin', 1, 0)";

    exSQL($sql, $mysqli);
}

function createBase($mysqli) {
    usersCreateTable($mysqli);
    loginAttemptsCreateTable($mysqli);

    userPrepopulate($mysqli);
}

createBase($mysqli);
