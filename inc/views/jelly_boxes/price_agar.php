<table class="widefat fixed" cellspacing="0">
  <thead>
    <tr>
      <th>Personas</th>
      <th>Agua</th>
      <th>Leche</th>
      <th>Mousse</th>
      <th>Vino</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $persons = array(1, 8, 10, 12, 15, 20, 30);
      foreach ($persons as $key => $size) :
    ?>
    <tr<?php if ( 0 === $key % 2 ) echo ' class="alternate"'?>>
      <td>
        <?php echo $size ?> <?php echo $size == 1 ? 'persona' : 'personas' ?>
        <input type="hidden" name="jelly_sizes_2[<?php echo $key ?>]" value="<?php echo $size; ?>">
      </td>
      <td>
        <input name="jelly_prices_agar[water][<?php echo $size ?>]" type="text" value="<?php if( $prices ) echo $prices['water'][$size]; ?>" placeholder="$00.00" class="widefat">
      </td>
      <td>
        <input name="jelly_prices_agar[milk][<?php echo $size ?>]" type="text" value="<?php if( $prices ) echo $prices['milk'][$size]; ?>" placeholder="$00.00" class="widefat">
      </td>
      <td>
        <input name="jelly_prices_agar[mousse][<?php echo $size ?>]" type="text" value="<?php if( $prices ) echo $prices['mousse'][$size]; ?>" placeholder="$00.00" class="widefat">
      </td>
      <td>
        <input name="jelly_prices_agar[wine][<?php echo $size ?>]" type="text" value="<?php if( $prices ) echo $prices['wine'][$size]; ?>" placeholder="$00.00" class="widefat">
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<input type="hidden" name="jelly_prices_agar_nonce" id="jelly_prices_agar_nonce" value="<?php echo $nonce; ?>">
