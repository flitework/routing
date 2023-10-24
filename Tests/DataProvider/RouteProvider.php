<?php

namespace Flitework\Routing\Tests\DataProvider;

use Flitework\Routing\Route;

/**
 * @author Ivan Mezinov <ivanmezinov@mail.ru>
 */
class RouteProvider
{
    public static function get()
    {
        return [
            ['route', new Route('/foo'), '/foo'],
            ['route', new Route('/foo/{bar}/baz'), '/foo/string/baz/'],
            ['route', new Route('/{id}/foo/bar/'), '/string/foo/bar'],
        ];
    }
}
