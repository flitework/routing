<?php

namespace Flitework\Routing\Tests;

use PHPUnit\Framework\TestCase;
use Flitework\Routing\RouteCollection;
use Flitework\Routing\Route;
use Flitework\Routing\Exception\RouteNotFoundException;
use Flitework\Routing\Tests\DataProvider\RouteDataProvider;

class RouteCollectionTest extends TestCase
{
    private static $collection;
    
    public static function setUpBeforeClass(): void
    {
        self::$collection = new RouteCollection();
    }
    
    /**
     * @depends testRemove
     */
    public function testGetRoute()
    {
        $route = self::$collection->get("name2");
        
        $this->assertEquals(Route::class, get_class($route));
    }
    
    /**
     * @depends testGetRoute
     */
    public function testGetRouteNotFound()
    {
        $this->expectException(RouteNotFoundException::class);
        self::$collection->get("name1");
    }
    
    /**
     * @depends testAdd
     */
    public function testHasTrue()
    {
        $this->assertTrue(self::$collection->has('name1'));
        $this->assertTrue(self::$collection->has('name2'));
        $this->assertTrue(self::$collection->has('name3'));
    }
    
    /**
     * @depends testRemove
     */
    public function testHasFalse()
    {
        $this->assertFalse(self::$collection->has('name1'));
    }
    
    /**
     * @dataProvider routeProvider
     */
    public function testAdd($path, $methods, $requirements)
    {
        $quantity = 3;
        for ($i = 1; $i <= $quantity; $i++) {
            $route = new Route($path, $methods, $requirements);
            self::$collection->add("name$i", $route);
        }
        
        $this->assertEquals($quantity, self::$collection->count());
    }
    
    /**
     * @depends testHasTrue
     */
    public function testRemove()
    {
        self::$collection->remove("name1");
        
        $this->assertEquals(2, self::$collection->count());
    }
    
    /**
     * @depends testGetRouteNotFound
     */
    public function testClear()
    {
        self::$collection->clear();
        
        $this->assertEquals(0, self::$collection->count());
    }
    
    public function testAll()
    {
        $this->assertIsArray(self::$collection->all());
    }
    
    public function routeProvider(): array
    {
        return RouteDataProvider::get();
    }
}
