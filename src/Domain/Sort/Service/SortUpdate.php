<?php

namespace App\Domain\Sort\Service;

use App\Domain\Sort\Repository\SortRepository;

final class SortUpdate
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
    public function modifierSort(int $id, array $data): array
    {

        $ancienSort = $this->repository->afficheSortParId($id);

        if(empty($ancienSort)) {
            $resultat = [
                "reponse" => [
                    "erreur" => "Le sort n'existe pas"
                ],
                "codeStatut" => 404
            ];
        } else {
            $nouveauSort = $this->repository->modificationSort($id, $data);

            $resultat = [
                "reponse" => $nouveauSort,
                "codeStatut" => 200
            ];  
        }

        

        return $resultat;
    }


}
