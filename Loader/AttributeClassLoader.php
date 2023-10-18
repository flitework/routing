<?php

declare(strict_types=1);

namespace Flitework\Routing\Loader;

use Flitework\Routing\Contracts\LoaderInterface;
use Flitework\Routing\Route;

/**
 * 
 *
 * @author Ivan Mezinov <ivanmezinov@mail.ru>
 */
class AttributeClassLoader implements LoaderInterface
{
    /**
     * 
     * @var array<string: name, Route>
     */
    private array $routes = [];
    
    public function load(string $resource): ?array
    {
        if (!class_exists($resource)) {
            return null;
        }
        $reflection = new \ReflectionClass($resource);
        
        $allMethods = $reflection->getMethods();
        foreach ($allMethods as $method) {
            if (!$this->isRoute($method)) {
                continue;
            }
            $this->setRoute($method);
        }
        
        if (0 === count($this->routes)) {
            return null;
        }
        
        return $this->routes;
    }

    public function supportType(): string
    {
        return 'attribute';
    }
    
    private function isRoute(\ReflectionMethod $method): bool
    {
        if (!$method->getAttributes(Route::class)) {
            return false;
        }
        
        return true;
    }
    
    private function setRoute(\ReflectionMethod $method): void
    {
        $routeAttributes = $method->getAttributes(Route::class);
        $attr = $routeAttributes[0];
        $arguments = $attr->getArguments();
        if (!isset($arguments['name'], $arguments['path'])) {
            throw new \Exception('Route name or path cannot be empty');
        }
        $routeName = $arguments['name'];
        $route = new Route(
                $arguments['path'],
                $arguments['methods'] ?? [],
                $arguments['requirements'] ?? []
        );
        $this->routes[$routeName] = $route;
    }
}
