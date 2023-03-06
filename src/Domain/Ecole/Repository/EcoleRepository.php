<?php

namespace App\Domain\Ecole\Repository;

use PDO;

/**
 * Repository.
 */
class EcoleRepository
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
     * Sélectionne la liste des écoles de magie
     *
     * @return array La liste de toutes les écoles de magie
     */
    public function afficheEcole(): array
    {
        $sql = "SELECT DISTINCT school FROM dnd_spells ORDER BY school;";

        $query = $this->connection->prepare($sql);
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result ?? [];
    }

}

