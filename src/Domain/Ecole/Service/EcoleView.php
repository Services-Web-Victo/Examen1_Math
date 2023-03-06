<?php

namespace App\Domain\Ecole\Service;

use App\Domain\Ecole\Repository\EcoleRepository;

final class EcoleView
{
    /**
     * @var EcoleRepository
     */
    private $repository;

    public function __construct(EcoleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Sélectionne la liste de toutes les écoles de magie.
     *
     * @return array Tous les genres
     */
    public function viewEcole(): array
    {

        $ecoles = $this->repository->afficheEcole();

        $resultat = array_map(function($ligne) {
            return $ligne["school"];
        }, $ecoles);

        return $resultat;
    }


}
