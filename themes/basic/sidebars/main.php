<div id="sidebar">
	
	<div class="widget sidewidget">
		<h2>Latest Blogs</h2>
		<ul>
			<?php foreach(fetch('articles', 'section=blogs&limit=5') as $article) : ?>
			<li>
				<img class="rf-thumb" src="<?php echo $article->user->avatar(); ?>">
				<h3><?= link_to($article->title, article_url($article->section->url_name, $article->category->url_name, $article->id, $article->url_title)) ?></h3>
				<span class="meta">By <?= link_to($article->user->username, profile_url($article->user->username)) ?> on <?= $article->created_at ?></span>
			</li>
			<?php endforeach; ?>
			<li>
				<a class="button right" href="/articles/blogs">All Blogs</a>
			</li>
		</ul>
	</div>	
	
</div>
