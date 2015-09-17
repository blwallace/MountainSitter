
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

  			ajax_formatting_table(server_data);

	            
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

	  			ajax_formatting_table(server_data);
	  			

			})			    	
		    }, 250 );
		    return false;
		})
			
	});
</script>