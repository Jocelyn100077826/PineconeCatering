<?php
session_start();

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
			<li class="active"><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="#">Sets</a></li>
				<li><a href="#">Categories</a></li>
			  </ul>
			</li>
          
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> My Account <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="editpro.php">Edit Profile</a></li>
			  </ul>
			</li>
          
			<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
			<li><a href="login.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
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
       
       <div class="col-sm-4 col-md-3">
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
       </div> 
       
       <?php
            endwhile;
        endif;
    endif;

?> 
       
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
    
    <!-- jQuery – required for Bootstrap's JavaScript plugins) -->
    <script src="bootstrap/js/jquery.min.js"></script>
    <!-- All Bootstrap plug-ins file -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Basic AngularJS -->
    <script src="bootstrap/js/angular.min.js"></script>
    
    </body>
</html>

