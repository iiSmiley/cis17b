<?php 
session_start(); // Start the session.
    if(!isset($_SESSION['user_id']) && !isset($_COOKIE['time'])) {
        redirect_user("update_list.php");
    }
$page_title = 'Survey Kendi';
include ('includes/sk_header.html');


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


<?php
include ('includes/sk_footer.html');
?>
</html>
