<?php

require("db.php");

$email = $password = "";
$username_err = $password_err = $login_err = "";

session_start();
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username is empty
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql1 = "SELECT ID, adminusername, adminpassword FROM `adminlogin` WHERE adminusername = ?";

        $admin = false;

        if ($stmt1 = mysqli_prepare($link, $sql1)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt1, "s", $param_email);

            // Set parameters
            $param_email = $email;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt1)) {
                // Store result
                mysqli_stmt_store_result($stmt1);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt1) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt1, $id, $email, $hashed_password);
                    if (mysqli_stmt_fetch($stmt1)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            

                            $admin = true;
                            // Store data in session variables
                            $_SESSION["admin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;

                            // Redirect user to welcome page
                            header("location: admin.php");
                        }
                    }
                }
            }
        }

        if (!$admin) {

            $sql = "SELECT CustomerID, Email, Password, FirstName, EmailValidated FROM `customer` WHERE Email = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);

                // Set parameters
                $param_email = $email;

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Store result
                    mysqli_stmt_store_result($stmt);

                    // Check if username exists, if yes then verify password
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password, $name, $emailValidated);
                        if (mysqli_stmt_fetch($stmt)) {
                            
                            if (password_verify($password, $hashed_password)) {
                                
                                if ($emailValidated == 1) {
                                     // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["email"] = $email;
                                $_SESSION["name"] = $name;

                                $ip = $_SERVER["REMOTE_ADDR"];
                                mysqli_query($link, "DELETE FROM `iptries` WHERE `address` LIKE '$ip'");
                                // Redirect user to welcome page
                                header("location: ./dashboard.php");
                                } else {
                                    $login_err = "You must validate your email before logging in";
                                }
                            } else {
                                // Password is not valid, display a generic error message
                                $login_err = "Invalid username or password";
                                $ip = $_SERVER["REMOTE_ADDR"];
                                mysqli_query($link, "INSERT INTO `iptries` (`address` ,`timestamp`) VALUES ('$ip',CURRENT_TIMESTAMP)");
                                $result = mysqli_query($link, "SELECT COUNT(*) FROM `iptries` WHERE `address` LIKE '$ip' AND `timestamp` > (now() - interval 10 minute)");
                                $count = mysqli_fetch_array($result, MYSQLI_NUM);

                                if ($count[0] > 3) {
                                    header("location: ./error_tries.php");
                                }
                            }
                        } else {
                            $login_err = "Contact the Admin if you are having this error.";
                        }
                    } else {
                        // Username doesn't exist, display a generic error message
                        $login_err = "Invalid username or password.";
                        $ip = $_SERVER["REMOTE_ADDR"];
                        mysqli_query($link, "INSERT INTO `iptries` (`address` ,`timestamp`)VALUES ('$ip',CURRENT_TIMESTAMP)");
                        $result = mysqli_query($link, "SELECT COUNT(*) FROM `iptries` WHERE `address` LIKE '$ip' AND `timestamp` > (now() - interval 10 minute)");
                        $count = mysqli_fetch_array($result, MYSQLI_NUM);

                        if ($count[0] > 3) {
                            header("location: error_tries.php");
                        }
                    }
                } else {
                    $login_err = "Oops! Something went wrong. Please try again later.";
                }
            }
            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            $login_err = "nose";
        }
    }

    // Close connection
    mysqli_close($link);
}



?>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Agency - Start Bootstrap Theme</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://kit.fontawesome.com/830f3f6cfa.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <a class="navbar-brand mr-5" href="../index.html"><img src="../assets/img/logo.png" alt="OnTheQ"></a>
                <ul class="navbar-nav py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#services">Desk</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portfolio">Rooms</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Workspace</a></li>
                    <li class="nav-item"><a class="nav-link" href="#team">Pricing</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
            <a class="btn btn-outline-white text-uppercase rounded-pill" href="login/login.php">Member Area</a>

        </div>
    </nav>
    <section class="page-login">
        <div class="container">
            <div class="row justify-content-center">
                <div class="card mr-4 shadowed-blue bg-login h-auto rounded-login" style="width: 35rem; ">
                    <div class="card-body h-100">
                        <h3 class="text-uppercase text-center fa-primary my-5">Log in</h3>
                        <form class="my-5" action="" method="POST">
                            <div class="form-group my-4">
                                <input type="email" class="form-control" name="email" placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group my-4">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="text-center">
                                <?php
                                if (!empty($login_err)) {
                                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                                }

                                ?>
                                <button class="btn btn-primary btn-xl shadow text-uppercase rounded-pill mt-5 px-5 py-2 text-center" type="submit">Log In</button>
                            </div>
                        </form>
                        <div class="text-center">
                            <h6 class="my-4 text-center">Or Log In With</h6>
                            <a href=""><i class="fa fa-facebook fa-primary fa-login-f mx-2 fa-2x shadow" aria-hidden="true"></i></a>
                            <a href=""><i class="fa fa-google fa-primary fa-login-g mt-2 mb-5 fa-2x shadow" aria-hidden="true"></i></a>
                            <br>
                            <a href="./register.php" class="text-uppercase text-center my-5 text-decoration-none">
                                <h5 class="my-4">Sign up</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>