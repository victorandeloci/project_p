<?php
  $mp3Url = trim(get_post_meta(get_the_ID(), 'episode_mp3_url', true));
  if (!empty($mp3Url)) :
?>
  <audio controls preload="none" id="player">
    <source src="<?= $mp3Url ?>">
  </audio>
<?php endif; ?>