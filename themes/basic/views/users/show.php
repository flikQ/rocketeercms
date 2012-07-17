<div id="content-wrapper">
	<div id="content" class="has-side user-profile">
		<img class="user-image" src="<?php echo $user->avatar('large'); ?>">
		<h1><img src="/themes/<?= setting('themes.default_theme') ?>/assets/images/flags/32/<?php echo strtolower($user->country);?>.png" class="flag">  <?= $user->username ?> </h1>	
		<p class="full-name"><?php echo $user->full_name(); ?></p>
		<ul class="quick-info">
			<?php if(!empty($user->age)) : ?><li class="dob"><span class="web-symbol">P</span><?php echo $user->age; ?></li><?php endif;?>
			<?php if(!empty($user->twitter)) : ?><li class="twi"><span class="web-symbol">t</span><a href="http://www.twitter.com/<?php echo $user->twitter; ?>">@<?php echo $user->twitter; ?></a></li><?php endif;?>
		</ul>
				
		<?php if(!empty($user->about)) : ?>
			<div class="widget">		
				<h2>About me</h2>
				<?php echo $user->about; ?>
			</div>	
		<?php endif;?>					
	</div>
	<?php sidebar('main');?>
</div>