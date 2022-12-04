<?php
    if(!empty($user)){
        $data = array("$user->id_user","$user->nama","$user->jabatan","$user->username","$user->password");
    }else{
        $data = array("","","","","","","","");
    }
    $hak_akses=array(
      "admin"=>"Admin",
      "resepsionis"=>"Resepsionis",
      "dokter"=>"Dokter",
      "perawat"=>"Perawat");
?>
<div class="row">

	<div class="span12">

		<div class="widget ">

			<div class="widget-header">
				<i class="icon-user"></i>
				<h3><?=$title?></h3>
			</div> <!-- /widget-header -->

			<div class="widget-content">
				<div class="container-fluid">
					<div class="tab-content">
						<div class="span8">
							<form id="edit-profile" action="<?= base_url()?><?= $this->session->userdata('hak_akses')?>"
								method="POST" class="form-horizontal" enctype="multipart/form-data">
								<fieldset>
									<div class="control-group">
										<label class="control-label" for="Nama">Nama</label>
										<div class="controls">
											<input type="hidden" class="span6" id="id_user" name="id_user" value="<?= $data[0]; ?>">
											<input type="text" class="span6" id="Nama" name="nama" placeholder="Nama" value="<?= $data[1]; ?>"
												required>
										</div> <!-- /controls -->
									</div> <!-- /control-group -->

									<div class="control-group">
										<label class="control-label" for="Jabatan">Jabatan</label>
										<div class="controls">
											<input type="text" class="span6" id="Jabatan" name="jabatan" placeholder="Jabatan"
												value="<?= $data[2]; ?>" required>
										</div> <!-- /controls -->
									</div> <!-- /control-group -->

									<div class="control-group">
										<label class="control-label" for="username">Username</label>
										<div class="controls">
											<input type="text" class="span6" id="username" name="username" placeholder="username"
												value="<?= $data[3]; ?>" required>
										</div> <!-- /controls -->
									</div> <!-- /control-group -->


									<div class="control-group">
										<label class="control-label" for="password">Password</label>
										<div class="controls">
											<input type="password" class="span6" id="password" name="password" placeholder="Password"
												value="<?= $data[4]; ?>" required>
										</div> <!-- /controls -->
									</div> <!-- /control-group -->


									<div class="form-actions">
										<a class="btn button-merah" href="<?= base_url() ?>/<?= $this->session->userdata('hak_akses') ?>">Batal</a>
										<button type="submit" class="btn button-biru">Simpan</button>
									</div> <!-- /form-actions -->
								</fieldset>
							</form>
						</div>
						<div class="span3">
							<form id="edit-profile"
								action="<?= base_url()?><?= $this->session->userdata('hak_akses')?>/page/upload_gambar" method="POST"
								enctype="multipart/form-data">
								<div class="control-group">
									<label class="control-label" for="Foto">Foto</label>
									<div class="controls">
										<input type="file" class="span6" id="Foto" name="foto" placeholder="Foto">
										<input type="hidden" class="span6" id="id_user" name="id_user" value="<?= $data[0]; ?>">
									</div> <!-- /controls -->
								</div> <!-- /control-group -->
								<button type="submit" class="btn button-biru">Simpan</button>
							</form>
						</div>
					</div>
				</div>





			</div> <!-- /widget-content -->

		</div> <!-- /widget -->

	</div> <!-- /span8 -->




</div> <!-- /row -->
