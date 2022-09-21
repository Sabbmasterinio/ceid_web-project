<?php 
    $conn=new mysqli("localhost", "root", "", "web_project");
    $sql1 = "DELETE FROM places ";
    $sql2 = "DELETE FROM populartimes ";
	 $sql = "DELETE FROM pois";
    $result = mysqli_query($conn,$sql1);
    $result = mysqli_query($conn,$sql2);
    $result = mysqli_query($conn,$sql);
   if ($result) {
   	  header("Location:admin_delete.php?success=All data successfully deleted");
   }else {
      header("Location:admin_delete.php?error=unknown error occurred");
   }
?>