<!DOCTYPE HTML>
<?php
/* * *
 * PHTML5 Photo Gallery
 * @version 1.0-102021
 * @author Rafael Amorim <github.com/rafaelmamorim>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * 
 * Multiverse by HTML5 UP
 * html5up.net | @ajlkn
 * Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
 * Icons made by Freepik from www.flaticon.com
 */

require_once("config.php");
require_once("label.php");
require_once("list.php");

$lang = substr((isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : ''), 0, 2);
$acceptLang = $config['acceptLang'];
$lang = in_array($lang, $acceptLang) ? $lang : $config['default_language'];

if ($config['reverse_order']) {
    $image = array_reverse($image, true);
}
if ($config['random_order']) {
    shuffle($image);
}
?>
<html>
    <head>
        <title><?php echo $label[$lang]['htmlTitle']; ?></title>
        <meta charset="utf-8" />

        <meta property="og:url" content="<?php echo $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="<?php echo $label[$lang]['htmlTitle']; ?>" />
        <meta property="og:image" content="<?php echo $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . $config['social_image']; ?>" />
        <meta property="og:image:url" content="<?php echo "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . $config['social_image']; ?>" />
        <meta property="og:image:secure_url" content="<?php echo $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . $config['social_image']; ?>" />
        <meta property="og:image:type" content="<?php echo $config['social_image_type']; ?>">
        <meta property="og:image:width" content="<?php echo $config['social_image_width']; ?>">
        <meta property="og:image:height" content="<?php echo $config['social_image_height']; ?>">
        <meta property="og:description" content="<?php echo strip_tags($label[$lang]['SocialMediaText']); ?>" />
        <meta property="fb:app_id" content="<?php echo $config['fb_app_ip']; ?>"/>
        <meta property="og:locale content="<?php echo $config['fbDefaultLang']; ?>">
        <meta property="og:site_name" content="<?php echo $label[$lang]['siteTitle']; ?>" />
        <?php
        foreach ($config['fbAlternateLang'] as $value) {
            echo "<meta property=\"og:locale:alternate\" content=\"" . $value . "\">\n";
        }
        ?>

        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:title" content="<?php echo $label[$lang]['htmlTitle']; ?>" />
        <meta property="twitter:description" content="<?php echo strip_tags($label[$lang]['SocialMediaText']); ?>" />
        <meta property="twitter:image" content="<?php echo $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . $config['social_image']; ?>" />

        <link rel="shortcut icon" href="<?php echo $config['favicon']; ?>" type="image/x-icon">
        <link rel="icon" href="<?php echo $config['favicon']; ?>" type="image/x-icon">

        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>

    </head>
    <body class="is-preload">

        <!-- Wrapper -->
        <div id="wrapper">

            <!-- Header -->
            <header id="header">
                <h1><a href="index.php"><?php echo $label[$lang]['siteTitle']; ?></a></h1>
                <nav>
                    <ul>
                        <li><a href="#footer" class="icon solid fa-info-circle"><?php echo $label[$lang]['about']; ?></a></li>
                    </ul>
                </nav>
            </header>

            <!-- Main -->
            <div id="main">

                <?php
                $photoNumber = 1;
                foreach ($image as $img) {
                    $lazyLoad = $photoNumber >= 15 ? " loading=\"lazy\" " : "";
                    echo "<article class=\"thumb\">\n";
                    echo "    <a href=\"images/fulls/" . $img['name'] . "\" class=\"image\"><img src=\"images/thumbs/" . $img['name'] . "\" " . $lazyLoad . "/></a>\n";
                    echo "    <h2>" . $img['title'] . "</h2>\n";
                    echo "    " . $img['text'] . "\n";
                    echo "</article>\n";
                    $photoNumber++;
                }
                ?>
            </div>

            <!-- Footer -->
            <footer id="footer" class="panel">
                <div class="inner split">
                    <div>
                        <section>
                            <h2>
                                <?php echo $label[$lang]['footerTitle']; ?>
                            </h2>
                            <?php echo $label[$lang]['footerText']; ?>
                        </section>
                        <section>
                            <h2><?php echo $label[$lang]['followMe']; ?></h2>
                            <ul class="icons">
                                <?php
                                if (!empty($config['facebook'])) {
                                    echo "    <li><a href=\"https://www.facebook.com/" . $config['facebook'] . "\" class=\"icon brands fa-facebook-f\"><span class=\"label\">Facebook</span></a></li>\n";
                                }
                                if (!empty($config['twitter'])) {
                                    echo "    <li><a href=\"http://www.twitter.com/" . $config['twitter'] . "\" class=\"icon brands fa-twitter\"><span class=\"label\">Twitter</span></a></li>\n";
                                }
                                if (!empty($config['linkedin'])) {
                                    echo "    <li><a href=\"http://www.linkedin.com/" . $config['linkedin'] . "\" class=\"icon brands fa-linkedin-in\"><span class=\"label\">LinkedIn</span></a></li>\n";
                                }
                                if (!empty($config['instagram'])) {
                                    echo "    <li><a href=\"https://www.instagram.com/" . $config['instagram'] . "\" class=\"icon brands fa-instagram\"><span class=\"label\">Instagram</span></a></li>\n";
                                }
                                if (!empty($config['github'])) {
                                    echo "    <li><a href=\"https://github.com/" . $config['github'] . "\" class=\"icon brands fa-github\"><span class=\"label\">GitHub</span></a></li>\n";
                                }
                                if (!empty($config['dribble'])) {
                                    echo "    <li><a href=\"https://dribble.com/" . $config['dribble'] . "\" class=\"icon brands fa-dribble\"><span class=\"label\">GitHub</span></a></li>\n";
                                }
                                ?>
                            </ul>
                        </section>
                        <p class="copyright">
                            &copy; <?php echo $label[$lang]['copyright']; ?>. Design: <a href="http://html5up.net">HTML5 UP</a>.
                        </p>
                    </div>
                    <div>
                        <section>
                            <h2><?php echo $label[$lang]['contactMe']; ?></h2>
                            <form method="post" action="sendform.php">
                                <div class="fields">
                                    <div class="field half" id="name-group">
                                        <input type="text" name="name" id="name" placeholder="<?php echo $label[$lang]['nameForm']; ?>" />
                                    </div>
                                    <div class="field half" id="email-group">
                                        <input type="email" name="email" id="email" placeholder="<?php echo $label[$lang]['emailForm']; ?>" />
                                    </div>
                                    <div class="field" id="message-group">
                                        <textarea name="message" id="message" rows="4" placeholder="<?php echo $label[$lang]['messageForm']; ?>"></textarea>
                                    </div>
                                </div>
                                <ul class="actions">
                                    <li><input type="submit" id="sendButton" name="sendButton" value="<?php echo $label[$lang]['sendButton']; ?>" class="primary" /></li>
                                    <li><input type="reset" id="clearButton" name="clearButton" value="clear" onClick="document.getElementById('sendButton').disabled = false;"/></li>
                                </ul>
                            </form>
                        </section>
                    </div>
                </div>
            </footer>

        </div>

        <!-- Scripts -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.poptrox.min.js"></script>
        <script src="assets/js/browser.min.js"></script>
        <script src="assets/js/breakpoints.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/form.js"></script>

    </body>
</html>