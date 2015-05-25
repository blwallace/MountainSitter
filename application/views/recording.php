<div class = "container">
	<div class="row">
		<div class="col-xs-12">
			<div class="intro">
			<h4><a href="/sites/add_document">Update Sites Documents</a></h4>


			<table class="table table-striped">
			    <thead>
			      <tr>
					<th>Document</th>
					<th>Weather</th>
					<th>Temp</th>
			      </tr>
			    </thead>
			    <tbody>
<?php
				foreach($locations as $location)
				{?>		    
			      <tr>
			        <td><?= $location['name'] ?></td>
			        <td><?= $location['weather'] ?></td>		      				        
			        <td><?= $location['temp'] ?> F</td>		
	        
			      </tr>
<?php 			}?>
			    </tbody>
			  </table>

			</div>
		</div>
	</div>
	
</div>