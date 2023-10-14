<?php

declare(strict_types=1);

namespace Flitework\Routing;

/**
 * Describes route and its parameters
 * 
 * @author Ivan Mezinov <ivanmezinov@mail.ru>
 */
class Route
{
    public function __construct(
            private string $path,
            private array $methods = [],
            private array $requirements = []
    ) {}
    
    public function getPath(): string
    {
        return $this->path;
    }
    
    public function getMethods(): array
    {
        return $this->methods;
    }
    
    public function getRequirements(): array
    {
        return $this->requirements;
    }
}
