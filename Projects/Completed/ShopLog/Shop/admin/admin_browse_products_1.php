<?php # Script 10.5 - #5
// This script retrieves all the records from the users table.
// This new version allows the results to be sorted in different ways.
//Starting the session so we can carry user credintials (user_id, first_name, user_level)
session_start();
    require ('../includes/login_functions.inc.php');
    if($_SESSION['user_level']!=1) {
        redirect_user("access_denied.php");
    }
$page_title = 'The Coffee Connoisseur: Admin Page';
$page_title = 'View Products';
include ('../includes/admin_header.html');
echo '<h1>Registered Products</h1>';

require ('../mysqli_connect.php');

// Number of records to show per page:
$display = 10;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(prod_id) FROM entity_prod";
	$r = @mysqli_query ($dbc, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'dn';

// Determine the sorting order:
switch ($sort) {
	case 'pn':
		$order_by = 'prod_name ASC';
		break;
	case 'pr':
		$order_by = 'price ASC';
		break;
	default:
		$order_by = 'dept_name ASC';
		$sort = 'dn';
		break;
}
	
// Define the query:
$q = "SELECT dept_name, prod_id, prod_name, price From entity_prod, entity_dept WHERE entity_dept.dept_id = entity_prod.dept_id ORDER BY  $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); // Run the query.
if (!$r) {
   echo mysqli_error($dbc);
    exit();
}
// Table header:
echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
<tr>
	<td align="left"><b>Edit</b></td>
	<td align="left"><b>Delete</b></td>
	<td align="left"><b><a href="admin_browse_products_1.php?sort=dn">Department</a></b></td>
	<td align="left"><b><a href="admin_browse_products_1.php?sort=pn">Product Name</a></b></td>
	<td align="left"><b><a href="admin_browse_products_1.php?sort=pr">Price</a></b></td>
</tr>
';

// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="admin_edit_product.php?id=' . $row['prod_id'] . '">Edit</a></td>
		<td align="left"><a href="admin_delete_product.php?id=' . $row['prod_id'] . '">Delete</a></td>
		<td align="left">' . $row['dept_name'] . '</td>
		<td align="left">' . $row['prod_name'] . '</td>
		<td align="left">' . $row['price'] . '</td>
	</tr>
	';
} // End of WHILE loop.

echo '</table>';
mysqli_free_result ($r);
mysqli_close($dbc);

// Make the links to other pages, if necessary.
if ($pages > 1) {
	
	echo '<br /><p>';
	$current_page = ($start/$display) + 1;
	
	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="admin_browse_products_1.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="admin_browse_products_1.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="admin_browse_products_1.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}
	
	echo '</p>'; // Close the paragraph.
	
} // End of links section.
	
include ('../includes/admin_footer.html');
?>