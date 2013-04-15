<div id="content" class="forums no-side">
	<h1 id="page-title">Forums</h1>

	<div id="forum-list">
		<?php foreach(fetch('forum_sections', 'order_by_asc=order&private=0') as $section) : ?>				
			<div class="widget">
				<h2><?= $section->name ?> <span class="threads">Threads</span></h2>
				<ul class="the-forums">
					<?php foreach(fetch('forums', 'parent_id=0&order_by_asc=order&section_id='.$section->id.'') as $forum) : ?>
						<li>
							<?php if($forum->icon_thumb_url):?><img src="<?= $forum->icon_thumb_url ?>" width="64" height="64" class="thumb-left" /><?php endif;?>
							<div class="forum-info">
								<h3><?= link_to($forum->name, forum_threads_url($forum->url_name)) ?></h3>
								<?= $forum->description ?>
								<ul class="sub-forums">
								<?php foreach(fetch('forums', 'parent_id='.$forum->id.'&order_by_asc=order') as $subforum) : ?>
									<li><?= link_to($subforum->name, forum_threads_url($subforum->url_name)) ?>,</li>
								<?php endforeach; ?>
								</ul>
							</div>
							
							<span class="forum-threads">
								<div class="thread-count"><span><?php echo $forum->count('forum_threads'); ?></span> topics</div>
							</span>
							
							<div class="latest-thread">
								<?php $latest_thread = $forum->latest_thread(); if($latest_thread) : ?>
									<?php foreach(fetch_post($latest_thread->forum->id) as $thread) : ?>
										<?php if(!empty($thread['thumb'])): ?>
											<img src="<?php echo $thread['thumb']; ?>" class="u-thumb">
										<?php else :?>
											<img src="/themes/<?php echo setting('themes.default_theme') ?>/assets/images/no-pic.jpg" class="u-thumb">
										<?php endif; ?>
										<span class="thread-title"><?= link_to($thread['trim'], forum_thread_url('General-Discussion', $thread['thread_id'], $thread['url_title'], $thread['page'].'/#'.$thread['id'])) ?></span>
										<span>by <a href="/profile/<?php echo $thread['user'] ?>"><?php echo $thread['user'] ?></a> on <?php echo date('D jS M Y - g:ia', $thread['date']); ?></span>

									<?php endforeach; ?>
								<?php endif ;?>		
							</div>
							
						
							
							
						</li>
					<?php endforeach; ?>
				</ul>
			</div>					
		<?php endforeach; ?>
		
		<?php if (user_logged_in() && current_user()->group_id !=2) : ?>
		<?php foreach(fetch('forum_sections', 'order_by_asc=order&private=1') as $section) : ?>				
			<div class="widget">
				<h2><?= $section->name ?> <span class="threads">Threads</span></h2>
				<ul class="the-forums">
					<?php foreach(fetch('forums', 'parent_id=0&order_by_asc=order&section_id='.$section->id.'') as $forum) : ?>
						<li>
							<img src="<?= $forum->icon_thumb_url ?>" width="64" height="64" class="thumb-left" />
							<div class="forum-info">
								<h3><?= link_to($forum->name, forum_threads_url($forum->url_name)) ?></h3>
								<?= $forum->description ?>
							</div>
							
							<span class="forum-threads">
								<div class="thread-count"><span><?php echo $forum->count('forum_threads'); ?></span> topics</div>
							</span>
							
							<div class="latest-thread">
								<?php $latest_thread = $forum->latest_thread(); if($latest_thread) : ?>
									<?php foreach(fetch_post($latest_thread->forum->id) as $thread) : ?>
										<?php if(!empty($thread['thumb'])): ?>
											<img src="<?php echo $thread['thumb']; ?>" class="u-thumb">
										<?php else :?>
											<img src="/themes/paradigm/assets/images/no-pic.jpg" class="u-thumb">
										<?php endif; ?>
										<span class="thread-title"><?= link_to($thread['trim'], forum_thread_url('General-Discussion', $thread['thread_id'], $thread['url_title'], $thread['page'].'/#'.$thread['id'])) ?></span>
										<span>by <a href="/profile/<?php echo $thread['user'] ?>"><?php echo $thread['user'] ?></a> on <?php echo date('D jS M Y - g:ia', $thread['date']); ?></span>

									<?php endforeach; ?>
								<?php endif ;?>		
							</div>

						</li>
					<?php endforeach; ?>
				</ul>
			</div>					
		<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<div class="who-is-online widget">
		<div class="user-online" title="User Online"></div><h2>Currently Online (<?php echo count( $recently_online ) > 0 ? count( $recently_online ) : 0 ?>)</h2>
			
		<ul>
			<?php foreach( $recently_online as $ro ): ?>
				<?php 

				$class = "";

				switch( $ro->group_id )
				{
					case "1":
					$class = "admin";
					break;

					case "6":
					$class = "moderator";
					break;

					case "4":
					$class = "team";
					break;

					default:
					$class = "";
					break;
				}
				?>
				<li	class="<?php echo $class ?>"><a href="/profile/<?= $ro->username ?>"><?= $ro->username ?></a>,</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>

