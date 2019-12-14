<?php
/*
 * Author : Omar Alkendi
 * Purpose: The user class is used to creat and edit users. 
 */
class User {
    private $f_name;
    private $l_name;
    private $email;
    private $pass;    
    
    public function creat_user($fn, $ln, $e, $p, $dbc) {
        //require ('mysqli_connect.php');
        //user_level = 2 ==> Normal users
        $ul=2;
	$q = "INSERT INTO entity_user (first_name, last_name, email, pass, registration_date, user_level) VALUES ('$fn', '$ln', '$e', SHA1('$p'), NOW(), '$ul')";		
	$r = @mysqli_query ($dbc, $q); // Run the query.
	if ($r) { // If it ran OK.
		
            // Print a message:
            echo '<h1>Thank you!</h1>
            <p>You are now steps away from having a breathtaking experience.</p><p><br /></p>';	
		
	}
        else { 
            // If it did not run OK.
            // Public message:
            echo '<h1>System Error</h1>
            <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
            // Debugging message:
            echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
						
	} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection.
        return $r;
    }
    public function check_pass ($user_id, $pass, $dbc) {
        $q = "SELECT user_id FROM entity_user WHERE (user_id='$user_id' AND pass=SHA1('$pass') )";
        $r = @mysqli_query($dbc, $q);
        
        //mysqli_close($dbc); // Close the database connection.
        //Fetch an array from DB
        $row = mysqli_fetch_array($r, MYSQLI_NUM);
        if($row){
            foreach($row as $val) {
                //If the value of any col in row is == user_id --> we are good
                if($val == $user_id) {
                    return true;
                } 
            }
        }
        else return false;
    }
    public function update_pass($user_id, $new_pass, $dbc) {
        // Make the UPDATE query:
	$q = "UPDATE entity_user SET pass=SHA1('$new_pass') WHERE user_id=$user_id";		
	$r = @mysqli_query($dbc, $q);
			
	if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

            // Print a message.
            echo '<h1>Thank you!</h1>
                <p>Your password has been updated.</p><p><br /></p>';	

            } 
            else { // If it did not run OK.
        	// Public message:
                echo '<h1>System Error</h1>
		<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>'; 
	
		// Debugging message:
		echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
		}
                
		mysqli_close($dbc); // Close the database connection.
    }
    
    public function update_name($user_id, $new_f_name, $new_l_name, $dbc) {
        // Make the UPDATE query:
	$q = "UPDATE entity_user SET first_name='$new_f_name', last_name='$new_l_name' WHERE user_id=$user_id";		
	$r = @mysqli_query($dbc, $q);
			
	if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

            // Print a message.
            echo '<h1>Thank you!</h1>
                <p>Your name has been updated.</p><p><br /></p>';	

            } 
            else { // If it did not run OK.
        	// Public message:
                echo '<h1>System Error</h1>
		<p class="error">Your name could not be changed due to a system error. We apologize for any inconvenience.</p>'; 
	
		// Debugging message:
		echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
		}
                
		mysqli_close($dbc); // Close the database connection.
    }
    
    public function check_email($user_id, $new_email, $dbc) {
        $q = "SELECT user_id FROM entity_user WHERE (user_id='$user_id' AND email='$new_email')";
        $r = @mysqli_query($dbc, $q);
        
        //mysqli_close($dbc); // Close the database connection.
        //Fetch an array from DB
        $row = mysqli_fetch_array($r, MYSQLI_NUM);
        if($row){
            foreach($row as $val) {
                //If the value of any col in row is == user_id --> we are good
                if($val == $user_id) {
                    return true;
                } 
            }
        }
        else return false;
    }
    public function update_email($user_id, $new_email, $dbc) {
        // Make the UPDATE query:
	$q = "UPDATE entity_user SET email='$new_email' WHERE user_id='$user_id'";		
	$r = @mysqli_query($dbc, $q);
			
	if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

            // Print a message.
            echo '<h1>Thank you!</h1>
                <p>Your email has been updated.</p><p><br /></p>';	

            } 
            else { // If it did not run OK.
        	// Public message:
                echo '<h1>System Error</h1>
		<p class="error">Your email could not be changed due to a system error. We apologize for any inconvenience.</p>'; 
	
		// Debugging message:
		echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
		}
                
		mysqli_close($dbc); // Close the database connection.
    }
    public function DB() {
        require ('../mysqli_connect.php');
        return $dbc;
    }
}
