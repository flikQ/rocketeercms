<section id="new-post">
	<a name="reply"></a>
	<h2>Post Reply</h1>
	
	<div id="user-info">
		<?php echo img(current_user()->avatar()); ?>
		<h3><?= link_to(current_user()->username, profile_url(current_user()->username)) ?></h3>
		<span class="name"><?php echo current_user()->full_name(); ?></span>
	</div>
	
	<div id="write-post">
		<?= partial('validation') ?>
		<?= form_open(create_forum_post_url(param('name'), param('id'), param('title'))) ?>
		<?= form_textarea('content', '' ,'class="short"') ?><br />
		<?= form_submit('submit', 'Post Reply', 'class="button left"') ?>
		</form>
	</div>
	
	
</section>
