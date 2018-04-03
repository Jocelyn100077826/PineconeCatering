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
    
    
</head>

<body>
    
   <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Pinecone</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Food Category</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Customer Profile <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="editpro.php">Edit Profile</a></li>
            <li><a href="#">Log out</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    
    <br>
    <br>
    
<div class="row">
    <div class="col-md-6 col-md-12 col-md-6 col-md-offset-3">
		<div class="panel panel-primary">
			<div class="panel-heading"> Register Here </div>
			<div class="panel-body">
                
				<form method="POST" action="Registration Form.php" onsubmit="Validate()" name="myform">
                
                    <!-- display validation here -->
				    
                    <?php require 'errors.php'; ?>
                    
                    <div class="form-group">
						<label for="firstname">First Name: </label>
						<input type="text" name="firstname" id="fname" class="form-control" value="<?php if (isset($_POST["firstname"])) echo $_POST["firstname"]; ?>">
						<span id="error_fname" class="text-danger"></span>
					</div>
                    
                    <div class="form-group">
						<label for="lastname">last Name: </label>
						<input type="text" name="lastname" id="lname" class="form-control" value="<?php if (isset($_POST["lastname"])) echo $_POST["lastname"]; ?>">
						<span id="error_lname" class="text-danger"></span>
					</div>
                    
                     <div class="form-group">
						<label for="email">Email: </label>
						<input type="email" name="email" id="email" class="form-control" value="<?php if (isset($_POST["email"])) echo $_POST["email"]; ?>">
						<span id="error_email" class="text-danger"></span>
					</div>
                    
                      <div class="form-group">
						<label for="username">User Name: </label>
						<input type="text" name="username" id="uname" class="form-control" value="<?php if (isset($_POST["username"])) echo $_POST["username"]; ?>">
						<span id="error_uname" class="text-danger"></span>
					</div>
                    
                    <div class="form-group">
						<label for="password">Password: </label>
                        <input type="password" name="password" class="form-control" maxlength="12" value="<?php if (isset($_POST["password"])) echo $_POST["password"]; ?>">
                        <span id="error_password"></span>
					</div>
                    
                    
					<div class="form-group">
						<label for="password">Confirm Password: </label>
                        <input type="password" name="conpassword" class="form-control" maxlength="12">
                        <?php require 'errors.php'; ?>
                        
                        <span id="error_password_confirm"></span>
					</div>

					
					<button id="submit" type="submit" value="submit" name="register" class="btn btn-primary center">Submit</button>
                    
                    <p> Already a member? <a href="login.php"> Sign in </a></p>
			
				</form>

			</div>
		</div>
	</div>
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