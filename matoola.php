<?php
/**
 * MatOOla:  a simple OO-ish PHP framework
 * hat-tip: http://twitto.org/ and https://news.ycombinator.com/item?id=505899
 *
 * @author  Terry Matula <terrymatula@gmail.com>
 *
 */

// Get controller
$controller = new ReflectionClass('Controller');

try {
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

/**
 * Controller
 */
class Controller
{
	public function index()
	{
		echo 'Welcome to MatOOla!';
	}

	public function testing()
	{
		echo 'Testing out';
	}
}
