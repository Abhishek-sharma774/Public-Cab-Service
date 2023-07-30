<?php require'../register/header.php';?>
<form action="validate_pass.php" method="POST">
                  
                  <div class="form-outline mb-4">
                   
                    <input type="email" id="form2Example11" autocomplete="false" name="email" required class="form-control"
                      placeholder="email address" />
                    
                  </div>
<div class="text-center pt-1 mb-5 pb-1">
                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" name="send_otp" type="submit">Get OTP
                 </button>
                  </div>
                    
                 

             </form>


<?php require'../register/footer.php';?>