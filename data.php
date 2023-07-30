<?php require 'header.php';

  $qry2 = mysqli_query($db,"select * from user_ride where id ='".urldecode(base64_decode($_REQUEST['id']))."'");
  $data2 = mysqli_fetch_array($qry2);


  if ($_SESSION['role']=='driver') 
  {
    msg('Not Autherized to this Page');
  }
?>


<!-- BEGIN: Content-->
<div class="app-content content">

  <div class="content-wrapper">
    <div class="content-body">

      <div class="row">

        <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-danger text-white text-center"> <a href="javascript:window.history.back(-1);" style="float:left;color: white;" ><i class="fa fa-arrow-left"></i> Back</a>
 Ride Data</div>
            <div class="card-body">
              <table width="100%" class="table table-Normal">
                <tr>
                  <td>ID:</td><th><?php echo $data2['id']; ?></th>

                  <td>Booking Date:</td><th><?php echo date('d-M-Y',strtotime($data2['at'])); ?></th>
                </tr>

                <tr>
                  <td >Pickup:</td><th><?php echo $data2['source']; ?></th>
               
                  <td >Destination:</td><th><?php echo $data2['destination']; ?></th>
                </tr>

                <tr>
                  <td >Distance:</td>
                  <th>
                    <?php // Latitude and Longitude of Source Point (source)
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
echo $radius_km= round($km,2);

?> KMs
                  </th>
                
                  <td>Charge per Km</td><th>₹2 * <?php echo $radius_km ?></th>
                </tr>
                <tr>
                  <td>Service Charge</td><th>₹1/-</th>
              </tr>

              <tr>
                  <td style="font-size:18px;" >Total:</td>
                  <th style="font-size:18px;">₹<?php echo $radius_km * 2 * 1; ?></th>
                </tr>
              </table>

              Current Booking Status: <?php if($data2['ride_status']=='Pending'){echo '<b style="color:red">'.$data2['ride_status'].'</b>';} if($data2['ride_status']=='Confirmed'){echo '<b style="color:green">'.$data2['ride_status'].'</b>';} if($data2['ride_status']=='Requested'){echo '<b style="color:blue">'.$data2['ride_status'].'</b>';} ?>

<?php if (!empty($data2['driver_id']))
 {
  ?>
         <form action="" method="POST">
                <input type="submit" name="confirm_ride" value="Request Ride" class="btn btn-danger btn-sm" style="float:right;">
              </form>

<?php

if (isset($_POST['confirm_ride']))
{
  $sql="UPDATE user_ride set ride_status='Requested' WHERE id='".$data2['id']."' ";
  mysqli_query($db,$sql);

  yes();
}#end of if issert





 }

 if (empty($data2['driver_id']))
 {
  ?>

<p style="float:right;font-size: 12px;color: red;">Select Driver below before Confirming the ride</p>

<?php }?>
              
            </div><!------- end of card body---------->
          </div><!------- end of card---------->
        </div><!------- end of col md 6---------->





<?php 

 if (empty($data2['driver_id']))
 {
  ?>

         <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-warning text-white text-center">Drivers on Requested Route</div>
            <div class="card-body">


<?php
$date = date('Y-m-d'); // Get today's date

$sql3 = "SELECT * FROM driver_routes
WHERE ((source_latitude <= $lat1 AND destination_latitude >= $lat2) 
OR (source_latitude >= $lat1 AND destination_latitude <= $lat2)) 
AND ((source_longitude <= $lon1 AND destination_longitude >= $lon2) 
OR (source_longitude >= $lon1 AND destination_longitude <= $lon2))
AND DATE(at) = '$date'"; // Add the date condition



$result2 = mysqli_query($db,$sql3);
if (mysqli_num_rows($result2) > 0)
{

   
?>

<center><b><?php echo date('d-M-Y') ?></b> Drivers for your requested routes</center>

<table width="100%" class="table table-Normal">
       
                      <tr>
                        <th style="background-color:black; color:white;width: 1% !important;" scope="col">#</th>
                        <th style="background-color:black; color:white;" scope="col">Seats</th>

                        <th style="background-color:black; color:white;" scope="col">Driver</th>
                        <th style="background-color:black; color:white;" scope="col">Source</th>

                        <th style="background-color:black; color:white;" scope="col">Destination</th>
                      </tr>

                    <?php
                     $i=0;
                     while($row = mysqli_fetch_array($result2)) {

                       $qry2 = mysqli_query($db,"select * from driver_details where mobile ='".$row['driver_id']."'");
  $driver = mysqli_fetch_array($qry2);
                     ?>

                    <tbody>
                      <tr>
                        <th scope="row" style="width: 1% !important;"> <form action="" method="POST"><input type="hidden" name="driver_id" value="<?php echo ucfirst($row["driver_id"]);?>"><button type="submit" name="allot_driver" class="btn btn-sm btn-info">Book</button></form> </th>

                        <th style="text-align:left !important;width: 2%"><?php echo ucfirst($row["seats"]);?></th>

                        <th style="text-align:left !important;"><?php echo ucfirst($driver["name"]);?><br>[xxxxx<?php echo substr($row['driver_id'], -4);?>]</th>
                        <th style="text-align:left !important;"><?php echo ucfirst($row["source"]);?></th>
                        <th style="text-align:left !important;"><?php echo ucfirst($row["destination"]);?></th>
                      </tr>                     
                    </tbody>


                    <?php $i++;}?>

                    <?php
 }
else{
echo "<b><center>No driver found......!</b></center>";}



if (isset($_POST['allot_driver'])) 
{
  $sql="UPDATE user_ride set driver_id='".$_POST['driver_id']."' where id='".$data2['id']."' ";
  mysqli_query($db,$sql);

  //$qry3 = mysqli_query($db,"select * from driver_routes where driver_id ='".$_POST['driver_id']."'");
  //$driverr = mysqli_fetch_array($qry3);

//  $sql2="UPDATE driver_routes SET seats=seats-1 where id='".$driverr['id']."' and driver_id='".$_POST['driver_id']."' ";
//mysqli_query($db,$sql2);


  msg('Driver Alloted Successfully. Now confirm your ride');
}
?>
</table>
              
            </div><!------- end of card body---------->
          </div><!------- end of card---------->
        </div><!------- end of col md 6---------->
<?php }




if (!empty($data2['driver_id']) && $data2['ride_status']=='Confirmed') 
{


 $qry2 = mysqli_query($db,"select * from driver_details where mobile ='".$data2['driver_id']."'");
  $driver = mysqli_fetch_array($qry2);
 ?>


  <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-warning text-white text-center">Alloted Driver</div>
            <div class="card-body">

              <table width="100%" style="font-size:17px;">
                <tr>
                  <td>Name:</td><th><?php echo ucwords($driver['name']) ?></th>

                  <td>Mobile:</td><th><?php echo ucwords($driver['mobile']) ?></th>

                </tr>


                 <tr>
                  <td>Email:</td><th><?php echo strtolower($driver['email']) ?></th>

                  <td>Gender:</td><th><?php echo ucwords($driver['gender']) ?></th>

                </tr>

                 <tr>
                  <td>DL No.:</td><th><?php echo strtoupper($driver['dl_no']) ?></th>

                  <td>Vehicle No.:</td><th><?php echo strtoupper($driver['vehicle_no']) ?></th>

                </tr>
              </table>




            </div><!------- end of card body---------->
          </div><!------- end of card---------->
        </div><!------- end of col md 6---------->



<?php } ?>



      </div><!------- end of row---------->






       <div class="row">

        <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-success text-white text-center">Route Map</div>
            <div class="card-body">

  <script>
    // Latitude and Longitude of Source Point


     function initMap() {
        // Latitude and Longitude of Source Point
        var lat1 = <?php echo $data2['source_latitude'] ?>;  // Latitude of Source Point
        var lon1 = <?php echo $data2['source_longitude'] ?>; // Longitude of Source Point
        
        // Latitude and Longitude of Destination Point
        var lat2 = <?php echo $data2['destination_latitude'] ?>;  // Latitude of Destination Point
        var lon2 = <?php echo $data2['destination_longitude'] ?>; // Longitude of Destination Point
        
        // Create a map centered on the Source Point
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: lat1, lng: lon1}
        });
        
        // Create markers for the Source and Destination Points
        var marker1 = new google.maps.Marker({
          position: {lat: lat1, lng: lon1},
          map: map,
          title: 'Source Point'
        });
        
        var marker2 = new google.maps.Marker({
          position: {lat: lat2, lng: lon2},
          map: map,
          title: 'Destination Point'
        });
      }
  </script>
<style type="text/css">
  #map {
  height: 500px;
  width: 100%;
}

</style>
               <div id="map"></div>

 
              
            </div><!------- end of card body---------->
          </div><!------- end of card---------->
        </div><!------- end of col md 6---------->


      </div><!------- end of row---------->













</div>
</div>
</div>


<?php require 'footer.php';?>