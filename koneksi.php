<?php

$db_host="DEMO";
$db_user="sa";
$db_pass="starwars";
$db_name="FO_BLJ";

sybase_min_server_severity(11);
sybase_min_client_severity(11);

//Koneksi server
$link = @sybase_connect($db_host, $db_user, $db_pass) 
or die ("Koneksi Gagal Ke Database karena databasenya mati!");
if (!$link) {
	echo "Koneksi Gagal";
} 

//Pilih database
$db_selected = @sybase_select_db($db_name, $link);
if (!$db_selected) {
    die ('Tidak bisa memilih database');
}

?>