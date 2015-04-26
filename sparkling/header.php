<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package sparkling
 */
?><!doctype html>
	<!--[if !IE]>
	<html class="no-js non-ie" <?php language_attributes(); ?>> <![endif]-->
	<!--[if IE 7 ]>
	<html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
	<!--[if IE 8 ]>
	<html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
	<!--[if IE 9 ]>
	<html class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->
	<!--[if gt IE 9]><!-->
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- favicon -->

<?php if ( of_get_option( 'custom_favicon' ) ) { ?>
<link rel="icon" href="<?php echo of_get_option( 'custom_favicon' ); ?>" />
<?php } ?>

<!--[if IE]><?php if ( of_get_option( 'custom_favicon' ) ) { ?><link rel="shortcut icon" href="<?php echo of_get_option( 'custom_favicon' ); ?>" /><?php } ?><![endif]-->

<?php wp_head(); ?>
<style>
	.navbar.navbar-default {
	  background: url("<?php echo bloginfo( 'template_url' ); ?>/inc/img/asn_pattern_1_6x6.png") repeat scroll 0 0 #252525;
	}
	/*.post-inner-content.Video, .post-inner-content.News {
	  background: url("<?php echo bloginfo( 'template_url' ); ?>/inc/img/ASN_tile_bg_575x400.png") no-repeat center center #363636;
	}*/
	
	/*.post-inner-content.News {
	  background: url("<?php echo bloginfo( 'template_url' ); ?>/inc/img/ASN_placeholder_news_1000x525.jpg") repeat scroll 0 0 #252525;
	}
	.post-inner-content.Video {
	  background: url("<?php echo bloginfo( 'template_url' ); ?>/inc/img/ASN_placeholder_video_1000x525.jpg") repeat scroll 0 0 #252525;
	}*/
</style>

<!-- GOOGLE Ads Scripts Section -->
	<script type='text/javascript'>
		var googletag = googletag || {};
		googletag.cmd = googletag.cmd || [];
		(function() {
		var gads = document.createElement('script');
		gads.async = true;
		gads.type = 'text/javascript';
		var useSSL = 'https:' == document.location.protocol;
		gads.src = (useSSL ? 'https:' : 'http:') + 
		'//www.googletagservices.com/tag/js/gpt.js';
		var node = document.getElementsByTagName('script')[0];
		node.parentNode.insertBefore(gads, node);
		})();
	</script>
<?php 
  // Add Google tags per page
if(is_home()) {
?>
 	<!-- GOOGLE Ads Scripts Home Page -->
	<script type='text/javascript'>
		googletag.cmd.push(function() {
			googletag.defineSlot('/4756/ASPNET/Web/Home', [300, 250], 'div-gpt-ad-1424462716955-5').addService(googletag.companionAds()).addService(googletag.pubads());
			googletag.defineSlot('/4756/ASPNET/Web/Home', [300, 250], 'div-gpt-ad-1424462716955-6').addService(googletag.companionAds()).addService(googletag.pubads());
			googletag.pubads().enableSingleRequest();
			googletag.companionAds().setRefreshUnfilledSlots(true);
			googletag.pubads().enableVideoAds();
			googletag.enableServices();
		});
	</script>
<?php
} else {
?>
	<!-- GOOGLE Ads Scripts All Sub-Pages -->
	<script type='text/javascript'>
		googletag.cmd.push(function() {
			googletag.defineSlot('/4756/ASPNET/Web/News', [300, 250], 'div-gpt-ad-1423247213682-5').addService(googletag.companionAds()).addService(googletag.pubads());
			googletag.defineSlot('/4756/ASPNET/Web/News', [300, 250], 'div-gpt-ad-1423247213682-6').addService(googletag.companionAds()).addService(googletag.pubads());
			googletag.pubads().enableSingleRequest();
			googletag.companionAds().setRefreshUnfilledSlots(true);
			googletag.pubads().enableVideoAds();
			googletag.enableServices();
		});
	</script>
<?php
}
?>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="row">
					<div class="site-navigation-inner col-sm-12">
		        <div class="navbar-header">
		            <button type="button" class="btn navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		                <span class="sr-only">Toggle navigation</span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		            </button>

				<?php if( get_header_image() != '' ) : ?>
					<div id="logo" class="company-logo">
						<a href="<?php echo bloginfo( 'url' ); ?>">
							<img src="<?php header_image(); ?>"  height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo( 'name' ); ?>"/>
						</a>
					</div><!-- end of #logo -->
				<?php endif; // header image was removed ?>

				<?php if( !get_header_image() ) : ?>

					<div id="logo">
						<span class="site-name"><a class="navbar-brand" href="<?php echo bloginfo( 'url' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
					</div><!-- end of #logo -->

				<?php endif; // header image was removed (again) ?>

		        </div>
					<?php sparkling_header_menu(); ?>
					</div>
		    </div>
		  </div>
		</nav><!-- .site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">

			<div class="top-section">
				<?php sparkling_featured_slider(); ?>
				<?php sparkling_call_for_action(); ?>
			</div>

		<div class="container-fluid main-content-area">
			<div class="row">
				<?php if ( is_page('schedule')) { ?>
					<div id="content" class="main-content-inner col-lg-12">
				<?php } else { ?>
					<div id="content" class="main-content-inner col-sm-12 col-md-8 col-lg-9 <?php echo of_get_option( 'site_layout' ); ?>">
				<?php } ?>