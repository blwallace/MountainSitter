<html>
<head>
<title>Project Teton</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="/assets/css/project.css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>


    <script>
    $(document).ready(function(){
	// $.ajax({
	// 	  url : "http://api.wunderground.com/api/de7ee2cef1184d4c/conditions/q/pws:MHSQC1.json",
	// 	  dataType : "jsonp",
	// 	  success : function(parsed_json) {
	// 	  console.log(parsed_json);
	// 	  }
	// 	  });
    });

  </script>
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
		</div>
	</div>
</div>
