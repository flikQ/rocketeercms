<h1>Comments</h1>

<div id="mainbody">
	<h2 class="form-head">Edit Comment</h2>

	<?php echo partial('validation'); ?>
	<?php echo form_open_multipart('admin/comments/update'); ?>
	<?php echo form_hidden('id', param('id')); ?>
		
		<div id="form-content">	
			<div class="form-row">
				<label>Users Comment</label>
				<?php echo form_textarea('content', $comment->content, 'class="full"'); ?>
			</div>
		</div>
        
        <div class="final-row">
			<?php echo form_submit('submit', 'Update'); ?>
			<a href="/admin/comments/index/" class="cancel">Cancel</a>
		</div>
	</form>
</div>

