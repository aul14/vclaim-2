<?php
//0001867144959
//AM
// $consumerid = '21311';
// $consumersecret = '8kGE8A7AA6';
// $userkey = 'b4e3dc60db03f492c697824b65109898';

//CBB OPS
$consumerid = '28518';
$consumersecret = '1vKD085AAB';
$userkey = '6c12ebaaf430fb75adc56840d83d4d41';

//STM OPS
// $consumerid = '15503';
// $consumersecret = '4hY926F636';
// $userkey = 'e9ed590484ba179275bd916666569901';


//STM TEST
// $consumerid = '1389';
// $consumersecret = 'rs1soe2tomo3';
// $userkey = '6920a00ad467b51086003de8758460ca';


//Jika menggunakan http://api.bpjs-kesehatan.go.id berarti koneksi ke internet. 
//Jika menggunakan http://192.168.1.3:8082 berarti koneksi lokal. 

$basic_url = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/';
// $basic_url = 'https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest';

$url_diagnosa = $basic_url.'/referensi/diagnosa/';
$url_poli = $basic_url.'/referensi/poli/';
$url_faskes = $basic_url.'/referensi/faskes/';
$url_dpjp = $basic_url.'/referensi/dokter/pelayanan/'; 				//vclaim versi 1.1
$url_propinsi = $basic_url.'/referensi/propinsi'; 					//vclaim versi 1.1
$url_kabupaten = $basic_url.'/referensi/kabupaten/propinsi/'; 		//vclaim versi 1.1
$url_kecamatan = $basic_url.'/referensi/kecamatan/kabupaten/'; 		//vclaim versi 1.1
$url_prosedur = $basic_url.'/referensi/procedure/';
$url_kelasrawat = $basic_url.'/referensi/kelasrawat';
$url_dokter = $basic_url.'/referensi/dokter/';
$url_spesialistik = $basic_url.'/referensi/spesialistik';
$url_ruangrawat = $basic_url.'/referensi/ruangrawat';
$url_carakeluar = $basic_url.'/referensi/carakeluar';
$url_pascapulang = $basic_url.'/referensi/pascapulang';

$url_cari_peserta = $basic_url .'/Peserta';

$url_insert_sep = $basic_url .'/SEP/insert';
$url_update_sep = $basic_url .'/SEP/Update';
$url_insert_sep11 = $basic_url .'/SEP/1.1/insert'; 					//vclaim versi 1.1
$url_update_sep11 = $basic_url .'/SEP/1.1/Update'; 					//vclaim versi 1.1
$url_insert_sep2 = $basic_url .'/SEP/2.0/insert'; 					//vclaim versi 2.0
$url_update_sep2 = $basic_url .'/SEP/2.0/update'; 					//vclaim versi 2.0

$url_delete_sep = $basic_url .'/SEP/Delete';
$url_delete_sep2 = $basic_url .'/SEP/2.0/delete'; 					//vclaim versi 2.0
$url_cari_sep = $basic_url .'/SEP/';

$url_suplesijr = $basic_url .'/sep/JasaRaharja/Suplesi/'; 			//vclaim versi 1.1

$url_pengajuan = $basic_url .'/Sep/pengajuanSEP';
$url_aproval = $basic_url .'/Sep/aprovalSEP';

$url_update_plg = $basic_url .'/Sep/updtglplg';
$url_update_plg2 = $basic_url .'/SEP/2.0/updtglplg';				//vclaim versi 2.0

$url_integrasi_inacbg = $basic_url .'/sep/cbg/';

$url_insert_rencana_kontrol = $basic_url .'/RencanaKontrol/insert';
$url_update_rencana_kontrol = $basic_url .'/RencanaKontrol/Update';
$url_delete_rencana_kontrol = $basic_url .'/RencanaKontrol/Delete';

$url_sep_rencana_kontrol = $basic_url .'/RencanaKontrol/nosep/';
$url_list_rencana_kontrol = $basic_url .'/RencanaKontrol/ListRencanaKontrol/';
$url_cari_surat_kontrol = $basic_url .'/RencanaKontrol/noSuratKontrol/';
$url_dokter_rencana_kontrol = $basic_url .'/RencanaKontrol/JadwalPraktekDokter/';
$url_poli_rencana_kontrol = $basic_url .'/RencanaKontrol/ListSpesialistik/';

$url_insert_spri = $basic_url .'/RencanaKontrol/InsertSPRI';
$url_update_spri = $basic_url .'/RencanaKontrol/UpdateSPRI';

$url_rujukan_pcare = $basic_url.'/Rujukan/';
$url_rujukan_rs = $basic_url.'/Rujukan/RS/';

$url_list_rujukan_pcare = $basic_url.'/Rujukan/List/Peserta/'; 				//vclaim versi 2
$url_list_rujukan_rs = $basic_url.'/Rujukan/RS/List/Peserta/'; 				//vclaim versi 2
$url_tgl_rujukan_pcare = $basic_url.'/Rujukan/TglRujukan/'; 		//vclaim versi 1.1
$url_tgl_rujukan_rs = $basic_url.'/Rujukan/RS/TglRujukan/'; 		//vclaim versi 1.1

$url_insert_rujukan = $basic_url .'/Rujukan/insert';
$url_update_rujukan = $basic_url .'/Rujukan/update';
$url_insert_rujukan2 = $basic_url .'/Rujukan/2.0/insert';			//vclaim versi 2.0
$url_update_rujukan2 = $basic_url .'/Rujukan/2.0/Update';			//vclaim versi 2.0
$url_delete_rujukan = $basic_url .'/Rujukan/delete';

$url_insert_rujukan_khusus = $basic_url.'/Rujukan/Khusus/insert';
$url_delete_rujukan_khusus = $basic_url.'/Rujukan/Khusus/delete';
$url_list_rujukan_khusus = $basic_url.'/Rujukan/Khusus/List/';

$url_insert_lpk = $basic_url .'/LPK/insert';
$url_update_lpk = $basic_url .'/LPK/update';
$url_delete_lpk = $basic_url .'/LPK/delete';
$url_data_lpk = $basic_url .'/LPK/';

$url_data_kunjungan = $basic_url .'/Monitoring/Kunjungan/';
$url_data_klaim = $basic_url .'/Monitoring/Klaim/';

$url_data_histori_lyn = $basic_url .'/monitoring/HistoriPelayanan/'; //vclaim versi 1.1
$url_data_klaimjr = $basic_url .'/monitoring/JasaRaharja/'; //vclaim versi 1.1

$url_list_spesialistik_rujukan = $basic_url .'/Rujukan/ListSpesialistik/';
$url_list_sarana = $basic_url .'/Rujukan/ListSarana/PPKRujukan/';

$url_list_induk_kecelakaan = $basic_url .'/sep/KllInduk/List/';

$url_list_sep_internal = $basic_url .'/SEP/Internal/';
$url_delete_sep_internal = $basic_url .'/SEP/Internal/delete'; 		

/*Setting untuk monitoring IP, port, dan WS. Alamat monitoring diambil dari $url_dasar_cari_peserta*/
$pingporttimeout = 15; 				//Setting timeout saat mengecek port. Maksimum 45 detik
$nopesertates = '0000371374479'; 	//No peserta yang digunakan untuk monitoring tes web service
$log_service = "0"; 				//0: tidak membuat log, 1 : membuat log

// jika tidak menggunakan if pda define tidak bisa cek pesearta pada monitoring.php
if(!defined('ConsumerID')) define('ConsumerID', $consumerid);
if(!defined('ConsumerSecret')) define('ConsumerSecret', $consumersecret);
if(!defined('UserKey')) define('UserKey', $userkey);
if(!defined("LOG_SERVICE")) define("LOG_SERVICE", $log_service);

// define('ConsumerID', $consumerid);
// define('ConsumerSecret', $consumersecret);
// define('UserKey', $userkey);
?>