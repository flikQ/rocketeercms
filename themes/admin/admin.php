<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>RocketFuel - <?php echo setting('general.site_title'); ?></title>

	<?php echo css('style'); ?>
	
	<!-- include the Tools -->
	<script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js"></script>
	<?php if(isset($js)) : foreach($js as $name) : echo js($name); endforeach; endif; ?>
	<script src="<?=site_url('themes/admin/assets/js/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php');?>" type="text/javascript" charset="utf-8"></script>
	<?php if(isset($css)) : foreach($css as $name) : echo css($name); endforeach; endif; ?>
	
	<script type="text/javascript">
		$(function(){
			$(".delete").click(function(){
				if(!confirm('Are you sure you want to delete this order?\n\nIt can NOT be undone!')) {
					return false;
				}
			});
		});
	</script>
		
	
	<link rel="icon" type="image/png" href="/themes/admin/assets/img/favicon.ico" />
	
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<![endif]-->
</head>
<body id="index" class="home">
	
	
	<div id="wrapper">
			
			<header>
				<div class="inner">
					<div id="logo"><?php echo setting('general.site_title'); ?></div>
					<section id="utility">
						<ul>
							<li class="welcome"><img class="rf-thumb" src="<?php echo current_user()->avatar_thumb_url; ?>"> Hi <?php echo current_user()->username; ?> <?php echo user_logged_in() ? link_to('Logout', '/admin/auth/logout') : ''; ?></li>
						</ul>
					</section>
				</div>
			
			</header>
			
		<section id="wrapper-inner">		

			<div id="side">
				
				
				<?php if(user_logged_in()) : ?>
					<nav id="main-nav">
					<ul>
						<li id="dashboard" <?php if($this->uri->segment(2) == ''): echo 'class="active"'; endif; ?>><a href="/admin/">Dashboard</a></li>
						<?php foreach(glob(APPPATH.'controllers/admin/*.php') as $controller) {
							preg_match('/[a-z_]+.php/i', $controller, $match);
							$slices = explode('.', $match[0]);
							$class = $slices[0];
							if(fetch_class() !== $class) {
									require FCPATH.$controller;
								}
								$vars = get_class_vars($class);
								if(isset($vars['menu']) && is_array($vars['menu']) && isset($vars['menu']['show']) && $vars['menu']['show'] == TRUE && can('view_'.$class)) {
								?><li id="<?php echo $class; ?>" <?php if(fetch_class() == $class) { ?>class="active"<?php }?>><a href="/admin/<?php echo $class; ?>/"><?php echo isset($vars['menu']['as']) ? $vars['menu']['as'] : humanize($class); ?></a><?php
								if(isset($vars['menu']['consists_of']) && is_array($vars['menu']['consists_of']) && count($vars['menu']['consists_of']) > 0) {
									?><ul class="drop-down">
									<li><a href="/admin/<?php echo $class; ?>/index"><?php echo humanize($class); ?></a></li>
									<?php
									foreach($vars['menu']['consists_of'] as $controller) {
										if(can('view_'.$controller)) { ?><li><a href="/admin/<?php echo $controller; ?>/index"><?php echo humanize(str_replace(singular($class).'_', '', $controller)); ?></a></li><?php }
									}
									?></ul><?php
								}
								?></li><?php
								}
						}
						?>
					</ul>
					</nav>
					<?php endif; ?>
			</div>
	
			
			<div id="content">
				{yield}
			</div>
			
			<div id="footer">
				<div class="inner">
					<p>
					Rocketeer CMS by <a href="http://www.gavinweeks.com" target="_blank">Gavin Weeks</a>.
					</p>
				</div>
			</div>
			
		</section>
	
	
	</div>
	
	
	
</body>
</html>
