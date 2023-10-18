<?php

namespace Flitework\Routing\Tests\Fixtures\AttributeFixtures;

use Flitework\Routing\Route;

/**
 * @author Ivan Mezinov <ivanmezinov@mail.ru>
 */
class MissingParameterNameForRouteFixture
{
    #[Route(path: '/bar')]
    public function bar()
    {}
}
