<?php

spl_autoload_register(function ($class) {
	$prefix = 'App\\';

	if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
		return;
	}

	$relative = str_replace('\\', '/', substr($class, strlen($prefix)));
	$file = __DIR__ . '/../src/App/' . $relative . '.php';

	if (is_file($file)) {
		require_once $file;
	}
});

?>
