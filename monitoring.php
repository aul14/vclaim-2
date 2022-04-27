<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>VClaim Monitoring</title>
	<style type="text/css" title="currentStyle">
		@import "include/media/css/bpjsmon_page.css";
		@import "include/media/css/bpjsmon_table.css";
	</style>
	<script type="text/javascript" language="javascript" src="include/media/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" language="javascript" src="include/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" charset="utf-8">
		var gi_idsettimeout;
		
		$(document).ready(function() {
			$('#tabmon').dataTable( {
				"aaSorting": [[ 0, "desc" ]],
				"aoColumns": [
					{ "sClass": "center"},
					{ "sClass": "center"},
					{ "sClass": "center"},
					{ "sClass": "center"},
					{ "sClass": "center"},
					{ "sClass": "center"},
					{ "sClass": "center"}
				]					
			} ); 
			
			$("#loadingbar").hide();
		} );
		
		function fnClickAddRow(ls_tanggal, ls_host, li_port, ls_stsping, ls_stsport, li_wscode, ls_wsmessage) {
				$('#tabmon').dataTable().fnAddData( [
					ls_tanggal,
					ls_host,
					li_port,
					ls_stsping,
					ls_stsport,
					li_wscode,
					ls_wsmessage] );
		}
		
		function fnGetDataAjax() {
			$("#loadingbar").show();
			$("#href_cek").hide();
			$("#href_start").hide();
			$("#href_stop").hide();
			$.ajax({
				url : 'monjson.php',
				cache:false,
				timeout:45000,
				type : 'GET',
				dataType : 'json',
				aSync: false,
				success : function (result) {
					var lb_status = result['status'];
					var ls_tanggal = result['tanggal'];
					var	ls_host, li_port, li_stsping, li_stsport, ls_stsping, ls_stsport, li_wscode, ls_wsmessage;
					
					if (lb_status == false) {
						ls_host = 'Error';
						li_port = 0;
						ls_stsping = 'Error';
						ls_stsport = 'Error';
						li_wscode = 0;
						ls_wsmessage = 'Error';
					} else {
						ls_host = result['host'];
						li_port = result['port'];
						
						li_stsping = result['sts_ping'];
						if (li_stsping == 0) {
							ls_stsping = 'OK';
						} else {
							ls_stsping = 'Not OK';
						}
						
						li_stsport = result['sts_port'];
						if (li_stsport == 1) {
							ls_stsport = 'OK';
						} else {
							ls_stsport = 'Not OK';
						}
						li_wscode = result['sts_ws_code'];
						ls_wsmessage = result['sts_ws_message'];
					}
					fnClickAddRow(ls_tanggal, ls_host, li_port, ls_stsping, ls_stsport, li_wscode, ls_wsmessage);
					
					$("#loadingbar").hide();
					$("#href_cek").show();
					$("#href_start").show();
					$("#href_stop").show();
				},
				error : function () {
					fnClickAddRow('Error', 'Error', 0, 'Error', 'Error', 0, 'Error');
					$("#loadingbar").hide();
					$("#href_cek").show();
					$("#href_start").show();
					$("#href_stop").show();
				}
			});
		}
	</script>
</head>
<body id="body_bpjsmon">
	<div id="container">
		<div class="full_width big">
			VClaim Monitoring
		</div>
		<div class="spacer"></div>
		<div id="linkcontrol">
			<div id="loadingbar"><img src="include/media/images/loadingbar.gif"></div>
			<div id="href_cek"><a href="javascript: void(0);" onclick="fnGetDataAjax();">Cek Sekarang!</a></div>
		</div>
		<div class="spacer"></div>
		<div id="tablemon">
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="tabmon">
			<thead>
				<tr>
					<th>Tanggal</th>
					<th>Host</th>
					<th>Port</th>
					<th>Status Ping</th>
					<th>Status Port</th>
					<th>WS Metadata Code</th>
					<th>WS Metadata Message</th>
				</tr>
			</thead>
		</table>
		<div class="spacer"></div>
	</div>
</body>
</html>