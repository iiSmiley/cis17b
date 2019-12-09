<?php # Script - checkout.php
// This page inserts the order information into the table.
// This page would come after the billing process.
// This page assumes that the billing process worked (the money has been taken).
// Preventing the user from checking out before registering their information
session_start();
    require ('../includes/login_functions.inc.php');
    if($_SESSION['user_level']!=2) {
        alert("You have to sign up before checking out!");
        redirect_user("../sign_up.php");
    }
// Set the page title and include the HTML header:
$page_title = 'Order Confirmation';
include ('../includes/tcc_header.html');

// Assume that the customer is logged in and that this page has access to the customer's ID:
$cid = $_SESSION['user_id'];

// Assume that this page receives the order total:
$total = $_SESSION['total'];

require ('../mysqli_connect.php'); // Connect to the database.

// Turn autocommit off:
mysqli_autocommit($dbc, FALSE);

// Add the order to the orders table...
$q = "INSERT INTO entity_order (customer_id, total, order_date) VALUES ($cid, $total, NOW())";
$r = mysqli_query($dbc, $q);
if (mysqli_affected_rows($dbc) == 1) {

	// Need the order ID:
	$oid = mysqli_insert_id($dbc);
	
	// Insert the specific order contents into the database...
	
	// Prepare the query:
	$q = "INSERT INTO entity_order_contents (order_id, prod_id, quantity, price) VALUES (?, ?, ?, ?)";
        
	$stmt = mysqli_prepare($dbc, $q);
	mysqli_stmt_bind_param($stmt, 'iiid', $oid, $pid, $qty, $price);
	if (!$stmt) {
            echo mysqli_error($dbc);
            exit();
        }
	// Execute each query; count the total affected:
	$affected = 0;
	foreach ($_SESSION['cart'] as $pid => $item) {
		$qty = $item['quantity'];
		$price = $item['price'];
		mysqli_stmt_execute($stmt);
		$affected += mysqli_stmt_affected_rows($stmt);
	}

	// Close this prepared statement:
	mysqli_stmt_close($stmt);

	// Report on the success....
	if ($affected == count($_SESSION['cart'])) { // Whohoo!
	
		// Commit the transaction:
		mysqli_commit($dbc);
		
		// Clear the cart:
		unset($_SESSION['cart']);
		
		// Message to the customer:
		echo '<p>Thank you for your order. You will be notified when the items are shiped.</p>';
		
		// Send emails and do whatever else.
	
	}
        else { // Rollback and report the problem.
	
		mysqli_rollback($dbc);
		
		echo '<p>Your order could not be processed due to a system error. You will be contacted in order to have the problem fixed. We apologize for the inconvenience.</p>';
		// Send the order information to the administrator.
		
	}

} 
else { // Rollback and report the problem.

	mysqli_rollback($dbc);

	echo '<p>Your order could not be processed due to a system error. You will be contacted in order to have the problem fixed. We apologize for the inconvenience.</p>';
	
	// Send the order information to the administrator.
	
}
/*if (!$check1_res) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}*/
if (!$stmt) {
            echo mysqli_error($dbc);
            exit();
        }
mysqli_close($dbc);

include ('../includes/tcc_footer.html');
?>