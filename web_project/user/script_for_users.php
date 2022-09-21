<?php
$mysqli = new mysqli('localhost', 'root', '', 'web_project'); 
if($mysqli->connect_errno != 0)
{ 
	echo $mysqli->connect_error; 
} 

create users
for($i=1;$i<6;$i++){
$query1 ="INSERT INTO users(email,username,password) VALUES
				('user$i@mail.com', 'user$i','User$i!passwordHere'); ";

if(mysqli_multi_query($mysqli, $query1)){
    echo "success\n";
}
}

for($k=0;$k<20;$k++){
$sql = "SELECT username FROM users";
$sql2 = "SELECT id FROM pois ORDER BY RAND()";
$result = mysqli_query($mysqli,$sql);
$result2 = mysqli_query($mysqli,$sql2);


while($rows = mysqli_fetch_assoc($result)){
   
    while($rows2 = mysqli_fetch_assoc($result2)){

     $poi=$rows2['id'];
        break;
    }
        
    $date = mt_rand(strtotime('2022-08-25'),strtotime('2022-09-17'));
    $final_date = date('Y-m-d',$date);
    $timestamp = mt_rand(12*60*60, 20*60*60);
    $final_timestamp = date('H:i:s',$timestamp);


    $query2 ="INSERT INTO places VALUES
                    ('".$rows['username']."','$poi','$final_date $final_timestamp'); ";

    if(mysqli_multi_query($mysqli, $query2)){
        echo "success\n";
    }
}
}