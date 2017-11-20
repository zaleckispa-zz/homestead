<?php

include 'dbconnect.php';
require_once "config.php";
//check if form is submitted

if (isset($_POST['login'])) {
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '" . md5($password) . "'";
    $result = mysqli_query($con, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['type'] = $row['type'];
        if($_SESSION['type']=='User'){
        header("Location: user.php");
        }
        if($_SESSION['type']=='Admin'){
        header("Location: admin.php");
        }
    } else {
        $errormsg = "Email and/or password is wrong!";
    }
} else if (isset($_SESSION['access_token'])){
    header("Location: guser.php");
    exit();
}
$loginURL = $gClient->createAuthUrl();



?>

<!DOCTYPE html>
<html>
    <head>
        <title>Homestead</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" >
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    </head>
    <body>

        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <!-- add header -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- menu items -->
                <div class="collapse navbar-collapse" id="navbar1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="visitor.php">Back</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 well">
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
                        <fieldset>
                            <legend>Login</legend>

                            <div class="form-group">
                                <label for="name">E-mail</label>
                                <input type="text" name="email" placeholder="E-mail" required class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="password" name="password" placeholder="Password" required class="form-control" />
                            </div>

                            <div class="form-group">
                                <input type="submit" name="login" value="Login" class="btn btn-primary" />
                            </div>
                            <div class="form-group">
                                <input type="button" onclick="window.location = '<?php echo $loginURL ?>';" name="loginGoogle" value="Login using Google" class="btn btn-danger" />
                            </div>                            
                        </fieldset>
                    </form>
                    <span class="text-danger"><?php
                        if (isset($errormsg)) {
                            echo $errormsg;
                        }
                        ?></span>
                </div>
            </div>
        </div>

        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>