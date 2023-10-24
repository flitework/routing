<?php

declare(strict_types=1);

namespace Flitework\Routing;

use Flitework\Routing\Contracts\LoaderManagerInterface;
use Flitework\Routing\RouteCollection;
use Flitework\Routing\Route;
use Flitework\Routing\Matcher\UrlMatcher;

/**
 * 
 *
 * @author Ivan Mezinov <ivanmezinov@mail.ru>
 */
class Router
{
    private RouteCollection $routes;
    
    private UrlMatcher $matcher;
    
    public function __construct(
            private array|string $resource,
            private LoaderManagerInterface $loader
    ) {
        $this->routes ??= $this->loader->load($this->resource);
        $this->matcher ??= new UrlMatcher($this->routes);
    }
    
    public function getRequestRoute(string $path): Route
    {
        foreach ($this->routes->all() as $route)
        {
            if ($this->matcher->match($path))
            {
                return $route;
            }
        }
        
        throw new \Exception(sprintf('No route found for \'%s\' path', $path));
    }
}
