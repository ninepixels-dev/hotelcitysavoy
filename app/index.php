<?php require_once 'np-controller/server/controller.php' ?>
<!DOCTYPE html>
<html lang="en" ng-app="ninepixels" class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $GLOBALS['page']->title ?></title>
        <meta name="description" content="<?php echo isset($GLOBALS['page']->description) ? $GLOBALS['page']->description : '' ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:title" content="<?php echo $GLOBALS['page']->title ?>" />
        <meta property="og:description" content="<?php echo isset($GLOBALS['page']->description) ? $GLOBALS['page']->description : '' ?>" />
        <meta property="og:image" content="<?php echo isset($GLOBALS['page']->image) ? $GLOBALS['page']->image->url : '/np-assets/images/logo.svg' ?>" />
        <link rel="icon" type="image/png" href="/np-assets/images/logo.svg" />
        <?php
        if (isset($_COOKIE['user']) || (isset($GLOBALS['page']->name) && $GLOBALS['page']->name === 'login-page')) {
            echo '<link rel="stylesheet" href="/np-assets/css/vendor.min.css">';
        }
        ?>
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400italic,700|Open+Sans:400,600,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/np-assets/css/app.min.css?v8">
    </head>
    <body>
        <?php
        if (isset($GLOBALS['page']->name) && $GLOBALS['page']->name === 'login-page') {
            echo '<div np-login></div>';
        } else {
            if (isset($_COOKIE['user']) && !$GLOBALS['WITHOUT_TOOLBAR']) {
                echo '<div class="site-controller" np-toolbar></div>';
                echo '<iframe id="editor-iframe" src="' . $_SERVER['REQUEST_URI'] . '?toolbar=false"></iframe>';
            } else {
                if (isset($GLOBALS['page']->show_header) || strrpos($GLOBALS['page']->name, 'news/') !== false) {
                    include_once 'np-templates/element_header.php';
                }

                include 'np-templates/' . $GLOBALS['page']->template;

                if (isset($GLOBALS['page']->show_footer) || strrpos($GLOBALS['page']->name, 'news/') !== false) {
                    include_once 'np-templates/element_footer.php';
                }
            }
        }
        ?>
        <script type="text/javascript" src="/np-assets/js/app.min.js"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqJI54945Uc8KkwucshJ_kos9Y7mHDuo4&callback=initMap"></script>
        <?php
        if (isset($_COOKIE['user']) || (isset($GLOBALS['page']->name) && $GLOBALS['page']->name === 'login-page')) {
            echo '<script type="text/javascript" src="/np-assets/js/vendor.min.js"></script>';
            echo '<script type="text/javascript" src="/np-assets/js/controller.min.js"></script>';
        }
        ?>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-91936040-1', 'auto');
            ga('send', 'pageview');
        </script>
    </body>
</html>