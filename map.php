<?php 
    include 'connect.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Directions service</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div id="floating-panel">
    <b>Start: </b>
    <select id="start">
    	<?php 
    	       $query = mysqli_query($con, "SELECT * FROM map");
    	       while ($row = mysqli_fetch_array($query)) {
    	          
    	?>
      		<option value="<?php echo $row['name']?>"><?php echo $row['name'];?></option>
     	<?php }?>
    </select>
    <b>End: </b>
    <select id="end">
      <?php 
    	       $query = mysqli_query($con, "SELECT * FROM map");
    	       while ($row = mysqli_fetch_array($query)) {
    	          
    	?>
      		<option value="<?php echo $row['name']?>"><?php echo $row['name'];?></option>
     	<?php }?>
    </select>
    </div>
    <div id="map"></div>
    <script>
      function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 7,
          center: {lat: 10.033758, lng: 105.773774}
        });
        directionsDisplay.setMap(map);

        var onChangeHandler = function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        };
        document.getElementById('start').addEventListener('change', onChangeHandler);
        document.getElementById('end').addEventListener('change', onChangeHandler);
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        directionsService.route({
          origin: document.getElementById('start').value,
          destination: document.getElementById('end').value,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUMtIZEzEwh-1C3GWpk-iwl6s-k-d3_Bs&callback=initMap">
    </script>
  </body>
</html>