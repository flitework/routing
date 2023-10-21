<?php

declare(strict_types=1);

namespace Flitework\Routing;

use Flitework\Routing\Contracts\CollectionInterface;
use Flitework\Routing\Route;
use Flitework\Routing\Exception\RouteNotFoundException;

/**
 * 
 * 
 * @author Ivan Mezinov <ivanmezinov@mail.ru>
 */
class RouteCollection implements CollectionInterface
{
    /**
     * @var array<name: string, Route>
     */
    private array $routes = [];
    
    public function add(string $name, Route $route = null): static
    {
        if ($route) {
            $this->routes[$name] = $route;
        }
        
        return $this;
    }

    public function clear(): static
    {
        $this->routes = [];
        
        return $this;
    }

    public function count(): int
    {
        return \count($this->routes);
    }

    public function get(string $name): Route
    {
        if (!$this->has($name)) {
            throw new RouteNotFoundException($name);
        }
        
        return $this->routes[$name];
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $this->routes);
    }

    public function remove(string $name): static
    {
        unset($this->routes[$name]);
        
        return $this;
    }

    public function all(): array
    {
        return $this->routes;
    }
}
