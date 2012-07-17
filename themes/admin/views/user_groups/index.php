<h1>User Groups</h1> 
			
			<div id="subnav"> 
				<ul>
					<li><a href="/admin/users/index/">Users</a></li>
					<li class="active"><a href="/admin/user_groups/index/">Groups</a></li>
					<li><a href="/admin/user_rights">Rights</a></li>
				</ul> 
			</div> 
			
			<div id="mainbody" class="with-subnav"> 
				<ul class="action-buttons"> 
					<li><a href="/admin/user_groups/add/" class="generic_button large">Add Group</a></li> 
				</ul><br>
				
				<?php if(count($groups) > 0) : ?> 
				
				<div class="component-block"> 
				
					<table cellpadding="0" cellspacing="0"> 
						<tr class="lead"> 
							<th>Name</th>
							<th>Description</th>
							<th class="controls"></th> 
						</tr> 
						<?php foreach($groups as $group) : ?>
						<tr>
							<td><?php echo link_to($group->name, '/admin/user_groups/edit/id/'.$group->id); ?></td> 
							<td><?php echo $group->description; ?></td> 
							<td class="controls-lists">
								<ul class="buttons">
									
									<li><a href="/admin/user_groups/remove/id/<?php echo $group->id; ?>" class="delete">Delete</a></li>
									<li><a href="/admin/user_groups/edit/id/<?php echo $group->id; ?>/" class="edit">Edit</a></li>
								</ul> 
							</td> 
						</tr> 
						<?php endforeach; ?>
					</table>
				
				</div>
				
				<?php else: ?>
				<h1>No groups found.</h1>
				<?php endif; ?>
			
			</div>
