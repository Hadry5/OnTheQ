<?php

require('db.php');

if (isset($_GET['workspace3'])) {

    $workspace = $_GET['workspace3'];
    $price = $_GET['price3'];
    $description = $_GET['description3'];

    $sql2 = "SELECT DISTINCT COUNT(`Name`) as countname FROM workspace WHERE `Name` LIKE '$workspace'";
    $stmt2 = $db->prepare($sql2);
    $stmt2->execute();
    $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    if ($rows2[0]['countname'] == 0) {
        $sql2 = "INSERT INTO `workspace` (`TypeID`, `Name`, `Price`, `Description`) 
                VALUES ('','$workspace','$price','$description');";

        $stmt2 = $db->prepare($sql2);

        if ($stmt2->execute()) {
            echo "Workspace " . $workspace . " inserted succesfully <a href='allworkspace.php'>view all Workspaces</a>.";
        }
    } else {
        echo "Workspace " . $workspace . " already exists, please change the name.";
    }
}
