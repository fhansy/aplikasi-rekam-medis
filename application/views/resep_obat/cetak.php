<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="colorlib">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title><?= $judul_tab ?></title>


	<script type="text/javascript">
		window.print();

		function myFunction() {
			window.location.href="<?= base_url()?><?= $this->session->userdata('hak_akses')?>/pendaftaran"
		}

	</script>
</head>

<body class="justify-content-center" id='printTable' onafterprint="myFunction()">
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
	<!--
      CSS
      ============================================= -->
	<link rel="stylesheet" href="<?= base_url('assets/')?>css/linearicons.css">
	<link rel="stylesheet" href="<?= base_url('assets/')?>css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/')?>css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url('assets/')?>css/magnific-popup.css">
	<link rel="stylesheet" href="<?= base_url('assets/')?>css/nice-select.css">
	<link rel="stylesheet" href="<?= base_url('assets/')?>css/animate.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/')?>css/jquery-ui.css">
	<link rel="stylesheet" href="<?= base_url('assets/')?>css/owl.carousel.css">
	<link rel="stylesheet" href="<?= base_url('assets/')?>css/main.css">
	<div class="row justify-content-center">
	<div class="widget-content">
				<div class="table-responsive" style="white-space: nowrap; overflow-x:auto;">
					<div id="printTable" style="display: inline-block;">
					<div style="padding: 20px; margin-bottom: 10px; border:1px solid black;">
						<table style="width: 100%;">
							<tr>
								<td align="center"><img src='<?= $this->M_1Setting->getLogo(); ?>' width="50px" style="margin-right: 20px;"></td>
								<td>
									<h3>KLINIK PKU MUHAMMADIYAH GANDRUNGMANGU</h3>
									Jl. Raya Gandrungmangu, Tambangan, Wringinharjo,<br>
									Kec. Gandrungmangu, Kabupaten Cilacap, Jawa Tengah 53254<br>
									Email : pku.gandrungmangu@gmail.com<br>
								</td>
							</tr>
						</table>
						<div style="padding: 20px;">

							<div style="padding: 10px; margin-bottom: 10px; border:1px solid black;">
								<table style="width: 85%;">
									<tr>
										<td>Tanggal</td>
										<td> : <?= $rekap_medis->tgl_pendaftaran; ?></td>
									</tr>
									<tr>
										<td>Dokter</td>
										<td> : <?= $rekap_medis->nama_dokter; ?></td>
									</tr>
								</table>
							</div>
							<div style="padding-right: 20px; padding-left: 20px; margin-bottom: 10px;">
								<div style="padding-left: 10px; margin-bottom: 10px;">
									<table style="width: 70%;">
										<?php foreach ($resep_obat as $data) : ?>
											<tr>
												<td style="width: 10%;">R/</td>
												<td><?= $data['nama_obat']; ?></td>
											</tr>
											<tr>
												<td></td>
												<td><?= $data['signatura']; ?></td>
											</tr>
											<tr>
												<td style="border-bottom:1px solid black;"></td>
												<td style="border-bottom:1px solid black;"></td>
											</tr>
											<?php endforeach ?>
									</table>
									<?php
									if ($resep_obat == null) {
										echo "-";
									}
									?>
								</div>
							</div>
							<div style="padding: 10px; margin-bottom: 10px;">
								<table style="width: 85%;">
									<tr>
										<td>Pro</td>
										<td> : <?= $rekap_medis->nama_pasien; ?></td>
									</tr>
									<tr>
										<?php
											$diff = date_diff(date_create($rekap_medis->tanggal_lahir), date_create());
										?>
										<td>Usia</td>
										<td> : <?= $diff->y . " tahun " . $diff->m . " bulan " . $diff->d . " hari"; ?></td>
									</tr>
									<tr>
										<td>Berat Badan</td>
										<td>: <?= $rekap_medis->berat_badan; ?> kg</td>
									</tr>
									<tr>
										<td>Alamat</td>
										<td> : <?= $rekap_medis->alamat; ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					</div>
				</div>





			</div> <!-- /widget-content -->
	</div>
</body>

</html>
