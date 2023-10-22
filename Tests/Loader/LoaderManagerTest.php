<?php

namespace Flitework\Routing\Tests\Loader;

use PHPUnit\Framework\TestCase;
use Flitework\Routing\Loader\LoaderManager;
use Flitework\Routing\Loader\AttributeClassLoader;
use Flitework\Routing\Tests\Fixtures\AttributeFixtures\NoRoutesFixture;
use Flitework\Routing\Tests\Fixtures\AttributeFixtures\FullFixture;

/**
 * @author Ivan Mezinov <ivanmezinov@mail.ru>
 */
class LoaderManagerTest extends TestCase
{
    private $manager;
    
    protected function setUp(): void
    {
        $this->manager = new LoaderManager();
    }
    
    public function testLoadEmptyCollection()
    {
        $this->assertEquals(0, $this->manager->load(NoRoutesFixture::class)->count());
    }
    
    public function testLoad()
    {
        $this->manager->addLoader(AttributeClassLoader::class);
        $this->assertEquals(3, $this->manager->load(FullFixture::class)->count());
    }


    public function testAddLoader()
    {
        $manager = clone $this->manager;
        $this->assertEquals($manager, $this->manager);
        $this->manager->addLoader(AttributeClassLoader::class);
        $this->assertNotEquals($manager, $this->manager);
    }
}
