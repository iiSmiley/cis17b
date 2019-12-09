<?php

session_start();
    require ('includes/login_functions.inc.php');
    if($_SESSION['user_level']!=1) {
        redirect_user("access_denied.php");
   }

//To connenct to database
require ('mysqli_connect.php');
include ('includes/admin_sk_header.html');
//The classes that we will be using

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
    
    //Check if there is a question
    if(!empty($_POST['qstn'])) {
        $qstn = test_input($_POST['qstn']);
        //echo "<p> '$qstn' </>";
    }
    else {
        $errors[]= "Please enter an important question description.";
    }
    
    //check if there is a category
    if(!empty($_POST['cat'])) {
        $cat = test_input($_POST['cat']);
    }
    else {
        $errors[]= "Please enter a category.";
    }
    
    //check for answers 1~5 (There should be at least TWO answers
    //ans1
    if(!empty($_POST['ans1'])) {
        $ans1 = test_input($_POST['ans1']);
        $q_ans1 = "INSER INTO enum_ans (ans) VALUES ('$ans1')";
    }
    else {
        $errors[]= "Please enter at least two answer (Put them in Answer 1 and 2.";
    }
    
    //ans2
    if(!empty($_POST['ans2'])) {
        $ans2 = test_input($_POST['ans2']);
        $q_ans2 = "INSER INTO enum_ans (ans) VALUES ('$ans2')";
    }
    else {
        $errors[]= "Please enter an important question description";
    }
    
    //ans3
    if(!empty($_POST['ans3'])) {
        $ans3 = test_input($_POST['ans3']);
        $q_ans3 = "INSER INTO enum_ans (ans) VALUES ('$ans3')";
    }
    
    //ans4
    if(!empty($_POST['ans4'])) {
        $ans4 = test_input($_POST['ans4']);
        $q_ans4 = "INSER INTO enum_ans (ans) VALUES ('$ans4')";
    }
    
    //ans5
    if(!empty($_POST['ans5'])) {
        $ans5 = test_input($_POST['ans5']);
        $q_ans5 = "INSER INTO enum_ans (ans) VALUES ('$ans5')";
    }
    
    //If there are no errors -> Horray! good to go
    if (empty($errors)) {
        
        
        $qstn_id;
        //Submmiting Question
        {
            $q = "INSERT INTO enum_qstn (cat,qstn) VALUES ('$cat','$qstn')";
            $r = @mysqli_query($dbc, $q);
            $qstn_id = @mysqli_insert_id($dbc);
            //mysqli_close($dbc);
            //check if it went to db
            if (!$r) {
                    echo mysqli_error($dbc);
                }
            if($r) {
                echo "<p>The question has been inserted into the data bases.</P>";
                }
                //ERROR!
                else{
                    echo '<p style="font-weight: bold; color: #C00">Your submission could not be processed due to a system error.</p>'; 
                }
        }
          //ans1
            if(!empty($_POST['ans1'])) {
                $ans1 = test_input($_POST['ans1']);
                $q_ans1 = "INSERT INTO enum_ans (answer) VALUES ('$ans1')";
                $r1 = @mysqli_query($dbc, $q_ans1);
                $ans1_id = @mysqli_insert_id($dbc);
                
                //Updating the survey table
                $q2 = "INSERT INTO survey (survey_id, qstn_id, ans_id) VALUES ('$sur_id','$qstn_id','$ans1_id')";
                $r2 = @mysqli_query($dbc, $q2);       
                /*if($r1) {echo "<p>YAY1!</p></br>";}
                if (!$r1) {
                    echo mysqli_error($dbc);
                }
                if($r2) {echo "<p>YAY1!</p></br>";}
                //mysqli_close($dbc);
                if (!$r2) {
                    echo mysqli_error($dbc);
                exit();
                }*/
           }

            //ans2
            if(!empty($_POST['ans2'])) {
                $ans2 = test_input($_POST['ans2']);
                $q_ans2 = "INSERT INTO enum_ans (answer) VALUES ('$ans2')";
                $r = @mysqli_query($dbc, $q_ans2);
                $ans2_id = @mysqli_insert_id($dbc);
                $q3 = "INSERT INTO survey (survey_id, qstn_id, ans_id) VALUES ('$sur_id','$qstn_id','$ans2_id')";
                $r3 = @mysqli_query($dbc, $q3);
                //mysqli_close($dbc);
                //if($r) {echo "<p>YAY2</p></br>";}
                //if($r3) {echo "<p>YAY2!</p></br>";}
                //mysqli_close($dbc);
            }

            //ans3
            if(!empty($_POST['ans3'])) {
                $ans3 = test_input($_POST['ans3']);
                $q_ans3 = "INSERT INTO enum_ans (answer) VALUES ('$ans3')";
                $r = @mysqli_query($dbc, $q_ans3);
                $ans3_id = @mysqli_insert_id($dbc);
                $q4 = "INSERT INTO survey (survey_id, qstn_id, ans_id) VALUES ('$sur_id','$qstn_id','$ans3_id')";
                $r4 = @mysqli_query($dbc, $q4);
                //if($r) {echo "<p>YAY3!</p></br>";}
                //if($r4) {echo "<p>YAY2!</p></br>";}
                //mysqli_close($dbc);
            }

            //ans4
            if(!empty($_POST['ans4'])) {
                $ans4 = test_input($_POST['ans4']);
                $q_ans4 = "INSERT INTO enum_ans (answer) VALUES ('$ans4')";
                $r = @mysqli_query($dbc, $q_ans4);
                $ans4_id = @mysqli_insert_id($dbc);
                $q5 = "INSERT INTO survey (survey_id, qstn_id, ans_id) VALUES ('$sur_id','$qstn_id','$ans4_id')";
                $r5 = @mysqli_query($dbc, $q5);
                //if($r) {echo "<p>YAY4!</p></br>";}
                //if($r5) {echo "<p>YAY4!</p></br>";}
                //mysqli_close($dbc);
            }

            //ans5
            if(!empty($_POST['ans5'])) {
                $ans5 = test_input($_POST['ans5']);
                $q_ans5 = "INSERT INTO enum_ans (answer) VALUES ('$ans5')";
                $r = @mysqli_query($dbc, $q_ans5);
                $ans5_id = @mysqli_insert_id($dbc);
                $q6 = "INSERT INTO survey (survey_id, qstn_id, ans_id) VALUES ('$sur_id','$qstn_id','$ans5_id')";
                $r6 = @mysqli_query($dbc, $q6);
                //if($r) {echo "<p>YAY5!</p></br>";}
                //if($r6) {echo "<p>YAY5!</p></br>";}
                //mysqli_close($dbc);
            }
            


        /*
        
        //$r = @mysqli_query($dbc, $q);
        //Check if it went to DB
        if($r) {
            echo "<p>The Survey has been successfully initiated in the data bases.</P>";
        }
        //ERROR!
        else{
            echo '<p style="font-weight: bold; color: #C00">Your submission could not be processed due to a system error.</p>'; 
        }
        mysqli_close($dbc);*/
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
    

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Add A Question</title>
</head>
<body>
    <form action="question_form.php" method="post" >
        <p><b>Select Target Survey:</b></br> <select name="survey"><option>Select Survey</option>
            <?php 
                // Retrieve all the artists and add to the pull-down menu.
                $q = "SELECT survey_id, survey_title FROM enum_survey ORDER BY survey_title ASC";		
                $r = mysqli_query ($dbc, $q);
                if (mysqli_num_rows($r) > 0) {
		while ($row = mysqli_fetch_array ($r, MYSQLI_NUM)) {
			echo "<option value=\"$row[0]\"";
			// Check for stickyness:
			if (isset($_POST['survey']) && ($_POST['survey'] == $row[0]) ) echo ' selected="selected"';
			echo ">$row[1]</option>\n";
		}
                } else {
                        echo '<option>Please add a new artist first.</option>';
                }
                mysqli_close($dbc); // Close the database connection.
            
                ?></select></br>
        <p><b>Question:</b></br> <input type="text" name="qstn" size="50" maxlength="40" value="<?php if (isset($_POST['qstn'])) echo $_POST['qstn']; ?>"</br></br>
        <p><b>Category:</b></br> <input type="text" name="cat" size="50" maxlength="40" value="<?php if (isset($_POST['cat'])) echo $_POST['cat']; ?>" </br></br>                  
        <p><b>Answer 1:</b></br> <input type="text" name="ans1" size="50" maxlength="40" value="<?php if (isset($_POST['ans1'])) echo $_POST['ans1']; ?>" </br></br>
        <p><b>Answer 2:</b></br> <input type="text" name="ans2" size="50" maxlength="40" value="<?php if (isset($_POST['ans2'])) echo $_POST['ans2']; ?>" </br></br>
        <p><b>Answer 3:</b></br> <input type="text" name="ans3" size="50" maxlength="40" value="<?php if (isset($_POST['ans3'])) echo $_POST['ans3']; ?>" </br></br>
        <p><b>Answer 4:</b></br> <input type="text" name="ans4" size="50" maxlength="40" value="<?php if (isset($_POST['ans4'])) echo $_POST['ans4']; ?>" </br></br> 
        <p><b>Answer 5:</b></br> <input type="text" name="ans5" size="50" maxlength="40" value="<?php if (isset($_POST['ans5'])) echo $_POST['ans5']; ?>" </br></br>         
            <div align="left"><input type="submit" name="submit" value="Submit" /></div>
    </form>
</body>
</html>
<?php 
include ('includes/sk_footer.html');
?>