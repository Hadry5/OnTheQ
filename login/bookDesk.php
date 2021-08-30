<?php 
    require('db.php');

    if (isset($_GET)) {
        $sql2 = "INSERT INTO `reserva` (`CustomerID`, `CheckIN`, `CheckOUT`, `Type`, `TypeID`, `Price`, `BookStatus`) 
        VALUES ('".$_GET['CustomerID']."', '".$_GET['CheckIN']."', '".$_GET['CheckOUT']."', '".$_GET['Type']."', '".$_GET['TypeID']."', '".$_GET['Price']."', 'Not Payed');";
        
        $stmt2 = $db->prepare($sql2);


        if ($stmt2->execute()) {
            echo 'Reservation Booked Succesfully';
        }
    }
?>