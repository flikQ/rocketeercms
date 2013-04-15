<div id="content" class="forums">
	<h1 id="page-title">Forums</h1>

	<h2 id="section-title"><?= fetch_one('forums', 'url_name='.param('name'))->name ?></h2>

	
	<?php if(fetch_one('forums', 'parent_id='.$forum->id.'&order_by_asc=order')): ?>
	<div class="sub-forum-list widget">
		<h2>Sub Forums</h2>
		<ul class="the-forums">
		<?php foreach(fetch('forums', 'parent_id='.$forum->id.'&order_by_asc=order') as $subforum) : ?>
			<li>
				<div class="forum-info">
					<h3><?= link_to($subforum->name, forum_threads_url($subforum->url_name)) ?></h3>
					<?= $forum->description ?>
					<ul class="sub-forums">
					<?php foreach(fetch('forums', 'parent_id='.$subforum->id.'&order_by_asc=order') as $subforum) : ?>
						<li><?= link_to($subforum->name, forum_threads_url($subforum->url_name)) ?>,</li>
					<?php endforeach; ?>
					</ul>
				</div>
				
				<span class="forum-threads">
					<div class="thread-count"><span><?php echo $subforum->count('forum_threads'); ?></span> topics</div>
				</span>
				
				<div class="latest-thread">
					<?php $thread = $subforum->latest_thread();
						if($thread) : ?>					
						<img src="<?php echo $thread->user->avatar(); ?>" class="u-thumb">
						<span class="thread-title"><?php echo link_to($thread->title, forum_thread_url($forum->url_name, $thread->id, $thread->url_title));?></span>
						<span>by <a href="/profile/<?php echo $thread->user->username ?>"><?php echo $thread->user->username ?></a> on <?php echo $thread->created_at ?></span>
					<?php endif; ?>
				</div>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
	<?php endif; ?>


	<div class="context-nav">
		<a class="button float-left mar-right-10 back" href="<?= forums_url() ?>"><span>&lt;</span>	</a>
		<?php if (user_logged_in()) : ?>
			<span class="button float-left"><?= link_to('New Thread', new_forum_thread_url(param('name'))) ?></span>
		<?php else: ?>
			<span class="button float-left"><a href="<?= login_url() ?>">New Thread</a></span>
		<?php endif; ?>
	</div>
	
	
	
	<?= $pagination ?>
		
	<table class="forum-table" width="100%">
		<tr>
			<th width="50"></th>
			<th width="450">Thread</th>
			
			<th width="80" class="replies">Replies</th>
			<th width="120">Latest</th>
		</tr>
	
	
	<?php foreach($threads as $thread) : ?>
		<?php if($thread->sticky == '1') :?>
		<tr>
			<td align="center">
				<?php if($thread->closed == '1') :?>
					<img class="forum-message" src="/themes/<?php echo setting('themes.default_theme') ?>/assets/images/forum/env_lock.png" title="This Thread is Locked" />
				<?php else :?>
					<img src="/themes/<?php echo setting('themes.default_theme') ?>/assets/images/forum/env_on.png" />
				<?php endif; ?>
			</td>
			<td>
				<span class="is-sticky">Sticky</span> <?= link_to($thread->title, forum_thread_url(param('name'), $thread->id, $thread->url_title)) ?>
				<span class="started_by">by <?= link_to($thread->user->username, profile_url($thread->user->username)) ?> on <?= $thread->created_at ?></span>
			</td>
		
			<td class="replies small"><span><?= $thread->count('posts') ?> replies</span><span><?= $thread->view_count ?> views</span></td>
			<td>
				<span class="date"><?= link_to($thread->updated_at, forum_thread_url(param('name'), $thread->id, $thread->url_title)) ?></span>
				<span class="latest-by">By: 
					<?php foreach(fetch('forum_posts', 'limit=1&order_by_desc=id&thread_id='.$thread->id.'') as $item) : ?>
						<a href="/profile/<?php echo $item->user->username ?>"><?php echo $item->user->username ?></a>
					<?php endforeach; ?>
				</span>
			</td>
		</tr>		
		<?php endif; ?>
	<?php endforeach; ?>
	
	
	<?php foreach($threads as $thread) : ?>
		<?php if($thread->sticky == '0') :?>
		<tr>
			<td align="center">
				<?php if($thread->closed == '1') :?>
					<img class="forum-message" src="/themes/<?php echo setting('themes.default_theme') ?>/assets/images/forum/env_lock.png" title="This Thread is Locked" />
				<?php else :?>
					<img src="/themes/<?php echo setting('themes.default_theme') ?>/assets/images/forum/env_on.png" />
				<?php endif; ?>
			</td>
			<td>
				<?= link_to($thread->title, forum_thread_url(param('name'), $thread->id, $thread->url_title)) ?>
				<span class="started_by">by <?= link_to($thread->user->username, profile_url($thread->user->username)) ?> on <?= $thread->created_at ?></span>
			</td>
			
			<td class="replies small"><span><?= $thread->count('posts') ?> replies</span><span><?= $thread->view_count ?> views</span></td>
			<td>
				<span class="date"><?= link_to($thread->updated_at, forum_thread_url(param('name'), $thread->id, $thread->url_title)) ?></span>
				<span class="latest-by">By: 
					<?php foreach(fetch('forum_posts', 'limit=1&order_by_desc=id&thread_id='.$thread->id.'') as $item) : ?>
						<a href="/profile/<?php echo $item->user->username ?>"><?php echo $item->user->username ?></a>
					
					<?php endforeach; ?>
				</span>
			</td>
		</tr>		
		<?php endif; ?>
	<?php endforeach; ?>
	
	<script>
			$(".forum-message[title]").tooltip({
				effect: 'slide',
				layout: '<span class="help-tool"><span class="arrow">]</span></span>',
				 position: "center left",
				 offset: [10, -4],
				});
		</script>
	
	</table>
	
	<?= $pagination ?>

</div>
