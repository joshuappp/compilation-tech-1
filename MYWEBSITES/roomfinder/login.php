 <?php
   @ob_start();
   session_start(); 
 
 ?>
 <h1 style="text-align:center;background-color:orange; color:white;">Login Here</h1><br>
  <h2 style="text-align:center;"><a href="index.php" style="text-decoration:none;">Click Here To Go Back to Home Page</a></h2><br>

<?php
include 'connect_server.php';

 if(isset($_POST['username']) && isset($_POST['password'])){
	$username = htmlentities($_POST['username']);
	$password = htmlentities($_POST['password']);
	$password_hash = md5($password);
	
	if(!empty($username) && !empty($password)){
		
		$query = "SELECT Id FROM login WHERE Username='".mysql_real_escape_string($username)."' AND Password='".mysql_real_escape_string($password_hash)."'  ";
		
		$query_run = mysql_query($query);
		if(mysql_num_rows($query_run)==1){
			
			$user_id = mysql_result($query_run, 0, 'Id');
			$_SESSION['user_id'] = $user_id; 
			
		}else if(mysql_num_rows($query_run)==0){	
?>
     <p style="text-align:center;"><?php  echo "Invalid Username\Surname\Password Combination" ?></p>
 <?php		
       
		}
		$query = "SELECT Username, Password FROM login WHERE Username='".mysql_real_escape_string($username)."' AND Password='".mysql_real_escape_string($password_hash)."' ";
		
		 		
		$query_run = mysql_query($query);
		
		if($username=='Joshua' && $password_hash=='860d41e68c470092047c1dab82ee5eba'){			
			header('Location:admin.php');		
		}else if(mysql_num_rows($query_run)==1){			
			header('Location:user.php');			
		}else{
 ?>			
                 <p style="text-align:center;">The Username\Password Combination is Incorrect</p> 
<?php	             
		}  
		
	}else{
?>			
                 <p style="text-align:center;">Fill all the Fields</p> 
<?php	

	}	
	
}	

?>  
  
  
  
<form action="login.php" method="POST" style="text-align:center;">
Username:<br><input type="text" name="username" maxlength="20" ><br><br>
Password:<br><input type="password" name="password" maxlength="50" ><br><br>
<input type="submit" value="Submit">

</form>