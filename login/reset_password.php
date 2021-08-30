<?php

require("db.php");

$login_err = "";
if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) && ($_GET["action"] == "reset") && !isset($_POST["action"]))
{
    $key = $_GET["key"];
    $email = $_GET["email"];
    $curDate = date("Y-m-d H:i:s");
    $sql1 = "SELECT * FROM `reset_password_temp` WHERE `key`='" . $key . "' and `email`='" . $email . "'";
    $stmt1 = $db->prepare($sql1);
    $stmt1->execute();
    $row = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    $numrows = count($row);
    if ($numrows == 0)
    {
        $login_err = "The link is invalid/expired.";
    }
    else
    {
        $expDate = $row[0]['expDate'];
        if ($expDate >= $curDate)
        {
        
        }
        else
        {
            $login_err = "The link is expired. (1 day after request).";
        }
    }
} 


if (isset($_POST["email"]) && isset($_POST["action"]) && ($_POST["action"] == "update"))
{
    $login_err = "";
    $pass1 = $_POST["pass1"];
    $pass2 = $_POST["pass2"];
    $email = $_POST["email"];
    if ($pass1 != $pass2)
    {
        $login_err = "Password do not match, both password should be same.";
    }
    if ($login_err != "")
    {
        $showModal = false;
    }
    else
    {
        $pass1 = password_hash($pass1, PASSWORD_DEFAULT);
        $sql2 = "UPDATE `customer` SET `Password`='" . $pass1 . "' WHERE `email`='" . $email . "';";
        $db->prepare($sql2)->execute();
        $sql3 = "DELETE FROM `reset_password_temp` WHERE `email`='" . $email . "';";
        $db->prepare($sql3)->execute();

        $showModal = true;
        
    }
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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reset Password Successfull</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-footer">
                    <label>Your password has been changed correctly, login again with the new credentials.</label>
                </div>
                </div>
            </div>
        </div>
    <section class="page-login">
        <div class="container">
            <div class="row justify-content-center">
                <div class="card mr-4 shadowed-blue bg-login h-auto rounded-login" style="width: 35rem; ">
                    <div class="card-body h-100">
                        <h3 class="text-uppercase text-center fa-primary my-5">Reset Password</h3>
                        <form class="my-5" action="" method="POST">
                            <?php
                                if ($login_err == "") {
                            ?>
                            <input type="hidden" name="action" value="update" />
                            <input type="hidden" name="email" value="<?php echo $email;?>" />
                            <div class="form-group my-4">
                                <input type="password" class="form-control" name="pass1" placeholder="Enter password">
                            </div>
                            <div class="form-group my-4">
                                <input type="password" class="form-control" name="pass2" placeholder="Confirm Password">
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary btn-xl shadow text-uppercase rounded-pill mt-5 px-5 py-2 text-center" type="submit">Reset Password</button>
                            </div>
                            <?php 
                            }
                            ?>
                            <div class="text-center">
                                
                                <?php
                                
                                if (!empty($login_err))
                                {
                                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                                    echo '<button class="btn btn-primary btn-xl shadow text-uppercase rounded-pill mt-5 px-5 py-2 text-center" href="./login.php">log In</button>';
                                }

                                ?>
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