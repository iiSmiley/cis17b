<?php # Script 3.4 - index.php
//Starting the session so we can carry user credintials (user_id, first_name, user_level)
session_start();
    require ('../includes/login_functions.inc.php');
    if($_SESSION['user_level']!=1) {
        redirect_user("access_denied.php");
    }
$page_title = 'The Coffee Connoisseur: Admin Page';
include ('../includes/admin_header.html');

?>

<h1>Welcom</h1>

<?php include ('../includes/admin_footer.html'); ?>