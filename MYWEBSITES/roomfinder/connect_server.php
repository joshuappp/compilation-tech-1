<?php
$connect_error = 'Could not connect to server,please call the administrator at 0763213581';
$mysql_host = 'localhost';
$mysql_username = 'root';
$mysql_password = '';
$mysql_db = 'room_finder_database';
 if(!@mysql_connect($mysql_host, $mysql_username, $mysql_password) || !@mysql_select_db( $mysql_db)){
?> 
	 <p style="text-align:center;"><?php  die($connect_error);	?></p> 	   
<?php	  
   }
?>




