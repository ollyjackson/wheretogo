<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://npmcdn.com/leaflet@1.0.0-rc.3/dist/leaflet.css" />
</head>
<body>
	<div id="mapid" style="width: 800px; height: 800px"></div>

	<script src="https://npmcdn.com/leaflet@1.0.0-rc.3/dist/leaflet.js"></script>
	<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
	<script>

		var mymap = L.map('mapid').setView([55.953252, -3.188267], 7);

		var rspbicon = L.icon({iconUrl: 'rspb-icon.png'});
		var ntsicon = L.icon({iconUrl: 'nts-icon.png'});
		var hesicon = L.icon({iconUrl: 'hes-icon.png'});

		L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw', {
			maxZoom: 18,
			attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
				'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
				'Imagery © <a href="http://mapbox.com">Mapbox</a>',
			id: 'mapbox.streets'
		}).addTo(mymap);

		$.getJSON( "getdata.php", function( data ) {
			$.each( data, function( key, val ) {
				$.each(val.rspb, function( innerkey, innerval) {
					L.marker([innerval.point.lat, innerval.point.long], {icon: rspbicon}).addTo(mymap)
						.bindPopup(innerval.name).openPopup();
				});

				$.each(val.nts, function( innerkey, innerval) {
					L.marker([innerval.point.lat, innerval.point.long], {icon: ntsicon}).addTo(mymap)
						.bindPopup(innerval.name).openPopup();
				});

				$.each(val.hes, function( innerkey, innerval) {
					L.marker([innerval.point.lat, innerval.point.long], {icon: hesicon}).addTo(mymap)
						.bindPopup(innerval.name).openPopup();
				});
			 });
		});
	</script>
</body>
</html>