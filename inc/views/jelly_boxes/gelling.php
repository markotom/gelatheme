<div class="columns-prefs">
  <label><input name="jelly_gelling[0]" type="checkbox" value="Grenetina" <?php if( $gelling && $gelling['0'] ) echo 'checked="checked"' ?>>Grenetina</label>
  <label><input name="jelly_gelling[1]" type="checkbox" value="Agar" <?php if( $gelling && $gelling['1'] ) echo 'checked="checked"' ?>>Agar</label>
</div>

<input type="hidden" name="jelly_gelling_nonce" id="jelly_gelling_nonce" value="<?php echo $nonce; ?>">
