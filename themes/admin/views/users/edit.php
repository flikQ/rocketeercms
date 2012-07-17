<h1>Users</h1>
<div id="subnav"> 
				<ul>
					<li class="active"><a href="/admin/users/index/">Users</a></li>
					<li><a href="/admin/user_groups/index/">Groups</a></li>
					<li><a href="/admin/user_rights">Rights</a></li>
				</ul> 
			</div> 
			
			<div id="mainbody" class="with-subnav"> 
			<h2 class="form-head">Edit User</h2>
<?php echo partial('validation'); ?>
<?php echo form_open_multipart('admin/users/update'); ?>
<?php echo form_hidden('id', $user->id); ?>
<div class="form-row">
	<div class="form-row-half">
	<label>Username</label>
	<?php echo form_input('user[username]', $user->username); ?><br>
	</div>
	<div class="form-row-half">
	<label>Email</label>
	<?php echo form_input('user[email]', $user->email); ?><br>
	</div>
</div>
<div class="form-row">
	<div class="form-row-half">
	<label>Group</label>
	<?php echo form_dropdown('user[group_id]', $groups, $user->group_id); ?><br><br>
	</div>
	
	<div class="form-row-half">
		
		<?php echo img($user->avatar()); ?>
		<label>Avatar</label>
		<?php echo form_upload('avatar'); ?>
	</div>
</div>
<div class="form-row">

		<label>Active</label>
		<?php
		echo form_dropdown('user[active]', array
		(
			0 => 'No',
			1 => 'Yes'
		), $user->active);
		?>

	

</div>
<br><br>
<div class="edit-block">
	<h2 class="form-head">Meta data</h2>
	<ul>
	
	<?php foreach($meta as $key=>$value) : ?>
	<li>
		<div class="form-row-half">
		<label><?php echo humanize($key); ?></label>
		<?php echo form_input('meta['.$key.']', $value); ?>
		</div>
	</li>
	<?php endforeach; ?>
	</ul>
</div>

<div style="clear: both;"></div>

<br />
<div class="edit-block">
	<h2 class="form-head">Change Password</h2>
	<p>If you don't want to change your password, please leave these fields empty.</p>
	
	<ul>
		<li>
			<div class="form-row-half">
				<label>New Password</label>
				<?php echo form_password('new_password'); ?>
			</div>
		</li>
		<li>	
			<div class="form-row-half">
				<label>Confirm New password</label>
				<?php echo form_password('new_password_r'); ?>
			</div>
		</li>
	</ul>
</div>

<div class="form-row">
<?php echo form_submit('submit', 'Update'); ?>
</div>
</form>

</div>
