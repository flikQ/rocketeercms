<div id="saved">Order Saved</div>

<h1>Forums</h1>
<div id="subnav"> 
				<ul> 
					<li class="active"><a href="/admin/forums/index/">Forums</a></li>
					<li><a href="/admin/forum_threads/index/">Threads</a></li>
                    <li><a href="/admin/forum_posts/index/">Posts</a></li>
					<li><a href="/admin/forum_sections/index/">Sections</a></li>
				</ul> 
			</div> 
			
			<div id="mainbody" class="with-subnav"> 
				<ul class="action-buttons"> 
					<li><a href="/admin/forums/add/" class="generic_button large">Add Forum</a></li> 
				</ul><br>
				<?php if(count($sections) > 0) : foreach($sections as $section) : ?>
				<h2><?php echo $section->name; ?></h2>
				<?php if($section->forums && count($section->forums) > 0) : ?>
				<div class="component-block"> 
				
					<table cellpadding="0" cellspacing="0" id="section-<?=$section->id;?>" class="sortable">
						<tbody>
							<tr class="lead"> 
								<th class="title">Name</th> 
								<th class="description">Description</th>
								<th class="date">Created</th> 
								<th class="controls"></th> 
							</tr>
							<?php foreach(fetch('forums', 'order_by_asc=order&section_id='.$section->id.'') as $forum) : ?> 
							<tr id="forum_<?=$forum->id;?>" class="sort">
								<td class="article-info"> 
									<a href="/admin/forums/edit/id/<?php echo $forum->id; ?>/" class="article-title"><?php echo $forum->name; ?></a> 
								</td>
								<td class="description"><?php echo $forum->description; ?></td>
								<td class="date"><?php echo $forum->created_at; ?></td> 
								<td class="controls-lists"> 
									<ul class="buttons">
										<li><a href="/admin/forums/remove/id/<?php echo $forum->id; ?>" class="delete">Delete</a></li> 
										<li><a href="/admin/forums/edit/id/<?php echo $forum->id; ?>" class="edit">Edit</a></li>
									</ul> 
								</td> 
							</tr> 
							<?php endforeach; ?>
						</tbody>
					</table> 
				</div>
				<?php else : ?>
				<p class="none">No forums found</p>
				<br />
				<?php endif; endforeach; ?>
				<?php else : ?>
				<p class="none">You must add a section before you can add a forum</p>
				<?php endif; ?>
			</div> 

<script type="text/javascript" charset="utf-8">
	
	var orderTimer = null;
	
	function saveAlert() {
	    $("#saved").clone().removeAttr('id').attr('class', 'saved').css('display', 'block').prependTo('body');
		setTimeout(function(){
			$(".saved").fadeOut(300, function(){
				$(this).remove();
			});
		}, 3000);
	}
	
	$(function(){
		
		$(".sortable tbody tr.lead").css('cursor', 'default');
		
		$(".sortable tbody tr.sort").mouseover(function(){
			$(this).addClass('sort-active');
		}).mouseout(function(){
			$(this).removeClass('sort-active');
		});
		
		var userAgent = navigator.userAgent.toLowerCase();
		
		if(userAgent.match(/firefox/)) {
			$(".sortable tbody").bind("sortstart", function(event, ui){
				ui.helper.css('margin-top', $(window).scrollTop());
			}).bind('sortbeforestop', function(event, ui){
				ui.helper.css('margin-top', 0);
			});
		}
		
		<?php foreach($sections as $section): ?>
			
			<?php
			if(!isset($section->forums) OR count($section->forums) === 0)
			{
				continue;
			}
			?>
			
			$("#section-<?=$section->id;?> tbody").sortable({
				helper: function(event, ui) {
					ui.children().each(function(){
						$(this).width($(this).width());
					});

					return ui;
				},
				update: function() {
					var order      = $("#section-<?=$section->id;?> tbody").sortable('serialize', {key: 'item'});
					var section_id = $(this).parent().attr('id');

					// Save the the new order
					clearTimeout(orderTimer);

					orderTimer = setTimeout(function(){
			            save                = {};
						save.section_id     = section_id;
						save.order          = order;
			            save.csrf_test_name = '<?php echo $this->security->csrf_hash; ?>';

						console.log(save);

			            $.post("<?=site_url('admin/forums/index/order');?>", save, function(data){
							if(data.success) {
								saveAlert();
							} else {
								alert(data.error);
							}
			        	});
			        }, 1000);
				},
				items: 'tr.sort',
				axis: 'y'
			}).disableSelection();
			
		<?php endforeach; ?>
		
	});
</script>