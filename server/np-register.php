<?php

require_once 'controllers/np-connect.php';

$error_msg = array();

if (isset($_POST['user_username'], $_POST['user_email'], $_POST['user_password'])) {
    // Sanitize and validate the data passed in
    $username = filter_input(INPUT_POST, 'user_username', FILTER_SANITIZE_STRING);

    $user_name = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_STRING);
    $user_address = filter_input(INPUT_POST, 'user_address', FILTER_SANITIZE_STRING);
    $user_picture = filter_input(INPUT_POST, 'user_picture', FILTER_SANITIZE_STRING);
    $user_type = filter_input(INPUT_POST, 'user_type', FILTER_SANITIZE_STRING);
    $user_status = filter_input(INPUT_POST, 'user_status', FILTER_SANITIZE_STRING);

    $email = filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        array_push($error_msg, 'The email address you entered is not valid');
    }

    $password = filter_input(INPUT_POST, 'user_password', FILTER_SANITIZE_STRING);
    $password = hash('sha512', $password);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        array_push($error_msg, 'Invalid password configuration.');
    }

    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //

    $prep_stmt = "SELECT user_id FROM users WHERE user_email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);

    // check existing email
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            array_push($error_msg, 'A user with this email address already exists.');
            $stmt->close();
        }
    } else {
        array_push($error_msg, 'Database error Line 39');
        $stmt->close();
    }

    // check existing username
    $prep_stmt = "SELECT user_id FROM users WHERE user_username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);

    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            // A user with this username already exists
            array_push($error_msg, 'A user with this username already exists.');
            $stmt->close();
        }
    } else {
        array_push($error_msg, 'Database error line 55');
        $stmt->close();
    }

    if (empty($error_msg)) {
        // Create hashed password using the password_hash function.
        // This function salts it with a random salt and can be verified with
        // the password_verify function.
        $password = password_hash($password, PASSWORD_BCRYPT);

        // Insert the new user into the database
        $mysqli->query('SET NAMES utf8');

        $preparemysqli = $mysqli->prepare("INSERT INTO users (user_username, user_email, user_password, user_name, user_address, user_picture, user_type, user_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if ($insert_stmt = $preparemysqli) {
            $insert_stmt->bind_param('ssssssss', $username, $email, $password, $user_name, $user_address, $user_picture, $user_type, $user_status);
            // Execute the prepared query.
            if (!$insert_stmt->execute()) {
                return false;
            }
        }
        echo json_encode(array("register" => true));
    } else {
        echo json_encode($error_msg);
    }
}
