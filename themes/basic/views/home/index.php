<div id="content-wrapper">
	<?php spotlight('main'); ?>
	<div class="has-side" id="content">
		
		<div class="intro">
			<h1>Welcome to Rocketeer Basic</h1>
			<h2>This is a very simple theme showing off some of the simple functionality available with <a href="http://rocketeercms.com">Rocketeer CMS.</a></h2>
		</div>
		
		<div class="widget">
			<h2>Latest News</h2>
			<ul>
				<?php foreach(fetch('articles', 'section=news&limit=5') as $article) : ?>
				<li>
					<a href="<?= article_url($article->section->url_name, $article->category->url_name, $article->id, $article->url_title) ?>"><img alt="<?= $article->title ?>" src="<?= $article->image_thumb_url ?>" class="rf-thumb"></a>
					<h3><?= link_to($article->title, article_url($article->section->url_name, $article->category->url_name, $article->id, $article->url_title)) ?></h3>
					<span class="meta"><?= link_to($article->user->username, profile_url($article->user->username)) ?> on <?= $article->created_at ?> in <a href="/articles/news/<?= $article->category->url_name ?>"><?= $article->category->name ?></a></span>
					<?= $article->short_content; ?>
				</li>
				<?php endforeach; ?>
				<li>
					<a class="button right" href="/articles/news">News Archive</a>
				</li>
			</ul>
		</div>
			
		
	</div>
	<?php sidebar('main'); ?>
</div>
