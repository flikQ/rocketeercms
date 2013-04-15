<h1>Forum Threads</h1>
    
    <div id="subnav"> 
				<ul> 
					<li><a href="/admin/forums/index/">Forums</a></li> 
					<li class="active"><a href="/admin/forum_threads/index/">Threads</a></li>
                    <li><a href="/admin/forum_posts/index/">Posts</a></li>
					<li><a href="/admin/forum_sections/index/">Sections</a></li> 
				</ul> 
			</div> 

<div id="mainbody" class="with-subnav">
	<h2 class="form-head">Edit Forum Thread</h2>

	<?php echo partial('validation'); ?>
	<?php echo form_open_multipart('admin/forum_threads/update'); ?>
	<?php echo form_hidden('id', param('id')); ?>
		
		<div class="form-row">
			<label>Thread Title</label>
			<?php echo form_input('content', $thread->title); ?>
		</div>
		
		<div class="form-row">
			<label>Related Forum Posts</label>
			<table cellpadding="0" cellspacing="0"> 
				<tr class="lead"> 
					<th>User</th>
					<th>Comment</th>
					<th class="date">Created</th> 
					<th class="controls"></th> 
				</tr>
				<?php foreach($posts as $post) : ?> 
					<tr> 
						<td style="width:100px;"> 
							<?php echo link_to($post->user->full_name(), '/admin/users/show/id/'.$post->user->id); ?>
							<span class="section"></span> 
						</td>
						<td class="article-info"><?php echo $post->content; ?></td>
						<td class="date"><?php echo $post->created_at; ?></td> 
						<td class="controls-lists"> 
							<ul class="buttons">
								<li><a href="/admin/forum_posts/remove/id/<?php echo $post->id; ?>" class="delete">Delete</a></li> 
								<li><a href="/admin/forum_posts/edit/id/<?php echo $post->id; ?>" class="edit">Edit</a></li> 
							</ul>
						</td> 
					</tr> 
				<?php endforeach; ?>
			</table> 
		</div>
        
        <div class="form-row">
			<?php echo form_submit('submit', 'Update'); ?>
			<a href="/admin/forum_threads/index/" class="cancel">Cancel</a>
		</div>
	</form>
</div>

