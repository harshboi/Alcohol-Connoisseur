<?php  if (count($errorsDelete) > 0) : ?>
  <div class="error">
  	<?php foreach ($errorsDelete as $errorsDeleteN) : ?>
  	  <p><?php echo $errorsDeleteN ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
