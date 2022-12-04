<?php
        $poli_tujuan = array("Poli Umum","Poli KIA");

				if($pasien->identitas == 'NIK'){
					$noIdentitas = $pasien->nik;
				}else if($pasien->identitas == 'SIM'){
					$noIdentitas = $pasien->sim;
				}else if($pasien->identitas == 'Paspor'){
					$noIdentitas = $pasien->paspor;
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
                <form id="edit-profile" action="<?= base_url()?><?= $this->session->userdata('hak_akses')?>/pendaftaran/input" method="POST" class="form-horizontal">
                  <fieldset>
                    
                    <div class="control-group">                     
                      <label class="control-label" for="nama_pasien">Nama pasien</label>
                      <div class="controls">
                        <input type="text" class="span6" id="nama_pasien" name="nama_pasien" placeholder="nama_pasien" value="<?= $pasien->nama_pasien; ?>" disabled>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group">                     
                      <label class="control-label" for="nama_pasien">No Identitas ( <i><?=$pasien->identitas?></i> )</label>
                      <div class="controls">
                        <input type="text" class="span6" id="nama_pasien" name="nama_pasien" placeholder="nama_pasien" value="<?= $noIdentitas; ?>" disabled>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group">                     
                      <label class="control-label" for="poli_tujuan">Poli Tujuan</label>
                      <div class="controls">
                        <input type="hidden" class="span6" id="id_pasien" name="id_pasien" value="<?= $pasien->id_pasien; ?>">
                        <select name="poli_tujuan">
                          <?php foreach ( $poli_tujuan as $data2 => $value) : ?>
                            <option value="<?= $value;?>"><?= $value;?></option>
                            <?php endforeach ?>
                        </select>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group">                     
                      <label class="control-label">Keluhan</label>
                      <div class="controls">
                        <textarea class="span6" id="keluhan" name="keluhan" placeholder="keluhan" rows='5' value="" required> </textarea>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
                      
                    <div class="form-actions">
                      <a href="<?= base_url()?><?= $this->session->userdata('hak_akses')?>/pasien/" class="btn button-merah" >Batal</a>
                      <button type="submit" class="btn button-biru">Simpan</button> 
                    </div> <!-- /form-actions -->
                  </fieldset>
                </form>
              
              
            </div>
            
            
            
            
            
          </div> <!-- /widget-content -->
            
        </div> <!-- /widget -->
            
        </div> <!-- /span8 -->
          
          
          
          
        </div> <!-- /row -->
  