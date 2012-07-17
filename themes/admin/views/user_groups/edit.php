<h1>Groups</h1>
<div id="subnav"> 
				<ul>
					<li><a href="/admin/users/index/">Users</a></li>
					<li class="active"><a href="/admin/user_groups/index/">Groups</a></li>
					<li><a href="/admin/user_rights">Rights</a></li>
				</ul> 
			</div> 
			
			<div id="mainbody" class="with-subnav"> 
			<h2  class="form-head">Edit Group</h2>
			<?php echo partial('validation'); ?>
			<?php echo form_open('admin/user_groups/update'); ?>
			<?php echo form_hidden('id', $group->id); ?>
			<div class="form-row">
			<label>Name</label>
			<?php echo form_input('name', $group->name); ?>
			</div>
			<div class="form-row">
			<label>Description</label>
			<?php echo form_textarea('description', $group->description); ?><br><br>
			</div>
			<div class="form-row">
			<label>Rights</label>
			<table>
				<tr>
					<th>Description</th>
					<th>Value</th>
				</tr>
				<?php foreach($rights as $right) : ?>
				<tr>
					<td><?php echo humanize($right); ?></td>
					<td><?php echo form_checkbox('rights['.$right.']', '1', can($right, $group)); ?></td>
				</tr>
				<?php endforeach; ?>
			</table>
			</div>
			<?php echo form_submit('submit', 'Update'); ?>
			</form>

</div>