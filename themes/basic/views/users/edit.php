<div id="content-wrapper">
	<div class="left-side edit-profile" id="content">
		
		<div class="main-form">
			<?php echo partial('validation'); ?>
			<?php echo form_open_multipart('profile/update', 'id=profile_form"'); ?>
			
			<div class="profile-edit">
				<h1>My Profile</h1>
						
				<fieldset>
					<legend>The Basics</legend>
					<div class="form-row">
						<label>Nickname</label> <?php echo form_input('user[username]', $user->username); ?>
					</div>
					<div class="form-row"><label>Email</label> 
						<div class="email-address"><?php echo form_input('user[email]', $user->email); ?></div>
					</div>
					<div class="form-row">
						<label>First Name</label> <?php echo form_input('meta[first_name]', $user->first_name); ?>
					</div>
						
					<div class="form-row">
						<label>Last Name</label> <?php echo form_input('meta[last_name]', $user->last_name); ?>
					</div>
					
					<div class="form-row">
						<label>Date of Birth</label> <?php echo form_input('meta[age]', $user->age); ?>
					</div>
					<div class="form-row"><label>Location</label> 
						<?php echo country_dropdown('user[country]', array('US','CA','GB','DE','BR','IT','ES','AU','NZ','HK'), $user->country); ?>
					
					</div>
					<div class="form-row">
						<label>Timezone</label>
						<select size="1" name="user[timezone]"><?php partial('timezones'); ?></select>
					</div>
					
					
					<div class="form-row">
						<label>Twitter</label><?php echo form_input('meta[twitter]', $user->twitter); ?>
					</div>
				
					
					<div class="form-row textarea">
						<label>Bio</label>	
						 <div class="formtextarea">
						 <?=form_textarea(array(
							'id'    => 'meta[about]',
						 	'name'  => 'meta[about]',
							'value' => $user->about
						 ));?>
						 </div>
					</div>
					
									
					<div class="password-fill">
						<p class="fyi">Only fill this to change your password.</p>
						<div class="form-row">
							<label>Password</label> <?php echo form_password('user[password]'); ?></div>
						<div class="form-row">
							<label>Confirm</label> <?php echo form_password('password'); ?>
						</div>
					</div>
				</fieldset>
				
				<div class="form-row confirm-edit">
					<span class="generic_surround"><?php echo form_submit('submit', 'Update Profile', 'class="button"'); ?></span>
					<?php echo link_to('Cancel', 'profile'); ?>
				</div>
				
			</div>
			
			<div class="photo-edit">
				<fieldset>
					<legend>Your Photo</legend>
					<div class="form-row">
						<img class="current-avatar" src="<?=$user->avatar('large'); ?>" />
					</div>
					<div class="form-row">	
						<label>Upload New Photo</label>
						<?php echo form_upload('avatar'); ?>
						<br><br>
						<?php echo form_submit('submit', 'Update Avatar', 'class="button"'); ?>
					</div>
				</fieldset>
			</div>
			
			
				
			</form>
			
		</div>
	</div>
</div>

