<div id="content-wrapper">
	<div class="noside" id="content">	
		<div id="register">

			<!-- Register new account -->
			<div id="login-box">
				
				
				<div class="reg-intro">
					<h1>Create Your Account</h1>
				</div>
				
				<?php echo partial('validation'); ?>
				<?php echo flash('message'); ?>	

				<?php echo form_open_multipart("auth/sign_up");?>
			   	     <div class="form-row">
				      	<label>Username</label>
				     	<?php echo form_input('username'); ?>
			   	     </div>
			
				     <div class="form-row">
					    <label>Email</label>
					 	<?php echo form_input('email');?>
				     </div>
			
			   	     <div class="form-row">
				    	<label>Password</label>
					    <?php echo form_password('password');?>
				     </div>
				     <div class="form-row">
					    <label>Confirm password</label>
				     	<?php echo form_password('password_confirm');?>
				     </div>
				     
				     <div class="form-row">
					    <label>Location</label>
					 	<?php echo country_dropdown('country', array('US','CA','GB','DE','BR','IT','ES','AU','NZ','HK')); ?>
				     </div>
				
					
					<div class="form-row">
				      	<span class="generic_surround float-right"><?php echo form_submit('submit', 'Register', 'class="button"');?></span>
			      	</div>
				<?php echo form_close();?>
			</div>		
			
			<div id="social-signin">
				<h3>Already have an account?</h3>
				<ul>
					<li><a class="button left marg-r-10" href="/login">Log In</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
