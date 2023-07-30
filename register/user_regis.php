<?php require 'header.php';?>


<center>  User Registration</center>

<form action="" method="POST">

                    <input type="text"  name="name" onkeypress="return /[a-z A-Z ]/i.test(event.key)" required class="form-control"
                      placeholder="Enter your full name" /> <br>

                    
                    <input type="text" onkeypress="return /[0-9]/i.test(event.key)" maxlength="10"  name="mobile" required class="form-control"
                      placeholder="Enter your Mobile Number" /><br>


                      <input type="email"  name="email" onkeypress="return /[0-9 a-z . @]/i.test(event.key)" required class="form-control"
                      placeholder="Enter email" /><br>

                      
                   Gender:  &emsp;&emsp;
                    <input type="radio"  name="gender" value="Male" required /> Male &emsp;&emsp;

                    <input type="radio"  name="gender" value="Female" required />   Female<br><br>

                    
                    <input type="password"  name="pass" required class="form-control"
                      placeholder="Enter password" /><br>

            
                    <input type="password"  name="confirm_pass" required class="form-control"
                      placeholder="Re-enter password" /><br>

                    <input class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit"  name="user_registration"  >


                  

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
          $sql2="INSERT INTO user_details (name,mobile,email,gender) VALUES ('".$_POST['name']."','".$_POST['mobile']."','".$_POST['email']."','".$_POST['gender']."') ";

            mysqli_query($db,$sql2);

           
            echo'<script type="text/javascript">alert("Registration Successfull");window.location.href="../login.php";</script>';

      }


}



require 'footer.php';
?>