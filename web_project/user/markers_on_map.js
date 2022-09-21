//script for markers

var map = L.map("mapid").setView([38.246142, 21.735200], 13.5);

// Google Maps Layer
L.tileLayer(
    'https://api.maptiler.com/maps/openstreetmap/{z}/{x}/{y}.jpg?key=0HFidHVyj5JGlGUaFgpX',
    {
      attribution:
        '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>',
    }
  ).addTo(map);

//checks for color of marker
for (var i=0; i<dataPOI.length; i++){
    if  (dataPOI[i].current_popularity == null){
        var leafletImage = L.icon({
            iconUrl: '../photos/green.png',
            iconSize: [30, 40],
            iconAnchor: [15, 40],
            popupAnchor: [0, -35]
        });
        function clickZoom(e) {
            map.setView(e.target.getLatLng(),17);
        }
        L.marker([dataPOI[i].lat,dataPOI[i].lng],{icon: leafletImage}).bindPopup("<b>"+ dataPOI[i].name  + "</b><br />Address: "+ dataPOI[i].address + "</b><br />Rating: " + dataPOI[i].rating + "</b><br />Popularity: " + "This place seems to be empty!").on('click', clickZoom).addTo(map);
    }else if  (dataPOI[i].current_popularity>0 && dataPOI[i].current_popularity <=32){
        var leafletImage = L.icon({
            iconUrl: '../photos/green.png',
            iconSize: [30, 40],
            iconAnchor: [15, 40],
            popupAnchor: [0, -35]
        });
        function clickZoom(e) {
            map.setView(e.target.getLatLng(),17);
        }
        L.marker([dataPOI[i].lat,dataPOI[i].lng],{icon: leafletImage}).bindPopup("<b>"+ dataPOI[i].name  + "</b><br />Address: "+ dataPOI[i].address + "</b><br />Rating: " + dataPOI[i].rating + "</b><br />Popularity: " + dataPOI[i].current_popularity+"%").on('click', clickZoom).addTo(map);
    }else if (dataPOI[i].current_popularity > 32 && dataPOI[i].current_popularity <= 65) {
        var leafletImage = L.icon({
            iconUrl: '../photos/orange.png',
            iconSize: [30, 40],
            iconAnchor: [15, 40],
            popupAnchor: [0, -35]
        });
        function clickZoom(e) {
            map.setView(e.target.getLatLng(),17);
        }
        L.marker([dataPOI[i].lat,dataPOI[i].lng],{icon: leafletImage}).bindPopup("<b>"+ dataPOI[i].name  + "</b><br />Address: "+ dataPOI[i].address + "</b><br />Rating: " + dataPOI[i].rating + "</b><br />Popularity: " + dataPOI[i].current_popularity+"%").on('click', clickZoom).addTo(map);
    }else {
        var leafletImage = L.icon({
            iconUrl: '../photos/red.png',
            iconSize: [30, 40],
            iconAnchor: [15, 40],
            popupAnchor: [0, -35]
        });
        function clickZoom(e) {
            map.setView(e.target.getLatLng(),17);
        }
        L.marker([dataPOI[i].lat,dataPOI[i].lng],{icon: leafletImage}).bindPopup("<b>"+ dataPOI[i].name  + "</b><br />Address: "+ dataPOI[i].address + "</b><br />Rating: " + dataPOI[i].rating + "</b><br />Popularity: " + dataPOI[i].current_popularity+"%").on('click', clickZoom).addTo(map);
     }
}