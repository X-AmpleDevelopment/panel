<?php
  $announce__toggle = $blueprint->dbGet("lyrdyannounce", "enable");
  $announce__user_id = $blueprint->dbGet("lyrdyannounce", "user_id");
?>

@if($announce__toggle == "true")
  <script src="https://announce.layeredy.com/js/embed.js" data-user-id="{{ $announce__user_id }}"></script>
@endif