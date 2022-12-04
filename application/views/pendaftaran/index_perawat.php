<?php
 header("Refresh: 30;"); 
  $head = array("#","Nomer Identitas","Nama","Alamat","Umur","Action");
  $no=0;
 ?>
<div class="widget">
	<div class="widget-header"> <i class="icon-th-list"></i>
		<h3><?= $title ?></h3>
	</div>
	<!-- /widget-header -->
	<div class="widget-content" style="min-height: 400px">
		<table class="table table-striped span6" style="max-width: 100%; margin-left: 10px">
			<tr>
				<td colspan="3">
					<h3>Sedang Diperiksa Dokter</h3>
				</td>
			</tr>
			<?php 
        $pertama='pertama';
        foreach ( $periksa as $data) : $no++;
        $diff= date_diff(date_create($data["tanggal_lahir"]),date_create());?>
			<tr>
				<td style="background-color: #1E323C;text-align:center; color: white"
					rowspan='<?= $pertama=='pertama' && $this->session->userdata('hak_akses')=='dokter'?2 :1 ?>'> No.
					<h2><?= $data["no_daftar"]; ?></h2>
				</td>
				<td>
					<?= $data["nama_pasien"]; ?>(<b><?= $data["jenis_kelamin"]; ?></b>)
					<br>
					<?= $diff->y." tahun ".$diff->m." bulan ".$diff->d." hari"; ?>
				</td>
				<td>
					No. RM
					<h2><?= $data["id_pasien"]; ?></h2>
					<br>

				</td>
			</tr>
			<?php if($pertama=='pertama' && $this->session->userdata('hak_akses')=='dokter'){?>
			<tr>
				<td>
					<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/pendaftaran/input/<?= $data["id_pendaftaran"]; ?>"
						class="btn button-merah" style="color: white;padding :5px;"><i
							class="btn-icon-only icon-remove">
						</i>Lewati Pasien </a>
				</td>
				<td>
					<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/rekap_medis/periksa/<?= $data["id_rekap_medis"]; ?>"
						class="btn button-hijau" style="color: white;padding :5px;"><i
							class="btn-icon-only icon-edit">
						</i>Periksa Pasien </a>
				</td>
			</tr>
			<?php $pertama='kedua';} ?>
			<?php endforeach ?>
		</table>
		<div>

			<div class="span6" style="max-width: 100%; margin-left: 10px">

				<table class="table table-striped">
					<tr>
						<td colspan="3">
							<h3>Sudah Vital Sign</h3>
						</td>
					</tr>
					<?php 
      $pertama='pertama';
      foreach ( $vital_sign as $data) :$no++;
        $diff= date_diff(date_create($data["tanggal_lahir"]),date_create());?>
					<tr>
						<td style="background-color: #1E323C;text-align:center; color: white"
							rowspan='<?= $pertama=='pertama' && $this->session->userdata('hak_akses')=='dokter'?2 :1 ?>'>
							No.
							<h2><?= $data["no_daftar"]; ?></h2>
						</td>
						<td>
							<?= $data["nama_pasien"]; ?>(<b><?= $data["jenis_kelamin"]; ?></b>)
							<br>
							<?= $diff->y." tahun ".$diff->m." bulan ".$diff->d." hari"; ?>
						</td>
						<td class="td-actions">
							No. RM
							<h2><?= $data["id_pasien"]; ?></h2>
							<br>

						</td>
					</tr>
					<?php if($pertama=='pertama' && $this->session->userdata('hak_akses')=='dokter'){?>
					<tr>
						<td>
							<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/pendaftaran/input/<?= $data["id_pendaftaran"]; ?>"
								class="btn button-merah" style="color: white;padding :5px;"
								onClick="return confirm('Anda yakin ingin melewati pasien ini?')"><i
									class="btn-icon-only icon-remove"> </i>Lewati Pasien </a>
						</td>
						<td>
							<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/rekap_medis/periksa/<?= $data["id_rekap_medis"]; ?>"
								class="btn button-hijau" style="color: white;padding :5px;"><i
									class="btn-icon-only icon-edit"> </i>Periksa Pasien </a>
						</td>
					</tr>
					<?php $pertama='kedua';} ?>
					<?php endforeach ?>
				</table>
			</div>
			<div class="span5" style="max-width: 100%; margin-left: 10px">

				<table class="table table-striped">
					<tr>
						<td colspan="3">
							<h3>Dilewati Periksa Dokter</h3>
						</td>
					</tr>
					<?php 
      $pertama='pertama';
      foreach ( $tunggu_periksa as $data) :$no++;
        $diff= date_diff(date_create($data["tanggal_lahir"]),date_create());?>
					<tr>
						<td style="background-color: #1E323C;text-align:center; color: white"
							rowspan='<?= $pertama=='pertama' && $this->session->userdata('hak_akses')=='dokter'?2 :1 ?>'>
							No.
							<h2><?= $data["no_daftar"]; ?></h2>
						</td>
						<td>
							<?= $data["nama_pasien"]; ?>(<b><?= $data["jenis_kelamin"]; ?></b>)
							<br>
							<?= $diff->y." tahun ".$diff->m." bulan ".$diff->d." hari"; ?>
						</td>
						<td class="td-actions">
							No. RM
							<h2><?= $data["id_pasien"]; ?></h2>
							<br>

						</td>
					</tr>
					<?php if($this->session->userdata('hak_akses')=='dokter'){?>
					<tr>
						<td>
							<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/pendaftaran/input_batal/<?= $data["id_pendaftaran"]; ?>"
								class="btn button-merah" style="color: white;padding :5px;"
								onClick="return confirm('Anda yakin ingin menghapus pasien ini dari antrian?')"><i
									class="btn-icon-only icon-remove"> </i>Hapus dari Antrian </a>
						</td>
						<td>
							<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/rekap_medis/periksa/<?= $data["id_rekap_medis"]; ?>"
								class="btn button-hijau" style="color: white;padding :5px;"><i
									class="btn-icon-only icon-edit"> </i>Periksa Pasien </a>
						</td>
					</tr>
					<?php $pertama='kedua';} ?>
					<?php endforeach ?>
				</table>
			</div>
			<div class="span6" style="max-width: 100%; margin-left: 10px">
				<table class="table table-striped ">
					<tr>
						<td colspan="3">
							<h3>Belum Vital Sign</h3>
						</td>
					</tr>
					<?php 
      $pertama='pertama';
      foreach ( $antrian as $data) :
        $diff= date_diff(date_create($data["tanggal_lahir"]),date_create());?>
					<tr>
						<td style="background-color: #1E323C;text-align:center; color: white"
							rowspan='<?= $pertama=='pertama' && $this->session->userdata('hak_akses')=='perawat'?2 :1 ?>'>
							No.
							<h2><?= $data["no_daftar"]; ?></h2>
						</td>
						<td>
							<?= $data["nama_pasien"]; ?>(<b><?= $data["jenis_kelamin"]; ?></b>)
							<br>
							<?= $diff->y." tahun ".$diff->m." bulan ".$diff->d." hari"; ?>
						</td>
						<td class="td-actions">
							No. RM
							<h2><?= $data["id_pasien"]; ?></h2>
							<br>

						</td>
					</tr>
					<?php if($pertama=='pertama' && $this->session->userdata('hak_akses')=='perawat'){?>
					<tr>
						<td>
							<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/pendaftaran/input/<?= $data["id_pendaftaran"]; ?>"
								class="btn button-merah"
								onClick="return confirm('Anda yakin ingin melewati pasien ini?')"><i
									class="btn-icon-only icon-remove"> </i>Lewati Pasien </a>
						</td>
						<td>
							<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/rekap_medis/form/<?= $data["id_rekap_medis"]; ?>"
								class="btn button-hijau"><i
									class="btn-icon-only icon-edit"> </i>Periksa Pasien </a>
						</td>
					</tr>
					<?php $pertama='kedua';} ?>
					<?php endforeach ?>
				</table>
			</div>
			<div class="span5" style="max-width: 100%; margin-left: 10px">
				<table class="table table-striped ">
					<tr>
						<td colspan="3">
							<h3>Dilewati Vital Sign</h3>
						</td>
					</tr>
					<?php 
      $pertama='pertama';
      foreach ( $tunggu_vital_sign as $data) :
        $diff= date_diff(date_create($data["tanggal_lahir"]),date_create());?>
					<tr>
						<td style="background-color: #1E323C;text-align:center; color: white"
							rowspan='<?= $pertama=='pertama' && $this->session->userdata('hak_akses')=='perawat'?2 :1 ?>'>
							No.
							<h2><?= $data["no_daftar"]; ?></h2>
						</td>
						<td>
							<?= $data["nama_pasien"]; ?>(<b><?= $data["jenis_kelamin"]; ?></b>)
							<br>
							<?= $diff->y." tahun ".$diff->m." bulan ".$diff->d." hari"; ?>
						</td>
						<td class="td-actions">
							No. RM
							<h2><?= $data["id_pasien"]; ?></h2>
							<br>

						</td>
					</tr>
					<?php if($this->session->userdata('hak_akses')=='perawat'){?>
					<tr>
						<td>
							<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/pendaftaran/input_batal/<?= $data["id_pendaftaran"]; ?>"
								class="btn button-merah"
								onClick="return confirm('Anda yakin ingin menghapus pasien ini dari antrian?')"><i
									class="btn-icon-only icon-remove"> </i>Hapus dari Antrian</a>
						</td>
						<td>
							<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/rekap_medis/form/<?= $data["id_rekap_medis"]; ?>"
								class="btn button-hijau"><i
									class="btn-icon-only icon-edit"> </i>Periksa Pasien </a>
						</td>
					</tr>
					<?php $pertama='kedua';} ?>
					<?php endforeach ?>
				</table>
			</div>
		</div>
	</div>
	<!-- /widget-content -->
</div>

<script src="<?= base_url()?>js/jquery-1.7.2.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
		$(".active").removeClass("active");
		$("#navAntrian-perawat").addClass("active");
		$("#navAntrian-dokter").addClass("active");
	});

</script>
