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

header("Content-type: application/json");

echo json_encode($out);