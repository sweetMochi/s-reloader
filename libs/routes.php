<?

function appRun() {

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

?>