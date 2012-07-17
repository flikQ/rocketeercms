<h1>Settings</h1>
<div id="subnav"> 
				<ul>
					<?php foreach($categories as $category) : ?>
					<li><a href="/admin/settings/index/category/<?php echo $category; ?>/"><?php echo humanize($category); ?></a></li>
					<?php endforeach; ?>
				</ul> 
			</div> 
			
			<div id="mainbody" class="with-subnav"> 
				<h2 class="form-head">Add Setting</h2>

				<?php echo form_open('admin/settings/create'); ?>
				<div class="form-row">
					<label>Key</label>
					<?php echo form_input('key'); ?>
				</div>
				<div class="form-row">
					<label>Value</label>
					<?php echo form_input('value'); ?>
				</div>
				<div class="form-row">
					<label>Category</label>
					<?php echo form_dropdown('category_name', $categories, param('category')); ?>
				</div>
				<div class="form-row">
					<?php echo form_submit('submit', 'Create'); ?>
				</div>
				</form>
			</div>
