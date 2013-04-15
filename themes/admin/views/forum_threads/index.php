	<h1>Forum Threads</h1>
    
    <div id="subnav"> 
				<ul> 
					<li><a href="/admin/forums/index/">Forums</a></li> 
					<li class="active"><a href="/admin/forum_threads/index/">Threads</a></li>
                    <li><a href="/admin/forum_posts/index/">Posts</a></li>
					<li><a href="/admin/forum_sections/index/">Sections</a></li> 
				</ul> 
			</div> 
			<?php if(count($threads) > 0) : ?>
			<div id="mainbody" class="with-subnav"> 
				<div class="component-block"> 
				
					<table cellpadding="0" cellspacing="0"> 
						<tr class="lead"> 
							<th>User</th>
							<th>Thread Title</th>
							<th>Posts</th>
							<th class="date">Created</th> 
							<th class="controls"></th> 
						</tr>
						<?php foreach($threads as $thread) : ?> 
						<tr> 
							<td style="width:100px;"> 
								<?php echo link_to($thread->user->full_name(), '/admin/users/show/id/'.$thread->user->id); ?>
								<span class="section"></span> 
							</td>
							<td class="article-info"><?php echo $thread->title; ?></td>
							<td><?php echo $thread->forum_posts_number; ?></td>
							<td class="date"><?php echo $thread->created_at; ?></td> 
							<td class="controls-lists"> 
								<ul class="buttons">
									<li><a href="/admin/forum_threads/remove/id/<?php echo $thread->id; ?>" class="delete">Delete</a></li> 
                                    <li><a href="/admin/forum_threads/edit/id/<?php echo $thread->id; ?>" class="edit">Edit</a></li> 
								</ul>
							</td> 
						</tr> 
						<?php endforeach; ?>
					</table> 
				</div>
			</div>
			<?php else : ?>
			<p class="none">No comments</p>
			<?php endif; ?>
			<div class="pagination">
				<?php echo $pagination; ?>
			</div>
