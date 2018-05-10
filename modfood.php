<?php
        session_start();
        $con = mysqli_connect('localhost', 'root', '', 'pinocone');
        $update = false;

    //if upload button is pressed
    if (isset($_POST['upload'])){
        //path to store uploaded image
        $target = "images/".basename($_FILES['image']['name']);
        $db = mysqli_connect("localhost","root","","pinocone");
        //get all the submitted data from the form
        $name = $_POST['name'];
        $image =$_FILES['image']['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $desp = $_POST['desp'];
        
        $mysql = "INSERT INTO products (name, desp, image, category, price) VALUES ('$name','$desp','$image','$category', '$price')";
        mysqli_query($db, $mysql); //stores the submitted data into the database table: images
        
        //move uploaded image into folder
        if (move_uploaded_file($_FILES['image']['tmp_name'],$target)){
            $msg = "Image uploaded successfully";
        }else{
            $msg = "There was a problem uploading image";
        }
        
    }

if (isset($_POST['del'])) {
    $id = $_POST['hidden'];
    $db = mysqli_connect("localhost","root","","pinocone");
    $deleteitem=  "DELETE FROM products WHERE id='$id'";
	mysqli_query($db,$deleteitem);
}

if (isset($_POST['edit'])) {
    $id = $_POST['hidden'];
    $update = true;
    $db = mysqli_connect("localhost","root","","pinocone");
    $sql = "SELECT * FROM products WHERE id='$id'";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_array($result)){
        $image = $row['image'];
        $name = $row['name'];
        $price = $row['price'];
        $category = $row['category'];
        $desp = $row['desp'];
    }
}

    if (isset($_POST['update'])){
        //path to store uploaded image
        $target = "images/".basename($_FILES['uimage']['name']);
        $db = mysqli_connect("localhost","root","","pinocone");
        //get all the submitted data from the form
        $id = $_POST['idhidden'];
        $name = $_POST['uname'];
        $image =$_FILES['uimage']['name'];
        $price = $_POST['uprice'];
        $category = $_POST['ucategory'];
        $desp = $_POST['udesp'];
        
        if (!$image){
            $image = $_POST['imghidden'];
        }
        
        $mysql = "UPDATE products SET name='$name', image='$image', price='$price', category='$category', desp='$desp' WHERE id='$id'";
        mysqli_query($db, $mysql); //stores the submitted data into the database table: images
        
        //$SESSION['message'] = "FOOD ITEM UPDATED";
        //header('location: index.php');
        
        //move uploaded image into folder
        if (move_uploaded_file($_FILES['uimage']['tmp_name'],$target)){
            $msg = "Image uploaded successfully";
        }else{
            $msg = "There was a problem uploading image";
        }
        
    }

?>



<!DOCTYPE html>
<html>
<head>
    <title>Food Upload</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,
    initial-scale=1.0" />
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    
    <link href="bootstrap/css/cart.css" rel="stylesheet" />
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
                <li><a href="modfood.php"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
            <?php
                } else {
            ?>
			     <li class="active"><a href="modfood.php">Edit food</a></li>
                <li><a href="custom.php">Edit Sets</a></li>
            <?php
            }
            ?>
			
			<li><a href="logout.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    <div id="modfood">
	<br/>
	<br/>
	<br/>
    
	<?php if ($update == true):  ?>
        
    <form method="post" action="modfood.php" enctype="multipart/form-data">
        <input type="hidden" name="size" value="1000000"/>
        <div>
            <input type="file" name="uimage" />
            <input type="hidden" name="idhidden" value="<?php echo $id; ?>"/>
            <input type="hidden" name="imghidden" value="<?php echo $image; ?>"/>
        </div>
        <div>
            <label>Name: </label><br/><input type="text" name="uname" placeholder="name" value="<?php echo $name; ?>"/>
        </div>
        <div>
            <label>Price: </label><br/><input type="number" cols="40"  name="uprice" step="0.01" placeholder="0.00" value="<?php echo $price; ?>"/>
        </div>
        <div>
            <label>Description: </label><br/><textarea name="udesp" placeholder="Write something about this..." rows="4" cols="50"><?php echo $desp; ?></textarea>
        </div>
        <div>
            <label>Category: </label><br/>
            <select name="ucategory">
                  <option value="Chinese">Chinese</option>
                  <option value="English">English</option>
                  <option value="Indian">Indian</option>
                  <option value="Pakistani">Pakistani</option>
                  <option value="Spanish">Spanish</option>
                  <option value="Thai">Thai</option>
              </select>
        </div>
        <div>
            <br/>
            
            <input type="submit" name="update" value="Update"/>
        </div>
        </form>	
        
        <?php else:  ?>
          <form method="post" action="modfood.php" enctype="multipart/form-data">
              
        <input type="hidden" name="size" value="1000000"/>
        <div>
            <input type="file" name="image" />
            <input type="hidden" name="idhidden" />
        </div>
        <div>
            <label>Name: </label><br/><input type="text" name="name" placeholder="name"/>
        </div>
        <div>
            <label>Price: </label><br/><input type="number" cols="40"  name="price" step="0.01" placeholder="0.00" />
        </div>
        <div>
            <label>Description: </label><br/><textarea name="desp" placeholder="Write something about this..." value="<?php echo $desp; ?>" rows="4" cols="50"></textarea>
        </div>
        <div>
            <label>Category: </label><br/>
              <select name="category">
                  <option value="Chinese">Chinese</option>
                  <option value="English">English</option>
                  <option value="Indian">Indian</option>
                  <option value="Pakistani">Pakistani</option>
                  <option value="Spanish">Spanish</option>
                  <option value="Thai">Thai</option>
              </select>
        </div>
            <br/>
            <input type="submit" name="upload" value="Upload Food Item"/>
        </form>	
        <?php endif  ?>
        
    <div id='imgdiv'>
        <table>
        <tr>
            <th colspan="4"><h3>Food items</h3><hr/></th>    
        </tr>
        
            <?php
                    $db = mysqli_connect("localhost","root","","pinocone");
                    $sql = "SELECT * FROM products";
                    $result = mysqli_query($db, $sql);
                    while ($row = mysqli_fetch_array($result)){
                        echo "<form method='post' action='modfood.php' enctype='multipart/form-data'>";
                        echo "<tr>";
                        echo "<th><img src='images/".$row['image']."'/></th>";
                        echo "<td><p>".$row['name']."</p></td>";
                        echo "<td><p>".$row['desp']."<br/>RM ".$row['price']."</p></td>";
                        echo "<input type='hidden' name='hidden' value='".$row['id']."'/>";
                        echo "<input type='hidden' name='hname' value='".$row['name']."'/>";
                        echo "<input type='hidden' name='hprice' value='".$row['price']."'/>";
                        echo "<input type='hidden' name='himage' value='".$row['image']."'/>";
                        echo "<td><input type='submit' name='edit' value='EDIT'/><br/><br/><input type='submit' name='del' value='DELETE'/>
                        </td>";
                        echo "</tr>";
                        echo "</form>";

                    }

            ?>
        </table>
    </div>
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