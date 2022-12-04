<?php
    if(!empty($obat)){
        $data = array("$obat->id_obat","$obat->nama_obat");
    }else{
        $data = array("","","","","","","","");
    }

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
					<form id="edit-profile" action="<?= base_url()?>admin/obat/input" method="POST" class="form-horizontal">
						<fieldset>

							<div class="control-group">
								<label class="control-label" for="nama_obat">Nama Obat</label>
								<div class="controls">
									<input type="hidden" class="span6" id="id_obat" name="id_obat" value="<?= $data[0]; ?>">
									<input type="text" class="span6" id="nama_obat" name="nama_obat" placeholder="nama_obat"
										value="<?= $data[1]; ?>" required>
								</div> <!-- /controls -->
							</div> <!-- /control-group -->

							<div class="form-actions">
								<a href="<?= base_url()?>admin/obat/" class="btn button-merah">Batal</a>
								<button type="submit" class="btn button-biru">Simpan</button>
							</div> <!-- /form-actions -->
						</fieldset>
					</form>


				</div>





			</div> <!-- /widget-content -->

		</div> <!-- /widget -->

	</div> <!-- /span8 -->




</div> <!-- /row -->
