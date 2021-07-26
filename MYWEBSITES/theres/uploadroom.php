<?php

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


  <!---  File upload -->

  <link rel="stylesheet" type="text/css" href="css/file-upload.css" />
  <script src="js/file-upload.js"></script>
  <script type="text/javascript">
      $(document).ready(function() {
          $('.file-upload').file_upload();
      });
  </script>

<!---  File upload -->
  
</head>
<body>

        <div class="container-fluid">
                    <!-- Navigation  -->

                    <nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
                      <div class="container-fluid">
                        <a class="navbar-brand" href="index.php"><img src="comp.png" width="100px" height="100px"/></a>
                        <button type="button" class="navbar-toggler"  data-toggle="collapse" data-target="#navbarResponsive"> 
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarResponsive">
                          <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                              <a class="nav-link" style="color: blue;" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" style="text-decoration:underline;color:red;" href="uploadroom.php">Upload Room</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" style="color: blue;" href="aboutus.php">About Us</a>
                            </li>
                          </ul>
                        </div>

                      </div>
                    </nav>

                    <!-- Image Slider -->
                    <div>
                    <img src="the_background.jpeg" style="width:1440px; height:600px;">
                                <div class="the_card" style="margin-top:-40px;margin-bottom:-10px;"> 

                                  <div class="card" style="height:430px; margin-top:40px;">
                                    <div style="background-color: green;" class="card-header" >
                                      <h5 style="text-align: center;">Landlord To Upload The Room</h5>
                                    </div>
                                    <div class="card-body">
                                      <h6>Tech That Provide You With A Way To Find Tenants With Few Clicks</h6>
                                      <div style="margin-top:-30px;" class="container">
                                          <div class="row">
                                              <form action="uploadroom.php" method="POST" id="upload_room_form" enctype="multipart/form-data">
                                                    <div class="form-row">
                                                            
                                                          <div class="form-group col-md-6">
                                                              <label >Province</label>
                                                              <select style="width: 233px;" name="province" class="form-control select2">
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
                                                          </div>

                                                          <div class="form-group col-md-6">
                                                              <label for="location" >Location</label>
                                                              <input style="width: 233px;" type="text" class="form-control" name="location" aria-describedby="location" placeholder="Enter Location" maxlength="50">  
                                                          </div>

                                                    </div>
                                                  
                                                    
                                                    <div class="form-row" style="margin-top:-50px;">

                                                          <div class="form-group col-md-6">
                                                              <label for="section" >Section</label>
                                                              <input style="width: 233px;" type="text" has-success class="form-control" name="section" aria-describedby="section" placeholder="Enter Section" maxlength="50">   
                                                          </div>

                                                          <div class="form-group col-md-6">
                                                              <label for="address" >Address</label>
                                                              <input style="width: 233px;" type="text" has-success class="form-control" name="address" aria-describedby="address" placeholder="Enter Address" maxlength="50">   
                                                          </div>

                                                    </div>


                                                    <div class="form-row" style="margin-top:-50px;">
                                                          <div class="form-group col-md-6">
                                                              <label for="price" >Price R:</label>
                                                              <input style="width: 233px;" type="number" has-success class="form-control" name="price" aria-describedby="price" placeholder="Enter Price" maxlength="10">   
                                                          </div>

                                                          <div class="form-group col-md-6">
                                                              <label for="contact" >Contact</label>
                                                              <input style="width: 233px;" type="tel" has-success class="form-control" name="contact" aria-describedby="price" placeholder="Enter Contact" maxlength="10">  
                                                          </div>
                                                    </div>

                                                    <div class="form-row" style="margin-top:-50px;">
                                                          <div class="form-group col-md-6">
                                                                <label for="contact" >Room Type</label>
                                                                  <select style="width: 233px;" name="roomtype" class="form-control select2">
                                                                    <option value="Single Room">Single Room</option> 
                                                                    <option value="Double Room">Double Room</option> 
                                                                  </select>  
                                                          </div>

                                                          
                                                          <div class="form-group col-md-6">
                                                              <div class="col-sm-6" >
                                                                  <label style="margin-top:0px;" for="contact" >Upload</label>
                                                                  <div class="file-upload btn btn-success" style="width:240px;">
                                                                      <input type="file" name="image"/>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                    </div>
                                                    
                                              </form>
                                              
                                          </div>
                                          <button type="submit" form="upload_room_form" value="Submit" style="margin-top:-25px;margin-left:-35px;" class="btn btn-success btn-l">Submit</button>
                                        </div>                  
                                      </div>
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
                          <div class="container-fluid padding">
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

                      </div>
                    </footer>

        </div>
</body>
</html>










<?php

     if(isset($_POST['province']) && isset($_POST['location']) && isset($_POST['section']) && isset($_POST['address']) &&
       isset($_POST['price']) && isset($_POST['contact']) && isset($_POST['roomtype'])){

                  $province = htmlentities($_POST['province']);
                  $location = htmlentities($_POST['location']);
                  $section = htmlentities($_POST['section']);
                  $address = htmlentities($_POST['address']);
                  $price = htmlentities($_POST['price']);
                  $contact = htmlentities($_POST['contact']);
                  $roomtype = htmlentities($_POST['roomtype']);

                  @$imagename = $_FILES['image']['name'];
                  @$imageurl = $_FILES['image']['tmp_name'];

                  $extension = array('jpg','png','gif','jpeg','tif');

                  $randomNumber = strval(rand(1,1000000));  #This thing is to try to make an image unique

                  $the_imagename = $randomNumber.$imagename;

                  $image_dir = "webimage/".$the_imagename;

                  $file_ext = trim(strtolower(explode('.',$imagename)[1])); #get image extension


                  if(in_array($file_ext,$extension)){

                        if(!empty($province) && !empty($location) && !empty($section) && !empty($address) && !empty($price) && !empty($contact) 
                                                      && !empty($roomtype) && !empty($imagename) && !empty($imageurl)){

                              if(move_uploaded_file($imageurl,$image_dir)){

                                          @$query  = "INSERT INTO `uploadroom` (`id`,`province`,`location`,`section`,`address`,`price`,`contact`,`roomtype`,`imagename`) VALUES (NULL,'$province','$location','$section','$address','$price','$contact','$roomtype','$the_imagename');";
                                                
                                          @$query_run = mysqli_query($mysqli_connect,$query); 
                                          if($query_run){
                                              $message= "uploaded successfully.";
                                              $module = "uploadroom";
                                              alertFuction($message,$module);
            
                                          }else{
                                            $message= "upload not successful, please try later.";
                                            $module = "uploadroom";
                                            alertFuction($message,$module);
                                    
                                        }
                              }else{
                                $message= "upload not successful, please try later.";
                                $module = "uploadroom";
                                alertFuction($message,$module);
                              }                         
                              

                        }else{
                          $message= "please fill all the fields, and choose image.";
                          $module = "uploadroom";
                          alertFuction($message,$module);
                  
                      }

                  }else{

                        $message= "We allow image of type jpg,png,gif,jpeg,tif";
                        $module = "uploadroom";
                        alertFuction($message,$module);

                  }

     }

     function alertFuction($message,$module){

        include 'alert.php';

        alertUser($message,$module);

     }

?>
