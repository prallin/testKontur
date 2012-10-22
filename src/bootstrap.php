<?php
/**
 * Bootstrapping, setting up and loading the core.
 *
 * @package KonturCore
 */

/**
 * Enable auto-load of class declarations.
 */

function autoload($aClassName) {
	$classFile = "/src/{$aClassName}/{$aClassName}.php";
	$file1 = KONTUR_INSTALL_PATH . $classFile;
	$file2 = KONTUR_SITE_PATH . $classFile;
	if (is_file($file1)) {
		require_once ($file1);
	} elseif (is_file($file2)) {
		require_once ($file2);
	}
}

spl_autoload_register('autoload');

/**
 * Helper, wrap html_entites with correct character encoding
 */
function htmlent($str, $flags = ENT_COMPAT) {
	return htmlentities($str, $flags, CKontur::Instance() -> config['character_encoding']);
}

/**
 * Set a default exception handler and enable logging in it.
 */
function exception_handler($exception) {
	echo "Kontur: Uncaught exception: <p>" . $e -> getMessage() . "</p><pre>" . $e -> getTraceAsString(), "</pre>";
}

set_exception_handler('exception_handler');


/**
 * Helper, include a file and store it in a string. Make $vars available to the included file.
 */
function getIncludeContents($filename, $vars=array()) {
  if (is_file($filename)) {
    ob_start();
    extract($vars);
    include $filename;
    return ob_get_clean();
  }
  return false;
}