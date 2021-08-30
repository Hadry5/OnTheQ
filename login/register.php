<?php

require('db.php');
$errormsg = "";
if (isset($_POST['email'])){
    // removes backslashes
    $firstname = stripslashes($_REQUEST['firstname']);
    $firstname = mysqli_real_escape_string($link,$firstname); 
    $surname = stripslashes($_REQUEST['surname']);
    $surname = mysqli_real_escape_string($link,$surname);
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($link,$email);
    $location = stripslashes($_REQUEST['location']);
    $location = mysqli_real_escape_string($link,$location);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($link,$password);
    $confirmpassword = stripslashes($_REQUEST['confirmpassword']);
    $confirmpassword = mysqli_real_escape_string($link,$confirmpassword);
    $trn_date = date("Y-m-d H:i:s");
    
    $hash = md5(rand(0,1000));
    $query = "INSERT into `customer` (FirstName, Surname, Email, Password, Location, CreatedAt, EmailValidated, Hash)
    VALUES ('$firstname','$surname','$email','".password_hash($password, PASSWORD_DEFAULT)."','$location', '$trn_date', false, '$hash')";
    
    if($password == $confirmpassword) {
        // Prepare a select statement
        $sql = "SELECT Email FROM customer WHERE Email = ?";

        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = trim($_POST["email"]);
            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $errormsg = "Email is already taken, try again.";
                } else{
                    $result = mysqli_query($link,$query);
                    if($result){
                        $to      = $email; // Send email to our user
                        $subject = 'Verification'; // Give the email a subject 
                        $message = '
                        
                        Thanks for signing up!
                        Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
                        
                        ------------------------
                        Email: '.$email.'
                        Password: '.$password.'
                        ------------------------
                        
                        Please click this link to activate your account:
                        http://localhost/Projects/OnTheQ/OnTheQWeb/login/verify.php?email='.$email.'&hash='.$hash.'
                        
                        '; // Our message above including the link
                                            
                        $headers = 'From:noreply@OnTheQ.com' . "\r\n"; // Set from headers
                        mail($to, $subject, $message, $headers); // Send our email


                        $showModal = true;
                    }
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
    } else {
        $errormsg = "Passwords do not match, try again.";
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
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registration Successfull</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-footer">
                    <label>A confirmation Email has been sent to your email to be able to log in the account, please check it and then log in</label>
                </div>
                </div>
            </div>
        </div>
        <section class="page-register">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="card mr-4 shadowed-blue bg-login h-auto rounded-login" style="width: 35rem; ">
                        <div class="card-body h-100">
                            <h3 class="text-uppercase text-center fa-primary my-5">Sign Up</h3>
                            <form class="my-5" name="registration" action="" method="POST">
                                <div class="form-group my-4">
                                    <div class="row MY-2">
                                        <div class="col">                                    
                                          <input type="text" class="form-control" name="firstname" placeholder="First Name">
                                        </div>
                                        <div class="col">
                                        <input type="text" class="form-control" name="surname" placeholder="Surname">
                                        </div>
                                    </div>  
                                  <input type="email" class="form-control my-2" name="email" placeholder="Email">
                                  <input type="text" class="form-control my-2" name="location" placeholder="Location">
                                  <input type="password" class="form-control my-2" name="password" placeholder="Password">
                                  <input type="password" class="form-control my-2" name="confirmpassword" placeholder="Confirm Password">
                                  
                                </div>
                                <div class="text-center">
                                    <?php

                                    if($errormsg != null) {
                                        echo '<small class="text-danger">'.$errormsg.'</small>' ;
                                    }

                                    ?>
                                    <br>
                                    <small class="text-muted">By pressing "Sign Up" you agree to the <a href="">Privacy Policy</a> and <a href="">Terms & Conditions</a> of this site</small>
                                    <br>
                                    <button class="btn btn-primary btn-xl shadow text-uppercase px-5 py-2 rounded-pill text-center" type="submit">Sign Up</button>
                                </div>
                            </form>
                            <div class="text-center">
                                <h6 class="text-center">Or Sign Up With</h6>
                                <a href=""><i class="fa fa-facebook fa-primary fa-login-f mx-2 fa-2x shadow" aria-hidden="true"></i></a>
                                <a href=""><i class="fa fa-google fa-primary fa-login-g mt-2 fa-2x shadow" aria-hidden="true"></i></a>
                                <br>
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

<?php

if($showModal){
    echo "<script type='text/javascript'>
            $(document).ready(function(){
            $('#myModal').modal('show');
            });
            $('#myModal').on('hidden.bs.modal', function () {
                window.location.href = './login.php';
            });
            
                        </script>";

                    
}

?>