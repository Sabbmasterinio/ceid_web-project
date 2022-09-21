<?php
session_start();
error_reporting(E_ALL ^ E_WARNING);;
?>

<!-- HTML Code --> 
<!DOCTYPE html>
<html>
<head>
	<title>Delete</title>
    <link rel="stylesheet" type="text/css" href="styleAdmindelete.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<?php
  include "sidebar.php";
  ?>

    <div class="container">
            <?php
    

     // Connecto to DB
     $conn=new mysqli("localhost", "root", "", "web_project");
     if($conn->connect_errno ){
         echo "<p class='errMsg'>Couldn't connect to DB server. " . $conn->connect_errno ."</p>\n";
         // Exit PHP and end HTML
         exit();
     }


        $username = $_SESSION["username"];
        $sql = "SELECT * FROM pois GROUP BY name ASC";
        $result = mysqli_query($conn,$sql);
       
    
    ?>
           
      <div class="box">
      <div class="col-md-10 text-right">
      <h4 class="display-4 text-right">POIs</h4>
      <br>
      <a href="admin_select_deleteall.php"class="btn btn-danger text-right remove">Delete All Data</a>

      <!-- prospatheia confirm-delete : -->
      <!-- <script type="text/javascript">
        $(".remove").click(function(){
         var id = $(this).parents("tr").attr("id");


        if(confirm('Are you sure to remove this record ?'))
        {
            $.ajax({
               url: '/delete.php',
               type: 'GET',
               data: {id: id},
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
                    $("#"+id).remove();
                    alert("Record removed successfully");  
               }
            });
        }
        }); -->


</script>


      </div>
      <br>
      <?php if (isset($_GET['success'])) { ?>
		    <div class="alert alert-warning text-center" role="alert">
			  <?php echo $_GET['success']; ?>
		    </div>
		    <?php } ?>
      <?php if (mysqli_num_rows($result)) {
      ?>
      <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col"></th>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Address</th>
              <th scope="col">Rating</th>
              <th scope="col"></th>
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
              <td><?=$rows['id']?></td>
              <td><?=$rows['name']?></td>
              <td><?=$rows['address']?></td>
              <td><?=$rows['rating']?></td>
              <td><a href="admin_select_delete.php?id=<?=$rows['id']?>"
                  class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php } ?>
          </tbody>
      </table>
      <?php } ?>
  </div>
</div>
</div>    
</div>



    
</body>
</html>