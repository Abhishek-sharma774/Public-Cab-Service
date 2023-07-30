<?php
session_start();
date_default_timezone_set('Asia/Calcutta');




if(!isset($_SESSION['username']))
     {
        header('Location: login.php');
        session_destroy();
        exit;
     } 

    
#====================requiring files======================#

require'conf/config.php';
require'conf/email_config.php';


$api_key='AIzaSyAfXf-LQP9u9U_ErdoOw8ONByB50QRTT9A&libraries=places&callback=initMap';


if ($_SESSION['role']=='user') 
{
  $qry = mysqli_query($db,"select * from user_details where mobile ='".$_SESSION['username']."'");
  $data = mysqli_fetch_array($qry);
}

if ($_SESSION['role']=='driver') 
{
  $qry = mysqli_query($db,"select * from driver_details where mobile ='".$_SESSION['username']."'");
  $data = mysqli_fetch_array($qry);
}



if($data['mobile']==0)
     {
        header('Location: login.php');
        session_destroy();
        exit;
     } 



function msg($msg)
{echo'<script type="text/javascript">alert("'.$msg.'");history.go(-1);</script>';}

function yes()
{echo'<script type="text/javascript">history.go(-1);</script>';}
?>




<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    
    <title>Liftup</title>
    <link rel="apple-touch-icon" href="https://imgs.search.brave.com/jmajY8eOGWXhyT68Lwxolb70B34ZmIZZMrke04OIuIo/rs:fit:474:225:1/g:ce/aHR0cHM6Ly90c2U0/Lm1tLmJpbmcubmV0/L3RoP2lkPU9JUC5W/amdQTmtaeTNVRElF/a19XU29lX2pRSGFI/YSZwaWQ9QXBp">
    <link rel="shortcut icon" type="image/x-icon" href="https://imgs.search.brave.com/jmajY8eOGWXhyT68Lwxolb70B34ZmIZZMrke04OIuIo/rs:fit:474:225:1/g:ce/aHR0cHM6Ly90c2U0/Lm1tLmJpbmcubmV0/L3RoP2lkPU9JUC5W/amdQTmtaeTNVRElF/a19XU29lX2pRSGFI/YSZwaWQ9QXBp">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="Files/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="Files/app-assets/vendors/css/forms/toggle/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="Files/app-assets/css/plugins/forms/switch.min.css">
    <link rel="stylesheet" type="text/css" href="Files/app-assets/css/core/colors/palette-switch.min.css">
    <link rel="stylesheet" type="text/css" href="Files/app-assets/vendors/css/charts/chartist.css">
    <link rel="stylesheet" type="text/css" href="Files/app-assets/vendors/css/charts/chartist-plugin-tooltip.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="Files/app-assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Files/app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="Files/app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="Files/app-assets/css/components.min.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="Files/app-assets/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="Files/app-assets/css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="Files/app-assets/css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="Files/app-assets/css/pages/chat-application.css">
    <link rel="stylesheet" type="text/css" href="Files/app-assets/css/pages/dashboard-analytics.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="Files/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- END: Custom CSS-->
  <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_key; ?>" async defer></script>

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns" onload="initMap()">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light"> 
      <div class="navbar-wrapper">
        <div class="navbar-container content">
          <div class="collapse navbar-collapse show" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">

              <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="fa fa-bars"></i></a></li>

                          
            </ul>


            <ul class="nav navbar-nav float-right">         
             


              <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">             <span class="avatar avatar-online"><img src="https://imgs.search.brave.com/Rw5YSy1d5izkCgd-89TJ4zX-EgH8qXfDAgSzGdz0A5Y/rs:fit:1200:1200:1/g:ce/aHR0cHM6Ly93d3cu/MzY2aWNvbnMuY29t/L21lZGlhLzAxL3By/b2ZpbGUtYXZhdGFy/LWFjY291bnQtaWNv/bi0xNjY5OS5wbmc" alt="avatar"></span></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <div class="arrow_box_right">
                    <a class="dropdown-item" href="#"><span class="avatar avatar-online"><img src="https://imgs.search.brave.com/Rw5YSy1d5izkCgd-89TJ4zX-EgH8qXfDAgSzGdz0A5Y/rs:fit:1200:1200:1/g:ce/aHR0cHM6Ly93d3cu/MzY2aWNvbnMuY29t/L21lZGlhLzAxL3By/b2ZpbGUtYXZhdGFy/LWFjY291bnQtaWNv/bi0xNjY5OS5wbmc" alt="avatar"><span class="user-name text-bold-700 ml-1"><?php echo ucwords($data['name']) ?></span></span></a>

                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fa fa-user"></i> Edit Profile</a><a class="dropdown-item" href="#"><i class="fa fa-mail"></i> My Inbox</a><a class="dropdown-item" href="project-summary.html"><i class="fa fa-check-square"></i> Task</a><a class="dropdown-item" href="#"><i class="fa fa-message-square"></i> Chats</a>
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="logout.php"><i class="fa fa-power"></i> Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- END: Header-->









    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true" data-img="Files/app-assets/images/backgrounds/02.jpg">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mr-auto"><a class="navbar-brand" href="#"><img class="brand-logo" alt="logo" src="https://imgs.search.brave.com/jmajY8eOGWXhyT68Lwxolb70B34ZmIZZMrke04OIuIo/rs:fit:474:225:1/g:ce/aHR0cHM6Ly90c2U0/Lm1tLmJpbmcubmV0/L3RoP2lkPU9JUC5W/amdQTmtaeTNVRElF/a19XU29lX2pRSGFI/YSZwaWQ9QXBp"/>
              <h3 class="brand-text">Liftup</h3></a></li>
          <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="fa fa-times-circle-o"></i></a></li>
        </ul>
      </div>

      <div class="navigation-background"></div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


         <li class=" nav-item"><a href="index.php"><i class="fa fa-dashboard"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
          </li>

          <li class=" nav-item"><a href="history.php"><i class="fa fa-file-text"></i><span class="menu-title" data-i18n="">History</span></a>
          </li>

           <li class=" nav-item"><a href="settings.php"><i class="fa fa-cogs"></i><span class="menu-title" data-i18n="">Settings</span></a>
          </li>

          <li class=" nav-item"><a href="logout.php"><i class="fa fa-power-off"></i><span class="menu-title" data-i18n="">Logout</span></a>
          </li>


         
        </ul>
      </div>
    </div>
    <!-- END: Main Menu-->


    <style type="text/css">
      
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

.card-body {
  padding: 2px 2px 2px 2px;
}
    </style>