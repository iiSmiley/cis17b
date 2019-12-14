<?php # Script 9.7 - password.php
// This page lets a user change their password.

//Starting the session so we can carry user credintials (user_id, first_name, user_level)
session_start();

$page_title = 'Update Your Email';
require ('../includes/sk_header_1.html');
require ('../user/User.php');
//require ('mysqli_connect.php');
// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $p = test_input($_POST["pass"]);
    $ce = test_input($_POST["c_email"]);
    $ne = test_input($_POST["n_email"]);

    $user_id = $_SESSION['user_id'];
	$errors = array(); // Initialize an error array.
	
	// Check for the current password:
	if (empty($_POST['pass'])) {
		$errors[] = 'You forgot to enter your current password.';
	}
        else {
		$p = test_input($_POST['pass']);
	}

	// Check for current email
	if (empty($_POST['c_email'])) {
                $errors[] = 'You forgot to enter your current email name.';
        }
                //Correct format?
        else if(!filter_var($ce, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Please enter a correct email address.";
                echo "email: ".!filter_var($email, FILTER_VALIDATE_EMAIL);
                echo "Empty? ". empty($errors); 
        }

	
        // Check for new email
	if (empty($_POST['n_email'])) {
                $errors[] = 'You forgot to enter your current email name.';
        }
                //Correct format?
        else if(!filter_var($ne, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Please enter a correct email address.";
                echo "email: ".!filter_var($email, FILTER_VALIDATE_EMAIL);
                echo "Empty? ". empty($errors); 
        }
        
        //Check if the entered emails are the same
        if($ce == $ne) {
            $errors[] = 'No changes are occuring to your email! Please do not try to fool us!.';
        }
        
	if (empty($errors)) { // If everything's OK.

                //create a user instance to use the functions of the user class
                $user = new user ();
                $dbc = $user->DB();
                if($user->check_pass($user_id, $p, $dbc)) {
                    if($user->check_email($user_id, $ce, $dbc)) {
			//Make the update
			$user->update_email($user_id, $ne, $dbc);

			include ('../includes/tcc_footer.html'); 
			exit();
                    }
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
<form action="edit_email.php" method="post">
	<p>Current Password: <input type="password" name="pass" size="10" maxlength="20" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>"  /></p>
	<p>Current email   : <input type="text" name="c_email" size="40" maxlength="40" value="<?php if (isset($_POST['c_email'])) echo $_POST['c_email']; ?>"  /></p>
	<p>New email       : <input type="text" name="n_email" size="40" maxlength="40" value="<?php if (isset($_POST['e_email'])) echo $_POST['n_email']; ?>"  /></p>
	<p><input type="submit" name="submit" value="Update Email" /></p>
</form>
<?php include ('../includes/tcc_footer.html'); ?>