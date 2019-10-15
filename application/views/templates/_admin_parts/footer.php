<footer class="main-footer">
  <strong>Copyright &copy; 2019 <?= APP_AUTHOR ?>.</strong>
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 3.0.0-rc.1
  </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url('assets/') ?>plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<!-- <script src="<?= base_url('assets/') ?>plugins/sparklines/sparkline.js"></script> -->
<!-- JQVMap -->
<script src="<?= base_url('assets/') ?>plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/jqvmap/maps/jquery.vmap.world.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('assets/') ?>plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url('assets/') ?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/') ?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/') ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/') ?>dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url('assets/') ?>dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?= base_url('assets/') ?>dist/js/demo.js"></script> -->
<!-- bootstrap datepicker -->
<script src="<?= base_url('assets/') ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script>
  $(function() {
    //Date range picker
    $('.datepicker').datepicker();
    // console.log( $('.datepicker').val() );
  })
</script>

<script>
  $(document).ready(function() {
    var t = $('#summernote').summernote({
      height: 500,
      // focus: true
    });
    $("#btn").click(function() {
      $('div.note-editable').height(150);
    });
  });
</script>

<script>
  var cor = [];
  <?php $i = 0; ?>
  <?php foreach ($cordinate as $key => $value) : ?>
    <?= $key ?> = [<?= $value[0] ?>, <?= $value[1] ?>];
    cor[<?= $i ?>] = <?= $key ?>;
    <?php $i++; ?>
  <?php endforeach; ?>

  var config = {
    "baseUrl": "",
    "apiRoot": "",
    "index": 1
  };
  mapboxgl.accessToken = 'pk.eyJ1IjoiZmFraHJhd3kiLCJhIjoiY2pscWs4OTNrMmd5ZTNra21iZmRvdTFkOCJ9.15TZ2NtGk_AtUvLd27-8xA';

  var konut = [<?= $cordinate['konut_0'][0]; ?>, <?= $cordinate['konut_0'][1]; ?>];
  var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v9',
    center: konut,
    zoom: <?php echo (isset($zoom)) ? $zoom : 12 ?>
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
    addMarker(konut, 'load');
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
      <?php $i = 0; ?>
      <?php foreach ($cordinate as $key => $value) : ?>
        cor[<?= $i ?>] = ltlng;
        <?php $i++; ?>
      <?php endforeach; ?>
    }
    console.log(cor.length);
    <?php $i = 0; ?>
    <?php foreach ($cordinate as $key => $value) : ?>
      marker_<?= $i; ?> = new mapboxgl.Marker({
          draggable: true,
          color: "#c20e2c"
        })
        .setLngLat(cor[<?= $i; ?>])
        .addTo(map)
        .on('dragend', onDragEnd);
      <?php $i++; ?>
    <?php endforeach; ?>

    map.on('click', function(e) {
      marker.remove();
      addMarker(e.lngLat, 'click');
      document.getElementById("latitude").value = e.lngLat.lat;
      document.getElementById("longitude").value = e.lngLat.lng;
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