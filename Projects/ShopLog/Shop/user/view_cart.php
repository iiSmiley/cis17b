<?php # Script - view_cart.php
// This page displays the contents of the shopping cart.
// This page also lets the user update the contents of the cart.
session_start();
// Set the page title and include the HTML header:
$page_title = 'View Your Shopping Cart';
include ('../includes/tcc_header.html');

// Check if the form has been submitted (to update the cart):
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Change any quantities:
	foreach ($_POST['qty'] as $k => $v) {

		// Must be integers!
		$pid = (int) $k;
		$qty = (int) $v;
		
		if ( $qty == 0 ) { // Delete.
			unset ($_SESSION['cart'][$pid]);
		} elseif ( $qty > 0 ) { // Change quantity.
			$_SESSION['cart'][$pid]['quantity'] = $qty;
		}
		
	} // End of FOREACH.
	
} // End of SUBMITTED IF.

// Display the cart if it's not empty...
if (!empty($_SESSION['cart'])) {

	// Retrieve all of the information for the prints in the cart:
	require ('../mysqli_connect.php'); // Connect to the database.
	$q = "SELECT prod_id, dept_name AS dept, prod_name FROM entity_dept, entity_prod WHERE entity_dept.dept_id = entity_prod.dept_id AND entity_prod.prod_id IN (";
	foreach ($_SESSION['cart'] as $pid => $value) {
		$q .= $pid . ',';
	}
	$q = substr($q, 0, -1) . ') ORDER BY entity_dept.dept_name ASC';
	$r = mysqli_query ($dbc, $q);
        

	// Create a form and a table:
	echo '<form action="view_cart.php" method="post">
	<table border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
	<tr>
		<td align="left" width="30%"><b>Department</b></td>
		<td align="left" width="30%"><b>Product Name</b></td>
		<td align="right" width="10%"><b>Price</b></td>
		<td align="center" width="10%"><b>Qty</b></td>
		<td align="right" width="10%"><b>Total Price</b></td>
	</tr>
	';

	// Print each item...
	$total = 0; // Total cost of the order.
	while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
	
		// Calculate the total and sub-totals.
		$subtotal = $_SESSION['cart'][$row['prod_id']]['quantity'] * $_SESSION['cart'][$row['prod_id']]['price'];
		$total += $subtotal;
                $_SESSION['total'] = $total;
		
		// Print the row:
		echo "\t<tr>
		<td align=\"left\">{$row['dept']}</td>
		<td align=\"left\">{$row['prod_name']}</td>
		<td align=\"right\">\${$_SESSION['cart'][$row['prod_id']]['price']}</td>
		<td align=\"center\"><input type=\"text\" size=\"3\" name=\"qty[{$row['prod_id']}]\" value=\"{$_SESSION['cart'][$row['prod_id']]['quantity']}\" /></td>
		<td align=\"right\">$" . number_format ($subtotal, 2) . "</td>
		</tr>\n";
	
	} // End of the WHILE loop.


	mysqli_close($dbc); // Close the database connection.

	// Print the total, close the table, and the form:
	echo '<tr>
		<td colspan="4" align="right"><b>Total:</b></td>
		<td align="right">$' . number_format ($total, 2) . '</td>
	</tr>
	</table>
	<div align="center"><input type="submit" name="submit" value="Update My Cart" /></div>
	</form><p align="center">Enter a quantity of 0 to remove an item.
	<br /><br /><a href="checkout.php">Checkout</a></p>';

} else {
	echo '<p>Your cart is currently empty.</p>';
}

include ('../includes/tcc_footer.html');
?>