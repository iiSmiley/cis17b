<?php
    /*session_start();
    require ('includes/login_functions.inc.php');
    if($_SESSION['user_level']!=1) {
    redirect_user("access_denied.php");
    } */
?>
<?php # Script - add_artist.php
// This page allows the administrator to add a department.
//Cleaning data obtained from user.
$page_title = 'Add Departmet';
include ('../includes/admin_header.html');

$dept="";
    
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
	$dept = test_input($_POST['department']);
	// Check for a last_name...
	if (!empty($_POST['department'])) {
                // Add the department to the database:
		require ('../../mysqli_connect.php');
		$q = "INSERT INTO entity_dept (dept_name) VALUES ('$dept')";
                $r = mysqli_query($dbc, $q);
		if ($r) { // If it ran OK.
			// Print a message:
			echo '<h1>You have succefully added a new department to your store.</h1>';
		} 
                else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not add a department due to a system error. Contact your trusty technical support.</p>'; 
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
						
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection
        } // End of the submission IF.
        include ('../includes/admin_footer.html'); 
        exit();
        // Check for an error and print it:
        if (isset($error)) {
                echo '<h1>Error!</h1>
                <p style="font-weight: bold; color: #C00">' . $error . ' Please try again.</p>';
        }
        //cleans inpput data -> Better security
        
}
        //cleans inpput data -> Better security
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
// Display the form...
?>
</br></br>
<h1>Add a Department</h1>
<form action="add_department.php" method="post">
	
	<fieldset><legend>Fill out the form to add a department:</legend>
	
	<p><b>Department Name:</b> <input type="text" name="department" size="10" maxlength="20" value="<?php echo $dept; ?>" /></p>
        <div align="center"><input type="submit" name="submit" value="Submit" /></div>
	</fieldset>
		
	

</form>

</body>
<?php include ('../includes/admin_footer.html'); ?>