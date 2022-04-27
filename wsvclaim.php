<?php
	require_once('wsfunction.php');
	
	// Pull in the NuSOAP code
	require_once('include/nusoap/lib/nusoap.php');
	$server = new soap_server;
	$server->configureWSDL('vclaim_wsdl','urn:vclaim_wsdl');
	$server->soap_defencoding = 'UTF-8';

	//Diagnosa
	$server->wsdl->addComplexType(
		'responVClaimDiagnosa_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kodeDiagnosa' => array('name'=>'kodeDiagnosa', 'type'=>'xsd:string'),
			'namaDiagnosa' => array('name'=>'namaDiagnosa', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimDiagnosa_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimDiagnosa_result[]')),
		'tns:responVClaimDiagnosa_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimDiagnosaFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimDiagnosa_resultArray')
		)
	);

	$server->register(
		'apiVClaimDiagnosa',
		array('keyword' => 'xsd:string'),
		array('return' => 'tns:responVClaimDiagnosaFull_result'),
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data diagnosa VClaim'
	);

	//Poli
	$server->wsdl->addComplexType(
		'responVClaimPoli_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kode_poli' => array('name'=>'kode_poli', 'type'=>'xsd:string'),
			'nama_poli' => array('name'=>'nama_poli', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimPoli_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimPoli_result[]')),
		'tns:responVClaimPoli_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimPoliFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimPoli_resultArray')
		)
	);

	$server->register(
		'apiVClaimPoli',
		array('keyword' => 'xsd:string'),
		array('return' => 'tns:responVClaimPoliFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data poli VClaim'
	);

	//Fasilitas Kesehatan
	$server->wsdl->addComplexType(
		'responVClaimFaskes_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kode_faskes' => array('name'=>'kode_faskes', 'type'=>'xsd:string'),
			'nama_faskes' => array('name'=>'nama_faskes', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimFaskes_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimFaskes_result[]')),
		'tns:responVClaimFaskes_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimFaskesFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimFaskes_resultArray')
		)
	);

	$server->register(
		'apiVClaimFaskes',
		array(
			'keyword' => 'xsd:string',
			'jenis_faskes' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimFaskesFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data Fasilitas Kesehatan VClaim'
	);

	//DPJP
	$server->wsdl->addComplexType(
		'responVClaimDPJP_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kode_dpjp' => array('name'=>'kode_dpjp', 'type'=>'xsd:string'),
			'nama_dpjp' => array('name'=>'nama_dpjp', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimDPJP_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimDPJP_result[]')),
		'tns:responVClaimDPJP_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimDPJPFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimDPJP_resultArray')
		)
	);

	$server->register(
		'apiVClaimDPJP',
		array(
			'jenis_pelayanan' => 'xsd:string',
			'tgl_pelayanan' => 'xsd:string',
			'kode_spesialis' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimDPJPFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data Dokter DPJP VClaim'
	);

	//Propinsi
	$server->wsdl->addComplexType(
		'responVClaimPropinsi_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kode_propinsi' => array('name'=>'kode_propinsi', 'type'=>'xsd:string'),
			'nama_propinsi' => array('name'=>'nama_propinsi', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimPropinsi_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimPropinsi_result[]')),
		'tns:responVClaimPropinsi_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimPropinsiFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimPropinsi_resultArray')
		)
	);

	$server->register(
		'apiVClaimPropinsi',
		array(),
		array('return' => 'tns:responVClaimPropinsiFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data Propinsi VClaim'
	);

	//Kabupaten
	$server->wsdl->addComplexType(
		'responVClaimKabupaten_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kode_kabupaten' => array('name'=>'kode_kabupaten', 'type'=>'xsd:string'),
			'nama_kabupaten' => array('name'=>'nama_kabupaten', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimKabupaten_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimKabupaten_result[]')),
		'tns:responVClaimKabupaten_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimKabupatenFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimKabupaten_resultArray')
		)
	);

	$server->register(
		'apiVClaimKabupaten',
		array(
			'kode_propinsi' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimKabupatenFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data Kabupaten VClaim'
	);

	//Kecamatan
	$server->wsdl->addComplexType(
		'responVClaimKecamatan_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kode_kecamatan' => array('name'=>'kode_kecamatan', 'type'=>'xsd:string'),
			'nama_kecamatan' => array('name'=>'nama_kecamatan', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimKecamatan_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimKecamatan_result[]')),
		'tns:responVClaimKecamatan_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimKecamatanFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimKecamatan_resultArray')
		)
	);

	$server->register(
		'apiVClaimKecamatan',
		array(
			'kode_kabupaten' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimKecamatanFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data Kecamatan VClaim'
	);
	
	//diagnosaprb
	$server->wsdl->addComplexType(
		'responVClaimDiagnosaPRB_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kode_diagnosaprb' => array('name'=>'kode_diagnosaprb', 'type'=>'xsd:string'),
			'nama_diagnosaprb' => array('name'=>'nama_diagnosaprb', 'type'=>'xsd:string')
		)
	);
	

	$server->wsdl->addComplexType(
		'responVClaimDiagnosaPRB_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimDiagnosaPRB_result[]')),
		'tns:responVClaimDiagnosaPRB_result'
	);
	$server->wsdl->addComplexType(
		'responVClaimDiagnosaPRBFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimDiagnosaPRB_resultArray')
		)
	);
	$server->register(
		'apiVClaimDiagnosaPRB',
		array(),
		array('return' => 'tns:responVClaimDiagnosaPRBFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data Diagnosaprb VClaim'
	);
	
	//Obat Generik Program PRB
	$server->wsdl->addComplexType(
		'responVClaimObatGenerikPRB_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kode_obatprb' => array('name'=>'kode_obatprb', 'type'=>'xsd:string'),
			'nama_obatprb' => array('name'=>'nama_obatprb', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimObatGenerikPRB_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimObatGenerikPRB_result[]')),
		'tns:responVClaimObatGenerikPRB_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimObatGenerikPRBFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimObatGenerikPRB_resultArray')
		)
	);

	$server->register(
		'apiVClaimObatGenerikPRB',
		array('keyword' => 'xsd:string'),
		array('return' => 'tns:responVClaimObatGenerikPRBFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data Obat Generik Program PRB VClaim'
	);
	

	//Procedure / Tindakan
	$server->wsdl->addComplexType(
		'responVClaimProsedur_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kodeProsedur' => array('name'=>'kodeProsedur', 'type'=>'xsd:string'),
			'namaProsedur' => array('name'=>'namaProsedur', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimProsedur_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimProsedur_result[]')),
		'tns:responVClaimProsedur_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimProsedurFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimProsedur_resultArray')
		)
	);

	$server->register(
		'apiVClaimProsedur',
		array('keyword' => 'xsd:string'),
		array('return' => 'tns:responVClaimProsedurFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data Prosedur VClaim'
	);

	//Kelas Rawat
	$server->wsdl->addComplexType(
		'responVClaimKelasRawat_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kode_kelasrawat' => array('name'=>'kode_kelasrawat', 'type'=>'xsd:string'),
			'nama_kelasrawat' => array('name'=>'nama_kelasrawat', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimKelasRawat_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimKelasRawat_result[]')),
		'tns:responVClaimKelasRawat_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimKelasRawatFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimKelasRawat_resultArray')
		)
	);

	$server->register(
		'apiVClaimKelasRawat',
		array(),
		array('return' => 'tns:responVClaimKelasRawatFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data Kelas Rawat VClaim'
	);
	
	//Dokter
	$server->wsdl->addComplexType(
		'responVClaimDokter_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kode_dokter' => array('name'=>'kode_dokter', 'type'=>'xsd:string'),
			'nama_dokter' => array('name'=>'nama_dokter', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimDokter_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimDokter_result[]')),
		'tns:responVClaimDokter_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimDokterFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimDokter_resultArray')
		)
	);

	$server->register(
		'apiVClaimDokter',
		array('keyword' => 'xsd:string'),
		array('return' => 'tns:responVClaimDokterFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data Dokter VClaim'
	);
	
	//Spesialistik
	$server->wsdl->addComplexType(
		'responVClaimSpesialistik_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kode_spesialistik' => array('name'=>'kode_spesialistik', 'type'=>'xsd:string'),
			'nama_spesialistik' => array('name'=>'nama_spesialistik', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimSpesialistik_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimSpesialistik_result[]')),
		'tns:responVClaimSpesialistik_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimSpesialistikFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimSpesialistik_resultArray')
		)
	);

	$server->register(
		'apiVClaimSpesialistik',
		array(),
		array('return' => 'tns:responVClaimSpesialistikFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data Spesialistik VClaim'
	);
	
	//Ruang Rawat
	$server->wsdl->addComplexType(
		'responVClaimRuangRawat_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kode_ruangrawat' => array('name'=>'kode_ruangrawat', 'type'=>'xsd:string'),
			'nama_ruangrawat' => array('name'=>'nama_ruangrawat', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimRuangRawat_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimRuangRawat_result[]')),
		'tns:responVClaimRuangRawat_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimRuangRawatFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimRuangRawat_resultArray')
		)
	);

	$server->register(
		'apiVClaimRuangRawat',
		array(),
		array('return' => 'tns:responVClaimRuangRawatFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data Ruang Rawat VClaim'
	);
	
	//Cara Keluar
	$server->wsdl->addComplexType(
		'responVClaimCaraKeluar_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kode_carakeluar' => array('name'=>'kode_carakeluar', 'type'=>'xsd:string'),
			'nama_carakeluar' => array('name'=>'nama_carakeluar', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimCaraKeluar_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimCaraKeluar_result[]')),
		'tns:responVClaimCaraKeluar_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimCaraKeluarFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimCaraKeluar_resultArray')
		)
	);

	$server->register(
		'apiVClaimCaraKeluar',
		array(),
		array('return' => 'tns:responVClaimCaraKeluarFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data Cara Keluar VClaim'
	);
	
	//Pasca Pulang
	$server->wsdl->addComplexType(
		'responVClaimPascaPulang_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kode_pascapulang' => array('name'=>'kode_pascapulang', 'type'=>'xsd:string'),
			'nama_pascapulang' => array('name'=>'nama_pascapulang', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimPascaPulang_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimPascaPulang_result[]')),
		'tns:responVClaimPascaPulang_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimPascaPulangFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimPascaPulang_resultArray')
		)
	);

	$server->register(
		'apiVClaimPascaPulang',
		array(),
		array('return' => 'tns:responVClaimPascaPulangFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data Pasca Pulang VClaim'
	);

	//Peserta
	$server->wsdl->addComplexType(
		'responVClaimPeserta_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'cob_nama_asuransi' => array('name'=>'cob_nama_asuransi', 'type'=>'xsd:string'),
			'cob_nomor_asuransi' => array('name'=>'cob_nomor_asuransi', 'type'=>'xsd:string'),
			'cob_tgltat' => array('name'=>'cob_tgltat', 'type'=>'xsd:string'),
			'cob_tgltmt' => array('name'=>'cob_tgltmt', 'type'=>'xsd:string'),
			'hak_kelas_ket' => array('name'=>'hak_kelas_ket', 'type'=>'xsd:string'),
			'hak_kelas_kode' => array('name'=>'hak_kelas_kode', 'type'=>'xsd:string'),
			'info_dinsos' => array('name'=>'info_dinsos', 'type'=>'xsd:string'),
			'info_nosktm' => array('name'=>'info_nosktm', 'type'=>'xsd:string'),
			'info_prolanisprb' => array('name'=>'info_prolanisprb', 'type'=>'xsd:string'),
			'jenis_peserta_ket' => array('name'=>'jenis_peserta_ket', 'type'=>'xsd:string'),
			'jenis_peserta_kode' => array('name'=>'jenis_peserta_kode', 'type'=>'xsd:string'),
			'no_rm' => array('name'=>'no_rm', 'type'=>'xsd:string'),
			'no_telp' => array('name'=>'no_telp', 'type'=>'xsd:string'),
			'nama' => array('name'=>'nama', 'type'=>'xsd:string'),
			'nik' => array('name'=>'nik', 'type'=>'xsd:string'),
			'no_kartu' => array('name'=>'no_kartu', 'type'=>'xsd:string'),
			'pisa' => array('name'=>'pisa', 'type'=>'xsd:string'),
			'prov_umum_kode_provider' => array('name'=>'prov_umum_kode_provider', 'type'=>'xsd:string'),
			'prov_umum_nama_provider' => array('name'=>'prov_umum_nama_provider', 'type'=>'xsd:string'),
			'sex' => array('name'=>'sex', 'type'=>'xsd:string'),
			'status_peserta_ket' => array('name'=>'status_peserta_ket', 'type'=>'xsd:string'),
			'status_peserta_kode' => array('name'=>'status_peserta_kode', 'type'=>'xsd:string'),
			'tgl_cetak_kartu' => array('name'=>'tgl_cetak_kartu', 'type'=>'xsd:string'),
			'tgl_lahir' => array('name'=>'tgl_lahir', 'type'=>'xsd:string'),
			'tgl_tat' => array('name'=>'tgl_tat', 'type'=>'xsd:string'),
			'tgl_tmt' => array('name'=>'tgl_tmt', 'type'=>'xsd:string'),
			'umur_pelayanan' => array('name'=>'umur_pelayanan', 'type'=>'xsd:string'),
			'umur_sekarang' => array('name'=>'umur_sekarang', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimPeserta',
		array(
			'varRequest' => 'xsd:string',
			'tgl_sep' => 'xsd:string',
			'tipeRequest' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimPeserta_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data peserta VClaim'
	);

	//Buat SEP
	$server->wsdl->addComplexType(
		'responVClaimSEP_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'response' => array('name'=>'response', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimGenSEP',
		array(
			'noKartu' => 'xsd:string',
			'tglSep' => 'xsd:string',
			'tglRujukan' => 'xsd:string',
			'noRujukan' => 'xsd:string',
			'ppkRujukan' => 'xsd:string',
			'ppkPelayanan' => 'xsd:string',
			'jnsPelayanan' => 'xsd:string',
			'catatan' => 'xsd:string',
			'diagAwal' => 'xsd:string',
			'poliTujuan' => 'xsd:string',
			'klsRawat' => 'xsd:string',
			'user' => 'xsd:string',
			'noMr' => 'xsd:string',
			'noTelp' => 'xsd:string',
			'asalRujukan' => 'xsd:string',
			'poliEksekutif' => 'xsd:string',
			'cob' => 'xsd:string',
			'lakaLantas' => 'xsd:string',
			'penjamin' => 'xsd:string',
			'lokasiLaka' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimSEP_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Create SEP VClaim'
	);

	//Update SEP
	$server->register(
		'apiVClaimUpdateSEP',
		array(
			'no_sep' => 'xsd:string',
			'kelas_rawat' => 'xsd:string',
			'norm' => 'xsd:string',
			'asal_rujukan' => 'xsd:string',
			'tgl_rujukan' => 'xsd:string',
			'no_rujukan' => 'xsd:string',
			'ppk_rujukan' => 'xsd:string',
			'catatan' => 'xsd:string',
			'diagnosa_awal' => 'xsd:string',
			'poli_eksekutif' => 'xsd:string',
			'cob' => 'xsd:string',
			'laka_lantas' => 'xsd:string',
			'penjamin' => 'xsd:string',
			'lokasi_laka' => 'xsd:string',
			'no_telp' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimSEP_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Update SEP VClaim'
	);

	//Buat SEP 1.1
	$server->register(
		'apiVClaimGenSEP11',
		array(
			'noKartu' => 'xsd:string',
			'tglSep' => 'xsd:string',
			'tglRujukan' => 'xsd:string',
			'noRujukan' => 'xsd:string',
			'ppkRujukan' => 'xsd:string',
			'ppkPelayanan' => 'xsd:string',
			'jnsPelayanan' => 'xsd:string',
			'catatan' => 'xsd:string',
			'diagAwal' => 'xsd:string',
			'poliTujuan' => 'xsd:string',
			'klsRawat' => 'xsd:string',
			'user' => 'xsd:string',
			'noMr' => 'xsd:string',
			'noTelp' => 'xsd:string',
			'asalRujukan' => 'xsd:string',
			'poliEksekutif' => 'xsd:string',
			'cob' => 'xsd:string',
			'lakaLantas' => 'xsd:string',
			'penjamin' => 'xsd:string',
			'katarak' => 'xsd:string',
			'tgl_kejadian' => 'xsd:string',
			'keterangan' => 'xsd:string',
			'suplesi' => 'xsd:string',
			'nosepsuplesi' => 'xsd:string',
			'kode_propinsi' => 'xsd:string',
			'kode_kabupaten' => 'xsd:string',
			'kode_kecamatan' => 'xsd:string',
			'no_surat' => 'xsd:string',
			'kode_dpjp' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimSEP_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Create SEP VClaim 1.1'
	);
	
	//Update SEP 1.1
	$server->register(
		'apiVClaimUpdateSEP11',
		array(
			'no_sep' => 'xsd:string',
			'kelas_rawat' => 'xsd:string',
			'norm' => 'xsd:string',
			'asal_rujukan' => 'xsd:string',
			'tgl_rujukan' => 'xsd:string',
			'no_rujukan' => 'xsd:string',
			'ppk_rujukan' => 'xsd:string',
			'catatan' => 'xsd:string',
			'diagnosa_awal' => 'xsd:string',
			'poli_eksekutif' => 'xsd:string',
			'cob' => 'xsd:string',
			'laka_lantas' => 'xsd:string',
			'penjamin' => 'xsd:string',
			'no_telp' => 'xsd:string',
			'user' => 'xsd:string',
			'katarak' => 'xsd:string',
			'tgl_kejadian' => 'xsd:string',
			'keterangan' => 'xsd:string',
			'suplesi' => 'xsd:string',
			'nosepsuplesi' => 'xsd:string',
			'kode_propinsi' => 'xsd:string',
			'kode_kabupaten' => 'xsd:string',
			'kode_kecamatan' => 'xsd:string',
			'no_surat' => 'xsd:string',
			'kode_dpjp' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimSEP_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Update SEP VClaim 1.1'
	);
	
	//Buat SEP 2.0
	$server->register(
		'apiVClaimGenSEP2',
		array(
			'noKartu' => 'xsd:string',
			'tglSep' => 'xsd:string',
			'tglRujukan' => 'xsd:string',
			'noRujukan' => 'xsd:string',
			'ppkRujukan' => 'xsd:string',
			'ppkPelayanan' => 'xsd:string',
			'jnsPelayanan' => 'xsd:string',
			'catatan' => 'xsd:string',
			'diagAwal' => 'xsd:string',
			'poliTujuan' => 'xsd:string',
			'user' => 'xsd:string',
			'noMr' => 'xsd:string',
			'noTelp' => 'xsd:string',
			'asalRujukan' => 'xsd:string',
			'poliEksekutif' => 'xsd:string',
			'cob' => 'xsd:string',
			'lakaLantas' => 'xsd:string',
			'penjamin' => 'xsd:string',
			'katarak' => 'xsd:string',
			'tgl_kejadian' => 'xsd:string',
			'keterangan' => 'xsd:string',
			'suplesi' => 'xsd:string',
			'nosepsuplesi' => 'xsd:string',
			'kode_propinsi' => 'xsd:string',
			'kode_kabupaten' => 'xsd:string',
			'kode_kecamatan' => 'xsd:string',
			'no_surat' => 'xsd:string',
			'kode_dpjp' => 'xsd:string',
			'klsRawatHak' => 'xsd:string',
			'klsRawatNaik' => 'xsd:string',
			'pembiayaan' => 'xsd:string',
			'penanggungJawab' => 'xsd:string',
			'tujuan_kunj' => 'xsd:string',
			'flagProcedure' => 'xsd:string',
			'kdPenunjang' => 'xsd:string',
			'assesmentPel' => 'xsd:string',
			'dpjpLayan' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimSEP_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Create SEP VClaim 2.0'
	);
	
	//Update SEP 2.0
	$server->register(
		'apiVClaimUpdateSEP2',
		array(
			'no_sep' => 'xsd:string',
			'norm' => 'xsd:string',
			'asal_rujukan' => 'xsd:string',
			'tgl_rujukan' => 'xsd:string',
			'no_rujukan' => 'xsd:string',
			'ppk_rujukan' => 'xsd:string',
			'catatan' => 'xsd:string',
			'diagnosa_awal' => 'xsd:string',
			'poli_tujuan' => 'xsd:string',
			'poli_eksekutif' => 'xsd:string',
			'cob' => 'xsd:string',
			'laka_lantas' => 'xsd:string',
			'penjamin' => 'xsd:string',
			'no_telp' => 'xsd:string',
			'user' => 'xsd:string',
			'katarak' => 'xsd:string',
			'tgl_kejadian' => 'xsd:string',
			'keterangan' => 'xsd:string',
			'suplesi' => 'xsd:string',
			'nosepsuplesi' => 'xsd:string',
			'kode_propinsi' => 'xsd:string',
			'kode_kabupaten' => 'xsd:string',
			'kode_kecamatan' => 'xsd:string',
			'no_surat' => 'xsd:string',
			'kode_dpjp' => 'xsd:string',
			'kelas_rawat_hak' => 'xsd:string',
			'kelas_rawat_naik' => 'xsd:string',
			'pembiayaan' => 'xsd:string',
			'penanggung_jawab' => 'xsd:string',
			'dpjp_layan' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimSEP_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Update SEP VClaim 2.0'
	);
	
	//Hapus SEP
	$server->wsdl->addComplexType(
		'responVClaimHapusSEP_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'response' => array('name'=>'response', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimHapusSEP',
		array(
			'noSep' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimHapusSEP_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Hapus SEP Pasien VClaim'
	);

	//Hapus SEP 2.0
	$server->wsdl->addComplexType(
		'responVClaimHapusSEP2_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'response' => array('name'=>'response', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimHapusSEP2',
		array(
			'noSep' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimHapusSEP2_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Hapus SEP 2.0 Pasien VClaim'
	);
	
	//Cari SEP
	$server->wsdl->addComplexType(
		'responVClaimCariSEP_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'catatan' => array('name'=>'catatan', 'type'=>'xsd:string'),
			'diagnosa' => array('name'=>'diagnosa', 'type'=>'xsd:string'),
			'jns_pelayanan' => array('name'=>'jns_pelayanan', 'type'=>'xsd:string'),
			'kelas_rawat' => array('name'=>'kelas_rawat', 'type'=>'xsd:string'),
			'no_sep' => array('name'=>'no_sep', 'type'=>'xsd:string'),
			'penjamin' => array('name'=>'penjamin', 'type'=>'xsd:string'),
			'asuransi' => array('name'=>'asuransi', 'type'=>'xsd:string'),
			'hak_kelas' => array('name'=>'hak_kelas', 'type'=>'xsd:string'),
			'jns_peserta' => array('name'=>'jns_peserta', 'type'=>'xsd:string'),
			'kelamin' => array('name'=>'kelamin', 'type'=>'xsd:string'),
			'nama' => array('name'=>'nama', 'type'=>'xsd:string'),
			'no_kartu' => array('name'=>'no_kartu', 'type'=>'xsd:string'),
			'norm' => array('name'=>'norm', 'type'=>'xsd:string'),
			'tgl_lahir' => array('name'=>'tgl_lahir', 'type'=>'xsd:string'),
			'poli' => array('name'=>'poli', 'type'=>'xsd:string'),
			'poli_eksekutif' => array('name'=>'poli_eksekutif', 'type'=>'xsd:string'),
			'tgl_sep' => array('name'=>'tgl_sep', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimCariSEP',
		array(
			'no_sep' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimCariSEP_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Cari SEP VClaim'
	);
	
	//Suplesi
	$server->wsdl->addComplexType(
		'responVClaimSuplesiJR_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'no_register' => array('name'=>'no_register', 'type'=>'xsd:string'),
			'no_sep' => array('name'=>'no_sep', 'type'=>'xsd:string'),
			'no_sepawal' => array('name'=>'no_sepawal', 'type'=>'xsd:string'),
			'no_suratjaminan' => array('name'=>'no_suratjaminan', 'type'=>'xsd:string'),
			'tgl_kejadian' => array('name'=>'tgl_kejadian', 'type'=>'xsd:string'),
			'tgl_sep' => array('name'=>'tgl_sep', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimSuplesiJR_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimSuplesiJR_result[]')),
		'tns:responVClaimSuplesiJR_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimSuplesiJRFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimSuplesiJR_resultArray')
		)
	);

	$server->register(
		'apiVClaimSuplesiJR',
		array('no_kartu' => 'xsd:string',
			  'tgl_pelayanan' => 'xsd:string'),
		array('return' => 'tns:responVClaimSuplesiJRFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data SuplesiJR VClaim'
	);
	
	//Pengajuan SEP
	$server->wsdl->addComplexType(
		'responVClaimPengajuan_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'response' => array('name'=>'response', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimPengajuan',
		array(
			'no_kartu' => 'xsd:string',
			'tgl_sep' => 'xsd:string',
			'jenis_pelayanan' => 'xsd:string',
			'jenis_pengajuan' => 'xsd:string',
			'keterangan' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimPengajuan_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Pengajuan SEP'
	);

	$server->register(
		'apiVClaimPengajuan11',
		array(
			'no_kartu' => 'xsd:string',
			'tgl_sep' => 'xsd:string',
			'jenis_pelayanan' => 'xsd:string',
			'jenis_pengajuan' => 'xsd:string',
			'keterangan' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimPengajuan_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Pengajuan SEP versi 1.1'
	);


	
	//Aproval pengajuan SEP11
	$server->wsdl->addComplexType(
		'responVClaimAproval11_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'response' => array('name'=>'response', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimAproval11',
		array(
			'no_kartu' => 'xsd:string',
			'tgl_sep' => 'xsd:string',
			'jenis_pelayanan' => 'xsd:string',
			'jenis_pengajuan' => 'xsd:string',
			'keterangan' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimAproval11_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Aproval pengajuan SEP 1.1'
	);
	
	//Aproval pengajuan SEP
	$server->wsdl->addComplexType(
		'responVClaimAproval_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'response' => array('name'=>'response', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimAproval',
		array(
			'no_kartu' => 'xsd:string',
			'tgl_sep' => 'xsd:string',
			'jenis_pelayanan' => 'xsd:string',
			'keterangan' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimAproval_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Aproval pengajuan SEP'
	);
	
	//Update tanggal pulang
	$server->wsdl->addComplexType(
		'responVClaimUpdatePulang_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'response' => array('name'=>'response', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimUpdatePulang',
		array(
			'noSep' => 'xsd:string',
			'tglPlg' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimUpdatePulang_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Update tanggal pulang SEP'
	);
	
	//Update tanggal pulang 2.0
	$server->wsdl->addComplexType(
		'responVClaimUpdatePulang2_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'response' => array('name'=>'response', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimUpdatePulang2',
		array(
			'noSep' => 'xsd:string',
			'statusPulang' => 'xsd:string',
			'noSuratMeninggal' => 'xsd:string',
			'tglMeninggal' => 'xsd:string',
			'tglPulang' => 'xsd:string',
			'noLPManual' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimUpdatePulang2_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Update tanggal pulang SEP 2.0'
	);
	
	//Integrasi Ina CBG
	$server->wsdl->addComplexType(
		'responVClaimIntegrasiInaCBG_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'kelamin' => array('name'=>'response', 'type'=>'xsd:string'),
			'kelas_rawat' => array('name'=>'response', 'type'=>'xsd:string'),
			'nama' => array('name'=>'response', 'type'=>'xsd:string'),
			'no_kartu_bpjs' => array('name'=>'response', 'type'=>'xsd:string'),
			'norm' => array('name'=>'response', 'type'=>'xsd:string'),
			'no_rujukan' => array('name'=>'response', 'type'=>'xsd:string'),
			'tgl_lahir' => array('name'=>'response', 'type'=>'xsd:string'),
			'tgl_pelayanan' => array('name'=>'response', 'type'=>'xsd:string'),
			'tkt_pelayanan' => array('name'=>'response', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimIntegrasiInaCBG',
		array(
			'no_sep' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimIntegrasiInaCBG_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Integrasi SEP dan Inacbg'
	);

	//Cari Rujukan
	$server->wsdl->addComplexType(
		'responVClaimRujukan_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			"metadata_code" => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			"metadata_message" => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			"catatan" => array('name'=>'catatan', 'type'=>'xsd:string'),
			"kd_diagnosa" => array('name'=>'kd_diagnosa', 'type'=>'xsd:string'),
			"nm_diagnosa" => array('name'=>'nm_diagnosa', 'type'=>'xsd:string'),
			"keluhan" => array('name'=>'keluhan', 'type'=>'xsd:string'),
			"no_kunjungan" => array('name'=>'no_kunjungan', 'type'=>'xsd:string'),
			"pem_fisik_lain" => array('name'=>'pem_fisik_lain', 'type'=>'xsd:string'),
			"dinsos" => array('name'=>'dinsos', 'type'=>'xsd:string'),
			"iuran" => array('name'=>'iuran', 'type'=>'xsd:string'),
			"no_sktm" => array('name'=>'no_sktm', 'type'=>'xsd:string'),
			"prolanis_prb" => array('name'=>'prolanis_prb', 'type'=>'xsd:string'),
			"kd_jenis_peserta" => array('name'=>'kd_jenis_peserta', 'type'=>'xsd:string'),
			"nm_jenis_peserta" => array('name'=>'nm_jenis_peserta', 'type'=>'xsd:string'),
			"kd_kelas" => array('name'=>'kd_kelas', 'type'=>'xsd:string'),
			"nm_kelas" => array('name'=>'nm_kelas', 'type'=>'xsd:string'),
			"nama" => array('name'=>'nama', 'type'=>'xsd:string'),
			"nik" => array('name'=>'nik', 'type'=>'xsd:string'),
			"no_kartu" => array('name'=>'no_kartu', 'type'=>'xsd:string'),
			"norm" => array('name'=>'norm', 'type'=>'xsd:string'),
			"pisa" => array('name'=>'pisa', 'type'=>'xsd:string'),
			"kd_cabang_prov_umum" => array('name'=>'kd_cabang_prov_umum', 'type'=>'xsd:string'),
			"kd_provider_prov_umum" => array('name'=>'kd_provider_prov_umum', 'type'=>'xsd:string'),
			"nm_cabang_prov_umum" => array('name'=>'nm_cabang_prov_umum', 'type'=>'xsd:string'),
			"nm_provider_prov_umum" => array('name'=>'nm_provider_prov_umum', 'type'=>'xsd:string'),
			"sex" => array('name'=>'sex', 'type'=>'xsd:string'),
			"status_peserta" => array('name'=>'status_peserta', 'type'=>'xsd:string'),
			"kd_status_peserta" => array('name'=>'kd_status_peserta', 'type'=>'xsd:string'),
			"tgl_cetak_kartu" => array('name'=>'tgl_cetak_kartu', 'type'=>'xsd:string'),
			"tgl_lahir" => array('name'=>'tgl_lahir', 'type'=>'xsd:string'),
			"tgl_tat" => array('name'=>'tgl_tat', 'type'=>'xsd:string'),
			"tgl_tmt" => array('name'=>'tgl_tmt', 'type'=>'xsd:string'),
			"umur" => array('name'=>'umur', 'type'=>'xsd:string'),
			"kd_poli_rujuk" => array('name'=>'kd_poli_rujuk', 'type'=>'xsd:string'),
			"nm_poli_rujuk" => array('name'=>'nm_poli_rujuk', 'type'=>'xsd:string'),
			"kd_cabang_prov_kunjungan" => array('name'=>'kd_cabang_prov_kunjungan', 'type'=>'xsd:string'),
			"kd_provider_prov_kunjungan" => array('name'=>'kd_provider_prov_kunjungan', 'type'=>'xsd:string'),
			"nm_cabang_prov_kunjungan" => array('name'=>'nm_cabang_prov_kunjungan', 'type'=>'xsd:string'),
			"nm_provider_prov_kunjungan" => array('name'=>'nm_provider_prov_kunjungan', 'type'=>'xsd:string'),
			"kd_cabang_prov_rujuk" => array('name'=>'kd_cabang_prov_rujuk', 'type'=>'xsd:string'),
			"kd_provider_prov_rujuk" => array('name'=>'kd_provider_prov_rujuk', 'type'=>'xsd:string'),
			"nm_cabang_prov_rujuk" => array('name'=>'nm_cabang_prov_rujuk', 'type'=>'xsd:string'),
			"nm_provider_prov_rujuk" => array('name'=>'nm_provider_prov_rujuk', 'type'=>'xsd:string'),
			"tgl_kunjungan" => array('name'=>'tgl_kunjungan', 'type'=>'xsd:string'),
			"nm_pelayanan" => array('name'=>'nm_pelayanan', 'type'=>'xsd:string'),
			"tkt_pelayanan" => array('name'=>'tkt_pelayanan', 'type'=>'xsd:string'),
			"nama_asuransi_cob" => array('name'=>'nama_asuransi_cob', 'type'=>'xsd:string'),
			"no_asuransi_cob" => array('name'=>'no_asuransi_cob', 'type'=>'xsd:string'),
			"tgl_tat_cob" => array('name'=>'tgl_tat_cob', 'type'=>'xsd:string'),
			"tgl_tmt_cob" => array('name'=>'tgl_tmt_cob', 'type'=>'xsd:string'),
			"no_telp" => array('name'=>'no_telp', 'type'=>'xsd:string'),
			"umur_saat_pelayanan" => array('name'=>'umur_saat_pelayanan', 'type'=>'xsd:string')
		)
	);
	
	//PCare
	$server->register(
		'apiVClaimRujukanPCare',
		array(
			'varRequest' => 'xsd:string',
			'tipeRequest' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimRujukan_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data rujukan PCare peserta VClaim'
	);
	
	//RS
	$server->register(
		'apiVClaimRujukanRS',
		array(
			'varRequest' => 'xsd:string',
			'tipeRequest' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimRujukan_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data rujukan RS peserta VClaim'
	);
	
	//All
	$server->register(
		'apiVClaimRujukan',
		array(
			'varRequest' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimRujukan_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data rujukan peserta VClaim'
	);

	//Rujukan multi record berdasarkan nomor peserta dan tanggal rujukan
	$server->wsdl->addComplexType(
		'responVClaimListRujukan_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kd_diagnosa' => array('name'=>'kd_diagnosa', 'type'=>'xsd:string'),
		    'nm_diagnosa' => array('name'=>'nm_diagnosa', 'type'=>'xsd:string'),
		    'keluhan' => array('name'=>'keluhan', 'type'=>'xsd:string'),
			'no_kunjungan' => array('name'=>'no_kunjungan', 'type'=>'xsd:string'),
			'kode_pelayanan' => array('name'=>'kode_pelayanan', 'type'=>'xsd:string'),
			'nama_pelayanan' => array('name'=>'nama_pelayanan', 'type'=>'xsd:string'),
			'nama_asuransi_cob' => array('name'=>'nama_asuransi_cob', 'type'=>'xsd:string'),
			'no_asuransi_cob' => array('name'=>'no_asuransi_cob', 'type'=>'xsd:string'),
			'tgl_tat_cob' => array('name'=>'tgl_tat_cob', 'type'=>'xsd:string'),
			'tgl_tmt_cob' => array('name'=>'tgl_tmt_cob', 'type'=>'xsd:string'),
			'nm_kelas' => array('name'=>'nm_kelas', 'type'=>'xsd:string'),
			'kd_kelas' => array('name'=>'kd_kelas', 'type'=>'xsd:string'),
			'dinsos' => array('name'=>'dinsos', 'type'=>'xsd:string'),
			'no_sktm' => array('name'=>'no_sktm', 'type'=>'xsd:string'),
			'prolanis_prb' => array('name'=>'prolanis_prb', 'type'=>'xsd:string'),
			'nm_jenis_peserta' => array('name'=>'nm_jenis_peserta', 'type'=>'xsd:string'),
			'kd_jenis_peserta' => array('name'=>'kd_jenis_peserta', 'type'=>'xsd:string'),
			'norm' => array('name'=>'norm', 'type'=>'xsd:string'),
			'no_telp' => array('name'=>'no_telp', 'type'=>'xsd:string'),
			'nama' => array('name'=>'nama', 'type'=>'xsd:string'),
			'nik' => array('name'=>'nik', 'type'=>'xsd:string'),
			'no_kartu' => array('name'=>'no_kartu', 'type'=>'xsd:string'),
			'pisa' => array('name'=>'pisa', 'type'=>'xsd:string'),
			'kd_provider_prov_umum' => array('name'=>'kd_provider_prov_umum', 'type'=>'xsd:string'),
			'nm_provider_prov_umum' => array('name'=>'nm_provider_prov_umum', 'type'=>'xsd:string'),
			'sex' => array('name'=>'sex', 'type'=>'xsd:string'),
			'status_peserta' => array('name'=>'status_peserta', 'type'=>'xsd:string'),
			'kd_status_peserta' => array('name'=>'kd_status_peserta', 'type'=>'xsd:string'),
			'tgl_cetak_kartu' => array('name'=>'tgl_cetak_kartu', 'type'=>'xsd:string'),
			'tgl_lahir' => array('name'=>'tgl_lahir', 'type'=>'xsd:string'),
			'tgl_tat' => array('name'=>'tgl_tat', 'type'=>'xsd:string'),
			'tgl_tmt' => array('name'=>'tgl_tmt', 'type'=>'xsd:string'),
			'umur_saat_pelayanan' => array('name'=>'umur_saat_pelayanan', 'type'=>'xsd:string'),
			'umur' => array('name'=>'umur', 'type'=>'xsd:string'),
			'kd_poli_rujuk' => array('name'=>'kd_poli_rujuk', 'type'=>'xsd:string'),
			'nm_poli_rujuk' => array('name'=>'nm_poli_rujuk', 'type'=>'xsd:string'),
			'kd_provider_prov_rujuk' => array('name'=>'kd_provider_prov_rujuk', 'type'=>'xsd:string'),
			'nm_provider_prov_rujuk' => array('name'=>'nm_provider_prov_rujuk', 'type'=>'xsd:string'),
			'tgl_kunjungan' => array('name'=>'tgl_kunjungan', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimListRujukan_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimListRujukan_result[]')),
		'tns:responVClaimListRujukan_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimListRujukanFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimListRujukan_resultArray')
		)
	);
	
	//Vclaim List Rujukan PCare
	$server->register(
		'apiVClaimListRujukanPCare',
		array(
			'varrequest' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimListRujukanFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data List Rujukan PCare'
	);
	
	//Vclaim List Rujukan RS
	$server->register(
		'apiVClaimListRujukanRS',
		array(
			'varrequest' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimListRujukanFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data List Rujukan RS'
	);
	
	//Vclaim List Rujukan
	$server->register(
		'apiVClaimListRujukan',
		array(
			'varrequest' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimListRujukanFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data List Rujukan Puskesmas & RS'
	);
	
	//Vclaim Tanggal Rujukan PCare
	$server->register(
		'apiVClaimTglRujukanPCare',
		array(
			'varrequest' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimListRujukanFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data berdasarkan Tanggal Rujukan PCare'
	);
	
	//Vclaim Tanggal Rujukan RS
	$server->register(
		'apiVClaimTglRujukanRS',
		array(
			'varrequest' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimListRujukanFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Ambil data berdasarkan Tanggal Rujukan RS'
	);
	
	//Insert rujukan
	$server->wsdl->addComplexType(
		'responVClaimInsertRujukan_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'kode_asal_rujukan' => array('name'=>'kode_asal_rujukan', 'type'=>'xsd:string'),
			'nama_asal_rujukan' => array('name'=>'nama_asal_rujukan', 'type'=>'xsd:string'),
			'kode_diagnosa' => array('name'=>'kode_diagnosa', 'type'=>'xsd:string'),
			'nama_diagnosa' => array('name'=>'nama_diagnosa', 'type'=>'xsd:string'),
			'no_rujukan' => array('name'=>'no_rujukan', 'type'=>'xsd:string'),
			'asuransi' => array('name'=>'asuransi', 'type'=>'xsd:string'),
			'hak_kelas' => array('name'=>'hak_kelas', 'type'=>'xsd:string'),
			'jenis_peserta' => array('name'=>'jenis_peserta', 'type'=>'xsd:string'),
			'kelamin' => array('name'=>'kelamin', 'type'=>'xsd:string'),
			'nama' => array('name'=>'nama', 'type'=>'xsd:string'),
			'no_kartu' => array('name'=>'no_kartu', 'type'=>'xsd:string'),
			'norm' => array('name'=>'norm', 'type'=>'xsd:string'),
			'tgl_lahir' => array('name'=>'tgl_lahir', 'type'=>'xsd:string'),
			'kode_poli_tujuan' => array('name'=>'kode_poli_tujuan', 'type'=>'xsd:string'),
			'nama_poli_tujuan' => array('name'=>'nama_poli_tujuan', 'type'=>'xsd:string'),
			'tgl_rujukan' => array('name'=>'tgl_rujukan', 'type'=>'xsd:string'),
			'kode_tujuan_rujukan' => array('name'=>'kode_tujuan_rujukan', 'type'=>'xsd:string'),
			'nama_tujuan_rujukan' => array('name'=>'nama_tujuan_rujukan', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimInsertRujukan',
		array(
			'no_sep' => 'xsd:string',
			'tgl_rujukan' => 'xsd:string',
			'ppk_dirujuk' => 'xsd:string',
			'jenis_pelayanan' => 'xsd:string',
			'catatan' => 'xsd:string',
			'diagnosa_rujukan' => 'xsd:string',
			'tipe_rujukan' => 'xsd:string',
			'poli_rujukan' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimInsertRujukan_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Insert rujukan VClaim'
	);

	//Update rujukan
	$server->wsdl->addComplexType(
		'responVClaimUpdateRujukan_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'response' => array('name'=>'response', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimUpdateRujukan',
		array(
			'no_rujukan' => 'xsd:string',
			'ppk_dirujuk' => 'xsd:string',
			'tipe' => 'xsd:string',
			'jenis_pelayanan' => 'xsd:string',
			'catatan' => 'xsd:string',
			'diagnosa_rujukan' => 'xsd:string',
			'tipe_rujukan' => 'xsd:string',
			'poli_rujukan' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimUpdateRujukan_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Update SEP VClaim'
	);
	
	//Hapus rujukan
	$server->wsdl->addComplexType(
		'responVClaimHapusRujukan_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'response' => array('name'=>'response', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimHapusRujukan',
		array(
			'no_rujukan' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimHapusRujukan_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Hapus rujukan pasien VClaim'
	);
	
	//Insert PRB
	$server->wsdl->addComplexType(
		'responVClaimInsertPRB_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'response' => array('name'=>'response', 'type'=>'xsd:string')
		)
	);
	
	$server->register(
		'apiVClaimInsertPRB',
		array(
			'no_sep' => 'xsd:string',
			'no_kartu' => 'xsd:string',
			'alamat' => 'xsd:string',
			'email' => 'xsd:string',
			'program_prb' => 'xsd:string',
			'kode_dpjp' => 'xsd:string',
			'keterangan' => 'xsd:string',
			'saran' => 'xsd:string',
			'user' => 'xsd:string',
			'limit_obat' => 'xsd:string',
			'kode_obat1' => 'xsd:string',
			'kode_obat2' => 'xsd:string',
			'kode_obat3' => 'xsd:string',
			'kode_obat4' => 'xsd:string',
			'kode_obat5' => 'xsd:string',
			'kode_obat6' => 'xsd:string',
			'kode_obat7' => 'xsd:string',
			'kode_obat8' => 'xsd:string',
			'kode_obat9' => 'xsd:string',
			'kode_obat10' => 'xsd:string',
			'kode_obat11' => 'xsd:string',
			'kode_obat12' => 'xsd:string',
			'kode_obat13' => 'xsd:string',
			'kode_obat14' => 'xsd:string',
			'kode_obat15' => 'xsd:string',
			'kode_obat16' => 'xsd:string',
			'kode_obat17' => 'xsd:string',
			'kode_obat18' => 'xsd:string',
			'kode_obat19' => 'xsd:string',
			'kode_obat20' => 'xsd:string',
			'kode_obat21' => 'xsd:string',
			'kode_obat22' => 'xsd:string',
			'kode_obat23' => 'xsd:string',
			'kode_obat24' => 'xsd:string',
			'kode_obat25' => 'xsd:string',
			'kode_obat26' => 'xsd:string',
			'kode_obat27' => 'xsd:string',
			'kode_obat28' => 'xsd:string',
			'kode_obat29' => 'xsd:string',
			'kode_obat30' => 'xsd:string',
			'signa1_1' => 'xsd:string',
			'signa1_2' => 'xsd:string',
			'signa1_3' => 'xsd:string',
			'signa1_4' => 'xsd:string',
			'signa1_5' => 'xsd:string',
			'signa1_6' => 'xsd:string',
			'signa1_7' => 'xsd:string',
			'signa1_8' => 'xsd:string',
			'signa1_9' => 'xsd:string',
			'signa1_10' => 'xsd:string',
			'signa1_11' => 'xsd:string',
			'signa1_12' => 'xsd:string',
			'signa1_13' => 'xsd:string',
			'signa1_14' => 'xsd:string',
			'signa1_15' => 'xsd:string',
			'signa1_16' => 'xsd:string',
			'signa1_17' => 'xsd:string',
			'signa1_18' => 'xsd:string',
			'signa1_19' => 'xsd:string',
			'signa1_20' => 'xsd:string',
			'signa1_21' => 'xsd:string',
			'signa1_22' => 'xsd:string',
			'signa1_23' => 'xsd:string',
			'signa1_24' => 'xsd:string',
			'signa1_25' => 'xsd:string',
			'signa1_26' => 'xsd:string',
			'signa1_27' => 'xsd:string',
			'signa1_28' => 'xsd:string',
			'signa1_29' => 'xsd:string',
			'signa1_30' => 'xsd:string',
			'signa2_1' => 'xsd:string',
			'signa2_2' => 'xsd:string',
			'signa2_3' => 'xsd:string',
			'signa2_4' => 'xsd:string',
			'signa2_5' => 'xsd:string',
			'signa2_6' => 'xsd:string',
			'signa2_7' => 'xsd:string',
			'signa2_8' => 'xsd:string',
			'signa2_9' => 'xsd:string',
			'signa2_10' => 'xsd:string',
			'signa2_11' => 'xsd:string',
			'signa2_12' => 'xsd:string',
			'signa2_13' => 'xsd:string',
			'signa2_14' => 'xsd:string',
			'signa2_15' => 'xsd:string',
			'signa2_16' => 'xsd:string',
			'signa2_17' => 'xsd:string',
			'signa2_18' => 'xsd:string',
			'signa2_19' => 'xsd:string',
			'signa2_20' => 'xsd:string',
			'signa2_21' => 'xsd:string',
			'signa2_22' => 'xsd:string',
			'signa2_23' => 'xsd:string',
			'signa2_24' => 'xsd:string',
			'signa2_25' => 'xsd:string',
			'signa2_26' => 'xsd:string',
			'signa2_27' => 'xsd:string',
			'signa2_28' => 'xsd:string',
			'signa2_29' => 'xsd:string',
			'signa2_30' => 'xsd:string',
			'jml_obat1' => 'xsd:string',
			'jml_obat2' => 'xsd:string',
			'jml_obat3' => 'xsd:string',
			'jml_obat4' => 'xsd:string',
			'jml_obat5' => 'xsd:string',
			'jml_obat6' => 'xsd:string',
			'jml_obat7' => 'xsd:string',
			'jml_obat8' => 'xsd:string',
			'jml_obat9' => 'xsd:string',
			'jml_obat10' => 'xsd:string',
			'jml_obat11' => 'xsd:string',
			'jml_obat12' => 'xsd:string',
			'jml_obat13' => 'xsd:string',
			'jml_obat14' => 'xsd:string',
			'jml_obat15' => 'xsd:string',
			'jml_obat16' => 'xsd:string',
			'jml_obat17' => 'xsd:string',
			'jml_obat18' => 'xsd:string',
			'jml_obat19' => 'xsd:string',
			'jml_obat20' => 'xsd:string',
			'jml_obat21' => 'xsd:string',
			'jml_obat22' => 'xsd:string',
			'jml_obat23' => 'xsd:string',
			'jml_obat24' => 'xsd:string',
			'jml_obat25' => 'xsd:string',
			'jml_obat26' => 'xsd:string',
			'jml_obat27' => 'xsd:string',
			'jml_obat28' => 'xsd:string',
			'jml_obat29' => 'xsd:string',
			'jml_obat30' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimInsertPRB_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Insert data PRB pasien VClaim'
	);
	
	//Insert LPK
	$server->wsdl->addComplexType(
		'responVClaimInsertLPK_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'response' => array('name'=>'response', 'type'=>'xsd:string')
		)
	);
	
	$server->register(
		'apiVClaimInsertLPK',
		array(
			'no_sep' => 'xsd:string',
			'tgl_masuk' => 'xsd:string',
			'tgl_keluar' => 'xsd:string',
			'jaminan' => 'xsd:string',
			'poli' => 'xsd:string',
			'ruang_rawat_perawatan' => 'xsd:string',
			'kelas_rawat_perawatan' => 'xsd:string',
			'spesialistik_perawatan' => 'xsd:string',
			'cara_keluar_perawatan' => 'xsd:string',
			'kondisi_pulang_perawatan' => 'xsd:string',
			'limit_diagnosa' => 'xsd:string',
			'limit_prosedur' => 'xsd:string',
			'kode_diagnosa1' => 'xsd:string',
			'kode_diagnosa2' => 'xsd:string',
			'kode_diagnosa3' => 'xsd:string',
			'kode_diagnosa4' => 'xsd:string',
			'kode_diagnosa5' => 'xsd:string',
			'kode_diagnosa6' => 'xsd:string',
			'kode_diagnosa7' => 'xsd:string',
			'kode_diagnosa8' => 'xsd:string',
			'kode_diagnosa9' => 'xsd:string',
			'kode_diagnosa10' => 'xsd:string',
			'kode_diagnosa11' => 'xsd:string',
			'kode_diagnosa12' => 'xsd:string',
			'kode_diagnosa13' => 'xsd:string',
			'kode_diagnosa14' => 'xsd:string',
			'kode_diagnosa15' => 'xsd:string',
			'kode_diagnosa16' => 'xsd:string',
			'kode_diagnosa17' => 'xsd:string',
			'kode_diagnosa18' => 'xsd:string',
			'kode_diagnosa19' => 'xsd:string',
			'kode_diagnosa20' => 'xsd:string',
			'kode_diagnosa21' => 'xsd:string',
			'kode_diagnosa22' => 'xsd:string',
			'kode_diagnosa23' => 'xsd:string',
			'kode_diagnosa24' => 'xsd:string',
			'kode_diagnosa25' => 'xsd:string',
			'kode_diagnosa26' => 'xsd:string',
			'kode_diagnosa27' => 'xsd:string',
			'kode_diagnosa28' => 'xsd:string',
			'kode_diagnosa29' => 'xsd:string',
			'kode_diagnosa30' => 'xsd:string',
			'kode_prosedur1' => 'xsd:string',
			'kode_prosedur2' => 'xsd:string',
			'kode_prosedur3' => 'xsd:string',
			'kode_prosedur4' => 'xsd:string',
			'kode_prosedur5' => 'xsd:string',
			'kode_prosedur6' => 'xsd:string',
			'kode_prosedur7' => 'xsd:string',
			'kode_prosedur8' => 'xsd:string',
			'kode_prosedur9' => 'xsd:string',
			'kode_prosedur10' => 'xsd:string',
			'kode_prosedur11' => 'xsd:string',
			'kode_prosedur12' => 'xsd:string',
			'kode_prosedur13' => 'xsd:string',
			'kode_prosedur14' => 'xsd:string',
			'kode_prosedur15' => 'xsd:string',
			'kode_prosedur16' => 'xsd:string',
			'kode_prosedur17' => 'xsd:string',
			'kode_prosedur18' => 'xsd:string',
			'kode_prosedur19' => 'xsd:string',
			'kode_prosedur20' => 'xsd:string',
			'kode_prosedur21' => 'xsd:string',
			'kode_prosedur22' => 'xsd:string',
			'kode_prosedur23' => 'xsd:string',
			'kode_prosedur24' => 'xsd:string',
			'kode_prosedur25' => 'xsd:string',
			'kode_prosedur26' => 'xsd:string',
			'kode_prosedur27' => 'xsd:string',
			'kode_prosedur28' => 'xsd:string',
			'kode_prosedur29' => 'xsd:string',
			'kode_prosedur30' => 'xsd:string',
			'tindak_lanjut' => 'xsd:string',
			'kode_ppkrencanadirujuk' => 'xsd:string',
			'tgl_rencanakontrolkembali' => 'xsd:string',
			'poli_rencanakontrolkembali' => 'xsd:string',
			'dpjp' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimInsertLPK_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Insert data LPK pasien VClaim'
	);

	//Update LPK
	$server->wsdl->addComplexType(
		'responVClaimUpdateLPK_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'response' => array('name'=>'response', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimUpdateLPK',
		array(
			'no_sep' => 'xsd:string',
			'tgl_masuk' => 'xsd:string',
			'tgl_keluar' => 'xsd:string',
			'jaminan' => 'xsd:string',
			'poli' => 'xsd:string',
			'ruang_rawat_perawatan' => 'xsd:string',
			'kelas_rawat_perawatan' => 'xsd:string',
			'spesialistik_perawatan' => 'xsd:string',
			'cara_keluar_perawatan' => 'xsd:string',
			'kondisi_pulang_perawatan' => 'xsd:string',
			'limit_diagnosa' => 'xsd:string',
			'limit_prosedur' => 'xsd:string',
			'kode_diagnosa1' => 'xsd:string',
			'kode_diagnosa2' => 'xsd:string',
			'kode_diagnosa3' => 'xsd:string',
			'kode_diagnosa4' => 'xsd:string',
			'kode_diagnosa5' => 'xsd:string',
			'kode_diagnosa6' => 'xsd:string',
			'kode_diagnosa7' => 'xsd:string',
			'kode_diagnosa8' => 'xsd:string',
			'kode_diagnosa9' => 'xsd:string',
			'kode_diagnosa10' => 'xsd:string',
			'kode_diagnosa11' => 'xsd:string',
			'kode_diagnosa12' => 'xsd:string',
			'kode_diagnosa13' => 'xsd:string',
			'kode_diagnosa14' => 'xsd:string',
			'kode_diagnosa15' => 'xsd:string',
			'kode_diagnosa16' => 'xsd:string',
			'kode_diagnosa17' => 'xsd:string',
			'kode_diagnosa18' => 'xsd:string',
			'kode_diagnosa19' => 'xsd:string',
			'kode_diagnosa20' => 'xsd:string',
			'kode_diagnosa21' => 'xsd:string',
			'kode_diagnosa22' => 'xsd:string',
			'kode_diagnosa23' => 'xsd:string',
			'kode_diagnosa24' => 'xsd:string',
			'kode_diagnosa25' => 'xsd:string',
			'kode_diagnosa26' => 'xsd:string',
			'kode_diagnosa27' => 'xsd:string',
			'kode_diagnosa28' => 'xsd:string',
			'kode_diagnosa29' => 'xsd:string',
			'kode_diagnosa30' => 'xsd:string',
			'kode_prosedur1' => 'xsd:string',
			'kode_prosedur2' => 'xsd:string',
			'kode_prosedur3' => 'xsd:string',
			'kode_prosedur4' => 'xsd:string',
			'kode_prosedur5' => 'xsd:string',
			'kode_prosedur6' => 'xsd:string',
			'kode_prosedur7' => 'xsd:string',
			'kode_prosedur8' => 'xsd:string',
			'kode_prosedur9' => 'xsd:string',
			'kode_prosedur10' => 'xsd:string',
			'kode_prosedur11' => 'xsd:string',
			'kode_prosedur12' => 'xsd:string',
			'kode_prosedur13' => 'xsd:string',
			'kode_prosedur14' => 'xsd:string',
			'kode_prosedur15' => 'xsd:string',
			'kode_prosedur16' => 'xsd:string',
			'kode_prosedur17' => 'xsd:string',
			'kode_prosedur18' => 'xsd:string',
			'kode_prosedur19' => 'xsd:string',
			'kode_prosedur20' => 'xsd:string',
			'kode_prosedur21' => 'xsd:string',
			'kode_prosedur22' => 'xsd:string',
			'kode_prosedur23' => 'xsd:string',
			'kode_prosedur24' => 'xsd:string',
			'kode_prosedur25' => 'xsd:string',
			'kode_prosedur26' => 'xsd:string',
			'kode_prosedur27' => 'xsd:string',
			'kode_prosedur28' => 'xsd:string',
			'kode_prosedur29' => 'xsd:string',
			'kode_prosedur30' => 'xsd:string',
			'tindak_lanjut' => 'xsd:string',
			'kode_ppkrencanadirujuk' => 'xsd:string',
			'tgl_rencanakontrolkembali' => 'xsd:string',
			'poli_rencanakontrolkembali' => 'xsd:string',
			'dpjp' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimUpdateLPK_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Update data LPK pasien VClaim'
	);
	
	//Hapus LPK
	$server->wsdl->addComplexType(
		'responVClaimHapusLPK_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'response' => array('name'=>'response', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimHapusLPK',
		array('no_sep' => 'xsd:string'),
		array('return' => 'tns:responVClaimHapusLPK_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Hapus data LPK pasien VClaim'
	);


	//data LPK
	$server->wsdl->addComplexType(
		'responVClaimDiagnosaLPK_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'level' => array('name'=>'level', 'type'=>'xsd:string'),
			'kode_diagnosa' => array('name'=>'kode_diagnosa', 'type'=>'xsd:string'),
			'nama_diagnosa' => array('name'=>'nama_diagnosa', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimDiagnosaLPK_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimDiagnosaLPK_result[]')),
		'tns:responVClaimDiagnosaLPK_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimDataLPK_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kode_dokter_dpjp' => array('name'=>'kode_dokter_dpjp', 'type'=>'xsd:string'),
			'nama_dokter_dpjp' => array('name'=>'nama_dokter_dpjp', 'type'=>'xsd:string'),
			'count_diagnosa' => array('name'=>'count_diagnosa', 'type'=>'xsd:string'),
			'diagnosa' => array('name'=>'diagnosa', 'type'=>'tns:responVClaimDiagnosaLPK_resultArray'),
			'jenis_pelayanan' => array('name'=>'jenis_pelayanan', 'type'=>'xsd:string'),
			'no_sep' => array('name'=>'no_sep', 'type'=>'xsd:string'),
			'kode_carakeluar' => array('name'=>'kode_carakeluar', 'type'=>'xsd:string'),
			'nama_carakeluar' => array('name'=>'nama_carakeluar', 'type'=>'xsd:string'),
			'kode_kelasrawat' => array('name'=>'kode_kelasrawat', 'type'=>'xsd:string'),
			'nama_kelasrawat' => array('name'=>'nama_kelasrawat', 'type'=>'xsd:string'),
			'kode_kondisipulang' => array('name'=>'kode_kondisipulang', 'type'=>'xsd:string'),
			'nama_kondisipulang' => array('name'=>'nama_kondisipulang', 'type'=>'xsd:string'),
			'kode_ruangrawat' => array('name'=>'kode_ruangrawat', 'type'=>'xsd:string'),
			'nama_ruangrawat' => array('name'=>'nama_ruangrawat', 'type'=>'xsd:string'),
			'kode_spesialistik' => array('name'=>'kode_spesialistik', 'type'=>'xsd:string'),
			'nama_spesialistik' => array('name'=>'nama_spesialistik', 'type'=>'xsd:string'),
			'kelamin' => array('name'=>'kelamin', 'type'=>'xsd:string'),
			'nama' => array('name'=>'nama', 'type'=>'xsd:string'),
			'no_kartu' => array('name'=>'no_kartu', 'type'=>'xsd:string'),
			'norm' => array('name'=>'norm', 'type'=>'xsd:string'),
			'tgl_lahir' => array('name'=>'tgl_lahir', 'type'=>'xsd:string'),
			'poli_eksekutif' => array('name'=>'poli_eksekutif', 'type'=>'xsd:string'),
			'kode_poli' => array('name'=>'kode_poli', 'type'=>'xsd:string'),
			'count_prosedur' => array('name'=>'count_prosedur', 'type'=>'xsd:string'),
			'prosedur' => array('name'=>'prosedur', 'type'=>'tns:responVClaimProsedur_resultArray'),
			'rencana_tl' => array('name'=>'rencana_tl', 'type'=>'xsd:string'),
			'tgl_keluar' => array('name'=>'tgl_keluar', 'type'=>'xsd:string'),
			'tgl_masuk' => array('name'=>'tgl_masuk', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimDataLPK_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimDataLPK_result[]')),
		'tns:responVClaimDataLPK_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimDataLPKFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'count_lpk' => array('name'=>'count_lpk', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimDataLPK_resultArray')
		)
	);

	$server->register(
		'apiVClaimDataLPK',
		array(
			'tgl_masuk' => 'xsd:string',
			'jenis_pelayanan' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimDataLPKFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Data lembar pengajuan klaim VClaim'
	);

	//Monitoring data kunjungan
	$server->wsdl->addComplexType(
		'responVClaimDataKunjungan_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'diagnosa' => array('name'=>'diagnosa', 'type'=>'xsd:string'),
			'jenis_pelayanan' => array('name'=>'jenis_pelayanan', 'type'=>'xsd:string'),
			'kelas_rawat' => array('name'=>'kelas_rawat', 'type'=>'xsd:string'),
			'nama' => array('name'=>'nama', 'type'=>'xsd:string'),
			'no_kartu' => array('name'=>'no_kartu', 'type'=>'xsd:string'),
			'no_sep' => array('name'=>'no_sep', 'type'=>'xsd:string'),
			'poli' => array('name'=>'poli', 'type'=>'xsd:string'),
			'tgl_pulangsep' => array('name'=>'tgl_pulangsep', 'type'=>'xsd:string'),
			'tgl_sep' => array('name'=>'tgl_sep', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimDataKunjungan_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimDataKunjungan_result[]')),
		'tns:responVClaimDataKunjungan_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimDataKunjunganFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimDataKunjungan_resultArray')
		)
	);

	$server->register(
		'apiVClaimDataKunjungan',
		array(
			'tgl_masuk' => 'xsd:string',
			'jenis_pelayanan' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimDataKunjunganFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Monitoring kunjungan peserta BPJS'
	);

	//Monitoring data klaim
	$server->wsdl->addComplexType(
		'responVClaimDataKlaim_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'diagnosa' => array('name'=>'diagnosa', 'type'=>'xsd:string'),
			'jenis_pelayanan' => array('name'=>'jenis_pelayanan', 'type'=>'xsd:string'),
			'kelas_rawat' => array('name'=>'kelas_rawat', 'type'=>'xsd:string'),
			'nama' => array('name'=>'nama', 'type'=>'xsd:string'),
			'no_kartu' => array('name'=>'no_kartu', 'type'=>'xsd:string'),
			'no_sep' => array('name'=>'no_sep', 'type'=>'xsd:string'),
			'poli' => array('name'=>'poli', 'type'=>'xsd:string'),
			'tgl_pulangsep' => array('name'=>'tgl_pulangsep', 'type'=>'xsd:string'),
			'tgl_sep' => array('name'=>'tgl_sep', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimDataKlaim_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimDataKlaim_result[]')),
		'tns:responVClaimDataKlaim_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimDataKlaimFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimDataKlaim_resultArray')
		)
	);

	$server->register(
		'apiVClaimDataKlaim',
		array(
			'tgl_pulang' => 'xsd:string',
			'jenis_pelayanan' => 'xsd:string',
			'status_klaim' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimDataKlaimFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Monitoring Data Klaim'
	);

	//Monitoring data histori pelayanan peserta
	$server->wsdl->addComplexType(
		'responVClaimDataLayananPeserta_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'diagnosa' => array('name'=>'diagnosa', 'type'=>'xsd:string'),
			'jenis_pelayanan' => array('name'=>'jenis_pelayanan', 'type'=>'xsd:string'),
			'kelas_rawat' => array('name'=>'kelas_rawat', 'type'=>'xsd:string'),
			'nama' => array('name'=>'nama', 'type'=>'xsd:string'),
			'no_kartu' => array('name'=>'no_kartu', 'type'=>'xsd:string'),
			'no_sep' => array('name'=>'no_sep', 'type'=>'xsd:string'),
			'no_rujukan' => array('name'=>'no_rujukan', 'type'=>'xsd:string'),
			'poli' => array('name'=>'poli', 'type'=>'xsd:string'),
			'ppk_pelayanan' => array('name'=>'ppk_pelayanan', 'type'=>'xsd:string'),
			'tgl_pulangsep' => array('name'=>'tgl_pulangsep', 'type'=>'xsd:string'),
			'tgl_sep' => array('name'=>'tgl_sep', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimDataLayananPeserta_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimDataLayananPeserta_result[]')),
		'tns:responVClaimDataLayananPeserta_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimDataLayananPesertaFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimDataLayananPeserta_resultArray')
		)
	);

	$server->register(
		'apiVClaimDataLayananPeserta',
		array(
			'no_kartu' => 'xsd:string',
			'tgl_mulai' => 'xsd:string',
			'tgl_akhir' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimDataLayananPesertaFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Monitoring Data Histori Layanan Peserta'
	);

	//Monitoring data klaim jaminan Jasa Raharja
	$server->wsdl->addComplexType(
		'responVClaimDataJaminanJR_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'no_sep' => array('name'=>'no_sep', 'type'=>'xsd:string'),
			'tgl_sep' => array('name'=>'tgl_sep', 'type'=>'xsd:string'),
			'tgl_pulangsep' => array('name'=>'tgl_pulangsep', 'type'=>'xsd:string'),
			'norm' => array('name'=>'norm', 'type'=>'xsd:string'),
			'jenis_pelayanan' => array('name'=>'jenis_pelayanan', 'type'=>'xsd:string'),
			'poli' => array('name'=>'poli', 'type'=>'xsd:string'),
			'diagnosa' => array('name'=>'diagnosa', 'type'=>'xsd:string'),
			'no_kartu' => array('name'=>'no_kartu', 'type'=>'xsd:string'),
			'nama' => array('name'=>'nama', 'type'=>'xsd:string'),
			'norm_peserta' => array('name'=>'norm_peserta', 'type'=>'xsd:string'),
			'tgl_kejadian' => array('name'=>'tgl_kejadian', 'type'=>'xsd:string'),
			'nomor_register' => array('name'=>'nomor_register', 'type'=>'xsd:string'),
			'ket_statusdijamin' => array('name'=>'ket_statusdijamin', 'type'=>'xsd:string'),
			'ket_statusdikirim' => array('name'=>'ket_statusdikirim', 'type'=>'xsd:string'),
			'biaya_dijamin' => array('name'=>'biaya_dijamin', 'type'=>'xsd:string'),
			'plafon' => array('name'=>'plafon', 'type'=>'xsd:string'),
			'jumlah_dibayar' => array('name'=>'jumlah_dibayar', 'type'=>'xsd:string'),
			'resultjr' => array('name'=>'resultjr', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimDataJaminanJR_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimDataJaminanJR_result[]')),
		'tns:responVClaimDataJaminanJR_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimDataJaminanJRFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimDataJaminanJR_resultArray')
		)
	);

	$server->register(
		'apiVClaimDataJaminanJR',
		array(
			'tgl_mulai' => 'xsd:string',
			'tgl_akhir' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimDataJaminanJRFull_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Monitoring Data Klaim Jaminan Jasa Raharja'
	);
	
	//Insert Rencana Kontrol
	$server->wsdl->addComplexType(
		'responVClaimInsertRencanaKontrol_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'nosuratkontrol' => array('name'=>'nosuratkontrol', 'type'=>'xsd:string'),
			'tglrencanakontrol' => array('name'=>'tglrencanakontrol', 'type'=>'xsd:string'),
			'namadokter' => array('name'=>'namadokter', 'type'=>'xsd:string'),
			'nokartu' => array('name'=>'nokartu', 'type'=>'xsd:string'),
			'nama' => array('name'=>'nama', 'type'=>'xsd:string'),
			'kelamin' => array('name'=>'kelamin', 'type'=>'xsd:string'),
			'tgllahir' => array('name'=>'tgllahir', 'type'=>'xsd:string')
		)
	);
	
	$server->register(
		'apiVClaimInsertRencanaKontrol',
		array(
			'no_sep' => 'xsd:string',
			'kode_dokter' => 'xsd:string',
			'poli_kontrol' => 'xsd:string',
			'tgl_rencana_kontrol' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimInsertRencanaKontrol_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Insert rencana kontrol VClaim'
	);
	
	//Update Rencana Kontrol
	$server->wsdl->addComplexType(
		'responVClaimUpdateRencanaKontrol_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'nosuratkontrol' => array('name'=>'nosuratkontrol', 'type'=>'xsd:string'),
			'tglrencanakontrol' => array('name'=>'tglrencanakontrol', 'type'=>'xsd:string'),
			'namadokter' => array('name'=>'namadokter', 'type'=>'xsd:string'),
			'nokartu' => array('name'=>'nokartu', 'type'=>'xsd:string'),
			'nama' => array('name'=>'nama', 'type'=>'xsd:string'),
			'kelamin' => array('name'=>'kelamin', 'type'=>'xsd:string'),
			'tgllahir' => array('name'=>'tgllahir', 'type'=>'xsd:string')
		)
	);
	
	$server->register(
		'apiVClaimUpdateRencanaKontrol',
		array(
			'no_surat_kontrol' => 'xsd:string',
			'no_sep' => 'xsd:string',
			'kode_dokter' => 'xsd:string',
			'poli_kontrol' => 'xsd:string',
			'tgl_rencana_kontrol' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimUpdateRencanaKontrol_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Update rencana kontrol VClaim'
	);
	
	//Hapus Rencana Kontrol
	$server->wsdl->addComplexType(
		'responVClaimHapusRencanaKontrol_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'response' => array('name'=>'response', 'type'=>'xsd:string')
		)
	);
	
	$server->register(
		'apiVClaimHapusRencanaKontrol',
		array(
			'no_surat_kontrol' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimHapusRencanaKontrol_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Hapus rencana kontrol VClaim'
	);
	
	//Cari Surat Kontrol
	$server->wsdl->addComplexType(
		'responVClaimCariSuratKontrol_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'no_suratkontrol' => array('name'=>'no_suratkontrol', 'type'=>'xsd:string'),
			'tglrencanakontrol' => array('name'=>'tglrencanakontrol', 'type'=>'xsd:string'),
			'tglterbit' => array('name'=>'tglterbit', 'type'=>'xsd:string'),
			'jnskontrol' => array('name'=>'jnskontrol', 'type'=>'xsd:string'),
			'politujuan' => array('name'=>'politujuan', 'type'=>'xsd:string'),
			'namapolitujuan' => array('name'=>'namapolitujuan', 'type'=>'xsd:string'),
			'kodedokter' => array('name'=>'kodedokter', 'type'=>'xsd:string'),
			'namadokter' => array('name'=>'namadokter', 'type'=>'xsd:string'),
			'flagkontrol' => array('name'=>'flagkontrol', 'type'=>'xsd:string'),
			'kodedokterpembuat' => array('name'=>'kodedokterpembuat', 'type'=>'xsd:string'),
			'namadokterpembuat' => array('name'=>'namadokterpembuat', 'type'=>'xsd:string'),
			'namajnskontrol' => array('name'=>'namajnskontrol', 'type'=>'xsd:string'),
			'nosep' => array('name'=>'nosep', 'type'=>'xsd:string'),
			'tglsep' => array('name'=>'tglsep', 'type'=>'xsd:string'),
			'jnspelayanan' => array('name'=>'jnspelayanan', 'type'=>'xsd:string'),
			'poli' => array('name'=>'poli', 'type'=>'xsd:string'),
			'diagnosa' => array('name'=>'diagnosa', 'type'=>'xsd:string'),
			'nokartu' => array('name'=>'nokartu', 'type'=>'xsd:string'),
			'nama' => array('name'=>'nama', 'type'=>'xsd:string'),
			'tgllahir' => array('name'=>'tgllahir', 'type'=>'xsd:string'),
			'kelamin' => array('name'=>'kelamin', 'type'=>'xsd:string'),
			'hakkelas' => array('name'=>'hakkelas', 'type'=>'xsd:string'),
			'kdprovider' => array('name'=>'kdprovider', 'type'=>'xsd:string'),
			'nmprovider' => array('name'=>'nmprovider', 'type'=>'xsd:string'),
			'kdproviderperujuk' => array('name'=>'kdproviderperujuk', 'type'=>'xsd:string'),
			'nmproviderperujuk' => array('name'=>'nmproviderperujuk', 'type'=>'xsd:string'),
			'asalrujukan' => array('name'=>'asalrujukan', 'type'=>'xsd:string'),
			'norujukan' => array('name'=>'norujukan', 'type'=>'xsd:string'),
			'tglrujukan' => array('name'=>'tglrujukan', 'type'=>'xsd:string')
		)
	);
	
	$server->register(
		'apiVClaimCariSuratKontrol',
		array(
			'no_surat_kontrol' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimCariSuratKontrol_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Cari surat kontrol VClaim'
	);
	
	//Insert SPRI
	$server->wsdl->addComplexType(
		'responVClaimInsertSPRI_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'nospri' => array('name'=>'nospri', 'type'=>'xsd:string'),
			'tglrencanakontrol' => array('name'=>'tglrencanakontrol', 'type'=>'xsd:string'),
			'namadokter' => array('name'=>'namadokter', 'type'=>'xsd:string'),
			'nokartu' => array('name'=>'nokartu', 'type'=>'xsd:string'),
			'nama' => array('name'=>'nama', 'type'=>'xsd:string'),
			'kelamin' => array('name'=>'kelamin', 'type'=>'xsd:string'),
			'tgllahir' => array('name'=>'tgllahir', 'type'=>'xsd:string'),
			'namadiagnosa' => array('name'=>'namadiagnosa', 'type'=>'xsd:string')
		)
	);
	
	$server->register(
		'apiVClaimInsertSPRI',
		array(
			'no_kartu' => 'xsd:string',
			'kode_dokter' => 'xsd:string',
			'poli_kontrol' => 'xsd:string',
			'tgl_rencana_kontrol' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimInsertSPRI_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Insert SPRI VClaim'
	);
	
	//Update SPRI
	$server->wsdl->addComplexType(
		'responVClaimUpdateSPRI_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'nospri' => array('name'=>'nospri', 'type'=>'xsd:string'),
			'tglrencanakontrol' => array('name'=>'tglrencanakontrol', 'type'=>'xsd:string'),
			'namadokter' => array('name'=>'namadokter', 'type'=>'xsd:string'),
			'nokartu' => array('name'=>'nokartu', 'type'=>'xsd:string'),
			'nama' => array('name'=>'nama', 'type'=>'xsd:string'),
			'kelamin' => array('name'=>'kelamin', 'type'=>'xsd:string'),
			'tgllahir' => array('name'=>'tgllahir', 'type'=>'xsd:string'),
			'namadiagnosa' => array('name'=>'namadiagnosa', 'type'=>'xsd:string')
		)
	);
	
	$server->register(
		'apiVClaimUpdateSPRI',
		array(
			'no_spri' => 'xsd:string',
			'kode_dokter' => 'xsd:string',
			'poli_kontrol' => 'xsd:string',
			'tgl_rencana_kontrol' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimUpdateSPRI_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Update SPRI VClaim'
	);
	
	//Cari SEP Rencana Kontrol
	$server->wsdl->addComplexType(
		'responVClaimSEPRencanaKontrol_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'nosep' => array('name'=>'nosep', 'type'=>'xsd:string'),
			'tglsep' => array('name'=>'tglsep', 'type'=>'xsd:string'),
			'jnspelayanan' => array('name'=>'jnspelayanan', 'type'=>'xsd:string'),
			'poli' => array('name'=>'poli', 'type'=>'xsd:string'),
			'nokartu' => array('name'=>'nokartu', 'type'=>'xsd:string'),
			'nama' => array('name'=>'nama', 'type'=>'xsd:string'),
			'tgllahir' => array('name'=>'tgllahir', 'type'=>'xsd:string'),
			'kelamin' => array('name'=>'kelamin', 'type'=>'xsd:string'),
			'hakkelas' => array('name'=>'hakkelas', 'type'=>'xsd:string'),
			'kdprovider' => array('name'=>'kdprovider', 'type'=>'xsd:string'),
			'namaprovider' => array('name'=>'namaprovider', 'type'=>'xsd:string'),
			'kdproviderperujuk' => array('name'=>'kdproviderperujuk', 'type'=>'xsd:string'),
			'nmproviderperujuk' => array('name'=>'nmproviderperujuk', 'type'=>'xsd:string'),
			'asalrujukan' => array('name'=>'asalrujukan', 'type'=>'xsd:string'),
			'norujukan' => array('name'=>'norujukan', 'type'=>'xsd:string'),
			'tglrujukan' => array('name'=>'tglrujukan', 'type'=>'xsd:string')
		)
	);
	
	$server->register(
		'apiVClaimSEPRencanaKontrol',
		array(
			'no_sep' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimSEPRencanaKontrol_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Cari SEP rencana kontrol VClaim'
	);
	
	//Data Rencana Kontrol
	$server->wsdl->addComplexType(
		'responVClaimDataKontrol_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'noSuratKontrol' => array('name'=>'noSuratKontrol', 'type'=>'xsd:string'),
			'jnsPelayanan' => array('name'=>'jnsPelayanan', 'type'=>'xsd:string'),
			'jnsKontrol' => array('name'=>'jnsKontrol', 'type'=>'xsd:string'),
			'namaJnsKontrol' => array('name'=>'namaJnsKontrol', 'type'=>'xsd:string'),
			'tglRencanaKontrol' => array('name'=>'tglRencanaKontrol', 'type'=>'xsd:string'),
			'tglTerbitKontrol' => array('name'=>'tglTerbitKontrol', 'type'=>'xsd:string'),
			'noSepAsalKontrol' => array('name'=>'noSepAsalKontrol', 'type'=>'xsd:string'),
			'poliAsal' => array('name'=>'poliAsal', 'type'=>'xsd:string'),
			'namaPoliAsal' => array('name'=>'namaPoliAsal', 'type'=>'xsd:string'),
			'poliTujuan' => array('name'=>'poliTujuan', 'type'=>'xsd:string'),
			'namaPoliTujuan' => array('name'=>'namaPoliTujuan', 'type'=>'xsd:string'),
			'tglSEP' => array('name'=>'tglSEP', 'type'=>'xsd:string'),
			'kodeDokter' => array('name'=>'kodeDokter', 'type'=>'xsd:string'),
			'namaDokter' => array('name'=>'namaDokter', 'type'=>'xsd:string'),
			'noKartu' => array('name'=>'noKartu', 'type'=>'xsd:string'),
			'nama' => array('name'=>'nama', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimDataKontrol_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimDataKontrol_result[]')),
		'tns:responVClaimDataKontrol_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimDataKontrolFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimDataKontrol_resultArray')
		)
	);

	$server->register(
		'apiVClaimDataRencanaKontrol',
		array(
			'tgl_awal' => 'xsd:string',
			'tgl_akhir' => 'xsd:string',
			'filter' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimDataKontrolFull_result'),
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Data rencana kontrol VClaim'
	);

	//Data Rencana Kontrol By No Kartu //UPDATE 2022-03-24
	$server->wsdl->addComplexType(
		'responVClaimDataKontrolByNokartu_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'noSuratKontrol' => array('name'=>'noSuratKontrol', 'type'=>'xsd:string'),
			'jnsPelayanan' => array('name'=>'jnsPelayanan', 'type'=>'xsd:string'),
			'jnsKontrol' => array('name'=>'jnsKontrol', 'type'=>'xsd:string'),
			'namaJnsKontrol' => array('name'=>'namaJnsKontrol', 'type'=>'xsd:string'),
			'tglRencanaKontrol' => array('name'=>'tglRencanaKontrol', 'type'=>'xsd:string'),
			'tglTerbitKontrol' => array('name'=>'tglTerbitKontrol', 'type'=>'xsd:string'),
			'noSepAsalKontrol' => array('name'=>'noSepAsalKontrol', 'type'=>'xsd:string'),
			'poliAsal' => array('name'=>'poliAsal', 'type'=>'xsd:string'),
			'namaPoliAsal' => array('name'=>'namaPoliAsal', 'type'=>'xsd:string'),
			'poliTujuan' => array('name'=>'poliTujuan', 'type'=>'xsd:string'),
			'namaPoliTujuan' => array('name'=>'namaPoliTujuan', 'type'=>'xsd:string'),
			'tglSEP' => array('name'=>'tglSEP', 'type'=>'xsd:string'),
			'kodeDokter' => array('name'=>'kodeDokter', 'type'=>'xsd:string'),
			'namaDokter' => array('name'=>'namaDokter', 'type'=>'xsd:string'),
			'noKartu' => array('name'=>'noKartu', 'type'=>'xsd:string'),
			'nama' => array('name'=>'nama', 'type'=>'xsd:string'),
			'terbitSEP' => array('name'=>'terbitSEP', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimDataKontrolByNokartu_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimDataKontrolByNokartu_result[]')),
		'tns:responVClaimDataKontrolByNokartu_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimDataKontrolByNokartuFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimDataKontrolByNokartu_resultArray')
		)
	);

	$server->register(
		'apiVClaimDataRencanaKontrolByNoKartu',
		array(
			'bulan' => 'xsd:string',
			'tahun' => 'xsd:string',
			'nokartu' => 'xsd:string',
			'filter' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimDataKontrolByNokartuFull_result'),
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Data rencana kontrol VClaim By No Kartu'
	);
	
	//Dokter Rencana Kontrol
	$server->wsdl->addComplexType(
		'responVClaimDokterKontrol_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kodeDokter' => array('name'=>'kodeDokter', 'type'=>'xsd:string'),
			'namaDokter' => array('name'=>'namaDokter', 'type'=>'xsd:string'),
			'jadwalPraktek' => array('name'=>'jadwalPraktek', 'type'=>'xsd:string'),
			'kapasitas' => array('name'=>'kapasitas', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimDokterKontrol_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimDokterKontrol_result[]')),
		'tns:responVClaimDokterKontrol_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimDokterKontrolFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimDokterKontrol_resultArray')
		)
	);

	$server->register(
		'apiVClaimDokterRencanaKontrol',
		array(
			'jns_kontrol' => 'xsd:string',
			'kd_poli' => 'xsd:string',
			'tgl_rencana_kontrol' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimDokterKontrolFull_result'),
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Data dokter rencana kontrol VClaim'
	);
	
	//Poli Rencana Kontrol
	$server->wsdl->addComplexType(
		'responVClaimPoliKontrol_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kodePoli' => array('name'=>'kodePoli', 'type'=>'xsd:string'),
			'namaPoli' => array('name'=>'namaPoli', 'type'=>'xsd:string'),
			'kapasitas' => array('name'=>'kapasitas', 'type'=>'xsd:string'),
			'jmlRencanaKontroldanRujukan' => array('name'=>'jmlRencanaKontroldanRujukan', 'type'=>'xsd:string'),
			'persentase' => array('name'=>'persentase', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimPoliKontrol_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimPoliKontrol_result[]')),
		'tns:responVClaimPoliKontrol_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimPoliKontrolFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimPoliKontrol_resultArray')
		)
	);

	$server->register(
		'apiVClaimPoliRencanaKontrol',
		array(
			'jns_kontrol' => 'xsd:string',
			'nomor' => 'xsd:string',
			'tgl_rencana_kontrol' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimPoliKontrolFull_result'),
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Data poli rencana kontrol VClaim'
	);
	
	//Insert rujukan 2.0
	$server->wsdl->addComplexType(
		'responVClaimInsertRujukan2_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'kode_asal_rujukan' => array('name'=>'kode_asal_rujukan', 'type'=>'xsd:string'),
			'nama_asal_rujukan' => array('name'=>'nama_asal_rujukan', 'type'=>'xsd:string'),
			'kode_diagnosa' => array('name'=>'kode_diagnosa', 'type'=>'xsd:string'),
			'nama_diagnosa' => array('name'=>'nama_diagnosa', 'type'=>'xsd:string'),
			'no_rujukan' => array('name'=>'no_rujukan', 'type'=>'xsd:string'),
			'asuransi' => array('name'=>'asuransi', 'type'=>'xsd:string'),
			'hak_kelas' => array('name'=>'hak_kelas', 'type'=>'xsd:string'),
			'jenis_peserta' => array('name'=>'jenis_peserta', 'type'=>'xsd:string'),
			'kelamin' => array('name'=>'kelamin', 'type'=>'xsd:string'),
			'nama' => array('name'=>'nama', 'type'=>'xsd:string'),
			'no_kartu' => array('name'=>'no_kartu', 'type'=>'xsd:string'),
			'norm' => array('name'=>'norm', 'type'=>'xsd:string'),
			'tgl_lahir' => array('name'=>'tgl_lahir', 'type'=>'xsd:string'),
			'kode_poli_tujuan' => array('name'=>'kode_poli_tujuan', 'type'=>'xsd:string'),
			'nama_poli_tujuan' => array('name'=>'nama_poli_tujuan', 'type'=>'xsd:string'),
			'tgl_berlaku_kunjungan' => array('name'=>'tgl_berlaku_kunjungan', 'type'=>'xsd:string'),
			'tgl_rencana_kunjungan' => array('name'=>'tgl_rencana_kunjungan', 'type'=>'xsd:string'),
			'tgl_rujukan' => array('name'=>'tgl_rujukan', 'type'=>'xsd:string'),
			'kode_tujuan_rujukan' => array('name'=>'kode_tujuan_rujukan', 'type'=>'xsd:string'),
			'nama_tujuan_rujukan' => array('name'=>'nama_tujuan_rujukan', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimInsertRujukan2',
		array(
			'no_sep' => 'xsd:string',
			'tgl_rujukan' => 'xsd:string',
			'tgl_rencana_kunjungan' => 'xsd:string',
			'ppk_dirujuk' => 'xsd:string',
			'jenis_pelayanan' => 'xsd:string',
			'catatan' => 'xsd:string',
			'diagnosa_rujukan' => 'xsd:string',
			'tipe_rujukan' => 'xsd:string',
			'poli_rujukan' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimInsertRujukan2_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Insert rujukan VClaim 2.0'
	);
	
	//Update rujukan
	$server->wsdl->addComplexType(
		'responVClaimUpdateRujukan2_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'kode_asal_rujukan' => array('name'=>'kode_asal_rujukan', 'type'=>'xsd:string'),
			'nama_asal_rujukan' => array('name'=>'nama_asal_rujukan', 'type'=>'xsd:string'),
			'kode_diagnosa' => array('name'=>'kode_diagnosa', 'type'=>'xsd:string'),
			'nama_diagnosa' => array('name'=>'nama_diagnosa', 'type'=>'xsd:string'),
			'no_rujukan' => array('name'=>'no_rujukan', 'type'=>'xsd:string'),
			'asuransi' => array('name'=>'asuransi', 'type'=>'xsd:string'),
			'hak_kelas' => array('name'=>'hak_kelas', 'type'=>'xsd:string'),
			'jenis_peserta' => array('name'=>'jenis_peserta', 'type'=>'xsd:string'),
			'kelamin' => array('name'=>'kelamin', 'type'=>'xsd:string'),
			'nama' => array('name'=>'nama', 'type'=>'xsd:string'),
			'no_kartu' => array('name'=>'no_kartu', 'type'=>'xsd:string'),
			'norm' => array('name'=>'norm', 'type'=>'xsd:string'),
			'tgl_lahir' => array('name'=>'tgl_lahir', 'type'=>'xsd:string'),
			'kode_poli_tujuan' => array('name'=>'kode_poli_tujuan', 'type'=>'xsd:string'),
			'nama_poli_tujuan' => array('name'=>'nama_poli_tujuan', 'type'=>'xsd:string'),
			'tgl_berlaku_kunjungan' => array('name'=>'tgl_berlaku_kunjungan', 'type'=>'xsd:string'),
			'tgl_rencana_kunjungan' => array('name'=>'tgl_rencana_kunjungan', 'type'=>'xsd:string'),
			'tgl_rujukan' => array('name'=>'tgl_rujukan', 'type'=>'xsd:string'),
			'kode_tujuan_rujukan' => array('name'=>'kode_tujuan_rujukan', 'type'=>'xsd:string'),
			'nama_tujuan_rujukan' => array('name'=>'nama_tujuan_rujukan', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimUpdateRujukan2',
		array(
			'no_rujukan' => 'xsd:string',
			'tgl_rujukan' => 'xsd:string',
			'tgl_rencana_kunjungan' => 'xsd:string',
			'ppk_dirujuk' => 'xsd:string',
			'jenis_pelayanan' => 'xsd:string',
			'catatan' => 'xsd:string',
			'diagnosa_rujukan' => 'xsd:string',
			'tipe_rujukan' => 'xsd:string',
			'poli_rujukan' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimUpdateRujukan2_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Update rujukan VClaim 2.0'
	);
	
	//Insert rujukan khusus
	$server->wsdl->addComplexType(
		'responVClaimInsertRujukanKhusus_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'norujukan' => array('name'=>'norujukan', 'type'=>'xsd:string'),
			'nokapst' => array('name'=>'nokapst', 'type'=>'xsd:string'),
			'nmpst' => array('name'=>'nmpst', 'type'=>'xsd:string'),
			'diagppk' => array('name'=>'diagppk', 'type'=>'xsd:string'),
			'tglrujukan_awal' => array('name'=>'tglrujukan_awal', 'type'=>'xsd:string'),
			'tglrujukan_berakhir' => array('name'=>'tglrujukan_berakhir', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimInsertRujukanKhusus',
		array(
			'no_rujukan' => 'xsd:string',
			'kode_diagnosa' => 'xsd:string',
			'kode_prosedur' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimInsertRujukanKhusus_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Insert rujukan khusus VClaim'
	);
	
	//Hapus rujukan khusus
	$server->wsdl->addComplexType(
		'responVClaimHapusRujukanKhusus_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'response' => array('name'=>'response', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimHapusRujukanKhusus',
		array(
			'id_rujukan' => 'xsd:string',
			'no_rujukan' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimHapusRujukanKhusus_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Hapus rujukan khusus VClaim'
	);
	
	//Data Rujukan Khusus
	$server->wsdl->addComplexType(
		'responVClaimDataRujukanKhusus_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'idrujukan' => array('name'=>'idrujukan', 'type'=>'xsd:string'),
			'norujukan' => array('name'=>'norujukan', 'type'=>'xsd:string'),
			'nokapst' => array('name'=>'nokapst', 'type'=>'xsd:string'),
			'nmpst' => array('name'=>'nmpst', 'type'=>'xsd:string'),
			'diagppk' => array('name'=>'diagppk', 'type'=>'xsd:string'),
			'tglrujukan_awal' => array('name'=>'tglrujukan_awal', 'type'=>'xsd:string'),
			'tglrujukan_berakhir' => array('name'=>'tglrujukan_berakhir', 'type'=>'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimDataRujukanKhusus_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimDataRujukanKhusus_result[]')),
		'tns:responVClaimDataRujukanKhusus_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimDataRujukanKhususFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'rujukan' => array('name'=>'rujukan', 'type'=>'tns:responVClaimDataRujukanKhusus_resultArray')
		)
	);

	$server->register(
		'apiVClaimDataRujukanKhusus',
		array(
			'bulan' => 'xsd:string',
			'tahun' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimDataRujukanKhususFull_result'),
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Data rujukan khusus VClaim'
	);

	//List Spesialistik Rujukan

	$server->wsdl->addComplexType(
		'responVClaimListSpesialistikRujukan_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kodespesialis' => array('name'=>'kodespesialis', 'type'=>'xsd:string'),
			'namaspesialis' => array('name'=>'namaspesialis', 'type'=>'xsd:string'),
			'kapasitas' => array('name'=>'kapasitas', 'type'=>'xsd:string'),
			'jumlahrujukan' => array('name'=>'jumlahrujukan', 'type'=>'xsd:string'),
			'persentase' => array('name'=>'persentase', 'type'=>'xsd:string'),
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimListSpesialistikRujukan_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimListSpesialistikRujukan_result[]')),
		'tns:responVClaimListSpesialistikRujukan_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimListSpesialistikRujukanFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimListSpesialistikRujukan_resultArray')
		)
	);

	$server->register(
		'apiVClaimListSpesialistikRujukan',
		array(
			'kodeppk' => 'xsd:string',
			'tglrujukan' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimListSpesialistikRujukanFull_result'),
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'List Spesialistik Rujukan VClaim'
	);

	//List Sarana

	$server->wsdl->addComplexType(
		'responVClaimListSarana_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'kodesarana' => array('name'=>'kodesarana', 'type'=>'xsd:string'),
			'namasarana' => array('name'=>'namasarana', 'type'=>'xsd:string'),
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimListSarana_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimListSarana_result[]')),
		'tns:responVClaimListSarana_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimListSaranaFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimListSarana_resultArray')
		)
	);

	$server->register(
		'apiVClaimListSarana',
		array(
			'kodeppk' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimListSaranaFull_result'),
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'List Sarana VClaim'
	);

	//Data Induk Kecelakaan

	$server->wsdl->addComplexType(
		'responVClaimDataIndukKecelakaan_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'nosep' => array('name'=>'nosep', 'type'=>'xsd:string'),
			'tglkejadian' => array('name'=>'tglkejadian', 'type'=>'xsd:string'),
			'ppkpelsep' => array('name'=>'ppkpelsep', 'type'=>'xsd:string'),
			'kdprop' => array('name'=>'kdprop', 'type'=>'xsd:string'),
			'kdkab' => array('name'=>'kdkab', 'type'=>'xsd:string'),
			'kdkec' => array('name'=>'kdkec', 'type'=>'xsd:string'),
			'ketkejadian' => array('name'=>'ketkejadian', 'type'=>'xsd:string'),
			'nosepsuplesi' => array('name'=>'nosepsuplesi', 'type'=>'xsd:string'),
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimDataIndukKecelakaan_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimDataIndukKecelakaan_result[]')),
		'tns:responVClaimDataIndukKecelakaan_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimDataIndukKecelakaanFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimDataIndukKecelakaan_resultArray')
		)
	);

	$server->register(
		'apiVClaimDataIndukKecelakaan',
		array(
			'nokartu' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimDataIndukKecelakaanFull_result'),
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Data Induk Kecelakaan VClaim'
	);

	//Data SEP Internal

	$server->wsdl->addComplexType(
		'responVClaimDataSEPInternal_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'tujuanrujuk' => array('name'=>'tujuanrujuk', 'type'=>'xsd:string'),
			'nmtujuanrujuk' => array('name'=>'nmtujuanrujuk', 'type'=>'xsd:string'),
			'nmpoliasal' => array('name'=>'nmpoliasal', 'type'=>'xsd:string'),
			'tglrujukinternal' => array('name'=>'tglrujukinternal', 'type'=>'xsd:string'),
			'nosep' => array('name'=>'nosep', 'type'=>'xsd:string'),
			'nosepref' => array('name'=>'nosepref', 'type'=>'xsd:string'),
			'ppkpelsep' => array('name'=>'ppkpelsep', 'type'=>'xsd:string'),
			'nokapst' => array('name'=>'nokapst', 'type'=>'xsd:string'),
			'tglsep' => array('name'=>'tglsep', 'type'=>'xsd:string'),
			'nosurat' => array('name'=>'nosurat', 'type'=>'xsd:string'),
			'flaginternal' => array('name'=>'flaginternal', 'type'=>'xsd:string'),
			'kdpoliasal' => array('name'=>'kdpoliasal', 'type'=>'xsd:string'),
			'kdpolituj' => array('name'=>'kdpolituj', 'type'=>'xsd:string'),
			'kdpenunjang' => array('name'=>'kdpenunjang', 'type'=>'xsd:string'),
			'nmpenunjang' => array('name'=>'nmpenunjang', 'type'=>'xsd:string'),
			'diagppk' => array('name'=>'diagppk', 'type'=>'xsd:string'),
			'kddokter' => array('name'=>'kddokter', 'type'=>'xsd:string'),
			'nmdokter' => array('name'=>'nmdokter', 'type'=>'xsd:string'),
			'flagprosedur' => array('name'=>'flagprosedur', 'type'=>'xsd:string'),
			'opsikonsul' => array('name'=>'opsikonsul', 'type'=>'xsd:string'),
			'flagsep' => array('name'=>'flagsep', 'type'=>'xsd:string'),
			'fuser' => array('name'=>'fuser', 'type'=>'xsd:string'),
			'fdate' => array('name'=>'fdate', 'type'=>'xsd:string'),
			'nmdiag' => array('name'=>'nmdiag', 'type'=>'xsd:string'),
		)
	);

	$server->wsdl->addComplexType(
		'responVClaimDataSEPInternal_resultArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:responVClaimDataSEPInternal_result[]')),
		'tns:responVClaimDataSEPInternal_result'
	);

	$server->wsdl->addComplexType(
		'responVClaimDataSEPInternalFull_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'metadata_code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'metadata_message', 'type'=>'xsd:string'),
			'count' => array('name'=>'count', 'type'=>'xsd:string'),
			'list' => array('name'=>'list', 'type'=>'tns:responVClaimDataSEPInternal_resultArray')
		)
	);

	$server->register(
		'apiVClaimDataSEPInternal',
		array(
			'nosep' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimDataSEPInternalFull_result'),
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Data SEP Internal VClaim'
	);
	

	//Hapus SEP Internal
	$server->wsdl->addComplexType(
		'responVClaimHapusSEPInternal_result',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'metadata_code' => array('name'=>'code', 'type'=>'xsd:string'),
			'metadata_message' => array('name'=>'message', 'type'=>'xsd:string'),
			'response' => array('name'=>'response', 'type'=>'xsd:string')
		)
	);

	$server->register(
		'apiVClaimHapusSEPInternal',
		array(
			'noSep' => 'xsd:string',
			'noSurat' => 'xsd:string',
			'tglRujukanInternal' => 'xsd:string',
			'kdPoliTuj' => 'xsd:string',
			'user' => 'xsd:string'
		),
		array('return' => 'tns:responVClaimHapusSEPInternal_result'), 
		'vclaim_wsdl',
		false,
		'rpc',
		'encoded',
		'Hapus SEP Internal VClaim'
	);
$request = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($request);
?>