  <h1 style="text-align:center;background-color:orange; color:white;">Landlord Registration Here</h1><br>
  <h2 style="text-align:center;"><a href="index.php" style="text-decoration:none;">Click Here To Go Back to Home Page</a></h2><br>
<?php
 include 'connect_server.php';

if(isset($_POST['username']) && isset($_POST['surname']) && isset($_POST['telInput']) && isset($_POST['address_of_room']) && 

   isset($_POST['location_of_room']) && isset($_POST['price']) && isset($_POST['double_or_single']) && isset($_POST['bathroom_sharing'])){
	   
	    $username = htmlentities($_POST['username']);
	    $surname = htmlentities($_POST['surname']);
	    $telInput = htmlentities($_POST['telInput']);
	    $address_of_room = htmlentities($_POST['address_of_room']);
	    $location_of_room = htmlentities($_POST['location_of_room']);
		$price = htmlentities($_POST['price']);
	    $double_or_single = htmlentities($_POST['double_or_single']);
		$bathroom_sharing = htmlentities($_POST['bathroom_sharing']);

		if(!empty($username) && !empty($surname) && !empty($telInput) && !empty($address_of_room) && !empty($location_of_room) &&

		 !empty($price) && !empty($double_or_single) && !empty($bathroom_sharing)){
			
			  $query = "SELECT Name, Surname FROM landlord_register WHERE Name='".mysql_real_escape_string($username)."' AND Surname='".mysql_real_escape_string($surname)."'";
			
			 $query_run = mysql_query($query);
			 
			 if(mysql_num_rows($query_run) == 1){
			                                      echo $username." ".$surname." "."Already Exist";
			 }else{
				    $query = "INSERT INTO landlord_register VALUES ('','$username','$surname','$telInput','$address_of_room','$location_of_room','$price','$double_or_single','$bathroom_sharing')";
					$query_run = mysql_query($query); 
					if($query_run ){
?>			
                 <p style="text-align:center;"><?php echo	"You,re registered successfully.";?></p> 
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
  
  
<form action="Landlord_register.php" method="POST" style="text-align:center;">

  Username:<br><input type="text" name="username" maxlength="20" style="font-size: 10pt; width:280px;"><br><br>
  Surname:<br><input type="text" name="surname" maxlength="30" style="font-size: 10pt; width:280px;"><br><br>
  Contact:<br><input type=tel name=telInput maxlength="10" style="font-size: 10pt; width:280px;"><br><br>
  Address of Room:<br><input type="text" name="address_of_room" maxlength="70" style="font-size: 10pt; width:280px;"><br><br>
  Price:<br><input type="number" name="price" maxlength="20" style="font-size: 10pt; width:280px;"><br><br>
  Location of Room:<br><input type="text" name="location_of_room" maxlength="40" style="font-size: 10pt; width:280px;"><br><br>
  Double or Single:<select name="double_or_single">
                           <option value="Single">Single</option>
						   <option value="Double">Double</option>  
                   </select><br><br>
  Bathroom Sharing:<select name="bathroom_sharing">
                           <option value="Sharing">Sharing</option>
						   <option value="Not Sharing ">Not Sharing </option>  
                   </select><br><br>				   
  <input type="submit" value="submit">
</form>  