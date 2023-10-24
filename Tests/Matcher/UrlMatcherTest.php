<?php

namespace Flitework\Routing\Tests\Matcher;

use PHPUnit\Framework\TestCase;
use Flitework\Routing\Matcher\UrlMatcher;
use Flitework\Routing\RouteCollection;
use Flitework\Routing\Route;
use Flitework\Routing\Tests\DataProvider\RouteProvider;

class UrlMatcherTest extends TestCase
{
    private $routes;
    
    protected function setUp(): void
    {
        $this->routes = new RouteCollection();
    }
    
    /**
     * @dataProvider providerRoute
     */
    public function testMatch($name, $route, $path)
    {
        $this->routes->add($name, $route);
        $matcher = new UrlMatcher($this->routes);
        $this->assertEquals($route, $matcher->match($path));
        $this->assertEquals(Route::class, get_class($matcher->match($path)));
    }
    
    /**
     * @dataProvider providerRoute
     */
    public function testMatchNull($name, $route, $path)
    {
        $this->routes->add($name, $route);
        $matcher = new UrlMatcher($this->routes);
        $this->assertNull($matcher->match('/foo/bar/'));
    }
    
    public function providerRoute(): array
    {
        return RouteProvider::get();
    }
}
