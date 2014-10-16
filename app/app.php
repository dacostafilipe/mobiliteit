<?php

    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    require_once __DIR__.'/bootstrap.php';

    $app = new Silex\Application();

    $app[ 'debug' ] = true;

    // stations information
    $app->mount( '/api/station/', new mobiliteit\jsonControllerProvider() );

    // search for stations
    $app->mount( '/api/search/', new mobiliteit\searchControllerProvider() );

    // Send user to stations information path per default. But here we could display information about the available routes.
    $app->get('/', function () use ( $app ) {
        return $app->redirect('/api/station/');
    });

    $app->get('/api/', function () use ( $app ) {
        return $app->redirect('/api/station/');
    });

    $app->after(function (Request $request, Response $response) {

        $response->headers->set('Access-Control-Allow-Origin', '*');

    });

    return $app;
