<div id="content-wrapper">
	<div class="noside" id="content">				
		<div id="register">

			<!-- Register new account -->
			<div id="login-box">
				<h1>Forgot Password</h1>
				<p>Please enter your email address so we can send you an email to reset your password.</p>
			
				<div id="infoMessage"><?php echo $message;?></div>
				
				<?php echo form_open("auth/forgot_password");?>
				
				     <div class="form-row">
					    <label for="email">Email Address</label>
					 	<?php echo form_input($email);?>
					 </div>
				     <div class="form-row">
						<?php echo form_submit('submit', 'Submit', 'class="button"');?>
				     </div>
				      
				<?php echo form_close();?>
			</div>
		</div>
	</div>
</div>