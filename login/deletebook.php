<?php
    require('db.php');

    if (isset($_GET['bookid'])) {
        $sql2 = "DELETE FROM reserva WHERE `BookingID` = ?";
          
        $stmt2 = $db->prepare($sql2);

        if ($stmt2->execute(array($_GET['bookid']))) {
            echo 'Reservation Deleted Succesfully';
        }
    }
?>