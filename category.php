<?php require 'server.php';
//session_start();
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
    
    <link href="bootstrap/css/cart.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5
    elements and media queries -->
   <link href="styles/style.css" rel="stylesheet" />
</head>

<body>
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
      <a class="navbar-brand" href="index.php">Pinecone Catering</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
			<li><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
			<li class="active dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="set.php">Sets</a></li>
				<li class="active"><a href="category.php">Categories</a></li>
			  </ul>
			</li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php
					if($result = $con->query("SELECT username FROM users WHERE id = '".$_SESSION['id']."'")) {
					if($count = $result->num_rows) {
						while ($row = $result->fetch_object()){
							echo $row->username;
						}
					}
					}
				?> <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="editpro.php">Edit Profile</a></li>
                <li><a href="orderhistory.php">Order Details</a></li>
			  </ul>
			</li>
			<li><a href="#"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
			<li><a href="login.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<div  style="margin:100px;" class="container">
<div class="page-header">
  <h1>Categories</h1>
</div>
    
<div class="row">
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="images/chinesefoodthumbnail.jpg" alt="Chinese Food Thumbnail">
      <div class="caption">
        <h3>Chinese Food</h3>
        <p>...</p>
        <form method="post" action="cart.php">
            <input type="submit" class="btn btn-primary" name="chinese" value="Order Now"/>
          </form>
          
      </div>
    </div>
  </div>
    <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="images/westernfoodthumbnail.jpg" alt="Western Food Thumbnail">
      <div class="caption">
        <h3>Western Food</h3>
        <p>...</p>
        <form method="post" action="cart.php">
            <input type="submit" class="btn btn-primary" name="english" value="Order Now"/>
          </form>
      </div>
    </div>
  </div>
    <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="images/indianfoodthumbnail.jpg" alt="Indian Food Thumbnail">
      <div class="caption">
        <h3>Indian Food</h3>
        <p>...</p>
        <form method="post" action="cart.php">
            <input type="submit" class="btn btn-primary" name="indian" value="Order Now"/>
          </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="images/pakistanifoodthumbnail.jpg" alt="Pakistani Food Thumbnail" >
      <div class="caption">
        <h3>Pakistani Food</h3>
        <p>...</p>
        <form method="post" action="cart.php">
            <input type="submit" class="btn btn-primary" name="pakistani" value="Order Now"/>
          </form>
      </div>
    </div>
  </div>
    <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="images/spanishfoodthumbnail.jpg" alt="Spanish Food Thumbnail">
      <div class="caption">
        <h3>Spanish Food</h3>
        <p>...</p>
        <form method="post" action="cart.php">
            <input type="submit" class="btn btn-primary" name="spanish" value="Order Now"/>
          </form>
      </div>
    </div>
  </div>
    <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="images/thaifoodthumbnail.jpg" alt="Thai Food THumbnail">
      <div class="caption">
        <h3>Thai Food</h3>
        <p>...</p>
        <form method="post" action="cart.php">
            <input type="submit" class="btn btn-primary" name="thai" value="Order Now"/>
          </form>
      </div>
    </div>
  </div>
</div>

    
    
</div>

  

<div class="footer">
	<h3>Contact Information</h3>
	<p>Steven : 010-8328234</p>
	<p>Alberto : 019-43942934</p>
	<p>Malibu : 013-24567892</p>
    <p class="m-0 text-center text-white">Copyright &copy; Pinecone Catering 2018 DP2 Project</p>
</div> 
    
    <!-- jQuery – required for Bootstrap's JavaScript plugins) -->
    <script src="bootstrap/js/jquery.min.js"></script>
    <!-- All Bootstrap plug-ins file -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Basic AngularJS -->
    <script src="bootstrap/js/angular.min.js"></script>
</body>
</html>