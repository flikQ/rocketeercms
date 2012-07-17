	<h1>Comments</h1>
	<!--<div id="subnav"> 
		<ul> 
			<?php foreach($resources as $resource) : ?>
			<li><a href="/admin/comments/index/resource/<?php echo $resource->resource; ?>"><?php echo humanize($resource->resource); ?></a></li>
			<?php endforeach; ?>
		</ul> 
	</div>--> 
			<?php if(count($comments) > 0) : ?>
			<div id="mainbody"> 
				<div class="component-block"> 
				
					<table cellpadding="0" cellspacing="0"> 
						<tr class="lead"> 
							<th>User</th>
							<th>Comment</th>
							<th class="date">Created</th> 
							<th class="controls"></th> 
						</tr>
						<?php foreach($comments as $comment) : ?> 
						<tr> 
							<td style="width:100px;"> 
								<?php echo link_to($comment->user->full_name(), '/admin/users/show/id/'.$comment->user->id); ?>
								<span class="section"></span> 
							</td>
							<td class="article-info"><?php echo $comment->content; ?></td>
							<td class="date"><?php echo $comment->created_at; ?></td> 
							<td class="controls-lists"> 
								<ul class="buttons" style="position:relative;left:-40px;">
									<li><a href="/admin/comments/remove/id/<?php echo $comment->id; ?>" class="delete">Delete</a></li> 
                                    <li><a href="/admin/comments/edit/id/<?php echo $comment->id; ?>" class="edit">Edit</a></li> 
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
