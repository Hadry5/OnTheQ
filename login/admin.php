<?php

require("securityadmin.php");
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
                    <li class="nav-item"><a class="nav-link" href="./allDesk.php">Desk</a></li>
                    <li class="nav-item"><a class="nav-link" href="./allRoom.php">Rooms</a></li>
                    <li class="nav-item"><a class="nav-link" href="./allWorkspace.php">Workspace</a></li>
                    <li class="nav-item"><a class="nav-link" href="./allReservation.php">Bookings</a></li>
                </ul>
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
                            Bookings for Today</span>
                        </h3>
                        <p class="card-title text-white-50">There are <span class="text-white">
                                <?php

                                $sql = "SELECT COUNT(`BookingID`) as numberbooking FROM reserva WHERE DATE(`CheckIN`) = CURRENT_DATE";

                                if ($stmt = mysqli_prepare($link, $sql)) {
                                    // Bind variables to the prepared statement as parameters


                                    // Attempt to execute the prepared statement
                                    if (mysqli_stmt_execute($stmt)) {
                                        // Store result
                                        mysqli_stmt_store_result($stmt);


                                        // Check if username exists, if yes then verify password
                                        if (mysqli_stmt_num_rows($stmt) == 1) {
                                            mysqli_stmt_bind_result($stmt, $numberbookings);

                                            if (mysqli_stmt_fetch($stmt)) {
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
                        <h3 class="card-title mt-3 text-white-50">
                            Total Users Registered</span>
                        </h3>
                        <p class="card-title text-white-50">There are <span class="text-white">
                                <?php

                                $sql = "SELECT COUNT(`CustomerID`) as numbercustomer FROM customer";

                                if ($stmt = mysqli_prepare($link, $sql)) {
                                    // Bind variables to the prepared statement as parameters


                                    // Attempt to execute the prepared statement
                                    if (mysqli_stmt_execute($stmt)) {
                                        // Store result
                                        mysqli_stmt_store_result($stmt);


                                        // Check if username exists, if yes then verify password
                                        if (mysqli_stmt_num_rows($stmt) == 1) {
                                            mysqli_stmt_bind_result($stmt, $numberbookings);

                                            if (mysqli_stmt_fetch($stmt)) {
                                                echo $numberbookings . " customers";
                                            }
                                        }
                                    }
                                }
                                ?>
                            </span></p>

                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-green-gradient text-center">
                <div class="card-content">
                    <div class="card-body pt-3">
                        <h3 class="card-title mt-3 text-white-50">
                            Reservations Made </span>
                        </h3>
                        <p class="card-title text-white-50"><span class="text-white">
                                <?php

                                $sql = "SELECT COUNT(`BookingID`) as numberbooking FROM reserva WHERE DATE(`CheckIN`) < CURRENT_DATE and BookStatus = 'Completed'";

                                if ($stmt = mysqli_prepare($link, $sql)) {
                                    // Bind variables to the prepared statement as parameters


                                    // Attempt to execute the prepared statement
                                    if (mysqli_stmt_execute($stmt)) {
                                        // Store result
                                        mysqli_stmt_store_result($stmt);


                                        // Check if username exists, if yes then verify password
                                        if (mysqli_stmt_num_rows($stmt) == 1) {
                                            mysqli_stmt_bind_result($stmt, $numberbookings);

                                            if (mysqli_stmt_fetch($stmt)) {
                                                echo $numberbookings . " bookings";
                                            }
                                        }
                                    }
                                }
                                ?>
                            </span> have been completed</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="w-75 mt-5">
                    <p class="fs-3 mb-4">Add new Desk</p>
                    <div class="form-body card p-4 bg-solight-gray shadowed rounded-login">
                        <div class="row mt-2">
                            <div class="col mx-2">
                                <div class="form-group">
                                    <label for="projectinput1">Desk Name</label>
                                    <input id="nameDesk" type="text" name="nameDesk" class="form-control" placeholder="Desk..." required>
                                </div>
                            </div>
                            <div class="col mx-2">
                                <div class="form-group">
                                    <label for="projectinput2">Room Name</label>
                                    <input type="text" class="form-control" id="nameRoom" name="nameRoom" placeholder="Room..." required>
                                </div>
                            </div>
                            <div class="col mx-2">
                                <div class="form-group">
                                    <label for="projectinput2">Workspace Name</label>
                                    <input type="text" class="form-control" id="nameWorkspace" name="nameWorkspace" placeholder="Workspace..." required>
                                </div>
                            </div>
                            <div class="col mx-2">
                                <div class="form-group">
                                    <label for="projectinput2">Price</label>
                                    <input type="price" class="form-control" id="price" name="price" placeholder="Price..." required>
                                </div>
                            </div>
                            <div class="col mx-2">
                                <div class="form-group">
                                    <label for="projectinput2">Description</label>
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Description..." required>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 mx-2">
                                <div class="form-group">
                                    <label id="error_find_desk"></label>
                                </div>
                            </div>

                        </div>
                        <div class="row text-end mt-2">
                            <div class="form-group">
                                <button class="btn btn-outline-info btn-min-width mx-1 rounded-3 w-auto py-2 px-4" onclick="addDesk();">Add Desk</button>
                            </div>
                        </div>
                    </div>
                    <p class="fs-3 mt-5 mb-4">Add new Room</p>
                    <div class="form-body card p-4 bg-solight-gray shadowed rounded-login">
                        <div class="row mt-2">
                            <div class="col mx-2">
                                <div class="form-group">
                                    <label for="projectinput1">Room Name</label>
                                    <input id="nameRoom2" type="text" name="nameRoom" class="form-control" placeholder="Room..." required>
                                </div>
                            </div>
                            <div class="col mx-2">
                                <div class="form-group">
                                    <label for="projectinput2">Workspace Name</label>
                                    <input type="text" class="form-control" id="nameWorkspace2" name="nameWorkspace" placeholder="Workspace..." required>
                                </div>
                            </div>
                            <div class="col mx-2">
                                <div class="form-group">
                                    <label for="projectinput2">Price</label>
                                    <input type="text" class="form-control" id="price2" name="price2" placeholder="Price..." required>
                                </div>
                            </div>
                            <div class="col mx-2">
                                <div class="form-group">
                                    <label for="projectinput2">Description</label>
                                    <input type="text" class="form-control" id="description2" name="description2" placeholder="Description..." required>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 mx-2">
                                <div class="form-group">
                                    <label id="error_find_desk2"></label>
                                </div>
                            </div>

                        </div>
                        <div class="row text-end mt-2">
                            <div class="form-group">
                                <button class="btn btn-outline-info btn-min-width mx-1 rounded-3 w-auto py-2 px-4" onclick="addRoom();">Add Room</button>
                            </div>
                        </div>
                    </div>
                    <p class="fs-3 mt-5 mb-4">Add new Workspace</p>
                    <div class="form-body card p-4 bg-solight-gray shadowed rounded-login mb-5">
                        <div class="row mt-2">
                            <div class="col mx-2">
                                <div class="form-group">
                                    <label for="projectinput2">Workspace Name</label>
                                    <input type="text" class="form-control" id="nameWorkspace3" name="nameWorkspace3" placeholder="Workspace..." required>
                                </div>
                            </div>
                            <div class="col mx-2">
                                <div class="form-group">
                                    <label for="projectinput2">Price</label>
                                    <input type="text" class="form-control" id="price3" name="price3" placeholder="Price..." required>
                                </div>
                            </div>
                            <div class="col mx-2">
                                <div class="form-group">
                                    <label for="projectinput2">Description</label>
                                    <input type="text" class="form-control" id="description3" name="description3" placeholder="Description..." required>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 mx-2">
                                <div class="form-group">
                                    <label id="error_find_desk3"></label>
                                </div>
                            </div>

                        </div>
                        <div class="row text-end mt-2">
                            <div class="form-group">
                                <button class="btn btn-outline-info btn-min-width mx-1 rounded-3 w-auto py-2 px-4" onclick="addWorkspace();">Add Workspace</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function addDesk() {
                var desk = $("#nameDesk").val();
                var room = $("#nameRoom").val();
                var workspace = $("#nameWorkspace").val();
                var price = $("#price").val();
                var description = $("#description").val();

                if (desk == "" || room == "" || workspace == "" || price == "" || description == "") {
                    document.getElementById("error_find_desk").innerHTML = "Be sure to fill all the gaps.";
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("error_find_desk").innerHTML = xmlhttp.responseText;
                        }
                    };
                    xmlhttp.open("GET", "addDesk.php?desk=" + desk + "&room=" + room + "&workspace=" + workspace + "&price=" + price + "&description=" + description, true);
                    xmlhttp.send();
                }
            }

            function addRoom() {
                var room2 = $("#nameRoom2").val();
                var workspace2 = $("#nameWorkspace2").val();
                var price2 = $("#price2").val();
                var description2 = $("#description2").val();

                if (room2 == "" || workspace2 == "" || price2 == "" || description2 == "") {
                    document.getElementById("error_find_desk2").innerHTML = "Be sure to fill all the gaps.";
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            console.log(xmlhttp.responseText);
                            document.getElementById("error_find_desk2").innerHTML = xmlhttp.responseText;
                        }
                    };
                    xmlhttp.open("GET", "addRoom.php?room2=" + room2 + "&workspace2=" + workspace2 + "&price2=" + price2 + "&description2=" + description2, true);
                    xmlhttp.send();
                }
            }

            function addWorkspace() {
                var workspace3 = $("#nameWorkspace3").val();
                var price3 = $("#price3").val();
                var description3 = $("#description3").val();

                if (workspace3 == "" || price3 == "" || description3 == "") {
                    document.getElementById("error_find_desk3").innerHTML = "Be sure to fill all the gaps.";
                } else {

                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            console.log(xmlhttp.responseText);
                            document.getElementById("error_find_desk3").innerHTML = xmlhttp.responseText;
                        }
                    };
                    xmlhttp.open("GET", "addWorkspace.php?workspace3=" + workspace3 + "&price3=" + price3 + "&description3=" + description3, true);
                    xmlhttp.send();
                }
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