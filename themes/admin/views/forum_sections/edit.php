<h1>Forum Sections</h1>


<div id="subnav"> 
				<ul> 
					<li><a href="/admin/forums/index/">Forums</a></li> 
					<li><a href="/admin/forum_threads/index/">Threads</a></li>
                    <li><a href="/admin/forum_posts/index/">Posts</a></li>
					<li class="active"><a href="/admin/forum_sections/index/">Sections</a></li> 
				</ul> 
			</div> 
			
			<div id="mainbody" class="with-subnav"> 

			<h2 class="form-head">Edit Forum Section</h2>
			<?php echo partial('validation'); ?>
			<?php echo form_open('admin/forum_sections/update'); ?>
			<?php echo form_hidden('id', $section->id); ?>
			<div class="form-row">
				<label>Name</label>
				<?php echo form_input('name', $section->name); ?><br>
			</div>
			<div class="form-row">
				<label>Private?</label>
				<?php if($section->private == '1') :?>
					<?= form_checkbox('private', '1', TRUE) ?>
				<?php else :?>
					<?= form_checkbox('private', '1', '') ?>
				<?php endif; ?>
			</div>
			<div class="form-row">
				<label>Description</label>
				<?php echo form_textarea('description', $section->description, 'class="short"'); ?><br>
			</div>
			<div class="form-row">
			<?php echo form_submit('submit', 'Update'); ?>
			</div>
			</form>
</div>