<script>
	$(document).ready(function(){
		$('body').css('background-image',"url(/assets/images/whitney.jpg)");
	});

</script>




<body>
<div class = "jumbotron">
	<div class = "container">
		<div class="row">
	    	<h3>
	    		<?php 
			    echo $this->session->flashdata('site_error');
			     ?>	
	    	</h3>

			<div class="col-xs-12">
				<div class="intro">
					<h1>MOUNTAIN SITTER</h1>
					<h4><a href="/sites">See All Sites</a></h4>
					<h4><a href="/recordings">See All Recordings</a></h4>
				</div>
			</div>
		</div>
	</div>
</div>	