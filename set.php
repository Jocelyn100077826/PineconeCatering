<?php
require 'server.php';

if(filter_input(INPUT_POST, 'buynow')){
    if(isset($_SESSION['shopping_cart'])){
        
        /* Keep track how many products are in the shopping cart*/
        $count = count($_SESSION['shopping_cart']);
        
        /* create sequential array for matching array keys to product ids */
        $product_ids = array_column($_SESSION['shopping_cart'], 'id');
        
        if(!in_array(filter_input(INPUT_GET, 'id'), $product_ids))
        {
        
            $_SESSION['shopping_cart'][$count] = array
            (
                'id' => filter_input(INPUT_GET, 'id'),
                'name' => filter_input(INPUT_POST, 'name'),
                'price' => filter_input(INPUT_POST, 'price'),
                'quantity' => filter_input(INPUT_POST, 'quantity')
            );
            
        }
        
        else
        {
            /* product already exists , increase quantity  */
            /* math array key to id of the product being added to the cart  */
            for($i=0; $i < count($product_ids); $i++)
            {
                if($product_ids[$i] == filter_input(INPUT_GET, 'id'))
                {
                    /* add item quantity to the existing product in the array */
                    
                    $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                }
            }
        }
        
        
    }
    else /* if shopping cart does not exist, create first product with array key 0 */
    {
        /* create array using submitted form data, start from key 0 and fill it with values  */
        $_SESSION['shopping_cart'][0] = array
        (
            'id' => filter_input(INPUT_GET, 'id'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity')
        );
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
			<li><a href="index.php">Home</a></li>
            <?php
                $check = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
                $result = mysqli_query($con, $check);
                $row = mysqli_fetch_row($result);
                if($row[6] == '0')
                {
            ?>
			<li class=" active dropdown">
			  <a href="category.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li  class="active"><a href="set.php">Sets</a></li>
				<li><a href="category.php">Categories</a></li>
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
            <?php
                } else {
            ?>
			     <li><a href="modfood.php">Edit food</a></li>
                <li><a href="custom.php">Edit Sets</a></li>
            <?php
            }
            ?>
			<li><a href="#"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true" onclick="openNav()"></span></a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav> 

    
    <br/>
    <br/>
    <br/>
    <br/>
<div class="container">
    
    <h1>Sets</h1>
    <hr/>
    
    
    <?php
        $connect = mysqli_connect('localhost', 'root', '12345678', 'pinocone');

        $query = "SELECT * FROM custom ORDER by custom_id";
        $result = mysqli_query($connect, $query);
    
    
    
    if($result):
        if(mysqli_num_rows($result) > 0):
       
            while($set = mysqli_fetch_assoc($result)):
            /*print_r($product);*/
            $array= (explode(', ',$set['fooditems']));
                    echo '<form method="post" action="set.php">';
                    echo "<div class='cust'>";
    
                    echo "<h3>".$set['custom_name']."</h3>";
                    echo "<ul>";
                    
                    foreach($array as $arr){
                        $q = "SELECT * FROM products WHERE id =".$arr;
                        $r = mysqli_query($connect, $q);
                        while($check = mysqli_fetch_assoc($r)):
                            
                            echo "<li>".$check['name']."</li>";
                        
                        endwhile;  
                    }
                    echo"</ul>";
                    echo "<h2> RM ".$set['menu_price']."</h2>";
    
                    echo "<input type='hidden' value='".$set['custom_id']."' name='id'/>";
        
                    echo "<input type='hidden' value='".$set['custom_name']."' name='name'/>";
                    echo "<input type='hidden' value='".$set['menu_price']."' name='price'/>";
                    echo "<input type='hidden' value='1' name='quantity'/>";
        
        
                    echo "<input type='submit' value='Buy Now' name='buynow' class='btn btn-primary btn-block'/>";
                    echo "</div>";
                    
    echo '</form>';
    
            endwhile;
        endif;
    endif;
    ?>
    
    <br/>
    <br/>
    
    
</div>
<div id="mySidenav" class="sidenav">
      <a href="#" class="closebtn" onclick="closeNav()">x</a>
       <div style="clear:both"></div>
       <br />
       
       <div class="table-responsive">
           <table class="table">
               <tr><th colspan="5"><h3>Order Details</h3></th></tr>
               
               <tr>
                   <th width="40%">Product Name</th>
                   <th width="10%">Quantity</th>
                   <th width="20%">Price</th>
                   <th width="15%">Total</th>
                   <th width="5%">Action</th>
               </tr>
               
            <?php
               if(!empty($_SESSION['shopping_cart'])):
                    
                    $total = 0;
               
               foreach($_SESSION['shopping_cart'] as $key => $product):
            ?>
               
               <tr>
                   <td><?php echo $product['name']; ?></td>
                   <td><?php echo $product['quantity']; ?></td>
                   <td><?php echo $product['price']; ?></td>
                   <td><?php echo number_format($product['quantity'] * $product['price'], 2);  ?></td>
                   <td>
                    <a href="cart.php?action=delete&id=<?php echo $product['id']; ?>">
                        
                        <div class="btn btn-danger btn-md"  onclick="openNav()" > Remove </div>
                    </a>   
                   </td>
               </tr>
               
               <?php
                    /* grand total function code */
                    $total = $total + ($product['quantity'] * $product['price']);
                    endforeach;
               ?>
               
               <tr>
                   <td colspan="3" align="right">Total </td>
                   <td align="right">RM <?php echo number_format($total, 2); ?></td>
                   <td></td>
               </tr>
               
               <tr>
                   <!-- shows checkout button only if the shopping cart is not empty -->
                   <td colspan="5">
                       <?php
                            if(isset($_SESSION['shopping_cart'])):
                            if(count($_SESSION['shopping_cart']) > 0):
                       ?>
                       
                        <a href="checkout.php" class="button"> Check Out</a>
                       
                       <?php endif; endif; ?>
                    </td>
               </tr>
               
               <?php
                    endif;
               ?>
               
           </table>
           
       </div>
       
    </div>
 <div class="footer">
	<h3>Contact Information</h3>
	<p>Steven : 010-8328234</p>
	<p>Alberto : 019-43942934</p>
	<p>Malibu : 013-24567892</p>
     <p class="m-0 text-center text-white">Copyright &copy; Pinecone Catering 2018 DP2 Project</p>
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