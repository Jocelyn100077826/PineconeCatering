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
      <a class="navbar-brand" href="#">Pinecone</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
			<li><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="#">Sets</a></li>
				<li class="active"><a href="category.php">Categories</a></li>
			  </ul>
			</li>
			<li><a href="editpro.php">My Account</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
			<li><a href="#"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


    <div  style="margin:100px;" class="container">
    
    <?php

$connect = mysqli_connect('localhost', 'root', '12345678', 'cart');

$query = 'SELECT * FROM products ORDER by id';

$result = mysqli_query($connect, $query);

    if($result):
        if(mysqli_num_rows($result) > 0):
            while($product = mysqli_fetch_assoc($result)):
            /*print_r($product);*/
            ?>
       
    <!--   <div class="col-sm-4 col-md-3">
           <form method="post" action="cart.php?action=add&id=<?php echo $product['id']; ?>">
               
               <div class="products">
                   <img src="<?php echo $product['image']; ?>" class="img-responsive"/>
                   <h4 class="text-info"> <?php echo $product['name']; ?> </h4>
                   <h4>RM <?php echo $product['price']; ?></h4>
                   <input type="text" name="quantity" class="form-control" value="1" />
                   <input type="hidden" name="name" value="<?php echo $product['name']; ?>" />
                   <input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
                   <input type="submit" name="addtocart" style="margin-top:10px;" class="btn btn-info" value="Add to Cart" />
               </div>
           </form>
       </div> -->
       
       <?php
            endwhile;
        endif;
    endif;

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