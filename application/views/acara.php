<div class="banner">
  <div class="banner-img">
    <img src="<?= base_url() ?>assets/images/banner-acara.webp" />
    <div class="banner-acara-title">Acara Budaya Seni</div>
  </div>
</div>
<div class="event">
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
