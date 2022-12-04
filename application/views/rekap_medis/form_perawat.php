<?php
    if(!empty($rekap_medis)){
        $data = array(
          "$rekap_medis->id_rekap_medis",
          "$rekap_medis->nama_pasien",
          "$rekap_medis->jenis_kelamin",
          "$rekap_medis->tanggal_lahir",
          "$rekap_medis->tinggi_badan",
          "$rekap_medis->berat_badan",
          "$rekap_medis->suhu_badan",
          "$rekap_medis->frekuensi_nadi",
          "$rekap_medis->frekuensi_pernapasan",
          "$rekap_medis->tekanan_darah_sistolik",
          "$rekap_medis->tekanan_darah_diastolik",
          "$rekap_medis->id_pendaftaran");
    }else{
        $data = array("","","","","","","","","","","","");
    }
    $diff= date_diff(date_create($data[3]),date_create());
?>
<div class="row">

	<div class="span12">

		<div class="widget ">

			<div class="widget-header">
				<i class="icon-user"></i>
				<h3><?= $title?></h3>
			</div> <!-- /widget-header -->

			<div class="widget-content">

				<div class="tab-content">
					<form id="edit-profile" name="edit-profile"
						action="<?= base_url()?><?= $this->session->userdata('hak_akses')?>/rekap_medis/input"
						method="POST" class="form-horizontal" data-toggle="validator" role="form">
						<fieldset>
							<div class="control-group">
								<div class="controls" style="margin: auto;">
									<table class="table table-striped table-bordered data-table">
										<tr>
											<td>
												<?= $data[1]; ?>(<b><?= $data[2]; ?></b>)
												<br>
												<?= $diff->y." tahun ".$diff->m." bulan ".$diff->d." hari"; ?>
											</td>
											<td class="td-actions"
												style="background-color: #1E323C;text-align:center; color: white">
												No. RM
												<h2><?= $rekap_medis->id_pasien; ?></h2>
												<br>

											</td>
										</tr>
									</table>
								</div>
							</div>

							<table class="table table-striped table-bordered data-table">
								<tr>
									<td>
										<h3>Pemeriksaan Tanda Vital Pasien</h3>
									</td>
								</tr>
							</table>

							<div class="control-group">
								<label class="control-label">Tinggi Badan</label>
								<div class="controls">
									<input type="hidden" class="span2" id="id_rekap_medis" name="id_rekap_medis"
										value="<?= $data[0]; ?>">
									<input type="hidden" class="span2" id="id_pendaftaran" name="id_pendaftaran"
										value="<?= $data[11]; ?>">
									<input type="number" class="span2" id="tinggi_badan" name="tinggi_badan"
										value="<?= $data[4]; ?>" required min="15" max="500"> cm
								</div> <!-- /controls -->
							</div> <!-- /control-group -->

							<div class="control-group">
								<label class="control-label">Berat Badan</label>
								<div class="controls">
									<input type="number" class="span2" id="berat_badan" name="berat_badan"
										value="<?= $data[5]; ?>" required min="1" max="600" step="0.1"> kg
								</div> <!-- /controls -->
							</div> <!-- /control-group -->

							<div class="control-group">
								<label class="control-label">Suhu Badan</label>
								<div class="controls">
									<input type="number" class="span2" id="suhu_badan" name="suhu_badan"
										value="<?= $data[6]; ?>" required min="32" max="45" step="0.1"> <sup>o</sup>C
								</div> <!-- /controls -->
							</div> <!-- /control-group -->

							<div class="control-group">
								<label class="control-label">Frekuensi Nadi</label>
								<div class="controls">
									<input type="number" class="span2" id="frekuensi_nadi" name="frekuensi_nadi"
										value="<?= $data[7]; ?>" required min="30" max="250"> kali/menit
								</div> <!-- /controls -->
							</div> <!-- /control-group -->

							<div class="control-group">
								<label class="control-label">Frekuensi Pernapasan</label>
								<div class="controls">
									<input type="number" class="span2" id="frekuensi_pernapasan"
										name="frekuensi_pernapasan" value="<?= $data[8]; ?>" required min="6" max="50">
									kali/menit
								</div> <!-- /controls -->
							</div> <!-- /control-group -->

							<div class="control-group">
								<label class="control-label">Tekanan Darah</label>
								<div class="controls">

								</div> <!-- /controls -->
							</div> <!-- /control-group -->
							<div class="control-group">
								<label class="control-label">Sistolik</label>
								<div class="controls">
									<input type="number" class="span2" id="tekanan_darah_sistolik"
										name="tekanan_darah_sistolik" value="<?= $data[9]; ?>" required min="0"
										max="280"> mm/Hg
								</div> <!-- /controls -->
							</div> <!-- /control-group -->
							<div class="control-group">
								<label class="control-label">Diastolik</label>
								<div class="controls">
									<input type="number" class="span2" id="tekanan_darah_diastolik"
										name="tekanan_darah_diastolik" value="<?= $data[10]; ?>" required min="0"
										max="280">
									mm/Hg
								</div> <!-- /controls -->
							</div> <!-- /control-group -->

							<table class="table table-striped table-bordered data-table">
								<tr>
									<td>
										<h3>Riwayat Kesehatan Pasien</h3>
									</td>
								</tr>
							</table>

							<div class="control-group">
								<label class="control-label">Riwayat Alergi</label>
								<div class="controls">
									<textarea class="span2" name='riwayat_alergi' placeholder="Riwayat Alergi"
										rows="3"><?= $rekap_medis->riwayat_alergi;?></textarea>
								</div> <!-- /controls -->
							</div> <!-- /control-group -->

							<div class="control-group">
								<label class="control-label">Riwayat Penyakit Terdahulu</label>
								<div class="controls">
									<textarea class="span2" name='riwayat_penyakit_terdahulu'
										placeholder="Riwayat Penyakit Terdahulu"
										rows="3"><?= $rekap_medis->riwayat_penyakit_terdahulu;?></textarea>
								</div> <!-- /controls -->
							</div> <!-- /control-group -->

							<div class="control-group">
								<label class="control-label">Riwayat Kebiasaan Pasien</label>
								<div class="controls">
									<textarea class="span2" name='riwayat_kebiasaan'
										placeholder="Riwayat Kebiasaan Pasien"
										rows="3"><?= $rekap_medis->riwayat_kebiasaan;?></textarea>
								</div> <!-- /controls -->
							</div> <!-- /control-group -->

							<div class="form-actions">
								<a href="<?= base_url()?><?= $this->session->userdata('hak_akses')?>/pendaftaran/"
									class="btn button-merah">Batal</a>
								<button type="submit" class="btn button-biru">Simpan</button>
							</div> <!-- /form-actions -->
						</fieldset>
					</form>


				</div>





			</div> <!-- /widget-content -->

		</div> <!-- /widget -->

	</div> <!-- /span8 -->




</div> <!-- /row -->
