<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

  <center>
    <h4>Dear, <b>DEEPAK KUMAR</b></h4>
  
  <br>
  <img src="https://i.pinimg.com/originals/39/d9/d1/39d9d12f7360ee2650b039818da184f0.gif" style="width: 100px; height:100px"><br>
  <p style="font-size:20px;">
  Your Ride Request has been: <b style="color:green;">Confirmed</b>
  <br>
  Ride Data as you requested


  <table width="100%">
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

</center>
</p>
</body>
</html>