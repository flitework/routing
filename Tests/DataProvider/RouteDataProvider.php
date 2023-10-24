<?php

namespace Flitework\Routing\Tests\DataProvider;

class RouteDataProvider
{
    public static function get()
    {
        return [
            ['/path', ['GET', 'POST'], ['id']]
        ];
    }
}
