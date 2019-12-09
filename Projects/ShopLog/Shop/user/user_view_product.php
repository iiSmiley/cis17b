<?php # Script - view_print.php
// This page displays the details for a particular print.
session_start();
$row = FALSE; // Assume nothing!

if (isset($_GET['pid']) && filter_var($_GET['pid'], FILTER_VALIDATE_INT, array('min_range' => 1)) ) { // Make sure there's a print ID!

	$pid = $_GET['pid'];
	
	// Get the print info:
	require ('../mysqli_connect.php'); // Connect to the database.
	$q = "SELECT dept_name AS dept, prod_name, price, description, img_name FROM entity_dept, entity_prod WHERE entity_dept.dept_id=entity_prod.dept_id AND entity_prod.prod_id=$pid";
	$r = mysqli_query ($dbc, $q);
	if (mysqli_num_rows($r) == 1) { // Good to go!

		// Fetch the information:
		$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
	
		// Start the HTML page:
		$page_title = $row['prod_name'];
		include ('../includes/tcc_Header.html');
	
		// Display a header:
		echo "<div align=\"center\">
		<b>{$row['prod_name']}</b> by 
		{$row['dept']}<br />";

		echo "<br />\${$row['price']} 
		<a href=\"add_cart.php?pid=$pid\">Add to Cart</a>
		</div><br />";
                //$pid = $row['img_name'];
		// Get the image information and display the image:
		if ($image = @getimagesize ("../../uploads/$pid")) {
			echo "<div align=\"center\"><img src=\"show_image.php?image=$pid&name=" . urlencode($row['img_name']) . "\" $image[3] alt=\"{$row['prod_name']}\" /></div>\n";	
		} else {
			echo "<div align=\"center\">No image available.</div>\n"; 
		}
		
		// Add the description or a default message:
		echo '<p align="center">' . ((is_null($row['description'])) ? '(No description available)' : $row['description']) . '</p>';
	
	} // End of the mysqli_num_rows() IF.
	
	mysqli_close($dbc);

} // End of $_GET['pid'] IF.

if (!$row) { // Show an error message.
	$page_title = 'Error';
	include ('../includes/tcc_Header.html');
	echo '<div align="center">This page has been accessed in error!</div>';
}

// Complete the page:
include ('../includes/tcc_Footer.html');
?>