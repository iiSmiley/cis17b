<?php
require ('../includes/login_functions.inc.php');
echo "<p>Adding your fancy product... </p>";
sleep(10);
redirect_user('add_product.php');
