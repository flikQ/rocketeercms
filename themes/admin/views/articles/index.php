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
				
				<h3>Filter List By</h3>
				
					<?php
						if((int)current_user()->group_id !== 3):
							echo form_dropdown('user_id', $users, param('user_id'));
						endif;
						
						echo form_dropdown('section_id', $sections, param('section_id')); 
						echo form_dropdown('category_id', $categories, param('category_id'));
						
						if((int)current_user()->group_id !== 3):
							echo form_dropdown('status', array(
								'draft' => 'Draft',
								'published' => 'Published'
							), param('status') ? param('status') : 'published');
						endif;
					?>
					
				<div class="search-block">
					<form action="<?php echo site_url('/admin/articles/search'); ?>" method="get">
						<?php echo form_input('q', $this->input->get('q')); ?>
						<button type="submit" class="generic_button float-right medium">Search</button>
					</form>
				</div>
					
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
						<?php foreach($articles as $article) : ?>
						<tr> 
							<td class="article-info"> 
								<a href="/admin/articles/edit/id/<?php echo $article->id; ?>/" class="article-title"><?php echo $article->title; ?></a> 
								<span class="section"><?php echo $article->section->name; ?></span> 
							</td> 
							<td><?php echo link_to($article->category->name, '/admin/articles/index/category_id/'.$article->category->id); ?></td> 
							<td><?php echo link_to($article->user->full_name(), '/admin/users/show/id/'.$article->user->id); ?></td> 
							<td class="date"><?php echo $article->created_at; ?></td> 
							<td class="controls-lists"> 
								<ul class="buttons"> 
									<li><a href="/admin/articles/remove/id/<?php echo $article->id; ?>" class="delete">Delete</a></li> 
									<li><a href="/admin/articles/edit/id/<?php echo $article->id; ?>" class="edit">Edit</a></li> 
								</ul> 
							</td> 
						</tr> 
						<?php endforeach; ?>
					</table> 
					
					<div class="pagination">
						<?php echo $pagination; ?>
					</div>
				
				</div> 
			
			</div> 
