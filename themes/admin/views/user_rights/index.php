<h1>User Rights</h1> 
			
			<div id="subnav"> 
				<ul>
					<li><a href="/admin/users/index/">Users</a></li>
					<li><a href="/admin/user_groups/index/">Groups</a></li>
					<li class="active"><a href="/admin/user_rights">Rights</a></li>
				</ul> 
			</div> 
			
			<div id="mainbody" class="with-subnav"> 
				<ul class="action-buttons"> 
					<li><a href="/admin/user_rights/add/" class="generic_button large">Add User Right</a></li> 
				</ul>
				
				<?php if(count($rights) > 0) : ?> 
				
				<p class="tip">Please do not edit this unless you know exactly what you are doing. If you do not you could lock yourself out of your website.</p>
				
				<div class="component-block"> 
				
					<table cellpadding="0" cellspacing="0"> 
						<tr class="lead"> 
							<th>Key</th>
							<th>Description</th>
							<th class="controls"></th> 
						</tr> 
						<?php foreach($rights as $right) : ?>
						<tr>
							<td><?php echo $right; ?></td>
							<td><?php echo humanize($right); ?></td> 
							<td class="controls-lists">
								<ul class="buttons">
									<li><a href="/admin/user_rights/remove/id/<?php echo $right; ?>" class="delete">Delete</a></li>
								</ul> 
							</td> 
						</tr> 
						<?php endforeach; ?>
					</table>
				
				</div>
				
				<?php else: ?>
				<p class="none">No user rights found.</p>
				<?php endif; ?>
			
			</div>
