<?php require 'header.php';?>

<style type="text/css">
  .mb-5 {margin-bottom: 1rem !important;}
</style>


<center>  Driver Registration</center>


<form action="" method="POST">

  <div class="form-outline mb-4">
                    
                    <input type="text" onkeypress="return /[a-z A-Z]/i.test(event.key)"  name="name" required class="form-control"
                      placeholder="Enter your full name" /> <br>

                    
                    <input type="text" onkeypress="return /[0-9]/i.test(event.key)" maxlength="10" name="mobile" required class="form-control"
                      placeholder="Enter your Mobile Number" /><br>


                      <input type="email"  name="email" onkeypress="return /[0-9 a-z A-Z @ .]/i.test(event.key)" required class="form-control"
                      placeholder="Enter Email" /><br>

                      
                   Gender:  &emsp;&emsp;
                    <input type="radio"  name="gender" value="Male" required /> Male &emsp;&emsp;
                    
                    <input type="radio"  name="gender" value="Female" required />   Female<br><br>

                      <input type="text"  name="dl_no" onkeypress="return /[0-9 A-Z]/i.test(event.key)" required class="form-control"
                      placeholder="Enter Driving License No." /><br>


                      <input type="text"  name="vehicle_no" onkeypress="return /[0-9 A-Z]/i.test(event.key)" required class="form-control"
                      placeholder="Enter vehicle No." /><br>

                    
                    <input type="password"  name="pass" required class="form-control"
                      placeholder="Enter password" /><br>

            
                    <input type="password"  name="confirm_pass" required class="form-control"
                      placeholder="Re-enter password" /><br>

                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit"  name="driver_registraion"
                       >Submit</button>


                  </div>

             </form>

<?php 
if (isset($_POST['driver_registraion'])) 
{
   if ($_POST['pass']!=$_POST['confirm_pass']) 
    {echo'<script type="text/javascript">alert("Password Not Matched");history.go(-1);</script>';}


  

    if ($_POST['pass']==$_POST['confirm_pass']) 
    {
          $qry = mysqli_query($db,"select * from a_driver_login where username ='".$_POST['mobile']."'");
            $data = mysqli_fetch_array($qry);

            if ($data['username']==$_POST['mobile']) 
                {echo'<script type="text/javascript">alert("'.strtolower($_POST['mobile']).' already registered.");history.go(-1);</script>';} 

              else{
                $sql="INSERT INTO a_driver_login (username,password) VALUES ('".$_POST['mobile']."','".password_hash($_POST['confirm_pass'], PASSWORD_DEFAULT)."') ";
                $run=mysqli_query($db,$sql);
              }

     }




    if ($run) 
      {
          $sql2="INSERT INTO driver_details (name,mobile,email,gender,dl_no,vehicle_no) VALUES ('".$_POST['name']."','".$_POST['mobile']."','".$_POST['email']."','".$_POST['gender']."','".$_POST['dl_no']."','".$_POST['vehicle_no']."') ";

            mysqli_query($db,$sql2);

            echo'<script type="text/javascript">alert("Registration Successfull");window.location.href="../login.php";</script>';
           // header('Location:../login.php');

      }


}



require 'footer.php';
?>