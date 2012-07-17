<h1>Users</h1> 
			
			<div id="subnav"> 
				<ul>
					<li class="active"><a href="/admin/users/index/">Users</a></li>
					<li><a href="/admin/user_groups/index/">Groups</a></li>
					<li><a href="/admin/user_rights">Rights</a></li>
				</ul> 
			</div> 
			
			<div id="mainbody" class="with-subnav"> 
				<ul class="action-buttons"> 
					<li><a href="/admin/users/add/" class="generic_button large">Add User</a></li> 
					<li><a href="/admin/users/columns/" class="generic_button large">Custom Fields</a></li> 
				</ul>
				
				<script type="text/javascript">
				$(document).ready(function() {
				
					// Init sort by user group
					$('#group_id').change(function() {
					
						if(parseInt($(this).val()) == 0)
						{
							window.location = '/admin/users/';
							return false;
						}
						else
						{
							window.location = '/admin/users/index/group_id/' + parseInt($(this).val());
							return false;
						}
					
					});
				
				});
				</script>
				
				<div class="filterby component-block"> 
					
					<div class="search-block">
						<form action="<?php echo site_url('/admin/users/search'); ?>" method="get">
							<?php echo form_input('q', $this->input->get('q')); ?>
							<button type="submit" class="generic_button float-right medium">Search</button>
						</form>
					</div>
					
				</div> 
				
				<?php if(count($users) > 0) : ?>
				
				<div class="component-block"> 
				
					<table cellpadding="0" cellspacing="0"> 
						<tr class="lead"> 
							<th class="first">Username</th>
							<th>Full Name</th>
							<th>Group</th>
							<th class="date">Registered</th> 
							<th class="controls"></th> 
						</tr> 
						<?php foreach($users as $user) : ?>
						<tr> 
							<td><?php echo $user->username; ?></td>
							<td><?php echo link_to($user->full_name(), '/admin/users/edit/id/'.$user->id); ?></td> 
							<td><?php echo $user->group_descr; ?></td> 
							<td class="date"><?php echo $user->created_on; ?></td> 
							<td class="controls-lists">
								<ul class="buttons">
									
									<li><a href="/admin/users/remove/id/<?php echo $user->id; ?>" class="delete">Delete</a></li>
									<li><a href="/admin/users/edit/id/<?php echo $user->id; ?>" class="edit">Edit</a></li>
								</ul> 
							</td> 
						</tr> 
						<?php endforeach; ?>
					</table> 
					
					<div class="pagination">
						<?php echo $pagination; ?>
					</div>
				
				</div>
				
				<?php else: ?>
				<p class="none">No users found.</p>
				<?php endif; ?>
			
			</div>
