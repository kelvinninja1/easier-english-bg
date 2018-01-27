<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <![endif]-->
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/css/style.min.css?v=1.6.0" />

    <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/img/favicons/favicon.ico">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('template_url'); ?>/img/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_url'); ?>/img/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_url'); ?>/img/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_url'); ?>/img/favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php bloginfo('template_url'); ?>/img/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('template_url'); ?>/img/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('template_url'); ?>/img/favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_url'); ?>/img/favicons/apple-touch-icon-152x152.png">
    <link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/img/favicons/favicon-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/img/favicons/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/img/favicons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/img/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/img/favicons/favicon-32x32.png" sizes="32x32">
    <meta name="msapplication-TileColor" content="#603cba">
    <meta name="msapplication-TileImage" content="<?php bloginfo('template_url'); ?>/img/favicons/mstile-144x144.png">
    <meta name="msapplication-config" content="<?php bloginfo('template_url'); ?>/img/favicons/browserconfig.xml">

    <!--[if lt IE 9]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="//css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <?php wp_head(); ?>

    <script>
        //Google Analytics:
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-21569700-10', 'easierenglish.bg');
        ga('send', 'pageview');
    </script>

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
        n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
        document,'script','https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1823032834392797'); // Insert your pixel ID here.
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1823032834392797&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
</head>

<body itemscope itemtype="http://schema.org/Organization" <?php body_class(); ?>>
<div id="fb-root"></div>

<header id="masthead" class="page_header">

    <div class="page_wrapper group">

        <div class="logo alignleft">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                <img src="<?php bloginfo('template_url'); ?>/img/EasierEnglish.BG.png" itemprop="logo" width="82" height="62" alt="EasierEnglish.BG" />
            </a>
        </div>

        <nav id="site-navigation" class="page_nav alignleft">
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
        </nav>

        <div class="social_bar alignleft">
            <a href="http://www.linkedin.com/company/5020387" target="_blank" class="socialIcon" title="LinkedIn Страница">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
                    <path d="M150.65,100.682c0,27.992-22.508,50.683-50.273,50.683c-27.765,0-50.273-22.691-50.273-50.683C50.104,72.691,72.612,50,100.377,50C128.143,50,150.65,72.691,150.65,100.682z M143.294,187.333H58.277V462h85.017V187.333zM279.195,187.333h-81.541V462h81.541c0,0,0-101.877,0-144.181c0-38.624,17.779-61.615,51.807-61.615c31.268,0,46.289,22.071,46.289,61.615c0,39.545,0,144.181,0,144.181h84.605c0,0,0-100.344,0-173.915s-41.689-109.131-99.934-109.131s-82.768,45.369-82.768,45.369V187.333z"/>
                </svg>
            </a>
            <a href="https://www.facebook.com/easierenglish.bg" target="_blank" class="socialIcon" title="Facebook Фен Страница">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
                    <path d="M204.067,184.692h-43.144v70.426h43.144V462h82.965V254.238h57.882l6.162-69.546h-64.044c0,0,0-25.97,0-39.615c0-16.398,3.302-22.89,19.147-22.89c12.766,0,44.896,0,44.896,0V50c0,0-47.326,0-57.441,0c-61.734,0-89.567,27.179-89.567,79.231C204.067,174.566,204.067,184.692,204.067,184.692z"/>
                </svg>
            </a>
        </div>

    </div>

</header>

<div class="background">
    <div class="headings page_wrapper">
        <h2 itemprop="description">Докъде ще стигнат твоите контакти и знания догодина,<br />
        ако владееш английски отлично?</h2>
        <p class="big-p">Обучавай се. Безплатно.</p>
        <br />
        <form id="searchform" role="search" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>">
            <input type="text" value="" maxlength="100" name="s" id="s" placeholder="... потърси урок" />
        </form>
    </div>
</div>

<div id="page" class="hfeed site">
    <div id="main" class="wrapper">
