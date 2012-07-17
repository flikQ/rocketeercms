<h1>Dashboard</h1> 
			
		<?php if($analytics): ?>
			<div id="dash-full">
				<div class="traffic widget-box">
					<h3>Analytics Summary</h3> 
					<div id="analytics">	
						<script type="text/javascript">
							var visitsColor = '#BF202F', viewsColor = '#188B9C';
						</script>
						<!--[if lte IE 8]><script src="<?php echo site_url('themes/admin/assets/js/excanvas.min.js'); ?>" type="text/javascript"></script><![endif]-->
						<script src="<?php echo site_url('themes/admin/assets/js/analytics.js'); ?>" type="text/javascript"></script>
						<div id="loading">Compiling Analytics…</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
			
			
			<div id="dash-static">
				<div id="newusers" class="widget-box"> 
					<h3>New Users <span class="total">Total Users: <?php echo $total_users; ?></span></h3> 
					<div class="inner"> 
						<ul class="list"> 
							<?php foreach($new_users as $user) : ?>
							<li>
								<h4><?php echo link_to($user->username, '/admin/users/edit/id/'.$user->id); ?></h4>
								<span class="posted"><?php echo $user->created_on; ?></span>
							</li>
							<?php endforeach; ?>	
						</ul> 
					</div> 
				</div>
				
				<div id="loggedin" class="widget-box"> 
					<h3>Recently Logged In</h3> 
					<div class="inner"> 
						<ul class="list"> 
							<?php foreach($recent_users as $user) : ?>
							<li>
								<h4><?php echo link_to($user->username, '/admin/users/edit/id/'.$user->id); ?></h4>
								<span class="posted"><?php echo date('D jS M Y - g:ia', $user->last_login); ?></span>
							</li>
							<?php endforeach; ?>	
						</ul> 
					</div> 
				</div>

			
			</div>
			
			
			<div id="dash-variable">
				<div id="latest-articles" class="widget-box"> 
					<h3>Latest Articles</h3> 
					<div class="inner"> 
						<ul class="list">
							<?php foreach($latest_articles as $article): ?>
							<li> 
								<span class="posted"><?php echo link_to($article->user->full_name(), '/admin/users/edit/id/'.$article->user->id); ?> posted a <?php echo $article->section->name; ?></span> 
								<h4><?php echo $article->title; ?></h4> 
								<span class="posted"><?php echo $article->created_at; ?></span>
								<ul class="buttons float-right"> 
									<li></li>
									<li><a href="/admin/articles/edit/id/<?php echo $article->id; ?>/" class="edit">Edit</a></li>
								</ul> 
							</li>
							<?php endforeach; ?>
						</ul>
					</div> 
				</div> 
			</div> 
			

			
			
			
