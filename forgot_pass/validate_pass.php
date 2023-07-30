<?php require'../register/header.php';

if (isset($_POST['send_otp'])) 
{
	#$email=$_POST['email'];
}
?>

 <form action="validate_pass.php" method="POST">
                  
                 <p style="font-size: 14px; color:green;"> OTP Delivered to <?php echo $_POST['email']; ?></p>
                  <div class="form-outline mb-4">
               
                 
                    <input type="number" id="form2Example11" required class="form-control"
                      placeholder="Enter OTP" />
                    
                  </div>

                    
                 <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Validate</button>

             </form>



<?php require'../register/footer.php';?>
