<div id="content-wrapper">
	<div id="content" class="has-side">
		<article>
			<h2 id="page-title"><?= $article->section->name ?></h2>	
			<h1 id="the-title"><?= $article->title ?></h1>
			<div id="post-meta">
				<a href="<?= profile_url($article->user->username) ?>" class="author-avatar">
					<img src="<?php echo $article->user->avatar_url ?>" title="<?php echo $article->user->username ?>" alt="<?php echo $article->user->username ?>" />
				</a>
				<h3 class="author-meta"><?= link_to($article->user->username, profile_url($article->user->username)) ?></h3>
				<h4 class="author-meta"><?= $article->user->full_name() ?></h4>	
			</div>
			<div id="the-post">
				<span class="date"><?= $article->created_at ?> <span class="category"><?= $article->category->name ?></span></span>
				<img width="660" alt="<?php echo $article->title; ?>" src="<?php echo $article->image_url; ?>" class="rf-article-img">
				<?= $article->content ?>
			</div>
		</article>
	
		<?= partial('comments', array(
			'model' => $article,
		)) ?>
	
	</div>
	<?php sidebar('main'); ?>
</div>
