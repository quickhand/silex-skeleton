<?php
namespace Quickhand\MyApp;

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;

$app = new Application();
$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider());
$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
}));

$test=new Models\Tree();

$app->register(new CapsuleServiceProvider(), array(
    // DB Connection: Single.
    'capsule.connection' => array(
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'silex',
        'username'  => 'silexuser',
        'password'  => 'supersecret',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ),
 
    // Cache.
    'capsule.cache' => array(
        'driver' => 'apc',
        'prefix' => 'laravel',
    ),
));


/*
// Cache: Available Options.
'capsule.cache' => array(
    'driver'        => 'file',
    'path'          => '/path/to/cache',
    'connection'    => null,
    'table'         => 'cache',

    'memcached' => array(
        array(
            'host'      => '127.0.0.1',
            'port'      => 11211,
            'weight'    => 100
        ),
    ),

    'prefix' => 'laravel',
),
*/

//$app['debug']=true;

return $app;
