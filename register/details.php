<?php require 'header.php';


if (isset($_POST['send_otp'])) 
{
  $regis_type=$_POST['regis_type'];
}



if ($regis_type=='user') 
{

  
?>

<center>  <?php echo ucwords($regis_type); ?> Registration</center>

<form action="" method="POST">

                    <input type="text"  name="name" required class="form-control"
                      placeholder="Enter your full name" /> <br>

                    
                    <input type="number"  name="moible" required class="form-control"
                      placeholder="Enter your Mobile Number" /><br>


                      <input type="email"  name="email" required class="form-control"
                      placeholder="Enter email" /><br>

                      
                   Gender:  &emsp;&emsp;
                    <input type="radio"  name="gender" value="Male" required /> Male &emsp;&emsp;

                    <input type="radio"  name="gender" value="Female" required />   Female<br><br>

                    
                    <input type="password"  name="pass" required class="form-control"
                      placeholder="Enter password" /><br>

            
                    <input type="password"  name="confirm_pass" required class="form-control"
                      placeholder="Re-enter password" /><br>

                    <input class="btn btn-primary " type="submit"  name="user_registration"  >


                  

             </form>


<?php 
if (isset($_POST['user_registration'])) 
{
   if ($_POST['pass']!=$_POST['confirm_pass']) 
    {echo'<script type="text/javascript">alert("Password Not Matched");history.go(-1);</script>';}


  

    if ($_POST['pass']==$_POST['confirm_pass']) 
    {
          $qry = mysqli_query($db,"select * from a_user_login where username ='".$_POST['mobile']."'");
            $data = mysqli_fetch_array($qry);

            if ($data['username']==$_POST['mobile']) 
                {echo'<script type="text/javascript">alert("'.strtolower($_POST['mobile']).' already registered.");history.go(-1);</script>';} 
                 
              else{
                $sql="INSERT INTO a_user_login (username,password) VALUES ('".$_POST['mobile']."','".password_hash($_POST['confirm_pass'], PASSWORD_DEFAULT)."') ";

                $run=mysqli_query($db,$sql);}

     }




    if ($run) 
      {
          $sql2="INSERT INTO user_details (name,mobile,email,gender) VALUES ('".$_POST['name']."','".$_POST['mobile']."','".$_POST['gender']."') ";

            mysqli_query($db,$sql2);

            echo'<script type="text/javascript">alert("Registration Successfull");</script>';
            header('Location:../login.php');

      }


}

?>




<?php 
}

if ($regis_type=='driver') 
{
?>




<center>  <?php echo ucwords($_POST['regis_type']); ?> Registration</center>


<form action="" method="POST">

  <div class="form-outline mb-4">
                    
                    <input type="text"  name="name" required class="form-control"
                      placeholder="Enter your full name" /> <br>

                    
                    <input type="number"  name="mobile" required class="form-control"
                      placeholder="Enter your Mobile Number" /><br>


                      <input type="email"  name="email" required class="form-control"
                      placeholder="Enter Email" /><br>

                      
                   Gender:  &emsp;&emsp;
                    <input type="radio"  name="gender" value="Male" required /> Male &emsp;&emsp;
                    
                    <input type="radio"  name="gender" value="Female" required />   Female<br><br>

                      <input type="text"  name="dl_no" required class="form-control"
                      placeholder="Enter Driving License No." /><br>


                      <input type="text"  name="vehicle_no" required class="form-control"
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
          $sql2="INSERT INTO driver_details (name,mobile,email,gender,dl_no,vehicle_no) VALUES ('".$_POST['name']."','".$_POST['mobile']."','".$_POST['gender']."','".$_POST['dl_no']."','".$_POST['vehicle_no']."') ";

            mysqli_query($db,$sql2);

            echo'<script type="text/javascript">alert("Registration Successfull");</script>';
            header('Location:../login.php');

      }


}

?>












<?php } 


require'footer.php';?>