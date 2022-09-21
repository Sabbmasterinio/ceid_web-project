<?php 
$mysqli = new mysqli('localhost', 'root', '', 'web_project'); 
if($mysqli->connect_errno != 0)
{ 
	echo $mysqli->connect_error; 
} 
$json_data = file_get_contents("generic.json");  // select the json file u will extract data from
$products = json_decode($json_data, true); 
$stmt = $mysqli->prepare(" 
INSERT INTO populartimes(h1,h2) 
VALUES(?,?) "); 
$stmt->bind_param("ii", $d1,$d2); 

$inserted_rows = 0; 
foreach ($products as $product ) { 
$d1 = $product["data"][7];
$d2 = $product["data"][8];

$stmt->execute(); 

$inserted_rows ++; 
}

if (count($products) == $inserted_rows){ 
echo "success"; }
else{ echo "error"; 
}




// print_r($json_data);


// SELECT JSON_EXTRACT('$json_data', );

// echo $json_data['id'];