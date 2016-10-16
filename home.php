<div id="home" class="grid_12">
	<h1>
		<span>Hello there...</span>
	</h1>
	<section id="shortInfo">
		<h2 class="text1">
			I am a 33 year old Front-end Developer from Turkey
			<? /*of <a class="ud-green" href="http://twitter.com/udemy">@udemy</a><? */?>
			and member of the <a href="https://twitter.com/awwwards"
				class="aw-orange">@awwwards</a> Jury . Follow me on <a href="http://twitter.com/geryit" class="tw-blue">@geryit</a>
		</h2>
		<div class="text2">
			<h3>Some of the clients I worked with :</h3>
			<article>
				<span id="q1">&nbsp;</span> <a href="/works/activision">Activision</a>,
				<a href="/works/bridgestone">Bridgestone</a>, <a
					href="/works/starbuck">Starbucks</a>, Honda Turkey, Varyap, Boyner,
				Beymen, Avea, Hurriyet &amp; <a href="/works" title="Click for more">more</a>
				<span id="q2">&nbsp;</span>
			</article>
		</div>

		<?
		$result = $conn->query("SELECT * FROM ".$wpdb->prefix."works where wid=$latest_work_id");
		$r = $result->fetch_assoc();

		?>
		<div id="latest-work">
			<h4>Latest Work</h4>
			<div class="container clearfix">
				<figure>
					<div id="cycle_slide">
						<?
						if ($handle = opendir('images/works-big/'.$latest_work_id)) {
                        while (false !== ($file = readdir($handle))) {
                        if ($file != "." && $file != ".." && (strpos($file, "jpg") || strpos($file, "png"))>0) {
                        $files[]=$file;
                        }
                        }
                        closedir($handle);
                        }
                        sort($files);

                        for($i=0;$i
                        <count($files);$i++){
                        ?>
						<img alt="latest-work-<?=$latest_work_id;?>"
							src="//d2g83xhm015jzr.cloudfront.net/images/works-big/<?=$latest_work_id;?>/<?=$files[$i];?>" />
						<? }?>
					</div>
					<p>
						<span><?=$r['title'];?>
						</span> <a href="<?=$r['url'];?>" target="_blank">Launch Project</a>
					</p>
				</figure>
				<div id="latest-work-details">
					<div class="title">DESCRIPTION</div>
					<p class="desc">
						<?=$r['des'];?>
					</p>
					<div class="title">RELATED TAGS</div>
					<p class="tags"><? $tags=explode(",",$r['tags']);for($i=0;$i < count($tags);$i++){$tag=trim($tags[$i]);if($i != 0) echo ", ";?><a href="/works/<?=urlencode(strtolower($tag)); ?>" title="Click to filter by '<?=ucwords($tag);?>' tag" ><? echo $tag; ?></a><? } ?></p>
				</div>
			</div>
		</div>
	</section>
	<section id="twitterAndBlog">
		<section id="twitterPost" class="grid_6 prefix_1 alpha">
			<h3>
				FROM <span>TWITTER</span>
			</h3>
			<article class="grid_5 alpha omega">
				<?php
				
				require_once('TwitterAPIExchange.php');
				
				$settings = array(
				    'oauth_access_token' => "15278684-sIVZzur9xJ6xfcNXcqColoZu7cmDnfeaza2csRBin",
				    'oauth_access_token_secret' => "1BOQkTA36kgAgsvFoi2LvI7evPBf8HfXBd94NtV3U",
				    'consumer_key' => "GbSDzIxjzIfSZYLXwYmgRw",
				    'consumer_secret' => "eh1kAwkpPyXHtLRHQ7k22mXd4iQVYlxvqueR2PI2sYc",
				);
				
				$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
				$getfield = '?screen_name=geryit&count=3';
				$requestMethod = 'GET';
				
				$twitter = new TwitterAPIExchange($settings);
			
				$string = json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest(),$assoc = TRUE);



                function linkify($value, $protocols = array('http', 'mail'), array $attributes = array())
                {
                    // Link attributes
                    $attr = '';
                    foreach ($attributes as $key => $val) {
                        $attr = ' ' . $key . '="' . htmlentities($val) . '"';
                    }

                    $links = array();

                    // Extract existing links and tags
                    $value = preg_replace_callback('~(<a .*?>.*?</a>|<.*?>)~i', function ($match) use (&$links) { return '<' . array_push($links, $match[1]) . '>'; }, $value);

                    // Extract text links for each protocol
                    foreach ((array)$protocols as $protocol) {
                        switch ($protocol) {
                            case 'http':
                            case 'https':   $value = preg_replace_callback('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) { if ($match[1]) $protocol = $match[1]; $link = $match[2] ?: $match[3]; return '<' . array_push($links, "<a $attr href=\"$protocol://$link\">$link</a>") . '>'; }, $value); break;
                            case 'mail':    $value = preg_replace_callback('~([^\s<]+?@[^\s<]+?\.[^\s<]+)(?<![\.,:])~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"mailto:{$match[1]}\">{$match[1]}</a>") . '>'; }, $value); break;
                            case 'twitter': $value = preg_replace_callback('~(?<!\w)[@#](\w++)~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"https://twitter.com/" . ($match[0][0] == '@' ? '' : 'search/%23') . $match[1]  . "\">{$match[0]}</a>") . '>'; }, $value); break;
                            default:        $value = preg_replace_callback('~' . preg_quote($protocol, '~') . '://([^\s<]+?)(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) { return '<' . array_push($links, "<a $attr href=\"$protocol://{$match[1]}\">{$match[1]}</a>") . '>'; }, $value); break;
                        }
                    }

                    // Insert all link
                    return preg_replace_callback('/<(\d+)>/', function ($match) use (&$links) { return $links[$match[1] - 1]; }, $value);
                }
				?>

				<ul> 
					<?
					foreach($string as $items)
					    {
					        ?>
					        <li><?=linkify($items['text'])?>
					        </li>
					        <?
					        
					    }
					?>
				</ul>
				
				
				
			</article>
		</section>
		<aside id="blogPosts" class="grid_4 prefix_1 omega">
			<h3>
				FROM THE <span>BLOG</span>
			</h3>
			<article>Loading latest posts...</article>
		</aside>
	</section>
</div>
