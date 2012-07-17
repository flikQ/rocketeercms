<h1>Pages</h1>
			<div id="mainbody"> 
				<h2 class="form-head">Edit Page</h2>
				<?php echo partial('validation'); ?>
				<?php echo form_open('admin/pages/update'); ?>
				<?php echo form_hidden('id', $page->id); ?>
				<div class="form-row title">
					<label>Title</label>
					<?php echo form_input('title', $page->title); ?>	
				</div>
				<div class="form-row">
					<label>Slug (URL)</label>
					<?php echo base_url(); ?><?php echo form_input('url_title', $page->url_title); ?>	
				</div>
				<div class="form-row">
					<label>Parent Page</label>
					<?php echo form_dropdown('parent_id', $pages, $page->parent_id); ?>	
				</div>
				<div class="form-row">
					<label>Page Template</label>
					<?php echo form_dropdown('template_name', $templates, $page->template_name); ?>	
				</div>
				<div class="form-row">
					<label>Content</label>
					<?php echo form_textarea('content', $page->content, 'class="full"'); ?>	
				</div>
				<div class="form-row">
					<?php echo form_submit('submit', 'Update'); ?>
					<a href="/admin/pages/index/" class="cancel">Cancel</a>
				</div>
				</form>
			</div> 
