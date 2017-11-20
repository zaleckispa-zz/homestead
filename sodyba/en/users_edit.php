<?php
session_start();


include_once 'dbconnect.php';

//set validation error flag as false
$error = false;

//check if form is submitted

if (isset($_POST['registruoti_klienta'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $surname = mysqli_real_escape_string($con, $_POST['surname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if (!$error) {
        if (mysqli_query($con, "UPDATE users SET name='" . $name . "', surname='" . $surname . "', email='" . $email . "', password='" . $password . "', phone='".$phone."' WHERE id='$id'")) {
            $successmsg = "Sėkmingai paredagavote klientą! <a href='users_list.php'>Paspauskite, kad grįžtumėte į klientų sąrašo langą.</a>";
        } else {
            $errormsg = "Įvyko klaida...  Bandykite dar kartą!";
        }
    }
}

$show = $con->query("SELECT * FROM users");


if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "SELECT * FROM users WHERE id='" . $id . "'";

    $r = $con->query($query);
    $r = $r->fetch_assoc();
}
?>

<!DOCTYPE html>
<head>
    <title>Homestead</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right">
                        <?php if (isset($_SESSION['email']) && $_SESSION['type']=='Admin') { ?>
                            <li><a href="reserv.php">Reservations</a></li>  
                            <li><a href="users_list.php">Users</a></li>                           
                            <li><p class="navbar-text">Welcome, <?php echo $_SESSION['email']; ?></p></li>
                            <li><a href="alogout.php">Logout</a></li>
                        <?php } else { header("Location: login.php");?>
                        <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="inventoriausforma">
                <fieldset>
                    <legend>Edit</legend>

                    <input type="hidden" name="id" value="<?php echo @$r['id']; ?>"/>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" placeholder="Name" value="<?php echo @$r['name']; ?>" class="form-control" />

                    </div>

                    <div class="form-group">
                        <label for="name">Last name</label>
                        <input type="text" name="surname" placeholder="Last name" value="<?php echo @$r['surname']; ?>" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="name">Phone</label>
                        <input type="text" name="phone" placeholder="Phone" value="<?php echo @$r['phone']; ?>" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="name">E-mail</label>
                        <input type="text" name="email" placeholder="E-mail" value="<?php echo @$r['email']; ?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" name="password" placeholder="Password" value="<?php echo @$r['password']; ?>" class="form-control" />
                    </div>

                    <div class="form-group">
                        <input type="submit" name="registruoti_klienta" value="Apply changes" class="btn btn-primary" />
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

</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>