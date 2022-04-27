<?php
ini_set('max_execution_time', 86400);
include('wsfunction.php');
// echo 'a';
if(!isset($_POST['func'])) { $_POST['func'] = ''; }
// if(isset($_POST)) {
	// $param = array();
	if(function_exists($_POST['func'])) {
		$_POST['func']();
	}
// }

function diagnosa() {
	$inc = array();
	$merge = array();
	// $tes = array();
	$al = strtoupper('abcdefghijklmnopqrstuvwxyz');
	$n = '0123456789';
	$len_al = strlen($al);
	$len_n = strlen($n);
	for($x=0; $x < $len_al; $x++) {
		$a = substr($al, $x, 1);
		for($y=0; $y < $len_n; $y++) {
			$b = substr($n, $y, 1);
			for($z=0; $z < $len_n; $z++) {
				$c = substr($n, $z, 1);
				// echo "$a$b$c";
				// echo "<br>";
				$inc = apiVClaimDiagnosa("$a$b$c");
				$merge = array_merge($merge, $inc['list']);
			}
		}
	}
	
	$data = array_map(function($diag) {
		return $diag['kodeDiagnosa'].' - '.$diag['namaDiagnosa'];
	}, $merge);
	
	// var_dump($data);
	$line = implode(PHP_EOL, $data);
	
	header('Content-Disposition: attachment; filename="data_diagnosa_'.date('Ymd').'.txt"');
	header('Content-Type: text/plain');
	header('Content-Length: ' . strlen($line));
	header('Connection: close');
	
	echo $line;
}

function poli() {
	// $data = array();
	// $merge_n = array();
	// $n = '0123456789';
	// $len_n = strlen($n);
	// for($x=0; $x < $len_n; $x++) {
		// $a = substr($n, $x, 1);
		// for($y=0; $y < $len_n; $y++) {
			// $b = substr($n, $y, 1);
			// for($z=0; $z < $len_n; $z++) {
				// $c = substr($n, $z, 1);
				// $inc_n = "$a$b$c";
				// $poli_n = apiVClaimPoli($inc_n);
				// $count_poli_n = (int) $poli_n['count'];
				// if($count_poli_n != 0) {
					// $poli_n = $poli_n['list'];
					// $merge_n = array_merge($merge_n, $poli_n);
					// // $data_poli = array_map(function($pk) {
						// // return $pk['kode_poli'].' - '.$pk['nama_poli'];
					// // }, $poli);
					
					// // $merge = array_merge($merge, $data_poli);
				// }
			// }
		// }
	// }
	
	// $merge_al = array();
	// $al = strtoupper('abcdefghijklmnopqrstuvwxyz');
	// $len_al = strlen($al);
	// for($x=0; $x < $len_al; $x++) {
		// $a = substr($al, $x, 1);
		// for($y=0; $y < $len_al; $y++) {
			// $b = substr($al, $y, 1);
			// for($z=0; $z < $len_al; $z++) {
				// $c = substr($al, $z, 1);
				// $inc_al = "$a$b$c";
				// $poli_al = apiVClaimPoli($inc_al);
				// $count_poli_al = (int) $poli_al['count'];
				// if($count_poli_al != 0) {
					// $poli_al = $poli_al['list'];
					// $merge_al = array_merge($merge_al, $poli_al);
				// }
			// }
		// }
	// }
	
	// $data_poli = array_merge($merge_n, $merge_al);
	// sort($data_poli);
	
	$poli = $_POST['poli'];
	$response = apiVClaimPoli($poli);
	
	if($response['metadata_code'] == 200) {
		$data_poli = $response['list'];
		sort($data_poli);
		
		$data = array_map(function($pk) {
			return $pk['kode_poli'].' - '.$pk['nama_poli'];
		}, $data_poli);
		
		$line = implode(PHP_EOL, $data);
		
		header('Content-Disposition: attachment; filename="data_poli_'.$poli.'_'.date('Ymd').'.txt"');
		header('Content-Type: text/plain');
		header('Content-Length: ' . strlen($line));
		header('Connection: close');
		
		echo $line;
	} else {
		$message = $response['metadata_message'];
		header('location: master.php?rb=poli&message='.$message);
	}
}

function faskes() {
	$faskes = $_POST['faskes'];
	$jenis_faskes = $_POST['jenis_faskes'];
	$response = apiVClaimFaskes($faskes, $jenis_faskes);
	
	if($response['metadata_code'] == 200) {
		$data_faskes = $response['list'];
		sort($data_faskes);
		
		$data = array_map(function($pk) {
			return $pk['kode_faskes'].' - '.$pk['nama_faskes'];
		}, $data_faskes);
		
		$line = implode(PHP_EOL, $data);
		
		header('Content-Disposition: attachment; filename="data_faskes_'.$faskes.'_'.$jenis_faskes.'_'.date('Ymd').'.txt"');
		header('Content-Type: text/plain');
		header('Content-Length: ' . strlen($line));
		header('Connection: close');
		
		echo $line;
	} else {
		$message = $response['metadata_message'];
		header('location: master.php?rb=faskes&message='.$message);
	}
}

function dpjp() {
	$jenis_layan = $_POST['jenis_layan'];
	$tgl = date('Y-m-d');
	$spesialis = $_POST['spesialis'];
	$response = apiVClaimDPJP($jenis_layan, $tgl, $spesialis);
	
	if($response['metadata_code'] == 200) {
		$data_dpjp = $response['list'];
		sort($data_dpjp);
		
		$data = array_map(function($pk) {
			return $pk['kode_dpjp'].' - '.$pk['nama_dpjp'];
		}, $data_dpjp);
		
		$line = implode(PHP_EOL, $data);
		
		header('Content-Disposition: attachment; filename="data_dpjp_'.$jenis_layan.'_'.$tgl.'_'.$spesialis.'_'.date('Ymd').'.txt"');
		header('Content-Type: text/plain');
		header('Content-Length: ' . strlen($line));
		header('Connection: close');
		
		echo $line;
	} else {
		$message = $response['metadata_message'];
		header('location: master.php?rb=dpjp&message='.$message);
	}
}

function propinsi() {
	$inc = array();
	$inc = apiVClaimPropinsi();
	$inc = $inc['list'];
	sort($inc);
	
	$data =  array_map(
        function($prop) {
			return $prop['kode_propinsi'].' - '.$prop['nama_propinsi'];
		}, $inc);
	$line = implode(PHP_EOL, $data);
	
	header('Content-Disposition: attachment; filename="data_propinsi_'.date('Ymd').'.txt"');
	header('Content-Type: text/plain');
	header('Content-Length: ' . strlen($line));
	header('Connection: close');
	
	echo $line;
}

function kabupaten() {
	$inc = array();
	$inc = apiVClaimPropinsi();
	$inc = $inc['list'];
	sort($inc);
	
	$data = array();
	$data_wilayah = array_map(
        function($prop) use (&$data) {
			$kode_propinsi = $prop['kode_propinsi'];
			$inc_kabupaten = apiVClaimKabupaten($kode_propinsi);
			$inc_kabupaten = $inc_kabupaten['list'];
			sort($inc_kabupaten);
			
			$data_kabupaten = array_map(function($kab) use (&$kode_propinsi) {
				return $kode_propinsi.' - '.$kab['kode_kabupaten'].' - '.$kab['nama_kabupaten'];
			}, $inc_kabupaten);
			
			$data = array_merge($data, $data_kabupaten);
		}, $inc);
	
	// var_dump($data);
	$line = implode(PHP_EOL, $data);
	
	header('Content-Disposition: attachment; filename="data_kabupaten_'.date('Ymd').'.txt"');
	header('Content-Type: text/plain');
	header('Content-Length: ' . strlen($line));
	header('Connection: close');
	
	echo $line;
}

function kecamatan() {
	$inc = array();
	$inc = apiVClaimPropinsi();
	$inc = $inc['list'];
	sort($inc);
	
	$data = array();
	$data_wilayah = array_map(
        function($prop) use (&$data) {
			$kode_propinsi = $prop['kode_propinsi'];
			$inc_kabupaten = apiVClaimKabupaten($kode_propinsi);
			$inc_kabupaten = $inc_kabupaten['list'];
			sort($inc_kabupaten);
			
			$data_kabupaten = array_map(function($kab) use (&$data, &$kode_propinsi) {
				$kode_kabupaten = $kab['kode_kabupaten'];
				$inc_kecamatan = apiVClaimKecamatan($kode_kabupaten);
				$inc_kecamatan = $inc_kecamatan['list'];
				sort($inc_kecamatan);
				
				$data_kecamatan = array_map(function($kec) use (&$data, &$kode_propinsi, &$kode_kabupaten) {
					return $kode_propinsi.' - '.$kode_kabupaten.' - '.$kec['kode_kecamatan'].' - '.$kec['nama_kecamatan'];
				}, $inc_kecamatan);
				
				$data = array_merge($data, $data_kecamatan);
			}, $inc_kabupaten);
			
			// $data = array_merge($data, $data_kabupaten);
		}, $inc);
	
	// var_dump($data);
	$line = implode(PHP_EOL, $data);
	
	header('Content-Disposition: attachment; filename="data_kecamatan_'.date('Ymd').'.txt"');
	header('Content-Type: text/plain');
	header('Content-Length: ' . strlen($line));
	header('Connection: close');
	
	echo $line;
}

function tindakan() {
	$tindakan = $_POST['tindakan'];
	$response = apiVClaimProsedur($tindakan);
	
	if($response['metadata_code'] == 200) {
		$data_tindakan = $response['list'];
		sort($data_tindakan);
		
		$data = array_map(function($pk) {
			return $pk['kode_prosedur'].' - '.$pk['nama_prosedur'];
		}, $data_tindakan);
		
		$line = implode(PHP_EOL, $data);
		
		header('Content-Disposition: attachment; filename="data_prosedur_'.$tindakan.'_'.date('Ymd').'.txt"');
		header('Content-Type: text/plain');
		header('Content-Length: ' . strlen($line));
		header('Connection: close');
		
		echo $line;
	} else {
		$message = $response['metadata_message'];
		header('location: master.php?rb=tindakan&message='.$message);
	}
}

function kelasrawat() {
	$inc = array();
	$inc = apiVClaimKelasRawat();
	$inc = $inc['list'];
	sort($inc);
	
	$data =  array_map(
        function($kr) {
			return $kr['kode_kelasrawat'].' - '.$kr['nama_kelasrawat'];
		}, $inc);
	$line = implode(PHP_EOL, $data);
	
	header('Content-Disposition: attachment; filename="data_kelasrawat_'.date('Ymd').'.txt"');
	header('Content-Type: text/plain');
	header('Content-Length: ' . strlen($line));
	header('Connection: close');
	
	echo $line;
}

function dokter() {
	$dokter = $_POST['dokter'];
	$response = apiVClaimProsedur($dokter);
	
	if($response['metadata_code'] == 200) {
		$data_tindakan = $response['list'];
		sort($data_tindakan);
		
		$data = array_map(function($dokter) {
			return $dokter['kode_dokter'].' - '.$dokter['nama_dokter'];
		}, $data_tindakan);
		
		$line = implode(PHP_EOL, $data);
		
		header('Content-Disposition: attachment; filename="data_dokter_'.$dokter.'_'.date('Ymd').'.txt"');
		header('Content-Type: text/plain');
		header('Content-Length: ' . strlen($line));
		header('Connection: close');
		
		echo $line;
	} else {
		$message = $response['metadata_message'];
		header('location: master.php?rb=dokter&message='.$message);
	}
}

function spesialistik() {
	$inc = array();
	$inc = apiVClaimSpesialistik();
	$inc = $inc['list'];
	sort($inc);
	
	$data =  array_map(
        function($rr) {
			return $rr['kode_spesialistik'].' - '.$rr['nama_spesialistik'];
		}, $inc);
	$line = implode(PHP_EOL, $data);
	
	header('Content-Disposition: attachment; filename="data_spesialistik_'.date('Ymd').'.txt"');
	header('Content-Type: text/plain');
	header('Content-Length: ' . strlen($line));
	header('Connection: close');
	
	echo $line;
}

function ruangrawat() {
	$inc = array();
	$inc = apiVClaimRuangRawat();
	$inc = $inc['list'];
	sort($inc);
	
	$data =  array_map(
        function($rr) {
			return $rr['kode_ruangrawat'].' - '.$rr['nama_ruangrawat'];
		}, $inc);
	$line = implode(PHP_EOL, $data);
	
	header('Content-Disposition: attachment; filename="data_ruangrawat_'.date('Ymd').'.txt"');
	header('Content-Type: text/plain');
	header('Content-Length: ' . strlen($line));
	header('Connection: close');
	
	echo $line;
}

function carakeluar() {
	$inc = array();
	$inc = apiVClaimCaraKeluar();
	$inc = $inc['list'];
	sort($inc);
	
	$data =  array_map(
        function($ck) {
			return $ck['kode_carakeluar'].' - '.$ck['nama_carakeluar'];
		}, $inc);
	$line = implode(PHP_EOL, $data);
	
	header('Content-Disposition: attachment; filename="data_carakeluar_'.date('Ymd').'.txt"');
	header('Content-Type: text/plain');
	header('Content-Length: ' . strlen($line));
	header('Connection: close');
	
	echo $line;
}

function pascapulang() {
	$inc = array();
	$inc = apiVClaimPascaPulang();
	$inc = $inc['list'];
	sort($inc);
	
	$data =  array_map(
        function($pp) {
			return $pp['kode_pascapulang'].' - '.$pp['nama_pascapulang'];
		}, $inc);
	$line = implode(PHP_EOL, $data);
	
	header('Content-Disposition: attachment; filename="data_pascapulang_'.date('Ymd').'.txt"');
	header('Content-Type: text/plain');
	header('Content-Length: ' . strlen($line));
	header('Connection: close');
	
	echo $line;
}

?>