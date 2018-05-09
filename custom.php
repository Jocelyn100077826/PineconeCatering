<?php
    require 'server.php'; 
//    session_start();


    if (isset($_POST['submitMenu'])) {
        
        
//                    /* grand total function code */
//                    $menustring .= $product['name'] . " " . $product['quantity'] . ",";
//               
//                    $total = $total + ($product['quantity'] * $product['price']);
//                    endforeach;
//               
             
        $items = "";
        

        foreach($_POST['set'] as $set){
            $items .= $set. ", ";
        }
        
        $items = substr($items, 0, -2);
        
//        $items= $_POST['set'];
        $name= $_POST['name'];
        $price= $_POST['price'];
        
        $db = mysqli_connect("localhost","root","","pinocone");
        
        $mysql = "INSERT INTO `custom`(`custom_name`, `fooditems`, `menu_price`) VALUES ('$name', '$items','$price')";
        mysqli_query($db, $mysql);
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
      <a class="navbar-brand" href="#">Pinocone</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
			<li class="active"><a href="index.php">Home</a></li>
            <?php
                $check = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
                $result = mysqli_query($con, $check);
                $row = mysqli_fetch_row($result);
                if($row[6] == '0')
                {
            ?>
			<li class="dropdown">
			  <a href="category.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="set.php">Sets</a></li>
				<li><a href="category.php">Categories</a></li>
			  </ul>
			</li>
          <li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php
					if($result = $con->query("SELECT username FROM users WHERE id = 1")) {
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
            <?php
                } else {
            ?>
			     <li><a href="modfood.php">Edit food</a></li>
                <li><a href="custom.php">Edit Sets</a></li>
            <?php
            }
            ?>
			<li><a href="category.php"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php
        
            $connect = mysqli_connect('localhost', 'root', '', 'pinocone');
       
            $query = "SELECT * FROM products ORDER by id";
            $result = mysqli_query($connect, $query);
        
?>
<div class="container">
    <br/>
    <br/>
    <br/>
    <form method="post" action="custom.php">
        
    <h3>Name of custom menu: <input class="form-control input-sm" id="inputsm" type="text" name="name"/></h3>
    
    <h4>Price: <input class="form-control" id="inputdefault" type="number" name="price"/></h4>

    <table class="table">
        <tr>
            <th></th>
            <th>Food ID</th>
            <th>Food Name</th>
            <th>Food Description</th>
            <th>Food Price</th>
        </tr>
        
        
        
        <?php
         if($result):
        if(mysqli_num_rows($result) > 0):
       
            while($food = mysqli_fetch_assoc($result)):
            /*print_r($product);*/
                echo "<tr>";
                echo "<td><input type='checkbox' name='set[]' value='".$food['id']."'/></td>";
                echo "<td>".$food['id']."</td>";
                echo "<td>".$food['name']."</td>";
                echo "<td>".$food['desp']."</td>";
                echo "<td> RM ".$food['price']."</td>";
                echo "</tr>";
            endwhile;
        endif;
    endif;
?>
        </table>
        
        <input class="btn btn-primary btn-block" type="submit" value="Submit" name="submitMenu"/>
    </form>
</div>
    
    
    <br/>
    <br/>
    <br/>
    
    
 <div class="footer">
	<h3>Contact Information</h3>
	<p>Steven : 010-8328234</p>
	<p>Alberto : 019-43942934</p>
	<p>Malibu : 013-24567892</p>
</div> 
<!-- FOR SIDE CART -->
<script src="style.js"></script> 
<link rel="stylesheet" type="text/css" href="style.css"/>
    
    <!-- jQuery – required for Bootstrap's JavaScript plugins) -->
    <script src="bootstrap/js/jquery.min.js"></script>
    <!-- All Bootstrap plug-ins file -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Basic AngularJS -->
    <script src="bootstrap/js/angular.min.js"></script>
</body>
</html>