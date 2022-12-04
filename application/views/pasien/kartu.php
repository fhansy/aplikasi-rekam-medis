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
			window.location = "<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/pasien/index/";
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
		<div style="width:450px;height: 230px;border: 3px solid black; padding: 10px">
			<div class="row d-flex ">
				<div class="col-md-2 ">
					<img src="<?= base_url('assets/')?>images/logo.png" width="50px" style="margin-bottom: 10px;"
						alt="...">
				</div>
				<div class="col-md-10 ">
				<center>
					<h6>Klinik PKU Muhammadiyah Gandrungmangu</h6>
					<a style="font-size: 12px;">Jl. Raya Gandrungmangu RT 03 RW 03 Kec. Gandrungmangu</a>
				</center>
				</div>
				<div class="text-center col-md-12" style="border-top: 3px solid black; font-weight: bold">
					Kartu Identitas Berobat
				</div>
			</div>

			<div class="row col-md-12">
				<table class="col-md-12 ">
					<tr>
						<td>No. RM</td>
						<td>:</td>
						<td><?= $pasien->id_pasien?></td>
					</tr>
					<tr>
						<td style="width: 50px">Nama</td>
						<td>:</td>
						<td><?= $pasien->nama_pasien?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><?= $pasien->alamat?></td>
					</tr>
				</table>
			</div>
			<br>
			<CENTER>
				<small>KARTU INI HARUS DIBAWA SETIAP KALI BEROBAT</small>
			</CENTER>
		</div>
	</div>
</body>

</html>
