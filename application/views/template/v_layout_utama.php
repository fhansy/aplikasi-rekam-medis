<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title><?= $judul_tab; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="stylesheet" href="<?= base_url() ?>css/matrix-style.css" />
	<link href="<?= base_url() ?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>css/bootstrap-responsive.min.css" rel="stylesheet">

	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
	<link href="<?= base_url() ?>css/font-awesome.css" rel="stylesheet">
	<link href="<?= base_url() ?>css/style.css" rel="stylesheet">
	<link href="<?= base_url() ?>css/pages/dashboard.css" rel="stylesheet">

	<link href="<?= base_url('assets/'); ?>plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
	<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

	<style>
		@media (max-width: 480px) {
			table.dataTable {
				margin-top: 50px !important;
			}
		}
	</style>

</head>

<body>
	<?php $akses =  $this->session->userdata('hak_akses') ?>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<div class="brand pull-left" style="height:100%; padding-top:15px">
					<img src="<?= $this->M_1Setting->getLogo(); ?>" width="40px">
				</div>
				<div class="brand pull-left">
					<h2>Sistem Rekam Medis </h2>
					<h4>Klinik PKU Muhammadiyah Gandrungmangu</h4>
				</div>

				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="index.html">
				</a>
				<div class="nav-collapse">
					<?php if (!empty($this->session->userdata('username'))) { ?>
						<ul class="nav pull-right">
							<li><a style="text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25); font-size: 13px" data-toggle="modal" data-target="#akses"><?= $this->session->userdata('poli'); ?></a>
							</li>
							<li class="dropdown">

								<a href="" class="dropdown-toggle" data-toggle="dropdown" style="text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25); font-size: 13px">
									<i class="icon-user"></i> <?= $this->session->userdata("nama"); ?> (<?= $this->session->userdata("hak_akses"); ?>) <b class="caret"></b></a>
								<ul class="dropdown-menu" style="background-color: white;">
									<li><a href="<?= base_url() ?><?= $this->session->userdata('hak_akses') ?>/page/profile" style="font-size: 13px">Profile</a>
									</li>
									<li><a href="<?= base_url() ?>auth/logout" onclick="sessionStorage.clear()" style="font-size: 13px">Logout</a></li>
								</ul>
							</li>
						</ul>
					<?php } ?>
				</div>
				<!--/.nav-collapse -->
			</div>
			<!-- /container -->
		</div>
		<!-- /navbar-inner -->
	</div>
	<!-- /navbar -->
	<div class="subnavbar">
		<div class="subnavbar-inner" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25); padding: 10px">
			<div class="container">
				<?php if (!empty($this->session->userdata('username'))) { ?>
					<ul class="nav mainnav">
						<li class="nav-item active" id="navDasboard">
							<a class="nav-link" href="<?= base_url("/") ?><?= $this->session->userdata('hak_akses') ?>">
								<img src="<?= base_url('/') ?>/icon/icon-dashboardMini.svg" width="30px" alt="dashboard"><span>Dashboard</span> </a>
						</li>

						<?php if ($this->session->userdata('hak_akses') == "dokter") { ?>

							<li class="nav-item" id="navAntrian-dokter">
								<a class="nav-link" href="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/pendaftaran">
									<img src="<?= base_url('/') ?>/icon/icon-user.svg" width="30px" alt="antrian"><span>Antrian</span> </a>
							</li>
							<li class="nav-item" id="navRekapMedis-dokter">
								<a class="nav-link" href="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/rekap_medis">
									<img src="<?= base_url('/') ?>/icon/icon-rm.svg" width="30px" alt="rm">
									<span>Rekam Medis Pasien</span> </a>
							</li>

						<?php } else if ($this->session->userdata('hak_akses') == "resepsionis") { ?>
							<li class="nav-item" id="navPendaftaran">
								<a class="nav-link" href="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/pasien">
									<img src="<?= base_url('/') ?>/icon/icon-user.svg" width="30px" alt="pendaftaran"><span>Pendaftaran</span> </a>
							</li>

						<?php } elseif ($this->session->userdata('hak_akses') == "perawat") { ?>
							<li class="nav-item" id="navAntrian-perawat">
								<a class="nav-link" href="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/pendaftaran">
									<img src="<?= base_url('/') ?>/icon/icon-user.svg" width="30px" alt="antrian"><span>Antrian</span> </a>
							</li>
							<!-- <li class="nav-item" id="navLaporanHarian">
						<a class="nav-link"
							href="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/pasien/laporan">
							<img src="<?= base_url('/') ?>/icon/icon-laporan.svg" width="30px"
								alt="laporan"><span>Laporan Harian</span> </a> </li> -->

						<?php } else if ($this->session->userdata('hak_akses') == "admin") { ?>
							<li class="nav-item" id="navUser">
								<a class="nav-link" href="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/user">
									<img src="<?= base_url('/') ?>/icon/icon-user.svg" width="30px" alt="user"><span>User</span>
								</a>
							</li>
							<li class="nav-item" id="navObat">
								<a class="nav-link" href="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/obat">
									<img src="<?= base_url('/') ?>/icon/icon-obat.svg" width="30px" alt="obat"><span>Obat</span>
								</a>
							</li>
							<li class="nav-item" id="navPenyakit">
								<a class="nav-link" href="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/penyakit">
									<img src="<?= base_url('/') ?>/icon/icon-virus.svg" width="30px" alt="penyakit"><span>Penyakit</span> </a>
							</li>
							<li class="nav-item" id="navRekapMedis-admin">
								<a class="nav-link" href="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/rekap_medis">
									<img src="<?= base_url('/') ?>/icon/icon-rm.svg" width="30px" alt="rm"><span>Rekam
										Medis</span> </a>
							</li>
							<li class="nav-item" id="navLaporanMorbiditas">
								<a class="nav-link" href="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/penyakit/laporan">
									<img src="<?= base_url('/') ?>/icon/icon-laporan.svg" width="30px" alt="laporan"><span>Laporan Morbiditas</span> </a>
							</li>
					<?php }
					} ?>
					</ul>
			</div>
			<!-- /container -->
		</div>
		<!-- /subnavbar-inner -->
	</div>
	<!-- /subnavbar -->
	<div class="main">
		<div class="main-inner">
			<div class="container" style="min-height: 300px">
				<?php if (!empty($this->session->flashdata('message'))) : ?>
					<div class="alert alert-success fade in" role="alert">
						<i class="icon-check-sign" data-notify=icon> </i>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						<?= $this->session->flashdata('message'); ?>
					</div>
				<?php endif; ?>
				<?php if (!empty($this->session->flashdata('message2'))) : ?>
					<div class="alert alert-danger fade in" role="alert">
						<i class="icon-trash" data-notify=icon> </i>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						<?= $this->session->flashdata('message2'); ?>
					</div>
				<?php endif; ?>
				<?php if (!empty($this->session->flashdata('message3'))) : ?>
					<div class="alert alert-warning fade in" role="alert">
						<i class="icon-warning-sign" data-notify=icon> </i>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						<?= $this->session->flashdata('message3'); ?>
					</div>
				<?php endif; ?>
				<?php
				if (!empty($isi)) {
					echo $isi;
				}
				?>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /main-inner -->

		<!-- Modal -->
		<div class="modal fade" id="akses" tabindex="-1" role="dialog" aria-labelledby="aksesLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h2>Pilih Lokasi Poli:</h2>
					</div>
					<div class="modal-body">
						<center>
							<button id="umum" class="btn button-abu">Poli Umum</button>
							<button id="kia" class="btn button-abu">Poli KIA</button>
						</center>
					</div>
					<div class="modal-footer">
						<div class="column">
							<button type="button" class="btn button-merah pull-left" data-dismiss="modal">Batal</button>
						</div>
						<div class="column">
							<form action="<?= base_url(); ?>auth/pilihPoli" method="POST" style="margin: 0;">
								<input type="hidden" id="pilihPoli" name="pilihPoli" value="" />
								<button class="btn button-biru">Simpan</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- /main -->

	<!-- Le javascript
================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="<?= base_url() ?>js/jquery-1.7.2.min.js"></script>
	<script src="<?= base_url() ?>assets/jquery/jquery-3.3.1.min.js"></script>
	<!-- <script src="<?= base_url() ?>js/jquery.min.js"></script>  -->
	<script src="<?= base_url() ?>js/excanvas.min.js"></script>
	<script src="<?= base_url() ?>js/chart.min.js" type="text/javascript"></script>

	<script src="<?= base_url() ?>js/jquery.dataTables.min.js"></script>
	<script src="<?= base_url() ?>js/matrix.tables.js"></script>
	<script language="javascript" type="text/javascript" src="<?= base_url() ?>js/full-calendar/fullcalendar.min.js">
	</script>

	<script src="<?= base_url() ?>js/base.js"></script>
	<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-3.3.7/dist/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/select2-4.0.6-rc.1/dist/css/select2.min.css">
	<script src="<?= base_url() ?>assets/bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>assets/select2-4.0.6-rc.1/dist/js/select2.min.js"></script>
	<script src="<?= base_url() ?>assets/select2-4.0.6-rc.1/dist/js/i18n/id.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {

			if (!sessionStorage.getItem('shown-poli')) {
				var akses = <?php echo json_encode($akses); ?>;
				if (akses == 'dokter' || akses == 'perawat') {
					$("#akses").modal('show');
					sessionStorage.setItem('shown-poli', true);
				}
			}

			$('#umum').click(function() {
				$('#pilihPoli').val('Poli Umum');
			});
			$('#kia').click(function() {
				$('#pilihPoli').val('Poli KIA');
			});

			$('#obat').select2({
				placeholder: 'Pilih Obat',
				language: "id"
			});
			$('#penyakit').select2({
				placeholder: 'Pilih Penyakit',
				language: "id"
			});

			// $(".mainnav a").on("click", function () {
			// 	$(".mainnav").find(".active").removeClass("active");
			// 	$(this).parent().addClass("active");
			// });

			// $(".mainnav .nav-item").bind("click", function (event) {
			// 	event.preventDefault();
			// 	var clickedItem = $(this);
			// 	$(".mainnav .nav-item").each(function () {
			// 		$(this).removeClass("active");
			// 	});
			// 	clickedItem.addClass("active");
			// });

			//------fitur hide/show dropdown identitas-----------
			if ($('select[name=identitas] option:selected').val() == 'NIK') {
				$('#nik').show();
				$('#sim').hide();
				$('#paspor').hide();
			} else if ($('select[name=identitas] option:selected').val() == 'SIM') {
				$('#sim').show();
				$('#nik').hide();
				$('#paspor').hide();
			} else if ($('select[name=identitas] option:selected').val() == 'Paspor') {
				$('#paspor').show();
				$('#nik').hide();
				$('#sim').hide();
			}

			$('select[name=identitas]').change(function() {
				if ($(this).val() == 'NIK') {
					$('#nik').show();
					$('#sim').hide();
					$('#paspor').hide();
				} else if ($(this).val() == 'SIM') {
					$('#sim').show();
					$('#nik').hide();
					$('#paspor').hide();
				} else if ($(this).val() == 'Paspor') {
					$('#paspor').show();
					$('#nik').hide();
					$('#sim').hide();
				}
			});
			//END------fitur hide/show dropdown identitas-----------

			//------fitur hide/show textarea keterangan diagnosis sementara-----------
			$('select[name=penyakit_terkonfirmasi]').change(function() {
				if ($(this).val() == 'N') {
					$('div[id=keterangan]').show();
				} else {
					$('div[id=keterangan]').hide();
				}
			});
			//END------fitur hide/show textarea keterangan diagnosis sementara-----------

			//------fitur cek tinggi badan-----------
			// Get DOM reference
			var tinggi_badan = document.getElementById("tinggi_badan");

			// Add event listener
			tinggi_badan.addEventListener("input", function(e) {

				// Clear any old status
				this.setCustomValidity("");

				// Check for invalid state(s)
				if (this.validity.rangeOverflow) {
					this.setCustomValidity("Tinggi Maksimal 500 cm");
				} else if (this.validity.rangeUnderflow) {
					this.setCustomValidity("Tinggi Minimum 15 cm");
				}
			});
			//END------fitur cek tinggi badan-----------

			//------fitur cek berat badan-----------
			// Get DOM reference
			var berat_badan = document.getElementById("berat_badan");

			// Add event listener
			berat_badan.addEventListener("input", function(e) {

				// Clear any old status
				this.setCustomValidity("");

				// Check for invalid state(s)
				if (this.validity.rangeOverflow) {
					this.setCustomValidity("Berat Maksimal 600 Kg");
				} else if (this.validity.rangeUnderflow) {
					this.setCustomValidity("Berat Minimum 1 Kg");
				}
			});
			//END------fitur cek berat badan-----------

			//------fitur cek Suhu badan-----------
			// Get DOM reference
			var suhu_badan = document.getElementById("suhu_badan");

			// Add event listener
			suhu_badan.addEventListener("input", function(e) {

				// Clear any old status
				this.setCustomValidity("");

				// Check for invalid state(s)
				if (this.validity.rangeOverflow) {
					this.setCustomValidity("Suhu Maksimal 45°C");
				} else if (this.validity.rangeUnderflow) {
					this.setCustomValidity("Suhu Minimum 32°C");
				}
			});
			//END------fitur cek Suhu badan-----------

			//------fitur cek Frekuensi Nadi-----------
			// Get DOM reference
			var frekuensi_nadi = document.getElementById("frekuensi_nadi");

			// Add event listener
			frekuensi_nadi.addEventListener("input", function(e) {

				// Clear any old status
				this.setCustomValidity("");

				// Check for invalid state(s)
				if (this.validity.rangeOverflow) {
					this.setCustomValidity("Frekuensi Nadi Maksimal 250 kali/menit");
				} else if (this.validity.rangeUnderflow) {
					this.setCustomValidity("Frekuensi Nadi Minimum 30 kali/menit");
				}
			});
			//END------fitur cek Frekuensi Nadi-----------

			//------fitur cek Frekuensi Pernapasan-----------
			// Get DOM reference
			var frekuensi_pernapasan = document.getElementById("frekuensi_pernapasan");

			// Add event listener
			frekuensi_pernapasan.addEventListener("input", function(e) {

				// Clear any old status
				this.setCustomValidity("");

				// Check for invalid state(s)
				if (this.validity.rangeOverflow) {
					this.setCustomValidity("Frekuensi Pernapasan Maksimal 50 kali/menit");
				} else if (this.validity.rangeUnderflow) {
					this.setCustomValidity("Frekuensi Pernapasan Minimum 6 kali/menit");
				}
			});
			//END------fitur cek Frekuensi Pernapasan-----------

			//------fitur cek Tekanan Darah Sistolik-----------
			// Get DOM reference
			var tekanan_darah_sistolik = document.getElementById("tekanan_darah_sistolik");

			// Add event listener
			tekanan_darah_sistolik.addEventListener("input", function(e) {

				var val_sistolik = $('#tekanan_darah_sistolik').val();
				var val_diastolik = $('#tekanan_darah_diastolik').val();

				// Clear any old status
				this.setCustomValidity("");

				// Check for invalid state(s)
				if (this.validity.rangeOverflow) {
					this.setCustomValidity("Tekanan Darah Sistolik Maksimal 280 mm/Hg");
				} else if (this.validity.rangeUnderflow) {
					this.setCustomValidity("Tekanan Darah Sistolik Minimum 0 mm/Hg");
				} else if (Number(val_sistolik) < Number(val_diastolik)) {
					this.setCustomValidity(
						"Tidak boleh kurang dari Diastolik");
				}
				if (Number(val_sistolik) == Number(val_diastolik)) {
					this.setCustomValidity(
						"Tidak boleh sama dengan Diastolik");
				}
			});
			//END------fitur cek Tekanan Darah Sistolik-----------

			//------fitur cek Tekanan Darah Diastolik-----------
			// Get DOM reference
			var tekanan_darah_diastolik = document.getElementById("tekanan_darah_diastolik");

			// Add event listener
			tekanan_darah_diastolik.addEventListener("input", function(e) {

				var val_sistolik = $('#tekanan_darah_sistolik').val();
				var val_diastolik = $('#tekanan_darah_diastolik').val();
				var val_nadi = $('#frekuensi_nadi').val();
				var perbandingan = Number(val_sistolik) - Number(val_diastolik);

				// Clear any old status
				this.setCustomValidity("");

				// Check for invalid state(s)
				if (this.validity.rangeOverflow) {
					this.setCustomValidity("Tekanan Darah Diastolik Maksimal 280 mm/Hg");
				} else if (this.validity.rangeUnderflow) {
					this.setCustomValidity("Tekanan Darah Diastolik Minimum 0 mm/Hg");
				} else if (Number(val_diastolik) > Number(val_sistolik)) {
					this.setCustomValidity(
						"Tidak boleh melebihi Sistolik");
				} else if (Number(val_nadi) != Number(perbandingan)) {
					this.setCustomValidity(
						"Selisih Sistolik dengan Diastolik sama dengan Frekuensi Nadi");
				}
			});
			//END------fitur cek Tekanan Darah Diastolik-----------

			setTimeout(function() {
				$(".alert").alert('close');
			}, 2000);

			$('#tabelDaftar').dataTable( {
			"ordering": false
			} );
		});
	</script>
</body>

</html>