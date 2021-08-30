<?php

require("db.php");

if(isset($_POST["email"]) && (!empty($_POST["email"]))){
    $email = $_POST["email"];
    
    $expFormat = mktime(
        date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
    );
    $expDate = date("Y-m-d H:i:s",$expFormat);
    $key = md5($email);
    $addKey = substr(md5(uniqid(rand(),1)),3,10);
    $key = $key . $addKey;

    $sql1 = "INSERT INTO `reset_password_temp` (`key`, `email`, `expDate`) VALUES ('".$key."', '".$email."', '".$expDate."')";
    $db->prepare($sql1)->execute();
    

    $to      = $email; // Send email to our user
    $subject = 'Reset Password'; // Give the email a subject 
    $message = '
    
    
    You have requested to change your password, reset your password and log in your account by pressing the url below.
    
    ------------------------
    Please click this link to reset your password:
    http://localhost/Projects/OnTheQ/OnTheQWeb/login/reset_password.php?email='.$email.'&key='.$key.'&action=reset
    ------------------------
    
    
    
    '; // Our message above including the link
                        
    $headers = 'From:noreply@OnTheQ.com' . "\r\n"; // Set from headers
    mail($to, $subject, $message, $headers); // Send our email
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
                        <h3 class="text-uppercase text-center fa-primary my-5">Too Many Tries</h3>
                        <form class="my-5" action="" method="POST">
                            <div class="form-group my-4">
                                <input type="email" class="form-control" name="email" placeholder="Enter email to reset password">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary btn-xl shadow text-uppercase rounded-pill mt-5 px-5 py-2 text-center" type="submit">Reset Password</button>
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