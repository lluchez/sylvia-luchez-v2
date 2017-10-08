<?php
	error_reporting(E_ALL); // & ~E_NOTICE);

	// Define paths
	define('DIR_ROOT', '');
		define('DIR_APP',    DIR_ROOT.'application/');
			define('DIR_CONFIG', DIR_APP.'config/');
		define('DIR_ASSETS', DIR_ROOT.'assets/');
			define('DIR_CSS',   DIR_ASSETS.'css/');
			define('DIR_FONTS', DIR_ASSETS.'fonts/');
			define('DIR_IMG',   DIR_ASSETS.'images/');
			define('DIR_JS',    DIR_ASSETS.'js/');
			define('DIR_VIEWS', DIR_ASSETS.'views/');
			define('DIR_BOWER', DIR_ASSETS.'bower_components/');
		define('DIR_SYSTEM', DIR_ROOT.'system/');
			define('DIR_CORE',   DIR_SYSTEM.'core/');
			define('DIR_LIB',   DIR_SYSTEM.'lib/');
	
	
	// include the main file
	include DIR_APP.'router.php';
?>