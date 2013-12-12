<?php
$controller = new ReflectionClass('Controller');
try {
	$method = $controller->getMethod(($_GET['m']) ?: 'index');
}
catch(ReflectionException $e)
{
	header('HTTP/1.0 404 Not Found');
	die('404 error. Page not found.');
}

if (!$method OR !$method->isPublic())
{
	header('HTTP/1.0 404 Bad Request');
	die('404 error. Page not found.');
}

$invoke = $controller->newInstance();
$method->invoke($invoke);

class C
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
