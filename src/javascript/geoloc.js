const x = document.getElementById("location");
    window.addEventListener("load", getLocation);

    function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition,showError);
    } else {
        x.innerHTML = "Geolocalizzazione non funzionante";
    }
    }

    var lat;
    var long;

    function showPosition(position) {
        lat = position.coords.latitude;
        long = position.coords.longitude;

        //Create query for the API.
        var latitude = "latitude=" + lat;
        var longitude = "&longitude=" + long;
        var query = latitude + longitude + "&localityLanguage=en";
        const Http = new XMLHttpRequest();
        var citta = "nulla";
        var bigdatacloud_api = "https://api.bigdatacloud.net/data/reverse-geocode-client?";
        bigdatacloud_api += query;
        Http.open("GET", bigdatacloud_api);
        Http.send();
        Http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var myObj = JSON.parse(this.responseText);
                //return myObj.city;
                x.innerHTML="Posizione utente : " + myObj.city;
            }
        }
    }

    function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
        x.innerHTML = "L'utente non ha fornito la geolocalizzazione"
        break;
        case error.POSITION_UNAVAILABLE:
        x.innerHTML = "Informazioni sulla posizione non disponibili."
        break;
        case error.UNKNOWN_ERROR:
        x.innerHTML = "Errore sconosciuto."
        break;
    }
    }