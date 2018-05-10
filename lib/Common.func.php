<?
class App {

	public function run() {

		// require the file that matches the controller name
		// create a new instance of the needed controller
		// call the action

		$module = "apps";
		$action = "index";

		if ( !isset($_GET["module"]) ) {
			$get_module = "App.class.php";
		} else {
			$get_module = "module/" . ucfirst($_GET["module"]) . ".class.php";
		}

		if ( file_exists($get_module) ) {
			$action = $_GET["action"] ? $_GET["action"] : $action;
		} else {
			exit;
		}

		require_once($get_module);
		$module = new AppModule();
		$module->{ $action }();
	}

	// All css and script rearrangement
	public function resource($list) {

		$html = array();
		$tag_name = "data-rid";
		$default_type = "require";
		$file_tag = array(
			"css" => "style",
			"js" => "script",
		);

		foreach ( $list as $key ) {

			$value = $GLOBALS["resource"][$key];
			$file = strpos($value["path"], ".css") !== false || $value["file"] == "css" ? "css" : "js";
			$link = $value["link"];
			$base = $value["base"] ? $value["base"] : "resource";
			$preload = $value["preload"];

			if ( !$link ) {
				$require_item = file_get_contents($GLOBALS["path_" . $base] . $value["path"]);
				$html_line = '<' . $file_tag[$file] . ' ' . $tag_name . '="' . $key . '">' . $require_item . '</' . $file_tag[$file] . '>';
			} else {
				$exteral = strpos($value["path"], "//") !== false || $value["base"] == "exteral" ? true : false;
				$resource_url = $exteral ? $value["path"] : $GLOBALS["url_" . $base] . $value["path"];
				if ( $file == "css" ) {
					$html_line = '<link ' . $tag_name . '="' . $key . '" rel="stylesheet" href="' . $resource_url . '">';
				} else {
					$html_line = '<script ' . $tag_name . '="' . $key . '" src="' . $resource_url . '"></script>';
				}
			}
			$load_tag = $preload ? "head" : "later";
			$html[$load_tag . "_" . $file_tag[$file]] .= $html_line;
		}

		return $html;

		// echo html var
		// $resource_html["head_style"];
		// $resource_html["head_script"];
		// $resource_html["later_style"];
		// $resource_html["later_script"];

	}

	// PHP var convert to JS var
	// PHP var can be three types: boolean, array, numeric
	function js_var ($js_var) {
		$js_var_html = '<script id="js-var">';
		foreach ($js_var as $js_var_key => $js_var_value ) {
			$js_var_html .= 'window["' . $js_var_key . '"]=';
			switch (true) {
				case is_bool($js_var_value): $js_var_html .= $js_var_value ? "true" : "false"; break;
				case is_array($js_var_value): $js_var_html .= json_encode($js_var_value); break;
				case is_numeric($js_var_value): $js_var_html .= $js_var_value; break;
				default: $js_var_html .= '"' . $js_var_value . '"';
			}
			$js_var_html .= ';';
		}
		$js_var_html .= '</script>';
		return $js_var_html;
	}

	// SEO meta formate
	public function meta ($option = array(
		"title" => "",
		"name" => array(),
		"property" => array(),
	)) {
		$meta_html = '<meta charset="UTF-8"><title>' . $option["title"] . '</title>';
		$meta_html .= '<link type="image/x-icon" rel="shortcut icon" href="' . $GLOBALS["site"]["favicon"] . '">';
		unset($option["title"]);
		foreach ($option as $key => $value) {
			foreach ($value as $meta_key => $meta_value ) {
				$meta_html .= '<meta ' . $key . '="' . $meta_key . '" content="' . $meta_value . '">';
			}
		}
		return $meta_html;
	}

	// Structured Data: json-dl and microdata
	function structuredData ($data = array(), $type = "json-dl") {

		$html = "";
		$data_type = $data["type"];
		$data_item = array(
			"image" => "ImageObject",
			"offers" => "Offer",
			"aggregateRating" => "AggregateRating",
		);

		$structure = array(
			"microdata" => array(
				"wrap_start" => "",
				"open" => array( "<div itemprop='", "' itemscope itemtype='http://schema.org/", "'>" ),
				"mid" => array( "<meta itemprop='", "' content='", "'>" ),
				"close" => "</div>",
				"item" => array( "<div itemprop='", "' content='", "'>" ),
				"wrap_end" => "",
			),
			"json-dl" => array(
				"wrap_start" => '<script type="application/ld+json">{"@context":"http://schema.org/",',
				"open" => array( '"', '":{"@type":"', '",' ),
				"mid" => array( '"', '":"', '",' ),
				"close" => "},",
				"item" => array( '"', '":"', '",' ),
				"wrap_end" => "}</script>",
			),
		);

		unset($data["type"]);

		function scope($key, $value, $structure, $type, $data_item) {
			$scope_html = "";
			$scope_html .= $structure[$type]["open"][0] . $key . $structure[$type]["open"][1] . $data_item[$key] . $structure[$type]["open"][2];
			foreach ($value as $item_key => $item_value ) {
				if (  is_array($item_value) ) {
					$scope_html .= scope($item_key, $item_value, $structure, $type, $data_item);
				} else {
					$scope_html .= prop($item_key, $item_value, $structure, $type, $data_item);
				}
			}
			$scope_html .= $structure[$type]["close"];
			return $scope_html;
		}

		function prop($key, $value, $structure, $type, $data_item) {
			$prop_html = "";
			$prop_html .=  $structure[$type]["mid"][0] . $key . $structure[$type]["mid"][1] . $value . $structure[$type]["mid"][2];
			return $prop_html;
		}

		$html .= $structure[$type]["wrap_start"];

		if ( $type == "json-dl" ) {
			$html .= '"@type": "' . $data_type . '",';
		} else {
			$html_scope = "itemscope itemtype='http://schema.org/{$data_type}'>";
		}

		foreach ($data as $data_key => $data_value ) {
			if ( is_array($data_value) ) {
				$html .= scope($data_key, $data_value, $structure, $type, $data_item);
			} else {
				$html .= prop($data_key, $data_value, $structure, $type, $data_item);
			}
		}
		$html .= $structure[$type]["wrap_end"];

		if ( $type == "json-dl" ) {
			$html = str_replace(",}", "}", $html);
		} else {
			$html["content"] = $html;
			$html["scope"] = $html_scope;
		}
		return $html;
	}

	// Render html and passing php vars
	public function render ($view, $data = array() ) {
		$data["App"] = new App;
		$data["body_style"] = $data["body_style"] ? " class='{$data["body_style"]}'" : "";
		$data["content"] = $this->view("page/{$view}", $data);
		echo $this->view("layout", $data);
	}

	public function view ($view, $data = array()) {
		$path = "{$GLOBALS["path_view"]}/{$view}.tpl";
		ob_start();
		if ( !empty($data) ) { extract($data); }
		require($path);
		return ob_get_clean();
	}

	public function pageMsg ($title, $url = "") {

		$url = $url == "" ? $GLOBALS["site"]["url"] : $url;
		$meta_html = $this->meta(array(
			"title" => $title,
			"name" => array(
				"theme-color" => "#000000",
				"viewport" => "width=device-width, minimum-scale=1.0, user-scalable=no",
			),
		));

		$resource_html = $this->resource(array(
			"index_css",
			"cwtexyen_css",
			"font_awesome",
		));

		$data["url"] = $url;
		$data["title"] = $title;
		$data["body_style"] = "msg";
		$data["meta_html"] = $meta_html;
		$data["resource_html"] = $resource_html;
		render ("msg", $data);

	}
}

$App = new App;

?>
