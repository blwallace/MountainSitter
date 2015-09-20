
<script>
$(document).ready(function(){

  $('body').css('background-image',"url(/assets/images/whitney.jpg)");  
    //updates infortion
  searchTable();

});
</script>



<body>
	<div class = "container">
		<div class="row">
	    	<h3>
	    		<?php 
			    echo $this->session->flashdata('site_error');
			     ?>	
	    	</h3>
      <div class = "col-md-2"></div>

			<div class="col-md-8">
				<div class="intro">
					<h1>CAMPSITTER</h1>
          <h4>UNDER DEVELOPMENT: Search for recent weather records</h4>  
				</div>
			</div>

      <div class = "col-md-2"></div>

		</div>
    <div class="row">
      <div class = "col-md-3"></div>
      <div class="col-md-6">
        <h3 class="intro_class"> <form id="site_search"><input type = 'submit' class="btn-link" value='SEARCH'><input id="tags" type='text'></form></h3>
        <table class="table table-striped" id = "distance_results">

      </table>
      </div>
    <div class = "col-md-3"></div>  
    </div>

	</div>

<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-3">
    </div>
    <div class="col-md-3">

      <h3><?php 
        echo $this->session->flashdata('login_error');
        echo $this->session->flashdata('registration_error');
         ?>
      </h3>


<!--       <h3>Login</h3>
      <form action='/users/login' method='post'>
        <input type="text" placeholder="Email" name = 'email' class="form-control">
        <input type="password" placeholder="Password" name = 'password' class="form-control">
      <button type="submit" class="btn btn-success">Sign in</button>
      </form> -->

<!--       <h3>Registration</h3>
      <form action='/users/add' method='post'>
        <input type='text' name='email' class="form-control" placeholder="Email">
        <input type='text' name='alias' class="form-control" placeholder="Alias">
        <input type='password' name='password' class="form-control" placeholder="Password">
        <p>*****Password must be at least 8 characters</p>
        <input type='password' name='confirm' class="form-control" placeholder="Confirm Password">
        <button type="submit" class="btn btn-success">Register</button>
      </form> -->
    </div>
    <div class="col-md-3"></div>
  </div>