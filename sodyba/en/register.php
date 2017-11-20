<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: visitor.php");
}

include_once 'dbconnect.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $surname = mysqli_real_escape_string($con, $_POST['surname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $password = mysqli_real_escape_string($con, $_POST['password']);


//name can contain only alpha characters and space
    if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $error = true;
        $name_error = "Name contains only letters";
    }


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $elpastas_error = "Please enter a valid email";
    }

    if (strlen($password) < 6) {
        $error = true;
        $password_error = "Password must contain atleast 6 symbols";
    }
    if (!$error) {
        if (mysqli_query($con, "INSERT INTO users(name,surname,email,phone,password)
            VALUES('" . $name . "', '" . $surname . "', '" . $email . "', '" . $phone . "',
             '" . md5($password)  . "')")) {
            $successmsg = "Succesfully registered! <a href='login.php'>Click to login</a>";
        } else {
            $errormsg = "Something went wrong... Try again!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Homestead</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" >
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" >
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
                        <li><a href="login.php">Login</a></li>
                        <li class="active"><a href="register.php">Register</a></li>
                        <li><a href="visitor.php">Back</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 well">
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
                        <fieldset>
                            <legend>Registration</legend>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" placeholder="Name" required value="<?php if ($error) echo $name; ?>" class="form-control" />
                                <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="name">Last name</label>
                                <input type="text" name="surname" placeholder="Last name" required value="<?php if ($error) echo $surname; ?>" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="name">E-mail</label>
                                <input type="email" name="email" placeholder="E-mail" required value="<?php if ($error) echo $email; ?>" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="name">Phone</label>
                                <input type="text" name="phone" placeholder="Phone" required value="<?php if ($error) echo $phone; ?>" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="password" name="password" placeholder="Password" required class="form-control" />
                                <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="signup" value="Register" class="btn btn-primary" />
                            </div>
                        </fieldset>
                    </form>
                    <span class="text-success"><?php
                        if (isset($successmsg)) {
                            echo $successmsg;
                        }
                        ?></span>
                    <span class="text-danger"><?php
                        if (isset($errormsg)) {
                            echo $errormsg;
                        }
                        ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    Already registered? <a href="login.php">Login</a>
                </div>
            </div>
        </div>
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>