<div id="comments" class="widget">
	<h2>Your Comments</h2>
	
	<?php echo $pagination; ?>
	<ul id="the-comments">
    
		<?php foreach($comments as $comment) : ?>
		<li>
			<div class="comment-author">
				<span class="meta"><?php echo $comment->created_at; ?></span>
				<a href="/profile/<?php echo $comment->user->username; ?>">
					<img src="<?php echo $comment->user->avatar(); ?>" />
				</a>
				<h3><?php echo link_to($comment->user->username, 'profile/'.$comment->user->username); ?></h3>
				<span class="name"><?php echo $comment->user->full_name(); ?></span>
				               
			</div>
			<div class="the-comment">
				<p><?php echo $comment->content; ?></p>
				<ul class="edit-options">
					
				<?php if(user_logged_in()) : ?>
				<?php if((current_user() && $comment->user_id == current_user()->id) OR (current_user() && current_user()->group_id == 1)) : ?>
                	<li><a class="button right" href="<?= edit_comment_url($comment->id) ?>">Edit Post</a><?php endif; ?></li>
				<?php endif; ?>
					
				</ul>
				</div>
		</li>
		<?php endforeach; ?>
	</ul>
    <?php echo $pagination; ?>
	
	<?php if (! user_logged_in()) : ?>
		<div id="comment-form">
			<h4>Please <a href="/auth/sign_up">register</a> or <a href="/auth/sign_in">login</a> to post comments</h4>
		</div>
	<?php else: ?>
		
		<div id="comment-form">
			<h3>Post a comment</h3>
			<div id="user-info">
				<?php echo img(current_user()->avatar()); ?>
				<?= link_to(current_user()->username, profile_url(current_user()->username)) ?>
			</div>
			
			<div id="write-comment">
				<?php echo form_open('comments/create'); ?>
				<?php echo form_hidden('resource', plural(get_class($model))); ?>
				<?php echo form_hidden('resource_id', $model->id); ?>
				<?php echo form_textarea('comment'); ?><br>
				<?php echo form_submit('submit', 'Add Comment', 'class="button left"'); ?>
				</form>
			</div>
		</div>
	<?php endif; ?>
	
	
	<?php echo partial('validation'); ?>
	
</div>
