function myMap() {
    var mapProp= {
        center:new google.maps.LatLng(30.057154258392465, 30.97136942036917),
        zoom:16,
    };
    var map = new google.maps.Map(document.getElementById("map"),mapProp);
}
