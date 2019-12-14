<?php 
session_start(); // Start the session.
    if(!isset($_SESSION['user_id']) && !isset($_COOKIE['time'])) {
        redirect_user("update_list.php");
    }
$page_title = 'Survey Kendi';
include ('../includes/sk_header_1.html');
include ('../includes/tcc_footer.html');
?>
</html>
