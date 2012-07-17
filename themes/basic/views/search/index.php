<div id="content" class="has-side">

	<h1 id="page-title">Search Results</h1>

    <section id="search">

   			
	<div id="search-large" class="widget">
        <form action="<?php echo site_url('search'); ?>" method="get">
            <?php echo form_input('q', $this->input->get('q')); ?>
            <?php echo ($this->input->get('filter')) ? form_hidden('filter', $this->input->get('filter')) : ''; ?>
            <button type="submit" class="generic_button">Search</button>
        </form>
	</div>
	
	 <ul class="search-for">
        <li class="here">Currently searching for: <strong><?= $this->input->get('q') ?></strong></li>
    </ul>

    
    <div id="filter-tabs">
		<ul>
			<?php $search_url = site_url('search?q=').$this->input->get('q'); ?>
			<li><a href="<?php echo $search_url; ?>&amp;filter=articles" <?=($filter == 'articles' OR !$filter) ? 'class="active"' : ''; ?>>Articles & Blogs</a></li>
			<li><a href="<?php echo $search_url; ?>&amp;filter=videos" <?=($filter == 'videos') ? 'class="active"' : ''; ?>>Video</a></li>
		</ul>
    </div>
    <?php if($count >= 1) { ?><div class="results">Found <?php echo $count; echo ($count > 1) ? ' results' : ' result'; ?></div><?php } ?>
    
    <?php if($count >= 1) { ?>

            <?php if($filter == 'articles'): ?>
			<div id="search-results" class="articles">
       		   <ul id="the-articles">

                <?php foreach($result as $row) : ?>
                    <li>
                        <?php $cat_url = ($row->cat_url) ? $row->cat_url : 'Unknown'; ?>
                        
                        <a href="<?=site_url('articles/'.$row->section_url.'/'.$cat_url.'/'.$row->id.'/'.$row->article_url);?>"><img width="150" alt="<?= $row->title ?>" src="<?= $row->image_url ?>" class="rf-thumb" /></a>
                        
                        <h2><a href="<?=site_url('articles/'.$row->section_url.'/'.$cat_url.'/'.$row->id.'/'.$row->article_url);?>">
                            <?=$row->title;?>
                        </a></h2>
                        
                        <span class="meta"><?= ($row->date > 1000000000) ? date("D dS M Y - h:ma", $row->date) : $row->date ; ?></span>
                        
                       <p><?php
                        $content = (strlen(strip_tags($row->short_content)) > 0) ? $row->short_content : strip_tags(word_limiter($row->content, 50));
                        echo strip_tags($content);
                        ?></p>
						
						<span class="url"><a href="<?= site_url('articles/'.$row->section_url.'/'.$cat_url.'/'.$row->id.'/'.$row->article_url); ?>"><?= 'articles/'.$row->section_url.'/'.$cat_url.'/'.$row->id.'/'.$row->article_url; ?></a></span>
                    </li>
                <?php endforeach; ?>
			</ul>
			</div>
            <?php endif; ?>
            
            <?php if($filter == 'videos'): ?>
			<section id="videos" class="a-list">
				<ul id="the-articles">
                <?php foreach($result as $row) : ?>
				
				<?php
                        $cat_name     = ($row->cat_name) ? $row->cat_name : 'Unknown';
                        $username     = ($row->username) ? $row->username : 'Unknown';
                        $created_at   = ($row->created_at) ? date("D jS M Y - g:ia", $row->created_at) : 'Unknown';
                        $cat_url_name = ($row->cat_url_name) ? $row->cat_url_name : 'Unknown';
                        ?>
					
					<li>
						<figure class="thumb-box">
							
							<span class="thumb-crop"><a href="<?=site_url('videos/'.$cat_url_name.'/'.$row->id.'/'.$row->url_title);?>">
							
							<?php
								if(preg_match('/embed\/([A-Za-z0-9-_]+)/', $row->embed_code, $match)) {
								?>
									<img alt="<?= $row->title ?>" src="<?= 'http://img.youtube.com/vi/'.$match[1].'/0.jpg'; ?>" class="rf-youtube-thumb">
								<?php
								}
							?>
							
							</a></span>
						</figure>
						<h2><a href="<?=site_url('videos/'.$cat_url_name.'/'.$row->id.'/'.$row->url_title);?>"><?=$row->title;?></a></h2>
						
						<span class="section-meta"><?= $cat_name; ?></span>
						<span class="meta">By <?= $username; ?> // <?= $created_at; ?></span>
						
						
					</li>
                     
                <?php endforeach; ?>
				</ul>
			</div>
            <?php endif; ?>
                
        <?=$pagination;?>

        </section>

               
    <?php } else { ?>
        
        <p class="none">Sorry no results.</p>
        
    <?php } ?>
    

</div>

<?php sidebar('main'); ?>