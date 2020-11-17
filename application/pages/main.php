<?php
	$version_number = '20200729'; // to by-pass cache (needs a better system for bower resources)

	// include other files
	include_once DIR_CORE.'lib.php';
	include_once DIR_CORE.'page.php';
	include_once DIR_CORE.'detectmobilebrowser.php';

	// pre-computations
	$jquery_folder = browser_only_supports_jquery1() ? 'jquery-old' : 'jquery';
	$page = new Page($version_number);
	$page->css->addBower('bootstrap/dist/css/bootstrap');
    $page->css->add('styles');
	$page->js->addBower("{$jquery_folder}/dist/jquery", 'bootstrap/dist/js/bootstrap', 'angular/angular', 'angular-route/angular-route', 'jquery-ui/jquery-ui'); //, 'lodash/dist/lodash.core');
	$page->js->add('lib/jquery.ui.touch-punch', 'prototypes-extensions', 'app');
	if( preg_match("/IEMobile\/10\.0/", $_SERVER['HTTP_USER_AGENT'], $matches) )
		$page->js->add('lib/ie10-viewport-bug-workaround');

	header('Content-Type: text/html; charset=UTF-8');
?><!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
	<title>Sylvia Prokopowicz Luchez</title>
	<link rel="SHORTCUT ICON" href="<?php echo $page->image('favicon.png'); ?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge;" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	<meta name="keywords" content="artist, art, Chicago artist, Chicago, Polish-American, acrylic painting, pencil drawing, flowers, paintings of flowers, still life, oil painting, contemporary artist, painter, artwork, Sylvia, Luchez, Prokopowicz"/>
	<meta name="description" content="Polish-American contemporary artist in Chicago"/>
	<meta name="author" content="Lionel Luchez" />
	<meta name="robots" content="index,follow"/>
	<meta name="image" property="og:image" content="assets/images/home_page/iteration_623x621.jpg" />
<?php
	$page->write_header();
?>
</head>
<body ng-app="myApp">
	<nav class="navbar _navbar-fixed-top">
		<div class="container container-fluid">
			<!-- Menu Top bar -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-top-menu" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a href="#/home" class="navbar-brand">
					<span class="navbar-text hidden-xs">Sylvia Prokopowicz Luchez</span>
					<span class="navbar-text hidden-sm hidden-md hidden-lg hidden-print">Sylvia Luchez</span>
				</a>
			</div>
			<!-- Foldable menu -->
			<div class="collapse navbar-collapse" id="navbar-top-menu">
				<ul class="nav navbar-nav">
					<li><a href="#/bio">Bio</a></li>
					<li><a href="#/statement">Artist statement</a></li>
					<li><a href="#/projects">Projects</a></li>
					<li><a href="#/contact">Contact</a></li>
					<li><a href="https://artbysylvia.weebly.com/" target="_blank">Art By Sylvia</a></li>
					<li><a href="https://www.etsy.com/shop/sylvialuchezart" target="_blank">Shop</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="content-holder container">
		<ng-view />
	</div>

	<div class="footer">
	</div>
</body>
</html>