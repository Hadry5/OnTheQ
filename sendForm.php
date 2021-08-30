<?php

if (isset($_GET['Email'])){
    $to      = $_GET['Email'];
    $subject    = $_GET['Subject'];
    $message   = $_GET['Message'];
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Cabeceras adicionales
    $headers .= 'To: '. $to . "\r\n";
    $headers .= 'From: OnTheQ <OnTheQ@gmail.com>' . "\r\n";

    if (mail($to, $subject, $message, $headers)){
        echo "Mail sent Correctly";
    } else {
        echo "Try with a correct Email or Contact the Developer";
    }
} 


?>