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
                <a class="navbar-brand mr-5" href="./admin.php"><img src="../assets/img/logo.png" alt="OnTheQ"></a>
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
                <div class="table w-75 mt-5">
                    <p class="fs-3 mb-2">All Reservations</p>
                    <div class="row mb-4">
                        <select class="col mx-2 form-select rounded-login" aria-label="Default select example" name="filter" id="filter" onchange="setFilter()">
                            <option selected>All Reservations</option>
                            <option value="1">Venue</option>
                            <option value="2">Organisation</option>
                            <option value="3">Date</option>
                        </select>
                        <div class="col mx-2" id="filterInput">

                        </div>
                        <div class="col mx-2" id="butonFilter">

                        </div>
                        <div class="col mx-2">

                        </div>
                        <div class="col mx-2">

                        </div>
                        <script>
                            
                            function setFilter() {
                                var filter = document.getElementById("filter")
                                var element = document.getElementById("filterInput");
                                var filterbuton = document.getElementById("butonFilter");

                                if (filter.value == 1) {
                                    element.innerHTML = '<input class="form-control" type="text" id="filterText" name="Venue" placeholder="Venue...">';
                                    filterbuton.innerHTML =  '<button class="btn btn-outline-info btn-min-width rounded-login w-50" onclick="loadTable(\'Venue\')">Filter</button>';
                                } else if (filter.value == 2) {
                                    element.innerHTML = '<input class="form-control" type="text" id="filterText" name="Organisation" placeholder="Organisation...">';
                                    filterbuton.innerHTML =  '<button class="btn btn-outline-info btn-min-width rounded-login w-50" onclick="loadTable(\'Organisation\')">Filter</button>';
                                } else if (filter.value == 3) {
                                    element.innerHTML = '<input class="form-control" type="date" id="filterText" name="Date" placeholder="Date...">';
                                    filterbuton.innerHTML =  '<button class="btn btn-outline-info btn-min-width rounded-login w-50" onclick="loadTable(\'Date\')">Filter</button>';
                                } else {
                                    element.innerHTML = '';
                                    filterbuton.innerHTML =  '';
                                    loadTable("Reset");
                                }
                            }
                            function loadTable(Type){
                                if (Type != "Reset") {
                                    var filtertext = document.getElementById("filterText").value;

                                } else {
                                    var filtertext = "";
                                }
                                
                                    var xmlhttp = new XMLHttpRequest();
                                xmlhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        document.getElementById("tbody").innerHTML = xmlhttp.responseText;
                                    }
                                };
                                xmlhttp.open("GET", "showReservations.php?type=" + Type + "&filterText=" + filtertext, true);
                                xmlhttp.send();
                            }

                            loadTable("Reset");
                        </script>
                    </div>
                    
                    <table class="table table-stripped">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-uppercase text-center" scope="col">Organisation</th>
                                <th class="text-uppercase text-center" scope="col">Check In</th>
                                <th class="text-uppercase text-center" scope="col">Check Out</th>
                                <th class="text-uppercase text-center" scope="col">Type</th>
                                <th class="text-uppercase text-center" scope="col">Name</th>
                                <th class="text-uppercase text-center" scope="col">Venue</th>
                                <th class="text-uppercase text-center" scope="col">Price</th>
                                <th class="text-uppercase text-center" scope="col">Book Status</th>
                                <th class="text-uppercase text-center" scope="col">Contact</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalForm" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Cabecera -->
                    <div class="modal-header justify-content-center">
                        <h4 class="modal-title" id="myModalLabel">Contact Form</h4>
                    </div>
                    
                    <!-- Modal Cuerpo contenido -->
                    <div class="modal-body">
                        <p class="statusMsg"></p>
                        <form role="form">
                            <div class="form-group">
                                <label for="inputName">Subject</label>
                                <input type="text" class="form-control" id="inputSubjectModal" placeholder="Subject..."/>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input type="email" class="form-control" id="inputEmailModal" placeholder="Email..."/>
                            </div>
                            <div class="form-group">
                                <label for="inputMessage">Mensaje</label>
                                <textarea class="form-control" id="inputMessageModal" placeholder="Message..."></textarea>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Modal Pie de Página -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary submitBtn" data-dismiss="modal" onclick="SendForm()">Send Email</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function WriteModal(email) {
                var inputEmailModal = document.getElementById("inputEmailModal");

                inputEmailModal.value = email;
            }
            function SendForm(){
                var inputSubjectModal = document.getElementById("inputSubjectModal").value;
                var inputEmailModal = document.getElementById("inputEmailModal").value;
                var inputMessageModal = document.getElementById("inputMessageModal").value;

                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        alert(xmlhttp.responseText);


                    }
                };
                xmlhttp.open("GET", "../sendForm.php?Subject=" + inputSubjectModal + "&Email=" + inputEmailModal + "&Message=" + inputMessageModal, true);
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