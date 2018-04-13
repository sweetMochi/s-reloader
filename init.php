<?

	require("libs/Common.func.php");
	require("libs/routes.php");

	$GLOBALS["path_static"] = dirname(__FILE__) . "/static";
	$GLOBALS["path_resource"] = dirname(__FILE__) . "/resource";
	$GLOBALS["url_static"] = "//" . $_SERVER['SERVER_NAME'] . "/resource";

	$GLOBALS["resource"] = array(
		"aos_css" => array(
			"type" => "require",
			"base" => "static",
			"path" => "/js/aos/2.1.1/min.css",
			"loading" => "later",
		),
		"index_css" => array(
			"type" => "require",
			"path" => "/css/index.css",
		),
		"page_css" => array(
			"type" => "require",
			"path" => "/css/page.css",
		),
		"aos" => array(
			"type" => "require",
			"base" => "static",
			"path" => "/js/aos/2.1.1/min.js",
			"loading" => "later",
		),
		"jquery" => array(
			"type" => "require",
			"base" => "static",
			"path" => "/js/jquery/3.1.0.js",
			"loading" => "later",
		),
		"slides" => array(
			"type" => "require",
			"base" => "static",
			"path" => "/js/jquery/plugin/slides/3.0.4.js",
			"loading" => "later",
		),
		"index" => array(
			"type" => "require",
			"path" => "/js/index.js",
			"loading" => "later",
		),
		"font_awesome" => array(
			"type" => "link",
			"path" => "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css",
			"loading" => "later",
		),
	);
?>