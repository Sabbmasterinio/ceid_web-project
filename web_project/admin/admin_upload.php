<?php
session_start();
error_reporting(E_ALL ^ E_WARNING);

?>

<!DOCTYPE html>
<html>
  <head>
  <title>Upload</title>  
     <link rel="stylesheet" type="text/css" href="styleAdmin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <?php
      include ("sidebar.php");
      
	      $conn = new PDO("mysql:host=localhost;dbname=web_project", 'root', '');
        if(isset($_POST['buttomImport'])) {
          copy($_FILES['jsonFile']['tmp_name'], '../script_for_uploads/'.$_FILES['jsonFile']['name']);
          $_DATA = file_get_contents('../script_for_uploads/'.$_FILES['jsonFile']['name']);
        include ("../script_for_uploads/upload_data.php");

          // $products = json_decode($data);
          // foreach ($products as $product) {
          //     $stmt = $conn->prepare('insert into pois(`id`, `name`, `address`, `lat`, `lng`, `rating`, `rating_n`, `current_popularity`) 
          //                                       values(:id, :name, :address, :lat, :lng, :rating, :rating_n, :current_popularity)');
          //     $stmt->bindValue('id', $product->id);
          //     $stmt->bindValue('name', $product->name);
          //     $stmt->bindValue('address', $product->address);
          //     // $stmt->bindValue('types', $product->types);
          //     $stmt->bindValue('lat', $product->lat);
          //     $stmt->bindValue('lng', $product->lng);
          //     $stmt->bindValue('rating', $product->rating);
          //     $stmt->bindValue('rating_n', $product->rating_n);
          //     $stmt->bindValue('current_popularity', $product->current_popularity);
          //     // $stmt->bindValue('time_spent', $product->time_spent);
          //     $stmt->execute();
        }
           
    ?>
    
    <div id="card"> 
      <h4>Upload POIs</h4>
      <br>
      <br>
      <form method="post" enctype="multipart/form-data">
			JSON File <input type="file" name="jsonFile">
			<br>
			<input type="submit" value="Import" name="buttomImport" class="btn btn-success">
		</form>
    </head>
    </html>