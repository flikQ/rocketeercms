<h1>Article Categories</h1>

<div id="subnav"> 
	<ul> 
		<li><a href="/admin/articles/index/">Articles</a></li> 
		<li><a href="/admin/article_sections/index/">Sections</a></li> 
		<li class="active"><a href="/admin/article_categories/index/">Categories</a></li> 
	</ul> 
</div> 

<div id="mainbody" class="with-subnav">
	<h2 class="form-head">Add New Category</h2>
	<p class="tip">Categories are usually descriptive of the subject of the article. Some examples would be Football, Rugby or Tennis.</p>
	<?php echo partial('validation'); ?>
	<?php echo form_open('admin/article_categories/create'); ?>
	<div class="form-row">
		<label>Category Name</label>
		<?php echo form_input('name'); ?>
	</div>
	<div class="form-row">
		<?php echo form_submit('submit', 'Create'); ?>
		<a href="/admin/article_categories/index/" class="cancel">Cancel</a>
	</div>
	</form>
</div>