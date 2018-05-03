# sweet-loader
It's a html resource manger, include script and style by php.
If your server config like this:

var/www/static
static.exsample.com

var/www/official
exsample.com

Anothoer server like
cdn.exsample.com

You can config your web resource (css or javascript) by sweet-loader.
Wether in head or in the end of body tag.

Extra function include php variable pass to js and SEO setting (For game website microdata and facebook share standard).
Built-in UI function: Scroll top, custom js alert alteration method, open popout method.
All js runing in ECMAScript 5.

# How to use

1. Set your path.
```php
$GLOBALS["path_static"] = "/resource";
$GLOBALS["url_static"] = "//" . $_SERVER['SERVER_NAME'] . "/resource";
```

2. Copy file to resource folder.

3. Index your resource by loading order.
```php
$GLOBALS["resource"] = array(
	"aos_css" => array(
		"base" => "static",
		"path" => "/js/aos/2.1.1/min.css",
	),
	"index_css" => array(
		"preload" => true,
		"path" => "/css/index.css",
	),
);
```
	base: null(default) | static
		[default]：Loading in resource folder.
		[static]：Loading in predefind domain or server folder.

	path: Can't not be empty.
		This is path in "var/www/static" and "static.exsample.com" should be the same.

	preload: null(default) | true.
		[default]：Loading in head tag, whether in <script src=""> or <script></script>.
		[true]：Loading resource in the end before body.

	(Deprecated)type: null(default) | require
		[default]：Resource loading in <script src=""> or <link rel="stylesheet" href="">
		[require]： Resource loading in <script></script> or <style></style>

	(Deprecated)loading: null(default) | later
		[default]：Loading in head tag, whether in <script src=""> or <script></script>.
		[later]：Loading resource in the end before body.

4. Setting loading resource in App.class, becare in dependence order.

```php
$resource_html = $App->resource(array(
	"aos_css",
	"index_css",
	"aos",
	"jquery",
	"slides",
	"index",
));
```

And if you have some var or array. Passing php to js, you can use like this:
```php
$js_var_html = $App->js_var(array(
	"var" => $var,
));
```
