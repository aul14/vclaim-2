<?php
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Master VClaim</title>
	<style type="text/css" title="currentStyle">
		#message{
			color: red;
			margin-bottom: 20px;
		}
		.form {
			display : none;
		}
		.form label {
			display: inline-block;
			width: 200px;
		}
		.form input {
		    height: 30px;
			/*max-width: 100%;*/
			padding: 4px 6px;
			border: 1px solid #aaa;
			background: #fff;
			color: #444;
			-webkit-transition: all .2s linear;
			-webkit-transition-property: border,background,color,box-shadow,padding;
			transition: all .2s linear;
				transition-property: all;
			transition-property: border,background,color,box-shadow,padding;
			border-radius: 4px;
		}
		.btn-radio {
		  cursor: pointer;
		  display: inline-block;
		  -webkit-user-select: none;
		  user-select: none;
		  margin-bottom: 20px;
		}
		.btn-radio:not(:first-child) {
		  margin-left: 20px;
		}
		@media screen and (max-width: 480px) {
		  .btn-radio {
			display: block;
			float: none;
		  }
		  .btn-radio:not(:first-child) {
			margin-left: 0;
			margin-top: 15px;
		  }
		}
		.btn-radio svg {
		  fill: none;
		  vertical-align: middle;
		}
		.btn-radio svg circle {
		  stroke-width: 2;
		  stroke: #C8CCD4;
		}
		.btn-radio svg path {
		  stroke: #008FFF;
		}
		.btn-radio svg path.inner {
		  stroke-width: 6;
		  stroke-dasharray: 19;
		  stroke-dashoffset: 19;
		}
		.btn-radio svg path.outer {
		  stroke-width: 2;
		  stroke-dasharray: 57;
		  stroke-dashoffset: 57;
		}
		.btn-radio input {
		  display: none;
		}
		.btn-radio input:checked + svg path {
		  transition: all 0.4s ease;
		}
		.btn-radio input:checked + svg path.inner {
		  stroke-dashoffset: 38;
		  transition-delay: 0.3s;
		}
		.btn-radio input:checked + svg path.outer {
		  stroke-dashoffset: 0;
		}
		.btn-radio span {
		  display: inline-block;
		  vertical-align: middle;
		}
		a.btn-submit{
			display:inline-block;
			padding:0.2em 1.45em;
			margin:0.1em;
			border:0.15em solid #CCCCCC;
			box-sizing: border-box;
			text-decoration:none;
			font-family:'Segoe UI','Roboto',sans-serif;
			font-weight:400;
			color:#000000;
			background-color:#CCCCCC;
			text-align:center;
			position:relative;
		}
		a.btn-submit:hover{
			border-color:#7a7a7a;
		}
		a.btn-submit:active{
			background-color:#999999;
		}
		@media all and (max-width:30em){
			a.btn-submit{
				display:block;
				margin:0.2em auto;
			}
		} 
	</style>
	<script type="text/javascript" language="javascript" src="include/media/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			<?php
				if(isset($_REQUEST['rb'])) {
					echo "$('input[name=ref][value=".'"'.$_REQUEST['rb'].'"'."]').prop('checked', true).trigger('change');";
					echo "$('#".$_REQUEST['rb']."').show();";
					echo 'history.pushState("", document.title, "master.php");';
				}
			?>
			$("#loadingbar").hide();
			
		
			$('input[name=ref]').on('change', function() {
				var checked = $(this).val();
				// console.log(checked);
				$('.form').hide();
				// if(checked == 'dpjp') {
					$('#'+checked).show();
				// }
			});
			
			$('#get_data').on('click', function() {
				var func = $('input[name=ref]:checked').val();
				console.log(func);
				
				if(typeof(func) == 'undefined') {
					alert('Silahkan pilih salah satu referensi terlebih dahulu');
					return;
				}
				
				var konfirm = confirm("Proses ini membutuhkan waktu, apakah anda yakin?");
				if(konfirm) {
					// alert("Silahkan menunggu, sistem sedang memproses data.");
					// $("#loadingbar").show();
					var form = document.createElement("form");
					var data = document.createElement("input");
					
					form.method = "POST";
					form.action = "mstfunction.php";
					
					data.value = func;
					data.name = "func";
					form.appendChild(data);
					
					if(func == 'poli') {
						var poli = $('input[name=poli]').val();
						var data_poli = document.createElement("input");
						
						data_poli.value = poli;
						data_poli.name = "poli";
						form.appendChild(data_poli);
					} else if(func == 'faskes') {
						var faskes = $('input[name=faskes]').val();
						var jns_faskes = $('input[name=jenis_faskes]').val();
						var data_faskes = document.createElement("input");
						var data_jns_faskes = document.createElement("input");
						
						data_faskes.value = faskes;
						data_faskes.name = "faskes";
						data_jns_faskes.value = jns_faskes;
						data_jns_faskes.name = "jenis_faskes";
						form.appendChild(data_faskes);
						form.appendChild(data_jns_faskes);
					} else if(func == 'dpjp') {
						var jns_layan = $('input[name=jenis_layan]').val();
						var spesialis = $('input[name=spesialis]').val();
						var data_jns_layan = document.createElement("input");
						var data_spesialis = document.createElement("input");
						
						data_jns_layan.value = jns_layan;
						data_jns_layan.name = "jenis_layan";
						data_spesialis.value = spesialis;
						data_spesialis.name = "spesialis";
						form.appendChild(data_jns_layan);
						form.appendChild(data_spesialis);
					} else if(func == 'tindakan') {
						var tindakan = $('input[name=tindakan]').val();
						var data_tindakan = document.createElement("input");
						
						data_tindakan.value = tindakan;
						data_tindakan.name = "tindakan";
						form.appendChild(data_tindakan);
					} else if(func == 'dokter') {
						var dokter = $('input[name=dokter]').val();
						var data_dokter = document.createElement("input");
						
						data_dokter.value = dokter;
						data_dokter.name = "dokter";
						form.appendChild(data_dokter);
					} 
					
					$("#ket_export").html(form).hide();	
					// // form.submit(function() {
						// // e.preventDefault();
						// // $("#loadingbar").show();
						// console.log('cek');
						// // var form_data = form.serialize();
						// // var form_url = form.attr("action");
						// // var form_method = form.attr("method").toUpperCase();
						// // console.log(form_data + ' ' + form_url +' ' + form_method);
						// $.ajax({
							// url: 'mstfunction.php',
							// type: 'POST',
							// data: {func : func},
							// cache: false,
							// success: function (response) {
								// $("body").append("<iframe src='" + response + "' style='display: none;' ></iframe>");
								// $("#loadingbar").hide();
							// },
							// error : function () {
								// alert('Terjadi permasalahan koneksi');
								// $("#loadingbar").hide();
							// }
						// });
					// });
					
					// var response = function() {
						// $("#loadingbar").hide();
						// $("#ket_export").unbind('load', response);
					// }
					
					// $("#ket_export").bind('load', response);
					form.submit();
				}
			});
		});
	</script>
</head>
<body id="body_bpjsmon">
	<div style="width:80%; margin:30px auto;padding: 0;">
		<div style="font-size:2em; font-weight:bold; line-height:2em; color:#4E6CA3;">
			Master VClaim
		</div>
		<div>
			<?php
				if(isset($_REQUEST['message'])) {
					$message = $_REQUEST['message'];
					echo '<div id="message">'.$message.'</div>';
				}
			?>
			<div>Silahkan pilih data master yang akan di ambil</div>
			<br>
			<div style="float: left; margin: 0 30px 0 0">
				<div>
					<label for="rb1" class="btn-radio">
						<input type="radio" id="rb1" name="ref" value="diagnosa"></input>
						<svg width="20px" height="20px" viewBox="0 0 20 20">
							<circle cx="10" cy="10" r="9"></circle>
							<path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
							<path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
						</svg>
						<span><span>Diagnosa</span></span>
					</label>
				</div>
				<div>
					<label for="rb2" class="btn-radio">
						<input type="radio" id="rb2" name="ref" value="poli"></input>
						<svg width="20px" height="20px" viewBox="0 0 20 20">
							<circle cx="10" cy="10" r="9"></circle>
							<path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
							<path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
						</svg>
						<span><span>Poli</span></span>
					</label>
				</div>
				<div>
					<label for="rb3" class="btn-radio">
						<input type="radio" id="rb3" name="ref" value="faskes"></input>
						<svg width="20px" height="20px" viewBox="0 0 20 20">
							<circle cx="10" cy="10" r="9"></circle>
							<path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
							<path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
						</svg>
						<span><span>Fasilitas Kesehatan</span></span>
					</label>
				</div>
				<div>
					<label for="rb4" class="btn-radio">
						<input type="radio" id="rb4" name="ref" value="dpjp"></input>
						<svg width="20px" height="20px" viewBox="0 0 20 20">
							<circle cx="10" cy="10" r="9"></circle>
							<path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
							<path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
						</svg>
						<span><span>Dokter DPJP</span></span>
					</label>
				</div>
			</div>
			<div style="float: left; margin: 0 30px 0 0">
				<div>
					<label for="rb5" class="btn-radio">
						<input type="radio" id="rb5" name="ref" value="propinsi"></input>
						<svg width="20px" height="20px" viewBox="0 0 20 20">
							<circle cx="10" cy="10" r="9"></circle>
							<path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
							<path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
						</svg>
						<span><span>Propinsi</span></span>
					</label>
				</div>
				<div>
					<label for="rb6" class="btn-radio">
						<input type="radio" id="rb6" name="ref" value="kabupaten"></input>
						<svg width="20px" height="20px" viewBox="0 0 20 20">
							<circle cx="10" cy="10" r="9"></circle>
							<path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
							<path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
						</svg>
						<span><span>Kabupaten</span></span>
					</label>
				</div>
				<div>
					<label for="rb7" class="btn-radio">
						<input type="radio" id="rb7" name="ref" value="kecamatan"></input>
						<svg width="20px" height="20px" viewBox="0 0 20 20">
							<circle cx="10" cy="10" r="9"></circle>
							<path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
							<path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
						</svg>
						<span><span>Kecamatan</span></span>
					</label>
				</div>
				<div>
					<label for="rb8" class="btn-radio">
						<input type="radio" id="rb8" name="ref" value="tindakan"></input>
						<svg width="20px" height="20px" viewBox="0 0 20 20">
							<circle cx="10" cy="10" r="9"></circle>
							<path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
							<path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
						</svg>
						<span><span>Procedure / Tindakan</span></span>
					</label>
				</div>
				<div>
					<label for="rb9" class="btn-radio">
						<input type="radio" id="rb9" name="ref" value="kelasrawat"></input>
						<svg width="20px" height="20px" viewBox="0 0 20 20">
							<circle cx="10" cy="10" r="9"></circle>
							<path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
							<path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
						</svg>
						<span><span>Kelas Rawat</span></span>
					</label>
				</div>
			</div>
			<div style="float: left; margin: 0 30px 0 0">
				<div>
					<label for="rb10" class="btn-radio">
						<input type="radio" id="rb10" name="ref" value="dokter"></input>
						<svg width="20px" height="20px" viewBox="0 0 20 20">
							<circle cx="10" cy="10" r="9"></circle>
							<path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
							<path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
						</svg>
						<span><span>Dokter</span></span>
					</label>
				</div>
				<div>
					<label for="rb11" class="btn-radio">
						<input type="radio" id="rb11" name="ref" value="spesialistik"></input>
						<svg width="20px" height="20px" viewBox="0 0 20 20">
							<circle cx="10" cy="10" r="9"></circle>
							<path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
							<path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
						</svg>
						<span><span>Spesialistik</span></span>
					</label>
				</div>
				<div>
					<label for="rb12" class="btn-radio">
						<input type="radio" id="rb12" name="ref" value="ruangrawat"></input>
						<svg width="20px" height="20px" viewBox="0 0 20 20">
							<circle cx="10" cy="10" r="9"></circle>
							<path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
							<path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
						</svg>
						<span><span>Ruang Rawat</span></span>
					</label>
				</div>
				<div>
					<label for="rb13" class="btn-radio">
						<input type="radio" id="rb13" name="ref" value="carakeluar"></input>
						<svg width="20px" height="20px" viewBox="0 0 20 20">
							<circle cx="10" cy="10" r="9"></circle>
							<path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
							<path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
						</svg>
						<span><span>Cara Keluar</span></span>
					</label>
				</div>
				<div>
					<label for="rb14" class="btn-radio">
						<input type="radio" id="rb14" name="ref" value="pascapulang"></input>
						<svg width="20px" height="20px" viewBox="0 0 20 20">
							<circle cx="10" cy="10" r="9"></circle>
							<path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
							<path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
						</svg>
						<span><span>Pasca Pulang</span></span>
					</label>
				</div>
			</div>
			<div style="clear: both"></div>
			<div id="poli" class="form">
				<div style="margin:20px 0">
					<label for="poli">Kode atau nama poli</label>
					<input type="text" name="poli" />
				</div>
			</div>
			<div id="faskes" class="form">
				<div style="margin:20px 0">
					<label for="faskes">Nama atau kode faskes</label>
					<input type="text" name="faskes" />
				</div>
				<div style="margin:20px 0">
					<label for="jenis_faskes">Jenis faskes</label>
					<input type="text" name="jenis_faskes" />
				</div>
			</div>
			<div id="dpjp" class="form">
				<div style="margin:20px 0">
					<label for="jenis_layan">Jenis pelayanan</label>
					<input type="text" name="jenis_layan" />
				</div>
				<div style="margin:20px 0">
					<label for="spesialis">Kode Spesialis/Subspesialis</label>
					<input type="text" name="spesialis" />
				</div>
			</div>
			<div id="tindakan" class="form">
				<div style="margin:20px 0">
					<label for="tindakan">Kode atau nama procedure</label>
					<input type="text" name="tindakan" />
				</div>
			</div>
			<div id="dokter" class="form">
				<div style="margin:20px 0">
					<label for="dokter">Nama dokter atau dpjp</label>
					<input type="text" name="dokter" />
				</div>
			</div>
			<div>
				<a href="#" id="get_data" class="btn-submit">Download</a>
			</div>
			<div id="linkcontrol">
				<div id="loadingbar" style="display:none"><img src="include/media/images/loadingbar.gif"></div>
			</div>
			<div id="ket_export"></div>
</body>
</html>