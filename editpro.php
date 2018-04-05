<?php require 'server.php'; session_start(); ?>

<?php

$errors = array();

if (isset($_POST['updateprofile'])) {
	   $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['email'];
		$username = $_POST['username'];
        $password = $_POST['password'];
        $conpassword = $_POST['conpassword'];
	
       if ($password != $conpassword) {
			array_push($errors, "Password do not match");
		}
    
    if($password == $conpassword){
        $update = "UPDATE users SET  firstname = '$fname', lastname = '$lname', email = '$email' , username = '$username' , password = '$password' WHERE id = 2";
	   $result = mysqli_query($con, $update);
	   if ($result) {
           header('Location: editpro.php');
	   }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pinocone Project</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,
    initial-scale=1.0" />
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5
    elements and media queries -->
    <link href="styles/style.css" rel="stylesheet" />

   
</head>
    
    

<body>
    
    <div class="container">
        
        <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid p-3 mb-2 bg-dark text-dark">
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
			<li class="active"><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="#">Sets</a></li>
				<li><a href="#">Categories</a></li>
			  </ul>
			</li>
          
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php
					if($result = $con->query("SELECT username FROM users WHERE id = 2")) {
					if($count = $result->num_rows) {
						while ($row = $result->fetch_object()){
							echo $row->username;
						}
					}
					}
				?> <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="editpro.php">Edit Profile</a></li>
				<li><a href="login.php" <?php session_destroy(); ?>>Logout</a></li>
			  </ul>
			</li>
          
			<li><a href="#"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
			<li><a href="#"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        
    <h1 style="margin:100px;">Edit Profile</h1>
  	<hr>
	<div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img src="//placehold.it/100" class="avatar img-circle" alt="avatar">
          <h6>Upload a different photo...</h6>
          
          <input type="file" class="form-control">
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
          
        <!--<div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          <i class="fa fa-coffee"></i>
          This is an <strong>.alert</strong>. Use this to show important messages to the user.
        </div>-->
          
        <h3>Personal info</h3>
        
        <form class="form-horizontal" role="form" method="post" action="editpro.php">
          <div class="form-group">
            <label class="col-lg-3 control-label">First name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="firstname" value="<?php
				if($result = $con->query("SELECT firstname FROM users WHERE id = 2")) {
				if($count = $result->num_rows) {
					while ($row = $result->fetch_object()){
						echo $row->firstname;
					}
				}
				}
			?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Last name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="lastname" value="<?php
				if($result = $con->query("SELECT lastname FROM users WHERE id = 2")) {
				if($count = $result->num_rows) {
					while ($row = $result->fetch_object()){
						echo $row->lastname;
					}
				}
				}
			?>">
            </div>
          </div>
            
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="email" value="<?php
				if($result = $con->query("SELECT email FROM users WHERE id = 2")) {
				if($count = $result->num_rows) {
					while ($row = $result->fetch_object()){
						echo $row->email;
					}
				}
				}
			?>">
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label">Username:</label>
            <div class="col-md-8">
              <input class="form-control" type="text" name="username" value="<?php
				if($result = $con->query("SELECT username FROM users WHERE id = 2")) {
				if($count = $result->num_rows) {
					while ($row = $result->fetch_object()){
						echo $row->username;
					}
				}
				}
			?>">
            </div>
          </div>
            
          <div class="form-group">
            <label class="col-md-3 control-label">Password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" name="password" value="<?php
				if($result = $con->query("SELECT password FROM users WHERE id = 2")) {
				if($count = $result->num_rows) {
					while ($row = $result->fetch_object()){
						echo $row->password;
					}
				}
				}
			?>">
            </div>
          </div>
            
          <div class="form-group">
            <label class="col-md-3 control-label">Confirm password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" name="conpassword">
                <?php require 'errors.php'; ?>
            </div>
          </div>
            
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="submit" class="btn btn-primary" value="Save Changes" name="updateprofile">
              <span></span>
              <input type="button" id="reset" class="btn btn-default" value="Cancel">
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
<hr>
    
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
</body>
</html>