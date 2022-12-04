<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title><?= $judul_tab; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="stylesheet" href="<?= base_url() ?>css/matrix-style.css" />

	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
	<link href="<?= base_url() ?>css/font-awesome.css" rel="stylesheet">
	<link href="<?= base_url() ?>css/pages/dashboard.css" rel="stylesheet">

	<link href="<?= base_url('assets/'); ?>plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
	<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url('assets/dashboard/'); ?>plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="<?= base_url('assets/dashboard/'); ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?= base_url('assets/dashboard/'); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="<?= base_url('assets/dashboard/'); ?>plugins/jqvmap/jqvmap.min.css">
	<!-- SweetAlert2 -->
	<!-- <link rel="stylesheet" href="<?= base_url('assets/dashboard/'); ?>plugins/sweetalert2/sweetalert2.min.css"> -->
	<!-- Toastr -->
	<!-- <link rel="stylesheet" href="<?= base_url('assets/dashboard/'); ?>plugins/toastr/toastr.min.css"> -->
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url('assets/dashboard/'); ?>dist/css/adminlte.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="<?= base_url('assets/dashboard/'); ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?= base_url('assets/dashboard/'); ?>plugins/daterangepicker/daterangepicker.css">
	<!-- summernote -->
	<link rel="stylesheet" href="<?= base_url('assets/dashboard/'); ?>plugins/summernote/summernote-bs4.min.css">
	<link href="<?= base_url() ?>css/style.css" rel="stylesheet">

	<?php
	$bulan = array(
		"January", "February", "March", "April", "May", "June", "July", "August", "September",
		"October", "November", "December"
	);
	$usia = array(
		array('awal' => 0, 'akhir' => 4),
		array('awal' => 5, 'akhir' => 14),
		array('awal' => 15, 'akhir' => 24),
		array('awal' => 25, 'akhir' => 44),
		array('awal' => 45, 'akhir' => 64),
		array('awal' => 65, 'akhir' => 100)
	);

	$jenis_kelamin = array(
		"L" => "Laki-laki",
		"P" => "Perempuan"
	);

	foreach ($usia as $usia_key => $usia_value) {
		$labelUsia[] = array($usia_value['awal'] . '-' . $usia_value['akhir'] . ' Tahun');
	}

	foreach ($jenis_kelamin as $jenis_kelamin_key => $jenis_kelamin_value) {
		$labelGender[] = $jenis_kelamin_value;
	}

	foreach ($bulan as $bulan_key => $bulan_value) {
		$total[] = $this->M_Pendaftaran->totalKunjungan($chartTahun, $bulan_value);
	}

	foreach ($usia as $usia_key => $usia_value) {
		$totalUsia[] = $this->M_Pasien->totalKunjunganUsia($chartTahun, $usia_value['awal'], $usia_value['akhir']);
	}

	foreach ($jenis_kelamin as $jenis_kelamin_key => $jenis_kelamin_value) {
		$totalGender[] = $this->M_Pasien->totalKunjunganGender($chartTahun, $jenis_kelamin_key);
	}

	?>

</head>

<body class="hold-transition sidebar-mini" style="font: 13px/1.7em 'Open Sans';">

		<nav class="navbar navbar-expand-lg navbar-dark navbar-fixed-top" style="margin: 0; min-height: 88px; background-image: -webkit-linear-gradient(160deg, #0072FF 11.9%, #00C6FF 12%);">
			<ul class="navbar-nav" style="margin-left: 10px">
				<li class="nav-item" style="height:100%; padding-top:8px">
					<img src="<?= $this->M_1Setting->getLogo(); ?>" width="40px">
				</li>
				<li class="nav-item d-sm-inline-block" style="margin-left: 20px;">
					<h2 style="font-size: 24px; line-height:36px; margin:0; font-family: inherit; font-weight: bold; color: inherit; text-rendering: optimizelegibility; color:white">
						Sistem Rekam Medis </h2>
					<h4 style="font-size: 14px; line-height:18px; margin:0; font-family: inherit; font-weight: bold; color: inherit; text-rendering: optimizelegibility; color:white">
						Klinik PKU Muhammadiyah Gandrungmangu</h4>
				</li>
			</ul>
			<button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="margin-top: 10px;">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<div class="ml-auto">
					<?php if (!empty($this->session->userdata('username'))) { ?>
						<a style="text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25); font-size: 13px; color:white"><?= $this->session->userdata('poli'); ?></a>

						<div class="dropdown">
							<a href="" class="dropdown-toggle" data-toggle="dropdown" style="text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25); font-size: 13px; color:white">
								<i class="icon-user"></i> <?= $this->session->userdata("nama"); ?> (<?= $this->session->userdata("hak_akses"); ?>) <b class="caret"></b></a>
							<ul class="dropdown-menu" style="background-color: white;">
								<li><a href="<?= base_url() ?><?= $this->session->userdata('hak_akses') ?>/page/profile" style="font-size: 13px; display:block;">Profile</a>
								</li>
								<li><a href="<?= base_url() ?>auth/logout" onclick="sessionStorage.clear()" style="font-size: 13px; display:block;">Logout</a></li>
							</ul>
						</div>
						</ul>
					<?php } ?>
				</div>
			</div>
		</nav>

	<div class="subnavbar">
		<div class="subnavbar-inner" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25); padding: 10px; height:auto; padding-bottom:0;">
			<div class="container">
				<?php if (!empty($this->session->userdata('username'))) { ?>
					<ul class="nav mainnav" style="height: auto;">
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
							<li class="nav-item" id="navLaporanHarian">
								<a class="nav-link" href="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/pasien/laporan">
									<img src="<?= base_url('/') ?>/icon/icon-laporan.svg" width="30px" alt="laporan"><span>Laporan Harian</span> </a>
							</li>

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
									<img src="<?= base_url('/') ?>/icon/icon-rm.svg" width="30px" alt="rm"><span>Rekap
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
					<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						<?= $this->session->flashdata('message'); ?>
					</div>
				<?php endif; ?>
				<?php if (!empty($this->session->flashdata('message2'))) : ?>
					<div class="alert alert-danger" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						<?= $this->session->flashdata('message2'); ?>
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
	<script src="<?= base_url() ?>assets/select2-4.0.6-rc.1/dist/js/select2.min.js"></script>
	<script src="<?= base_url() ?>assets/select2-4.0.6-rc.1/dist/js/i18n/id.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
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
		});
	</script>

	<!-- jQuery -->
	<script src="<?= base_url('assets/dashboard/'); ?>plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?= base_url('assets/dashboard/'); ?>plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="<?= base_url('assets/dashboard/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js">
	</script>
	<!-- ChartJS -->
	<script src="<?= base_url('assets/dashboard/'); ?>plugins/chart.js/Chart.min.js"></script>
	<!-- Sparkline -->
	<script src="<?= base_url('assets/dashboard/'); ?>plugins/sparklines/sparkline.js"></script>
	<!-- JQVMap -->
	<script src="<?= base_url('assets/dashboard/'); ?>plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="<?= base_url('assets/dashboard/'); ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="<?= base_url('assets/dashboard/'); ?>plugins/jquery-knob/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="<?= base_url('assets/dashboard/'); ?>plugins/moment/moment.min.js"></script>
	<script src="<?= base_url('assets/dashboard/'); ?>plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="<?= base_url('assets/dashboard/'); ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
	</script>
	<!-- Summernote -->
	<script src="<?= base_url('assets/dashboard/'); ?>plugins/summernote/summernote-bs4.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="<?= base_url('assets/dashboard/'); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js">
	</script>
	<!-- AdminLTE App -->
	<script src="<?= base_url('assets/dashboard/'); ?>dist/js/adminlte.js"></script>

	<script type="text/javascript">
		$(function() {
			/* ChartJS
			 * -------
			 * Here we will create a few charts using ChartJS
			 */

			//--------------
			//- AREA CHART -
			//--------------

			// Get context with jQuery - using jQuery's .get() method.
			var areaChartCanvas = $('#kunjunganChart').get(0).getContext('2d')

			var areaChartData = {
				labels: <?php echo json_encode($bulan); ?>,
				datasets: [{
					label: 'Pengunjung',
					backgroundColor: 'rgb(255, 152, 0)',
					borderColor: 'rgb(255, 152, 0)',
					pointRadius: false,
					pointColor: '#3b8bba',
					pointStrokeColor: 'rgba(60,141,188,1)',
					pointHighlightFill: '#fff',
					pointHighlightStroke: 'rgba(60,141,188,1)',
					data: <?php echo json_encode($total); ?>,
					pointRadius: 2,
				}, ]
			}

			var areaChartOptions = {
				maintainAspectRatio: false,
				responsive: true,
				legend: {
					display: false
				},
				scales: {
					xAxes: [{
						gridLines: {
							display: true,
						}
					}],
					yAxes: [{
						gridLines: {
							display: true,
						}
					}]
				}
			}

			// This will get the first returned node in the jQuery collection.
			var areaChart = new Chart(areaChartCanvas, {
				type: 'line',
				data: areaChartData,
				options: areaChartOptions
			})

			//-------------
			//- DONUT CHART -
			//-------------
			// Get context with jQuery - using jQuery's .get() method.
			var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
			var donutData = {
				labels: //[
					// '0-5 tahun',
					// '5-15 tahun',
					// '15-25 tahun',
					// '25-45 tahun',
					// '45-65 tahun',
					// '65-100 tahun',
					//]
					<?php echo json_encode($labelUsia); ?>,
				datasets: [{
					data: <?php echo json_encode($totalUsia); ?>,
					backgroundColor: ['#F33527', '#47A44B', '#F08F00', '#00D3EE', '#9124A3', '#919191'],
				}]
			}
			var donutOptions = {
				maintainAspectRatio: false,
				responsive: true,
			}
			//Create pie or douhnut chart
			// You can switch between pie and douhnut using the method below.
			var donutChart = new Chart(donutChartCanvas, {
				type: 'doughnut',
				data: donutData,
				options: donutOptions
			})

			//-------------
			//- DONUT CHART -
			//-------------
			// Get context with jQuery - using jQuery's .get() method.
			var donutChartCanvas = $('#donutChartGender').get(0).getContext('2d')
			var donutData = {
				labels: <?php echo json_encode($labelGender); ?>,
				datasets: [{
					data: <?php echo json_encode($totalGender); ?>,
					backgroundColor: ['#00D3EE', '#EB3573'],
				}]
			}
			var donutOptions = {
				maintainAspectRatio: false,
				responsive: true,
			}
			//Create pie or douhnut chart
			// You can switch between pie and douhnut using the method below.
			var donutChart = new Chart(donutChartCanvas, {
				type: 'doughnut',
				data: donutData,
				options: donutOptions
			})
		})
	</script>

</body>

</html>