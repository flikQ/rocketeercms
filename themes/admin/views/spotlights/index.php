<h1>Spotlights</h1>
<div id="subnav"> 
				<ul> 
					<li class="active"><a href="/admin/spotlights/index/">Spotlights</a></li> 
					<li><a href="/admin/spotlight_items/index/">Items</a></li> 
				</ul> 
			</div> 
			
			<div id="mainbody" class="with-subnav"> 
				<ul class="action-buttons"> 
					<li><a href="/admin/spotlights/add/" class="generic_button large">Add Spotlight</a></li> 
				</ul><br>
				<?php if(count($spotlights) > 0) : ?>
				<div class="component-block"> 
				
					<table cellpadding="0" cellspacing="0"> 
						<tr class="lead"> 
							<th class="title first">Name</th> 
							<th class="date">Created</th> 
							<th class="controls"></th> 
						</tr>
						<?php foreach($spotlights as $spotlight) : ?> 
						<tr> 
							<td><?php echo $spotlight->name; ?></td>
							<td class="date"><?php echo $spotlight->created_at; ?></td> 
							<td class="controls-lists">
								<ul class="buttons">
									<li><a href="/admin/spotlights/remove/id/<?php echo $spotlight->id; ?>" class="delete">Delete</a></li> 
									<li><a href="/admin/spotlights/edit/id/<?php echo $spotlight->id; ?>" class="edit">Edit</a></li> 
								</ul>
							</td>
						</tr>
						<?php endforeach; ?>
						</table>
				</div>
				<?php else: ?>
				<p class="none">No spotlights found</p>
				<?php endif; ?>
			</div> 
