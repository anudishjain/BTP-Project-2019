<?php
define('DB_HOST', 'localhost');
 define('DB_USER', 'id11109150_admin');
 define('DB_PASS', 'projectBTP#2019');
 define('DB_NAME', 'id11109150_btpatmdata');
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }
 

?>