<?php require 'header.php';?>

                <form action="" method="POST">
                  
                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example11">Registration Type:<?php echo astri();?></label>
                    

                    <select name="regis_type" required class="form-control">
                      <option value="">--Select--</option>
                      <option value="user">User</option>
                      <option value="driver">Driver</option>
                      
                    </select>
                    
                  </div>

                    
                 <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" name="send_otp">Register</button>

             </form>

              
<?php

if (isset($_POST['send_otp'])) 
{
   if ($_POST['regis_type']=='user') 
   {
     header('Location: user_regis.php');
   }


   if ($_POST['regis_type']=='driver') 
   {
     header('Location: driver_regis.php');
   }
}


 require'footer.php'?>