<div id="content" class="forums">
	<h1 id="page-title">Forums </a></h1>
	
	<ul class="forum-breadcrumb">
		<li><a href="/forums">Forums Home</a></li>
		<li><a href="/forums/<?php echo $thread->forum->url_name ?>"><?php echo $thread->forum->name ?></a></li>
	</ul>

	<h2 class="topic"><span>Topic</span><?php if($thread->sticky == '1') :?><span class="is-sticky">Sticky</span><?php endif; ?><?= $thread->title ?></h2>
	
	<div class="context-nav">
		<a class="button float-left mar-right-10 back" href="<?= forum_threads_url(param('name')) ?>/"><span>&lt;</span></a>	
		<?php if($thread->closed == '1') :?>
			<a class="button float-left inactive " href="">Thread Closed</a>
		<?php else :?>
		<a class="button float-left " href="#reply">New Reply</a>
		<?php endif; ?>
		
		<?php if ( user_logged_in()) : ?>
			<?php if($thread->user_id == current_user()->id OR current_user()->group_id == 1 OR current_user()->group_id == 6 )  : ?><span class="button float-right"><?= link_to('Edit Thread', edit_forum_thread_url(param('name'), param('id'), param('title'))) ?></span><?php endif; ?>
		<?php endif; ?>
	</div>
	
	<?= $pagination ?>
	
	<ul id="the-posts">
		<?php foreach($posts as $post) : ?>
		<li <?php if($post->user->group_id == 1): ?> 
					class="admin-member"
				<?php elseif($post->user->group_id == 4) :?>
					class="team-member"
				<?php elseif($post->user->group_id == 6): ?>
					class="mod-member"
				<?php else: ?>
					
				<?php endif;?>
			>
			<a name="<?= $post->id ?>"></a>		
			<div class="post-author">
							
				
				<a href="<?= profile_url($post->user->username) ?>" class="user-avatar">
					<img src="<?= $post->user->avatar('medium'); ?>" />
				</a>
				
				<h3><?php if((time() - $post->user->last_login) < 28880): ?>
						<div class="user-online" title="User Online"></div>
					<?php else: ?>
						<div class="user-online not" title="User Offline"></div>
					<?php endif ?>
					
					<?= link_to($post->user->username, profile_url($post->user->username)) ?></h3>
				<?php if($post->user->group_id == 1): ?> 
					<span class="is-admin">Admin</span>
				<?php endif;?>
				
				<span class="name"><?= $post->user->forum_posts_number ?> posts</span>
				
				
				
			</div>
			<span class="meta"><?= $post->created_at ?></span>
			<div class="the-post ">
				<?= $post->content ?>
			
				<?php if(!empty($post->user->signature)):?>
				<div class="signature">
					<?= $post->user->signature ?>
				</div>
				<?php endif;?>
			
			</div>
			
			
			<?php if (user_logged_in()) : ?>
			
			<?php if($post->user_id == current_user()->id OR current_user()->group_id == 1 OR current_user()->group_id == 6) : ?>
				<ul class="edit-options">
					<li><a class="button" href="<?= edit_forum_post_url(param('name'), param('id'), param('title'), $post->id) ?>">Edit Post</a></li>
				</ul>				
			<?php endif; ?>
			<div class="user-buttons">
				
				<?php if($post->user_id != current_user()->id) : ?>
					<a title="Send Private Message" href="/profile/messages/new/#<?php echo $post->user->username ?>" class="button float-left">@</a>
					<?php if(current_user()->is_friend_requested($post->user)) : ?>
						<span class="button inactive float-left ">Friend Request Sent</span>
					<?php elseif(is_friend($post->user)) : ?>
						<span class="button inactive float-left web-symbol">U</span>
					<?php else :?>
						<a title="Add Friend" href="/friends/add/<?php echo $post->user_id ?>" class="button float-left">U</a>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			
					
		</li>
		<?php endforeach; ?>
		<script>
		$(".user-buttons a[title]").tooltip({
			effect: 'slide',
			layout: '<span class="help-tool"><span class="arrow">]</span></span>',
			position: "center left",
			offset: [10, -4],});
		</script>

	</ul>
	
	<div class="context-nav">
		<a class="button float-left mar-right-10 back" href="<?= forum_threads_url(param('name')) ?>/"><span>&lt;</span></a>	
		<?php if($thread->closed == '1') :?>
			<a class="button float-left inactive " href="">Thread Closed</a>
		<?php else :?>
		<a class="button float-left " href="#reply">New Reply</a>
		<?php endif; ?>
		<?php if ( user_logged_in()) : ?>
			<?php if($thread->user_id == current_user()->id OR current_user()->group_id == 1 OR current_user()->group_id == 6 ) : ?><span class="button float-right"><?= link_to('Edit Thread', edit_forum_thread_url(param('name'), param('id'), param('title'))) ?></span><?php endif; ?>
		<?php endif; ?>
	</div>
	
	
	<?= $pagination ?>
	
	<?php if($thread->closed == '1') :?>
		<section id="new-post">
			<h4>This thread has been closed</h4>
		</section>	
	<?php else :?>
	
		<?php if (! user_logged_in()) : ?>
			<section id="new-post">
				<h4>Please <a href="/register">register</a> or <a href="/login">login</a> to post forum replies</h4>
			</section>
		<?php else: ?>
	
			<?php require FCPATH.'themes/'. setting('themes.default_theme') .'/views/forums/new_post.php'; ?>
		
		<?php endif; ?>

	<?php endif; ?>

</div>
