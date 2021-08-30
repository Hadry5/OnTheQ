<?php

require('db.php');

if (isset($_GET)) {

    $room = $_GET['room2'];
    $workspace = $_GET['workspace2'];
    $price = $_GET['price2'];
    $description = $_GET['description2'];

    $sql1 = "SELECT DISTINCT `TypeID` FROM workspace WHERE `Name` LIKE '$workspace'";
    $stmt1 = $db->prepare($sql1);
    $stmt1->execute();
    $rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    $numrows1 = count($rows1);
    if ($numrows1 >= 1) {
        $sql2 = "SELECT DISTINCT COUNT(`Name`) as countname FROM room WHERE `Name` LIKE '$room'";
        $stmt2 = $db->prepare($sql2);
        $stmt2->execute();
        $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        if ($rows2[0]['countname'] == 0) {
            $workspaceID = $rows1[0]['TypeID'];
            $sql2 = "INSERT INTO `room` (`WorkSpaceID`, `TypeID`, `Name`, `Price`, `Description`) 
                VALUES ('$workspaceID','','$room','$price','$description');";

            $stmt2 = $db->prepare($sql2);

            if ($stmt2->execute()) {
                echo "Room " . $room . " inserted succesfully <a href='allroom.php'>view all Rooms</a>.";
            }
        } else {
            echo "Room " . $room . " already exists, please change the name.";
        }
    } else {
        echo "Workspace " . $workspace . " not exists, please create it first.";
    }
}
