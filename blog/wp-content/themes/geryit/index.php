<!DOCTYPE html>
<html class="blog">
	<head>
		<meta charset="utf-8">

		<title><?php bloginfo('name'); ?><?php wp_title('&raquo;', true, 'left'); ?></title>
		<meta name="author" content="Goksel Eryigit">

		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-TX79MN');</script>
        <!-- End Google Tag Manager -->

	<? wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TX79MN"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
		<iframe id="getSite" src="/loading.php"></iframe>
		<div id="back">
			<a href="">&lt; BACK TO POST</a>
		</div>
		<div id="content">
			<div id="light">
				<div id="contentWrapper" class="container_12">
					<header id="contentHeader" class="grid_12">
						<a href="/" id="logo" class="grid_5 alpha rotating">Goksel Eryigit / FRONT-END &amp; WEB APPLICATION DEVELOPER</a>
						<nav id="menu" class="grid_6">
							<ul>
								<li>
									<a href="/works" id="menuWorks" class="rotating">WORK</a>
								</li>
								<li>
									<a href="/code-samples" id="menuCodeSamples" class="rotating">CODE SAMPLES</a>
								</li>
								<li>
									<a href="/info" id="menuInfo" class="rotating">INFO</a>
								</li>
								<li class="current">
									<a href="/blog/" id="menuBlog" class="rotating">BLOG</a>
								</li>
								<li>
									<a href="/contact" id="menuContact" class="rotating">CONTACT</a>
								</li>
							</ul>
						</nav>
						<section id="networks" class="grid_1 omega">
							<a href="http://www.linkedin.com/in/geryit" class="rotating" id="n1">LinkedIn</a>
							<a href="http://www.facebook.com/goksel.eryigit" class="rotating" id="n2">Facebook</a>
							<a href="http://twitter.com/geryit" class="rotating" id="n3">Twitter</a>
						</section>
					</header>
					<div id="blog" class="grid_12">
						<h1>
							<span><a href="<?php bloginfo('url');?>">Blog</a></span>
						</h1>
						<section id="search" class="grid_3 push_9 alpha">
							<form id="searchForm" method="get" action="<?php bloginfo('url');?>">
								<input type="text" name="s" value="Search" title="Search" /><a href="" class="rotating">Search</a>
								<input type="submit" value="search" class="hiddenSubmit" />
							</form>
						</section>
						<section id="postsAndSideBar" class="grid_12 alpha omega">
							<section id="posts" class="grid_9 alpha omega">
								<?php if (have_posts()): ?>
								<?php while (have_posts()): the_post(); ?>
								<article class="grid_9 alpha omega">
									<? if (!is_single()) { ?>
									<div class="img grid_2 alpha omega">
										<?

										$thumb = get_the_post_thumbnail();
										$content = get_the_content();
										$html = str_get_html($content);
										$first_img = $html->find('img');
										$src = $first_img[0]->src;

										if (!$src) $src = "//d2g83xhm015jzr.cloudfront.net/images/cats_general.png";
										if ($thumb != ""){
											echo $thumb;
										}else{?>
											<img src="<?=$src;?>" width="120" height="70" alt="" />
										<? }?>
									</div>
									<? } ?>
									<div class="text alpha omega <? if (is_single()) echo "grid_9"; else echo "grid_7";?>">
										<h2>
											<a href="<? the_permalink() ?>" rel="bookmark"><? the_title(); ?></a>
										</h2>
										<? if (is_single()) { ?>
										<p class="dateAndCats">
											<?php the_time('F jS, Y')?> | <?php $cat = get_the_category(); for ($i = 0; $i < count($cat); $i++) { ?><? if ($i) echo ", "; ?><a href="<?=get_category_link($cat[$i]->cat_ID);?>"><?= $cat[$i]->cat_name; ?></a>
											<? } ?>
										</p>

										<article id="single">
											<?
											$content = get_the_content();
											$old = array("[code]", "[/code]");
											$new = array("<code>", "</code>");
											$content = str_replace($old, $new, $content);


											$main_image = get_post_meta(get_the_ID(), 'gk_main_image', true);
											$source_url = get_post_meta(get_the_ID(), 'gk_source_url', true);
											$source_logourl = get_post_meta(get_the_ID(), 'gk_source_logourl', true);
											$source_logo = get_post_meta(get_the_ID(), 'gk_source_logo', true);
											$logo_bg = get_post_meta(get_the_ID(), 'gk_logo_bg', true);

											if($main_image != ""){
												echo '<div id="main-image">'.wp_get_attachment_image($main_image,'full').'</div>';
											}

											echo $content;
											if($source_url != ""){
												$str = '<p><strong>&rarr; Source: <a href="'.$source_url.'">'.$source_url.'</a></strong></p>';
												echo $str;
											}
											?>
											<br/><? edit_post_link('Edit this entry', '', ''); ?>
										</article>
										<? } else { ?>
										<article>
											<? $length = 140; $content = strip_tags(get_the_content()); $shortContent = substr($content, 0, $length); if (strlen($content) > $length) $shortContent .= "..."; echo $shortContent; ?><span class="yellowArrow">&nbsp;</span>
										</article>
										<p class="dateAndCats">
											<?php the_time('F jS, Y')?>| <?php $cat = get_the_category(); for ($i = 0; $i < count($cat); $i++) { ?><? if ($i) echo ", "; ?><a href="<?=get_category_link($cat[$i]->cat_ID);?>"><?= $cat[$i]->cat_name; ?></a>
											<? } ?>
										</p>
										<? } ?>
									</div>
								</article>
								<?php comments_template(); ?>
								<? endwhile; ?>
								<nav class="grid_9 alpha">
									<?php next_posts_link('&larr; Older Posts')?><?php previous_posts_link('Newer Posts &rarr;')?>
								</nav>
								<?php else : ?>
								<h2 class="center">No Results</h2>
								<?php endif; ?>
							</section>
							<section id="sideBar" class="grid_3 omega">
								<nav id="catList">
									<h3>CATEGORIES</h3>
									<ul>
										<?php wp_list_categories('title_li='); ?>
									</ul>
								</nav>
								<nav id="linkList">
									<h3>LINKS</h3>
									<ul>
										<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
									</ul>
								</nav>
							</section>
						</section>
					</div>
				</div>
			</div>
		</div>
		<footer id="footer">
			<div id="footerWrapper" class="container_12">
				<section class="grid_8">
					Copyright &copy; 2010, Goksel Eryigit  | <a href="http://validator.w3.org/check?uri=http://www.geryit.com<?=$_SERVER["REQUEST_URI"];?>">HTML5</a>
					&amp; <a href="http://jigsaw.w3.org/css-validator/check/referer/?profile=css3">CSS 3</a>
					| Designed by <a href="http://www.thecoreunits.com">The Core Units</a>
					| Proudly powered by <a href="http://www.wordpress.org">WordPress</a>.
					<p>
						<a href="http://www.w3.org/html/logo/">
							<img src="//d2g83xhm015jzr.cloudfront.net/images/html5-logo.png" width="85" height="38" alt="HTML5 Powered with CSS3 / Styling and Semantics" title="HTML5 Powered with CSS3 / Styling, and Semantics">
						</a>
					</p>
				</section>
				<aside class="grid_4">
					<a id="rss" href="http://feeds.feedburner.com/goksel">Subscribe to Rss</a>
				</aside>
			</div>
		</footer>

		<?php wp_footer(); ?>


		<script type="text/javascript">
			var sd = "<?php bloginfo('stylesheet_directory'); ?>";
		</script>

        <!-- W3TC-include-js -->
        <!-- W3TC-include-css -->
	</body>
</html>

