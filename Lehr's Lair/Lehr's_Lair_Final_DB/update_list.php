<?php
include ('includes/login_functions.inc.php');
session_start();
    if(!isset($_SESSION['user_id']) || ($_COOKIE['time']==0)) {
        redirect_user("uni_login.php");
    }
//echo $_COOKIE['time'];
//To connenct to database
require ('mysqli_connect.php');
//Handling the form on the page:
if (isset($_SESSION['user_id']) && isset($_COOKIE['time'])) {
    
    //validating incoming data...
    $errors = array();
    
    //Obtain Reposne iterartion
    $user_id = $time =0;
        if(isset($_SESSION['user_id'])) {
            $user_id = test_input($_SESSION['user_id']);
            echo $user_id;
        }
        else {
            $errors[]= "Please login to save your score!";
        }
        if($_COOKIE['time'] != 0) {
            $time = test_input($_COOKIE['time']);
            echo $time;
        }
        else {
            $errors[]= "It appears that you do not have any new scores!";
        }
        
        if (empty($errors)) {
            //Obtain current value of responses
            $q = "INSERT INTO scores (user_id, time) VALUES ('$user_id','$time')";
            $r = mysqli_query($dbc, $q);
            //Show me errors, if any.
            if(!$r) {
                echo mysqli_error($dbc);
            }
            setcookie('time',"",-3600);
        }
            
        
    
        mysqli_close($dbc);
        //setc
        //setcookie('time',0,-3600);
        //Exit the page
        //redirect_user('view.php');
        
}
// Check for any errors and print them:
if ( !empty($errors) && is_array($errors) ) {
	echo '<h1>Error!</h1>
	<p style="font-weight: bold; color: #C00">The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
}
//Better than using trim() alone
function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        redirect_user('view.php');
?>


