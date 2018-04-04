<?php require 'server.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,
    initial-scale=1.0" />
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5
    elements and media queries -->
    <link href="styles/style.css" rel="stylesheet" />
    
    <link href="bootstrap/css/form.css" rel="stylesheet" />
</head>

<body>
    

    
<div style="margin:50px;" class="row">
    <div class="col-md-6 col-md-12 col-md-6 col-md-offset-3">
		<div class="panel panel-primary">
			<div class="panel-heading"> Log in </div>
			<div class="panel-body">
				<form method="POST" action="login.php" onsubmit="Validate()" name="myform">
                    
                      <div class="form-group">
						<label for="username">User Name: </label>
						<input type="text" name="username" id="uname" class="form-control" value="<?php if (isset($_POST["username"])) echo $_POST["name"]; ?>">
						<span id="error_uname" class="text-danger"></span>
					</div>
                    
					<div class="form-group">
						<label for="password">Password: </label>
                        <input type="password" name="password" class="form-control" maxlength="12">
                        <?php require 'errors.php'; ?><br>
                        <span id="error_password"></span>
					</div>
					
					<button name="login" type="submit" value="login" class="btn btn-primary center">Login</button>
                    
                    <p> Not yet a member? <a href="Registration%20Form.php"> Sign Up </a></p>
			
				</form>

			</div>
		</div>
	</div>
</div>
  
    <div class="footer">
	<h3>Contact Information</h3>
	<p>Steven : 010-8328234</p>
	<p>Alberto : 019-43942934</p>
	<p>Malibu : 013-24567892</p>
</div> 
            

    <!-- jQuery – required for Bootstrap's JavaScript plugins) -->
    <script src="bootstrap/js/jquery.min.js"></script>
    <!-- All Bootstrap plug-ins file -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Basic AngularJS -->
    <script src="bootstrap/js/angular.min.js"></script>
    <script src="bootstrap/js/form.js"></script>
</body>
</html>