<h1>Settings</h1>

			
			<div id="mainbody" class="the-settings"> 
				<ul class="action-buttons"> 
					<li><a href="/admin/settings/add/<?php if(param('category')) { echo 'category/'.param('category'); } ?>" class="generic_button large">Add Setting</a></li> 
				</ul><br>
				<?php if(count($settings) > 0) : ?>
				<div class="component-block">
					<?php echo form_open_multipart('admin/settings/multi_update'); ?>
					
					<div class="left-menu">
						<ul class="left-tabs">
							<?php foreach($settings as $category=>$items) : ?>
							<li><a href="#"><?php echo humanize($category); ?></a></li>
							
							<?php endforeach; ?>
						</ul>
					</div>
					<script>// perform JavaScript after the document is scriptable.
						$(function() {
							// setup ul.tabs to work as tabs for each div directly under div.panes
							$("ul.left-tabs").tabs("div.panes > div");
						});</script>
					<div class="variable panes">
					<?php foreach($settings as $category=>$items) : ?>
					<div class="form-group">
						<h2><?php echo humanize($category); ?></h2>
						<?php foreach($items as $setting) : ?>
						<div class="form-row">
							<div class="inner">
								<label><?php echo humanize($setting->key); ?></label>
							<?php echo strpos($setting->key, 'password') === 0 ? form_password('settings['.$setting->key.']', $setting->value) : form_input('settings['.$setting->key.']', $setting->value); ?>
							</div>
						</div>
						<?php endforeach; ?>
						
						<?php if($category == 'themes'): ?>
						
							<!-- Background image -->
							<div class="form-row">
								<div class="inner">
								<label>Background image</label>
								<input type="file" name="background" id="background" />
								
								<?php if(file_exists(FCPATH . 'uploads/backgrounds/takeover.jpg')): ?>
								
									<p>
										<em>Leave this field empty if you don't want to change 
										<a href="/uploads/backgrounds/takeover.jpg" target="_blank">current takeover background image</a>. 
										</em>
									</p>
									<p>
										<a href="/admin/settings/delete_takeover" class="delete">Delete</a>
									</p>
								
								<?php endif; ?>
								</div>
							</div>
						
						<?php endif; ?>
					</div>
					<?php endforeach; ?>
					</div>
					
					<div class="form-row">
						<?php echo form_submit('submit', 'Save'); ?>
					</div>
					</form>
				</div>
				<?php else: ?>
				<p class="none">No settings found.</p>
				<?php endif; ?>
			</div> 
