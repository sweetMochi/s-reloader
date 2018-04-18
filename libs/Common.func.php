<?
	// All css and script rearrangement
	function resource_manager($resource_list) {

		$html = array();
		$tag_name = "data-rid";
		$default_type = "require";
		$file_tag = array(
			"css" => "style",
			"js" => "script",
		);

		foreach ($resource_list as $key ) {

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
	// if php var is array, then echo json in html
	// if php var is number, then echo number
	function js_var ($js_var) {

		$js_var_html = '<script id="js-var">';
		foreach ($js_var as $js_var_key => $js_var_value ) {
			$js_var_html .= 'window["' . $js_var_key . '"]=';
			if ( is_array($js_var_value) ) {
				$js_var_html .= json_encode($js_var_value);
			} else
			if ( is_numeric($js_var_value) ) {
				$js_var_html .= $js_var_value;
			} else {
				$js_var_html .= '"' . $js_var_value . '"';
			}
			$js_var_html .= ';';
		}
		$js_var_html .= '</script>';

		return $js_var_html;

	}

	function meta_manager ($meta, $property = array()) {
		$meta_html = "";
		foreach ($meta as $meta_key => $meta_value ) {
			$meta_html .= '<meta name="' . $meta_key . '" content="' . $meta_value . '">';
		}
		foreach ($property as $property_key => $property_value ) {
			$meta_html .= '<meta property="' . $property_key . '" content="' . $property_value . '">';
		}
		return $meta_html;
	}

	function microdata_manager ($microdata) {
		$microdata_html = "";
		$microdata_item = array(
			"image" => "ImageObject",
			"offers" => "Offer",
			"aggregateRating" => "AggregateRating",
		);
		foreach ($microdata as $microdata_key => $microdata_value ) {
			if ( is_array($microdata_value) ) {
				$microdata_html .= '<div itemprop="' . $microdata_key . '" itemscope itemtype="http://schema.org/' . $microdata_item[$microdata_key] . '">';
				foreach ($microdata_value as $item_key => $item_value ) {
					$microdata_html .= '<meta itemprop="' . $item_key . '" content="' . $item_value . '">';
				}
				$microdata_html .= '</div>';
			} else {
				$microdata_html .= '<meta itemprop="' . $microdata_key . '" content="' . $microdata_value . '">';
			}
		}
		return $microdata_html;
	}
?>
