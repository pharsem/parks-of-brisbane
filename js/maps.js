////////////////////////////////////////////////////////////////////////
// Function for all map features
////////////////////////////////////////////////////////////////////////

(function() {
    window.onload = function() {

        // Array of hard-coded locations
        /*var locations = [
            ['<h1>King Edward Park</h1>', -27.46592964, 153.0240113, '<p><a href="sample-item.php">More info</a></p>'],
            ['<h1>Kurilpa Point Park</h1>', -27.46986502, 153.0162047, '<p><a href="sample-item.php">More info</a></p>'],
            ['<h1>Powerhouse Park</h1>', -27.46778508, 153.0541694, '<p><a href="sample-item.php>More info</a></p>'],
            ['<h1>Musk Avenue Park</h1>', -27.45443025, 153.014476, '<p><a href="sample-item.php>More info</a></p>'],
            ['<h1>Wickham Park</h1>', -27.46571131, 153.0219679, '<p><a href="sample-item.php>More info</a></p>'],
            ['<h1>West End Community Park</h1>', -27.47975625, 153.0120341, '<p><a href="sample-item.php>More info</a></p>']

        ];*/

        // General options for the maps
        var options = {
            zoom: 11,
            center: new google.maps.LatLng(-27.4724118, 153.0242805),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        // check what kind of map is needed, for the search result pages a map element is
        // created and the function continues.
        //
        // If it's the single item page, the map only needs to have one single marker,
        // so the function is cancelled (return;) when the map and that marker has been created
        if($("#map-result").length > 0) {

            var map = new google.maps.Map(document.getElementById('map-result'), options);

        } else if($("#map-single-item").length > 0) {

            var map = new google.maps.Map(document.getElementById('map-single-item'), options);

            var location = new google.maps.LatLng(locations[0].latitude, locations[0].longitude);

            new google.maps.Marker({
                position: location,
                map: map
            })

            return;
        }


        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        if($("#distance-result").length > 0) {
            $limit = 20;
        } else {
            $limit = locations.length;
        }

        // generate markers and info windows for each location
        for (i = 0; i < $limit; i++) {

            var location = new google.maps.LatLng(locations[i].latitude, locations[i].longitude)

            // place markers on the map
            marker = new google.maps.Marker({
                position: location,
                map: map
            });

            // eventlistener to open info windows when markers are pressed
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent((locations[i].name + ('<p><a href="single-item.php?item-id=' + locations[i].id + '">More info</a></p>')));
                    infowindow.open(map, marker);
                }
            })(marker, i));

        }


        // check if geolocation is supported by the browser, get position if it is
        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, error);
        }

        // if the position collection works, place a marker on the map and calculate distances
        function success(position) {
            var pos = position.coords;

            // place a marker of the user's location on the map
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(pos.latitude, pos.longitude),
                map: map,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 8
                }
            });

            if($("#distance-result").length > 0) {

                // new array for markers sorted by distance
                var markersByDistance = [];

                // calculating distances from each location to user's position
                for (i = 0; i < locations.length; i++ ) {

                    var marker = locations[i];

                    // using pythagoras to calculate distance
                    var dx = pos.longitude - marker.longitude;
                    var dy = pos.latitude - marker.latitude;
                    var distance = Math.sqrt( dx * dx + dy * dy );

                    markersByDistance[i] = marker;
                    markersByDistance[i].distance = (distance * 100).toFixed(1); //convert to format x.x km


                }

                // function to sort the array by distance
                function sorter (a,b) {
                    return a.distance > b.distance ? 1 : -1;
                }

                markersByDistance.sort(sorter);

                // print the search result in the right order
                for (i = 0; i < 20; i++) {
                    if(markersByDistance[i].distance <= 10) {

                        var text = '<div class="search-result">' + markersByDistance[i].name +
                            '<p>' + markersByDistance[i].distance + ' km from your location</p>' +
                            '<p><a href="single-item.php?item-id=' + markersByDistance[i].id + '">More info</a></p></div>';

                        document.getElementById('distance-result').innerHTML += text;
                    }

                }
            }
        }

        // in case the geolocation fails
        function error(err) {
            console.warn('ERROR(' + err.code + '): ' + err.message);
        }
    };
})();