
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
  			console.log(server_data);
	        var trHTML = '';
	        $.each(server_data.table_data, function (i, item) {
		            trHTML += '<tr><td>' + item.wind_dir + '</td><td>' + item.time + '</td><td>' + item.wind_mph + 'mph</td><td>' + item.wind_gust_mph + 'mph</td></tr>';
	        });
	        $('#table_windrose').append(trHTML); 	

	        //create summary table starting with header
	        var tsHTML = '<tr><th>DATE</th>';
	        $.each(server_data.table_data_days, function(i,item){
	        	tsHTML += '<th>' + i + '</th>';
	        	})
	        tsHTML += '</tr>';
	        $('#weather_summary').append(tsHTML);


	        var tfHTML = '<tr><td><b>Temp Max/Min</b></td>';	        
	        $.each(server_data.table_data_days, function(i,item){
	        	tfHTML += '<td><p>High: ' + item.tempf_high + '</p><p>Low: ' + item.tempf_low +'</p></td>';
	        	})
	        tfHTML += '</tr>';	        
	        $('#weather_summary').append(tfHTML);

	        var twHTML = '<tr><td><b>Wind Max</b></td>';	
	        $.each(server_data.table_data_days, function(i,item){
	        	twHTML += '<td>' + item.windspeed_high +' mph</td>';
	        	})
	        twHTML += '</tr>';	        
	        $('#weather_summary').append(twHTML);	        
			}); 		

  		//updates infortion
		$('input').change(function(event) {
		    event.stopPropagation();
		    delay(function(){
	  		$.post('/recordings/find/<?= $id ?>',$('form').serialize(),function(result){	  			
	  			$("#windrose_frame").empty();
	  			$("#speedrose_frame").empty();
	  			$("#table_windrose").empty();
				$("#weather_summary").empty();	  			

	  			var server_data = (JSON.parse(result));	

	  			createGraphs(server_data);

	  			//create wind speed table
		        var trHTML = '';
		        $.each(server_data.table_data, function (i, item) {
		            trHTML += '<tr><td>' + item.wind_dir + '</td><td>' + item.time + '</td><td>' + item.wind_mph + 'mph</td></tr>';
		        });
		        $('#table_windrose').append(trHTML); 

				var tsHTML = '<tr><th>DATE</th>';
		        $.each(server_data.table_data_days, function(i,item){
		        	tsHTML += '<th>' + i + '</th>';
		        	})
		        tsHTML += '</tr>';
		        $('#weather_summary').append(tsHTML);

		        var tfHTML = '<tr><td><b>Temp Max/Min</b></td>';	        
		        $.each(server_data.table_data_days, function(i,item){
		        	tfHTML += '<td><p>High: ' + item.tempf_high + '</p><p>Low: ' + item.tempf_low +'</p></td>';
		        	})
		        tfHTML += '</tr>';	        
		        $('#weather_summary').append(tfHTML);	       

		        var twHTML = '<tr><td><b>Wind Max</b></td>';	
		        $.each(server_data.table_data_days, function(i,item){
		        	twHTML += '<td>' + item.windspeed_high +' mph</td>';
		        	})
		        twHTML += '</tr>';	        
		        $('#weather_summary').append(twHTML);		         


			})			    	
		    }, 250 );
		    return false;
		})
			
	});
</script>