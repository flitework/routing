<?php

namespace Flitework\Routing\Tests\Fixtures\AttributeFixtures;

use Flitework\Routing\Route;

/**
 * @author Ivan Mezinov <ivanmezinov@mail.ru>
 */
class FullFixture
{
    #[Route(name: 'foo', path: '/foo')]
    public function foo()
    {
        
    }
    
    #[Route(name: 'bar', path: '/bar', methods: ['GET', 'POST'])]
    public function bar()
    {
        
    }
    
    #[Route(name: 'baz', path: '/baz', requirements: ['GET', 'POST'])]
    public function baz()
    {
        
    }
}
