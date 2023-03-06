<?php

namespace App\Domain\Sort\Service;

use App\Domain\Sort\Repository\SortRepository;

final class SortView
{
    /**
     * @var SortRepository
     */
    private $repository;

    public function __construct(SortRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Sélectionne la liste de toutes les écoles de magie.
     *
     * @return array Tous les genres
     */
    public function afficherSort(string $classe, int $niveau): array
    {
        

        $listeSorts = $this->repository->afficheSort($classe, $niveau);

        $resultat = [
            "sorts" => $listeSorts,
            "classe" => $classe,
            "niveau" => $niveau < 0 || $niveau > 9 ? "Tous" : $niveau
        ];  

        return $resultat;
    }


}
