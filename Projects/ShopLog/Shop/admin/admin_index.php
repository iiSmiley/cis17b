<?php # Script 3.4 - index.php
$page_title = 'The Coffee Connoisseur: Admin Page';
//Starting the session so we can carry user credintials (user_id, first_name, user_level)
session_start();
include ('../includes/admin_header.html');
/*$cookie_name="user";
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
}*/
?>

<h1>Big Header</h1>
<p>This is where you'll put the main page content. This content will differ for each page.</p>
<p>This is where you'll put the main page content. This content will differ for each page.</p>
<p>This is where you'll put the main page content. This content will differ for each page.</p>
<p>This is where you'll put the main page content. This content will differ for each page.</p>
<h2>Subheader</h2>
<p>This is where you'll put the main page content. This content will differ for each page.</p>
<p>This is where you'll put the main page content. This content will differ for each page.</p>
<p>This is where you'll put the main page content. This content will differ for each page.</p>
<p>This is where you'll put the main page content. This content will differ for each page.</p>
<?php include ('../includes/admin_footer.html'); ?>