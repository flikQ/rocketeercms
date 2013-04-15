<div id="content">
	<h1 id="page-title">Edit Thread : <?php echo $thread->title; ?></h1>

	<div class="main-form new-thread-form">
	<?php echo partial('validation'); ?>
	<?php echo form_open(update_forum_thread_url(param('name'), param('id'), param('title'))); ?>
	<?php echo form_hidden('id', $thread->id); ?>
	<?php echo form_hidden('post_id', $post->id); ?>
	<div class="form-row">
		<label>Title</label>
		<?php echo form_input('title', $thread->title); ?>
	</div>
	
	<?php if(current_user()->group_id == 1 OR current_user()->group_id == 6): ?>
	<div class="form-row">
		<label>Move Thread</label>
		<?php echo form_dropdown('forum_id', $forums, $thread->forum_id); ?>	
	</div>
	<?php endif; ?>	
	
	
	<?php if(current_user()->group_id == 1 OR current_user()->group_id == 6): ?>
	<div class="form-row">
		<?php if($thread->sticky == '1') :?>
			<?= form_checkbox('sticky', '1', TRUE) ?>
		<?php else :?>
			<?= form_checkbox('sticky', '1', '') ?>
		<?php endif; ?>
		<label>Sticky?</label>
	</div>
	<?php endif; ?>	
	
	<?php if(current_user()->group_id == 1 OR current_user()->group_id == 6): ?>
	<div class="form-row">
		<?php if($thread->closed == '1') :?>
			<?= form_checkbox('closed', '1', TRUE) ?>
		<?php else :?>
			<?= form_checkbox('closed', '1', '') ?>
		<?php endif; ?>
		<label>Close Thread</label>
	</div>
	<?php endif; ?>	
	
	
	<div class="form-row">
		<?php echo form_textarea('content', $post->content, 'class="full"'); ?><br>
	</div>
	
	<span class="generic_surround"><?php echo form_submit('submit', 'Update Thread'); ?></span>
	
	</form>
	</div>

</div>
