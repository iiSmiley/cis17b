<?php 
session_start(); // Start a session.
$page_title = 'Survey Kendi';
if($_SESSION['user_level'] == 1) {
    include ('includes/admin_sk_header.html');
}
else {
    include ('includes/sk_header.html');
}
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
