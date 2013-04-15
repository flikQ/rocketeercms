<div id="content">
	<h1 id="page-title">Edit Post</h1>
	
	<div class="main-form new-thread-form">
	<?php echo partial('validation'); ?>
	<?php echo form_open(update_forum_post_url(param('name'), param('id'), param('title'), param('post_id'))); ?>
	<div class="form-row">
	<?php echo form_textarea('content', $post->content, 'class="short"'); ?><br>
	</div>
	<?php echo form_submit('submit', 'Update Post', 'class=generic_button'); ?>
	</form>
	</div>

</div>
