<?php
         @ob_start();
         session_start();
         include 'connect_server.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Residents</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Residents</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  <link href="first.css" rel="stylesheet">
  
</head>
<body>
                <!-- Navigation  -->

      <div class="container-fluid" >

                <nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
                    <a class="navbar-brand" href="index.php"><img src="comp.png" width="100px" height="100px"/></a>
                    <button type="button" class="navbar-toggler"  data-toggle="collapse" data-target="#navbarResponsive"> 
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                      <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                          <a class="nav-link" style="text-decoration:underline;color:red;" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" style="color: blue;" href="uploadroom.php">Upload Room</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" style="color: blue;" href="aboutus.php">About Us</a>
                        </li>
                      </ul>
                    </div>

                </nav>

                <!-- Image Slider -->
              <img src="the_background.jpeg">

                            <div class="card">
                                  <div style="background-color: green;" class="card-header" >
                                    <h5 style="text-align: center;">Find The Room To Rent In SA</h5>
                                  </div>
                                  <div class="card-body">
                                    <div class="container">

                                    <h6>Select  a Better Place To Stay In The Whole SA With Few Clicks</h6>

                                        <div class="row">
                                            <form class="col-md-8" action="index.php" method="POST" id="find_room_form">
                                                <label >Province</label>
                                                <select name="province" class="form-control select2">
                                                  <option value="Gauteng">Gauteng</option> 
                                                  <option value="North West">North West</option> 
                                                  <option value="Mpumalanga">Mpumalanga</option> 
                                                  <option value="KwaZulu-Natal">KwaZulu-Natal</option> 
                                                  <option value="Limpopo">Limpopo</option> 
                                                  <option value="Northern Cape">Northern Cape</option> 
                                                  <option value="Eastern Cape">Eastern Cape</option>
                                                  <option value="Western Cape">Western Cape</option>
                                                  <option value="Free State">Free State</option>
                                                </select>
                                                <label for="location" style="margin-top:10px;">Location</label>
                                                <input type="location" class="form-control" name="location" aria-describedby="location" placeholder="Enter Location" maxlength="50">    
                                                
                                                <label for="section" style="margin-top:10px;">Section</label>
                                                <input type="section" has-success class="form-control" name="section" aria-describedby="section" placeholder="Enter Section" maxlength="50">
                                                
                                              </form>
                                        </div>
                                        <button type="submit" form="find_room_form" value="Submit" style="margin-top:-10px;margin-bottom:-20px;" class="btn btn-success btn-l">Find</button>

                                      </div>
                                  </div>
                            </div>


                          <!-- Jumbotron -->

                      <div class="the_jumbotron" style="text-align: center;">
                                  <div class="container-fluid">
                                        <div class="row jumbotron">
                                            
                                                <p >
                                                    We are playing a role to assist community in South Africa to find the rooms to rent faster
                                                    and to assist the landlords to find the rental faster for the whole 9 provinces in South Africa 
                                                    , so what are you waiting for, unpload your room for free of charge, 
                                                    because we can make it an open source.
                                                </p>
                                          
                                        </div>
                                  </div>
                      </div>

                <!-- footer -->

                <footer>
                <div class="the_footer">
                          <div class="row text-center">
                              <div class="col-md-4">
                                  
                                  <div class="the_provices">
                                    <hr class="light">
                                        <h5>Provinces</h5>
                                    <hr class="light">
                                  </div>
                                  
                                  <p>Gauteng</p>
                                  <p>North West</p>
                                  <p>Mpumalanga</p>
                                  
                              </div>

                              <div class="col-md-4">
                                  <div class="the_provices">
                                    <hr class="light">
                                        <h5>Provinces</h5>
                                    <hr class="light">
                                  </div>
                                  <p>KwaZulu-Natal</p>
                                  <p>Eastern Cape</p>
                                  <p>Limpopo</p>
                              </div>

                              <div class="col-md-4">
                                  <div class="the_provices">
                                    <hr class="light">
                                        <h5>Provinces</h5>
                                    <hr class="light">
                                  </div>
                                  <p>Northern Cape</p>  
                                  <p>Eastern Cape</p>
                                  <p>Western Cape</p>
                              </div>   

                              <div class="col-12">
                                  <hr class="light">
                                  <h5>&copy;The Residence.co.za</h5>
                              </div>

                          </div>
       

                  </div>
                </footer>

      </div>

</body>
</html>

<?php

   if(isset($_POST['province']) && isset($_POST['location']) && isset($_POST['section'])){

          $province = htmlentities($_POST['province']);
          $location = htmlentities($_POST['location']);
          $section = htmlentities($_POST['section']);

          if(!empty($province) && !empty($location) && !empty($section)){

                    @$match_all = "SELECT `address` FROM `uploadroom` WHERE (`province`='$province' AND `location`='$location' AND `section`='$section')";


                    @$match_province_location = "SELECT `address` FROM `uploadroom` WHERE (`province`='$province' AND `location`='$location')";
                     
                    @$query_run_province_location = mysqli_query($mysqli_connect,$match_province_location);

                    if(mysqli_num_rows($query_run_province_location)>=1){  

                                $_SESSION['province'] = $province;
                                $_SESSION['location'] = $location;
                                $_SESSION['section'] = $section;
                                
                                header('Location:rooms.php');	
                      
                    }else{
                          $message= "Sorry they is no match for selected criteria.";
                          $module = "index";
                          alertFuction($message,$module);
              
                    }
          }else{
              $message= "please fill all the fields.";
              $module = "index";
              alertFuction($message,$module);
          }

   }

   function alertFuction($message,$module){

    include 'alert.php';

    alertUser($message,$module );

   }

?>
