<h1>Articles</h1> 
			
			<div id="subnav"> 
				<ul> 
					<li class="active"><a href="/admin/articles/index/">Articles</a></li> 
					<li><a href="/admin/article_sections/index/">Sections</a></li> 
					<li><a href="/admin/article_categories/index/">Categories</a></li> 
				</ul> 
			</div> 
			
			<div id="mainbody" class="with-subnav"> 
				<ul class="action-buttons"> 
					<li><a href="/admin/articles/add/" class="generic_button large">Add Article</a></li> 
				</ul> 
				
				<div class="filterby component-block"> 
				
				<h3>Search Articles</h3>
				
					<form action="<?php echo site_url('/admin/articles/search'); ?>" method="get">
						<?php echo form_input('q', $this->input->get('q')); ?>
						<button type="submit" class="generic_button float-right medium">Search</button>
					</form>
					
				</div> 
				
				<div class="component-block"> 
				
					<table cellpadding="0" cellspacing="0"> 
						<tr class="lead"> 
							<th class="title">Title</th> 
							<th class="category">Category</th> 
							<th class="author">Author</th> 
							<th class="date">Posted</th> 
							<th class="controls"></th> 
						</tr> 
						<?php if(count($result) > 0) : ?>
							<?php foreach($result as $row) : ?>
								<tr> 
									<td class="article-info"> 
										<a href="/admin/articles/edit/id/<?php echo $row->id; ?>/" class="article-title"><?php echo $row->title; ?></a> 
										<span class="section"><?php echo $row->section_name; ?></span> 
									</td> 
									<td><?php echo link_to($row->category_name, '/admin/articles/index/category_id/'.$row->category_id); ?></td> 
									<td><?php echo link_to($row->username, '/admin/users/show/id/'.$row->user_id); ?></td> 
									<td class="date"><?php echo date('D jS M Y - g:ia', $row->created_at); ?></td> 
									<td class="controls-lists"> 
										<ul class="buttons"> 
											<li><a href="/admin/articles/remove/id/<?php echo $row->id; ?>" class="delete">Delete</a></li> 
											<li><a href="/admin/articles/edit/id/<?php echo $row->id; ?>" class="edit">Edit</a></li> 
										</ul> 
									</td> 
								</tr> 
							<?php endforeach; ?>
						<?php else : ?>
							<tr>No search results were found for <b><?= $this->input->get('q'); ?></b>.</tr>
						<?php endif; ?>
					</table> 
					
					<div class="pagination">
						<?php echo $pagination; ?>
					</div>
				
			</div> 
			
</div> 