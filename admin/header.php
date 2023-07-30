<?php 
@ob_start();
session_start();

require "../conf/config.php";
?>


<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta name="author" content="JSI Software Solutions">
    

    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link rel="shortcut icon" href="https://imgs.search.brave.com/jmajY8eOGWXhyT68Lwxolb70B34ZmIZZMrke04OIuIo/rs:fit:474:225:1/g:ce/aHR0cHM6Ly90c2U0/Lm1tLmJpbmcubmV0/L3RoP2lkPU9JUC5W/amdQTmtaeTNVRElF/a19XU29lX2pRSGFI/YSZwaWQ9QXBp" />



    <title>Admin Dashboard | Lift UP</title>

    <link href="Files/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


</head>






<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="main.php">
                    <center>
                       <img src="https://imgs.search.brave.com/jmajY8eOGWXhyT68Lwxolb70B34ZmIZZMrke04OIuIo/rs:fit:474:225:1/g:ce/aHR0cHM6Ly90c2U0/Lm1tLmJpbmcubmV0/L3RoP2lkPU9JUC5W/amdQTmtaeTNVRElF/a19XU29lX2pRSGFI/YSZwaWQ9QXBp" width="80" height="80"  alt="logo" />
                       <br>
                       Admin Liftup
                   </center>
                </a>




                <ul class="sidebar-nav">
                   
                       <?php if(!isset($_SESSION['username']))
                       {
                        ?>

                         <li class="sidebar-item">
                        <a class="sidebar-link" href="login.php"> <i class="fa fa-user"></i> Admin Login </a>
                         </li>

                         <?php
                         }
                        
                         if(isset($_SESSION['username']))

                          {
                         ?>

                         <li class="sidebar-item">
                        <a class="sidebar-link" href="index.php"> <i class="fa fa-dashboard"></i> Home </a>
                         </li>

                         <li class="sidebar-item">
                        <a class="sidebar-link" href="logout.php" onclick="return confirm('Are You Sure Want to Logout ?')"> <i class="fa fa-power-off"></i> Logout </a>
                         </li>

                         <?php
                          }
                          ?>

                 

                 
                </ul>




                
            </div>
        </nav>



        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        
                  
                    </ul>
                </div>
            </nav>






<style type="text/css">
    table,tr,th,td{padding: 7px 7px 7px 7px;}

    .card{padding: 2px 2px 2px 2px !important;}

    
   .table-Normal {
    position: relative;
    display: block !important;
    margin: 10px auto;
    padding: 0;
    width: 100%;
    height: auto;
    border-collapse: collapse;
    text-align: center;
    overflow-x: auto;
    white-space: nowrap;
    text-align: left;
}
</style>




