<?
include "blog/wp-config.php";
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$latest_work_id = 31;
?>

<!doctype html>
<html lang="en" class="site">
<head>
    <?
    $page = $_GET["page"];

    if ($page == "home") {
        $title = "Goksel Eryigit - Front-end Developer &amp;raquo; Home";
        $des = "I'm a Front-End and Web Application Developer based in Turkey";
    } else if ($page == "works") {
        $title = "Goksel Eryigit - Front-end Developer &amp;raquo; Works";
        $des = "Some of the clients I worked with :Activision, Bridgestone, Starbucks, Honda Turkey, Varyap, Boyner, Beymen, Avea, Hurriyet";
    } else if ($page == "code-samples") {
        $title = "Goksel Eryigit - Front-end Developer &amp;raquo; Code Samples";
        $des = "My Html5, CSS3 and WebGL Code Samples";
    } else if ($page == "info") {
        $title = "Goksel Eryigit - Front-end Developer &amp;raquo; Info";
        $des = "I'm 27 years old, living and working in Turkey. I currently work as a freelance developer for three months so feel free to chat with me on +90 5325819818";
    } else if ($page == "contact") {
        $title = "Goksel Eryigit - Front-end Developer &amp;raquo; Contact";
        $des = "Get in touch with me on; Phone: +90 5325819818. You want to say hello ?";
    } else {
        $title = "Goksel Eryigit - Front-end Developer";
        $des = "Goksel Eryigit is a Front-End and Web Application Developer based in Turkey.";
    }

    if ($_GET["tag"]) {
        $tag = $_GET["tag"];
        $title = "Works filtered by tag: " . $tag;
        $des = "Works filtered by tag: " . $tag;
    }

    $pages_allowed = array("home", "works", "code-samples", "info", "thanks", "contact");

    if (!in_array($page, $pages_allowed))
        $page = "home";
    if (!$page)
        $page = "home";


    ?>

    <meta charset="utf-8">
    <meta name="p:domain_verify" content="e068c57b2416a913a831f831e4f6943a"/>
    <meta name="viewport"
          content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title><?= $title; ?></title>
    <meta name="description" content="<?= $des; ?>"/>
    <meta name="author" content="Goksel Eryigit">

    <link rel="shortcut icon" href="//d2g83xhm015jzr.cloudfront.net/favicon.ico"
          type="image/x-icon"/>
    <link rel="apple-touch-icon" href="//d2g83xhm015jzr.cloudfront.net/images/share.gif">
    <link rel="image_src" href="//d2g83xhm015jzr.cloudfront.net/images/share.gif"/>

    <link rel="stylesheet" type="text/css" href="dist/styles.min.css?v=2374"/>

    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-TX79MN');</script>
    <!-- End Google Tag Manager -->

</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TX79MN"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>

<!-- End Google Tag Manager (noscript) -->
<iframe id="getSite" src="/loading.php"></iframe>
<div id="content">
    <div id="light">
        <div id="contentWrapper" class="container_12">
            <header id="contentHeader" class="grid_12">
                <a href="/" id="logo" class="grid_5 alpha rotating">Goksel Eryigit / FRONT-END &amp;amp;
                    WEB APPLICATION DEVELOPER</a>
                <nav id="menu" class="grid_6">
                    <ul>
                        <li<? if ($page == "works") echo " class='current' "; ?>>
                            <a href="/works" id="menuWorks" class="rotating">WORK</a>
                        </li>
                        <li<? if ($page == "code-samples") echo " class='current' "; ?>>
                            <a href="/code-samples" id="menuCodeSamples" class="rotating">CODE
                                SAMPLES</a>
                        </li>
                        <li<? if ($page == "info") echo " class='current' "; ?>>
                            <a href="/info" id="menuInfo" class="rotating">INFO</a>
                        </li>
                        <li>
                            <a href="/blog/" id="menuBlog" class="rotating">BLOG</a>
                        </li>
                        <li<? if ($page == "contact") echo " class='current' "; ?>>
                            <a href="/contact" id="menuContact" class="rotating">CONTACT</a>
                        </li>
                    </ul>
                </nav>
                <section id="networks" class="grid_1 omega">
                    <a href="http://www.linkedin.com/in/geryit" class="rotating"
                       id="n1">LinkedIn</a>
                    <a href="http://www.facebook.com/goksel.eryigit" class="rotating" id="n2">Facebook</a>
                    <a href="http://twitter.com/geryit" class="rotating" id="n3">Twitter</a>
                </section>
            </header>
            <? include $page . ".php"; ?>
        </div>
    </div>
</div>
<footer id="footer">
    <div id="footerWrapper" class="container_12">
        <section class="grid_8">
            Copyright &copy; 2010, Goksel Eryigit | <a
                href="http://validator.w3.org/check?uri=http://www.geryit.com<?= $_SERVER["REQUEST_URI"]; ?>">HTML5</a>
            &amp; <a
                href="http://jigsaw.w3.org/css-validator/validator?uri=http://www.geryit.com<?= $_SERVER["REQUEST_URI"]; ?>&amp;profile=css3&amp;usermedium=all&amp;warning=1&amp;lang=en">CSS
                3</a>
            | Designed by <a href="http://draftsman.co/">draftsman</a>
            | Proudly powered by <a href="http://www.wordpress.org">WordPress</a>
            .
        </section>
        <aside class="grid_4">
            <a id="rss" href="http://feeds.feedburner.com/goksel">Subscribe to Rss</a>
        </aside>
    </div>
</footer>


<?
if ($_GET["tag"]) {
    $tag = $_GET["tag"];

    ?>
    <script>
        $(function () {
            geryit.highlight("<?=$tag;?>");
        })
    </script>
<? } ?>



<script src="dist/scripts.min.js?v=2374"></script>
</body>
</html>


