<div class="columns-prefs">
  <label><input name="jelly_gelling[grenetina]" type="checkbox" value="true" <?php if( $gelling['grenetina'] ) echo 'checked="checked"' ?>>Grenetina</label>
  <label><input name="jelly_gelling[agar]" type="checkbox" value="true" <?php if( $gelling['agar'] ) echo 'checked="checked"' ?>>Agar</label>
</div>

<input type="hidden" name="jelly_gelling_nonce" id="jelly_gelling_nonce" value="<?php echo $nonce; ?>">
