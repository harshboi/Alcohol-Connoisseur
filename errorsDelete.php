<!-- Loop through possible errors that can occur in the deleting drink forms and create an error output to be displayed to the user -->
<?php  if (count($errorsDelete) > 0) : ?>
  <div class="error">
  	<?php foreach ($errorsDelete as $errorsDeleteN) : ?>
  	  <p><?php echo $errorsDeleteN ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
