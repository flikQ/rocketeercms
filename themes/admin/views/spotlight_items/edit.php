<h1>Spotlight Items</h1>
<div id="subnav"> 
				<ul> 
					<li><a href="/admin/spotlights/index/">Spotlights</a></li> 
					<li class="active"><a href="/admin/spotlight_items/index/">Items</a></li> 
				</ul> 
			</div> 
			
			<div id="mainbody" class="with-subnav"> 
				<h2 class="form-head">Edit Spotlight Item</h2>
				<?php echo partial('validation'); ?>
				<?php echo form_open_multipart('admin/spotlight_items/update'); ?>
				<?php echo form_hidden('id', $item->id); ?>
				<div class="form-row">
					<label>Headline</label>
					<?php echo form_input('headline', $item->headline); ?>
				</div>
				<div class="form-row">
					<label>Description</label>
					<?php echo form_textarea('description', $item->description, 'class="short"'); ?>
				</div>
				<div class="form-row">
					<label>URL</label>
					<?php echo form_input('url', $item->url); ?>
				</div>
				<div class="form-row">
					<label>Spotlight</label>
					<?php echo form_dropdown('spotlight_id', $spotlights, $item->spotlight_id); ?>
				</div>
				<div class="form-row">
					<label>Image</label>
					<?php echo img($item->image_thumb_url); ?> <br /><br />
					<?php echo form_upload('image'); ?>
				</div>
				<div class="form-row">
					<?php echo form_submit('submit', 'Update'); ?>
				</div>
				</form>
			</div> 
