<?php

namespace App\Controller;

use App\Component\Factory\UomFactory;
use App\Component\Manager\UomManager;
use App\Entity\Uom;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UomCreateAction extends AbstractController
{
    public function __construct(
        private readonly UomManager $uomManager,
        private readonly UomFactory $uomFactory
    )
    {
    }

    #[NoReturn] public function __invoke(Uom $data): void
    {
        $uom = $this->uomFactory->create($data->getName());

        $this->uomManager->save($uom, true);

        exit();
    }
}