<?php
session_start();
//echo "You level is: ".$_SESSION['user_level']."</br>";
echo "<h1 style='font-size:60px; color:red;'>ERROR 001: Access Denied!</h1></br> ";
echo "You have to be an admin to access this page.</br>";
echo "Please check your login credintials.</br>";

?>
