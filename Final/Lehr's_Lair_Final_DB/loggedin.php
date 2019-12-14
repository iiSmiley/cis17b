<?php # Script 12.13 - loggedin.php #3
// The user is redirected here from login.php.


session_start(); // Start the session.
include ('includes/login_functions.inc.php');
    if(isset($_SESSION['user_id']) && isset($_COOKIE['time'])) {
        redirect_user("update_list.php");
    }
    else {
        redirect_user("view.php");
    }
// If no session value is present, redirect the user:
// Also validate the HTTP_USER_AGENT!
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

	// Need the functions:
	include ('includes/sk_header.html');
        include ('includes/login_functions.inc.php');
	redirect_user('home.php');	

}

// Set the page title and include the HTML header:
$page_title = 'Logged In!';
include ('includes/sk_header.html');

// Print a customized message:
//echo "</br>";
echo "<h1>Logged In!</h1>
<p>You are now logged in, {$_SESSION['first_name']}!</p>
<p><a href=\"logout.php\">Logout</a></p>";

include ('includes/sk_footer.html');
?>