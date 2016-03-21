<?php
/**
 * Template Name: contact us 
 */
//* Add google map
add_action('genesis_before_footer', 'bounded_map',1);

function bounded_map() {
    $location = get_field('google_map');
    if (!empty($location)):
        ?>
        <div class="acf-map">
            <script src='https://maps.googleapis.com/maps/api/js?sensor=false?v=3.exp&signed_in=true&language=en' type='text/javascript'></script>
            <div id="map"  style="width: 100%; height: 350px;"></div>
            <script src='https://maps.googleapis.com/maps/api/js?sensor=false?v=3.exp&signed_in=true&language=en' type='text/javascript'></script>
            <script type="text/javascript">

                var lat = <?php echo $location['lat']; ?>;
                var lng = <?php echo $location['lng']; ?>;
                var radius = <?php echo get_field('radius'); ?>;
                var zoom = <?php echo get_field('zoom'); ?>;
                var latlng = new google.maps.LatLng(lat, lng);

                var cityCircle;

                function initialize() {
                    // Create the map.
                    var mapOptions = {
                        zoom: zoom,
                        center: latlng,
                        mapTypeId: google.maps.MapTypeId.TERRAIN
                    };
                    //draw a map

                    var map = new google.maps.Map(document.getElementById('map'),
                            mapOptions);


                    var CircleOptions = {
                        strokeColor: '#026607',
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: '#026607',
                        fillOpacity: 0.15,
                        map: map,
                        center: latlng,
                        radius: radius
                    };
                    // Add the circle for this city to the map.
                    cityCircle = new google.maps.Circle(CircleOptions);
                }

                google.maps.event.addDomListener(window, 'load', initialize);

            </script>

        </div>
    <?php
    endif;
}

genesis();
