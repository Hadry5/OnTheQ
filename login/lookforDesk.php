<?php 

    require('db.php');
    require('security.php');

    if (isset($_GET)) {
        $checkInDate = $_GET['checkInDate'] ." ". $_GET['checkInHour'];
        
        $checkOutDate = $_GET['checkOutDate'] ." ". $_GET['checkOutHour'];
        $privacy = $_GET['privacy'];
        $monitor = $_GET['monitor'];
        $docking = $_GET['docking'];
        $adjustable = $_GET['adjustable'];
        $wheelchair = $_GET['wheelchair'];

        $sql2 = "SELECT DISTINCT `Name`, `TypeID`, `RoomID`, `Price` FROM desk WHERE `TypeID` NOT IN (SELECT DISTINCT `TypeID` FROM reserva WHERE `Type` = 'Desk' and \"".$checkInDate."\" BETWEEN `CheckIN` AND `CheckOUT` OR \"".$checkOutDate."\" BETWEEN `CheckIN` AND `CheckOUT` OR `CheckIN` BETWEEN \"".$checkInDate."\" AND \"".$checkOutDate."\")";
          
        $stmt2 = $db->prepare($sql2);
        $stmt2->execute();
        $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $numrows2 = count($rows2);

        if ($numrows2 >= 1) {
            ?>
                    <p class="form-section fs-3 mt-2"> Search Result</p>
                    <div class="form-body card p-4 bg-solight-gray shadowed rounded-login h-auto">
                        <span class="ms-3 mb-3">Available Desks From <?php echo $checkInDate; ?> to <?php echo $checkOutDate; ?>: <strong><?php echo $numrows2; ?> Desks.</strong></span>
                        <div class="table-responsive w-100 card p-2 bg-white shadowed rounded-login">
                            <table class="table table-stripped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-uppercase text-center" scope="col">Desk</th>
                                        <th class="w-50 text-uppercase text-center" scope="col text-uppercase">Room</th>
                                        <th class="text-uppercase text-center" scope="col text-uppercase">WorkSpace</th>
                                        <th class="text-uppercase text-center" scope="col text-uppercase">Price</th>
                                        <th class="text-uppercase text-center" scope="col text-uppercase">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    foreach($rows2 as $row){
                                        ?>
                                        <tr>
                                            <td><div class="row justify-content-center">
                                                    <?php 
                                                        echo $row['Name'];
                                                    ?>
                                                    </div>
                                            </td>
                                            <td><div class="row justify-content-center">
                                                <?php 
                                                    $sql6 = "SELECT `Name`, `WorkSpaceID` FROM room WHERE `TypeID` = ".$row['RoomID'];
                
                                                    $stmt6 = $db->prepare($sql6);
                                                    $stmt6->execute();
                                                    $rows6 = $stmt6->fetchAll(PDO::FETCH_ASSOC);
                                                    $numrows6 = count($rows6);
                
                                                    if ($numrows6 >= 1) {
                                                        echo $rows6[0]['Name']; 
                                                    }
                                                ?>
                                                    </div>
                                            </td>
                                            <td><div class="row justify-content-center"><?php 
                                                    if ($numrows6 >= 1) {
                                                        $sql7 = "SELECT `Name` FROM workspace WHERE `TypeID` = ".$rows6[0]['WorkSpaceID'];
                    
                                                        $stmt7 = $db->prepare($sql7);
                                                        $stmt7->execute();
                                                        $rows7 = $stmt7->fetchAll(PDO::FETCH_ASSOC);
                                                        $numrows7 = count($rows7);
                    
                                                        if ($numrows7 >= 1)  {
                                                            echo $rows7[0]['Name']; 
                                                        }
                                                    }
                                                    
                                                ?></div></td>
                                            <td><div class="row justify-content-center"><?php echo $row['Price']; ?></div></td>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <?php 
                                                        echo '<button class="btn btn-outline-info btn-min-width mx-1 rounded-3 w-auto py-0 px-2" onclick="secureBook('.$row['TypeID'].','.$_SESSION['id'].',\''.$checkInDate.'\',\''.$checkOutDate.'\','.$row['Price'].')">Book Now</button>'; 
                                                        }
                                                    ?>
                                                </div>
                                            </td>
                                            <!---->
                                </tbody>
                            </table>
                        </div>
                    </div>
        <?php
        

        }
    }
?>
