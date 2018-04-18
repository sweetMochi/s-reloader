<?

	require("libs/Common.func.php");
	require("libs/routes.php");

	$GLOBALS["path_static"] = dirname(__FILE__) . "/static";
	$GLOBALS["path_resource"] = dirname(__FILE__) . "/resource";
	$GLOBALS["url_static"] = "//" . $_SERVER['SERVER_NAME'] . "/resource";

	$GLOBALS["resource"] = array(
		"aos_css" => array(
			"base" => "static",
			"path" => "/js/aos/2.1.1/min.css",
		),
		"index_css" => array(
			"path" => "/css/index.css",
			"preload" => true,
		),
		"page_css" => array(
			"path" => "/css/page.css",
		),
		"aos" => array(
			"base" => "static",
			"path" => "/js/aos/2.1.1/min.js",
		),
		"jquery" => array(
			"base" => "static",
			"path" => "/js/jquery/3.1.0.js",
		),
		"slides" => array(
			"base" => "static",
			"path" => "/js/jquery/plugin/slides/3.0.4.js",
		),
		"index" => array(
			"path" => "/js/index.js",
		),
		"font_awesome" => array(
			"type" => "link",
			"path" => "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css",
		),
	);
?>