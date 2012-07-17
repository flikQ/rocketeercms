<h1>Settings</h1>
<div id="subnav"> 
				<ul>
					<?php foreach($categories as $category) : ?>
					<li><a href="/admin/settings/index/category/<?php echo $category; ?>/"><?php echo humanize($category); ?></a></li>
					<?php endforeach; ?>
				</ul> 
			</div> 
			
			<div id="mainbody" class="with-subnav"> 
				<h2 class="form-head">Edit Setting</h2>

				<?php echo form_open('admin/settings/update'); ?>
				<?php echo form_hidden('id', $setting->id); ?>
				<div class="form-row">
					<label>Key</label>
					<?php echo form_input('key', humanize$setting->key); ?>
				</div>
				<div class="form-row">
					<label>Value</label>
					<?php echo form_input('value', $setting->value); ?>
				</div>
				<div class="form-row">
					<label>Category</label>
					<?php echo form_dropdown('category_name', $categories, $setting->category_name); ?>
				</div>
				<div class="form-row">
					<?php echo form_submit('submit', 'Update'); ?>
				</div>
				</form>
			</div>
