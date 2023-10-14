<?php

namespace Flitework\Routing\Tests\DataProvider;

class RouteProvider
{
    public static function get()
    {
        return [
            ['/path', ['GET', 'POST'], ['id']]
        ];
    }
}
