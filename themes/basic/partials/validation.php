<?php
$errors = collect('errors') ? collect('errors') : (flash('errors') ? flash('errors') : NULL);
if(is_array($errors) && count($errors) > 0) : ?>

<div class="error">
	<?php foreach($errors as $error) : ?>
		<?php echo $error; ?>
	<?php endforeach; ?>
</div>
<?php endif; ?>
