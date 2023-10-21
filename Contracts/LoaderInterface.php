<?php

namespace Flitework\Routing\Contracts;

/**
 * 
 * @author Ivan Mezinov <ivanmezinov@mail.ru>
 */
interface LoaderInterface
{
    public function load(string $resource);
    public function support(string $resource, string $type);
}
