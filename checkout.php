<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'pinocone');

$orderstring = ""; 
$quantity = 0;

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

if (isset($_POST['confirm'])) {
$items= $_POST['items'];
$quantity = $_POST['quantity'];
$total= $_POST['total'];
$price = $_POST['price'];
$db = mysqli_connect("localhost","root","12345678","pinocone");
date_default_timezone_set('Asia/Kuala_Lumpur');
$mysql = "INSERT INTO `orders`(`username`, `product name`, `quantity`, `total`, `unitprice`, `date`) VALUES ('".$_SESSION['username']."', '$items','$quantity','$total','$price','".date("Y-m-d H:i:s")."')";
mysqli_query($db, $mysql);
echo '<script>location= "success.php";</script>';
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
    
    <link href="bootstrap/css/checkout.css" rel="stylesheet" />
    
    <link href="bootstrap/css/cart.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5
    elements and media queries -->
   <link href="styles/style.css" rel="stylesheet" />
    
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
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
                <li><a href="orderhistory.php">Order Details</a></li>
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
    
    
    <div style="margin:100px;" class="container">
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Payment Details
                    </h3>
                    <div class="checkbox pull-right">
                        <label>
                            <input type="checkbox" />
                            Remember
                        </label>
                    </div>
                </div>
                <div class="panel-body">
                    <form role="form">
                    <div class="form-group">
                        <label for="cardNumber">
                            CARD NUMBER</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cardNumber" placeholder="Valid Card Number"
                                required autofocus />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-7 col-md-7">
                            <div class="form-group">
                                <label for="expityMonth">
                                    EXPIRY DATE</label>
                                <div class="col-xs-6 col-lg-6 pl-ziro">
                                    <input type="text" class="form-control" id="expityMonth" placeholder="MM" required />
                                </div>
                                <div class="col-xs-6 col-lg-6 pl-ziro">
                                    <input type="text" class="form-control" id="expityYear" placeholder="YY" required /></div>
                            </div>
                        </div>
                        <div class="col-xs-5 col-md-5 pull-right">
                            <div class="form-group">
                                <label for="cvCode">
                                    CV CODE</label>
                                <input type="password" class="form-control" id="cvCode" placeholder="CV" required />
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#"><span class="badge pull-right"><span class="glyphicon glyphicon-usd"></span>4200</span> Final Payment</a>
                </li>
            </ul>
            <br/>
            <a href="http://www.jquery2dotnet.com" class="btn btn-success btn-lg btn-block" role="button">Pay</a>
        </div>
    </div>
</div>

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
                        
                        <div class="btn-danger"> Remove </div>
                    </a>   
                   </td>
               </tr>
               
               <?php
                    /* grand total function code */
                    $itemname .= $product['name'] . ",";
                    $quantity .= $product['quantity'] . ",";
                    $unitprice .= $product['price'] . ",";
                    $total = $total + ($product['quantity'] * $product['price']);
                    endforeach;
               
               
               ?>
               
               <tr>
                   <td colspan="3" align="right"> Total </td>
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
                       <form method="post" action="checkout.php">
                        <input type="hidden" name="items" value="<?php echo $itemname; ?>"/>
                        <input type="hidden" name="quantity" value="<?php echo $quantity; ?>"/>
                        <input type="hidden" name="total" value="<?php echo number_format($total, 2); ?>"/>
                        <input type="hidden" name="price" value="<?php echo $unitprice; ?>"/>
                        <input type="submit" name="confirm" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" value="Confirm Check Out"/>                       
                        </form>
                       <?php endif; endif; ?>
                    </td>
               </tr>
               
               <?php
                    endif;
               ?>
               
           </table>
           
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