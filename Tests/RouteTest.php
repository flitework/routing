<?php

namespace Flitework\Routing\Tests;

use PHPUnit\Framework\TestCase;
use Flitework\Routing\Route;
use Flitework\Routing\Tests\DataProvider\RouteDataProvider;

class RouteTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testGetPath($path, $methods, $requirements)
    {
        $route = new Route($path, $methods, $requirements);
        
        $this->assertEquals('/path', $route->getPath());
    }
    
    /**
     * @dataProvider dataProvider
     */
    public function testGetMethods($path, $methods, $requirements)
    {
        $route = new Route($path, $methods, $requirements);
        
        $this->assertEquals(['GET', 'POST'], $route->getMethods());
    }
    
    /**
     * @dataProvider dataProvider
     */
    public function testGetRequirements($path, $methods, $requirements)
    {
        $route = new Route($path, $methods, $requirements);
        
        $this->assertEquals(['id'], $route->getRequirements());
    }
    
    public function dataProvider(): array
    {
        return RouteDataProvider::get();
    }
}
