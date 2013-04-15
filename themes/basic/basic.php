<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?></title>
		<?php echo css('core'); ?>
		<?php if(isset($js)) : foreach($js as $name) : echo js($name); endforeach; endif; ?>
		<?php if(isset($css)) : foreach($css as $name) : echo css($name); endforeach; endif; ?>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
		<script src="/themes/admin/assets/js/jquery-ui-1.8.min.js"></script>
		<!--[if lte IE 8]><script type="text/javascript" language="javascript" src="/themes/jowst/assets/js/charts/excanvas.min.js"></script><![endif]-->
		<script type="text/javascript" src="/themes/<?php echo setting('themes.default_theme') ?>/assets/js/charts/jquery.flot.js"></script>
		<script src="http://cdn.jquerytools.org/1.2.5/all/jquery.tools.min.js"></script>
		<script src="/themes/<?php echo setting('themes.default_theme') ?>/assets/plugins/jquery-validation-1.8.1/jquery.validate.min.js" type="text/javascript"></script>
		<script src="/themes/<?php echo setting('themes.default_theme') ?>/assets/js/jquery.cycle.all.js" type="text/javascript"></script>

		<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
		<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>			

		<link rel="icon" type="image/png" href="/themes/<?php echo setting('themes.default_theme') ?>/assets/images/favicon.png" />
		
	</head>

	<body>
		
		<div id="wrapper">
			
			<?php widget('userbox'); ?>
			
			<header>
				<div class="logo"><a href="/"><?php echo setting('general.site_title') ?></a></div>				
			</header>
			<nav>
				<ul>
					<li <?php if($this->uri->segment(1) == ''): echo 'class="active"'; endif; ?>><a href="/">Home</a></li>
					<li <?php if($this->uri->segment(2) == 'news'): echo 'class="active"'; endif; ?>><a href="/articles/news">News</a></li>
					<li <?php if($this->uri->segment(2) == 'blogs'): echo 'class="active"'; endif; ?>><a href="/articles/blogs">Blogs</a></li>
					<li <?php if($this->uri->segment(1) == 'forums'): echo 'class="active"'; endif; ?>><a href="/forums">Forums</a></li>
					<li <?php if($this->uri->segment(1) == 'about'): echo 'class="active"'; endif; ?>><a href="/about">About</a></li>
				</ul>
			</nav>
					
			{yield}
			
				
			<footer>
				<p class="copyright">Copyright &copy; Rocketeer CMS 2011-<?php echo date('Y')?>. All rights reserved.</p>
				<p class="rocket-link">Basic theme for <a href="http://www.rocketeercms.com">Rocketeer CMS</a></p>
			</footer>		
		</div>
	</body>
</html>
