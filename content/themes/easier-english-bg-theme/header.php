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

	<link href='//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%26subset=latin,cyrillic' rel='stylesheet' />

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
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-21569700-10', 'easierenglish.bg');
		ga('send', 'pageview');
	</script>
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
			<a href="https://www.facebook.com/easierenglish.bg" target="_blank" class="socialIcon" title="Facebook Фен Страница">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
					<path d="M204.067,184.692h-43.144v70.426h43.144V462h82.965V254.238h57.882l6.162-69.546h-64.044c0,0,0-25.97,0-39.615c0-16.398,3.302-22.89,19.147-22.89c12.766,0,44.896,0,44.896,0V50c0,0-47.326,0-57.441,0c-61.734,0-89.567,27.179-89.567,79.231C204.067,174.566,204.067,184.692,204.067,184.692z"/>
				</svg>
			</a>
			<a href="http://www.linkedin.com/company/5020387" target="_blank" class="socialIcon" title="LinkedIn Страница">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
					<path d="M150.65,100.682c0,27.992-22.508,50.683-50.273,50.683c-27.765,0-50.273-22.691-50.273-50.683C50.104,72.691,72.612,50,100.377,50C128.143,50,150.65,72.691,150.65,100.682z M143.294,187.333H58.277V462h85.017V187.333zM279.195,187.333h-81.541V462h81.541c0,0,0-101.877,0-144.181c0-38.624,17.779-61.615,51.807-61.615c31.268,0,46.289,22.071,46.289,61.615c0,39.545,0,144.181,0,144.181h84.605c0,0,0-100.344,0-173.915s-41.689-109.131-99.934-109.131s-82.768,45.369-82.768,45.369V187.333z"/>
				</svg>
			</a>
			<a href="https://plus.google.com/117848531738148076134" rel="publisher" target="_blank" class="socialIcon" title="Google+ Страница">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
					<g>
						<path d="M462,141.347h-54.621v54.622h-27.311v-54.622h-54.622v-27.311h54.622V59.416h27.311v54.621H462V141.347z M307.583,367.26c0,40.943-37.384,90.787-131.434,90.787C107.365,458.047,50,428.379,50,378.478c0-38.514,24.383-88.511,138.323-88.511c-16.922-13.792-21.075-33.077-10.733-53.959c-66.714,0-100.879-39.222-100.879-89.023c0-48.731,36.242-93.032,110.15-93.032c18.66,0,118.398,0,118.398,0l-26.457,27.77h-31.079c21.925,12.562,33.586,38.433,33.586,66.949c0,26.175-14.413,47.375-34.983,63.279c-36.503,28.222-27.158,43.98,11.087,71.872C295.121,312.074,307.583,333.882,307.583,367.26z M233.738,150.453c-5.506-41.905-32.806-76.284-64.704-77.243c-31.909-0.949-53.309,31.119-47.798,73.035c5.509,41.905,35.834,71.178,67.749,72.139C220.882,219.333,239.242,192.363,233.738,150.453z M266.631,371.463c0-34.466-31.441-67.317-84.192-67.317c-47.542-0.523-87.832,30.042-87.832,65.471c0,36.154,34.335,66.25,81.879,66.25C237.267,435.866,266.631,407.617,266.631,371.463z"/>
					</g>
				</svg>
			</a>
			<a href="https://twitter.com/EasierEnglishBG" target="_blank" class="socialIcon" title="Twitter Страница">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="20px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
					<path d="M462,128.223c-15.158,6.724-31.449,11.269-48.547,13.31c17.449-10.461,30.854-27.025,37.164-46.764c-16.333,9.687-34.422,16.721-53.676,20.511c-15.418-16.428-37.386-26.691-61.698-26.691c-54.56,0-94.668,50.916-82.337,103.787c-70.25-3.524-132.534-37.177-174.223-88.314c-22.142,37.983-11.485,87.691,26.158,112.85c-13.854-0.438-26.891-4.241-38.285-10.574c-0.917,39.162,27.146,75.781,67.795,83.949c-11.896,3.237-24.926,3.978-38.17,1.447c10.754,33.58,41.972,58.018,78.96,58.699C139.604,378.282,94.846,390.721,50,385.436c37.406,23.982,81.837,37.977,129.571,37.977c156.932,0,245.595-132.551,240.251-251.435C436.339,160.061,450.668,145.174,462,128.223z"/>
				</svg>
			</a>
		</div>

	</div>
		
</header>

<div class="background">
	<div class="headings page_wrapper">
		<h2 itemprop="description">Докъде ще стигнат твоите контакти и знания догодина,<br />
		ако владееш английски отлично?</h2>
		<p>Обучавай се. Безплатно.</p>
	</div>
	
	<div id="breadcrumbs_holder" class="breadcrumbs">
		<div class="page_wrapper">
			<?php
				if( !is_front_page() && function_exists('bcn_display') ) {
					bcn_display();
				} else {
					//echo '<span itemprop="name">EasierEnglish.BG</span>';
				}
			?>
		</div>
	</div>
	
</div>

<div id="page" class="hfeed site">
	<div id="main" class="wrapper">

