<div id="content">
	<h1 id="page-title">Create Thread</h1>

	<div class="main-form new-thread-form">
	
	<?= partial('validation') ?>
	<?= form_open(create_forum_thread_url(param('name'))) ?>
	<?= form_hidden('forum_name', param('name')) ?>
	<div class="form-row">
		<label>Title</label>
		<?= form_input('title') ?>
	</div>
	<?php if(current_user()->group_id == 1 OR current_user()->group_id == 6): ?>
	<div class="form-row">
		<?= form_checkbox('sticky', '1', '') ?><label>Sticky?</label>
	</div>
	<?php endif; ?>
	
	<div class="form-row">
		<?= form_textarea('content', '', 'class="full"') ?>
	</div>
	<span class="generic_surround"><?= form_submit('submit', 'Submit') ?></span>
	</form>

	</div>

</div>
