<?php

namespace Flitework\Routing\Contracts;

/**
 *
 * @author Ivan Mezinov <ivanmezinov@mail.ru>
 */
interface CollectionInterface
{
    public function get(string $name);
    public function has(string $name);
    public function add(string $name);
    public function remove(string $name);
    public function count();
    public function clear();
}
