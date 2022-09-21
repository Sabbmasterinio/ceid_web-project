<?php 
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'web_project'); 
if($mysqli->connect_errno != 0)
{ 
	echo $mysqli->connect_error; 
} 

$json_data = file_get_contents("generic.json");  // select the json file u will extract data from
$products = json_decode($json_data,true);
// print_r($products);
$query = "";
 

display_array_recursive($products);
function display_array_recursive($json_rec){
	if($json_rec){
		foreach($json_rec as $key=> $value){

            if($key=="id"){
                $id = $value;
                // echo $id;
            }
			if(is_array($value)){

                if($key=="types" ){
                    $types_json = json_encode($value);
                     echo $id . $types_json;
                    $query .= 
                    "INSERT INTO categories(poi,types) 
                    VALUES('$id', '$types_json'); ";      
                }
                
				display_array_recursive($value);
			}else{
                
				// echo $key.'--'.$value.'<br>';
			}	
		}	
	}	
}	

// $query = "";
// foreach($products as $product) {
//     $id = $product['id'];
//     $types = $product['types'];
 
//     foreach($types as $type) {
//         echo $id.' has '.$country['name'].' in '.$country['year'].'.';
//     }
// }

// print_r ($products);

// echo $products["0"]["types"]["1"];


// display_array_recursive($products);


// function display_array_recursive($json_rec){
// 	if($json_rec){
// 		foreach($json_rec as $key=> $value){
// 			if(is_array($value)){
// 				display_array_recursive($value);
// 			}else{
// 				$query .= "INSERT INTO categories(poi,type1,type2,type3,type4,type5,type6) VALUES
// 				('".$value["name"]."', '".$row["gender"]."',
// 				'".$row["subject"]."'); ";
// 			}	
// 		}	
// 	}	
// }	