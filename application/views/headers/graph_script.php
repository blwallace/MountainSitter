
<script>

	$(document).ready(function(){

		$(function() {
			    $( "#startdate" ).datepicker();
			  });
			$(function() {
			    $( "#enddate" ).datepicker();
			  });	

		
		//get initial data  		
  		$.get('/recordings/find/<?= $id ?>',function(result){
  			//creates graph
  			var server_data = (JSON.parse(result));		
  			createGraphs(server_data);

	        var trHTML = '';
	        $.each(server_data.table_data, function (i, item) {
		            trHTML += '<tr><td>' + item.wind_dir + '</td><td>' + item.time + '</td><td>' + item.wind_mph + 'mph</td><td>' + item.wind_gust_mph + 'mph</td></tr>';
	        });
	        $('#table_windrose').append(trHTML); 			
				}); 		

  		//updates infortion
		$('input').change(function(event) {
		    event.stopPropagation();
		    delay(function(){
	  		$.post('/recordings/find/<?= $id ?>',$('form').serialize(),function(result){	  			
	  			$("#windrose_frame").empty();
	  			$("#speedrose_frame").empty();
	  			$("#table_windrose").empty();

	  			var server_data = (JSON.parse(result));	

	  			createGraphs(server_data);
		        var trHTML = '';
		        $.each(server_data.table_data, function (i, item) {
		            trHTML += '<tr><td>' + item.wind_dir + '</td><td>' + item.time + '</td><td>' + item.wind_mph + 'mph</td></tr>';
		        });
		        $('#table_windrose').append(trHTML); 	  			
			})			    	
		    }, 250 );
		    return false;
		})
			
	});
</script>