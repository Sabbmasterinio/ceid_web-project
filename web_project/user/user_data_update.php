<?php
session_start();
error_reporting(E_ALL ^ E_WARNING);;
?>
<?php
   
   $conn=new mysqli("localhost", "root", "", "web_project");
   if($conn->connect_errno ){
       echo "<p class='errMsg'>Couldn't connect to DB server. " . $conn->connect_errno ."</p>\n";
       exit();
   }
  
    

    $username = $_SESSION["username"];

      $sql = "SELECT * FROM users WHERE username='$username'";
      $result = mysqli_query($conn,$sql);
      if( mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
      }

?>

<!-- HTML Code --> 
<!DOCTYPE html>
<html>
<head>
	<title>Update User Data</title>
    <link rel="stylesheet" type="text/css" href="covid.css">
    <!-- Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<?php
    include "sidebar.php";
    ?>
  <div class="container">
  <form method="POST">
      <h4 class="display-5 text-center">Update</h4>
      <br>
      <?php if (isset($_GET['error'])){ ?>
        <div class="alert alert-danger" role="alert">
        <?php echo $_GET['error']; ?>
        </div>
		    <?php } ?>
        <?php if (isset($_GET['success'])){ ?>
        <div class="alert alert-success" role="alert">
        <?php echo $_GET['success']; ?>
        </div>
		    <?php } ?>
        
        
      
      <br>
      <div class="form-group">
        <label>Username</label>
        <input class="form-control" id="disabledInput" type="text" value='<?=$row['username']?>' disabled>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="text" class="form-control" id="password" name="password" value='<?=$row['password']?>'>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control" id="email" name="email" value='<?=$row['email']?>'>
      </div>
      <br>
      <button type="submit" class="btn btn-success" name="update">SAVE</button>
      
  </form>

    <?php
     $conn=new mysqli("localhost", "root", "", "web_project");
     if($conn->connect_errno ){
         echo "<p class='errMsg'>Couldn't connect to DB server. " . $conn->connect_errno ."</p>\n";
         exit();
     }
    
     if(isset($_POST[ 'password']) && isset($_POST[ 'email'])){

      function validate($data){
        $data = trim($data);
        return $data;
      }
      $username = $_SESSION["username"];
      $password = validate($_POST['password']);
      $email = validate($_POST['email']);

      if(empty($password) && empty($email)){
        header("Location: user_data_update.php?error=Password and email can not be blank!");
      }else if(empty($password)){
        header("Location: user_data_update.php?error=Password can not be blank!");
      }else if(empty($email)){
        header("Location: user_data_update.php?error=Email can not be blank!");
      }else{
        $sql = "UPDATE users SET password='$password',email='$email' WHERE username='$username'";
        $result = mysqli_query($conn,$sql);
        if($result){
          header("Location: user_data_update.php?success=Changes saved successfully!");
        }
      }
    }
    ?>
  </div>
</body>
</html>