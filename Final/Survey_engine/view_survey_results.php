<?php

session_start();
    require ('includes/login_functions.inc.php');
    if($_SESSION['user_level']!=1) {
        redirect_user("access_denied.php");
    }

//To connenct to database
require ('Survey.php');
include ('includes/admin_sk_header.html');

//Handling the form on the page:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $sur_id = "";
    //validating incoming data...
    $errors = array();
    
    //Check if there is any data
    if(isset($_POST['survey']) && filter_var($_POST['survey'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
        $sur_id = test_input($_POST['survey']);
        //echo "<p> '$sur_id' </>";
    }
    else {
        $errors[]= "Please choose a survey or create one if no survies exist!";
    }
    
    //If there are no errors -> Horray! good to go
    if (empty($errors)) {
        
        $survey = new Survey("","");
        $dbc = $survey->getDB();
        $survey->show_results($sur_id, $dbc);
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
    
include ('includes/sk_footer.html');
?>
