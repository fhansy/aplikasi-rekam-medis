<?php
    $diff= date_diff(date_create($rekap_medis->tanggal_lahir),date_create());

	if (!empty($rujukan)) {
		$dataRujukan = array(
			"$rujukan->poli_rujukan",
			"$rujukan->rs_rujukan",
			"$rujukan->id_rekap_medis"
		);
	} else {
		$dataRujukan = array("", "", "");
	}
?>
<style type="text/css">
	.widget {
		margin-bottom: 2em;
	}

	.widget-content {
		border: 1px solid #e6e6e6;
		box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
	}
	.row{
		margin-left: 0;
	}

</style>
<div class="row">

	<div class="container-fluid" style="padding: 0;">

		<div class="widget ">

			<div class="widget-header">
				<i class="icon-user"></i>
				<h3><?= $title?></h3>
			</div> <!-- /widget-header -->

			<div class="widget-content">

			<?php if ($rekap_medis->id_rekap_medis == $dataRujukan[2]) { ?>
				<div class="span8">
					<blockquote style="background-color: #FFC107; border-color:#D9A406; box-shadow: 0px 4px 4px rgb(0 0 0 / 25%);">
						<table>
							<tr style="background-color: transparent !important;">
								<td style="width: 100%;">
									<p style="font-weight: bold;">
										Pasien telah dirujuk ke <?= $dataRujukan[0] ?> di <?= $dataRujukan[1] ?> pada Tanggal <?= date("d-M-Y",strtotime($rekap_medis->tgl_pendaftaran)); ?>
									</p>
								</td>
							</tr>
						</table>
					</blockquote>
				</div>
			<?php } ?>

				<div class="tab-content">

					<div class="row">
						<div class="span8">
							<table class="table" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);">
								<tr style="color:white">
									<td class="span3" style="text-align: center; background-color:#148A9D; color:white">Dalam Pemeriksaan
									</td>
									<td class="span3" style="text-align: center; background-color:#37AFC2; color:white">
										<?= $rekap_medis->poli_tujuan; ?>
									</td>
									<td class="span3" style="text-align: center; background-color:#6C757D; color:white;">
											No. RM: <?= $rekap_medis->id_pasien; ?>
									</td>
									<!-- <td class="span3" style="background-color: grey;text-align:center; color: white">
								Tindakan Pasien
							</td> -->
								</tr>
								<tr style="background-color: #F6F6F2;">
									<td colspan="2">
										<h3><?= $rekap_medis->nama_pasien; ?>(<b><?= $rekap_medis->jenis_kelamin; ?></b>)
										</h3>
										<br>
										<p style="margin: 0;">Umur</p>
										<h4><?php
										if($diff->y != 0) {
											echo $diff->y . " tahun ";
										}
										if($diff->m != 0) {
											echo $diff->m . " bulan ";
										}
										if($diff->d != 0) {
											echo $diff->d . " hari";
										}
										?></h4>
									</td>
									<td>
										<p style="border-bottom: 1px solid grey">Dokter</p>
										<?= $this->session->userdata('nama')?>
									</td>
								</tr>
							</table>
						</div>
						<div class="span3">
							<div class="widget">
								<div class="widget-content"
									style="background-color: #343F4B;text-align:center; ; color: white; min-height: 80px;">
									<!-- <td class="span4" rowspan="3" style="background-color: #343F4B;text-align:center; color: white"> -->
									<a href="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/resep_obat/print/<?= $rekap_medis->id_rekap_medis; ?>?h=lihat"
										class="btn button-hijau" style="width: 80%; margin-bottom:10px"
										onClick="sessionStorage.removeItem('shown-rujukan'); return confirm('Anda yakin ingin mengakhiri kunjungan ini?')">Akhiri Kunjungan</a>
									<?php 
									$terkonfirmasi = 'Y';
									foreach($diagnosis as $data) :
										$terkonfirmasi = $data['penyakit_terkonfirmasi'];
									endforeach;
										if($terkonfirmasi == 'N'){ ?>
									<a href='<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/rekap_medis/form_rujukan/<?= $rekap_medis->id_rekap_medis; ?> ' class="btn button-kuning" style="width: 80%;">Buat Surat Rujukan</a>
									<?php } ?>
									<!-- </td> -->
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="span5">

							<div class="widget">

								<div class="widget-content">

									<h4>Hasil Pemeriksaan Vital</h4>
									<br>
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
											<td>: <?= $rekap_medis->suhu_badan; ?><sup>o</sup>C</td>
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
												<?= $rekap_medis->tekanan_darah_sistolik; ?>/<?= $rekap_medis->tekanan_darah_diastolik; ?>
												mmHg</td>
										</tr>
									</table>

								</div> <!-- /widget-content -->

							</div> <!-- /widget -->

						</div>
						<div class="span5">
							<div class="widget">
								<div class="widget-content">

									<h4>Riwayat Rekam Medis</h4>
									<br>
									<table class="table">
										<tr>
											<th style="text-align: center;">Tanggal Kunjungan</th>
											<th style="text-align: center;">Poli</th>
										</tr>
										<?php foreach($rekap_medis_pasien as $data) : ?>
										<tr
											onclick="window.location='<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/rekap_medis/lihat/<?= $data['id_rekap_medis']; ?>';">
											<td><?= date("d-M-Y",strtotime($data['tgl_pendaftaran'])); ?></td>
											<td> <span class="alert pull-right"
													style="margin: 0; padding: 8px 14px 8px 14px; background-color:#37AFC2; color:white"><?= $data['poli_tujuan']; ?></span></td>
										</tr>
										<?php endforeach ?>
									</table>
									<center>
										<a href='<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/rekap_medis/pasien/<?= $rekap_medis->id_pasien; ?> '
											class="btn button-biru">
											Lihat Rekam Medis
										</a>
									</center>

								</div> <!-- /widget-content -->
							</div> <!-- /widget -->
						</div>
					</div>

					<div class="row">
						<div class="span5">
							<div class="widget">
								<div class="widget-content" style="min-height: 125px;">
									<!-- <a href="#ubah" role="button" class="btn button-biru pull-right" data-toggle="modal">Ubah Data</a> -->
									<h4>Keluhan/Tujuan Kunjungan</h4>
									<br>
									<?= $rekap_medis->keluhan; ?>

								</div> <!-- /widget-content -->

							</div> <!-- /widget -->
						</div>
						<div class="span5">
							<div class="widget">
								<div class="widget-content" style="min-height: 125px;">
									<h4>Riwayat Alergi</h4>
									<br>
									<?= nl2br($rekap_medis->riwayat_alergi); ?>
								</div> <!-- /widget-content -->
							</div> <!-- /widget -->

						</div>
					</div>

					<div class="row">
						<div class="span5">
							<div class="widget">
								<div class="widget-content" style="min-height: 125px;">
									<h4>Riwayat Penyakit Terdahulu</h4>
									<br>
									<?= nl2br($rekap_medis->riwayat_penyakit_terdahulu); ?>
								</div> <!-- /widget-content -->
							</div> <!-- /widget -->
						</div>
						<div class="span5">
							<div class="widget">
								<div class="widget-content" style="min-height: 125px;">
									<h4>Riwayat Kebiasaan</h4>
									<br>
									<?= nl2br($rekap_medis->riwayat_kebiasaan); ?>
								</div> <!-- /widget-content -->
							</div> <!-- /widget -->
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<!-- Button to trigger modal -->
							<!-- Modal -->
							<div id="ubahAnamnesis" class="modal hide fade" tabindex="-1" role="dialog"
								aria-labelledby="myModalLabel" aria-hidden="true">
								<form
									action="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/rekap_medis/input"
									method="POST">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"
											aria-hidden="true">×</button>
										<h3 id="myModalLabel">Anamnesis</h3>
									</div>
									<div class="modal-body">
										<input style="width:98%;" name='id_rekap_medis' type="hidden"
											value="<?= $rekap_medis->id_rekap_medis; ?>">
										<input style="width:98%;" name='halaman' type="hidden" value="periksa">
										Anamnesis
										<textarea style="width:98%;" name='anamnesis' placeholder="Anamnesis"
											rows="3"><?= $rekap_medis->anamnesis; ?></textarea>
										<!-- Pemeriksaan -->
										<textarea style="width:98%; display:none" name='pemeriksaan'
											placeholder="Pemeriksaan"
											rows="3"><?= $rekap_medis->pemeriksaan; ?></textarea>
										<!-- Terapi -->
										<textarea style="width:98%; display:none" name='terapi' placeholder="Terapi"
											rows="3"><?= $rekap_medis->terapi; ?></textarea>
									</div>
									<div class="modal-footer">
										<button class="btn button-merah" data-dismiss="modal"
											aria-hidden="true">Batal</button>
										<button class="btn button-biru">Simpan</button>
									</div>
								</form>
							</div>

							<div id="ubahPemeriksaan" class="modal hide fade" tabindex="-1" role="dialog"
								aria-labelledby="myModalLabel" aria-hidden="true">
								<form
									action="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/rekap_medis/input"
									method="POST">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"
											aria-hidden="true">×</button>
										<h3 id="myModalLabel">Pemeriksaan</h3>
									</div>
									<div class="modal-body">
										<input style="width:98%;" name='id_rekap_medis' type="hidden"
											value="<?= $rekap_medis->id_rekap_medis; ?>">
										<input style="width:98%;" name='halaman' type="hidden" value="periksa">
										<!-- Anamnesis -->
										<textarea style="width:98%; display:none" name='anamnesis'
											placeholder="Anamnesis" rows="3"><?= $rekap_medis->anamnesis; ?></textarea>
										Pemeriksaan
										<textarea style="width:98%;" name='pemeriksaan' placeholder="Pemeriksaan"
											rows="3"><?= $rekap_medis->pemeriksaan; ?></textarea>
										<!-- Terapi -->
										<textarea style="width:98%; display:none" name='terapi' placeholder="Terapi"
											rows="3"><?= $rekap_medis->terapi; ?></textarea>
									</div>
									<div class="modal-footer">
										<button class="btn button-merah" data-dismiss="modal"
											aria-hidden="true">Batal</button>
										<button class="btn button-biru">Simpan</button>
									</div>
								</form>
							</div>

							<div id="ubahTerapi" class="modal hide fade" tabindex="-1" role="dialog"
								aria-labelledby="myModalLabel" aria-hidden="true">
								<form
									action="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/rekap_medis/input"
									method="POST">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"
											aria-hidden="true">×</button>
										<h3 id="myModalLabel">Terapi</h3>
									</div>
									<div class="modal-body">
										<input style="width:98%;" name='id_rekap_medis' type="hidden"
											value="<?= $rekap_medis->id_rekap_medis; ?>">
										<input style="width:98%;" name='halaman' type="hidden" value="periksa">
										<!-- Anamnesis -->
										<textarea style="width:98%; display:none" name='anamnesis'
											placeholder="Anamnesis" rows="3"><?= $rekap_medis->anamnesis; ?></textarea>
										<!-- Pemeriksaan -->
										<textarea style="width:98%; display:none" name='pemeriksaan'
											placeholder="Pemeriksaan"
											rows="3"><?= $rekap_medis->pemeriksaan; ?></textarea>
										Terapi
										<textarea style="width:98%;" name='terapi' placeholder="Terapi"
											rows="3"><?= $rekap_medis->terapi; ?></textarea>
									</div>
									<div class="modal-footer">
										<button class="btn button-merah" data-dismiss="modal"
											aria-hidden="true">Batal</button>
										<button class="btn button-biru">Simpan</button>
									</div>
								</form>
							</div>

							<div id="lampiran" class="modal hide fade" tabindex="-1" role="dialog"
								aria-labelledby="myModalLabel" aria-hidden="true">
								<form
									action="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/rekap_medis/upload_file"
									method="POST" enctype="multipart/form-data">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"
											aria-hidden="true">×</button>
										<h3 id="myModalLabel">Tambah Lampiran</h3>
									</div>
									<div class="modal-body">
										<input style="width:98%;" name='id_rekap_medis' type="hidden"
											value="<?= $rekap_medis->id_rekap_medis; ?>">
										<input style="width:98%;" name='halaman' type="hidden" value="periksa">
										File
										<input style="width:98%;" type='file' name='file'>
										<small>*file pdf maksimal 500Kb</small>

									</div>
									<div class="modal-footer">
										<button class="btn button-merah" data-dismiss="modal"
											aria-hidden="true">Batal</button>
										<button class="btn button-biru">Simpan</button>
									</div>
								</form>
							</div>
						</div> <!-- /controls -->
					</div> <!-- /control-group -->

					<div class="row ">

						<div class="span5">
							<div class="widget">
								<div class="widget-content" style="min-height: 125px;">
									<a href="#ubahAnamnesis" role="button" class="btn button-biru pull-right"
										data-toggle="modal">Ubah Data</a>
									<h4>Anamnesis</h4>

									<?= nl2br($rekap_medis->anamnesis); ?>
								</div>
							</div>
						</div>

						<div class="span5">
							<div class="widget">
								<div class="widget-content" style="min-height: 125px;">
									<?php if ($this->session->userdata('hak_akses') == 'dokter') { ?>
									<a href="#ubahPemeriksaan" role="button" class="btn button-biru pull-right"
										data-toggle="modal">Ubah Data</a>
									<?php } ?>
									<h4>Pemeriksaan</h4>
									<br>
									<?= nl2br($rekap_medis->pemeriksaan); ?>
								</div>
							</div>
						</div>
					</div>

					<div class="row ">
						<div class="span5">
							<div class="widget">
								<div class="widget-content" style="min-height: 125px;">
									<a href="#ubahTerapi" role="button" class="btn button-biru pull-right"
										data-toggle="modal">Ubah Data</a>
									<h4>Terapi</h4>

									<?= nl2br($rekap_medis->terapi); ?>
								</div>
							</div>
						</div>

						<div class="span5">
							<div class="widget">
								<div class="widget-content" style="min-height: 125px;">
									<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/diagnosa/form/<?= $rekap_medis->id_rekap_medis; ?>?h=periksa"
										class="btn button-biru pull-right">Diagnosis Pasien</a>
									<h4>Hasil Diagnosis</h4>
									<table class="table">
										<tr>
											<th>Nama Penyakit</th>
											<th>Nomor Daftar Terperinci</th>
											<th>Status Terkonfirmasi</th>
											<th>Keterangan</th>
										</tr>
										<?php foreach($diagnosis as $data) : ?>
										<tr>
											<td><?= $data['nama_penyakit']; ?></td>
											<td><?= $data['kode_icdx']; ?></td>
											<td><?= $data['penyakit_terkonfirmasi']; ?></td>
											<td><?= nl2br($data['keterangan']); ?></td>
										</tr>
										<?php endforeach ?>
									</table>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
					<div class="span5">
							<div class="widget">
								<div class="widget-content" style="min-height: 125px;">
									<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/resep_obat/form/<?= $rekap_medis->id_rekap_medis; ?>?h=periksa"
										class="btn button-biru pull-right">Anjuran Obat</a>
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
						</div>

						<div class="span5">
							<div id="lampiran" class="modal hide fade" tabindex="-1" role="dialog"
								aria-labelledby="myModalLabel" aria-hidden="true">
								<form
									action="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/rekap_medis/upload_file"
									method="POST" enctype="multipart/form-data">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"
											aria-hidden="true">×</button>
										<h3 id="myModalLabel">Tambahkan hasil pemeriksaan penunjang</h3>
									</div>
									<div class="modal-body">
										<input style="width:98%;" name='id_rekap_medis' type="hidden"
											value="<?= $rekap_medis->id_rekap_medis;?>">
										<input style="width:98%;" name='halaman' type="hidden" value="periksa">
										<input style="width:98%;" type='file' id="files" name='file'>
										<!-- <label for="files" class="btn button-kuning">Pilih file penunjang</label> -->
										<small>*file pdf maksimal 500Kb</small>

									</div>
									<div class="modal-footer">
										<button class="btn button-merah" data-dismiss="modal"
											aria-hidden="true">Batal</button>
										<button class="btn button-biru">Simpan</button>
									</div>
								</form>
							</div>
							<div class="widget">
								<div class="widget-content" style="min-height: 125px;">
									<a href='#lampiran' role="button" class="btn button-kuning pull-right"
										data-toggle="modal">Tambahkan
										Lampiran</a>
									<h4>File Penunjang</h4>
									<table class="table">

										<?php foreach($file as $data) : ?>
										<tr>
											<td><?= $data['file_name']?></td>
											<td>
												<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/rekap_medis/hapus_penunjang/<?= $data['id_penunjang'] ?>/periksa"
													class="btn button-merah pull-right"
													onClick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</a>
												<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/rekap_medis/tampil_file/<?= $data['id_penunjang'] ?>"
													target='blank' class="btn button-biru pull-right">Lihat</a>
											</td>
											<!-- <td><iframe src="<?= base_url()?>dokter/resep_obat/tampil_file/<?= $data['id_penunjang'] ?>" width='100%' height='500px'></iframe></td> -->
										</tr>
										<?php endforeach ?>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>





			</div> <!-- /widget-content -->

		</div> <!-- /widget -->

	</div> <!-- /span8 -->




</div> <!-- /row -->
<script src="<?= base_url()?>js/jquery-1.7.2.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
		$(".active").removeClass("active");
		$("#navAntrian-perawat").addClass("active");
		$("#navAntrian-dokter").addClass("active");
	});

</script>