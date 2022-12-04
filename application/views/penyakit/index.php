 <?php 
  $head = array("#","Kode DTD","Kode ICDX","Nama Penyakit","Action");
  $no=0;
 ?>
 <div class="widget">
 	<div class="widget-header"> <i class="icon-th-list"></i>
 		<h3><?= $title ?></h3>
 		<a href="<?= base_url()?>admin/penyakit/form/0" class="btn button-hijau pull-right"
 			style="height: 29px; margin: 0;">Tambah Data Penyakit</a>
 	</div>
 	<!-- /widget-header -->
 	<div class="widget-content table-responsive">

 		<table id="table" class="table table-striped table-bordered data-table">
 			<thead>
 				<tr>
 					<?php foreach ( $head as $data) : ?>
 					<th> <?= $data; ?></th>
 					<?php endforeach ?>
 				</tr>
 			</thead>
 			<tbody>
 				<?php foreach ( $penyakit as $data) : $no++;?>
 				<tr>
 					<td> <?= $no; ?></td>
 					<td> <?= $data["kode_dtd"]; ?></td>
 					<td> <?= $data["kode_icdx"]; ?></td>
 					<td> <?= $data["nama_penyakit"]; ?></td>
 					<td class="td-actions">
 						<a href="<?= base_url()?>admin/penyakit/form/<?= $data["id_penyakit"]; ?>" class="btn button-hijau" style="display: block; margin-bottom:3px;"><i
 								class="btn-icon-only icon-edit"> </i></a>
 						<a href="<?= base_url()?>admin/penyakit/hapus/<?= $data["id_penyakit"]; ?>"
 							onClick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn button-merah" style="display: block;"><i
 								class="btn-icon-only icon-remove"> </i></a>
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
 		$("#navPenyakit").addClass("active");
 	});

 </script>
