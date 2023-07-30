<?php 
require'header.php';
require'session.php';
?>


   <main class="content">
                <div class="container-fluid p-0">
                	<center><h1><strong>Admin Dashboard</strong></h1></center><br>
                    




                    	<div class="row">

                    		<div class="col-md-4">
                    			<div class="card">
                    				<div class="card-header bg-info text-white text-center">Registered Users</div>

                                    <div class="card-body">

                                        <table width="100%">
                                            <tr>
                                              <td><img src="https://cdn-icons-png.flaticon.com/512/3233/3233483.png" alt="Male" style="width:50px; height:50px"></td>
                                              <th> <?php 
                                                    $sql="SELECT count(id) AS total FROM user_details where gender='Male'";
                                                    $result=mysqli_query($db,$sql);
                                                    $value=mysqli_fetch_assoc($result);
                                                     echo $num_row=$value['total'];
                                              ?></th>
                                            
                                              <td><img src="https://cdn1.iconfinder.com/data/icons/user-pictures/100/female1-512.png" alt="Female" style="width:50px; height:50px"></td>
                                              <th> <?php 
                                                    $sql="SELECT count(id) AS total FROM user_details where gender='Female'";
                                                    $result=mysqli_query($db,$sql);
                                                    $value=mysqli_fetch_assoc($result);
                                                     echo $num_row=$value['total'];
                                              ?></th>
                                            </tr>
                                        </table>
                                        <hr>
                                        <center>Total: <b> <?php 
                                                    $sql="SELECT count(id) AS total FROM user_details";
                                                    $result=mysqli_query($db,$sql);
                                                    $value=mysqli_fetch_assoc($result);
                                                     echo $num_row=$value['total'];
                                              ?></b></center>

                                        
                                    </div><!--------- end of card body---------->
                    			</div><!--------- end of card---------->
                    		</div><!--------- end of cold md 4---------->


                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header bg-primary text-white text-center">Registered Drivers</div>

                                    <div class="card-body">

                                        <table width="100%">
                                            <tr>
                                              <td><img src="https://cdn-icons-png.flaticon.com/512/5283/5283021.png" alt="Male" style="width:50px; height:50px"></td>
                                              <th> <?php 
                                                    $sql="SELECT count(id) AS total FROM driver_details where gender='Male'";
                                                    $result=mysqli_query($db,$sql);
                                                    $value=mysqli_fetch_assoc($result);
                                                     echo $num_row=$value['total'];
                                              ?></th>
                                            
                                              <td><img src="https://cdni.iconscout.com/illustration/premium/thumb/woman-driving-car-6496055-5372765.png" alt="Female" style="width:50px; height:50px"></td>
                                              <th> <?php 
                                                    $sql="SELECT count(id) AS total FROM driver_details where gender='Female'";
                                                    $result=mysqli_query($db,$sql);
                                                    $value=mysqli_fetch_assoc($result);
                                                     echo $num_row=$value['total'];
                                              ?></th>
                                            </tr>
                                        </table>


                                         <hr>
                                        <center>Total: <b> <?php 
                                                    $sql="SELECT count(id) AS total FROM driver_details";
                                                    $result=mysqli_query($db,$sql);
                                                    $value=mysqli_fetch_assoc($result);
                                                     echo $num_row=$value['total'];
                                              ?></b></center>

                                        
                                    </div><!--------- end of card body---------->
                                </div><!--------- end of card---------->
                            </div><!--------- end of cold md 4---------->





                          
                    	</div><!--------- end of row---------->




























                        <div class="row">

                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header bg-dark text-white text-center">User Rides</div>

                                    <div class="card-body">

                                         <?php

          $result=mysqli_query($db,"SELECT * FROM user_ride order by at desc") ;

          if (mysqli_num_rows($result)>0) 
          {
            
          ?>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>User</th>

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
                <th><?php echo $i+1;?></th>
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


  <th style="font-size:15px;color: green"><?php if($row['ride_status']=='Pending'){echo '<b style="color:red">'.$row['ride_status'].'</b>';} if($row['ride_status']=='Confirmed'){echo '<b style="color:green">'.$row['ride_status'].'</b>';} ?></th>


  <th style="font-size:15px;color: blue;">₹<?php echo $radius_km * 2 * 1; ?>/-</th>

              </tr>


              <?php $i++; } } else {echo 'no data found';} ?>
              
            </table>
        </div>

                                        
                                    </div><!--------- end of card body---------->
                                </div><!--------- end of card---------->
                            </div><!--------- end of cold md 4---------->










  <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header bg-warning text-white text-center">Server Information</div>

                                    <div class="card-body">
 <ul>
        <li><strong>Server Name:</strong> <?php echo $_SERVER['SERVER_NAME']; ?></li>
        <li><strong>Server IP Address:</strong> <?php echo $_SERVER['SERVER_ADDR']; ?></li>
        <li><strong>Server Software:</strong> <?php echo $_SERVER['SERVER_SOFTWARE']; ?></li>
        <li><strong>Server Load:</strong> <?php echo getServerLoad(); ?></li>
        <li><strong>Server Uptime:</strong> <?php echo getServerUptime(); ?></li>
        <li><strong>Server Port:</strong> <?php echo $_SERVER['SERVER_PORT']; ?></li>
        <li><strong>Server Protocol:</strong> <?php echo $_SERVER['SERVER_PROTOCOL']; ?></li>
        <li><strong>PHP Version:</strong> <?php echo phpversion(); ?></li>
        <li><strong>Server Memory:</strong> <?php echo formatBytes(memory_get_usage(true)); ?></li>
        <li><strong>Current Date and Time:</strong> <?php date_default_timezone_set('Asia/Calcutta'); echo date('Y-m-d [H:i:s a]'); ?></li>
    </ul>

    <?php
    function formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    function getServerLoad() {
        if (stristr(PHP_OS, 'win')) {
            return 'N/A'; // Server load not available on Windows without COM extension
        } else {
            if (is_readable('/proc/loadavg')) {
                $load = file_get_contents('/proc/loadavg');
                $load = explode(' ', $load);
                return implode(', ', array_slice($load, 0, 3));
            }
        }

        return 'N/A';
    }

    function getServerUptime() {
        if (stristr(PHP_OS, 'win')) {
            $uptime = shell_exec('net statistics server | find "Statistics since"');
            if ($uptime !== null) {
                $uptime = str_replace('Statistics since ', '', $uptime);
                return trim($uptime);
            }
        } else {
            $uptime = shell_exec('uptime -p');
            if ($uptime !== null) {
                return trim($uptime);
            }
        }

        return 'N/A';
    }
    ?>
                                        
                                    </div><!--------- end of card body---------->
                                </div><!--------- end of card---------->
                            </div><!--------- end of cold md 4---------->

                            




                         

                            
                        </div><!--------- end of row---------->













                </div>
    </main>








<?php require'footer.php';?>