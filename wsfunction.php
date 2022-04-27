<?php
	require_once('config.php');
	require_once('functions.php');
	
// if(isset($_POST['func'])) { $_POST['func'] = '' }
// if(isset($_POST)) {
	// $param = array();
	// if(function_exists($_POST['func'])) {
		// $param = explode(',', $_POST['param']);
		// call_user_func_array($_POST['func'], $param);
	// }
// }
	
function apiVClaimDiagnosa($keyword) {
	global $url_diagnosa;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'count'=>0,
			'list'=>''
		);
	}
	
	if(is_null($keyword) && $keyword == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'Keyword harus diisi',
			'count'=>0,
			'list'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_diagnosa.$keyword;
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['diagnosa']);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$datarray = array();
	if($count > 0) {
		for ($i = 0; $i < $count; $i++){
			$datarray[$i]['kodeDiagnosa'] = $data_decrypt['diagnosa'][$i]['kode'];
			$datarray[$i]['namaDiagnosa'] = $data_decrypt['diagnosa'][$i]['nama'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	log_data('apiVClaimDiagnosa', $completeurl, $keyword, $metadata_message);
	
	return $return_data;
}

function apiVClaimPoli($keyword) {
	global $url_poli;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'count'=>0,
			'list'=>''
		);
	}
	
	if(is_null($keyword) && $keyword == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'Keyword harus diisi',
			'count'=>0,
			'list'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_poli.$keyword;
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['poli']);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$datarray = array();
	if($count > 0) {
		for ($i = 0; $i < $count; $i++){
			$datarray[$i]['kode_poli'] = $data_decrypt['poli'][$i]['kode'];
			$datarray[$i]['nama_poli'] = $data_decrypt['poli'][$i]['nama'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	log_data('apiVClaimPoli', $completeurl, $keyword, $metadata_message);
	
	return $return_data;
}

function apiVClaimFaskes($keyword, $jenis_faskes) {
	global $url_faskes;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'count'=>0,
			'list'=>''
		);
	}
	
	if(is_null($keyword) && $keyword == '' && is_null($jenis_faskes) && $jenis_faskes == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'Keyword dan Jenis Fasilitas Kesehatan harus diisi',
			'count'=>0,
			'list'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_faskes.$keyword.'/'.$jenis_faskes;
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['faskes']);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$i = 0;
	$datarray = array();
	if($count > 0) {
		for ($i = 0; $i < $count; $i++){
			$datarray[$i]['kode_faskes'] = $data_decrypt['faskes'][$i]['kode'];
			$datarray[$i]['nama_faskes'] = $data_decrypt['faskes'][$i]['nama'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	$data_req = json_encode(
		array(
			"keyword" => $keyword,
			"jenis_faskes" => $jenis_faskes
		)
	);

	log_data('apiVClaimFaskes', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVClaimDPJP($jenis_pelayanan, $tgl_pelayanan, $kode_spesialis) {
	global $url_dpjp;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'count'=>0,
			'list'=>''
		);
	}
	
	if(is_null($jenis_pelayanan) && $jenis_pelayanan == '' && is_null($tgl_pelayanan) && $tgl_pelayanan == '' && is_null($kode_spesialis) && $kode_spesialis == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'Jenis Pelayanan, Tanggal Pelayanan dan Kode Spesialis harus diisi',
			'count'=>0,
			'list'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_dpjp.$jenis_pelayanan.'/tglPelayanan/'.$tgl_pelayanan.'/Spesialis/'.$kode_spesialis;
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['list']);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$i = 0;
	$datarray = array();
	if($count > 0) {
		for ($i = 0; $i < $count; $i++){
			$datarray[$i]['kode_dpjp'] = $data_decrypt['list'][$i]['kode'];
			$datarray[$i]['nama_dpjp'] = $data_decrypt['list'][$i]['nama'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	$data_req = json_encode(
		array(
			"jenis_pelayanan" => $jenis_pelayanan,
			"tgl_pelayanan" => $tgl_pelayanan,
			"kode_spesialis" => $kode_spesialis
		)
	);

	log_data('apiVClaimDPJP', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVClaimPropinsi() {
	global $url_propinsi;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'count'=>0,
			'list'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_propinsi;
	
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);

	$count = count($data_decrypt['list']);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$i = 0;
	$datarray = array();
	if($count > 0) {
		for ($i = 0; $i < $count; $i++){
			$datarray[$i]['kode_propinsi'] = $data_decrypt['list'][$i]['kode'];
			$datarray[$i]['nama_propinsi'] = $data_decrypt['list'][$i]['nama'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	log_data('apiVClaimPropinsi', $completeurl, '', $metadata_message);
	
	return $return_data;
}

function apiVClaimKabupaten($kode_propinsi) {
	global $url_kabupaten;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'count'=>0,
			'list'=>''
		);
	}
	
	if(is_null($kode_propinsi) && $kode_propinsi == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'Kode Propinsi harus diisi',
			'count'=>0,
			'list'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_kabupaten.$kode_propinsi;
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['list']);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$i = 0;
	$datarray = array();
	if($count > 0) {
		for ($i = 0; $i < $count; $i++){
			$datarray[$i]['kode_kabupaten'] = $data_decrypt['list'][$i]['kode'];
			$datarray[$i]['nama_kabupaten'] = $data_decrypt['list'][$i]['nama'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	$data_req = json_encode(
		array(
			"kode_propinsi" => $kode_propinsi
		)
	);

	log_data('apiVClaimKabupaten', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVClaimKecamatan($kode_kabupaten) {
	global $url_kecamatan;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'count'=>0,
			'list'=>''
		);
	}
	
	if(is_null($kode_kabupaten) && $kode_kabupaten == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'Kode Kabupaten harus diisi',
			'count'=>0,
			'list'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_kecamatan.$kode_kabupaten;
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
		
	$count = count($data_decrypt['list']);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$i = 0;
	$datarray = array();
	if($count > 0) {
		for ($i = 0; $i < $count; $i++){
			$datarray[$i]['kode_kecamatan'] = $data_decrypt['list'][$i]['kode'];
			$datarray[$i]['nama_kecamatan'] = $data_decrypt['list'][$i]['nama'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	$data_req = json_encode(
		array(
			"kode_kabupaten" => $kode_kabupaten
		)
	);

	log_data('apiVClaimKecamatan', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVClaimDiagnosaPRB() {
	global $url_diagnosaprb;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'count'=>0,
			'list'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_diagnosaprb;
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
		
	$count = count($data_decrypt['list']);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$i = 0;
	$datarray = array();
	if($count > 0) {
		for ($i = 0; $i < $count; $i++){
			$datarray[$i]['kode_diagnosaprb'] = $data_decrypt['list'][$i]['kode'];
			$datarray[$i]['nama_diagnosaprb'] = $data_decrypt['list'][$i]['nama'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	log_data('apiVClaimDiagnosaPRB', $completeurl, '', $metadata_message);
	
	return $return_data;
}

function apiVClaimObatGenerikPRB($keyword) {
	global $url_obatprb;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'count'=>0,
			'list'=>''
		);
	}
	
	if(is_null($keyword) && $keyword == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'Keyword harus diisi',
			'count'=>0,
			'list'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_obatprb.$keyword;
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['list']);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$i = 0;
	$datarray = array();
	if($count > 0) {
		for ($i = 0; $i < $count; $i++){
			$datarray[$i]['kode_obatprb'] = $data_decrypt['list'][$i]['kode'];
			$datarray[$i]['nama_obatprb'] = $data_decrypt['list'][$i]['nama'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	$data_req = json_encode(
		array(
			"keyword" => $keyword
		)
	);

	log_data('apiVClaimObatGenerikPRB', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVClaimProsedur($keyword) {
	global $url_prosedur;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'count'=>0,
			'list'=>''
		);
	}
	
	if(is_null($keyword) && $keyword == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'Keyword harus diisi',
			'count'=>0,
			'list'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_prosedur.$keyword;
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['procedure']);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
		
	$i = 0;
	$datarray = array();
	for ($i = 0; $i < $count; $i++){
		$datarray[$i]['kodeProsedur'] = $data_decrypt['procedure'][$i]['kode'];
		$datarray[$i]['namaProsedur'] = $data_decrypt['procedure'][$i]['nama'];
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	$data_req = json_encode(
		array(
			"keyword" => $keyword
		)
	);

	log_data('apiVClaimProsedur', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVClaimKelasRawat() {
	global $url_kelasrawat;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'count'=>0,
			'list'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_kelasrawat;
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['list']);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
		
	$i = 0;
	$datarray = array();
	if($count > 0) {
		for ($i = 0; $i < $count; $i++){
			$datarray[$i]['kode_kelasrawat'] = $data_decrypt['list'][$i]['kode'];
			$datarray[$i]['nama_kelasrawat'] = $data_decrypt['list'][$i]['nama'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	log_data('apiVClaimKelasRawat', $completeurl, '', $metadata_message);
	
	return $return_data;
}

function apiVClaimDokter($keyword) {
	global $url_dokter;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'count'=>0,
			'list'=>''
		);
	}
	
	if(is_null($keyword) && $keyword == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'Keyword harus diisi',
			'count'=>0,
			'list'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_dokter.$keyword;
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['list']);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
		
	$i = 0;
	$datarray = array();
	if($count > 0) {
		for ($i = 0; $i < $count; $i++){
			$datarray[$i]['kode_dokter'] = $data_decrypt['list'][$i]['kode'];
			$datarray[$i]['nama_dokter'] = $data_decrypt['list'][$i]['nama'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	$data_req = json_encode(
		array(
			"keyword" => $keyword
		)
	);

	log_data('apiVClaimDokter', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVClaimSpesialistik() {
	global $url_spesialistik;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'count'=>0,
			'list'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_spesialistik;
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['list']);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
		
	$i = 0;
	$datarray = array();
	if($count > 0) {
		for ($i = 0; $i < $count; $i++){
			$datarray[$i]['kode_spesialistik'] = $data_decrypt['list'][$i]['kode'];
			$datarray[$i]['nama_spesialistik'] = $data_decrypt['list'][$i]['nama'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	log_data('apiVClaimSpesialistik', $completeurl, '', $metadata_message);
	
	return $return_data;
}

function apiVClaimRuangRawat() {
	global $url_ruangrawat;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'count'=>0,
			'list'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_ruangrawat;
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['list']);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
		
	$i = 0;
	$datarray = array();
	if($count > 0) {
		for ($i = 0; $i < $count; $i++){
			$datarray[$i]['kode_ruangrawat'] = $data_decrypt['list'][$i]['kode'];
			$datarray[$i]['nama_ruangrawat'] = $data_decrypt['list'][$i]['nama'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	log_data('apiVClaimRuangRawat', $completeurl, '', $metadata_message);
	
	return $return_data;
}

function apiVClaimCaraKeluar() {
	global $url_carakeluar;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'count'=>0,
			'list'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_carakeluar;
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['list']);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
		
	$i = 0;
	$datarray = array();
	if($count > 0) {
		for ($i = 0; $i < $count; $i++){
			$datarray[$i]['kode_carakeluar'] = $data_decrypt['list'][$i]['kode'];
			$datarray[$i]['nama_carakeluar'] = $data_decrypt['list'][$i]['nama'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	log_data('apiVClaimCaraKeluar', $completeurl, '', $metadata_message);
	
	return $return_data;
}

function apiVClaimPascaPulang() {
	global $url_pascapulang;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'count'=>0,
			'list'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_pascapulang;
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['list']);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
		
	$i = 0;
	$datarray = array();
	if($count > 0) {
		for ($i = 0; $i < $count; $i++){
			$datarray[$i]['kode_pascapulang'] = $data_decrypt['list'][$i]['kode'];
			$datarray[$i]['nama_pascapulang'] = $data_decrypt['list'][$i]['nama'];
		}
	}
	
	$return_data = array
	(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	log_data('apiVClaimPascaPulang', $completeurl, '', $metadata_message);
	
	return $return_data;
}

function apiVClaimPeserta($varrequest, $tgl_sep, $tiperequest) {
	global $url_cari_peserta;
	
	if (empty($varrequest)) {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'Variabel request tidak ada',
			'cob_nama_asuransi'=>'',
			'cob_nomor_asuransi'=>'',
			'cob_tgltat'=>'',
			'cob_tgltmt'=>'',
			'hak_kelas_ket'=>'',
			'hak_kelas_kode'=>'',
			'info_dinsos'=>'',
			'info_nosktm'=>'',
			'info_prolanisprb'=>'',
			'jenis_peserta_ket'=>'',
			'jenis_peserta_kode'=>'',
			'no_rm'=>'',
			'no_telp'=>'',
			'nama'=>'',
			'nik'=>'',
			'noKartu'=>'',
			'pisa'=>'',
			'prov_umum_kode_provider'=>'',
			'prov_umum_nama_provider'=>'',
			'sex'=>'',
			'status_peserta_ket'=>'',
			'status_peserta_kode'=>'',
			'tgl_cetak_kartu'=>'',
			'tgl_lahir'=>'',
			'tgl_tat'=>'',
			'tgl_tmt'=>'',
			'umur_pelayanan'=>'',
			'umurSekarang'=>''
		);
	}
	
	if (empty($tgl_sep)) {
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Tanggal SEP tidak ada',
			'cob_nama_asuransi'=>'',
			'cob_nomor_asuransi'=>'',
			'cob_tgltat'=>'',
			'cob_tgltmt'=>'',
			'hak_kelas_ket'=>'',
			'hak_kelas_kode'=>'',
			'info_dinsos'=>'',
			'info_nosktm'=>'',
			'info_prolanisprb'=>'',
			'jenis_peserta_ket'=>'',
			'jenis_peserta_kode'=>'',
			'no_rm'=>'',
			'no_telp'=>'',
			'nama'=>'',
			'nik'=>'',
			'noKartu'=>'',
			'pisa'=>'',
			'prov_umum_kode_provider'=>'',
			'prov_umum_nama_provider'=>'',
			'sex'=>'',
			'status_peserta_ket'=>'',
			'status_peserta_kode'=>'',
			'tgl_cetak_kartu'=>'',
			'tgl_lahir'=>'',
			'tgl_tat'=>'',
			'tgl_tmt'=>'',
			'umur_pelayanan'=>'',
			'umurSekarang'=>''
		);
	}
	
	if (empty($tiperequest)) {
		return array(
			'metadata_code'=>'91',
			'metadata_message'=>'Tipe request tidak ada',
			'cob_nama_asuransi'=>'',
			'cob_nomor_asuransi'=>'',
			'cob_tgltat'=>'',
			'cob_tgltmt'=>'',
			'hak_kelas_ket'=>'',
			'hak_kelas_kode'=>'',
			'info_dinsos'=>'',
			'info_nosktm'=>'',
			'info_prolanisprb'=>'',
			'jenis_peserta_ket'=>'',
			'jenis_peserta_kode'=>'',
			'no_rm'=>'',
			'no_telp'=>'',
			'nama'=>'',
			'nik'=>'',
			'noKartu'=>'',
			'pisa'=>'',
			'prov_umum_kode_provider'=>'',
			'prov_umum_nama_provider'=>'',
			'sex'=>'',
			'status_peserta_ket'=>'',
			'status_peserta_kode'=>'',
			'tgl_cetak_kartu'=>'',
			'tgl_lahir'=>'',
			'tgl_tat'=>'',
			'tgl_tmt'=>'',
			'umur_pelayanan'=>'',
			'umurSekarang'=>''
		);
	}

	if (!(defined('ConsumerID') && defined('ConsumerSecret'))) {
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'cob_nama_asuransi'=>'',
			'cob_nomor_asuransi'=>'',
			'cob_tgltat'=>'',
			'cob_tgltmt'=>'',
			'hak_kelas_ket'=>'',
			'hak_kelas_kode'=>'',
			'info_dinsos'=>'',
			'info_nosktm'=>'',
			'info_prolanisprb'=>'',
			'jenis_peserta_ket'=>'',
			'jenis_peserta_kode'=>'',
			'no_rm'=>'',
			'no_telp'=>'',
			'nama'=>'',
			'nik'=>'',
			'noKartu'=>'',
			'pisa'=>'',
			'prov_umum_kode_provider'=>'',
			'prov_umum_nama_provider'=>'',
			'sex'=>'',
			'status_peserta_ket'=>'',
			'status_peserta_kode'=>'',
			'tgl_cetak_kartu'=>'',
			'tgl_lahir'=>'',
			'tgl_tat'=>'',
			'tgl_tmt'=>'',
			'umur_pelayanan'=>'',
			'umurSekarang'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$extend_url = ($tiperequest == "nik") ? "/nik/" : "/nokartu/";
	$completeurl = "$url_cari_peserta$extend_url$varrequest/tglSEP/$tgl_sep";
	
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
		
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$cob_nama_asuransi = '';
	$cob_nomor_asuransi = '';
	$cob_tgltat = '';
	$cob_tgltmt = '';
	$hak_kelas_ket = '';
	$hak_kelas_kode = '';
	$info_dinsos = '';
	$info_nosktm = '';
	$info_prolanisprb = '';
	$jenis_peserta_ket = '';
	$jenis_peserta_kode = '';
	$no_rm = '';
	$no_telp = '';
	$nama = '';
	$nik = '';
	$no_kartu = '';
	$pisa = '';
	$prov_umum_kode_provider = '';
	$prov_umum_nama_provider = '';
	$sex = '';
	$status_peserta_ket = '';
	$status_peserta_kode = '';
	$tgl_cetak_kartu = '';
	$tgl_lahir = '';
	$tgl_tat = '';
	$tgl_tmt = '';
	$umur_pelayanan = '';
	$umur_sekarang = '';
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	if ($metadata_code == 200) {
		$cob_nama_asuransi = $data_decrypt['peserta']['cob']['nmAsuransi'];
		$cob_nomor_asuransi = $data_decrypt['peserta']['cob']['noAsuransi'];
		$cob_tgltat = $data_decrypt['peserta']['cob']['tglTAT'];
		$cob_tgltmt = $data_decrypt['peserta']['cob']['tglTMT'];
		$hak_kelas_ket = $data_decrypt['peserta']['hakKelas']['keterangan'];
		$hak_kelas_kode = $data_decrypt['peserta']['hakKelas']['kode'];
		$info_dinsos = $data_decrypt['peserta']['informasi']['dinsos'];
		$info_nosktm = $data_decrypt['peserta']['informasi']['noSKTM'];
		$info_prolanisprb = $data_decrypt['peserta']['informasi']['prolanisPRB'];
		$jenis_peserta_ket = $data_decrypt['peserta']['jenisPeserta']['keterangan'];
		$jenis_peserta_kode = $data_decrypt['peserta']['jenisPeserta']['kode'];
		$no_rm = $data_decrypt['peserta']['mr']['noMR'];
		$no_telp = $data_decrypt['peserta']['mr']['noTelepon'];
		$nama = $data_decrypt['peserta']['nama'];
		$nik = $data_decrypt['peserta']['nik'];
		$no_kartu = $data_decrypt['peserta']['noKartu'];
		$pisa = $data_decrypt['peserta']['pisa'];
		$prov_umum_kode_provider = $data_decrypt['peserta']['provUmum']['kdProvider'];
		$prov_umum_nama_provider = $data_decrypt['peserta']['provUmum']['nmProvider'];
		$sex = $data_decrypt['peserta']['sex'];
		$status_peserta_ket = $data_decrypt['peserta']['statusPeserta']['keterangan'];
		$status_peserta_kode = $data_decrypt['peserta']['statusPeserta']['kode'];
		$tgl_cetak_kartu = $data_decrypt['peserta']['tglCetakKartu'];
		$tgl_lahir = $data_decrypt['peserta']['tglLahir'];
		$tgl_tat = $data_decrypt['peserta']['tglTAT'];
		$tgl_tmt = $data_decrypt['peserta']['tglTMT'];
		$umur_pelayanan = $data_decrypt['peserta']['umur']['umurSaatPelayanan'];
		$umur_sekarang = $data_decrypt['peserta']['umur']['umurSekarang'];
	}
	
	$return_data = array(
		'metadata_code' => $metadata_code,
		'metadata_message' => $metadata_message,
		'cob_nama_asuransi' => $cob_nama_asuransi,
		'cob_nomor_asuransi' => $cob_nomor_asuransi,
		'cob_tgltat' => $cob_tgltat,
		'cob_tgltmt' => $cob_tgltmt,
		'hak_kelas_ket' => $hak_kelas_ket,
		'hak_kelas_kode' => $hak_kelas_kode,
		'info_dinsos' => $info_dinsos,
		'info_nosktm' => $info_nosktm,
		'info_prolanisprb' => $info_prolanisprb,
		'jenis_peserta_ket' => $jenis_peserta_ket,
		'jenis_peserta_kode' => $jenis_peserta_kode,
		'no_rm' => $no_rm,
		'no_telp' => $no_telp,
		'nama' => $nama,
		'nik' => $nik,
		'no_kartu' => $no_kartu,
		'pisa' => $pisa,
		'prov_umum_kode_provider' => $prov_umum_kode_provider,
		'prov_umum_nama_provider' => $prov_umum_nama_provider,
		'sex' => $sex,
		'status_peserta_ket' => $status_peserta_ket,
		'status_peserta_kode' => $status_peserta_kode,
		'tgl_cetak_kartu' => $tgl_cetak_kartu,
		'tgl_lahir' => $tgl_lahir,
		'tgl_tat' => $tgl_tat,
		'tgl_tmt' => $tgl_tmt,
		'umur_pelayanan' => $umur_pelayanan,
		'umur_sekarang' => $umur_sekarang
	);

	$data_req = json_encode(
		array(
			"varrequest" => $varrequest,
			"tgl_sep" => $tgl_sep,
			"tiperequest" => $tiperequest
		)
	);

	log_data('apiVClaimPeserta', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVClaimGenSEP($nokartu, $tglsep, $tglrujukan, $norujukan, $ppkrujukan, $ppkpelayanan, $jnspelayanan, $catatan, $diagawal, $politujuan, $klsrawat, $user, $nomr, $notelp, $asalrujukan, $polieksekutif, $cob, $lakalantas, $penjamin, $lokasilaka) {
	global $url_insert_sep;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);

	$urlrequest = $url_insert_sep;
	
	if($jnspelayanan == '2') {
		$klsrawat = '3';
	} else {
		//$data_peserta = apiBPJSPeserta($nokartu, '');
		$data_peserta = apiVClaimPeserta($nokartu, $tglsep, '');
		
		if(!is_null($data_peserta['hak_kelas_kode']) && $data_peserta['hak_kelas_kode'] != '') {
			$klsrawat = $data_peserta['hak_kelas_kode'];
		}
		
		if(is_null($politujuan) && $politujuan == '') {
			$politujuan = ' ';
		}
	}
	
	$request = array('request'=>
					array('t_sep'=>
						array('noKartu'=>$nokartu,
							  'tglSep'=>$tglsep,
							  'ppkPelayanan'=>$ppkpelayanan,
							  'jnsPelayanan'=>$jnspelayanan,
							  'noMR'=>$nomr,
							  'klsRawat'=>$klsrawat,
							  'rujukan' => array('asalRujukan' => $asalrujukan,
												 'tglRujukan' => $tglrujukan,
												 'noRujukan' => $norujukan,
												 'ppkRujukan' => $ppkrujukan),
							  'catatan'=>$catatan,
							  'diagAwal'=>$diagawal,
							  'poli' => array('tujuan' => $politujuan,
											  'eksekutif' => $polieksekutif),
							  'cob' => array('cob' => $cob),
							  'jaminan' => array('lakaLantas' => $lakalantas,
												 'penjamin' => $penjamin,
												 'lokasiLaka' => $lokasilaka),
							  'noTelp' => $notelp,
							  'user'=>$user
						)
					)
				);
	
	$jsonrequest = json_encode($request);
	
	$reqmethod = 'post';
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	$data = json_decode($response, true);
	
	$metadata_code = '';
	$metadata_message = '';
	$response = '';
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	if($metadata_code == 200) {
		$key = $cid . ConsumerSecret . $timestmp;
		$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);	
		$response = $data_decrypt['sep']['noSep'];
	}
	
	if(is_null($response) && $response == '') {
		$response = ' ';
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'response'=>$response
	);
	$hasil = json_encode($return_data);

	log_data('apiVClaimGenSEP', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimUpdateSEP($no_sep, $kelas_rawat, $norm, $asal_rujukan, $tgl_rujukan, $no_rujukan, $ppk_rujukan, $catatan, $diagnosa_awal, $poli_eksekutif, $cob, $laka_lantas, $penjamin, $lokasi_laka, $no_telp, $user	) {
	global $url_update_sep;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
		
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$urlrequest = $url_update_sep;
	
	$request = array('request'=>
					array('t_sep'=>
						array('noSep'=>$no_sep,
							  'klsRawat'=>$kelas_rawat,
							  'noMR'=>$norm,
							  'rujukan' => array('asalRujukan' => $asal_rujukan,
												 'tglRujukan' => $tgl_rujukan,
												 'noRujukan' => $no_rujukan,
												 'ppkRujukan' => $ppk_rujukan),
							  'catatan'=>$catatan,
							  'diagAwal'=>$diagnosa_awal,
							  'poli' => array('eksekutif' => $poli_eksekutif),
							  'cob' => array('cob' => $cob),
							  'jaminan' => array('lakaLantas' => $laka_lantas,
												 'penjamin' => $penjamin,
												 'lokasiLaka' => $lokasi_laka),
							  'noTelp' => $no_telp,
							  'user'=>$user
						)
					)
				);
	
	$jsonrequest = json_encode($request);

	$reqmethod = 'put';
	
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
		
	$response = null;
	$metadata_code = null;
	$metadata_message = null;
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	if($metadata_code == 200) {
		$key = $cid . ConsumerSecret . $timestmp;
		$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
		$response = $data_decrypt;
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'response'=>$response
	);

	log_data('apiVClaimUpdateSEP', $urlrequest, $jsonrequest, $metadata_message);
	
	return $return_data;
}

function apiVClaimGenSEP11($nokartu, $tglsep, $tglrujukan, $norujukan, $ppkrujukan, $ppkpelayanan, $jnspelayanan, $catatan, $diagawal, $politujuan, $klsrawat, $user, $nomr, $notelp, $asalrujukan, $polieksekutif, $cob, $lakalantas, $penjamin, $katarak, $tgl_kejadian, $keterangan, $suplesi, $nosepsuplesi, $kode_propinsi, $kode_kabupaten, $kode_kecamatan, $no_surat, $kode_dpjp) {
	global $url_insert_sep11;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	$katarak = ($katarak == '' || $katarak == '?') ? '0' : $katarak;
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);

	$urlrequest = $url_insert_sep11;
	
	if($jnspelayanan == '2') {
		$klsrawat = '3';
	} else {
		//$data_peserta = apiBPJSPeserta($nokartu, '');
		$data_peserta = apiVClaimPeserta($nokartu, $tglsep, '');
		
		if(!is_null($data_peserta['hak_kelas_kode']) && $data_peserta['hak_kelas_kode'] != '') {
			$klsrawat = $data_peserta['hak_kelas_kode'];
		}
		
		if(is_null($politujuan) && $politujuan == '') {
			$politujuan = ' ';
		}
	}
	
	$request = array('request'=>
					array('t_sep'=>
						array('noKartu'=>$nokartu,
							  'tglSep'=>$tglsep,
							  'ppkPelayanan'=>$ppkpelayanan,
							  'jnsPelayanan'=>$jnspelayanan,
							  'noMR'=>$nomr,
							  'klsRawat'=>$klsrawat,
							  'rujukan' => array('asalRujukan' => $asalrujukan,
												 'tglRujukan' => $tglrujukan,
												 'noRujukan' => $norujukan,
												 'ppkRujukan' => $ppkrujukan),
							  'catatan'=>$catatan,
							  'diagAwal'=>$diagawal,
							  'poli' => array('tujuan' => $politujuan,
											  'eksekutif' => $polieksekutif),
							  'cob' => array('cob' => $cob),
							  'katarak' => array('katarak' => $katarak),
							  'jaminan' => array('lakaLantas' => $lakalantas,
												 'penjamin' => array('penjamin' => $penjamin,
																	 'tglKejadian' => $tgl_kejadian,
																	 'keterangan' => $keterangan,
																	 'suplesi' => array('suplesi' => $suplesi,
																						'noSepSuplesi' => $nosepsuplesi,
																						'lokasiLaka' => array('kdPropinsi' => $kode_propinsi,
																											  'kdKabupaten' => $kode_kabupaten,
																											  'kdKecamatan' => $kode_kecamatan)
																				   )
																	)
												),
							  'skdp' => array('noSurat' => $no_surat,
										   'kodeDPJP' => $kode_dpjp),
							  'noTelp' => $notelp,
							  'user'=>$user
						)
					)
				);
	
	$jsonrequest = json_encode($request);
	
	$reqmethod = 'post';
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	
	$metadata_code = '';
	$metadata_message = '';
	$response = '';
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	if($metadata_code == 200) {
		$key = $cid . ConsumerSecret . $timestmp;
		$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
		$response = $data_decrypt['sep']['noSep'];
	}
	
	// if($metadata_code == 200) {
		// $response = $data['response']['sep']['noSep'];
		// // $catatan = $data['response']['sep']['catatan'];
		// // $diagnosa = $data['response']['sep']['diagnosa'];
		// // $jns_pelayanan = $data['response']['sep']['jnsPelayanan'];
		// // $kelas_rawat = $data['response']['sep']['kelasRawat'];
		// // $no_sep = $data['response']['sep']['noSep'];
		// // $penjamin = $data['response']['sep']['penjamin'];
		// // $asuransi = $data['response']['sep']['peserta']['asuransi'];
		// // $hak_kelas = $data['response']['sep']['peserta']['hakKelas'];
		// // $jns_peserta = $data['response']['sep']['peserta']['jnsPeserta'];
		// // $kelamin = $data['response']['sep']['peserta']['kelamin'];
		// // $nama = $data['response']['sep']['peserta']['nama'];
		// // $no_kartu = $data['response']['sep']['peserta']['noKartu'];
		// // $norm = $data['response']['sep']['peserta']['noMr'];
		// // $tgl_lahir = $data['response']['sep']['peserta']['tglLahir'];
		// // $poli = $data['response']['sep']['poli'];
		// // $poli_eksekutif = $data['response']['sep']['poliEksekutif'];
		// // $tgl_sep = $data['response']['sep']['tglSep'];
	// } else {
	
		// if(is_null($response) && $response == '') {
			// $response = ' ';
		// }
		
	// if(strpos(strtoupper($metadata_message), 'TELAH MENDAPAT PELAYANAN R.INAP') > 0) {
		// global $url_cari_sep;
		
		// list($cid, $timestmp, $hashsignature) = HashBPJS(ConsumerID, ConsumerSecret);
		
		// $no_sep = substr($metadata_message, -19);
		
		// $completeurl = $url_cari_sep.$no_sep;
		// $response_cari_sep = xrequest($completeurl, $hashsignature, $cid, $timestmp);
	
		// $metadata_code = '';
		// $metadata_message = '';
		
		// $data_cari_sep = json_decode($response_cari_sep, true);
	
		// $metadata_code = $data_cari_sep['metaData']['code'];
		// $metadata_message = $data_cari_sep['metaData']['message'];
		
		// if($metadata_code == 200) {
			
			// $waktu = new DateTime();
			// $waktu->setTimezone(new DateTimeZone('Asia/Jakarta'));
			// $waktu->modify('-1 day');
			// $tglPlg = $waktu->format("Y-m-d");
			
			// $data_update_tglpulang = apiVClaimUpdatePulang($no_sep, $tglPlg, $user);

			// $metadata_code = '';
			// $metadata_message = '';
			// $response = '';
			
			// $response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content);
			// $data = json_decode($response, true);
			
			
			// $metadata_code = $data['metaData']['code'];
			// $metadata_message = $data['metaData']['message'];
			// $response = $data['response']['sep']['noSep'];
			
		// }
	// }
	// }
	
	if(is_null($response) && $response == '') {
		$response = ' ';
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'response'=>$response
	);
	
	$no_kartu 			= $nokartu;
	$tgl_sep 			= $tglsep;
	$tgl_rujukan 		= $tglrujukan;
	$no_rujukan			= $norujukan;
	$ppk_rujukan		= $ppkrujukan;
	$ppk_pelayanan		= $ppkpelayanan;
	$jns_pelayanan		= $jnspelayanan;
	$catatan			= $catatan;
	$kd_icd				= $diagawal;
	$poli_tujuan		= $politujuan;
	$kls_rawat			= $klsrawat;
	$kd_user			= $user;
	$norm				= $nomr;
	$no_telp			= $notelp;
	$asal_rujukan		= $asalrujukan;
	$poli_eksekutif		= $polieksekutif;
	$cob				= $cob;
	$laka_lantas		= $lakalantas;
	$penjamin			= $penjamin;
	$katarak			= $katarak;
	$tgl_kejadian		= $tgl_kejadian;
	$keterangan			= $keterangan;
	$suplesi			= $suplesi;
	$no_suplesi			= $nosepsuplesi;
	$propinsi			= $kode_propinsi;
	$kabupaten			= $kode_kabupaten;
	$kecamatan			= $kode_kecamatan;
	$no_surat			= $no_surat;
	$kode_dpjp			= $kode_dpjp;
	$no_sep				= $response;	
	$metadata_code		= $metadata_code;
	$metadata_msg		= $metadata_message;
	$response			= $response;

	brid_vclaim_log('apiVClaimGenSEP11',$no_kartu,$tgl_sep,$tgl_rujukan,$no_rujukan,$ppk_rujukan,$ppk_pelayanan,$jns_pelayanan,$catatan,$kd_icd,$poli_tujuan,$kls_rawat,$kd_user,$norm,$no_telp,$asal_rujukan,$poli_eksekutif,$cob,$laka_lantas,$penjamin,$katarak,$tgl_kejadian,$keterangan,$suplesi,$no_suplesi,$propinsi,$kabupaten,$kecamatan,$no_surat,$kode_dpjp,$no_sep,$metadata_code,$metadata_msg,$response);
	$hasil = json_encode($return_data);
	log_data('apiVClaimGenSEP11', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimUpdateSEP11($no_sep, $kelas_rawat, $norm, $asal_rujukan, $tgl_rujukan, $no_rujukan, $ppk_rujukan, $catatan, $diagnosa_awal, $poli_eksekutif, $cob, $laka_lantas, $penjamin, $no_telp, $user, $katarak, $tgl_kejadian, $keterangan, $suplesi, $nosepsuplesi, $kode_propinsi, $kode_kabupaten, $kode_kecamatan, $no_surat, $kode_dpjp) {
	global $url_update_sep11;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	$katarak = ($katarak == '' || $katarak == '?') ? '0' : $katarak;
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$urlrequest = $url_update_sep11;
	
	$request = array('request'=>
					array('t_sep'=>
						array('noSep'=>$no_sep,
							  'klsRawat'=>$kelas_rawat,
							  'noMR'=>$norm,
							  'rujukan' => array('asalRujukan' => $asal_rujukan,
												 'tglRujukan' => $tgl_rujukan,
												 'noRujukan' => $no_rujukan,
												 'ppkRujukan' => $ppk_rujukan),
							  'catatan'=>$catatan,
							  'diagAwal'=>$diagnosa_awal,
							  'poli' => array('eksekutif' => $poli_eksekutif),
							  'cob' => array('cob' => $cob),
							  'katarak' => array('katarak' => $katarak),
							  'skdp' => array('noSurat' => $no_surat,
										   'kodeDPJP' => $kode_dpjp),
							  'jaminan' => array('lakaLantas' => $laka_lantas,
												 'penjamin' => array('penjamin' => $penjamin,
																	 'tglKejadian' => $tgl_kejadian,
																	 'keterangan' => $keterangan,
																	 'suplesi' => array('suplesi' => $suplesi,
																						'noSepSuplesi' => $nosepsuplesi,
																						'lokasiLaka' => array('kdPropinsi' => $kode_propinsi,
																											  'kdKabupaten' => $kode_kabupaten,
																											  'kdKecamatan' => $kode_kecamatan)
																				   )
																	)
												),
							  'noTelp' => $no_telp,
							  'user'=>$user
						)
					)
				);
	
	$jsonrequest = json_encode($request);

	$reqmethod = 'put';
	
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
		
	$response = null;
	$metadata_code = null;
	$metadata_message = null;
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	if($metadata_code == 200) {
		$key = $cid . ConsumerSecret . $timestmp;
		$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
		$response = $data_decrypt;
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'response'=>$response
	);
	$hasil = json_encode($return_data);
	log_data('apiVClaimUpdateSEP11', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimGenSEP2($nokartu, $tglsep, $tglrujukan, $norujukan, $ppkrujukan, $ppkpelayanan, $jnspelayanan, $catatan, $diagawal, $politujuan, $user, $nomr, $notelp, $asalrujukan, $polieksekutif, $cob, $lakalantas, $penjamin, $katarak, $tgl_kejadian, $keterangan, $suplesi, $nosepsuplesi, $kode_propinsi, $kode_kabupaten, $kode_kecamatan, $no_surat, $kode_dpjp, $klsrawathak, $klsrawatnaik, $pembiayaan, $penanggungjawab, $tujuankunj, $flagprocedure, $kdpenunjang, $assesmentpel, $dpjplayan) {
	global $url_insert_sep2;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	$katarak = ($katarak == '' || $katarak == '?') ? '0' : $katarak;
	$tujuankunj = ($tujuankunj == '' || $tujuankunj == '?') ? '0' : $tujuankunj;
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);

	$urlrequest = $url_insert_sep2;
	
	if($jnspelayanan == '2') {
		$klsrawathak = '3';
	} else {
		//$data_peserta = apiBPJSPeserta($nokartu, '');
		$data_peserta = apiVClaimPeserta($nokartu, $tglsep, '');
		
		if(!is_null($data_peserta['hak_kelas_kode']) && $data_peserta['hak_kelas_kode'] != '') {
			$klsrawathak = $data_peserta['hak_kelas_kode'];
		}
		
		if(is_null($politujuan) && $politujuan == '' && $jnspelayanan == '1') {
			$politujuan = ' ';
		}
	}
	
	$flagprocedure = ($tujuankunj != '0') ? $flagprocedure : '';
	$kdpenunjang = ($tujuankunj != '0') ? $kdpenunjang : '';
	$assesmentpel = ($tujuankunj == '2' || $tujuankunj == '0') ? $assesmentpel : '';
	$pembiayaan = ($klsrawatnaik != '') ? $pembiayaan : '';
	$penanggungjawab = ($klsrawatnaik != '') ? $penanggungjawab : '';
	$dpjplayan = ($jnspelayanan != '1') ? $dpjplayan : '';
	
	$request = array('request'=>
					array('t_sep'=>
						array('noKartu'=>$nokartu,
							  'tglSep'=>$tglsep,
							  'ppkPelayanan'=>$ppkpelayanan,
							  'jnsPelayanan'=>$jnspelayanan,
							  'noMR'=>$nomr,
							  'klsRawat' => array('klsRawatHak'=>$klsrawathak,
												'klsRawatNaik'=>$klsrawatnaik,
												'pembiayaan'=>$pembiayaan,
												'penanggungJawab'=>$penanggungjawab),
							  'rujukan' => array('asalRujukan' => $asalrujukan,
												 'tglRujukan' => $tglrujukan,
												 'noRujukan' => $norujukan,
												 'ppkRujukan' => $ppkrujukan),
							  'catatan'=>$catatan,
							  'diagAwal'=>$diagawal,
							  'poli' => array('tujuan' => $politujuan,
											  'eksekutif' => $polieksekutif),
							  'cob' => array('cob' => $cob),
							  'katarak' => array('katarak' => $katarak),
							  'jaminan' => array('lakaLantas' => $lakalantas,
												 'penjamin' => array('penjamin' => $penjamin,
																	 'tglKejadian' => $tgl_kejadian,
																	 'keterangan' => $keterangan,
																	 'suplesi' => array('suplesi' => $suplesi,
																						'noSepSuplesi' => $nosepsuplesi,
																						'lokasiLaka' => array('kdPropinsi' => $kode_propinsi,
																											  'kdKabupaten' => $kode_kabupaten,
																											  'kdKecamatan' => $kode_kecamatan)
																				   )
																	)
												),
							  'tujuanKunj'=>$tujuankunj,
							  'flagProcedure'=>$flagprocedure,
							  'kdPenunjang'=>$kdpenunjang,
							  'assesmentPel'=>$assesmentpel,
							  'skdp' => array('noSurat' => $no_surat,
										   'kodeDPJP' => $kode_dpjp),
							  'dpjpLayan'=>$dpjplayan,			   
							  'noTelp' => $notelp,
							  'user'=>$user
						)
					)
				);
	
	$jsonrequest = json_encode($request);
	
	$reqmethod = 'post';
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	
	$metadata_code = '';
	$metadata_message = '';
	$response = '';
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	if($metadata_code == 200) {
		$key = $cid . ConsumerSecret . $timestmp;
		$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);	
		$response = $data_decrypt['sep']['noSep'];
	}
	
	// if($metadata_code == 200) {
		// $response = $data['response']['sep']['noSep'];
		// // $catatan = $data['response']['sep']['catatan'];
		// // $diagnosa = $data['response']['sep']['diagnosa'];
		// // $jns_pelayanan = $data['response']['sep']['jnsPelayanan'];
		// // $kelas_rawat = $data['response']['sep']['kelasRawat'];
		// // $no_sep = $data['response']['sep']['noSep'];
		// // $penjamin = $data['response']['sep']['penjamin'];
		// // $asuransi = $data['response']['sep']['peserta']['asuransi'];
		// // $hak_kelas = $data['response']['sep']['peserta']['hakKelas'];
		// // $jns_peserta = $data['response']['sep']['peserta']['jnsPeserta'];
		// // $kelamin = $data['response']['sep']['peserta']['kelamin'];
		// // $nama = $data['response']['sep']['peserta']['nama'];
		// // $no_kartu = $data['response']['sep']['peserta']['noKartu'];
		// // $norm = $data['response']['sep']['peserta']['noMr'];
		// // $tgl_lahir = $data['response']['sep']['peserta']['tglLahir'];
		// // $poli = $data['response']['sep']['poli'];
		// // $poli_eksekutif = $data['response']['sep']['poliEksekutif'];
		// // $tgl_sep = $data['response']['sep']['tglSep'];
	// } else {
	
		// if(is_null($response) && $response == '') {
			// $response = ' ';
		// }
		
	// if(strpos(strtoupper($metadata_message), 'TELAH MENDAPAT PELAYANAN R.INAP') > 0) {
		// global $url_cari_sep;
		
		// list($cid, $timestmp, $hashsignature) = HashBPJS(ConsumerID, ConsumerSecret);
		
		// $no_sep = substr($metadata_message, -19);
		
		// $completeurl = $url_cari_sep.$no_sep;
		// $response_cari_sep = xrequest($completeurl, $hashsignature, $cid, $timestmp);
	
		// $metadata_code = '';
		// $metadata_message = '';
		
		// $data_cari_sep = json_decode($response_cari_sep, true);
	
		// $metadata_code = $data_cari_sep['metaData']['code'];
		// $metadata_message = $data_cari_sep['metaData']['message'];
		
		// if($metadata_code == 200) {
			
			// $waktu = new DateTime();
			// $waktu->setTimezone(new DateTimeZone('Asia/Jakarta'));
			// $waktu->modify('-1 day');
			// $tglPlg = $waktu->format("Y-m-d");
			
			// $data_update_tglpulang = apiVClaimUpdatePulang($no_sep, $tglPlg, $user);

			// $metadata_code = '';
			// $metadata_message = '';
			// $response = '';
			
			// $response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content);
			// $data = json_decode($response, true);
			
			
			// $metadata_code = $data['metaData']['code'];
			// $metadata_message = $data['metaData']['message'];
			// $response = $data['response']['sep']['noSep'];
			
		// }
	// }
	// }
	
	if(is_null($response) && $response == '') {
		$response = ' ';
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'response'=>$response
	);
	
	$no_kartu 			= $nokartu;
	$tgl_sep 			= $tglsep;
	$tgl_rujukan 		= $tglrujukan;
	$no_rujukan			= $norujukan;
	$ppk_rujukan		= $ppkrujukan;
	$ppk_pelayanan		= $ppkpelayanan;
	$jns_pelayanan		= $jnspelayanan;
	$catatan			= $catatan;
	$kd_icd				= $diagawal;
	$poli_tujuan		= $politujuan;
	$kd_user			= $user;
	$norm				= $nomr;
	$no_telp			= $notelp;
	$asal_rujukan		= $asalrujukan;
	$poli_eksekutif		= $polieksekutif;
	$cob				= $cob;
	$laka_lantas		= $lakalantas;
	$penjamin			= $penjamin;
	$katarak			= $katarak;
	$tgl_kejadian		= $tgl_kejadian;
	$keterangan			= $keterangan;
	$suplesi			= $suplesi;
	$no_suplesi			= $nosepsuplesi;
	$propinsi			= $kode_propinsi;
	$kabupaten			= $kode_kabupaten;
	$kecamatan			= $kode_kecamatan;
	$no_surat			= $no_surat;
	$kode_dpjp			= $kode_dpjp;
	$kls_rawat_hak		= $klsrawathak;
	$kls_rawat_naik		= $klsrawatnaik;
	$pembiayaan			= $pembiayaan;
	$penanggung_jawab	= $penanggungjawab;
	$tujuan_kunj 		= $tujuankunj;
	$flag_procedure		= $flagprocedure;
	$kd_penunjang		= $kdpenunjang;
	$assesment_pel		= $assesmentpel;
	$dpjp_layan			= $dpjplayan;
	$no_sep				= $response;	
	$metadata_code		= $metadata_code;
	$metadata_msg		= $metadata_message;
	$response			= $response;

	brid_vclaim_log('apiVClaimGenSEP2',$no_kartu,$tgl_sep,$tgl_rujukan,$no_rujukan,$ppk_rujukan,$ppk_pelayanan,$jns_pelayanan,$catatan,$kd_icd,$poli_tujuan,$kd_user,$norm,$no_telp,$asal_rujukan,$poli_eksekutif,$cob,$laka_lantas,$penjamin,$katarak,$tgl_kejadian,$keterangan,$suplesi,$no_suplesi,$propinsi,$kabupaten,$kecamatan,$no_surat,$kode_dpjp,$kls_rawat_hak,$kls_rawat_naik,$pembiayaan,$penanggung_jawab,$tujuan_kunj,$flag_procedure,$kd_penunjang,$assesment_pel,$dpjp_layan,$no_sep,$metadata_code,$metadata_msg,$response);
	$hasil = json_encode($return_data);
	log_data('apiVClaimGenSEP2', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimUpdateSEP2($no_sep, $norm, $asal_rujukan, $tgl_rujukan, $no_rujukan, $ppk_rujukan, $catatan, $diagnosa_awal, $poli_tujuan, $poli_eksekutif, $cob, $laka_lantas, $penjamin, $no_telp, $user, $katarak, $tgl_kejadian, $keterangan, $suplesi, $nosepsuplesi, $kode_propinsi, $kode_kabupaten, $kode_kecamatan, $no_surat, $kode_dpjp, $kelas_rawat_hak, $kelas_rawat_naik, $pembiayaan, $penanggung_jawab, $dpjp_layan) {
	global $url_update_sep2;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	$katarak = ($katarak == '' || $katarak == '?') ? '0' : $katarak;
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$urlrequest = $url_update_sep2;
	
	$request = array('request'=>
					array('t_sep'=>
						array('noSep'=>$no_sep,
							  'klsRawat'=>array('klsRawatHak'=>$kelas_rawat_hak,
												'klsRawatNaik'=>$kelas_rawat_naik,
												'pembiayaan'=>$pembiayaan,
												'PenanggungJawab'=>$penanggung_jawab),
							  'noMR'=>$norm,
							  'catatan'=>$catatan,
							  'diagAwal'=>$diagnosa_awal,
							  'poli' => array('tujuan'=>$poli_tujuan,'eksekutif' => $poli_eksekutif),
							  'cob' => array('cob' => $cob),
							  'katarak' => array('katarak' => $katarak),
							  'skdp' => array('noSurat' => $no_surat,
										   'kodeDPJP' => $kode_dpjp),
							  'jaminan' => array('lakaLantas' => $laka_lantas,
												 'penjamin' => array('penjamin' => $penjamin,
																	 'tglKejadian' => $tgl_kejadian,
																	 'keterangan' => $keterangan,
																	 'suplesi' => array('suplesi' => $suplesi,
																						'noSepSuplesi' => $nosepsuplesi,
																						'lokasiLaka' => array('kdPropinsi' => $kode_propinsi,
																											  'kdKabupaten' => $kode_kabupaten,
																											  'kdKecamatan' => $kode_kecamatan)
																				   )
																	)
												),
							  'dpjpLayan'=>$dpjp_layan,
							  'noTelp' => $no_telp,
							  'user'=>$user
						)
					)
				);
	
	$jsonrequest = json_encode($request);

	$reqmethod = 'put';
	
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$response = null;
	$metadata_code = null;
	$metadata_message = null;
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	$response = $data_decrypt;
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'response'=>$response
	);
	$hasil = json_encode($return_data);
	log_data('apiVClaimUpdateSEP2', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimHapusSEP($nosep, $user) {
	global $url_delete_sep;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
		
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$urlrequest = $url_delete_sep;
	
	$request = array('request'=>
					array('t_sep'=>
						array('noSep' => $nosep,
							  'user' => $user
						)
					)
			   );
	
	$jsonrequest = json_encode($request);

	$reqmethod = 'delete';
	
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$metadata_code = null;
	$metadata_message = null;
	$response = null;
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	$response = $data_decrypt;
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'response'=>$response
	);

	log_data('apiVClaimHapusSEP', $urlrequest, $jsonrequest, $metadata_message);
	
	return $return_data;
}

function apiVClaimHapusSEP2($nosep, $user) {
	global $url_delete_sep2;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
		
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$urlrequest = $url_delete_sep2;
	
	$request = array('request'=>
					array('t_sep'=>
						array('noSep' => $nosep,
							  'user' => $user
						)
					)
			   );
	
	$jsonrequest = json_encode($request);

	$reqmethod = 'delete';
	
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$metadata_code = null;
	$metadata_message = null;
	$response = null;
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	$response = $data_decrypt;
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'response'=>$response
	);

	log_data('apiVClaimHapusSEP2', $urlrequest, $jsonrequest, $metadata_message);
	
	return $return_data;
}

function apiVClaimCariSEP($nosep) {
	global $url_cari_sep;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	if(is_null($nosep) && $nosep == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'Nomor SEP harus diisi',
			'count'=>0,
			'list'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_cari_sep.'/'.$nosep;
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);

	$metadata_code = '';
	$metadata_message = '';
	$catatan = '';
	$diagnosa = '';
	$jns_pelayanan = '';
	$kelas_rawat = '';
	$no_sep = '';
	$penjamin = '';
	$asuransi = '';
	$hak_kelas = '';
	$jns_peserta = '';
	$kelamin = '';
	$nama = '';
	$no_kartu = '';
	$norm = '';
	$tgl_lahir = '';
	$poli = '';
	$poli_eksekutif = '';
	$tgl_sep = '';
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	 if($metadata_code == 200) {
		$catatan = $data_decrypt['catatan'];
		$diagnosa = $data_decrypt['diagnosa'];
		$jns_pelayanan = $data_decrypt['jnsPelayanan'];
		$kelas_rawat = $data_decrypt['kelasRawat'];
		$no_sep = $data_decrypt['noSep'];
		$penjamin = $data_decrypt['penjamin'];
		$asuransi = $data_decrypt['peserta']['asuransi'];
		$hak_kelas = $data_decrypt['peserta']['hakKelas'];
		$jns_peserta = $data_decrypt['peserta']['jnsPeserta'];
		$kelamin = $data_decrypt['peserta']['kelamin'];
		$nama = $data_decrypt['peserta']['nama'];
		$no_kartu = $data_decrypt['peserta']['noKartu'];
		$norm = $data_decrypt['peserta']['noMr'];
		$tgl_lahir = $data_decrypt['peserta']['tglLahir'];
		$poli = $data_decrypt['poli'];
		$poli_eksekutif = $data_decrypt['poliEksekutif'];
		$tgl_sep = $data_decrypt['tglSep'];
	}
	
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'catatan' => $catatan,
		'diagnosa' => $diagnosa,
		'jns_pelayanan' => $jns_pelayanan,
		'kelas_rawat' => $kelas_rawat,
		'no_sep' => $no_sep,
		'penjamin' => $penjamin,
		'asuransi' => $asuransi,
		'hak_kelas' => $hak_kelas,
		'jns_peserta' => $jns_peserta,
		'kelamin' => $kelamin,
		'nama' => $nama,
		'no_kartu' => $no_kartu,
		'norm' => $norm,
		'tgl_lahir' => $tgl_lahir,
		'poli' => $poli,
		'poli_eksekutif' => $poli_eksekutif,
		'tgl_sep' => $tgl_sep
	);

	$data_req = json_encode(
		array(
			"nosep" => $nosep
		)
	);

	log_data('apiVClaimCariSEP', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVClaimSuplesiJR($no_kartu, $tgl_pelayanan) {
	global $url_suplesi;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'count'=>0,
			'list'=>''
		);
	}
	
	if(is_null($no_kartu) && $no_kartu == '' && is_null($tgl_pelayanan) && $tgl_pelayanan == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'No Kartu Peserta dan Tanggal Pelayanan harus diisi',
			'count'=>0,
			'list'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_suplesi.$no_kartu.'/tglPelayanan/'.$tgl_pelayanan;
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['jaminan']);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$i = 0;
	$datarray = array();
	if($count > 0) {
		for ($i = 0; $i < $count; $i++){
			$datarray[$i]['no_register'] = $data_decrypt['jaminan'][$i]['noRegister'];
			$datarray[$i]['no_sep'] = $data_decrypt['jaminan'][$i]['noSep'];
			$datarray[$i]['no_sepawal'] = $data_decrypt['jaminan'][$i]['noSepAwal'];
			$datarray[$i]['no_suratjaminan'] = $data_decrypt['jaminan'][$i]['noSuratJaminan'];
			$datarray[$i]['tgl_kejadian'] = $data_decrypt['jaminan'][$i]['tglKejadian'];
			$datarray[$i]['tgl_sep'] = $data_decrypt['jaminan'][$i]['tglSep'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	$data_req = json_encode(
		array(
			"no_kartu" => $no_kartu,
			"tgl_pelayanan" => $tgl_pelayanan
		)
	);

	log_data('apiVClaimSuplesiJR', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVClaimPengajuan($no_kartu, $tgl_sep, $jenis_pelayanan, $jenis_pengajuan, $keterangan, $user) {
	global $url_pengajuan;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);

	$urlrequest = $url_pengajuan;
	
	$request = array('request'=>
					array('t_sep'=>
						array('noKartu'=>$no_kartu,
							  'tglSep'=>$tgl_sep,
							  'jnsPelayanan'=>$jenis_pelayanan,
							  'jnsPengajuan'=>$jenis_pengajuan,
							  'keterangan'=>$keterangan,
							  'user'=>$user
						)
					)
				);
	
	$jsonrequest = json_encode($request);
	
	$reqmethod = 'post';
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);

	$response = null;
	$metadata_message = null;
	$metadata_code = null;
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	$response = $data_decrypt;
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'response'=>$response
	);
	$hasil = json_encode($return_data);
	log_data('apiVClaimPengajuan', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimPengajuan11($no_kartu, $tgl_sep, $jenis_pelayanan, $jenis_pengajuan, $keterangan, $user) {
	global $url_pengajuan;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);

	$urlrequest = $url_pengajuan;
	
	$request = array('request'=>
					array('t_sep'=>
						array('noKartu'=>$no_kartu,
							  'tglSep'=>$tgl_sep,
							  'jnsPelayanan'=>$jenis_pelayanan,
							  'jnsPengajuan'=>$jenis_pengajuan,
							  'keterangan'=>$keterangan,
							  'user'=>$user
						)
					)
				);
	
	$jsonrequest = json_encode($request);
	
	$reqmethod = 'post';
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);

	$response = null;
	$metadata_message = null;
	$metadata_code = null;
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	$response = $data_decrypt;
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'response'=>$response
	);
	$hasil = json_encode($return_data);
	log_data('apiVClaimPengajuan11', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}


function apiVClaimAproval11($no_kartu, $tgl_sep, $jenis_pelayanan, $jenis_pengajuan, $keterangan, $user) {
	global $url_aproval;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);

	$urlrequest = $url_aproval;
	
	$request = array('request'=>
					array('t_sep'=>
						array('noKartu'=>$no_kartu,
							  'tglSep'=>$tgl_sep,
							  'jnsPelayanan'=>$jenis_pelayanan,
							  'jnsPengajuan' => $jenis_pengajuan,
							  'keterangan'=>$keterangan,
							  'user'=>$user
						)
					)
				);
	
	$jsonrequest = json_encode($request);
	
	$reqmethod = 'post';
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$response = null;
	$metadata_message = null;
	$metadata_code = null;
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	$response = $data_decrypt;
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'response'=>$response
	);
	$hasil = json_encode($return_data);
	log_data('apiVClaimAproval11', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimAproval($no_kartu, $tgl_sep, $jenis_pelayanan, $keterangan, $user) {
	global $url_aproval;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);

	$urlrequest = $url_aproval;
	
	$request = array('request'=>
					array('t_sep'=>
						array('noKartu'=>$no_kartu,
							  'tglSep'=>$tgl_sep,
							  'jnsPelayanan'=>$jenis_pelayanan,
							  'keterangan'=>$keterangan,
							  'user'=>$user
						)
					)
				);
	
	$jsonrequest = json_encode($request);
	
	$reqmethod = 'post';
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$response = null;
	$metadata_message = null;
	$metadata_code = null;
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	$response = $data_decrypt;
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'response'=>$response
	);
	$hasil = json_encode($return_data);
	log_data('apiVClaimAproval', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimUpdatePulang($nosep, $tglplg, $user) {
	global $url_update_plg;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);

	$urlrequest = $url_update_plg;
	
	$request = array('request'=>
					array('t_sep'=>
						array('noSep'=>$nosep,
							  'tglPulang'=>$tglplg,
							  'user'=>$user
						)
					)
				);
	
	$jsonrequest = json_encode($request);
	
	$reqmethod = 'put';
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);

	$response = null;
	$metadata_message = null;
	$metadata_code = null;
	
	$response = $data_decrypt;
	$metadata_message = $data['metaData']['message'];
	$metadata_code = $data['metaData']['code'];
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'response'=>$response
	);
	$hasil = json_encode($return_data);
	log_data('apiVClaimUpdatePulang', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimUpdatePulang2($nosep, $statusplg, $nosuratmeninggal, $tglmeninggal, $tglplg, $nolpmanual, $user) {
	global $url_update_plg2;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_code'=>'92',
			'metadata_message'=>'Consumer ID or Consumer Secret not found'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);

	$urlrequest = $url_update_plg2;
	
	$request = array('request'=>
					array('t_sep'=>
						array('noSep'=>$nosep,
							  'statusPulang'=>$statusplg,
							  'noSuratMeninggal'=>$nosuratmeninggal,
							  'tglMeninggal'=>$tglmeninggal,
							  'tglPulang'=>$tglplg,
							  'noLPManual'=>$nolpmanual,
							  'user'=>$user
						)
					)
				);
	
	$jsonrequest = json_encode($request);
	
	$reqmethod = 'put';
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);

	$response = '';
	$metadata_code = '';
	$metadata_message = '';
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	$response = $data_decrypt;
		
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'response'=>$response
	);
	$hasil = json_encode($return_data);
	log_data('apiVClaimUpdatePulang2', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimIntegrasiInaCBG($no_sep) {
	global $url_integrasi_inacbg;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92',
			'kelamin' => '',
			'kelas_rawat' => '',
			'nama' => '',
			'no_kartu_bpjs' => '',
			'norm' => '',
			'no_rujukan' => '',
			'tgl_lahir' => '',
			'tgl_pelayanan' => '',
			'tkt_pelayanan' => ''
		);
	}
	
	if(is_null($no_sep) && $no_sep == '') {
		return array(
			'metadata_code' => '90',
			'metadata_message' => 'Nomor SEP harus diisi',
			'kelamin' => '',
			'kelas_rawat' => '',
			'nama' => '',
			'no_kartu_bpjs' => '',
			'norm' => '',
			'no_rujukan' => '',
			'tgl_lahir' => '',
			'tgl_pelayanan' => '',
			'tkt_pelayanan' => ''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_integrasi_inacbg.'/'.$no_sep;
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = $data['response'];

	$metadata_code = null;
	$metadata_message = null;
	$kelamin = null;
	$kelas_rawat = null;
	$nama = null;
	$no_kartu_bpjs = null;
	$norm = null;
	$no_rujukan = null;
	$tgl_lahir = null;
	$tgl_pelayanan = null;
	$tkt_pelayanan = null;
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$kelamin = $data_decrypt['pesertasep']['kelamin'];
	$kelas_rawat = $data_decrypt['pesertasep']['klsRawat'];
	$nama = $data_decrypt['pesertasep']['nama'];
	$no_kartu_bpjs = $data_decrypt['pesertasep']['noKartuBpjs'];
	$norm = $data_decrypt['pesertasep']['noMr'];
	$no_rujukan = $data_decrypt['pesertasep']['noRujukan'];
	$tgl_lahir = $data_decrypt['pesertasep']['tglLahir'];
	$tgl_pelayanan = $data_decrypt['pesertasep']['tglPelayanan'];
	$tkt_pelayanan = $data_decrypt['pesertasep']['tktPelayanan'];
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'kelamin' => $kelamin,
		'kelas_rawat' => $kelas_rawat,
		'nama' => $nama,
		'no_kartu_bpjs' => $no_kartu_bpjs,
		'norm' => $norm,
		'no_rujukan' => $no_rujukan,
		'tgl_lahir' => $tgl_lahir,
		'tgl_pelayanan' => $tgl_pelayanan,
		'tkt_pelayanan' => $tkt_pelayanan
	);

	$data_req = json_encode(
		array(
			"no_sep" => $no_sep
		)
	);

	log_data('apiVClaimIntegrasiInaCBG', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVClaimRujukan($varrequest) {
	
	$tiperequest = (strlen($varrequest) === 13) ? 'peserta' : '';
	
	$list = '0';
	$rujukan = array();
	$rujukan_list = array();
	$rujukan_list_rs = '';
	$rujukan_list_pcare = '';
	$rujukan_rs = apiVClaimRujukanPCare($varrequest, $tiperequest);
	$rujukan_pcare = apiVClaimRujukanRS($varrequest, $tiperequest);
	
	if($tiperequest == 'peserta') {
		$rujukan_list_rs = apiVClaimLRujukan($varrequest, 'list', 'rs');
		$rujukan_list_pcare = apiVClaimLRujukan($varrequest, 'list', 'pcare');
	}else{
		$rujukan_list_rs['metadata_code'] = '';
		$rujukan_list_pcare['metadata_code'] = '';
	}
		
	if(empty($rujukan_pcare['metadata_code']) && empty($rujukan_rs['metadata_code']) && empty($rujukan_list_pcare['metadata_code']) && empty($rujukan_list_rs['metadata_code'])){
		$pesan = 'Ada gangguan koneksi, silakan ulangi kembali';
		$return = array("metadata_code" => "101",
						"metadata_message" => $pesan,
						"catatan" => "",
						"kd_diagnosa" => "",
						"nm_diagnosa" => "",
						"keluhan" => "",
						"no_kunjungan" => "",
						"pem_fisik_lain" => "",
						"dinsos" => "",
						"iuran" => "",
						"no_sktm" => "",
						"prolanis_prb" => "",
						"kd_jenis_peserta" => "",
						"nm_jenis_peserta" => "",
						"kd_kelas" => "",
						"nm_kelas" => "",
						"nama" => "",
						"nik" => "",
						"no_kartu" => "",
						"norm" => "",
						"pisa" => "",
						"kd_cabang_prov_umum" => "",
						"kd_provider_prov_umum" => "",
						"nm_cabang_prov_umum" => "",
						"nm_provider_prov_umum" => "",
						"sex" => "",
						"status_peserta" => "",
						"kd_status_peserta" => "",
						"tgl_cetak_kartu" => "",
						"tgl_lahir" => "",
						"tgl_tat" => "",
						"tgl_tmt" => "",
						"umur" => "",
						"kd_poli_rujuk" => "",
						"nm_poli_rujuk" => "",
						"kd_cabang_prov_kunjungan" => "",
						"kd_provider_prov_kunjungan" => "",
						"nm_cabang_prov_kunjungan" => "",
						"nm_provider_prov_kunjungan" => "",
						"kd_cabang_prov_rujuk" => "",
						"kd_provider_prov_rujuk" => "",
						"nm_cabang_prov_rujuk" => "",
						"nm_provider_prov_rujuk" => "",
						"tgl_kunjungan" => "",
						"nm_pelayanan" => "",
						"tkt_pelayanan" => "",
						"nama_asuransi_cob" => "",
						"no_asuransi_cob" => "",
						"tgl_tat_cob" => "",
						"tgl_tmt_cob" => "",
						"no_telp" => "",
						"umur_saat_pelayanan" => "");
		return $return;
	}
	
	if($rujukan_pcare['metadata_code'] <> '200' && $rujukan_rs['metadata_code'] <> '200' && $rujukan_list_pcare['metadata_code'] <> '200' && $rujukan_list_rs['metadata_code'] <> '200'){
		$metadata_code = $rujukan_pcare['metadata_code'];
		$metadata_message = $rujukan_pcare['metadata_message'];
		$return = array("metadata_code" => $metadata_code,
						"metadata_message" => $metadata_message,
						"catatan" => "",
						"kd_diagnosa" => "",
						"nm_diagnosa" => "",
						"keluhan" => "",
						"no_kunjungan" => "",
						"pem_fisik_lain" => "",
						"dinsos" => "",
						"iuran" => "",
						"no_sktm" => "",
						"prolanis_prb" => "",
						"kd_jenis_peserta" => "",
						"nm_jenis_peserta" => "",
						"kd_kelas" => "",
						"nm_kelas" => "",
						"nama" => "",
						"nik" => "",
						"no_kartu" => "",
						"norm" => "",
						"pisa" => "",
						"kd_cabang_prov_umum" => "",
						"kd_provider_prov_umum" => "",
						"nm_cabang_prov_umum" => "",
						"nm_provider_prov_umum" => "",
						"sex" => "",
						"status_peserta" => "",
						"kd_status_peserta" => "",
						"tgl_cetak_kartu" => "",
						"tgl_lahir" => "",
						"tgl_tat" => "",
						"tgl_tmt" => "",
						"umur" => "",
						"kd_poli_rujuk" => "",
						"nm_poli_rujuk" => "",
						"kd_cabang_prov_kunjungan" => "",
						"kd_provider_prov_kunjungan" => "",
						"nm_cabang_prov_kunjungan" => "",
						"nm_provider_prov_kunjungan" => "",
						"kd_cabang_prov_rujuk" => "",
						"kd_provider_prov_rujuk" => "",
						"nm_cabang_prov_rujuk" => "",
						"nm_provider_prov_rujuk" => "",
						"tgl_kunjungan" => "",
						"nm_pelayanan" => "",
						"tkt_pelayanan" => "",
						"nama_asuransi_cob" => "",
						"no_asuransi_cob" => "",
						"tgl_tat_cob" => "",
						"tgl_tmt_cob" => "",
						"no_telp" => "",
						"umur_saat_pelayanan" => "");
		return $return;
	}
	
	if(!empty($rujukan_list_rs['metadata_code']) && $rujukan_list_rs['metadata_code'] == '200') {
		$rujukan_list = $rujukan_list_rs['list'];
		$list = '1';
	}

	if(!empty($rujukan_list_pcare['metadata_code']) && $rujukan_list_pcare['metadata_code'] == '200') {
		if($list == '0') {
			$rujukan_list = $rujukan_list_pcare['list'];
			$list = '1';
		} else {
			$rujukan_list = array_merge($rujukan_list, $rujukan_list_pcare['list']);
		}
	}
	
	if(!empty($rujukan_rs['metadata_code']) && $rujukan_rs['metadata_code'] == '200'){
		if($list == '0') {
			$rujukan_list = array($rujukan_rs);
			$list = '1';
		} else {
			$rujukan_list = array_merge($rujukan_list, array($rujukan_rs));
		}
	}
	
	if(!empty($rujukan_pcare['metadata_code']) && $rujukan_pcare['metadata_code'] == '200'){
		if($list == '0') {
			$rujukan_list = array($rujukan_pcare);
			// $list = '1';
		} else {
			$rujukan_list = array_merge($rujukan_list, array($rujukan_pcare));
		}
	}
	// var_dump($rujukan_list);
	$count_list = ($list == '1') ? count($rujukan_list) : 1;
	for($i=0; $i < $count_list;$i++) {
		$tglkunjungan_list_array[] = explode(" ", $rujukan_list[$i]['tgl_kunjungan']);
	}
	$row_array_list = array_search(max($tglkunjungan_list_array), $tglkunjungan_list_array);
	
	$peserta = apiVClaimPeserta($rujukan_list[$row_array_list]['no_kartu'], date('Y-m-d'), 'peserta');
	$nik = $peserta['nik'];
	$nama = str_replace('\'', '', $peserta['nama']);
	$pisa = $peserta['pisa'];
	$sex = $peserta['sex'];
	$tgllahir = $peserta['tgl_lahir'];
	$tglcetakkartu = $peserta['tgl_cetak_kartu'];
	$provumum_kdprovider = $peserta['prov_umum_kode_provider'];
	$provumum_nmprovider = htmlspecialchars($peserta['prov_umum_nama_provider'], ENT_QUOTES); 
	$kdjenispeserta = $peserta['jenis_peserta_kode'];
	$nmjenispeserta = $peserta['jenis_peserta_ket'];
	$kdkelas = $peserta['hak_kelas_kode'];
	$nmkelas = $peserta['hak_kelas_ket'];
	
	$return = array("metadata_code" =>  '200',
					"metadata_message" => 'OK',
					"catatan" => '',
					"kd_diagnosa" => $rujukan_list[$row_array_list]['kd_diagnosa'],
					"nm_diagnosa" => $rujukan_list[$row_array_list]['nm_diagnosa'],
					"keluhan" => $rujukan_list[$row_array_list]['keluhan'],
					"no_kunjungan" => $rujukan_list[$row_array_list]['no_kunjungan'],
					"pem_fisik_lain" => '',
					"dinsos" => $rujukan_list[$row_array_list]['dinsos'],
					"iuran" => '',
					"no_sktm" => $rujukan_list[$row_array_list]['no_sktm'],
					"prolanis_prb" => $rujukan_list[$row_array_list]['prolanis_prb'],
					"kd_jenis_peserta" => $peserta['jenis_peserta_kode'],
					"nm_jenis_peserta" => $peserta['jenis_peserta_ket'],
					"kd_kelas" => $peserta['hak_kelas_kode'],
					"nm_kelas" => $peserta['hak_kelas_ket'],
					"nama" => str_replace('\'', '', $peserta['nama']),
					"nik" => $peserta['nik'],
					"no_kartu" => $rujukan_list[$row_array_list]['no_kartu'],
					"norm" => $rujukan_list[$row_array_list]['norm'],
					"pisa" => $peserta['pisa'],
					"kd_cabang_prov_umum" => '',
					"kd_provider_prov_umum" => $peserta['prov_umum_kode_provider'],
					"nm_cabang_prov_umum" => '',
					"nm_provider_prov_umum" => htmlspecialchars($peserta['prov_umum_nama_provider'], ENT_QUOTES),
					"sex" => $peserta['sex'],
					"status_peserta" => $rujukan_list[$row_array_list]['status_peserta'],
					"kd_status_peserta" => $rujukan_list[$row_array_list]['kd_status_peserta'],
					"tgl_cetak_kartu" => $peserta['tgl_cetak_kartu'],
					"tgl_lahir" => $peserta['tgl_lahir'],
					"tgl_tat" => $rujukan_list[$row_array_list]['tgl_tat'],
					"tgl_tmt" => $rujukan_list[$row_array_list]['tgl_tmt'],
					"umur" => $rujukan_list[$row_array_list]['umur'],
					"kd_poli_rujuk" => $rujukan_list[$row_array_list]['kd_poli_rujuk'],
					"nm_poli_rujuk" => $rujukan_list[$row_array_list]['nm_poli_rujuk'],
					"kd_cabang_prov_kunjungan" => '',
					"kd_provider_prov_kunjungan" => '',
					"nm_cabang_prov_kunjungan" => '',
					"nm_provider_prov_kunjungan" => '',
					"kd_cabang_prov_rujuk" => '',
					"kd_provider_prov_rujuk" => $rujukan_list[$row_array_list]['kd_provider_prov_rujuk'],
					"nm_cabang_prov_rujuk" => '',
					"nm_provider_prov_rujuk" => $rujukan_list[$row_array_list]['nm_provider_prov_rujuk'],
					"tgl_kunjungan" => $rujukan_list[$row_array_list]['tgl_kunjungan'],
					"nm_pelayanan" => (!empty($rujukan_list[$row_array_list]['nama_pelayanan'])) ? $rujukan_list[$row_array_list]['nama_pelayanan'] : $rujukan_list[$row_array_list]['nm_pelayanan'],
					"tkt_pelayanan" => (!empty($rujukan_list[$row_array_list]['kode_pelayanan'])) ? $rujukan_list[$row_array_list]['kode_pelayanan'] : $rujukan_list[$row_array_list]['tkt_pelayanan'],
					"nama_asuransi_cob" => $rujukan_list[$row_array_list]['nama_asuransi_cob'],
					"no_asuransi_cob" => $rujukan_list[$row_array_list]['no_asuransi_cob'],
					"tgl_tat_cob" => $rujukan_list[$row_array_list]['tgl_tat_cob'],
					"tgl_tmt_cob" => $rujukan_list[$row_array_list]['tgl_tmt_cob'],
					"no_telp" => $rujukan_list[$row_array_list]['no_telp'],
					"umur_saat_pelayanan" => $rujukan_list[$row_array_list]['umur_saat_pelayanan']);

	$data_req = json_encode(
		array(
			"varrequest" => $varrequest
		)
	);

	log_data('apiVClaimRujukan', 'no url merujuk ke function rujukan lain', $data_req, 'message merujuk ke function rujukan lain');
	
	return $return;
}

function apiVClaimListRujukan($varrequest) {
	
	$tiperequest = (strlen($varrequest) === 13) ? 'peserta' : '';
	
	$list = '0';
	$rujukan = array();
	$rujukan_list = array();
	$rujukan_list_rs = '';
	$rujukan_list_pcare = '';
	$rujukan_rs = apiVClaimRujukanPCare($varrequest, $tiperequest);
	$rujukan_pcare = apiVClaimRujukanRS($varrequest, $tiperequest);
	
	if($tiperequest == 'peserta') {
		$rujukan_list_rs = apiVClaimLRujukan($varrequest, 'list', 'rs');
		$rujukan_list_pcare = apiVClaimLRujukan($varrequest, 'list', 'pcare');
	}else{
		$rujukan_list_rs['metadata_code'] = '';
		$rujukan_list_pcare['metadata_code'] = '';
	}
	
	if(empty($rujukan_pcare['metadata_code']) && empty($rujukan_rs['metadata_code']) && empty($rujukan_list_pcare['metadata_code']) && empty($rujukan_list_rs['metadata_code'])){
		$pesan = 'Ada gangguan koneksi, silakan ulangi kembali';
		$return = array("count" => "0",
						"metadata_code" => "101",
						"metadata_message" => $pesan,
						"list" => "");
		return $return;
	}
	
	if($rujukan_pcare['metadata_code'] <> '200' && $rujukan_rs['metadata_code'] <> '200' && $rujukan_list_pcare['metadata_code'] <> '200' && $rujukan_list_rs['metadata_code'] <> '200'){
		$metadata_code = $rujukan_pcare['metadata_code'];
		$metadata_message = $rujukan_pcare['metadata_message'];
		$return = array("count" => "0",
						"metadata_code" => $metadata_code,
						"metadata_message" => $metadata_message,
						"list" => "");
		return $return;
	}
	
	if(!empty($rujukan_list_rs['metadata_code']) && $rujukan_list_rs['metadata_code'] == '200') {
		$rujukan_list = $rujukan_list_rs['list'];
		$list = '1';
	}

	if(!empty($rujukan_list_pcare['metadata_code']) && $rujukan_list_pcare['metadata_code'] == '200') {
		if($list == '0') {
			$rujukan_list = $rujukan_list_pcare['list'];
			$list = '1';
		} else {
			$rujukan_list = array_merge($rujukan_list, $rujukan_list_pcare['list']);
		}
	}
	
	if(!empty($rujukan_rs['metadata_code']) && $rujukan_rs['metadata_code'] == '200'){
		if($list == '0') {
			$rujukan_list = array($rujukan_rs);
			$list = '1';
		} else {
			$no_kunjungan_rs = array_column($rujukan_list, 'no_kunjungan');
			if(!in_array($rujukan_rs['no_kunjungan'], $no_kunjungan_rs)) {
				$rujukan_list = array_merge($rujukan_list, array($rujukan_rs));
			}
		}
	}
	
	if(!empty($rujukan_pcare['metadata_code']) && $rujukan_pcare['metadata_code'] == '200'){
		if($list == '0') {
			$rujukan_list = array($rujukan_pcare);
			// $list = '1';
		} else {
			$no_kunjungan_pcare = array_column($rujukan_list, 'no_kunjungan');
			if(!in_array($rujukan_pcare['no_kunjungan'], $no_kunjungan_pcare)) {
				$rujukan_list = array_merge($rujukan_list, array($rujukan_pcare));
			}
		}
	}
	// var_dump($rujukan_list);
	// for($i=0; $i < $count_list;$i++) {
		// $tglkunjungan_list_array[] = explode(" ", $rujukan_list[$i]['tgl_kunjungan']);
	// }
	$row_array_list = array_filter($rujukan_list, function($row) {
		return strtotime($row['tgl_kunjungan']) > strtotime(date('Y-m-d')." -89 days");
	});
	$count_list = count($row_array_list);
	$row_array_list = array_values($row_array_list);
	
	$i = 0;
	$datarray = array();
	if($count_list > 0) {
		for ($i = 0; $i < $count_list; $i++){
			$datarray[$i]['kd_diagnosa'] = $row_array_list[$i]['kd_diagnosa'];
			$datarray[$i]['nm_diagnosa'] = $row_array_list[$i]['nm_diagnosa'];
			$datarray[$i]['keluhan'] = $row_array_list[$i]['keluhan'];
			$datarray[$i]['no_kunjungan'] = $row_array_list[$i]['no_kunjungan'];
			$datarray[$i]['kode_pelayanan'] = (isset($row_array_list[$i]['kode_pelayanan'])) ? $row_array_list[$i]['kode_pelayanan'] : $row_array_list[$i]['tkt_pelayanan'];
			$datarray[$i]['nama_pelayanan'] = (isset($row_array_list[$i]['nama_pelayanan'])) ? $row_array_list[$i]['nama_pelayanan'] : $row_array_list[$i]['nm_pelayanan'];
			$datarray[$i]['nama_asuransi_cob'] = $row_array_list[$i]['nama_asuransi_cob'];
			$datarray[$i]['no_asuransi_cob'] = $row_array_list[$i]['no_asuransi_cob'];
			$datarray[$i]['tgl_tat_cob'] = $row_array_list[$i]['tgl_tat_cob'];
			$datarray[$i]['tgl_tmt_cob'] = $row_array_list[$i]['tgl_tmt_cob'];
			$datarray[$i]['nm_kelas'] = $row_array_list[$i]['nm_kelas'];
			$datarray[$i]['kd_kelas'] = $row_array_list[$i]['kd_kelas'];
			$datarray[$i]['dinsos'] = $row_array_list[$i]['dinsos'];
			$datarray[$i]['no_sktm'] = $row_array_list[$i]['no_sktm'];
			$datarray[$i]['prolanis_prb'] = $row_array_list[$i]['prolanis_prb'];
			$datarray[$i]['nm_jenis_peserta'] = $row_array_list[$i]['nm_jenis_peserta'];
			$datarray[$i]['kd_jenis_peserta'] = $row_array_list[$i]['kd_jenis_peserta'];
			$datarray[$i]['norm'] = $row_array_list[$i]['norm'];
			$datarray[$i]['no_telp'] = $row_array_list[$i]['no_telp'];
			$datarray[$i]['nama'] = $row_array_list[$i]['nama'];
			$datarray[$i]['nik'] = $row_array_list[$i]['nik'];
			$datarray[$i]['no_kartu'] = $row_array_list[$i]['no_kartu'];
			$datarray[$i]['pisa'] = $row_array_list[$i]['pisa'];
			$datarray[$i]['kd_provider_prov_umum'] = $row_array_list[$i]['kd_provider_prov_umum'];
			$datarray[$i]['nm_provider_prov_umum'] = $row_array_list[$i]['nm_provider_prov_umum'];
			$datarray[$i]['sex'] = $row_array_list[$i]['sex'];
			$datarray[$i]['status_peserta'] = $row_array_list[$i]['status_peserta'];
			$datarray[$i]['kd_status_peserta'] = $row_array_list[$i]['kd_status_peserta'];
			$datarray[$i]['tgl_cetak_kartu'] = $row_array_list[$i]['tgl_cetak_kartu'];
			$datarray[$i]['tgl_lahir'] = $row_array_list[$i]['tgl_lahir'];
			$datarray[$i]['tgl_tat'] = $row_array_list[$i]['tgl_tat'];
			$datarray[$i]['tgl_tmt'] = $row_array_list[$i]['tgl_tmt'];
			$datarray[$i]['umur_saat_pelayanan'] = $row_array_list[$i]['umur_saat_pelayanan'];
			$datarray[$i]['umur'] = $row_array_list[$i]['umur'];
			$datarray[$i]['kd_poli_rujuk'] = $row_array_list[$i]['kd_poli_rujuk'];
			$datarray[$i]['nm_poli_rujuk'] = $row_array_list[$i]['nm_poli_rujuk'];
			$datarray[$i]['kd_provider_prov_rujuk'] = $row_array_list[$i]['kd_provider_prov_rujuk'];
			$datarray[$i]['nm_provider_prov_rujuk'] = $row_array_list[$i]['nm_provider_prov_rujuk'];
			$datarray[$i]['tgl_kunjungan'] = $row_array_list[$i]['tgl_kunjungan'];
		}
	}
	
	$return = array(
		'metadata_code'=> '200',
		'metadata_message'=> 'OK',
		'count'=>$count_list,
		'list'=>$datarray
	);
	
	log_data('apiVClaimListRujukan', 'no url merujuk ke function rujukan lain', '', 'message merujuk ke function rujukan lain');
	
	return $return;
}

function apiVClaimRujukanPCare($varrequest, $tiperequest) {
	
	return vclaim_rujukan($varrequest, $tiperequest, 'pcare');
}

function apiVClaimRujukanRS($varrequest, $tiperequest) {
	
	return vclaim_rujukan($varrequest, $tiperequest, 'rs');
}

function vclaim_rujukan($varrequest, $tiperequest, $jenisrequest) {
	
	if(empty($varrequest) || $varrequest == '?') {
		$return = array("metadata_code" => "90",
						"metadata_message" => "Tidak ada parameter yang diinputkan",
						"catatan" => "",
						"kd_diagnosa" => "",
						"nm_diagnosa" => "",
						"keluhan" => "",
						"no_kunjungan" => "",
						"pem_fisik_lain" => "",
						"dinsos" => "",
						"iuran" => "",
						"no_sktm" => "",
						"prolanis_prb" => "",
						"kd_jenis_peserta" => "",
						"nm_jenis_peserta" => "",
						"kd_kelas" => "",
						"nm_kelas" => "",
						"nama" => "",
						"nik" => "",
						"no_kartu" => "",
						"norm" => "",
						"pisa" => "",
						"kd_cabang_prov_umum" => "",
						"kd_provider_prov_umum" => "",
						"nm_cabang_prov_umum" => "",
						"nm_provider_prov_umum" => "",
						"sex" => "",
						"status_peserta" => "",
						"kd_status_peserta" => "",
						"tgl_cetak_kartu" => "",
						"tgl_lahir" => "",
						"tgl_tat" => "",
						"tgl_tmt" => "",
						"umur" => "",
						"kd_poli_rujuk" => "",
						"nm_poli_rujuk" => "",
						"kd_cabang_prov_kunjungan" => "",
						"kd_provider_prov_kunjungan" => "",
						"nm_cabang_prov_kunjungan" => "",
						"nm_provider_prov_kunjungan" => "",
						"kd_cabang_prov_rujuk" => "",
						"kd_provider_prov_rujuk" => "",
						"nm_cabang_prov_rujuk" => "",
						"nm_provider_prov_rujuk" => "",
						"tgl_kunjungan" => "",
						"nm_pelayanan" => "",
						"tkt_pelayanan" => "",
						"nama_asuransi_cob" => "",
						"no_asuransi_cob" => "",
						"tgl_tat_cob" => "",
						"tgl_tmt_cob" => "",
						"no_telp" => "",
						"umur_saat_pelayanan" => "");
						
	} else if(!defined('ConsumerID') || !defined('ConsumerSecret')) {
		$return = array("metadata_code" => "92",
						"metadata_message" => "Consumer ID or Consumer Secret not found",
						"catatan" => "",
						"kd_diagnosa" => "",
						"nm_diagnosa" => "",
						"keluhan" => "",
						"no_kunjungan" => "",
						"pem_fisik_lain" => "",
						"dinsos" => "",
						"iuran" => "",
						"no_sktm" => "",
						"prolanis_prb" => "",
						"kd_jenis_peserta" => "",
						"nm_jenis_peserta" => "",
						"kd_kelas" => "",
						"nm_kelas" => "",
						"nama" => "",
						"nik" => "",
						"no_kartu" => "",
						"norm" => "",
						"pisa" => "",
						"kd_cabang_prov_umum" => "",
						"kd_provider_prov_umum" => "",
						"nm_cabang_prov_umum" => "",
						"nm_provider_prov_umum" => "",
						"sex" => "",
						"status_peserta" => "",
						"kd_status_peserta" => "",
						"tgl_cetak_kartu" => "",
						"tgl_lahir" => "",
						"tgl_tat" => "",
						"tgl_tmt" => "",
						"umur" => "",
						"kd_poli_rujuk" => "",
						"nm_poli_rujuk" => "",
						"kd_cabang_prov_kunjungan" => "",
						"kd_provider_prov_kunjungan" => "",
						"nm_cabang_prov_kunjungan" => "",
						"nm_provider_prov_kunjungan" => "",
						"kd_cabang_prov_rujuk" => "",
						"kd_provider_prov_rujuk" => "",
						"nm_cabang_prov_rujuk" => "",
						"nm_provider_prov_rujuk" => "",
						"tgl_kunjungan" => "",
						"nm_pelayanan" => "",
						"tkt_pelayanan" => "",
						"nama_asuransi_cob" => "",
						"no_asuransi_cob" => "",
						"tgl_tat_cob" => "",
						"tgl_tmt_cob" => "",
						"no_telp" => "",
						"umur_saat_pelayanan" => "");
	} else {
	
		list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
		
		if($jenisrequest == 'rs') {
			global $url_rujukan_rs;
			$urlrequest = $url_rujukan_rs;
		} else {
			global $url_rujukan_pcare;
			$urlrequest = $url_rujukan_pcare;
		}
		
		if($tiperequest == 'peserta') {
			$completeurl = $urlrequest.'Peserta/'.$varrequest;
		} else {
			$completeurl = $urlrequest.$varrequest;
		}
		
		$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
			
		$data = json_decode($response, true);
		$key = $cid . ConsumerSecret . $timestmp;
		$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);

		$metadata_message = $data['metaData']['message'];
		
		$return = array("metadata_code" => $data['metaData']['code'],
						"metadata_message" => $data['metaData']['message'],
						"catatan" => '',
						"kd_diagnosa" => $data_decrypt['rujukan']['diagnosa']['kode'],
						"nm_diagnosa" => $data_decrypt['rujukan']['diagnosa']['nama'],
						"keluhan" => $data_decrypt['rujukan']['keluhan'],
						"no_kunjungan" => $data_decrypt['rujukan']['noKunjungan'],
						"pem_fisik_lain" => '',
						"dinsos" => $data_decrypt['rujukan']['peserta']['informasi']['dinsos'],
						"iuran" => '',
						"no_sktm" => $data_decrypt['rujukan']['peserta']['informasi']['noSKTM'],
						"prolanis_prb" => $data_decrypt['rujukan']['peserta']['informasi']['prolanisPRB'],
						"kd_jenis_peserta" => $data_decrypt['rujukan']['peserta']['jenisPeserta']['kode'],
						"nm_jenis_peserta" => $data_decrypt['rujukan']['peserta']['jenisPeserta']['keterangan'],
						"kd_kelas" => $data_decrypt['rujukan']['peserta']['hakKelas']['kode'],
						"nm_kelas" => $data_decrypt['rujukan']['peserta']['hakKelas']['keterangan'],
						"nama" => $data_decrypt['rujukan']['peserta']['nama'],
						"nik" => $data_decrypt['rujukan']['peserta']['nik'],
						"no_kartu" => $data_decrypt['rujukan']['peserta']['noKartu'],
						"norm" => $data_decrypt['rujukan']['peserta']['mr']['noMR'],
						"pisa" => $data_decrypt['rujukan']['peserta']['pisa'],
						"kd_cabang_prov_umum" => '',
						"kd_provider_prov_umum" => $data_decrypt['rujukan']['peserta']['provUmum']['kdProvider'],
						"nm_cabang_prov_umum" => '',
						"nm_provider_prov_umum" => $data_decrypt['rujukan']['peserta']['provUmum']['nmProvider'],
						"sex" => $data_decrypt['rujukan']['peserta']['sex'],
						"status_peserta" => $data_decrypt['rujukan']['peserta']['statusPeserta']['keterangan'],
						"kd_status_peserta" => $data_decrypt['rujukan']['peserta']['statusPeserta']['kode'],
						"tgl_cetak_kartu" => $data_decrypt['rujukan']['peserta']['tglCetakKartu'],
						"tgl_lahir" => $data_decrypt['rujukan']['peserta']['tglLahir'],
						"tgl_tat" => $data_decrypt['rujukan']['peserta']['tglTAT'],
						"tgl_tmt" => $data_decrypt['rujukan']['peserta']['tglTMT'],
						"umur" => $data_decrypt['rujukan']['peserta']['umur']['umurSekarang'],
						"kd_poli_rujuk" => $data_decrypt['rujukan']['poliRujukan']['kode'],
						"nm_poli_rujuk" => $data_decrypt['rujukan']['poliRujukan']['nama'],
						"kd_cabang_prov_kunjungan" => '',
						"kd_provider_prov_kunjungan" => '',
						"nm_cabang_prov_kunjungan" => '',
						"nm_provider_prov_kunjungan" => '',
						"kd_cabang_prov_rujuk" => '',
						"kd_provider_prov_rujuk" => $data_decrypt['rujukan']['provPerujuk']['kode'],
						"nm_cabang_prov_rujuk" => '',
						"nm_provider_prov_rujuk" => $data_decrypt['rujukan']['provPerujuk']['nama'],
						"tgl_kunjungan" => $data_decrypt['rujukan']['tglKunjungan'],
						"nm_pelayanan" => $data_decrypt['rujukan']['pelayanan']['nama'],
						"tkt_pelayanan" => $data_decrypt['rujukan']['pelayanan']['kode'],
						"nama_asuransi_cob" => $data_decrypt['rujukan']['peserta']['cob']['nmAsuransi'],
						"no_asuransi_cob" => $data_decrypt['rujukan']['peserta']['cob']['noAsuransi'],
						"tgl_tat_cob" => $data_decrypt['rujukan']['peserta']['cob']['tglTAT'],
						"tgl_tmt_cob" => $data_decrypt['rujukan']['peserta']['cob']['tglTMT'],
						"no_telp" => $data_decrypt['rujukan']['peserta']['mr']['noTelepon'],
						"umur_saat_pelayanan" => $data_decrypt['rujukan']['peserta']['umur']['umurSaatPelayanan']);
	}

	$data_req = json_encode(
		array(
			"varrequest" => $varrequest,
			"tiperequest" => $tiperequest,
			"jenisrequest" => $jenisrequest
		)
	);

	log_data('vclaim_rujukan', $completeurl, $data_req, $metadata_message);
	
	return $return;
}

function apiVClaimListRujukanPCare($varrequest) {
	
	return apiVClaimLRujukan($varrequest, 'list', 'pcare');
}

function apiVClaimListRujukanRS($varrequest) {
	
	return apiVClaimLRujukan($varrequest, 'list', 'rs');
}

function apiVClaimTglRujukanPCare($varrequest) {
	
	return apiVClaimLRujukan($varrequest, 'tgl_rujukan', 'pcare');
}

function apiVClaimTglRujukanRS($varrequest) {
	
	return apiVClaimLRujukan($varrequest, 'tgl_rujukan', 'rs');
}

function apiVClaimLRujukan($varrequest, $tiperequest, $jenisrequest) {
	
	if(empty($varrequest) || $varrequest == '?') {
		$return = array("metadata_code" => "90",
						"metadata_message" => "Tidak ada parameter yang diinputkan",
						"count" => 0,
						"list" => "");
						
	} else if(!defined('ConsumerID') || !defined('ConsumerSecret')) {
		$return = array("metadata_code" => "92",
						"metadata_message" => "Consumer ID or Consumer Secret not found",
						"count" => 0,
						"list" => "");
	} else {
	
		list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
		
		if($tiperequest == 'list') {
			if($jenisrequest == 'rs') {
				global $url_list_rujukan_rs;
				$urlrequest = $url_list_rujukan_rs;
			} else {
				global $url_list_rujukan_pcare;
				$urlrequest = $url_list_rujukan_pcare;
			}
		} else {
			if($jenisrequest == 'rs') {
				global $url_tgl_rujukan_rs;
				$urlrequest = $url_tgl_rujukan_rs;
			} else {
				global $url_tgl_rujukan_pcare;
				$urlrequest = $url_tgl_rujukan_pcare;
			}
		}
		
		$completeurl = $urlrequest.$varrequest;
		
		$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
			
		$data = json_decode($response, true);
		$key = $cid . ConsumerSecret . $timestmp;
		$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
		
		$count = count($data_decrypt['rujukan']);
		
		$metadata_code = $data['metaData']['code'];
		$metadata_message = $data['metaData']['message'];
		
		$i = 0;
		$datarray = array();
		if($count > 0) {
			for ($i = 0; $i < $count; $i++){
				$datarray[$i]['kd_diagnosa'] = $data_decrypt['rujukan'][$i]['diagnosa']['kode'];
				$datarray[$i]['nm_diagnosa'] = $data_decrypt['rujukan'][$i]['diagnosa']['nama'];
				$datarray[$i]['keluhan'] = $data_decrypt['rujukan'][$i]['keluhan'];
				$datarray[$i]['no_kunjungan'] = $data_decrypt['rujukan'][$i]['noKunjungan'];
				$datarray[$i]['kode_pelayanan'] = $data_decrypt['rujukan'][$i]['pelayanan']['kode'];
				$datarray[$i]['nama_pelayanan'] = $data_decrypt['rujukan'][$i]['pelayanan']['nama'];
				$datarray[$i]['nama_asuransi_cob'] = $data_decrypt['rujukan'][$i]['peserta']['cob']['nmAsuransi'];
				$datarray[$i]['no_asuransi_cob'] = $data_decrypt['rujukan'][$i]['peserta']['cob']['noAsuransi'];
				$datarray[$i]['tgl_tat_cob'] = $data_decrypt['rujukan'][$i]['peserta']['cob']['tglTAT'];
				$datarray[$i]['tgl_tmt_cob'] = $data_decrypt['rujukan'][$i]['peserta']['cob']['tglTMT'];
				$datarray[$i]['nm_kelas'] = $data_decrypt['rujukan'][$i]['peserta']['hakKelas']['keterangan'];
				$datarray[$i]['kd_kelas'] = $data_decrypt['rujukan'][$i]['peserta']['hakKelas']['kode'];
				$datarray[$i]['dinsos'] = $data_decrypt['rujukan'][$i]['peserta']['informasi']['dinsos'];
				$datarray[$i]['no_sktm'] = $data_decrypt['rujukan'][$i]['peserta']['informasi']['noSKTM'];
				$datarray[$i]['prolanis_prb'] = $data_decrypt['rujukan'][$i]['peserta']['informasi']['prolanisPRB'];
				$datarray[$i]['nm_jenis_peserta'] = $data_decrypt['rujukan'][$i]['peserta']['jenisPeserta']['keterangan'];
				$datarray[$i]['kd_jenis_peserta'] = $data_decrypt['rujukan'][$i]['peserta']['jenisPeserta']['kode'];
				$datarray[$i]['norm'] = $data_decrypt['rujukan'][$i]['peserta']['mr']['noMR'];
				$datarray[$i]['no_telp'] = $data_decrypt['rujukan'][$i]['peserta']['mr']['noTelepon'];
				$datarray[$i]['nama'] = $data_decrypt['rujukan'][$i]['peserta']['nama'];
				$datarray[$i]['nik'] = $data_decrypt['rujukan'][$i]['peserta']['nik'];
				$datarray[$i]['no_kartu'] = $data_decrypt['rujukan'][$i]['peserta']['noKartu'];
				$datarray[$i]['pisa'] = $data_decrypt['rujukan'][$i]['peserta']['pisa'];
				$datarray[$i]['kd_provider_prov_umum'] = $data_decrypt['rujukan'][$i]['peserta']['provUmum']['kdProvider'];
				$datarray[$i]['nm_provider_prov_umum'] = $data_decrypt['rujukan'][$i]['peserta']['provUmum']['nmProvider'];
				$datarray[$i]['sex'] = $data_decrypt['rujukan'][$i]['peserta']['sex'];
				$datarray[$i]['status_peserta'] = $data_decrypt['rujukan'][$i]['peserta']['statusPeserta']['keterangan'];
				$datarray[$i]['kd_status_peserta'] = $data_decrypt['rujukan'][$i]['peserta']['statusPeserta']['kode'];
				$datarray[$i]['tgl_cetak_kartu'] = $data_decrypt['rujukan'][$i]['peserta']['tglCetakKartu'];
				$datarray[$i]['tgl_lahir'] = $data_decrypt['rujukan'][$i]['peserta']['tglLahir'];
				$datarray[$i]['tgl_tat'] = $data_decrypt['rujukan'][$i]['peserta']['tglTAT'];
				$datarray[$i]['tgl_tmt'] = $data_decrypt['rujukan'][$i]['peserta']['tglTMT'];
				$datarray[$i]['umur_saat_pelayanan'] = $data_decrypt['rujukan'][$i]['peserta']['umur']['umurSaatPelayanan'];
				$datarray[$i]['umur'] = $data_decrypt['rujukan'][$i]['peserta']['umur']['umurSekarang'];
				$datarray[$i]['kd_poli_rujuk'] = $data_decrypt['rujukan'][$i]['poliRujukan']['kode'];
				$datarray[$i]['nm_poli_rujuk'] = $data_decrypt['rujukan'][$i]['poliRujukan']['nama'];
				$datarray[$i]['kd_provider_prov_rujuk'] = $data_decrypt['rujukan'][$i]['provPerujuk']['kode'];
				$datarray[$i]['nm_provider_prov_rujuk'] = $data_decrypt['rujukan'][$i]['provPerujuk']['nama'];
				$datarray[$i]['tgl_kunjungan'] = $data_decrypt['rujukan'][$i]['tglKunjungan'];
			}
		}
		
		$return_data = array(
			'metadata_code'=>$metadata_code,
			'metadata_message'=>$metadata_message,
			'count'=>$count,
			'list'=>$datarray
		);

		$data_req = json_encode(
			array(
				"varrequest" => $varrequest,
				"tiperequest" => $tiperequest,
				"jenisrequest" => $jenisrequest
			)
		);

		log_data('apiVClaimLRujukan', $completeurl, $data_req, $metadata_message);
		
		return $return_data;
	}
	
	return $return;
}

function apiVClaimInsertRujukan($no_sep, $tgl_rujukan, $ppk_dirujuk, $jenis_pelayanan, $catatan, $diagnosa_rujukan, $tipe_rujukan, $poli_rujukan, $user) {
	global $url_insert_rujukan;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);

	$urlrequest = $url_insert_rujukan;
	
	$request = array('request'=>
					array('t_rujukan'=>
						array('noSep' => $no_sep,
							  'tglRujukan' => $tgl_rujukan,
							  'ppkDirujuk' => $ppk_dirujuk,
							  'jnsPelayanan' => $jenis_pelayanan,
							  'catatan' => $catatan,
							  'diagRujukan' => $diagnosa_rujukan,
							  'tipeRujukan' => $tipe_rujukan,
							  'poliRujukan' => $poli_rujukan,
							  'user'=>$user
						)
					)
				);
	
	$jsonrequest = json_encode($request);
	
	$reqmethod = 'post';
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);

	$metadata_code = '';
	$metadata_message = '';
	$kode_asal_rujukan = '';
	$nama_asal_rujukan = '';
	$kode_diagnosa = '';
	$nama_diagnosa = '';
	$no_rujukan = '';
	$asuransi = '';
	$hak_kelas = '';
	$jenis_peserta = '';
	$kelamin = '';
	$nama = '';
	$no_kartu = '';
	$norm = '';
	$tgl_lahir = '';
	$kode_poli_tujuan = '';
	$nama_poli_tujuan = '';
	$tgl_rujukan = '';
	$kode_tujuan_rujukan = '';
	$nama_tujuan_rujukan = '';
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	if($metadata_code == 200) {
		$kode_asal_rujukan = $data_decrypt['rujukan']['AsalRujukan']['kode'];
		$nama_asal_rujukan = $data_decrypt['rujukan']['AsalRujukan']['nama'];
		$kode_diagnosa = $data_decrypt['rujukan']['diagnosa']['kode'];
		$nama_diagnosa = $data_decrypt['rujukan']['diagnosa']['nama'];
		$no_rujukan = $data_decrypt['rujukan']['noRujukan'];
		$asuransi = $data_decrypt['rujukan']['peserta']['asuransi'];
		$hak_kelas = $data_decrypt['rujukan']['peserta']['hakKelas'];
		$jenis_peserta = $data_decrypt['rujukan']['peserta']['jnsPeserta'];
		$kelamin = $data_decrypt['rujukan']['peserta']['kelamin'];
		$nama = $data_decrypt['rujukan']['peserta']['nama'];
		$no_kartu = $data_decrypt['rujukan']['peserta']['noKartu'];
		$norm = $data_decrypt['rujukan']['peserta']['noMr'];
		$tgl_lahir = $data_decrypt['rujukan']['peserta']['tglLahir'];
		$kode_poli_tujuan = $data_decrypt['rujukan']['poliTujuan']['kode'];
		$nama_poli_tujuan = $data_decrypt['rujukan']['poliTujuan']['nama'];
		$tgl_rujukan = $data_decrypt['rujukan']['tglRujukan'];
		$kode_tujuan_rujukan = $data_decrypt['rujukan']['tujuanRujukan']['kode'];
		$nama_tujuan_rujukan = $data_decrypt['rujukan']['tujuanRujukan']['nama'];
	}
	
	$return_data = array(
		'metadata_code' => $metadata_code,
		'metadata_message' => $metadata_message,
		'kode_asal_rujukan' => $kode_asal_rujukan,
		'nama_asal_rujukan' => $nama_asal_rujukan,
		'kode_diagnosa' => $kode_diagnosa,
		'nama_diagnosa' => $nama_diagnosa,
		'no_rujukan' => $no_rujukan,
		'asuransi' => $asuransi,
		'hak_kelas' => $hak_kelas,
		'jenis_peserta' => $jenis_peserta,
		'kelamin' => $kelamin,
		'nama' => $nama,
		'no_kartu' => $no_kartu,
		'norm' => $norm,
		'tgl_lahir' => $tgl_lahir,
		'kode_poli_tujuan' => $kode_poli_tujuan,
		'nama_poli_tujuan' => $nama_poli_tujuan,
		'tgl_rujukan' => $tgl_rujukan,
		'kode_tujuan_rujukan' => $kode_tujuan_rujukan,
		'nama_tujuan_rujukan' => $nama_tujuan_rujukan
	);
	$hasil = json_encode($return_data);
	log_data('apiVClaimInsertRujukan', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimUpdateRujukan($no_rujukan, $ppk_dirujuk, $tipe, $jenis_pelayanan, $catatan, $diagnosa_rujukan, $tipe_rujukan, $poli_rujukan, $user) {
	global $url_update_rujukan;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
		
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$urlrequest = $url_update_rujukan;
	
	$request = array('request'=>
					array('t_rujukan'=>
						array('noRujukan' => $no_rujukan,
							  'ppkDirujuk' => $ppk_dirujuk,
							  'tipe' => $tipe,
							  'jnsPelayanan' => $jenis_pelayanan,
							  'catatan' => $catatan,
							  'diagRujukan' => $diagnosa_rujukan,
							  'tipeRujukan' => $tipe_rujukan,
							  'poliRujukan' => $poli_rujukan,
							  'user' => $user
						)
					)
				);
	
	$jsonrequest = json_encode($request);

	$reqmethod = 'put';
	
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$response = null;
	$metadata_code = null;
	$metadata_message = null;
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	$response = $data_decrypt;
	
	$return_data = array(
		'metadata_code' => $metadata_code,
		'metadata_message' => $metadata_message,
		'response' => $response
	);
	$hasil = json_encode($return_data);
	log_data('apiVClaimUpdateRujukan', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimHapusRujukan($no_rujukan, $user) {
	global $url_delete_rujukan;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
		
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$urlrequest = $url_delete_rujukan;
	
	$request = array('request'=>
					array('t_rujukan'=>
						array('noRujukan' => $no_rujukan,
							  'user' => $user
						)
					)
			   );
	
	$jsonrequest = json_encode($request);

	$reqmethod = 'delete';
	
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$metadata_code = null;
	$metadata_message = null;
	$response = null;
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	$response = $data_decrypt;
	
	$return_data = array(
		'metadata_code' => $metadata_code,
		'metadata_message' => $metadata_message,
		'response' => $response
	);
	$hasil = json_encode($return_data);

	log_data('apiVClaimHapusRujukan', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

//insert PRB
function apiVClaimInsertPRB($no_sep, $no_kartu, $alamat, $email, $program_prb, $dpjp, $keterangan, $saran, $user, $limit_obat, $kode_obat1, $kode_obat2, $kode_obat3, $kode_obat4, $kode_obat5, $kode_obat6, $kode_obat7, $kode_obat8, $kode_obat9, $kode_obat10, $kode_obat11, $kode_obat12, $kode_obat13, $kode_obat14, $kode_obat15, $kode_obat16, $kode_obat17, $kode_obat18, $kode_obat19, $kode_obat20, $kode_obat21, $kode_obat22, $kode_obat23, $kode_obat24, $kode_obat25, $kode_obat26, $kode_obat27, $kode_obat28, $kode_obat29, $kode_obat30,  $signa1_1, $signa1_2, $signa1_3, $signa1_4, $signa1_5, $signa1_6, $signa1_7, $signa1_8, $signa1_9, $signa1_10, $signa1_11, $signa1_12, $signa1_13, $signa1_14, $signa1_15, $signa1_16, $signa1_17, $signa1_18, $signa1_19, $signa1_20, $signa1_21, $signa1_22, $signa1_23, $signa1_24, $signa1_25, $signa1_26, $signa1_27, $signa1_28, $signa1_29, $signa1_30,  $signa2_1, $signa2_2, $signa2_3, $signa2_4, $signa2_5, $signa2_6, $signa2_7, $signa2_8, $signa2_9, $signa2_10, $signa2_11, $signa2_12, $signa2_13, $signa2_14, $signa2_15, $signa2_16, $signa2_17, $signa2_18, $signa2_19, $signa2_20, $signa2_21, $signa2_22, $signa2_23, $signa2_24, $signa2_25, $signa2_26, $signa2_27, $signa2_28, $signa2_29, $signa2_30, $jml_obat1, $jml_obat2, $jml_obat3, $jml_obat4, $jml_obat5, $jml_obat6, $jml_obat7, $jml_obat8, $jml_obat9, $jml_obat10, $jml_obat11, $jml_obat12, $jml_obat13, $jml_obat14, $jml_obat15, $jml_obat16, $jml_obat17, $jml_obat18, $jml_obat19, $jml_obat20, $jml_obat21, $jml_obat22, $jml_obat23, $jml_obat24, $jml_obat25, $jml_obat26, $jml_obat27, $jml_obat28, $jml_obat29, $jml_obat30) {
	global $url_insert_prb;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$obat = array();
	for($i=1; $i <= $limit_obat; $i++) {
		
		$dataObat = array('kdObat' => ${'kode_obat' . $i},
						  'signa1' => ${'signa1' . $i},
						  'signa2' => ${'signa2' . $i},
						  'jmlObat' => ${'jml_obat' . $i} );
		
		array_push($obat, $dataObat);
	}
	

	$urlrequest = $url_insert_prb;
                                                    
    $request = 	array('request' =>
					array('t_prb' =>
						array('noSep' => $no_sep,
							  'noKartu' => $no_kartu,
							  'alamat'  => $alamat,
							  'email' => $email,
							  'programPRB' => $program_prb,
							  'kodeDPJP' => $dpjp,
							  'keterangan' =>$keterangan,
							  'saran' => $saran,
							  'user' => $user,
							  'obat' => $obat )
					)
				);                
    
	$jsonrequest = json_encode($request);
	
	$reqmethod = 'post';
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$metadata_code = '';
	$metadata_message = '';
	$response = '';
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	if($metadata_code == 200) {
		$response = $data_decrypt;
	}
	
	$return_data = array(
		'metadata_code' => $metadata_code,
		'metadata_message' => $metadata_message,
		'response' => $response
	);
	$hasil = json_encode($return_data);

	log_data('apiVClaimInsertPRB', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}



function apiVClaimInsertLPK($no_sep, $tgl_masuk, $tgl_keluar, $jaminan, $poli, $ruang_rawat_perawatan, $kelas_rawat_perawatan, $spesialistik_perawatan, $cara_keluar_perawatan,$kondisi_pulang_perawatan, $limit_diagnosa, $limit_prosedur, $kode_diagnosa1, $kode_diagnosa2, $kode_diagnosa3, $kode_diagnosa4, $kode_diagnosa5, $kode_diagnosa6, $kode_diagnosa7, $kode_diagnosa8, $kode_diagnosa9, $kode_diagnosa10, $kode_diagnosa11, $kode_diagnosa12, $kode_diagnosa13, $kode_diagnosa14, $kode_diagnosa15, $kode_diagnosa16, $kode_diagnosa17, $kode_diagnosa18, $kode_diagnosa19, $kode_diagnosa20, $kode_diagnosa21, $kode_diagnosa22, $kode_diagnosa23, $kode_diagnosa24, $kode_diagnosa25, $kode_diagnosa26, $kode_diagnosa27, $kode_diagnosa28, $kode_diagnosa29, $kode_diagnosa30, $kode_prosedur1, $kode_prosedur2, $kode_prosedur3, $kode_prosedur4, $kode_prosedur5, $kode_prosedur6, $kode_prosedur7, $kode_prosedur8, $kode_prosedur9, $kode_prosedur10, $kode_prosedur11, $kode_prosedur12, $kode_prosedur13, $kode_prosedur14, $kode_prosedur15, $kode_prosedur16, $kode_prosedur17, $kode_prosedur18, $kode_prosedur19, $kode_prosedur20, $kode_prosedur21, $kode_prosedur22, $kode_prosedur23, $kode_prosedur24, $kode_prosedur25, $kode_prosedur26, $kode_prosedur27, $kode_prosedur28, $kode_prosedur29, $kode_prosedur30, $tindak_lanjut, $kode_ppkrencanadirujuk, $tgl_rencanakontrolkembali, $poli_rencanakontrolkembali, $dpjp, $user) {
	global $url_insert_lpk;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$diagnosa = array();
	for($i=1; $i <= $limit_diagnosa; $i++) {
		if($i == 1) {
			$dataDiagnosa = array('kode' => ${'kode_diagnosa' . $i},
								  'Level' => "1"
							);
		} else {
			$dataDiagnosa = array('kode' => ${'kode_diagnosa' . $i},
								  'Level' => "2"
							);
		}
		
		array_push($diagnosa, $dataDiagnosa);
	}
	
	//looping prosedur
	$prosedur = array();
	for($i=1; $i <= $limit_prosedur; $i++) {
		$dataProsedur = array('kode' => ${'kode_prosedur' . $i});
		array_push($prosedur, $dataProsedur);
	}

	$urlrequest = $url_insert_lpk;
	
	$request = array('request'=>
					array('t_lpk'=>
						array('noSep' => $no_sep,
							  'tglMasuk' => $tgl_masuk,
							  'tglKeluar' => $tgl_keluar,
							  'jaminan' => $jaminan,
							  'poli' => array('poli' => $poli),
							  'perawatan' => array('ruangRawat' => $ruang_rawat_perawatan,
												   'kelasRawat' => $kelas_rawat_perawatan,
												   'spesialistik' => $spesialistik_perawatan,
												   'caraKeluar' => $cara_keluar_perawatan,
												   'kondisiPulang' => $kondisi_pulang_perawatan),
							  'diagnosa' => $diagnosa,
							  'procedure' => $prosedur,
							  'rencanaTL' => array('tindakLanjut' => $tindak_lanjut,
												   'dirujukKe' => array('kodePPK' => $kode_ppkrencanadirujuk),
												   'kontrolKembali' => array('tglKontrol' => $tgl_rencanakontrolkembali,
																			 'poli' => $poli_rencanakontrolkembali)),
							  'DPJP' => $dpjp,
							  'user'=> $user
						)
					)
				);
	
	$jsonrequest = json_encode($request);
	
	$reqmethod = 'post';
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$metadata_code = '';
	$metadata_message = '';
	$response = '';
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	if($metadata_code == 200) {
		$response = $data_decrypt;
	}
	
	$return_data = array(
		'metadata_code' => $metadata_code,
		'metadata_message' => $metadata_message,
		'response' => $response
	);
	$hasil = json_encode($return_data);

	log_data('apiVClaimInsertLPK', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimUpdateLPK($no_sep, $tgl_masuk, $tgl_keluar, $jaminan, $poli, $ruang_rawat_perawatan, $kelas_rawat_perawatan, $spesialistik_perawatan, $cara_keluar_perawatan,$kondisi_pulang_perawatan, $limit_diagnosa, $limit_prosedur, $kode_diagnosa1, $kode_diagnosa2, $kode_diagnosa3, $kode_diagnosa4, $kode_diagnosa5, $kode_diagnosa6, $kode_diagnosa7, $kode_diagnosa8, $kode_diagnosa9, $kode_diagnosa10, $kode_diagnosa11, $kode_diagnosa12, $kode_diagnosa13, $kode_diagnosa14, $kode_diagnosa15, $kode_diagnosa16, $kode_diagnosa17, $kode_diagnosa18, $kode_diagnosa19, $kode_diagnosa20, $kode_diagnosa21, $kode_diagnosa22, $kode_diagnosa23, $kode_diagnosa24, $kode_diagnosa25, $kode_diagnosa26, $kode_diagnosa27, $kode_diagnosa28, $kode_diagnosa29, $kode_diagnosa30, $kode_prosedur1, $kode_prosedur2, $kode_prosedur3, $kode_prosedur4, $kode_prosedur5, $kode_prosedur6, $kode_prosedur7, $kode_prosedur8, $kode_prosedur9, $kode_prosedur10, $kode_prosedur11, $kode_prosedur12, $kode_prosedur13, $kode_prosedur14, $kode_prosedur15, $kode_prosedur16, $kode_prosedur17, $kode_prosedur18, $kode_prosedur19, $kode_prosedur20, $kode_prosedur21, $kode_prosedur22, $kode_prosedur23, $kode_prosedur24, $kode_prosedur25, $kode_prosedur26, $kode_prosedur27, $kode_prosedur28, $kode_prosedur29, $kode_prosedur30, $tindak_lanjut, $kode_ppkrencanadirujuk, $tgl_rencanakontrolkembali, $poli_rencanakontrolkembali, $dpjp, $user) {
	global $url_update_lpk;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
		
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$diagnosa = array();
	for($i=1; $i <= $limit_diagnosa; $i++) {
		if($i == 1) {
			$dataDiagnosa = array('kode' => ${'kode_diagnosa' . $i},
								  'Level' => "1"
							);
		} else {
			$dataDiagnosa = array('kode' => ${'kode_diagnosa' . $i},
								  'Level' => "2"
							);
		}
		
		array_push($diagnosa, $dataDiagnosa);
	}
	
	//looping prosedur
	$prosedur = array();
	for($i=1; $i <= $limit_prosedur; $i++) {
		$dataProsedur = array('kode' => ${'kode_prosedur' . $i});
		array_push($prosedur, $dataProsedur);
	}
	
	$urlrequest = $url_update_lpk;
	
	$request = array('request'=>
					array('t_lpk'=>
						array('noSep' => $no_sep,
							  'tglMasuk' => $tgl_masuk,
							  'tglKeluar' => $tgl_keluar,
							  'jaminan' => $jaminan,
							  'poli' => array('poli' => $poli),
							  'perawatan' => array('ruangRawat' => $ruang_rawat_perawatan,
												   'kelasRawat' => $kelas_rawat_perawatan,
												   'spesialistik' => $spesialistik_perawatan,
												   'caraKeluar' => $cara_keluar_perawatan,
												   'kondisiPulang' => $kondisi_pulang_perawatan),
							  'diagnosa' => $diagnosa,
							  'procedure' => $prosedur,
							  'rencanaTL' => array('tindakLanjut' => $tindak_lanjut,
												   'dirujukKe' => array('kodePPK' => $kode_ppkrencanadirujuk),
												   'kontrolKembali' => array('tglKontrol' => $tgl_rencanakontrolkembali,
																			 'poli' => $poli_rencanakontrolkembali)),
							  'DPJP' => $dpjp,
							  'user'=> $user
						)
					)
				);
	
	$jsonrequest = json_encode($request);

	$reqmethod = 'put';
	
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$response = '';
	$metadata_code = '';
	$metadata_message = '';
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	if($metadata_code == 200) {
		$response = $data_decrypt;
	}
	
	$return_data = array(
		'metadata_code' => $metadata_code,
		'metadata_message' => $metadata_message,
		'response' => $response
	);
	$hasil = json_encode($return_data);

	log_data('apiVClaimUpdateLPK', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimHapusLPK($no_sep) {
	global $url_delete_lpk;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
		
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$urlrequest = $url_delete_lpk;
	
	$request = array('request' =>
					array('t_lpk' =>
						array('noSep' => $no_sep)
					)
			   );
	
	$jsonrequest = json_encode($request);

	$reqmethod = 'delete';
	
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$metadata_code = '';
	$metadata_message = '';
	$response = '';
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	if($metadata_code == 200) {
		$response = $data_decrypt;
	}
	
	$return_data = array(
		'metadata_code' => $metadata_code,
		'metadata_message' => $metadata_message,
		'response' => $response
	);
	$hasil = json_encode($return_data);

	log_data('apiVClaimHapusLPK', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimDataLPK($tgl_masuk, $jenis_pelayanan) {
	global $url_data_lpk;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_data_lpk.'tglMasuk/'.$tgl_masuk.'/JnsPelayanan/'.$jenis_pelayanan;
	
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$count_lpk = count($data['lpk']['list']);
	
	$i = 0;
	$datarray = array();
	
	for ($i = 0; $i < $count_lpk; $i++){
		$datarray[$i]['kode_dokter_dpjp'] = $data_decrypt['lpk']['list'][$i]['Inacbg']['kdInacbg'];
		$datarray[$i]['nama_dokter_dpjp'] = $data_decrypt['lpk']['list'][$i]['Inacbg']['kdSeverity'];
		$datarray[$i]['count_diagnosa'] = count($data_decrypt['lpk']['list'][$i]['diagnosa']['list']);
		for ($j = 0; $j < $datarray[$i]['count_diagnosa']; $j++){
			$datarray[$i]['diagnosa'][$j]['level'] = $data_decrypt['lpk']['list'][$i]['diagnosa']['list'][$j]['level'];
			$datarray[$i]['diagnosa'][$j]['kode_diagnosa'] = $data_decrypt['lpk']['list'][$i]['diagnosa']['list'][$j]['list']['kode'];
			$datarray[$i]['diagnosa'][$j]['nama_diagnosa'] = $data_decrypt['lpk']['list'][$i]['diagnosa']['list'][$j]['list']['nama'];
		}
		$datarray[$i]['jenis_pelayanan'] = $data_decrypt['lpk']['list'][$i]['jnsPelayanan'];
		$datarray[$i]['no_sep'] = $data_decrypt['lpk']['list'][$i]['noSep'];
		$datarray[$i]['kode_carakeluar'] = $data_decrypt['lpk']['list'][$i]['perawatan']['caraKeluar']['kode'];
		$datarray[$i]['nama_carakeluar'] = $data_decrypt['lpk']['list'][$i]['perawatan']['caraKeluar']['nama'];
		$datarray[$i]['kode_kelasrawat'] = $data_decrypt['lpk']['list'][$i]['perawatan']['kelasRawat']['kode'];
		$datarray[$i]['nama_kelasrawat'] = $data_decrypt['lpk']['list'][$i]['perawatan']['kelasRawat']['nama'];
		$datarray[$i]['kode_kondisipulang'] = $data_decrypt['lpk']['list'][$i]['perawatan']['kondisiPulang']['kode'];
		$datarray[$i]['nama_kondisipulang'] = $data_decrypt['lpk']['list'][$i]['perawatan']['kondisiPulang']['nama'];
		$datarray[$i]['kode_ruangrawat'] = $data_decrypt['lpk']['list'][$i]['perawatan']['ruangRawat']['kode'];
		$datarray[$i]['nama_ruangrawat'] = $data_decrypt['lpk']['list'][$i]['perawatan']['ruangRawat']['nama'];
		$datarray[$i]['kode_spesialistik'] = $data_decrypt['lpk']['list'][$i]['perawatan']['spesialistik']['kode'];
		$datarray[$i]['nama_spesialistik'] = $data_decrypt['lpk']['list'][$i]['perawatan']['spesialistik']['nama'];
		$datarray[$i]['kelamin'] = $data_decrypt['lpk']['list'][$i]['peserta']['kelamin'];
		$datarray[$i]['nama'] = $data_decrypt['lpk']['list'][$i]['peserta']['nama'];
		$datarray[$i]['no_kartu'] = $data_decrypt['lpk']['list'][$i]['peserta']['noKartu'];
		$datarray[$i]['norm'] = $data_decrypt['lpk']['list'][$i]['peserta']['noMR'];
		$datarray[$i]['tgl_lahir'] = $data_decrypt['lpk']['list'][$i]['peserta']['tglLahir'];
		$datarray[$i]['poli_eksekutif'] = $data_decrypt['lpk']['list'][$i]['poli']['eksekutif'];
		$datarray[$i]['kode_poli'] = $data_decrypt['lpk']['list'][$i]['poli']['poli']['kode'];
		$datarray[$i]['count_prosedur'] = count($data_decrypt['lpk']['list'][$i]['procedure']['list']);
		for ($j = 0; $j < $datarray[$i]['count_prosedur']; $j++){
			$datarray[$i]['prosedur'][$j]['kode_prosedur'] = $data_decrypt['lpk']['list'][$i]['procedure']['list'][$j]['list']['kode'];
			$datarray[$i]['prosedur'][$j]['nama_prosedur'] = $data_decrypt['lpk']['list'][$i]['procedure']['list'][$j]['list']['nama'];
		}
		$datarray[$i]['rencana_tl'] = $data_decrypt['lpk']['list'][$i]['rencanaTL'];
		$datarray[$i]['tgl_keluar'] = $data_decrypt['lpk']['list'][$i]['tglKeluar'];
		$datarray[$i]['tgl_masuk'] = $data_decrypt['lpk']['list'][$i]['tglMasuk'];
	}
	
	$return_data = array
	(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count_lpk'=>$count_lpk,
		'list'=>$datarray
	);

	$data_req = json_encode(
		array(
			"tgl_masuk" => $tgl_masuk,
			"jenis_pelayanan" => $jenis_pelayanan
		)
	);

	log_data('apiVClaimDataLPK', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVClaimDataKunjungan($tanggal, $jenis_pelayanan) {
	global $url_data_kunjungan;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_data_kunjungan.'Tanggal/'.$tanggal.'/JnsPelayanan/'.$jenis_pelayanan;
	
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$count = count($data_decrypt['sep']);
	
	$i = 0;
	$datarray = array();
	
	for ($i = 0; $i < $count; $i++){
		$datarray[$i]['diagnosa'] = $data_decrypt['sep'][$i]['diagnosa'];
		$datarray[$i]['jenis_pelayanan'] = $data_decrypt['sep'][$i]['jnsPelayanan'];
		$datarray[$i]['kelas_rawat'] = $data_decrypt['sep'][$i]['kelasRawat'];
		$datarray[$i]['nama'] = $data_decrypt['sep'][$i]['nama'];
		$datarray[$i]['no_kartu'] = $data_decrypt['sep'][$i]['noKartu'];
		$datarray[$i]['no_sep'] = $data_decrypt['sep'][$i]['noSep'];
		$datarray[$i]['poli'] = $data_decrypt['sep'][$i]['poli'];
		$datarray[$i]['tgl_pulangsep'] = $data_decrypt['sep'][$i]['tglPlgSep'];
		$datarray[$i]['tgl_sep'] = $data_decrypt['sep'][$i]['tglSep'];
	}
	
	$return_data = array
	(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	$data_req = json_encode(
		array(
			"tanggal" => $tanggal,
			"jenis_pelayanan" => $jenis_pelayanan
		)
	);

	log_data('apiVClaimDataKunjungan', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVClaimDataKlaim($tgl_pulang, $jenis_pelayanan, $status_klaim) {
	global $url_data_klaim;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_data_klaim.'Tanggal/'.$tgl_pulang.'/JnsPelayanan/'.$jenis_pelayanan.'/Status/'.$status_klaim;
	
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$count = count($data_decrypt['klaim']);
	
	$i = 0;
	$datarray = array();
	
	for ($i = 0; $i < $count; $i++){
		$datarray[$i]['kode_inacbg'] = $data_decrypt['klaim'][$i]['Inacbg']['kode'];
		$datarray[$i]['nama_inacbg'] = $data_decrypt['klaim'][$i]['Inacbg']['nama'];
		$datarray[$i]['biaya_pengajuan'] = $data_decrypt['klaim'][$i]['biaya']['byPengajuan'];
		$datarray[$i]['biaya_setujui'] = $data_decrypt['klaim'][$i]['biaya']['bySetujui'];
		$datarray[$i]['biaya_tarifgrouper'] = $data_decrypt['klaim'][$i]['biaya']['byTarifGruper'];
		$datarray[$i]['biaya_tarifrs'] = $data_decrypt['klaim'][$i]['biaya']['byTarifRS'];
		$datarray[$i]['biaya_topup'] = $data_decrypt['klaim'][$i]['biaya']['byTopup'];
		$datarray[$i]['kelas_rawat'] = $data_decrypt['klaim'][$i]['kelasRawat'];
		$datarray[$i]['no_fpk'] = $data_decrypt['klaim'][$i]['noFPK'];
		$datarray[$i]['no_sep'] = $data_decrypt['klaim'][$i]['noSEP'];
		$datarray[$i]['nama'] = $data_decrypt['klaim'][$i]['peserta']['nama'];
		$datarray[$i]['no_kartu'] = $data_decrypt['klaim'][$i]['peserta']['noKartu'];
		$datarray[$i]['norm'] = $data_decrypt['klaim'][$i]['peserta']['noMR'];
		$datarray[$i]['poli'] = $data_decrypt['klaim'][$i]['poli'];
		$datarray[$i]['status'] = $data_decrypt['klaim'][$i]['status'];
		$datarray[$i]['tgl_pulang'] = $data_decrypt['klaim'][$i]['tglPulang'];
		$datarray[$i]['tgl_sep'] = $data_decrypt['klaim'][$i]['tglSep'];
	}
	
	$return_data = array
	(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	$data_req = json_encode(
		array(
			"tgl_pulang" => $tgl_pulang,
			"jenis_pelayanan" => $jenis_pelayanan,
			"status_klaim" => $status_klaim
		)
	);

	log_data('apiVClaimDataKlaim', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVClaimDataLayananPeserta($no_kartu, $tgl_mulai, $tgl_akhir) {
	global $url_data_histori_lyn;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	if(is_null($no_kartu) && $no_kartu == '' && is_null($tgl_mulai) && $tgl_mulai == '' && is_null($tgl_akhir) && $tgl_akhir == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'Nomor Peserta, Tanggal Mulai dan Tanggal Akhir harus diisi',
			'count'=>0,
			'list'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_data_histori_lyn.'NoKartu/'.$no_kartu.'/tglAwal/'.$tgl_mulai.'/tglAkhir/'.$tgl_akhir;
	
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$count = count($data_decrypt['histori']);
	
	$i = 0;
	$datarray = array();
	
	for ($i = 0; $i < $count; $i++){
		$datarray[$i]['diagnosa'] = $data_decrypt['histori'][$i]['diagnosa'];
		$datarray[$i]['jenis_pelayanan'] = $data_decrypt['histori'][$i]['jnsPelayanan'];
		$datarray[$i]['kelas_rawat'] = $data_decrypt['histori'][$i]['kelasRawat'];
		$datarray[$i]['nama'] = $data_decrypt['histori'][$i]['namaPeserta'];
		$datarray[$i]['no_kartu'] = $data_decrypt['histori'][$i]['noKartu'];
		$datarray[$i]['no_sep'] = $data_decrypt['histori'][$i]['noSep'];
		$datarray[$i]['no_rujukan'] = $data_decrypt['histori'][$i]['noRujukan'];
		$datarray[$i]['poli'] = $data_decrypt['histori'][$i]['poli'];
		$datarray[$i]['ppk_pelayanan'] = $data_decrypt['histori'][$i]['ppkPelayanan'];
		$datarray[$i]['tgl_pulangsep'] = $data_decrypt['histori'][$i]['tglPlgSep'];
		$datarray[$i]['tgl_sep'] = $data_decrypt['histori'][$i]['tglSep'];
	}
	
	$return_data = array
	(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	$data_req = json_encode(
		array(
			"no_kartu" => $no_kartu,
			"tgl_mulai" => $tgl_mulai,
			"tgl_akhir" => $tgl_akhir
		)
	);

	log_data('apiVClaimDataLayananPeserta', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVClaimDataJaminanJR($tgl_mulai, $tgl_akhir) {
	global $url_data_klaimjr;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	if(is_null($tgl_mulai) && $tgl_mulai == '' && is_null($tgl_akhir) && $tgl_akhir == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'Tanggal Mulai dan Tanggal Akhir harus diisi',
			'count'=>0,
			'list'=>''
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_data_klaimjr.'tglMulai/'.$tgl_mulai.'/tglAkhir/'.$tgl_akhir;
	
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$count = count($data_decrypt['jaminan']);
	
	$i = 0;
	$datarray = array();
	
	for ($i = 0; $i < $count; $i++){
		$datarray[$i]['no_sep'] = $data_decrypt['jaminan'][$i]['sep']['noSEP'];
		$datarray[$i]['tgl_sep'] = $data_decrypt['jaminan'][$i]['sep']['tglSEP'];
		$datarray[$i]['tgl_pulangsep'] = $data_decrypt['jaminan'][$i]['sep']['tglPlgSEP'];
		$datarray[$i]['norm'] = $data_decrypt['jaminan'][$i]['sep']['noMR'];
		$datarray[$i]['jenis_pelayanan'] = $data_decrypt['jaminan'][$i]['sep']['jnsPelayanan'];
		$datarray[$i]['poli'] = $data_decrypt['jaminan'][$i]['sep']['poli'];
		$datarray[$i]['diagnosa'] = $data_decrypt['jaminan'][$i]['sep']['diagnosa'];
		$datarray[$i]['no_kartu'] = $data_decrypt['jaminan'][$i]['sep']['peserta']['noKartu'];
		$datarray[$i]['nama'] = $data_decrypt['jaminan'][$i]['sep']['peserta']['nama'];
		$datarray[$i]['norm_peserta'] = $data_decrypt['jaminan'][$i]['sep']['peserta']['noMR'];
		$datarray[$i]['tgl_kejadian'] = $data_decrypt['jaminan'][$i]['jasaRaharja']['tglKejadian'];
		$datarray[$i]['nomor_register'] = $data_decrypt['jaminan'][$i]['jasaRaharja']['noRegister'];
		$datarray[$i]['ket_statusdijamin'] = $data_decrypt['jaminan'][$i]['jasaRaharja']['ketStatusDijamin'];
		$datarray[$i]['ket_statusdikirim'] = $data_decrypt['jaminan'][$i]['jasaRaharja']['ketStatusDikirim'];
		$datarray[$i]['biaya_dijamin'] = $data_decrypt['jaminan'][$i]['jasaRaharja']['biayaDijamin'];
		$datarray[$i]['plafon'] = $data_decrypt['jaminan'][$i]['jasaRaharja']['plafon'];
		$datarray[$i]['jumlah_dibayar'] = $data_decrypt['jaminan'][$i]['jasaRaharja']['jmlDibayar'];
		$datarray[$i]['resultjr'] = $data_decrypt['jaminan'][$i]['jasaRaharja']['resultsJasaRaharja'];
	}
	
	$return_data = array
	(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$datarray
	);

	$data_req = json_encode(
		array(
			"tgl_mulai" => $tgl_mulai,
			"tgl_akhir" => $tgl_akhir
		)
	);

	log_data('apiVClaimDataJaminanJR', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVClaimInsertRencanaKontrol($nosep, $kodedokter, $polikontrol, $tglrencanakontrol, $user) {
	global $url_insert_rencana_kontrol;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	$urlrequest = $url_insert_rencana_kontrol;
	
	$request = array('request'=>
					array('noSEP' => $nosep,
						  'kodeDokter' => $kodedokter,
						  'poliKontrol' => $polikontrol,
						  'tglRencanaKontrol' => $tglrencanakontrol,
						  'user' => $user
					)
				);
	
	$jsonrequest = json_encode($request);

	$reqmethod = 'post';
	
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
		
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$metadata_code = '';
	$metadata_message = '';
	$nosuratkontrol = '';
	$tglrencanakontrol = '';
	$namadokter = '';
	$nokartu = '';
	$nama = '';
	$kelamin = '';
	$tgllahir = '';

	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	
	if($metadata_code == 200) {
		$nosuratkontrol = $data_decrypt['noSuratKontrol'];
		$tglrencanakontrol = $data_decrypt['tglRencanaKontrol'];
		$namadokter = $data_decrypt['namaDokter'];
		$nokartu = $data_decrypt['noKartu'];
		$nama = $data_decrypt['nama'];
		$kelamin = $data_decrypt['kelamin'];
		$tgllahir = $data_decrypt['tglLahir'];
	}
	
	$return_data = array(
		'metadata_code' => $metadata_code,
		'metadata_message' => $metadata_message,
		'nosuratkontrol' => $nosuratkontrol,
		'tglrencanakontrol' => $tglrencanakontrol,
		'namadokter' => $namadokter,
		'nokartu' => $nokartu,
		'nama' => $nama,
		'kelamin' => $kelamin,
		'tgllahir' => $tgllahir,
	);
	$hasil = json_encode($return_data);
	log_data('apiVClaimInsertRencanaKontrol', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
	
}

function apiVClaimUpdateRencanaKontrol($nosuratkontrol, $nosep, $kodedokter, $polikontrol, $tglrencanakontrol, $user) {
	global $url_update_rencana_kontrol;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	$urlrequest = $url_update_rencana_kontrol;
	
	$request = array('request'=>
					array('noSuratKontrol' => $nosuratkontrol,
						  'noSEP' => $nosep,
						  'kodeDokter' => $kodedokter,
						  'poliKontrol' => $polikontrol,
						  'tglRencanaKontrol' => $tglrencanakontrol,
						  'user' => $user
					)
				);
	
	$jsonrequest = json_encode($request);

	$reqmethod = 'put';
	
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$metadata_code = '';
	$metadata_message = '';
	$nosuratkontrol = '';
	$tglrencanakontrol = '';
	$namadokter = '';
	$nokartu = '';
	$nama = '';
	$kelamin = '';
	$tgllahir = '';

	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	
	if($metadata_code == 200) {
		$nosuratkontrol = $data_decrypt['noSuratKontrol'];
		$tglrencanakontrol = $data_decrypt['tglRencanaKontrol'];
		$namadokter = $data_decrypt['namaDokter'];
		$nokartu = $data_decrypt['noKartu'];
		$nama = $data_decrypt['nama'];
		$kelamin = $data_decrypt['kelamin'];
		$tgllahir = $data_decrypt['tglLahir'];
	}
	
	$return_data = array(
		'metadata_code' => $metadata_code,
		'metadata_message' => $metadata_message,
		'nosuratkontrol' => $nosuratkontrol,
		'tglrencanakontrol' => $tglrencanakontrol,
		'namadokter' => $namadokter,
		'nokartu' => $nokartu,
		'nama' => $nama,
		'kelamin' => $kelamin,
		'tgllahir' => $tgllahir,
	);
	$hasil = json_encode($return_data);

	log_data('apiVClaimUpdateRencanaKontrol', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimHapusRencanaKontrol($noSuratKontrol, $user) {
	global $url_delete_rencana_kontrol;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	$urlrequest = $url_delete_rencana_kontrol;
	
	$request = array('request'=>
					array('t_suratkontrol' => 
						array('noSuratKontrol' => $noSuratKontrol,
							  'user' => $user
						)
					)
				);
				
	$jsonrequest = json_encode($request);
	
	$reqmethod = 'delete';
	
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$response = '';
	$metadata_code = '';
	$metadata_message = '';
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	if($metadata_code == 200) {
		$response = $data_decrypt;
	}
	
	$return_data = array(
		'metadata_code' => $metadata_code,
		'metadata_message' => $metadata_message,
		'response' => $response
	);
	$hasil = json_encode($return_data);

	log_data('apiVClaimHapusRencanaKontrol', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;	
}

function apiVClaimCariSuratKontrol($noSuratKontrol) {
	global $url_cari_surat_kontrol;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	if(is_null($noSuratKontrol) && $noSuratKontrol == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'Nomor surat kontrol harus diisi',
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_cari_surat_kontrol.$noSuratKontrol;
	
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$metadata_code = '';
	$metadata_message = '';
	$no_suratkontrol = '';
	$tglrencanakontrol = '';
	$tglterbit = '';
	$jnskontrol = '';
	$politujuan = '';
	$namapolitujuan = '';
	$kodedokter = '';
	$namadokter = '';
	$flagkontrol = '';
	$kodedokterpembuat = '';
	$namadokterpembuat = '';
	$namajnskontrol = '';
	$nosep = '';
	$tglsep = '';
	$jnspelayanan = '';
	$poli = '';
	$diagnosa = '';
	$nokartu = '';
	$nama = '';
	$tgllahir = '';
	$kelamin = '';
	$hakkelas = '';
	$kdprovider = '';
	$nmprovider = '';
	$kdproviderperujuk = '';
	$nmproviderperujuk = '';
	$asalrujukan = '';
	$norujukan = '';
	$tglrujukan = '';
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	
	if($metadata_code == 200) {
		$no_suratkontrol = $data_decrypt['noSuratKontrol'];
		$tglrencanakontrol = $data_decrypt['tglRencanaKontrol'];
		$tglterbit = $data_decrypt['tglTerbit'];
		$jnskontrol = $data_decrypt['jnsKontrol'];
		$politujuan = $data_decrypt['poliTujuan'];
		$namapolitujuan = $data_decrypt['namaPoliTujuan'];
		$kodedokter = $data_decrypt['kodeDokter'];
		$namadokter = $data_decrypt['namaDokter'];
		$flagkontrol = $data_decrypt['flagKontrol'];
		$kodedokterpembuat = $data_decrypt['kodeDokterPembuat'];
		$namadokterpembuat = $data_decrypt['namaDokterPembuat'];
		$namajnskontrol = $data_decrypt['namaJnsKontrol'];

		$nosep = $data_decrypt['sep']['noSep'];
		$tglsep = $data_decrypt['sep']['tglSep'];
		$jnspelayanan = $data_decrypt['sep']['jnsPelayanan'];
		$poli = $data_decrypt['sep']['poli'];
		$diagnosa = $data_decrypt['sep']['diagnosa'];
		$nokartu = $data_decrypt['sep']['peserta']['noKartu'];
		$nama = $data_decrypt['sep']['peserta']['nama'];
		$tgllahir = $data_decrypt['sep']['peserta']['tglLahir'];
		$kelamin = $data_decrypt['sep']['peserta']['kelamin'];
		$hakkelas = $data_decrypt['sep']['peserta']['hakKelas'];
		$kdprovider = $data_decrypt['sep']['provUmum']['kdProvider'];
		$nmprovider = $data_decrypt['sep']['provUmum']['nmProvider'];

		$kdproviderperujuk = $data_decrypt['sep']['provPerujuk']['kdProviderPerujuk'];
		$nmproviderperujuk = $data_decrypt['sep']['provPerujuk']['nmProviderPerujuk'];
		$asalrujukan = $data_decrypt['sep']['provPerujuk']['asalRujukan'];
		$norujukan = $data_decrypt['sep']['provPerujuk']['noRujukan'];
		$tglrujukan = $data_decrypt['sep']['provPerujuk']['tglRujukan'];
	}
	
	$return_data = array(
		'metadata_code' => $metadata_code,
		'metadata_message' => $metadata_message,
		'no_suratkontrol' => $no_suratkontrol, 
		'tglrencanakontrol' => $tglrencanakontrol,
		'tglterbit' => $tglterbit,
		'jnskontrol' => $jnskontrol,
		'politujuan' => $politujuan,
		'namapolitujuan' => $namapolitujuan,
		'kodedokter' => $kodedokter,
		'namadokter' => $namadokter,
		'flagkontrol' => $flagkontrol,
		'kodedokterpembuat' => $kodedokterpembuat,
		'namadokterpembuat' => $namadokterpembuat,
		'namajnskontrol' => $namajnskontrol,
		'nosep' => $nosep,
		'tglsep' => $tglsep,
		'jnspelayanan' => $jnspelayanan,
		'poli' => $poli,
		'diagnosa' => $diagnosa , 
		'nokartu' => $nokartu , 
		'nama' => $nama,
		'tgllahir' => $tgllahir,
		'kelamin' => $kelamin ,
		'hakkelas' => $hakkelas,
		'kdprovider' => $kdprovider,
		'nmprovider' => $nmprovider,
		'kdproviderperujuk' => $kdproviderperujuk,
		'nmproviderperujuk' => $nmproviderperujuk,
		'asalrujukan' => $asalrujukan,
		'norujukan' => $norujukan,
		'tglrujukan' => $tglrujukan,
	);

	$data_req = json_encode(
		array(
			"noSuratKontrol" => $noSuratKontrol
		)
	);

	log_data('apiVClaimCariSuratKontrol', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVclaimInsertSPRI($nokartu, $kodedokter, $polikontrol, $tglrencanakontrol, $user) {
	global $url_insert_spri;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	$urlrequest = $url_insert_spri;
	
	$request = array('request'=>
					array('noKartu' => $nokartu,
						  'kodeDokter' => $kodedokter,
						  'poliKontrol' => $polikontrol,
						  'tglRencanaKontrol' => $tglrencanakontrol,
						  'user' => $user
					)
				);
	
	$jsonrequest = json_encode($request);

	$reqmethod = 'post';
	
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$metadata_code = '';
	$metadata_message = '';
	$nospri = '';
	$tglrencanakontrol = '';
	$namadokter = '';
	$nokartu = '';
	$nama = '';
	$kelamin = '';
	$tgllahir = '';
	$namadiagnosa = '';
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	
	if($metadata_code == 200) {
		$nospri = $data_decrypt['noSPRI'];
		$tglrencanakontrol = $data_decrypt['tglRencanaKontrol'];
		$namadokter = $data_decrypt['namaDokter'];
		$nokartu = $data_decrypt['noKartu'];
		$nama = $data_decrypt['nama'];
		$kelamin = $data_decrypt['kelamin'];
		$tgllahir = $data_decrypt['tglLahir'];
		$namadiagnosa = $data_decrypt['namaDiagnosa'];
	}
	
	$return_data = array(
		'metadata_code' => $metadata_code,
		'metadata_message' => $metadata_message,
		'nospri' => $nospri,
		'tglrencanakontrol' => $tglrencanakontrol,
		'namadokter' => $namadokter,
		'nokartu' => $nokartu,
		'nama' => $nama,
		'kelamin' => $kelamin,
		'tgllahir' => $tgllahir,
		'namadiagnosa' => $namadiagnosa
	);
	$hasil = json_encode($return_data);

	log_data('apiVclaimInsertSPRI', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVclaimUpdateSPRI($nospri, $kodedokter, $polikontrol, $tglrencanakontrol, $user) {
	global $url_update_spri;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	$urlrequest = $url_update_spri;
	
	$request = array('request'=>
					array('noSPRI' => $nospri,
						  'kodeDokter' => $kodedokter,
						  'poliKontrol' => $polikontrol,
						  'tglRencanaKontrol' => $tglrencanakontrol,
						  'user' => $user
					)
				);
	
	$jsonrequest = json_encode($request);

	$reqmethod = 'put';
	
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$metadata_code = '';
	$metadata_message = '';
	$nospri = '';
	$tglrencanakontrol = '';
	$namadokter = '';
	$nokartu = '';
	$nama = '';
	$kelamin = '';
	$tgllahir = '';
	$namadiagnosa = '';
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	
	if($metadata_code == 200) {
		$nospri = $data_decrypt['noSPRI'];
		$tglrencanakontrol = $data_decrypt['tglRencanaKontrol'];
		$namadokter = $data_decrypt['namaDokter'];
		$nokartu = $data_decrypt['noKartu'];
		$nama = $data_decrypt['nama'];
		$kelamin = $data_decrypt['kelamin'];
		$tgllahir = $data_decrypt['tglLahir'];
		$namadiagnosa = $data_decrypt['namaDiagnosa'];
	}
	
	$return_data = array(
		'metadata_code' => $metadata_code,
		'metadata_message' => $metadata_message,
		'nospri' => $nospri,
		'tglrencanakontrol' => $tglrencanakontrol,
		'namadokter' => $namadokter,
		'nokartu' => $nokartu,
		'nama' => $nama,
		'kelamin' => $kelamin,
		'tgllahir' => $tgllahir,
		'namadiagnosa' => $namadiagnosa
	);
	$hasil = json_encode($return_data);

	log_data('apiVclaimUpdateSPRI', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimSEPRencanaKontrol($nosep) {
	global $url_sep_rencana_kontrol;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	if(is_null($nosep) && $nosep == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'Nomor SEP harus diisi',
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_sep_rencana_kontrol.$nosep;
	
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$metadata_code = '';
	$metadata_message = '';
	$nosep = '';
	$tglsep = '';
	$jnspelayanan = '';
	$poli = '';
	$diagnosa = '';
	$nokartu = '';
	$nama = '';
	$tgllahir = '';
	$kelamin = '';
	$hakkelas = '';
	$kdprovider = '';
	$namaprovider = '';
	$kdproviderperujuk = '';
	$nmproviderperujuk = '';
	$asalrujukan = '';
	$norujukan = '';
	$tglrujukan = '';
	
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	if($metadata_code == 200) {
		$nosep = $data_decrypt['noSep'];
		$tglsep = $data_decrypt['tglSep'];
		$jnspelayanan = $data_decrypt['jnsPelayanan'];
		$poli = $data_decrypt['poli'];
		$diagnosa = $data_decrypt['diagnosa'];
		$nokartu = $data_decrypt['peserta']['noKartu'];
		$nama = $data_decrypt['peserta']['nama'];
		$tgllahir = $data_decrypt['peserta']['tglLahir'];
		$kelamin = $data_decrypt['peserta']['kelamin'];
		$hakkelas = $data_decrypt['peserta']['hakKelas'];
		
		$kdprovider = $data_decrypt['provUmum']['kdProvider'];
		$namaprovider = $data_decrypt['provUmum']['nmProvider'];

		$kdproviderperujuk = $data_decrypt['provPerujuk']['kdProviderPerujuk'];
		$nmproviderperujuk = $data_decrypt['provPerujuk']['nmProviderPerujuk'];
		$asalrujukan = $data_decrypt['provPerujuk']['asalRujukan'];
		$norujukan = $data_decrypt['provPerujuk']['noRujukan'];
		$tglrujukan = $data_decrypt['provPerujuk']['tglRujukan'];


	}
	
	$return_data = array(
		'metadata_code' => $metadata_code,
		'metadata_message' => $metadata_message,
		'nosep' => $nosep,
		'tglsep' => $tglsep,
		'jnspelayanan' => $jnspelayanan,
		'poli' => $poli,
		'diagnosa' => $diagnosa,
		'nokartu' => $nokartu,
		'nama' => $nama,
		'tgllahir' => $tgllahir,
		'kelamin' => $kelamin,
		'hakkelas' => $hakkelas,
		'kdprovider' => $kdprovider,
		'namaprovider' => $namaprovider,
		'kdproviderperujuk' => $kdproviderperujuk,
		'nmproviderperujuk' => $nmproviderperujuk,
		'asalrujukan' => $asalrujukan,
		'norujukan' => $norujukan,
		'tglrujukan' => $tglrujukan,
	);

	$data_req = json_encode(
		array(
			"nosep" => $nosep
		)
	);

	log_data('apiVClaimSEPRencanaKontrol', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}	

function apiVClaimDataRencanaKontrol($tglawal, $tglakhir, $filter) {
	global $url_list_rencana_kontrol;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	if(is_null($tglawal) && $tglawal == '' && is_null($tglakhir) && $tglakhir == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'Tanggal awal dan tanggal akhir harus diisi',
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_list_rencana_kontrol.'tglAwal/'.$tglawal.'/tglAkhir/'.$tglakhir.'/filter/'.$filter;
	
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['list']);
		
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$i = 0;
	$data_arr = array();
	if($count > 0) {
		for($i=0;$i<$count;$i++) {
			$data_arr[$i]['noSuratKontrol'] = $data_decrypt['list'][$i]['noSuratKontrol'];
			$data_arr[$i]['jnsPelayanan'] = $data_decrypt['list'][$i]['jnsPelayanan'];
			$data_arr[$i]['jnsKontrol'] = $data_decrypt['list'][$i]['jnsKontrol'];
			$data_arr[$i]['namaJnsKontrol'] = $data_decrypt['list'][$i]['namaJnsKontrol'];
			$data_arr[$i]['tglRencanaKontrol'] = $data_decrypt['list'][$i]['tglRencanaKontrol'];
			$data_arr[$i]['tglTerbitKontrol'] = $data_decrypt['list'][$i]['tglTerbitKontrol'];
			$data_arr[$i]['noSepAsalKontrol'] = $data_decrypt['list'][$i]['noSepAsalKontrol'];
			$data_arr[$i]['poliAsal'] = $data_decrypt['list'][$i]['poliAsal'];
			$data_arr[$i]['namaPoliAsal'] = $data_decrypt['list'][$i]['namaPoliAsal'];
			$data_arr[$i]['poliTujuan'] = $data_decrypt['list'][$i]['poliTujuan'];
			$data_arr[$i]['namaPoliTujuan'] = $data_decrypt['list'][$i]['namaPoliTujuan'];
			$data_arr[$i]['tglSEP'] = $data_decrypt['list'][$i]['tglSEP'];
			$data_arr[$i]['kodeDokter'] = $data_decrypt['list'][$i]['kodeDokter'];
			$data_arr[$i]['namaDokter'] = $data_decrypt['list'][$i]['namaDokter'];
			$data_arr[$i]['noKartu'] = $data_decrypt['list'][$i]['noKartu'];
			$data_arr[$i]['nama'] = $data_decrypt['list'][$i]['nama'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$data_arr
	);

	$data_req = json_encode(
		array(
			"tglawal" => $tglawal,
			"tglakhir" => $tglakhir,
			"filter" => $filter
		)
	);

	log_data('apiVClaimDataRencanaKontrol', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

//UPDATE 2022-03-24
function apiVClaimDataRencanaKontrolByNoKartu($bulan, $tahun, $nokartu, $filter) {
	global $url_list_rencana_kontrol;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	if(is_null($bulan) && $bulan == '' && is_null($tahun) && $tahun == '' && is_null($nokartu) && $nokartu == '' && is_null($filter) && $filter == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'Parameter harus lengkap',
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_list_rencana_kontrol.'Bulan/'.$bulan.'/Tahun/'.$tahun.'/Nokartu/'.$nokartu.'/filter/'.$filter;
	
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['list']);
		
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$i = 0;
	$data_arr = array();
	if($count > 0) {
		for($i=0;$i<$count;$i++) {
			$data_arr[$i]['noSuratKontrol'] = $data_decrypt['list'][$i]['noSuratKontrol'];
			$data_arr[$i]['jnsPelayanan'] = $data_decrypt['list'][$i]['jnsPelayanan'];
			$data_arr[$i]['jnsKontrol'] = $data_decrypt['list'][$i]['jnsKontrol'];
			$data_arr[$i]['namaJnsKontrol'] = $data_decrypt['list'][$i]['namaJnsKontrol'];
			$data_arr[$i]['tglRencanaKontrol'] = $data_decrypt['list'][$i]['tglRencanaKontrol'];
			$data_arr[$i]['tglTerbitKontrol'] = $data_decrypt['list'][$i]['tglTerbitKontrol'];
			$data_arr[$i]['noSepAsalKontrol'] = $data_decrypt['list'][$i]['noSepAsalKontrol'];
			$data_arr[$i]['poliAsal'] = $data_decrypt['list'][$i]['poliAsal'];
			$data_arr[$i]['namaPoliAsal'] = $data_decrypt['list'][$i]['namaPoliAsal'];
			$data_arr[$i]['poliTujuan'] = $data_decrypt['list'][$i]['poliTujuan'];
			$data_arr[$i]['namaPoliTujuan'] = $data_decrypt['list'][$i]['namaPoliTujuan'];
			$data_arr[$i]['tglSEP'] = $data_decrypt['list'][$i]['tglSEP'];
			$data_arr[$i]['kodeDokter'] = $data_decrypt['list'][$i]['kodeDokter'];
			$data_arr[$i]['namaDokter'] = $data_decrypt['list'][$i]['namaDokter'];
			$data_arr[$i]['noKartu'] = $data_decrypt['list'][$i]['noKartu'];
			$data_arr[$i]['nama'] = $data_decrypt['list'][$i]['nama'];
			$data_arr[$i]['terbitSEP'] = $data_decrypt['list'][$i]['terbitSEP'];

		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$data_arr
	);

	$data_req = json_encode(
		array(
			"bulan" => $bulan,
			"tahun" => $tahun,
			"nokartu" => $nokartu,
			"filter" => $filter
		)
	);

	log_data('apiVClaimDataRencanaKontrolByNoKartu', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVClaimDokterRencanaKontrol($jnskontrol, $kdpoli, $tglrencanakontrol) {
	global $url_dokter_rencana_kontrol;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_dokter_rencana_kontrol.'jnsKontrol/'.$jnskontrol.'/kdPoli/'.$kdpoli.'/tglRencanaKontrol/'.$tglrencanakontrol;
	
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['list']);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$i = 0;
	$data_arr = array();
	if($count > 0) {
		for($i=0;$i<$count;$i++) {
			$data_arr[$i]['kodeDokter'] = $data_decrypt['list'][$i]['kodeDokter'];
			$data_arr[$i]['namaDokter'] = $data_decrypt['list'][$i]['namaDokter'];
			$data_arr[$i]['jadwalPraktek'] = $data_decrypt['list'][$i]['jadwalPraktek'];
			$data_arr[$i]['kapasitas'] = $data_decrypt['list'][$i]['kapasitas'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$data_arr
	);

	$data_req = json_encode(
		array(
			"jnskontrol" => $jnskontrol,
			"kdpoli" => $kdpoli,
			"tglrencanakontrol" => $tglrencanakontrol
		)
	);

	log_data('apiVClaimDokterRencanaKontrol', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVClaimPoliRencanaKontrol($jnskontrol, $nomor, $tglrencanakontrol) {
	global $url_poli_rencana_kontrol;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	if($jnskontrol == '1' && (strlen($nomor) != '13' || strlen($nomor) != 13)) {
		return array(
			'metadata_message'=>'Nomor kartu tidak sesuai',
			'metadata_code'=>'90'
		);
	}
	
	if($jnskontrol == '2' && (strlen($nomor) < '19' || strlen($nomor) < 19)) {
		return array(
			'metadata_message'=>'Nomor SEP tidak sesuai',
			'metadata_code'=>'90'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_poli_rencana_kontrol.'jnsKontrol/'.$jnskontrol.'/nomor/'.$nomor.'/tglRencanaKontrol/'.$tglrencanakontrol;
	
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['list']);
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$i = 0;
	$data_arr = array();
	if($count > 0) {
		for($i=0;$i<$count;$i++) {
			$data_arr[$i]['kodePoli'] = $data_decrypt['list'][$i]['kodePoli'];
			$data_arr[$i]['namaPoli'] = $data_decrypt['list'][$i]['namaPoli'];
			$data_arr[$i]['kapasitas'] = $data_decrypt['list'][$i]['kapasitas'];			 
			$data_arr[$i]['jmlRencanaKontroldanRujukan'] = $data_decrypt['list'][$i]['jmlRencanaKontroldanRujukan'];
			$data_arr[$i]['persentase'] = $data_decrypt['list'][$i]['persentase'];
		}
	}
		
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$data_arr
	);

	$data_req = json_encode(
		array(
			"jnskontrol" => $jnskontrol,
			"nomor" => $nomor,
			"tglrencanakontrol" => $tglrencanakontrol
		)
	);

	log_data('apiVClaimPoliRencanaKontrol', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVClaimInsertRujukan2($no_sep, $tgl_rujukan, $tgl_rencana_kunjungan, $ppk_dirujuk, $jenis_pelayanan, $catatan, $diagnosa_rujukan, $tipe_rujukan, $poli_rujukan, $user) {
	global $url_insert_rujukan2;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);

	$urlrequest = $url_insert_rujukan2;
	
	$request = array('request'=>
					array('t_rujukan'=>
						array('noSep' => $no_sep,
							  'tglRujukan' => $tgl_rujukan,
							  'tglRencanaKunjungan' => $tgl_rencana_kunjungan,
							  'ppkDirujuk' => $ppk_dirujuk,
							  'jnsPelayanan' => $jenis_pelayanan,
							  'catatan' => $catatan,
							  'diagRujukan' => $diagnosa_rujukan,
							  'tipeRujukan' => $tipe_rujukan,
							  'poliRujukan' => $poli_rujukan,
							  'user'=>$user
						)
					)
				);
	
	$jsonrequest = json_encode($request);
	
	$reqmethod = 'post';
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);

	$metadata_code = '';
	$metadata_message = '';
	$kode_asal_rujukan = '';
	$nama_asal_rujukan = '';
	$kode_diagnosa = '';
	$nama_diagnosa = '';
	$no_rujukan = '';
	$asuransi = '';
	$hak_kelas = '';
	$jenis_peserta = '';
	$kelamin = '';
	$nama = '';
	$no_kartu = '';
	$norm = '';
	$tgl_lahir = '';
	$kode_poli_tujuan = '';
	$nama_poli_tujuan = '';
	$tgl_berlaku_kunjungan = '';
	$tgl_rencana_kunjungan = '';
	$tgl_rujukan = '';
	$kode_tujuan_rujukan = '';
	$nama_tujuan_rujukan = '';
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	if($metadata_code == 200) {
		$kode_asal_rujukan = $data_decrypt['rujukan']['AsalRujukan']['kode'];
		$nama_asal_rujukan = $data_decrypt['rujukan']['AsalRujukan']['nama'];
		$kode_diagnosa = $data_decrypt['rujukan']['diagnosa']['kode'];
		$nama_diagnosa = $data_decrypt['rujukan']['diagnosa']['nama'];
		$no_rujukan = $data_decrypt['rujukan']['noRujukan'];
		$asuransi = $data_decrypt['rujukan']['peserta']['asuransi'];
		$hak_kelas = $data_decrypt['rujukan']['peserta']['hakKelas'];
		$jenis_peserta = $data_decrypt['rujukan']['peserta']['jnsPeserta'];
		$kelamin = $data_decrypt['rujukan']['peserta']['kelamin'];
		$nama = $data_decrypt['rujukan']['peserta']['nama'];
		$no_kartu = $data_decrypt['rujukan']['peserta']['noKartu'];
		$norm = $data_decrypt['rujukan']['peserta']['noMr'];
		$tgl_lahir = $data_decrypt['rujukan']['peserta']['tglLahir'];
		$kode_poli_tujuan = $data_decrypt['rujukan']['poliTujuan']['kode'];
		$nama_poli_tujuan = $data_decrypt['rujukan']['poliTujuan']['nama'];
		$tgl_berlaku_kunjungan = $data_decrypt['rujukan']['tglBerlakuKunjungan'];
		$tgl_rencana_kunjungan = $data_decrypt['rujukan']['tglRencanaKunjungan'];
		$tgl_rujukan = $data_decrypt['rujukan']['tglRujukan'];
		$kode_tujuan_rujukan = $data_decrypt['rujukan']['tujuanRujukan']['kode'];
		$nama_tujuan_rujukan = $data_decrypt['rujukan']['tujuanRujukan']['nama'];
	}
	
	$return_data = array(
		'metadata_code' => $metadata_code,
		'metadata_message' => $metadata_message,
		'kode_asal_rujukan' => $kode_asal_rujukan,
		'nama_asal_rujukan' => $nama_asal_rujukan,
		'kode_diagnosa' => $kode_diagnosa,
		'nama_diagnosa' => $nama_diagnosa,
		'no_rujukan' => $no_rujukan,
		'asuransi' => $asuransi,
		'hak_kelas' => $hak_kelas,
		'jenis_peserta' => $jenis_peserta,
		'kelamin' => $kelamin,
		'nama' => $nama,
		'no_kartu' => $no_kartu,
		'norm' => $norm,
		'tgl_lahir' => $tgl_lahir,
		'kode_poli_tujuan' => $kode_poli_tujuan,
		'nama_poli_tujuan' => $nama_poli_tujuan,
		'tgl_rujukan' => $tgl_rujukan,
		'kode_tujuan_rujukan' => $kode_tujuan_rujukan,
		'nama_tujuan_rujukan' => $nama_tujuan_rujukan
	);
	$hasil = json_encode($return_data);

	log_data('apiVClaimInsertRujukan2', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimUpdateRujukan2($no_rujukan, $tgl_rujukan, $tgl_rencana_kunjungan, $ppk_dirujuk, $jenis_pelayanan, $catatan, $diagnosa_rujukan, $tipe_rujukan, $poli_rujukan, $user) {
	global $url_update_rujukan2;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
		
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$urlrequest = $url_update_rujukan2;
	
	$request = array('request'=>
					array('t_rujukan'=>
						array('noRujukan' => $no_rujukan,
							  'tglRujukan' => $tgl_rujukan,
							  'tglRencanaKunjungan' => $tgl_rencana_kunjungan,	
							  'ppkDirujuk' => $ppk_dirujuk,
							  'jnsPelayanan' => $jenis_pelayanan,
							  'catatan' => $catatan,
							  'diagRujukan' => $diagnosa_rujukan,
							  'tipeRujukan' => $tipe_rujukan,
							  'poliRujukan' => $poli_rujukan,
							  'user' => $user
						)
					)
				);
	
	$jsonrequest = json_encode($request);

	$reqmethod = 'put';
	
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$metadata_code = '';
	$metadata_message = '';
	$kode_asal_rujukan = '';
	$nama_asal_rujukan = '';
	$kode_diagnosa = '';
	$nama_diagnosa = '';
	$no_rujukan = '';
	$asuransi = '';
	$hak_kelas = '';
	$jenis_peserta = '';
	$kelamin = '';
	$nama = '';
	$no_kartu = '';
	$norm = '';
	$tgl_lahir = '';
	$kode_poli_tujuan = '';
	$nama_poli_tujuan = '';
	$tgl_berlaku_kunjungan = '';
	$tgl_rencana_kunjungan = '';
	$tgl_rujukan = '';
	$kode_tujuan_rujukan = '';
	$nama_tujuan_rujukan = '';
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	if($metadata_code == 200) {
		$kode_asal_rujukan = $data_decrypt['rujukan']['AsalRujukan']['kode'];
		$nama_asal_rujukan = $data_decrypt['rujukan']['AsalRujukan']['nama'];
		$kode_diagnosa = $data_decrypt['rujukan']['diagnosa']['kode'];
		$nama_diagnosa = $data_decrypt['rujukan']['diagnosa']['nama'];
		$no_rujukan = $data_decrypt['rujukan']['noRujukan'];
		$asuransi = $data_decrypt['rujukan']['peserta']['asuransi'];
		$hak_kelas = $data_decrypt['rujukan']['peserta']['hakKelas'];
		$jenis_peserta = $data_decrypt['rujukan']['peserta']['jnsPeserta'];
		$kelamin = $data_decrypt['rujukan']['peserta']['kelamin'];
		$nama = $data_decrypt['rujukan']['peserta']['nama'];
		$no_kartu = $data_decrypt['rujukan']['peserta']['noKartu'];
		$norm = $data_decrypt['rujukan']['peserta']['noMr'];
		$tgl_lahir = $data_decrypt['rujukan']['peserta']['tglLahir'];
		$kode_poli_tujuan = $data_decrypt['rujukan']['poliTujuan']['kode'];
		$nama_poli_tujuan = $data_decrypt['rujukan']['poliTujuan']['nama'];
		$tgl_berlaku_kunjungan = $data_decrypt['rujukan']['tglBerlakuKunjungan'];
		$tgl_rencana_kunjungan = $data_decrypt['rujukan']['tglRencanaKunjungan'];
		$tgl_rujukan = $data_decrypt['rujukan']['tglRujukan'];
		$kode_tujuan_rujukan = $data_decrypt['rujukan']['tujuanRujukan']['kode'];
		$nama_tujuan_rujukan = $data_decrypt['rujukan']['tujuanRujukan']['nama'];
	}
	
	$return_data = array(
		'metadata_code' => $metadata_code,
		'metadata_message' => $metadata_message,
		'kode_asal_rujukan' => $kode_asal_rujukan,
		'nama_asal_rujukan' => $nama_asal_rujukan,
		'kode_diagnosa' => $kode_diagnosa,
		'nama_diagnosa' => $nama_diagnosa,
		'no_rujukan' => $no_rujukan,
		'asuransi' => $asuransi,
		'hak_kelas' => $hak_kelas,
		'jenis_peserta' => $jenis_peserta,
		'kelamin' => $kelamin,
		'nama' => $nama,
		'no_kartu' => $no_kartu,
		'norm' => $norm,
		'tgl_lahir' => $tgl_lahir,
		'kode_poli_tujuan' => $kode_poli_tujuan,
		'nama_poli_tujuan' => $nama_poli_tujuan,
		'tgl_rujukan' => $tgl_rujukan,
		'kode_tujuan_rujukan' => $kode_tujuan_rujukan,
		'nama_tujuan_rujukan' => $nama_tujuan_rujukan
	);
	$hasil = json_encode($return_data);

	log_data('apiVClaimUpdateRujukan2', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimInsertRujukanKhusus($no_rujukan, $kode_diagnosa, $kode_prosedur, $user) {
	global $url_insert_rujukan_khusus;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);

	$urlrequest = $url_insert_rujukan_khusus;

	$var=explode(',',$kode_diagnosa);
	$kode = array();
	foreach($var as $row)
		{
		$kode[] = array('kode' => $row);
		}
		
	$var_p=explode(',',$kode_prosedur);
	$kodep = array();
	foreach($var_p as $row_p)
		{
		$kodep[] = array('kode' => $row_p);
		}
	// var_dump($kode);die();
	$request = array('noRujukan' => $no_rujukan,
					  'diagnosa' => $kode,
					  'procedure' => $kodep,
					  'user'=>$user
				);
	
	
	$jsonrequest = json_encode($request);
	// print_r($jsonrequest);die();
	$reqmethod = 'post';
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);

	$metadata_code = '';
	$metadata_message = '';
	$norujukan = '';
	$nokapst = '';
	$nmpst = '';
	$diagppk = '';
	$tglrujukan_awal = '';
	$tglrujukan_berakhir= '';
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	if($metadata_code == 200) {
		$norujukan = $data_decrypt['rujukan']['norujukan'];
		$nokapst = $data_decrypt['rujukan']['nokapst'];
		$nmpst = $data_decrypt['rujukan']['nmpst'];
		$diagppk = $data_decrypt['rujukan']['diagppk'];
		$tglrujukan_awal = $data_decrypt['rujukan']['tglrujukan_awal'];
		$tglrujukan_awal = $data_decrypt['rujukan']['tglrujukan_berakhir'];
	}
	
	$return_data = array(
		'metadata_code' => $metadata_code,
		'metadata_message' => $metadata_message,
		'norujukan' => $norujukan,
		'nokapst' => $nokapst,
		'nmpst' => $nmpst,
		'diagppk' => $diagppk,
		'tglrujukan_awal' => $tglrujukan_awal,
		'tglrujukan_berakhir' => $tglrujukan_berakhir
	);
	$hasil = json_encode($return_data);

	log_data('apiVClaimInsertRujukanKhusus', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimHapusRujukanKhusus($id_rujukan, $no_rujukan, $user) {
	global $url_delete_rujukan_khusus;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
		
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$urlrequest = $url_delete_rujukan_khusus;
	
	$request = array('request'=>
					array('t_rujukan'=>
						array('idRujukan' => $id_rujukan,
							  'noRujukan' => $no_rujukan,
							  'user' => $user
						)
					)
			   );
	
	$jsonrequest = json_encode($request);

	$reqmethod = 'post';
	
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$metadata_code = null;
	$metadata_message = null;
	$response = null;
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	$response = $data_decrypt;
	
	$return_data = array(
		'metadata_code' => $metadata_code,
		'metadata_message' => $metadata_message,
		'response' => $response
	);
	$hasil = json_encode($return_data);

	log_data('apiVClaimHapusRujukanKhusus', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function apiVClaimDataRujukanKhusus($bulan, $tahun) {
	global $url_list_rujukan_khusus;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	if(is_null($bulan) && $bulan == '' && is_null($tahun) && $tahun == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'Bulan dan tahun harus diisi',
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_list_rujukan_khusus.'bulan/'.$bulan.'/tahun/'.$tahun;
	
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['rujukan']);
		
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$i = 0;
	$data_arr = array();
	if($count > 0) {
		for($i=0;$i<$count;$i++) {
			$data_arr[$i]['idrujukan'] = $data_decrypt['rujukan'][$i]['idrujukan'];
			$data_arr[$i]['norujukan'] = $data_decrypt['rujukan'][$i]['norujukan'];
			$data_arr[$i]['nokapst'] = $data_decrypt['rujukan'][$i]['nokapst'];
			$data_arr[$i]['nmpst'] = $data_decrypt['rujukan'][$i]['nmpst'];
			$data_arr[$i]['diagppk'] = $data_decrypt['rujukan'][$i]['diagppk'];
			$data_arr[$i]['tglrujukan_awal'] = $data_decrypt['rujukan'][$i]['tglrujukan_awal'];
			$data_arr[$i]['tglrujukan_berakhir'] = $data_decrypt['rujukan'][$i]['tglrujukan_berakhir'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'rujukan'=>$data_arr
	);

	$data_req = json_encode(
		array(
			"bulan" => $bulan,
			"tahun" => $tahun
		)
	);

	log_data('apiVClaimDataRujukanKhusus', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}


function apiVClaimListSpesialistikRujukan($kodeppk, $tglrujukan) {
	global $url_list_spesialistik_rujukan;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	if(is_null($kodeppk) && $kodeppk == '' && is_null($tglrujukan) && $tglrujukan == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'kode ppk dan tanggal rujukan harus diisi',
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_list_spesialistik_rujukan.'PPKRujukan/'.$kodeppk.'/TglRujukan/'.$tglrujukan;
	
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['list']);
		
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$i = 0;
	$data_arr = array();
	if($count > 0) {
		for($i=0;$i<$count;$i++) {
			$data_arr[$i]['kodespesialis'] = $data_decrypt['list'][$i]['kodeSpesialis'];
			$data_arr[$i]['namaspesialis'] = $data_decrypt['list'][$i]['namaSpesialis'];
			$data_arr[$i]['kapasitas'] = $data_decrypt['list'][$i]['kapasitas'];
			$data_arr[$i]['jumlahrujukan'] = $data_decrypt['list'][$i]['jumlahRujukan'];
			$data_arr[$i]['persentase'] = $data_decrypt['rujukan'][$i]['persentase'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$data_arr
	);

	$data_req = json_encode(
		array(
			"kodeppk" => $kodeppk,
			"tglrujukan" => $tglrujukan
		)
	);

	log_data('apiVClaimListSpesialistikRujukan', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}


function apiVClaimListSarana($kodeppk) {
	global $url_list_sarana;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	if(is_null($kodeppk) && $kodeppk == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'kode ppk rujukan harus diisi',
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_list_sarana.$kodeppk;
	
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['list']);
		
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$i = 0;
	$data_arr = array();
	if($count > 0) {
		for($i=0;$i<$count;$i++) {
			$data_arr[$i]['kodesarana'] = $data_decrypt['list'][$i]['kodeSarana'];
			$data_arr[$i]['namasarana'] = $data_decrypt['list'][$i]['namaSarana'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$data_arr
	);

	$data_req = json_encode(
		array(
			"kodeppk" => $kodeppk
		)
	);

	log_data('apiVClaimListSarana', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}

function apiVClaimDataIndukKecelakaan($nokartu) {
	global $url_list_induk_kecelakaan;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	if(is_null($nokartu) && $nokartu == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'Nomor kartu peserta harus diisi',
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_list_induk_kecelakaan.$nokartu;
	
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['list']);
		
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$i = 0;
	$data_arr = array();
	if($count > 0) {
		for($i=0;$i<$count;$i++) {
			$data_arr[$i]['nosep'] = $data_decrypt['list'][$i]['noSEP'];
			$data_arr[$i]['tglkejadian'] = $data_decrypt['list'][$i]['tglKejadian'];
			$data_arr[$i]['ppkpelsep'] = $data_decrypt['list'][$i]['ppkPelSEP'];
			$data_arr[$i]['kdprop'] = $data_decrypt['list'][$i]['kdProp'];
			$data_arr[$i]['kdkab'] = $data_decrypt['list'][$i]['kdKab'];
			$data_arr[$i]['kdkec'] = $data_decrypt['list'][$i]['kdKec'];
			$data_arr[$i]['ketkejadian'] = $data_decrypt['list'][$i]['ketKejadian'];
			$data_arr[$i]['nosepsuplesi'] = $data_decrypt['list'][$i]['noSEPSuplesi'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$data_arr
	);

	$data_req = json_encode(
		array(
			"nokartu" => $nokartu
		)
	);

	log_data('apiVClaimDataIndukKecelakaan', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}


function apiVClaimDataSEPInternal($nosep) {
	global $url_list_sep_internal;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
	
	if(is_null($nosep) && $nosep == '') {
		return array(
			'metadata_code'=>'90',
			'metadata_message'=>'Nomor SEP harus diisi',
		);
	}
	
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$completeurl = $url_list_sep_internal.$nosep;
	
	$response = xrequest($completeurl, $hashsignature, $cid, $timestmp, $user_key);
	
	$data = json_decode($response, true);
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$count = count($data_decrypt['list']);
		
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	
	$i = 0;
	$data_arr = array();
	if($count > 0) {
		for($i=0;$i<$count;$i++) {
			$data_arr[$i]['tujuanrujuk'] = $data_decrypt['list'][$i]['tujuanrujuk'];
			$data_arr[$i]['nmtujuanrujuk'] = $data_decrypt['list'][$i]['nmtujuanrujuk'];
			$data_arr[$i]['nmpoliasal'] = $data_decrypt['list'][$i]['nmpoliasal'];
			$data_arr[$i]['tglrujukinternal'] = $data_decrypt['list'][$i]['tglrujukinternal'];
			$data_arr[$i]['nosep'] = $data_decrypt['list'][$i]['nosep'];
			$data_arr[$i]['nosepref'] = $data_decrypt['list'][$i]['nosepref'];
			$data_arr[$i]['ppkpelsep'] = $data_decrypt['list'][$i]['ppkpelsep'];
			$data_arr[$i]['nokapst'] = $data_decrypt['list'][$i]['nokapst'];
			$data_arr[$i]['tglsep'] = $data_decrypt['list'][$i]['tglsep'];
			$data_arr[$i]['nosurat'] = $data_decrypt['list'][$i]['nosurat'];
			$data_arr[$i]['flaginternal'] = $data_decrypt['list'][$i]['flaginternal'];
			$data_arr[$i]['kdpoliasal'] = $data_decrypt['list'][$i]['kdpoliasal'];
			$data_arr[$i]['kdpolituj'] = $data_decrypt['list'][$i]['kdpolituj'];
			$data_arr[$i]['kdpenunjang'] = $data_decrypt['list'][$i]['kdpenunjang'];
			$data_arr[$i]['nmpenunjang'] = $data_decrypt['list'][$i]['nmpenunjang'];
			$data_arr[$i]['diagppk'] = $data_decrypt['list'][$i]['diagppk'];
			$data_arr[$i]['kddokter'] = $data_decrypt['list'][$i]['kddokter'];
			$data_arr[$i]['nmdokter'] = $data_decrypt['list'][$i]['nmdokter'];
			$data_arr[$i]['flagprosedur'] = $data_decrypt['list'][$i]['flagprosedur'];
			$data_arr[$i]['opsikonsul'] = $data_decrypt['list'][$i]['opsikonsul'];
			$data_arr[$i]['flagsep'] = $data_decrypt['list'][$i]['flagsep'];
			$data_arr[$i]['fuser'] = $data_decrypt['list'][$i]['fuser'];
			$data_arr[$i]['fdate'] = $data_decrypt['list'][$i]['fdate'];
			$data_arr[$i]['nmdiag'] = $data_decrypt['list'][$i]['nmdiag'];
		}
	}
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'count'=>$count,
		'list'=>$data_arr
	);

	$data_req = json_encode(
		array(
			"nosep" => $nosep
		)
	);

	log_data('apiVClaimDataSEPInternal', $completeurl, $data_req, $metadata_message);
	
	return $return_data;
}


function apiVClaimHapusSEPInternal($nosep, $nosurat, $tglrujukaninternal, $kdpolituj, $user) {
	global $url_delete_sep_internal;
	
	if (!defined('ConsumerID') || !defined('ConsumerSecret')) { 
		return array(
			'metadata_message'=>'Consumer ID or Consumer Secret not found',
			'metadata_code'=>'92'
		);
	}
		
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	$urlrequest = $url_delete_sep_internal;
	
	$request = array('request'=>
					array('t_sep'=>
						array('noSep' => $nosep,
							  'noSurat' => $nosurat,
							  'tglRujukanInternal' => $tglrujukaninternal,
							  'kdPoliTuj' => $kdpolituj,
							  'user' => $user
						)
					)
			   );
	
	$jsonrequest = json_encode($request);

	$reqmethod = 'delete';
	
	$content = 'application/x-www-form-urlencoded';
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $jsonrequest, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	
	$key = $cid . ConsumerSecret . $timestmp;
	$data_decrypt = json_decode(decompress(stringDecrypt($key,$data['response'])), true);
	
	$metadata_code = null;
	$metadata_message = null;
	$response = null;
	
	$metadata_code = $data['metaData']['code'];
	$metadata_message = $data['metaData']['message'];
	$response = $data_decrypt;
	
	$return_data = array(
		'metadata_code'=>$metadata_code,
		'metadata_message'=>$metadata_message,
		'response'=>$response
	);
	$hasil = json_encode($return_data);

	log_data('apiVClaimHapusSEPInternal', $urlrequest, $jsonrequest, $hasil);
	
	return $return_data;
}

function xml_request($urlrequest, $sendmethod, $reqmethod, $request, $content) {
		
	list($cid, $timestmp, $hashsignature, $user_key) = HashBPJS(ConsumerID, ConsumerSecret);
	
	if($sendmethod == 'json') {
		$request = json_encode($request);
	} elseif($sendmethod == 'xml') {
		include_once('XML/Serializer.php');
		$options = array(XML_SERIALIZER_OPTION_RETURN_RESULT => true);

		$serializer = new XML_Serializer($options);
		
		$request = $serializer->serialize($request);
		$pjgxmlrequest = strlen($request);
		$request = substr($request, 7, $pjgxmlrequest - 16);
	}
	
	// var_dump($request);
	
	$response = xrequestwithdata($urlrequest, $hashsignature, $cid, $timestmp, $request, $reqmethod, $content, $user_key);
	
	$data = json_decode($response, true);
	
	return $data;

}

?>