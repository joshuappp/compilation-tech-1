<?php
 @ob_start();
 session_start(); 
 include 'connect_server.php';
 @$user = $_SESSION['user_id'];
 $amount_value = 0;
 @$query = "UPDATE login SET Amount_Value='$amount_value' WHERE Id='$user' ";
 $query_run = mysql_query($query);
 session_destroy();
 header('Location:login.php');


?>