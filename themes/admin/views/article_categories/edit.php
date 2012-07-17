<h1>Article Categories</h1>

<div id="subnav"> 
	<ul> 
		<li><a href="/admin/articles/index/">Articles</a></li> 
		<li><a href="/admin/article_sections/index/">Sections</a></li> 
		<li class="active"><a href="/admin/article_categories/index/">Categories</a></li> 
	</ul> 
</div> 

<div id="mainbody" class="with-subnav">
	<h2 class="form-head">Edit Category</h2>
	<?php echo partial('validation'); ?>
	<?php echo form_open('admin/article_categories/update'); ?>
	<?php echo form_hidden('id', $category->id); ?>
	<div class="form-row">
		<label>Category name</label>
		<?php echo form_input('name', $category->name); ?>
	</div>
	<div class="form-row">
		<?php echo form_submit('submit', 'Update'); ?>
		<a href="/admin/article_categories/index/" class="cancel">Cancel</a>
	</div>
	</form>
</div>
