
<script>

	$(document).ready(function(){

		$(function() {
		    $( "#startdate" ).datepicker({
	            dateFormat: "mm/dd/yy",
	            maxDate: 0,
	            onSelect: function (date) {
	                var date2 = $('#startdate').datepicker('getDate');
	                var arg = date2;
	                date2.setDate(date2.getDate() + 6);
	                $('#enddate').datepicker('setDate', date2);
		    delay(function(){
	  		$.post('/recordings/find/<?= $id ?>',$('form').serialize(),function(result){	

	  			//clear out existing graphs and tables  			
	  			$("#windrose_frame").empty();
	  			$("#speedrose_frame").empty();
	  			$("#table_windrose").empty();
				$("#weather_summary").empty();	  			

				//format ajax result
	  			var server_data = (JSON.parse(result));	

	  			//creates windrose
	  			createGraphs(server_data);

	  			//creates tables
	  			ajax_formatting_table(server_data);
	  			

			})			    	
		    }, 250 );	                
	            	}
	        	});
		  	});
		$(function() {
		    $( "#enddate" ).datepicker({
	            dateFormat: "mm/dd/yy",
	            maxDate: 0,  
	             onSelect: function (date) {
	                var date2 = $('#enddate').datepicker('getDate');
	                var arg = date2;
	                date2.setDate(date2.getDate() - 6);
	                $('#startdate').datepicker('setDate', date2);
				    delay(function(){
			  		$.post('/recordings/find/<?= $id ?>',$('form').serialize(),function(result){	

			  			//clear out existing graphs and tables  			
			  			$("#windrose_frame").empty();
			  			$("#speedrose_frame").empty();
			  			$("#table_windrose").empty();
						$("#weather_summary").empty();	  			

						//format ajax result
			  			var server_data = (JSON.parse(result));	

			  			//creates windrose
			  			createGraphs(server_data);

			  			//creates tables
			  			ajax_formatting_table(server_data);
			  			

					})			    	
				    }, 250 )	                
	            }
	        });
		  });	

		
		//get initial data  		
  		$.get('/recordings/find/<?= $id ?>',function(result){
  			//formats ajax result
  			var server_data = (JSON.parse(result));	

  			//creates windrose	
  			createGraphs(server_data);

  			//creates tables
  			ajax_formatting_table(server_data);

	            
			}); 		

  // 		//updates infortion
		// $('input').change(function(event) {
		//     event.stopPropagation();
		//     delay(function(){
		    	
		//     }, 250 );
		//     return false;
		// })
			
	});
</script>