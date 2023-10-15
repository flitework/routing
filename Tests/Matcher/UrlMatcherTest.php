<?php

namespace Flitework\Routing\Tests\Matcher;

use PHPUnit\Framework\TestCase;
use Flitework\Routing\Matcher\UrlMatcher;
use Flitework\Routing\Route;

class UrlMatcherTest extends TestCase
{
    private $matcher;
    private string $pattern;
    
    protected function setUp(): void
    {
        $this->matcher = new UrlMatcher();
        $this->pattern = '/path/{foo}/bar/{baz}';
    }
    
    public function testMatch()
    {
        $route = new Route($this->pattern);
        $this->assertEquals(Route::class, get_class($this->matcher->match($route, '/path/dssdg/bar/dfg////')));
    }
    
    public function testMatchNull()
    {
        $this->assertNull($this->matcher->match(new Route($this->pattern), '/dssdg/bar/dfg/'));
    }
}
