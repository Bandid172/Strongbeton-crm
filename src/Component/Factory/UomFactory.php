<?php

namespace App\Component\Factory;

use App\Entity\Uom;

class UomFactory
{
    public function create(string $name): Uom
    {
        $uom = new Uom();
        $uom->setName($name);

        return $uom;
    }
}