<?php
session_start();
error_reporting(E_ALL ^ E_WARNING);
?>

<!-- HTML Code --> 
<!DOCTYPE html>
<html>
<head>
	<title>Covid Infection</title>
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
      <h4 class="display-5 text-center">Tell us when you got infected</h4>
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
        <label>Enter Date</label>
        <input type="text" class="form-control" name="date" placeholder="Date Format: yyyy-mm-dd">
      </div>
      <br>
      <button type="submit" class="btn btn-success" name="add">Submit</button>
      
  </form>
  <!-- Database Connection and Query -->
    <?php
    
     $conn=new mysqli("localhost", "root", "", "web_project");
     if($conn->connect_errno ){
         echo "<p class='errMsg'>Couldn't connect to DB server. " . $conn->connect_errno ."</p>\n";
         exit();
     }
    
     if(isset($_POST['add'])){

      function validate($data){
        $data = trim($data);
        return $data;
      }
      

      $username = $_SESSION["username"];
      $date = validate($_POST['date']);
      $sql_q = "SELECT * FROM infection WHERE user = '$username'";
      $res = mysqli_query($conn,$sql_q);
      $res =  mysqli_fetch_assoc($res);

      if(empty($date)){
        header("Location: user_covid_infection.php?error=Date can not be blank!");
      }else if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)){
        header("Location: user_covid_infection.php?error=Date is not in the correct format!");
      }else if(!(strtotime($date) < strtotime('now'))){
        header("Location: user_covid_infection.php?error=You can't predict future infections!");
        echo $date;
      }
      else{
        try{
          $sql = "INSERT INTO infection(user,date_of_inf) VALUES('$username', '$date')";
          $result = mysqli_query($conn,$sql);
          if($result){
            header("Location: user_covid_infection.php?success=Date added successfully!");
          }
        } catch(Exception $e){
          header("Location: user_covid_infection.php?error=Already inserted that date!");
        }
      }
     }
    ?>
  </div>
</body>
</html>