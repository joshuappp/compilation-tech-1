<?php
$connect_error = 'Could not connect to server,please try again later';
$mysql_host = 'localhost';
$mysql_username = 'root';
$mysql_password = '';
$mysql_db = 'Residents';
@$mysqli_connect = mysqli_connect($mysql_host, $mysql_username, $mysql_password);
 if(!@$mysqli_connect || !mysqli_select_db(@$mysqli_connect, $mysql_db)){
?> 
   <br>
   <br>
   <br>
   <br>
   <br>
	 <h2 style="text-align:center;"><?php  die(@$connect_error);	?></h2> 	   
<?php	  
   }
?>




