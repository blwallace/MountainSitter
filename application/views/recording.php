<div class = "container">
	<div class="row">
		<div class="col-xs-12">
			<div class="intro">

			<h4><a href="/sites/add_document">Update Sites Documents</a></h4>
			
			<form action="/recordings/show/<?= $id ?>" method="post">		
				<p>Start Date: <input type="text" id="startdate" name="startdate"></p>
				<p>End Date: <input type="text" id="enddate" name='enddate'></p>
				<button type="submit" name = 'action' class="btn btn-default">Submit</button>
			</form>				
			
		</div>
	</div>
</div>		