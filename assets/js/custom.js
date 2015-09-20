function ajax_formatting_table(server_data)
{
	//creates max wind speed table
	var trHTML = '<tr><th>:↔:</th><th>Speed</th><th>Gust</th><th>Date</th><th>Time</th></tr>';	
	$.each(server_data.table_data, function (i, item) 
	{
		trHTML += '<tr><td>' + item.wind_dir + '</td><td>' + item.wind_mph + ' mph</td><td>' + item.wind_gust_mph + ' mph</td><td>' + item.date + '</td><td>' +item.time + '</td></tr>';
	});
	$('#table_windrose').append(trHTML); 	

	//create summary table starting with header
	var tsHTML = '<tr><th>DATE</th>';
	//adds the date to the weather summary
	$.each(server_data.table_data_days, function(i,item)
	{
		tsHTML += '<th>' + i + '</th>';
	});
	tsHTML += '</tr>';
	$('#weather_summary').append(tsHTML);

	//creates max min temps
	var tfHTML = '<tr><td><b>Temp Max/Min</b></td>';
	$.each(server_data.table_data_days, function(i,item)
	{
		tfHTML += '<td><p>High: ' + item.tempf_high + '</p><p>Low: ' + item.tempf_low +'</p></td>';
	});
	tfHTML += '</tr>';	        
	$('#weather_summary').append(tfHTML);

	//creaets max wind
	var twHTML = '<tr><td><b>Wind Max</b></td>';	
	$.each(server_data.table_data_days, function(i,item)
	{
		twHTML += '<td>' + item.windspeed_high +' mph</td>';
	})
	twHTML += '</tr>';	        
	$('#weather_summary').append(twHTML);		
}

function ajax_formatting_table_distance(server_data)
{
	var trHTML = '<tr><th>Location</th><th>Distance</th><th>Station ID</th></tr>';	
	$.each(server_data, function (i, item) 
	{
		trHTML += "<tr><td><a href='/recordings/search/" + item.id + "'>" + item.location +"</a></td><td>"+ item.distance +" miles</td><td>" + item.station_id + "</td></tr>";
	});
	$('#distance_results').append(trHTML);	

}

function searchTable()
{
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
							$('#distance_results').empty();
							ajax_formatting_table_distance(results);
							console.log(results);
						}

					})

		        }
		    });		  
		  event.preventDefault();	
	})
}

