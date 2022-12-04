 <?php 
  $head = array("No. Rekam Medis","No. Identitas","Nama","Alamat","Action");
  $no=0;
 ?>
 <div class="widget">
 	<div class="widget-header"> <i class="icon-th-list"></i>
 		<h3><?= $title ?></h3>
 		<!-- <a href="<?= base_url()?>admin/penyakit/form/0" class="btn btn-small btn-success pull-right" ><i class="btn-icon-only icon-plus" style="color: white"> Tambah</i></a> -->
 	</div>
 	<!-- /widget-header -->
 	<div class="widget-content" style="min-height: 400px">

 		<table class="table table-striped table-bordered data-table">
 			<thead>
 				<tr>
 					<?php foreach ( $head as $data) : ?>
 					<th> <?= $data; ?></th>
 					<?php endforeach ?>
 				</tr>
 			</thead>
 			<tbody>
 				<?php foreach ( $pasien as $data) : ?>
 				<?php if($data['identitas'] == 'NIK'){
						$noIdentitas = $data['nik'];
					}else if($data['identitas'] == 'SIM'){
						$noIdentitas = $data['sim'];
					}else if($data['identitas'] == 'Paspor'){
						$noIdentitas = $data['paspor'];
					}?>
 				<tr>
 
 					<td><?= $data["id_pasien"]; ?></td>
 					<td> (<?= $data['identitas']?>) <?= $noIdentitas;?></td>
 					<td> <?= $data["nama_pasien"]; ?></td>
 					<td> <?= $data["alamat"]; ?></td>
 					<td class="td-actions">
 						<a href="<?= base_url()?><?= $this->session->userdata('hak_akses')?>/rekap_medis/pasien/<?= $data["id_pasien"]; ?>"
 							class="btn button-hijau">Lihat</a>
 						<?php if($this->session->userdata('hak_akses')=="admin"){ ?>
 						<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/pasien/form/<?= $data["id_pasien"]; ?>"
 							class="btn button-hijau"><i class="btn-icon-only icon-edit"> </i></a>
 						<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/pasien/hapus/<?= $data["id_pasien"]; ?>"
 							onClick="return confirm('Anda yakin ingin menghapus data ini?')"
 							class="btn button-merah"><i class="btn-icon-only icon-remove"> </i></a>
 						<?php } ?>
 					</td>
 				</tr>
 				<?php endforeach ?>
 			</tbody>
 		</table>
 	</div>
 	<!-- /widget-content -->
 </div>

 <script src="<?= base_url()?>js/jquery-1.7.2.min.js"></script>

 <script type="text/javascript">
 	$(document).ready(function () {
 		$(".active").removeClass("active");
 		$("#navRekapMedis-admin").addClass("active");
 		$("#navRekapMedis-dokter").addClass("active");
 	});

 </script>
