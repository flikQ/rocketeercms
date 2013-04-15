<div id="content-wrapper">
	<div class="noside" id="content">	
		<h1>Log In</h1>
		<div id="register">

			<?php echo partial('validation'); ?>
	 			
	 		<div class="error">
	 			<?php echo collect('message'); ?>
			</div>
	
			<?php echo form_open(login_url());?>
	
			      <div class="form-row">
			      	<label for="email">Email</label>
			      	<?php echo form_input('email');?>
			      </div>
			      
			      <div class="form-row">
			      	<label for="password">Password</label>
			      	<?php echo form_password('password');?>
			      </div>
			      
			      <div class="form-row">
				      <label for="remember" class="not-text">Remember me?</label>
				      <?php echo form_checkbox('remember', '1', FALSE);?>
				  </div>
				  <div class="form-row">
				  	<?php echo form_submit('submit', 'Log In', 'class="button"');?>
				  </div>
				  <div class="form-row">
					  <p><a href="/auth/forgot_password" class="float-left">Oh no I've forgotten my password!</a></p>
				  </div>
			<?php echo form_close();?>	
		</div>
	
		<div id="social-signin">
			<h3>Need an account?</h3>
			<ul>
				<li><a class="button left marg-r-10" href="/register">Register</a></li>
			</ul>
		</div>   
	</div>
</div>