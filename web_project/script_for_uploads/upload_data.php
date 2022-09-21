<?php 
error_reporting(E_ALL ^ E_WARNING);
$mysqli = new mysqli('localhost', 'root', '', 'web_project'); 
if($mysqli->connect_errno != 0)
{ 
	echo $mysqli->connect_error; 
} 
// $json_data = file_get_contents("starting_pois.json");  // select the json file u will extract data from
$products = json_decode($_DATA, true); 
$stmt = $mysqli->prepare(" 
INSERT INTO pois(id, name, address, types , lat, lng, rating, rating_n, current_popularity, time_spent) 
VALUES(?,?,?,?,?,?,?,?,?,?) "); 
$stmt->bind_param("ssssdddiss", $id, $name, $address, $types, $lat, $lng, $rating, $rating_n, $current_popularity, $time_spent); 

$inserted_rows = 0; 
$new_rows=0;
foreach ($products as $product) { 

$id = $product["id"];
$name = $product["name"]; 
$address = $product["address"];  
$types = json_encode($product["types"]);
$lat = $product["coordinates"]["lat"];
$lng = $product["coordinates"]["lng"];
$rating = $product["rating"];
$rating_n = $product["rating_n"] ;
$current_popularity = $product["current_popularity"];
$time_spent = json_encode($product["time_spent"]);

// try-catch block to get next unique poi
try{
$stmt->execute(); 
}catch(exception $e){
	$inserted_rows++;
	continue;
}
$new_rows++;
$inserted_rows ++; 
}

//success: all unique pois inserted
if (count($products) == $inserted_rows){ 

echo $new_rows." new row(s) inserted"; }
else{ echo "error"; 
}
// echo "\r\n".$products[0]["id"];


// insert in populartimes
$stmt2 = $mysqli->prepare(" 
INSERT INTO populartimes(popular_id,poi,name,h1,h2) 
VALUES(?,?,?,?,?) "); 
$stmt2->bind_param("sssii",$popular_id, $poi,$name,$h1,$h2); 

for($i=0;$i<count($products);$i++){
	for($j=0;$j<7;$j++){
		$popular_id=$products[$i]["id"].$j;   // this line basically doesn't allow duplicate values --- popular_id is unique in the table
		$poi=$products[$i]["id"];
		$name=$products[$i]["populartimes"][$j]["name"];
		$h1=$products[$i]["populartimes"][$j]["data"][0];
		$h2=$products[$i]["populartimes"][$j]["data"][1];

		try{
			$stmt2->execute(); 
			}catch(exception $e){ 
				continue;
			}
	}
}