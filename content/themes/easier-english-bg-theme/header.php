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

    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%26subset=latin,cyrillic" />
    <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/css/style.min.css" />

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
        // Rollbar Tracking code
        /*
        var _rollbarConfig = {
            accessToken: "23be9995c0d14364b48cb73ba7e4f392",
            captureUncaught: true,
            payload: {
                environment: "production"
            }
        };
        !function(r){function o(e){if(t[e])return t[e].exports;var n=t[e]={exports:{},id:e,loaded:!1};return r[e].call(n.exports,n,n.exports,o),n.loaded=!0,n.exports}var t={};return o.m=r,o.c=t,o.p="",o(0)}([function(r,o,t){"use strict";var e=t(1).Rollbar,n=t(2),i="https://d37gvrvc0wt4s1.cloudfront.net/js/v1.7/rollbar.min.js";_rollbarConfig.rollbarJsUrl=_rollbarConfig.rollbarJsUrl||i;var a=e.init(window,_rollbarConfig),l=n(a,_rollbarConfig);a.loadFull(window,document,!1,_rollbarConfig,l)},function(r,o,t){"use strict";function e(r){this.shimId=++s,this.notifier=null,this.parentShim=r,this.logger=function(){},window.console&&void 0===window.console.shimId&&(this.logger=window.console.log)}function n(r,o,t){window._rollbarWrappedError&&(t[4]||(t[4]=window._rollbarWrappedError),t[5]||(t[5]=window._rollbarWrappedError._rollbarContext),window._rollbarWrappedError=null),r.uncaughtError.apply(r,t),o&&o.apply(window,t)}function i(r){var o=e;return l(function(){if(this.notifier)return this.notifier[r].apply(this.notifier,arguments);var t=this,e="scope"===r;e&&(t=new o(this));var n=Array.prototype.slice.call(arguments,0),i={shim:t,method:r,args:n,ts:new Date};return window._rollbarShimQueue.push(i),e?t:void 0})}function a(r,o){if(o.hasOwnProperty&&o.hasOwnProperty("addEventListener")){var t=o.addEventListener;o.addEventListener=function(o,e,n){t.call(this,o,r.wrap(e),n)};var e=o.removeEventListener;o.removeEventListener=function(r,o,t){e.call(this,r,o&&o._wrapped?o._wrapped:o,t)}}}function l(r,o){return o=o||window.console.log||function(){},function(){try{return r.apply(this,arguments)}catch(t){o("Rollbar internal error:",t)}}}var s=0;e.init=function(r,o){var t=o.globalAlias||"Rollbar";if("object"==typeof r[t])return r[t];r._rollbarShimQueue=[],r._rollbarWrappedError=null,o=o||{};var i=new e;return l(function(){if(i.configure(o),o.captureUncaught){var e=r.onerror;r.onerror=function(){var r=Array.prototype.slice.call(arguments,0);n(i,e,r)};var l,s,u="EventTarget,Window,Node,ApplicationCache,AudioTrackList,ChannelMergerNode,CryptoOperation,EventSource,FileReader,HTMLUnknownElement,IDBDatabase,IDBRequest,IDBTransaction,KeyOperation,MediaController,MessagePort,ModalWindow,Notification,SVGElementInstance,Screen,TextTrack,TextTrackCue,TextTrackList,WebSocket,WebSocketWorker,Worker,XMLHttpRequest,XMLHttpRequestEventTarget,XMLHttpRequestUpload".split(",");for(l=0;l<u.length;++l)s=u[l],r[s]&&r[s].prototype&&a(i,r[s].prototype)}return r[t]=i,i},i.logger)()},e.prototype.loadFull=function(r,o,t,e,n){var i=l(function(){var r=o.createElement("script"),n=o.getElementsByTagName("script")[0];r.src=e.rollbarJsUrl,r.async=!t,r.onload=a,n.parentNode.insertBefore(r,n)},this.logger),a=l(function(){var o;if(void 0===r._rollbarPayloadQueue){var t,e,i,a;for(o=new Error("rollbar.js did not load");t=r._rollbarShimQueue.shift();)for(i=t.args,a=0;a<i.length;++a)if(e=i[a],"function"==typeof e){e(o);break}}"function"==typeof n&&n(o)},this.logger);l(function(){t?i():r.addEventListener?r.addEventListener("load",i,!1):r.attachEvent("onload",i)},this.logger)()},e.prototype.wrap=function(r,o){try{var t;if(t="function"==typeof o?o:function(){return o||{}},"function"!=typeof r)return r;if(r._isWrap)return r;if(!r._wrapped){r._wrapped=function(){try{return r.apply(this,arguments)}catch(o){throw o._rollbarContext=t()||{},o._rollbarContext._wrappedSource=r.toString(),window._rollbarWrappedError=o,o}},r._wrapped._isWrap=!0;for(var e in r)r.hasOwnProperty(e)&&(r._wrapped[e]=r[e])}return r._wrapped}catch(n){return r}};for(var u="log,debug,info,warn,warning,error,critical,global,configure,scope,uncaughtError".split(","),p=0;p<u.length;++p)e.prototype[u[p]]=i(u[p]);r.exports={Rollbar:e,_rollbarWindowOnError:n}},function(r,o,t){"use strict";r.exports=function(r,o){return function(t){if(!t&&!window._rollbarInitialized){var e=window.RollbarNotifier,n=o||{},i=n.globalAlias||"Rollbar",a=window.Rollbar.init(n,r);a._processShimQueue(window._rollbarShimQueue||[]),window[i]=a,window._rollbarInitialized=!0,e.processPayloads()}}}}]);
        */

        //Google Analytics:
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-21569700-10', 'easierenglish.bg');
        ga('send', 'pageview');

        // Hotjar Tracking Code
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:113484,hjsv:5};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
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
