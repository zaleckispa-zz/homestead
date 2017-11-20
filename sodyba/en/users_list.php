<?php
session_start();
include_once 'dbconnect.php';
if (isset($_POST['delete'])) {

    $id = mysqli_real_escape_string($con, $_POST['id']);

    mysqli_query($con, "DELETE FROM users WHERE id='" . $id . "'");
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
                        <?php } else { header("Location: user.php");?>
                        <?php } ?>
            </ul>
        </div>
    </div>
</nav>


<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <p class="lead section-lead">Registered users</p>
                <div class="row">

                    <?php
                    $query = 'SELECT * from users';
                    $result = @mysqli_query($con, $query);

                    echo "<table class='table table-bordered table-striped table-hover'>
                                <thead>
                                    <tr>
                                        <td colspan=11><a href='users_new.php'>Add new user</a><br>

                                    </tr>
                                </thead>";

                    echo "<tbody>
                                    <tr>
                                        <th class='text-center'>ID</td>
                                        <th class='text-center'>Name</td>
                                        <th class='text-center'>Last name</td>
                                        <th class='text-center'>E-mail</td>
                                        <th class='text-center'>Phone</td>
                                        <th class='text-center'>&nbsp;</td>
                                    </tr>";
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td class='text-center'>" . $row['id'] . "</td>";
                        echo "<td class='text-center'>" . $row['name'] . "</td>";
                        echo "<td class='text-center'>" . $row['surname'] . "</td>";
                        echo "<td class='text-center'>" . $row['email'] . "</td>";
                        echo "<td class='text-center'>" . $row['phone'] . "</td>";
                        echo "<td class='text-center'><a href=\"users_edit.php?id=" . $row['id'] . " \" name='edit' value='Redaguoti'>Edit</a>&nbsp;&nbsp;&nbsp;";
                         echo "<a href=\"users_del.php?id=" . $row['id'] . " \" name='delete' value='Šalinti'>Delete</a>" . "</td>
                                </tr>";
                    }
                    echo "</tbody>
                            </table> ";
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>