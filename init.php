<?

require("lib/Common.func.php");

$title = "test Website";
$description = "test Description";

// Path and URL
$dir_file = dirname(__FILE__);
$GLOBALS["path_view"] = "{$dir_file}/view";
$GLOBALS["path_static"] = "{$dir_file}/static";
$GLOBALS["path_resource"] = "{$dir_file}/resource";
$GLOBALS["url_static"] = "http://{$_SERVER['SERVER_NAME']}/static";
$GLOBALS["url_image"] = "http://{$_SERVER['SERVER_NAME']}/resource/images";
$GLOBALS["url_resource"] = "http://{$_SERVER['SERVER_NAME']}/resource";

// Game Data
$GLOBALS["game"] = array(
	"lang" => "zh-tw",
	"name" => "Test game",
	"rating" => "6",
	"release" => true,
	"rating_desc" => "Rating Description",
);

// Site Data
$GLOBALS["site"] = array(
	"url" => "http://{$_SERVER['SERVER_NAME']}",
	"lang" => "zh-tw",
	"title" => $title,
	"favicon" => "",
	"headpic" => "",
	"description" => $description,
);

// Resource setting
$GLOBALS["resource"] = array(
	"aos_css" => array(
		"base" => "static",
		"path" => "/js/aos/2.1.1/min.css",
	),
	"index_css" => array(
		"path" => "/css/index.css",
		"preload" => true,
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
		"link" => true,
		"path" => "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css",
	),
);
?>