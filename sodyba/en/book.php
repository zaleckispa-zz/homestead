<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include('dbconnect.php'); 
include('classes/class_calendar.php');

$calendar = new booking_diary($con);

if(isset($_GET['month'])) $month = $_GET['month']; else $month = date("m");
if(isset($_GET['year'])) $year = $_GET['year']; else $year = date("Y");
if(isset($_GET['day'])) $day = $_GET['day']; else $day = 0;

// Unix Timestamp of the date a user has clicked on
$selected_date = mktime(0, 0, 0, $month, 01, $year); 

// Unix Timestamp of the previous month which is used to give the back arrow the correct month and year 
$back = strtotime("-1 month", $selected_date); 

// Unix Timestamp of the next month which is used to give the forward arrow the correct month and year 
$forward = strtotime("+1 month", $selected_date);

?>
<!DOCTYPE html "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>Homestead</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" >
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
        <link href="style.css" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script type="text/javascript">

        $(document).ready(function(){

            $(".fields").click(function(){
            
                dataval = $(this).data('date');
                var price = $(this).data('price');
                var type = $(this).data('type');    
            
                // Show the Selected Slots box if someone selects a slot
                if($("#outer_basket").css("display") == 'none') { 
                    $("#outer_basket").css("display", "block");
                }

                // Update basket total box
                $("#total").html(price);   
                $("#selected_slots").html(type);
                $("#cost_per_slot").val(price);
                $("#type").val(type);

                
            });
            
            $(".classname").click(function(){
            
                msg = '';
            

                if($("#name").val() == '')
                msg += 'Enter your name\r\n';

                if($("#email").val() == '')
                msg += 'Enter your e-mail\r\n';

                if($("#phone").val() == '')
                msg += 'Enter your phone\r\n';  

                if(msg != '') {
                    alert(msg);
                    return false;
                }

            });

            // Firefox caches the checkbox state.  This resets all checkboxes on each page load 
            $('input:checkbox').removeAttr('checked');
            
        });
        </script>
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
                        <?php } else { ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>

        <div>
            <?php            
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $calendar->after_post($month, $day, $year);  
            }   

            // Call calendar function
            $calendar->make_calendar($selected_date, $back, $forward, $day, $month, $year);
            ?>
        </div>
        
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>