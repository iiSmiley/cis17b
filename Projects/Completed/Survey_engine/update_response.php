<?php

session_start();
//  if($_SESSION['user_level']!=1) {
//        redirect_user("access_denied.php");
//  }

//To connenct to database
require ('mysqli_connect.php');
include ('includes/login_functions.inc.php');

//Handling the form on the page:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    //validating incoming data...
    $errors = array();
    
    //Obtain Reposne iterartion
    $iter = $_SESSION['iter'];
    $var_str = "response";
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
            //Obtain current value of responses
            $q = "SELECT response FROM enum_ans WHERE ans_id=$ans_id";
            $r = mysqli_query($dbc, $q);
            if (mysqli_num_rows($r) > 0) {
                while($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
                    //Update current value of response by adding 1 to the chosen answer.
                    $update= $row[0]+1;
                    $q2 = "UPDATE enum_ans SET response='$update' WHERE ans_id=$ans_id";
                    $r2 = mysqli_query($dbc, $q2);
                }
            }
            //Show me errors, if any.
            if(!$r) {
                echo mysqli_error($dbc);
            }
            
        }
    }
        mysqli_close($dbc);
        
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
        
        echo "<a href='thank_you.php'>Thank You</a>"
?>


