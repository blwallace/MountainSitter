function ajax_formatting_table(server_data)
{
	//creates max wind speed table
	var trHTML = '<tr><th></th><th>Date</th><th>Time</th><th>Wind Speed</th><th>Wind Gust</th></tr>';	
	$.each(server_data.table_data, function (i, item) 
	{
		trHTML += '<tr><td>' + item.wind_dir + '</td><td>' + item.date + '</td><td>' +item.time + '</td><td>' + item.wind_mph + 'mph</td><td>' + item.wind_gust_mph + 'mph</td></tr>';
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

