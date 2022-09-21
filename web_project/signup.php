<!-- HTML Code -->
<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
    <link rel="stylesheet" type="text/css" href="login_style.css">
</head>
<body>


<?php  

$conn = new mysqli("localhost", "root", "", "web_project");

if($conn->connect_error){
	die("connection failed");
}

error_reporting(E_ERROR | E_PARSE);
$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];
$number = preg_match('@[0-9]@', $password);
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$specialChars = preg_match('@[^\w]@', $password);




$sql = "INSERT INTO users (email, username, password) 
VALUES ('$email','$username', '$password')";

if(isset($username) && isset($password) && isset($email)){
	if(empty($username) && empty($password) && empty($email)){
		header("Location: signup.php?error=Email,Username and Password is required!");
		exit();
	}else if(empty($username) && empty($password)){
		header("Location: signup.php?error=Username and Password is required!");
		exit();
	}else if(empty($username) && empty($email)){
		header("Location: signup.php?error=Username and Email is required!");
		exit();
	}else if(empty($email) && empty($password)){
		header("Location: signup.php?error=Email and Password is required!");
		exit();
	}else if(empty($username)){
		header("Location: signup.php?error=Username is required!");
		exit();
	}else if (empty($password)){
		header("Location: signup.php?error=Password is required!");
		exit();
	}else if (empty($email)){
		header("Location: signup.php?error=Email is required!");
		exit();
	}else{
		if (isset($password)){
		if(strlen($password) < 8 ) {
			header("Location: signup.php?error=Password must be at least 8 characters in length!");
			exit();
		} else if(!$number){
			header("Location: signup.php?error=Password must contain at least one number!");
			exit();
		}else if(!$uppercase){
			header("Location: signup.php?error=Password must contain at least one upper case letter!");
			exit();
		}else if(!$lowercase){
			header("Location: signup.php?error=Password must contain at least one lower case letter!");
			exit();
		}else if(!$specialChars){
			header("Location: signup.php?error=Password must contain at least one special character!");
			exit();
		}else {
			try{if($conn->query($sql) === TRUE){
				header("Location: signup.php?success=User created successfully!");
			exit();
			}
			}catch(Exception $e){
				header("Location: signup.php?error=User already exists! <br>Try another username");
			}
		}
		
	}
}
}
?>

<form action="signup.php" method="POST" >
	<h2>Create Account</h2>
	<?php if (isset($_GET['error'])){ ?>
		<p class="error"><?php echo $_GET['error']; ?></p>
	<?php } ?>
	<?php if (isset($_GET['success'])){ ?>
		<p class="success"><?php echo $_GET['success']; ?></p>
	<?php } ?>
	<br>
	<br>
	<br>
	<input type="email" name="email" placeholder="Email">
	<input type="text" name="username" placeholder="Username">
	<input type="password" name="password" placeholder="Password"> 
	<br>
	<button>SignUp</button>
</form>

<p class="redirect">Already a member? Log In  <a class="goto-signup" href=signin.php>here! </a></p> 

 
</body>
</html>