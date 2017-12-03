<html>
    <head>
        <title>Sign Up</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script>
            function getCityInfo() {
                 $.ajax({
                    type: "GET",
                    url: "http://hosting.otterlabs.org/laramiguel/ajax/zip.php",
                    dataType: "json",
                    data: {
                        "zip_code": $("#zip").val()
                    },
                    success: function(data,status) {
                        console.log(data); 
                        $("#zip-code-error-msg").html("");
                        
                        if (!data.city) {
                            $("#zip-code-error-msg").html("Zip code is invalid").css("color","red"); 
                            return; 
                        }
                        $("#city").html(data.city);
                        $("#lon").html(data.longitude);
                        $("#lat").html(data.latitude);
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                         //alert(status);
                    }
                 });
            }
            
            function getCountyList() {
            $.ajax({
                    type: "GET",
                    url: "http://hosting.otterlabs.org/laramiguel/ajax/countyList.php?",
                    dataType: "json",
                    data: { "state": $("#state").val()},
                    success: function(data,status) {
                    //alert(data);
                    console.log(data);
                    $("#county").html("<option> Select One </option>");
                    for (var i=0; i< data['counties'].length; i++){
                        $("#county").append("<option>" + data["counties"][i].county + "</option>" );
                    }
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                    //alert(status);
                    }
                    });//ajax
            }
            
            function validateUsername() {
                $.ajax({
                    type: "GET",
                    url: "api.php",
                    dataType: "json",
                    data: {
                        'username': $('#username').val(),
                        'action': 'validate-username'
                    },
                    success: function(data,status) {
                        debugger;
                        
                        if (data.length > 0) {
                            $('#username-valid').html("Username is not available").css("color","red"); 
                        } else {
                            $('#username-valid').html("Username is available").css("color","green");
                        }
                        
                      },
                    complete: function(data,status) { //optional, used for debugging purposes
                         //alert(status);
                    }
                });
                    }
        </script>
    </head>
    <body>
        <form onsubmit="return false;" class="form-horizontal">
        <fieldset>
            <legend>Sign Up</legend>
             <div class="form-group">
                  <label class="col-md-4 control-label" for="first">First:</label>  
                  <div class="col-md-4">
                  <input id="first" class="form-control input-md" type="text">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-md-4 control-label" for="last">Last:</label>  
                  <div class="col-md-4">
                  <input id="last"class="form-control input-md" type="text">
                  </div>
                </div>
            
                <div class="form-group">
                  <label class="col-md-4 control-label" for="email">Email:</label>  
                  <div class="col-md-4">
                  <input id="email" class="form-control input-md" type="text">
                  </div>
                </div>
              
                <div class="form-group">
                  <label class="col-md-4 control-label" for="phone">Phone Number:</label>  
                  <div class="col-md-4">
                  <input id="phone"class="form-control input-md" type="text">
                  </div>
                </div>
            
             <div class="form-group">
                  <label class="col-md-4 control-label" for="zip">Zip Code:</label>  
                  <div class="col-md-4">
                  <input class="form-control input-md" id="zip" onchange="getCityInfo();" type="text"> <span id="zip-code-error-msg"></span><br/>
                  <strong>City:</strong>  <span id="city"></span> <br/>
                  <strong>Latitude:</strong> <span id="lon"></span> <br/>
                  <strong>Longitude:</strong> <span id="lat"></span><br/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-4 control-label" for="state">State:</label>  
                  <div class="col-md-4">
                  <input id="state" onchange="getCountyList();"type="text" class="form-control input-md" required="">
                  </div>
                </div>
   
                <br/>
            
                <div class="form-group">
                  <label class="col-md-4 control-label" for="county">County:</label>  
                  <div class="col-md-4">
                  <select class="form-control input-md" id="county"></select>
                  </div>
                </div>
              
                <div class="form-group">
                  <label class="col-md-4 control-label" for="username">Desired Username:</label>  
                  <div class="col-md-4">
                  <input class="form-control input-md" onchange="validateUsername();" id='username' type="text"> <span id="username-valid"></span></span>
                  </div>
                </div>
              
                <div class="form-group">
                  <label class="col-md-4 control-label" for="password">Password:</label>  
                  <div class="col-md-4">
                  <input id="password"class="form-control input-md" type="text">
                  </div>
                </div>
         
                <div class="form-group">
                  <label class="col-md-4 control-label" for="password2">Type Password Again:</label>  
                  <div class="col-md-4">
                  <input id="password2"class="form-control input-md" type="text">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-4 control-label" for="signup"></label>
                  <div class="col-md-4">
                    <button id="signup" name="signup" class="btn btn-primary">Sign Up</button>
                  </div>
                </div>
        </fieldset>
        </form>
    </body>
</html>
