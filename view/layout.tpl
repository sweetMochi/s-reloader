<!DOCTYPE html>
<html lang="<?=$GLOBALS["site"]["lang"]?>">
<head><?
	echo $meta_html;
	echo $resource_html["head_style"];
	echo $js_var_html;
	echo $resource_html["head_script"];
?></head>
<body<?=$body_style?>><?
	?><div class="wrap" itemscope itemtype="http://schema.org/<?=$microdata_type?>"><?
		echo $microdata_html;
		echo $content;
	?></div><?
	echo $resource_html["later_style"];
	echo $resource_html["later_script"];
	echo $App->view("_mode/ui");
	if ( $show_footer ) echo $App->view("_mode/footer");
?></body>
</html>
