<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Routing\Loader\YamlFileLoader as RoutingYamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use App\App;

require_once __DIR__.'/../vendor/autoload.php';

$fileLocator = new FileLocator(array(__DIR__ . '/../config'));
$loader = new RoutingYamlFileLoader($fileLocator);
$routes = $loader->load('routes.yaml');

$containerBuilder = new ContainerBuilder();
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__ . '/../config'));
$loader->load('services.yaml');

/** @var App $app */
$app = $containerBuilder->get('app');
$app->start();
