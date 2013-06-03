<?php

// Define the root of the application in a constant
define('ROOT', realpath('../'));

// Configure the application
include ROOT . 'config.php';

/* Class autoloader */
function __autoload($className) {
    require_once str_replace("_", "/", $className) . ".php";
}

/* Define include paths for library and models */
set_include_path(ROOT . 'models') . ':' .
                 ROOT . 'library'));

$requestUri = explode('?', $_SERVER['REQUEST_URI']);
$requestUri = $requestUri[0];

// Check for bad uri's and potential hacks
if (( strstr($requestUri, '//') !== false )
or	( strstr($requestUri, '../') !== false )
or	( strstr($requestUri, '/_') !== false )) {
    // Redirect those to _default
    $path = '/_default.php';
    
// Check if the file is an index
} elseif (( substr($requestUri, -1) == '/' )
and       ( file_exists(ROOT . 'views' . $requestUri . 'index.php') ))
{
    $path = $requestUri . 'index.php';
    
// Check if the file exists
} elseif (file_exists(ROOT . 'views' . rtrim($requestUri, '/') . '.php'))
{
    $path = rtrim($requestUri, '/') . '.php';
    
// If none of the above 3 is applicable, find the nearest _default
} else {
    $path = $requestUri;
    do {
        // 
        $path = substr($path, 0, strrchr($path, "/")-1);
        
        // Check if the default was located
        if (file_exists(ROOT . 'views' . $path . '/_default.php')) {
            $path .= '_default.php';
            break;
        }
    } while($path != '');
}
// Varify that a path was found
if ($path == '') {
    trigger_error("Unable to process request $requestUri", E_USER_ERROR);
} elseif (( $_SERVER['REQUEST_METHOD'] == 'POST' )
and       ( file_exists(ROOT . 'controllers' . $path) ))
{
    
    /* If a controller exists run it */
    include ROOT . 'controllers' . $path;
}

$setup = array();
ob_start();
include ROOT . 'views' . $path;
$content = ob_get_clean();

/* Define the file type for the http header */
if (!isset( $setup['filetype'] )) {
    $setup['filetype'] = 'text/html; charset=utf-8';
}

header('Content-type: ' . $setup['filetype']);

if (isset( $setup['header'] )) {
    include ROOT . 'views/' . $setup['header'];
}

echo $content;

if (isset( $setup['footer'] )) {
    include ROOT . 'views/' . $setup['footer'];
}
