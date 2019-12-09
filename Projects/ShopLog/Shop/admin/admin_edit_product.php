<?php # Script 10.3 - edit_user.php
// This page is for editing a user record.
// This page is accessed through view_users.php.
//Starting the session so we can carry user credintials (user_id, first_name, user_level)

session_start();
$page_title = 'Edit a Product';
include ('../includes/admin_header.html');
echo '<h1>Edit a Product</h1>';
// Check for a valid product ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_products.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
	include ('../includes/admin_header.html'); 
	exit();
}

require ('../mysqli_connect.php'); 

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array();
	
	// Check for a first name:
	if (empty($_POST['product_name'])) {
		$errors[] = 'You forgot to enter the product\'s name.';
	}
        else {
		$pn = mysqli_real_escape_string($dbc, trim($_POST['product_name']));
	}
	
	// Check for a last name:
	if (empty($_POST['price'])) {
		$errors[] = 'You forgot to enter the product\'s price';
	}
        else {
		$p = mysqli_real_escape_string($dbc, trim($_POST['price']));
	}

	// Check for an email address:
	if (empty($_POST['description'])) {
		$errors[] = 'You forgot to enter the prduct\'s description.';
	}
        else {
		$d = mysqli_real_escape_string($dbc, trim($_POST['description']));
	}
	
	if (empty($errors)) { // If everything's OK.
	
		//  Test for unique name:
		$q = "SELECT prod_id FROM entity_prod WHERE prod_name='$pn' AND prod_id != $id";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 0) {

			// Make the query:
			$q = "UPDATE entity_prod SET prod_name='$pn', price='$p', description='$d' WHERE prod_id=$id LIMIT 1";
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message:
				echo '<p>The product has been edited.</p>';	
				
			}
                        else { // If it did not run OK.
				echo '<p class="error">The product could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
				
		}
                else { // Already registered.
			echo '<p class="error">The email address has already been registered.</p>';
		}
		
	}
        else { // Report the errors.

		echo '<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p>';
	
	} // End of if (empty($errors)) IF.

} // End of submit conditional.

// Always show the form...

// Retrieve the product's information:
$q = "SELECT prod_name, price, description FROM entity_prod WHERE prod_id=$id";		
$r = @mysqli_query ($dbc, $q);
if (!$r) {
    echo mysqli_error($dbc);
    exit();
}

if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

	// Get the product information:
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);
	
	// Create the form:
	echo '<form action="admin_edit_product.php" method="post">
<p>New Product Name: <input type="text" name="product_name" size="15" maxlength="15" value="' . $row[0] . '" /></p>
<p>New Price: <input type="text" name="price" size="15" maxlength="30" value="' . $row[1] . '" /><small> Do not include the dollar sign or commas.</small></p>
<p>New Description: <textarea name="description" cols="40" rows="5" >' . $row[2] . '</textarea> </p>
<p><input type="submit" name="submit" value="Submit" /></p>
<p><input type="hidden" name="id" value="' . $id . '" />
</form>';

}
else { // Not a valid user ID.
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($dbc);
		
include ('../includes/admin_footer.html');
?>