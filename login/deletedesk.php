<?php
require('db.php');

if (isset($_GET['TypeID'])) {
    if ($_GET['Type'] == "desk") {
        $sql2 = "DELETE FROM desk WHERE `TypeID` = ?";

        $stmt2 = $db->prepare($sql2);

        if ($stmt2->execute(array($_GET['TypeID']))) {
            echo 'Desk Deleted Succesfully';
        }
    } elseif ($_GET['Type'] == "room") {
        $sql2 = " DELETE FROM room WHERE `TypeID` = ?";

        $stmt2 = $db->prepare($sql2);

        $sql3 = " DELETE FROM desk WHERE `RoomID` = ?";

        $stmt3 = $db->prepare($sql3);

        if ($stmt2->execute(array($_GET['TypeID'])) && $stmt3->execute(array($_GET['TypeID']))) {
            echo 'Room and all Desks inside it deleted succesfully.';
        }

    } elseif ($_GET['Type'] == "workspace") {
        $sql2 = "DELETE FROM workspace WHERE `TypeID` = ?";

        $stmt2 = $db->prepare($sql2);

        $sql3 = " DELETE FROM desk WHERE `WorkspaceID` = ?";

        $stmt3 = $db->prepare($sql3);

        $sql4 = " DELETE FROM room WHERE `WorkspaceID` = ?";

        $stmt4 = $db->prepare($sql4);

        if ($stmt2->execute(array($_GET['TypeID'])) && $stmt3->execute(array($_GET['TypeID'])) && $stmt4->execute(array($_GET['TypeID']))) {
            echo 'Workspace and all rooms and desks inside it deleted succesfully.';
        }
    }
}

?>