<?php
session_start();
error_reporting(E_ALL ^ E_WARNING);
?>

<!-- HTML Code --> 
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
    <link rel="stylesheet" type="text/css" href="styleAdmin.css">
    <meta charset="utf-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/> -->
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
</head>
<body>
<?php
  include "sidebar.php";
  ?>
   

<div id="card">
<div class="row">
<div class="container">
  <h2>APP INFO BELOW</h2>
  <p>Displayed: Total Users, Total POIs, Total Visits, Total Covid-Infections</p>
  <br>
  
  <table class="table">
    
    <tbody>
       
      <tr class="success">
        <td>Users</td>
        <td >
        <?php
                   
                  
         $conn = new mysqli("localhost", "root", "", "web_project");
         $sql = "SELECT COUNT(*) AS total FROM users";
         $result = mysqli_query($conn,$sql);
         $data = mysqli_fetch_assoc($result);
         // we decrease 1 so we don't count the admin 
         $real = $data['total'] - 1;
         echo   $real;
        ?>
        
      </tr>
      <tr class="info">
      <td>POIs</td>
        <td>
          <?php
                   
                  
            $conn = new mysqli("localhost", "root", "", "web_project");
            $sql = "SELECT COUNT(*) AS total FROM pois";
            $result = mysqli_query($conn,$sql);
            $data = mysqli_fetch_assoc($result);
            $real = $data['total'];
            echo   $real; 
    ?>
      </td>
      </tr>
      <tr class="warning">
        <td>Visits</td>
        <td><?php     
            $conn = new mysqli("localhost", "root", "", "web_project");
            $sql = "SELECT COUNT(*) AS total FROM places";
            $result = mysqli_query($conn,$sql);
            $data = mysqli_fetch_assoc($result);
            $real = $data['total'];
            echo   $real; 
      ?>      
      </td>
      </tr>
  
      <tr class="danger">
        <td>Covid Infections</td>
        <td><?php        
          $conn = new mysqli("localhost", "root", "", "web_project");
          $sql = "SELECT COUNT(*) AS total FROM infection";
          $result = mysqli_query($conn,$sql);
          $data = mysqli_fetch_assoc($result);
          $real = $data['total'];
          echo   $real; ?>
      </td>
      </tr>
    </tbody>
  </table>
</div>

<br>
<br>
<div>

<?php
  $conn = new mysqli("localhost", "root", "", "web_project");
  $sql2 =  $conn->query("SELECT pois.name as poi, pois.current_popularity as popularity
  FROM pois
  WHERE pois.current_popularity > 66
  GROUP BY pois.current_popularity DESC
  ");

  foreach($sql2 as $data){
    $poi[] = $data['poi'];
    $popularity[] = $data['popularity'];
  }
    
    ?>
    <br>
    <div style="width:50%; margin-left:200px; text-align:center">
    <h4>POIs with high popularity Pie</h4>
      <canvas id="myChart2"></canvas>
      <br>
    </div>

    <script>

const data2 = {
  labels:<?php echo json_encode($poi)?>,
  datasets: [{
    label: '',
    data: <?php echo json_encode($popularity)?>,
    backgroundColor: [
      'rgb(179, 11, 0)',
      'rgb(215, 41, 41)',
      'rgb(255, 7, 7)',
      'rgb(224, 87, 87)',
      'rgb(236, 149, 149)',
      'rgb(240, 176, 176)',
      'rgb(244, 197, 197)'
    ],
    hoverOffset: 4
  }]
};

const config2 = {
  type: 'pie',
  data: data2,
};
</script>

<script>
  const myChart2 = new Chart(
    document.getElementById('myChart2'),
    config2
  );
</script>

<?php
$conn = new mysqli("localhost", "root", "", "web_project");
  $sql =  $conn->query("SELECT pois.types as types, COUNT(places.poi) as visits
  FROM pois
  INNER JOIN places ON pois.id = places.poi
  GROUP BY pois.types
  ");

  foreach($sql as $data){
    $visit[] = $data['places'];
    $types[] = $data['types'];
  }
    
    ?>
    <!-- <div class='row'> -->
    <div style="width:60%; margin-left:150px; text-align:center">
    <h4>Visits per Category Pie</h4>
      <canvas id="myChart"></canvas>
      <br>
    
    </div>

    <script>

const data = {
  labels:<?php echo json_encode($types)?>,
  datasets: [{
    label: 'Visits per Category',
    data: <?php echo json_encode($visit)?>,
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 205, 86)',
      'rgb(54, 162, 235)',
      'rgb(75, 192, 192)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)',
      'rgb(255, 159, 64)',
      'rgb(179, 11, 0)'
    ],
    hoverOffset: 4
  }]
};

const config = {
  type: 'doughnut',
  data: data,
};
</script>

<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
</div>
</div>
</div>

<br>
<br>

</body>
</html>