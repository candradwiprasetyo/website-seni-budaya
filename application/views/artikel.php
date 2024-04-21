<div class="galeri">
  <div class="galeri-title">Artikel dan Informasi</div>
  <div class="galeri-description">Temukan berbagai artikel dan informasi di sini untuk memperluas pengetahuan Anda tentang seni tradisional Indonesia</div>
  <div class="galeri-content">
    <?php 
      foreach($list_article as $row) {
    ?>
    <div class="galeri-card">
      <div class="galeri-card-left" style="background: url('<?= base_url() ?>/assets/images/articles/<?php echo $row['article_images'] ?>'); background-size: cover;"></div>
      <div class="galeri-card-bottom">
        <div class="date"><?php echo date( 'd M Y g:i', strtotime($row['created_at'])) ?></div>
        <div class="title"><?php echo $row['article_name'] ?></div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>