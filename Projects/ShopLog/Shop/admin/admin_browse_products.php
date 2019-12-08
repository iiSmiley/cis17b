<?php # Script - browse_prints.php
// This page displays the available prints (products).

// Set the page title and include the HTML header:
$page_title = 'Dicover Our Collection';
include ('../includes/admin_header.html');

require ('../mysqli_connect.php');
 
// Default query for this page:
$q = "SELECT entity_dept.dept_id, dept_name , prod_name, price, description, prod_id FROM entity_dept, entity_prod WHERE entity_dept.dept_id = entity_prod.dept_id ORDER BY entity_dept.dept_name ASC, entity_prod.prod_name ASC";

// Are we looking at a particular artist?
if (isset($_GET['did']) && filter_var($_GET['did'], FILTER_VALIDATE_INT, array('min_range' => 1))  ) {
	// Overwrite the query:
	$q = "SELECT entity_dept.dept_id, prod_name, price, description, prod_id FROM entity_dept, entity_prod WHERE entity_dept.dept_id=entity_prod.prod_id AND entity_prod.dept_id={$_GET['did']} ORDER BY entity_prod.prod_name";
}
//echo "<p>Value of $q <--<p>";
//echo "<p>Value of  <--<p>";
// Create the table head:
echo '<table border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
	<tr>
                <td align=\"left\" width="10%"><b>Edit</b></td>
                <td align=\"left\" width="10%"><b>Delete</b></td>
		<td align="left" width="20%"><b>Department</b></td>
		<td align="left" width="20%"><b>Product</b></td>
		<td align="left" width="30%"><b>Description</b></td>
		<td align="right" width="10%"><b>Price</b></td>
	</tr>';

// Display all the prints, linked to URLs:
$r = mysqli_query ($dbc, $q);
if (!$r) {
    echo mysqli_error($dbc);
    exit();
}
//echo "<p>Value of $r <--<p>";
while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {

	// Display each record:
	echo "\t<tr>
                <td align=\"left\"><a href=\"edit_product.php?id={$row['prod_id']}\">Edit</a></td>
                <td align=\"left\"><a href=\"delete_product.php?id={$row['prod_id']}\">Delete</a></td>
		<td align=\"left\"><a href=\"browse_products.php?aid={$row['dept_id']}\">{$row['dept_name']}</a></td>
		<td align=\"left\"><a href=\"view_product.php?pid={$row['prod_id']}\">{$row['prod_name']}</a></td>
		<td align=\"left\">{$row['description']}</td>
		<td align=\"right\">\${$row['price']}</td>
	</tr>\n";

} // End of while loop.

echo '</table>';
mysqli_close($dbc);
include ('../includes/admin_footer.html');
?>