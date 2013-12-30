<table class="widefat" cellspacing="0">
  <thead>
    <tr>
      <th>Personas</th>
      <th>Precio</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $persons = array(1, 8, 10, 12, 15, 20, 30);
      foreach ($persons as $key => $size) :

        // Get size and price stored
        $stored = $price[0][$key];
    ?>
    <tr class="alternate">
      <td>
        <?php echo $size ?> <?php echo $size == 1 ? 'persona' : 'personas' ?>
        <input type="hidden" name="jelly_sizes[<?php echo $key ?>]" value="<?php echo $size; ?>">
      </td>
      <td>
        <input name="jelly_prices[<?php echo $key ?>]" type="text" value="<?php if( $stored ) echo $stored['price']; ?>" placeholder="$00.00" class="widefat">
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<input type="hidden" name="jelly_prices_nonce" id="jelly_prices_nonce" value="<?php echo $nonce; ?>">
