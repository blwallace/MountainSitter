
<script>
$(document).ready(function(){

  $('body').css('background-image',"url(/assets/images/whitney.jpg)");  
    //updates infortion
  $('#tags').keyup(function(event) {  
      event.stopPropagation();
      delay(function(){
        var queryVal = $('#tags').val();
        var website = "http://autocomplete.wunderground.com/aq?query=" + queryVal + "&format=jsonp&c=US";
      $.ajax({
            type: "GET",
            url: website,
            async:true,
          jsonp: 'cb',              
        jsonpCallback: 'callback',
            dataType : 'jsonp',   //you may use jsonp for cross origin request
            crossDomain:true,
            success: function(data, status, xhr) {
                availableTags =[];
                console.log(data);
          for (var key in data.RESULTS) {
             if (data.RESULTS.hasOwnProperty(key)) {
                 var obj = data.RESULTS[key];
                      if (prop = 'name')
                      {
                        availableTags.push(obj[prop])
                      }                  
                  for (var prop in obj) {
                    if(obj.hasOwnProperty(prop)){
                    }
                 }
              }
          }
            $( "#tags" ).autocomplete({
              source: availableTags
            });           
            }
        });
      }, 25 );
      return false;
  })  
  
  $('#site_search').submit(function(event){
      var lat = 0;
      var lon = 0;
      var name = '';
        var queryVal = $('#tags').val();
        var website = "http://autocomplete.wunderground.com/aq?query=" + queryVal + "&format=jsonp&c=US";
      $.ajax({
            type: "GET",
            url: website,
            async:true,
          jsonp: 'cb',              
        jsonpCallback: 'callback',
            dataType : 'jsonp',   //you may use jsonp for cross origin request
            crossDomain:true,
            success: function(data, status, xhr) {
                availableTags =[];
          for (var key in data.RESULTS) {
             if (data.RESULTS.hasOwnProperty(key)) {
                 var obj = data.RESULTS[key];
                      if (prop = 'name')
                      {
                        name = obj[prop];
                      } 
                      if (prop = 'lat')
                      {
                        lat = obj[prop];
                      }     
                      if (prop = 'lon')
                      {
                        lon = obj[prop]
                      }     
                      break;                           
                  for (var prop in obj) {
                    if(obj.hasOwnProperty(prop)){
                    }
                 }
              }
          } 

          // console.log(lat + lon + name);

          $.ajax({
            type: "POST",
            url: "/sites/locate",
            data: {
                'name': name,
                'lat': lat,
                'lon': lon
                },
            success: function(data, status, xhr){
              var results = JSON.parse(data);
              ajax_formatting_table_distance(results);
              console.log(results);
            }

          })

            }
        });     
      event.preventDefault(); 
  })

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
      <div class = "col-md-3"></div>

			<div class="col-md-6">
				<div class="intro">
					<h1 ><a href="sites" class="intro_class" ></a></h1>
          <h3></h3>  
				</div>
			</div>

      <div class = "col-md-3"></div>

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