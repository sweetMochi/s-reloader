<?
class AppModule {

	public function index () {

		$App = new App;
		$body_style = "index";
		$microdata_type = "MobileApplication";
		$microdata_html = $App->microdata(array(
			"url" => $GLOBALS["site"]["url"],
			"name" => $GLOBALS["game"]["name"],
			"image" => $GLOBALS["site"]["headpic"],
			"inLanguage" => $GLOBALS["game"]["lang"],
			"dateCreated" => $GLOBALS["game"]["create_time"],
			"downloadUrl" => $GLOBALS["site"]["url"] . "/get",
			"offers" => array(
				"name" => "Offer Name",
				"price" => "0",
				"priceCurrency" => "TWD",
			),
			"aggregateRating" => array(
				"ratingValue" => 4.9,
				"ratingCount" => 1,
			),
			"applicationCategory" => "Game",
			"operatingSystem" => "Android, iOS",
		));

		$meta_html = $App->meta(array(
			"title" => $GLOBALS["site"]["title"],
			"name" => array(
				//"msvalidate.01" => "",
				"theme-color" => "#000000",
				"viewport" => "width=device-width, minimum-scale=1.0, user-scalable=no",
				"description" => $GLOBALS["site"]["description"],
			),
			"property" => array(
				"fb:app_id" => $GLOBALS["site"]["fb_appid"],
				"og:url" => $GLOBALS["site"]["url"],
				"og:title" => $GLOBALS["site"]["title"],
				"og:type" => "game",
				"og:image" => $GLOBALS["site"]["headpic"],
				"og:description" => $GLOBALS["site"]["description"],
			)
		));

		$resource_html = $App->resource(array(
			"aos_css",
			"index_css",
			"aos",
			"jquery",
			"slides",
			"index",
		));

		$js_var_html = $App->js_var(array(
			"var" => $var,
		));

		$data["body_style"] = $body_style;
		$data["meta_html"] = $meta_html;
		$data["js_var_html"] = $js_var_html;
		$data["resource_html"] = $resource_html;
		$data["microdata_html"] = $microdata_html;
		$data["microdata_type"] = $microdata_type;

		$App->render ("index", $data);
	}
}
?>