<?php

namespace App\Domain\Sort\Repository;

use PDO;

/**
 * Repository.
 */
class SortRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Affiche une liste de sort
     */
    public function afficheSort(string $classe, int $niveau): array
    {
        if($niveau >= 0 and $niveau <= 9) {
            $sql = "SELECT id, name FROM dnd_spells WHERE classes LIKE :classes AND `level` = :niveau;";

            $params = [
                "classes" => '%' . $classe .'%',
                "niveau" => $niveau
            ];    
        } else {
            $sql = "SELECT id, name FROM dnd_spells WHERE classes LIKE :classes;";

            $params = [
                "classes" => '%' . $classe .'%'
            ]; 
        }

        $query = $this->connection->prepare($sql);
        $query->execute($params);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result ?? [];
    }

    /**
     * Affiche un sort selon son id
     * 
     * @param int $id Le id du sort à afficher
     * 
     * @return array Un tableau contenant les informations du sort
     */
    public function afficheSortParId(int $id): array
    {
        $sql = "SELECT * FROM dnd_spells WHERE id = :id;";
        $params = [ 
            "id" => $id
        ];

        $query = $this->connection->prepare($sql);
        $query->execute($params);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result[0] ?? [];
    }

    /**
     * Modifier un sort
     * 
     * @param int $id Le id du sort à modifier
     * @param array $data Les valeurs à modifier
     * 
     * @return array Les informations du sort qui a été modifié
     */
    public function modificationSort(int $id, array $data): array
    {
        $sql = "
            UPDATE dnd_spells
            SET name=:name, 
                classes=:classes, 
                `level`=:level, 
                school=:school, 
                cast_time=:cast_time, 
                `range`=:range, 
                duration=:duration, 
                verbal=:verbal, 
                somatic=:somatic, 
                material=:material, 
                material_cost=:material_cost, 
                description=:description
            WHERE id=:id;
        ";

        $params = [
            "name" => $data["name"],
            "classes" => $data["classes"], 
            "level" => $data["level"], 
            "school" => $data["school"], 
            "cast_time" => $data["cast_time"], 
            "range" => $data["range"], 
            "duration" => $data["duration"], 
            "verbal" => $data["verbal"], 
            "somatic" => $data["somatic"], 
            "material" => $data["material"], 
            "material_cost" => $data["material_cost"], 
            "description" => $data["description"],
            "id" => $id
        ];

        $query = $this->connection->prepare($sql);
        
        $query->execute($params);

        $resultat = $this->afficheSortParId($id);

        return $resultat;

    }

    // /**
    //  * Sélectionne la liste des sorts
    //  *
    //  * @return array La liste de toutes les écoles de magie
    //  */
    // public function afficheSort(): array
    // {
    //     $sql = "SELECT DISTINCT school FROM dnd_spells ORDER BY school;";

    //     $query = $this->connection->prepare($sql);
    //     $query->execute();

    //     $result = $query->fetchAll(PDO::FETCH_ASSOC);

    //     return $result ?? [];
    // }

}

