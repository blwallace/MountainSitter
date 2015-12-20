<script>
$(document).ready(function(){

     //updates infortion
  searchTable();

});
</script>
	<div class ='row'>
		<div class = "col-md-3"></div>
		<div class = "col-md-6">
			<form id="site_search">
				<h2>Search location or landmark</h2>
				<div class="centered">
				<p><input id="tags">
				<input type = 'submit' class="btn btn-success" value='Submit'></div></p>
			</form>				
			<table class="table table-striped" id = "distance_results">

			</table>
		</div>
		<div class = "col-md-3"></div>
	</div>
