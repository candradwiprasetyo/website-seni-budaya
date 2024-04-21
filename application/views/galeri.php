<div class="galeri">
  <div class="galeri-title">Galeri Seni</div>
  <div class="galeri-description">Beragam karya seni yang dihasilkan oleh seniman-seniman Indonesia</div>
  <div class="galeri-content">
    <?php 
      foreach($list_artwork as $row) {
    ?>
    <div class="galeri-card">
      <div class="galeri-card-left" style="background: url('<?= base_url() ?>/assets/images/artworks/<?php echo $row['artwork_images'] ?>'); background-size: cover;"></div>
    </div>
    <?php } ?>
  </div>
</div>