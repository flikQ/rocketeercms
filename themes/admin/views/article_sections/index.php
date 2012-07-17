<h1>Article Sections</h1>
<div id="subnav"> 
	<ul> 
		<li><a href="/admin/articles/index/">Articles</a></li> 
		<li class="active"><a href="/admin/article_sections/index/">Sections</a></li> 
		<li><a href="/admin/article_categories/index/">Categories</a></li> 
	</ul> 
</div> 
			
			<div id="mainbody" class="with-subnav"> 
				<ul class="action-buttons"> 
					<li><a href="/admin/article_sections/add/" class="generic_button large">Add Section</a></li> 
				</ul>
				<br />
				<div class="component-block"> 
				
					<table cellpadding="0" cellspacing="0"> 
						<tr class="lead"> 
							<th class="title">Name</th>
							<th class="date">Created</th> 
							<th class="controls"></th> 
						</tr>
						<?php foreach($sections as $section) : ?> 
						<tr> 
							<td class="article-info"> 
								<a href="/admin/article_sections/edit/id/<?php echo $section->id; ?>/" class="article-title"><?php echo $section->name; ?></a> 
								<span class="section"></span> 
							</td>
							<td class="date"><?php echo $section->created_at; ?></td> 
							<td class="controls-lists"> 
								<ul class="buttons">
									<li><a href="/admin/article_sections/remove/id/<?php echo $section->id; ?>" class="delete">Delete</a></li> 
									<li><a href="/admin/article_sections/edit/id/<?php echo $section->id; ?>" class="edit">Edit</a></li> 
								</ul> 
							</td> 
						</tr> 
						<?php endforeach; ?>
					</table> 
				</div>
			</div> 
