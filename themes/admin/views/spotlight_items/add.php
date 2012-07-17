<h1>Spotlight Items</h1>
<div id="subnav"> 
				<ul> 
					<li><a href="/admin/spotlights/index/">Spotlights</a></li> 
					<li class="active"><a href="/admin/spotlight_items/index/">Items</a></li> 
				</ul> 
			</div> 
			
			<div id="mainbody" class="with-subnav"> 
				<h2 class="form-head">New Spotlight Item</h2>
				<?php echo partial('validation'); ?>
				<?php echo form_open_multipart('admin/spotlight_items/create'); ?>
				<div class="form-row">
					<label>Headline</label>
					<?php echo form_input('headline'); ?>
				</div>
				<div class="form-row">
					<label>Description</label>
					<?php echo form_textarea('description', '', 'class="short"'); ?>
				</div>
				<div class="form-row">
					<label>URL</label>
					<?php echo form_input('url'); ?>
				</div>
				<div class="form-row">
					<label>Spotlight</label>
					<?php echo form_dropdown('spotlight_id', $spotlights); ?>
				</div>
				<div class="form-row">
					<label>Image</label>
					<?php echo form_upload('image'); ?>	
				</div>
				<div class="form-row">
					<?php echo form_submit('submit', 'Create'); ?>
				</div>
				</form>
			</div> 
