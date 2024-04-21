<div class="banner">
  <div class="banner-img">
    <img src="<?= base_url() ?>assets/images/banner.webp" />
  </div>
  <div class="banner-overlay">
    <div class="title">Selamat datang</div>
    <div class="description">Website ini adalah wadah untuk para seniman seni dapat memamerkan karyanya dan juga untuk masyarakat umum dapat melihat beragam seni dari seniman di Indonesia</div>
  </div>
</div>
<div class="product">
  <div class="title">Karya Terbaru</div>
  <div class="description-product">Keragaman seni budaya di Indonesia terdiri dari seni tari, seni rupa, seni musik, seni teater, dan seni kriya</div> 
  <div class="container">
    <div class="gallery-container">
      <?php 
        foreach($list_artwork as $row) {
      ?>
      <figure>
        <img
        src="<?= base_url() ?>assets/images/artworks/<?php echo $row['artwork_images'] ?>"
        />
      </figure>
      <?php 
        } 
      ?>
    </div>
  </div>
</div>
<div class="event">
  <div class="event-title">Acara Terbaru</div>
  <div class="event-content">
    <?php 
      foreach($list_event as $row) {
    ?>
      <div class="event-card">
        <div class="event-card-left" style="background: url('<?= base_url() ?>/assets/images/event/<?php echo $row['event_images'] ?>'); background-size: contain;"></div>
        <div class="event-card-right">
          <div><?php echo $row['event_location'] ?></div>
          <div class="title"><?php echo $row['event_name'] ?></div>
          <button class="button">Baca lebih lanjut</button>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
