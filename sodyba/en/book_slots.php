<?php 

session_start();
include('dbconnect.php'); 

if(isset($_POST['booking_date'])) $booking_date = mysqli_real_escape_string($con, $_POST['booking_date']);
if(isset($_POST['cost_per_slot'])) $cost_per_slot = mysqli_real_escape_string($con, $_POST['cost_per_slot']);
if(isset($_POST['type'])) $type = mysqli_real_escape_string($con, $_POST['type']);

if(isset($_SESSION['email'])){

	$user = $con->query("SELECT * FROM users WHERE email='{$_SESSION['email']}'");
	$user = $user->fetch_assoc();

	$email = $user['email'];
	$name = $user['name'];
	$phone = $user['phone'];

	if(!$con->query("INSERT INTO bookings (date, start, name, email, phone, type)
	 VALUES ('{$booking_date}', '{$booking_date}', '{$name}', '{$email}', '{$phone}', '{$type}')")){
		print_r($con->error);
	} 

	header("Location: /sodyba/en/payment.php");
} else if(isset($_SESSION['access_token'])){

	$email = $user['email'];

	if(!$con->query("INSERT INTO bookings (date, start, email, type)
	 VALUES ('{$booking_date}', '{$booking_date}', '{$email}', '{$type}')")){
		print_r($con->error);
	} 

	header("Location: /sodyba/en/payment.php");
} 
	?>