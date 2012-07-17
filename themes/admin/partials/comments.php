<section id="comments">
	<header>
		<h2>Your Comments</h2>
	</header>
	
	<div id="comment-form">
		<?php echo form_open('comments/create'); ?>
		<?php echo form_hidden('resource', plural(get_class($model))); ?>
		<?php echo form_hidden('resource_id', $model->id); ?>
		<?php echo form_textarea('comment'); ?><br>
		<?php echo form_submit('submit', 'Add Comment!'); ?>
		</form>
	</div>
	
	<ul id="the-comments">
		<?php foreach($model->comments as $comment) : ?>
		<li>
			<div class="comment-author">
				<a href="profile/<?php echo $comment->user->username; ?>">
					<img src="<?php echo $comment->user->avatar_thumb_url; ?>" />
				</a>
				<h3><?php echo link_to($comment->user->username, 'profile/'.$comment->user->username); ?></h3>
				<span class="name"><?php echo $comment->user->full_name(); ?></span>
			</div>
			<div class="the-comment"><p><?php echo $comment->content; ?></p></div>
		</li>
		<?php endforeach; ?>
	</ul>
	
	<?php echo partial('validation'); ?>
	
</section>
