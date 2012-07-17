<h1>Spotlights</h1>
<div id="subnav"> 
				<ul> 
					<li class="active"><a href="/admin/spotlights/index/">Spotlights</a></li> 
					<li><a href="/admin/spotlight_items/index/">Items</a></li> 
				</ul> 
			</div> 
			
			<div id="mainbody" class="with-subnav"> 
				<h2 class="form-head">New Spotlight</h2>
				<?php echo partial('validation'); ?>
				<?php echo form_open_multipart('admin/spotlights/create'); ?>
				<div class="form-row">
					<label>Name</label>
					<?php echo form_input('name'); ?>
				</div>
				<div class="form-row">
					<label>Template Name</label>
					<?php echo form_dropdown('template_name', $templates); ?>
				</div>
				<!--<a href="#" id="add-sp-item">Add Spotlight Item</a><br />-->
				<div class="form-row">
					<?php echo form_submit('submit', 'Create'); ?>
				</div>
				</form>
			</div>
