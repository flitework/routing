<?php

namespace Flitework\Routing\Contracts;

/**
 * 
 * @author Ivan Mezinov <ivanmezinov@mail.ru>
 */
interface LoaderInterface
{
    public function load(string $resource);
    public function supportType(): string;
}
