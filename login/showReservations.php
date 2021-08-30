<?php

require('db.php');
require('securityadmin.php');

if (isset($_GET)) {
    if ($_GET['type'] == "Venue") {
        $sql1 = "SELECT `Name`, `TypeID` FROM workspace WHERE `Name` LIKE '".$_GET['filterText']."'";

        $stmt1 = $db->prepare($sql1);
        $stmt1->execute();

        $rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        $sql5 = "SELECT `CustomerID`, `CheckIN`, `CheckOUT`, `Type`, `TypeID`, `Price`, `BookStatus` FROM reserva ORDER BY `BookStatus`";

        $stmt5 = $db->prepare($sql5);
        $stmt5->execute();
        $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
        $numrows5 = count($rows5);

        if ($numrows5 >= 1 and count($rows1) >= 1) {
            foreach ($rows5 as $row) {
                if ($row['Type'] == "Workspace") {
                    $sql3 = "SELECT `Name`, `TypeID` as finalID FROM " . $row['Type'] . " WHERE `TypeID` = ".$row['TypeID']." AND `WorkSpaceID` = ".$rows1[0]['TypeID'];
                } else {
                    $sql3 = "SELECT `Name`, `WorkspaceID` as finalID FROM " . $row['Type'] . " WHERE `TypeID` = ".$row['TypeID']." AND `WorkSpaceID` = ".$rows1[0]['TypeID'];

                }
                
                $stmt3 = $db->prepare($sql3);
                $stmt3->execute();

                $rows3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

                $numrows3 = count($rows3);

                if ($numrows3 >= 1) {
                
        ?>
                <tr>
                    <td>
                        <div class="row justify-content-center">
                            <?php
                            $sql6 = "SELECT `FirstName`, `Surname`, `Email`, `Location` FROM customer WHERE `CustomerID` = ".$row['CustomerID'];

                            $stmt6 = $db->prepare($sql6);
                            $stmt6->execute();
                            $rows6 = $stmt6->fetchAll(PDO::FETCH_ASSOC);
                            echo '<span class="d-inline-block position-relative has-hovercard text-center">'.$rows6[0]['FirstName'] ." ". $rows6[0]['Surname'].'
                            <span class="d-none p-2 position-absolute border text-nowrap hovercard bg-light">
                                User: '.$rows6[0]['FirstName'] ." ". $rows6[0]['Surname']. '<br />
                                Email: '.$rows6[0]['Email'].'<br />
                                Location:'.$rows6[0]['Location'].'
                            </span>
                            </span>';
                            ?>
                        </div>
                    </td>


                    <td>
                        <div class="row justify-content-center"><?php echo $row['CheckIN']; ?></div>
                    </td>
                    <td>
                        <div class="row justify-content-center"><?php echo $row['CheckOUT']; ?></div>
                    </td>
                    <td>
                        <div class="row justify-content-center"><?php echo $row['Type']; ?></div>
                    </td>
                    <td>
                        <div class="row justify-content-center">
                            <?php
                            
                                echo $rows3[0]["Name"];
                            
                            ?>
                        </div>
                    </td>
                    <td>
                        <div class="row justify-content-center">
                            <?php

                            $sql3 = "SELECT `Name` FROM workspace WHERE `TypeID` = ".$rows3[0]['finalID'];
                            $stmt3 = $db->prepare($sql3);
                            $stmt3->execute();


                            $rows3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

                            echo $rows3[0]["Name"];

                            ?>
                        </div>
                    </td>
                    <td>
                        <div class="row justify-content-center"><?php echo $row['Price']; ?></div>
                    </td>
                    <td>
                        <div class="row justify-content-center"><?php echo $row['BookStatus']; ?></div>
                    </td>
                    <td>
                        <div class="row justify-content-center">
                            <?php 
                                echo '<button class="btn btn-outline-info btn-min-width mx-1 rounded-3 w-auto py-0 px-2" data-toggle="modal" data-target="#modalForm" onclick="WriteModal(\''.$rows6[0]['Email'].'\')">Send Mail</button>';
                            ?>
                        </div>
                    </td>
                </tr>
        <?php } }
        }
    } else if ($_GET['type'] == "Organisation") {
        $sql1 = "SELECT `FirstName`, `Surname`, `CustomerID` FROM customer WHERE `FirstName` LIKE '".$_GET['filterText']."' OR `Surname` LIKE '".$_GET['filterText']."' OR CONCAT(`FirstName`, ' ',`Surname`) LIKE '".$_GET['filterText']."'";

        $stmt1 = $db->prepare($sql1);
        $stmt1->execute();

        $rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows1) >= 1) {
            
        foreach ($rows1 as $row1) { 
        
        $sql5 = "SELECT `CustomerID`, `CheckIN`, `CheckOUT`, `Type`, `TypeID`, `Price`, `BookStatus` FROM reserva WHERE `CustomerID` = ".$row1['CustomerID']." ORDER BY `BookStatus`";

        $stmt5 = $db->prepare($sql5);
        $stmt5->execute();
        $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
        $numrows5 = count($rows5);

        if ($numrows5 >= 1 ) {
            
            foreach ($rows5 as $row) {
                
        ?>
                <tr>
                    <td>
                        <div class="row justify-content-center">
                            <?php
                            
                            echo '<span class="d-inline-block position-relative has-hovercard text-center">'.$rows1[0]['FirstName'] ." ". $rows1[0]['Surname'].'
                            <span class="d-none p-2 position-absolute border text-nowrap hovercard bg-light">
                                User: '.$rows6[0]['FirstName'] ." ". $rows6[0]['Surname']. '<br />
                                Email: '.$rows6[0]['Email'].'<br />
                                Location:'.$rows6[0]['Location'].'
                            </span>
                            </span>';
                            ?>
                        </div>
                    </td>


                    <td>
                        <div class="row justify-content-center"><?php echo $row['CheckIN']; ?></div>
                    </td>
                    <td>
                        <div class="row justify-content-center"><?php echo $row['CheckOUT']; ?></div>
                    </td>
                    <td>
                        <div class="row justify-content-center"><?php echo $row['Type']; ?></div>
                    </td>
                    <td>
                        <div class="row justify-content-center">
                            <?php
                            if ($row['Type'] == "Workspace") {
                                $sql3 = "SELECT `Name`, `TypeID` as finalID FROM " . $row['Type'] . " WHERE `TypeID` = ".$row['TypeID'];
                                $stmt3 = $db->prepare($sql3);
                                $stmt3->execute();


                                $rows3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

                                echo $rows3[0]["Name"];
                            } else {
                                $sql3 = "SELECT `Name`, `WorkSpaceID` as finalID FROM " . $row['Type'] . " WHERE `TypeID` = ".$row['TypeID'];
                                $stmt3 = $db->prepare($sql3);
                                $stmt3->execute();
    
    
                                $rows3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    
                                echo $rows3[0]["Name"];
                            }
                            ?>
                        </div>
                    </td>
                    <td>
                        <div class="row justify-content-center">
                            <?php

                            $sql3 = "SELECT `Name` FROM workspace WHERE `TypeID` = ".$rows3[0]['finalID'];
                            $stmt3 = $db->prepare($sql3);
                            $stmt3->execute();


                            $rows3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

                            echo $rows3[0]["Name"];

                            ?>
                        </div>
                    </td>
                    <td>
                        <div class="row justify-content-center"><?php echo $row['Price']; ?></div>
                    </td>
                    <td>
                        <div class="row justify-content-center"><?php echo $row['BookStatus']; ?></div>
                    </td>
                    <td>
                        <div class="row justify-content-center">
                            <?php 
                                echo '<button class="btn btn-outline-info btn-min-width mx-1 rounded-3 w-auto py-0 px-2" data-toggle="modal" data-target="#modalForm" onclick="WriteModal(\''.$rows1[0]['Email'].'\')">Send Mail</button>';
                            ?>
                        </div>
                    </td>
                </tr>
        <?php } } }
        }
    } else if ($_GET["type"] == "Date") {
        $sql5 = "SELECT `CustomerID`, `CheckIN`, `CheckOUT`, `Type`, `TypeID`, `Price`, `BookStatus` FROM reserva WHERE TIMESTAMPDIFF(day, `CheckIN`, '".$_GET['filterText']."') = 0 OR TIMESTAMPDIFF(day, `CheckOUT`, '".$_GET['filterText']."') = 0 ORDER BY `BookStatus`";

        $stmt5 = $db->prepare($sql5);
        $stmt5->execute();
        $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
        $numrows5 = count($rows5);

        if ($numrows5 >= 1) {
            
            foreach ($rows5 as $row) {
        ?>
                <tr>
                    <td>
                        <div class="row justify-content-center">
                            <?php
                            $sql6 = "SELECT `FirstName`, `Surname` FROM customer WHERE `CustomerID` = ".$row['CustomerID'];

                            $stmt6 = $db->prepare($sql6);
                            $stmt6->execute();
                            $rows6 = $stmt6->fetchAll(PDO::FETCH_ASSOC);
                            echo '<span class="d-inline-block position-relative has-hovercard text-center">'.$rows6[0]['FirstName'] ." ". $rows6[0]['Surname'].'
                            <span class="d-none p-2 position-absolute border text-nowrap hovercard bg-light">
                                User: '.$rows6[0]['FirstName'] ." ". $rows6[0]['Surname']. '<br />
                                Email: '.$rows6[0]['Email'].'<br />
                                Location:'.$rows6[0]['Location'].'
                            </span>
                            </span>';
                            ?>
                        </div>
                    </td>


                    <td>
                        <div class="row justify-content-center"><?php echo $row['CheckIN']; ?></div>
                    </td>
                    <td>
                        <div class="row justify-content-center"><?php echo $row['CheckOUT']; ?></div>
                    </td>
                    <td>
                        <div class="row justify-content-center"><?php echo $row['Type']; ?></div>
                    </td>
                    
                    <td>
                        <div class="row justify-content-center">
                            <?php
                            if ($row['Type'] == "Workspace") {
                                $sql3 = "SELECT `Name`, `TypeID` as finalID FROM " . $row['Type'] . " WHERE `TypeID` = ".$row['TypeID'];
                                $stmt3 = $db->prepare($sql3);
                                $stmt3->execute();


                                $rows3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

                                echo $rows3[0]["Name"];
                            } else {
                                $sql3 = "SELECT `Name`, `WorkSpaceID` as finalID FROM " . $row['Type'] . " WHERE `TypeID` = ".$row['TypeID'];
                                $stmt3 = $db->prepare($sql3);
                                $stmt3->execute();
    
    
                                $rows3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    
                                echo $rows3[0]["Name"];
                            }
                            ?>
                        </div>
                    </td>
                    <td>
                        <div class="row justify-content-center">
                            <?php

                            $sql3 = "SELECT `Name` FROM workspace WHERE `TypeID` = ".$rows3[0]['finalID'];
                            $stmt3 = $db->prepare($sql3);
                            $stmt3->execute();


                            $rows3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

                            echo $rows3[0]["Name"];

                            ?>
                        </div>
                    </td>
                    <td>
                        <div class="row justify-content-center"><?php echo $row['Price']; ?></div>
                    </td>
                    <td>
                        <div class="row justify-content-center"><?php echo $row['BookStatus']; ?></div>
                    </td>
                    <td>
                        <div class="row justify-content-center">
                            <?php 
                                echo '<button class="btn btn-outline-info btn-min-width mx-1 rounded-3 w-auto py-0 px-2" data-toggle="modal" data-target="#modalForm" onclick="WriteModal(\''.$rows6[0]['Email'].'\')">Send Mail</button>';
                            ?>
                        </div>
                    </td>
                </tr>
        <?php } 
        }
    } else if ($_GET["type"] == "Reset") {
        $sql5 = "SELECT `CustomerID`, `CheckIN`, `CheckOUT`, `Type`, `TypeID`, `Price`, `BookStatus` FROM reserva ORDER BY `BookStatus`";

        $stmt5 = $db->prepare($sql5);
        $stmt5->execute();
        $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
        $numrows5 = count($rows5);

        if ($numrows5 >= 1) {
            
            foreach ($rows5 as $row) {
        ?>
                <tr>
                    <td>
                        <div class="row justify-content-center">
                            <?php
                            $sql6 = "SELECT `FirstName`, `Surname`, `Email`, `Location` FROM customer WHERE `CustomerID` = ".$row['CustomerID'];

                            $stmt6 = $db->prepare($sql6);
                            $stmt6->execute();
                            $rows6 = $stmt6->fetchAll(PDO::FETCH_ASSOC);
                            echo '<span class="d-inline-block position-relative has-hovercard text-center">'.$rows6[0]['FirstName'] ." ". $rows6[0]['Surname'].'
                            <span class="d-none p-2 position-absolute border text-nowrap hovercard bg-light">
                                User: '.$rows6[0]['FirstName'] ." ". $rows6[0]['Surname']. '<br />
                                Email: '.$rows6[0]['Email'].'<br />
                                Location:'.$rows6[0]['Location'].'
                            </span>
                            </span>';
                            ?>
                        </div>
                    </td>


                    <td>
                        <div class="row justify-content-center"><?php echo $row['CheckIN']; ?></div>
                    </td>
                    <td>
                        <div class="row justify-content-center"><?php echo $row['CheckOUT']; ?></div>
                    </td>
                    <td>
                        <div class="row justify-content-center"><?php echo $row['Type']; ?></div>
                    </td>
                    <td>
                        <div class="row justify-content-center">
                            <?php
                            if ($row['Type'] == "Workspace") {
                                $sql3 = "SELECT `Name`, `TypeID` as finalID FROM " . $row['Type'] . " WHERE `TypeID` = ".$row['TypeID'];
                                $stmt3 = $db->prepare($sql3);
                                $stmt3->execute();


                                $rows3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

                                echo $rows3[0]["Name"];
                            } else {
                                $sql3 = "SELECT `Name`, `WorkSpaceID` as finalID FROM " . $row['Type'] . " WHERE `TypeID` = ".$row['TypeID'];
                                $stmt3 = $db->prepare($sql3);
                                $stmt3->execute();
    
    
                                $rows3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    
                                echo $rows3[0]["Name"];
                            }
                            ?>
                        </div>
                    </td>
                    <td>
                        <div class="row justify-content-center">
                            <?php

                            $sql3 = "SELECT `Name` FROM workspace WHERE `TypeID` = ".$rows3[0]['finalID'];
                            $stmt3 = $db->prepare($sql3);
                            $stmt3->execute();


                            $rows3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

                            echo $rows3[0]["Name"];

                            ?>
                        </div>
                    </td>
                    <td>
                        <div class="row justify-content-center"><?php echo $row['Price']; ?></div>
                    </td>
                    <td>
                        <div class="row justify-content-center"><?php echo $row['BookStatus']; ?></div>
                    </td>
                    <td>
                        <div class="row justify-content-center">
                            <?php 
                                echo '<button class="btn btn-outline-info btn-min-width mx-1 rounded-3 w-auto py-0 px-2" data-toggle="modal" data-target="#modalForm" onclick="WriteModal(\''.$rows6[0]['Email'].'\')">Send Mail</button>';
                            ?>
                        </div>
                    </td>
                </tr>
        <?php } 
        }
    }
}
