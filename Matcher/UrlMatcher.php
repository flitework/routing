<?php

declare(strict_types=1);

namespace Flitework\Routing\Matcher;
use Flitework\Routing\Route;

/**
 * 
 * 
 * @author Ivan Mezinov <ivanmezinov@mail.ru>
 */
class UrlMatcher
{
    public function match(Route $route, string $path): ?Route
    {
        $cleanPath = $this->clean($path);
        $cleanPattern = $this->clean($route->getPath());
        if (!(count($cleanPath) === count($cleanPattern))) {
            return null;
        }
        foreach ($cleanPattern as $partKey => $partPattern) {
            if ($this->isRequirementParameter($partPattern)) {
                continue;
            }
            if ($partPattern !== $cleanPath[$partKey]) {
                return null;
            }
        }
        
        return $route;
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
