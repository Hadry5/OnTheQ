<?php

require('db.php');

$showModal = "Your Account is already activated";
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verify data
    $email = ($_GET['email']); // Set email variable
    $hash = ($_GET['hash']); // Set hash variable

    $sql1 = "SELECT Email, hash, active FROM customer WHERE Email='".$email."' AND Hash='".$hash."' AND EmailValidated='0'"; 
    $stmt1 = $db->prepare($sql1);
    $stmt1->execute();
    $rows = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    $numrows = count($rows);
    if ($numrows > 0) {
        $sql2 = "UPDATE customer SET EmailValidated='1' WHERE Email='".$email."' AND Hash='".$hash."' AND EmailValidated='0'";
        $stmt2 = $db->prepare($sql2)->execute();

        $showModal = "Your account has been activated, you can now login";
    }

}

?>
<html lang="en">
  <head>
    <title>On The Q - Register</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/830f3f6cfa.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        
    <!-- Bootstrap CSS -->
    <link href="../css/styles.css" rel="stylesheet" />
  </head>
  <body id="page-top">        
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
        <!-- Modal -->
        
        <section class="page-register">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="card mr-4 shadowed-blue bg-login h-auto rounded-login" style="width: 35rem; ">
                        <div class="card-body h-100">
                            <h3 class="text-uppercase text-center fa-primary my-5">Verification</h3>
                            
                            <div class="text-center">
                                <h6 class="text-center"><?php echo $showModal ?></h6>
                                <a href="./login.php" class="text-uppercase text-center my-5 text-decoration-none"><h5 class="my-4">Log In</h5></a>
                            </div>                     
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
