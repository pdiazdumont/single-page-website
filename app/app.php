<?php

require '../vendor/autoload.php';

$app = new \Slim\App;

$container = $app->getContainer();
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('../app/views', [
        'cache' => false //'../app/cache'
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));
    return $view;
};

$pages = require 'routes.php';

foreach ($pages as $page) {
	$app->get($page['url'], function($request, $response) use ($page) {
		return $this->view->render($response, $page['view'], getTemplateVariables($request, $page));
	});
}

$app->get('/ajax', function($request, $response) use ($pages) {
	$params = $request->getQueryParams();
	$section = $params['section'];
	if (array_key_exists($section, $pages)) {
		$page = $pages[$section];
		return $response->withHeader('Content-type', 'application/json')->write(json_encode([
			'title' => $page['params']['title'],
			'content' => $this->view->getEnvironment()->loadTemplate($page['view'])->renderBlock('body', getTemplateVariables($request, $page)),
			'section' => $section,
			'url' => getBaseUrl($request) . $page['url']
		]));
	}
	else {
		return $response->withStatus(404)->write('Invalid request');
	}
});

$app->run();

function getBaseUrl($request) {
	$uri = $request->getUri();
	return $uri->getScheme() . '://' . $uri->getHost() . $uri->getBasePath();
}

function getTemplateVariables($request, $page) {
	$uri = $request->getUri();
	return array_merge($page['params'], [
		'baseUrl' => getBaseUrl($request),
		'uri' => $request->getUri()
	]);
}