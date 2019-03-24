<?php
declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader as RoutingYamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Routing\RouteCollection;

class RouterTest extends TestCase
{
    /**
     * @var ContainerBuilder
     */
    private $containerBuilder;

    public function testGenerate()
    {
        $routes = $this->containerBuilder->getParameter('routes');
        self::assertTrue($routes instanceof RouteCollection);
    }

    protected function setUp(): void
    {
        $fileLocator = new FileLocator(array(__DIR__ . '/../config'));
        $loader = new RoutingYamlFileLoader($fileLocator);
        $routes = $loader->load('routes.yaml');

        $this->containerBuilder = new ContainerBuilder();
        $this->containerBuilder->setParameter('routes', $routes);
        $this->containerBuilder->compile();
    }

}