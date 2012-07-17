<h1>Users</h1>
<div id="subnav"> 
	<ul>
		<li class="active"><a href="/admin/users/index/">Users</a></li>
		<li><a href="/admin/user_groups/index/">Groups</a></li>
		<li><a href="/admin/user_rights">Rights</a></li>
	</ul> 
</div> 
			
<div id="mainbody" class="with-subnav"> 
			
			
			<h2 class="form-head">Add User</h2>
			<?php echo partial('validation'); ?>
			<?php echo form_open('admin/users/create'); ?>
			<div class="form-row">
			<label>Username</label>
			<?php echo form_input('user[username]'); ?>
			</div>
			<div class="form-row">
			<label>Email</label>
			<?php echo form_input('user[email]'); ?><br>
			</div>
			<div class="form-row">
			<label>Password</label>
			<?php echo form_password('user[password]'); ?><br>
			</div>
			<div class="form-row">
			<label>First Name</label>
			<?php echo form_input('meta[first_name]'); ?><br>
			</div>
			<div class="form-row">
			<label>Last Name</label>
			<?php echo form_input('meta[last_name]'); ?><br>
			</div>
			<div class="form-row">
			<label>Group</label>
			<?php echo form_dropdown('meta[group_id]', $groups); ?><br><br >
			</div>
			<div class="form-row">
			<?php echo form_submit('submit', 'Create'); ?>
			</div>
			</form>

</div>