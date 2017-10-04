<?

	require_once("lib/Common.func.php");
	require_once("lib/routes.php");

	$GLOBALS["path_static"] = "/resource";
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
			"path" => "/js/jquery/2.1.4.js",
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
			"path" => "/webfont/font-awesome/4.5.0/css/min.css",
			"loading" => "later",
		),
	);
?>