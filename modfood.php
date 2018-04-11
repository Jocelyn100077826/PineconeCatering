<?php
    
    //if upload button is pressed
    if (isset($_POST['upload'])){
        //path to store uploaded image
        $target = "images/".basename($_FILES['image']['name']);
        $db = mysqli_connect("localhost","root","12345678","cart");
        //get all the submitted data from the form
        $image =$_FILES['image']['name'];
        $price = $_POST['price'];
        
        $mysql = "INSERT INTO products (image, price) VALUES ('$image', '$price')";
        mysqli_query($db, $mysql); //stores the submitted data into the database table: images
        
        //move uploaded image into folder
        if (move_uploaded_file($_FILES['image']['tmp_name'],$target)){
            $msg = "Image uploaded successfully";
        }else{
            $msg = "There was a problem uploading image";
        }
        
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Image Upload</title>
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
			<li><a href="index.php">Home</a></li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="#">Sets</a></li>
				<li><a href="category.php">Categories</a></li>
			  </ul>
			</li>
			<li class="active"><a href="modfood.php">Edit food</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
			<li><a href="#"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	
	<br/>
	<br/>
	<br/>
    <div id="content">
	
    <form method="post" action="modfood.php" enctype="multipart/form-data">
        <input type="hidden" name="size" value="1000000"/>
        <div>
            <input type="file" name="image"/>
        </div>
        <div>
            <textarea name="text" cols="40" placeholder="Say something about this..."></textarea>
        </div>
        <div>
            <input type="submit" name="upload" value="Upload Image"/>
        </div>
        </form>	
<?php
		$db = mysqli_connect("localhost","root","12345678","cart");
		$sql = "SELECT * FROM products";
		$result = mysqli_query($db, $sql);
		while ($row = mysqli_fetch_array($result)){
			echo "<div id='img_div'>";
			echo "<img src='images/".$row['image']."'/>";
			echo "<p>".$row['price']."</p>";
			echo "</div>";
		}
		
?>
	
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
</body>
</html>