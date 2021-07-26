<?php
   @ob_start();
   session_start(); 
         
  if(loggedin()){
	  include 'connect_server.php';
     @$user = $_SESSION['user_id'];  
	 $query = "SELECT Amount_Value FROM login WHERE Id='$user'";
	$query_run = mysql_query($query);	
	while($query_row=mysql_fetch_assoc($query_run)){		
		$amount_value = $query_row['Amount_Value'];
	}    	
	$amount_value = $amount_value + 1;
	@$query = "UPDATE login SET Amount_Value='$amount_value' WHERE Id='$user' ";
	$query_run = mysql_query($query);  
	   
	if($amount_value == 1){
	   $logout_time = time()+3000;	  
	   $query = "UPDATE login SET Time_Counter='$logout_time' WHERE Id='$user' ";
	   $query_run = mysql_query($query);
	   header('Refresh: 3000; logout.php');
     }else if($amount_value >= 2){          
			   $query = "SELECT Time_Counter FROM login WHERE Id='$user' ";
			   $query_run = mysql_query($query);

			   while($query_row = mysql_fetch_assoc($query_run)){
				   $logout_time = $query_row['Time_Counter'];
			   }

				if(time() >= $logout_time){
					header('Refresh: 0; logout.php');
				}
      }	

 ?>
 
 <script type="text/javascript">
 document.onkeydown = function() {    
    switch (event.keyCode) { 
        case 116 : //F5 button
            event.returnValue = false;
            event.keyCode = 0;
            return false; 
        case 82 : //R button
            if (event.ctrlKey) { 
                event.returnValue = false; 
                event.keyCode = 0;  
                return false; 
            } 
    }
}
</script>



<h1 style="text-align:center;background-color:orange; color:white;">Administrator Page</h1>

<?php
  
   
   
    
   ////////////////////////////////////////////
  
   ///////////////////////////////////////////
   
    $query = " SELECT Username, Surname FROM login WHERE Id='$user' ";
	if($query_run = mysql_query($query)){
		
		while($query_row = mysql_fetch_assoc($query_run)){
			 $the_user_name = $query_row['Username'];
			 $the_Sur_name = $query_row['Surname'];
?>
    <p style="text-align:right;background-color:orange; color:Black;margin-top:-15px;margin-left:1140px;"><?php if(!empty($the_user_name) && !empty($the_Sur_name)){ echo 'Welcome '.$the_user_name.' '.$the_Sur_name;} ?></p>

<?php		   
		}
	}else{
	   echo mysql_error();
   }
     $query = "SELECT Amount FROM login WHERE Id='$user' ";
		   if($query_run = mysql_query($query)){
			
               while($query_row = mysql_fetch_assoc($query_run)){			
				  $query_result = $query_row['Amount'].'<br>'; 
				  $query_result=$query_result+10.0;
			   }
		   }else{
			   echo mysql_error();
		   }   
   

?>
   <p style="text-align:right;background-color:orange; color:Black;margin-top:-15px;margin-left:1120px;"><?php  
      if($amount_value ==1){echo 'R'.@$query_result;}else{echo 'R'.($query_result-10.0);}   ?></p>

<?php
           if($amount_value ==1){
				 @$query = "UPDATE login SET Amount='$query_result' WHERE Id='$user' ";
		         $query_run = mysql_query($query);
			 }

?>
<h2 style="text-align:center;"><a href="logout.php" style="text-decoration:none;">Logout</a></h2>

 <h1 style="margin-left:20px;color:blue;">Landlords Who Registered</h1>

<?php

 include 'connect_server.php';
//Administrator Section

  $query = "SELECT Name, Surname, Contact, Address_Of_Room, Location_Of_Room,  Price, Double_Or_Single, Bathroom_Sharing FROM landlord_register";
  $count=1;
  $query_run = mysql_query($query);
  
  if($query_run){
?>	  
	  <table border="1" cellpadding="0" cellspacing="0"  style="border-collapse:collapse;" >
               <tr>
					     <th width="125px" >USER NUMBER</th>
						 <th width="110px" >USERNAME</th>
						 <th width="110px" >SURNAME</th>
						 <th width="170px" >CONTACT NUMBER</th>
						 <th width="170px" >ADDRESS OF ROOM</th>
						 <th width="170px" >LOCATION OF ROOM</th>
						 <th width="170px" >PRICE OF ROOM</th>
						 <th width="170px" >DOUBLE OR SINGLE</th>
						 <th width="170px" >Bathroom Sharing</th>
					   </tr>
   </table>
	  
 <?php 
	   while($query_row = mysql_fetch_assoc($query_run)){
		  
		  $username = $query_row['Name'];
		  $surname = $query_row['Surname'];
		  $contact = $query_row['Contact'];
		  $address_of_room = $query_row['Address_Of_Room'];
		  $location_of_room = $query_row['Location_Of_Room'];
		  $price = $query_row['Price'];
		  $double_or_single = $query_row['Double_Or_Single'];
		  $bathroom_sharing = $query_row['Bathroom_Sharing'];

?>			
             <table border="1" cellpadding="0" cellspacing="0"  style="border-collapse:collapse;" > 					   
					   <tr >
					        <td width="129px" ><?php echo "<strong>".$count."</strong>"; ?></td>
					        <td width="112px" ><?php echo $username; ?></td>
							<td width="112px" ><?php echo $surname; ?></td>							
							<td width="170px" ><?php echo $contact; ?></td>
							<td width="170px" ><?php echo $address_of_room; ?></td>
							<td width="170px" ><?php echo $location_of_room; ?></td>
							<td width="170px" ><?php echo $price; ?></td>
							<td width="170px" ><?php echo $double_or_single; ?></td>
							<td width="170px" ><?php echo $bathroom_sharing; ?></td>
					   </tr>				   
				   </table>										
<?php			  
		  $count++;
	  }

  }else{
				  echo mysql_error(); 
	  }
?>

          <h1 style="margin-left:20px;color:blue;">Members registered in user registration</h1>	
<?php	 
              
			  $query = "SELECT Username, Surname FROM user_register ";
			  
			  $query_run = mysql_query($query);
			  
			  if($query_run){				   
?>					  
					  <table border="1" cellpadding="0" cellspacing="0"  style="border-collapse:collapse;">
					           <tr>
							        <th width="170px">USER NUMBER</th>
							        <th width="170px">USERNAME</th>
									<th width="170px">SURNAME</th>
								</tr>					  				  				  
					  </table>				  
<?php		
                  $user_counter = 1;				 
				  while($query_row = mysql_fetch_assoc($query_run)){					  
					   $the_Username = $query_row['Username'];
					   $the_surname = $query_row['Surname'];
					   
?>					  
					  <table border="1" cellpadding="0" cellspacing="0"  style="border-collapse:collapse;">
					           <tr>
							        <td width="170px"><?php  echo "<strong>".$user_counter."</strong>"; ?></td>
							        <td width="170px"><?php  echo $the_Username;  ?></td>
									<td width="170px"><?php  echo $the_surname;  ?></td>
									
							   </tr>					  				  				  
					  </table>				  
<?php					 				
					$user_counter++;  
				  }					 
			   }else{
                       echo mysql_error();
			   }	  
	

?>




 <h1 style="margin-left:20px;color:blue;">Members Who Can Login</h1>	
<?php	 
              
			  $query = "SELECT Username, Surname, Amount FROM login ";
			  
			  $query_run = mysql_query($query);
			  
			  if($query_run){				   
?>					  
					  <table border="1" cellpadding="0" cellspacing="0"  style="border-collapse:collapse;">
					           <tr>
							        <th width="170px">USER NUMBER</th>
							        <th width="170px">USERNAME</th>
									<th width="170px">SURNAME</th>
									<th width="170px">AMOUNT</th>

								</tr>					  				  				  
					  </table>				  
<?php		
                  $user_counter = 1;				 
				  while($query_row = mysql_fetch_assoc($query_run)){					  
					   $the_Username = $query_row['Username'];
					   $the_surname = $query_row['Surname'];
					   $the_amount = $query_row['Amount'];

					   
?>					  
					  <table border="1" cellpadding="0" cellspacing="0"  style="border-collapse:collapse;">
					           <tr>
							        <td width="170px"><?php  echo "<strong>".$user_counter."</strong>"; ?></td>
							        <td width="170px"><?php  echo $the_Username;  ?></td>
									<td width="170px"><?php  echo $the_surname;  ?></td>
									<td width="170px"><?php  echo $the_amount;  ?></td>

									
							   </tr>					  				  				  
					  </table>				  
<?php					 				
					$user_counter++;  
				  }					 
			   }else{
                       echo mysql_error();
			   }	  
?>



<hr/>
  <div ><h1 style="text-align:center;color:blue;border-top:2px solid blue;padding:0px;margin-top:0px;" >ADMINISTRATOR CONTROL ONLY</h1></div>
<?php
 if(isset($_POST['delete_landlord_at_register']) || isset($_POST['delete_landlord_at_register_surname'])|| 
 isset($_POST['delete_user_at_register']) ||  isset($_POST['delete_user_at_register_surname']) || isset($_POST['add_user_to_login']) ||
 isset($_POST['add_user_to_login_surname']) || isset($_POST['delete_user_at_login']) || isset($_POST['delete_user_at_login_surname']) ||
 /////////////////////-----------------
 isset($_POST['update_user_amount']) || isset($_POST['update_user_amount_surname']) 
/////////////////////-------------------
 ){
	 
	if(loggedin()){ 
	 $delete_landlord_at_register   = htmlentities($_POST['delete_landlord_at_register']);
	 $delete_landlord_at_register_surname   = htmlentities($_POST['delete_landlord_at_register_surname']);
	 $delete_user_at_register   = htmlentities($_POST['delete_user_at_register']);
	 $delete_user_at_register_surname   = htmlentities($_POST['delete_user_at_register_surname']);
	 $add_user_to_login = htmlentities($_POST['add_user_to_login']);
	 $add_user_to_login_surname = htmlentities($_POST['add_user_to_login_surname']);	
	 $delete_user_at_login  = htmlentities($_POST['delete_user_at_login']);
	 $delete_user_at_login_surname  = htmlentities($_POST['delete_user_at_login_surname']);
//////////////////////////////	 -----------------
	 $update_user_amount  = htmlentities($_POST['update_user_amount']);
	 $update_user_amount_surname  = htmlentities($_POST['update_user_amount_surname']);
///////////////////////////	 --------------
	 if((!empty($delete_landlord_at_register) && !empty($delete_landlord_at_register_surname)) ||
		 (!empty($delete_user_at_register) && !empty($delete_user_at_register_surname)) 
		 ||(!empty($add_user_to_login) && !empty($add_user_to_login_surname)) ||		 
		 (!empty($delete_user_at_login) && !empty($delete_user_at_login_surname  ))||
////////////////////////////------------		 
		  (!empty($update_user_amount) && !empty($update_user_amount_surname  ))){
///////////////////////////-----------------
         if($delete_landlord_at_register && $delete_landlord_at_register_surname){				
								$query = "SELECT Name,Surname FROM landlord_register WHERE Name='".mysql_real_escape_string($delete_landlord_at_register)."' AND Surname='".mysql_real_escape_string($delete_landlord_at_register_surname)."'";
								$query_run = mysql_query($query);										
										if(mysql_num_rows($query_run)== 0){									
												   echo $delete_landlord_at_register.' '.$delete_landlord_at_register_surname.' Does Not Exist In The Register Table';
			                              }else if(mysql_num_rows($query_run)== 1){				
														  $query = "DELETE FROM landlord_register WHERE Name='".mysql_real_escape_string($delete_landlord_at_register)."' AND Surname='".mysql_real_escape_string($delete_landlord_at_register_surname)."'";
														if(mysql_query($query)){
																  echo "You Successfully Deleted ". $delete_landlord_at_register." ".$delete_landlord_at_register_surname;
															}else{
																echo "Unable To Delete The User";
												                 }
										}				
		}else if($delete_user_at_register && $delete_user_at_register_surname){				
								$query = "SELECT Username,Surname FROM user_register WHERE Username='".mysql_real_escape_string($delete_user_at_register)."' AND Surname='".mysql_real_escape_string($delete_user_at_register_surname)."'";
								$query_run = mysql_query($query);										
										if(mysql_num_rows($query_run)== 0){									
												   echo $delete_user_at_register.' '.$delete_user_at_register_surname.' Does Not Exist In The User Register Table';
			                              }else if(mysql_num_rows($query_run)== 1){				
														  $query = "DELETE FROM user_register WHERE Username='".mysql_real_escape_string($delete_user_at_register)."' AND Surname='".mysql_real_escape_string($delete_user_at_register_surname)."'";
														if(mysql_query($query)){
																  echo "You Successfully Deleted ". $delete_user_at_register." ".$delete_user_at_register_surname;
															}else{
																echo "Unable To Delete The User";
												                 }
										}				
		}else if($add_user_to_login && $add_user_to_login_surname ){			
		$query = "SELECT Username, Surname FROM login WHERE Username='".mysql_real_escape_string($add_user_to_login)."' AND Surname='".mysql_real_escape_string($add_user_to_login_surname)."'";
 		$query_run = mysql_query($query);
		if(mysql_num_rows($query_run)== 1){			
			   echo $add_user_to_login.' '.$add_user_to_login_surname.' Exist In The Login Table';			   
		   }else if(mysql_num_rows($query_run)== 0){			
					$query = "SELECT Username,Surname,Password FROM user_register WHERE Username='".mysql_real_escape_string($add_user_to_login)."' AND Surname='".mysql_real_escape_string($add_user_to_login_surname)."'";
					$query_run = mysql_query($query);					
					if(mysql_num_rows($query_run)== 0){						
						  echo "The User ".$add_user_to_login." ".$add_user_to_login_surname." Does Not Exist In The User Register Table";
						}else if(mysql_num_rows($query_run)== 1){							  
							  $user_username = mysql_result($query_run, 0, 'Username');
							  $user_surname = mysql_result($query_run, 0, 'Surname');							  
							  $user_password = mysql_result($query_run, 0, 'Password');	
                              							  
							  $query = "INSERT INTO login VALUES ('','$user_username','$user_surname', '$user_password','0.0')";
							  if(!mysql_query($query)){
								  echo "Try again later";
							  } else{
                                      echo "You Successfully Added ".$user_username." ".$user_surname." To Login Table ";
							  }							  
						}
		         }	
				}else if($delete_user_at_login && $delete_user_at_login_surname){						
						               $query = "SELECT Username,Surname FROM login WHERE Username='".mysql_real_escape_string($delete_user_at_login)."' AND Surname='".mysql_real_escape_string($delete_user_at_login_surname)."'";
								        $query_run = mysql_query($query);										
										if(mysql_num_rows($query_run)== 0){
									   echo $delete_user_at_login.' '.$delete_user_at_login_surname.' Does Not Exist In The Login Table';
			                                 }else if(mysql_num_rows($query_run)== 1){
												  $query = "DELETE FROM login WHERE Username='".mysql_real_escape_string($delete_user_at_login)."' AND Surname='".mysql_real_escape_string($delete_user_at_login_surname)."'";
														if( mysql_query($query)){
																						  echo "You Successfully Deleted ".$delete_user_at_login." ".$delete_user_at_login_surname." From The Login Table";
																					}else{
																							echo "Unable To Delete The Leader";
																			  }
										}	
     //////////////////////////////////---------------------										
				               }else if($update_user_amount && $update_user_amount_surname){
								   	       $query = "SELECT Username,Surname FROM login WHERE Username='".mysql_real_escape_string($update_user_amount)."' AND Surname='".mysql_real_escape_string($update_user_amount_surname)."'";
                                            $query_run = mysql_query($query);
								              if(mysql_num_rows($query_run)== 0){
								           echo $update_user_amount.' '.$update_user_amount_surname.' Does Not Exist In The Login Table';
											  }else if(mysql_num_rows($query_run)== 1){
												    global $user;
												       $amount = 0; 
								                      $query = "UPDATE login SET Amount='$amount' WHERE Username='".mysql_real_escape_string($update_user_amount)."' AND Surname='".mysql_real_escape_string($update_user_amount_surname)."'";
													  if( mysql_query($query)){
														  echo "You Successfully updated ".$update_user_amount." ".$update_user_amount_surname." From The Login Table";
													  }else{ 
													              echo "Unable To Delete The Leader";
													  }	  
								              }
							   }
	//////////////////////////////////-------------------------------------------						   
							   else{
                                         echo "Nothing Has Been Changed";
						            }		 
	 }else{
             echo "Please Enter The Username And Surname";           
	 }	
	}else{
		echo "Login First";
	}	 
 }   
?>


			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
<?php			   
	
 }
 
 
  function loggedin(){
	 if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){ 
	  return true;
	 }else{
?>
 <h3 style="margin-left:20px;color:blue;"><a href="login.php">Click here to login Login First in order to View the members</a> </h3>	
<?php		 
		 
		 
		    return false;
	 }
  }	  
 


 
?>


<form action="admin.php" method="POST">   
  <p><label>
     
     Delete Landlord At Register:<br><input type="text" name="delete_landlord_at_register" maxlength="20"><br>
	 Surname:<br><input type="text" name="delete_landlord_at_register_surname" maxlength="20"><br><br><br>
	 Delete User At Register:<br><input type="text" name="delete_user_at_register" maxlength="20"><br>
	 Surname:<br><input type="text" name="delete_user_at_register_surname" maxlength="20"><br><br><br>
	 Add User To Login:<br><input type="text" name="add_user_to_login" maxlength="20"><br>
	 Surname:<br><input type="text" name="add_user_to_login_surname" maxlength="20"><br><br><br>
	 Delete user At Login:<br><input type="text" name="delete_user_at_login" maxlength="20"><br>
	 Surname:<br><input type="text" name="delete_user_at_login_surname" maxlength="20"><br><br>
	 Delete user Amount:<br><input type="text" name="update_user_amount" maxlength="20"><br>
	 Surname:<br><input type="text" name="update_user_amount_surname" maxlength="20"><br><br>
	                       <input type="submit" name="submit" value="submit"><br>  
  </label></p> 
</form>