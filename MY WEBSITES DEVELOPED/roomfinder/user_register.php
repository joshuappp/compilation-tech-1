
  <h1 style="text-align:center;background-color:orange; color:white;">User Registration Here</h1><br>
  <h2 style="text-align:center;"><a href="index.php" style="text-decoration:none;">Click Here To Go Back to Home Page</a></h2><br>
<?php
 include 'connect_server.php';

if(isset($_POST['username']) && isset($_POST['surname']) && isset($_POST['password'])){
	   
	    $username = htmlentities($_POST['username']);
	    $surname = htmlentities($_POST['surname']);
	    $password = htmlentities($_POST['password']);
		$password_hash = md5($password);
	    		
		if(!empty($username) && !empty($surname) && !empty($password) ){
			
			  $query = "SELECT Username, Surname FROM user_register WHERE Username='".mysql_real_escape_string($username)."' AND Surname='".mysql_real_escape_string($surname)."'";
			
			 $query_run = mysql_query($query);
			 
			 if(mysql_num_rows($query_run) == 1){
			                                      echo $username." ".$surname." "."Already Exist";
			 }else{
				    $query = "INSERT INTO user_register VALUES ('','$username','$surname','$password_hash')";
					$query_run = mysql_query($query); 
					if($query_run ){
?>			
                 <p style="text-align:center;"> <?php echo	"You,re registered successfully."; ?> </p> 
<?php						

					}else{
						   echo "Try Again, You Did Not Register The User";
					}
			 }
											   
        }else{
?>			
                 <p style="text-align:center;">Fill all the Fields</p> 
<?php				 
		     }		
	 
	
}	

?>
  
  
<form action="user_register.php" method="POST" style="text-align:center;">

  Username:<br><input type="text" name="username" maxlength="20" style="font-size: 10pt; width:280px;"><br><br>
  Surname:<br><input type="text" name="surname" maxlength="30" style="font-size: 10pt; width:280px;"><br><br>
  Password:<br><input type="password" name="password" maxlength="10" style="font-size: 10pt; width:280px;"><br><br>
  
  <input type="submit" value="submit">
</form>  