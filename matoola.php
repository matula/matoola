<?php
/**
 * MatOOla:  a simple OO-ish PHP framework
 * hat-tip: http://twitto.org/ and https://news.ycombinator.com/item?id=505899
 *
 * @author  Terry Matula <terrymatula@gmail.com>
 *
 */
// Autoload
require 'vendor/autoload.php';

// Get controller
$controller = new ReflectionClass('Matoola\Controllers\Controller');

try
{
	// Default to index
	$method = $controller->getMethod(($_GET['m']) ?: 'index');
}
catch(ReflectionException $e)
{
	// Method/page not found
	header('HTTP/1.0 404 Not Found');
	die('404 error. Page not found.');
}

// Either no method, or it wasn't public
if (!$method OR !$method->isPublic())
{
	header('HTTP/1.0 404 Bad Request');
	die('404 error. Page not found.');
}

// Call the method
$invoke = $controller->newInstance();
$method->invoke($invoke);
