<?php
    $diff= date_diff(date_create($rekap_medis->tanggal_lahir),date_create());

	if($pasien->identitas == 'NIK'){
		$noIdentitas = $pasien->nik;
	}else if($pasien->identitas == 'SIM'){
		$noIdentitas = $pasien->sim;
	}else if($pasien->identitas == 'Paspor'){
		$noIdentitas = $pasien->paspor;
	}
?>
<?= $this->M_1Setting->cetak();?>

<div class="row">

	<div class="span12">

		<div class="widget ">
			<div class="widget-header">
				<i class="icon-user"></i>
				<h3><?= $title?></h3>
			</div> <!-- /widget-header -->

			<div class="widget-content">
				<a href='<?= base_url()?><?= $this->session->userdata('hak_akses')?>/rekap_medis/pasien/<?= $rekap_medis->id_pasien; ?>'
				class="btn button-abu">Kembali</a>
				<button class="btn button-kuning" onclick="printData()">Cetak</button>
				<hr>
				<div class="tab-content">
					<div id="printTable">
						<table style="width: 100%;">
							<tr>
								<td><img src='<?= $this->M_1Setting->getLogo();?>' width="50px"></td>
								<td align="center">
									<h3>KLINIK PKU MUHAMMADIYAH GANDRUNGMANGU</h3>
									Jl. Raya Gandrungmangu, Tambangan, Wringinharjo,<br>
									Kec. Gandrungmangu, Kabupaten Cilacap, Jawa Tengah 53254<br>
									Email : pku.gandrungmangu@gmail.com<br>
								</td>
							</tr>
						</table>
						<table style="width: 100%;">
							<tr>
								<td colspan="4">
									<hr style="border-bottom: 1px solid black ">
									<h4>Rekam Medis <?= $rekap_medis->poli_tujuan; ?></h4>
								</td>
							</tr>
							<tr>
								<td>Hari/Tanggal</td>
								<td>:</td>
								<td><?= Date("d-m-Y",strtotime($rekap_medis->tgl_pendaftaran)) ?></td>
								<td align="center">No. Rekam Medis</td>
							</tr>
							<tr>
								<td>Dokter</td>
								<td>:</td>
								<td><?= $rekap_medis->nama_dokter; ?></td>
								<td align="center"><?= $rekap_medis->id_pasien; ?></td>
							</tr>

						</table>
						<hr>
						<div class="card panel panel-default"
							style="border-radius: 0; margin-bottom: 50px; box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, 0.25);">
							<table class="table">
								<tr>
									<td>Nama</td>
									<td> : <?= $pasien->nama_pasien ?></td>
									<td>Agama</td>
									<td> : <?= $pasien->agama ?></td>
								</tr>
								<tr>
									<td>No Identitas ( <?= $pasien->identitas ?> )</td>
									<td> : <?= $noIdentitas ?></td>
									<td>Status Perkawinan</td>
									<td> : <?= $pasien->status_perkawinan=="bk"?"Belum Kawin":"Kawin" ?></td>
								</tr>
								<tr>
									<td>Tempat Lahir</td>
									<td> : <?= $pasien->tempat_lahir ?></td>
									<td>Pekerjaan</td>
									<td> : <?= $pasien->pekerjaan ?></td>
								</tr>
								<tr>
									<td>Tanggal Lahir</td>
									<td> : <?= $pasien->tanggal_lahir ?></td>
									<td>Alamat Lengkap</td>
									<td> : <?= $pasien->alamat ?></td>
								</tr>
								<tr>
									<td>Umur</td>
									<td> : <?= $diff->y." tahun ".$diff->m." bulan ".$diff->d." hari"; ?></td>
									<td>Nomer Telepon</td>
									<td> : <?= $pasien->no_telp ?></td>
								</tr>
								<tr>
									<td>Jenis Kelamin</td>
									<td> : <?= $pasien->jenis_kelamin=="L"?"Laki-laki":"Perempuan" ?></td>
								</tr>
							</table>
						</div>

						<div class="column">
							<div width="50%" align="center" style="border: 1px solid black">SOA</div>
							<div class="widget">
								<div class="widget-content">
									<h4>Keluhan/Tujuan Kunjungan</h4>
									<?= nl2br($rekap_medis->keluhan); ?>
								</div>
							</div>
							<div class="widget">
								<div class="widget-content">

									<h4>Hasil Pemeriksaan Vital</h4>
									<table class="table ">
										<tr>
											<td>Tinggi Badan</td>
											<td>: <?= $rekap_medis->tinggi_badan; ?> cm</td>
										</tr>
										<tr>
											<td>Berat Badan</td>
											<td>: <?= $rekap_medis->berat_badan; ?> kg</td>
										</tr>
										<tr>
											<td>Suhu Badan</td>
											<td>: <?= $rekap_medis->berat_badan; ?><sup>o</sup>C</td>
										</tr>
										<tr>
											<td>Frekuensi Nadi</td>
											<td>: <?= $rekap_medis->frekuensi_nadi; ?> kali/menit</td>
										</tr>
										<tr>
											<td>Frekuensi Pernapasan</td>
											<td>: <?= $rekap_medis->frekuensi_pernapasan; ?> kali/menit </td>
										</tr>
										<tr>
											<td>Tekanan Darah</td>
											<td>:
												<?= $rekap_medis->tekanan_darah_diastolik; ?>/<?= $rekap_medis->tekanan_darah_sistolik; ?>
												mmHg</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="widget">
								<div class="widget-content">

									<h4>Riwayat Alergi</h4>
									<?= nl2br($rekap_medis->riwayat_alergi); ?>
								</div>
							</div>
							<div class="widget">
								<div class="widget-content">

									<h4>Riwayat Penyakit Terdahulu</h4>
									<?= nl2br($rekap_medis->riwayat_penyakit_terdahulu); ?>
								</div>
							</div>
							<div class="widget">
								<div class="widget-content">

									<h4>Riwayat Kebiasaan</h4>
									<?= nl2br($rekap_medis->riwayat_kebiasaan); ?>
								</div>
							</div>
							<div class="widget">
								<div class="widget-content">

									<h4>Anamnesis</h4>
									<?= nl2br($rekap_medis->anamnesis); ?>
								</div>
							</div>
							<div class="widget">
								<div class="widget-content">

									<h4>Pemeriksaan</h4>
									<?= nl2br($rekap_medis->pemeriksaan); ?>
								</div>
							</div>
							<div class="widget">
								<div class="widget-content">

									<h4>Hasil Diagnosis</h4>
									<table class="table">
										<tr>
											<th>Nama Penyakit</th>
											<th>Nomor Daftar Terperinci</th>
											<th>Status Terkonfirmasi</th>
										</tr>
										<?php foreach($diagnosis as $data) : ?>
										<tr>
											<td><?= $data['nama_penyakit']; ?></td>
											<td><?= $data['kode_icdx']; ?></td>
											<td><?= $data['penyakit_terkonfirmasi']=='Y'?"Terkonfirmasi":""; ?>
											</td>
										</tr>
										<?php endforeach ?>
									</table>
								</div>
							</div>
							<div class="widget">
								<div class="widget-content">

									<h4>File Penunjang</h4>
									<table class="table">

										<?php foreach($file as $data) : ?>
										<tr>
											<td><?= $data['file_name']?></td>
										</tr>
										<?php endforeach ?>
									</table>
								</div>
							</div>
						</div>

						<div class="column">
							<div width="50%" align="center" style="border: 1px solid black">TERAPI</div>
							<td rowspan="3" valign="top">

								<div class="widget">
									<div class="widget-content">
										<h4>Terapi</h4>
										<?= nl2br($rekap_medis->terapi); ?>

									</div>
								</div>
								<div class="widget">
									<div class="widget-content">

										<h4>Resep Obat</h4>
										<table class="table">
											<tr>
												<th>Nama Obat</th>
												<th>Signatura</th>
											</tr>
											<?php foreach($resep_obat as $data) : ?>
											<tr>
												<td><?= $data['nama_obat']; ?></td>
												<td><?= $data['signatura']; ?></td>
											</tr>
											<?php endforeach ?>

										</table>
									</div>
								</div>
							</td>
						</div>
					</div>
				</div>





			</div> <!-- /widget-content -->

		</div> <!-- /widget -->

	</div> <!-- /span8 -->




</div> <!-- /row -->
