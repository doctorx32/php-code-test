<?php
declare(strict_types=1);

namespace App\Tests;

use App\App;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AppTest extends TestCase
{
    public function testStart()
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->compile();
        self::assertTrue($containerBuilder->isCompiled(), "container was not built");
    }

    protected function setUp(): void
    {
        $container = new ContainerBuilder();
        $container
            ->register('app', App::class)
        ;
    }
}