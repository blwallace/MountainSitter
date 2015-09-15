
<script>

	$(document).ready(function(){

		// function createGraphs(data){

		// 	var svg = d3.select("#windrose_frame")
		// 	            .append("svg")
		// 	            .attr("width", "100%")
		// 	            .attr("height", "100%");

		// 	//setup some containers to put the plots inside
		// 	var big = svg.append("g")
		// 	  .attr("id", "windrose")
		// 	  // .attr("transform", "translate(" + [35, 35] + ")");

		// 	drawBigWindrose(data, "#windrose", "caption")

		// 	//Style the plots, this doesn't capture everything from windhistory.com  
		// 	svg.selectAll("text").style( { font: "14px sans-serif", "text-anchor": "middle" });

		// 	svg.selectAll(".arcs").style( {  stroke: "#000", "stroke-width": "0.5px", "fill-opacity": 1, fill:"blue" });
		// 	svg.selectAll(".caption").style( { font: "18px sans-serif" });
		// 	svg.selectAll(".axes").style( { stroke: "#aaa", "stroke-width": "0.5px", fill: "none" })
		// 	svg.selectAll("text.labels").style( { "letter-spacing": "1px", fill: "#444", "font-size": "12px" })
		// 	svg.selectAll("text.arctext").style( { "font-size": "9px" })

		// }

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