<?php
require_once('config.php');
	
function HashBPJS($ConsumerID, $ConsumerSecret){
	$cid = $ConsumerID;
	$dateserv = new DateTime(date('Y-m-d H:i:sP', time()));
	$gettz = $dateserv->getTimeZone();
	$settz = $dateserv->setTimezone(new DateTimeZone('Asia/Jakarta'));
	$timestmp = strtotime($dateserv->format('Y-m-d H:i:sP'));
	$str = $cid."&".$timestmp;
	$secret = ConsumerSecret;
	$user_key = UserKey;
	$hasher = base64_encode(hash_hmac('sha256', utf8_encode($str), utf8_encode($secret), TRUE)); //signature;
	return array($cid, $timestmp, $hasher, $user_key);
}

function xrequest($url, $hashsignature, $uid, $timestmp, $user_key){
	$session = curl_init($url);
	$arrheader =  array(
		'X-cons-id: '.$uid,
		'X-timestamp: '.$timestmp,
		'X-signature: '.$hashsignature,
		'user_key: '.$user_key,
		'Accept: application/json'
		);
	curl_setopt($session, CURLOPT_HTTPHEADER, $arrheader);
	curl_setopt($session, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($session, CURLOPT_SSL_VERIFYHOST, 0);
	// curl_setopt($session, CURLOPT_SSLVERSION, 3);
	$response = curl_exec($session);
	if ($response === false) {
		$resp_arr = array();
		$resp_arr['metaData']['message'] = curl_error($session);
		$resp_arr['metaData']['code'] = curl_errno($session);
		$response = json_encode($resp_arr);
	}
	curl_close($session);
	return $response;
}

function xrequestwithdata($url, $hashsignature, $uid, $timestmp, $data, $reqmethod, $content, $user_key){
	$arrheader =  array(
		'Content-type: '.$content,
		'X-cons-id: '.$uid,
		'X-timestamp: '.$timestmp,
		'X-signature: '.$hashsignature,
		'user_key: '.$user_key,
	);
	
	$custreq = strtoupper($reqmethod);
	
	// if ($reqmethod == 'put') {
		// $custreq = 'PUT';
	// } elseif ($reqmethod == 'delete') {
		// $custreq = 'DELETE';
	// } else {
		// $custreq = 'POST';
	// }
	
	$handle = curl_init();
	curl_setopt($handle, CURLOPT_URL, $url);
	curl_setopt($handle, CURLOPT_HTTPHEADER, $arrheader);
	curl_setopt($handle, CURLOPT_CUSTOMREQUEST, $custreq);
	curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);	
	curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 0);
	// curl_setopt($handle, CURLOPT_CERTINFO, false);
	// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__)."cacert-20180903.pem");
	//curl_setopt($session, CURLOPT_SSLVERSION, 3);
	
	$response = curl_exec($handle);
	
	if ($response === false) {
		$resp_arr = array();
		$resp_arr['metaData']['message'] = curl_error($handle);
		$resp_arr['metaData']['code'] = curl_errno($handle);
		$response = json_encode($resp_arr);
	}
	curl_close($handle);
	
	return $response;
}

// function decrypt
function stringDecrypt($key, $string){
	$encrypt_method = 'AES-256-CBC';

	// hash
	$key_hash = hex2bin(hash('sha256', $key));

	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

	$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

	return $output;
}

// function lzstring decompress 
function decompress($string){
	require_once('LZcompressor/LZString.php');
	
	$LZ = new LZString();
	
	return LZString::decompressFromEncodedURIComponent($string);
}

function phpping($host) {
	//Untuk ping, status 0 dianggap sukses dan 1 adalah tidak sukses
	$pingresult = exec("ping -n 1 $host", $outcome, $status);
	
	return $status;
}

function phppingport($host, $port, $timeout) {
	$connection = @fsockopen($host, $port, $errno, $errstr, $timeout);
	if (is_resource($connection)) {
		$status = 1;
		fclose($connection);
	} else {
		$status = 0;
	}
	
	return $status;
}

function brid_vclaim_log($nama_function,$no_kartu,$tgl_sep,$tgl_rujukan,$no_rujukan,$ppk_rujukan,$ppk_pelayanan,$jns_pelayanan,$catatan,$kd_icd,$poli_tujuan,$kls_rawat,$kd_user,$norm,$no_telp,$asal_rujukan,$poli_eksekutif,$cob,$laka_lantas,$penjamin,$katarak,$tgl_kejadian,$keterangan,$suplesi,$no_suplesi,$propinsi,$kabupaten,$kecamatan,$no_surat,$kode_dpjp,$no_sep,$metadata_code,$metadata_msg,$response) {
	

	$nama_function = ($nama_function != '' && $nama_function != '?') ? $nama_function : "-";
	$no_kartu= ($no_kartu != '' && $no_kartu != '?') ? $no_kartu : "-";
	$tgl_sep= ($tgl_sep != '' && $tgl_sep != '?') ? "'".$tgl_sep."'" : "NULL";
	$tgl_rujukan= ($tgl_rujukan != '' && $tgl_rujukan != '?') ? "'".$tgl_rujukan."'" : "NULL";
	$no_rujukan= ($no_rujukan !='' && $no_rujukan != '?') ? "'".$no_rujukan."'" : "NULL";
	$ppk_rujukan= ($ppk_rujukan != '' && $ppk_rujukan != '?') ? "'".$ppk_rujukan."'" : "NULL";
	$ppk_pelayanan= ($ppk_pelayanan != '' && $ppk_pelayanan != '?') ? "'".$ppk_pelayanan."'" : "NULL";
	$jns_pelayanan= ($jns_pelayanan != '' && $jns_pelayanan != '?') ? "'".$jns_pelayanan."'" : "NULL";
	$catatan= ($catatan != '' && $catatan != '?') ? "'".$catatan."'" : "NULL";
	$kd_icd= ($kd_icd != '' && $kd_icd != '?') ? "'".$kd_icd."'" : "NULL";
	$poli_tujuan= ($poli_tujuan != '' && $poli_tujuan != '?') ? "'".$poli_tujuan."'" : "NULL";
	$kls_rawat= ($kls_rawat != '' && $kls_rawat != '?') ? "'".$kls_rawat."'" : "NULL";
	$kd_user= ($kd_user != '' && $kd_user != '?') ? "'".$kd_user."'" : "NULL";
	$norm= ($norm != '' && $norm != '?') ? "'".$norm."'" : "NULL";
	$no_telp= ($no_telp != '' && $no_telp != '?' ) ? "'".$no_telp."'" : "NULL";
	$asal_rujukan= ($asal_rujukan != '' && $asal_rujukan != '?') ? "'".$asal_rujukan."'" : "NULL";
	$poli_eksekutif= ($poli_eksekutif != '' && $poli_eksekutif != '?') ? "'".$poli_eksekutif."'" : "NULL";
	$cob= ($cob != '' && $cob != '?') ? "'".$cob."'" : "NULL";
	$laka_lantas= ($laka_lantas != '' && $laka_lantas != '?') ? "'".$laka_lantas."'" : "NULL";
	$penjamin= ($penjamin != '' && $penjamin != '?') ? "'".$penjamin."'" : "NULL";
	$katarak= ($katarak != '' && $katarak != '?') ? "'".$katarak."'" : "NULL";
	$tgl_kejadian= ($tgl_kejadian != '' && $tgl_kejadian != '?') ? "'".$tgl_kejadian."'" : "NULL";
	$keterangan= ($keterangan != '' && $keterangan != '?') ? "'".$keterangan."'" : "NULL";
	$suplesi= ($suplesi != '' && $suplesi != '?' ) ? "'".$suplesi."'" : "NULL";
	$no_suplesi= ($no_suplesi != '' && $no_suplesi != '?') ? "'".$no_suplesi."'" : "NULL";
	$propinsi= ($propinsi != '' && $propinsi != '?') ? "'".$propinsi."'" : "NULL";
	$kabupaten= ($kabupaten != '' && $kabupaten != '?') ? "'".$kabupaten."'" : "NULL"; 
	$kecamatan= ($kecamatan != '' && $kecamatan != '?') ? "'".$kecamatan."'" : "NULL";
	$no_surat= ($no_surat != '' && $no_surat != '?') ? "'".$no_surat."'" : "NULL";
	$kode_dpjp= ($kode_dpjp != '' && $kode_dpjp != '?') ? "'".$kode_dpjp."'" : "NULL";
	$no_sep= ($no_sep != '' && $no_sep != '?') ? "'".$no_sep."'" : "NULL";
	$metadata_code= ($metadata_code != '' && $metadata_code != '?') ? "'".$metadata_code."'" : "NULL";
	$metadata_msg= ($metadata_msg != '' && $metadata_msg != '?') ? "'".$metadata_msg."'" : "NULL";
	$response = ($response != '' && $response != '?') ? "'".$response."'" : "NULL";

	
	if(LOG_SERVICE) {
		include 'koneksi.php';
		$sql = "INSERT INTO BRID_VCLAIM_LOG
						(
						TGL_INSERT,			NAMA_FUNCTION,			NO_KARTU,			TGL_SEP,
						TGL_RUJUKAN,		NO_RUJUKAN,				PPK_RUJUKAN,		PPK_PELAYANAN,
						JNS_PELAYANAN,		CATATAN,				KD_ICD,				POLI_TUJUAN,
						KLS_RAWAT,			KD_USER,				NORM,				NO_TELP,
						ASAL_RUJUKAN,		POLI_EKSEKUTIF,			COB,				LAKA_LANTAS,
						PENJAMIN,			KATARAK,				TGL_KEJADIAN,		KETERANGAN,
						SUPLESI,			NO_SUPLESI,				PROPINSI,			KABUPATEN,
						KECAMATAN,			NO_SURAT,				KODE_DPJP,			NO_SEP,
						METADATA_CODE,		METADATA_MSG,			RESPONSE
						)
					VALUES 
						(
						getdate(),			'$nama_function',		'$no_kartu',		$tgl_sep,
						$tgl_rujukan,		$no_rujukan,			$ppk_rujukan,		$ppk_pelayanan,
						$jns_pelayanan,		$catatan,				$kd_icd,			$poli_tujuan,
						$kls_rawat,			$kd_user,				$norm,				$no_telp,
						$asal_rujukan,		$poli_eksekutif,		$cob,				$laka_lantas,
						$penjamin,			$katarak,				$tgl_kejadian,		$keterangan,
						$suplesi,			$no_suplesi,			$propinsi,			$kabupaten,
						$kecamatan,			$no_surat,				$kode_dpjp,			$no_sep,	
						$metadata_code,		$metadata_msg,			$response
						)";
		
		sybase_query($sql);
		sybase_close();
	}

}



?>