<div id="content">
	<h1>Comment</h1>

	<?php echo partial('validation'); ?>
	<?php echo form_open(update_comment_url(param('comment_id'))); ?>
	<?php echo form_textarea('content', $comment->content); ?><br>
	<?php echo form_submit('submit', 'Update Comment', 'class="button"'); ?>
	</form>

</div>
