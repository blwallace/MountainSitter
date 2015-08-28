
<div class = "container">
	<div class="row">
		<div class="col-md-1"></div>	

		<div class="col-md-10">
			<form action="/recordings/find/<?= $id ?>" method="post">		
				<table class="table table-striped">
				      <tr>
				      	<th>Site Name</th>
				      	<th><?= $locations[0]['name'] ?></th>
				      </tr>	
				      <tr>
				      	<td>Start Time</td>
				      	<td><input type="text" id="startdate" name="startdate" placeholder = "<?= $locations[0]['time'] ?>"></td>
				      </tr>			      		
				      <tr>
				      	<td>End Time</td>
				      	<td><input type="text" id="enddate" name='enddate' placeholder = "<?= $locations[count($locations)-1]['time'] ?>"></td>
				      </tr>	
				      <tr>
				      	<td>View</td>
				      	<td><div><input type="checkbox" id = "graph_speed" name="graph_speed" checked>Wind Direction Graph</div>
				      		<div><input type="checkbox" id = "graph_speed" name="graph_speed" checked>Speed Intensity Graph</div>
				      		<div><input type="checkbox" id = "graph_speed" name="graph_speed" checked>Data Dump</div></td>

				      </tr>					      
				</table>		      	      
				<button type="submit" name = 'action' class="btn btn-default">Submit</button>
			</form>							
		</div>

		<div class="col-md-1"></div>
	</div>		
