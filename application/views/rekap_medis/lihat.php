<?php
$diff = date_diff(date_create($rekap_medis->tanggal_lahir), date_create());

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
</style>
<div class="container" style="width: auto;">

	<div class="widget ">

		<div class="widget-header">
			<i class="icon-user"></i>
			<h3><?= $title ?></h3>
		</div> <!-- /widget-header -->

		<div class="widget-content">

			<a href='<?= base_url() ?><?= $this->session->userdata('hak_akses') ?>/rekap_medis/pasien/<?= $rekap_medis->id_pasien; ?>' class="btn button-abu">Kembali</a>
			<?php if ($this->session->userdata('hak_akses') == 'admin') { ?>
				<a href='<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/rekap_medis/cetak/<?= $rekap_medis->id_rekap_medis; ?> ' class="btn button-kuning">Cetak</a>
				<a href="<?= base_url() ?><?= $this->session->userdata('hak_akses') ?>/rekap_medis/hapus/<?= $rekap_medis->id_rekap_medis; ?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn button-merah">Hapus</a>
				<hr>
			<?php } ?>

			<?php if ($rekap_medis->id_rekap_medis == $dataRujukan[2]) { ?>
				<blockquote style="background-color: #FFC107; border-color:#D9A406; box-shadow: 0px 4px 4px rgb(0 0 0 / 25%); margin-top:18px">
					<table>
						<tr style="background-color: transparent !important;">
							<td style="width: 100%;">
								<p style="font-weight: bold;">
									Pasien telah dirujuk ke <?= $dataRujukan[0] ?> di <?= $dataRujukan[1] ?> pada Tanggal <?= date("d-M-Y", strtotime($rekap_medis->tgl_pendaftaran)); ?>
								</p>
							</td>
							<td>
								<a href='<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/rekap_medis/form_rujukan/<?= $rekap_medis->id_rekap_medis; ?> ' class="btn button-biru">Lihat</a>
							</td>
						</tr>
					</table>
				</blockquote>
			<?php } ?>

			<div class="tab-content" style="margin-top: 10px;">
				<table class="table ">
					<tr style="color:white; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);">
						<td class="span3" style="text-align: center; background-color:#148A9D; color:white">
							Tgl Kunjungan: <?= $rekap_medis->tgl_pendaftaran; ?></td>
						<td class="span3" style="text-align: center; background-color:#37AFC2; color:white">
							<?= $rekap_medis->poli_tujuan; ?></td>
						<td class="span3" style="text-align: center; background-color:#6C757D; color:white;">
							No. RM: <?= $rekap_medis->id_pasien; ?>
						</td>
						<!-- <td class="span3" style="">

              </td> -->
					</tr>
					<tr style="background-color: #F6F6F2; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);">
						<td colspan="2">
							<h3><?= $rekap_medis->nama_pasien; ?>(<b><?= $rekap_medis->jenis_kelamin; ?></b>)</h3>
							<br>
							<h4><?= $diff->y . " tahun " . $diff->m . " bulan " . $diff->d . " hari"; ?></h4>
						</td>
						<td>
							<p style="border-bottom: 1px solid grey">Dokter</p>
							<?= $rekap_medis->nama_dokter; ?>
						</td>
						<!-- <td class="span4" rowspan="3" style="">
              </td> -->
					</tr>
				</table>
				<div class="desc-row">
					<div class="col-xs-6" style="width: 50%; margin-left:10px; margin-right:10px">
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

					<div class="col-xs-6 mx-auto" style="width: 50%;  margin-left:10px; margin-right:10px">
						<div class="widget">
							<div class="widget-content" style="min-height: 125px;">
								<?php //if ($this->session->userdata('hak_akses') == 'dokter') { 
								?>
								<!-- <a href="#ubah" role="button" class="btn button-biru pull-right" data-toggle="modal">Ubah Data</a> -->
								<?php //} 
								?>
								<h4>Keluhan/Tujuan Kunjungan</h4>
								<br>
								<?= nl2br($rekap_medis->keluhan); ?>
							</div> <!-- /widget-content -->
						</div> <!-- /widget -->

						<div class="widget">
							<div class="widget-content" style="min-height: 125px;">
								<h4>Riwayat Alergi</h4>
								<br>
								<?= nl2br($rekap_medis->riwayat_alergi); ?>
							</div> <!-- /widget-content -->
						</div> <!-- /widget -->
					</div>
				</div>

				<div class="desc-row">
					<div class="col-xs-6" style="width: 50%; margin-left:10px; margin-right:10px">
						<div class="widget">
							<div class="widget-content" style="min-height: 125px;">
								<h4>Riwayat Penyakit Terdahulu</h4>
								<br>
								<?= nl2br($rekap_medis->riwayat_penyakit_terdahulu); ?>
							</div> <!-- /widget-content -->
						</div> <!-- /widget -->
					</div>
					<div class="col-xs-6" style="width: 50%; margin-left:10px; margin-right:10px">
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
						<div id="ubahAnamnesis" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<form action="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/rekap_medis/input" method="POST">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h3 id="myModalLabel">Anamnesis</h3>
								</div>
								<div class="modal-body">
									<input style="width:98%;" name='id_rekap_medis' type="hidden" value="<?= $rekap_medis->id_rekap_medis; ?>">
									<input style="width:98%;" name='halaman' type="hidden" value="lihat">
									Anamnesis
									<textarea style="width:98%;" name='anamnesis' placeholder="Anamnesis" rows="3"><?= $rekap_medis->anamnesis; ?></textarea>
									<!-- Pemeriksaan -->
									<textarea style="width:98%; display:none" name='pemeriksaan' placeholder="Pemeriksaan" rows="3"><?= $rekap_medis->pemeriksaan; ?></textarea>
									<!-- Terapi -->
									<textarea style="width:98%; display:none" name='terapi' placeholder="Terapi" rows="3"><?= $rekap_medis->terapi; ?></textarea>
								</div>
								<div class="modal-footer">
									<button class="btn button-merah" data-dismiss="modal" aria-hidden="true">Batal</button>
									<button class="btn button-biru">Simpan</button>
								</div>
							</form>
						</div>

						<div id="ubahPemeriksaan" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<form action="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/rekap_medis/input" method="POST">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h3 id="myModalLabel">Pemeriksaan</h3>
								</div>
								<div class="modal-body">
									<input style="width:98%;" name='id_rekap_medis' type="hidden" value="<?= $rekap_medis->id_rekap_medis; ?>">
									<input style="width:98%;" name='halaman' type="hidden" value="lihat">
									<!-- Anamnesis -->
									<textarea style="width:98%; display:none" name='anamnesis' placeholder="Anamnesis" rows="3"><?= $rekap_medis->anamnesis; ?></textarea>
									Pemeriksaan
									<textarea style="width:98%;" name='pemeriksaan' placeholder="Pemeriksaan" rows="3"><?= $rekap_medis->pemeriksaan; ?></textarea>
									<!-- Terapi -->
									<textarea style="width:98%; display:none" name='terapi' placeholder="Terapi" rows="3"><?= $rekap_medis->terapi; ?></textarea>
								</div>
								<div class="modal-footer">
									<button class="btn button-merah" data-dismiss="modal" aria-hidden="true">Batal</button>
									<button class="btn button-biru">Simpan</button>
								</div>
							</form>
						</div>

						<div id="ubahTerapi" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<form action="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/rekap_medis/input" method="POST">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h3 id="myModalLabel">Terapi</h3>
								</div>
								<div class="modal-body">
									<input style="width:98%;" name='id_rekap_medis' type="hidden" value="<?= $rekap_medis->id_rekap_medis; ?>">
									<input style="width:98%;" name='halaman' type="hidden" value="lihat">
									<!-- Anamnesis -->
									<textarea style="width:98%; display:none" name='anamnesis' placeholder="Anamnesis" rows="3"><?= $rekap_medis->anamnesis; ?></textarea>
									<!-- Pemeriksaan -->
									<textarea style="width:98%; display:none" name='pemeriksaan' placeholder="Pemeriksaan" rows="3"><?= $rekap_medis->pemeriksaan; ?></textarea>
									Terapi
									<textarea style="width:98%;" name='terapi' placeholder="Terapi" rows="3"><?= $rekap_medis->terapi; ?></textarea>
								</div>
								<div class="modal-footer">
									<button class="btn button-merah" data-dismiss="modal" aria-hidden="true">Batal</button>
									<button class="btn button-biru">Simpan</button>
								</div>
							</form>
						</div>

						<div id="lampiran" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<form action="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/rekap_medis/upload_file" method="POST" enctype="multipart/form-data">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h3 id="myModalLabel">Tambah Lampiran</h3>
								</div>
								<div class="modal-body">
									<input style="width:98%;" name='id_rekap_medis' type="hidden" value="<?= $rekap_medis->id_rekap_medis; ?>">
									<input style="width:98%;" name='halaman' type="hidden" value="lihat">
									File
									<input style="width:98%;" type='file' name='file'>
									<small>*file pdf maksimal 500Kb</small>

								</div>
								<div class="modal-footer">
									<button class="btn button-merah" data-dismiss="modal" aria-hidden="true">Batal</button>
									<button class="btn button-biru">Simpan</button>
								</div>
							</form>
						</div>
					</div> <!-- /controls -->
				</div> <!-- /control-group -->

				<div class="desc-row">
					<div class="col-xs-6" style="width: 50%; margin-left:10px; margin-right:10px">
						<div class="widget">
							<div class="widget-content" style="min-height: 125px;">
								<?php if ($this->session->userdata('hak_akses') == 'dokter' && $this->session->userdata('id_user') == $rekap_medis->id_user) { ?>
									<a href="#ubahAnamnesis" role="button" class="btn button-biru pull-right" data-toggle="modal">Ubah Data</a>
								<?php } ?>
								<h4>Anamnesis</h4>
								<br>
								<?= nl2br($rekap_medis->anamnesis); ?>
							</div>
						</div>
					</div>

					<div class="col-xs-6" style="width: 50%; margin-left:10px; margin-right:10px">
						<div class="widget">
							<div class="widget-content" style="min-height: 125px;">
								<?php if ($this->session->userdata('hak_akses') == 'dokter' && $this->session->userdata('id_user') == $rekap_medis->id_user) { ?>
									<a href="#ubahPemeriksaan" role="button" class="btn button-biru pull-right" data-toggle="modal">Ubah Data</a>
								<?php } ?>
								<h4>Pemeriksaan</h4>
								<br>
								<?= nl2br($rekap_medis->pemeriksaan); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="desc-row">
					<div class="col-xs-6" style="width: 50%; margin-left:10px; margin-right:10px">
						<div class="widget">
							<div class="widget-content" style="min-height: 125px;">
								<?php if ($this->session->userdata('hak_akses') == 'dokter' && $this->session->userdata('id_user') == $rekap_medis->id_user) { ?>
									<a href="#ubahTerapi" role="button" class="btn button-biru pull-right" data-toggle="modal">Ubah Data</a>
								<?php } ?>
								<h4>Terapi</h4>
								<br>
								<?= nl2br($rekap_medis->terapi); ?>
							</div>
						</div>
					</div>

					<div class="col-xs-6" style="width: 50%; margin-left:10px; margin-right:10px">
						<div class="widget">
							<div class="widget-content" style="min-height: 125px;">
								<?php if ($this->session->userdata('hak_akses') == 'dokter' && $this->session->userdata('id_user') == $rekap_medis->id_user) { ?>
									<a href="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/diagnosa/form/<?= $rekap_medis->id_rekap_medis; ?>?h=lihat" class="btn button-biru pull-right">Diagnosis Pasien</a>
								<?php } ?>
								<h4>Hasil Diagnosis</h4><br>
								<table class="table">
									<tr>
										<th>Nama Penyakit</th>
										<th>Nomor Daftar Terperinci</th>
										<th>Status Terkonfirmasi</th>
										<th>Keterangan</th>
									</tr>
									<?php foreach ($diagnosis as $data) : ?>
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

				<div class="desc-row">
					<div class="col-xs-6" style="width: 50%; margin-left:10px; margin-right:10px">
						<div class="widget">
							<div class="widget-content" style="min-height: 125px;">
								<?php if ($this->session->userdata('hak_akses') == 'dokter' && $this->session->userdata('id_user') == $rekap_medis->id_user) { ?>
									<a href="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/resep_obat/form/<?= $rekap_medis->id_rekap_medis; ?>?h=lihat" class="btn button-biru pull-right">Anjuran Obat</a>
								<?php } ?>
								<h4>Resep Obat</h4><br>
								<table class="table">
									<tr>
										<th>Nama Obat</th>
										<th>Signatura</th>
									</tr>
									<?php foreach ($resep_obat as $data) : ?>
										<tr>
											<td><?= $data['nama_obat']; ?></td>
											<td><?= nl2br($data['signatura']); ?></td>
										</tr>
										<?php endforeach ?>
								</table>
							</div>
						</div>
					</div>

					<div class="col-xs-6" style="width: 50%; margin-left:10px; margin-right:10px">
						<div class="widget">
							<div class="widget-content" style="min-height: 125px;">
								<?php if ($this->session->userdata('hak_akses') == 'dokter' && $this->session->userdata('id_user') == $rekap_medis->id_user) { ?>
									<a href='#lampiran' role="button" class="btn button-kuning pull-right" data-toggle="modal">Tambahkan
										Lampiran</a>
								<?php } ?>
								<h4>File Penunjang</h4><br>
								<table class="table">

									<?php foreach ($file as $data) : ?>
										<tr>
											<td><?= $data['file_name'] ?></td>
											<td>
												<?php if ($this->session->userdata('hak_akses') == 'dokter' && $this->session->userdata('id_user') == $rekap_medis->id_user) { ?>
													<a href="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/rekap_medis/hapus_penunjang/<?= $data['id_penunjang'] ?>/lihat" class="btn button-merah pull-right" onClick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</a>
												<?php } ?>
												<a href="<?= base_url('/') ?><?= $this->session->userdata('hak_akses') ?>/rekap_medis/tampil_file/<?= $data['id_penunjang'] ?>" target='blank' class="btn button-abu pull-right">Lihat</a>
											</td>
											<!-- <td><iframe src="<?= base_url() ?>dokter/resep_obat/tampil_file/<?= $data['id_penunjang'] ?>" width='100%' height='500px'></iframe></td> -->
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

</div>

<script src="<?= base_url() ?>js/jquery-1.7.2.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$(".active").removeClass("active");
		$("#navRekapMedis-admin").addClass("active");
		$("#navRekapMedis-dokter").addClass("active");
	});
</script>