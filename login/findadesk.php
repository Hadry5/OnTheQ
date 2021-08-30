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
                <a class="navbar-brand mr-5" href="./dashboard.php"><img src="../assets/img/logo.png" alt="OnTheQ"></a>
                <ul class="navbar-nav text-uppercase py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="./findadesk.php">book a Desk</a></li>
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
    <div class="container">
        <div class="row justify-content-center mx-5">
            <form class="form" method="POST" id="myForm" onsubmit="return false">
            <p class="form-section fs-3 mt-5"> Find a Desk</p>

                <div class="form-body card p-4 bg-solight-gray shadowed rounded-login h-75">
                    <div class="row mt-2">
                        <div class="col-md-4 mx-2">
                            <div class="form-group">
                                <strong><span class="form-section fs-5"> When do you want to book?</span></strong>
                            </div>
                        </div>
                        <div class="col-md-4 mx-2">
                            <div class="form-group">
                                <strong><span class="form-section fs-5">Desk Attributes</span></strong>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2 mx-2">
                            <div class="form-group">
                                <label for="projectinput1">Check In Date</label>
                                <input id="checkInDate" type="date" name="checkInDate" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2 mx-2">
                            <div class="form-group">
                                <label for="projectinput2">Check In Hour</label>
                                <input type="time" class="form-control" id="checkInHour" name="checkInHour" required>
                            </div>
                        </div>
                        <div class="col-md-3 mx-2">
                            <div class="form-group">
                                <div>
                                    <label class="mb-2" for="projectinput2">Privacy</label>
                                    <br>
                                    <input type="radio" id="high" name="privacy" value="high" checked>
                                    <label class="px-2" for="huey">High</label>
                                    <input type="radio" id="medium" name="privacy" value="medium">
                                    <label class="px-2" for="dewey">Medium</label>
                                    <input type="radio" id="low" name="privacy" value="low">
                                    <label for="louie">Low</label>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 mx-2">
                            <div class="form-group">
                                <label for="projectinput1">Check Out Date</label>
                                <input id="checkOutDate" type="date" class="form-control" name="checkOutDate" required>
                            </div>
                        </div>
                        <div class="col-md-2 mx-2">
                            <div class="form-group">
                                <label for="projectinput2">Check Out Hour</label>
                                <input type="time" class="form-control" id="checkOutHour" name="checkOutHour" required>
                            </div>
                        </div>
                        <div class="col-md-6 mx-2">
                            <div class="form-group">
                                <div>
                                    <label class="mb-2" for="projectinput2">Default Desk Attributes</label>
                                    <br>
                                    <label class="mx-2"><input type="checkbox" id="monitor" value="first_checkbox" name="monitor"> Monitor</label>
                                    <label class="mx-2"><input type="checkbox" id="docking" value="first_checkbox" name="docking"> Docking Station</label>
                                    <label class="mx-2"><input type="checkbox" id="adjustable" value="first_checkbox" name="adjustable"> Adjustable Height</label>
                                    <label class="mx-2"><input type="checkbox" id="wheelchair" value="first_checkbox" name="wheelchair"> Wheelchair Accessible</label>
                                </div>
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
                    <div class="row mt-2">
                        <div class="col-md-6 mt-4">
                            <div class="form-group">
                                <button class="btn btn-outline-info btn-min-width mx-1 rounded-3 w-auto py-2 px-4" onclick="findDesk()">Find A Desk</button>
                                <button class="btn btn-outline-info btn-min-width mx-1 rounded-3 w-auto py-2 px-4" onclick="document.getElementById('myForm').reset();">Clear Fields</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row justify-content-center mx-5" id="searchTable">
            </div>
            
            
        </div>
    </div>
    <script>
                function findDesk() {
                    
                    var checkInDate = $("#checkInDate").val();
                    var checkInHour = $("#checkInHour").val();
                    var checkOutDate = $("#checkOutDate").val();
                    var checkOutHour = $("#checkOutHour").val();
                    var high = $("#high").prop('checked');
                    var medium = $("#medium").prop('checked');
                    var low = $("#low").prop('checked');
                    if (high) {
                        var privacy = 'high';
                    } else if (medium) {
                        var privacy = 'medium';
                    } else{
                        var privacy = 'low';
                    }
                    var monitor = $("#monitor").prop('checked');
                    var docking = $("#docking").prop('checked');
                    var adjustable = $("#adjustable").prop('checked');
                    var wheelchair = $("#wheelchair").prop('checked');

                    var hour1 = Number(checkInHour.split(':')[0] * 60) + Number(checkInHour.split(':')[1]);
                    var hour2 = Number(checkOutHour.split(':')[0] * 60) + Number(checkOutHour.split(':')[1]);



                    var diff = hour2 - hour1;
                    if (checkInDate =="" || checkInHour == "" || checkOutHour == "" || checkOutDate == "") {
                        document.getElementById("error_find_desk").innerHTML = "Fill the Date and Hour Fields.";
                    } else if (checkInDate > checkOutDate || (checkInDate == checkOutDate && checkInHour > checkOutHour)) {
                        document.getElementById("error_find_desk").innerHTML = "Notice that the Check In must be before the Check Out";
                    } else if (checkInDate == checkOutDate && diff < 60) {
                        document.getElementById("error_find_desk").innerHTML = "Reservation must be of one hour at least";
                    } else {
                        document.getElementById("error_find_desk").innerHTML = "";


                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("searchTable").innerHTML = xmlhttp.responseText;
                            /*setTimeout(
                                function() 
                                {
                                    location.reload();
                                }, 0001);  */
                            }
                        };
                        
                        xmlhttp.open("GET","lookforDesk.php?checkInDate="+checkInDate+"&checkInHour="+checkInHour+"&checkOutDate="+checkOutDate+"&checkOutHour="+checkOutHour+"&privacy="+privacy+"&monitor="+monitor+"&docking="+docking+"&adjustable="+adjustable+"&wheelchair="+wheelchair,true);
                        
                        xmlhttp.send();
                    }

                    
                }
                function secureBook(deskID, customerID, CheckInDesk, checkOutDesk, price) {
                    if (confirm("Are you sure to Book from" + CheckInDesk + " to " + checkOutDesk + "?") == true) {
                        bookDesk(deskID, customerID, CheckInDesk, checkOutDesk, price);
                    }
                }
                function bookDesk(deskID, customerID, CheckInDesk, checkOutDesk, price) {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        alert(xmlhttp.responseText);

                        setTimeout(
                                function() 
                                {
                                    window.location.replace("./dashboard.php");
                                }, 0001);
                    }
                    };
                    xmlhttp.open("GET","bookDesk.php?TypeID="+deskID+"&CustomerID="+customerID+"&CheckIN="+CheckInDesk+"&CheckOUT="+checkOutDesk+"&Price="+price+"&Type=Desk",true);
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