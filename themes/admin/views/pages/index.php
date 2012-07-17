<h1>Pages</h1>
			<div id="mainbody"> 
				<ul class="action-buttons"> 
					<li><a href="/admin/pages/add/" class="generic_button large">Add Page</a></li> 
				</ul><br>
				<?php if(count($pages) > 0) : ?>
				<div class="component-block"> 
				
					<table cellpadding="0" cellspacing="0"> 
						<tr class="lead">
							<th class="title">Title</th>
							<th>Parent Page</th>
							<th>Template</th>
							<th class="date">Created</th>
							<th class="controls"></th> 
						</tr>
						<?php foreach($pages as $page) : ?> 
						<tr> 
							<td><?php echo $page->title; ?></td>
							<td><?php echo $page->parent_id ? $page->parent->title : ''; ?></td>
							<td><?php echo humanize($page->template_name); ?></td>
							<td class="date"><?php echo $page->created_at; ?></td> 
							<td class="controls-lists"> 
								<ul class="buttons">
									<li><a href="/admin/pages/remove/id/<?php echo $page->id; ?>" class="delete">Delete</a></li> 
									<li><a href="/admin/pages/edit/id/<?php echo $page->id; ?>" class="edit">Edit</a></li> 
								</ul> 
							</td> 
						</tr> 
						<?php endforeach; ?>
						</table> 
				</div>
				<?php else: ?>
				<p class="none">No pages found</p>
				<?php endif; ?>
			</div> 
