<div id="content-wrapper">
	
	<div id="content" class="has-side articles">
		<h1><?= humanize(param('section')) ?></h1>
		<?php if(humanize(param('category'))):?><h2><?= humanize(param('category')) ?></h2><?php endif; ?>
		
		<?php if(count($articles) > 0) : ?>
		
			<?php echo $pagination; ?>
			<div class="widget">
				<ul id="the-articles" class="<?= humanize(param('section')) ?>-list">
				<?php foreach($articles as $article) : ?>
					<li>					
						<?php if($article->section->url_name == 'blogs'):?>
							<a href="<?= article_url($article->section->url_name, $article->category->url_name, $article->id, $article->url_title) ?>"><img alt="<?= $article->user->username; ?>" src="<?= $article->user->avatar('small'); ?>" class="user-thumb"></a>
						<?php else:?>
							<a href="<?= article_url($article->section->url_name, $article->category->url_name, $article->id, $article->url_title) ?>"><img alt="<?= $article->title ?>" src="<?= $article->image_thumb_url ?>" class="rf-thumb"></a>
						<?php endif;?>
						<h3><a href="<?= article_url($article->section->url_name, $article->category->url_name, $article->id, $article->url_title) ?>"><?= $article->title ?></a></h3>
						<span class="meta">By <?= link_to($article->user->username, profile_url($article->user->username)) ?> on <?= $article->created_at ?></span>
						<?= $article->short_content ?>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
			<?php echo $pagination; ?>
		
		<?php else: ?>
			There are no articles in this area.
		<?php endif; ?>
		
	</div>
	<?php sidebar('main'); ?>
</div>

