


<div class = "container">
	<div class="row">
		<div class="col-xs-12">
			<div class="intro">
			<table class="table table-striped">
			      <tr>
			      	<th>Site Name<th>
			      	<th><?= $locations[0]['name'] ?></th>
			      </tr>	
			      <tr>
			      	<td>Start Time<td>
			      	<td><?= $locations[0]['time'] ?></td>
			      </tr>			      		
			      <tr>
			      	<td>End Time<td>
			      	<td><?= $locations[count($locations)-1]['time'] ?></td>
			      </tr>	
			</table>		      	      
			<form action="/recordings/find/<?= $id ?>" method="post">		
				<h4>Change Start/End Date:</h4>
				<p>Start Date: <input type="text" id="startdate" name="startdate"></p>
				<p>End Date: <input type="text" id="enddate" name='enddate'></p>
				<button type="submit" name = 'action' class="btn btn-default">Submit</button>
			</form>				
			
		</div>
	</div>
</div>		