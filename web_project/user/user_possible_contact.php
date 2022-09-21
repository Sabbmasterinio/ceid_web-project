<?php
session_start();
error_reporting(E_ALL ^ E_WARNING);;
?>

<!-- HTML Code --> 
<!DOCTYPE html>
<html>
<head>
	<title>Possible Contact</title>
    <link rel="stylesheet" type="text/css" href="personaldata.css">
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
              </br>
            <?php
     $conn=new mysqli("localhost", "root", "", "web_project");
     if($conn->connect_errno ){
         echo "<p class='errMsg'>Couldn't connect to DB server. " . $conn->connect_errno ."</p>\n";
         exit();
     }


        $username = $_SESSION["username"];

        $sql = "SELECT T1.user,pois.name, pois.address, T1.time 
        FROM places AS T1
        INNER JOIN places AS T2 ON T1.user <> T2.user AND T1.poi=T2.poi
        INNER JOIN pois ON T1.poi=pois.id
        INNER JOIN infection ON T1.user <> infection.user
        WHERE  T1.time >= DATE_SUB(infection.date_of_inf,INTERVAL 7 DAY) AND 
               T1.time >= DATE_SUB(CURDATE(),INTERVAL 7 DAY) AND 
               T1.user='$username' AND 
               T1.time=T2.time
        ORDER BY T1.time DESC";                                              
        $result = mysqli_query($conn,$sql);
       
        // $sql2 = "SELECT `places`.`user`, ADDTIME(`places`.`time`, `places`.`timespent`) AS EntranceDate, `pois`.`name` FROM 
        // INNER JOIN `pois` ON `places`.`poi` = `pois`.`id` 
        // INNER JOIN `infection` ON `infection`.`user` != '$username' AND ADDTIME(ADDTIME(`places`.`time`, `places`.`timespent`), -7200) <= `infection`.`date_of_inf` AND ADDTIME(ADDTIME(`places`.`time`, `places`.`timespent`), 7200) >= `infection`.`date_of_inf`
        // WHERE  `places`.`user`='$username' AND `infection`.`date_of_inf` >= DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL 7 DAY)";
    ?>

    <div class='box'>
      <h4 class="display-5 text-center">Possible Contact with Positive Cases the past 7 days </h4>
      <br>
      <?php if (mysqli_num_rows($result) > 0) {
      ?>
      <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col"></th>
              <th scope="col">User</th>
              <th scope="col">POI Name</th>
              <th scope="col">POI Address</th>
              <th scope="col">Visit Date</th>
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
              <td><?=$rows['user']?></td>
              <td><?=$rows['name']?></td>
              <td><?=$rows['address']?></td>
              <td><?=$rows['time']?></td>
            </tr>
            <?php } ?>
          </tbody>
      </table>
      <?php } 
      else{
         echo '<script>alert("No possible contacts\nYou are safe!")</script>';
      }?>
  </div>
  <br>
  </div>

  
 
</body>
</html>