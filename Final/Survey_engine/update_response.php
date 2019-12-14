<?php

session_start();
//  if($_SESSION['user_level']!=1) {
//        redirect_user("access_denied.php");
//  }

//To connenct to database
require ('Survey.php');
include ('includes/login_functions.inc.php');

//Handling the form on the page:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    //Catch any errors
    $errors = array();
    
    //Obtain Reposne iterartion
    $iter = $_SESSION['iter'];
    $var_str = "response";
    $survey = new Survey("","");
        $dbc = $survey->getDB();
    for($i=1; $i<$iter+1; $i++ ) {
        $ans_id=0;
        $temp_str = $var_str.$i;
        if(isset($_POST[$temp_str])) {
            $ans_id = test_input($_POST[$temp_str]);
        }
        else {
            $errors[]= "Please choose a survey or create one if no survies exist!";
        }
        
        if (empty($errors)) {
            $survey->update_results($ans_id, $dbc);
        }
    }
        mysqli_close($dbc);
        //Exit the page
        redirect_user('thank_you.php');
        
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
        
        redirect_user('thank_you.php');
?>


