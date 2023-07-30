<?php require'header.php';

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

                  <hr>

                  <table width="">
                      
                  </table>

                     <div id="distance"></div>

                     <div id="price"></div>
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
          
        var pricePerKm = 10; // Define a price per kilometer
        var price = distance * pricePerKm; // Calculate the total price
        document.getElementById("distance").innerHTML = "Distance: " + distance.toFixed(2) + " km";
        document.getElementById("price").innerHTML = "Price: $" + price.toFixed(2);
        } 
      });
    }
  }
}


</script>







































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