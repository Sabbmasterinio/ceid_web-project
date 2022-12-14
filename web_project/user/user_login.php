<?php
session_start();
error_reporting(E_ALL ^ E_WARNING);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Welcome!</title>

    <!-- CSS: -->
    <link rel="stylesheet" type="text/css" href="user_style.css"> 

    <!-- leaflet code found on: https://leafletjs.com/download.html -->
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
      integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
      crossorigin=""
    />
    <script
      src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
      integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
      crossorigin=""
    ></script>
    <!-- live location  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.76.1/dist/L.Control.Locate.min.css" />
<script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.76.1/dist/L.Control.Locate.min.js" charset="utf-8"></script>
    <style>
      #map {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
      }
    </style>
  </head>
  <body>

      

  <?php
  include "sidebar.php";
  ?>

    <div id="map"></div>
    <script>
      var map = L.map("map").setView([38.246142, 21.735200], 15);
      L.tileLayer(
        'https://api.maptiler.com/maps/openstreetmap/{z}/{x}/{y}.jpg?key=0HFidHVyj5JGlGUaFgpX',
        {
          attribution:
            '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>',
        }
      ).addTo(map);
      
      L.control.locate().addTo(map);

    </script>
<br><br><br><br><br>
        <h1>You can press the <img src="../photos/live_position.png" > button on map to see live location
</h1>
          
  </body>
</html>