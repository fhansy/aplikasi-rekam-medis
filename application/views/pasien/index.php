 <?php 
  $head = array("No. Rekam Medis","No. Identitas","Nama","Alamat","Action");
  $no=0;
 ?>
 <div class="widget">
 	<div class="widget-header"> <i class="icon-th-list"></i>
 		<h3><?= $title ?></h3>
 		<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/pasien/form/0"
 			class="btn button-hijau pull-right" style="height: 29px; margin: 0;">Daftarkan Pasien Baru
 		</a>
 	</div>
 	<!-- /widget-header -->
 	<div class="widget-content">
 		<div class="table-responsive" style="overflow: auto;">
 			<table class="table table-striped table-bordered data-table">
 				<thead>
 					<tr>
 						<?php foreach ( $head as $data) : ?>
 						<th> <?= $data; ?></th>
 						<?php endforeach ?>
 					</tr>
 				</thead>
 				<tbody>
 					<?php foreach ( $pasien as $data) :
        $diff= date_diff(date_create($data["tanggal_lahir"]),date_create());?>
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
 						<!-- <td>//$diff->y." tahun ".$diff->m." bulan ".$diff->d." hari";</td> -->
 						<td class="td-actions">
 							<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/pendaftaran/form/<?= $data["id_pasien"]; ?>"
 								class="btn button-hijau" style="color: white;padding :5px;"><i
 									class="btn-icon-only icon-edit">
 								</i>Pilih </a>
 							<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/pasien/kartu/<?= $data["id_pasien"]; ?>"
 								class="btn button-biru" target='blank' style="color: white;padding :5px;"><i
 									class="btn-icon-only icon-credit-card"> </i>Kartu</a>
							<?php if(date("d-m-Y",strtotime($data['tgl_pasien'])) == date("d-m-Y")){?>
 							<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/pasien/form/<?= $data["id_pasien"]; ?>"
 								class="btn button-hijau" style="width: 40px;"><i class="btn-icon-only icon-edit">
 								</i></a>
 							<a href="<?= base_url('/')?><?= $this->session->userdata('hak_akses')?>/pasien/hapus/<?= $data["id_pasien"]; ?>"
 								onClick="return confirm('Anda yakin ingin menghapus data ini?')"
 								class="btn button-merah" style="width: 40px;"><i class="btn-icon-only icon-remove">
 								</i></a>
 							<?php } ?>
 						</td>
 					</tr>
 					<?php endforeach ?>
 				</tbody>
 			</table>
 		</div>
 	</div>
 	<!-- /widget-content -->
 </div>

 <script src="<?= base_url()?>js/jquery-1.7.2.min.js"></script>

 <script type="text/javascript">
 	$(document).ready(function () {
 		$(".active").removeClass("active");
 		$("#navPendaftaran").addClass("active");
 	});

 </script>
