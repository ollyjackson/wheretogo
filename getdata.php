<?php

$nts_locations = "http://www.nts.org.uk/property/locationData.php";

$hes_locations = "http://members.historic-scotland.gov.uk/file/scripts/map-script.js";
$hes_start_line = 6;
$hes_end_line = 306;

$rspb_locations = "http://www.rspb.org.uk/includes/xml/reserves.asp";

$ntsdata = json_decode(file_get_contents($nts_locations));

$out = array();

foreach ($ntsdata as $ntspoint) {
	$out[] = array("name" => $ntspoint->name, "point" => $ntspoint->point);
}

$finalout[] = array("nts" => $out);

$rspbdata = file_get_contents($rspb_locations);
$doc = new DOMDocument();
$doc->loadXML($rspbdata);
$rspbitems = $doc->getElementsByTagName("item");

$out = array();

foreach ($rspbitems as $rspbitem) {
	foreach ($rspbitem->getElementsByTagName("latitude") as $latitude) {
		$lat = $latitude->nodeValue;
	}

	foreach ($rspbitem->getElementsByTagName("longitude") as $longitude) {
		$long = $longitude->nodeValue;
	}

	foreach ($rspbitem->getElementsByTagName("name") as $name) {
		$nam = $name->nodeValue;
	}

	$out[] = array("name" => $nam, "point" => array("lat" => $lat, "long" => $long));
}

$finalout[] = array("rspb" => $out);

$hesdata = file($hes_locations);

$out = array();

for ($i = ($hes_start_line - 1); $i < $hes_end_line; $i++) {
	preg_match("/(-?[0-9\.]+)','(-?[0-9\.]+)/", trim($hesdata[$i]), $matches);
	$out[] = array("name" => "unnamed hes", "point" => array("lat" => $matches[1], "long" => $matches[2]));
}

$finalout[] = array("hes" => $out);

header("Content-type: application/json");

echo json_encode($finalout);