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
           <a class="nav-link" style="color: blue;" href="uploadroom.php">Upload Room</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" style="color: blue;" href="aboutus.php">About Us</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" style="text-decoration:underline;color:red;" href="rooms.php">Rooms</a>
         </li>
       </ul>
     </div>

  </div>
</nav>

<!-- Image Slider -->

<div class="the_images">

            
            <img src="the_background.jpeg" style="width:1440px; height:500px;">

            <div style="margin-top:-480px; margin-left:10px;">
                  <div class="room_provice_location">
                                
                          <h3><?php echo $_SESSION['province'] ?>&ensp;Province&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $_SESSION['location']?>&ensp;Section</h3>
        
                  </div>
                   
                  <div style="height:450px;width:1420px;border:0px solid #ccc;overflow:auto;">

<?php                       
                                  $province = $_SESSION['province'];
                                  $location = $_SESSION['location']; 
                                  $section = $_SESSION['section'];

                                  @$match_all = "SELECT `address`,`price`,`contact`,`roomtype`,`imagename` FROM `uploadroom` WHERE (`province`='$province' AND `location`='$location' AND `section`='$section')";


                                  @$match_province_location = "SELECT `section`,`address`,`price`,`contact`,`roomtype`,`imagename` FROM `uploadroom` WHERE (`province`='$province' AND `location`='$location')";
                                  
                                  $query_run_match_all = mysqli_query($mysqli_connect,$match_all); 
                                  $query_run_province_location = mysqli_query($mysqli_connect,$match_province_location); 
                                  
                                  $total_elements_of_array_match_all = mysqli_num_rows($query_run_match_all);
                                  $total_elements_of_array_province_location = mysqli_num_rows($query_run_province_location);

                                  $card_alignment = 170;
                                  $card_alignment_count = 1;

                                  if(mysqli_num_rows($query_run_match_all)>=1){

                                         $counter = 1;
                          
                                          while($query_row = mysqli_fetch_assoc($query_run_match_all)){
                                            $the_address = $query_row['address'];
                                            $the_price = $query_row['price'];
                                            $the_contact = $query_row['contact'];
                                            $the_roomtype = $query_row['roomtype'];
                                            $the_imagename = $query_row['imagename'];
                                            
                                                if($counter == 1){

                                                  if($card_alignment_count == 1){
                                                       $card_alignment_count = $card_alignment_count +1;
                                                  }elseif($card_alignment_count != 1){
                                                       
                                                       if($card_alignment == 170){
                                                           $card_alignment = $card_alignment + 200;
                                                       }
                                                  }

                                                    

?>
                                                         <div class="row" style="margin-top:<?php echo $card_alignment."px"?>;">
<?php
                                                }
                                                        
?>
                                                          <div class="col-sm-4">
                                                              
                                                                    <div class="card" style="width:450px; height:400px;">
                                                                                  <div style="background-color: green;padding-bottom:0px; " class="card-header" >
                                                                                    <h6 style="color:white">Address:&ensp;<?php echo $the_address?></h6>
                                                                                    <h6 style="color:white">Price: R<?php echo $the_price?></h6>
                                                                                    <h6 style="color:white">Contact:&ensp;<?php echo $the_contact?></h6>
                                                                                    <h6 style="color:white">Room Type:&ensp;<?php echo $the_roomtype?></h6>
                                                                                  </div>
                                                                                  
                                                                                  <div class="card-body" style="padding:0px; ">
                                                                                      <img class="card-img-bottom" src="webimage/<?php echo $the_imagename ?>" alt="Card image cap" >
                                                                                  </div>
                                                                    </div>
                                                              
                                                          </div>
                                                          
<?php
                                                if($total_elements_of_array_match_all == 2 && $counter == 1){
                                                    $unknowvaluenumbercounter = 0;
                                                }
                                                elseif($total_elements_of_array_match_all == 1 || $total_elements_of_array_match_all == 2 || $counter == 3){
                                                  $total_elements_of_array_match_all = $total_elements_of_array_match_all -3;
                                                  
?>
                                                    </div>
<?php
                                                }
?>


<?php
                                                  if($counter !=3){
                                                    $counter = $counter + 1;
                                                  }else {
                                                    $counter = 1;
                                                  }

                                 
                                        }

                                        //   Retrive all the rooms except one populated already



                                                      $counter = 1;
                                                                  
                                                      while($query_row = mysqli_fetch_assoc($query_run_province_location)){
                                                        $the_section = $query_row['section'];
                                                        $the_address = $query_row['address'];
                                                        $the_price = $query_row['price'];
                                                        $the_contact = $query_row['contact'];
                                                        $the_roomtype = $query_row['roomtype'];
                                                        $the_imagename = $query_row['imagename'];
                                                        
                                                             
                                                             if($the_section == $section){
                                                                   continue;
                                                             }
                                                                        if($counter == 1){

                                                                                if($card_alignment_count == 1){
                                                                                  $card_alignment_count = $card_alignment_count +1;
                                                                                }elseif($card_alignment_count != 1){
                                                                                      
                                                                                      if($card_alignment == 170){
                                                                                          $card_alignment = $card_alignment + 200;
                                                                                      }
                                                                                }

                                                                  ?>
                                                                                  <div class="row" style="margin-top:<?php echo $card_alignment."px"?>;">
                                                                  <?php
                                                                        }
                                                                                
                                                                  ?>
                                                                                  <div class="col-sm-4">
                                                                                      
                                                                                            <div class="card" style="width:450px; height:400px;">
                                                                                                          <div style="background-color: green;padding-bottom:0px; " class="card-header" >
                                                                                                            <h6 style="color:white">Address:&ensp;<?php echo $the_address?></h6>
                                                                                                            <h6 style="color:white">Price: R<?php echo $the_price?></h6>
                                                                                                            <h6 style="color:white">Contact:&ensp;<?php echo $the_contact?></h6>
                                                                                                            <h6 style="color:white">Room Type:&ensp;<?php echo $the_roomtype?></h6>
                                                                                                          </div>
                                                                                                          
                                                                                                          <div class="card-body" style="padding:0px; ">
                                                                                                                <img class="card-img-bottom" src="webimage/<?php echo $the_imagename ?>" alt="Card image cap" >
                                                                                                          </div>
                                                                                            </div>
                                                                                      
                                                                                  </div>
                                                                                  
                                                                  <?php
                                                                        if($total_elements_of_array_province_location == 2 && $counter == 1){
                                                                            $unknowvaluenumbercounter = 0;
                                                                        }
                                                                        elseif($total_elements_of_array_province_location == 1 || $total_elements_of_array_province_location == 2 || $counter == 3){
                                                                          $total_elements_of_array_province_location = $total_elements_of_array_province_location -3;
                                                                          
                                                                  ?>
                                                                            </div>
                                                                  <?php
                                                                        }
                                                                  ?>


                                                                  <?php
                                                                          if($counter !=3){
                                                                            $counter = $counter + 1;
                                                                          }else {
                                                                            $counter = 1;
                                                                          }


                                                      }


                                        //End Of Retrive all the rooms except on populated already


                                    }elseif(mysqli_num_rows($query_run_province_location)>=1){

//===============

                                                      $counter = 1;
                                                    
                                                      while($query_row = mysqli_fetch_assoc($query_run_province_location)){
                                                        $the_address = $query_row['address'];
                                                        $the_price = $query_row['price'];
                                                        $the_contact = $query_row['contact'];
                                                        $the_roomtype = $query_row['roomtype'];
                                                        $the_imagename = $query_row['imagename'];

                                                        
                                                            if($counter == 1){

                                                                    if($card_alignment_count == 1){
                                                                      $card_alignment_count = $card_alignment_count +1;
                                                                }elseif($card_alignment_count != 1){
                                                                      
                                                                      if($card_alignment == 170){
                                                                          $card_alignment = $card_alignment + 200;
                                                                      }
                                                                }

                                                                


                                                      ?>
                                                                      <div class="row" style="margin-top:<?php echo $card_alignment."px"?>;">
                                                      <?php
                                                            }
                                                                    
                                                      ?>
                                                                      <div class="col-sm-4">
                                                                          
                                                                                <div class="card" style="width:450px; height:400px;">
                                                                                              <div style="background-color: green;padding-bottom:0px; " class="card-header" >
                                                                                                <h6 style="color:white">Address:&ensp;<?php echo $the_address?></h6>
                                                                                                <h6 style="color:white">Price: R<?php echo $the_price?></h6>
                                                                                                <h6 style="color:white">Contact:&ensp;<?php echo $the_contact?></h6>
                                                                                                <h6 style="color:white">Room Type:&ensp;<?php echo $the_roomtype?></h6>
                                                                                              </div>
                                                                                              
                                                                                              <div class="card-body" style="padding:0px; ">
                                                                                                    <img class="card-img-bottom" src="webimage/<?php echo $the_imagename ?>" alt="Card image cap" >
                                                                                              </div>
                                                                                </div>
                                                                          
                                                                      </div>
                                                                      
                                                      <?php
                                                            if($total_elements_of_array_province_location == 2 && $counter == 1){
                                                                $unknowvaluenumbercounter = 0;
                                                            }
                                                            elseif($total_elements_of_array_province_location == 1 || $total_elements_of_array_province_location == 2 || $counter == 3){
                                                              $total_elements_of_array_province_location = $total_elements_of_array_province_location -3;
                                                              
                                                      ?>
                                                                </div>
                                                      <?php
                                                            }
                                                      ?>


                                                      <?php
                                                              if($counter !=3){
                                                                $counter = $counter + 1;
                                                              }else {
                                                                $counter = 1;
                                                              }


                                                      }


                                                                                          



                                    }  


//============
?>
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


</body>
</html>
