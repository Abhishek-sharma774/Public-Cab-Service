<?php require'header.php';


// Check if the user is already logged in, if yes then redirect him to welcome page

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){

  header("location: dashboard.php");

  exit;

}

 

// Include config file

 

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



        // Prepare a select statement

        $sql = "SELECT id, username, password FROM admin_login WHERE username = ?";

        

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



                            header("location: dashboard.php");

                        } else{

                            // Display an error message if password is not valid

                            $password_err = "<img src='https://i.giphy.com/media/26n6V8pFcFlxl6XhS/giphy.webp' width='50' height='50'> <b class='text-danger'>Incorrect Password .....!</b>";


                        }

                    }

                } else{

                    // Display an error message if username doesn't exist

                    $username_err = " <img src='https://1.bp.blogspot.com/_mPhwr-H60ks/TN3Ju2t_IkI/AAAAAAAAAGM/Yuzs7Xbd5jw/s1600/donald+duck+angry.gif' width='50' height='50'> &emsp; <font color='red'> <b>".$username. "</b> is not authorized for login</font>";


                

                }

            } else{

                echo "Oops! Something went wrong. Please try again later.";

            }



            // Close statement

            mysqli_stmt_close($stmt);

        }

    }
}
    

    // Close connection

    mysqli_close($db);



?>

 

            <main class="content">
                <div class="container-fluid p-0">

                   <center> <h1 class="h3 mb-3"><strong>Admin Login <i class="fa fa-sign-in"></i></strong></h1></center>

                   


                    <div class="row">



                        <div class="col-md-12" style="display: flex; justify-content: center; align-items: center; ">
                            <div class="card">
                                <div class="card-header bg-info text-white text-center"> Login</div>

                                <div class="card-body">

                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" autocomplete="off">
                                        <table style="width:100%">
                                            <tr>
                                                <th class="<?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                                    <input type="text" name="username" placeholder="Username"  value="<?php echo $username; ?>" required class="form-control"><br>

                                                     <span class="help-block"><?php echo $username_err; ?></span>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th class="<?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">

                                                    <input type="password" name="password" placeholder="Password" required class="form-control"><br>
                                                    <span class="help-block"><?php echo $password_err; ?></span>

                                                </th>
                                            </tr>

                                            <tr>
                                                <th><button style="float:right;" type="submit" name="submit" class="btn btn-primary">Login</button></th>
                                            </tr>
                                        </table>
                                    </form>

                                    
                                </div>
                            </div>
                        </div>

                        










                 </div>













                </div>
            </main>



<style type="text/css">
    .card-body{padding: 2px 2px 2px 2px;}


</style>

<?php require 'footer.php';?>