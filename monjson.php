<?php
include "functions.php";
include "config.php";

$tanggal = new DateTime(Date('Y-m-d H:i:sP'));
$tanggal->setTimezone(new DateTimeZone('Asia/Jakarta'));
$tanggal = $tanggal->format('Y-m-d H:i:sP');
$tanggal_sep = date('Y-m-d');

if (($pingporttimeout > 45) || empty($pingporttimeout)) {
	$pingporttimeout = 45;
}

$parseurl = parse_url($url_cari_peserta);

if ($parseurl === false) {
	$return = array("status" => false, "tanggal" => $tanggal);
	$return = json_encode($return);
	echo $return;
	return false;
}

$port = 80;
if (!empty($parseurl['port'])) {
	$port = $parseurl['port'];
}

$host = $parseurl['host'];

$stsping = phpping($host);

$stsport = phppingport($host, $port, $pingporttimeout);

$completeurl = "$url_cari_peserta/nokartu/$nopesertates/tglSEP/$tanggal_sep";

list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);

$data = json_decode($response, true);
	
$metadata_code = $data['metaData']['code'];
$metadata_message = $data['metaData']['message'];

$return = array("status" => true, "tanggal" => $tanggal, "host" => $host, "port" => $port, 
	"sts_ping" => $stsping, "sts_port" => $stsport, "sts_ws_code" => $metadata_code, 
	"sts_ws_message" => $metadata_message);

$return = json_encode($return);
echo $return;
?>