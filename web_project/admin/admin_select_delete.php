<?php 
if(isset($_GET['id'])){
    $id= $_GET['id'];
        echo  $id;
    $conn=new mysqli("localhost", "root", "", "web_project");
    $sql1 = "DELETE FROM places WHERE poi='$id'";
    $sql2 = "DELETE FROM populartimes WHERE poi='$id'";
	$sql3 = "DELETE FROM pois WHERE id='$id'";
    $result = mysqli_query($conn,$sql1);
    $result = mysqli_query($conn,$sql2);
    $result = mysqli_query($conn,$sql3);
   if ($result) {
   	  {header("Location:admin_delete.php?success=POI deleted successfully");
         exit();}
   }else {
      header("Location:admin_delete.php?error=unknown error occurred");
   }

}else {
	header("Location:adminDashboardDelete.php");
}
?>