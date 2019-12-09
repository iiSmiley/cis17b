<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
    require ('../includes/login_functions.inc.php');
    if($_SESSION['user_level']!=1) {
        redirect_user("access_denied.php");
    }
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Add a Product</title>
</head>
<body>
<?php # Script - add_print.php
// This page allows the administrator to add a print (product).
include ('../includes/admin_header.html');
require ('../../mysqli_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
	
	// Validate the incoming data...
	$errors = array();

	// Check for a print name:
	if (!empty($_POST['product_name'])) {
		$pn = trim($_POST['product_name']);
	} else {
		$errors[] = 'Please enter the product\'s name!';
	}
	
	// Check for an image:
	if (is_uploaded_file ($_FILES['img']['tmp_name'])) {

		// Create a temporary file name:
                //$uploaddir = '../../uploads/';
                //$uploadfile = $uploaddir . basename($_FILES['img']['tmp_name']);
		$temp = '../../uploads/' . md5($_FILES['img']['name']);
	
		// Move the file over:
		if (move_uploaded_file($_FILES['img']['tmp_name'], $temp)) {

			echo '<p>The file has been uploaded!</p>';
	
			// Set the $i variable to the image's name:
			$i = $_FILES['img']['name'];
	
		}
                else { // Couldn't move the file over.
			$errors[] = 'The file could not be moved.';
			$temp = $_FILES['img']['tmp_name'];
		}

	}
        else { // No uploaded file.
		$errors[] = 'No file was uploaded.';
		$temp = NULL;
	}
	

	// Check for a price:
	if (is_numeric($_POST['price']) && ($_POST['price'] > 0)) {
		$p = (float) $_POST['price'];
	}
        else {
		$errors[] = 'Please enter the print\'s price!';
	}

	// Check for a description (not required):
	$d = (!empty($_POST['description'])) ? trim($_POST['description']) : NULL;
	
	// Validate the artist...
	if ( isset($_POST['dept']) && filter_var($_POST['dept'], FILTER_VALIDATE_INT, array('min_range' => 1))  ) {
		$dept = $_POST['dept'];
	}
        else { // No artist selected.
		$errors[] = 'Please select the product\'s department!';
	}
	
	if (empty($errors)) { // If everything's OK.

		// Add the print to the database:
		$q = "INSERT INTO entity_prod (dept_id, prod_name, price, description, img_name) VALUES ('$dept', '$pn', '$p', '$d', '$i')";
		$r = @mysqli_query($dbc, $q);
		// Check the results...
		if ($r) {

			// Print a message:
			echo '<p>The product has been added.</p>';
	
			// Rename the image:
			$id = mysqli_insert_id($dbc); // Get the print ID.
			rename ($temp, "../../uploads/$id");
	
			// Clear $_POST:
			$_POST = array();
	
		} else { // Error!
			echo '<p style="font-weight: bold; color: #C00">Your submission could not be processed due to a system error.</p>'; 
		}
		
		mysqli_close($dbc);
		
	} // End of $errors IF.
	
	// Delete the uploaded file if it still exists:
	if ( isset($temp) && file_exists ($temp) && is_file($temp) ) {
		unlink ($temp);
	}
	
} // End of the submission IF.

// Check for any errors and print them:
if ( !empty($errors) && is_array($errors) ) {
	echo '<h1>Error!</h1>
	<p style="font-weight: bold; color: #C00">The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
	echo 'Please reselect the product image and try again.</p>';
}

// Display the form...
?>
<h1>Add a Product</h1>
<form enctype="multipart/form-data" action="add_product.php" method="post">

	<input type="hidden" name="MAX_FILE_SIZE" value="1024000" />
	
	<fieldset><legend>Fill out the form to add a product to the catalog:</legend>
	
	<p><b>Product Name:</b> <input type="text" name="product_name" size="30" maxlength="60" value="<?php if (isset($_POST['product_name'])) echo htmlspecialchars($_POST['product_name']); ?>" /></p>
	
	<p><b>Image:</b> <input type="file" name="img" /></p>
	
	<p><b>Department:</b> 
	<select name="dept"><option>Select One</option>
	<?php // Retrieve all the artists and add to the pull-down menu.
	$q = "SELECT dept_id, dept_name FROM entity_dept ORDER BY dept_name ASC";		
	$r = mysqli_query ($dbc, $q);
	if (mysqli_num_rows($r) > 0) {
		while ($row = mysqli_fetch_array ($r, MYSQLI_NUM)) {
			echo "<option value=\"$row[0]\"";
			// Check for stickyness:
			if (isset($_POST['dept']) && ($_POST['dept'] == $row[0]) ) echo ' selected="selected"';
			echo ">$row[1]</option>\n";
		}
	} else {
		echo '<option>Please add a department first.</option>';
	}
	mysqli_close($dbc); // Close the database connection.
	?>
	</select></p>
	
	<p><b>Price:</b> <input type="text" name="price" size="10" maxlength="10" value="<?php if (isset($_POST['price'])) echo $_POST['price']; ?>" /> <small>Do not include the dollar sign or commas.</small></p>
		
	<p><b>Description:</b> <textarea name="description" cols="40" rows="5"><?php if (isset($_POST['description'])) echo $_POST['description']; ?></textarea> (optional)</p>
	
	</fieldset>
		
	<div align="center"><input type="submit" name="submit" value="Submit" /></div>

</form>
<?php include ('../includes/admin_footer.html');?>
</body>
</html>