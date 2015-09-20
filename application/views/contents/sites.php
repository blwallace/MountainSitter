<script>
$(document).ready(function(){

		//updates infortion
	$('#tags').keyup(function(event) {	
	    event.stopPropagation();
	    delay(function(){
	    	var queryVal = $('#tags').val();
	    	var website = "http://autocomplete.wunderground.com/aq?query=" + queryVal + "&format=jsonp&c=US";
			$.ajax({
		        type: "GET",
		        url: website,
		        async:true,
					jsonp: 'cb',			        
				jsonpCallback: 'callback',
		        dataType : 'jsonp',   //you may use jsonp for cross origin request
		        crossDomain:true,
		        success: function(data, status, xhr) {
		            availableTags =[];
		            console.log(data);
					for (var key in data.RESULTS) {
					   if (data.RESULTS.hasOwnProperty(key)) {
					       var obj = data.RESULTS[key];
					            if (prop = 'name')
					            {
					            	availableTags.push(obj[prop])
					            }						       
					        for (var prop in obj) {
					          if(obj.hasOwnProperty(prop)){
					          }
					       }
					    }
					}
				    $( "#tags" ).autocomplete({
				      source: availableTags
				    });						
		        }
		    });
	    }, 25 );
	    return false;
	})	
	
	$('#site_search').submit(function(event){
			var lat = 0;
			var lon = 0;
			var name = '';
	    	var queryVal = $('#tags').val();
	    	var website = "http://autocomplete.wunderground.com/aq?query=" + queryVal + "&format=jsonp&c=US";
			$.ajax({
		        type: "GET",
		        url: website,
		        async:true,
					jsonp: 'cb',			        
				jsonpCallback: 'callback',
		        dataType : 'jsonp',   //you may use jsonp for cross origin request
		        crossDomain:true,
		        success: function(data, status, xhr) {
		            availableTags =[];
					for (var key in data.RESULTS) {
					   if (data.RESULTS.hasOwnProperty(key)) {
					       var obj = data.RESULTS[key];
					            if (prop = 'name')
					            {
					            	name = obj[prop];
					            }	
					            if (prop = 'lat')
					            {
					            	lat = obj[prop];
					            }			
					            if (prop = 'lon')
					            {
					            	lon = obj[prop]
					            }			
					            break;		            		       
					        for (var prop in obj) {
					          if(obj.hasOwnProperty(prop)){
					          }
					       }
					    }
					}	

					// console.log(lat + lon + name);

					$.ajax({
						type: "POST",
						url: "/sites/locate",
						data: {
								'name': name,
								'lat': lat,
								'lon': lon
								},
						success: function(data, status, xhr){
							var results = JSON.parse(data);
							ajax_formatting_table_distance(results);
							console.log(results);
						}

					})

		        }
		    });		  
		  event.preventDefault();	
	})

});
</script>


<div class = "container">
	<div class ='row'>
		<div class = "col-md-3"></div>
		<div class = "col-md-6">
			<form id="site_search">
				<h4>Search</h4>
				<input id="tags">
				<input type = 'submit' class="btn btn-success" value='Submit'>
			</form>				
			<table class="table table-striped" id = "distance_results">

			</table>
		</div>
		<div class = "col-md-3"></div>
	</div>
	<div class="row">
		<div class = "col-md-3"></div>
		<div class = "col-md-6">				
			<div class="mountain">
			<form action='/sites/add' method='post'>
				<h4>Add New Mountain</h4>
    			<input type="text" placeholder="ENTER PWS" name = 'site' class="form-control">
  				<button type="submit" class="btn btn-success">Submit</button>
  				<h4><a href="/sites/add_document">Force Update</a></h4>
  			</form>
		</div>
		</div>
		<div class = "col-md-3"></div>	
		</div>	
	<div class="row">
		<div class="col-xs-12">
			<div class="intro">
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
			       		echo  "<td><a href='/recordings/search/" . $site['id'] . "'>Recording</a></td>";
					}

					else 
					{
			       		echo  "<td><a href='/recordings/search/" . $site['id'] . "'>Not Recording</a></td>";
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