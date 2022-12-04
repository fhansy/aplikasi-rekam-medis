<?php
$diff = date_diff(date_create($rekap_medis->tanggal_lahir), date_create());

if (!empty($rujukan)) {
	$dataRujukan = array(
		"$rujukan->poli_rujukan",
		"$rujukan->rs_rujukan"
	);
} else {
	$dataRujukan = array("", "");
}

$bulan = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
$bulanRomawi = array('I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');
$getBulan = date("M",strtotime($rekap_medis->tgl_pendaftaran));
$tampilRomawi = str_ireplace($bulan, $bulanRomawi, $getBulan);

?>
<?= $this->M_1Setting->cetak(); ?>

<div class="modal fade" id="rujukan" tabindex="-1" role="dialog" aria-labelledby="aksesLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="<?= base_url(); ?>dokter/rekap_medis/rujukan" method="POST" style="margin: 0;">
				<div class="modal-header">
					<h2>Masukan RS Rujukan:</h2>
				</div>
				<div class="modal-body">
					<div class="control-group">
						<label class="control-label">Teman Sejawat dr. Poli</label>
						<div class="controls">
							<input style="width:98%;" name='id_rekap_medis' type="hidden" value="<?= $rekap_medis->id_rekap_medis; ?>">
							<input id="poli_rujukan" name='poli_rujukan' placeholder="Isikan Poli Rujukan" value="<?= $dataRujukan[0] ?>" required>
						</div> <!-- /controls -->
					</div> <!-- /control-group -->
					<div class="control-group">
						<label class="control-label">RS Rujukan</label>
						<div class="controls">
							<input id="rs_rujukan" name='rs_rujukan' placeholder="Isikan RS Rujukan" value="<?= $dataRujukan[1] ?>" required>
						</div> <!-- /controls -->
					</div> <!-- /control-group -->

				</div>
				<div class="modal-footer">
					<div class="column">
						<button type="button" class="btn button-merah pull-left" data-dismiss="modal">Batal</button>
					</div>
					<div class="column">
						<button class="btn button-biru">Simpan</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="row">

	<div class="span12">

		<div class="widget ">
			<div class="widget-header">
				<i class="icon-user"></i>
				<h3><?= $title ?></h3>
			</div> <!-- /widget-header -->

			<div class="widget-content">
				<a href='<?= base_url() ?><?= $this->session->userdata('hak_akses') ?>/rekap_medis/<?= $this->session->userdata('halamanKembali') ?>/<?= $rekap_medis->id_rekap_medis; ?>' class="btn button-abu">Kembali</a>
				<?php if(date("d-m-Y",strtotime($rekap_medis->tgl_pendaftaran)) == date("d-m-Y") && $this->session->userdata('hak_akses') == "dokter"){ ?>
				<button class="btn button-kuning" onclick="printData()">Cetak Surat</button>
				<a href='' data-toggle="modal" data-target="#rujukan" class="btn button-biru">Ubah Rujukan</a>
				<?php } ?>
				<hr>
				<div class="table-responsive" style="white-space: nowrap; overflow-x:auto;">
					<div id="printTable" style="display: inline-block;">
						<table style="width: 100%;">
							<tr>
								<td align="center"><img src='<?= $this->M_1Setting->getLogo(); ?>' width="50px"></td>
								<td>
									<h3>KLINIK PKU MUHAMMADIYAH GANDRUNGMANGU</h3>
									Jl. Raya Gandrungmangu, Tambangan, Wringinharjo,<br>
									Kec. Gandrungmangu, Kabupaten Cilacap, Jawa Tengah 53254<br>
									Email : pku.gandrungmangu@gmail.com<br>
								</td>
							</tr>
						</table>
						<hr style="border-bottom: 1px solid black ">
						<div style="padding: 20px;">
							<h4 align="center">
								SURAT RUJUKAN PASIEN
							</h4>

							<div style="padding: 10px; margin-bottom: 10px; border:1px solid black;">
								<table style="width: 85%;">
									<tr>
										<td style="width: 30%;">Nomor rujukan</td>
										<td> : 440/<?= $pasien->id_pasien ?>/SR/<?= $tampilRomawi; ?>/<?= date("Y",strtotime($rekap_medis->tgl_pendaftaran)); ?></td>
									</tr>
									<tr>
										<td>Klinik</td>
										<td> : Klinik PKU Muhammadiyah Gandrungmangu</td>
									</tr>
									<tr>
										<td>Kabupaten</td>
										<td> : Cilacap</td>
									</tr>
								</table>
							</div>
							<div style="padding-right: 20px; padding-left: 20px; margin-bottom: 10px;">
								<table style="width: 50%;">
									<tr>
										<td style="width: 50%;">Kepada Yth. TS dr. Poli</td>
										<td> : <?= $dataRujukan[0] ?></td>
									</tr>
									<tr>
										<td>Di RSU</td>
										<td> : <?= $dataRujukan[1] ?></td>
									</tr>
								</table>
								<div>
									Mohon pemeriksaan dan penanganan lebih lanjut terhadap pasien:
								</div>
								<table style="width: 70%;">
									<tr>
										<td style="width: 50%;">Nama</td>
										<td> : <?= $pasien->nama_pasien ?></td>
									</tr>
									<tr>
										<td>Umur</td>
										<td style="white-space: pre;">: <?php
																		if ($diff->y != 0) {
																			echo $diff->y . " tahun ";
																		}
																		if ($diff->m != 0) {
																			echo $diff->m . " bulan ";
																		}
																		if ($diff->d != 0) {
																			echo $diff->d . " hari";
																		}
																		?> / <?= $pasien->jenis_kelamin == "L" ? "Laki-laki" : "Perempuan" //date("d-M-Y", strtotime($pasien->tanggal_lahir)); 
																				?></td>
									</tr>
									<tr>
										<td>Dengan Anamnesis</td>
										<td> : </td>
									</tr>
								</table>
								<div style="padding-left: 10px; margin-bottom: 10px;">
									<?php
									if ($rekap_medis->anamnesis == null) {
										echo "-";
									} else {
										echo nl2br($rekap_medis->anamnesis);
									}
									?>
								</div>
								<table style="width: 70%;">
									<tr>
										<td style="width: 50%;">Pemeriksaan yang dilakukan</td>
										<td> : </td>
									</tr>
								</table>
								<div style="padding-left: 10px; margin-bottom: 10px;">
									<?php
									if ($rekap_medis->pemeriksaan == null) {
										echo "-";
									} else {
										echo nl2br($rekap_medis->pemeriksaan);
									}
									?>
								</div>
								<table style="width: 70%;">
									<tr>
										<td style="width: 50%;">Diagnosis</td>
										<td> : </td>
									</tr>
								</table>
								<div style="padding-left: 10px; margin-bottom: 10px;">
								<table style="width: 70%;">
										<?php foreach($diagnosis as $data) : ?>
										<tr>
											<td>-</td>
											<td><?= $data['nama_penyakit']; ?></td>
											<td> <?= $data["penyakit_terkonfirmasi"]=="Y"?"Terkonfirmasi":"Sementara"; ?></td>
										</tr>
										<?php endforeach ?>
									</table>
									<?php
									if ($diagnosis == null) {
										echo "-";
									}
									?>
								</div>
								<table style="width: 70%;">
									<tr>
										<td style="width: 50%;">Terapi yang telah diberikan</td>
										<td> : </td>
									</tr>
								</table>
								<div style="padding-left: 10px; margin-bottom: 10px;">
									<?php
									if ($rekap_medis->terapi == null) {
										echo "-";
									} else {
										echo nl2br($rekap_medis->terapi);
									}
									?>
								</div>
								<table style="width: 70%;">
									<tr>
										<td style="width: 50%;">Pengobatan yang telah diberikan</td>
										<td> : </td>
									</tr>
								</table>
								<div style="padding-left: 10px; margin-bottom: 10px;">
									<table style="width: 70%;">
										<?php foreach ($resep_obat as $data) : ?>
											<tr>
												<td><?= $data['nama_obat']; ?></td>
												<td><?= $data['signatura']; ?></td>
											</tr>
											<?php endforeach ?>
									</table>
									<?php
									if ($resep_obat == null) {
										echo "-";
									}
									?>
								</div>
								<div class="justify-content-center">
									Demikian surat rujukan ini kami kirimkan dan kami mohon balasan atas rujukan ini.
									Atas perhatian dan kerjasama yang diberikan. Kami ucapkan terima kasih.
								</div>
								<div align="right" style="margin-right: 15%; margin-top:5%">
									Salam sejawat, <?= date('d M Y') ?>
								</div>
								<div align="right" style="margin-right: 15%; margin-top:15%">
									( <?= $rekap_medis->nama_dokter; ?> )
								</div>
							</div>
						</div>
					</div>
				</div>





			</div> <!-- /widget-content -->

		</div> <!-- /widget -->

	</div> <!-- /span8 -->




</div> <!-- /row -->

<?php $akses =  $this->session->userdata('hak_akses') ?>
<?php $halamanKembali =  $this->session->userdata('halamanKembali') ?>

<script src="<?= base_url() ?>js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".active").removeClass("active");
		$("#navAntrian-perawat").addClass("active");
		$("#navAntrian-dokter").addClass("active");

		var halamanKembali = <?php echo json_encode($halamanKembali); ?>;
		var akses = <?php echo json_encode($akses); ?>;
		var poliRujukan = <?php echo json_encode($dataRujukan[0]); ?>;
		var RSRujukan = <?php echo json_encode($dataRujukan[1]); ?>;
		if (!sessionStorage.getItem('shown-rujukan') && akses == 'dokter' && halamanKembali == 'periksa' && !poliRujukan && !RSRujukan ) {
			$("#rujukan").modal('show');
			if (poliRujukan != NULL && RSRujukan != NULL) {
				sessionStorage.setItem('shown-rujukan', true);
			}
		}
	});
</script>