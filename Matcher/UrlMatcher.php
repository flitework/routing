<?php

declare(strict_types=1);

namespace Flitework\Routing\Matcher;
use Flitework\Routing\Route;
use Flitework\Routing\RouteCollection;

/**
 * 
 * 
 * @author Ivan Mezinov <ivanmezinov@mail.ru>
 */
class UrlMatcher
{
    public function __construct(
            private RouteCollection $routes
    ) {}
    
    public function match(string $path): ?Route
    {
        foreach ($this->routes->all() as $route) {
            if ($this->isMatchRoute($route, $path)) {
                return $route;
            }
        }
        
        return null;
    }
    
    private function isMatchRoute(Route $route, string $path): bool
    {
        $cleanPath = $this->clean($path);
        $cleanPattern = $this->clean($route->getPath());
        if (!(count($cleanPath) === count($cleanPattern))) {
            return false;
        }
        foreach ($cleanPattern as $partKey => $partPattern) {
            if ($this->isRequirementParameter($partPattern)) {
                continue;
            }
            if ($partPattern !== $cleanPath[$partKey]) {
                return false;
            }
        }
        
        return true;
    }
    
    private function clean(string $path): array
    {
        $cleanPath = \explode('/', trim($path, '/'));
        
        return $cleanPath;
    }
    
    private function isRequirementParameter(string $partPath): bool
    {
        if (mb_strlen(trim($partPath, '{}')) === mb_strlen($partPath)) {
            return false;
        }
        
        return true;
    }
}
