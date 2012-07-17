<h1>Spotlight Items</h1>
<div id="subnav"> 
				<ul> 
					<li><a href="/admin/spotlights/index/">Spotlights</a></li> 
					<li class="active"><a href="/admin/spotlight_items/index/">Items</a></li> 
				</ul> 
			</div> 
			
			<div id="mainbody" class="with-subnav"> 
				<ul class="action-buttons"> 
					<li><a href="/admin/spotlight_items/add/" class="generic_button large">Add Item</a></li> 
				</ul><br>
				<?php if(count($items) > 0) : ?>
				<div class="component-block"> 
				
					<table cellpadding="0" cellspacing="0"> 
						<tr class="lead"> 
							<th class="first">Image</th>
							<th class="title">Headline</th>
							<th>URL</th> 
							<th>Spotlight Slot</th>
							
							<th class="controls"></th> 
						</tr>
						<?php foreach($items as $item) : ?> 
						<tr>
							<td class="img-preview"><?php echo img($item->image_url); ?></td>
							<td><?php echo $item->headline; ?></td>
							
							<td><?php echo $item->url; ?></td>
							
							<td><?php echo $item->spotlight->name; ?></td>
							
							<td class="controls-lists">
								<ul class="buttons">
									<li><a href="/admin/spotlight_items/remove/id/<?php echo $item->id; ?>" class="delete">Delete</a></li> 
									<li><a href="/admin/spotlight_items/edit/id/<?php echo $item->id; ?>" class="edit">Edit</a></li> 
								</ul>
							</td>
						</tr>
						<?php endforeach; ?>
						</table>
				</div>
				<?php else: ?>
				<p class="none">No spotlight items found</p>
				<?php endif; ?>
			</div> 
