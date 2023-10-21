<?php

namespace Flitework\Routing\Tests\Loader;

use PHPUnit\Framework\TestCase;
use Flitework\Routing\Loader\PhpClassLoader;
use Flitework\Routing\Route;
use Flitework\Routing\Tests\Fixtures\AttributeFixtures\FullFixture;
use Flitework\Routing\Tests\Fixtures\AttributeFixtures\NoRoutesFixture;
use Flitework\Routing\Tests\Fixtures\AttributeFixtures\MissingParameterNameForRouteFixture;
use Flitework\Routing\Tests\Fixtures\AttributeFixtures\MissingParameterPathForRouteFixture;

/**
 * @author Ivan Mezinov <ivanmezinov@mail.ru>
 */
class PhpClassLoaderTest extends TestCase
{
    private $loader;
    
    protected function setUp(): void
    {
        $this->loader = new PhpClassLoader();
    }
    
    public function testLoadClassNotExist()
    {
        $this->assertIsArray($this->loader->load('CustomClass'));
        $this->assertEquals(0, \count($this->loader->load('CustomClass')));
    }
    
    public function testLoadNoRoutes()
    {
        $this->assertIsArray($this->loader->load(NoRoutesFixture::class));
        $this->assertEquals(0, \count($this->loader->load(NoRoutesFixture::class)));
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
    
    /**
     * @dataProvider supportTrueProvider
     */
    public function testSupportTrue($class, $type)
    {
        $this->assertTrue($this->loader->support($class, $type));
    }
    
    /**
     * @dataProvider supportFalseProvider
     */
    public function testSupportFalse($class, $type)
    {
        $this->assertFalse($this->loader->support($class, $type));
    }
    
    public function supportTrueProvider(): array
    {
        $class = FullFixture::class;
        return [
            [$class, 'attribute'],
            [$class, 'phpdoc'],
            [$class, ['attribute']],
            [$class, ['phpdoc']],
            [$class, ['attribute', 'phpdoc', 'foo']],
            [$class, ['foo', 'bar', 'baz', 'attribute']]
        ];
    }
    
    public function supportFalseProvider(): array
    {
        $class = FullFixture::class;
        return [
            ['CustomClass', 'attribute'],
            ['CustomClass', 'phpdoc'],
            [$class, ['foo', 'bar', 'baz']],
            [$class, 'foo']
        ];
    }
}
