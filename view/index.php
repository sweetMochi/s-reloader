<!DOCTYPE html>
<html lang="<?=$GLOBALS["site"]["lang"]?>">
<head>
	<meta charset="UTF-8">
	<title><?=$GLOBALS["site"]["title"]?></title>
	<link type="image/x-icon" rel="shortcut icon" href="<?=$GLOBALS["site"]["favicon"]?>">
	<?
		echo $meta_html;
		echo $resource_html["head_style"];
		echo $js_var_html;
		echo $resource_html["head_script"];
	?>
</head>
<body class="index">

	<div class="wrap" itemscope itemtype="http://schema.org/<?=$microdata_type?>"><?
		echo $microdata_html;
	?></div>

	<?
		echo $resource_html["later_style"];
		echo $resource_html["later_script"];
		require ("_mode/ui.php");
	?>

</body>
</html>
