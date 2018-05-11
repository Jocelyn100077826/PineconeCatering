<?php
    session_start();
    // connect to the database
    $con = mysqli_connect('localhost', 'root', '12345678', 'pinocone');
	$errors = array();
	
	if (isset($_POST['register'])) {
		$fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['email'];
		$username = $_POST['username'];
        $password = $_POST['password'];
        $conpassword = $_POST['conpassword'];
	
		// Check form inputs & return errors
		if (empty($fname)) {
			array_push($errors, "First name is required");
		}
        
        if (empty($lname)) {
			array_push($errors, "last name is required");
		}
        
        if (empty($email)) {
			array_push($errors, "Email is required");
		}
        
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
        if (empty($password)) {
			array_push($errors, "Password is required");
		}
        if ($password != $conpassword) {
			array_push($errors, "Password do not match");
		}

		
		// Save to database if no errors
		if (count($errors) == 0) {
			$sql = $con->query("INSERT INTO users (firstname, lastname, email, username, password) VALUES('{$fname}', '{$lname}', '{$email}', '{$username}', '{$password}')");
            echo "<script>alert('Registration Successful'); location = 'login.php';</script>";
			
		}	
	}


if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}
		else {
			$username = $_POST['username'];
			$password = $_POST['password'];
            $id =0;
			
			$result = $con->query("select * from users where username='$username' AND password='$password'");
            
            while ($row = mysqli_fetch_array($result)){
                $id = $row['id'];
            }
            
			$rows = mysqli_num_rows($result);
			if ($rows == 0)
				array_push($errors, "Invalid Username or Password");
		}
		
		if (count($errors) == 0) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			session_start();
			$_SESSION['username'] = $username;
            $_SESSION['id'] = $id;
            
            $check = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
            $result = mysqli_query($con, $check);
            $row = mysqli_fetch_row($result);
            if($row[6] == '0')
			    echo "<script>alert('WELCOME USER'); location = 'index.php';</script>";
            else if($row[6] == '1')
                echo "<script>alert('WELCOME ADMIN'); location = 'index.php';</script>";
		}
	}

?>