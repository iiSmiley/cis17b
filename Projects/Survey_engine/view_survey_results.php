<?php

session_start();
    require ('includes/login_functions.inc.php');
    if($_SESSION['user_level']!=1) {
        redirect_user("access_denied.php");
    }

//To connenct to database
require ('mysqli_connect.php');
include ('includes/admin_sk_header.html');

//Handling the form on the page:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
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
        //Get the damn query
        $q = "SELECT `survey`.`record_id`, `enum_survey`.`survey_title`, `enum_qstn`.`qstn`, `enum_ans`.`ans_id`, `enum_ans`.`answer`, `enum_ans`.`response` "
                . "FROM `survey_engine`.`survey` AS `survey`, `survey_engine`.`enum_qstn` AS `enum_qstn`, `survey_engine`.`enum_survey` AS `enum_survey`, `survey_engine`.`enum_ans` AS `enum_ans` "
                . "WHERE `survey`.`qstn_id` = `enum_qstn`.`qstn_id` AND `survey`.`survey_id` = `enum_survey`.`survey_id` AND `survey`.`ans_id` = `enum_ans`.`ans_id`"
                . "AND enum_survey.survey_id =$sur_id";
        $r = mysqli_query($dbc, $q);
        if (!$r) {
            //If there is an error, display the error string (Life Line!)
            echo mysqli_error($dbc);
            exit();
        }
        //If there is a query of at least on record 
        if(mysqli_num_rows($r)>0) {
            
            $temp_title = $temp_qstn ="";   //To avoid displaying the title ans the same question multiple times
            $temp_first_qstn=true;          //To properly set the fields and the legends
            $temp_iter=0;                   //To be used to update the number of responses
            while($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
                //echo "<p>$row[0] $row[1] $row[2] $row[3] $row[4]</p>";
                if($temp_title != $row[1]) {
                    $temp_title = $row[1];
                    echo "<h1>$temp_title</h1></br>";
                }
                if($temp_qstn != $row[2]) {
                    $temp_qstn = $row[2];
                    if($temp_first_qstn) {
                        echo "<fieldset>";
                        echo "<legend>$temp_qstn</legend>";
                        $temp_first_qstn = false;
                        $temp_iter++;
                    }
                    else {
                        //Close previus field
                        echo "</fieldset>";
                        //Open new field
                        echo "<fieldset>";
                        //Display Qstn
                        echo "<legend>$temp_qstn</legend>";
                    }    
                }
                //Display Radio buttons for different answers with their unique values
                echo "$row[4] ($row[5] Entries)</br>";
                $_SESSION["iter"] = $temp_iter;
            }
            //Close the last form
            echo "</fieldset> </br>";
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
    
include ('includes/sk_footer.html');
?>
