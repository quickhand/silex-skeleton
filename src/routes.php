<?php

namespace Quickhand\MyApp;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Schema\Builder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function () use ($app) {
    $blargh=new Models\Tree();
    //$blargh2=new Builder($app['capsule.connection']);

    /*$blargh2->create('blusers', function($table)
    {
    // Let's not get carried away.
    });*/

    //ob_start();
    //var_dump();
    //var_dump($app['capsule']->getDatabaseManager());
    //$result = ob_get_clean();
    $result=$blargh->say();
    /*Capsule::schema()->create('users', function($table)
    {
	    $table->increments('id');
	    $table->string('email')->unique();
	    $table->timestamps();
    });*/


    return $result; //$app['twig']->render('index.html', array());
})
->bind('homepage')
;

$app->get('/boo', function () use ($app) {
    $blargh=new Models\Tree();
    //$blargh2=new Builder($app['capsule.connection']);

    /*$blargh2->create('blusers', function($table)
    {
    // Let's not get carried away.
    });*/

    //ob_start();
    //var_dump();
    //var_dump($app['capsule']->getDatabaseManager());
    //$result = ob_get_clean();
    $result=$blargh->say();
    /*Capsule::schema()->create('users', function($table)
    {
        $table->increments('id');
        $table->string('email')->unique();
        $table->timestamps();
    });*/


    return $app['twig']->render('index.html', array());
});



$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html',
        'errors/'.substr($code, 0, 2).'x.html',
        'errors/'.substr($code, 0, 1).'xx.html',
        'errors/default.html',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
