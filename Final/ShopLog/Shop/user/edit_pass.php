<?php # Script 9.7 - password.php
// This page lets a user change their password.

//Starting the session so we can carry user credintials (user_id, first_name, user_level)
session_start();

$page_title = 'Change Your Password';
require ('../includes/sk_header_1.html');
require ('../user/User.php');
//require ('mysqli_connect.php');
// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$user_id = $_SESSION['user_id'];
        
        //Regular expression
        $re = '/((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[-_@#$%]).{6,20})/'; //RegEx for password
        
	$errors = array(); // Initialize an error array.
	
	// Check for the current password:
	if (empty($_POST['pass'])) {
		$errors[] = 'You forgot to enter your current password.';
	}
        else {
//                require ('mysqli_connect.php');
		$p = test_input($_POST['pass']);
	}

	// Check for a new password and match 
	// against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your new password did not match the confirmed password.';
		}
                else if (!preg_match($re, test_input($_POST['pass1']))) {
                    //Match Format?
                $errors[] = 'Your passowrd must:';
                $errors[] = 'be 6~20 characters long';
                $errors[] = 'includes 1 lowercase letter:';
                $errors[] = 'includes 1 upercase letter:';
                $errors[] = 'includes one special character -_!@#$%';
                //echo "test pswd".!preg_match($re, $pswd1);
                }
                else {
			$np =test_input($_POST['pass1']);
		}
	}
        else {
		$errors[] = 'You forgot to enter your new password.';
	}
	
	if (empty($errors)) { // If everything's OK.

                //create a user instance to use the functions of the user class
                $user = new user ();
                $dbc = $user->DB();
                if($user->check_pass($user_id, $p, $dbc)) {
			//Make the update
			$user->update_pass($user_id, $np, $dbc);

			// Include the footer and quit the script (to not show the form).
			include ('../includes/tcc_footer.html'); 
			exit();
				
		} 
                else { // Invalid password combination.
			echo '<h1>Error!</h1>
			<p class="error">The current password does not match that on records.</p>';
		}
		
	} 
        else { // Report the errors.

		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
	
	} // End of if (empty($errors)) IF.
		
} // End of the main Submit conditional.

//cleans inpput data -> Better security
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
?>
<h1>Change Your Password</h1>
<form action="edit_pass.php" method="post">
	<p>Current Password: <input type="password" name="pass" size="10" maxlength="20" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>"  /></p>
	<p>New Password: <input type="password" name="pass1" size="10" maxlength="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"  /></p>
	<p>Confirm New Password: <input type="password" name="pass2" size="10" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"  /></p>
	<p><input type="submit" name="submit" value="Change Password" /></p>
</form>
<?php include ('../includes/tcc_footer.html'); ?>