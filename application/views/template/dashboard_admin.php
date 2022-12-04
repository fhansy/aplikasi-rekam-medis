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
$bulan = array("January", "February", "March", "April", "May", "June", "July", "August", "September",
"October", "November", "December");
  
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
					<div class="card-header" style="background-color: #343A40;">
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
							<input name="hari" id="hari" type='date' value="<?= $hari ?>">
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

				<div class="card card-primary">
					<div class="card-header" style="background-color: #343A40;">
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
			<!-- /.col (LEFT) -->

			<div class="col-md-6">
				<!-- AREA CHART -->
				<div class="card card-danger">
					<div class="card-header" style="background-color: #343A40;">
						<h3 class="card-title">Total Kunjungan Pertahun</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body">

						<form method="POST" style="margin-bottom: 20px;">
							<select name="chartTahun" class="col-3">
								<?php for($i='2019';$i<=Date('Y');$i++){ ?>
								<option value="<?= $i;?>" <?php if($i==$chartTahun){echo "selected"; }?>><?= $i;?>
								</option>
								<?php } ?>
							</select>
							<button class="btn button-biru">Pilih</button>
						</form>

						<div class="chart">
							<canvas id="kunjunganChart"
								style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
						</div>
					</div>
					<!-- /.card-body -->

					<!-- DONUT CHART -->
					<h3 class="card-title" style="margin-left: 20px;">Total Kunjungan Berdasarkan Umur</h3>
					<div class="card-body">
						<canvas id="donutChart"
							style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
					</div>

					<!-- DONUT CHART -->
					<h3 class="card-title" style="margin-left: 20px;">Total Kunjungan Berdasarkan Gender</h3>
					<div class="card-body">
						<canvas id="donutChartGender"
							style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
