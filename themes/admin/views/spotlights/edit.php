<h1>Spotlights</h1>
<div id="subnav"> 
				<ul> 
					<li class="active"><a href="/admin/spotlights/index/">Spotlights</a></li> 
					<li><a href="/admin/spotlight_items/index/">Items</a></li> 
				</ul> 
			</div> 
			
			<div id="mainbody" class="with-subnav"> 
				<h2 class="form-head">Edit Spotlight</h2>
				<?php echo partial('validation'); ?>
				<?php echo form_open_multipart('admin/spotlights/update'); ?>
				<?php echo form_hidden('id', $spotlight->id); ?>
				<div class="form-row">
					<label>Name</label>
					<?php echo form_input('name', humanize($spotlight->name)); ?>
				</div>
				<div class="form-row">
					<label>Select Template</label>
					<?php echo form_dropdown('template_name', $templates, $spotlight->template_name); ?>
				</div>
				
				<!--<div class="form-group">
					<a href="#" id="add-sp-item" class="generic_button">Add Spotlight Item</a>
					<ul>
					<?php foreach($spotlight->items as $item) : ?>
						<li>
							<?php echo form_hidden('items[][id]', $item->id); ?>
							<div class="preview-img"></div>
							
							<label>Headline</label>
							<?php echo form_input('items[][headline]', $item->headline); ?><br>
							<label>Strapline</label>
							<?php echo form_input('items[][description]', $item->description); ?><br>
							<label>URL</label>
							<?php echo form_input('items[][url]', $item->url); ?>
						</li>
					<?php endforeach; ?>
					</ul>
				</div>-->
				<div class="form-row">
					<?php echo form_submit('submit', 'Update'); ?>
				</div>
				</form>
			</div>
