<?php

$nts_locations = "http://www.nts.org.uk/property/locationData.php";

$hes_locations = "http://members.historic-scotland.gov.uk/file/scripts/map-script.js";
$hes_start_line = 6;
$hes_end_line = 306;

$rspb_locations = "http://www.rspb.org.uk/includes/xml/reserves.asp";

$out = array();

// get National Trust Scotland locations
$ntsdata = json_decode(file_get_contents($nts_locations));

foreach ($ntsdata as $ntspoint) {
	$out[] = array("name" => $ntspoint->name, "point" => $ntspoint->point);
}

$finalout[] = array("nts" => $out);

// get Royal Society Protection Birds locations
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

// get Historic Environment Scotland locations
$hesdata = file($hes_locations);

$out = array();

for ($i = ($hes_start_line - 1); $i < $hes_end_line; $i++) {

	preg_match("/\[(.*)\]/", trim($hesdata[$i]), $matches);

	$wrangleddata = explode("',", substr($matches[1], 0, -2));

	$out[] = array("name" => substr($wrangleddata[0], 1), "point" => array("lat" => substr($wrangleddata[2], 1), "long" => substr($wrangleddata[3], 1, -1)));
}

$finalout[] = array("hes" => $out);

header("Content-type: application/json");

echo json_encode($finalout);