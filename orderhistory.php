<?php require 'server.php'; 
//session_start();

$username="";

$remove= 0;
if (isset($_POST['del'])) {
    $remove = $_POST['hidden'];
    $db = mysqli_connect("localhost","root","","pinocone");
    $deleteitem=  "DELETE FROM orders WHERE order_id='$remove'";
	mysqli_query($db,$deleteitem);
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
			<li><a href="index.php">Home</a></li>
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
          <li class="active dropdown">
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
                <li class="active"><a href="orderhistory.php">Order Details</a></li>
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
 
    
    
    <div style="margin:100px;" class="table-responsive">
            <table class="table">
               <tr><th colspan="5"><h3>Order Details</h3></th></tr>
    <?php
        $db = mysqli_connect("localhost","root","","pinocone");
        $sql = "SELECT * FROM orders WHERE username = '".$_SESSION['username']."'";
        $result = mysqli_query($db, $sql);
        $count = 0;
        while ($row = mysqli_fetch_array($result)){
            $q = substr($row['quantity'], 1);
            $count++;
            $name = explode(",",$row['product name']);
            $quantity = explode(",", $q);
            $total = $row['total'];
            $unitprice = explode(",", $row['unitprice']);
            $date = $row['deli_date'];
            $id = $row['order_id'];
            
            echo '<tr><th colspan="5"><h5><b>Order Number'.$count.'</b></h5></th></tr>';
            
            
            echo '
               <tr>
                   <th width="40%">Product Name</th>
                   <th width="10%">Quantity</th>
                   <th width="15%">Unit Price</th>
                   <th width="15%">Total</th>
                   <th width="10%">Delivery Date</th>
               </tr>';
            for($i=0;$i<count($name);$i++)
            {
                if($i != count($name)-1)
                {
                echo '
            <form method="post" action="orderhistory.php">
                <tr>
                    <td>'.$name[$i].'</td>
                    <td>'.$quantity[$i].'</td>
                    <td>'.$unitprice[$i].'</td>
                    <td>'.$total.'</td>
                    <td>'.$date.'</td>
                     
       
                </tr>
                ';
                }
            }
            
            echo '<tr>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="hidden" name="hidden" value="'.$id.'"/></td>
                    <td><button type="submit" class="btn btn-info btn-md pull-right" name="del">Delete</button></td>
                </tr>
                
                </form>';
        }

                
                
                ?>
            </table>
        
        <!-- Modal -->

    
    </div>
    
    
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