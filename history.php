<?php require 'header.php';

?>


<!-- BEGIN: Content-->
<div class="app-content content">

  <div class="content-wrapper">
    <div class="content-body">

      <div class="row">

        <div class="col-md-12">
          <div class="card">
            <div class="card-header bg-warning text-white text-center"> <a href="javascript:window.history.back(-1);" style="float:left;color: white;" ><i class="fa fa-arrow-left"></i> Back</a>
 Ride History</div>
            <div class="card-body">
             

              <?php

          $result=mysqli_query($db,"SELECT * FROM user_ride WHERE user_id='".$_SESSION['username']."' order by at DESC ") ;

          if (mysqli_num_rows($result)>0) 
          {
            
          ?>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Pick Up</th>
                  <th>Drop</th>
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
              ?>

              <tr>
                <th><a href="data.php?id=<?php echo urlencode(base64_encode($row['id'])) ?>" class="btn btn-sm btn-danger"> <i class="fa fa-eye"></i> <?php echo $i+1;?></a></th>
                <th><?php echo $row['source']; ;?></th>
                <th><?php echo $row['destination']  ?></th>

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


  <th style="font-size:20px;color: green"><?php if($row['ride_status']=='Pending'){echo '<b style="color:red">'.$row['ride_status'].'</b>';} if($row['ride_status']=='Confirmed'){echo '<b style="color:green">'.$row['ride_status'].'</b>';} ?></th>


  <th style="font-size:20px;color: blue;">₹<?php echo $radius_km * 2 * 1; ?>/-</th>

              </tr>


              <?php $i++; } } else {echo 'no data found';} ?>
              
            </table>

 
              
            </div><!------- end of card body---------->
          </div><!------- end of card---------->
        </div><!------- end of col md 6---------->


      </div><!------- end of row---------->













</div>
</div>
</div>


<?php require 'footer.php';?>