<div id="content-wrapper">
	<div id="content" class="has-side page">
		<h1><?= $page->title ?></h1>
		<?php view('pages/show', array('page' => $page)); ?>	
	</div>
	<?php sidebar('main'); ?>

</div>
