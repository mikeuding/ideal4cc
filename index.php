<?php

// ori: http://pastebin.com/YXbK6DGV

// Ophalen van het web
$json = file_get_contents ( 'https://www.ideal-status.nl/static/consumer_notification_advice.json' );
if ($json) {
	// Parse die json
	$data = json_decode ( $json, true );
	if ($data) {
		$status = 0;
		// Alle bankjes aflopen
		foreach ( $data as $issuerData ) {
			$issuerName = $issuerData ['issuer_name'];
			$issuerStatus = $issuerData ['status'];
			
			if ($issuerStatus == "NOK") {
				$status = 1;
				$bank .= '<span class="banknaam">' . $issuerName . '</span><br />';
			}
		}
		if ($status) {
			print ('<div id="idealstoring">') ;
			print ('<span class="idealerror">Let op: iDeal storing bij de volgende banken:<br />') ;
			print ($bank) ;
			print ('</div>') ;
		}
	}
}
?>