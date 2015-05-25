<div class = "container">
	<div class="row">
		<div class="col-xs-12">
			<div class="intro">
			<h4><a href="/sites/add_document">Update Sites Documents</a></h4>


			<table class="table table-striped">
			    <thead>
			      <tr>
					<th>Full Name</th>
			        <th>PWS</th>
			        <th>Elevation</th>
			        <th>Latitude</th>
			        <th>Longitude</th>
			        <th>Status</th>
			        <th>Action</th>
			        <th>Delete</th>
			      </tr>
			    </thead>
			    <tbody>
<?php
				foreach($sites as $site)
				{?>		    
			      <tr>
			        <td><?= $site['full'] ?></td>			      	
			        <td><?= $site['site_name'] ?></td>
			        <td><?= $site['elevation'] ?></td>
			        <td><?= $site['longitude'] ?></td>
			        <td><?= $site['latitude'] ?></td>

<?php

					//Updates sites table.
					if ($site['deactivated_at'] == '')
					{
			       		echo  "<td><a href='/recordings/show/" . $site['id'] . "'>Recording</a></td>";
					}

					else 
					{
			       		echo  "<td><a href='/recordings/show/" . $site['id'] . "'>Not Recording</a></td>";
					}


?>
<?php

					//Updates sites table.
					if ($site['deactivated_at'] == '')
					{
			       		echo  "<td><a href='/sites/deactivate/" . $site['id'] . "'>Deactivate</a></td>";
					}

					else 
					{
			       		echo  "<td><a href='/sites/activate/" . $site['id'] . "'>Activate</a></td>";
					}


?>
<?php

					//Updates sites table.
					if ($site['deleted_at'] == '')
					{
			       		echo  "<td><a href='/sites/delete/" . $site['id'] . "'>Delete</a></td>";
					}

					else 
					{
			       		echo  "<td><a href='/sites/revive/" . $site['id'] . "'>Revive</a></td>";
					}


?>			        
			      </tr>
<?php 			}?>
			    </tbody>
			  </table>

			</div>
		</div>
	</div>
	
</div>