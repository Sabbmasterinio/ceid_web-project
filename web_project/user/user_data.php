<?php
session_start();
error_reporting(E_ALL ^ E_WARNING);;
?>

<!DOCTYPE html>
<html>
<head>
	<title>User Data</title>
    <link rel="stylesheet" type="text/css" href="personaldata.css">

   
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<?php
    include "sidebar.php";
    ?>

  <div class="container">
            <!-- Database Connection and Query -->
            <?php
    

     // Connecto to DB
     $conn=new mysqli("localhost", "root", "", "web_project");
     if($conn->connect_errno ){
         echo "<p class='errMsg'>Couldn't connect to DB server. " . $conn->connect_errno ."</p>\n";
         exit();
     }


        $username = $_SESSION["username"];
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn,$sql);    
    ?>

    <div class='box'>
      <h4 class="display-5 text-center">Personal Data</h4>
      <br>
      <?php if (mysqli_num_rows($result)) {
        
      ?>
      <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Usename</th>
              <th scope="col">Password</th>
              <th scope="col">Email</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
             $i=0;
              while($rows = mysqli_fetch_assoc($result)){
              $i++;
            ?>
            <tr>
              <th scope="row"><?=$i?></th>
              <td><?=$rows['username']?></td>
              <td><?=$rows['password']?></td>
              <td><?=$rows['email']?></td>
              <td><a href='user_data_update.php?id=<?=$rows['username']?>'
                  class="btn btn-warning">Update</button></td>
            </tr>
            <?php } ?>
          </tbody>
      </table>
      <?php } ?>
  </div>
</div>
<div class="container">
              </br>
            <!-- Database Connection and Query -->
            <?php
    
     // Connecto to DB
     $conn=new mysqli("localhost", "root", "", "web_project");
     if($conn->connect_errno ){
         echo "<p class='errMsg'>Couldn't connect to DB server. " . $conn->connect_errno ."</p>\n";
         exit();
     }


        $username = $_SESSION["username"];
        $sql = "SELECT * FROM places WHERE user = '$username' ORDER BY time DESC";
        $sql2 = "SELECT * FROM infection WHERE user = '$username'";
        $result = mysqli_query($conn,$sql);
        $result2 = mysqli_query($conn,$sql2);
    
    ?>

    <div class='box'>
      <h4 class="display-5 text-center">Visits</h4>
      <br>
      <?php if (mysqli_num_rows($result)) {
        
      ?>
      <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Usename</th>
              <th scope="col">POI Name</th>
              <th scope="col">Visit Datetime</th>
            </tr>
          </thead>
          <tbody>
            <?php
             $i=0;
              while($rows = mysqli_fetch_assoc($result)){
                $i++;
                $poi = $rows['poi'];
                $sql3 = "SELECT name FROM pois WHERE id = '$poi'";
                $result3 = mysqli_query($conn,$sql3);
                if (mysqli_num_rows($result3)) {
                  $rowss = mysqli_fetch_assoc($result3)
                
            ?>
            <tr>
              <th scope="row"><?=$i?></th>
               <td><?=$rows['user']?></td>
              <td><?=$rowss['name']?></td>
              <td><?=$rows['time']?></td>
            </tr>
            <?php } }?>
          </tbody>
      </table>
      <?php }?>
  </div>
  <br>
  <div class='box'>
      <h4 class="display-5 text-center">Covid Infection</h4>
      <br>
      <?php if (mysqli_num_rows($result2)) {
      ?>
      <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Usename</th>
              <th scope="col">Date</th>
            </tr>
          </thead>
          <tbody>
            <?php
             $i=0;
              while($rows = mysqli_fetch_assoc($result2)){
                
              $i++;
            ?>
            <tr>
              <th scope="row"><?=$i?></th>
              <td><?=$rows['user']?></td>
              <td><?=$rows['date_of_inf']?></td>
            </tr>
            <?php } ?>
          </tbody>
      </table>
      <?php } 
      else{ ?>
      <table class="table">
        <tr>
              <th>No covid infection added</th>
        </tr>
      <?php }?>
  </div>
  </div>

  
 
</body>
</html>