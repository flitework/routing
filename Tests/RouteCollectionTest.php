<?php

namespace Flitework\Routing\Tests;

use PHPUnit\Framework\TestCase;
use Flitework\Routing\RouteCollection;
use Flitework\Routing\Route;
use Flitework\Routing\Exception\RouteNotFoundException;
use Flitework\Routing\Tests\DataProvider\RouteProvider;

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
        
        $this->assertEquals(Route::class, $route);
    }
    
    /**
     * @depends testGetRoute
     */
    public function testGetRouteNotFound()
    {
        self::$collection->get("name1");
        $this->expectExceptionObject(RouteNotFoundException::class);
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
        $this->assertTrue(self::$collection->has('name1'));
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
        $this->assertEquals(2, self::$collection->clear());
    }
    
    /**
     * @depends setUpBeforeClass
     */
    public function testCountNewCollection()
    {
        $this->assertEquals(0, self::$collection->count());
    }
    
    public function routeProvider(): array
    {
        return RouteProvider::get();
    }
}
