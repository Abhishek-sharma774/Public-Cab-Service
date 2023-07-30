<?php require'header.php';

?>

 <style type="text/css">
 table,tr,th {padding: 9px 9px 9px 9px;}
 </style>
 
<script type="text/javascript">
   var source, destination, distance;
   
   function initAutocomplete() {
      var options = {
         componentRestrictions: {country: "in"}
      };
      var address = document.getElementById('address');
      var autocomplete = new google.maps.places.Autocomplete(address,options);

      autocomplete.addListener('place_changed', function() {
        var source = autocomplete.getPlace(); 
        var latitude = source.geometry.location.lat();
        var longitude = source.geometry.location.lng();
        $('#latitude').val(latitude);
        $('#longitude').val(longitude); 
         calculateDistance();
      });

   }

   function initAutocomplete2() {
      var options = {
         componentRestrictions: {country: "in"}
      };
      var address = document.getElementById('address2');
      var autocomplete = new google.maps.places.Autocomplete(address,options);

      autocomplete.addListener('place_changed', function() {
        var destination = autocomplete.getPlace(); 
        var latitude2 = destination.geometry.location.lat();
        var longitude2 = destination.geometry.location.lng();
        $('#latitude2').val(latitude2);
        $('#longitude2').val(longitude2);
         calculateDistance();
      });



   }

   function calculateDistance() {
      if (source && destination) {
         var distanceService = new google.maps.DistanceMatrixService();
         distanceService.getDistanceMatrix({
            origins: [source.formatted_address],
            destinations: [destination.formatted_address],
            travelMode: 'DRIVING'
         }, function(response, status) {
            if (status == 'OK') {
               distance = response.rows[0].elements[0].distance.value;
               document.getElementById('distance').innerHTML = 'Distance: ' + (distance/1000).toFixed(2) + ' km';
            } else {
               alert('Error: ' + status);
            }
         });
      }
   }
</script>





       


<!-- BEGIN: Content-->
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-body">










<?php 

if ($_SESSION['role']=='driver') 
{
?>







      <div class="row">

      	<div class="col-md-6">
      		<div class="card">
      			<div class="card-header bg-warning text-white text-center">Set Your Routes</div>
      			<div class="card-body">


<form action="" method="POST">
   <input type="text" name="source" required id="address" onfocus="initAutocomplete()" placeholder="Source" class="form-control">
   <br>
   <input type="text" name="destination" required id="address2" onfocus="initAutocomplete2()" placeholder="Destination" class="form-control">
   <br>

<input type="number" name="seats" required class="form-control" placeholder="Seats available">

   <div id="distance"></div>
   <br>

   <input type="hidden" name="source_latitude" id="latitude" value="">
<input type="hidden" name="source_longitude" id="longitude" value="">
<input type="hidden" name="destination_latitude" id="latitude2" value="">
<input type="hidden" name="destination_longitude" id="longitude2" value="">


   <input type="submit" id="submit" name="submit" class="btn btn-success text-white" style="float:right;" value="Submit">
</form>


<?php 
if (isset($_POST['submit'])) 
{
	$sql="INSERT INTO driver_routes (driver_id, source, source_latitude, source_longitude, destination, destination_latitude, destination_longitude,seats) VALUES ('".$_SESSION['username']."','".$_POST['source']."','".$_POST['source_latitude']."','".$_POST['source_longitude']."','".$_POST['destination']."','".$_POST['destination_latitude']."','".$_POST['destination_longitude']."','".$_POST['seats']."')";

		mysqli_query($db,$sql);
		msg('Addedd Successfully');
}


?>


 
			
      			</div><!------- end of card body---------->
      		</div><!------- end of card---------->
      	</div><!------- end of col md 6---------->















      	<div class="col-md-6">
      		<div class="card">
      			<div class="card-header bg-primary text-white text-center">Routes</div>
      			<div class="card-body">


<?php
$result2 = mysqli_query($db,"SELECT * FROM driver_routes WHERE driver_id='".$_SESSION['username']."' order by at desc");
if (mysqli_num_rows($result2) > 0)
{
?>

<table width="100%" class="table table-Normal">
       
                      <tr>
                        <th style="background-color:black; color:white;width: 1% !important;" scope="col">#</th>
                        <th style="background-color:black; color:white;" scope="col">Seats</th>
                        <th style="background-color:black; color:white;" scope="col">Source</th>
                        <th style="background-color:black; color:white;" scope="col">Destination</th>
                        <th style="background-color:black; color:white;" scope="col">Kms</th>
                        <th style="background-color:black; color:white;" scope="col">Date</th>

                      </tr>

                    <?php
                     $i=0;
                     while($row = mysqli_fetch_array($result2)) {
                     ?>

                    <tbody>
                      <tr>
                        <th scope="row" style="width: 1% !important;"><?php echo $i+1;?></th>
                        <th style="text-align:left !important;"><?php echo ucfirst($row["seats"]);?></th>



                        <th style="text-align:left !important;"><?php echo ucfirst($row["source"]);?></th>

                        <th style="text-align:left !important;"><?php echo ucfirst($row["destination"]);?></th>

                        <th>
                        	<?php 

                        	$lat1 =  $row['source_latitude'];  // Latitude of Source Point
                          $lon1 =  $row['source_longitude']; // Longitude of Source Point

                          $lat2 = $row["destination_latitude"];  // Latitude of Destination Point
                          $lon2 = $row["destination_longitude"]; // Longitude of Destination Point


                        	// Calculate distance between two points
$theta = $lon1 - $lon2;
$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
$dist = acos($dist);
$dist = rad2deg($dist);
$km = $dist * 60 * 1.1515 * 1.609344;

echo  round($km, 2). "KMs";

                        	?>
                        </th>


                        <th scope="row"><?php echo date('d-M-Y [l]',strtotime($row['at']));?></th>  
                   

                      </tr>                     
                    </tbody>


                    <?php $i++;}?>

                    <?php
 }
else{
echo "<b><center>No routes found......!</b></center>";}
?>
</table>
   				
      			</div><!------- end of card body---------->
      		</div><!------- end of card---------->
      	</div><!------- end of col md 6---------->
        



      </div><!------- end of row---------->




      <div class="row">
      	<div class="col-md-12">
      		<div class="card">
      			<div class="card-header bg-info text-white text-center">Today Clients</div>
      			<div class="card-body">
                     <?php
                     $today=date('Y-m-d');

          $result=mysqli_query($db,"SELECT * FROM user_ride WHERE driver_id='".$_SESSION['username']."'  AND DATE(at) = '$today' ") ;

          if (mysqli_num_rows($result)>0) 
          {
            
          ?>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Client</th>
                  <th>Routes</th>
                  <th>Date</th>
                  <th>Distance</th>
                  <th>Status</th>
                  <th>Amount</th>
                </tr>
              </thead>

              <?php 

              $i=0;
              while ($row=mysqli_fetch_array($result)) 
              {
                  $qry3 = mysqli_query($db,"select * from user_details where mobile ='".$row['user_id']."'");
                  $user = mysqli_fetch_array($qry3);
              ?>

              <tr>

                <th><?php echo $user['name']; ;?> <br> <?php echo $user['mobile']; ;?></th>

                
                <th><?php echo $row['source']; ?> <br><?php echo $row['destination']  ?> <br> <a href="https://www.google.com/maps/dir/<?php echo str_replace(" ", "+", $row['source']) ?>/<?php echo str_replace(" ", "+", $row['destination']) ?>/@<?php echo $row['source']; ?>,<?php echo $row['destination']  ?> " target="_blank" class="btn btn-warning btn-sm">View in Map</a></th>
              

                <th><?php echo date('d-M-Y',strtotime($row['at'])) ?></th>

                 <th>
                    <?php // Latitude and Longitude of Source Point (source)
$lat1 = $row['source_latitude'];  // Latitude of source
$lon1 = $row['source_longitude']; // Longitude of source

// Latitude and Longitude of Destination Point (Destination)
$lat2 = $row['destination_latitude'];  // Latitude of Destination
$lon2 = $row['destination_longitude']; // Longitude of Destination

// Calculate distance between source and Destination
$theta = $lon1 - $lon2;
$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
$dist = acos($dist);
$dist = rad2deg($dist);
 $km = $dist * 60 * 1.1515 * 1.609344;
echo $radius_km= round($km,2);

?> KMs</th>


  <th style="font-size:20px;">
    <?php if($row['ride_status']=='Pending'){echo '<b style="color:red">'.$row['ride_status'].'</b>';} if($row['ride_status']=='Confirmed'){echo '<b style="color:green">'.$row['ride_status'].'</b>';}  if($row['ride_status']=='Requested'){echo '<b style="color:blue">'.$row['ride_status'].'</b>';}

    if($row['ride_status']=='Rejected'){echo '<b style="color:maroon">'.$row['ride_status'].'</b>';}  ?>
        
        <br>

        <form action="" method="POST"><input type="hidden" name="id" value="<?php echo $row['id'] ?>">
            <input type="hidden" name="email" value="<?php echo $user['email'] ?>">
<select name="ride_status" required class="form-control">
    <option>--Select---</option>
    <option value="Confirmed">Confirm</option>
    <option value="Rejected">Reject</option>

</select> 
         <button type="submit" name="confirm_ride" class="btn btn-success btn-sm">Confirm Ride</button></form>
    </th>


  <th style="font-size:20px;color: blue;">₹<?php echo $radius_km * 2 * 1; ?>/-</th>

              </tr>


              <?php $i++; } } else {echo 'no data found';}
              
 



if (isset($_POST['confirm_ride'])) 
{
    if ($_POST['ride_status']=='Rejected') 
    {$sql="UPDATE user_ride set ride_status='".$_POST['ride_status']."' WHERE id='".$_POST['id']."' ";
     
     $gif='https://media0.giphy.com/media/v1.Y2lkPTc5MGI3NjExZDZiMjFhMDRmOGMyZGIxNzM3M2U1NDk4ODI5M2M5Mjc1YTA3YmE4MyZlcD12MV9pbnRlcm5hbF9naWZzX2dpZklkJmN0PWc/YRhT9PSJe4twXxTE0U/giphy.gif';
     $color='red';

     }

if ($_POST['ride_status']=='Confirmed') 
    {$sql="UPDATE user_ride set ride_status='".$_POST['ride_status']."' WHERE id='".$_POST['id']."' ";
$date = date('Y-m-d');
$sql2="UPDATE driver_routes SET seats=seats-1 where  DATE(at) = '".$date."' AND driver_id='".$_SESSION['username']."'  ";
mysqli_query($db,$sql2);

 $gif='https://i.pinimg.com/originals/39/d9/d1/39d9d12f7360ee2650b039818da184f0.gif';
     $color='green';
}


  $qry2 = mysqli_query($db,"select * from user_ride where id ='".$_REQUEST['id']."'");
  $data2 = mysqli_fetch_array($qry2);



 $body='<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

  <center>
    <h4>Dear, <b>User</b></h4>
  
  <br>
  <img src="'.$gif.'" style="width: 100px; height:100px"><br>
  <p style="font-size:20px;">
  Your Ride Request has been: <b style="color:'.$color.';">'.$_POST['ride_status'].'</b>
  <br>
  Ride Data as you requested


  <table width="100%">
     <tr>
                  <td>Request ID:</td><th>'.$data2['id'].'</th>

                  <td>Booking Date:</td><th>'.date('d-M-Y',strtotime($data2['at'])).'</th>
                </tr>

                <tr>
                  <td >Pickup:</td><th>'.$data2['source'].'</th>
               
                  <td >Destination:</td><th>'.$data2['destination'].'</th>
                </tr>

                <tr>
                  <td >Distance:</td>
                  <th>
                   '.
$lat1 = $data2['source_latitude'];  // Latitude of source
$lon1 = $data2['source_longitude']; // Longitude of source

// Latitude and Longitude of Destination Point (Destination)
$lat2 = $data2['destination_latitude'];  // Latitude of Destination
$lon2 = $data2['destination_longitude']; // Longitude of Destination

// Calculate distance between source and Destination
$theta = $lon1 - $lon2;
$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
$dist = acos($dist);
$dist = rad2deg($dist);
 $km = $dist * 60 * 1.1515 * 1.609344;
echo $radius_km= round($km,2)



.' KMs
                  </th>
                
                  <td>Charge per Km</td><th>₹2 * '.$radius_km.'</th>
                </tr>
                <tr>
                  <td>Service Charge</td><th>₹1/-</th>
              </tr>

              <tr>
                  <td style="font-size:18px;" >Total:</td>
                  <th style="font-size:18px;">₹'.$total=$radius_km * 2 * 1; $total.'/-</th>
                </tr>
              </table>

</center>
</p>
</body>
</html>';
     

     mysqli_query($db,$sql);

    $mail= email($_POST['email'],$_POST['ride_status'],$body);
    msg('Successfull');


}


               ?>
              
            </table>
        </div>
      				
      		</div><!------- end of card body---------->
      		</div><!------- end of card---------->
      	</div><!------- end of col md 6---------->
        



      </div><!------- end of row---------->




<?php } #end of driver role 

if($_SESSION['role']=='user')
{
?>


  <div class="row">
      	<div class="col-md-6">
      		<div class="card">
      			<div class="card-header bg-info text-white text-center">Request Lift</div>
      			<div class="card-body">


<form action="" method="POST">
   <input type="text" name="source" required id="address" onfocus="initAutocomplete()" placeholder="Source" class="form-control">
   <br>
   <input type="text" name="destination" required id="address2" onfocus="initAutocomplete2()" placeholder="Destination" class="form-control">
   <br>
   <div id="distance"></div>
   <br>

   <input type="hidden" name="source_latitude" id="latitude" value="">
<input type="hidden" name="source_longitude" id="longitude" value="">
<input type="hidden" name="destination_latitude" id="latitude2" value="">
<input type="hidden" name="destination_longitude" id="longitude2" value="">

   <input type="submit" id="submit" name="submit" class="btn btn-success text-white" style="float:right;" value="Submit">
</form>


<?php 
if (isset($_POST['submit'])) 
{
	$sql="INSERT INTO user_ride (user_id, source, source_latitude, source_longitude, destination, destination_latitude, destination_longitude,ride_status) VALUES ('".$_SESSION['username']."','".$_POST['source']."','".$_POST['source_latitude']."','".$_POST['source_longitude']."','".$_POST['destination']."','".$_POST['destination_latitude']."','".$_POST['destination_longitude']."','Pending')";

		mysqli_query($db,$sql);
		
        echo '<script type="text/javascript">'; 
echo 'alert("Request Successfull");'; 
echo 'window.location.href = "data.php?id='.urlencode(base64_encode($row['id'])).'";';
echo '</script>';
}


?>


      				
      		</div><!------- end of card body---------->
      		</div><!------- end of card---------->
      	</div><!------- end of col md 6---------->
        



<div class="col-md-6">
      		<div class="card">
      			<div class="card-header bg-primary text-white text-center">Routes</div>
      			<div class="card-body">


<?php
$result2 = mysqli_query($db,"SELECT * FROM user_ride WHERE user_id='".$_SESSION['username']."' order by at desc");

if (mysqli_num_rows($result2) > 0)
{
?>

<table width="100%" class="table table-Normal">
       
                      <tr>
                        <th style="background-color:black; color:white;width: 1% !important;" scope="col">#</th>
                        <th style="background-color:black; color:white;" scope="col">Source</th>
                        <th style="background-color:black; color:white;" scope="col">Destination</th>
                        <th style="background-color:black; color:white;" scope="col">Kms</th>
                        <th style="background-color:black; color:white;" scope="col">Date</th>

                      </tr>

                    <?php
                     $i=0;
                     while($row = mysqli_fetch_array($result2)) {
                     ?>

                    <tbody>
                      <tr>
                        <th scope="row" style="width: 1% !important;"><a href="data.php?id=<?php echo urlencode(base64_encode($row['id'])) ?>" class="btn btn-sm btn-warning"> <i class="fa fa-eye"></i> <?php echo $i+1;?></a></th>

                        <th style="text-align:left !important;"><?php echo ucfirst($row["source"]);?></th>

                        <th style="text-align:left !important;"><?php echo ucfirst($row["destination"]);?></th>

                        <th>
                        	<?php 

                        	$lat1 =  $row['source_latitude'];  // Latitude of Source Point
                          $lon1 =  $row['source_longitude']; // Longitude of Source Point

                          $lat2 = $row["destination_latitude"];  // Latitude of Destination Point
                          $lon2 = $row["destination_longitude"]; // Longitude of Destination Point


                        	// Calculate distance between two points
$theta = $lon1 - $lon2;
$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
$dist = acos($dist);
$dist = rad2deg($dist);
$km = $dist * 60 * 1.1515 * 1.609344;

echo  round($km, 2). "KMs";

                        	?>
                        </th>


                        <th scope="row"><?php echo date('d-M-Y [l]',strtotime($row['at']));?></th>  
                   

                      </tr>                     
                    </tbody>


                    <?php $i++;}?>

                    <?php
 }
else{
echo "<b><center>No routes found......!</b></center>";}
?>
</table>
   				
      			</div><!------- end of card body---------->
      		</div><!------- end of card---------->
      	</div><!------- end of col md 6---------->
        
















      </div><!------- end of row---------->
















<?php } #end of user role  ?>





    </div><!------- end of content body---------->
  </div><!------- end of content wrapper---------->

</div><!------- end of app-content content---------->
<!-- END: Content-->






























    <!-- BEGIN: Customizer-->
    <div class="customizer border-left-blue-grey border-left-lighten-4 d-none d-xl-block"><a class="customizer-close" href="#"><i class="ft-x font-medium-3"></i></a><a class="customizer-toggle bg-primary box-shadow-3" href="#" id="customizer-toggle-setting"><i class="fa fa-cog font-medium-3 spinner white"></i></a><div class="customizer-content p-2">
	<h5 class="mt-1 mb-1 text-bold-500">Navbar Color Options</h5>
	<div class="navbar-color-options clearfix">
		<div class="gradient-colors mb-1 clearfix">
			<div class="bg-gradient-x-purple-blue navbar-color-option" data-bg="bg-gradient-x-purple-blue" title="bg-gradient-x-purple-blue"></div>
			<div class="bg-gradient-x-purple-red navbar-color-option" data-bg="bg-gradient-x-purple-red" title="bg-gradient-x-purple-red"></div>
			<div class="bg-gradient-x-blue-green navbar-color-option" data-bg="bg-gradient-x-blue-green" title="bg-gradient-x-blue-green"></div>
			<div class="bg-gradient-x-orange-yellow navbar-color-option" data-bg="bg-gradient-x-orange-yellow" title="bg-gradient-x-orange-yellow"></div>
			<div class="bg-gradient-x-blue-cyan navbar-color-option" data-bg="bg-gradient-x-blue-cyan" title="bg-gradient-x-blue-cyan"></div>
			<div class="bg-gradient-x-red-pink navbar-color-option" data-bg="bg-gradient-x-red-pink" title="bg-gradient-x-red-pink"></div>
		</div>
		<div class="solid-colors clearfix">
			<div class="bg-primary navbar-color-option" data-bg="bg-primary" title="primary"></div>
			<div class="bg-success navbar-color-option" data-bg="bg-success" title="success"></div>
			<div class="bg-info navbar-color-option" data-bg="bg-info" title="info"></div>
			<div class="bg-warning navbar-color-option" data-bg="bg-warning" title="warning"></div>
			<div class="bg-danger navbar-color-option" data-bg="bg-danger" title="danger"></div>
			<div class="bg-blue navbar-color-option" data-bg="bg-blue" title="blue"></div>
		</div>
	</div>

	<hr>

	<h5 class="my-1 text-bold-500">Layout Options</h5>
	<div class="row">
		<div class="col-12">
			<div class="d-inline-block custom-control custom-radio mb-1 col-4">
				<input type="radio" class="custom-control-input bg-primary" name="layouts" id="default-layout" checked>
				<label class="custom-control-label" for="default-layout">Default</label>
			</div>
			<div class="d-inline-block custom-control custom-radio mb-1 col-4">
				<input type="radio" class="custom-control-input bg-primary" name="layouts" id="fixed-layout">
				<label class="custom-control-label" for="fixed-layout">Fixed</label>
			</div>
			<div class="d-inline-block custom-control custom-radio mb-1 col-4">
				<input type="radio" class="custom-control-input bg-primary" name="layouts" id="static-layout">
				<label class="custom-control-label" for="static-layout">Static</label>
			</div>
			<div class="d-inline-block custom-control custom-radio mb-1">
				<input type="radio" class="custom-control-input bg-primary" name="layouts" id="boxed-layout">
				<label class="custom-control-label" for="boxed-layout">Boxed</label>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="d-inline-block custom-control custom-checkbox mb-1">
				<input type="checkbox" class="custom-control-input bg-primary" name="right-side-icons" id="right-side-icons">
				<label class="custom-control-label" for="right-side-icons">Right Side Icons</label>
			</div>
		</div>
	</div>

	<hr>

	<h5 class="mt-1 mb-1 text-bold-500">Sidebar menu Background</h5>
	<!-- <div class="sidebar-color-options clearfix">
		<div class="bg-black sidebar-color-option" data-sidebar="menu-dark" title="black"></div>
		<div class="bg-white sidebar-color-option" data-sidebar="menu-light" title="white"></div>
	</div> -->
	<div class="row sidebar-color-options ml-0">
		<label for="sidebar-color-option" class="card-title font-medium-2 mr-2">White Mode</label>
		<div class="text-center mb-1">
			<input type="checkbox" id="sidebar-color-option" class="switchery" data-size="xs"/>
		</div>
		<label for="sidebar-color-option" class="card-title font-medium-2 ml-2">Dark Mode</label>
	</div>

	<hr>

	<label for="collapsed-sidebar" class="font-medium-2">Menu Collapse</label>
	<div class="float-right">
		<input type="checkbox" id="collapsed-sidebar" class="switchery" data-size="xs"/>
	</div>
	
	<hr>

	<!--Sidebar Background Image Starts-->
	<h5 class="mt-1 mb-1 text-bold-500">Sidebar Background Image</h5>
	<div class="cz-bg-image row">
		<div class="col mb-3">
			<img src="Files/app-assets/images/backgrounds/04.jpg" class="rounded sidiebar-bg-img" width="50" height="100" alt="background image">
		</div>
		<div class="col mb-3">
			<img src="Files/app-assets/images/backgrounds/01.jpg" class="rounded sidiebar-bg-img" width="50" height="100" alt="background image">
		</div>
		<div class="col mb-3">
			<img src="Files/app-assets/images/backgrounds/02.jpg" class="rounded sidiebar-bg-img" width="50" height="100" alt="background image">
		</div>
		<div class="col mb-3">
			<img src="Files/app-assets/images/backgrounds/05.jpg" class="rounded sidiebar-bg-img" width="50" height="100" alt="background image">
		</div>
	</div>
	<!--Sidebar Background Image Ends-->

	<!--Sidebar BG Image Toggle Starts-->
	<div class="sidebar-image-visibility">
		<div class="row ml-0">
			<label for="toggle-sidebar-bg-img" class="card-title font-medium-2 mr-2">Hide Image</label>
			<div class="text-center mb-1">
				<input type="checkbox" id="toggle-sidebar-bg-img" class="switchery" data-size="xs" checked/>
			</div>
			<label for="toggle-sidebar-bg-img" class="card-title font-medium-2 ml-2">Show Image</label>
		</div>
	</div>
	<!--Sidebar BG Image Toggle Ends-->

</div>
    </div>
    <!-- End: Customizer-->


    <!-- BEGIN: Footer-->
   

   <?php require'footer.php';?>