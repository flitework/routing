<?php

namespace Flitework\Routing\Exception;



/**
 * Description of RouteNotFoundException
 *
 * @author Ivan Mezinov <ivanmezinov@mail.ru>
 */
class RouteNotFoundException extends \Exception
{
    public function __construct(string $name)
    {
        return parent::__construct(sprintf('Route %s not found', $name), 0, null);
    }
}
