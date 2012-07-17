<div id="userbar">
	<div id="userbox">	
		<?php if (! user_logged_in()) : ?>
			<ul class="loggedout">	
				<li><a href="/login">Login</a></li>
				<li><a href="/register">Register</a></li>
			</ul>
		<?php else: ?>			
			<ul class="loggedin">		
				<li class="dropuser">
					<span class="username"><?php echo current_user()->username ?></span>
					<img class="user-thumb" src="<?php echo current_user()->avatar('smaller') ?>" />
					<span class="drop web-symbol">&#123;</span>
					<ul class="dropdown">
						<li><a href="<?=site_url('profile')?>">My Profile</a></li>
						<li><a href="<?=site_url('profile/edit')?>">Edit Profile</a></li>
						
						<li><a href="<?=site_url('logout')?>">Logout</a></li>
					</ul>
				</li>
			</ul>
		<?php endif; ?>
	</div>
</div>