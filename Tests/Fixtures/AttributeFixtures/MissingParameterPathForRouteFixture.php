<?php

namespace Flitework\Routing\Tests\Fixtures\AttributeFixtures;

use Flitework\Routing\Route;

/**
 * @author Ivan Mezinov <ivanmezinov@mail.ru>
 */
class MissingParameterPathForRouteFixture
{
    #[Route(name: 'foo')]
    public function foo()
    {}
}
