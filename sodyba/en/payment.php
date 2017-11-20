<?php
session_start();
include_once 'dbconnect.php';

$user = $con->query("SELECT * FROM users WHERE email='{$_SESSION['email']}'");
$user = $user->fetch_assoc();
                            $selectname = 'SELECT name from users';
                            $result = @mysqli_query($con, $selectname);
                            $row = mysqli_fetch_assoc($result);
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
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="navbar1">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (isset($_SESSION['email'])) { ?>
                        <li><a href="user_reserv.php">My reservations</a></li>
                            <li><a href="start2.php">About</a></li>
                            <li><a href="book.php">Reservation</a></li>
                            <li><a href="contact2.php">Contact</a></li>                            
                            <li><p class="navbar-text">Welcome, <?php echo $_SESSION['email']; ?></p></li>
                            <li><a href="logout.php">Logout</a></li>
                        <?php } else { header("Location: login.php");?>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>

        <div style="margin-left: 35%; margin-top: 200px; font-size: 30px; font-weight: bold;">

                <?php if (isset($_SESSION['email'])) { ?>
                            <p class="navbar-text"><?php echo $_SESSION['email']; ?>, your reservation is successful!</p>                      
                        <?php } else { ?>
                        <?php } ?>
        </div>
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>