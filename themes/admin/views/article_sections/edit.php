<h1>Article Sections</h1>

<div id="subnav"> 
	<ul> 
		<li><a href="/admin/articles/index/">Articles</a></li> 
		<li class="active"><a href="/admin/article_sections/index/">Sections</a></li> 
		<li><a href="/admin/article_categories/index/">Categories</a></li> 
	</ul> 
</div> 

<div id="mainbody" class="with-subnav"> 

	<h2 class="form-head">Edit Section</h2>
	<?php echo partial('validation'); ?>
	<?php echo form_open('admin/article_sections/update'); ?>
	<?php echo form_hidden('id', $section->id); ?>
		<div class="form-row">
			<label>Section Name</label>
			<?php echo form_input('name', $section->name); ?>
		</div>
		<div class="form-row">
			<?php echo form_submit('submit', 'Update'); ?>
			<a href="/admin/article_sections/index/" class="cancel">Cancel</a>
		</div>
	</form>
</div>