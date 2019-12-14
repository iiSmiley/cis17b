<?php
//Loading necessary files
require ('includes/login_functions.inc.php');
require ('functions.php');

session_start();
    if(!isset($_SESSION['user_id'])) {
        redirect_user("uni_login.php");
    }
    
//Handling the form on the page:
if (isset($_SESSION['user_id']) && isset($_COOKIE['time'])) {
    
    //validating incoming data...
    $errors = array();
    
    //Obtain Reposne iterartion
    $user_id = $time = "";
        if(isset($_SESSION['user_id'])) {
            $user_id = test_input($_SESSION['user_id']);
            //echo $user_id;
        }
        else {
            $errors[]= "Please login to save your score!";
        }
        if(isset($_COOKIE['time']) && $_COOKIE['time'] != "") {
            $time = test_input($_COOKIE['time']);
            //echo $time;
            setcookie("time", "", time() -3600);
        }
        else {
            $errors[]= "It appears that you do not have any new scores!";
        }
        
        if (empty($errors)) {
         update_scores($user_id, $time);
        }
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


