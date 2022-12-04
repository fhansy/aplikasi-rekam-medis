<?php
$sudahVitalSign = count($vital_sign) + count($tunggu_periksa);
$belumVitalSign = count($antrian) + count($tunggu_vital_sign);
?>

<div class="card card-widget widget-user">
  <!-- Add the bg color to the header using any of the bg-* classes -->
  <div class="widget-user-header bg-info">
    <h3 class="widget-user-username" style="color: white;">Selamat Datang</h3>
    <h3 class="widget-user-desc" style="color: white;"><?= $this->session->userdata('nama') ?></h3>
  </div>
  <a href="<?= base_url() ?><?= $this->session->userdata('hak_akses') ?>/page/profile">
    <div class="widget-user-image">
      <img class="img-circle elevation-2" src="<?= base_url() ?>admin/user/tampil_gambar/<?= $this->session->userdata('id_user') ?>" alt="User Avatar">
    </div>
  </a>
  <div class="card-footer">
    <h4 class="widget-user-desc" style="text-align: center; margin-bottom:20px">Jumlah Antrian Hari ini <?= $this->session->userdata('poli'); ?>:</h4>
    <?php if ($this->session->userdata('hak_akses') == "dokter" || $this->session->userdata('hak_akses') == "perawat") { ?>
      <div class="desc-row">
        <div class="col-xs-6" style="width: 50%;">
          <div class="description-block">
            <h5 class="description-header">Belum Vital Sign</h5>
            <span class="description-text"><?= $belumVitalSign ?></span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-xs-6" style="width: 50%;">
          <div class="description-block">
            <h5 class="description-header">Sudah Vital Sign</h5>
            <span class="description-text"><?= $sudahVitalSign ?></span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-xs-6" style="width: 50%;">
          <div class="description-block">
            <h5 class="description-header">Sedang Diperiksa</h5>
            <span class="description-text"><?= count($periksa) ?></span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    <?php } ?>

    <?php if ($this->session->userdata('hak_akses') == "resepsionis") { ?>
      <div class="desc-row">
        <div class="col-xs-6" style="width: 50%;">
          <div class="description-block">
            <h5 class="description-header">Poli Umum</h5>
            <span class="description-text"><?= count($poliUmum) ?></span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-xs-6" style="width: 50%;">
          <div class="description-block">
            <h5 class="description-header">Poli KIA</h5>
            <span class="description-text"><?= count($poliKIA) ?></span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    <?php } ?>

  </div>
</div>