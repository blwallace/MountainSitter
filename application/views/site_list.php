<!-- shows a table of all the measured points -->
	<div class="row">
		<div class="col-xs-12">
			<div class="intro">

				<table class="table table-striped">
				    <thead>
				      <tr>
				      	<th>ID</th>
						<th>Document</th>
						<th>Time</th>
						<th>Weather</th>
						<th>Temp</th>
				      </tr>
				    </thead>
				    <tbody>
	<?php
					foreach($locations as $location)
					{?>		    
				      <tr>
				      	<td><?= $location['id'] ?></td>
				        <td><?= $location['name'] ?></td>
				        <td><?= $location['time'] ?></td>		      				        			        
				        <td><?= $location['weather'] ?></td>		      				        
				        <td><?= $location['temperature'] ?> F</td>		
		        
				      </tr>
	<?php 			}?>
				    </tbody>
				  </table>

			</div>
		</div>
	</div>