
<div class = "container">
	<div class="row">
		<div class="col-md-1"></div>	

		<div class="col-md-6">
			<form action="/recordings/find/<?= $id ?>" method="post">		
				<table class="table table-striped">
				      <tr>
				      	<th>Site Name</th>
				      	<th><?= $locations[0]['name'] ?> (<?=$locations[0]['station_id']?>)</th>
				      </tr>	
				      <tr>
				      	<td>Elevation</td>
				      	<td><?= $locations[0]['elevation'] ?></td>	
				      </tr>
				      <tr>
				      	<td>Start Time (No data before 8/23/16)</td>
				      	<td><input type="text" id="startdate" name="startdate" placeholder = "<?= date("D m/d/y",strtotime('now') - (60*60*24*6)) ?>"></td>
				      </tr>			      		
				      <tr>
				      	<td>End Time</td>
				      	<td><input type="text" id="enddate" name='enddate' placeholder = "<?= date("D m/d/y",strtotime('now')) ?>"></td>
				      </tr>		
				      <tr>
				      	<td>Forecast</td>
				      	<td><a href="wunderground.com">Click to Open in New Tab</a></td>
				      </tr>

				</table>		      	      
			</form>							
		</div>
		<div class = "col-md-4" id="map">

		    <script type="text/javascript">

			var map;
			function initMap() {
			  map = new google.maps.Map(document.getElementById('map'), {
				// center: {lat: -34.397, lng: 150.644},
				center: {lat: <?=$locations[0]['latitude']?>, lng:<?=$locations[0]['longitude']?>},			    
			    zoom: 8,
			  });
			}

		    </script>
		    <script async defer
		      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbQQ7ICe8rfgiHdUFj7fGevALG_kqSiVc&callback=initMap">
		    </script>
  		</div>

		<div class="col-md-1"></div>
	</div>		
