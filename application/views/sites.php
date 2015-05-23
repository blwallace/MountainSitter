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
			        <th>City, State</th>
			        <th>Elevation</th>
			        <th>Latitude</th>
			        <th>Longitude</th>
			      </tr>
			    </thead>
			    <tbody>
<?php
				foreach($sites as $site)
				{?>		    
			      <tr>
			        <td><?= $site['full'] ?></td>			      	
			        <td><?= $site['site_name'] ?></td>
			        <td><?= $site['city'] ?>, <?=$site['state']?></td>
			        <td><?= $site['elevation'] ?></td>
			        <td><?= $site['longitude'] ?></td>
			        <td><?= $site['latitude'] ?></td>
			      </tr>
<?php 			}?>
			    </tbody>
			  </table>

			</div>
		</div>
	</div>
	
</div>