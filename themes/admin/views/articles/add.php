<h1>Articles</h1>

<div id="subnav"> 
	<ul> 
		<li class="active"><a href="/admin/articles/index/">Articles</a></li> 
		<li><a href="/admin/article_sections/index/">Sections</a></li> 
		<li><a href="/admin/article_categories/index/">Categories</a></li> 
	</ul> 
</div> 

<div id="mainbody" class="with-subnav">
	
	<?php echo partial('validation'); ?>
	<?php echo form_open_multipart('admin/articles/create'); ?>
		<div id="form-final">
			<div class="final-row">
				<label>Image</label>
				<?php echo form_upload('image'); ?>
			</div>
			
			<?php if((int)current_user()->group_id !== 3): ?>
				<div class="final-row">
					<label>Status</label>
					<?php echo form_dropdown('status', array(
						'draft' => 'Draft',
						'published' => 'Published'
					), 'draft'); ?>
				</div>
			<?php endif; ?>
			
			<div class="final-row">
				<?php echo form_submit('submit', 'Create'); ?>
				<a href="/admin/articles/index/" class="cancel">Cancel</a>
			</div>
		</div>
		
		
		<div id="form-content">
			<h2 class="form-head">Create Article</h2>
			<div class="form-row">
				<label>Title</label>
				<?php echo form_input('title'); ?>
			</div>
			<div class="form-row">
				<div class="form-half">
					<label>Section</label>
					<?php echo form_dropdown('section_id', $sections); ?>
				</div>
				<div class="form-half">
					<label>Category</label>
					<?php echo form_dropdown('category_id', $categories); ?>
				</div>
			</div>
			<!--<div class="form-row">
				<label>Spotlights</label>
				<p class="tip">Choose which, if any you wish for this to appear.</p>
				<ul class="form-checkboxlist">
					<?php foreach($spotlights as $spotlight) : ?>
						<li><input type="checkbox" name="spotlight_id" value="<?php echo $spotlight->id; ?>"><label><?php echo humanize($spotlight->name); ?></label></li>
					<?php endforeach; ?>
				</ul>
			</div>-->
			<div class="form-row">
				<label>Intro</label>
				<?php echo form_textarea('short_content', '', 'class="short"'); ?>
			</div>
			<div class="form-row">
				<label>Full content</label>
				<?php echo form_textarea('content', '', 'class="full"'); ?><br>
			</div>
		
		</div>
		
		
	</form>
</div>
