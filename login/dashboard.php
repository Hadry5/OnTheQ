<?php 

require("security.php");
require("db.php");

?>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://kit.fontawesome.com/830f3f6cfa.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Bootstrap CSS -->
    <link href="../css/styles.css" rel="stylesheet" />
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark top" id="mainNav">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <a class="navbar-brand mr-5" href="#page-top"><img src="../assets/img/logo.png" alt="OnTheQ"></a>
                <ul class="navbar-nav text-uppercase py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="./findadesk.php">Book a Desk</a></li>
                </ul>
            </div>
            <div class="dropdown ms-auto">
                <button class="btn-dashboard btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo htmlspecialchars($_SESSION["name"]); ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="#">Privacity</a>
                    <a class="dropdown-item" href="#">Help</a>
                </div>
            </div>
            <ul class="navbar-nav text-uppercase py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link" href="./logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col-auto mr-auto">
            <div class="card text-white bg-gray text-center h-100">
                <div class="card-content">
                    <div class="card-body pt-3">
                        <h4 class="card-title mt-3"><?php echo date("d"); ?></h4>
                        <p class="card-title text-muted text-uppercase"><?php echo substr(date("l"), 0, 3); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-complementary-gradient text-center h-100">
                <div class="card-content">
                    <div class="card-body pt-3">
                        <h3 class="card-title mt-3 text-white-50">
                            Hello <span class="text-white"><?php echo htmlspecialchars($_SESSION["name"]); ?></span>
                        </h3>
                        <p class="card-title text-white-50" >You have <span class="text-white">
                            <?php

                            $sql = "SELECT COUNT(`BookingID`) as numberbooking FROM reserva WHERE `CustomerID` = ? and DATE(`CheckIN`) = CURRENT_DATE";

                            if($stmt = mysqli_prepare($link, $sql)){
                                // Bind variables to the prepared statement as parameters
                                mysqli_stmt_bind_param($stmt, "s", $_SESSION["id"]);
                    
                    
                                // Attempt to execute the prepared statement
                                if(mysqli_stmt_execute($stmt)){
                                    // Store result
                                    mysqli_stmt_store_result($stmt);
                                    

                                    // Check if username exists, if yes then verify password
                                    if(mysqli_stmt_num_rows($stmt) == 1){
                                        mysqli_stmt_bind_result($stmt, $numberbookings);
                                        
                                        if(mysqli_stmt_fetch($stmt)){
                                            echo $numberbookings . " bookings";
                                        }
                                    }

                                }
                            }
                            ?>
                        </span> today</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-blue-gradient text-center h-100">
                <div class="card-content">
                    <div class="card-body pt-3">
                        <div class="row">
                            <div class="col">
                                <p class="card-title float-start text-uppercase">Next Desk Booking</p>
                            </div>
                            <div class="col">
                                <p class="card-text">
                                    <?php
                                        $sql1 = "SELECT `BookingID`, `CustomerID`, `CheckIN`, `CheckOUT`, `Type`, `TypeID`, `Price`, `BookStatus` FROM reserva WHERE `CustomerID` = ? and `Type` = 'Desk' and DATE(`CheckIN`) >= CURRENT_DATE ORDER BY `CheckIN`";

                                        $stmt1 = $db->prepare($sql1);
                                        $stmt1->execute(array($_SESSION["id"]));
                                        $rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                                        $numrows1 = count($rows1);


                                        if ($numrows1 >= 1) {
                                            echo $rows1[0]['CheckIN'];
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="card-text float-start my-2">Desk Name: 
                                    <?php
                                        $sql2 = "SELECT `Name`, `Description` FROM desk WHERE `TypeID` = ?";

                                        
                                        $stmt2 = $db->prepare($sql2);
                                        $stmt2->execute(array($rows1[0]['TypeID']));


                                        $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                                        $numrows2 = count($rows2);
                                        
                                        if ($numrows2 >= 1) {
                                            echo $rows2[0]['Name'];                                        
                                    ?>
                                </p>
                            </div>
                            <div class="col">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <p class="float-start">Description: <?php echo $rows2[0]['Description']; } ?></p>
                            </div>
                            <div class="col">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <?php 
                                        echo '<button class="btn btn-outline-light float-start btn-min-width mr-1 mb-1 px-4" onclick="secureDelete('.$rows1[0]['BookingID'].')">Delete</button>'; 
                                        }
                                ?>
                                
                            </div>
                            <div class="col">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
        <div class="card text-white bg-green-gradient text-center h-100">
            <div class="card-content">
                <div class="card-body pt-3">
                    <div class="row">
                        <div class="col">
                            <p class="card-title float-start text-uppercase">Next Room Booking</p>
                        </div>
                        <div class="col">
                            <p class="card-text">
                                <?php
                                    $sql3 = "SELECT `BookingID`, `CustomerID`, `CheckIN`, `CheckOUT`, `Type`, `TypeID`, `Price`, `BookStatus` FROM reserva WHERE `CustomerID` = ? and DATE(`CheckIN`) >= CURRENT_DATE and `Type` = 'Room' ORDER BY `CheckIN`";

                                    $stmt3 = $db->prepare($sql3);
                                    $stmt3->execute(array($_SESSION["id"]));
                                    $rows3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                                    $numrows3 = count($rows3);


                                    if ($numrows3 >= 1) {
                                        echo $rows3[0]['CheckIN'];
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="card-text float-start my-2">Room Name: <?php
                                        $sql4 = "SELECT `Name`, `Description` FROM room WHERE `TypeID` = ?";

                                        
                                        $stmt4 = $db->prepare($sql4);
                                        $stmt4->execute(array($rows3[0]['TypeID']));
                                        $rows4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);
                                        $numrows4 = count($rows4);
                                        
                                        if ($numrows4 >= 1) {
                                            echo $rows4[0]['Name'];                                        
                                    ?></p>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <p class="float-start">Description: <?php echo $rows4[0]['Description']; } ?></p>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                                <?php 
                                    echo '<button class="btn btn-outline-light float-start btn-min-width mr-1 mb-1 px-4" onclick="secureDelete('.$rows3[0]['BookingID'].')">Delete</button>'; 
                                    }
                                ?>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="table-responsive w-75 mt-5">
                <p class="fs-3 mb-4">Incoming Bookings</p>
                <table class="table table-stripped">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-uppercase" scope="col">Type</th>
                            <th class="w-50 text-uppercase" scope="col text-uppercase">Title</th>
                            <th class="text-uppercase" scope="col text-uppercase">Check In</th>
                            <th class="text-uppercase" scope="col text-uppercase">Check Out</th>
                            <th class="text-uppercase" scope="col text-uppercase">Status</th>
                            <th class="text-uppercase text-center" scope="col text-uppercase">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql5 = "SELECT `BookingID`, `CustomerID`, `CheckIN`, `CheckOUT`, `Type`, `TypeID`, `Price`, `BookStatus` FROM reserva WHERE `CustomerID` = ? and DATE(`CheckIN`) >= CURRENT_DATE ORDER BY `CheckIN`";

                            $stmt5 = $db->prepare($sql5);
                            $stmt5->execute(array($_SESSION["id"]));
                            $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
                            $numrows5 = count($rows5);

                            if ($numrows5 >= 1) {
                                foreach($rows5 as $row){
                                    
                                
                        ?>
                        <tr>
                            <td>
                                <div class="row justify-content-center">
                                    <?php 
                                        echo $row['Type'];
                                    ?>
                                </div>
                            </td>
                            <td>
                                <?php 
                                    $sql6 = "SELECT `Name`, `Description` FROM ".strtolower($row['Type'])." WHERE `TypeID` = ".$row['TypeID'];

                                    $stmt6 = $db->prepare($sql6);
                                    $stmt6->execute();
                                    $rows6 = $stmt6->fetchAll(PDO::FETCH_ASSOC);
                                    $numrows6 = count($rows6);

                                    if ($numrows6 >= 1) {
                                        echo $rows6[0]['Name']; }
                                ?>
                                    
                            </td>
                            <td><?php echo $row['CheckIN']; ?></td>
                            <td><?php echo $row['CheckOUT']; ?></td>
                            <td><?php echo $row['BookStatus']; ?></td>
                            <td>
                                <div class="row justify-content-center">
                                    <?php 
                                        echo '<button class="btn btn-outline-info btn-min-width mx-1 rounded-3 w-auto py-0 px-2" onclick="secureDelete('.$row['BookingID'].')">Delete</button>'; 
                                        }
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script>
        function secureDelete(bookid) {
            if (confirm("Are you sure to delete this booking?") == true) {
                deleteBooking(bookid)
            }
        }

        function deleteBooking(bookid) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(xmlhttp.responseText);

                setTimeout(
                    function() 
                    {
                        location.reload();
                    }, 0001);  
            }
            };
            xmlhttp.open("GET","deletebook.php?bookid="+bookid,true);
            xmlhttp.send();
        }
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <!--script src="js/scripts.js"></-script-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
</html>