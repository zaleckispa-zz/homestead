<?php
//connect to mysql database
$con = mysqli_connect("localhost", "root", "", "sodyba") or die("Error " . mysqli_error($con));
mysqli_set_charset ( $con , 'utf8' )
?>