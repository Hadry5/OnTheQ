<?php

require('db.php');

if (isset($_GET)) {

    $desk = $_GET['desk'];
    $room = $_GET['room'];
    $workspace = $_GET['workspace'];
    $price = $_GET['price'];
    $description = $_GET['description'];

    $sql = "SELECT DISTINCT `TypeID` FROM room WHERE `Name` LIKE '$room'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $numrows = count($rows);
    if ($numrows >= 1) {

        $roomID = $rows[0]['TypeID'];
        $sql1 = "SELECT DISTINCT `Name`, `TypeID` FROM workspace WHERE `Name` LIKE '$workspace'";
        $stmt1 = $db->prepare($sql1);
        $stmt1->execute();
        $rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $numrows1 = count($rows1);
        if ($numrows1 >= 1) {
            $workspaceID = $rows1[0]['TypeID'];

            $sql2 = "SELECT DISTINCT COUNT(`Name`) as countname FROM desk WHERE `Name` LIKE '$desk'";
            $stmt2 = $db->prepare($sql2);
            $stmt2->execute();
            $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            if ($rows2[0]['countname'] == 0) {
                $sql2 = "INSERT INTO `desk` (`TypeID`, `Name`, `RoomID`, `WorkspaceID`, `Price`, `Description`) 
            VALUES ('', '$desk', '$roomID', '$workspaceID', '$price', '$description');";

                $stmt2 = $db->prepare($sql2);

                if ($stmt2->execute()) {
                    echo "Desk " . $desk . " inserted succesfully, <a href='alldesk.php'>view all Desks</a>.";
                }
            } else {
                echo "Desk " . $desk . " already exists, please change name.";
            }
        } else {
            echo "Workspace " . $workspace . " not exists, create it first.";
        }
    } else {
        echo "Room " . $room . " not exists, create it first";
    }
}
