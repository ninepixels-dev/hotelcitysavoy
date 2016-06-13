<?php

//Secure email function
function spamcheck($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);

    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

//Prikupljanje podataka
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$objectType = $_POST['objectType'];
$objectSize = $_POST['objectSize'];
$message = $_POST['message'];

date_default_timezone_set('Europe/Belgrade');
$today = date("j F Y, H:i");

//Provera da li je email adresa validna
$mailcheck = spamcheck($email);
if ($mailcheck == FALSE) {
    die();
} else {
    //Slanje email-a
    $to = "info@ninepixels.rs";
    $subject = "Nova poruka od: " . $name;
    $from = $name . "<no-reply@ninepixels.rs>";

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= "From:" . $from . "\r\n";
    $headers .= "Reply-To:" . $email;

    if ($phone == "") {
        $content = "Poruka poslata: " . $today . "<br><br>" . $message . "<br><br>" . $name . "<br>" . $email;
    } else {
        $content = "Poruka poslata: " . $today . "<br><br>" . $message . "<br><br>" . $name . ", <br>" . $phone . "<br>" . $email;
    }

    $content .= '<br><br>' . 'Tip objekta: ' . $objectType . '<br>' . 'Veličina objekta: ' . $objectSize;

    //Izvršvanje
    mail($to, $subject, $content, $headers);
}
