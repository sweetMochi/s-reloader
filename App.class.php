<?
	class AppModule {

		public function index () {

			$microdata_type = "WebApplication";
			$microdata_html = microdata_manager(array(
				"url" => $GLOBALS["site"]["url"],
				"name" => $GLOBALS["game"]["name"],
				"image" => $GLOBALS["site"]["headpic"],
				"inLanguage" => $GLOBALS["game"]["lang"],
				"dateCreated" => $GLOBALS["game"]["create_time"],
				"downloadUrl" => "",
				"offers" => array(
					"name" => "",
					"price" => "0",
					"priceCurrency" => "USD",
				),
				"applicationCategory" => "Game",
				"operatingSystem" => "Windows, OSX",
				"browserRequirements" => "Latest version of Chrome or Firefox, ie7 +, ie edge, Opera",
			));

			$meta_html = meta_manager(
				array(
					"msvalidate.01" => "",
					"viewport" => "width=device-width, minimum-scale=1.0, user-scalable=no",
					"description" => $GLOBALS["site"]["description"],
				),
				array(
					"fb:app_id" => $GLOBALS["fb_app"],
					"og:url" => $GLOBALS["site"]["url"],
					"og:title" => $GLOBALS["site"]["title"],
					"og:type" => "game",
					"og:image" => $GLOBALS["site"]["headpic"],
					"og:description" => $GLOBALS["site"]["description"],
				)
			);

			$resource_html = resource_manager(array(
				"aos_css",
				"index_css",
				"aos",
				"jquery",
				"slides",
				"index",
			));

			$js_var_html = js_var(array(
				"var" => $var,
			));

			require_once("view/index.php");
		}
	}
?>