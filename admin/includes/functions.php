<?php

	function autoload($class){

		$class = strtolower($class);
		$path = "includes/{$class}.php";

		// if(file_exists($path)){

		// 	require_once($path);

		// } else {

		// 	die("The {$class}.php was not found.");

		// }

		if(is_file($path) && !class_exists($class)){

			include $path;

		}

	}

	spl_autoload_register('autoload');

	function redirect($location){

		header("Location: {$location}");

	}

?>