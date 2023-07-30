<?php
require 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pickup = $_POST['pickup'];
    $dropoff = $_POST['dropoff'];

    // Geocode the pickup and dropoff addresses
    $pickupCoords = geocodeAddress($pickup);
    $dropoffCoords = geocodeAddress($dropoff);

    // Calculate the distance between the two points
    $distance = calculateDistance($pickupCoords, $dropoffCoords);
} else {
    $distance = null;
}

function geocodeAddress($address) {
    $geocoder = new \Geocoder\Geocoder();
    $result = $geocoder->geocode($address);

    return [
        'lat' => $result->latitude,
        'lng' => $result->longitude,
    ];
}

function calculateDistance($from, $to) {
    $earthRadius = 6371; // km

    $latFrom = deg2rad($from['lat']);
    $lngFrom = deg2rad($from['lng']);
    $latTo = deg2rad($to['lat']);
    $lngTo = deg2rad($to['lng']);

    $deltaLat = $latTo - $latFrom;
    $deltaLng = $lngTo - $lngFrom;

    $angle = 2 * asin(sqrt(pow(sin($deltaLat / 2), 2) +
        cos($latFrom) * cos($latTo) * pow(sin($deltaLng / 2), 2)));

    return $earthRadius * $angle;
}
?>
<!-- BEGIN: Content-->
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
    </div>
    <div class="content-body"><!-- Revenue, Hit Rate & Deals -->
      <div class="row">
        <div class="col-lg-8 col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Set Location</h4>
              <a class="heading-elements-toggle"></a>
              <div class="heading-elements">

              </div>
            </div>
            <div class="card-content collapse show">
              <div class="card-body p-0 pb-0">
                <form action="" method="POST">
                  <table width="100%" class="mytable">
                    <tr>
                      <th> <input class="form-control" style="border-color: navy;" type="text" id="pickup" name="pickup" placeholder="Enter Pick Up Point" required></th>
                    </tr>

                    <tr>
                      <th><input class="form-control" style="border-color: navy;" type="text" id="dropoff" name="dropoff" placeholder="Enter Drop Point" required></th>
                    </tr>
                  </table>

                  <br>

                  <input type="submit" id="submit" value="Submit" style="float:right;" class="btn btn-info">

                </form>
                <br>
              </div>
            </div>
          </div>
        </div>

        <style type="text/css">
          table,tr,th{
            padding: 9px 9px 9px 9px;
          }
        </style>

        <div class="col-lg-4 col-md-12">
          <div class="row">
            <div class="col-12">
              <div class="card pull-up">

                <div class="card">
                  <div class="card-body">
                    <div id="distance"></div>
                    <div id="map" style="height: 500px;width: 100%;"></div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- END: Content-->


<!-- BEGIN: Scripts -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfXf-LQP9u9U_ErdoOw8ONByB50QRTT9A&libraries=places"></script>
<script>
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 8,
    center: {lat: -34.397, lng: 150.644}
  });

  var directionsService = new google.maps.DirectionsService;
  var directionsDisplay = new google.maps.DirectionsRenderer({
    map: map,
    suppressMarkers: true
  });

  // Add markers to the map
  var pickupMarker = new google.maps.Marker({
    map: map,
    position: {lat: 0, lng: 0},
    icon: 'https://maps.google.com/mapfiles/kml/shapes/man.png'
  });

  var dropoffMarker = new google.maps.Marker({
    map: map,
    position: {lat: 0, lng: 0},
    icon: 'https://maps.google.com/mapfiles/kml/shapes/woman.png'
  });

  // Get the input fields
  var pickupInput = document.getElementById('pickup');
  var dropoffInput = document.getElementById('dropoff');

  // Autocomplete the input fields
  var pickupAutocomplete = new google.maps.places.Autocomplete(pickupInput);
  var dropoffAutocomplete = new google.maps.places.Autocomplete(dropoffInput);

  // When the pickup location is changed
  pickupAutocomplete.addListener('place_changed', function() {
    var pickupPlace = pickupAutocomplete.getPlace();
    pickupMarker.setPosition(pickupPlace.geometry.location);
    calculateAndDisplayRoute(directionsService, directionsDisplay);
  });

  // When the dropoff location is changed
  dropoffAutocomplete.addListener('place_changed', function() {
    var dropoffPlace = dropoffAutocomplete.getPlace();
    dropoffMarker.setPosition(dropoffPlace.geometry.location);
    calculateAndDisplayRoute(directionsService, directionsDisplay);
  });

  function calculateAndDisplayRoute(directionsService, directionsDisplay) {
    var pickup = pickupMarker.getPosition();
    var dropoff = dropoffMarker.getPosition();

    if (pickup && dropoff) {
      directionsService.route({
        origin: pickup,
        destination: dropoff,
        travelMode: 'DRIVING'
      }, function(response, status) {
        if (status === 'OK') {
          directionsDisplay.setDirections(response);

          // Calculate and display the distance
          var distance = response.routes[0].legs[0].distance.text;
          document.getElementById('distance').innerHTML = 'Distance: ' + distance;
        } 
      });
    }
  }
}
</script>
