<div class="galeri">
  <div class="galeri-title">Forum dan Diskusi</div>
  <div class="galeri-description">Bergabung dengan forum atau grup diskusi untuk berbagi ide atau pengalaman terkait seni budaya tradisional.</div>
  <div class="forum">
    <div class="forum-title">Forum</div>
    <div class="forum-content">
      <?php 
        foreach($list_forum as $row) {
      ?>
        <div class="forum-card">
          <div class="forum-card-left">
            <div class="forum-date"><?php echo date( 'd M Y g:i', strtotime($row['created_at'])) ?></div>
            <div class="forum-date"><?php echo $row['created_by'] ?></div>
          </div>
          <div class="forum-card-right"><?php echo $row['forum_title'] ?></div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>