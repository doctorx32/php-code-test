<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;
use Symfony\Component\Routing\Generator\UrlGenerator;

final class Router
{
    /**
     * @var Routing\RouteCollection
     */
    private $routes;

    public function __construct(Routing\RouteCollection $routes)
    {
        $this->routes = $routes;
    }

    public function generate(string $route, $parameters = [], $type = UrlGenerator::ABSOLUTE_URL)
    {
        $request = Request::createFromGlobals();
        $context = new Routing\RequestContext();
        $context->fromRequest($request);
        $urlGenerator = new Routing\Generator\UrlGenerator($this->routes, $context);

        return $urlGenerator->generate($route, $parameters, $type);
    }
}
