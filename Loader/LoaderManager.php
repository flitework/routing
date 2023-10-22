<?php

declare(strict_types=1);

namespace Flitework\Routing\Loader;

use Flitework\Routing\Contracts\LoaderManagerInterface;
use Flitework\Routing\Contracts\LoaderInterface;
use Flitework\Routing\RouteCollection;

/**
 * 
 * 
 * @author Ivan Mezinov <ivanmezinov@mail.ru>
 */
class LoaderManager implements LoaderManagerInterface
{
    /**
     * 
     * @var LoaderInterface[]
     */
    private array $loaders = [];
    
    private RouteCollection $routes;
    
    public function __construct(array|string|null $loader = null)
    {
        $this->routes ??= new RouteCollection();
        $this->addLoader($loader);
    }
    
    public function load(mixed $resource, array|string $type = 'attribute', array|string|null $loader = null): RouteCollection
    {
        if ($loader) {
            $this->addLoader($loader);
        }
        foreach ($this->loaders as $loader) {
            if (is_string($resource) && $loader->support($resource, $type)) {
                $this->addCollection($loader->load($resource));
            }
            if (is_array($resource)) {
                foreach ($resource as $OneResource) {
                    $this->routes = $this->load($OneResource, $type);
                }
            }
        }
        
        return $this->routes;
    }
    
    public function addLoader(array|string|null $loader): static
    {
        if (is_string($loader) && $this->isLoader($loader)) {
            $loader = new $loader();
            $this->loaders[] = $loader;
        }
        if (is_array($loader)) {
            foreach ($loader as $oneLoader) {
                $this->addLoader($oneLoader);
            }
        }
        
        return $this;
    }
    
    private function isLoader(string $classname): bool
    {
        return (class_exists($classname) && in_array(LoaderInterface::class, class_implements($classname)));
    }
    
    private function addCollection(array $routes): RouteCollection
    {
        foreach ($routes as $key => $route) {
            $this->routes->add($key, $route);
        }
        
        return $this->routes;
    }
}
