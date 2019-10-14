</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>


<script>
    var config = {
        "baseUrl": "",
        "apiRoot": "",
        "index": 1
    };
    mapboxgl.accessToken = 'pk.eyJ1IjoiZmFraHJhd3kiLCJhIjoiY2pscWs4OTNrMmd5ZTNra21iZmRvdTFkOCJ9.15TZ2NtGk_AtUvLd27-8xA';

    var kendari = [122.10348308181318, -3.5014330835094682];

    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v9',
        center: kendari,
        zoom: 8
    });

    var geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
    });


    var marker;
    var linkQ = 'map/user';
    var url = config.apiRoot + linkQ;

    var geojson = {
        'batasLine': 'line',
        'pantaiLine': 'line',
        'kawasanBandara': 'polygon'
    };
    map.on('load', function() {
        addMarker(kendari, 'load');
        allMarkers();

        for (let [key, value] of Object.entries(geojson)) {
            polygonMarker(`${key}`, `${value}`);
        }
        // console.log("panjangnya "+Object.keys(geojson).length);

        // Object.keys(geojson).forEach(function(name){
        //     polygonMarker(name);
        //     console.log("ini name "+name)
        //     console.log("ini type "+Object.values(geojson));
        // });

        geocoder.on('result', function(ev) {});
    });
    document.getElementById('geocoder').appendChild(geocoder.onAdd(map));

    function allMarkers() {
        $.get(url, function(data, status) {
            data.features.forEach(function(marker) {
                var el = document.createElement('div');
                el.className = 'marker';

                new mapboxgl.Marker({
                        color: "#426ff5"
                    })
                    .setLngLat(marker.geometry.coordinates)
                    .setPopup(new mapboxgl.Popup({
                            offset: 25
                        })
                        .setHTML('<h3>' + marker.properties.name + '</h3><p>' + marker.properties.name + '</p>'))
                    .addTo(map);
            });
        });
    }

    function addMarker(ltlng, event) {
        if (event === 'click') {
            kendari = ltlng;
        }
        marker = new mapboxgl.Marker({
                draggable: true,
                color: "#c20e2c"
            })
            .setLngLat(kendari)
            .addTo(map)
            .on('dragend', onDragEnd);

        map.on('click', function(e) {
            marker.remove();
            addMarker(e.lngLat, 'click');
            document.getElementById("lat").value = e.lngLat.lat;
            document.getElementById("lng").value = e.lngLat.lng;
        });
    }

    function polygonMarker(name, type) {


        // console.log();
        if (type === 'polygon') {
            map.addLayer({
                'id': name,
                'type': 'fill',
                'name': name,
                'source': {
                    'type': 'geojson',
                    'data': 'http://localhost/pu-baubau/cobax/' + name + '.geojson',
                },
                'layout': {},
                'paint': {
                    'fill-color': '#088',
                    'fill-opacity': 0.8
                }
            });
        } else if (type === 'line') {
            map.addLayer({
                'id': name,
                'type': type,
                'name': name,
                'source': {
                    'type': 'geojson',
                    'data': 'http://localhost/pu-baubau/cobax/' + name + '.geojson',
                },
                "paint": {
                    "line-color": "#BF93E4",
                    "line-width": 2
                }
            });
        }

        var link = document.createElement('a');
        link.href = '#';
        var keyQ = document.createElement('span');
        keyQ.style.backgroundColor = '#ff1a1a';

        var visCssClass = '';
        var terlihat = document.createAttribute('terlihat');
        terlihat.value = 'visible';
        link.className = visCssClass;
        link.textContent = name;

        map.setLayoutProperty(name, 'visibility', 'none');
        link.onclick = function(e) {

            e.preventDefault();
            e.stopPropagation();

            let visibility = $(this).attr("terlihat");
            console.log(visibility);

            if (visibility === 'visible') {
                map.setLayoutProperty(name, 'visibility', 'visible');
                this.className = 'active';
                terlihat.value = '';
            } else {
                this.className = '';
                map.setLayoutProperty(name, 'visibility', 'none');
                terlihat.value = 'visible';
            }

        };
        link.setAttributeNode(terlihat);
        var layers = document.getElementById('menu');
        layers.appendChild(link);


    }

    function onDragEnd() {
        var lngLat = marker.getLngLat();
        document.getElementById("latitude").value = lngLat.lat;
        document.getElementById("longitude").value = lngLat.lng;
    }
</script>
</body>

</html>