<?php

$nts_locations = "http://www.nts.org.uk/property/locationData.php";

$hes_locations = "https://www.historicenvironment.scot/visit-a-place/search-results/";
$hes_locations_xpath = "/html/body/div[2]/script[2]";

$rspb_locations = "http://www.rspb.org.uk/includes/xml/reserves.asp";

$ntsdata = json_decode(file_get_contents($nts_locations));

$out = array();

foreach ($ntsdata as $ntspoint) {
	//var_dump($ntspoint);
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

header("Content-type: application/json");

echo json_encode($finalout);