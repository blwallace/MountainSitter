<html>
<head>
<title>Project Teton</title>
<link rel="stylesheet" href="/assets/css/bootstrap_v3_3_2.css">
<link rel="stylesheet" type="text/css" href="/assets/css/project.css">
<script src="/assets/js/jquery_v2_1_3.js"></script>
<script src="/assets/js/d3_v3_5_5.js"></script>
<script src="/assets/js/windhistory.js"></script>


</head>



<body>
<div class = "container">
	<div class="row">

    	<h3>
    		<?php 
		    echo $this->session->flashdata('site_error');
		     ?>	
    	</h3>

		<div class="col-xs-12">
			<div class="intro">
				<h1>Welcome!</h1>
				<h4><a href="/sites">See All Sites</a></h4>
				<h4><a href="/recordings">See All Recordings</a></h4>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="mountain">
				<form action='/sites/add' method='post'>
					<p>Enter Mountain to Load</p>
        			<input type="text" placeholder="ENTER PWS" name = 'site' class="form-control">
      				<button type="submit" class="btn btn-success">Submit</button>
      			</form>
			</div>
		<svg width="2000" height="650">
		</svg>	
		</div>
	</div>
</div>
