<?php
$errors = collect('errors') ? collect('errors') : (flash('errors') ? flash('errors') : NULL);
if(is_array($errors) && count($errors) > 0) : ?>
	
	<ul class="errors">
	<?php foreach($errors as $error) : ?>
		<li><?=$error;?></li>
	<?php endforeach; ?>
	</ul>
	
	<script> 
		$(function pageLoad() { 
			$('.errors').hide().fadeIn(1000); 
			$("#login-box").effect("shake",{ times:2 },100 ); 
			$(".shadow").effect("shake",{ times:2 },100 ); 
		}); 
	</script> 

	
<?php endif; ?>