<?php
   function alertUser($message,$module){

         if ($module == "uploadroom"){

         
?>
         <div style="margin-left: 550px;">

                     <div style="text-align:center;margin-top:-1100px; width:400px;height:50px" class = "alert alert-success alert-dismissable">
                                 <button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">
                                       &times;
                                 </button>
                                 <p><?php echo $message; ?></p>
                                 
                     </div>

            </div>
<?php

         }elseif($module =="index"){
?>
          <div class="container-fluid">

               <!-- <div style="text-align:center;" class = "alert alert-success alert-dismissable">
                           <button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">
                                 &times;
                           </button>
                           <p><?php echo $message; ?></p>
                           
               </div> -->

         </div>


<?php
         }
   }

?>