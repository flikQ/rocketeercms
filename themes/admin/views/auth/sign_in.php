<div id="login-surround"> 
	<?php echo collect('message'); ?> 
	<?php echo partial('validation'); ?> 
	<div id="login-box"> 
		<h1><?php echo setting('general.site_title'); ?></h1> 
		<p class="title">Admin Control</p> 
		             
		<?php if(isset($redirect)) { ?> 
		<?php echo form_open("admin/login?redirect=".$redirect, array('autocomplete' => 'off'));?> 
			<?php } else { ?> 
				<?php echo form_open("admin/login", array('autocomplete' => 'off'));?> 
			<?php } ?> 
	
	
		<p> 
			<label class="email" for="email">Email</label> 
			<?php echo form_input('email');?> 
		</p> 
		
		<p> 
			<label class="password" for="password">Password</label> 
			<?php echo form_password('password');?> 
		</p> 
		
		<?php if(isset($redirect)): ?> 
			<input type="hidden" name="redirect" value="<?=$redirect;?>" /> 
		<?php endif; ?>     
		<p><?php echo form_submit('submit', 'Sign In');?></p> 
		<?php echo form_close();?> 
	 	 
	 	
		<script> 
		        $("input[type='text']").focus(function() { 
		            $(".email").fadeOut("fast", "linear"); 
 	            }); 
		             
	            $("input[type='text']").blur(function() { 
 	              if( !this.value ) { 
		                $(".email").fadeIn("fast", "linear"); 
					} 
		        }); 
		             
	 	        $("input[type='password']").focus(function() { 
	            $(".password").fadeOut("fast", "linear"); 
		            }); 
		             
		        $("input[type='password']").blur(function() { 
		            if( !this.value ) { 
		                $(".password").fadeIn("fast", "linear"); 
		            } 
		        }); 
        </script> 

      
    </div>
	
	<span class="shadow"></span> 
	
</div>
