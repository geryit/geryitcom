<div id="back">
	<a href="">&larr; BACK TO WORKS</a>
</div>
<div id="works" class="grid_12">
	<h1><span>Works</span></h1>
	<section id="workList" class="grid_12 alpha omega">
		<? 
		$result = $conn->query("SELECT * FROM ".$wpdb->prefix."works order by ord desc");
	
		while($r = $result->fetch_assoc()) {
		?>
		<article class="grid_3">
			<div class="mask">
				<p class="year">
					<? echo $r['year']; ?>
				</p>
				<p class="ss" style="background:url(//d2g83xhm015jzr.cloudfront.net/images/works_full/<?=$r['img'];?>)">
					Image
				</p>
				<section class="innerMask">
					<? if ($r->url != "http://www.geryit.com") { ?>
					<a href="<?=$r['url'];?>" class="launch">Launch</a>
					<? } ?>
					<h2>
						<? echo nl2br($r['title']); ?>
					</h2>
					<p class="short">
						<? echo nl2br($r['shortDes']); ?>
					</p>
					<p class="long">
						<? echo nl2br($r['des']); ?>
					</p>
					<div class="tags">
						&nbsp;
					</div>
				</section>
				<section class="tags">
					<h4>RELATED TAGS</h4>
					<ul>
						<? 
						$tags = explode(",", $r['tags']);
						for ($i = 0; $i < count($tags); $i++) {
						    $tag = trim($tags[$i]);
						    
						?>
						<li>
							<a href="" title='Click to filter by "<?=ucwords($tag);?>" tag'><? echo $tag; ?></a>
						</li>
						<? } ?>
					</ul>
				</section>
			</div>
		</article>
		<? } ?>
	</section>
</div>
<?
if ($_GET["tag"]){?>
<script>
window.onload = function() {
  $('html, body').animate({scrollTop: $("#workList").offset().top-15}, 1000);
};
</script>
<? }?>
