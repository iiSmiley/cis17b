<?php # Script 10.2 - delete_user.php
// This page is for deleting a user record.
// This page is accessed through view_users.php.

$page_title = 'Delete a User';
include ('../includes/admin_header.html');
echo '<h1>Delete a Product</h1>';

// Check for a valid product ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_products.php
	$id = $_GET['id'];
        //echo "<p>Get".$id."<p>";
} 
elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
        //echo "<p>Post".$id."<p>";
} 
else { // No valid ID, kill the script.
	echo '<p class="error">!!!This page has been accessed in error.</p>';
	include ('../includes/admin_footer.html'); 
	exit();
}

require ('../mysqli_connect.php');

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($_POST['sure'] == 'Yes') { // Delete the record.

		// Make the query:
		$q = "DELETE FROM entity_prod WHERE prod_id=$id LIMIT 1";		
		$r = @mysqli_query ($dbc, $q);
		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

			// Print a message:
			echo '<p>The product has been deleted.</p>';	

		} 
                else { // If the query did not run OK.
			echo '<p class="error">The product could not be deleted due to a system error.</p>'; // Public message.
			echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
		}
	
	} 
        else { // No confirmation of deletion.
		echo '<p>The product has NOT been deleted.</p>';	
	}

} 
else { // Show the form.

	// Retrieve the user's information:
	$q = "SELECT prod_name FROM entity_prod WHERE prod_id=$id";
	$r = @mysqli_query ($dbc, $q);
        if (!$r) {
            echo mysqli_error($dbc);
            exit();
        }

	if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

		// Get the user's information:
		$row = mysqli_fetch_array ($r, MYSQLI_NUM);
		
		// Display the record being deleted:
		echo "<h3>Name: $row[0]</h3>
		Are you sure you want to delete this product?";
		
		// Create the form:
		echo '<form action="delete_product.php" method="post">
	<input type="radio" name="sure" value="Yes" /> Yes 
	<input type="radio" name="sure" value="No" checked="checked" /> No
	<input type="submit" name="submit" value="Submit" />
	<input type="hidden" name="id" value="' . $id . '" />
	</form>';
	
	} 
        else { // Not a valid product ID.
		echo '<p class="error">!!This page has been accessed in error.</p>';
	}

} // End of the main submission conditional.

mysqli_close($dbc);
		
include ('../includes/admin_footer.html');
?>