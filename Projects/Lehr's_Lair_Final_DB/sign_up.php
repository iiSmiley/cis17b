<?php # Script 9.5 - register.php #2
// This script performs an INSERT query to add a record to the users table.


$time = $_COOKIE['time'];
//echo $time;
$page_title = 'Sign Up';
include ('includes/sk_header.html');
$f_name = $l_name = $email = $pswd1 = $pswd2 = "";
// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $f_name = test_input($_POST["first_name"]);
    $l_name = test_input($_POST["last_name"]);
    $email = test_input($_POST["email"]);
    $pswd1 = test_input($_POST["pass1"]);
    $pswd2 = test_input($_POST["pass2"]);
    
	require ('mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for a first name:
	if (empty($f_name)) {
            $errors[] = 'You forgot to enter your first name.';
	}
        elseif (!preg_match("/^[a-zA-Z ]*$/",$f_name)){
            $errors[] = "Please enter a correct first name";    
        }
        else {
		$fn = mysqli_real_escape_string($dbc, $f_name);
	}
	
	// Check for a last name:
        //Empty?
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} 
        //Correct format?
        elseif (!preg_match("/^[a-zA-Z ]*$/",$l_name)) {
            $errors[] = "Please enter a correct first name";  
        }
        else {
		$ln = mysqli_real_escape_string($dbc, $l_name);
	}
	
	// Check for an email address:
        //Empty?
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
                
	}
        //Correct format?
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a correct email address.";
            echo "email: ".!filter_var($email, FILTER_VALIDATE_EMAIL);
            echo "Empty? ". empty($errors);
            
        }
        //Good to go!
        else {
		$e = mysqli_real_escape_string($dbc, $email);
	}
	
	// Check for a password and match against the confirmed password:
        //Empty?
	if (!empty($_POST['pass1'])) {
            //Regular expression
            $re = '/((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[-_@#$%]).{6,20})/';
            //Empty?    
            if ($_POST['pass1'] != $_POST['pass2']) {
		$errors[] = 'Your password did not match the confirmed password.';
            }
            //Matches format?
            else if (!preg_match($re, $pswd1)) {
                $errors[] = 'Your passowrd must:';
                $errors[] = 'be 6~20 characters long';
                $errors[] = 'includes 1 lowercase letter:';
                $errors[] = 'includes 1 upercase letter:';
                $errors[] = 'includes one special character -_!@#$%';
                //echo "test pswd".!preg_match($re, $pswd1);
            }
            else {
			$p = mysqli_real_escape_string($dbc, $pswd1);
            }    
	} 
        else {
		$errors[] = 'You forgot to enter your password.';
	}
	
	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...
		// Make the query:
                //user_level = 2 ==> Normal users
                $ul=2;
		$q = "INSERT INTO entity_user (first_name, last_name, email, pass, registration_date, user_level) VALUES ('$fn', '$ln', '$e', SHA1('$p'), NOW(), '$ul')";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '<h1>Thank you!</h1>
		<p>You are now steps away from having a breathtaking experience.</p><p><br /></p>';	
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
						
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		include ('includes/sk_footer.html'); 
		exit();
		
	} else { // Report the errors.
	
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.
	
	mysqli_close($dbc); // Close the database connection.
        
        }
        //cleans inpput data -> Better security
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

// End of the main Submit conditional.
?>
<h1>Register</h1>
<form method="post" action="sign_up.php">
	<p>First Name: <input type="text" name="first_name" size="15" maxlength="20" value="<?php echo $f_name; ?>" /></p>
	<p>Last Name: <input type="text" name="last_name" size="15" maxlength="40" value="<?php echo $l_name; ?>" /></p>
	<p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="<?php echo $email; ?>"  /> </p>
	<p>Password: <input type="password" name="pass1" size="10" maxlength="20" value="<?php echo $pswd1 ?>"  /></p>
	<p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20" value="<?php echo $pswd2; ?>"  /></p>
	<p><input type="submit" name="submit" value="Register" /></p>
</form>
<?php include ('includes/sk_footer.html'); ?>