<?php
session_start();
include_once 'dbconnect.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sodyba prie ežero</title>
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

        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>