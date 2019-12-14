<?php

session_start();
    require ('includes/login_functions.inc.php');
    if($_SESSION['user_level']!=1) {
        redirect_user("access_denied.php");
    }

//To connenct to database
require ('Survey.php');
include ('includes/admin_sk_header.html');
//The classes that we will be using
//include ('Survey.php');
//include ('Question.php');

//Handling the form on the page:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $desc = '';
    //validating incoming data...
    $errors = array();
    
    //Check if there is any data
    if(!empty($_POST['title'])) {
        $title = test_input($_POST['title']);
    }
    else {
        $errors[]= "Please enter a catchy title!";
    }
    
    //Check if the is any description
    if(!empty($_POST['desc'])) {
        $desc = test_input($_POST['desc']);
    }
    else {
        $errors[]= "Please enter a desciptive description";
    }
    
    //If there are no errors -> Horray! good to go
    if (empty($errors)) {
        $survey = new Survey($title,$desc);
        $dbc = $survey->getDB();
        $survey->create_survey($dbc);
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
	<title>Create A Survey</title>
</head>
<body>
    <form action="survey_form.php" method="post" >
        <p><b>Title:</b></br> <input type="text" name="title" size="50" maxlength="40" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>"</br></br>
            <p><b>Description:</b></br> <input type="text" name="desc" size="50" maxlength="40" value="<?php if (isset($_POST['desc'])) echo $_POST['desc']; ?>" </br></br>                  
        <div align="left"><input type="submit" name="submit" value="Submit" /></div>
    </form>
</body>
</html>

<?php
include ('includes/sk_footer.html');
?>