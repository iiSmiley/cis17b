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
$page_title = 'View Orders';
include ('../includes/admin_header.html');
echo '<h1>Confirmed Orders</h1>';

require ('../mysqli_connect.php');

// Number of records to show per page:
$display = 15;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(order_id) FROM order";
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
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'od';

// Determine the sorting order:
switch ($sort) {
	case 'ln':
		$order_by = 'last_name ASC';
		break;
	case 'fn':
		$order_by = 'first_name ASC';
		break;
	case 'od':
		$order_by = 'order_date ASC';
		break;
        case 'tot':
		$order_by = 'total ASC';
		break;
	default:
		$order_by = 'order_date ASC';
		$sort = 'od';
		break;
}
	
// Define the query:
$q = "SELECT last_name, first_name, user_id, DATE_FORMAT(order_date, '%M %d, %Y') AS od, total, order_id From entity_user, entity_order WHERE entity_user.user_id=entity_order.customer_id ORDER BY  $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); // Run the query.

// Table header:
echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
<tr>
	<td align="left"><b>View</b></td>
	<td align="left"><b>Ship</b></td>
	<td align="left"><b><a href="view_orders.php?sort=ln">Last Name</a></b></td>
	<td align="left"><b><a href="view_orders.php?sort=fn">First Name</a></b></td>
	<td align="left"><b><a href="view_orders.php?sort=od">Order Date</a></b></td>
        <td align="left"><b><a href="view_orders.php?sort=tot">Total</a></b></td>
</tr>
';

// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="view_order.php?id=' . $row['order_id'] . '">View</a></td>
		<td align="left"><a href="confirm_order.php?id=' . $row['order_id'] . '">Ship</a></td>
		<td align="left">' . $row['last_name'] . '</td>
		<td align="left">' . $row['first_name'] . '</td>
		<td align="left">' . $row['od'] . '</td>
                <td align="left">' . $row['total'] . '</td>
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
		echo '<a href="view_orders.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="view_orders.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="view_orders.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}
	
	echo '</p>'; // Close the paragraph.
	
} // End of links section.
	
include ('../includes/admin_footer.html');
?>