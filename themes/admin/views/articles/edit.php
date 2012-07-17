<h1>Articles</h1>

<div id="subnav"> 
	<ul> 
		<li class="active"><a href="/admin/articles/index/">Articles</a></li> 
		<li><a href="/admin/article_sections/index/">Sections</a></li> 
		<li><a href="/admin/article_categories/index/">Categories</a></li> 
	</ul> 
</div> 

<div id="mainbody" class="with-subnav">
	

	<?php echo partial('validation'); ?>
	<?php echo form_open_multipart('admin/articles/update'); ?>
	<?php echo form_hidden('id', param('id')); ?>
			<script>
			$(function() {

    var $sidebar   = $("#form-final"),
        $window    = $(window),
        offset     = $sidebar.offset(),
        topPadding = 15;

    $window.scroll(function() {
        if ($window.scrollTop() > offset.top) {
            $sidebar.stop().animate({
                marginTop: $window.scrollTop() - offset.top + topPadding
            });
        } else {
            $sidebar.stop().animate({
                marginTop: 0
            });
        }
    });

});
		</script>
		<div id="form-final">
			<div class="final-row">
				<label>Article Image</label>
				
				<?php if(strlen($article->image_url) > 0): ?>
					<?php echo img($article->image_url); ?>
				<?php endif; ?>
				
				<?php echo form_upload('image'); ?>
			</div>	
			<div class="final-row">
				<label>Date (click to change) </label>
				<input type="text" value="<?= date('d-m-Y G:i', $article->original_created_at) ?>" name="created_at" class="date" />
			</div>
			
			<?php if((int)current_user()->group_id !== 3): ?>
				<div class="final-row">
					<label>Publish Status</label>
					<?php echo form_dropdown('status', array(
						'draft' => 'Draft',
						'published' => 'Published'
					), $article->status); ?>
				</div>
			<?php endif; ?>
			
			<div class="final-row">
				<?php echo form_submit('submit', 'Update'); ?>
				<a href="/admin/articles/index/" class="cancel">Cancel</a>
			</div>
		</div>
		
	
		
		<div id="form-content">	
			<h2 class="form-head">Edit Article</h2>
			<div class="form-row title">
				<label>Title</label>
				<?php echo form_input('title', $article->title); ?>
			</div>
			<div class="form-row">
				
				<div class="form-half">
					<label>Section</label>
					<?php echo form_dropdown('section_id', $sections, $article->section_id); ?>
				</div>
				<div class="form-half">
					<label>Category</label>
					<?php echo form_dropdown('category_id', $categories, $article->category_id); ?>
				</div>
			</div>
			<div class="form-row">
				<label>Intro</label>
				<?php echo form_textarea('short_content', $article->short_content, 'class="short"'); ?>
			</div>
			<div class="form-row">
				<label>Full content</label>
				<?php echo form_textarea('content', $article->content, 'class="full"'); ?>
			</div>
		</div>
	</form>
</div>

