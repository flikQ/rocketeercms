<div id="saved">Order Saved</div>

<h1>Forum Sections</h1>
<div id="subnav"> 
				<ul> 
					<li><a href="/admin/forums/index/">Forums</a></li> 
					<li><a href="/admin/forum_threads/index/">Threads</a></li>
                    <li><a href="/admin/forum_posts/index/">Posts</a></li>
					<li class="active"><a href="/admin/forum_sections/index/">Sections</a></li> 
				</ul> 
			</div> 
			
			<div id="mainbody" class="with-subnav"> 
				<ul class="action-buttons"> 
					<li><a href="/admin/forum_sections/add/" class="generic_button large">Add Forum Section</a></li> 
				</ul><br>
				<?php if(count($sections) > 0) : ?>
				<div class="component-block"> 
				
					<table cellpadding="0" cellspacing="0" class="sortable"> 
						<tr class="lead"> 
							<th class="title">Name</th> 
							<th class="description">Description</th>
							<th class="date">Created</th> 
							<th class="controls"></th> 
						</tr>
						<?php foreach($sections as $section) : ?> 
						<tr id="section-<?=$section->id;?>" class="sort"> 
							<td class="title"> 
								<a href="/admin/forum_sections/edit/id/<?php echo $section->id; ?>/" class="article-title"><?php echo $section->name; ?></a> 
							</td>
							<td class="description"><?php echo $section->description; ?></td>
							<td class="date"><?php echo $section->created_at; ?></td> 
							<td class="controls-lists"> 
								<ul class="buttons">
									<li><a href="/admin/forum_sections/remove/id/<?php echo $section->id; ?>" class="delete">Delete</a></li> 
									<li><a href="/admin/forum_sections/edit/id/<?php echo $section->id; ?>" class="edit">Edit</a></li> 
								</ul> 
							</td> 
						</tr> 
						<?php endforeach; ?>
						</table> 
				</div>
				<?php else: ?>
				<p class="none">No sections found</p>
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

		$(".sortable tbody").sortable({
			helper: function(event, ui) {
				ui.children().each(function(){
					$(this).width($(this).width());
				});

				return ui;
			},
			update: function() {
				var order      = $(".sortable tbody").sortable('serialize', {key: 'item'});

				// Save the the new order
				clearTimeout(orderTimer);

				orderTimer = setTimeout(function(){
		            save                = {};
					save.order          = order;
		            save.csrf_test_name = '<?php echo $this->security->csrf_hash; ?>';
					
		            $.post("<?=site_url('admin/forum_sections/index/order');?>", save, function(data){
						
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
	});
</script>