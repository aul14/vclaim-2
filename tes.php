<?php
	require_once('functions.php');
	require_once('config.php');
	
	// list($cid, $timestmp, $hashsignature) = HashBPJS(ConsumerID, ConsumerSecret);
	
	// $completeurl = $url_diagnosa.'/A10';
	// $response = xrequest($completeurl, $hashsignature, $cid, $timestmp);
	
	// $data = json_decode($response, true);
	
	// echo count($data['response']['diagnosa']);


	// ===================

	// if($data['metaData']['code'] == '201') {
		// $count = 1;
	// } else {
		// $count = $data['response']['count'];
	// }
	
	// $metadata_code = $data['metaData']['code'];
	// $metadata_message = $data['metaData']['message'];
	
	// $i = 0;
	// $datarray = array();
	// for ($i = 0; $i < $count; $i++){
		// $datarray[$i]['kodeDiagnosa'] = $data['response']['diagnosa'][$i]['kode'];
		// $datarray[$i]['namaDiagnosa'] = $data['response']['diagnosa'][$i]['nama'];
	// }
	
	// $return_data = array
	// (
		// 'metadata_code'=>$metadata_code,
		// 'metadata_message'=>$metadata_message,
		// 'count'=>$count,
		// 'list'=>$datarray
	// );


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
	
	return $return_data;
	

?>