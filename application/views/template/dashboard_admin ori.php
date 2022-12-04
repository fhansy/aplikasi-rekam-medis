<?php 
  $head = array("#","Kode DTD","Kode ICDX","Nama Penyakit","Action");
  $head2 = array("#","Penyakit","Jumlah");
  $no=0;
 
$usia = array(
            array('awal' =>0,'akhir'=>5 ),
            array('awal' =>5,'akhir'=>15 ),
            array('awal' =>15,'akhir'=>25 ),
            array('awal' =>25,'akhir'=>45 ),
            array('awal' =>45,'akhir'=>65 ),
            array('awal' =>65,'akhir'=>100 )
          );
$bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
"Oktober", "November", "Desember");
  
  $jenis_kelamin=array(
      "L"=>"Laki-laki",
      "P"=>"Perempuan");

 ?>
<?= $this->M_1Setting->Cetak();?>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">

				<div class="card card-info">
					<div class="card-header">
						<h3 class="card-title">Jumlah Pengunjung Perhari</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body">

						<form method="POST" style="margin-bottom: 20px;">
							<!-- Pilih Tanggal<br> -->
							<input name="hari" type='date' value="<?= $hari ?>">
							<button class="btn button-biru">Pilih</button>
						</form>

						<div class="row">
							<div class="col-6">
								<!-- small box -->
								<div class="small-box bg-success">
									<div class="inner">
										<h3><?= count($pasienUmum)?><sup style="font-size: 20px"> Pengunjung</sup></h3>

										<p>Poli Umum</p>
									</div>
									<div class="icon">
										<i class="ion ion-stats-bars"></i>
									</div>
									<a id="tombolUmum" href="<?= base_url()?>auth/sesiLaporanUmum"
										class="small-box-footer">Cetak
										Sensus Harian <i class="fas fa-arrow-circle-right"></i></a>
								</div>
							</div>
							<!-- ./col -->
							<div class="col-6">
								<!-- small box -->
								<div class="small-box bg-warning">
									<div class="inner">
										<h3><?= count($pasienKIA)?><sup style="font-size: 20px"> Pengunjung</sup></h3>

										<p>Poli KIA</p>
									</div>
									<div class="icon">
										<i class="ion ion-stats-bars"></i>
									</div>
									<a id="tombolKIA" href="<?= base_url()?>auth/sesiLaporanKIA"
										class="small-box-footer">Cetak
										Sensus
										Harian <i class="fas fa-arrow-circle-right"></i></a>
								</div>
							</div>
							<!-- ./col -->
						</div>

					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->

			</div>
			<!-- /.col (LEFT) -->


			<div class="col-md-6">
				<!-- AREA CHART -->
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">10 Besar Penyakit</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body">

						<form method="POST" style="margin-bottom: 20px;">
							<!-- Pilih Tanggal<br> -->
							<input name="pertahun10" id="pertahun10" type="month" value="<?= $pertahun10 ?>">
							<button class="btn button-biru">Pilih</button>
						</form>

						<table class="table table-striped table-bordered" border="1">
							<thead>
								<tr>
									<?php foreach ( $head2 as $data) : ?>
									<th> <?= $data; ?></th>
									<?php endforeach ?>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no=0;
								foreach ( $penyakit10 as $data) : 
								$no++;
								?>
								<tr>
									<td> <?= $no; ?></td>
									<td> <?= $data["nama_penyakit"]; ?></td>
									<td> <?= $data["jumlah"]; ?></td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>

					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->

			</div>
			<!-- /.col (RIGHT) -->

		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- <script src="<?= base_url()?>js/jquery-1.7.2.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
		$(".active").removeClass("active");
		$("#navDasboard").addClass("active");
		$("#navDasboard").addClass("active");
	});

</script> -->
