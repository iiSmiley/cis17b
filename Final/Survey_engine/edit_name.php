<?php # Script 9.7 - password.php
// This page lets a user change their password.

//Starting the session so we can carry user credintials (user_id, first_name, user_level)
session_start();

$page_title = 'Update Your Name';
require ('includes/sk_header_1.html');
require ('User.php');
//require ('mysqli_connect.php');
// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$user_id = $_SESSION['user_id'];
	$errors = array(); // Initialize an error array.
	
	// Check for the current password:
	if (empty($_POST['pass'])) {
		$errors[] = 'You forgot to enter your current password.';
	}
        else {
		$p = test_input($_POST['pass']);
	}

	// Check for new first name
	if (empty($_POST['f_name'])) {
                $errors[] = 'You forgot to enter your new first name.';
        }
        else {
                $nfm =test_input($_POST['f_name']);
	}
	
        // Check for new last name 
	if (empty($_POST['l_name'])) {
                $errors[] = 'You forgot to enter your new last name.';
		}
        else {
		$nlm =test_input($_POST['l_name']);
	}
        
        //Check if no name changes
        if($nfm == $_SESSION['first_name'] && $nlm == $_SESSION['last_name']) {
            $errors[] = 'No changes are occuring to your name! Please do not try to fool us!.';
        }
        
	if (empty($errors)) { // If everything's OK.

                //create a user instance to use the functions of the user class
                $user = new user ();
                $dbc = $user->DB();
                if($user->check_pass($user_id, $p, $dbc)) {
			//Make the update
			$user->update_name($user_id, $nfm, $nlm, $dbc);

			// Update in seession, include the footer and quit the script (to not show the form).
                        $_SESSION['first_name'] = $nfm;
			include ('includes/sk_footer.html'); 
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
<h1>Update Your Name</h1>
<form action="edit_name.php" method="post">
	<p>Current Password: <input type="password" name="pass" size="10" maxlength="20" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>"  /></p>
	<p>New First Name: <input type="text" name="f_name" size="10" maxlength="20" value="<?php if (isset($_POST['f_name'])) echo $_POST['f_name']; ?>"  /></p>
	<p>New Last Name : <input type="text" name="l_name" size="10" maxlength="20" value="<?php if (isset($_POST['l_name'])) echo $_POST['l_name']; ?>"  /></p>
	<p><input type="submit" name="submit" value="Update Name" /></p>
</form>
<?php include ('includes/sk_footer.html'); ?>