<?php

namespace Flitework\Routing\Tests;

use PHPUnit\Framework\TestCase;
use Flitework\Routing\Router;
use Flitework\Routing\RouteCollection;
use Flitework\Routing\Route;
use Flitework\Routing\Tests\Fixtures\AttributeFixtures\FullFixture;
use Flitework\Routing\Contracts\LoaderManagerInterface;
use Flitework\Routing\Tests\DataProvider\RouteProvider;

/**
 * @author Ivan Mezinov <ivanmezinov@mail.ru>
 */
class RouterTest extends TestCase
{
    private $collection;
    private $loader;
    
    
    protected function setUp(): void
    {
        $this->collection = $this->createStub(RouteCollection::class);
        $this->loader = $this->createStub(LoaderManagerInterface::class);
        $this->loader->method('load')->willReturn($this->collection);
    }
    
    /**
     * @dataProvider providerRoute
     */
    public function testGetRequestRoute($name, $route, $path)
    {
        $this->collection->method('all')->willReturn([$route]);
        $router = new Router(FullFixture::class, $this->loader);
        $this->assertEquals(Route::class, get_class($router->getRequestRoute($path)));
        $this->assertEquals($route, $router->getRequestRoute($path));
    }
    
    /**
     * @dataProvider providerRoute
     */
    public function testNotFoundRequestRoute($name, $route, $path)
    {
        $this->collection->method('all')->willReturn([$route]);
        $router = new Router(FullFixture::class, $this->loader);
        $this->expectException(\Exception::class);
        $router->getRequestRoute('/bar');
    }
    
    public function providerRoute(): array
    {
        return RouteProvider::get();
    }
}
