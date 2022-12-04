<?php
$penyakit_terkonfirmasi=array(
      "Y"=>"Ya",
      "N"=>"Tidak");
?>

<style type="text/css">
	.widget {
		margin-bottom: 2em;
	}

	.widget-content {
		border: 1px solid #e6e6e6;
		box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
	}

	.form-horizontal .control-group {
		border: 0;
	}

</style>

<div class="row">

	<div class="span12">

		<div class="widget ">

			<div class="widget-header">
				<i class="icon-th-list"></i>
				<h3>Tambah <?=$title?> Penyakit</h3>
			</div> <!-- /widget-header -->
			<div class="widget-content">


				<a href="<?= base_url()?><?= $this->session->userdata('hak_akses')?>/rekap_medis/<?= $_GET['h'];?>/<?= $rekap_medis->id_rekap_medis;?>"
					class="btn button-abu" style="margin-bottom: 10px;"><i
						class="btn-icon-only icon-arrow-left"> </i>Kembali</a>

				<div class="tab-content">
					<form id="edit-profile"
						action="<?= base_url()?><?= $this->session->userdata('hak_akses')?>/diagnosa/input"
						method="POST" class="form-horizontal" enctype="multipart/form-data">
						<fieldset>

							<div class="control-group span3">
								<label>Penyakit</label>
								<input type="hidden" id="id_rekap_medis" name="id_rekap_medis"
									value="<?= $rekap_medis->id_rekap_medis;?>">
								<input type="hidden" id="halaman" name="halaman" value="<?= $_GET['h'];?>">
								<select id="penyakit" name="id_penyakit" required="">
									<option value=""></option>
									<?php foreach($penyakit as $data) : ?>
									<option value="<?= $data['id_penyakit'];?>"><?= $data['kode_dtd'];?> | <?= $data['kode_icdx'];?> | <?= $data['nama_penyakit'];?></option>
									<?php endforeach ?>
								</select>
							</div> <!-- /control-group -->

							<div class="control-group span3">
								<label>Penyakit Terkonfirmasi</label>
								<select name="penyakit_terkonfirmasi">
									<?php foreach ( $penyakit_terkonfirmasi as $data2 => $value) : ?>
									<option value="<?= $data2;?>"><?= $value;?></option>
									<?php endforeach ?>
								</select>
							</div> <!-- /control-group -->

							<div id="keterangan" class="control-group" style="display: none;">
								<label>Keterangan</label>
								<textarea class="span3" id="keterangan" name="keterangan"
									placeholder="Keterangan Diagnosis Sementara" rows='5' value=""></textarea>
							</div> <!-- /control-group -->
							<br>
							<div class="control-group span3">
								<button type="submit" class="btn button-biru">Simpan</button>
							</div>
						</fieldset>
					</form>

				</div>
			</div>
		</div>

		<div class="widget ">

			<div class="widget-header">
				<i class="icon-th-list"></i>
				<h3>Hasil <?=$title?> RM. <?= $rekap_medis->id_pasien;?></h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">


				<?php $head = array("#","Nama Penyakit","Status Diagnosis","Keterangan","Action"); $no=0;?>
				<table class="table table-striped table-bordered data-table">
					<thead>
						<tr>
							<?php foreach ( $head as $data) : ?>
							<th> <?= $data; ?></th>
							<?php endforeach ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $diagnosis as $data) : $no++;?>
						<tr>
							<td> <?= $no; ?></td>
							<td> <?= $data["nama_penyakit"]; ?></td>
							<td> <?= $data["penyakit_terkonfirmasi"]=="Y"?"Terkonfirmasi":"Sementara"; ?></td>
							<td> <?= nl2br($data["keterangan"]); ?></td>
							<td class="td-actions">
								<a href="<?= base_url()?><?= $this->session->userdata('hak_akses')?>/diagnosa/hapus/<?= $data["id_diagnosa"]; ?>/<?= $data["id_rekap_medis"]; ?>/<?= $_GET['h']?>"
									class="btn btn-small button-merah"
									onClick="return confirm('Anda yakin ingin menghapus data ini?')"><i
										class="btn-icon-only icon-remove"> </i>Hapus</a>
							</td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>


			</div> <!-- /widget-content -->

		</div> <!-- /widget -->

	</div> <!-- /span8 -->




</div> <!-- /row -->
<script src="<?= base_url()?>js/jquery-1.7.2.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
		$(".active").removeClass("active");
	});

</script>