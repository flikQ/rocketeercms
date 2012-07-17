<script>
$('.slideshow').cycle({
	fx: 'fade',
	speed: 'slow',
	timeout: 5000,
	prev:    '#carousel_surround .prev',
    next:    '#carousel_surround .next',
	pager: '.main-car-nav',
	pagerAnchorBuilder: function(idx, slide) {
// return selector string for existing anchor
return '.main-car-nav li:eq(' + idx + ') a';
}
	});
	$('#direct').click(function() {
	$('.main-car-nav li:eq(2) a').trigger('click');
	return false;
}); 
</script>


<div id="carousel_surround">
	<a class="prev">&lt;</a>	
	<div id="carousel">	
		<!-- CAROUSEL NAV -->
		<div class="carousel-nav">
			<ul class="main-car-nav">
	        	<?php foreach($spotlight->items as $item) : ?>
			    <li>
			        <a href="#">nav		        
			        </a>
				</li>
			   <?php endforeach; ?>
	   		</ul>
	   	</div>
		
		<ul class="slideshow">
			<?php foreach($spotlight->order_by('id', 'desc')->items as $item) : ?>
			<li>
				<div class="carousel-copy">
					<h2><a href="<?php echo $item->url; ?>"><?php echo $item->headline; ?></a></h2>
					<?php echo $item->description; ?>
				</div>
				<a href="<?php echo $item->url; ?>"><img src="<?php echo $item->image_url; ?>" width="1000" height="300" /></a>
			</li>			
			<?php endforeach; ?>
		</ul>
	</div>
	<a class="next">&gt;</a>
</div>
