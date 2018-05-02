<?php
session_start();
 $con = mysqli_connect('localhost', 'root', '12345678', 'pinocone');
$product_ids = array();

/*session_destroy();*/
/* check if add to cart button has been submitted */
if(filter_input(INPUT_POST, 'addtocart')){
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

/* code for remove button */

if(filter_input(INPUT_GET, 'action') == 'delete')
{
    /* loop through all the food items in the cart until it matches with GET id Variable */
    foreach($_SESSION['shopping_cart'] as $key => $product)
    {
        if($product['id'] == filter_input(INPUT_GET, 'id'))
        {
            /* remove product from the shopping cart when it matches with the GET id */
            unset($_SESSION['shopping_cart'][$key]);
        }
    }
    
    /* reset session array keys so they match with $product_ids numeric array */
    $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}

/* this will show how is the array working for storing food products */
/*pre_r($_SESSION);*/

function pre_r($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
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
				<li><a href="#">Sets</a></li>
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
			  </ul>
			</li>
            <?php
                } else {
            ?>
			     <li><a href="modfood.php">Edit food</a></li>
            <?php
            }
            ?>
			<li><a href="category.php"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav> 
    
   <div  style="margin:100px;" class="container"> 
    
<?php

$connect = mysqli_connect('localhost', 'root', '12345678', 'pinocone');
       
$current = '';

$query = "SELECT * FROM products ORDER by id";
$result = mysqli_query($connect, $query);

$chineseQ = "SELECT * FROM products WHERE category = 'Chinese'  ORDER by id";
$englishQ = "SELECT * FROM products WHERE category = 'English'  ORDER by id";
$indianQ = "SELECT * FROM products WHERE category = 'Indian'  ORDER by id";
$pakistaniQ = "SELECT * FROM products WHERE category = 'Pakistani'  ORDER by id";
$spanishQ = "SELECT * FROM products WHERE category = 'Spanish'  ORDER by id";
$thaiQ = "SELECT * FROM products WHERE category = 'Thai'  ORDER by id";


if (isset($_POST['chinese'])) {
    $result = mysqli_query($connect, $chineseQ);
    $current = 'chinese';
}
if (isset($_POST['english'])) {
    $result = mysqli_query($connect, $englishQ);
    $current = 'english';
}
if (isset($_POST['indian'])) {
    $result = mysqli_query($connect, $indianQ);
    $current = 'indian';
}
if (isset($_POST['pakistani'])) {
    $result = mysqli_query($connect, $pakistaniQ);
    $current = 'pakistani';
}
if (isset($_POST['spanish'])) {
    $result = mysqli_query($connect, $spanishQ);
    $current = 'spanish';
}
if (isset($_POST['thai'])) {
    $result = mysqli_query($connect, $thaiQ);
    $current = 'thai';
}
       
?>
       
        <ol class="breadcrumb">
      
            <form method="post" action="cart.php">
        <li>
            
        <div class= "row">
        
      
        <div class="col-xs-2">
            <input type="submit" class="btn btn-primary" name="chinese" value="Chinese"/>
        </div> 
      
    
        <div class="col-xs-2">
			<input type="submit" class="btn btn-primary" name="english" value="Western"/>
        </div>  
             <div class="col-xs-2">
			<input type="submit" class="btn btn-primary" name="indian" value="Indian"/>
    </div>
    <div class="col-xs-2">
			<input type="submit" class="btn btn-primary" name="pakistani" value="Pakistani"/>
    </div>
    <div class="col-xs-2">
			<input type="submit" class="btn btn-primary" name="spanish" value="Spanish"/>
    </div>
			<input type="submit" class="btn btn-primary" name="thai" value="Thai"/>

    </div>
            </li>
</form> 
       
      
    </ol>
       
<!--<form method="post" action="cart.php">
<div class= "row">
    <div class="col-xs-2">
            <input type="submit" class="btn btn-primary" name="chinese" value="Chinese"/>
        </div>
    <div class="col-xs-2">
			<input type="submit" class="btn btn-primary" name="english" value="Western"/>
    </div>
    <div class="col-xs-2">
			<input type="submit" class="btn btn-primary" name="indian" value="Indian"/>
    </div>
    <div class="col-xs-2">
			<input type="submit" class="btn btn-primary" name="pakistani" value="Pakistani"/>
    </div>
    <div class="col-xs-2">
			<input type="submit" class="btn btn-primary" name="spanish" value="Spanish"/>
    </div>
			<input type="submit" class="btn btn-primary" name="thai" value="Thai"/>
</div>
</form> -->
<br/>
<?php

    if($result):
        if(mysqli_num_rows($result) > 0):
       
            while($product = mysqli_fetch_assoc($result)):
            /*print_r($product);*/
                
                   echo "<div class='col-sm-4 col-md-3'>";
                   echo "<form method='post' action='cart.php?action=add&id=".$product['id']."'>";

                   echo "<div class='products' style='min-height:500px;height:500px;'>";
                   echo "<img src='images/".$product['image']."' class='img-responsive' style='min-height:200px;height:200px;'/>";
                    echo "<h4 class='text-info'>". $product['name']."</h4>";
                   echo"<p>".$product['desp']."</p>";
                   echo"<p>".$product['category']."</p>";
                    echo"<h4>RM".$product['price']."</h4>";
                    echo "<input type='text' name='quantity' class='form-control' value='1' />";
                    echo "<input type='hidden' name='name' value='".$product['name']."' />";
                   echo "<input type='hidden' name='desp' value='".$product['desp']."' />";
                    echo "<input type='hidden' name='price' value='".$product['price']."' />";
                    echo "<input type='submit' name='addtocart' style='margin-top:10px;' onclick='openNav()' class='btn btn-info' value='Add to Cart' />";

                    echo "</div>";
                    echo "</form>";
                    echo "</div>"; 
       
            endwhile;
        endif;
    endif;

?> 
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
                        
                        <div class="btn-danger" onclick="openNav()"> Remove </div>
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
</div> 
      
      <!--FOR SIDE CART-->
      <link rel="stylesheet" type="text/css" href="style.css"/>
      <script src="style.js"></script> 
    
    <!-- jQuery – required for Bootstrap's JavaScript plugins) -->
    <script src="bootstrap/js/jquery.min.js"></script>
    <!-- All Bootstrap plug-ins file -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Basic AngularJS -->
    <script src="bootstrap/js/angular.min.js"></script>
    
    </body>
</html>

