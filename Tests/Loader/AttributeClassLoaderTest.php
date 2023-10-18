<?php

namespace Flitework\Routing\Tests\Loader;

use PHPUnit\Framework\TestCase;
use Flitework\Routing\Loader\AttributeClassLoader;
use Flitework\Routing\Route;
use Flitework\Routing\Tests\Fixtures\AttributeFixtures\FullFixture;
use Flitework\Routing\Tests\Fixtures\AttributeFixtures\NoRoutesFixture;
use Flitework\Routing\Tests\Fixtures\AttributeFixtures\MissingParameterNameForRouteFixture;
use Flitework\Routing\Tests\Fixtures\AttributeFixtures\MissingParameterPathForRouteFixture;

/**
 * @author Ivan Mezinov <ivanmezinov@mail.ru>
 */
class AttributeClassLoaderTest extends TestCase
{
    private $loader;
    
    protected function setUp(): void
    {
        $this->loader = new AttributeClassLoader();
    }
    
    public function testLoadClassNotExist()
    {
        $this->assertNull($this->loader->load('CustomClass'));
    }
    
    public function testLoadReturnNull()
    {
        $this->assertNull($this->loader->load(NoRoutesFixture::class));
    }
    
    public function testLoadReturnRoutes()
    {
        $result = $this->loader->load(FullFixture::class);
        
        $this->assertIsArray($result);
        $this->assertEquals(Route::class, get_class($result['foo']));
    }
    
    public function testLoadMissingParameterNameForRouteException()
    {
        $this->expectException(\Exception::class);
        $this->loader->load(MissingParameterNameForRouteFixture::class);
    }
    
    public function testLoadMissingParameterPathForRouteException()
    {
        $this->expectException(\Exception::class);
        $this->loader->load(MissingParameterPathForRouteFixture::class);
    }
    
    public function testSupportType()
    {
        $this->assertEquals('attribute', $this->loader->supportType());
    }
}
