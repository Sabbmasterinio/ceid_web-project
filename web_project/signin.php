<!DOCTYPE html>

<html>

<head>

    <title>LOGIN</title>

    <link rel="stylesheet" type="text/css" href="login_style.css">

</head>

<body>


<?php

session_start();  // session username for sign in and logout

// connection with server and database (servername,username,password,database)
$conn = new mysqli("localhost", "root", "", "web_project"); 

// check connection
if($conn->connect_error){
	die("connection failed");
}
error_reporting(E_ERROR | E_PARSE);

	$username = $_POST["username"];
	$password = $_POST["password"];


// sql query

$sql = mysqli_query($conn, "SELECT * from users WHERE username = '$username' and password = '$password'");

// execute query
$row = mysqli_fetch_array($sql);


if(isset($username) && isset($password)){

	if(empty($username) && empty($password)){
		header("Location: signin.php?error=Username and Password is required!");
		exit();
	}else if (empty($password)){
		header("Location: signin.php?error=Password is required!");
		exit();
	}else if(empty($username)){
		header("Location: signin.php?error=Username is required!");
		exit();
	}else{
		if($row > 0){
			$_SESSION["username"] = $username;
			$_SESSION["password"] = $password;
			 if(isset($_SESSION["username"])){
			if ($username=="admin" && $password=="admin"){
				header("Location: admin/admin_login.php");
				exit();
			}else{
				header("Location: user/user_login.php");
				exit();
			}
		}
		}
		else{
			header("Location: signin.php?error=False Credentials!");
			exit();
		}
	}
}
?>


	<form action="signin.php" method="post">
        <h2>LOGIN</h2>
        <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>

        <label>User Name</label>

        <input type="text" name="username" placeholder="User Name"><br>

        <label>Password</label>

        <input type="password" name="password" placeholder="Password"><br> 

        <button type="submit">Login</button>

     </form>
     <br>
	 <p class="redirect">If you dont have an account create one <a class="goto-signup" href=signup.php>here! </a></p> 

</body>

</html>