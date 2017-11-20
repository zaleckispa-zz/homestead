<?php
session_start();


include_once 'dbconnect.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['registruoti'])) {
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $type = mysqli_real_escape_string($con, $_POST['type']);


    if (!$error) { 
        if (mysqli_query($con, "INSERT INTO bookings(date, name, email, phone, type)
            VALUES('" . $date . "', '" . $name . "',
             '" . $email . "', '" . $phone . "', '" . $type . "')")) {
            $successmsg = "Reservation added successfully! <a href='reserv.php'>Click to return</a>";
        } else {
            $errormsg = "Error...  Give it another try!";
        }
    }
}
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
                        <?php } else { header("Location: user.php");?>
                        <?php } ?>
            </ul>
        </div>
    </div>
</nav>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 well">
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="abonimentaiforma">
                        <fieldset>
                            <legend>New reservation</legend>

                            <div class="form-group">
                                <label for="name">Date</label>
                                <input type="date" name="date" required value="<?php if ($error) echo $date; ?>" class="form-control" />                                
                            </div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" placeholder="Name" required value="<?php if ($error) echo $name; ?>" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="name">E-mail</label>
                                <input type="text" name="email" placeholder="E-mail" required value="<?php if ($error) echo $start; ?>" class="form-control" />                                
                            </div>

                            <div class="form-group">
                                <label for="name">Phone</label>
                                <input type="number" name="phone" placeholder="Phone" value="<?php if ($error) echo $phone; ?>" class="form-control" />
                            </div>

                            <div class="form-group">
                            <label for="type">Type</label>
                             <select id="type" name="type" class="form-control">
                                <option value="Visa sodyba">Two floor homestead</option>
                                <option value="Pirmas aukštas">Single floor homestead</option>
                                <option value="Antras aukštas">Small homestead</option>
                             </select>
                            </div>

            
                            <div class="form-group">
                                <input type="submit" name="registruoti" value="Add reservation" class="btn btn-primary" />
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