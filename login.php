<?php

// Initialize the session

ini_set('session.gc_maxlifetime', 3600);

session_start();

 

// Check if the user is already logged in, if yes then redirect him to welcome page

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){

  header("location: dashboard.php");

  exit;

}

 

// Include config file

require"conf/config.php";
 

// Define variables and initialize with empty values

$username = $password = "";

$username_err = $password_err = "";

 

// Processing form data when form is submitted

if($_SERVER["REQUEST_METHOD"] == "POST"){

 


    // Check if username is empty

    if(empty(trim($_POST["username"]))){

        $username_err = "Please enter username.";

    } else{

        $username = trim($_POST["username"]);

    }

    

    // Check if password is empty

    if(empty(trim($_POST["password"]))){

        $password_err = "Please enter your password.";

    } else{

        $password = trim($_POST["password"]);

    }

    

    // Validate credentials

    if(empty($username_err) && empty($password_err)){


      $table=$_POST['role'];

        // Prepare a select statement

        $sql = "SELECT id, username, password FROM a_".$table."_login WHERE username = ?";

        

        if($stmt = mysqli_prepare($db, $sql)){

            // Bind variables to the prepared statement as parameters

            mysqli_stmt_bind_param($stmt, "s", $param_username);

            

            // Set parameters

            $param_username = $username;

            

            // Attempt to execute the prepared statement

            if(mysqli_stmt_execute($stmt)){

                // Store result

                mysqli_stmt_store_result($stmt);

                

                // Check if username exists, if yes then verify password

                if(mysqli_stmt_num_rows($stmt) == 1){                    

                    // Bind result variables

                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

                    if(mysqli_stmt_fetch($stmt)){

                        if(password_verify($password, $hashed_password)){

                            // Password is correct, so start a new session

                            session_start();

                            

                            // Store data in session variables

                            $_SESSION["loggedin"] = true;

                            $_SESSION["username"] = $username; 

                            $_SESSION["role"] = $table; 



  header("location: dashboard.php");


                           

                        } else{

                            // Display an error message if password is not valid

                            $password_err = "<b class='text-danger'>Incorrect Password .....!</b>";

                        }

                    }

                } else{

                    // Display an error message if username doesn't exist

                    $username_err = "<b>".$username. "</b> is not Registered/Found. for <u>".ucwords($table).'</u> login';




                          

                }

            } else{

                echo "Oops! Something went wrong. Please try again later.";

            }



            // Close statement

            mysqli_stmt_close($stmt);

        }

    }

    

    // Close connection

    mysqli_close($db);

}

?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <style type="text/css">
  .gradient-custom-2 {
/* fallback for old browsers */
background: #fccb90;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
}

@media (min-width: 768px) {
.gradient-form {
height: 100vh !important;
}
}
@media (min-width: 769px) {
.gradient-custom-2 {
border-top-right-radius: .3rem;
border-bottom-right-radius: .3rem;
}
}
.text-centre{
  padding:centre;
  height:50px;
  width:50px;
}
</style>
</head>
<body>

<section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-3 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black" style="border-radius: 30px !important;">
          <div class="row g-0">
            <div class="col-lg-6" >
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="https://imgs.search.brave.com/jmajY8eOGWXhyT68Lwxolb70B34ZmIZZMrke04OIuIo/rs:fit:474:225:1/g:ce/aHR0cHM6Ly90c2U0/Lm1tLmJpbmcubmV0/L3RoP2lkPU9JUC5W/amdQTmtaeTNVRElF/a19XU29lX2pRSGFI/YSZwaWQ9QXBp"
                    style="width: 185px;" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1">You require, We acquire!!</h4>
                </div>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                  
                  <div class="form-outline mb-4 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    
                    <input type="text" onkeypress="return /[0-9]/i.test(event.key)" maxlength="10"  name="username" id="form2Example11" class="form-control"
                      placeholder="Phone number " required />
                      <br>
                      <span class="help-block text-danger"><?php echo $username_err; ?></span>
                    
                  </div>

                  <div class="form-outline mb-4 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    
                    <input type="password" id="form2Example22" class="form-control" name="password" required placeholder="Password" />

                      <br>

                                    <span class="help-block text-danger"><?php echo $password_err; ?></span>
                    
                  </div>

                  <div class="form-outline mb-4">
                    
                    <select name="role" required class="form-control">
                      <option value="">--Select Role---</option>
                      <option value="driver">Driver</option>
                      <option value="user">User</option>
                    </select>
                    
                  </div>

                   <div class="form-outline mb-4">
                    
                    <input type="checkbox" name="remember_me"> Remember Me
                    
                  </div>



                  <div class="text-center pt-1 mb-5 pb-1">
                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" >Log
                      in</button>


                    <a class="text-muted" href="forgot_pass">Forgot password?</a>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Don't have an account?</p>
                    <a href="register">Sign up</a>
                  </div>

                </form>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2" style="background-image: url('https://imgs.search.brave.com/wojekD-eEd54qLqY6Op21Gs9mf6cWFlHGcyewZGCpsU/rs:fit:640:360:1/g:ce/aHR0cHM6Ly9tZWRp/YS5nZXR0eWltYWdl/cy5jb20vdmlkZW9z/L2hpdGNoaGlrZXIt/dmlkZW8taWQ2MjQ3/MDQ4MjI_cz02NDB4/NjQw'); background-repeat: no-repeat ; background-size: cover;">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 style="color:goldenrod;" class="mb-4">YOU REQUIRE,WE ACQUIRE</h4>
                <p class="small mb-0">A broadcast service to the public for thier convenient journey with the saving of their time.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
