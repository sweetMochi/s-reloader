<?
	// All css and script rearrangement
	// [later] = load in bottom of body
	// [require] = require as script tag or style tag in line
	function resource_manager($resource_list) {

		$resource_html = array();

		foreach ($resource_list as $resource_key ) {

			$resource_value = $GLOBALS["resource"][$resource_key];
			$resource_is_css = strpos($resource_value["path"], ".css") !== false;

			if ( $resource_value["type"] == "require" ) {
				$resource_base = $resource_value["base"] ? $resource_value["base"] : "resource";
				$resource_base_path = $GLOBALS["path_" . $resource_base];
				$resource_item = file_get_contents($resource_base_path . $resource_value["path"]);
			} else {
				$resource_base = $resource_value["base"] ? $resource_value["base"] : "resource";
				$resource_base_url = $GLOBALS["url_" . $resource_base];
				$resource_url = $resource_base_url . $resource_value["path"];
			}

			if ( $resource_is_css ) {
				if ( $resource_value["type"] == "require" ) {
					$resource_style = "<style>" . $resource_item . "</style>\n";
				} else {
					$resource_style = '<link rel="stylesheet" href="' . $resource_url . '">';
				}
				if ( $resource_value["loading"] == "later" ) {
					$resource_html["later_style"] .= $resource_style;
				} else {
					$resource_html["head_style"] .= $resource_style;
				}
			} else {
				if ( $resource_value["type"] == "require" ) {
					$resource_script = "<script>" . $resource_item . "</script>\n";
				} else {
					$resource_script = '<script src="' . $resource_url . '"></script>';
				}
				if ( $resource_value["loading"] == "later" ) {
					$resource_html["later_script"] .= $resource_script;
				} else {
					$resource_html["head_script"] .= $resource_script;
				}
			}
		}

		return $resource_html;

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

		if ( $GLOBALS["game"]["type"] == "mobile" ) {
			$microdata_type = "MobileApplication";
			$microdata["downloadUrl"] = $GLOBALS["download"]["android"];
			$microdata["operatingSystem"] = "";
			unset($microdata["browserRequirements"]);
			if ( $GLOBALS["download"]["android"] ) {
				$microdata["downloadUrl"] = $meta_mobile['mobile_android_url'];
				$microdata["operatingSystem"] .= "Android,";
			}
			if ( $GLOBALS["download"]["ios"] ) {
				$microdata["operatingSystem"] .= "iOS";
			}
			if ( $GLOBALS["download"]["apk"] ) {
				$microdata["downloadUrl"] = $meta_mobile['mobile_apk_url'];
			}
		}

		foreach ($microdata as $microdata_key => $microdata_value ) {
			if ( is_array($microdata_value) ) {
				$microdata_html .= '<div itemprop="' . $microdata_key . '"  itemtype="' . $microdata_item[$microdata_key] . '">';
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
