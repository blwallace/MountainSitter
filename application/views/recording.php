<div class = "container">
	<div class="row">
		<div class="col-xs-12">
			<div class="intro">
			<h4><a href="/sites/add_document">Update Sites Documents</a></h4>
			<h3>Temperature</h3>
			<div id = "temp_graph"></div>		
			<!-- Script to generate graph -->
			<script>
			var w = 10000;
			var h = 100;

			var dataset = <?= json_encode($d3_datas) ?>;

			console.log(dataset);
			

			var temp_graph = d3.select("#temp_graph")
			            .append("svg")
			            .attr("width", w)
			            .attr("height", h);

			temp_graph.selectAll("circle")
			   .data(dataset)
			   .enter()
			   .append("circle")
			   .attr("cx", function(d,i) {
			        return i *10;
			   })
			   .attr("cy", function(d) {
			        return d[1];
			   })
			   .attr("r", 1);
  			
			</script>

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
	
</div>