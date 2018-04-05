<!DOCTYPE html>
<html lang="en" data-ng-app="myApp"> 
<head>
    <title>Staff Log In</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,
    initial-scale=1.0" />
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5
    elements and media queries -->
    
    <link href="bootstrap/css/form.css" rel="stylesheet" />
</head>

<body data-ng-controller="myCtrl"> 
    

    
<div class="row">
    <div class="col-md-6 col-md-12 col-md-6 col-md-offset-3">
		<div class="panel panel-primary">
			<div class="panel-heading"> Staff Log in </div>
			<div class="panel-body">
			<p>{{msg}}</p>
				<form name="myform">
                    
                      <div class="form-group">
						<label for="username">User Name: </label>
						<input type="text" name="username" class="form-control" data-ng-model="uname">
						
					</div>
                    
					<div class="form-group">
						<label for="password">Password: </label>
                        <input type="password" name="password" class="form-control" maxlength="12" data-ng-model="pword">
					</div>
					
					<input type="button" name="login" value="Log In" data-ng-click="check(uname,pword)" />
			
				</form>
			</div>
		</div>
	</div>
</div>
  

			<!-- jQuery – required for Bootstrap plugins) --> 
            <script src="js/jquery.min.js"></script> 
            <!-- All Bootstrap  plug-ins  file --> 
            <script src="js/bootstrap.min.js"></script> 
            <!-- Basic AngularJS --> 
            <script src="js/angular.min.js"></script> 
            <!-- Your Controller --> 
            <script src="app.js"></script>
			
			<!-- jQuery – required for Bootstrap's JavaScript plugins) -->
			<script src="bootstrap/js/jquery.min.js"></script>
			<!-- All Bootstrap plug-ins file -->
			<script src="bootstrap/js/bootstrap.min.js"></script>
			<!-- Basic AngularJS -->
			<script src="bootstrap/js/angular.min.js"></script>
			<script src="bootstrap/js/form.js"></script>
</body>
</html>