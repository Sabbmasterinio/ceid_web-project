<?php
session_start();
?>
<?php
    error_reporting(E_ALL ^ E_WARNING);
    $keyword = isset($_POST["poi_keyword"])?$_POST["poi_keyword"]:"";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>POIs Search</title>
        <meta charset="utf-8"/>
        <!-- Responsive -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Custom CSS -->
        <link rel="stylesheet"  type="text/css" href="user_search.css"/>
        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    </head>
    <body>
    <?php
    include "sidebar.php";
    ?>
    
      <div id="mapid"></div>
      </td>
    </tr>
            <tr>
            
                <div class="search" >
                    <br>
                    <form method="POST" action="">
                        <input type="text" name="poi_keyword" class="button" placeholder="Insert name, address or rating" value="">
                        <button type="submit" id="btn_find">Search</button>
                    </form>
                    
                </div>
                <div class="resultTable">
                    <?php
                       

                        // Connecto to DB
                        $conn=new mysqli("localhost", "root", "", "web_project");
                        if($conn->connect_errno ){
                            echo "<p class='errMsg'>Couldn't connect to DB server. " . $conn->connect_errno ."</p>\n";
                            // Exit PHP and end HTML
                            exit();
                        }

                        $clean_keyword = $conn->real_escape_string($keyword);
                        
                        
                        //SQL Syntax
                        $query = "SELECT * FROM pois WHERE name LIKE '%".$clean_keyword."%' OR address LIKE '%".$clean_keyword."%' OR rating LIKE '%".$clean_keyword."%' GROUP BY name ASC";

                        //Execute SQL
                        $result = $conn->query($query);

                        //Count results
                        $rowCount = $result->num_rows;

                        // echo $rowCount;
                        if($rowCount == 0)
                        {
                            echo "<p class='countMsg'>No Record(s) Found</p>\n </div> </td> </tr> </table> </body> </html>";
                            
                        }else{
                            echo "<br><p class='countMsg'>".$rowCount." Record(s) Found</p>\n";
                        }

                        if($rowCount > 0){
                            echo "
                            <table class='' summary=''>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Rating</th>
                                <th>Langitude</th>
                                <th>Longitude</th>
                            </tr>
                            ";

                            while ($row = $result->fetch_array()){
                                //Assing table variables

                                $id = $row[0];
                                $name = $row[1];
                                $address = $row[2];
                                $types = $row[3];
                                $lat = $row[4];
                                $lng = $row[5];
                                $rating = $row[6];
                                $rating_n = $row[7];
                                $current_popularity = $row[8];
                                $time_spent = $row[9];

                                // Store results into JSON array

                                $rows[] = array(
                                    "id" => $id,
                                    "name" =>  $name,
                                    "address" => $address,
                                    "types" => $types,
                                    "lat" => $lat,
                                    "lng" => $lng,
                                    "rating" => $rating,
                                    "rating_n" => $rating_n,
                                    "current_popularity" => $current_popularity,
                                    "time_spent" => $time_spent
                                );
                            

                            echo "
                            <tr>
                                <td>".$name."</td>
                                <td>".$address."</td>
                                <td>".$rating."</td>
                                <td>".$lat."</td>
                                <td>".$lng."</td>
                            </tr>
                            ";
                        }
                        echo "<table>\n";
                     
                    }
                    // Encode rows data to JSON format

                    $jsonOutput = json_encode($rows);

                    // echo $jsonOutput;

                    // Free and close DB connection
                    $result->free();
                    $conn->close();
                    ?>
                </div>
            </td>
            <td>
             
            </td>   
        </tr>
    </table>
    
    
        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" 
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" 
        crossorigin=""></script>

        <!-- JSON Data -->
        <?php
            //Dislpay POIs data from JSON output as <script> tag
            echo "<script type='text/javascript'>";
            echo "var dataPOI = " .$jsonOutput.";\n";
            echo "</script>\n";
        ?>

        <!-- Custom JS -->
        <script src="markers_on_map.js" type="text/javascript" ></script>






    </body>
    
    
</html>