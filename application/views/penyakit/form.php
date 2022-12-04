<?php
    if(!empty($penyakit)){
        $data = array("$penyakit->id_penyakit","$penyakit->kode_dtd","$penyakit->kode_icdx","$penyakit->nama_penyakit");
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
                <form id="edit-profile" action="<?= base_url()?>admin/penyakit/input" method="POST" class="form-horizontal">
                  <fieldset>
                    
                    <div class="control-group">                     
                      <label class="control-label" for="kode_dtd">Kode DTD</label>
                      <div class="controls">
                        <input type="hidden" class="span6" id="id_penyakit" name="id_penyakit" value="<?= $data[0]; ?>">
                        <input type="text" class="span6" id="kode_dtd" name="kode_dtd" placeholder="Kode DTD" value="<?= $data[1]; ?>" required>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group">                     
                      <label class="control-label" for="kode_icdx">Kode ICDX</label>
                      <div class="controls">
                        <input type="text" class="span6" id="kode_icdx" name="kode_icdx" placeholder="Kode ICDX" value="<?= $data[2]; ?>" required>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
                      
                    <div class="control-group">                     
                      <label class="control-label" for="nama_penyakit">Nama Penyakit</label>
                      <div class="controls">
                        <input type="text" class="span6" id="nama_penyakit" name="nama_penyakit" placeholder="nama_penyakit" value="<?= $data[3]; ?>" required>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
                      
                    <div class="form-actions">
                      <a href="<?= base_url()?>admin/penyakit/" class="btn button-merah" >Batal</a>
                      <button type="submit" class="btn button-biru">Simpan</button> 
                    </div> <!-- /form-actions -->
                  </fieldset>
                </form>
              
              
            </div>
            
            
            
            
            
          </div> <!-- /widget-content -->
            
        </div> <!-- /widget -->
            
        </div> <!-- /span8 -->
          
          
          
          
        </div> <!-- /row -->
  