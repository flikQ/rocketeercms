<h1>Forum Posts</h1>

<div id="subnav"> 
				<ul> 
					<li><a href="/admin/forums/index/">Forums</a></li>
					<li><a href="/admin/forum_threads/index/">Threads</a></li>
                    <li class="active"><a href="/admin/forum_posts/index/">Posts</a></li>
					<li><a href="/admin/forum_sections/index/">Sections</a></li> 
				</ul> 
			</div> 

<div id="mainbody" class="with-subnav">
	<h2 class="form-head">Edit Forum Post</h2>

	<?php echo partial('validation'); ?>
	<?php echo form_open_multipart('admin/forum_posts/update'); ?>
	<?php echo form_hidden('id', param('id')); ?>
		
		<div class="form-row">
			<label>Users Comment</label>
			<?php echo form_textarea('content', $post->content, 'class="full"'); ?>
		</div>
        
        <div class="form-row">
			<?php echo form_submit('submit', 'Update'); ?>
			<a href="/admin/forum_posts/index/" class="cancel">Cancel</a>
		</div>
	</form>
</div>

